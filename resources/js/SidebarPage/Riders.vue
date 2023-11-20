<template>
    <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1><b>Riders Account | <button type="button" class="btn btn-success btn-sm"  data-toggle="modal" data-target="#addDriver" data-dismiss="modal"><i class="fas fa-edit"> ADD</i></button></b></h1>

            <div class="modal fade" id="addDriver">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><b>Add Rider</b></h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><div class="text-right">Full Name</div></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="Enter Full Name" v-model="name">
                        </div>
                        </div>

                        <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><div class="text-right">Phone#</div></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="Enter Phone Number" v-model="phoneNum">
                        </div>
                        </div>

                        <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><div class="text-right">Email</div></label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" placeholder="Enter Email" v-model="email">
                        </div>
                        </div>

                        <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><div class="text-right">Password</div></label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" placeholder="Enter Password" v-model="password" readonly>
                        </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button :disabled="!name || !phoneNum || !email" @click="addDriver()" class="btn btn-success btn-block">ADD</button>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Riders Account</a></li>
            <li class="breadcrumb-item active">Admin</li>
            </ol>
        </div>
        </div>
    </div>
    </div>

<section class="content">
    <div class="container-fluid">
    <div class="card">
            <div class="card-body">
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
                            <!-- <th class="text-center">Image</th> -->
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                          <tr v-for="driver in drivers" :key="driver.id">
                              <td>{{ driver.name }}</td>
                              <td>{{ driver.email }}</td>
                              <td>{{ driver.phoneNum }}</td>
                              <td>
                                <button class="btn btn-warning btn-sm" data-toggle="modal" :data-target="'#driverEdit' + driver.id" data-dismiss="modal">EDIT</button>

                                <div class="modal fade" :id="'driverEdit' + driver.id">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title"><b>Update Driver</b></h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group" style="text-align: left;">
                                                <label for="exampleInputEmail1">Name</label>
                                                <input type="text" class="form-control" v-model="driver.name">
                                            </div>
                                            <div class="form-group" style="text-align: left;">
                                                <label for="exampleInputEmail1">Email</label>
                                                <input type="text" class="form-control" v-model="driver.email">
                                            </div>
                                            <div class="form-group" style="text-align: left;">
                                                <label for="exampleInputEmail1">Phone Number</label>
                                                <input type="text" class="form-control" v-model="driver.phoneNum">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button @click="updateDriver(driver)" class="btn btn-warning btn-block">UPDATE</button>
                                        </div>
                                        </div>
                                    </div>
                                </div>

                                <button @click="deleteRider(driver)" class="btn btn-danger btn-sm">DELETE</button>
                              </td>
                          </tr>
                        </tbody>
                    </table>
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
            isLoading: false,
            drivers: [],
            dataTableInstance: null,

            name: '',
            email: '',
            password: '123123',
            phoneNum: '',
        }
    },
    mounted() {
        this.getDrivers();
        this.initDataTable();
    },
    methods: {
        async getDrivers() {
            this.isLoading = true;

            try {
                const response = await axios.get('/web/getdrivers');
                this.drivers = response.data;

            } catch(error) {
                console.error('Error: ', error);
            } finally {
                this.isLoading = false;
                this.$nextTick(() => {
                    this.initDataTable();
                });
            }
        },
        initDataTable() {
        if (this.dataTableInstance) {
            this.dataTableInstance.destroy();
        }

        this.dataTableInstance = $(this.$refs.dataTable).DataTable();
        },
        async addDriver() {
            try {
                this.isLoading = true;

                const response = await axios.post('/web/adddriver', {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    phoneNum: this.phoneNum,
                });
                this.drivers.push(response.data);

                $(`#addDriver`).modal('hide');

                this.$swal({
                    title: 'Added Successfully',
                    text: 'You have successfully added.',
                    icon: 'success',
                    toast: true,
                    position: 'top-end',
                    timer: 3000,
                    showConfirmButton: false
                });

            } catch(error) {
                console.error(error);
            } finally {
                this.isLoading = false;
                this.$nextTick(() => {
                    this.initDataTable();
                });
            }
        },
        async updateDriver(driver) {
            const updatedData = {
                name: driver.name,
                email: driver.email,
                phoneNum: driver.phoneNum,
            }
            try {
                const response = await axios.patch(`/web/updatedriver/${driver.id}`, updatedData);

                $(`#driverEdit${driver.id}`).modal('hide');

                this.$swal({
                    title: 'Updated Successful',
                    text: 'You have successfully updated.',
                    icon: 'success',
                    toast: true,
                    position: 'top-end',
                    timer: 3000,
                    showConfirmButton: false
                });
            } catch(error) {
                console.error(error);
            }
        },
        async deleteRider(driver) {
            try {
                const response = await axios.delete(`/web/deleterider/${driver.id}`)

                this.$swal({
                    title: 'Deleted Successful',
                    text: 'You have successfully deleted.',
                    icon: 'success',
                    toast: true,
                    position: 'top-end',
                    timer: 3000,
                    showConfirmButton: false
                });
            } catch(error) {
                console.error(error);
            } finally {
                this.getDrivers();
            }
        }
    }
}
</script>
