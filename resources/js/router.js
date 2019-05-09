import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)
export default new VueRouter({
    routes: [{
        path: '/login',
        name: 'login',
        component: () => import('./components/LoginComponent'),
        meta: {
            auth: false
        }
    }, {
        path: '/home',
        component: () => import('./components/home/HomeComponent'),
        meta: {
            auth: true
        },
        children: [{
                path: 'dashboard',
                component: () => import(/* webpackChunkName: "js/routes/dashboard" */'./components/home/dashboard/DashboardComponent'),
            },
            {
                path: 'assignments',
                component: () => import(/* webpackChunkName: "js/routes/assignments" */'./components/home/assignments/AssignmentsComponent'),
            },
            {
                path: 'calendar',
                component: ()=>import(/* webpackChunkName: "js/routes/calendar" */'./components/home/calendar/CalendarComponent'),
            },
            {
                path: 'subjects',
                component: ()=>import(/* webpackChunkName: "js/routes/subjects" */'./components/home/admin/subjects/SubjectsComponent'),
            },
            {
                path: 'courses',
                component: ()=>import(/* webpackChunkName: "js/routes/courses" */'./components/home/admin/courses/CoursesComponent'),
            },
            {
                path: 'assign',
                component: ()=>import(/* webpackChunkName: "js/routes/assign" */'./components/home/admin/assign/AssignComponent')
            },
            {
                path: 'classroom',
                component: ()=>import(/* webpackChunkName: "js/routes/classroom" */'./components/home/admin/classroom/ClassroomComponent')
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
