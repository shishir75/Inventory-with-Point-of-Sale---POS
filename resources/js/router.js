import Vue from "vue";
import VueRouter from "vue-router";
Vue.use(VueRouter);

// Frontend Components
import Home from "./components/Frontend/Home.vue";

// 404 - Not Found Componenet
import NotFound from "./components/NotFound.vue";

// Admin Area Componenets
import Admin from "./components/Admin/index.vue";
import Dashboard from "./components/Admin/Dashboard.vue";

// Authentication Components
import Login from "./components/Auth/Login.vue";
import Register from "./components/Auth/Register.vue";
import Forget from "./components/Auth/Forget.vue";

const router = new VueRouter({
    mode: "history",
    linkExactActiveClass: "text-dark bg-primary",
    routes: [
        {
            path: "/",
            name: "Home",
            component: Home
        },
        {
            path: "/login",
            name: "Login",
            component: Login
        },
        {
            path: "/register",
            name: "Register",
            component: Register
        },
        {
            path: "/forget",
            name: "Forget",
            component: Forget
        },
        {
            path: "/admin",
            name: "Admin",
            component: Admin,
            children: [
                {
                    path: "dashboard",
                    name: "Dashboard",
                    component: Dashboard
                }
            ]
        },
        { path: "*", name: "NotFound", component: NotFound }
    ]
});

export default router;
