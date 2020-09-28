<template>
    <nav
        v-if="isLoggedIn"
        id="topbar"
        v-show="
            $route.path === '/' ||
            $route.path === '/login' ||
            $route.path === '/register' ||
            $route.path === '/forget'
                ? false
                : true
        "
        class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top"
    >
        <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown no-arrow">
                <a
                    class="nav-link dropdown-toggle"
                    href="#"
                    id="userDropdown"
                    role="button"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                >
                    <img
                        class="img-profile rounded-circle"
                        src="/assets/img/boy.png"
                        style="max-width: 60px"
                    />
                    <span class="ml-2 d-none d-lg-inline text-white small">{{
                        getUser.name
                    }}</span>
                </a>
                <div
                    class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                    aria-labelledby="userDropdown"
                >
                    <button class="dropdown-item" @click.prevent="logout">
                        <i
                            class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"
                        ></i>
                        Logout
                    </button>
                </div>
            </li>
        </ul>
    </nav>
</template>

<script>
export default {
    data() {
        return {};
    },
    components: {},
    mounted() {
        this.$store.commit("isLogIn", window.auth_user);
        this.$store.dispatch("getUser");
    },
    created() {},
    computed: {
        isLoggedIn() {
            return this.$store.getters.isLoggedIn;
        },
        getUser() {
            return this.$store.getters.getUser;
        }
    },
    methods: {
        logout() {
            axios
                .post("/api/logout")
                .then(() => {
                    this.$store.commit("isLogIn", null);
                    window.auth_user = null;
                    this.$router.push({ name: "Home" });
                    Toast.fire({
                        icon: "success",
                        title: "Logout successful. See you soon!"
                    });
                })
                .catch(error => {
                    console.log(error);
                    Toast.fire({
                        icon: "error",
                        title: "Something went wrong, Try again!"
                    });
                });
        }
    }
};
</script>

<style></style>
