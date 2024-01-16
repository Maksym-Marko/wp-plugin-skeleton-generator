import API from '@/services/API'
import store from '@/store'
import { extractMenuItem } from '@/services/helpers'

const Navigation = {
    getNavigations() {

        return new Promise((resolve, reject) => {

            API.get('/navigation')
                .then(res => {

                    if (res?.status === 200) {

                        store.commit({
                            type: 'navigation/SET_NAVIGATIONS',
                            navigations: res.data,
                        })

                        resolve()

                    }

                })

        })

    },
    getHeaderMenu(menuID) {

        if (isNaN(menuID)) return false

        const navigation = store.getters['navigation/getNavigations']

        if (navigation.length === 0) return false

        let headerMenu = [];

        navigation.forEach(menu => {

            if (menu.id === parseInt(menuID)) {
                if (typeof menu?.content?.rendered === 'string') {
                    const menuString = menu.content.rendered
                    const parser = new DOMParser()

                    try {

                        const dom = parser.parseFromString(menuString, 'text/html')

                        const menuItems = dom.body.children

                        if (menuItems.length > 0) {

                            for (let item of menuItems) {

                                const menuItem = extractMenuItem(item);

                                if (menuItem) {

                                    headerMenu.push(menuItem)
                                }
                            }
                        }
                    } catch (error) {

                        return false
                    }
                }
            }
        });

        return headerMenu

    }
}

export default Navigation