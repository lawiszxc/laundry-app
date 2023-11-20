import { createRouter, createWebHistory } from 'vue-router';

import Login from './components/Login.vue';
import Dashboard from './components/Dashboard.vue';
import DashboardPage from './SidebarPage/DashboardPage.vue';
import LaundrySetting from './SidebarPage/LaundrySetting.vue';
import Riders from './SidebarPage/Riders.vue';
import Remittance from './SidebarPage/Remittance.vue';
import PickupAndDelivery from './SidebarPage/PickupAndDelivery.vue';
import Users from './SidebarPage/Users.vue';
import History from './SidebarPage/History.vue';
import SalesReport from './SidebarPage/SalesReport.vue';
import DropOff from './SidebarPage/DropOff.vue';
import Profile from './SidebarPage/Profile.vue';
import Error404 from './components/Error404.vue';


const routes = [
    {path: '/login', component: Login,},
    {
        path: '/',
        component: Dashboard,
        children: [
            {path: '/', component: DashboardPage, props: true},
            {path: '/dashboard', component: DashboardPage, props: true},
            {path: '/profile', component: Profile, props: true},
            {path: '/laundry/setting', component: LaundrySetting, props: true},
            {path: '/riders', component: Riders, props: true},
            {path: '/remittances', component: Remittance, props: true},
            {path: '/pickupdelivery', component: PickupAndDelivery, props: true},
            {path: '/users', component: Users, props: true},
            {path: '/history', component: History, props: true},
            {path: '/dropoff', component: DropOff, props: true},
            {path: '/sales/report', component: SalesReport, props: true},
        ],
    },
    { path: '/:pathMatch(.*)*', component: Error404 },
];


const router = createRouter({
  history: createWebHistory(),
  routes,
});


export default router;

router.beforeEach((to, from, next) => {
const token = localStorage.getItem('token');

    if (!token && to.path !== '/login') {
        next('/login');
    } else {
        if (token && to.path === '/login') {
            next('/dashboard');
        } else {
            next();
        }
    }
});

router.beforeEach((to, from, next) => {
    if (to.matched.length === 0) {
      next('/404');
    } else {
      next();
    }
});
