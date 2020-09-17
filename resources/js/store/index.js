export default {
    state: {
        isLoggedIn: null
    },
    getters: {
        isLoggedIn(state) {
            return state.isLoggedIn !== null;
        }
    },
    mutations: {
        isLogIn(state, payload) {
            state.isLoggedIn = payload;
        }
    },
    actions: {}
};
