import { __ } from '@wordpress/i18n';
import metadata from './block.json';
import { useBlockProps, InnerBlocks, InspectorControls, MediaUpload, MediaUploadCheck } from '@wordpress/block-editor';
import { PanelBody, PanelRow, Button, CheckboxControl } from '@wordpress/components';
import { useSelect } from '@wordpress/data';
import { useEffect, useState } from '@wordpress/element';
import './editor.scss';

export default function edit({ attributes, setAttributes }) {
	const blockProps = useBlockProps()
	const [isImageToRight, setImageToRight] = useState(false)

	const ALLOWED_MEDIA_TYPES = ['image']

	// BG image 
	const imageBGData = useSelect((select) => {
		if (attributes.mediaBGId) {
			return select('core').getEntityRecord('postType', 'attachment', attributes.mediaBGId);

		} else {
			return false
		}
	}, [attributes]);

	useEffect(() => {
		if (imageBGData?.media_details) {
			setAttributes({
				mediaBGUrl: imageBGData.media_details.sizes.full.source_url
			})
		}
	}, [imageBGData]);

	// side image
	const sideImageData = useSelect((select) => {
		if (attributes.sideImageId) {
			return select('core').getEntityRecord('postType', 'attachment', attributes.sideImageId);

		} else {
			return false
		}
	}, [attributes]);

	useEffect(() => {
		if (sideImageData?.media_details) {
			setAttributes({
				sideImageUrl: sideImageData.media_details.sizes.full.source_url
			})
		}
	}, [sideImageData]);

	// style
	const style = () => {

		let styleObj = {}

		if (attributes?.style) {
			styleObj.backgroundColor = attributes.style.color?.background
			styleObj.color = attributes.style.color?.text
		}

		if (attributes?.mediaBGUrl) {

			styleObj.backgroundImage = 'url("' + attributes.mediaBGUrl + '")'

		}

		return styleObj

	}

	return [
		<InspectorControls key="mx-settings">

			<PanelBody title={__('Side Image', 'heebos')} initialOpen={true}>

				<PanelRow>
					<MediaUploadCheck>

						<div className='mx-media-button-wrapper'>

							{
								attributes?.sideImageUrl ?
									(<div className="|uniquestring|-cover-image-wrapper">
										<img src={attributes.sideImageUrl} />
										<Button
											icon="trash"
											text={__('Remove', 'heebos')}
											isDestructive
											onClick={() => {
												setAttributes({
													sideImageUrl: null,
													sideImageId: null
												})
											}}
										/>
									</div>) :
									(<></>)
							}
							<MediaUpload
								onSelect={(sideImageMedia) => setAttributes({
									sideImageId: sideImageMedia.id
								})}
								allowedTypes={ALLOWED_MEDIA_TYPES}
								value={attributes.sideImageId}
								render={({ open }) => (
									<Button
										icon="upload"
										text={attributes.sideImageId ? 'Change Background Image' : 'Upload Background Image'}
										variant="secondary"
										onClick={open}
									/>
								)}
							/>

						</div>

					</MediaUploadCheck>
				</PanelRow>

				<PanelRow>
					<CheckboxControl
						label="Image to right"
						help="Image to right?"
						checked={attributes.imageToRight === '1' ? true : false}
						onChange={(toRight) => setAttributes({
							imageToRight: toRight ? '1' : '0'
						})}
					/>
				</PanelRow>

			</PanelBody>

			<PanelBody title={__('Background Image', 'heebos')} initialOpen={false}>

				<PanelRow>
					<MediaUploadCheck>

						<div className='mx-media-button-wrapper'>

							{
								attributes?.mediaBGUrl ?
									(<div className="|uniquestring|-cover-image-wrapper">
										<img src={attributes.mediaBGUrl} />
										<Button
											icon="trash"
											text={__('Remove', 'heebos')}
											isDestructive
											onClick={() => {
												setAttributes({
													mediaBGUrl: null,
													mediaBGId: null
												})
											}}
										/>
									</div>) :
									(<></>)
							}
							<MediaUpload
								onSelect={(mediaBG) => setAttributes({
									mediaBGId: mediaBG.id
								})}
								allowedTypes={ALLOWED_MEDIA_TYPES}
								value={attributes.mediaBGId}
								render={({ open }) => (
									<Button
										icon="upload"
										text={attributes.mediaBGId ? 'Change Background Image' : 'Upload Background Image'}
										variant="secondary"
										onClick={open}
									/>
								)}
							/>

						</div>

					</MediaUploadCheck>
				</PanelRow>

			</PanelBody>

		</InspectorControls>,
		<div
			key="mx-main-content"
			{...blockProps}
			style={style()}
			data-image-id={attributes.mediaBGId}
			data-image-url={attributes.mediaBGUrl}
			data-image-to-right={attributes.imageToRight}
		>

			<div className="wp-block-|uniquestring|-full-width-section-image--image-wrapper">

				<img src={attributes.sideImageUrl} data-side-image-id={attributes.sideImageId} alt="" className="mx-side-img" />

			</div>

			<div className="wp-block-|uniquestring|-full-width-section-image--content-wrapper">
				<div className="wp-block-|uniquestring|-full-width-section-image--text">
					<InnerBlocks />
				</div>
			</div>

		</div>
	];
}
