require("./bootstrap");
import Vue from "vue";

// Vue Router Import
import router from "./router";

// Import User Helper Class
import User from "./Helpers/User";
window.User = User;

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

const app = new Vue({
    el: "#app",
    router
});
