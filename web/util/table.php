<?php


function echoTable($objets, $colonnes, $lien_ligne='', $class = 'table-dark'){


    $table = 
    "<table class='table table-striped table-hover $class w-100'>
    <thead>
        <tr>";

    foreach($colonnes as $colonne){
        $table .= "<th scope='col'>".$colonne['denom']."</th>";
    }

    $table .= 
    "</tr>
    </thead>
    <tbody>";

    foreach($objets as $objet){
        $table .= "<tr class='clickable' onclick=\"window.location='$lien_ligne&id=$objet->id'\">";
        foreach($colonnes as $idx => $colonne){
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
    
    echo $table;

}