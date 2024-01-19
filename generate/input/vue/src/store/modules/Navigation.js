const navigation = {
    namespaced: true,
    state: {
      items: [],
      headerMenu: [],
      footerMenu: []
    },
    getters: {
      getNavigations: state => state.items,
      getHeaderMenu: state => state.headerMenu,
      getFooterMenu: state => state.footerMenu,
    },
    mutations: {     
        SET_NAVIGATIONS: ( state, payload ) => {

          const {navigations} = payload
          state.items = navigations;
        },
        SET_HEADER_MENU: ( state, payload ) => {

          const {headerMenu} = payload
          state.headerMenu = headerMenu;
        },
        SET_FOOTER_MENU: ( state, payload ) => {

          const {footerMenu} = payload
          state.footerMenu = footerMenu;
        },
    },
  }
  
  export default navigation