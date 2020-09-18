<template>
    <footer
        class="sticky-footer bg-white"
        id="footer"
        v-if="isLoggedIn"
        v-show="
            $route.path === '/' ||
            $route.path === '/login' ||
            $route.path === '/register' ||
            $route.path === '/forget'
                ? false
                : true
        "
    >
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span
                    >copyright &copy; 2020 - developed by
                    <b
                        ><a
                            href="https://indrijunanda.gitlab.io/"
                            target="_blank"
                            >indrijunanda</a
                        ></b
                    >
                </span>
            </div>
        </div>
    </footer>
</template>

<script>
export default {
    data() {
        return {};
    },
    components: {},
    mounted() {
        this.$store.commit("isLogIn", window.auth_user);
    },
    created() {},
    computed: {
        isLoggedIn() {
            return this.$store.getters.isLoggedIn;
        }
    },
    methods: {}
};
</script>

<style></style>
