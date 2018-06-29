
<?php

echo "<form id='Medicos' action='/action_page.php'>";
echo "<select class='custom-select' id='Medicos' name='Medicos'>";
echo "<option value='Any'>Medico...</option>";
echo "<option value='Medico1'>Medico 1...</option>";
echo "<option value='Medico2'>Medico 2...</option>";
echo "<option value='Medico3'>Medico 3...</option>";
echo "</select>";
echo "</form>";

echo "<form id='Especialidade' action='/action_page.php'>";
echo "<select class='custom-select' id='Especialidade' name='Especialidade'>";
echo "<option value='Any'>Especialidade...</option>";
echo "<option value='Especialidade1'>Especialidade 1...</option>";
echo "<option value='Especialidade2'>Especialidade 2...</option>";
echo "<option value='Especialidade3'>Especialidade 3...</option>";
echo "</select>";
echo "</form>";

echo "<form id='CPF' action=''>";
echo "<input type='text' id='Cpf' name='Cpf' placeholder='* CPF do Paciente' pattern='[0-9]{11}' required>";
echo "</form>";
?> 