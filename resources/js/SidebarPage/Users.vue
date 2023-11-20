<template>
    <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1><b>Users Account</b></h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Users Account</a></li>
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
                            <th>Barangay</th>
                            <th>Phone Number</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                          <tr v-for="user in users" :key="user.id">
                              <td>{{ user.name }}</td>
                              <td>{{ user.email }}</td>
                              <td>{{ user.barangay.barangay }}</td>
                              <td>{{ user.phoneNum }}</td>
                              <td>
                                <span v-if="user.status === 'BLOCKED'" class="badge bg-danger">{{ user.status }}</span>
                                <span v-else class="badge bg-success">{{ user.status }}</span>
                              </td>
                              <td>
                                <button @click="updateUser(user, 'ACTIVE')" v-if="user.status === 'BLOCKED'" class="btn btn-warning btn-sm">UNBLOCK</button>
                                <button v-else @click="updateUser(user, 'BLOCKED')" class="btn btn-danger btn-sm">BLOCK</button>
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
            users: [],
            dataTableInstance: null,
            status: '',
        }
    },
    mounted() {
        this.initDataTable();
        this.getUsers();
    },
    methods: {
        async getUsers() {
            this.isLoading = true;

            try {
                const response = await axios.get('/web/getusers');
                this.users = response.data;
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
        async updateUser(user, status) {
            try {
                const updatedData = {
                    status: status
                }
                const response = await axios.patch(`/web/updateuser/${user.id}`, updatedData)

                this.$swal({
                    title: `${status} Successful`,
                    text: `You have successfully ${status}.`,
                    icon: 'success',
                    toast: true,
                    position: 'top-end',
                    timer: 3000,
                    showConfirmButton: false
                });
            } catch(error) {
                console.error(error);
            } finally {
                this.getUsers();
            }
        }
    }
}
</script>
