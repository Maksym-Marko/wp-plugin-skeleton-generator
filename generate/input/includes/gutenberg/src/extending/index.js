import { addFilter } from '@wordpress/hooks'
import { createHigherOrderComponent } from '@wordpress/compose'
import { Fragment } from '@wordpress/element'
import { InspectorControls } from '@wordpress/block-editor'
import { PanelBody, TextareaControl } from '@wordpress/components'

/**
 * Callback for the BlockEdit filter
 */
const withInspectorControls = createHigherOrderComponent((BlockEdit) => {
    return (props) => {
        if (props.name !== 'core/paragraph' && props.name !== 'core/heading' && props.name !== 'core/button') {
            return (
                <BlockEdit {...props} />
            )
        }

        const { attributes, setAttributes } = props

        const clean_prompt = (string) => {
            return string.replace(/[^A-Za-z0-9-_ .,?]/gi, '');
        }

        return (
            <Fragment>
                <BlockEdit {...props} />
                <InspectorControls>
                    <PanelBody title="Prompt" initialOpen={ false }>
                        <TextareaControl
                            help="Enter a prompt for this element"
                            value={attributes.extendedSettings.prompt ? attributes.extendedSettings.prompt : ''}
                            onChange={(prompt) => {
                                prompt = clean_prompt(prompt);
                                setAttributes({ extendedSettings: { ...attributes.extendedSettings, prompt } })
                            }}
                        />
                    </PanelBody>
                </InspectorControls>
            </Fragment>
        );
    }
}, 'withInspectorControls')

/**
 * Hook into registerBlockType to add our custom prop
 */
addFilter(
    'blocks.registerBlockType',
    'extending-gutenberg/add-attributes',
    (props, name) => {
        if (name !== 'core/paragraph' && name !== 'core/heading' && name !== 'core/button') {
            return props
        }

        const attributes = {
            ...props.attributes,
            extendedSettings: {
                type: 'object',
                default: {},
            }
        }

        return { ...props, attributes }
    }
)

/**
 * Hook into BlockEdit to add our custom inspector controls
 */
addFilter(
    'editor.BlockEdit',
    'extending-gutenberg/edit',
    withInspectorControls
)