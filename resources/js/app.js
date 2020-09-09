require("./bootstrap");
import Vue from "vue";

// Vue Router Import
import router from "./router";

// Vue.component("example-component", require("./components/ExampleComponent.vue").default);

const app = new Vue({
    el: "#app",
    router
});
