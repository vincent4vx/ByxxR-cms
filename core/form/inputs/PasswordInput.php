<?php
class PasswordInput extends AbstractInput{
    protected function defaultPattern() {
        return '.+';
    }

    public function __toString() {
        return HForm::input('password', $this->name, $this->attributes, true);
    }
}
