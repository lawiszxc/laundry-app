<template>
    <div class="hold-transition login-page">
      <div class="login-box">
      <div class="card card-outline card-primary">
        <div class="card-header text-center">
          <a class="h1"><b>Laundry</b><span class="font-italic">Delivery</span></a>
        </div>
        <div class="card-body">
          <p class="login-box-msg">Sign in to start your session</p>
            <div class="input-group mb-3">
              <input type="email" class="form-control" placeholder="Email" v-model="email">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" class="form-control" placeholder="Password" v-model="password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>

            <button @click="login()" class="btn btn-primary btn-block">Sign In</button>
          <br>

          <!-- <router-link to="register" class="text-center">Register an account</router-link> -->
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
      </div>
    <!-- /.login-box -->
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            role: null,
            email: '',
            password: '',
        };
    },
    methods: {
       async login() {
            try {
                const response = await axios.post('/web/login', {
                    email: this.email,
                    password: this.password
                });
                const token = response.data.token;
                localStorage.setItem('token', token);

                const role = response.data.role;

                if (role === 'ADMIN') {
                    this.$router.push('/dashboard');

                    this.$swal({
                        title: 'Logged In Successful',
                        text: 'You have successfully logged in.',
                        icon: 'success',
                    });
                }



            } catch (error) {
                this.$swal({
                    title: 'Login Failed',
                    text: 'Invalid username or password.',
                    icon: 'error',
                });
            }
        }
    }
};
</script>
