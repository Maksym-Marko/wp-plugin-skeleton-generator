import { registerBlockType } from '@wordpress/blocks';
import metadata from './block.json';
import './style.scss';
import Edit from './edit';
import save from './save';

registerBlockType(metadata.name, {
	/**
	 * @see ./edit.js
	 */
	edit: Edit,

	/**
	 * @see ./save.js
	 */
	save,
});
