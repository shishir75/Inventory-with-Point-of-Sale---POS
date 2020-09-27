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
                        All Orders
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
                                ALL ORDERS LIST
                            </h4>
                            <h6>
                                <form>
                                    <input
                                        type="date"
                                        class="form-control"
                                        v-model="searchItemByDate"
                                    />
                                </form>
                            </h6>
                            <h6>
                                <form>
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Search by Name...."
                                        v-model="searchItem"
                                    />
                                </form>
                            </h6>
                        </div>
                        <div class="table-responsive">
                            <table
                                class="table align-items-center table-flush table-bordered text-center"
                            >
                                <thead class="thead-light">
                                    <tr>
                                        <th>Serial</th>
                                        <th>Customer Name</th>
                                        <th>Customer Phone</th>
                                        <th>Quantity</th>
                                        <th>Order Date</th>
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
                                        <td class="text-right">
                                            {{ order.quantity }}
                                        </td>
                                        <td>{{ order.date }}</td>
                                        <td class="text-right">
                                            $ {{ order.total | numberFormat }}
                                        </td>
                                        <td class="text-right">
                                            $ {{ order.paid | numberFormat }}
                                        </td>
                                        <td
                                            class="text-right"
                                            :class="
                                                order.due == 0
                                                    ? 'text-success'
                                                    : 'text-danger'
                                            "
                                        >
                                            $ {{ order.due | numberFormat }}
                                        </td>
                                        <td>{{ order.paidBy }}</td>
                                        <td>
                                            <router-link
                                                :to="{
                                                    name: 'ViewOrder',
                                                    params: { id: order.id }
                                                }"
                                                class="btn btn-sm btn-info text-white"
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
            searchItem: "",
            searchItemByDate: ""
        };
    },
    components: {},
    mounted() {
        this.$store.dispatch("getAllOrders");
    },
    created() {},
    computed: {
        allOrders() {
            return this.$store.getters.getAllOrders;
        },
        filterSearch() {
            if (this.searchItem != "") {
                return this.allOrders.filter(item => {
                    return item.customer.name.match(this.searchItem);
                });
            } else if (this.searchItemByDate !== "") {
                return this.allOrders.filter(item => {
                    return item.date.match(this.searchItemByDate);
                });
            } else {
                return this.allOrders;
            }
        }
    },
    methods: {}
};
</script>

<style></style>
