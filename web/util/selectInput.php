<?php

class SelectInput
{
    public $name = null;
    public $value = null;
    protected $label = null;
    protected $choix = null;
    protected $multiple = "";


    public function __construct($name, $value, $label, $choix, $col = '=', $multiple = false)
    {
        $this->name = $name;
        $this->value =  $value;
        $this->label = $label;
        $this->choix = $choix;
        $this->col = $col == '=' ? $name : $col;
        $this->multiple = $multiple ? "multiple" : "";
    }


    public function __toString()
    {
        $col = $this->col;
        $name = $this->multiple ? $this->name . "[]" : $this->name;
        $res =  '<div class="form-group row mb-3" id="'.$this->name.'">' .
            '<label class="col-sm-2 col-form-label">' . $this->label . '</label>' .
            '<div class="col-sm-10">' .
            "<select name='$name' $this->multiple class='form-select'  required>";


        foreach ($this->choix as $choix) {

            $selected = '';
            $value = $choix->id;
            $text = $choix->$col;

            if ($this->multiple == 'multiple') {
                $selected = $this->value ? (in_array($value, $this->value) ? "selected='selected'" : '') : "";
            } else {
                $selected = $this->value == $value ? "selected='selected'" : "";
            }
 
            $res .= "<option value='$value' $selected>$text</option>";
        }

        $res .= "</select>" .
                '<div id="validationServer03Feedback" class="invalid-feedback">
                Il manque un agent qualifié (***).
                </div>'.
            '</div>' .
            '</div>';

        return $res;
    }
}
