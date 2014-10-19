<?php
/**
 *
 * $HeadURL: http://plugins.svn.wordpress.org/types/trunk/embedded/common/toolset-forms/classes/class.checkbox.php $
 * $LastChangedDate: 2014-09-18 09:37:16 +0000 (Thu, 18 Sep 2014) $
 * $LastChangedRevision: 992466 $
 * $LastChangedBy: brucepearson $
 *
 */
require_once 'class.field_factory.php';

/**
 * Description of class
 *
 * @author Srdjan
 */
class WPToolset_Field_Checkbox extends FieldFactory
{
    public function metaform()
    {
        global $post;
        $value = $this->getValue();
        $data = $this->getData();
        $checked = null;

        /**
         * autocheck for new posts
         */
        if (isset($post) && 'auto-draft' == $post->post_status && array_key_exists( 'checked', $data ) && $data['checked']) {
            $checked = true;
        }
        /**
         * is checked?
         */
        if ( isset($data['options']) && array_key_exists( 'checked', $data['options'] ) ) {
            $checked = $data['options']['checked'];
        }
        if ( array_key_exists('default_value', $data) && $value == $data['default_value'] ) {
            $checked = true;
        }
        
        // Comment out broken code. This tries to set the previous state after validation fails
        //if (!$checked&&$this->getValue()==1) {
        //    $checked=true;
        //}

        /**
         * metaform
         */
        $form = array(
            '#type' => 'checkbox',
            '#value' => $value,
            '#default_value' => array_key_exists( 'default_value', $data )? $data['default_value']:null,
            '#name' => $this->getName(),
            '#description' => $this->getDescription(),
            '#title' => $this->getTitle(),
            '#validate' => $this->getValidationData(),
            '#after' => '<input type="hidden" name="_wptoolset_checkbox[' . $this->getId() . ']" value="1" />',
            '#checked' => $checked,
            '#repetitive' => $this->isRepetitive(),
        );
        return array($form);
    }
}
