import { useBlockProps, InnerBlocks } from '@wordpress/block-editor'

export default function save({ attributes }) {
	const blockProps = useBlockProps.save()

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

	};

	return <div
		{...blockProps}
		style={style()}
	>
		<div
			className="|uniquestring|-full-width-inner"
			data-image-id={attributes.mediaBGId}
			data-image-url={attributes.mediaBGUrl}
		>
			<InnerBlocks.Content />
		</div>
	</div>
}
