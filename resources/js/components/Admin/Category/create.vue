<template>
    <div class="row justify-content-center">
        <div class="col-12">
            <div
                class="d-sm-flex align-items-center justify-content-between mb-4"
            >
                <router-link
                    :to="{ name: 'Category' }"
                    class="btn btn-info text-white mb-0 text-gray-800"
                    >All Categories</router-link
                >
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <router-link :to="{ name: 'Dashboard' }"
                            >Dashboard</router-link
                        >
                    </li>
                    <li class="breadcrumb-item">Category</li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Add New Category
                    </li>
                </ol>
            </div>
            <div class="card shadow-sm my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-8 offset-2">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mt-4">
                                    Add New Category
                                </h1>
                            </div>

                            <form
                                class="user"
                                @submit.prevent="saveForm"
                                method="POST"
                            >
                                <div class="row login-form">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="exampleInputFirstName"
                                                placeholder="Enter Category Name"
                                                v-model="form.name"
                                            />
                                            <small
                                                class="text-danger"
                                                v-if="errors.name"
                                                >{{ errors.name[0] }}</small
                                            >
                                        </div>
                                    </div>
                                </div>

                                <button
                                    type="submit"
                                    class="btn btn-primary float-right mr-5 mb-3"
                                >
                                    Save Data
                                </button>
                            </form>
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
                name: ""
            },
            errors: []
        };
    },
    components: {},
    mounted() {},
    created() {},
    computed: {},
    methods: {
        saveForm() {
            axios
                .post("/api/category", this.form)
                .then(res => {
                    this.$router.push({ name: "Category" });
                    Toast.fire({
                        icon: "success",
                        title: "Category Created Succesfully"
                    });
                })
                .catch(error => {
                    this.errors = error.response.data.errors;
                    Toast.fire({
                        icon: "error",
                        title: "Category can't be Created"
                    });
                });
        }
    }
};
</script>

<style></style>
