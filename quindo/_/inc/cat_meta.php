<?php

// Source:
// https://en.bainternet.info/wordpress-category-extra-fields/
//add extra fields to category edit form hook
function quindo_extra_category_fields( $tag ) {    //check for existing featured ID
    $t_id = $tag->term_id;
    $cat_color = get_option( "category_color_" . $t_id);
    ?>
    <tr class="form-field">
        <th scope="row" valign="top"><label for="cat_color"><?php _e('Category Color'); ?></label></th>
        <td>
            <input type="color" name="cat_color" id="cat_color" size="3" style="width:60%;" value="<?php echo $cat_color ? $cat_color : '#ff0000'; ?>"><br />
            <p class="description"><?php _e('The background color used when displaying the category name'); ?></p>
        </td>
    </tr>
    <?php
}
add_action ( 'edit_category_form_fields', 'quindo_extra_category_fields');

// save extra category extra fields callback function
function quindo_save_extra_category_fields( $term_id ) {
    if ( isset( $_POST['cat_color'] ) ) {
        if ($_POST['cat_color']){
            $cat_meta = $_POST['cat_color'];
        }
        update_option( "category_color_" . $term_id, $cat_meta );
    }
}
add_action ( 'edited_category', 'quindo_save_extra_category_fields');