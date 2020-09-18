<template>
    <div>
        <div class="row justify-content-center mt-5">
            <div class="col-xl-6 col-lg-6 col-md-6">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">
                                            User Login
                                        </h1>
                                    </div>
                                    <form
                                        class="user"
                                        @submit.prevent="login"
                                        method="POST"
                                    >
                                        <div class="form-group">
                                            <input
                                                type="email"
                                                class="form-control"
                                                id="exampleInputEmail"
                                                aria-describedby="emailHelp"
                                                placeholder="Enter Email Address"
                                                v-model="form.email"
                                            />
                                            <small
                                                class="text-danger"
                                                v-if="errors.email"
                                                >{{ errors.email[0] }}</small
                                            >
                                        </div>
                                        <div class="form-group">
                                            <input
                                                type="password"
                                                class="form-control"
                                                id="exampleInputPassword"
                                                placeholder="Password"
                                                v-model="form.password"
                                            />
                                            <small
                                                class="text-danger"
                                                v-if="errors.password"
                                                >{{ errors.password[0] }}</small
                                            >
                                        </div>
                                        <div class="form-group">
                                            <div
                                                class="custom-control custom-checkbox small"
                                                style="line-height: 1.5rem;"
                                            >
                                                <input
                                                    type="checkbox"
                                                    class="custom-control-input"
                                                    id="customCheck"
                                                />
                                                <label
                                                    class="custom-control-label"
                                                    for="customCheck"
                                                    >Remember Me</label
                                                >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button
                                                type="submit"
                                                class="btn btn-primary btn-block"
                                            >
                                                Login
                                            </button>
                                        </div>
                                    </form>
                                    <hr />
                                    <div class="text-center">
                                        <router-link
                                            class="font-weight-bold small"
                                            to="register"
                                            >Create an Account!</router-link
                                        >
                                    </div>
                                    <div class="text-center">
                                        <router-link
                                            class="font-weight-bold small"
                                            to="/forget"
                                            >Forget Password?</router-link
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            form: {
                email: "",
                password: ""
            },
            errors: {}
        };
    },
    components: {},
    mounted() {},
    created() {},
    computed: {},
    methods: {
        login() {
            axios.get("/sanctum/csrf-cookie").then(response => {
                axios
                    .post("/api/login", this.form)
                    .then(res => {
                        this.$store.commit("isLogIn", true);
                        window.auth_user = true; // it is must for login.
                        this.$router.push({ name: "Dashboard" });
                        Toast.fire({
                            icon: "success",
                            title: "Login successful."
                        });
                    })
                    .catch(error => {
                        this.errors = error.response.data.errors;
                        Toast.fire({
                            icon: "error",
                            title: "Something went wrong, Try again!"
                        });
                    });
            });
        }
    }
};
</script>

<style></style>
