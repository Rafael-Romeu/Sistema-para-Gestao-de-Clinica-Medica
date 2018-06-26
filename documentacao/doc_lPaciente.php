<?php

/**
 * ..:: Teste e documentacao da utilizacao da classe lPaciente ::..
 * 
 * @author Marlon R C Franco
 * @author Marlon R C Franco <marlonrcfranco@gmail.com>
 * 
 * * IMPORTANTE: Executar qualquer funcao de teste a seguir ira modificar a tabela tPaciente.xml
 * 
 * Para escolher as funcoes a serem executadas ou nao, comente ou descomente a chamada das mesmas
 * na funcao 'main' ao final deste codigo.
 * 
 */


include_once 'logicas/lPaciente.php';


/**
 * testeAtributos
 * 
 * ..:: Teste de modificacao dos atributos do objeto $oPaciente da classe lPaciente ::..
 * 
 * Comportamento esperado:
 *
 * * $oPaciente possuir os atributos passados a ele;
 * 
 */
function testeAtributos(){
    $oPaciente = new lPaciente();

    print_r("Antes:\n");
    print_r($oPaciente);

    $oPaciente->nome = "Teste";
    $oPaciente->senha = "1234567";
    $oPaciente->cpf = "123.456.789-00";
    $oPaciente->planoDeSaude = "Unimed";
    $oPaciente->genero = "F";
    $oPaciente->tipoSanguineo = "O+";
    $oPaciente->dtNascimento = "1993-05-31";
    $oPaciente->endereco = "Rua 7";
    $oPaciente->telefone = "53987452108";
    $oPaciente->email = "moc.liame@email.com";
    
    print_r("\nDepois:\n");
    print_r($oPaciente);
}


/**
 * testeCriacao
 * 
 * ..:: Teste do metodo de criacao da tabela tPaciente.xml ::..
 * 
 * Comportamento esperado:
 *
 * * Criacao da tabela 'db/tPaciente.xml' ou a sobrescrita se já houver uma tabela criada;
 * * Conteudo da tabela tPaciente.xml deve ser apenas o primeiro registro: Template.
 *
 */
function testeCriacao() {
    $oPaciente = new lPaciente();
    print_r($oPaciente->createTablePaciente());
}


/**
 * testeInsercaoPorParametro
 * 
 * ..:: Teste do metodo de insercao de um novo registro na tabela tPaciente.xml passando os valores como parametro ::..
 * 
 * Comportamento esperado:
 *
 * * Insercao de cinco registros com os respectivos valores informados nos parametros;
 * * Conteudo da tabela tPaciente.xml deve ser seis registros, sendo o primeiro o Template.
 *
 */
function testeInsercaoPorParametro() {
    $oPaciente = new lPaciente();
    $oPaciente->createTablePaciente();

    print_r($oPaciente->insertPacienteCompleto("Teste1", "1234567","364.964.588-00", "Unimed", "M", "A-", "1993-05-31", "Rua 7", "539879878888", "teste@email.com"));
    print_r("\n");
    print_r($oPaciente->insertPacienteCompleto("Teste2", "1234567","364.964.588-77", "Plano B", "F", "A+",  null, null, null, "teste@email.com"));
    print_r("\n");
    print_r($oPaciente->insertPacienteCompleto("Teste3", "1234567","364.964.588-77", "Unimed", "O", "AB-", null, null, null, "teste@email.com"));
    print_r("\n");
    print_r($oPaciente->insertPacienteCompleto("Teste4", "1234567","364.964.588-77", "Plano B", "M", "O-", null, null, null, "teste@email.com"));
    print_r("\n");
    print_r($oPaciente->insertPacienteCompleto("Teste5", "1234567","123.456.789-00", "Unimed", "F", "A-", "1993-05-31", "Rua 7", "53987452108", "moc.liame@email.com"));
    print_r("\n");
}


/**
 * testeInsercaoPorAtributo
 * 
 * ..:: Teste do metodo de insercao de um novo registro na tabela tPaciente.xml utilizando os atributos do objeto $oPaciente ::..
 * 
 * Comportamento esperado:
 *
 * * Insercao de um registro com os respectivos valores informados nos atributos do objeto $oPaciente;
 * * Conteudo da tabela tPaciente.xml deve ser dois registros, sendo o primeiro o Template.
 *
 */
function testeInsercaoPorAtributo() {
    $oPaciente = new lPaciente();
    $oPaciente->createTablePaciente();

    $oPaciente->nome = "Teste Insercao por Atributo";
    $oPaciente->senha = "7777777";
    $oPaciente->cpf = "777.777.777-77";
    $oPaciente->planoDeSaude = "Unimed";
    $oPaciente->genero = "F";
    $oPaciente->tipoSanguineo = "A-";
    $oPaciente->dtNascimento = "2999-12-31";
    $oPaciente->endereco = "Rua Teste Insercao por Atributo";
    $oPaciente->telefone = "777777777";
    $oPaciente->email = "moc.liame@email.com";

    print_r($oPaciente);
    print_r($oPaciente->insertPaciente());
    print_r($oPaciente);
}


/**
 * testeUpdatePorParametro
 * 
 * ..:: Teste do metodo 'updatePacienteCompleto' de atualização de um registro na tabela tPaciente.xml ::..
 * 
 * Comportamento esperado:
 *
 * * Atualização do registro que possui o codigo informado;
 * * A atualização por parametro ('updatePacienteCompleto') utiliza os valores passados como parametro para salvar na tabela tPaciente.xml;
 * * Eh necessario que o codigo do Paciente seja conhecido.
 * 
 *   
 */
function testeUpdatePorParametro(){
    $oPaciente = new lPaciente();
    $oPaciente->createTablePaciente();

    /* ..:: Atualizacao por parametro utilizando o metodo "updatePacienteCompleto" ::.. */
    print_r($oPaciente->updatePacienteCompleto("P0000", "Teste Update por Parametro", null,null,null,null,null,null,null,null,"template@teste.com"));
}


/**
 * testeUpdatePorAtributo
 * 
 * ..:: Teste do metodo 'updatePaciente' de atualização de um registro na tabela tPaciente.xml ::..
 * 
 * Comportamento esperado:
 *
 * * Atualização do registro que possui o codigo informado;
 * * A atualização por atributo ('updatePaciente') utiliza os nos atributos do objeto $oPaciente;
 * * Eh necessario que o codigo do Paciente seja conhecido.
 * 
 *   
 */
function testeUpdatePorAtributo(){
    $oPaciente = new lPaciente();
    $oPaciente->createTablePaciente();
    
    /* ..:: Atualizacao por atributo ::.. */
    $oPaciente->codigo = "P0000"; 
    // como exemplo, eh utilizado o codigo do Template ("P0000"), porem este codigo 
    // deve ser adquirido atraves do metodo "getCodigoByPaciente", ou por qualquer um dos metodos de Select (ver: testeSelect())
    $oPaciente->nome = "Teste Update por Atributo";
    $oPaciente->planoDeSaude = "(Plano de Saude)";
    $oPaciente->email = "email.teste@update.com";
    print_r($oPaciente->updatePaciente());
}


/**
 * testeExclusao
 * 
 * ..:: Teste do metodo de exclusao de um registro na tabela tPaciente.xml ::..
 * 
 * Comportamento esperado:
 *
 * * Exclusao de um registro com o codigo igual ao informado no parametro do metodo 'excluirPaciente';
 * * Conteudo da tabela tPaciente.xml deve ser zero registros, pois o primeiro e unico registro (Template) foi excluido.
 * 
 * 
 */
function testeExclusao(){
    $oPaciente = new lPaciente();
    $oPaciente->createTablePaciente();

    print_r($oPaciente->excluirPaciente("P0000"));
}


/**
 * testeSelectPorUmParametro
 * 
 * ..:: Teste dos metodos de selecao de um (ou mais) registro(s) na tabela tPaciente.xml ::..
 * 
 * Comportamento esperado:
 *
 * * Selecao de um ou mais registros que satisfazem as condicoes nos parametros;
 * * A selecao utilizando os metodos iniciados por 'get' retornam um array do tipo lPaciente.
 * * A selecao utilizando o metodo 'selectPaciente' retorna um array do tipo SimpleXMLElement.
 * 
 *  
 */
function testeSelectPorUmParametro(){
    $oPaciente = new lPaciente();
    $oPaciente->createTablePaciente();
    print_r($oPaciente->insertPacienteCompleto("Teste1", "1234567","364.964.588-00", "Unimed", "M", "A-", "1993-05-31", "Rua 7", "539879878888", "teste@email.com"));
    print_r("\n");
    print_r($oPaciente->insertPacienteCompleto("Teste2", "1234567","364.964.588-77", "Plano B", "F", "A+",  null, null, null, "teste@email.com"));
    print_r("\n\n");
    /* ..:: Consulta utilizando os metodos 'get' ::.. */
    /* Retornam um array de lPaciente */

    print_r($oPaciente->getPacienteByCodigo("P0001"));
    // print_r($oPaciente->getPacienteByNome("Teste1"));
    // print_r($oPaciente->getPacienteByCPF("364.964.588-00"));
    // print_r($oPaciente->getPacienteByPlanoDeSaude("Unimed"));
    // print_r($oPaciente->getPacienteByGenero("M"));
    // print_r($oPaciente->getPacienteByTipoSanguineo("A+"));
    // print_r($oPaciente->getPacienteByDtNascimento("1993-05-31"));
    // print_r($oPaciente->getPacienteByEndereco("Rua 7"));
    // print_r($oPaciente->getPacienteByTelefone("539879878888"));
    // print_r($oPaciente->getPacienteByEmail("teste@email.com"));

   
    /* ..:: Consultas equivalentes às acima mas utilizando o metodo 'selectPaciente' ::.. */ 
    /* Retonam um array de SimpleXMLElement */

    print_r($oPaciente->selectPaciente("P0001"));                                                                  // Busca pelo Codigo
    // print_r($oPaciente->selectPaciente(null,"Teste1"));                                                            // Busca pelo Nome
    // print_r($oPaciente->selectPaciente(null,null,"1234567"));                                                      // Busca somente pela senha
    // print_r($oPaciente->selectPaciente(null,null,null,"364.964.588-00"));                                          // Busca somente pelo CPF
    // print_r($oPaciente->selectPaciente(null,null,null,null, "Unimed"));                                            // Busca somente pelo Plano de Saude
    // print_r($oPaciente->selectPaciente(null,null,null,null,null, "M"));                                            // Busca somente pelo Genero
    // print_r($oPaciente->selectPaciente(null,null,null,null,null,null, "A+"));                                      // Busca somente pelo Tipo Sanguineo
    // print_r($oPaciente->selectPaciente(null,null,null,null,null,null,null, "1993-05-31"));                         // Busca somente pela Data de Nascimento
    // print_r($oPaciente->selectPaciente(null,null,null,null,null,null,null,null, "Rua 7"));                         // Busca somente pelo Endereco
    // print_r($oPaciente->selectPaciente(null,null,null,null,null,null,null,null,null, "539879878888"));             // Busca somente pelo Telefone
    // print_r($oPaciente->selectPaciente(null,null,null,null,null,null,null,null,null,null, "teste@email.com"));     // Busca somente pelo E-mail
}


/**
 * testeSelectPorMaisDeUmParametro
 * 
 * ..:: Teste do metodo 'selectPaciente' de selecao de um (ou mais) registro(s) na tabela tPaciente.xml ::..
 * 
 * Comportamento esperado:
 *
 * * Selecao de um ou mais registros que satisfazem as condicoes nos parametros;
 * * A selecao por um ou mais parametros (metodo 'selectPaciente') retorna um array do tipo SimpleXMLElement.
 * 
 *  
 */
function testeSelectPorMaisDeUmParametro(){
    $oPaciente = new lPaciente();
    $oPaciente->createTablePaciente();
    print_r($oPaciente->insertPacienteCompleto("Teste1", "1234567","364.964.588-00", "Unimed", "M", "A-", "1993-05-31", "Rua 7", "539879878888", "teste@email.com"));
    print_r("\n");
    print_r($oPaciente->insertPacienteCompleto("Teste2", "1234567","364.964.588-77", "Plano B", "F", "A+",  null, null, null, "teste@email.com"));
    print_r("\n\n");

    /* ..:: Selecao utilizando multiplos campos ::.. */
    print_r($oPaciente->selectPaciente(null, "Teste2", "1234567","364.964.588-77", "Plano B", "F", "A+", null, null, null, "teste@email.com"));
}



/**
 * testeDescobrirCodigoDoPaciente
 * 
 * ..:: Teste do metodo '' de selecao de um (ou mais) registro(s) na tabela tPaciente.xml ::..
 * 
 * Comportamento esperado:
 *
 * * O Paciente informado ($oPaciente) eh buscado na tabela tPaciente.xml, e o seu codigo 
 * eh retornado numa string.
 * 
 *  
 */
function testeDescobrirCodigoDoPaciente(){
    $oPaciente = new lPaciente();
    $oPaciente->createTablePaciente();
    print_r($oPaciente->insertPacienteCompleto("Teste1", "1234567","364.964.588-00", "Unimed", "M", "A-", "1993-05-31", "Rua 7", "539879878888", "teste@email.com"));
    print_r("\n");
    print_r($oPaciente->insertPacienteCompleto("Teste2", "1234567","364.964.588-77", "Plano B", "F", "A+",  null, null, null, "teste@email.com"));
    print_r("\n\n");

    // Para preencher os atributos de $oPaciente buscando na tabela tPaciente.xml pelo CPF ou por outro valor (ver testeSelect())
    // OBS: o retorno destas funcoes de selecao eh um array, por isso foi informado o indice [0] para pegar o elemento de interesse.
    $oPaciente = $oPaciente->getPacienteByCPF("364.964.588-00")[0];

    /* ..:: Para obter o codigo de um Paciente ::.. */
    // OBS: o $oPaciente deve possuir um ou mais atributos preenchidos
    print_r($oPaciente->getCodigoByPaciente($oPaciente));
}





function main(){

    // testeAtributos();
    // testeCriacao();
    // testeInsercaoPorParametro();
    // testeInsercaoPorAtributo();
    // testeUpdatePorParametro();
    // testeUpdatePorAtributo();
    // testeExclusao();
    // testeSelectPorUmParametro();
    // testeSelectPorMaisDeUmParametro();
    // testeDescobrirCodigoDoPaciente();
    
    $oPaciente = new lPaciente();
    print_r($oPaciente->selectPaciente());
    

}

main();
?>