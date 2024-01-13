const navigation = {
    namespaced: true,
    state: {
      items: [],
      headerMenu: [
        // {
        //   label: 'About',
        //   route: 'about',
        //   children: []
        // }
      ]
    },
    getters: {
      getNavigations: state => state.items,
      getHeaderMenu: state => state.headerMenu,
    },
    mutations: {     
        SET_NAVIGATIONS: ( state, payload ) => {

          const {navigations} = payload
          state.items = navigations;
        },
        SET_HEADER_MENU: ( state, payload ) => {

          const {headerMenu} = payload
          state.headerMenu = headerMenu;
        }
    },
  }
  
  export default navigation