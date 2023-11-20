<template>
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1><b>Ready to Pickup and Deliver</b></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">History</a></li>
                <li class="breadcrumb-item active">Admin</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="card">
              <div class="card-body">
                  <div v-if="isLoading" class="text-center">
                    <button class="btn btn-dark btn-block" type="button" disabled>
                      <span class="spinner-border spinner-border-sm text-white" role="status" aria-hidden="true"></span>
                      Loading...
                    </button>
                  </div>
                  <div v-else>
                    <table ref="dataTable" class="table table-bordered table-hover text-wrap" style="text-align: center; white-space: normal;">
                        <thead>
                          <tr>
                              <!-- <th class="text-center">Image</th> -->
                              <th style="vertical-align: top;">Customer</th>
                              <th style="vertical-align: top;">Order Type</th>
                              <th style="vertical-align: top;">Transaction #</th>
                              <th style="vertical-align: top;">Pickup Date / Time</th>
                              <th style="vertical-align: top;">Delivery Date / Time</th>
                              <th style="vertical-align: top;">Barangay</th>
                              <th style="vertical-align: top;">Total Price</th>
                              <th style="vertical-align: top;">Status</th>
                          </tr>
                          </thead>
                          <tbody>
                            <tr v-for="booking in bookings" :key="booking.id">
                                <td class="text-bold" v-if="booking.user && booking.user.name">{{ booking.user.name }}</td>
                                <td class="text-bold" v-else>{{ booking.dropoff.name }}</td>

                                <td class="text-bold" v-if="booking.user && booking.user.name"><span class="badge bg-dark">MOBILE</span></td>
                                <td class="text-bold" v-else><span class="badge bg-secondary">DROP-OFF</span>
                                    <br>
                                    <span class="badge bg-warning" v-if="booking.selectedDelivery">DELIVERY</span>
                                    <span v-else class="badge bg-dark">PICKUP</span>
                                </td>

                                <td class="text-bold"><span class="badge bg-primary">{{ booking.transactionNum }}</span></td>

                                <td v-if="booking.selectedDelivery">{{ formatDateTime(booking.selectedPickup) }}</td>
                                <td class="text-bold" v-else><span class="badge bg-dark">PICKUP</span></td>

                                <td v-if="booking.selectedDelivery">{{ formatDateTime(booking.selectedDelivery) }}</td>
                                <td class="text-bold" v-else><span class="badge bg-dark">PICKUP</span></td>

                                <td class="text-bold" v-if="booking.user && booking.user.name">{{ booking.user.barangay.barangay }}</td>
                                <td class="text-bold" v-else-if="booking.dropoff && booking.dropoff.barangay">{{ booking.dropoff.barangay.barangay }}</td>
                                <td class="text-bold" v-else><span class="badge bg-dark">PICKUP</span></td>

                                <td class="text-bold"><span class="badge bg-primary">₱{{ booking.totalPrice ?? 0 }}</span></td>

                              <td>
                                <button @click="updateOutOfDelivery(booking.id, 'OUT FOR DELIVERY')" class="btn btn-warning btn-sm" v-if="booking.status == 'CONFIRMED'">READY TO DELIVER</button>
                                <button @click="updateOutOfDelivery(booking.id, 'DROP-OFF / OUT FOR DELIVERY')" class="btn btn-warning btn-sm" v-else-if="booking.status == 'DROP-OFF / DELIVERY PENDING' && booking.selectedDelivery">READY TO DELIVER</button>
                                <button @click="updateOutOfDelivery(booking.id, 'DROP-OFF / READY TO PICKUP')" class="btn btn-warning btn-sm" v-else-if="booking.status == 'DROP-OFF / PICKUP PENDING' && !booking.selectedDelivery">READY TO PICKUP</button>
                                <button @click="updateOutOfDelivery(booking.id, 'DROP-OFF / SUCCESSFULLY PICKED UP')" class="btn btn-success btn-sm" v-else-if="booking.status == 'DROP-OFF / READY TO PICKUP' && !booking.selectedDelivery">SUCCESS PICKUP</button>
                            </td>
                            </tr>
                          </tbody>
                      </table>
                  </div>
              </div>
              </div>
      </section>
  </template>

<script>
  import axios from 'axios'
  import moment from 'moment';

  export default {
      data() {
          return {
              isLoading: false,
              bookings: {},
              status: '',
              countBooking: 0,
              pending: 0,
              delivered: 0,
              salesReport: 0,
          }
      },
      mounted() {
          this.getBookings();
          this.initDataTable();
      },
      methods: {
          initDataTable() {
              if (this.dataTableInstance) {
                  this.dataTableInstance.destroy();
              }
                  this.dataTableInstance = $(this.$refs.dataTable).DataTable();
          },
          formatDateTime(dateTime) {
              return moment(dateTime).format('MMM. D, YYYY / h:mma');
          },
          async getBookings() {
              try {
                  this.isLoading = true;

                  const response = await axios.get('/web/getpickupdelivery');
                  this.bookings = response.data;

              } catch(error) {
                  console.error(error);
              } finally {
                  this.isLoading = false;
                  this.$nextTick(() => {
                      this.initDataTable();
                  });
              }
          },
          async updateOutOfDelivery(id, status) {
            this.isLoading = true;

            try {
                const updatedData = {
                    status: status
                }

                const response = await axios.patch(`/web/updateoutofdelivery/${id}`, updatedData);

            } catch(error) {
                console.error(error);
            } finally {
                this.isLoading = false;
                this.$nextTick(() => {
                    this.initDataTable();
                    this.getBookings();
                });
            }
          }
      }
  }
  </script>
