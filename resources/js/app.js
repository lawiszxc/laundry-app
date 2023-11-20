import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import axios from 'axios';
import VueSweetalert2 from 'vue-sweetalert2'
import 'sweetalert2/dist/sweetalert2.min.css'


const token = localStorage.getItem('token');

axios.defaults.baseURL = 'http://localhost:8000/api';
axios.defaults.headers['Authorization'] = `Bearer ${token}`;

const app = createApp(App);

app.use(router);
app.use(VueSweetalert2);

app.mount('#app');
