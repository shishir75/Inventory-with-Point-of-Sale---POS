<template>
    <div class="row justify-content-center">
        <div class="col-12">
            <div
                class="d-sm-flex align-items-center justify-content-between mb-4"
            >
                <router-link
                    :to="{ name: 'Salary' }"
                    class="btn btn-info text-white mb-0 text-gray-800"
                    >All Paid Salaries</router-link
                >
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <router-link :to="{ name: 'Dashboard' }"
                            >Dashboard</router-link
                        >
                    </li>
                    <li class="breadcrumb-item">Salary</li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Pay Salary
                    </li>
                </ol>
            </div>
            <div class="card shadow-sm my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <p
                            class="py-2 text-danger text-center"
                            v-if="errors.message"
                        >
                            {{ errors.message }}
                        </p>
                        <div class="col-12">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mt-4">
                                    Pay Salary
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
                                            <label>Employee Name</label>

                                            <select
                                                class="form-control mb-3"
                                                v-model="form.employee_id"
                                                @change="
                                                    selectEmployee(
                                                        form.employee_id
                                                    )
                                                "
                                            >
                                                <option
                                                    value=""
                                                    selected
                                                    disabled
                                                    >Select Employee</option
                                                >
                                                <option
                                                    v-for="employee in allEmployees"
                                                    :key="employee.id"
                                                    :value="employee.id"
                                                    >{{ employee.name }}</option
                                                >
                                            </select>

                                            <small
                                                class="text-danger"
                                                v-if="errors.employee_id"
                                                >{{
                                                    errors.employee_id[0]
                                                }}</small
                                            >
                                        </div>

                                        <div class="form-group">
                                            <label>Salary Month</label>

                                            <select
                                                class="form-control mb-3"
                                                v-model="form.month"
                                            >
                                                <option
                                                    value=""
                                                    selected
                                                    disabled
                                                    >Select Month</option
                                                >
                                                <option value="January"
                                                    >January</option
                                                >
                                                <option value="February"
                                                    >February</option
                                                >
                                                <option value="March"
                                                    >March</option
                                                >
                                                <option value="April"
                                                    >April</option
                                                >
                                                <option value="May">May</option>
                                                <option value="June"
                                                    >June</option
                                                >
                                                <option value="July"
                                                    >July</option
                                                >
                                                <option value="August"
                                                    >August</option
                                                >
                                                <option value="September"
                                                    >September</option
                                                >
                                                <option value="October"
                                                    >October</option
                                                >
                                                <option value="November"
                                                    >November</option
                                                >
                                                <option value="December"
                                                    >December</option
                                                >
                                            </select>

                                            <small
                                                class="text-danger"
                                                v-if="errors.month"
                                                >{{ errors.month[0] }}</small
                                            >
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Salary Amount</label>
                                            <input
                                                type="number"
                                                class="form-control"
                                                v-model="form.amount"
                                                placeholder="Enter Salary Amount"
                                            />
                                            <small
                                                class="text-danger"
                                                v-if="errors.amount"
                                                >{{ errors.amount[0] }}</small
                                            >
                                        </div>
                                        <div class="form-group">
                                            <label>Salary Year</label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                v-model="form.year"
                                                placeholder="Enter Salary Year"
                                                maxlength="4"
                                            />
                                            <small
                                                class="text-danger"
                                                v-if="errors.year"
                                                >{{ errors.year[0] }}</small
                                            >
                                        </div>
                                    </div>
                                </div>

                                <button
                                    type="submit"
                                    class="btn btn-primary float-right mr-5 mb-3"
                                >
                                    Pay Salary
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
                employee_id: "",
                amount: "",
                month: "",
                year: ""
            },
            errors: []
        };
    },
    components: {},
    mounted() {
        this.$store.dispatch("getAllEmployees");
    },
    created() {},
    computed: {
        allEmployees() {
            return this.$store.getters.getAllEmployees;
        }
    },
    methods: {
        saveForm() {
            axios
                .post("/api/salary", this.form)
                .then(res => {
                    this.$router.push({ name: "Salary" });
                    Toast.fire({
                        icon: "success",
                        title: "Salary Created Succesfully"
                    });
                })
                .catch(error => {
                    this.errors = error.response.data.errors;
                    // this.single_error = error.response.data.single_error;
                    console.log(this.errors);
                    Toast.fire({
                        icon: "error",
                        title: "Salary can't be Created"
                    });
                });
        },
        selectEmployee(id) {
            axios
                .get("/api/employee/" + id)
                .then(res => {
                    this.form.amount = res.data.employee.salary;
                })
                .catch(error => {
                    this.errors = error.response.data.errors;
                });
        }
    }
};
</script>

<style></style>
