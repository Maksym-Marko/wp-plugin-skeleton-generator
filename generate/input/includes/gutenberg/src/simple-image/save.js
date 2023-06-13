import { useBlockProps } from '@wordpress/block-editor'

export default function save({ attributes }) {
	const blockProps = useBlockProps.save()

	return <div {...blockProps}>
		<img src={attributes.mediaUrl} data-image-id={attributes.mediaId} />
	</div>
}
