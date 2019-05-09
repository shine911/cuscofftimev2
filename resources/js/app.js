/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');
import BootstrapVue from 'bootstrap-vue'
import VueRouter from 'vue-router';
import App from './App.vue';
import Login from './components/LoginComponent.vue';
import Dashboard from './components/home/dashboard/DashboardComponent';
import Assignments from './components/home/assignments/AssignmentsComponent';
import Calendar from './components/home/calendar/CalendarComponent';
import Home from './components/home/HomeComponent';
import Subjects from './components/home/admin/subjects/SubjectsComponent';
import Courses from './components/home/admin/courses/CoursesComponent';
import Assign from './components/home/admin/assign/AssignComponent';
import AddClass from './components/home/admin/classroom/ClassroomComponent';

import Notifications from 'vue-notification';
import axios from 'axios';
import VueAxios from 'vue-axios';;
import velocity from 'velocity-animate';
import store from './store/store';

axios.defaults.baseURL = 'http://localhost:8000/api';

window.Vue = require('vue');
Vue.use(Notifications, {
    velocity
});

Vue.use(VueRouter);
Vue.use(VueAxios, axios);
Vue.use(BootstrapVue);

/**
 * Router
 */
const router = new VueRouter({
    routes: [{
        path: '/login',
        name: 'login',
        component: Login,
        meta: {
            auth: false
        }
    }, {
        path: '/home',
        component: Home,
        meta: {
            auth: true
        },
        children: [{
                path: 'dashboard',
                component: Dashboard,
            },
            {
                path: 'assignments',
                component: Assignments,
            },
            {
                path: 'calendar',
                component: Calendar,
            },
            {
                path: 'subjects',
                component: Subjects,
            },
            {
                path: 'courses',
                component: Courses,
            },
            {
                path: 'assign',
                component: Assign
            },
            {
                path: 'add-class',
                component: AddClass
            },
            {
                path: '',
                redirect: 'dashboard'
            }
        ]
    }, 
    {
        path: '',
        redirect: 'home'
    }
],
    linkActiveClass: 'active'
});
Vue.router = router;
Vue.use(require('@websanova/vue-auth'), {
    auth: require('./auth'),
    http: require('@websanova/vue-auth/drivers/http/axios.1.x.js'),
    router: require('@websanova/vue-auth/drivers/router/vue-router.2.x.js'),
});

App.store = store;
App.router = Vue.router;
new Vue(App).$mount('#app');