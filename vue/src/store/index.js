import { createStore } from "vuex";
import axiosClient from "../axios";

const store = createStore({
    state: {
        user: {
            data: {
                imageUrl: 'https://media-exp1.licdn.com/dms/image/C5603AQGwbo9rdQQKiw/profile-displayphoto-shrink_100_100/0/1516824621775?e=1658966400&v=beta&t=bfUtHtcrvK9RCG_Aa-5fP4jJ0mR4d8rXCK_k2EDasX4'
            },
            token: sessionStorage.getItem("TOKEN")
        },
    },
    getters: {},
    actions: {
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