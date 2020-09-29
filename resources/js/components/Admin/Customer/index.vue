<template>
    <div>
        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
            <div
                class="d-sm-flex align-items-center justify-content-between mb-4"
            >
                <router-link
                    :to="{ name: 'CreateCustomer' }"
                    class="btn btn-info text-white mb-0 text-gray-800"
                    >Add New Customer</router-link
                >
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <router-link :to="{ name: 'Dashboard' }"
                            >Dashboard</router-link
                        >
                    </li>
                    <li class="breadcrumb-item">Customer</li>
                    <li class="breadcrumb-item active" aria-current="page">
                        All Customers
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
                                ALL CUSTOMER LISTS
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
                                        <th>Name</th>
                                        <th>Photo</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Phone No</th>
                                        <th width="10%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="(customer,
                                        index) in filterSearch"
                                        :key="customer.id"
                                    >
                                        <td>{{ index + 1 }}</td>
                                        <td>{{ customer.name }}</td>
                                        <td>
                                            <img
                                                v-if="customer.photo"
                                                :src="photo(customer.photo)"
                                                :alt="customer.name"
                                                width="50px"
                                                height="40px"
                                            />
                                            <span
                                                v-else
                                                class="badge badge-warning"
                                                >No Image</span
                                            >
                                        </td>
                                        <td>{{ customer.email }}</td>
                                        <td>{{ customer.address }}</td>
                                        <td>{{ customer.phone }}</td>
                                        <td>
                                            <router-link
                                                :to="{
                                                    name: 'EditCustomer',
                                                    params: { id: customer.id }
                                                }"
                                                class="btn btn-sm btn-info"
                                                >Edit</router-link
                                            >
                                            <button
                                                @click="deleteData(customer.id)"
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
        this.$store.dispatch("getAllCustomers");
    },
    created() {},
    computed: {
        allCustomers() {
            return this.$store.getters.getAllCustomers;
        },
        filterSearch() {
            if (this.searchItem != "") {
                return this.allCustomers.filter(item => {
                    return item.name
                        .toLowerCase()
                        .match(this.searchItem.toLowerCase());
                });
            } else {
                return this.allCustomers;
            }
        }
    },
    methods: {
        photo(img) {
            return "/assets/img/customer/" + img;
        },
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
                        .delete("/api/customer/" + id)
                        .then(res => {
                            this.$store.dispatch("getAllCustomers");
                            Toast.fire({
                                icon: "success",
                                title: "Customer Data Deleted Successfully"
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
                        title: "Customer Data Remains Unchanged"
                    });
                }
            });
        }
    }
};
</script>

<style></style>
