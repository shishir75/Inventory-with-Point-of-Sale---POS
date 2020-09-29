export default {
    state: {
        isLoggedIn: null,
        user: [],
        allEmployees: [],
        allSuppliers: [],
        allCategories: [],
        allProducts: [],
        allExpenses: [],
        allMonths: [],
        allSalaries: [],
        allCustomers: [],
        allProductsByCategory: [],
        allCartProducts: [],
        todayOrders: [],
        orderDetails: [],
        customerOrder: [],
        allOrders: [],
        todayHistory: [],
        yesterdayHistory: []
    },
    getters: {
        isLoggedIn(state) {
            return state.isLoggedIn !== null;
        },
        getUser(state) {
            return state.user;
        },
        getAllEmployees(state) {
            return state.allEmployees;
        },
        getAllSuppliers(state) {
            return state.allSuppliers;
        },
        getAllCategories(state) {
            return state.allCategories;
        },
        getAllProducts(state) {
            return state.allProducts;
        },
        getAllExpenses(state) {
            return state.allExpenses;
        },
        getAllMonths(state) {
            return state.allMonths;
        },
        getAllSalaries(state) {
            return state.allSalaries;
        },
        getAllCustomers(state) {
            return state.allCustomers;
        },
        getAlLProductsByCategory(state) {
            return state.allProductsByCategory;
        },
        getAllCartProducts(state) {
            return state.allCartProducts;
        },
        getTodayOrders(state) {
            return state.todayOrders;
        },
        getOrderDetails(state) {
            return state.orderDetails;
        },
        getCustomerOrder(state) {
            return state.customerOrder;
        },
        getAllOrders(state) {
            return state.allOrders;
        },
        getAllTodayHistory(state) {
            return state.todayHistory;
        },
        getAllYesterdayHistory(state) {
            return state.yesterdayHistory;
        }
    },
    mutations: {
        isLogIn(state, payload) {
            state.isLoggedIn = payload;
        },
        getUser(state, payload) {
            state.user = payload;
        },
        getAllEmployees(state, payload) {
            state.allEmployees = payload;
        },
        getAllSuppliers(state, payload) {
            state.allSuppliers = payload;
        },
        getAllCategories(state, payload) {
            state.allCategories = payload;
        },
        getAllProducts(state, payload) {
            state.allProducts = payload;
        },
        getAllExpenses(state, payload) {
            state.allExpenses = payload;
        },
        getAllMonths(state, payload) {
            state.allMonths = payload;
        },
        getAllSalaries(state, payload) {
            state.allSalaries = payload;
        },
        getAllCustomers(state, payload) {
            state.allCustomers = payload;
        },
        getAlLProductsByCategory(state, payload) {
            state.allProductsByCategory = payload;
        },
        getAllCartProducts(state, payload) {
            state.allCartProducts = payload;
        },
        getTodayOrders(state, payload) {
            state.todayOrders = payload;
        },
        getOrderDetails(state, payload) {
            state.orderDetails = payload;
        },
        getCustomerOrder(state, payload) {
            state.customerOrder = payload;
        },
        getAllOrders(state, payload) {
            state.allOrders = payload;
        },
        getAllTodayHistory(state, payload) {
            state.todayHistory = payload;
        },
        getAllYesterdayHistory(state, payload) {
            state.yesterdayHistory = payload;
        }
    },
    actions: {
        getUser(context) {
            axios.get("/api/user").then(res => {
                context.commit("getUser", res.data);
            });
        },
        getAllEmployees(context) {
            axios.get("/api/employee").then(res => {
                context.commit("getAllEmployees", res.data.employees);
            });
        },
        getAllSuppliers(context) {
            axios.get("/api/supplier").then(res => {
                context.commit("getAllSuppliers", res.data.suppliers);
            });
        },
        getAllCategories(context) {
            axios.get("/api/category").then(res => {
                context.commit("getAllCategories", res.data.categories);
            });
        },
        getAllProducts(context) {
            axios.get("/api/product").then(res => {
                context.commit("getAllProducts", res.data.products);
            });
        },
        getAllExpenses(context) {
            axios.get("/api/expense").then(res => {
                context.commit("getAllExpenses", res.data.expenses);
            });
        },
        getAllMonths(context) {
            axios.get("/api/salary").then(res => {
                context.commit("getAllMonths", res.data.salaries);
            });
        },
        getAllSalaries(context, month_year) {
            axios.get("/api/salary/" + month_year + "/monthly").then(res => {
                context.commit("getAllSalaries", res.data.salaries);
            });
        },
        getAllCustomers(context) {
            axios.get("/api/customer").then(res => {
                context.commit("getAllCustomers", res.data.customers);
            });
        },
        getAlLProductsByCategory(context, id) {
            axios.get("/api/category/" + id + "/product").then(res => {
                context.commit("getAlLProductsByCategory", res.data.products);
            });
        },
        getAllCartProducts(context) {
            axios.get("/api/cart").then(res => {
                context.commit("getAllCartProducts", res.data.products);
            });
        },
        getTodayOrders(context) {
            axios.get("/api/order/today").then(res => {
                context.commit("getTodayOrders", res.data.orders);
            });
        },
        getOrderDetails(context, id) {
            axios.get("/api/order/" + id).then(res => {
                context.commit("getOrderDetails", res.data.orders);
                context.commit("getCustomerOrder", res.data.customerOrder);
            });
        },
        getAllOrders(context) {
            axios.get("/api/all-orders").then(res => {
                context.commit("getAllOrders", res.data.orders);
            });
        },
        getAllTodayHistory(context) {
            axios.get("/api/pos/today").then(res => {
                context.commit("getAllTodayHistory", res.data.data);
            });
        },
        getAllYesterdayHistory(context) {
            axios.get("/api/pos/yesterday").then(res => {
                context.commit("getAllYesterdayHistory", res.data.data);
            });
        }
    }
};
