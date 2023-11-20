<template>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1><b>Drop-Off</b></h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Drop Off</a></li>
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
                    <div class="card-body">
                            <div class="card">
                                <br>
                                <div class="form-group col-md-12" style="text-align: center;">
                                    <h4 style="text-align: center;" for="inputPassword4"><b>BOOKING TYPE</b></h4>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="custom-control custom-radio">
                                                <input @click="clearDeliveryData" v-model="bookingType" value="PICKUP" class="custom-control-input" type="radio" id="pickupType" name="bookingType">
                                                <label for="pickupType" class="custom-control-label">PICK-UP</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="custom-control custom-radio">
                                                <input v-model="bookingType" value="DELIVERY" class="custom-control-input" type="radio" id="deliveryType" name="bookingType">
                                                <label for="deliveryType" class="custom-control-label">DELIVERY</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>FULL NAME</label>
                                        <input v-model="name" list="nameList" class="form-control" placeholder="Full Name">
                                        <datalist id="nameList">
                                            <option v-for="dropOff in dropOffs" :key="dropOff" :value="dropOff.name">{{ dropOff.name }}</option>
                                        </datalist>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>PHONE #</label>
                                        <input v-model="phoneNum" list="phoneNum" class="form-control" placeholder="Phone #">
                                        <datalist id="phoneNum">
                                            <option v-for="dropOffPhone in dropOffsPhoneNum" :key="dropOffPhone" :value="dropOffPhone.phoneNum">{{ dropOffPhone.phoneNum }}</option>
                                        </datalist>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row" v-if="bookingType === 'DELIVERY'">
                                <div class="form-group col-md-4">
                                    <label for="inputCity">HOME ADDRESS</label>
                                    <textarea v-model="homeAddress" class="form-control" rows="3" placeholder="Home Address"></textarea>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputState">BARANGAY</label>
                                    <select v-model="barangayID" id="inputState" class="form-control">
                                        <option v-for="barangay in barangays" :key="barangay.id" :value="barangay.id">{{ barangay.barangay }}</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputState">DATE AND TIME TO DELIVER</label>
                                    <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                        <input class="form-control" type="datetime-local" id="datetime-input" v-model="selectedDelivery"/>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="card">
                                <br>
                                <div class="form-group col-md-12" style="text-align: center;">
                                    <h4 for="inputPassword4"><b>TRANSACTION TYPE</b></h4>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="custom-control custom-radio">
                                                <input v-model="transactionType" value="LOAD" class="custom-control-input" type="radio" id="loadType" name="transactionType">
                                                <label for="loadType" class="custom-control-label">LOAD</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="custom-control custom-radio">
                                                <input v-model="transactionType" value="KILO" class="custom-control-input" type="radio" id="kiloType" name="transactionType">
                                                <label for="kiloType" class="custom-control-label">KILO</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="custom-control custom-radio">
                                                <input v-model="transactionType" value="LOAD AND KILO" class="custom-control-input" type="radio" id="loadkiloType" name="transactionType">
                                                <label for="loadkiloType" class="custom-control-label">LOAD AND KILO</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row" v-if="transactionType === 'LOAD' || transactionType === 'LOAD AND KILO'">
                                <div class="form-group col-md-4">
                                    <label for="inputState">LOAD</label>
                                    <select v-model="load" id="inputState" class="form-control">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row" v-if="transactionType === 'KILO' || transactionType === 'LOAD AND KILO'">
                                <div class="form-group col-md-4" v-for="laundryKilo in laundryKilos" :key="laundryKilo.id">
                                    <label for="inputState">{{ laundryKilo.type }}</label>
                                    <input v-model="kilo[laundryKilo.id]" type="number" class="form-control" placeholder="Input KG">
                                </div>
                            </div>


                            <br>
                            <div class="card">
                                <br>
                                <h4 style="text-align: center;" for="inputPassword4"><b>PRODUCTS AND SERVICES</b></h4>
                                <br>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="inputState">SERVICES</label>
                                    <select v-model="serviceType" id="inputState" class="form-control" >
                                        <option v-for="service in services" :key="service.id" :value="service.id">{{ service.type }}</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputState">DETERGENT</label>
                                    <select v-model="detergentType" id="inputState" class="form-control">
                                        <option v-for="detergent in detergents" :key="detergent.id" :value="detergent.id">{{ detergent.type }}</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputState">BLEACH</label>
                                    <select v-model="bleachType" id="inputState" class="form-control">
                                        <option v-for="bleach in bleaches" :key="bleach.id" :value="bleach.id">{{ bleach.type }}</option>
                                    </select>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <p class="lead">Total Amount</p>

                        <div class="table-responsive" v-if="transactionType">
                            <table class="table">
                            <tr>
                                <th style="width:100%">Transaction Type</th>
                                <td>{{ transactionType }}</td>
                            </tr>
                            <!-- LOAD -->
                            <tr v-show="transactionType === 'LOAD'">
                                <th style="width:100%">{{ transactionType }}</th>
                                <td>₱{{ load * laundryLoads[0].price }}</td>
                            </tr>
                            <tr v-show="transactionType === 'LOAD'" v-for="service in services" :key="service">
                                <th style="width:100%" v-show="serviceType === service.id">{{ service.type }}</th>
                                <td v-show="serviceType === service.id">₱{{ service.price }}</td>
                            </tr>
                            <tr v-show="transactionType === 'LOAD'" v-for="detergent in detergents" :key="detergent">
                                <th style="width:100%" v-show="detergentType === detergent.id">{{ detergent.type }}</th>
                                <td v-show="detergentType === detergent.id">₱{{ detergent.price * totalLoadKilograms }}</td>
                            </tr>
                            <tr v-show="transactionType === 'LOAD'" v-for="bleach in bleaches" :key="bleach">
                                <th style="width:100%" v-show="bleachType === bleach.id">{{ bleach.type }}</th>
                                <td v-show="bleachType === bleach.id">₱{{ bleach.price * totalLoadKilograms }}</td>
                            </tr>
                            <!-- LOAD -->

                            <!-- KILO -->
                            <tr v-show="transactionType === 'KILO'" v-for="laundryKilo in laundryKilos" :key="laundryKilo.id">
                                <th style="width:100%" v-if="kilo[laundryKilo.id]">{{ laundryKilo.type }}</th>
                                <td v-if="kilo[laundryKilo.id]">₱{{ kiloTotal[laundryKilo.id] || 0 }}</td>
                            </tr>
                            <tr v-show="transactionType === 'KILO'" v-for="service in services" :key="service">
                                <th style="width:100%" v-show="serviceType === service.id">{{ service.type }}</th>
                                <td v-show="serviceType === service.id">₱{{ service.price }}</td>
                            </tr>
                            <tr v-show="transactionType === 'KILO'" v-for="detergent in detergents" :key="detergent">
                                <th style="width:100%" v-show="detergentType === detergent.id">{{ detergent.type }}</th>
                                <td v-show="detergentType === detergent.id">₱{{ detergent.price * totalKilograms }}</td>
                            </tr>
                            <tr v-show="transactionType === 'KILO'" v-for="bleach in bleaches" :key="bleach">
                                <th style="width:100%" v-show="bleachType === bleach.id">{{ bleach.type }}</th>
                                <td v-show="bleachType === bleach.id">₱{{ bleach.price * totalKilograms }}</td>
                            </tr>
                            <!-- KILO -->

                            <!-- LOAD AND KILO -->
                            <tr v-show="transactionType === 'LOAD AND KILO'">
                                <th style="width:100%">LOAD</th>
                                <td>₱{{ load * laundryLoads[0].price }}</td>
                            </tr>
                            <tr v-show="transactionType === 'LOAD AND KILO'" v-for="laundryKilo in laundryKilos" :key="laundryKilo.id">
                                <th style="width:100%" v-if="kilo[laundryKilo.id]">{{ laundryKilo.type }}</th>
                                <td v-if="kilo[laundryKilo.id]">₱{{ kiloTotal[laundryKilo.id] || 0 }}</td>
                            </tr>
                            <tr v-show="transactionType === 'LOAD AND KILO'" v-for="service in services" :key="service">
                                <th style="width:100%" v-show="serviceType === service.id">{{ service.type }}</th>
                                <td v-show="serviceType === service.id">₱{{ service.price }}</td>
                            </tr>
                            <tr v-show="transactionType === 'LOAD AND KILO'" v-for="detergent in detergents" :key="detergent">
                                <th style="width:100%" v-show="detergentType === detergent.id">{{ detergent.type }}</th>
                                <td v-show="detergentType === detergent.id">₱{{ (totalKilograms + totalLoadKilograms) * detergent.price }}</td>
                            </tr>
                            <tr v-show="transactionType === 'LOAD AND KILO'" v-for="bleach in bleaches" :key="bleach">
                                <th style="width:100%" v-show="bleachType === bleach.id">{{ bleach.type }}</th>
                                <td v-show="bleachType === bleach.id">₱{{ (totalKilograms + totalLoadKilograms) * bleach.price }}</td>
                            </tr>
                            <!-- LOAD AND KILO -->

                            <tr v-show="barangayID" v-for="barangay in barangays" :key="barangay">
                                <th style="width:100%" v-show="barangayID === barangay.id">Delivery Fee</th>
                                <td v-show="barangayID === barangay.id">₱{{ barangay.price * 0.5 }}</td>
                            </tr>

                            <tr v-show="transactionType === 'LOAD'|| transactionType === 'KILO' || transactionType === 'LOAD AND KILO'">
                                <th style="width:100%">Total Amount</th>
                                <td>₱{{ totalPriceOfAll }}</td>
                            </tr>

                            </table>
                        </div>
                        <br>
                        <button v-if="bookingType === 'DELIVERY'" :disabled="!name || !phoneNum || !homeAddress || !barangayID || !selectedDelivery || !transactionType || !serviceType || !detergentType || !bleachType" @click="addDropOff('DROP-OFF / DELIVERY PENDING')" class="btn btn-success btn-block">SUBMIT</button>
                        <button v-else :disabled="!name || !phoneNum || !transactionType || !serviceType || !detergentType || !bleachType" @click="addDropOff('DROP-OFF / PICKUP PENDING')" class="btn btn-success btn-block">SUBMIT</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            laundryLoads: {},
            services: {},
            detergents: {},
            bleaches: {},
            barangays: {},
            laundryKilos: {},
            dropOffs: {},
            dropOffsPhoneNum: {},

            name: '',
            phoneNum: '',
            barangayID: '',
            bookingType: '',
            selectedDelivery: '',
            homeAddress: '',
            totalPrice: '',
            transactionType: '',
            kilo: [],
            serviceType: '',
            detergentType: '',
            bleachType: '',
            load: '',

        }
    },
    mounted() {
        this.getServices();
        this.getDetergents();
        this.getBleaches();
        this.getBarangays();
        this.getLaundryKilo();
        this.getLaundryLoad();
        this.getDropOff();
        this.getDropOffPhoneNum();
    },
    computed: {
        kiloTotal() {
            const total = {};
            for (const laundryKilo of this.laundryKilos) {
                const kiloValue = this.kilo[laundryKilo.id] || 0;
                const price = laundryKilo.price || 0;
                total[laundryKilo.id] = kiloValue * price;
            }
            return total;
        },
        totalKilograms() {
            let sum = 0;
            for (const laundryKilo of this.laundryKilos) {
                sum += parseFloat(this.kilo[laundryKilo.id]) || 0;
            }
            return sum;
        },
        totalLoadKilograms() {
            let sum = 0;
            for (const laundryLoad of this.laundryLoads) {
                sum += parseFloat(laundryLoad.kilo * this.load) || 0;
            }
            return sum;
        },
        totalPriceOfAll() {
        let total = 0;
            if (this.transactionType === 'LOAD') {
            total += this.load * this.laundryLoads[0].price;

                for (const service of this.services) {
                    if (this.serviceType === service.id) {
                    total += service.price;
                    }
                }

                for (const detergent of this.detergents) {
                    if (this.detergentType === detergent.id) {
                    total += detergent.price * this.totalLoadKilograms;
                    }
                }

                for (const bleach of this.bleaches) {
                    if (this.bleachType === bleach.id) {
                    total += bleach.price * this.totalLoadKilograms;
                    }
                }

                for (const barangay of this.barangays) {
                    if (this.barangayID === barangay.id) {
                    total += barangay.price * 0.5;
                    }
                }
            }

            if (this.transactionType === 'KILO') {
                for (const laundryKilo of this.laundryKilos) {
                    total += (this.kilo[laundryKilo.id] || 0) * laundryKilo.price;
                }

                for (const service of this.services) {
                    if (this.serviceType === service.id) {
                    total += service.price;
                    }
                }

                for (const detergent of this.detergents) {
                    if (this.detergentType === detergent.id) {
                    total += detergent.price * this.totalKilograms;
                    }
                }

                for (const bleach of this.bleaches) {
                    if (this.bleachType === bleach.id) {
                    total += bleach.price * this.totalKilograms;
                    }
                }

                for (const barangay of this.barangays) {
                    if (this.barangayID === barangay.id) {
                    total += barangay.price;
                    }
                }
            }

            if (this.transactionType === 'LOAD AND KILO') {
                total += this.load * this.laundryLoads[0].price;

                for (const laundryKilo of this.laundryKilos) {
                    total += (this.kilo[laundryKilo.id] || 0) * laundryKilo.price;
                }

                for (const service of this.services) {
                    if (this.serviceType === service.id) {
                    total += service.price;
                    }
                }

                for (const detergent of this.detergents) {
                    if (this.detergentType === detergent.id) {
                    total += (this.totalKilograms + this.totalLoadKilograms) * detergent.price;
                    }
                }

                for (const bleach of this.bleaches) {
                    if (this.bleachType === bleach.id) {
                    total += (this.totalKilograms + this.totalLoadKilograms) * bleach.price;
                    }
                }

                for (const barangay of this.barangays) {
                    if (this.barangayID === barangay.id) {
                    total += barangay.price;
                    }
                }
            }
        return total;
        },
    },
    methods: {
        async addDropOff(status) {
            try {
                const laundryKiloData = [];

                for (const laundryKilo of this.laundryKilos) {
                    const kilo = this.kilo[laundryKilo.id] || 0;
                    if (kilo > 0) {
                        laundryKiloData.push({
                            type: laundryKilo.id,
                            kilo: kilo,
                        });
                    }
                }

                const response = await axios.post('/web/adddropoff', {
                    name: this.name,
                    phoneNum: this.phoneNum,
                    barangayID: this.barangayID,
                    bookingType: this.bookingType,
                    selectedDelivery: this.selectedDelivery,
                    homeAddress: this.homeAddress,
                    totalPrice: this.totalPrice,
                    transactionType: this.transactionType,
                    laundryKilos: laundryKiloData,
                    load: this.load,
                    service: this.serviceType,
                    detergent: this.detergentType,
                    bleach: this.bleachType,
                    totalPrice: this.totalPriceOfAll,
                    status: status,
                });
            } catch(error) {
                console.error(error);
            } finally {

                this.$router.push('/pickupdelivery');

                this.$swal({
                    title: 'Submitted Successfully',
                    text: 'You have successfully Submitted.',
                    icon: 'success',
                    toast: true,
                    position: 'top-end',
                    timer: 3000,
                    showConfirmButton: false
                });

                this.name = '';
                this.phoneNum = '';
                this.barangayID = '';
                this.bookingType = '';
                this.selectedDelivery = '';
                this.homeAddress = '';
                this.totalPrice = '';
                this.transactionType = '';
                this.kilo = [];
                this.serviceType = '';
                this.detergentType = '';
                this.bleachType = '';
                this.load = '';
            }
        },
        async getLaundryLoad() {
            try {
                const response = await axios.get('/web/getlaundryloads');
                this.laundryLoads = response.data;
            } catch(error) {
                console.error(error);
            }
        },
        async getServices() {
            try {
                const response = await axios.get('/web/getservices');
                this.services = response.data;
            } catch(error) {
                console.error(error);
            }
        },
        async getDetergents() {
            try {
                const response = await axios.get('/web/getdetergents');
                this.detergents = response.data;
            } catch(error) {
                console.error(error);
            }
        },
        async getBleaches() {
            try {
                const response = await axios.get('/web/getbleaches');
                this.bleaches = response.data;
            } catch(error) {
                console.error(error);
            }
        },
        async getBarangays() {
            try {
                const response = await axios.get('/web/getbarangays');
                this.barangays = response.data;
            } catch(error) {
                console.error(error);
            }
        },
        async getLaundryKilo() {
            try {
                const response = await axios.get('/web/getlaundrykilos');
                this.laundryKilos = response.data;
            } catch(error) {
                console.error(error);
            }
        },
        clearDeliveryData() {
            this.homeAddress = '';
            this.barangayID = '';
            this.selectedDelivery = '';
        },
        async getDropOff() {
            try {
                const response = await axios.get('/web/getdropoff');
                this.dropOffs = response.data;
            } catch(error) {
                console.error(error);
            }
        },
        async getDropOffPhoneNum() {
            try {
                const response = await axios.get('/web/getdropoffphonenum');
                this.dropOffsPhoneNum = response.data;
            } catch(error) {
                console.error(error);
            }
        },
    }
}
</script>
