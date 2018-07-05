<?php

/**
 * ..:: Teste e documentacao da utilizacao da classe lConsulta ::..
 * 
 * @author Marlon R C Franco
 * @author Marlon R C Franco <marlonrcfranco@gmail.com>
 * 
 * * IMPORTANTE: Executar qualquer funcao de teste a seguir ira modificar a tabela tConsulta.xml
 * 
 * Para escolher as funcoes a serem executadas ou nao, comente ou descomente a chamada das mesmas
 * na funcao 'main' ao final deste codigo.
 * 
 */


include_once 'logicas/lConsulta.php';


/**
 * testeAtributos
 * 
 * ..:: Teste de modificacao dos atributos do objeto $oConsulta da classe lConsulta ::..
 * 
 * Comportamento esperado:
 *
 * * $oConsulta possuir os atributos passados a ele;
 * 
 */
function testeAtributos(){
    $oConsulta = new lConsulta();

    print_r("Antes:\n");
    print_r($oConsulta);

    $oConsulta->codAtendente = "A0000";
    $oConsulta->codPaciente = "P0000";
    $oConsulta->codMedico = "M0000";
    $oConsulta->data = "2018-07-07";
    $oConsulta->hora = "11:30:00";
    $oConsulta->observacao = "O paciente apresentou o sintoma de dor de cabeça.";
    $oConsulta->receita = "Uma xícara de café ao menos uma vez ao dia.";

    
    print_r("\nDepois:\n");
    print_r($oConsulta);
}


/**
 * testeCriacao
 * 
 * ..:: Teste do metodo de criacao da tabela tConsulta.xml ::..
 * 
 * Comportamento esperado:
 *
 * * Criacao da tabela 'db/tConsulta.xml' ou a sobrescrita se já houver uma tabela criada;
 * * Conteudo da tabela tConsulta.xml deve ser apenas o primeiro registro: Template.
 *
 */
function testeCriacao() {
    $oConsulta = new lConsulta();
    print_r($oConsulta->createTableConsulta());
}


/**
 * testeInsercaoPorParametro
 * 
 * ..:: Teste do metodo de insercao de um novo registro na tabela tConsulta.xml passando os valores como parametro ::..
 * 
 * Comportamento esperado:
 *
 * * Insercao de cinco registros com os respectivos valores informados nos parametros;
 * * Conteudo da tabela tConsulta.xml deve ser seis registros, sendo o primeiro o Template.
 *
 */
function testeInsercaoPorParametro() {
    $oConsulta = new lConsulta();
    $oConsulta->createTableConsulta();

    print_r($oConsulta->insertConsultaCompleto("A0000", "M0000","P0000", "2018-07-01", "11:30:00", "Teste Insercao por Parametro", "Teste Insercao por Parametro"));
    print_r("\n");
    print_r($oConsulta->insertConsultaCompleto("A0000", "M0000","P0001", "2018-07-01", "12:30:00", "Teste Insercao por Parametro", null));
    print_r("\n");
    print_r($oConsulta->insertConsultaCompleto("A0000", "M0001","P0000", "2018-07-01", "13:30:00", "Teste Insercao por Parametro", null));
    print_r("\n");
    print_r($oConsulta->insertConsultaCompleto("A0001", "M0000","P0000", "2018-07-01", "14:30:00", "Teste Insercao por Parametro", null));
    print_r("\n");
    print_r($oConsulta->insertConsultaCompleto("A0001", "M0000","P0001", "2018-07-01", "11:30:00", "Teste Insercao por Parametro", null));
    print_r("\n");
}


/**
 * testeInsercaoPorAtributo
 * 
 * ..:: Teste do metodo de insercao de um novo registro na tabela tConsulta.xml utilizando os atributos do objeto $oConsulta ::..
 * 
 * Comportamento esperado:
 *
 * * Insercao de um registro com os respectivos valores informados nos atributos do objeto $oConsulta;
 * * Conteudo da tabela tConsulta.xml deve ser dois registros, sendo o primeiro o Template.
 *
 */
function testeInsercaoPorAtributo() {
    $oConsulta = new lConsulta();
    $oConsulta->createTableConsulta();

    $oConsulta->codAtendente = "A0000";
    $oConsulta->codPaciente = "P0000";
    $oConsulta->codMedico = "M0000";
    $oConsulta->data = "2018-07-07";
    $oConsulta->hora = "11:30:00";
    $oConsulta->observacao = "Teste insercao por Atributo.";
    $oConsulta->receita = "Teste insercao por Atributo.";

    print_r($oConsulta);
    print_r($oConsulta->insertConsulta());
    print_r($oConsulta);
}


/**
 * testeUpdatePorParametro
 * 
 * ..:: Teste do metodo 'updateConsultaCompleto' de atualização de um registro na tabela tConsulta.xml ::..
 * 
 * Comportamento esperado:
 *
 * * Atualização do registro que possui o codigo informado;
 * * A atualização por parametro ('updateConsultaCompleto') utiliza os valores passados como parametro para salvar na tabela tConsulta.xml;
 * * Eh necessario que o codigo do Consulta seja conhecido.
 * 
 *   
 */
function testeUpdatePorParametro(){
    $oConsulta = new lConsulta();
    $oConsulta->createTableConsulta();

    /* ..:: Atualizacao por parametro utilizando o metodo "updateConsultaCompleto" ::.. */
    print_r($oConsulta->updateConsultaCompleto("C0000","A0000", "M0000","P0000", "2018-07-01", "11:30:00", "Teste Update por Parametro", "Teste Update por Parametro"));
}


/**
 * testeUpdatePorAtributo
 * 
 * ..:: Teste do metodo 'updateConsulta' de atualização de um registro na tabela tConsulta.xml ::..
 * 
 * Comportamento esperado:
 *
 * * Atualização do registro que possui o codigo informado;
 * * A atualização por atributo ('updateConsulta') utiliza os nos atributos do objeto $oConsulta;
 * * Eh necessario que o codigo do Consulta seja conhecido.
 * 
 *   
 */
function testeUpdatePorAtributo(){
    $oConsulta = new lConsulta();
    $oConsulta->createTableConsulta();
    
    /* ..:: Atualizacao por atributo ::.. */
    $oConsulta->codigo = "C0000"; 
    // como exemplo, eh utilizado o codigo do Template ("C0000"), porem este codigo 
    // deve ser adquirido atraves do metodo "getCodigoByConsulta", ou por qualquer um dos metodos de Select (ver: testeSelect())
    $oConsulta->observacao = "Teste Update por Atributo";
    $oConsulta->receita = " 3 xicaras de café por dia.";
    print_r($oConsulta->updateConsulta());
}


/**
 * testeExclusao
 * 
 * ..:: Teste do metodo de exclusao de um registro na tabela tConsulta.xml ::..
 * 
 * Comportamento esperado:
 *
 * * Exclusao de um registro com o codigo igual ao informado no parametro do metodo 'excluirConsulta';
 * * Conteudo da tabela tConsulta.xml deve ser zero registros, pois o primeiro e unico registro (Template) foi excluido.
 * 
 * 
 */
function testeExclusao(){
    $oConsulta = new lConsulta();
    $oConsulta->createTableConsulta();

    print_r($oConsulta->excluirConsulta("C0000"));
}


/**
 * testeSelectPorUmParametro
 * 
 * ..:: Teste dos metodos de selecao de um (ou mais) registro(s) na tabela tConsulta.xml ::..
 * 
 * Comportamento esperado:
 *
 * * Selecao de um ou mais registros que satisfazem as condicoes nos parametros;
 * * A selecao utilizando os metodos iniciados por 'get' retornam um array do tipo lConsulta.
 * * A selecao utilizando o metodo 'selectConsulta' retorna um array do tipo SimpleXMLElement.
 * 
 *  
 */
function testeSelectPorUmParametro(){
    $oConsulta = new lConsulta();
    $oConsulta->createTableConsulta();
    print_r($oConsulta->insertConsultaCompleto("A0000", "M0000","P0000", "2018-07-01", "11:30:00", "Teste Select por UM Parametro", "Teste Select por UM Parametro"));
    print_r("\n");
    print_r($oConsulta->insertConsultaCompleto("A0000", "M0000","P0001", "2018-07-01", "12:30:00", "Teste Select por UM Parametro", null));
    print_r("\n\n");
    /* ..:: Consulta utilizando os metodos 'get' ::.. */
    /* Retornam um array de lConsulta */

    // print_r($oConsulta->getConsultaByCodigo("C0001"));
    // print_r($oConsulta->getConsultaByCodAtendente("A0000"));
    // print_r($oConsulta->getConsultaByCodMedico("M0000"));
    // print_r($oConsulta->getConsultaByCodPaciente("P0000"));
    // print_r($oConsulta->getConsultaByData("2018-07-01"));
    // print_r($oConsulta->getConsultaByHora("11:30:00"));
    // print_r($oConsulta->getConsultaByObservacao("Teste Select por UM Parametro"));
    // print_r($oConsulta->getConsultaByReceita("Teste Select por UM Parametro"));

   
    /* ..:: Consultas equivalentes às acima mas utilizando o metodo 'selectConsulta' ::.. */ 
    /* Retonam um array de SimpleXMLElement */

    // print_r($oConsulta->selectConsulta("C0001"));                                                               // Busca somente pelo codigo
    // print_r($oConsulta->selectConsulta(null,"A0000"));                                                          // Busca somente pelo codAtendente
    // print_r($oConsulta->selectConsulta(null,null,"M0000"));                                                     // Busca somente pelo codMedico
    // print_r($oConsulta->selectConsulta(null,null,null,"P0000"));                                                // Busca somente pelo codPaciente
    // print_r($oConsulta->selectConsulta(null,null,null,null, "2018-07-01"));                                     // Busca somente pela data
    // print_r($oConsulta->selectConsulta(null,null,null,null,null, "11:30:00"));                                  // Busca somente pela hora
    // print_r($oConsulta->selectConsulta(null,null,null,null,null,null, "Teste Select por UM Parametro"));        // Busca somente pela observacao
    // print_r($oConsulta->selectConsulta(null,null,null,null,null,null,null, "Teste Select por UM Parametro"));   // Busca somente pela receita
    
}


/**
 * testeSelectPorMaisDeUmParametro
 * 
 * ..:: Teste do metodo 'selectConsulta' de selecao de um (ou mais) registro(s) na tabela tConsulta.xml ::..
 * 
 * Comportamento esperado:
 *
 * * Selecao de um ou mais registros que satisfazem as condicoes nos parametros;
 * * A selecao por um ou mais parametros (metodo 'selectConsulta') retorna um array do tipo SimpleXMLElement.
 * 
 *  
 */
function testeSelectPorMaisDeUmParametro(){
    $oConsulta = new lConsulta();
    $oConsulta->createTableConsulta();
    print_r($oConsulta->insertConsultaCompleto("A0000", "M0000","P0000", "2018-07-01", "11:30:00", "Teste Select por + de um Parametro", "Teste Select por + de um Parametro"));
    print_r("\n");
    print_r($oConsulta->insertConsultaCompleto("A0000", "M0000","P0001", "2018-07-01", "12:30:00", "Teste Select por + de um Parametro", null));
    print_r("\n\n");

    /* ..:: Selecao utilizando multiplos campos ::.. */
    print_r($oConsulta->selectConsulta(null, "A0000", "M0000","P0001", "2018-07-01", "12:30:00", "Teste Select por + de um Parametro", null));
}



/**
 * testeDescobrirCodigoDoConsulta
 * 
 * ..:: Teste do metodo '' de selecao de um (ou mais) registro(s) na tabela tConsulta.xml ::..
 * 
 * Comportamento esperado:
 *
 * * O Consulta informado ($oConsulta) eh buscado na tabela tConsulta.xml, e o seu codigo 
 * eh retornado numa string.
 * 
 *  
 */
function testeDescobrirCodigoDoConsulta(){
    $oConsulta = new lConsulta();
    $oConsulta->createTableConsulta();
    print_r($oConsulta->insertConsultaCompleto("A0000", "M0000","P0000", "2018-07-01", "11:30:00", null, null));
    print_r("\n");
    print_r($oConsulta->insertConsultaCompleto("A0000", "M0000","P0001", "2018-07-01", "12:30:00", null, null));
    print_r("\n\n");

    
    $oConsulta = $oConsulta->traduzSimpleXMLObjectToConsulta($oConsulta->selectConsulta(null, "A0000", "M0000","P0001", "2018-07-01", "12:30:00"))[0];

    /* ..:: Para obter o codigo de um Consulta ::.. */
    // OBS: o $oConsulta deve possuir um ou mais atributos preenchidos
    print_r($oConsulta->getCodigoByConsulta($oConsulta));
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
    // testeDescobrirCodigoDoConsulta();

    $oConsulta = new lConsulta();
    print_r($oConsulta->selectConsulta());
    
    

}

main();
?>