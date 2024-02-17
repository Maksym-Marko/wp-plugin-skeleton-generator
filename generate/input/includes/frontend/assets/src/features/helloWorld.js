$ = jQuery;

/**
 * Hello World Component.
 */
export const helloWorld = window.helloWorld || {

    container: 'a.hello-world',

    bindClick: function () {

        if ($(this.container).length === 0) return;

        const _this = this;

        $(this.container).on('click', (e) => {

            e.preventDefault();

            console.log('Hello, World!');
        });

    },

    init: function () {

        this.bindClick();

    }

};