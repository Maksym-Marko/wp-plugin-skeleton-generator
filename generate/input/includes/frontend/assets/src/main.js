import './assets/css/style.css'

import { helloWorld } from './features/helloWorld'
import { block } from './components/vue2/block'
import { button } from './components/vue2/button'

; (function ($) {
    $(function () {

        /**
         * Features
         */
        helloWorld.init();

        /**
         * Vue 2 Example
         */
        if (document.getElementById('|uniquestring|_app')) {

            // Block component.
			Vue.component('|uniquestring|_block', block);

            // Button component.
			Vue.component('|uniquestring|_button', button);

            // Run the app
            new Vue({
                el: '#|uniquestring|_app',
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
