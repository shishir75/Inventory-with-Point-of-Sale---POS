<template>
    <div>
        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
            <div
                class="d-sm-flex align-items-center justify-content-between mb-4"
            >
                <router-link
                    :to="{ name: 'CreateEmployee' }"
                    class="btn btn-info text-white mb-0 text-gray-800"
                    >Add New Employee</router-link
                >
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <router-link :to="{ name: 'Dashboard' }"
                            >Dashboard</router-link
                        >
                    </li>
                    <li class="breadcrumb-item">Employee</li>
                    <li class="breadcrumb-item active" aria-current="page">
                        All Employees
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
                            <h4 class="m-0 font-weight-bold text-center">
                                ALL EMPLOYEE LISTS
                            </h4>
                        </div>
                        <div class="table-responsive">
                            <table
                                class="table align-items-center table-flush table-bordered"
                            >
                                <thead class="thead-light">
                                    <tr>
                                        <th>Serial</th>
                                        <th>Name</th>
                                        <th>Photo</th>
                                        <th>Email</th>
                                        <th>Joining Date</th>
                                        <th>Salary</th>
                                        <th>Phone No</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="(employee,
                                        index) in allEmployess"
                                        :key="employee.id"
                                    >
                                        <td>{{ index + 1 }}</td>
                                        <td>{{ employee.name }}</td>
                                        <td>
                                            <img
                                                v-if="employee.photo"
                                                :src="photo(employee.photo)"
                                                :alt="employee.name"
                                                width="50px"
                                                height="40px"
                                            />
                                            <span
                                                v-else
                                                class="badge badge-warning"
                                                >No Image</span
                                            >
                                        </td>
                                        <td>{{ employee.email }}</td>
                                        <td>{{ employee.joining_date }}</td>
                                        <td>{{ employee.salary }}</td>
                                        <td>{{ employee.phone }}</td>
                                        <td>
                                            <a
                                                href="#"
                                                class="btn btn-sm btn-primary"
                                                >Detail</a
                                            >
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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
        return {};
    },
    components: {},
    mounted() {
        this.$store.dispatch("getAllEmployees");
    },
    created() {},
    computed: {
        allEmployess() {
            return this.$store.getters.getAllEmployees;
        }
    },
    methods: {
        photo(img) {
            return "/assets/img/employee/" + img;
        }
    }
};
</script>

<style></style>
