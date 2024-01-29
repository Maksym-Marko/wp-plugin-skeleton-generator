const system = {
    namespaced: true,
    state: {
        attempt: false,
    },
    getters: {
        getAttempt: state => state.attempt,
    },
    mutations: {
        SET_ATTEMPT: ( state, payload ) => {
            const {attempt} = payload
            state.attempt = attempt
        },
    },
}

export default system