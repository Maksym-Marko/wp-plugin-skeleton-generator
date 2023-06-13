import { useBlockProps } from '@wordpress/block-editor'

export default function save({ attributes }) {

	const blockProps = useBlockProps.save()

	return (
		<div
			{...blockProps}
			className={'mx-responsive-block-spacer ' + attributes.unique_class}
		>
			<style>
				{'.' + attributes.unique_class + '{height:' + attributes.media_default + 'px;}'}

				{/* @media 1500 */}
				{
					attributes.media_1500 !== '' &&
					`@media (max-width: 1500px) {
							.${attributes.unique_class} {
								height: ${attributes.media_1500}px;
							}
						}
						`
				}

				{/* @media 1220 */}
				{
					attributes.media_1220 !== '' &&
					`@media (max-width: 1220px) {
							.${attributes.unique_class} {
								height: ${attributes.media_1220}px;
							}
						}
						`
				}

				{/* @media 992 */}
				{
					attributes.media_992 !== '' &&
					`@media (max-width: 992px) {
							.${attributes.unique_class} {
								height: ${attributes.media_992}px;
							}
						}
						`
				}

				{/* @media 768 */}
				{
					attributes.media_768 !== '' &&
					`@media (max-width: 768px) {
							.${attributes.unique_class} {
								height: ${attributes.media_768}px;
							}
						}
						`
				}
			</style>
		</div>
	);
}