<?php

/**
 * ..:: Teste e documentacao da utilizacao da classe lAtendente ::..
 * 
 * @author Marlon R C Franco
 * @author Marlon R C Franco <marlonrcfranco@gmail.com>
 * 
 * * IMPORTANTE: Executar qualquer funcao de teste a seguir ira modificar a tabela tAtendente.xml
 * 
 * Para escolher as funcoes a serem executadas ou nao, comente ou descomente a chamada das mesmas
 * na funcao 'main' ao final deste codigo.
 * 
 */


include_once './BancoDeDados/logicas/lAtendente.php';


/**
 * testeAtributos
 * 
 * ..:: Teste de modificacao dos atributos do objeto $oAtendente da classe lAtendente ::..
 * 
 * Comportamento esperado:
 *
 * * $oAtendente possuir os atributos passados a ele;
 * 
 */
function testeAtributos(){
    $oAtendente = new lAtendente();

    print_r("Antes:\n");
    print_r($oAtendente);

    $oAtendente->nome = "Teste";
    $oAtendente->senha = "1234567";
    $oAtendente->cpf = "123.456.789-00";
    $oAtendente->dtNascimento = "1993-05-31";
    $oAtendente->endereco = "Rua 7";
    $oAtendente->telefone = "53987452108";
    $oAtendente->email = "moc.liame@email.com";
    
    print_r("\nDepois:\n");
    print_r($oAtendente);
}


/**
 * testeCriacao
 * 
 * ..:: Teste do metodo de criacao da tabela tAtendente.xml ::..
 * 
 * Comportamento esperado:
 *
 * * Criacao da tabela 'db/tAtendente.xml' ou a sobrescrita se já houver uma tabela criada;
 * * Conteudo da tabela tAtendente.xml deve ser apenas o primeiro registro: Template.
 *
 */
function testeCriacao() {
    $oAtendente = new lAtendente();
    print_r($oAtendente->createTableAtendente());
}


/**
 * testeInsercaoPorParametro
 * 
 * ..:: Teste do metodo de insercao de um novo registro na tabela tAtendente.xml passando os valores como parametro ::..
 * 
 * Comportamento esperado:
 *
 * * Insercao de cinco registros com os respectivos valores informados nos parametros;
 * * Conteudo da tabela tAtendente.xml deve ser seis registros, sendo o primeiro o Template.
 *
 */
function testeInsercaoPorParametro() {
    $oAtendente = new lAtendente();
    $oAtendente->createTableAtendente();

    print_r($oAtendente->insertAtendenteCompleto("Teste1", "1234567","364.964.588-00", "1993-05-31", "Rua 7", "539879878888", "teste@email.com"));
    print_r("\n");
    print_r($oAtendente->insertAtendenteCompleto("Teste2", "1234567","364.964.588-77", null, null, null, "teste@email.com"));
    print_r("\n");
    print_r($oAtendente->insertAtendenteCompleto("Teste3", "1234567","364.964.588-77", null, null, null, "teste@email.com"));
    print_r("\n");
    print_r($oAtendente->insertAtendenteCompleto("Teste4", "1234567","364.964.588-77", null, null, null, "teste@email.com"));
    print_r("\n");
    print_r($oAtendente->insertAtendenteCompleto("Teste5", "1234567","123.456.789-00", "1993-05-31", "Rua 7", "53987452108", "moc.liame@email.com"));
    print_r("\n");
}


/**
 * testeInsercaoPorAtributo
 * 
 * ..:: Teste do metodo de insercao de um novo registro na tabela tAtendente.xml utilizando os atributos do objeto $oAtendente ::..
 * 
 * Comportamento esperado:
 *
 * * Insercao de um registro com os respectivos valores informados nos atributos do objeto $oAtendente;
 * * Conteudo da tabela tAtendente.xml deve ser dois registros, sendo o primeiro o Template.
 *
 */
function testeInsercaoPorAtributo() {
    $oAtendente = new lAtendente();
    $oAtendente->createTableAtendente();

    $oAtendente->nome = "Teste Insercao por Atributo";
    $oAtendente->senha = "7777777";
    $oAtendente->cpf = "777.777.777-77";
    $oAtendente->dtNascimento = "2999-12-31";
    $oAtendente->endereco = "Rua Teste Insercao por Atributo";
    $oAtendente->telefone = "777777777";
    $oAtendente->email = "moc.liame@email.com";

    print_r($oAtendente);
    print_r($oAtendente->insertAtendente());
    print_r($oAtendente);
}


/**
 * testeUpdatePorParametro
 * 
 * ..:: Teste do metodo 'updateAtendenteCompleto' de atualização de um registro na tabela tAtendente.xml ::..
 * 
 * Comportamento esperado:
 *
 * * Atualização do registro que possui o codigo informado;
 * * A atualização por parametro ('updateAtendenteCompleto') utiliza os valores passados como parametro para salvar na tabela tAtendente.xml;
 * * Eh necessario que o codigo do atendente seja conhecido.
 * 
 *   
 */
function testeUpdatePorParametro(){
    $oAtendente = new lAtendente();
    $oAtendente->createTableAtendente();

    /* ..:: Atualizacao por parametro utilizando o metodo "updateAtendenteCompleto" ::.. */
    print_r($oAtendente->updateAtendenteCompleto("A0000", "Teste Update por Parametro",null,null,null,null,null,"template@teste.com"));
}


/**
 * testeUpdatePorAtributo
 * 
 * ..:: Teste do metodo 'updateAtendente' de atualização de um registro na tabela tAtendente.xml ::..
 * 
 * Comportamento esperado:
 *
 * * Atualização do registro que possui o codigo informado;
 * * A atualização por atributo ('updateAtendente') utiliza os nos atributos do objeto $oAtendente;
 * * Eh necessario que o codigo do atendente seja conhecido.
 * 
 *   
 */
function testeUpdatePorAtributo(){
    $oAtendente = new lAtendente();
    $oAtendente->createTableAtendente();
    
    /* ..:: Atualizacao por atributo ::.. */
    $oAtendente->codigo = "A0000"; 
    // como exemplo, eh utilizado o codigo do Template ("A0000"), porem este codigo 
    // deve ser adquirido atraves do metodo "getCodigoByAtendente", ou por qualquer um dos metodos de Select (ver: testeSelect())
    $oAtendente->nome = "Teste Update por Atributo";
    $oAtendente->email = "email.teste@update.com";
    print_r($oAtendente->updateAtendente());
}


/**
 * testeExclusao
 * 
 * ..:: Teste do metodo de exclusao de um registro na tabela tAtendente.xml ::..
 * 
 * Comportamento esperado:
 *
 * * Exclusao de um registro com o codigo igual ao informado no parametro do metodo 'excluirAtendente';
 * * Conteudo da tabela tAtendente.xml deve ser zero registros, pois o primeiro e unico registro (Template) foi excluido.
 * 
 * 
 */
function testeExclusao(){
    $oAtendente = new lAtendente();
    $oAtendente->createTableAtendente();

    print_r($oAtendente->excluirAtendente("A0000"));
}


/**
 * testeSelectPorUmParametro
 * 
 * ..:: Teste dos metodos de selecao de um (ou mais) registro(s) na tabela tAtendente.xml ::..
 * 
 * Comportamento esperado:
 *
 * * Selecao de um ou mais registros que satisfazem as condicoes nos parametros;
 * * A selecao utilizando os metodos iniciados por 'get' retornam um array do tipo lAtendente.
 * * A selecao utilizando o metodo 'selectAtendente' retorna um array do tipo SimpleXMLElement.
 * 
 *  
 */
function testeSelectPorUmParametro(){
    $oAtendente = new lAtendente();
    $oAtendente->createTableAtendente();
    $oAtendente->insertAtendenteCompleto("Teste1", "1234567","364.964.588-00", "1993-05-31", "Rua 7", "539879878888", "teste@email.com");
    $oAtendente->insertAtendenteCompleto("Teste2", "1234567","364.964.588-77", null, null, null, "teste@email.com");
    
    /* ..:: Consulta utilizando os metodos 'get' ::.. */
    /* Retornam um array de lAtendente */

    print_r($oAtendente->getAtendenteByCodigo("A0001"));
    // print_r($oAtendente->getAtendenteByNome("Teste1"));
    // print_r($oAtendente->getAtendenteByCPF("364.964.588-00"));
    // print_r($oAtendente->getAtendenteByDtNascimento("1993-05-31"));
    // print_r($oAtendente->getAtendenteByEndereco("Rua 7"));
    // print_r($oAtendente->getAtendenteByTelefone("539879878888"));
    // print_r($oAtendente->getAtendenteByEmail("teste@email.com"));


    /* ..:: Consultas equivalentes às acima mas utilizando o metodo 'selectAtendente' ::.. */ 
    /* Retonam um array de SimpleXMLElement */

    print_r($oAtendente->selectAtendente("A0001"));                                                // Busca pelo Codigo
    // print_r($oAtendente->selectAtendente(null,"Teste1"));                                          // Busca pelo Nome
    // print_r($oAtendente->selectAtendente(null,null,"1234567"));                                    // Busca somente pela senha
    // print_r($oAtendente->selectAtendente(null,null,null, "364.964.588-00"));                       // Busca somente pelo CPF  
    // print_r($oAtendente->selectAtendente(null,null,null,null, "1993-05-31"));                      // Busca somente pela Data de Nascimento
    // print_r($oAtendente->selectAtendente(null,null,null,null,null, "Rua 7"));                      // Busca somente pelo Endereco
    // print_r($oAtendente->selectAtendente(null,null,null,null,null,null, "539879878888"));          // Busca somente pelo Telefone
    // print_r($oAtendente->selectAtendente(null,null,null,null,null,null,null, "teste@email.com"));  // Busca somente pelo E-mail
}


/**
 * testeSelectPorMaisDeUmParametro
 * 
 * ..:: Teste do metodo 'selectAtendente' de selecao de um (ou mais) registro(s) na tabela tAtendente.xml ::..
 * 
 * Comportamento esperado:
 *
 * * Selecao de um ou mais registros que satisfazem as condicoes nos parametros;
 * * A selecao por um ou mais parametros (metodo 'selectAtendente') retorna um array do tipo SimpleXMLElement.
 * 
 *  
 */
function testeSelectPorMaisDeUmParametro(){
    $oAtendente = new lAtendente();
    $oAtendente->createTableAtendente();
    $oAtendente->insertAtendenteCompleto("Teste1", "1234567","364.964.588-00", "1993-05-31", "Rua 7", "539879878888", "teste@email.com");
    $oAtendente->insertAtendenteCompleto("Teste2", "1234567","364.964.588-77", null, null, null, "teste@email.com");
    
    /* ..:: Selecao utilizando multiplos campos ::.. */
    print_r($oAtendente->selectAtendente(null, "Teste1", "1234567","364.964.588-00", "1993-05-31", "Rua 7", "539879878888", "teste@email.com"));
}



/**
 * testeDescobrirCodigoDoAtendente
 * 
 * ..:: Teste do metodo '' de selecao de um (ou mais) registro(s) na tabela tAtendente.xml ::..
 * 
 * Comportamento esperado:
 *
 * * O Atendente informado ($oAtendente) eh buscado na tabela tAtendente.xml, e o seu codigo 
 * eh retornado numa string.
 * 
 *  
 */
function testeDescobrirCodigoDoAtendente(){
    $oAtendente = new lAtendente();
    $oAtendente->createTableAtendente();
    $oAtendente->insertAtendenteCompleto("Teste1", "1234567","364.964.588-00", "1993-05-31", "Rua 7", "539879878888", "teste@email.com");
    $oAtendente->insertAtendenteCompleto("Teste2", "1234567","364.964.588-77", null, null, null, "teste@email.com");
    
    // Para preencher os atributos de $oAtendente buscando na tabela tAtendente.xml pelo CPF ou por outro valor (ver testeSelect())
    // OBS: o retorno destas funcoes de selecao eh um array, por isso foi informado o indice [0] para pegar o elemento de interesse.
    $oAtendente = $oAtendente->getAtendenteByCPF("364.964.588-00")[0];

    /* ..:: Para obter o codigo de um atendente ::.. */
    // OBS: o $oAtendente deve possuir um ou mais atributos preenchidos
    print_r($oAtendente->getCodigoByAtendente($oAtendente));
}





function main(){

    testeAtributos();
    testeCriacao();
    testeInsercaoPorParametro();
    testeInsercaoPorAtributo();
    testeUpdatePorParametro();
    testeUpdatePorAtributo();
    testeExclusao();
    testeSelectPorUmParametro();
    testeSelectPorMaisDeUmParametro();
    testeDescobrirCodigoDoAtendente();
    
    // $oAtendente = new lAtendente();
    // print_r($oAtendente->selectAtendente());
    

}

main();
?>