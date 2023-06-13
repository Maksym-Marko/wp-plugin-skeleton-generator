import { __ } from '@wordpress/i18n';
import metadata from './block.json';
import { useBlockProps, InnerBlocks, InspectorControls, MediaUpload, MediaUploadCheck } from '@wordpress/block-editor';
import { PanelBody, PanelRow, Button } from '@wordpress/components';
import { useSelect } from '@wordpress/data';
import { useEffect } from '@wordpress/element';
import './editor.scss';

export default function edit({ attributes, setAttributes }) {
	const blockProps = useBlockProps()

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
		>
			<div
				className="|uniquestring|-full-width-inner"
				data-image-id={attributes.mediaBGId}
				data-image-url={attributes.mediaBGUrl}
			>
				<InnerBlocks />
			</div>
		</div>
	];
}
