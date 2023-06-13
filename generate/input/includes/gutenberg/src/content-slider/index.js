import { registerBlockType } from '@wordpress/blocks';
import metadata from './block.json';
import './style.scss';
import edit from './edit';
import save from './save';

registerBlockType(metadata.name, {
	/**
	 * @see ./edit.js
	 */
	edit,

	/**
	 * @see ./save.js
	 */
	save,
});
