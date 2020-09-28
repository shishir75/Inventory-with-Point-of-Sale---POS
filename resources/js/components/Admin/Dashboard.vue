<template>
    <div>
        <div class="d-sm-flex align-items-center justify-content-between">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <router-link :to="{ name: 'Home' }">Home</router-link>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Dashboard
                </li>
            </ol>
        </div>

        <div class="row mb-3">
            <!-- Earnings (Today) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col mr-2">
                                <div
                                    class="text-xs font-weight-bold text-uppercase mb-1"
                                >
                                    Earnings (Today)
                                </div>
                                <div
                                    class="h5 mb-0 font-weight-bold text-gray-800"
                                >
                                    $ {{ todayHistory.paid | numberFormat }}
                                </div>
                                <div class="mt-2 mb-0 text-muted text-xs">
                                    <span class="text-success mr-2"
                                        ><i class="fa fa-arrow-up"></i>
                                        3.48%</span
                                    >
                                    <span>Since yesterday</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i
                                    class="fas fa-calendar fa-2x text-primary"
                                ></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sales (Today) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div
                                    class="text-xs font-weight-bold text-uppercase mb-1"
                                >
                                    Sales (Today)
                                </div>
                                <div
                                    class="h5 mb-0 font-weight-bold text-gray-800"
                                >
                                    $ {{ todayHistory.total | numberFormat }}
                                </div>
                                <div class="mt-2 mb-0 text-muted text-xs">
                                    <span class="text-success mr-2"
                                        ><i class="fas fa-arrow-up"></i>
                                        12%</span
                                    >
                                    <span>Since yesterday</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i
                                    class="fas fa-shopping-cart fa-2x text-success"
                                ></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Due (Today) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div
                                    class="text-xs font-weight-bold text-uppercase mb-1"
                                >
                                    Due (Today)
                                </div>
                                <div
                                    class="h5 mb-0 mr-3 font-weight-bold text-gray-800"
                                >
                                    $ {{ todayHistory.due | numberFormat }}
                                </div>
                                <div class="mt-2 mb-0 text-muted text-xs">
                                    <span class="text-success mr-2"
                                        ><i class="fas fa-arrow-up"></i>
                                        20.4%</span
                                    >
                                    <span>Since yesterday</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Expense (Today) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div
                                    class="text-xs font-weight-bold text-uppercase mb-1"
                                >
                                    Expense (Today)
                                </div>
                                <div
                                    class="h5 mb-0 font-weight-bold text-gray-800"
                                >
                                    $ {{ todayHistory.expense | numberFormat }}
                                </div>
                                <div class="mt-2 mb-0 text-muted text-xs">
                                    <span class="text-danger mr-2"
                                        ><i class="fas fa-arrow-down"></i>
                                        1.10%</span
                                    >
                                    <span>Since yesterday</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i
                                    class="fas fa-comments fa-2x text-warning"
                                ></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
                <div class="card mb-4">
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
                    >
                        <h6 class="m-0 font-weight-bold text-primary">
                            Monthly Recap Report
                        </h6>
                    </div>
                    <div class="card-body">
                        <chart></chart>
                    </div>
                </div>
            </div>
            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5">
                <div class="card mb-4">
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
                    >
                        <h6 class="m-0 font-weight-bold text-primary">
                            Top 9 Sold Products
                        </h6>
                    </div>
                    <div class="card-body">
                        <div
                            class="mb-3"
                            v-for="(top, index) in todayHistory.top_sold"
                            :key="index"
                        >
                            <div class="small">
                                {{ top.product.name }}
                                <div class="small float-right">
                                    <b
                                        >{{ top.total_sold }} of
                                        {{
                                            totalUnits(
                                                top.total_sold,
                                                top.product.quantity
                                            )
                                        }}
                                        Items</b
                                    >
                                </div>
                            </div>
                            <div class="progress" style="height: 12px;">
                                <div
                                    class="progress-bar bg-success"
                                    role="progressbar"
                                    :style="{
                                        width: widthPercentage(top.total_sold)
                                    }"
                                    aria-valuenow="top.total_sold"
                                    aria-valuemin="0"
                                    aria-valuemax="100"
                                ></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Top 5 Customers Example -->
            <div class="col-xl-5 col-lg-5 mb-4">
                <div class="card">
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
                    >
                        <h6 class="m-0 font-weight-bold text-primary">
                            Top 5 Customers
                        </h6>
                        <router-link
                            class="m-0 float-right btn btn-success btn-sm"
                            :to="{ name: 'Customer' }"
                            >View More <i class="fas fa-chevron-right"></i
                        ></router-link>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th>Serial</th>
                                    <th>Customer Name</th>
                                    <th>Customer Phone</th>
                                    <th>Order Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(top_customer,
                                    index) in todayHistory.top_customers"
                                    :key="top_customer.id"
                                >
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ top_customer.customer.name }}</td>
                                    <td>
                                        +88{{ top_customer.customer.phone }}
                                    </td>
                                    <td class="text-right">
                                        $
                                        {{
                                            top_customer.total_amount
                                                | numberFormat
                                        }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Invoice Example -->
            <div class="col-xl-3 col-lg-3 mb-4">
                <div class="card">
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
                    >
                        <h6 class="m-0 font-weight-bold text-primary">
                            Top 5 Categories
                        </h6>
                        <router-link
                            class="m-0 float-right btn btn-success btn-sm"
                            :to="{ name: 'Category' }"
                            >View More <i class="fas fa-chevron-right"></i
                        ></router-link>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th>Serial</th>
                                    <th>Name</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(top_category,
                                    index) in todayHistory.top_categories"
                                    :key="index"
                                >
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ top_category.category.name }}</td>
                                    <td>{{ top_category.category_count }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Top 5 Less Stock Products -->
            <div class="col-xl-4 col-lg-5 ">
                <div class="card">
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
                    >
                        <h6 class="m-0 font-weight-bold text-primary">
                            Top 5 Less Stock Products
                        </h6>
                        <router-link
                            class="m-0 float-right btn btn-success btn-sm"
                            :to="{ name: 'Product' }"
                            >View More <i class="fas fa-chevron-right"></i
                        ></router-link>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th>Serial</th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(product,
                                    index) in todayHistory.less_stock"
                                    :key="index"
                                >
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ product.name }}</td>
                                    <td>{{ product.quantity }}</td>
                                    <td>
                                        <button
                                            type="button"
                                            class="btn btn-sm btn-primary"
                                            data-toggle="modal"
                                            data-target="#exampleModalCenter"
                                            id="#modalCenter"
                                            @click.prevent="
                                                editStock(product.id)
                                            "
                                        >
                                            Stock
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Modal Center -->
            <div
                class="modal fade"
                id="exampleModalCenter"
                tabindex="-1"
                role="dialog"
                aria-labelledby="exampleModalCenterTitle"
                aria-hidden="true"
            >
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5
                                class="modal-title"
                                id="exampleModalCenterTitle"
                            >
                                Update Product Stock
                            </h5>
                            <button
                                type="button"
                                class="close"
                                data-dismiss="modal"
                                aria-label="Close"
                            >
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Product Quantity</label>
                                <input
                                    type="number"
                                    class="form-control"
                                    placeholder="Enter Product Quantity"
                                    v-model="form.quantity"
                                />
                                <small
                                    class="text-danger"
                                    v-if="errors.quantity"
                                    >{{ errors.quantity[0] }}</small
                                >
                            </div>
                            <input type="hidden" v-model="form.product_id" />
                        </div>
                        <div class="modal-footer">
                            <button
                                type="button"
                                class="btn btn-outline-secondary"
                                data-dismiss="modal"
                            >
                                Close
                            </button>
                            <button
                                type="button"
                                @click.prevent="updateStock"
                                class="btn btn-primary"
                            >
                                Update
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!--Row-->
        </div>
        <!--Row-->
    </div>
</template>

<script>
import Chart from "./Chart";
export default {
    data() {
        return {
            form: {
                quantity: "",
                product_id: ""
            },
            errors: []
        };
    },
    components: {
        Chart
    },
    mounted() {
        this.$store.dispatch("getAllTodayHistory");
    },
    created() {},
    computed: {
        todayHistory() {
            return this.$store.getters.getAllTodayHistory;
        }
    },
    methods: {
        totalUnits(sold, stock) {
            return parseInt(sold) + parseInt(stock);
        },
        widthPercentage(sold) {
            return sold + "%"; // this will be changed in real life
        },
        editStock(id) {
            axios
                .get("/api/product/" + id)
                .then(res => {
                    this.form.quantity = res.data.product.quantity;
                    this.form.product_id = res.data.product.id;
                })
                .catch(error => {
                    this.errors = error.response.data.errors;
                });
        },
        updateStock() {
            let id = this.form.product_id;
            axios
                .put("/api/product/stock/" + id, {
                    quantity: this.form.quantity
                })
                .then(res => {
                    $("#exampleModalCenter").modal("hide");
                    this.$store.dispatch("getAllTodayHistory");
                    Toast.fire({
                        icon: "success",
                        title: "Product Stock Updated Successfully"
                    });
                })
                .catch(error => {
                    this.errors = error.response.data.errors;
                    Toast.fire({
                        icon: "error",
                        title: "Product Stock can't be Updated"
                    });
                });
        }
    }
};
</script>

<style></style>
