<template>
    <div>
        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
            <div
                class="d-sm-flex align-items-center justify-content-between mb-4"
            >
                <router-link
                    :to="{ name: 'CreateSalary' }"
                    class="btn btn-info text-white mb-0 text-gray-800"
                    >Pay Salary</router-link
                >
                <router-link
                    :to="{ name: 'Salary' }"
                    class="btn btn-info text-white mb-0 text-gray-800"
                    >All Months Salary</router-link
                >
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <router-link :to="{ name: 'Dashboard' }"
                            >Dashboard</router-link
                        >
                    </li>
                    <li class="breadcrumb-item">Salary</li>
                    <li class="breadcrumb-item active" aria-current="page">
                        All Paid Monthly Salaries of
                        {{ allSalaries[0].month_year }}
                    </li>
                </ol>
            </div>

            <div class="row">
                <div class="col-lg-12 mb-4">
                    <!-- Simple Tables -->
                    <div class="card">
                        <div
                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
                        >
                            <h4 class="m-0 font-weight-bold">
                                ALL PAID MONTHLY SALARY LISTS of
                                {{ allSalaries[0].month_year }}
                            </h4>
                            <h6>
                                <form>
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Search...."
                                        v-model="searchItem"
                                    />
                                </form>
                            </h6>
                        </div>
                        <div class="table-responsive">
                            <table
                                class="table align-items-center table-flush table-bordered"
                            >
                                <thead class="thead-light">
                                    <tr>
                                        <th>Serial</th>
                                        <th>Employee Name</th>
                                        <th>Salary Amount</th>
                                        <th>Salary Date</th>
                                        <th>Salary Month Year</th>
                                        <th width="10%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="(salary, index) in filterSearch"
                                        :key="salary.id"
                                    >
                                        <td>{{ index + 1 }}</td>
                                        <td>{{ salary.employee.name }}</td>
                                        <td>{{ salary.amount }}</td>
                                        <td>{{ salary.date }}</td>
                                        <td>{{ salary.month_year }}</td>
                                        <td>
                                            <router-link
                                                :to="{
                                                    name: 'EditSalary',
                                                    params: { id: salary.id }
                                                }"
                                                class="btn btn-sm btn-info"
                                                >Edit</router-link
                                            >
                                            <button
                                                @click="deleteData(salary.id)"
                                                class="btn btn-sm btn-danger"
                                            >
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <h3
                                v-show="filterSearch == ''"
                                class="text-center text-danger my-5"
                            >
                                No Search Result Found
                            </h3>
                        </div>
                        <div class="card-footer"></div>
                    </div>
                </div>
            </div>
            <!--Row-->
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            searchItem: ""
        };
    },
    components: {},
    mounted() {
        let month_year = this.$route.params.month_year;
        this.$store.dispatch("getAllSalaries", month_year);
    },
    created() {},
    computed: {
        allSalaries() {
            return this.$store.getters.getAllSalaries;
        },
        filterSearch() {
            if (this.searchItem != "") {
                return this.allSalaries.filter(item => {
                    return item.employee.name
                        .toLowerCase()
                        .match(this.searchItem.toLowerCase());
                });
            } else {
                return this.allSalaries;
            }
        }
    },
    methods: {
        deleteData(id) {
            Swal.fire({
                title: "Are you sure?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Delete It!"
            }).then(result => {
                if (result.isConfirmed) {
                    axios
                        .delete("/api/salary/" + id)
                        .then(res => {
                            this.$router.push({ name: "Salary" });
                            Toast.fire({
                                icon: "success",
                                title: "Salary Data Deleted Successfully"
                            });
                        })
                        .catch(error => {
                            Toast.fire({
                                icon: "error",
                                title: "Data cann't be Deleted"
                            });
                        });
                } else {
                    Toast.fire({
                        icon: "info",
                        title: "Salary Data Remains Unchanged"
                    });
                }
            });
        }
    }
};
</script>

<style></style>
