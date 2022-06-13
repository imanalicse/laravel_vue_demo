import {createRouter, createWebHistory} from "vue-router";
import Dashboard from "../views/admin/Dashboard.vue";
import Login from "../views/Login.vue";
import Register from "../views/Register.vue";
import AdminLayout from "../components/Layout/AdminLayout.vue";
import ProductsAdmin from "../views/admin/ProductsAdmin.vue";
import ProductForm from "../views/admin/ProductForm.vue";
import store from "../store";
import AuthLayout from "../components/Layout/AuthLayout.vue";

const routes = [
    {
        path: '/',
        redirect: '/admin/dashboard',
        name: 'Dashboard',
        component: AdminLayout,
        meta: { requiresAuth: true },
        children: [
            { path: '/admin/dashboard', name: 'Dashboard', component: Dashboard },
            { path: '/admin/products', name: 'ProductsAdmin', component: ProductsAdmin },
            { path: '/admin/products/create', name: 'ProductCreate', component: ProductForm },
            { path: '/admin/products/:id/edit', name: 'ProductEdit', component: ProductForm },
        ]
    },
    {
        path: '/auth',
        redirect: '/login',
        name: 'Auth',
        component: AuthLayout,
        meta: { isGuest: true },
        children: [
            { path: '/login', name: 'Login', component: Login },
            { path: '/register', name: 'Register', component: Register }
        ]
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes
})

router.beforeEach((to, from, next) => {
    if (to.meta.requiresAuth && !store.state.user.token) {
        next({ name: "Login" })
    }
    else if (store.state.user.token && (to.meta.isGuest)) {
        next({ name: "Dashboard" })
    }
    else {
        next();
    }
});

export default router;