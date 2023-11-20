<template>
<div class="preloader flex-column justify-content-center align-items-center" v-if="isLoading">
    <img class="animation__shake" src="/images/bubbles.jpg" height="60" width="60">
</div>
    <div class="content-header" v-else>
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-12">
                <h1 class="text-center"><b>Laundry Settings</b></h1>
            </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
    <div class="container-fluid">
        <div class="row">
        <div class="col-4">
            <div class="card">
              <div class="modal-header">
                <h4 class="modal-title" style="margin: 0 auto;"><b>Laundry Load</b></h4>
              </div>

              <div class="card-body">
                  <ul class="nav flex-column">
                    <li style="margin: 0 auto;" class="nav-item" v-for="laundryLoad in laundryLoads" :key="laundryLoad.id">
                      <h3 class="nav-link text-bold">
                        {{ laundryLoad.kilo }}kg
                         / &nbsp;
                        <span class="float-right badge bg-info" data-toggle="modal" :data-target="'#loadPrice' + laundryLoad.id" data-dismiss="modal">₱{{ (laundryLoad.price).toFixed(2) }}</span>
                      </h3>

                    <div class="modal fade" :id="'loadPrice' + laundryLoad.id">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"><b>Update Load Price</b></h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label"><div class="text-right">Load Price</div></label>

                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" v-model="laundryLoad.price">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button @click="updateLaundryLoads(laundryLoad)" class="btn btn-warning btn-block">UPDATE</button>
                            </div>
                            </div>
                        </div>
                    </div>
                    </li>
                  </ul>
                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="card">
              <div class="modal-header">
                <h4 class="modal-title" style="margin: 0 auto;"><b>Laundry Kilos</b></h4>
              </div>
              <div class="card-body">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Type</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Input Type" v-model="laundryKiloType">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Price</label>
                    <div class="col-sm-10">
                    <input type="number" class="form-control" placeholder="Input Price" v-model="laundryKiloPrice">
                    </div>
                </div>

                <button :disabled="!laundryKiloType || !laundryKiloPrice" @click="addLaundryKilo()" class="btn btn-success btn-sm btn-block">ADD</button>
                </div>
                <div class="card-footer">
                    <ul class="nav flex-column">
                    <li class="nav-item" v-for="laundryKilo in laundryKilos" :key="laundryKilo.id">
                        <h6 class="nav-link text-bold">
                        <button @click="deleteLaundryKilo(laundryKilo.id)" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></button>

                        {{ laundryKilo.type }}

                        <span class="float-right badge bg-info" data-toggle="modal" :data-target="'#laundryKiloPrice' + laundryKilo.id" data-dismiss="modal">₱{{ laundryKilo.price }} / kg</span>
                        </h6>

                        <div class="modal fade" :id="'laundryKiloPrice' + laundryKilo.id">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title"><b>Update Laundry Kilo</b></h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Type</label>
                                        <input type="text" class="form-control" v-model="laundryKilo.type">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Price</label>
                                        <input type="text" class="form-control" v-model="laundryKilo.price">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button @click="updateLaundryKilo(laundryKilo)" class="btn btn-warning btn-block">UPDATE</button>
                                </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-4 justify-content-center">
            <div class="card">
              <div class="modal-header">
                <h4 class="modal-title" style="margin: 0 auto;"><b>Services</b></h4>
              </div>
              <div class="card-body">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Type</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Input Type" v-model="serviceType">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Price</label>
                    <div class="col-sm-10">
                    <input type="number" class="form-control" placeholder="Input Price" v-model="servicePrice">
                    </div>
                </div>

                  <button :disabled="!serviceType || !servicePrice" @click="addService()" class="btn btn-success btn-sm btn-block">ADD</button>
                </div>
                <div class="card-footer">
                    <ul class="nav flex-column">
                    <li class="nav-item" v-for="service in services" :key="service.id">
                        <h6 class="nav-link text-bold">
                        <button @click="deleteService(service.id)" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></button>

                        {{ service.type }}

                        <span class="float-right badge bg-info" data-toggle="modal" :data-target="'#servicePrice' + service.id" data-dismiss="modal">₱{{ service.price }}</span>
                        </h6>

                        <div class="modal fade" :id="'servicePrice' + service.id">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title"><b>Update Service</b></h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Type</label>
                                        <input type="text" class="form-control" v-model="service.type">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Price</label>
                                        <input type="text" class="form-control" v-model="service.price">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button @click="updateService(service)" class="btn btn-warning btn-block">UPDATE</button>
                                </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    </ul>
                </div>
            </div>
        </div>
        </div>

        <div class="row">
        <div class="col-4">
            <div class="card">
              <div class="modal-header">
                <h4 class="modal-title" style="margin: 0 auto;"><b>Detergents</b></h4>
              </div>
              <div class="card-body">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Type</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Input Type" v-model="detergentType">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Price</label>
                    <div class="col-sm-10">
                    <input type="number" class="form-control" placeholder="Input Price" v-model="detergentPrice">
                    </div>
                </div>
                  <button :disabled="!detergentType || !detergentPrice" @click="addDetergent()" class="btn btn-success btn-sm btn-block">ADD</button>
                </div>
                <div class="card-footer">
                    <ul class="nav flex-column">
                    <li class="nav-item" v-for="detergent in detergents" :key="detergent.id">
                      <h6 class="nav-link text-bold" v-if="detergent.type !== 'Customer Provided'">
                        <button @click="deleteDetergent(detergent.id)" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></button>

                        {{ detergent.type }}

                        <span class="float-right badge bg-info" data-toggle="modal" :data-target="'#detergentPrice' + detergent.id" data-dismiss="modal">₱{{ detergent.price }}</span>
                      </h6>

                      <div class="modal fade" :id="'detergentPrice' + detergent.id">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title"><b>Update Detergent</b></h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Type</label>
                                        <input type="text" class="form-control" v-model="detergent.type">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Price</label>
                                        <input type="text" class="form-control" v-model="detergent.price">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button @click="updateDetergent(detergent)" class="btn btn-warning btn-block">UPDATE</button>
                                </div>
                                </div>
                            </div>
                        </div>
                    </li>
                  </ul>
                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="card">
              <div class="modal-header">
                <h4 class="modal-title" style="margin: 0 auto;"><b>Bleaches</b></h4>
              </div>
              <div class="card-body">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Type</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Input Type" v-model="bleachType">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Price</label>
                    <div class="col-sm-10">
                    <input type="number" class="form-control" placeholder="Input Price" v-model="bleachPrice">
                    </div>
                </div>
                  <button :disabled="!bleachType || !bleachPrice" @click="addBleach()" class="btn btn-success btn-sm btn-block">ADD</button>

                </div>
                <div class="card-footer">
                    <ul class="nav flex-column">
                    <li class="nav-item" v-for="bleach in bleaches" :key="bleach.id">
                      <h6 class="nav-link text-bold" v-if="bleach.type !== 'N/A' && bleach.type !== 'Customer Provided'">
                        <button @click="deleteBleach(bleach.id)" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></button>

                        {{ bleach.type }}

                        <span class="float-right badge bg-info" data-toggle="modal" :data-target="'#bleachPrice' + bleach.id" data-dismiss="modal">₱{{ bleach.price }}</span>
                      </h6>

                      <div class="modal fade" :id="'bleachPrice' + bleach.id">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title"><b>Update Laundry Kilo</b></h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Type</label>
                                        <input type="text" class="form-control" v-model="bleach.type">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Price</label>
                                        <input type="text" class="form-control" v-model="bleach.price">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button @click="updateBleach(bleach)" class="btn btn-warning btn-block">UPDATE</button>
                                </div>
                                </div>
                            </div>
                        </div>
                    </li>
                  </ul>
                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="card">
              <div class="modal-header">
                <h4 class="modal-title" style="margin: 0 auto;"><b>Barangays</b></h4>
              </div>
              <div class="card-body">
                <div class="form-group row">
                    <label class="col-form-label" style="margin: 0 auto;">Barangay</label>
                    <div class="col-sm-12">
                    <input type="text" class="form-control text-center" placeholder="Input Barangay" v-model="barangayInput">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Price</label>
                    <div class="col-sm-10">
                    <input type="number" class="form-control" placeholder="Input Price" v-model="barangayPrice">
                    </div>
                </div>
                  <button :disabled="!barangayInput || !barangayPrice" @click="addBarangay()" class="btn btn-success btn-sm btn-block">ADD</button>

                </div>
                <div class="card-footer">
                    <ul class="nav flex-column">
                    <li class="nav-item" v-for="barangay in barangays" :key="barangay.id">
                      <h6 class="nav-link text-bold">
                        <button @click="deleteBarangay(barangay.id)" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></button>

                        {{ barangay.barangay }}

                        <span class="float-right badge bg-info" data-toggle="modal" :data-target="'#barangayPrice' + barangay.id" data-dismiss="modal">₱{{ barangay.price }}</span>
                      </h6>

                      <div class="modal fade" :id="'barangayPrice' + barangay.id">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title"><b>Update Barangay</b></h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Type</label>
                                        <input type="text" class="form-control" v-model="barangay.barangay">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Price</label>
                                        <input type="text" class="form-control" v-model="barangay.price">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button @click="updateBarangay(barangay)" class="btn btn-warning btn-block">UPDATE</button>
                                </div>
                                </div>
                            </div>
                        </div>
                    </li>
                  </ul>
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
            // dataTableInstance: null,
            isLoading: true,
            laundryLoads: {},
            laundryKilos: {},
            services: {},
            detergents: {},
            bleaches: {},
            barangays: {},

            laundryKiloType: '',
            laundryKiloPrice: '',

            serviceType: '',
            servicePrice: '',

            detergentType: '',
            detergentPrice: '',

            bleachType: '',
            bleachPrice: '',

            barangayInput: '',
            barangayPrice: '',
        }
    },
    mounted() {
        this.getLaundryLoads();
        this.getLaundryKilos();
        this.getServices();
        this.getDetergents();
        this.getBleaches();
        this.getBarangays();
    },
    methods: {
        async getLaundryLoads() {
            try {
                const response = await axios.get('/web/getlaundryloads');
                this.laundryLoads = response.data;

            } catch(error) {
                console.error('Error', error);
            }
        },
        async updateLaundryLoads(laundryLoad) {
            const updatedData = {
                price: laundryLoad.price
            }
            try {
                const response = await axios.patch(`/web/updatelaundryloads/${laundryLoad.id}`, updatedData);

                $(`#loadPrice${laundryLoad.id}`).modal('hide');

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
        async getLaundryKilos() {
            try {
                const response = await axios.get('/web/getlaundrykilos');
                this.laundryKilos = response.data;

            } catch(error) {
                console.error('Error', error);
            }
        },
        async addLaundryKilo() {
            try {
                const response = await axios.post('/web/addlaundrykilo', {
                    type: this.laundryKiloType,
                    price: this.laundryKiloPrice,
                });
            } catch(error) {
                console.error('Error:', error);
            } finally {
                this.laundryKiloType = '';
                this.laundryKiloPrice = '';
                this.getLaundryKilos();
            }
        },
        async updateLaundryKilo(laundryKilo) {
            const updatedData = {
                type: laundryKilo.type,
                price: laundryKilo.price,
            }
            try {
                const response = await axios.patch(`/web/updatelaundrykilo/${laundryKilo.id}`, updatedData);

                $(`#laundryKiloPrice${laundryKilo.id}`).modal('hide');

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
        async deleteLaundryKilo(id) {
            try {
                const response = await axios.delete(`/web/deletelaundrykilo/${id}`);
                this.getLaundryKilos();

                this.$swal({
                    title: 'Deleted Successfully',
                    text: 'You have successfully deleted.',
                    icon: 'success',
                    toast: true,
                    position: 'top-end',
                    timer: 3000,
                    showConfirmButton: false
                });
            } catch(error) {
                console.error('Error', error);
            }
        },
        async getServices() {
            try {
                const response = await axios.get('/web/getservices');
                this.services = response.data;
            } catch(error) {
                console.error('Error', error);
            }
        },
        async addService() {
            try {
                const response = await axios.post('/web/addservice', {
                    type: this.serviceType,
                    price: this.servicePrice,
                });
            } catch(error) {
                console.error('Error:', error);
            } finally {
                this.serviceType = '';
                this.servicePrice = '';
                this.getServices();

                this.$swal({
                    title: 'Added Successfully',
                    text: 'You have successfully added.',
                    icon: 'success',
                    toast: true,
                    position: 'top-end',
                    timer: 3000,
                    showConfirmButton: false
                });
            }
        },
        async updateService(service) {
            const updatedData = {
                type: service.type,
                price: service.price,
            }
            try {
                const response = await axios.patch(`/web/updateservice/${service.id}`, updatedData);

                $(`#servicePrice${service.id}`).modal('hide');

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
        async deleteService(id) {
            try {
                const response = await axios.delete(`/web/deleteservice/${id}`);
                this.getServices();

                this.$swal({
                    title: 'Deleted Successfully',
                    text: 'You have successfully deleted.',
                    icon: 'success',
                    toast: true,
                    position: 'top-end',
                    timer: 3000,
                    showConfirmButton: false
                });
            } catch(error) {
                console.error('Error', error);
            }
        },
        async getDetergents() {

            try {
                const response = await axios.get('/web/getdetergents');
                this.detergents = response.data;

            } catch(error) {
                console.error('Error', error);
            }
        },
        async addDetergent() {
            try {
                const response = await axios.post('/web/adddetergent', {
                    type: this.detergentType,
                    price: this.detergentPrice,
                });
            } catch(error) {
                console.error('Error:', error);
            } finally {
                this.detergentType = '';
                this.detergentPrice = '';
                this.getDetergents();

                this.$swal({
                    title: 'Added Successfully',
                    text: 'You have successfully added.',
                    icon: 'success',
                    toast: true,
                    position: 'top-end',
                    timer: 3000,
                    showConfirmButton: false
                });
            }
        },
        async updateDetergent(detergent) {
            const updatedData = {
                type: detergent.type,
                price: detergent.price,
            }
            try {
                const response = await axios.patch(`/web/updatedetergent/${detergent.id}`, updatedData);

                $(`#detergentPrice${detergent.id}`).modal('hide');

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
        async deleteDetergent(id) {
            try {
                const response = await axios.delete(`/web/deletedetergent/${id}`);
                this.getDetergents();

                this.$swal({
                    title: 'Deleted Successfully',
                    text: 'You have successfully deleted.',
                    icon: 'success',
                    toast: true,
                    position: 'top-end',
                    timer: 3000,
                    showConfirmButton: false
                });
            } catch(error) {
                console.error('Error', error);
            }
        },
        async getBleaches() {
            try {
                const response = await axios.get('/web/getbleaches');
                this.bleaches = response.data;

            } catch(error) {
                console.error('Error', error);
            }
        },
        async addBleach() {
            try {
                const response = await axios.post('/web/addbleach', {
                    type: this.bleachType,
                    price: this.bleachPrice,
                });
            } catch(error) {
                console.error('Error:', error);
            } finally {
                this.bleachType = '';
                this.bleachPrice = '';
                this.getBleaches();

                this.$swal({
                    title: 'Added Successfully',
                    text: 'You have successfully added.',
                    icon: 'success',
                    toast: true,
                    position: 'top-end',
                    timer: 3000,
                    showConfirmButton: false
                });
            }
        },
        async updateBleach(bleach) {
            const updatedData = {
                type: bleach.type,
                price: bleach.price,
            }
            try {
                const response = await axios.patch(`/web/updatebleach/${bleach.id}`, updatedData);

                $(`#bleachPrice${bleach.id}`).modal('hide');

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
        async deleteBleach(id) {
            try {
                const response = await axios.delete(`/web/deletebleach/${id}`);
                this.getBleaches();

                this.$swal({
                    title: 'Deleted Successfully',
                    text: 'You have successfully deleted.',
                    icon: 'success',
                    toast: true,
                    position: 'top-end',
                    timer: 3000,
                    showConfirmButton: false
                });
            } catch(error) {
                console.error('Error', error);
            }
        },
        async getBarangays() {
            try {
                const response = await axios.get('/web/getbarangays');
                this.isLoading = false;
                this.barangays = response.data;

            } catch(error) {
                console.error('Error', error);
            }
        },
        async addBarangay() {
            try {
                const response = await axios.post('/web/addbarangay', {
                    barangay: this.barangayInput,
                    price: this.barangayPrice,
                });
            } catch(error) {
                console.error('Error:', error);
            } finally {
                this.barangayInput = '';
                this.barangayPrice = '';
                this.getBarangays();

                this.$swal({
                    title: 'Added Successfully',
                    text: 'You have successfully added.',
                    icon: 'success',
                    toast: true,
                    position: 'top-end',
                    timer: 3000,
                    showConfirmButton: false
                });
            }
        },
        async updateBarangay(barangay) {
            const updatedData = {
                barangay: barangay.barangay,
                price: barangay.price,
            }
            try {
                const response = await axios.patch(`/web/updatebarangay/${barangay.id}`, updatedData);

                $(`#barangayPrice${barangay.id}`).modal('hide');

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
        async deleteBarangay(id) {
            try {
                const response = await axios.delete(`/web/deletebarangay/${id}`);
                this.getBarangays();

                this.$swal({
                    title: 'Deleted Successfully',
                    text: 'You have successfully deleted.',
                    icon: 'success',
                    toast: true,
                    position: 'top-end',
                    timer: 3000,
                    showConfirmButton: false
                });
            } catch(error) {
                console.error('Error', error);
            }
        }
    }
}
</script>
