import { __ } from '@wordpress/i18n';
import metadata from './block.json';
import { useBlockProps, InnerBlocks, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, PanelRow, __experimentalNumberControl as NumberControl } from '@wordpress/components';
import './editor.scss';

export default function edit({ attributes, setAttributes }) {
	const blockProps = useBlockProps()

	return [
		<InspectorControls key="mx-settings">

			<PanelBody title={__('Autoplay speed', 'heebos')} initialOpen={false}>

				<PanelRow>

					<NumberControl
						label={__('Speed in seconds', 'gutenpride')}
						value={attributes.autoplay}
						min="0"
						onChange={(speed) => setAttributes({
							autoplay: speed
						})}
					/>

				</PanelRow>

			</PanelBody>

		</InspectorControls>,
		<div
			{...blockProps}
			key="mx-main-content"
			data-autoplay-speed={attributes.autoplay}
		>
			<InnerBlocks />
		</div>
	];
}
