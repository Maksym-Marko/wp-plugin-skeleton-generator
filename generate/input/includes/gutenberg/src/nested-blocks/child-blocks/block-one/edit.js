import { __ } from '@wordpress/i18n';
import metadata from './block.json';
import { useBlockProps } from '@wordpress/block-editor';
import { Placeholder, TextControl } from '@wordpress/components';
import './editor.scss';

export default function edit({ attributes, isSelected, setAttributes }) {
	const blockProps = useBlockProps()
	return (
		<div  {...blockProps}>
			{attributes.message && !isSelected ? (
				<></>
			) :
				(
					<Placeholder
						label={metadata.title}
						instructions={metadata.description}
					>
						<TextControl
							label={__('Message', 'wp-plugin-skeleton')}
							value={attributes.message}
							onChange={(val) => setAttributes({ message: val })}
						/>
					</Placeholder>
				)
			}

			{attributes.message ? (
				<div data-number={attributes.number} data-size={attributes.size}>{attributes.message}</div>
			) : (
				<div>No Message</div>
			)}

		</div>
	);
}
