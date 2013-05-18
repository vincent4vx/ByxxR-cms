<?php
class AjaxController extends Controller{
    public function validateformAction($name){
        $name = str_replace(array('.', '/'), '', $name);
        $form =& $this->loader->loadForm($name);
        exit(json_encode($form->validate()));
    }
}
