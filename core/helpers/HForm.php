<?php
class HForm{
    /**
     * Open a form
     * @param Form $form
     * @return string
     */
    public static function open(Form $form){
        $name = get_class($form);
        $name = str_replace('Form', '', $name);
        $output =& Core::get_instance()->loader->get('Output');
        $output->addHeaderInc(Assets::js(array('form', 'ajax')));
        $output->addFooterInc('<script type="text/javascript">'.PHP_EOL.$form->getScript().PHP_EOL.'</script>');
        return '<form action="'.$form->url().'"  onsubmit="return formManager.validateForm(\''.$name.'\', this);">';
    }

    /**
     * close a form tag
     * @return string
     */
    public static function close(){
        return '</form>';
    }

    /**
     * add a new submit button
     * @param string $value
     * @return string
     */
    public static function submit($value){
        return '<input type="submit" value="'.$value.'"/>';
    }

    /**
     * Create a new input tag
     * @param string $type
     * @param string $name
     * @param string $pattern
     * @param bool $required
     * @param array $others
     * @return string
     */
    public static function input($type, $name, array $attributes = array(), $ajax_validation = false){
        $tag = '<input type="'.$type.'" name="'.$name.'" id="'.$name.'" ';
        foreach($attributes as $attr=>$value){
            if(is_numeric($attr)){
                $tag.=' '.$value;
                continue;
            }
            $tag.=' '.$attr.'="'.$value.'"';
        }

        return $tag.' />';
    }

    /**
     * Set a label for $obj
     * @param mixed $obj
     * @param string $text
     */
    public static function label($obj, $text = ''){
        $label = '<label for="';
        if(class_exists('AbstractInput') && $obj instanceof AbstractInput){
            $label.=$obj->getName().'">';
            $text = $obj->label;
        }else{
            $label.=$obj.'">';
        }

        $label.=$text.'</label>';

        return $label;
    }

    /**
     * Error tag
     * @param AbstractInput $obj
     */
    public static function error(AbstractInput $obj){
        return '<div id="'.$obj->getName().'Error" class="formError" style="display: inline-block"></div>';
    }
}
