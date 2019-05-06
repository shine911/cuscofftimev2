
Vue.use(VueRouter);
const router = new VueRouter({
    routes:[{
        path: '/login',
        name: 'login',
        component: Login,
        meta: {
            auth: false
        }
    },{
        path: '/dashboard',
        name: 'dashboard',
        component: Example,
        meta: {
            auth: true
        }
    }, {
        path: '/',
        redirect: '/dashboard'
    }]
});
Vue.router = router;
App.router = Vue.router