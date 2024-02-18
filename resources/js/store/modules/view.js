
const state = {
    snackbar: {
        show: false,
        text: '',
    },
}

const getters = {
    getSnackBar: (state) => state.snackbar
}

const mutations = {
    SET_SNACKBAR(state,value){
        state.snackbar = value
    },
}

export default {
    state,
    mutations,
    getters
}
