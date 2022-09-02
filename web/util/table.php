<?php


class Table
{
    private $objets;
    private $colonnes;
    private $lien_ligne;
    private $class;

    public function __construct($objets, $colonnes, $lien_ligne = '', $class = 'table-dark')
    {
        $this->objets = $objets;
        $this->colonnes = $colonnes;
        $this->lien_ligne = $lien_ligne;
        $this->class = $class;
    }


    public function __toString()
    {

        $table =
            "<table class='table table-striped table-hover $this->class w-100'>
    <thead>
        <tr>";

        foreach ($this->colonnes as $colonne) {
            $table .= "<th scope='col'>" . $colonne['denom'] . "</th>";
        }

        $table .=
            "</tr>
    </thead>
    <tbody>";

        foreach ($this->objets as $objet) {
            $table .= "<tr class='clickable' onclick=\"window.location='$this->lien_ligne&id=$objet->id'\">";
            foreach ($this->colonnes as $idx => $colonne) {
                $attr = $colonne['nom'];
                $text = $objet->$attr;
                if ($idx == 0) {
                    $table .= "<th scope='row'>$text</th>";
                } else {
                    $table .= "<td>$text</th>";
                }
            }
            $table .= "</tr>";
        }

        $table .= "</tbody></table>";

        return  $table;
    }
}
