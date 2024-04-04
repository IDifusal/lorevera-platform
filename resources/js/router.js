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
        path: "/packages/list-packages",
        name: "packages-list",
        component: () => import("../js/views/Programs/ListPrograms.vue"),
        meta: { auth: true },
    },   
    {
        path: "/programs/add",
        name: "packages-add",
        component: () => import("../js/views/Programs/CreateProgram.vue"),
        meta: { auth: true },
    },       
    {
        path: "/programs/edit/:id",
        name: "packages-edit",
        component: () => import("../js/views/Programs/EditProgram.vue"),
        meta: { auth: true },
    },          
    {
        path: "/packages/equipment",
        name: "equipment",
        component: () => import("../js/views/Equipment/ListEquipment.vue"),
        meta: { auth: true },
    },
    {
        path: "/packages/days",
        name: "days",
        component: () => import("./views/Programs/Days/ListDays.vue"),
        meta: { auth: true },
    },    
    {
        path: "/packages/days/add",
        name: "days-add",
        component: () => import("./views/Programs/Days/AddDay.vue"),
        meta: { auth: true },
    },  
    {
        path: "/packages/days/edit/:id",
        name: "days-edit",
        component: () => import("./views/Programs/Days/EditDay.vue"),
        meta: { auth: true },
    },      
    {
        path: "/packages/warm-up",
        name: "warm-up-list",
        component: () => import("../js/views/WarmUp/List.vue"),
        meta: { auth: true },
    },
    {
        path: "/packages/warm-up/add",
        name: "warm-up-add",
        component: () => import("../js/views/WarmUp/Add.vue"),
        meta: { auth: true },
    },
    {
        path: "/packages/workout",
        name: "workout-list",
        component: () => import("../js/views/WorkOut/List.vue"),
        meta: { auth: true },
    },
    {
        path: "/packages/workout/add",
        name: "workout-add",
        component: () => import("../js/views/WorkOut/Add.vue"),
        meta: { auth: true },
    },    
    {
        path: "/packages/warm-up/edit/:id",
        name: "warm-up-edit",
        component: () => import("../js/views/WarmUp/Edit.vue"),
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
