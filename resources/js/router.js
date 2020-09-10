import Vue from "vue";
import VueRouter from "vue-router";
Vue.use(VueRouter);

// Components
import login from "./components/auth/login.vue";
import register from "./components/auth/register.vue";
import forget from "./components/auth/forget.vue";
import home from "./components/home.vue";

const router = new VueRouter({
    mode: "history",
    routes: [
        { path: "/", name: "/", component: login },
        { path: "/register", name: "register", component: register },
        { path: "/forget", name: "forget", component: forget },
        { path: "/home", name: "home", component: home }
    ]
});

export default router;
