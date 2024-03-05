import { createRouter, createWebHistory } from 'vue-router';

const routes = [
    // {path: "*", redirect: '/404'},
    // {path: '/', redirect: '/pedidos'},
    {
        path: "/login",
        name: "login",
        component: () => import("../js/views/Login.vue"),
        meta: { auth: false },
    },
    {
        path: "/",
        name: "dashboard",
        component: () => import("../js/views/Dashboard.vue"),
        meta: { auth: true },
    },
    {
        path: "/users/list-users",
        name: "users",
        component: () => import("../js/views/Users/ListUsers.vue"),
        meta: { auth: true },
    },
    {
        path: "/support",
        name: "support",
        component: () => import("../js/views/Support/ListSupport.vue"),
        meta: { auth: true },
    },
    {
        path: "/packages/equipment",
        name: "equipment",
        component: () => import("../js/views/Equipment/ListEquipment.vue"),
        meta: { auth: true },
    }    
];
const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    let token = window.localStorage.authToken;
    if (!token && to.meta.auth) {
        return next("/login");
    } else if (to.name == "login" && token) {
        return next("/");
    }
    next();
});
export default router;
