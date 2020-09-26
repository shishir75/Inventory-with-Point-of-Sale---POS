import Vue from "vue";

// Global Filter
Vue.filter("numberFormat", value => {
    return value.toFixed(2);
});
