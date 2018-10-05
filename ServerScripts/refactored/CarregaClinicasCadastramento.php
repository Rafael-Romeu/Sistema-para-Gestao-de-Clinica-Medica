<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lClinica.php";
    
    $oClinica = new lClinica();
    $i = 1;
    $oClinica->setCodigo($i);

    while ($oClinica->identifica())
    {
        echo "<label class=\"container\">".$oClinica->getNome();
        echo "<input type=\"checkbox\" name = \"clinicas\" value=\"".$i."\">";
        echo "<span class=\"checkmark\"></span>";
        echo "</label>";

        $i = $i + 1;
        $oClinica = new lClinica();
        $oClinica->setCodigo($i);
    }
?> 