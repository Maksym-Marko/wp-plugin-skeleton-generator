import './assets/scss/style.scss'

import { helloWorld } from './features/helloWorld'
import { block } from './components/vue2/block'
import { button } from './components/vue2/button'
import { getPages } from './features/getPages'

; (function ($) {
    $(function () {

        /**
         * Get Pages Example
         */
        getPages()
            .then( res => {
                if(res.status === 200) {
                    console.log(res.data);
                }
            } );

        /**
         * Features
         */
        helloWorld.init();

        /**
         * Vue 2 Example
         */
        if (document.getElementById('mxtps_app')) {

            // Block component.
			Vue.component('mxtps_block', block);

            // Button component.
			Vue.component('mxtps_button', button);

            // Run the app
            new Vue({
                el: '#mxtps_app',
                data: {
                    open: false
                },
                methods: {
                    toggle() {
                        this.open = !this.open;
                    }
                }
            });
        }

    });
})(jQuery);
