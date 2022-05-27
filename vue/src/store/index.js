import { createStore } from "vuex";
import axiosClient from "../axios";

const store = createStore({
    state: {
        user: {
            data: {
            },
            token: sessionStorage.getItem("TOKEN")
        },
        currentProduct: {
            loading: false,
            data: {}
        },
    },
    getters: {},
    actions: {
        getProduct({commit}, id) {
             commit('setCurrentProductLoading', true)
             return axiosClient.get(`/products/${id}`)
               .then((res) => {
                    commit('setCurrentProduct', res.data);
                    commit('setCurrentProductLoading', false)
                    return res;
               }).catch((err) => {
                    commit('setCurrentProductLoading', false)
                    throw err;
               });
        },
        register({ commit }, user) {
            return axiosClient.post('/register', user)
               .then(({data}) => {
                    commit('setUser', data);
                    return data;
               });
        },

        login({ commit }, user) {
           return axiosClient.post('/login', user)
               .then(({data}) => {
                    commit('setUser', data);
                    return data;
               });
        },
        logout({ commit }, ) {
            return axiosClient.post('/logout')
                .then((response) => {
                    commit("logout")
                    return response;
                });
        }
    },
    mutations: {
        setCurrentProductLoading: (state, loading) => {
           state.currentProduct.loading = loading
       },
        setCurrentProduct: (state, product) => {
           state.currentProduct.data = product.data
       },
       logout: (state) => {
            state.user.data = {},
            state.user.token = null
            sessionStorage.removeItem("TOKEN");
       },
       setUser: (state, userData) => {
            state.user.token = userData.token;
            state.user.data = userData.user;
            sessionStorage.setItem('TOKEN', userData.token);
       }
    },
    modules: {}
});

export default store;