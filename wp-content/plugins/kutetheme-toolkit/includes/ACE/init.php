<?php

class KT_ACE_EDITER{
    public function __construct(){
        add_action('admin_enqueue_scripts', array( $this,'enqueue_scripts'));
        add_action( 'cmb2_render_ace_editer_css', array($this,'cmb2_render_callback_for_ace_editer_css'), 10, 5 );
        add_filter( 'cmb2_sanitize_ace_editer_css',array($this,'cmb2_sanitize_ace_editer_css_callback'), 10, 2 );

        add_action( 'cmb2_render_ace_editer_js', array($this,'cmb2_render_callback_for_ace_editer_js'), 10, 5 );
        add_filter( 'cmb2_sanitize_ace_editer_js', array($this,'cmb2_sanitize_ace_editer_js_callback'), 10, 2 );
    }

    function enqueue_scripts(){
        wp_enqueue_style( 'kt-ace_editer', plugin_dir_url( __FILE__ ). 'ace/style.css', array() );
        wp_enqueue_script( 'kt-ace_editer', plugin_dir_url( __FILE__ ). 'ace/src-noconflict/ace.js');
    }
    function cmb2_render_callback_for_ace_editer_css( $field, $escaped_value, $object_id, $object_type, $field_type_object ) {
        $id = $field_type_object->_id();
        $name = $field_type_object->_name();
        $ace_editer_id = 'ace-editor-'.$id;
        ?>
        <div class="ace_editer_wapper">
            <textarea name="<?php echo esc_attr( $name);?>" id="<?php echo esc_attr( $id);?>"><?php echo $escaped_value;?></textarea>
            <div class="ace-editer" id="<?php echo esc_attr( $ace_editer_id );?>"><?php echo $escaped_value;?></div>
        </div>
        <style type="text/css" media="screen">
        <?php echo "#".$ace_editer_id;?> {
            margin: 0;
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
        }
        </style>
        <script>
        var textarea_<?php echo $id;?> = jQuery("#<?php echo $id; ?>");
        var editor_<?php echo $id;?> = ace.edit("<?php echo $ace_editer_id ;?>");
            editor_<?php echo $id;?>.setTheme("ace/theme/twilight");
            editor_<?php echo $id;?>.session.setMode("ace/mode/css");
            editor_<?php echo $id;?>.getSession().on('change', function () {
               textarea_<?php echo $id;?>.val(editor_<?php echo $id;?>.getSession().getValue());
           });
        </script>
        <?php
    }
    function cmb2_sanitize_ace_editer_css_callback( $override_value, $value ) {
        return $value;
    }


    function cmb2_render_callback_for_ace_editer_js( $field, $escaped_value, $object_id, $object_type, $field_type_object ) {
        if( $escaped_value == ""){
            $escaped_value = "jQuery(function($){

});";
        }

        $id = $field_type_object->_id();
        $name = $field_type_object->_name();
        $ace_editer_id = 'ace-editor-'.$id;
        ?>
        <div class="ace_editer_wapper">
            <textarea name="<?php echo esc_attr( $name);?>" id="<?php echo esc_attr( $id);?>"><?php echo $escaped_value;?></textarea>
            <div class="ace-editer" id="<?php echo esc_attr( $ace_editer_id );?>"><?php echo $escaped_value;?></div>
        </div>
        <style type="text/css" media="screen">
        <?php echo "#".$ace_editer_id;?> {
            margin: 0;
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
        }
        </style>
        <script>
        var textarea_<?php echo $id;?> = jQuery("#<?php echo $id; ?>");
        var editor_<?php echo $id;?> = ace.edit("<?php echo $ace_editer_id ;?>");
            editor_<?php echo $id;?>.setTheme("ace/theme/twilight");
            editor_<?php echo $id;?>.session.setMode("ace/mode/javascript");
            editor_<?php echo $id;?>.getSession().on('change', function () {
               textarea_<?php echo $id;?>.val(editor_<?php echo $id;?>.getSession().getValue());
           });
        </script>
        <?php
    }

    function cmb2_sanitize_ace_editer_js_callback( $override_value, $value ) {
        
        return $value;
    }
}

new KT_ACE_EDITER;
