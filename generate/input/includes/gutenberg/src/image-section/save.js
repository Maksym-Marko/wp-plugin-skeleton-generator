import { useBlockProps, RichText } from '@wordpress/block-editor'

export default function save({ attributes }) {
	const blockProps = useBlockProps.save()

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

	return <div
		style={style()}
		data-image-id={attributes.mediaId}
		data-image-url={attributes.mediaUrl}
		data-bg-position={attributes.bgPosition}
		data-bg-alignment={attributes.testAlignment}
		className="mxImageSection"
	>
		<div
			{...blockProps}
		>
			<RichText.Content
				tagName="p"
				value={attributes.text}
			/>
		</div>
	</div>
}
