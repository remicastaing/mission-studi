<?php

require_once('identifiant.php');
require_once('textInput.php');
require_once('selectInput.php');
require_once('dateInput.php');
require_once('textArea.php');

class Form
{

    protected $fields = null;
    protected $action = false;


    public function __construct($_fields, $_action = false)
    {
        $this->fields = $_fields;
        $this->action = $_action;
    }


    public function __toString()
    {
        $action = $this->action ? "action='$this->action?action=create'" : "";
        $res = "<form method='post' $action>";
        foreach ($this->fields as $field) {
            $res .= $field;
        }
        $res .= '<div class="d-grid gap-2 d-md-flex justify-content-md-end">' .
            '<button id="enregistrer" type="submit" class="btn btn-dark">Enregistrer</button>' .
            '</div>';
        return $res . "</form>";
    }


    public function isset()
    {
        $res = true;
        $data = new stdClass;

        foreach ($this->fields as $field) {
            $res &= isset($_POST[$field->name]);
        }
        if (!$res) {
            return false;
        }

        foreach ($this->fields as $field) {
            $name = $field->name;
            $data->$name = $_POST[$name];
        }

        return $data;
    }


    public function fill($data)
    {
        foreach ($this->fields as &$field) {
            $name = $field->name;
            $field->value = property_exists($data, $name) ? $data->$name : null;
        }
    }
}
