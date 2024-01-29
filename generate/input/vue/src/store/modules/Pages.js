const pages = {
  namespaced: true,
  state: {

    items: [],
  },
  getters: {

    getPages: state => state.items,
  },
  mutations: {

    SET_PAGES: (state, payload) => {

      const { pages } = payload
      state.items = pages
    },
  },
}

export default pages