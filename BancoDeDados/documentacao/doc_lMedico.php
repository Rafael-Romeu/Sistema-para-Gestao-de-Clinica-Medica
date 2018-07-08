<?php

/**
 * ..:: Teste e documentacao da utilizacao da classe lMedico ::..
 * 
 * @author Marlon R C Franco
 * @author Marlon R C Franco <marlonrcfranco@gmail.com>
 * 
 * * IMPORTANTE: Executar qualquer funcao de teste a seguir ira modificar a tabela tMedico.xml
 * 
 * Para escolher as funcoes a serem executadas ou nao, comente ou descomente a chamada das mesmas
 * na funcao 'main' ao final deste codigo.
 * 
 */


include_once 'logicas/lMedico.php';


/**
 * testeAtributos
 * 
 * ..:: Teste de modificacao dos atributos do objeto $oMedico da classe lMedico ::..
 * 
 * Comportamento esperado:
 *
 * * $oMedico possuir os atributos passados a ele;
 * 
 */
function testeAtributos(){
    $oMedico = new lMedico();

    print_r("Antes:\n");
    print_r($oMedico);

    $oMedico->nome = "Teste";
    $oMedico->senha = "1234567";
    $oMedico->cpf = "123.456.789-00";
    $oMedico->especialidade = "Geriatria";
    $oMedico->planoDeSaude = "Unimed";
    $oMedico->dtNascimento = "1993-05-31";
    $oMedico->endereco = "Rua 7";
    $oMedico->telefone = "53987452108";
    $oMedico->email = "moc.liame@email.com";
    
    print_r("\nDepois:\n");
    print_r($oMedico);
}


/**
 * testeCriacao
 * 
 * ..:: Teste do metodo de criacao da tabela tMedico.xml ::..
 * 
 * Comportamento esperado:
 *
 * * Criacao da tabela 'db/tMedico.xml' ou a sobrescrita se já houver uma tabela criada;
 * * Conteudo da tabela tMedico.xml deve ser apenas o primeiro registro: Template.
 *
 */
function testeCriacao() {
    $oMedico = new lMedico();
    print_r($oMedico->createTableMedico());
}


/**
 * testeInsercaoPorParametro
 * 
 * ..:: Teste do metodo de insercao de um novo registro na tabela tMedico.xml passando os valores como parametro ::..
 * 
 * Comportamento esperado:
 *
 * * Insercao de cinco registros com os respectivos valores informados nos parametros;
 * * Conteudo da tabela tMedico.xml deve ser seis registros, sendo o primeiro o Template.
 *
 */
function testeInsercaoPorParametro() {
    $oMedico = new lMedico();
    $oMedico->createTableMedico();

    print_r($oMedico->insertMedicoCompleto("Teste1", "1234567","364.964.588-00", "Pediatria", "Unimed", "1993-05-31", "Rua 7", "539879878888", "teste@email.com"));
    print_r("\n");
    print_r($oMedico->insertMedicoCompleto("Teste2", "1234567","364.964.588-77", "Geriatria", "Plano B", null, null, null, "teste@email.com"));
    print_r("\n");
    print_r($oMedico->insertMedicoCompleto("Teste3", "1234567","364.964.588-77", "Clinico Geral", "Unimed", null, null, null, "teste@email.com"));
    print_r("\n");
    print_r($oMedico->insertMedicoCompleto("Teste4", "1234567","364.964.588-77", "Clinico Geral", "Plano B", null, null, null, "teste@email.com"));
    print_r("\n");
    print_r($oMedico->insertMedicoCompleto("Teste5", "1234567","123.456.789-00", "Ginecologista", "Unimed", "1993-05-31", "Rua 7", "53987452108", "moc.liame@email.com"));
    print_r("\n");
}


/**
 * testeInsercaoPorAtributo
 * 
 * ..:: Teste do metodo de insercao de um novo registro na tabela tMedico.xml utilizando os atributos do objeto $oMedico ::..
 * 
 * Comportamento esperado:
 *
 * * Insercao de um registro com os respectivos valores informados nos atributos do objeto $oMedico;
 * * Conteudo da tabela tMedico.xml deve ser dois registros, sendo o primeiro o Template.
 *
 */
function testeInsercaoPorAtributo() {
    $oMedico = new lMedico();
    $oMedico->createTableMedico();

    $oMedico->nome = "Teste Insercao por Atributo";
    $oMedico->senha = "7777777";
    $oMedico->cpf = "777.777.777-77";
    $oMedico->especialidade = "Pediatria";
    $oMedico->planoDeSaude = "Unimed";
    $oMedico->dtNascimento = "2999-12-31";
    $oMedico->endereco = "Rua Teste Insercao por Atributo";
    $oMedico->telefone = "777777777";
    $oMedico->email = "moc.liame@email.com";

    print_r($oMedico);
    print_r($oMedico->insertMedico());
    print_r($oMedico);
}


/**
 * testeUpdatePorParametro
 * 
 * ..:: Teste do metodo 'updateMedicoCompleto' de atualização de um registro na tabela tMedico.xml ::..
 * 
 * Comportamento esperado:
 *
 * * Atualização do registro que possui o codigo informado;
 * * A atualização por parametro ('updateMedicoCompleto') utiliza os valores passados como parametro para salvar na tabela tMedico.xml;
 * * Eh necessario que o codigo do Medico seja conhecido.
 * 
 *   
 */
function testeUpdatePorParametro(){
    $oMedico = new lMedico();
    $oMedico->createTableMedico();

    /* ..:: Atualizacao por parametro utilizando o metodo "updateMedicoCompleto" ::.. */
    print_r($oMedico->updateMedicoCompleto("M0000", "Teste Update por Parametro",null,null,null,null,null,null,null,"template@teste.com"));
}


/**
 * testeUpdatePorAtributo
 * 
 * ..:: Teste do metodo 'updateMedico' de atualização de um registro na tabela tMedico.xml ::..
 * 
 * Comportamento esperado:
 *
 * * Atualização do registro que possui o codigo informado;
 * * A atualização por atributo ('updateMedico') utiliza os nos atributos do objeto $oMedico;
 * * Eh necessario que o codigo do Medico seja conhecido.
 * 
 *   
 */
function testeUpdatePorAtributo(){
    $oMedico = new lMedico();
    $oMedico->createTableMedico();
    
    /* ..:: Atualizacao por atributo ::.. */
    $oMedico->codigo = "M0000"; 
    // como exemplo, eh utilizado o codigo do Template ("M0000"), porem este codigo 
    // deve ser adquirido atraves do metodo "getCodigoByMedico", ou por qualquer um dos metodos de Select (ver: testeSelect())
    $oMedico->nome = "Teste Update por Atributo";
    $oMedico->email = "email.teste@update.com";
    print_r($oMedico->updateMedico());
}


/**
 * testeExclusao
 * 
 * ..:: Teste do metodo de exclusao de um registro na tabela tMedico.xml ::..
 * 
 * Comportamento esperado:
 *
 * * Exclusao de um registro com o codigo igual ao informado no parametro do metodo 'excluirMedico';
 * * Conteudo da tabela tMedico.xml deve ser zero registros, pois o primeiro e unico registro (Template) foi excluido.
 * 
 * 
 */
function testeExclusao(){
    $oMedico = new lMedico();
    $oMedico->createTableMedico();

    print_r($oMedico->excluirMedico("M0000"));
}


/**
 * testeSelectPorUmParametro
 * 
 * ..:: Teste dos metodos de selecao de um (ou mais) registro(s) na tabela tMedico.xml ::..
 * 
 * Comportamento esperado:
 *
 * * Selecao de um ou mais registros que satisfazem as condicoes nos parametros;
 * * A selecao utilizando os metodos iniciados por 'get' retornam um array do tipo lMedico.
 * * A selecao utilizando o metodo 'selectMedico' retorna um array do tipo SimpleXMLElement.
 * 
 *  
 */
function testeSelectPorUmParametro(){
    $oMedico = new lMedico();
    $oMedico->createTableMedico();
    print_r($oMedico->insertMedicoCompleto("Teste1", "1234567","364.964.588-00", "Pediatria", "Unimed", "1993-05-31", "Rua 7", "539879878888", "teste@email.com"));
    print_r("\n");
    print_r($oMedico->insertMedicoCompleto("Teste2", "1234567","364.964.588-77", "Pediatria", "Plano B", null, null, null, "teste@email.com"));
    print_r("\n\n");
    /* ..:: Consulta utilizando os metodos 'get' ::.. */
    /* Retornam um array de lMedico */

    print_r($oMedico->getMedicoByCodigo("M0001"));
    // print_r($oMedico->getMedicoByNome("Teste1"));
    // print_r($oMedico->getMedicoByCPF("364.964.588-00"));
    // print_r($oMedico->getMedicoByEspecialidade("Pediatria"));
    // print_r($oMedico->getMedicoByPlanoDeSaude("Unimed"));
    // print_r($oMedico->getMedicoByDtNascimento("1993-05-31"));
    // print_r($oMedico->getMedicoByEndereco("Rua 7"));
    // print_r($oMedico->getMedicoByTelefone("539879878888"));
    // print_r($oMedico->getMedicoByEmail("teste@email.com"));

   
    /* ..:: Consultas equivalentes às acima mas utilizando o metodo 'selectMedico' ::.. */ 
    /* Retonam um array de SimpleXMLElement */

    print_r($oMedico->selectMedico("M0001"));                                                             // Busca pelo Codigo
    // print_r($oMedico->selectMedico(null,"Teste1"));                                                       // Busca pelo Nome
    // print_r($oMedico->selectMedico(null,null,"1234567"));                                                 // Busca somente pela senha
    // print_r($oMedico->selectMedico(null,null,null,"364.964.588-00"));                                     // Busca somente pelo CPF
    // print_r($oMedico->selectMedico(null,null,null,null,"Pediatria"));                                     // Busca somente pela Especialidade
    // print_r($oMedico->selectMedico(null,null,null,null,null,"Unimed"));                                   // Busca somente pelo Plano de Saude
    // print_r($oMedico->selectMedico(null,null,null,null,null,null, "1993-05-31"));                         // Busca somente pela Data de Nascimento
    // print_r($oMedico->selectMedico(null,null,null,null,null,null,null, "Rua 7"));                         // Busca somente pelo Endereco
    // print_r($oMedico->selectMedico(null,null,null,null,null,null,null,null, "539879878888"));             // Busca somente pelo Telefone
    // print_r($oMedico->selectMedico(null,null,null,null,null,null,null,null,null, "teste@email.com"));     // Busca somente pelo E-mail
}


/**
 * testeSelectPorMaisDeUmParametro
 * 
 * ..:: Teste do metodo 'selectMedico' de selecao de um (ou mais) registro(s) na tabela tMedico.xml ::..
 * 
 * Comportamento esperado:
 *
 * * Selecao de um ou mais registros que satisfazem as condicoes nos parametros;
 * * A selecao por um ou mais parametros (metodo 'selectMedico') retorna um array do tipo SimpleXMLElement.
 * 
 *  
 */
function testeSelectPorMaisDeUmParametro(){
    $oMedico = new lMedico();
    $oMedico->createTableMedico();
    print_r($oMedico->insertMedicoCompleto("Teste1", "1234567","364.964.588-00", "Pediatria", "Unimed", "1993-05-31", "Rua 7", "539879878888", "teste@email.com"));
    print_r("\n");
    print_r($oMedico->insertMedicoCompleto("Teste2", "1234567","364.964.588-77", "Pediatria", "Plano B", null, null, null, "teste@email.com"));
    print_r("\n\n");

    /* ..:: Selecao utilizando multiplos campos ::.. */
    print_r($oMedico->selectMedico(null, "Teste1", "1234567","364.964.588-00", "Pediatria", "Unimed", "1993-05-31", "Rua 7", "539879878888", "teste@email.com"));
}



/**
 * testeDescobrirCodigoDoMedico
 * 
 * ..:: Teste do metodo '' de selecao de um (ou mais) registro(s) na tabela tMedico.xml ::..
 * 
 * Comportamento esperado:
 *
 * * O Medico informado ($oMedico) eh buscado na tabela tMedico.xml, e o seu codigo 
 * eh retornado numa string.
 * 
 *  
 */
function testeDescobrirCodigoDoMedico(){
    $oMedico = new lMedico();
    $oMedico->createTableMedico();
    print_r($oMedico->insertMedicoCompleto("Teste1", "1234567","364.964.588-00", "Pediatria", "Unimed", "1993-05-31", "Rua 7", "539879878888", "teste@email.com"));
    print_r("\n");
    print_r($oMedico->insertMedicoCompleto("Teste2", "1234567","364.964.588-77", "Pediatria", "Plano B", null, null, null, "teste@email.com"));
    print_r("\n\n");

    // Para preencher os atributos de $oMedico buscando na tabela tMedico.xml pelo CPF ou por outro valor (ver testeSelect())
    // OBS: o retorno destas funcoes de selecao eh um array, por isso foi informado o indice [0] para pegar o elemento de interesse.
    $oMedico = $oMedico->getMedicoByCPF("364.964.588-00")[0];

    /* ..:: Para obter o codigo de um Medico ::.. */
    // OBS: o $oMedico deve possuir um ou mais atributos preenchidos
    print_r($oMedico->getCodigoByMedico($oMedico));
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
    // testeDescobrirCodigoDoMedico();
    
    $oMedico = new lMedico();
    print_r($oMedico->getTabela());
    

}

main();
?>