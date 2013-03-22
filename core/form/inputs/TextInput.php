<?php
class TextInput extends AbstractInput{
    protected function defaultPattern() {
        return '.+';
    }
    public function __toString() {
        return HForm::input('text', $this->name, $this->attributes, true);
    }
}
