<?php
/**
 * Term Customized
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

/**
 * Attachment Fileds To Edit
 *
 * @param object $form_fields Form Fields.
 * @param array  $post Post.
 * @return object
 */
function mode_attachment_fields_to_edit( $form_fields, $post ) {
	$field_value             = get_post_meta( $post->ID, 'link_url', true );
	$form_fields['link_url'] = array(
		'input' => 'text',
		'value' => $field_value ? $field_value : '',
		'label' => __( 'Link' ),
		'helps' => __( 'Link to the image. (Only the header image is valid)', 'welcart_mode' ),
	);
	return $form_fields;
}
add_filter( 'attachment_fields_to_edit', 'mode_attachment_fields_to_edit', 10, 2 );

/**
 * Attachment Fields To Save
 *
 * @param array  $post Post.
 * @param object $attachment Attachment.
 * @return object
 */
function mode_attachment_fields_to_save( $post, $attachment ) {
	if ( isset( $attachment['link_url'] ) ) {
		update_post_meta( $post['ID'], 'link_url', $attachment['link_url'] );
	}
	return $post;
}
add_filter( 'attachment_fields_to_save', 'mode_attachment_fields_to_save', 10, 2 );

/**
 * Add Term Fields
 *
 * @return void
 */
function mode_add_term_fields() {
	?>

	<div class="form-field">
		<label for="name_eng"><?php esc_html_e( 'Name (Eng)', 'welcart_mode' ); ?></label>
		<input type="text" name="name_eng" id="name_eng" value="" size="40">
		<p><?php esc_html_e( 'Please enter the category name in English.', 'welcart_mode' ); ?></p>
	</div>

	<div class="form-field category-image-uploader new-form-field">
		<label for="category-img"><?php esc_html_e( 'Image', 'welcart_mode' ); ?></label>
		<p class="thumbnail-form">
			<input name="category-img-url" id="category-img-url" type="text" value="">
			<button type="button" class="button upload-button" id="category-img-action"><?php esc_html_e( 'Select Image', 'welcart_mode' ); ?></button>
		</p>
		<p id="category-img-preview"  class="category-img-preview"></p>
		<input name="category-img-id" id="category-img-id" type="hidden" value="">
	</div>

	<div class="form-field category-thumbnail-uploader new-form-field">
		<label for="category-thumbnail"><?php esc_html_e( 'Thumbnail', 'welcart_mode' ); ?></label>
		<p class="thumbnail-form">
			<input name="category-thumbnail-url" id="category-thumbnail-url" type="text" value="">
			<button type="button" class="button upload-button" id="category-thumbnail-action"><?php esc_html_e( 'Select Image', 'welcart_mode' ); ?></button>
		</p>
		<p id="category-thumbnail-preview"  class="category-thumbnail-preview"></p>
		<input name="category-thumbnail-id" id="category-thumbnail-id" type="hidden" value="">
	</div>

	<?php
}
add_action( 'category_add_form_fields', 'mode_add_term_fields' );

/**
 * Edit Term Fields
 *
 * @param string $tag Tag.
 * @return void
 */
function mode_edit_term_fields( $tag ) {

	$category_img_url       = get_term_meta( $tag->term_id, 'category-img-url', true );
	$category_img_id        = get_term_meta( $tag->term_id, 'category-img-id', true );
	$category_thumbnail_url = get_term_meta( $tag->term_id, 'category-thumbnail-url', true );
	$category_thumbnail_id  = get_term_meta( $tag->term_id, 'category-thumbnail-id', true );

	$value = get_term_meta( $tag->term_id, 'name_eng', 1 );

	?>
	<tr class="form-field">
		<th><label for="name_eng"><?php esc_html_e( 'Name (Eng)', 'welcart_mode' ); ?></label></th>
		<td>
			<input type="text" name="name_eng" id="name_eng" size="40" value="<?php echo esc_attr( $value ); ?>">
			<p class="description"><?php esc_html_e( 'Please enter the category name in English.', 'welcart_mode' ); ?></p>
		</td>
	</tr>
	<tr class="form-field category-image-uploader edit-form-field">
		<th scope="row" valign="top"><label for="category-img"><?php esc_html_e( 'Image', 'welcart_mode' ); ?></label></th>
		<td>
			<p class="category-img-form">
				<input name="category-img-url" id="category-img-url" type="text" value="<?php echo esc_attr( $category_img_url ); ?>">
				<button type="button" class="button upload-button" id="category-img-action"><?php esc_html_e( 'Select Image', 'welcart_mode' ); ?></button>
			</p>
			<p id="category-img-preview" class="category-img-preview">
			<?php
			if ( ! empty( $category_img_url ) ) {
				echo '<img src="' . esc_url( $category_img_url ) . '" />';}
			?>
			</p>
			<input name="category-img-id" id="category-img-id" type="hidden" value="<?php echo esc_attr( $category_img_id ); ?>">
		</td>
	</tr>
	<tr class="form-field category-thumbnail-uploader edit-form-field">
		<th scope="row" valign="top"><label for="category-thumbnail"><?php esc_html_e( 'Thumbnail', 'welcart_mode' ); ?></label></th>
		<td>
			<p class="category-thumbnail-form">
				<input name="category-thumbnail-url" id="category-thumbnail-url" type="text" value="<?php echo esc_attr( $category_thumbnail_url ); ?>">
				<button type="button" class="button upload-button" id="category-thumbnail-action"><?php esc_html_e( 'Select Image', 'welcart_mode' ); ?></button>
			</p>
			<p id="category-thumbnail-preview" class="category-thumbnail-preview">
			<?php
			if ( ! empty( $category_thumbnail_url ) ) {
				echo '<img src="' . esc_url( $category_thumbnail_url ) . '" />';}
			?>
			</p>
			<input name="category-thumbnail-id" id="category-thumbnail-id" type="hidden" value="<?php echo esc_attr( $category_thumbnail_id ); ?>">
		</td>
	</tr>

	<?php
}
add_action( 'category_edit_form_fields', 'mode_edit_term_fields' );

/**
 * Save Term Fields
 *
 * @param int $term_id Term ID.
 * @return void
 */
function mode_save_terms( $term_id ) {
	if ( array_key_exists( 'name_eng', $_POST ) ) {
		update_term_meta( $term_id, 'name_eng', $_POST['name_eng'] );
	}
}
add_action( 'create_term', 'mode_save_terms' );
add_action( 'edit_terms', 'mode_save_terms' );

/**
 * Category Update Term Meta
 *
 * @param int $term_id Term ID.
 * @return void
 */
function category_update_term_meta( $term_id ) {
	if ( isset( $_POST['category-img-url'] ) ) {
		$category_img_url = trim( $_POST['category-img-url'] );
		$category_img_id  = (int) $_POST['category-img-id'];
		if ( empty( $category_img_url ) ) {
			$category_img_id = '';
		}
			update_term_meta( $term_id, 'category-img-url', esc_url( $category_img_url ) );
			update_term_meta( $term_id, 'category-img-id', $category_img_id );
	}
	if ( isset( $_POST['category-thumbnail-url'] ) ) {
		$category_thumbnail_url = trim( $_POST['category-thumbnail-url'] );
		$category_thumbnail_id  = (int) $_POST['category-thumbnail-id'];
		if ( empty( $category_thumbnail_url ) ) {
			$category_thumbnail_id = '';
		}
			update_term_meta( $term_id, 'category-thumbnail-url', esc_url( $category_thumbnail_url ) );
			update_term_meta( $term_id, 'category-thumbnail-id', $category_thumbnail_id );
	}
}
add_action( 'created_category', 'category_update_term_meta' );
add_action( 'edited_category', 'category_update_term_meta' );

/**
 * The Model Add Term Fields
 *
 * @return void
 */
function mode_model_add_term_fields() {
	?>
	<div class="form-field model-image-uploader new-form-field">
		<label for="model-img"><?php esc_html_e( 'Image', 'welcart_mode' ); ?></label>
		<p class="thumbnail-form">
			<input name="model-img-url" id="model-img-url" type="text" value="">
			<button type="button" class="button upload-button" id="model-img-action"><?php esc_html_e( 'Select Image', 'welcart_mode' ); ?></button>
		</p>
		<p id="model-img-preview"  class="model-img-preview"></p>
		<input name="model-img-id" id="model-img-id" type="hidden" value="">
	</div>
	<div class="form-field">
		<label for="model_height"><?php esc_html_e( 'Height (cm)', 'welcart_mode' ); ?></label>
		<input type="text" name="model_height" id="model_height" value="" size="40">
		<p><?php esc_html_e( 'Please enter the model height.', 'welcart_mode' ); ?></p>
	</div>
	<div class="form-field">
		<div class="field-label"><?php esc_html_e( 'Type', 'welcart_mode' ); ?></div>
		<label for="model_men">
			<input type="radio" name="model_type" id="model_men" value="Men"><?php esc_html_e( 'Men', 'welcart_mode' ); ?>
		</label>
		<label for="model_women">
			<input type="radio" name="model_type" id="model_women" value="Women"><?php esc_html_e( 'Women', 'welcart_mode' ); ?>
		</label>
		<label for="model_kid">
			<input type="radio" name="model_type" id="model_kid" value="Kid"><?php esc_html_e( 'Kid', 'welcart_mode' ); ?>
		</label>
		<p><?php esc_html_e( 'Please select the model type.', 'welcart_mode' ); ?></p>
	</div>
	<?php
}
add_action( 'model_add_form_fields', 'mode_model_add_term_fields' );

/**
 * The Model Edit Term Fields
 *
 * @param string $tag Tag.
 * @return void
 */
function mode_model_edit_term_fields( $tag ) {

	$model_img_url = get_term_meta( $tag->term_id, 'model-img-url', true );
	$model_img_id  = get_term_meta( $tag->term_id, 'model-img-id', true );

	$height_value = get_term_meta( $tag->term_id, 'model_height', 1 );
	$type_value   = get_term_meta( $tag->term_id, 'model_type', 1 );

	?>
	<tr class="form-field model-image-uploader edit-form-field">
		<th scope="row" valign="top"><label for="model-img"><?php esc_html_e( 'Image', 'welcart_mode' ); ?></label></th>
		<td>
			<p class="model-img-form">
				<input name="model-img-url" id="model-img-url" type="text" value="<?php echo esc_attr( $model_img_url ); ?>">
				<button type="button" class="button upload-button" id="model-img-action"><?php esc_html_e( 'Select Image' ); ?></button>
			</p>
			<p id="model-img-preview" class="model-img-preview">
			<?php
			if ( ! empty( $model_img_url ) ) {
				echo '<img src="' . esc_url( $model_img_url ) . '" />';}
			?>
			</p>
			<input name="model-img-id" id="model-img-id" type="hidden" value="<?php echo esc_url( $model_img_id ); ?>">
		</td>
	</tr>

	<tr class="form-field">
		<th><label for="model_height"><?php esc_html_e( 'Height (cm)', 'welcart_mode' ); ?></label></th>
		<td>
			<input type="text" name="model_height" id="model_height" size="40" value="<?php echo esc_url( $height_value ); ?>">
			<p class="description"><?php esc_html_e( 'Please enter the model height.', 'welcart_mode' ); ?></p>
		</td>
	</tr>
	<tr class="form-field">
		<th><?php esc_html_e( 'Type', 'welcart_mode' ); ?></th>
		<td>
			<label for="model_men">
				<?php
				if ( 'Men' === $type_value ) {
					echo '<input type="radio" name="model_type" id="model_men" value="Men" checked="checked">';
				} else {
					echo '<input type="radio" name="model_type" id="model_men" value="Men">';
				}
				?>
				<?php esc_html_e( 'Men', 'welcart_mode' ); ?>
			</label>
			<label for="model_women">
				<?php
				if ( 'Women' === $type_value ) {
					echo '<input type="radio" name="model_type" id="model_women" value="Women" checked="checked">';
				} else {
					echo '<input type="radio" name="model_type" id="model_women" value="Women">';
				}
				?>
				<?php esc_html_e( 'Women', 'welcart_mode' ); ?>
			</label>
			<label for="model_kid">
				<?php
				if ( 'Kid' === $type_value ) {
					echo '<input type="radio" name="model_type" id="model_kid" value="Kid" checked="checked">';
				} else {
					echo '<input type="radio" name="model_type" id="model_kid" value="Kid">';
				}
				?>
				<?php esc_html_e( 'Kid', 'welcart_mode' ); ?>
			</label>
			<p><?php esc_html_e( 'Please select the model type.', 'welcart_mode' ); ?></p>
		</td>
	</tr>
	<?php
}
add_action( 'model_edit_form_fields', 'mode_model_edit_term_fields' );

/**
 * The Model Saves Terms
 *
 * @param int $term_id Term ID.
 * @return void
 */
function mode_model_save_terms( $term_id ) {
	if ( array_key_exists( 'model_height', $_POST ) ) {
		update_term_meta( $term_id, 'model_height', $_POST['model_height'] );
	}
	if ( array_key_exists( 'model_type', $_POST ) ) {
		update_term_meta( $term_id, 'model_type', $_POST['model_type'] );
	}
}
add_action( 'create_term', 'mode_model_save_terms' );
add_action( 'edit_terms', 'mode_model_save_terms' );

/**
 * The Model Update Term Meta
 *
 * @param int $term_id Term ID.
 * @return void
 */
function model_update_term_meta( $term_id ) {
	if ( isset( $_POST['model-img-url'] ) ) {

		$model_img_url = trim( $_POST['model-img-url'] );
		$model_img_id  = (int) $_POST['model-img-id'];
		if ( empty( $model_img_url ) ) {
			$model_img_id = '';
		}
			update_term_meta( $term_id, 'model-img-url', esc_url( $model_img_url ) );
			update_term_meta( $term_id, 'model-img-id', $model_img_id );

	}
}
add_action( 'created_model', 'model_update_term_meta' );
add_action( 'edited_model', 'model_update_term_meta' );

/*
 * model_add_form_fields.
 * 「ブランド」の新規追加エリアにフィールドを追加
 */
/**
 * The Brand Adds Term Fields
 *
 * @return void
 */
function mode_brand_add_term_fields() {

	?>
	<div class="form-field">
		<label for="name_eng"><?php esc_html_e( 'Read', 'welcart_mode' ); ?></label>
		<input type="text" name="name_sub" id="name_sub" value="" size="40">
		<p><?php esc_html_e( 'Please enter how to read the brand name.', 'welcart_mode' ); ?></p>
	</div>
	<div class="form-field brand-image-uploader new-form-field">
		<label for="brand-img"><?php esc_html_e( 'Image' ); ?></label>
		<p class="thumbnail-form">
			<input name="brand-img-url" id="brand-img-url" type="text" value="">
			<button type="button" class="button upload-button" id="brand-img-action"><?php esc_html_e( 'Select Image' ); ?></button>
		</p>
		<p id="brand-img-preview"  class="brand-img-preview"></p>
		<input name="brand-img-id" id="brand-img-id" type="hidden" value="">
	</div>
	<?php
}
add_action( 'brand_add_form_fields', 'mode_brand_add_term_fields' );

/**
 * The Brand Edits Term Fields
 *
 * @param string $tag Tag.
 * @return void
 */
function mode_brand_edit_term_fields( $tag ) {

	$brand_img_url = get_term_meta( $tag->term_id, 'brand-img-url', true );
	$brand_img_id  = get_term_meta( $tag->term_id, 'brand-img-id', true );

	$name_sub_value = get_term_meta( $tag->term_id, 'name_sub', 1 );
	?>
	<tr class="form-field">
		<th><label for="name_hurigana"><?php esc_html_e( 'Read', 'welcart_mode' ); ?></label></th>
		<td>
			<input type="text" name="name_sub" id="name_sub" size="40" value="<?php echo esc_attr( $name_sub_value ); ?>">
			<p class="description"><?php esc_html_e( 'Please enter how to read the brand name.', 'welcart_mode' ); ?></p>
		</td>
	</tr>
	<tr class="form-field brand-image-uploader edit-form-field">
		<th scope="row" valign="top"><label for="brand-img"><?php esc_html_e( 'Image', 'welcart_mode' ); ?></label></th>
		<td>
			<p class="brand-img-form">
				<input name="brand-img-url" id="brand-img-url" type="text" value="<?php echo esc_attr( $brand_img_url ); ?>">
				<button type="button" class="button upload-button" id="brand-img-action"><?php esc_html_e( 'Select Image', 'welcart_mode' ); ?></button>
			</p>
			<p id="brand-img-preview" class="brand-img-preview">
			<?php
			if ( ! empty( $brand_img_url ) ) {
				echo '<img src="' . esc_url( $brand_img_url ) . '" />';}
			?>
			</p>
			<input name="brand-img-id" id="brand-img-id" type="hidden" value="<?php echo esc_attr( $brand_img_id ); ?>">
		</td>
	</tr>
	<?php
}
add_action( 'brand_edit_form_fields', 'mode_brand_edit_term_fields' );

/**
 * The Brand Updates Term Meta
 *
 * @param int $term_id Term ID.
 * @return void
 */
function brand_update_term_meta( $term_id ) {

	if ( array_key_exists( 'name_sub', $_POST ) ) {
		update_term_meta( $term_id, 'name_sub', $_POST['name_sub'] );
	}

	if ( isset( $_POST['brand-img-url'] ) ) {
		$brand_img_url = trim( $_POST['brand-img-url'] );
		$brand_img_id  = (int) $_POST['brand-img-id'];
		if ( empty( $brand_img_url ) ) {
			$brand_img_id = '';
		}
		update_term_meta( $term_id, 'brand-img-url', esc_url( $brand_img_url ) );
		update_term_meta( $term_id, 'brand-img-id', $brand_img_id );
	}
}
add_action( 'created_brand', 'brand_update_term_meta' );
add_action( 'edited_brand', 'brand_update_term_meta' );

/**
 * Admin Footer
 *
 * @return void
 */
function mode_admin_footer() {
	?>

<script type="text/javascript">

	( function( $ ) {

		var file_frame;

		/* 1. taxonomy = 'category' */
		$('#category-img-action').on( 'click', function(e) {
			e.preventDefault();

			if ( file_frame ) {
				file_frame.open();
				return;
			}
			file_frame = wp.media.frames.file_frame = wp.media( {
				title: '<?php esc_html_e( 'Image', 'welcart_mode' ); ?>',
				library: {
					type: 'image',
				},
				button: {
					text: '<?php esc_html_e( 'Select Image', 'welcart_mode' ); ?>',
					close: true
				},
				multiple: false
			} );

			var file_frame;

			file_frame.on( 'select', function() {
				var attachment = file_frame.state().get('selection').first().toJSON();
				$("#category-img-url").val(attachment.url);
				$("#category-img-id").val(attachment.id);
				$('#category-img-preview').html('<img src="'+attachment.url+'" />');
			} );

			file_frame.open();

		} );

		$('#category-thumbnail-action').on( 'click', function(e) {
			e.preventDefault();

			if ( file_frame ) {
				file_frame.open();
				return;
			}
			file_frame = wp.media.frames.file_frame = wp.media( {
				title: '<?php esc_html_e( 'Thumbnail', 'welcart_mode' ); ?>',
				library: {
					type: 'image',
				},
				button: {
					text: '<?php esc_html_e( 'Select Image', 'welcart_mode' ); ?>',
					close: true
				},
				multiple: false
			} );

			file_frame.on( 'select', function() {
				var attachment = file_frame.state().get('selection').first().toJSON();
				$("#category-thumbnail-url").val(attachment.url);
				$("#category-thumbnail-id").val(attachment.id);
				$('#category-thumbnail-preview').html('<img src="'+attachment.url+'" />');
			} );

			file_frame.open();

		} );

		/* 2. taxonomy = 'model' */
		$('#model-img-action').on( 'click', function(e) {
			e.preventDefault();

			if ( file_frame ) {
				file_frame.open();
				return;
			}
			file_frame = wp.media.frames.file_frame = wp.media( {
				title: '<?php esc_html_e( 'Image', 'welcart_mode' ); ?>',
				library: {
					type: 'image',
				},
				button: {
					text: '<?php esc_html_e( 'Select Image', 'welcart_mode' ); ?>',
					close: true
				},
				multiple: false
			} );

			file_frame.on( 'select', function() {
				var attachment = file_frame.state().get('selection').first().toJSON();
				$("#model-img-url").val(attachment.url);
				$("#model-img-id").val(attachment.id);
				$('#model-img-preview').html('<img src="'+attachment.url+'" />');
			} );

			file_frame.open();

		} );

		/* 3. taxonomy = 'brand' */
		$('#brand-img-action').on( 'click', function(e) {
			e.preventDefault();

			if ( file_frame ) {
				file_frame.open();
				return;
			}
			file_frame = wp.media.frames.file_frame = wp.media( {
				title: '<?php esc_html_e( 'Image', 'welcart_mode' ); ?>',
				library: {
					type: 'image',
				},
				button: {
					text: '<?php esc_html_e( 'Select Image', 'welcart_mode' ); ?>',
					close: true
				},
				multiple: false
			} );

			file_frame.on( 'select', function() {
				var attachment = file_frame.state().get('selection').first().toJSON();
				$("#brand-img-url").val(attachment.url);
				$("#brand-img-id").val(attachment.id);
				$('#brand-img-preview').html('<img src="'+attachment.url+'" />');
			} );

			file_frame.open();

		} );

	})(jQuery);
</script>
	<?php
}
add_action( 'admin_footer-term.php', 'mode_admin_footer' );
add_action( 'admin_footer-edit-tags.php', 'mode_admin_footer' );
