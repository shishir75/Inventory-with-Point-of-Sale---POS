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
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <router-link :to="{ name: 'Dashboard' }"
                            >Dashboard</router-link
                        >
                    </li>
                    <li class="breadcrumb-item">Salary</li>
                    <li class="breadcrumb-item active" aria-current="page">
                        All Paid Salaries
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
                                ALL PAID MONTHLY SALARY LISTS
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
                                        <th>Salary Month Year</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="(salary, index) in filterSearch"
                                        :key="salary.id"
                                    >
                                        <td>{{ index + 1 }}</td>
                                        <td>{{ salary.month_year }}</td>
                                        <td>
                                            <router-link
                                                :to="{
                                                    name: 'MonthlySalary',
                                                    params: {
                                                        month_year:
                                                            salary.month_year
                                                    }
                                                }"
                                                class="btn btn-sm btn-info"
                                                >View Details</router-link
                                            >
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
        this.$store.dispatch("getAllMonths");
    },
    created() {},
    computed: {
        allMonths() {
            return this.$store.getters.getAllMonths;
        },
        filterSearch() {
            if (this.searchItem != "") {
                return this.allMonths.filter(item => {
                    return item.month_year
                        .toLowerCase()
                        .match(this.searchItem.toLowerCase());
                });
            } else {
                return this.allMonths;
            }
        }
    },
    methods: {}
};
</script>

<style></style>
