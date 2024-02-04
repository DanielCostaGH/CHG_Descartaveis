import { createStore } from 'vuex';

export default createStore({
    state: {
        user: null,
        admin: null,
    },
    mutations: {
        setUser(state, user) {
            state.user = user;
        },
        setAdmin(state, admin) {
            state.admin = admin;
        },
    },
    actions: {
        setUser({ commit }, user) {
            commit('setUser', user);
        },

        setAdmin({ commit }, admin) {
            commit('setAdmin', admin);
        },
    },
});
