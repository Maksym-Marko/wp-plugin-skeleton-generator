<?php

// Exit if accessed directly.
if (!defined('ABSPATH')) exit;

/**
 * The |UNIQUESTRING|MetaboxesGenerator class.
 *
 * This Class helps add Metaboxes to any CPT.
 */
class |UNIQUESTRING|MetaboxesGenerator
{

    private $args = [];

    private $defaults = [];

    public function __construct($args)
    {

        $this->defaults = [
            'id'           => 'mx-extra-metabox-1',
            'post_types'   => 'page', // ['page', 'post']
            'name'         => esc_html('Extra metabox 1', 'wp-plugin-skeleton'),
            'metabox_type' => 'input-text',
            'options'  => []
        ];

        $this->args = wp_parse_args($args, $this->defaults);

        if (is_array($this->args['post_types'])) {

            $this->args['metabox_id'] = $this->args['id'] . '_' . implode('_',  $this->args['post_types']);
        } else {

            $this->args['metabox_id'] = $this->args['id'] . '_' . $this->args['post_types'];
        }

        $this->args['post_meta_key'] = '_mx_' . $this->args['metabox_id'] . '_id';
        $this->args['nonce_action']  = $this->args['metabox_id'] . '_nonce_action';
        $this->args['nonce_name']    = $this->args['metabox_id'] . '_nonce_name';

        // Add options area.
        if ($this->args['metabox_type'] == 'checkbox') {

            $i = 0;

            foreach ($this->args['options'] as $key => $value) {

                $this->args['options'][$key]['name'] = $this->args['post_meta_key'] . $i;

                $i++;
            }
        }

        add_action('add_meta_boxes', [$this, 'addMetaBox']);

        add_action('save_post', [$this, 'saveMetaBox']);
    }

    // Add post meta.
    public function addMetaBox()
    {

        add_meta_box(
            $this->args['metabox_id'],
            $this->args['name'],
            [$this, 'metaBoxContent'],
            $this->args['post_types'],
            'normal' // 'low'
        );
    }

    // Save post meta.
    public function saveMetaBox($post_id)
    {

        if (!isset($_POST[$this->args['nonce_name']]) || !wp_verify_nonce(wp_unslash($_POST[$this->args['nonce_name']]), $this->args['nonce_action'])) {
            return;
        }

        if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        $value = '';

        if (isset($_POST) && isset($_POST[$this->args['post_meta_key']])) {

            if ($this->args['metabox_type'] == 'input-email') {

                // Email field.
                $value = sanitize_email(wp_unslash($_POST[$this->args['post_meta_key']]));
            } elseif ($this->args['metabox_type'] == 'input-url') {

                // Url field.
                $value = esc_url_raw($_POST[$this->args['post_meta_key']]);
            } elseif ($this->args['metabox_type'] == 'textarea') {

                // Textarea field.
                $value = sanitize_textarea_field($_POST[$this->args['post_meta_key']]);
            } elseif ($this->args['metabox_type'] == 'image') {

                // Image id.
                $value = sanitize_text_field($_POST[$this->args['post_meta_key']]);
            } elseif ($this->args['metabox_type'] == 'radio') {

                // Radio value.
                $value = sanitize_text_field($_POST[$this->args['post_meta_key']]);
            } elseif ($this->args['metabox_type'] == 'select') {

                // Select value.
                $value = sanitize_text_field($_POST[$this->args['post_meta_key']]);
            } elseif ($this->args['metabox_type'] == 'checkbox') {

                $_value = null;

                // Checkbox value.
                foreach ($this->args['options'] as $key => $val) {

                    if (isset($_POST[$val['name']])) {
                        $_value = sanitize_text_field($_POST[$val['name']]);
                    }

                    // Save data.
                    update_post_meta($post_id, $val['name'], $_value);
                }

                // Checkbox marker.
                $value = sanitize_text_field($_POST[$this->args['post_meta_key']]);
            } else {

                // Input text.
                $value = sanitize_text_field(wp_unslash($_POST[$this->args['post_meta_key']]));
            }
        }

        // Save data.
        update_post_meta($post_id, $this->args['post_meta_key'], $value);
    }

    // Metabox content.
    public function metaBoxContent($post, $meta)
    {

        $metaValue = get_post_meta(
            $post->ID,
            $this->args['post_meta_key'],
            true
        ); ?>

        <div>
            <label for="<?php echo esc_attr($this->args['post_meta_key']); ?>"></label>

            <?php if ($this->args['metabox_type'] == 'input-email') : ?>

                <!-- Email field. -->
                <input type="email" id="<?php echo esc_attr($this->args['post_meta_key']); ?>" name="<?php echo esc_attr($this->args['post_meta_key']); ?>" value="<?php echo $metaValue; ?>" />

            <?php elseif ($this->args['metabox_type'] == 'input-url') : ?>

                <!-- Url field. -->
                <input type="url" id="<?php echo esc_attr($this->args['post_meta_key']); ?>" name="<?php echo esc_attr($this->args['post_meta_key']); ?>" value="<?php echo $metaValue; ?>" />

            <?php elseif ($this->args['metabox_type'] == 'textarea') : ?>

                <!-- Textarea field. -->
                <textarea name="<?php echo esc_attr($this->args['post_meta_key']); ?>" id="<?php echo esc_attr($this->args['post_meta_key']); ?>" cols="30" rows="10"><?php echo $metaValue; ?></textarea>

            <?php elseif ($this->args['metabox_type'] == 'image') : ?>

                <?php $image_url = ''; ?>

                <?php if ($metaValue !== '') : ?>

                    <?php $image_url = wp_get_attachment_url($metaValue); ?>

                <?php endif; ?>

                <!-- Image upload. -->
                <div class="mx-image-uploader">

                    <button class="|uniquestring|_upload_image" <?php echo $image_url !== '' ? 'style="display: none;"' : ''; ?>>Choose image</button>

                    <!-- Save an image id. -->
                    <input name="<?php echo esc_attr($this->args['post_meta_key']); ?>" id="<?php echo esc_attr($this->args['post_meta_key']); ?>" type="hidden" class="|uniquestring|_upload_image_save" value="<?php echo esc_html($metaValue); ?>" />

                    <!-- Show an image. -->
                    <img src="<?php echo $image_url !== '' ? esc_url($image_url) : ''; ?>" style="width: 300px;" alt="" class="|uniquestring|_upload_image_show" <?php echo $image_url == '' ? 'style="display: none;"' : ''; ?> />

                    <!-- Remove image. -->
                    <a href="#" class="|uniquestring|_upload_image_remove" <?php echo $image_url == '' ? 'style="display: none;"' : ''; ?>>Remove Image</a>

                </div>

            <?php elseif ($this->args['metabox_type'] == 'radio') : ?>

                <?php if (count($this->args['options']) == 0) : ?>
                    <p>You have to add some options to the "Options" array!</p>
                <?php else : ?>

                    <?php if (is_array($this->args['options'])) : ?>

                        <?php $i = 0; ?>

                        <?php foreach ($this->args['options'] as $key => $val) : ?>

                            <?php if (isset($val['value'])) : ?>

                                <div>
                                    <input 
                                        type="radio" 
                                        name="<?php echo esc_attr($this->args['post_meta_key']); ?>" 
                                        id="<?php echo esc_attr($this->args['post_meta_key']) . $i; ?>" 
                                        value="<?php echo esc_html($val['value']); ?>" 
                                        <?php if ($metaValue == '') : ?> 
                                            <?php echo isset($val['checked']) && $val['checked'] == true  ? 'checked' : ''; ?> 
                                        <?php else : ?> 
                                            <?php echo $metaValue == $val['value'] ? 'checked' : ''; ?> 
                                        <?php endif; ?>
                                    />
                                    <label
                                        for="<?php echo esc_attr($this->args['post_meta_key']) . $i; ?>"
                                    >
                                        <?php if (isset($val['label'])) : ?>
                                            <?php echo esc_html($val['label']); ?>
                                        <?php else : ?>
                                            <?php echo esc_html($val['value']); ?>
                                        <?php endif; ?>
                                    </label>
                                </div>

                                <?php $i++; ?>

                            <?php endif; ?>

                        <?php endforeach; ?>

                    <?php endif; ?>

                <?php endif; ?>

            <?php elseif ($this->args['metabox_type'] == 'select') : ?>

                <?php if (count($this->args['options']) == 0) : ?>
                    <p>You have to add some options to the "options" array!</p>
                <?php else : ?>

                    <?php if (is_array($this->args['options'])) : ?>

                        <label for="<?php echo esc_attr($this->args['post_meta_key']); ?>"><?php echo esc_attr($this->args['name']); ?></label>
                        <select name="<?php echo esc_attr($this->args['post_meta_key']); ?>" id="<?php echo esc_attr($this->args['post_meta_key']); ?>">

                            <option>---</option>

                            <?php foreach ($this->args['options'] as $key => $val) : ?>

                                <?php if (isset($val['value'])) : ?>

                                    <option 
                                        value="<?php echo $val['value']; ?>" 
                                        <?php if ($metaValue == '') : ?> 
                                            <?php echo isset($val['selected']) && $val['selected'] == true  ? 'selected' : ''; ?> 
                                        <?php else : ?>
                                            <?php echo $metaValue == $val['value'] ? 'selected' : ''; ?>
                                        <?php endif; ?>
                                    >
                                        <?php if (isset($val['label'])) : ?>
                                            <?php echo esc_html($val['label']); ?>
                                        <?php else : ?>
                                            <?php echo esc_html($val['value']); ?>
                                        <?php endif; ?>
                                    </option>

                                <?php endif; ?>

                            <?php endforeach; ?>

                        </select>

                    <?php endif; ?>

                <?php endif; ?>

            <?php elseif ($this->args['metabox_type'] == 'checkbox') : ?>

                <?php if (count($this->args['options']) == 0) : ?>

                    <p>You have to add some options to the "Options" array!</p>
                    
                <?php else : ?>

                    <?php if (is_array($this->args['options'])) : ?>

                        <input type="hidden" name="<?php echo esc_attr($this->args['post_meta_key']); ?>" value="checkbox-type" />

                        <?php $i = 0; ?>

                        <?php foreach ($this->args['options'] as $key => $val) : ?>

                            <?php if (isset($val['value'])) : ?>

                                <?php $checkboxValue = get_post_meta($post->ID, $val['name'], true); ?>

                                <div>
                                    <input 
                                        type="checkbox"
                                        name="<?php echo esc_attr($val['name']); ?>"
                                        id="<?php echo esc_attr($val['name']); ?>"
                                        value="<?php echo $val['value']; ?>"
                                        <?php if (!$metaValue) : ?>
                                            <?php echo isset($val['checked']) && $val['checked'] == true  ? 'checked' : ''; ?>
                                        <?php else : ?>
                                            <?php echo $val['value'] == $checkboxValue  ? 'checked' : ''; ?>
                                        <?php endif; ?>
                                    />
                                    <label for="<?php echo esc_attr($val['name']); ?>">
                                        <?php if (isset($val['label'])) : ?>
                                            <?php echo esc_html($val['label']); ?>
                                        <?php else : ?>
                                            <?php echo esc_html($val['value']); ?>
                                        <?php endif; ?>
                                    </label>
                                </div>

                                <?php $i++; ?>

                            <?php endif; ?>

                        <?php endforeach; ?>

                    <?php endif; ?>

                <?php endif; ?>

            <?php else : ?>

                <!-- Input text. -->
                <input type="text" id="<?php echo esc_attr($this->args['post_meta_key']); ?>" name="<?php echo esc_attr($this->args['post_meta_key']); ?>" value="<?php echo $metaValue; ?>" />

            <?php endif; ?>

        </div>

<?php wp_nonce_field($this->args['nonce_action'], $this->args['nonce_name'], true, true);
    }
}
