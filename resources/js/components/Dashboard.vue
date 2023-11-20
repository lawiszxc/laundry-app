<template>
    <div class="hold-transition sidebar-mini layout-fixed">
      <div class="wrapper">

      <nav class="main-header navbar navbar-expand navbar-white navbar-light">

        <ul class="navbar-nav ml-auto">
            <button @click="logoutUser()" class="btn btn-danger btn-sm">Logout</button>
        </ul>
      </nav>

      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a class="brand-link">
          <img src="/images/bubbles.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light"><b>Laundry</b><span class="font-italic">Delivery</span></span>
        </a>

        <div class="sidebar">
          <div class="user-panel mt-3 pb-3 mb-3 d-flex mx-auto text-center">
            <div class="image">
              <img src="/images/images.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
              <a href="#" class="d-block"> {{ user.name }} </a>
            </div>
          </div>

          <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
              <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <a class="btn btn-sidebar">
                  <i class="fas fa-search fa-fw"></i>
                </a>
              </div>
            </div>
          </div>

          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <li class="nav-item">
                <router-link to="/dashboard" class="nav-link">
                  <i class="nav-icon fas fa-columns"></i>
                  <p>
                    DASHBOARD
                  </p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/laundry/setting" class="nav-link">
                  <i class="nav-icon fas fa-money-check"></i>
                  <p>
                    LAUNDRY SETTINGS
                  </p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/users" class="nav-link">
                  <i class="nav-icon fas fa-user"></i>
                  <p>
                    USERS
                  </p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/riders" class="nav-link">
                  <i class="nav-icon fas fa-user-nurse"></i>
                  <p>
                    RIDERS
                  </p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/dropoff" class="nav-link">
                  <i class="nav-icon fas fa-landmark"></i>
                  <p>
                    DROP-OFF
                  </p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/pickupdelivery" class="nav-link">
                  <i class="nav-icon fas fa-landmark"></i>
                  <p>
                    PICKUP AND DELIVER
                  </p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/remittances" class="nav-link">
                  <i class="nav-icon fas fa-money-bill-wave"></i>
                  <p>
                    REMITTANCES
                  </p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/history" class="nav-link">
                  <i class="nav-icon fas fa-clipboard-list"></i>
                  <p>
                    HISTORY
                  </p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/sales/report" class="nav-link">
                  <i class="nav-icon fas fa-chart-line"></i>
                  <p>
                    SALES REPORT
                  </p>
                </router-link>
              </li>
            </ul>
          </nav>
        </div>
      </aside>

      <div class="content-wrapper">
          <router-view></router-view>
      </div>
      <footer class="main-footer">
        <strong>Copyright &copy; 2023-2024 <a>Laundry Delivery Capstone Project</a>.</strong>
        All rights reserved.
      </footer>
    </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            user: {},
        };
    },
    mounted() {
        this.fetchUserData();
    },
    methods: {
        async fetchUserData() {
            try {
                const response = await axios.get('/web/user', {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem('token')}`,
                    },
                });
                this.user = response.data;
            } catch (error) {
                console.error(error.response);
            }
        },
        logoutUser() {
            localStorage.removeItem('token');
            this.$router.push("/login");

            this.$swal({
                title: 'Logged Out Successful',
                text: 'You have successfully logged out.',
                icon: 'success',
            });
        },
    },
}
</script>

