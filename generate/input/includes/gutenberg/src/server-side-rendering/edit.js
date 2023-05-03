import { __ } from '@wordpress/i18n';
import { useBlockProps } from '@wordpress/block-editor';
import ServerSideRender from '@wordpress/server-side-render';
import { __experimentalNumberControl as NumberControl } from '@wordpress/components';
import './editor.scss';
import metadata from './block.json';

export default function Edit( {attributes, setAttributes} ) {

	const blockProps = useBlockProps();	

	const onChangeNumber = ( number ) => {
		setAttributes( { postsNumber: number } );		
	};
		
	return (
		<div {...blockProps}>
			<NumberControl
				label={__('Number of posts', 'gutenpride')}
				value={attributes.postsNumber}
				onChange={onChangeNumber}
			/>
			<ServerSideRender
				block={ metadata.name }
				attributes={ attributes }
			/>
		</div>
	);
}
