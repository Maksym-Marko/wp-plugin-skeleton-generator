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

router.beforeEach((to, from, next) => {

    const pages = store.getters['pages/getPages']
    const navigation = store.getters['navigation/getNavigations']

    let _next = null

    // Get navigation
    if (navigation.length === 0) {

        ; (async () => {
            await Navigation.getNavigations()
                .then(res => {

                    // Set Header Menu
                    const headerMenu = store.getters['navigation/getHeaderMenu']

                    if (headerMenu.length === 0) {

                        const mainMenu = Navigation.getMenu(parseInt(import.meta.env.VITE_HEADER_MENU_ID));

                        if (Array.isArray(mainMenu)) {
                            store.commit({
                                type: 'navigation/SET_HEADER_MENU',
                                headerMenu: mainMenu
                            })
                        }
                    }

                    // Set Footer Menu
                    const footerMenu = store.getters['navigation/getFooterMenu']

                    if (footerMenu.length === 0) {

                        const secondMenu = Navigation.getMenu(parseInt(import.meta.env.VITE_FOOTER_MENU_ID));

                        if (Array.isArray(secondMenu)) {
                            store.commit({
                                type: 'navigation/SET_FOOTER_MENU',
                                footerMenu: secondMenu
                            })
                        }
                    }

                })
        })()

    }

    // Get pages
    if (pages.length === 0) {

        ; (async () => {
            await Pages.getPages()
                .then(res => { })
        })()

    }

    next(_next);

    // Reset attempt
    store.commit({
        type: 'system/SET_ATTEMPT',
        attempt: false
    })

})

export default router