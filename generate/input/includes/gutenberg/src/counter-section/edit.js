import { __ } from '@wordpress/i18n';
import metadata from './block.json';
import { useBlockProps, InnerBlocks, MediaUpload, MediaUploadCheck, InspectorControls, } from '@wordpress/block-editor';
import { Placeholder, Button, Panel, PanelBody, PanelRow, SelectControl } from '@wordpress/components';
import { useSelect } from '@wordpress/data';
import { useEffect } from '@wordpress/element';
import './editor.scss';

export default function edit({ attributes, isSelected, setAttributes }) {
	const blockProps = useBlockProps()
	const ALLOWED_BLOCKS = ['|uniquestring|/counter-section-child-blocks-block-one'];
	const ALLOWED_MEDIA_TYPES = ['image']

	const imageData = useSelect((select) => {
		if (attributes.mediaId) {
			return select('core').getEntityRecord('postType', 'attachment', attributes.mediaId);

		} else {
			return false
		}
	}, [attributes]);

	useEffect(() => {
		if (imageData?.media_details) {
			setAttributes({
				mediaUrl: imageData.media_details.sizes.full.source_url
			})
		}
	}, [imageData])

	const style = () => {

		let styleObj = {}

		if (attributes?.mediaUrl) {

			styleObj.background = 'linear-gradient(rgba(0, 0, 0, .7), rgba(0, 0, 0, .7)), url("' + attributes.mediaUrl + '")';


		}

		return styleObj

	}

	return [
		<InspectorControls key="mx-settings">

			<Panel header="Background Image">

				<PanelBody title="Set a background image" initialOpen={true}>
					<PanelRow>
						<MediaUploadCheck>
							<MediaUpload
								onSelect={(media) => setAttributes({
									mediaId: media.id
								})}
								allowedTypes={ALLOWED_MEDIA_TYPES}
								value={attributes.mediaId}
								render={({ open }) => (
									<Button
										icon="upload"
										text={attributes.mediaId ? 'Change Image' : 'Upload Image'}
										variant="secondary"
										onClick={open}
									/>
								)}
							/>
						</MediaUploadCheck>
					</PanelRow>
				</PanelBody>
			</Panel>
		</InspectorControls>,

		<div
			{...blockProps}
			key="mx-main-content"
		>
			<div
				className="mx-counter-block mxImageSection"
				data-image-id={attributes.mediaId}
				data-image-url={attributes.mediaUrl}
			>
				<div className="container-fluid fact bg-dark py-5" style={style()}>
					<div className="container">
						<div className="row g-4">
							<InnerBlocks
								allowedBlocks={ALLOWED_BLOCKS}
								orientation="horizontal"
							/>
						</div>
					</div>
				</div>
			</div>
		</div>
	]
}
