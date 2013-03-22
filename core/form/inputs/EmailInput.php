<?php
class EmailInput extends AbstractInput{
    protected function defaultPattern() {
        return '[a-zA-A0-9\._-]+@[a-zA-A0-9\._-]+\.[a-zA-Z]{2,4}';
    }

    public function __toString() {
        return HForm::input('password', $this->name, $this->attributes, true);
    }
}