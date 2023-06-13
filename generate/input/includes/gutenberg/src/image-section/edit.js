import { __ } from '@wordpress/i18n';
import metadata from './block.json';
import { useBlockProps, MediaUpload, MediaUploadCheck, InspectorControls, RichText } from '@wordpress/block-editor';
import { Placeholder, Button, Panel, PanelBody, PanelRow, SelectControl } from '@wordpress/components';
import { useSelect } from '@wordpress/data';
import { useEffect } from '@wordpress/element';
import './editor.scss';

export default function edit({ attributes, isSelected, setAttributes }) {
	const blockProps = useBlockProps()
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

		let styleObj = {
			backgroundPosition: attributes.bgPosition,
			textAlign: attributes.testAlignment
		}

		if (attributes?.mediaUrl) {

			styleObj.backgroundImage = 'url("' + attributes.mediaUrl + '")'

		}

		return styleObj

	}

	return ([

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

				<PanelBody title="Set background position" initialOpen={true}>
					<PanelRow>
						<SelectControl
							onChange={(bgPosition) => setAttributes({ bgPosition })}
							__nextHasNoMarginBottom
							value={attributes.bgPosition}
							options={[
								{
									disabled: true,
									label: 'Select Position'
								},
								{
									label: 'Center',
									value: 'center'
								},
								{
									label: 'Top',
									value: 'top'
								},
								{
									label: 'Right',
									value: 'right'
								},
								{
									label: 'Bottom',
									value: 'bottom'
								},
								{
									label: 'Left',
									value: 'left'
								}
							]}
						/>
					</PanelRow>
				</PanelBody>

				<PanelBody title="Text Alignment" initialOpen={true}>
					<PanelRow>
						<SelectControl
							onChange={(testAlignment) => setAttributes({ testAlignment })}
							__nextHasNoMarginBottom
							value={attributes.testAlignment}
							options={[
								{
									disabled: true,
									label: 'Select Position'
								},
								{
									label: 'Left',
									value: 'left'
								},
								{
									label: 'Center',
									value: 'center'
								},
								{
									label: 'Right',
									value: 'right'
								}
							]}
						/>
					</PanelRow>
				</PanelBody>

			</Panel>

		</InspectorControls>,

		<div
			style={style()}
			key="mx-main-content"
			data-image-id={attributes.mediaId}
			data-image-url={attributes.mediaUrl}
			data-bg-position={attributes.bgPosition}
			data-bg-alignment={attributes.testAlignment}
			className="mxImageSection"
		>
			<div
				{...blockProps}
			>

				{isSelected && (
					<Placeholder
						label={metadata.title}
						instructions={metadata.description}
					>

						<RichText
							tagName="p"
							onChange={(text) => setAttributes({ text })}
							value={attributes.text}
						/>

					</Placeholder>
				)}
				{attributes.text}

			</div>
		</div>



	]);
}
