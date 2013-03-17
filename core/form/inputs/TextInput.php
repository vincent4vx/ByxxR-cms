<?php
class TextInput extends AbstractInput{
    public function __toString() {
        return HForm::input('text', $this->name, $this->pattern);
    }
}
