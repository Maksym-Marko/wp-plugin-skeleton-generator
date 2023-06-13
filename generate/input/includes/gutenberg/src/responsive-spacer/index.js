import { registerBlockType } from '@wordpress/blocks';
import metadata from './block.json';
import './style.scss';
import Edit from './edit';
import save from './save';

registerBlockType(metadata.name, {

	icon: {
		src: <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" width="24" height="24" aria-hidden="true" focusable="false"><path d="M12.5 4.2v1.6h4.7L5.8 17.2V12H4.2v7.8H12v-1.6H6.8L18.2 6.8v4.7h1.6V4.2z"></path></svg>
	},

	/**
	 * @see ./edit.js
	 */
	edit: Edit,

	/**
	 * @see ./save.js
	 */
	save,
});