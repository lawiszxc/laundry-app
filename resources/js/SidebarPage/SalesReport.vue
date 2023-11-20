<template>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1><b>Sales Report</b></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Sales Report</a></li>
                <li class="breadcrumb-item active">Admin</li>
                </ol>
            </div>
            </div>
        </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-4 col-6" data-toggle="modal" data-target="#modalWeekly">
            <a href="#" class="small-box bg-secondary">
              <div class="inner">
                <h3>₱{{ weeklySum }}</h3>
                <p>WEEKLY TOTAL</p>
              </div>
              <div class="icon">
                <i class="fas fa-clipboard-list"></i>
              </div>
            </a>
          </div>

        <div class="modal fade" id="modalWeekly">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">WEEKLY TRANSACTION</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="card-body table-responsive p-0">
                                <table class="table table-bordered table-hover text-wrap">
                                    <thead>
                                        <tr>
                                            <th>Customer</th>
                                            <th>Order Type</th>
                                            <th>Transaction #</th>
                                            <th>Total Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="weekly in weeklyTransaction" :key="weekly.id">
                                            <td class="text-bold">{{ weekly.user?.name ?? weekly.dropoff.name }}</td>

                                            <td class="text-bold" v-if="weekly.dropoff"><span class="badge bg-secondary">DROP-OFF</span></td>
                                            <td class="text-bold" v-else><span class="badge bg-dark">ONLINE</span></td>

                                            <td><span class="badge bg-primary">{{ weekly.transactionNum }}</span></td>
                                            <td class="text-bold">₱{{ weekly.totalPrice }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                            </div>

                            <div class="col-6">
                                <br>
                                <p class="lead">Weekly Transaction</p>

                                <div class="table-responsive">
                                    <table class="table">
                                    <tr>
                                        <th style="width:60%">Total Amount:</th>
                                        <td class="text-bold">₱{{ weeklySum }}</td>
                                    </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="col-lg-4 col-6" data-toggle="modal" data-target="#modalMonthly">
                <a href="#" class="small-box bg-light">
                <div class="inner">
                    <h3>₱{{ monthlySum }}</h3>
                    <p>MONTHLY TOTAL</p>
                </div>
                <div class="icon">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                </a>
            </div>

            <div class="modal fade" id="modalMonthly">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">MONTHLY TRANSACTION</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="card-body table-responsive p-0">
                                <table class="table table-bordered table-hover text-wrap">
                                    <thead>
                                        <tr>
                                            <th>Customer</th>
                                            <th>Order Type</th>
                                            <th>Transaction #</th>
                                            <th>Total Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="monthly in monthlyTransaction" :key="monthly.id">
                                            <td class="text-bold">{{ monthly.user?.name ?? monthly.dropoff.name }}</td>

                                            <td class="text-bold" v-if="monthly.dropoff"><span class="badge bg-secondary">DROP-OFF</span></td>
                                            <td class="text-bold" v-else><span class="badge bg-dark">ONLINE</span></td>

                                            <td><span class="badge bg-primary">{{ monthly.transactionNum }}</span></td>
                                            <td class="text-bold">₱{{ monthly.totalPrice }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                </div>

                                <div class="col-6">
                                    <br>
                                    <p class="lead">Monthly Transaction</p>

                                    <div class="table-responsive">
                                        <table class="table">
                                        <tr>
                                            <th style="width:60%">Total Amount:</th>
                                            <td class="text-bold">₱{{ monthlySum }}</td>
                                        </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-6" data-toggle="modal" data-target="#modalYearly">
                <a href="#" class="small-box bg-dark">
                <div class="inner">
                    <h3>₱{{ yearlySum }}</h3>
                    <p>YEARLY TOTAL</p>
                </div>
                <div class="icon">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                </a>
            </div>

            <div class="modal fade" id="modalYearly">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">YEARLY TRANSACTION</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-bordered table-hover text-wrap">
                                        <thead>
                                            <tr>
                                                <th>Customer</th>
                                                <th>Order Type</th>
                                                <th>Transaction #</th>
                                                <th>Total Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="yearly in yearlyTransaction" :key="yearly.id">
                                                <td class="text-bold">{{  yearly.user?.name ?? yearly.dropoff.name }}</td>

                                                <td class="text-bold" v-if="yearly.dropoff"><span class="badge bg-secondary">DROP-OFF</span></td>
                                                <td class="text-bold" v-else><span class="badge bg-dark">ONLINE</span></td>

                                                <td><span class="badge bg-primary">{{ yearly.transactionNum }}</span></td>
                                                <td class="text-bold">₱{{ yearly.totalPrice }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                    </div>

                                    <div class="col-6">
                                        <br>
                                        <p class="lead">Yearly Transaction</p>

                                        <div class="table-responsive">
                                            <table class="table">
                                            <tr>
                                                <th style="width:60%">Total Amount:</th>
                                                <td class="text-bold">₱{{ yearlySum }}</td>
                                            </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <div class="text-center">
            <button class="btn btn-secondary" @click="salesType = 'ONLINE'">ONLINE</button>
            &nbsp;
            <button class="btn btn-secondary" @click="salesType = 'DROP-OFF'">DROP-OFF</button>
        </div>
        <br>

        <div class="row" v-show="salesType === 'ONLINE'">
            <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-center p-0">
                <h3 class="card-title p-3 text-bold">ONLINE</h3>
                <ul class="nav nav-pills ml-auto p-2">
                    <li class="nav-item"><a class="nav-link active" href="#weekly" data-toggle="tab">WEEKLY</a></li>
                    <li class="nav-item"><a class="nav-link" href="#monthly" data-toggle="tab">MONTHLY</a></li>
                    <li class="nav-item"><a class="nav-link" href="#yearly" data-toggle="tab">YEARLY</a></li>
                </ul>
                </div>
                <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="weekly">
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
                                            <table ref="weeklyTable" class="table table-bordered table-hover text-nowrap" style="text-align: center;">
                                            <thead>
                                                <tr>
                                                    <!-- <th class="text-center">Image</th> -->
                                                    <th>Name</th>
                                                    <th>Total Price</th>
                                                    <th>Records</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr v-for="(userBookings, userName) in weeklys" :key="userName" data-widget="expandable-table" aria-expanded="false">
                                                    <td>{{ userName }}</td>
                                                    <td>
                                                        ₱{{ userBookings.reduce((total, booking) => total + booking.totalPrice, 0) }}
                                                    </td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-dark btn-sm btn-block"  data-toggle="modal" :data-target="'#invoice' + userBookings[0].user.id" data-dismiss="modal"><i class="fas fa-receipt"> ALL</i></button>
                                                            <button type="button" class="btn btn-warning btn-sm"  data-toggle="modal" :data-target="'#cod' + userBookings[0].user.id" data-dismiss="modal"><i class="fas fa-receipt"> COD</i></button>
                                                            <button type="button" class="btn btn-primary btn-sm"  data-toggle="modal" :data-target="'#gcash' + userBookings[0].user.id" data-dismiss="modal"><i class="fas fa-receipt"> GCASH</i></button>
                                                        </div>

                                                        <div class="modal fade" :id="'invoice' + userBookings[0].user.id">
                                                        <div class="modal-dialog modal-xl">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title"><b>{{ userName }} Records</b></h4>
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <table ref="weeklyTable" class="table table-bordered table-hover text-wrap" style="text-align: center;">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Transaction #</th>
                                                                            <th>Transaction Type</th>
                                                                            <th>Selected Pick-Up</th>
                                                                            <th>Selected Delivery</th>
                                                                            <th>Total Price</th>
                                                                            <th>Payment Method</th>
                                                                            <th>Status</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr v-for="booking in userBookings" :key="booking.id">
                                                                                <td><span class="badge bg-warning">{{ booking.transactionNum }}</span></td>
                                                                                <td><span class="badge bg-primary">{{ booking.transaction.transactionType }}</span></td>
                                                                                <td>{{ formatDateTime(booking.selectedPickup) }}</td>
                                                                                <td>{{ formatDateTime(booking.selectedDelivery) }}</td>
                                                                                <td>₱{{ booking.totalPrice }}</td>
                                                                                <td>
                                                                                    <div v-if="booking.payment.paymentType === 'GCash'">
                                                                                        <img alt="GCash" class="table-avatar" style="height: 40px; width: 50px" src="/images/GCash_Logo.png">
                                                                                    </div>
                                                                                    <div v-else-if="booking.payment.paymentType === 'COD'">
                                                                                        <img alt="COD" class="table-avatar" style="height: 40px; width: 100px" src="/images/COD_Logo.png">
                                                                                    </div>
                                                                                </td>
                                                                                <td><span class="badge bg-success">{{ booking.status }}</span></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        </div>

                                                        <div class="modal fade" :id="'cod' + userBookings[0].user.id">
                                                        <div class="modal-dialog modal-xl">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title"><b>{{ userName }} COD Records</b></h4>
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <table ref="weeklyTable" class="table table-bordered table-hover text-wrap" style="text-align: center;">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Transaction #</th>
                                                                            <th>Transaction Type</th>
                                                                            <th>Selected Pick-Up</th>
                                                                            <th>Selected Delivery</th>
                                                                            <th>Total Price</th>
                                                                            <th>Payment Method</th>
                                                                            <th>Status</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr v-for="booking in userBookings" :key="booking.id">
                                                                                <td v-if="booking.payment.paymentType === 'COD'"><span class="badge bg-warning">{{ booking.transactionNum }}</span></td>
                                                                                <td v-if="booking.payment.paymentType === 'COD'"><span class="badge bg-primary">{{ booking.transaction.transactionType }}</span></td>
                                                                                <td v-if="booking.payment.paymentType === 'COD'">{{ formatDateTime(booking.selectedPickup) }}</td>
                                                                                <td v-if="booking.payment.paymentType === 'COD'">{{ formatDateTime(booking.selectedDelivery) }}</td>
                                                                                <td v-if="booking.payment.paymentType === 'COD'">₱{{ booking.totalPrice }}</td>
                                                                                <td v-if="booking.payment.paymentType === 'COD'">
                                                                                    <img alt="COD" class="table-avatar" style="height: 40px; width: 100px" src="/images/COD_Logo.png">
                                                                                </td>
                                                                                <td v-if="booking.payment.paymentType === 'COD'"><span class="badge bg-success">{{ booking.status }}</span></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        </div>

                                                        <div class="modal fade" :id="'gcash' + userBookings[0].user.id">
                                                        <div class="modal-dialog modal-xl">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title"><b>{{ userName }} GCash Records</b></h4>
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <table ref="weeklyTable" class="table table-bordered table-hover text-wrap" style="text-align: center;">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Transaction #</th>
                                                                            <th>Transaction Type</th>
                                                                            <th>Selected Pick-Up</th>
                                                                            <th>Selected Delivery</th>
                                                                            <th>Total Price</th>
                                                                            <th>Payment Method</th>
                                                                            <th>GCash Reference #</th>
                                                                            <th>Status</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr v-for="booking in userBookings" :key="booking.id">
                                                                                <td v-if="booking.payment.paymentType === 'GCash'"><span class="badge bg-warning">{{ booking.transactionNum }}</span></td>
                                                                                <td v-if="booking.payment.paymentType === 'GCash'"><span class="badge bg-primary">{{ booking.transaction.transactionType }}</span></td>
                                                                                <td v-if="booking.payment.paymentType === 'GCash'">{{ formatDateTime(booking.selectedPickup) }}</td>
                                                                                <td v-if="booking.payment.paymentType === 'GCash'">{{ formatDateTime(booking.selectedDelivery) }}</td>
                                                                                <td v-if="booking.payment.paymentType === 'GCash'">₱{{ booking.totalPrice }}</td>
                                                                                <td v-if="booking.payment.paymentType === 'GCash'">
                                                                                    <img alt="GCash" class="table-avatar" style="height: 40px; width: 50px" src="/images/GCash_Logo.png">
                                                                                </td>
                                                                                <td v-if="booking.payment.paymentType === 'GCash'">{{ booking.payment.gcashReferenceNum }}</td>
                                                                                <td v-if="booking.payment.paymentType === 'GCash'"><span class="badge bg-success">{{ booking.status }}</span></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        </div>


                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="monthly">
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
                                            <table ref="monthlyTable" class="table table-bordered table-hover text-nowrap" style="text-align: center;">
                                            <thead>
                                                <tr>
                                                    <!-- <th class="text-center">Image</th> -->
                                                    <th>Name</th>
                                                    <th>Total Price</th>
                                                    <th>Records</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr v-for="(userBookings, userName) in monthlys" :key="userName">
                                                    <td>{{ userName }}</td>
                                                    <td>
                                                        ₱{{ userBookings.reduce((total, booking) => total + booking.totalPrice, 0) }}
                                                    </td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-dark btn-sm btn-block"  data-toggle="modal" :data-target="'#monthlyRecord' + userBookings[0].user.id" data-dismiss="modal"><i class="fas fa-receipt"> ALL</i></button>
                                                            <button type="button" class="btn btn-warning btn-sm"  data-toggle="modal" :data-target="'#monthlyRecordCOD' + userBookings[0].user.id" data-dismiss="modal"><i class="fas fa-receipt"> COD</i></button>
                                                            <button type="button" class="btn btn-primary btn-sm"  data-toggle="modal" :data-target="'#monthlyRecordGCash' + userBookings[0].user.id" data-dismiss="modal"><i class="fas fa-receipt"> GCASH</i></button>
                                                        </div>

                                                        <div class="modal fade" :id="'monthlyRecord' + userBookings[0].user.id">
                                                        <div class="modal-dialog modal-xl">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title"><b>{{ userName }} Records</b></h4>
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <table class="table table-bordered table-hover text-wrap" style="text-align: center;">
                                                                    <thead>
                                                                        <tr>
                                                                            <!-- <th class="text-center">Image</th> -->
                                                                            <th>Transaction #</th>
                                                                            <th>Transaction Type</th>
                                                                            <th>Selected Pick-Up</th>
                                                                            <th>Selected Delivery</th>
                                                                            <th>Total Price</th>
                                                                            <th>Payment Method</th>
                                                                            <th>Status</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr v-for="booking in userBookings" :key="booking.id">
                                                                                <td><span class="badge bg-warning">{{ booking.transactionNum }}</span></td>
                                                                                <td><span class="badge bg-primary">{{ booking.transaction.transactionType }}</span></td>
                                                                                <td>{{ formatDateTime(booking.selectedPickup) }}</td>
                                                                                <td>{{ formatDateTime(booking.selectedDelivery) }}</td>
                                                                                <td>₱{{ booking.totalPrice }}</td>
                                                                                <td>
                                                                                    <div v-if="booking.payment.paymentType === 'GCash'">
                                                                                        <img alt="GCash" class="table-avatar" style="height: 40px; width: 50px" src="/images/GCash_Logo.png">
                                                                                    </div>
                                                                                    <div v-else-if="booking.payment.paymentType === 'COD'">
                                                                                        <img alt="COD" class="table-avatar" style="height: 40px; width: 100px" src="/images/COD_Logo.png">
                                                                                    </div>
                                                                                </td>
                                                                                <td><span class="badge bg-success">{{ booking.status }}</span></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        </div>


                                                        <div class="modal fade" :id="'monthlyRecordCOD' + userBookings[0].user.id">
                                                        <div class="modal-dialog modal-xl">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title"><b>{{ userName }} COD Records</b></h4>
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <table ref="monthlyTable" class="table table-bordered table-hover text-wrap" style="text-align: center;">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Transaction #</th>
                                                                            <th>Transaction Type</th>
                                                                            <th>Selected Pick-Up</th>
                                                                            <th>Selected Delivery</th>
                                                                            <th>Total Price</th>
                                                                            <th>Payment Method</th>
                                                                            <th>Status</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr v-for="booking in userBookings" :key="booking.id">
                                                                                <td v-if="booking.payment.paymentType === 'COD'"><span class="badge bg-warning">{{ booking.transactionNum }}</span></td>
                                                                                <td v-if="booking.payment.paymentType === 'COD'"><span class="badge bg-primary">{{ booking.transaction.transactionType }}</span></td>
                                                                                <td v-if="booking.payment.paymentType === 'COD'">{{ formatDateTime(booking.selectedPickup) }}</td>
                                                                                <td v-if="booking.payment.paymentType === 'COD'">{{ formatDateTime(booking.selectedDelivery) }}</td>
                                                                                <td v-if="booking.payment.paymentType === 'COD'">₱{{ booking.totalPrice }}</td>
                                                                                <td v-if="booking.payment.paymentType === 'COD'">
                                                                                    <img alt="COD" class="table-avatar" style="height: 40px; width: 100px" src="/images/COD_Logo.png">
                                                                                </td>
                                                                                <td v-if="booking.payment.paymentType === 'COD'"><span class="badge bg-success">{{ booking.status }}</span></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        </div>

                                                        <div class="modal fade" :id="'monthlyRecordGCash' + userBookings[0].user.id">
                                                        <div class="modal-dialog modal-xl">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title"><b>{{ userName }} GCash Records</b></h4>
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <table ref="weeklyTable" class="table table-bordered table-hover text-wrap" style="text-align: center;">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Transaction #</th>
                                                                            <th>Transaction Type</th>
                                                                            <th>Selected Pick-Up</th>
                                                                            <th>Selected Delivery</th>
                                                                            <th>Total Price</th>
                                                                            <th>Payment Method</th>
                                                                            <th>GCash Reference #</th>
                                                                            <th>Status</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr v-for="booking in userBookings" :key="booking.id">
                                                                                <td v-if="booking.payment.paymentType === 'GCash'"><span class="badge bg-warning">{{ booking.transactionNum }}</span></td>
                                                                                <td v-if="booking.payment.paymentType === 'GCash'"><span class="badge bg-primary">{{ booking.transaction.transactionType }}</span></td>
                                                                                <td v-if="booking.payment.paymentType === 'GCash'">{{ formatDateTime(booking.selectedPickup) }}</td>
                                                                                <td v-if="booking.payment.paymentType === 'GCash'">{{ formatDateTime(booking.selectedDelivery) }}</td>
                                                                                <td v-if="booking.payment.paymentType === 'GCash'">₱{{ booking.totalPrice }}</td>
                                                                                <td v-if="booking.payment.paymentType === 'GCash'">
                                                                                    <img alt="GCash" class="table-avatar" style="height: 40px; width: 50px" src="/images/GCash_Logo.png">
                                                                                </td>
                                                                                <td v-if="booking.payment.paymentType === 'GCash'">{{ booking.payment.gcashReferenceNum }}</td>
                                                                                <td v-if="booking.payment.paymentType === 'GCash'"><span class="badge bg-success">{{ booking.status }}</span></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        </div>


                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                        </section>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="yearly">
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
                                            <table ref="yearlyTable" class="table table-bordered table-hover text-nowrap" style="text-align: center;">
                                            <thead>
                                                <tr>
                                                    <!-- <th class="text-center">Image</th> -->
                                                    <th>Name</th>
                                                    <th>Total Price</th>
                                                    <th>Records</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr v-for="(userBookings, userName) in yearlys" :key="userName">
                                                    <td>{{ userName }}</td>
                                                    <td>
                                                        ₱{{ userBookings.reduce((total, booking) => total + booking.totalPrice, 0) }}
                                                    </td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-dark btn-sm btn-block"  data-toggle="modal" :data-target="'#yearlyRecord' + userBookings[0].user.id" data-dismiss="modal"><i class="fas fa-receipt"> ALL</i></button>
                                                            <button type="button" class="btn btn-warning btn-sm"  data-toggle="modal" :data-target="'#yearlyRecordCOD' + userBookings[0].user.id" data-dismiss="modal"><i class="fas fa-receipt"> COD</i></button>
                                                            <button type="button" class="btn btn-primary btn-sm"  data-toggle="modal" :data-target="'#yearlyRecordGCash' + userBookings[0].user.id" data-dismiss="modal"><i class="fas fa-receipt"> GCASH</i></button>
                                                        </div>


                                                        <div class="modal fade" :id="'yearlyRecord' + userBookings[0].user.id">
                                                        <div class="modal-dialog modal-xl">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title"><b>{{ userName }} Records</b></h4>
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <table ref="yearlyTable" class="table table-bordered table-hover text-wrap" style="text-align: center;">
                                                                    <thead>
                                                                        <tr>
                                                                            <!-- <th class="text-center">Image</th> -->
                                                                            <th>Transaction #</th>
                                                                            <th>Transaction Type</th>
                                                                            <th>Selected Pick-Up</th>
                                                                            <th>Selected Delivery</th>
                                                                            <th>Total Price</th>
                                                                            <th>Payment Method</th>
                                                                            <th>Status</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr v-for="booking in userBookings" :key="booking.id">
                                                                                <td><span class="badge bg-warning">{{ booking.transactionNum }}</span></td>
                                                                                <td><span class="badge bg-primary">{{ booking.transaction.transactionType }}</span></td>
                                                                                <td>{{ formatDateTime(booking.selectedPickup) }}</td>
                                                                                <td>{{ formatDateTime(booking.selectedDelivery) }}</td>
                                                                                <td>₱{{ booking.totalPrice }}</td>
                                                                                <td>
                                                                                    <div v-if="booking.payment.paymentType === 'GCash'">
                                                                                        <img alt="GCash" class="table-avatar" style="height: 40px; width: 50px" src="/images/GCash_Logo.png">
                                                                                    </div>
                                                                                    <div v-else-if="booking.payment.paymentType === 'COD'">
                                                                                        <img alt="COD" class="table-avatar" style="height: 40px; width: 100px" src="/images/COD_Logo.png">
                                                                                    </div>
                                                                                </td>
                                                                                <td><span class="badge bg-success">{{ booking.status }}</span></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        </div>

                                                        <div class="modal fade" :id="'yearlyRecordCOD' + userBookings[0].user.id">
                                                        <div class="modal-dialog modal-xl">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title"><b>{{ userName }} COD Records</b></h4>
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <table ref="monthlyTable" class="table table-bordered table-hover text-wrap" style="text-align: center;">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Transaction #</th>
                                                                            <th>Transaction Type</th>
                                                                            <th>Selected Pick-Up</th>
                                                                            <th>Selected Delivery</th>
                                                                            <th>Total Price</th>
                                                                            <th>Payment Method</th>
                                                                            <th>Status</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr v-for="booking in userBookings" :key="booking.id">
                                                                                <td v-if="booking.payment.paymentType === 'COD'"><span class="badge bg-warning">{{ booking.transactionNum }}</span></td>
                                                                                <td v-if="booking.payment.paymentType === 'COD'"><span class="badge bg-primary">{{ booking.transaction.transactionType }}</span></td>
                                                                                <td v-if="booking.payment.paymentType === 'COD'">{{ formatDateTime(booking.selectedPickup) }}</td>
                                                                                <td v-if="booking.payment.paymentType === 'COD'">{{ formatDateTime(booking.selectedDelivery) }}</td>
                                                                                <td v-if="booking.payment.paymentType === 'COD'">₱{{ booking.totalPrice }}</td>
                                                                                <td v-if="booking.payment.paymentType === 'COD'">
                                                                                    <img alt="COD" class="table-avatar" style="height: 40px; width: 100px" src="/images/COD_Logo.png">
                                                                                </td>
                                                                                <td v-if="booking.payment.paymentType === 'COD'"><span class="badge bg-success">{{ booking.status }}</span></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        </div>

                                                        <div class="modal fade" :id="'yearlyRecordGCash' + userBookings[0].user.id">
                                                        <div class="modal-dialog modal-xl">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title"><b>{{ userName }} GCash Records</b></h4>
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <table ref="weeklyTable" class="table table-bordered table-hover text-wrap" style="text-align: center;">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Transaction #</th>
                                                                            <th>Transaction Type</th>
                                                                            <th>Selected Pick-Up</th>
                                                                            <th>Selected Delivery</th>
                                                                            <th>Total Price</th>
                                                                            <th>Payment Method</th>
                                                                            <th>GCash Reference #</th>
                                                                            <th>Status</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr v-for="booking in userBookings" :key="booking.id">
                                                                                <td v-if="booking.payment.paymentType === 'GCash'"><span class="badge bg-warning">{{ booking.transactionNum }}</span></td>
                                                                                <td v-if="booking.payment.paymentType === 'GCash'"><span class="badge bg-primary">{{ booking.transaction.transactionType }}</span></td>
                                                                                <td v-if="booking.payment.paymentType === 'GCash'">{{ formatDateTime(booking.selectedPickup) }}</td>
                                                                                <td v-if="booking.payment.paymentType === 'GCash'">{{ formatDateTime(booking.selectedDelivery) }}</td>
                                                                                <td v-if="booking.payment.paymentType === 'GCash'">₱{{ booking.totalPrice }}</td>
                                                                                <td v-if="booking.payment.paymentType === 'GCash'">
                                                                                    <img alt="GCash" class="table-avatar" style="height: 40px; width: 50px" src="/images/GCash_Logo.png">
                                                                                </td>
                                                                                <td v-if="booking.payment.paymentType === 'GCash'">{{ booking.payment.gcashReferenceNum }}</td>
                                                                                <td v-if="booking.payment.paymentType === 'GCash'"><span class="badge bg-success">{{ booking.status }}</span></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
                </div><!-- /.card-body -->
            </div>
            <!-- ./card -->
            </div>
            <!-- /.col -->

        </div>

        <div class="row" v-show="salesType === 'DROP-OFF'">
            <div class="col-12">
            <!-- Custom Tabs -->
            <div class="card">
                <div class="card-header d-flex justify-content-center p-0">
                <h3 class="card-title p-3 text-bold">DROP-OFF</h3>
                <ul class="nav nav-pills ml-auto p-2">
                    <li class="nav-item"><a class="nav-link active" href="#weeklyDropOff" data-toggle="tab">WEEKLY</a></li>
                    <li class="nav-item"><a class="nav-link" href="#monthlyDropOff" data-toggle="tab">MONTHLY</a></li>
                    <li class="nav-item"><a class="nav-link" href="#yearlyDropOff" data-toggle="tab">YEARLY</a></li>
                </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="weeklyDropOff">
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
                                            <table ref="dropOffTable" class="table table-bordered table-hover text-nowrap" style="text-align: center;">
                                            <thead>
                                                <tr>
                                                    <!-- <th class="text-center">Image</th> -->
                                                    <th>Name</th>
                                                    <th>Total Price</th>
                                                    <th>Records</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr v-for="(userBookings, userName) in weeklyDropOff" :key="userName">
                                                    <td>{{ userName }}</td>
                                                    <td>
                                                        ₱{{ userBookings.reduce((total, booking) => total + booking.totalPrice, 0) }}
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-primary btn-sm" data-toggle="modal" :data-target="'#dropOffWeeklyView' + userName[0]">View</button>

                                                        <div class="modal fade" :id="'dropOffWeeklyView' + userName[0]">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">Remittances</h4>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <table class="table table-bordered table-hover text-wrap" style="text-align: center;">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Customer</th>
                                                                                    <th>Booking Type</th>
                                                                                    <th>Transaction #</th>
                                                                                    <th>Total Price</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr v-for="booking in userBookings" :key="booking">
                                                                                    <td class="text-bold">{{ booking.dropoff.name }}</td>
                                                                                    <td v-if="!booking.selectedDelivery"><span class="badge bg-dark">PICK-UP</span></td>
                                                                                    <td v-else><span class="badge bg-dark">DELIVERY</span></td>

                                                                                    <td><span class="badge bg-primary">{{ booking.transactionNum }}</span></td>

                                                                                    <td>₱{{ booking.totalPrice }}</td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="tab-pane" id="monthlyDropOff">
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
                                            <table ref="dropOffMonthlyTable" class="table table-bordered table-hover text-nowrap" style="text-align: center;">
                                            <thead>
                                                <tr>
                                                    <!-- <th class="text-center">Image</th> -->
                                                    <th>Name</th>
                                                    <th>Total Price</th>
                                                    <!-- <th>Records</th> -->
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr v-for="(userBookings, userName) in monthlyDropOff" :key="userName" data-widget="expandable-table" aria-expanded="false">
                                                    <td>{{ userName }}</td>
                                                    <td>
                                                        ₱{{ userBookings.reduce((total, booking) => total + booking.totalPrice, 0) }}
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="tab-pane" id="yearlyDropOff">
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
                                            <table ref="dropOffYearlyTable" class="table table-bordered table-hover text-nowrap" style="text-align: center;">
                                            <thead>
                                                <tr>
                                                    <!-- <th class="text-center">Image</th> -->
                                                    <th>Name</th>
                                                    <th>Total Price</th>
                                                    <!-- <th>Records</th> -->
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr v-for="(userBookings, userName) in yearlyDropOff" :key="userName" data-widget="expandable-table" aria-expanded="false">
                                                    <td>{{ userName }}</td>
                                                    <td>
                                                        ₱{{ userBookings.reduce((total, booking) => total + booking.totalPrice, 0) }}
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
                <!-- /.tab-content -->
                </div><!-- /.card-body -->
            </div>
            <!-- ./card -->
            </div>
            <!-- /.col -->

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
            salesType: 'ONLINE',
            isLoading: false,
            WeeklyInstance: null,
            MonthlyInstance: null,
            YearlyInstance: null,
            weeklys: {},
            monthlys: {},
            yearlys: {},
            weeklySum: 0,
            monthlySum: 0,
            yearlySum: 0,
            weeklyDropOff: {},
            dropoffInstance: null,
            monthlyDropOff: {},
            dropoffMonthInstance: null,
            yearlyDropOff: {},
            dropoffYearInstance: null,
            weeklyTransaction: {},
            monthlyTransaction: {},
            yearlyTransaction: {},
        }
    },
    mounted() {
        this.getWeekly();
        this.getMonthly();
        this.getYearly();
        this.weeklyDataTable();
        this.monthlyDataTable();
        this.yearlyDataTable();
        this.dropoffDataTable();
        this.getSum();
        this.getDropOffWeekly();
        this.dropoffMonthDataTable();
        this.getDropOffMonthly();
        this.dropoffYearDataTable();
        this.getDropOffYearly();
        this.getWeeklyTransaction();
    },
    methods: {
        formatDateTime(dateTime) {
            return moment(dateTime).format('MMM. D, YYYY / h:mma');
        },
        weeklyDataTable() {
        if (this.WeeklyInstance) {
            this.WeeklyInstance.destroy();
        }

        this.WeeklyInstance = $(this.$refs.weeklyTable).DataTable({
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
        monthlyDataTable() {
        if (this.MonthlyInstance) {
            this.MonthlyInstance.destroy();
        }

        this.MonthlyInstance = $(this.$refs.monthlyTable).DataTable({
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
        yearlyDataTable() {
        if (this.YearlyInstance) {
            this.YearlyInstance.destroy();
        }

        this.YearlyInstance = $(this.$refs.yearlyTable).DataTable({
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
        async getWeekly() {
            try {
                this.isLoading = true;

                const response = await axios.get('/web/reports');
                this.weeklys = response.data.weekly;
            } catch(error) {
                console.error(error);
            } finally {
                this.isLoading = false;
                this.$nextTick(() => {
                    this.weeklyDataTable();
                });
            }
        },
        async getMonthly() {
            try {
                this.isLoading = true;

                const response = await axios.get('/web/reports');
                this.monthlys = response.data.monthly;
            } catch(error) {
                console.error(error);
            } finally {
                this.isLoading = false;
                this.$nextTick(() => {
                    this.monthlyDataTable();
                });
            }
        },
        async getYearly() {
            try {
                this.isLoading = true;

                const response = await axios.get('/web/reports');
                this.yearlys = response.data.yearly;
            } catch(error) {
                console.error(error);
            } finally {
                this.isLoading = false;
                this.$nextTick(() => {
                    this.yearlyDataTable();
                });
            }
        },
        async getSum() {
            try {
                const response = await axios.get('/web/reports');
                this.weeklySum = response.data.weeklySum;
                this.monthlySum = response.data.monthlySum;
                this.yearlySum = response.data.yearlySum;

            } catch(error) {
                console.error(error);
            }
        },
        dropoffDataTable() {
        if (this.dropoffInstance) {
            this.dropoffInstance.destroy();
        }

        this.dropoffInstance = $(this.$refs.dropOffTable).DataTable({
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
        async getDropOffWeekly() {
            try {
                this.isLoading = true;

                const response = await axios.get('/web/reports');
                this.weeklyDropOff = response.data.weeklyDropOff;
            } catch(error) {
                console.error(error);
            } finally {
                this.isLoading = false;
                this.$nextTick(() => {
                    this.dropoffDataTable();
                });
            }
        },
        dropoffMonthDataTable() {
        if (this.dropoffMonthInstance) {
            this.dropoffMonthInstance.destroy();
        }

        this.dropoffMonthInstance = $(this.$refs.dropOffMonthlyTable).DataTable({
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
        async getDropOffMonthly() {
            try {
                this.isLoading = true;

                const response = await axios.get('/web/reports');
                this.monthlyDropOff = response.data.monthlyDropOff;
            } catch(error) {
                console.error(error);
            } finally {
                this.isLoading = false;
                this.$nextTick(() => {
                    this.dropoffMonthDataTable();
                });
            }
        },
        dropoffYearDataTable() {
        if (this.dropoffYearInstance) {
            this.dropoffYearInstance.destroy();
        }

        this.dropoffYearInstance = $(this.$refs.dropOffYearlyTable).DataTable({
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
        async getDropOffYearly() {
            try {
                this.isLoading = true;

                const response = await axios.get('/web/reports');
                this.yearlyDropOff = response.data.yearlyDropOff;
            } catch(error) {
                console.error(error);
            } finally {
                this.isLoading = false;
                this.$nextTick(() => {
                    this.dropoffYearDataTable();
                });
            }
        },
        async getWeeklyTransaction() {
            try {
                const response = await axios.get('/web/reports');
                this.weeklyTransaction = response.data.weeklyTransaction;
                this.monthlyTransaction = response.data.monthlyTransaction;
                this.yearlyTransaction = response.data.yearlyTransaction;
            } catch(error) {
                console.error(error);
            }
        }
    },
}

</script>

<style>
    .card-header {
    display: flex;
    justify-content: center;
    }
</style>
