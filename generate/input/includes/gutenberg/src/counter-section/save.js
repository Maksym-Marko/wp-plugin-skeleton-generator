import { useBlockProps, InnerBlocks } from '@wordpress/block-editor'

export default function save({ attributes }) {
	const blockProps = useBlockProps.save()

	const style = () => {

		let styleObj = {}

		if (attributes?.mediaUrl) {

			styleObj.background = 'linear-gradient(rgba(0, 0, 0, .7), rgba(0, 0, 0, .7)), url("' + attributes.mediaUrl + '")';

		}

		return styleObj

	}

	return <div {...blockProps}>
		<div
			className="mx-counter-block mxImageSection"
			data-image-id={attributes.mediaId}
			data-image-url={attributes.mediaUrl}
		>
			<div className="container-fluid fact bg-dark py-5 test" style={style()}>
				<div className="container">
					<div className="row g-4">
						<InnerBlocks.Content />
					</div>
				</div>
			</div>
		</div>
	</div>
}
