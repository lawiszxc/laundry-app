<template>
    <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1><b>Remittances</b></h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Remittances</a></li>
            <li class="breadcrumb-item active">Admin</li>
            </ol>
        </div>
        </div>
    </div>
    </div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-header d-flex p-0">
                        <h3 class="card-title p-3">Remittances</h3>
                            <ul class="nav nav-pills ml-auto p-2">
                                <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">ONLINE</a></li>
                                <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">DROP-OFF</a></li>
                                <li class="nav-item"><a class="nav-link" href="#tab_3" data-toggle="tab">GCASH</a></li>
                            </ul>
                    </div>

                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                                <div class="col-sm-12">
                                    <h4 class="text-center"><b>ONLINE</b></h4>
                                    <br>
                                </div>
                                <div v-if="isLoading" class="text-center">
                                    <button class="btn btn-dark btn-block" type="button" disabled>
                                        <span class="spinner-border spinner-border-sm text-white" role="status" aria-hidden="true"></span>
                                        Loading...
                                    </button>
                                </div>
                                <div v-else>
                                    <table ref="dataTable" class="table table-bordered table-hover text-nowrap" style="text-align: center;">
                                        <thead>
                                            <tr>
                                                <th>Rider</th>
                                                <th>Collection</th>
                                                <th>Records</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="remittance in uniqueRemittances" :key="remittance.id">
                                                <td class="text-bold">{{ remittance.user.name }}</td>
                                                <td>₱{{ onlineTotalCollected[remittance.user.id] }}</td>
                                                <td><button class="btn btn-primary btn-sm" data-toggle="modal" :data-target="'#riderRemittance' + remittance.user.id">View</button></td>
                                                <td>
                                                    <div v-if="remittance.status || isLoading">
                                                        <span class="badge badge-success">COLLECTED</span>
                                                    </div>
                                                    <button v-else @click="updateRemittanceStatus(remittance.user.id)" class="btn btn-success btn-sm">COLLECT</button>
                                                </td>

                                                <div class="modal fade" :id="'riderRemittance' + remittance.user.id">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">{{ remittance.user.name }} Remittances</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <table ref="dataTable" class="table table-bordered table-hover text-nowrap" style="text-align: center;">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Customer</th>
                                                                            <th>Transaction #</th>
                                                                            <th>Total Price</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr v-for="record in remittances" :key="record" v-show="remittance.user.id === record.userID">
                                                                            <td class="text-bold">{{ record.booking.user.name }}</td>
                                                                            <td><span class="badge bg-primary">{{ record.booking.transactionNum }}</span></td>
                                                                            <td>₱{{ record.collected }}</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab_2">
                                <div class="col-sm-12">
                                    <h4 class="text-center"><b>DROP-OFF</b></h4>
                                    <br>
                                </div>
                                <div v-if="isLoading" class="text-center">
                                    <button class="btn btn-dark btn-block" type="button" disabled>
                                        <span class="spinner-border spinner-border-sm text-white" role="status" aria-hidden="true"></span>
                                        Loading...
                                    </button>
                                </div>
                                <div v-else>
                                    <table ref="dataTable2" class="table table-bordered table-hover text-nowrap" style="text-align: center;">
                                    <thead>
                                        <tr>
                                            <th>Customer</th>
                                            <th>Transaction #</th>
                                            <th>Collection</th>
                                            <th>Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="remittance in remittancesDropoff" :key="remittance.id">
                                                <td>{{ remittance.name }}</td>
                                                <td><span class="badge badge-primary">{{ remittance.booking.transactionNum }}</span></td>
                                                <td>₱{{ remittance.booking_sum_total_price }}</td>
                                                <td><span class="badge badge-success">COLLECTED</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab_3">
                                <div class="col-sm-12">
                                    <h4 class="text-center"><b>GCASH</b></h4>
                                    <br>
                                </div>
                                <div v-if="isLoading" class="text-center">
                                    <button class="btn btn-dark btn-block" type="button" disabled>
                                        <span class="spinner-border spinner-border-sm text-white" role="status" aria-hidden="true"></span>
                                        Loading...
                                    </button>
                                </div>
                                <div v-else>
                                    <table ref="dataTable3" class="table table-bordered table-hover text-nowrap" style="text-align: center;">
                                    <thead>
                                        <tr>
                                            <th>Customer</th>
                                            <th>Transaction #</th>
                                            <th>Collection</th>
                                            <th>Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="gcashRemittance in gcashRemittances" :key="gcashRemittance.id">
                                                <td class="text-bold">{{ gcashRemittance.booking.user.name }}</td>
                                                <td><span class="badge badge-primary">{{ gcashRemittance.booking.transactionNum }}</span></td>
                                                <td>₱{{ gcashRemittance.booking.totalPrice }}</td>
                                                <td><span class="badge badge-success">COLLECTED</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-4">
                <div class="card">
                    <div class="card-header d-flex p-0">
                        <h3 class="card-title p-3">Remittances History</h3>
                    </div>

                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                                <div v-if="isLoading" class="text-center">
                                    <button class="btn btn-dark btn-block" type="button" disabled>
                                        <span class="spinner-border spinner-border-sm text-white" role="status" aria-hidden="true"></span>
                                        Loading...
                                    </button>
                                </div>
                                <div v-else>
                                    <table ref="dataTable4" class="table table-bordered table-hover text-wrap" style="text-align: center;">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Records</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(remittancesHistory, dateHistory) in remittancesHistories" :key="dateHistory">
                                                <td>{{ formatDate(dateHistory) }}</td>
                                                <td><button class="btn btn-primary btn-sm" data-toggle="modal" :data-target="'#historyRemittance' + dateHistory">View</button></td>

                                                <div class="modal fade" :id="'historyRemittance' + dateHistory">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">{{ formatDate(dateHistory) }} Records</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <table class="table table-bordered table-hover text-wrap" style="text-align: center;">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Customer</th>
                                                                                <th>Order Type</th>
                                                                                <th>Transaction #</th>
                                                                                <th>Total Price</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr v-for="record in remittancesHistory" :key="record">
                                                                                <td class="text-bold">{{ record.user?.name ?? record.dropoff.name }}</td>

                                                                                <td v-if="record.user?.name"><span class="badge bg-dark">ONLINE</span></td>
                                                                                <td v-else><span class="badge bg-secondary">DROP-OFF</span></td>

                                                                                <td><span class="badge bg-primary">{{ record.transactionNum }}</span></td>
                                                                                <td>₱{{ record.totalPrice }}</td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-3">
                                                                    </div>

                                                                    <div class="col-9">
                                                                        <br>
                                                                        <p class="lead">{{ formatDate(dateHistory) }} Total Amount</p>

                                                                        <div class="table-responsive">
                                                                            <table class="table">
                                                                            <tr>
                                                                                <th style="width:60%">Total Amount:</th>
                                                                                <td class="text-bold">₱{{ remittancesHistories[dateHistory].reduce((acc, record) => acc + parseFloat(record.totalPrice), 0) }}</td>
                                                                            </tr>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</template>

<script>
import axios from 'axios';
import moment from 'moment';

export default {
    data() {
        return {
            isLoading: true,
            dataTableInstance: null,
            dataTableInstance2: null,
            dataTableInstance3: null,
            dataTableInstance4: null,
            remittances: {},
            remittancesDropoff: {},
            status: '',
            remittanceTotal: 0,
            totalCollected: 0,
            onlineTotalCollected: 0,
            gcashRemittances: {},
            remittancesHistories: {},
        }
    },
    mounted() {
        this.initDataTable();
        this.getRemittances();
        this.getRemittanceTotal();
        this.initDataTable2();
        this.initDataTable3();
        this.initDataTable4();
        this.getRemittancesDropoff();
        this.getGcashRemittance();
        this.getremittancesHistory();
    },
    computed: {
        uniqueRemittances() {
            const uniqueNames = new Set();
            return this.remittances.filter((remittance) => {
                if (!uniqueNames.has(remittance.user.name)) {
                uniqueNames.add(remittance.user.name);
                return true; // Include the first occurrence of each name
                }
                return false;
            });
        },
    },
    methods: {
        initDataTable() {
        if (this.dataTableInstance) {
            this.dataTableInstance.destroy();
        }

        this.dataTableInstance = $(this.$refs.dataTable).DataTable({
            dom: 'B<"float-right"f>t<ip>',
            buttons: [
                'pageLength',
                'copy',
                'excel',
                'pdf',
                'print'
            ]
        });
        },
        initDataTable2() {
        if (this.dataTableInstance2) {
            this.dataTableInstance2.destroy();
        }

        this.dataTableInstance2 = $(this.$refs.dataTable2).DataTable({
            dom: 'B<"float-right"f>t<ip>',
            buttons: [
                'pageLength',
                'copy',
                'excel',
                'pdf',
                'print'
            ]
        });
        },
        initDataTable3() {
        if (this.dataTableInstance3) {
            this.dataTableInstance3.destroy();
        }

        this.dataTableInstance3 = $(this.$refs.dataTable3).DataTable({
            dom: 'B<"float-right"f>t<ip>',
            buttons: [
                'pageLength',
                'copy',
                'excel',
                'pdf',
                'print'
            ]
        });
        },
        initDataTable4() {
        if (this.dataTableInstance4) {
            this.dataTableInstance4.destroy();
        }

        this.dataTableInstance4 = $(this.$refs.dataTable4).DataTable({
            dom: 'B<"float-right"f>t<ip>',
                ordering: false,
            buttons: [
            ]
        });
        },
        async getRemittances() {
            try{
                const response = await axios.get('/web/getremittances');
                this.remittances = response.data.remittances;
                this.onlineTotalCollected = response.data.totals;
            } catch(error) {
                console.error(error);
            } finally {
                this.isLoading = false;
                this.$nextTick(() => {
                    this.initDataTable();
                });
            }
        },
        async getRemittancesDropoff() {
            try{
                const response = await axios.get('/web/getremittancesdropoff');
                this.remittancesDropoff = response.data;
            } catch(error) {
                console.error(error);
            } finally {
                this.isLoading = false;
                this.$nextTick(() => {
                    this.initDataTable2();
                });
            }
        },
        async getRemittanceTotal() {
            try{
                const response = await axios.get('/web/getremittancetotal');
                this.remittanceTotal = response.data.remittanceTotal;
                this.totalCollected = response.data.totalCollected;

                // this.totalCollected = this.remittanceCollectedTotal + this.bookingCollectedTotal;

            } catch(error) {
                console.error(error);
            } finally {
                this.isLoading = false;
                this.getRemittanceTotal();
            }
        },
        async updateRemittanceStatus(userID) {
            try{
                const response = await axios.post(`/web/updateremittancestatus/${userID}`)
            } catch(error) {
                console.error(error);
            } finally {
                this.$nextTick(() => {
                    this.initDataTable();
                    this.getRemittances();
                });
            }
        },
        async getGcashRemittance() {
            try {
                const response = await axios.get('/web/getgcashremittance');
                this.gcashRemittances = response.data;
            } catch(error) {
                console.error(error);
            } finally {
                this.isLoading = false;
                this.$nextTick(() => {
                    this.initDataTable3();
                });
            }
        },
        async getremittancesHistory() {
            try {
                const response = await axios.get('/web/getremittanceshistory');
                this.remittancesHistories = response.data;
            } catch(error) {
                console.error(error);
            } finally {
                this.isLoading = false;
                this.$nextTick(() => {
                    this.initDataTable4();
                });
            }
        },
        formatDate(date) {
            return moment(date).format('MMMM. D, YYYY');
        },
    }
}
</script>
