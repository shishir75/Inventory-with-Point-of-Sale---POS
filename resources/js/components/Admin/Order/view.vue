<template>
    <div>
        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
            <div
                class="d-sm-flex align-items-center justify-content-between mb-4"
            >
                <router-link
                    :to="{ name: 'TodayOrder' }"
                    class="btn btn-info text-white mb-0 text-gray-800"
                    >Today's Order</router-link
                >
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <router-link :to="{ name: 'Dashboard' }"
                            >Dashboard</router-link
                        >
                    </li>
                    <li class="breadcrumb-item">Order</li>
                    <li class="breadcrumb-item active" aria-current="page">
                        View Order Details
                    </li>
                </ol>
            </div>
            <div class="row">
                <div class="col-md-6 py-5">
                    <h2>Inventory Management Syestem with POS</h2>
                    <h5>Developed By: Md. Obydullah Sarder (SHISHIR)</h5>
                    <h6>M.Sc in ICT at Jahangirnagar University</h6>
                    <h6>Savar, Dhaka - 1342</h6>
                    <h6>
                        GitHub:
                        <a href="https://github.com/shishir75"
                            >https://github.com/shishir75</a
                        >
                    </h6>
                    <h6>Email: obydullah.srdr18@gmail.com</h6>
                    <h6>Cell: +8801744681133, +8801614681133</h6>
                </div>
                <div class="col-md-6 text-right">
                    <h2>Order Details</h2>
                    <h5>
                        Order Number:
                        <strong
                            >POS-{{ customerOrder.date | dateToString
                            }}{{ idNumber }}</strong
                        >
                    </h5>
                    <h6>
                        Customer Name:
                        <strong>{{ customerOrder.customer.name }}</strong>
                    </h6>
                    <h6>
                        Mobile: +88{{ customerOrder.customer.phone }},
                        <span
                            >Address: {{ customerOrder.customer.address }}</span
                        >
                    </h6>
                    <h6>
                        Total Quantity:
                        <strong>{{ customerOrder.quantity }},</strong>
                        <span
                            >Sub Total: $
                            {{ customerOrder.sub_total | numberFormat }},</span
                        >
                        <span
                            >Vat<small>(15%)</small>: $
                            {{ customerOrder.vat | numberFormat }}</span
                        >
                    </h6>
                    <h6>
                        Total:
                        <strong
                            >$ {{ customerOrder.total | numberFormat }}</strong
                        >
                    </h6>
                    <h6>
                        <span class="badge badge-success py-2"
                            >Paid: $
                            {{ customerOrder.paid | numberFormat }}</span
                        >
                        <span class="badge badge-danger py-2"
                            >Due: $ {{ customerOrder.due | numberFormat }}</span
                        >
                    </h6>
                    <h6>
                        Payment Medium:
                        <strong>{{ customerOrder.paidBy }}</strong>
                    </h6>
                    <h6>
                        Order Date: <strong>{{ customerOrder.date }}</strong>
                    </h6>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 mb-4">
                    <!-- Simple Tables -->
                    <div class="card">
                        <div
                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
                        >
                            <h4 class="m-0 font-weight-bold">
                                PRODUCTS LIST
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
                                class="table align-items-center table-flush table-bordered text-center"
                            >
                                <thead class="thead-light">
                                    <tr>
                                        <th>Serial</th>
                                        <th>Product Name</th>
                                        <th>Product Photo</th>
                                        <th>Quantity</th>
                                        <th>Unit Price</th>
                                        <th>Sub Total Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="(order, index) in filterSearch"
                                        :key="order.id"
                                    >
                                        <td>{{ index + 1 }}</td>
                                        <td>{{ order.product.name }}</td>
                                        <td>
                                            <img
                                                v-if="order.product.photo"
                                                :src="
                                                    photo(order.product.photo)
                                                "
                                                :alt="order.product.name"
                                                width="50px"
                                                height="40px"
                                                class="rounded"
                                            />
                                            <span
                                                v-else
                                                class="badge badge-warning"
                                                >No Image</span
                                            >
                                        </td>
                                        <td>{{ order.quantity }}</td>
                                        <td class="text-right">
                                            {{ order.price | numberFormat }}
                                        </td>
                                        <td class="text-right">
                                            $
                                            {{ order.sub_total | numberFormat }}
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
        this.$store.dispatch("getOrderDetails", this.$route.params.id);
    },
    created() {},
    computed: {
        orderDetails() {
            return this.$store.getters.getOrderDetails;
        },
        filterSearch() {
            if (this.searchItem != "") {
                return this.orderDetails.filter(item => {
                    return item.product.name
                        .toLowerCase()
                        .match(this.searchItem.toLowerCase());
                });
            } else {
                return this.orderDetails;
            }
        },
        customerOrder() {
            return this.$store.getters.getCustomerOrder;
        },
        idNumber() {
            let str = "" + this.customerOrder.id;
            let pad = "0000";
            let ans = pad.substring(0, pad.length - str.length) + str;

            return ans;
        }
    },
    methods: {
        photo(img) {
            return "/assets/img/product/" + img;
        }
    }
};
</script>

<style></style>
