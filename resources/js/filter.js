import Vue from "vue";
import moment from "moment";

// Global Filter
Vue.filter("numberFormat", value => {
    return value.toFixed(2);
});

Vue.filter("dateToString", function(value) {
    if (value) {
        return moment(String(value)).format("YYYYMMDD");
    }
});
