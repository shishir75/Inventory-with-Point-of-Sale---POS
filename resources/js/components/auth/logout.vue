<template></template>

<script>
import AppStorage from "./../../Helpers/AppStorage";
export default {
    created() {
        AppStorage.clear();
        this.$router.push({ name: "login" });
        Toast.fire({
            icon: "success",
            title: "Logout Successfully"
        });
    }
};
</script>

<style></style>
