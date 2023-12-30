; (function ($) {
    $(function () {
		// JS Script.
		if (document.getElementById('|uniquestring|_app')) {

			// Block component.
			Vue.component('|uniquestring|_block', {
				props: {
					open: {
						type: Boolean,
						required: true
					}
				},
				template: `
					<div>
						I am {{open ? 'opened' : 'closed'}}
					</div>
				`
			});

			// Button component.
			Vue.component('|uniquestring|_button', {
				props: {
					open: {
						type: Boolean,
						required: true
					}
				},
				template: `
					<div>
						<button
							type="button"
							@click="$emit('toggle')"
						>{{open ? 'Close' : 'Open'}}</button>
					</div>
				`
			});
			
			// Run the app.
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