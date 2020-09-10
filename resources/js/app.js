require("./bootstrap");
import Vue from "vue";

// Vue Router Import
import router from "./router";

// Import User Helper Class
import User from "./Helpers/User";
window.User = User;

// Vue.component("example-component", require("./components/ExampleComponent.vue").default);

const app = new Vue({
    el: "#app",
    router
});
