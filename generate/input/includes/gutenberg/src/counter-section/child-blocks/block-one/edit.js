import { __ } from '@wordpress/i18n';
import metadata from './block.json';
import { useBlockProps } from '@wordpress/block-editor';
import { SelectControl, Placeholder, TextControl, __experimentalNumberControl as NumberControl } from '@wordpress/components';
import './editor.scss';

export default function edit({ attributes, isSelected, setAttributes }) {
	const blockProps = useBlockProps()
	return <div  {...blockProps}>
		{attributes.number && !isSelected ? (
			<></>
		) :
			(
				<>

					<Placeholder
						label="Set icon"
						instructions="Please set icon"
					>
						<SelectControl
							onChange={(icon) => setAttributes({ icon })}
							__nextHasNoMarginBottom
							value={attributes.icon}
							options={[
								{
									disabled: true,
									label: 'Select Position'
								},
								{
									label: 'Check',
									value: 'fa-check'
								},
								{
									label: 'User Plus',
									value: 'fa-user-plus'
								},
								{
									label: 'Users',
									value: 'fa-users'
								},
								{
									label: 'Car',
									value: 'fa-car'
								}
							]}
						/>
					</Placeholder>

					<Placeholder
						label="Set Count"
						instructions="Please set count"
					>
						<NumberControl
							label={__('Number', '|uniquestring|-domain')}
							value={attributes.number}
							onChange={(val) => {
								setAttributes({ number: val })
							}}
							step="1"
							min="0"
							max="1000000"
						/>
					</Placeholder>
					
					<Placeholder
						label="Set Label"
						instructions="Please set label"
					>
						<TextControl
							label={__('Label', '|uniquestring|-domain')}
							value={attributes.label}
							onChange={(val) => {
								setAttributes({ label: val })
							}}
						/>
					</Placeholder>
				</>

			)
		}

		<div
			className="text-center wow fadeIn mx-counter-item" data-wow-delay="0.1s"
		>
			<i className={'fa ' + attributes.icon + ' fa-2x text-white mb-3'}></i>

			<h2 className="text-white mb-2" data-toggle="counter-up">{attributes.number}</h2>

			<p className="text-white mb-0">{attributes.label}</p>
		</div>

	</div>

}
