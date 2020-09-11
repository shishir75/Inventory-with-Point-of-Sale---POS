import Vue from "vue";
import VueRouter from "vue-router";
Vue.use(VueRouter);

// Authentication Components
import login from "./components/auth/login.vue";
import register from "./components/auth/register.vue";
import forget from "./components/auth/forget.vue";
import logout from "./components/auth/logout.vue";

// Admin Area Components
import home from "./components/home.vue";

const router = new VueRouter({
    mode: "history",
    routes: [
        { path: "/", name: "login", component: login },
        { path: "/register", name: "register", component: register },
        { path: "/forget", name: "forget", component: forget },
        { path: "/logout", name: "logout", component: logout },
        { path: "/home", name: "home", component: home }
    ]
});

export default router;
