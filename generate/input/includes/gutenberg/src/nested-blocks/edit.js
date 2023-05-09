import { __ } from '@wordpress/i18n';
import metadata from './block.json';
import { useBlockProps, InnerBlocks } from '@wordpress/block-editor';
import { Placeholder, TextControl } from '@wordpress/components';
import './editor.scss';

export default function edit({ attributes, isSelected, setAttributes }) {
	const blockProps = useBlockProps()
	const ALLOWED_BLOCKS = [ '|uniquestring|/nested-blocks-child-blocks-block-one' ];
	return (
		<div  {...blockProps}>
			<InnerBlocks allowedBlocks={ ALLOWED_BLOCKS } />
		</div>
	);
}
