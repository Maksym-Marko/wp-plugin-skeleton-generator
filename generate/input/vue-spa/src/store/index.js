import { createStore } from 'vuex'
import pages from "@/store/modules/Pages"
import notify from "@/store/modules/Notify"
import system from "@/store/modules/System"
import navigation from "@/store/modules/Navigation"

const store = createStore( {    
    modules: {
        notify,
        pages,
        system,
        navigation
    }
} )

export default store