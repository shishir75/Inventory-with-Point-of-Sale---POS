<template>
    <div>
        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
            <div
                class="d-sm-flex align-items-center justify-content-between mb-4"
            >
                <router-link
                    :to="{ name: 'Pos' }"
                    class="btn btn-info text-white mb-0 text-gray-800"
                    >POS</router-link
                >
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <router-link :to="{ name: 'Dashboard' }"
                            >Dashboard</router-link
                        >
                    </li>
                    <li class="breadcrumb-item">Order</li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Today's Order
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
                                TODAY'S ALL ORDERS LIST
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
                                        <th>Customer Name</th>
                                        <th>Customer Phone</th>
                                        <th>Quantity</th>
                                        <th>Total Price</th>
                                        <th>Paid Amount</th>
                                        <th>Due Amount</th>
                                        <th>Payment Medium</th>
                                        <th width="10%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="(order, index) in filterSearch"
                                        :key="order.id"
                                    >
                                        <td>{{ index + 1 }}</td>
                                        <td>{{ order.customer.name }}</td>
                                        <td>{{ order.customer.phone }}</td>
                                        <td>{{ order.quantity }}</td>
                                        <td>
                                            $ {{ order.total | numberFormat }}
                                        </td>
                                        <td>
                                            $ {{ order.paid | numberFormat }}
                                        </td>
                                        <td>
                                            $ {{ order.due | numberFormat }}
                                        </td>
                                        <td>{{ order.paidBy }}</td>
                                        <td>
                                            <router-link
                                                :to="{
                                                    name: 'EditExpense',
                                                    params: { id: order.id }
                                                }"
                                                class="btn btn-sm btn-info"
                                                >Edit</router-link
                                            >
                                            <button
                                                @click="deleteData(order.id)"
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
        this.$store.dispatch("getTodayOrders");
    },
    created() {},
    computed: {
        allTodayOrder() {
            return this.$store.getters.getTodayOrders;
        },
        filterSearch() {
            if (this.searchItem != "") {
                return this.allTodayOrder.filter(item => {
                    return item.customer.name.match(this.searchItem);
                });
            } else {
                return this.allTodayOrder;
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
                        .delete("/api/expense/" + id)
                        .then(res => {
                            this.$store.dispatch("getAllExpenses");
                            Toast.fire({
                                icon: "success",
                                title: "Expense Data Deleted Successfully"
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
                        title: "Expense Data Remains Unchanged"
                    });
                }
            });
        }
    }
};
</script>

<style></style>
