export const extractMenuItem = (domElement) => {

    const a = domElement.querySelector('a')

    let menuItem = false

    if (a !== null) {

        menuItem = {}

        menuItem.label = a.innerText
        menuItem.route = a.getAttribute('href')

        // TODO
        // Extract route from href

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
