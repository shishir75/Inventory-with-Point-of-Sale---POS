import Vue from "vue";
import VueRouter from "vue-router";
Vue.use(VueRouter);

// Components
import login from "./components/auth/login.vue";
import register from "./components/auth/register.vue";

const router = new VueRouter({
    mode: "history",
    routes: [
        { path: "/", name: "/", component: login },
        { path: "/register", name: "register", component: register }
    ]
});

export default router;
