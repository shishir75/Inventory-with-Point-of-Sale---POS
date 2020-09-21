<template>
    <div class="row justify-content-center">
        <div class="col-12">
            <div
                class="d-sm-flex align-items-center justify-content-between mb-4"
            >
                <router-link
                    :to="{ name: 'Expense' }"
                    class="btn btn-info text-white mb-0 text-gray-800"
                    >All Expenses</router-link
                >
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <router-link :to="{ name: 'Dashboard' }"
                            >Dashboard</router-link
                        >
                    </li>
                    <li class="breadcrumb-item">Expense</li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Add New Expense
                    </li>
                </ol>
            </div>
            <div class="card shadow-sm my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-12">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mt-4">
                                    Add New Expense
                                </h1>
                            </div>

                            <form
                                class="user"
                                @submit.prevent="saveForm"
                                method="POST"
                            >
                                <div class="row login-form">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Expense Details</label>
                                            <textarea
                                                class="form-control"
                                                rows="3"
                                                v-model="form.details"
                                                placeholder="Expense Details"
                                            ></textarea>
                                            <small
                                                class="text-danger"
                                                v-if="errors.details"
                                                >{{ errors.details[0] }}</small
                                            >
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Expense Amount</label>
                                            <input
                                                type="number"
                                                class="form-control"
                                                v-model="form.amount"
                                                placeholder="Enter Expense Amount"
                                            />
                                            <small
                                                class="text-danger"
                                                v-if="errors.amount"
                                                >{{ errors.amount[0] }}</small
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
                details: "",
                amount: ""
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
                .post("/api/expense", this.form)
                .then(res => {
                    this.$router.push({ name: "Expense" });
                    Toast.fire({
                        icon: "success",
                        title: "Expense Created Succesfully"
                    });
                })
                .catch(error => {
                    this.errors = error.response.data.errors;
                    Toast.fire({
                        icon: "error",
                        title: "Expense can't be Created"
                    });
                });
        }
    }
};
</script>

<style></style>
