<template>
    <nav
        id="sidebar"
        v-if="isLoggedIn"
        v-show="
            $route.path === '/' ||
            $route.path === '/login' ||
            $route.path === '/register' ||
            $route.path === '/forget'
                ? false
                : true
        "
    >
        <ul
            class="navbar-nav sidebar sidebar-light accordion"
            id="accordionSidebar"
        >
            <a
                class="sidebar-brand d-flex align-items-center justify-content-center"
                href="#"
            >
                <div class="sidebar-brand-icon">
                    <img src="/assets/img/logo/logo2.png" class="rounded" />
                </div>
                <div class="sidebar-brand-text mx-3">Inventory POS</div>
            </a>
            <hr class="sidebar-divider my-0" />
            <li class="nav-item active">
                <router-link class="nav-link" :to="{ name: 'Dashboard' }">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></router-link
                >
            </li>
            <hr class="sidebar-divider" />
            <div class="sidebar-heading">
                Point of Sale
            </div>
            <li class="nav-item active">
                <router-link class="nav-link" :to="{ name: 'Pos' }">
                    <i class="fas fa-fw fa-cart-plus"></i>
                    <span>POS</span></router-link
                >
            </li>
            <hr class="sidebar-divider" />
            <div class="sidebar-heading">
                Features
            </div>
            <li class="nav-item">
                <a
                    class="nav-link collapsed"
                    href="#"
                    data-toggle="collapse"
                    data-target="#collapseBootstrap"
                    aria-expanded="true"
                    aria-controls="collapseBootstrap"
                >
                    <i class="fas fa-fw fa-user-tie"></i>
                    <span>Employees</span>
                </a>
                <div
                    id="collapseBootstrap"
                    class="collapse"
                    aria-labelledby="headingBootstrap"
                    data-parent="#accordionSidebar"
                >
                    <div class="bg-white py-2 collapse-inner rounded">
                        <router-link
                            class="collapse-item"
                            :to="{ name: 'CreateEmployee' }"
                            >Add Employee</router-link
                        >
                        <router-link
                            class="collapse-item"
                            :to="{ name: 'Employee' }"
                            >All Employees</router-link
                        >
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a
                    class="nav-link collapsed"
                    href="#"
                    data-toggle="collapse"
                    data-target="#collapseForm"
                    aria-expanded="true"
                    aria-controls="collapseForm"
                >
                    <i class="fas fa-fw fa-users"></i>
                    <span>Suppliers</span>
                </a>
                <div
                    id="collapseForm"
                    class="collapse"
                    aria-labelledby="headingForm"
                    data-parent="#accordionSidebar"
                >
                    <div class="bg-white py-2 collapse-inner rounded">
                        <router-link
                            class="collapse-item"
                            :to="{ name: 'CreateSupplier' }"
                            >Add Supplier</router-link
                        >
                        <router-link
                            class="collapse-item"
                            :to="{ name: 'Supplier' }"
                            >All Suppliers</router-link
                        >
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a
                    class="nav-link collapsed"
                    href="#"
                    data-toggle="collapse"
                    data-target="#category"
                    aria-expanded="true"
                    aria-controls="collapseForm"
                >
                    <i class="fas fa-fw fa-list"></i>
                    <span>Categories</span>
                </a>
                <div
                    id="category"
                    class="collapse"
                    aria-labelledby="headingForm"
                    data-parent="#accordionSidebar"
                >
                    <div class="bg-white py-2 collapse-inner rounded">
                        <router-link
                            class="collapse-item"
                            :to="{ name: 'CreateCategory' }"
                            >Add Category</router-link
                        >
                        <router-link
                            class="collapse-item"
                            :to="{ name: 'Category' }"
                            >All Categories</router-link
                        >
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a
                    class="nav-link collapsed"
                    href="#"
                    data-toggle="collapse"
                    data-target="#product"
                    aria-expanded="true"
                    aria-controls="collapseForm"
                >
                    <i class="fab fa-fw fa-product-hunt"></i>
                    <span>Products</span>
                </a>
                <div
                    id="product"
                    class="collapse"
                    aria-labelledby="headingForm"
                    data-parent="#accordionSidebar"
                >
                    <div class="bg-white py-2 collapse-inner rounded">
                        <router-link
                            class="collapse-item"
                            :to="{ name: 'CreateProduct' }"
                            >Add Product</router-link
                        >
                        <router-link
                            class="collapse-item"
                            :to="{ name: 'Product' }"
                            >All Products</router-link
                        >
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a
                    class="nav-link collapsed"
                    href="#"
                    data-toggle="collapse"
                    data-target="#expense"
                    aria-expanded="true"
                    aria-controls="collapseForm"
                >
                    <i class="fas fa-fw fa-file-invoice-dollar"></i>
                    <span>Expense</span>
                </a>
                <div
                    id="expense"
                    class="collapse"
                    aria-labelledby="headingForm"
                    data-parent="#accordionSidebar"
                >
                    <div class="bg-white py-2 collapse-inner rounded">
                        <router-link
                            class="collapse-item"
                            :to="{ name: 'CreateExpense' }"
                            >Add Expense</router-link
                        >
                        <router-link
                            class="collapse-item"
                            :to="{ name: 'Expense' }"
                            >All Expenses</router-link
                        >
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a
                    class="nav-link collapsed"
                    href="#"
                    data-toggle="collapse"
                    data-target="#salary"
                    aria-expanded="true"
                    aria-controls="collapseForm"
                >
                    <i class="fas fa-fw fa-dollar-sign"></i>
                    <span>Salary</span>
                </a>
                <div
                    id="salary"
                    class="collapse"
                    aria-labelledby="headingForm"
                    data-parent="#accordionSidebar"
                >
                    <div class="bg-white py-2 collapse-inner rounded">
                        <router-link
                            class="collapse-item"
                            :to="{ name: 'CreateSalary' }"
                            >Pay Salary</router-link
                        >
                        <router-link
                            class="collapse-item"
                            :to="{ name: 'Salary' }"
                            >All Paid Salary</router-link
                        >
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a
                    class="nav-link collapsed"
                    href="#"
                    data-toggle="collapse"
                    data-target="#customer"
                    aria-expanded="true"
                    aria-controls="collapseTable"
                >
                    <i class="fas fa-fw fa-restroom"></i>
                    <span>Customer</span>
                </a>
                <div
                    id="customer"
                    class="collapse"
                    aria-labelledby="headingTable"
                    data-parent="#accordionSidebar"
                >
                    <div class="bg-white py-2 collapse-inner rounded">
                        <router-link
                            :to="{ name: 'CreateCustomer' }"
                            class="collapse-item"
                            >Add Customer</router-link
                        >
                        <router-link
                            class="collapse-item"
                            :to="{ name: 'Customer' }"
                            >All Customers</router-link
                        >
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a
                    class="nav-link collapsed"
                    href="#"
                    data-toggle="collapse"
                    data-target="#order"
                    aria-expanded="true"
                    aria-controls="collapseTable"
                >
                    <i class="fas fa-fw fa-sort-amount-up"></i>
                    <span>Order</span>
                </a>
                <div
                    id="order"
                    class="collapse"
                    aria-labelledby="headingTable"
                    data-parent="#accordionSidebar"
                >
                    <div class="bg-white py-2 collapse-inner rounded">
                        <router-link
                            :to="{ name: 'TodayOrder' }"
                            class="collapse-item"
                            >Today's Order</router-link
                        >
                        <router-link
                            :to="{ name: 'AllOrders' }"
                            class="collapse-item"
                            >All Orders</router-link
                        >
                    </div>
                </div>
            </li>
        </ul>
    </nav>
</template>

<script>
export default {
    data() {
        return {};
    },
    components: {},
    mounted() {
        this.$store.commit("isLogIn", window.auth_user);
    },
    created() {},
    computed: {
        isLoggedIn() {
            return this.$store.getters.isLoggedIn;
        }
    },
    methods: {}
};
</script>

<style></style>
