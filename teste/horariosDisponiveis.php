<?php

$Dia = $_REQUEST["Dia"];
$Medico = $_REQUEST["Medico"];
$Especialidade = $_REQUEST["Especialidade"];
$CPF = $_REQUEST["CPF"];


echo '<p class="paragraph'.$Medico.'">'.$Dia.'...'.$Medico.'...'.$Especialidade.'...'.$CPF.'</p>';
echo "<form id='Medicos' action='/action_page.php'>";
echo "<select class='custom-select' id='Medicos' name='Medicos'>";
echo "<option value='Any'>Medico...</option>";
echo "<option value='Medico1'>Medico 1...</option>";
echo "<option value='Medico2'>Medico 2...</option>";
echo "<option value='Medico3'>Medico 3...</option>";
echo "</select>";
echo "</form>";

echo "<form id='Horarios' action='/action_page.php'>";
echo "<select class='custom-select' id='Horarios' name='Horarios'>";
echo "<option value='00:00'>00:00</option>";
echo "<option value='00:30'>00:30</option>";
echo "</select>";
echo "</form>";
echo "<input type='button' onclick='Funcao()' value='Selecionar'>"

?> 