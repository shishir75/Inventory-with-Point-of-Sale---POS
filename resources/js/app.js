require("./bootstrap");
import Vue from "vue";

// Vue Router Import
import router from "./router";

// VueX
import Vuex from "vuex";
Vue.use(Vuex);
import storeData from "./store/index";
const store = new Vuex.Store(storeData);

// Sweet Alert 2
import Swal from "sweetalert2";
const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: toast => {
        toast.addEventListener("mouseenter", Swal.stopTimer);
        toast.addEventListener("mouseleave", Swal.resumeTimer);
    }
});
window.Toast = Toast;
// window.Swal = Swal;

// Global Component
Vue.component(
    "topbar-component",
    require("./components/layouts/Topbar.vue").default
);

Vue.component(
    "sidebar-component",
    require("./components/layouts/Sidebar.vue").default
);

Vue.component(
    "footer-component",
    require("./components/layouts/Footer.vue").default
);

const app = new Vue({
    el: "#app",
    router,
    store
});
