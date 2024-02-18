import router from "../../routes/index";
import axios from "axios";

const state = {
    user: "",
    isLogged: false,
};

const getters = {
    isLogged: (state) => {
        return state.isLogged;
    },
    getUser: (state) => state.user,
    getUserName: (state) => state.user.name,
};

const mutations = {
    SET_USER(state, user) {
        state.user = user;
        state.isLogged = true;
        if (user.token) {
            window.localStorage.setItem("token", user.token);
        }
        axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
        axios.defaults.headers.common["Authorization"] =
            "Bearer " + window.localStorage.token;
    },
    LOGOUT(state) {
        state.isLogged = false;
        state.user = {
            name: "",
        };
        localStorage.removeItem("token");
        delete axios.defaults.headers.common["Authorization"];
        router.push("/login");
    },
};

const actions = {
    async FETCH_USER({ commit, dispatch }) {
        try {
            const response = await axios.get("/auth/me");
            commit("SET_USER", response.data);
        } catch (e) {
            dispatch("LOGOUT");
            console.log(e);
        }
    },
    async SESSION_START() {
        try {
            await axios.get("/session/start");
        } catch (e) {
            console.log(e);
        }
    },
    LOGIN({ commit, dispatch }, data) {
        //commit('LOGIN', data)
        dispatch("FETCH_USER");
        router.push("/");
    },
    SET_CENTER({ commit }, data) {
        console.log({ data });
        commit("SET_CENTER", data);
    },
    SET_CURRENCY_CODE({ commit }, data) {
        console.log({ data });
        commit("SET_CURRENCY_CODE", data);
    },
    SET_CURRENCY_SYMBOL({ commit }, data) {
        console.log({ data });
        commit("SET_CURRENCY_SYMBOL", data);
    },
    SET_LENGTH_PHONE({ commit }, data) {
        console.log({ data });
        commit("SET_LENGTH_PHONE", data);
    },
    LOGOUT({ commit }) {
        commit("LOGOUT");
        router.push({ name: "login" });
    },
};

export default {
    state,
    mutations,
    getters,
    actions,
};
