export default {
    state: {
        isLoggedIn: null,
        allEmployees: [],
        allSuppliers: [],
        allCategories: [],
        allProducts: [],
        allExpenses: [],
        allMonths: [],
        allSalaries: []
    },
    getters: {
        isLoggedIn(state) {
            return state.isLoggedIn !== null;
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
        }
    },
    mutations: {
        isLogIn(state, payload) {
            state.isLoggedIn = payload;
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
        }
    },
    actions: {
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
        }
    }
};
