export const extractMenuItem = (domElement) => {

    const a = domElement.querySelector('a')

    let menuItem = false

    if (a !== null) {

        menuItem = {}

        menuItem.label = a.innerText
        menuItem.route = '/'
        const href = a.getAttribute('href')        

        const pattern = new RegExp(`${import.meta.env.VITE_API_BASE_URL}\/(.*)\/$`)

        const route = href.match(pattern)

        if (!route) return false

        menuItem.route = route[1]

        const subMenu = domElement.querySelector('ul')

        if (subMenu !== null) {

            const subMenuItems = subMenu.children

            if (subMenuItems.length > 0) {

                menuItem.children = []

                for (let item of subMenuItems) {

                    const subMenuItem = extractMenuItem(item);

                    if (subMenuItem) {

                        menuItem.children.push(subMenuItem)
                    }
                }

            }

        }
    }

    return menuItem
}
