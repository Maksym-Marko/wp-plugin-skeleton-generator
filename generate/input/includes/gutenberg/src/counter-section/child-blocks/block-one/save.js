import { useBlockProps } from '@wordpress/block-editor'

export default function save({ attributes }) {
	const blockProps = useBlockProps.save()
	return <div
		className="col-md-6 col-lg-3 text-center wow fadeIn mx-counter-item" data-wow-delay="0.1s"
	>
		<div {...blockProps}>
			<i
				className={'fa ' + attributes.icon + ' fa-2x text-white mb-3'}
				data-icon-key={attributes.icon}
			></i>
			<h2 className="text-white mb-2" data-toggle="counter-up">{attributes.number}</h2>
			<p className="text-white mb-0">{attributes.label}</p>
		</div>
	</div>
}
