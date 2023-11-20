<template>
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><b>Dashboard</b></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
              <li class="breadcrumb-item active">Admin</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
        <div class="col-lg-3 col-6" @click="this.$router.push('history')">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3>{{ countBooking }}</h3>

                <p>BOOKINGS</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6" @click="this.$router.push('history')">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3>{{ pending }}</h3>

                <p>PENDINGS</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6" @click="this.$router.push('history')">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ delivered }}</h3>

                <p>DELIVERED</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6" @click="this.$router.push('/sales/report')">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{ salesReport }}</h3>

                <p>SALES REPORT</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

          <!-- ./col -->
        </div>
      </div>

      <div class="card">
            <div class="card-body">
                <div v-if="isLoading" class="text-center">
                  <button class="btn btn-dark btn-block" type="button" disabled>
                    <span class="spinner-border spinner-border-sm text-white" role="status" aria-hidden="true"></span>
                    Loading...
                  </button>
                </div>
                <div v-else>
                    <table ref="dataTable" class="table table-bordered table-hover text-wrap" style="text-align: center;">
                      <thead>
                        <tr>
                            <!-- <th class="text-center">Image</th> -->
                            <th>Full Name</th>
                            <th>Pickup Date / Time</th>
                            <th>Delivery Date / Time</th>
                            <th>Barangay</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                          <tr v-for="booking in bookings" :key="booking.id">
                            <td class="text-bold">{{ booking.user.name }}</td>
                            <td><span class="bg-warning">{{ formatDateTime(booking.selectedPickup) }}</span></td>
                            <td><span class="bg-dark">{{ formatDateTime(booking.selectedDelivery) }}</span></td>
                            <td class="text-bold">{{ booking.user.barangay.barangay }}</td>
                            <td><span class="badge bg-primary">{{ booking.status }}</span></td>
                            <td>
                                <button @click="updateBooking(booking.id, 'ACCEPTED')" class="btn btn-success btn-sm">ACCEPT</button>
                                <button @click="updateBooking(booking.id, 'DECLINED')" class="btn btn-danger btn-sm">DECLINE</button>
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
        this.bookingStatus();
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

                const response = await axios.get('/web/getbookings');
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
        async bookingStatus() {
            try {
                const response = await axios.get('/web/bookingstatus');
                this.countBooking = response.data.bookingCount;
                this.pending = response.data.pendingCount;
                this.delivered = response.data.deliveredCount;
                this.salesReport = response.data.salesCount;
            } catch(error) {
                console.error(error);
            } finally {
                this.bookingStatus();
            }
        },
        async updateBooking(bookingID, status) {
            this.isLoading = true;

            try {
                const response = await axios.patch(`/web/updatebooking/${bookingID}`, {status});
                this.getBookings();
            } catch(error) {
                console.error(error);
            } finally {
                this.isLoading = false;

                let title, text;
                if (status === 'ACCEPTED') {
                    title = 'Accepted Successful';
                    text = 'You have successfully accepted.';
                } else if (status === 'DECLINED') {
                    title = 'Declined Successful';
                    text = 'You have successfully declined.';
                }

                this.$swal({
                    title,
                    text,
                    icon: 'success',
                    toast: true,
                    position: 'top-end',
                    timer: 3000,
                    showConfirmButton: false
                });
            }
        }
    }
}
</script>
