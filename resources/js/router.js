import Vue from "vue";
import VueRouter from "vue-router";
Vue.use(VueRouter);

// Frontend Components
import Home from "./components/Frontend/Home.vue";

// 404 - Not Found Componenet
import NotFound from "./components/NotFound.vue";

// Admin Area Componenets
import Admin from "./components/Admin/index.vue";
import Dashboard from "./components/Admin/Dashboard.vue";

// Authentication Components
import Login from "./components/Auth/Login.vue";
import Register from "./components/Auth/Register.vue";
import Forget from "./components/Auth/Forget.vue";

// Employee Module Componenet
import Employee from "./components/Admin/Employee/index.vue";
import CreateEmployee from "./components/Admin/Employee/create.vue";
import EditEmployee from "./components/Admin/Employee/edit.vue";

// Supplier Module Componenets
import Supplier from "./components/Admin/Supplier/index.vue";
import CreateSupplier from "./components/Admin/Supplier/create.vue";
import EditSupplier from "./components/Admin/Supplier/edit.vue";

// Category Module Componenets
import Category from "./components/Admin/Category/index.vue";
import CreateCategory from "./components/Admin/Category/create.vue";
import EditCategory from "./components/Admin/Category/edit.vue";

// Product Module Componenets
import Product from "./components/Admin/Product/index.vue";
import CreateProduct from "./components/Admin/Product/create.vue";
import EditProduct from "./components/Admin/Product/edit.vue";

// Expense Module Componenets
import Expense from "./components/Admin/Expense/index.vue";
import CreateExpense from "./components/Admin/Expense/create.vue";
import EditExpense from "./components/Admin/Expense/edit.vue";

// Salary Module Components
import Salary from "./components/Admin/Salary/index.vue";
import CreateSalary from "./components/Admin/Salary/create.vue";
import MonthlySalary from "./components/Admin/Salary/monthly.vue";
import EditSalary from "./components/Admin/Salary/edit.vue";

// Customer Module Components
import Customer from "./components/Admin/Customer/index.vue";
import CreateCustomer from "./components/Admin/Customer/create.vue";
import EditCustomer from "./components/Admin/Customer/edit.vue";

// POS Module Componenet
import Pos from "./components/Admin/Pos/index.vue";

// Order Module Componenets
import TodayOrder from "./components/Admin/Order/totay.vue";
import ViewOrder from "./components/Admin/Order/view.vue";
import AllOrders from "./components/Admin/Order/allOrders.vue";

const router = new VueRouter({
    mode: "history",
    // linkExactActiveClass: "text-dark bg-primary",
    routes: [
        {
            path: "/",
            name: "Home",
            component: Home
        },
        {
            path: "/login",
            name: "Login",
            component: Login
        },
        {
            path: "/register",
            name: "Register",
            component: Register
        },
        {
            path: "/forget",
            name: "Forget",
            component: Forget
        },
        {
            path: "/admin",
            name: "Admin",
            component: Admin,
            meta: { requiresAuth: true },
            children: [
                {
                    path: "dashboard",
                    name: "Dashboard",
                    component: Dashboard
                },
                {
                    path: "employee",
                    name: "Employee",
                    component: Employee
                },
                {
                    path: "employee/create",
                    name: "CreateEmployee",
                    component: CreateEmployee
                },
                {
                    path: "employee/:id/edit",
                    name: "EditEmployee",
                    component: EditEmployee
                },
                {
                    path: "supplier",
                    name: "Supplier",
                    component: Supplier
                },
                {
                    path: "supplier/create",
                    name: "CreateSupplier",
                    component: CreateSupplier
                },
                {
                    path: "supplier/:id/edit",
                    name: "EditSupplier",
                    component: EditSupplier
                },
                {
                    path: "category",
                    name: "Category",
                    component: Category
                },
                {
                    path: "category/create",
                    name: "CreateCategory",
                    component: CreateCategory
                },
                {
                    path: "category/:id/edit",
                    name: "EditCategory",
                    component: EditCategory
                },
                {
                    path: "product",
                    name: "Product",
                    component: Product
                },
                {
                    path: "product/create",
                    name: "CreateProduct",
                    component: CreateProduct
                },
                {
                    path: "product/:id/edit",
                    name: "EditProduct",
                    component: EditProduct
                },
                {
                    path: "expense",
                    name: "Expense",
                    component: Expense
                },
                {
                    path: "expense/create",
                    name: "CreateExpense",
                    component: CreateExpense
                },
                {
                    path: "expense/:id/edit",
                    name: "EditExpense",
                    component: EditExpense
                },
                {
                    path: "salary",
                    name: "Salary",
                    component: Salary
                },
                {
                    path: "salary/pay",
                    name: "CreateSalary",
                    component: CreateSalary
                },
                {
                    path: "salary/:month_year/monthly",
                    name: "MonthlySalary",
                    component: MonthlySalary
                },
                {
                    path: "salary/:id/edit",
                    name: "EditSalary",
                    component: EditSalary
                },
                {
                    path: "customer",
                    name: "Customer",
                    component: Customer
                },
                {
                    path: "customer/create",
                    name: "CreateCustomer",
                    component: CreateCustomer
                },
                {
                    path: "customer/:id/edit",
                    name: "EditCustomer",
                    component: EditCustomer
                },
                {
                    path: "pos",
                    name: "Pos",
                    component: Pos
                },
                {
                    path: "order",
                    name: "TodayOrder",
                    component: TodayOrder
                },
                {
                    path: "order/:id",
                    name: "ViewOrder",
                    component: ViewOrder
                },
                {
                    path: "orders",
                    name: "AllOrders",
                    component: AllOrders
                }
            ]
        },
        { path: "*", name: "NotFound", component: NotFound }
    ]
});

router.beforeEach((to, from, next) => {
    let isAuthenticated = window.auth_user ? true : false;

    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (!isAuthenticated) {
            next({
                name: "Login"
            });
        } else {
            next();
        }
    } else {
        if (
            (to.name === "Login" ||
                to.name === "Register" ||
                to.name === "Forget") &&
            isAuthenticated
        ) {
            next({ name: "Dashboard" });
        } else {
            next(); // make sure to always call next()!
        }
    }
});

export default router;
