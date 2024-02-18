import { createRouter, createWebHistory } from 'vue-router';

const routes = [
        // {path: "*", redirect: '/404'},
        // {path: '/', redirect: '/pedidos'},
        {
            path: "/",
            name: "dashboard",
            component: () => import("../js/views/Dashboard.vue"),
            meta: { auth: true },
        },
        {
            path: "/login",
            name: "login",
            component: () => import("../js/views/Login.vue"),
            meta: { auth: false },
        },
        {
            path: "/users",
            name: "users",
            component: () => import("../js/views/Users/ListUsers.vue"),
            meta: { auth: true },
        },
        {
            path: "/sales",
            name: "sales",
            component: () => import("../js/views/Sales.vue"),
            meta: { auth: true },
        },
        {
            path: "/recipes",
            name: "recipes",
            component: () => import("../js/views/Recipes/ListRecipes.vue"),
            meta: { auth: true },
        },
        {
            path: "/recipesNew",
            name: "recipesNew",
            component: () => import("../js/views/RecipesNew/ListRecipes.vue"),
            meta: { auth: true },
        },        
        {
            path: "/recipes/edit/:id",
            name: "recipe_edit",
            component: () => import("../js/views/Recipes/EditRecipe.vue"),
            meta: { auth: true },
        },
        {
            path: "/recipesPlan/edit/:id",
            name: "recipe_plan_edit",
            component: () => import("../js/views/Recipes/EditRecipePlan.vue"),
            meta: { auth: true },
        },        
        {
            path: "/recipes/create",
            name: "recipe_create",
            component: () => import("../js/views/Recipes/CreateRecipe.vue"),
            meta: { auth: true },
        },
        {
            path: "/programs",
            name: "programs",
            component: () => import("../js/views/Programs/ListPrograms.vue"),
            meta: { auth: true },
        },
        {
            path: "/programs/edit/:id",
            name: "programs_edit",
            component: () => import("../js/views/Programs/EditProgram.vue"),
            meta: { auth: true },
        },
        {
            path: "/programs/create",
            name: "programs_create",
            component: () => import("../js/views/Programs/CreateProgram.vue"),
            meta: { auth: true },
        },        
        {
            path: "/support",
            name: "support",
            component: () => import("../js/views/Support/ListSupport.vue"),
            meta: { auth: true },
        },
        {
            path: "/cardio",
            name: "cardio",
            component: () => import("../js/views/Cardio/ListCardio.vue"),
            meta: { auth: true },
        },
        {
            path: "/cardio/create",
            name: "cardio_create",
            component: () => import("../js/views/Cardio/CreateCardio.vue"),
            meta: { auth: true },
        },      
        {
            path: "/cardio/edit/:id",
            name: "cardio_edit",
            component: () => import("../js/views/Cardio/EditCardio.vue"),
            meta: { auth: true },
        },                
    ];
const router = createRouter({
    history: createWebHistory(),
    routes,
  });
  
router.beforeEach((to, from, next) => {
    let token = window.localStorage.token;
    if (!token && to.meta.auth) {
        return next("/login");
    } else if (to.name == "login" && token) {
        return next("/");
    }
    next();
});
export default router;
