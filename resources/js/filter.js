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

Vue.filter("shortLength", (text, length, suffix = "...") => {
    if (text.length > length) {
        return text.substring(0, length) + suffix;
    } else {
        return text;
    }
});

Vue.filter("removeNegative", function(value) {
    if (value) {
        return Math.abs(value);
    }
});
