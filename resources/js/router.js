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

// Employee Module Componenet
import Employee from "./components/Admin/Employee/index.vue";
import CreateEmployee from "./components/Admin/Employee/create.vue";
import EditEmployee from "./components/Admin/Employee/edit.vue";

const router = new VueRouter({
    mode: "history",
    // linkExactActiveClass: "text-dark bg-primary",
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
            meta: { requiresAuth: true },
            children: [
                {
                    path: "dashboard",
                    name: "Dashboard",
                    component: Dashboard
                },
                {
                    path: "employee",
                    name: "Employee",
                    component: Employee
                },
                {
                    path: "employee/create",
                    name: "CreateEmployee",
                    component: CreateEmployee
                },
                {
                    path: "employee/:id/edit",
                    name: "EditEmployee",
                    component: EditEmployee
                }
            ]
        },
        { path: "*", name: "NotFound", component: NotFound }
    ]
});

router.beforeEach((to, from, next) => {
    let isAuthenticated = window.auth_user ? true : false;

    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (!isAuthenticated) {
            next({
                name: "Login"
            });
        } else {
            next();
        }
    } else {
        if (
            (to.name === "Login" ||
                to.name === "Register" ||
                to.name === "Forget") &&
            isAuthenticated
        ) {
            next({ name: "Dashboard" });
        } else {
            next(); // make sure to always call next()!
        }
    }
});

export default router;
