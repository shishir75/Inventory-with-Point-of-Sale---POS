<template></template>

<script>
import AppStorage from "./../../Helpers/AppStorage";
export default {
    created() {
        if (User.loggedIn()) {
            AppStorage.clear();
            this.$router.push({ name: "login" });
            Toast.fire({
                icon: "success",
                title: "Logout Successfully"
            });
        } else {
            this.$router.push({ name: "login" });
            Toast.fire({
                icon: "error",
                title: "Unauthorized! Login First!!"
            });
        }
    }
};
</script>

<style></style>
