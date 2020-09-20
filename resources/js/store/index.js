export default {
    state: {
        isLoggedIn: null,
        allEmployees: [],
        allSuppliers: [],
        allCategories: [],
        allProducts: []
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
        }
    }
};
