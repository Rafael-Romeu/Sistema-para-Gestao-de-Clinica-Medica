<?php

/**
 * ..:: Teste e documentacao da utilizacao da classe lHorarioAtendimento ::..
 * 
 * @author Marlon R C Franco
 * @author Marlon R C Franco <marlonrcfranco@gmail.com>
 * 
 * * IMPORTANTE: Executar qualquer funcao de teste a seguir ira modificar a tabela tHorarioAtendimento.xml
 * 
 * Para escolher as funcoes a serem executadas ou nao, comente ou descomente a chamada das mesmas
 * na funcao 'main' ao final deste codigo.
 * 
 */


include_once 'logicas/lHorarioAtendimento.php';


/**
 * testeAtributos
 * 
 * ..:: Teste de modificacao dos atributos do objeto $oHorarioAtendimento da classe lHorarioAtendimento ::..
 * 
 * Comportamento esperado:
 *
 * * $oHorarioAtendimento possuir os atributos passados a ele;
 * 
 */
function testeAtributos(){
    $oHorarioAtendimento = new lHorarioAtendimento();

    print_r("Antes:\n");
    print_r($oHorarioAtendimento);

    $oHorarioAtendimento->codMedico = "M0000";
    $oHorarioAtendimento->seg = "0101010101010101010101";
    $oHorarioAtendimento->ter = "0101010101010101010101";
    $oHorarioAtendimento->qua = "0101010101010101010101";
    $oHorarioAtendimento->qui = "0101010101010101010101";
    $oHorarioAtendimento->sex = "0101010101010101010101";


    
    print_r("\nDepois:\n");
    print_r($oHorarioAtendimento);
}


/**
 * testeCriacao
 * 
 * ..:: Teste do metodo de criacao da tabela tHorarioAtendimento.xml ::..
 * 
 * Comportamento esperado:
 *
 * * Criacao da tabela 'db/tHorarioAtendimento.xml' ou a sobrescrita se já houver uma tabela criada;
 * * Conteudo da tabela tHorarioAtendimento.xml deve ser apenas o primeiro registro: Template.
 *
 */
function testeCriacao() {
    $oHorarioAtendimento = new lHorarioAtendimento();
    print_r($oHorarioAtendimento->createTableHorarioAtendimento());
}


/**
 * testeInsercaoPorParametro
 * 
 * ..:: Teste do metodo de insercao de um novo registro na tabela tHorarioAtendimento.xml passando os valores como parametro ::..
 * 
 * Comportamento esperado:
 *
 * * Insercao de cinco registros com os respectivos valores informados nos parametros;
 * * Conteudo da tabela tHorarioAtendimento.xml deve ser seis registros, sendo o primeiro o Template.
 *
 */
function testeInsercaoPorParametro() {
    $oHorarioAtendimento = new lHorarioAtendimento();
    $oHorarioAtendimento->createTableHorarioAtendimento();

    print_r($oHorarioAtendimento->insertHorarioAtendimentoCompleto("M0000", "0000000000000000000000", "0000000000000000000000", "0000000000000000000000", "0000000000000000000000", "0101010101010101010101"));
    print_r("\n");
    print_r($oHorarioAtendimento->insertHorarioAtendimentoCompleto("M0001", "0000000000000000000000", "0000000000000000000000", "0000000000000000000000", "0101010101010101010101", "0000000000000000000000"));
    print_r("\n");
    print_r($oHorarioAtendimento->insertHorarioAtendimentoCompleto("M0002", "0000000000000000000000", "0000000000000000000000", "0101010101010101010101", "0000000000000000000000", "0000000000000000000000"));
    print_r("\n");
    print_r($oHorarioAtendimento->insertHorarioAtendimentoCompleto("M0003", "0000000000000000000000", "0101010101010101010101", "0000000000000000000000", "0000000000000000000000", "0000000000000000000000"));
    print_r("\n");
    print_r($oHorarioAtendimento->insertHorarioAtendimentoCompleto("M0004", "0101010101010101010101", "0000000000000000000000", "0000000000000000000000", "0000000000000000000000", "0000000000000000000000"));
    print_r("\n");
}


/**
 * testeInsercaoPorAtributo
 * 
 * ..:: Teste do metodo de insercao de um novo registro na tabela tHorarioAtendimento.xml utilizando os atributos do objeto $oHorarioAtendimento ::..
 * 
 * Comportamento esperado:
 *
 * * Insercao de um registro com os respectivos valores informados nos atributos do objeto $oHorarioAtendimento;
 * * Conteudo da tabela tHorarioAtendimento.xml deve ser dois registros, sendo o primeiro o Template.
 *
 */
function testeInsercaoPorAtributo() {
    $oHorarioAtendimento = new lHorarioAtendimento();
    $oHorarioAtendimento->createTableHorarioAtendimento();

    $oHorarioAtendimento->codMedico = "M0000";
    $oHorarioAtendimento->seg = "0101010101010101010101";
    $oHorarioAtendimento->ter = "0101010101010101010101";
    $oHorarioAtendimento->qua = "0101010101010101010101";
    $oHorarioAtendimento->qui = "0101010101010101010101";
    $oHorarioAtendimento->sex = "0101010101010101010101";

    print_r($oHorarioAtendimento);
    print_r($oHorarioAtendimento->insertHorarioAtendimento());
    print_r($oHorarioAtendimento);
}


/**
 * testeUpdatePorParametro
 * 
 * ..:: Teste do metodo 'updateHorarioAtendimentoCompleto' de atualização de um registro na tabela tHorarioAtendimento.xml ::..
 * 
 * Comportamento esperado:
 *
 * * Atualização do registro que possui o codigo informado;
 * * A atualização por parametro ('updateHorarioAtendimentoCompleto') utiliza os valores passados como parametro para salvar na tabela tHorarioAtendimento.xml;
 * * Eh necessario que o codigo do HorarioAtendimento seja conhecido.
 * 
 *   
 */
function testeUpdatePorParametro(){
    $oHorarioAtendimento = new lHorarioAtendimento();
    $oHorarioAtendimento->createTableHorarioAtendimento();

    /* ..:: Atualizacao por parametro utilizando o metodo "updateHorarioAtendimentoCompleto" ::.. */
    print_r($oHorarioAtendimento->updateHorarioAtendimentoCompleto("H0000", "M0000", "0000000000000000000010"));
}


/**
 * testeUpdatePorAtributo
 * 
 * ..:: Teste do metodo 'updateHorarioAtendimento' de atualização de um registro na tabela tHorarioAtendimento.xml ::..
 * 
 * Comportamento esperado:
 *
 * * Atualização do registro que possui o codigo informado;
 * * A atualização por atributo ('updateHorarioAtendimento') utiliza os nos atributos do objeto $oHorarioAtendimento;
 * * Eh necessario que o codigo do HorarioAtendimento seja conhecido.
 * 
 *   
 */
function testeUpdatePorAtributo(){
    $oHorarioAtendimento = new lHorarioAtendimento();
    $oHorarioAtendimento->createTableHorarioAtendimento();
    
    /* ..:: Atualizacao por atributo ::.. */
    $oHorarioAtendimento->codigo = "H0000"; 
    // como exemplo, eh utilizado o codigo do Template ("H0000"), porem este codigo 
    // deve ser adquirido atraves do metodo "getCodigoByHorarioAtendimento", ou por qualquer um dos metodos de Select (ver: testeSelect())
    $oHorarioAtendimento->seg = "0000000000000000011111";
    $oHorarioAtendimento->ter = "1111111111111111111111";
    print_r($oHorarioAtendimento->updateHorarioAtendimento());
}


/**
 * testeExclusao
 * 
 * ..:: Teste do metodo de exclusao de um registro na tabela tHorarioAtendimento.xml ::..
 * 
 * Comportamento esperado:
 *
 * * Exclusao de um registro com o codigo igual ao informado no parametro do metodo 'excluirHorarioAtendimento';
 * * Conteudo da tabela tHorarioAtendimento.xml deve ser zero registros, pois o primeiro e unico registro (Template) foi excluido.
 * 
 * 
 */
function testeExclusao(){
    $oHorarioAtendimento = new lHorarioAtendimento();
    $oHorarioAtendimento->createTableHorarioAtendimento();

    print_r($oHorarioAtendimento->excluirHorarioAtendimento("H0000"));
}


/**
 * testeSelectPorUmParametro
 * 
 * ..:: Teste dos metodos de selecao de um (ou mais) registro(s) na tabela tHorarioAtendimento.xml ::..
 * 
 * Comportamento esperado:
 *
 * * Selecao de um ou mais registros que satisfazem as condicoes nos parametros;
 * * A selecao utilizando os metodos iniciados por 'get' retornam um array do tipo lHorarioAtendimento.
 * * A selecao utilizando o metodo 'selectHorarioAtendimento' retorna um array do tipo SimpleXMLElement.
 * 
 *  
 */
function testeSelectPorUmParametro(){
    $oHorarioAtendimento = new lHorarioAtendimento();
    $oHorarioAtendimento->createTableHorarioAtendimento();
    print_r($oHorarioAtendimento->insertHorarioAtendimentoCompleto("M0000", "0000000000000000000000", "0000000000000000000000", "0000000000000000000000", "0000000000000000000000", "0101010101010101010101"));
    print_r("\n");
    print_r($oHorarioAtendimento->insertHorarioAtendimentoCompleto("M0001", "0000000000000000000000", "0000000000000000000000", "0000000000000000000000", "0101010101010101010101", "0000000000000000000000"));
    print_r("\n\n");
    /* ..:: HorarioAtendimento utilizando os metodos 'get' ::.. */
    /* Retornam um array de lHorarioAtendimento */

    // print_r($oHorarioAtendimento->getHorarioAtendimentoByCodigo("C0001"));
    // print_r($oHorarioAtendimento->getHorarioAtendimentoByCodAtendente("A0000"));
    // print_r($oHorarioAtendimento->getHorarioAtendimentoByCodMedico("M0000"));
    // print_r($oHorarioAtendimento->getHorarioAtendimentoByCodPaciente("P0000"));
    // print_r($oHorarioAtendimento->getHorarioAtendimentoByData("2018-07-01"));
    // print_r($oHorarioAtendimento->getHorarioAtendimentoByHora("11:30:00"));
    // print_r($oHorarioAtendimento->getHorarioAtendimentoByObservacao("Teste Select por UM Parametro"));
    // print_r($oHorarioAtendimento->getHorarioAtendimentoByReceita("Teste Select por UM Parametro"));

   
    /* ..:: HorarioAtendimentos equivalentes às acima mas utilizando o metodo 'selectHorarioAtendimento' ::.. */ 
    /* Retonam um array de SimpleXMLElement */

    // print_r($oHorarioAtendimento->selectHorarioAtendimento("C0001"));                                                               // Busca somente pelo codigo
    // print_r($oHorarioAtendimento->selectHorarioAtendimento(null,"A0000"));                                                          // Busca somente pelo codAtendente
    // print_r($oHorarioAtendimento->selectHorarioAtendimento(null,null,"M0000"));                                                     // Busca somente pelo codMedico
    // print_r($oHorarioAtendimento->selectHorarioAtendimento(null,null,null,"P0000"));                                                // Busca somente pelo codPaciente
    // print_r($oHorarioAtendimento->selectHorarioAtendimento(null,null,null,null, "2018-07-01"));                                     // Busca somente pela data
    // print_r($oHorarioAtendimento->selectHorarioAtendimento(null,null,null,null,null, "11:30:00"));                                  // Busca somente pela hora
    // print_r($oHorarioAtendimento->selectHorarioAtendimento(null,null,null,null,null,null, "Teste Select por UM Parametro"));        // Busca somente pela observacao
    // print_r($oHorarioAtendimento->selectHorarioAtendimento(null,null,null,null,null,null,null, "Teste Select por UM Parametro"));   // Busca somente pela receita
    
}


/**
 * testeSelectPorMaisDeUmParametro
 * 
 * ..:: Teste do metodo 'selectHorarioAtendimento' de selecao de um (ou mais) registro(s) na tabela tHorarioAtendimento.xml ::..
 * 
 * Comportamento esperado:
 *
 * * Selecao de um ou mais registros que satisfazem as condicoes nos parametros;
 * * A selecao por um ou mais parametros (metodo 'selectHorarioAtendimento') retorna um array do tipo SimpleXMLElement.
 * 
 *  
 */
function testeSelectPorMaisDeUmParametro(){
    $oHorarioAtendimento = new lHorarioAtendimento();
    $oHorarioAtendimento->createTableHorarioAtendimento();
    print_r($oHorarioAtendimento->insertHorarioAtendimentoCompleto("M0000", "0000000000000000000000", "0000000000000000000000", "0000000000000000000000", "0000000000000000000000", "0101010101010101010101"));
    print_r("\n");
    print_r($oHorarioAtendimento->insertHorarioAtendimentoCompleto("M0001", "0000000000000000000000", "0000000000000000000000", "0000000000000000000000", "0101010101010101010101", "0000000000000000000000"));
    print_r("\n\n");

    /* ..:: Selecao utilizando multiplos campos ::.. */
    print_r($oHorarioAtendimento->selectHorarioAtendimento(null, "A0000", "M0000","P0001", "2018-07-01", "12:30:00", "Teste Select por + de um Parametro", null));
}



/**
 * testeDescobrirCodigoDoHorarioAtendimento
 * 
 * ..:: Teste do metodo '' de selecao de um (ou mais) registro(s) na tabela tHorarioAtendimento.xml ::..
 * 
 * Comportamento esperado:
 *
 * * O HorarioAtendimento informado ($oHorarioAtendimento) eh buscado na tabela tHorarioAtendimento.xml, e o seu codigo 
 * eh retornado numa string.
 * 
 *  
 */
function testeDescobrirCodigoDoHorarioAtendimento(){
    $oHorarioAtendimento = new lHorarioAtendimento();
    $oHorarioAtendimento->createTableHorarioAtendimento();
    print_r($oHorarioAtendimento->insertHorarioAtendimentoCompleto("M0001", "0000000000000000000000", "0000000000000000000000", "0000000000000000000000", "0000000000000000000000", "0101010101010101010101"));
    print_r("\n");
    print_r($oHorarioAtendimento->insertHorarioAtendimentoCompleto("M0002", "0000000000000000000000", "0000000000000000000000", "0000000000000000000000", "0101010101010101010101", "0000000000000000000000"));
    print_r("\n\n");

    
    $oHorarioAtendimento = $oHorarioAtendimento->getHorarioAtendimentoByCodMedico("M0002")[0];

    /* ..:: Para obter o codigo de um HorarioAtendimento ::.. */
    // OBS: o $oHorarioAtendimento deve possuir um ou mais atributos preenchidos
    print_r($oHorarioAtendimento->getCodigoByHorarioAtendimento($oHorarioAtendimento));
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
    // testeDescobrirCodigoDoHorarioAtendimento();

    $oHorarioAtendimento = new lHorarioAtendimento();
    // $string = 'M0000';
    print_r($oHorarioAtendimento->selectHorarioAtendimento());
    
    

}

main();
?>