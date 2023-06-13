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
		data-image-id={attributes.mediaBGId}
		data-image-url={attributes.mediaBGUrl}
		data-image-to-right={attributes.imageToRight}
	>

		<div className="wp-block-|uniquestring|-full-width-section-image--image-wrapper">

			<img src={attributes.sideImageUrl} data-side-image-id={attributes.sideImageId} alt="" className="mx-side-img" />

		</div>

		<div className="wp-block-|uniquestring|-full-width-section-image--content-wrapper">
			<div className="wp-block-|uniquestring|-full-width-section-image--text">
				<InnerBlocks.Content />
			</div>
		</div>

	</div>

}
