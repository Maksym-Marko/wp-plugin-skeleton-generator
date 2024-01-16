import { createRouter, createWebHistory } from 'vue-router'
import store from '@/store'
import Pages from '@/services/Pages'
import Navigation from '@/services/Navigation'


const routes = [
    // Common pages
    {
        path: '/',
        component: () => import('@/components/DefaultLayout.vue'),
        children: [
            {
                path: '/',
                name: 'Home',
                component: () => import('@/views/Home.vue'),
            },
            {
                path: '/:pageSlug',
                component: () => import('@/views/Page.vue'),
            }
        ]
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

router.beforeEach( ( to, from, next ) => {

    const pages = store.getters['pages/getPages']
    const navigation = store.getters['navigation/getNavigations']
  
    let _next = null

    // Get navigation
    if(navigation.length === 0) {

        ;( async () => {
            await Navigation.getNavigations()
              .then( res => {

                const headerMenu = store.getters['navigation/getHeaderMenu']

                console.log(navigation);

                if(headerMenu.length === 0) {

                    const mainMenu = Navigation.getHeaderMenu(parseInt(import.meta.env.VITE_HEADER_MENU_ID));

                    if(Array.isArray(mainMenu)) {
                        // Set Header Menu
                        store.commit( {
                            type: 'navigation/SET_HEADER_MENU',
                            headerMenu: mainMenu
                        } )
                    }
                }
              } )
        } )()

    }

    // Get pages
    if(pages.length === 0) {

        ;( async () => {
            await Pages.getPages()
              .then( res => {} )      
        } )()

    }

    next(_next);
  
    // Reset attempt
    store.commit( {
      type: 'system/SET_ATTEMPT',
      attempt: false
    } )
  
  } )
  
  export default router