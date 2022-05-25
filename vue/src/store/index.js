import { createStore } from "vuex";
import axiosClient from "../axios";

const tmpSurveys = [
    {
        id: 100,
        title: "The Codeholic youtube chanel",
        slug: "the-codeholic-youtube-chanel",
        status: "draft",
        image: "https://picsum.photos/id/237/200/300",
        description: "My Name is Iman",
        create_at: "2022-04-19 18:45:15",
        update_at: "2022-04-19 18:45:15",
        expire_at: "2022-04-30 18:45:15",
        questions: [
            {
                id: 1,
                type: "Select",
                question: "From which country are you?",
                description: null,
                data: {
                    options: [
                        {
                            uuid: 'fef20064-bfec-11ec-9d64-0242ac120002',
                            text: 'USA',
                        },
                        {
                            uuid: 'fef2037a-bfec-11ec-9d64-0242ac120002',
                            text: 'Bangladesh',
                        },
                        {
                            uuid: 'fef20564-bfec-11ec-9d64-0242ac120002',
                            text: 'India',
                        }

                    ]
                },
            },
            {
                id: 2,
                type: "Checkbox",
                question: "Which language do you prefer?",
                description: null,
                data: {
                    options: [
                        {
                            uuid: 'fef20064-bfec-11ec-9d64-0242ac120002',
                            text: 'Javascript',
                        },
                        {
                            uuid: 'fef2037a-bfec-11ec-9d64-0242ac120002',
                            text: 'PHP',
                        },
                        {
                            uuid: 'fef20564-bfec-11ec-9d64-0242ac120002',
                            text: 'Java',
                        }
                    ]
                },
            },
            {
                id: 3,
                type: "Text",
                question: "What is your favourite person?",
                description: null,
                data: {},
            }
        ],
    },
    {
        id: 200,
        title: "Laravel 9",
        slug: "laravel-9",
        status: "active",
        image: "https://picsum.photos/seed/picsum/200/300",
        description: "My Name is Iman",
        create_at: "2022-04-19 18:45:15",
        update_at: "2022-04-19 18:45:15",
        expire_at: "2022-04-30 18:45:15",
        questions: [],
    }
];

const store = createStore({
    state: {
        user: {
            data: {
            },
            token: sessionStorage.getItem("TOKEN")
        },
        surveys: [...tmpSurveys]
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