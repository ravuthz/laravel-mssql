import Vue from 'vue';
import VueRouter from 'vue-router';

import Home from './components/pages/Home.vue';
import UserCrud from './components/pages/UserCRUD.vue';
import Register from './components/pages/auth/Register.vue';
import Login from './components/pages/auth/Login.vue';
import Dashboard from './components/pages/Dashboard.vue';

Vue.use(VueRouter);

const routes = [
    {
        path: '/',
        name: 'home',
        component: Home,
        meta: {
            auth: false
        }
    },
    {
        path: '/users',
        name: 'users',
        component: UserCrud,
        meta: {
            auth: false
        }
    },
    {
        path: '/register',
        name: 'register',
        component: Register,
        meta: {
            auth: false
        }
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
        meta: {
            auth: false

        }
    },
    {
        path: '/logout',
        name: 'logout',
        component: Login,
        meta: {
            auth: false
        }
    },
    {
        path: '/dashboard',
        name: 'dashboard',
        component: Dashboard,
        meta: {
            auth: true
        }
    }
];

const router = new VueRouter({
    history: true,
    mode: "history",
    routes
});

// router.beforeEach((to, from, next) => {
//     if (to.matched.some(record => record.meta.auth)) {
//         if (localStorage.getItem('jwt') == null) {
//             next({
//                 path: '/login',
//                 params: { nextUrl: to.fullPath }
//             })
//         } else {
//             let user = JSON.parse(localStorage.getItem('user'))
//             if (to.matched.some(record => record.meta.is_admin)) {
//                 if (user.is_admin == 1) {
//                     next()
//                 }
//                 else {
//                     next({ name: 'userboard' })
//                 }
//             } else {
//                 next()
//             }
//         }
//     } else {
//         next()
//     }
// })

export default router;
