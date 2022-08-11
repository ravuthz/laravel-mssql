import Vue from 'vue'
import Vuex from 'vuex'
import axios from './axios'

Vue.use(Vuex);

const state = {
    user: {},
    token: localStorage.getItem('token') || '',
    status: '',
};

const getters = {
    authStatus: state => state.status,
    isLoggedIn: state => !!state.token
};

const mutations = {
    auth_request(state) {
        state.status = 'loading'
    },
    auth_success(state, token, user) {
        state.status = 'success'
        state.token = token
        state.user = user
    },
    auth_error(state) {
        state.status = 'error'
    },
    logout(state) {
        state.status = ''
        state.token = ''
    },
};

const actions = {
    login({ commit }, user) {
        return new Promise((resolve, reject) => {
            commit('auth_request')
            axios({ url: '/login', data: user, method: 'POST' })
                .then(res => {
                    const { user, token } = res.data;
                    localStorage.setItem('token', token);
                    axios.defaults.headers.common['Authorization'] = token;
                    commit('auth_success', token, user);
                    resolve(res)
                })
                .catch(err => {
                    commit('auth_error', err);
                    localStorage.removeItem('token');
                    reject(err)
                });
        })
    },
    register({ commit }, user) {
        return new Promise((resolve, reject) => {
            commit('auth_request')
            axios({ url: '/register', data: user, method: 'POST' })
                .then(res => {
                    const { user, token } = res.data;
                    localStorage.setItem('token', token);
                    axios.defaults.headers.common['Authorization'] = token;
                    commit('auth_success', token, user);
                    resolve(res);
                })
                .catch(err => {
                    commit('auth_error', err)
                    localStorage.removeItem('token')
                    reject(err)
                })
        })
    },
    logout({ commit }) {
        return new Promise((resolve, reject) => {
            commit('logout');
            localStorage.removeItem('token');
            delete axios.defaults.headers.common['Authorization'];
            resolve();
        })
    }
};

export default new Vuex.Store({
    state,
    getters,
    mutations,
    actions
});
