import { __ } from '@wordpress/i18n';
import metadata from './block.json';
import { useBlockProps, MediaUpload, MediaUploadCheck } from '@wordpress/block-editor';
import { Placeholder, Button } from '@wordpress/components';
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

	return (
		<div {...blockProps}>

			{isSelected && (
				<Placeholder
					label={metadata.title}
					instructions={metadata.description}
				>

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

				</Placeholder>
			)}

			{attributes.mediaId && attributes?.mediaUrl ? (

				<img src={attributes.mediaUrl} id={attributes.mediaId} />

			) : (<h3>No image attached!</h3>)}

		</div>
	);
}
