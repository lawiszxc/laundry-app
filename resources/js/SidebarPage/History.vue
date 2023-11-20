<template>
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1><b>History</b></h1>
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
                              <th style="vertical-align: top;">Rider</th>
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

                                <td class="text-bold" v-if="booking.riderdelivery?.rider">{{ booking.riderdelivery?.rider.name }}</td>
                                <td class="text-bold" v-else>N/A</td>

                                <td class="text-bold" v-if="booking.user && booking.user.name"><span class="badge bg-dark">ONLINE</span></td>
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
                                <span class="badge bg-primary" v-if="booking.status == 'PENDING'">PENDING</span>
                                <span class="badge bg-secondary" v-else-if="booking.status == 'ACCEPTED'">PICK-UP</span>
                                <span class="badge bg-success" v-else-if="booking.status == 'SUCCESSFUL'">DELIVERED</span>
                                <span class="badge bg-danger" v-else-if="booking.status == 'DECLINED'">{{ booking.status }}</span>
                                <span class="badge bg-warning" v-else-if="booking.status == 'OUT FOR DELIVERY'">{{ booking.status }}</span>
                                <span class="badge bg-warning" v-else-if="booking.status == 'DROP-OFF / OUT FOR DELIVERY' && booking.selectedDelivery">OUT FOR DELIVERY</span>
                                <span class="badge bg-warning" v-else-if="booking.status == 'DROP-OFF / READY TO PICKUP'">READY TO PICK UP</span>
                                <span class="badge bg-success" v-else-if="booking.status == 'DROP-OFF / DELIVERED SUCCESSFULLY'">DELIVERED</span>
                                <span class="badge bg-success" v-else-if="booking.status == 'DROP-OFF / SUCCESSFULLY PICKED UP'">PICKED UP</span>
                                <span class="badge bg-secondary" v-else>PROCESSING</span>
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

                  const response = await axios.get('/web/gethistory');
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
                this.getBookings();

            } catch(error) {
                console.error(error);
            } finally {
                this.isLoading = false;
                this.$nextTick(() => {
                    this.initDataTable();
                });
            }
          }
      }
  }
  </script>
