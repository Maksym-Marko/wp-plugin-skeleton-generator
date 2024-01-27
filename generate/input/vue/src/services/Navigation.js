import API from '@/services/API'
import store from '@/store'
import { extractMenuItem } from '@/services/helpers'

const Navigation = {
    getNavigations() {

        return new Promise((resolve, reject) => {

            API.get('/navigation')
                .then(res => {

                    if (res?.status === 200) {

                        console.log(res.data);

                        store.commit({
                            type: 'navigation/SET_NAVIGATIONS',
                            navigations: res.data,
                        })

                        resolve()

                    }

                })

        })

    },
    getMenu(menuID) {

        if (isNaN(menuID)) return false

        const navigation = store.getters['navigation/getNavigations']

        if (navigation.length === 0) return false

        let fullMenu = [];

        navigation.forEach(menu => {

            if (menu.ID === parseInt(menuID)) {
                if (typeof menu?.post_content === 'string') {
                    const menuString = menu.post_content
                    const parser = new DOMParser()
                    
                    try {

                        const dom = parser.parseFromString(menuString, 'text/html')

                        const menuItems = dom.body.children

                        if (menuItems.length > 0) {

                            for (let item of menuItems) {

                                const menuItem = extractMenuItem(item);

                                if (menuItem) {

                                    fullMenu.push(menuItem)
                                }
                            }
                        }
                    } catch (error) {

                        return false
                    }
                }
            }
        });

        if(fullMenu.length===0) {
            fullMenu = [
                {
                    route: '/',
                    label: 'Home'
                }
            ]
        }

        return fullMenu

    },

}

export default Navigation