import { useBlockProps, InnerBlocks } from '@wordpress/block-editor'

export default function save({ attributes }) {
	const blockProps = useBlockProps.save()

	return <div
		{...blockProps}
		data-autoplay-speed={attributes.autoplay}
	>
		<InnerBlocks.Content />
	</div>
}
