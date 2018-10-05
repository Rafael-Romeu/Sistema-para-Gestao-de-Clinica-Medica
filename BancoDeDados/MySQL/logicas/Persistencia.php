<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set('America/Sao_Paulo');
include_once "Model.php";
include_once "iPersistencia.php";
include_once "Filtro.php";

class Persistencia implements iPersistencia
{
    private $Model;
    private $Relacionamento;
    private $campoTabelaRelacionamento;
    private $campoMinhaTabelaNoRelacionamento;
    private $SERVERNAME;
    private $DATABASE;
    private $USERNAME;
    private $PASSWORD;
    private $SQL;

    private $conn;
    private $stmt;
    private $FiltroTabelas;
    private $FiltroCampos;
    private $FiltroValores;
    private $Join;
    private $Distinct;
    private $OrderBy;
    private $AscDesc;
    private $GroupBy;

    private $identificou;
    private $temRelacionamento;
    private $TabelaIntermediaria;

    public function __construct()
    {
        $this->setSERVERNAME("localhost");
        $this->setDATABASE("trabalho");
        $this->setUSERNAME("admin");
        $this->setPASSWORD("admin");

        $this->setConn(null);
        $this->setFiltroCampos("*");
        $this->setFiltroValores("1");
        $this->setOrderBy("");
        $this->setGroupBy("");

        $this->temRelacionamento = false;
    }

    /**
     * Get the value of Model
     */
    public function getModel()
    {
        return $this->Model;
    }

    /**
     * Set the value of Model
     *
     * @return  self
     */
    public function setModel($Tabela)
    {
        //print_r("\n> " . __LINE__ . "\tPERSISTENCIA (" . $Tabela . ")> INICIALIZANDO ESTRUTURA...");
        $this->Model = new Model();
        $this->Model->setTABELANOME($Tabela);
        $this->Model->setSCHEMA($this->schema($Tabela));
        //print_r("\n> " . __LINE__ . "\tPERSISTENCIA (" . $Tabela . ")> INICIALIZAÇÃO FINALIZADA\n");
        return $this;
    }

    public function DBConnect()
    {
        try {
            $this->setConn(new PDO("mysql:host=" . $this->getSERVERNAME() . ";dbname=" . $this->getDATABASE().";charset=utf8", $this->getUSERNAME(), $this->getPASSWORD()));
            $this->getConn()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // print_r("\n> " . __LINE__ . "\tPERSISTENCIA (" . $this->getModel()->getTABELANOME() . ")> Connect");
            return $this->getConn();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function DBDisconnect()
    {
        // print_r("\n> " . __LINE__ . "\tPERSISTENCIA (" . $this->getModel()->getTABELANOME() . ")> Disconnect");
        $this->setConn(null);
    }

    public function schema($table)
    {
        $q = $this->DBConnect()->prepare("SHOW COLUMNS FROM `$table`");
        $q->execute();
        $q = $q->fetchAll();
        //print_r("\n> " . __LINE__ . "\tPERSISTENCIA (" . $this->getModel()->getTABELANOME() . ")> Preenchendo Model...");
        // //print_r($q);
        $this->DBDisconnect();
        return $q;
    }

    public function identifica($proUPDATE=null)
    {
        if($proUPDATE==null){
            $this->getModel()->zeraModificacoesTodosCamposMAPPING();
        }
        //print_r("\n> " . __LINE__ . "\tPERSISTENCIA (" . $this->getModel()->getTABELANOME() . ")> IDENTIFICANDO...");
        $oFiltro = new Filtro();
        foreach ($this->getModel()->getMAPPING() as $campo => $valor) {
            if ($campo != $this->getCampoTabelaRelacionamento() && $campo != "regDate") {
                if ($this->getModel()->getMAPPING()[$campo]["modificado"]=="N") {
                    // //print_r(">AQUIIIIIIII: ".$this->getModel()->getMAPPING()[$campo]["modificado"]);
                    if ($valor["valor"] != null && $valor["valor"] != "" && $valor["valor"] != "1900-01-01") {
                        $oFiltro->equals($campo, $valor["valor"], $valor["tipo"]);
                    }
                }
            }
        }
        $this->setFiltroValores($oFiltro->toString());
        $result = $this->executeSELECT();
        if (count($result) == 1) {
            foreach ($result[0] as $campo => $valor) {
                $this->getModel()->setValor($campo, $valor);
            }
            if ($this->temRelacionamento) {
                $this->buscaDadosRelacionamento();
            }
            $this->getModel()->zeraModificacoesTodosCamposMAPPING();
            // //print_r($result);
            //print_r("\n> " . __LINE__ . "\tPERSISTENCIA (" . $this->getModel()->getTABELANOME() . ")> IDENTIFICA TRUE\n");
            $this->setIdentificou(true);
            return true;
        } else {
            //print_r("\n> " . __LINE__ . "\tPERSISTENCIA (" . $this->getModel()->getTABELANOME() . ")> IDENTIFICA FALSE\n");
            $this->setIdentificou(false);
            return false;
        }
    }

    /***
     * Identifica e NÃO preenche apenas o codigo no Model
     */
    public function identificaSimples()
    {
        //print_r("\n> " . __LINE__ . "\tPERSISTENCIA (" . $this->getModel()->getTABELANOME() . ")> IDENTIFICANDO Simples...");
        $oFiltro = new Filtro();
        // //print_r($this->getModel()->getMAPPING());
        foreach ($this->getModel()->getMAPPING() as $campo => $valor) {
            if ($campo != $this->getCampoTabelaRelacionamento() && $campo != "regDate") {
                if ($this->getModel()->getMAPPING()[$campo]["modificado"]=="N") {
                    if ($valor["valor"] != null && $valor["valor"] != "" && $valor["valor"] != "1900-01-01") {
                        $oFiltro->equals($campo, $valor["valor"], $valor["tipo"]);
                    }
                }
            }
        }
        $this->limpaFiltros();
        $this->setFiltroValores($oFiltro->toString());
        $result = $this->executeSELECT();
        if (!$result) {
            //print_r("\n> " . __LINE__ . "\tPERSISTENCIA (" . $this->getModel()->getTABELANOME() . ")> IDENTIFICA Simples False");
            return false;
        }
        if (count($result) == 1) {
            //print_r("\n> " . __LINE__ . "\tPERSISTENCIA (" . $this->getModel()->getTABELANOME() . ")> IDENTIFICA Simples True");
            $this->getModel()->setValor("codigo", $result[0]["codigo"]);
            return true;
        } else {
            //print_r("\n> " . __LINE__ . "\tPERSISTENCIA (" . $this->getModel()->getTABELANOME() . ")> IDENTIFICA Simples False");
            return false;
        }
    }

    public function executeSELECT()
    {
        try {
            $this->DBConnect();
            // //print_r(">>> FILTRO CAMPOS (".$this->getModel()->getTABELANOME()."): ".$this->getFiltroCampos());
            $this->setSQL("SELECT " . $this->DISTINCT() . $this->getFiltroCampos() . " FROM " . $this->SQLTabelas() . " " . $this->getJOIN() . " WHERE " . $this->getFiltroValores() . $this->getGroupBy() . $this->getOrderBy() . ";");
            //print_r("\n> " . __LINE__ . "\tPERSISTENCIA (" . $this->getModel()->getTABELANOME() . ")> " . $this->getSQL());
            $this->setStmt(($this->getConn())->query($this->getSQL()));
            $this->getStmt()->execute();
            $result = $this->getStmt()->fetchAll(PDO::FETCH_ASSOC);
            //print_r("\n> " . __LINE__ . "\tPERSISTENCIA (" . $this->getModel()->getTABELANOME() . ")> Registros retornados: " . count($result));
            return $result;
        } catch (PDOException $e) {
            $this->DBDisconnect();
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function SQLTabelas()
    {
        if ($this->getFiltroTabelas() == null) {
            return $this->getModel()->getTABELANOME();
        } else {
            return $this->getFiltroTabelas();
        }
    }

    public function InnerJOIN($tabelaDireita, $campoTabelaEsquerda, $campoTabelaDireita)
    {
        $this->setJOIN("INNER JOIN " . $tabelaDireita . " ON (" . $this->getTABELANOME() . "." . $campoTabelaEsquerda . "=" . $tabelaDireita . "." . $campoTabelaDireita . ")");
    }

    public function RightJOIN($tabelaDireita, $campoTabelaEsquerda, $campoTabelaDireita)
    {
        $this->setJOIN("RIGHT JOIN " . $tabelaDireita . " ON (" . $this->getTABELANOME() . "." . $campoTabelaEsquerda . "=" . $tabelaDireita . "." . $campoTabelaDireita . ")");
    }

    public function LeftJOIN($tabelaDireita, $campoTabelaEsquerda, $campoTabelaDireita)
    {
        $this->setJOIN("LEFT JOIN " . $tabelaDireita . " ON (" . $this->getTABELANOME() . "." . $campoTabelaEsquerda . "=" . $tabelaDireita . "." . $campoTabelaDireita . ")");
    }

    public function executeDELETE()
    {
        if (!$this->identifica()) {
            //print_r("\n!! > PERSISTENCIA (" . $this->getModel()->getTABELANOME() . ")> Não foi possível identificar o registro. Informe mais parâmetros.\n");
            return "\nNão foi possível identificar o registro. Informe mais parâmetros.\n";
        }
        $this->setFiltroValores("codigo='" . $this->getModel()->getMAPPING()["codigo"]["valor"] . "'");
        try {
            $this->setSQL("DELETE FROM " . $this->getModel()->getTABELANOME() . " WHERE " . $this->getFiltroValores() . ";");
            //print_r("\n> " . __LINE__ . "\tPERSISTENCIA (" . $this->getModel()->getTABELANOME() . ")> " . $this->getSQL());
            $this->executeSQL();
            //print_r("\n> " . __LINE__ . "\tPERSISTENCIA (" . $this->getModel()->getTABELANOME() . ")> Exclusão efetuada com sucesso!");
            if ($this->temRelacionamento) {
                $codOutraTabela = $this->getModel()->getValor($this->getCampoTabelaRelacionamento());
                // //print_r($codOutraTabela);
                if ($codOutraTabela != null && count($codOutraTabela) > 0) {
                    $this->executeDELETERelacionamento();
                }
            }
            return "\nExclusão efetuada com sucesso!\n";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            $this->DBDisconnect();
        }
    }

    /***
     * @param string $campos Campos a serem alterados, separados por virgula (ex: "codigo,nome");
     */
    public function executeUPDATE($camposSelecionados = null)
    {
        if (!$this->identificaSimples(true)) {
            //print_r("\n*! > PERSISTENCIA (" . $this->getModel()->getTABELANOME() . ")> Não foi possível identificar o registro. Informe mais parâmetros.");
            return "\nNão foi possível identificar o registro. Informe mais parâmetros.\n";
        }
        $this->setFiltroValores("codigo=" . $this->getModel()->getMAPPING()["codigo"]["valor"]);
        try {
            $this->DBConnect();
            $this->getConn()->beginTransaction();
            $campos = "";
            // //print_r($this->getModel()->getMAPPING());
            $tabela = $this->getModel()->getTABELANOME();
            if ($camposSelecionados != null) {
                $camposSelecionados = explode(",", $camposSelecionados);
                $v = false;
                foreach ($camposSelecionados as $campo) {
                    if ($v) {
                        $campos .= ",";
                    }
                    $campos .= "$campo='" . $this->getModel()->getMAPPING()[$campo]["valor"] . "'";
                    $v = true;
                }
            } else {
                $v = false;
                foreach ($this->getModel()->getMAPPING() as $campo => $valor) {
                    if ($campo != "regDate" && $campo != "codigo" && $campo != $this->getCampoTabelaRelacionamento()) {
                        if ($v) {
                            $campos .= ",";
                        }
                        $campos .= "$campo='" . $valor["valor"] . "'";
                        $v = true;
                    }
                }
            }
            // print("\ncampos: $campos\n");
            $this->setSQL("UPDATE $tabela SET $campos WHERE " . $this->getFiltroValores() . ";");
            //print_r("\n> " . __LINE__ . "\tPERSISTENCIA (" . $this->getModel()->getTABELANOME() . ")> " . $this->getSQL());
            $this->setStmt($this->getConn()->prepare($this->getSQL()));
            $this->bindParams();
            $this->getStmt()->execute();
            $this->getConn()->commit();
            if ($this->temRelacionamento) {
                $codOutraTabela = $this->getModel()->getValor($this->getCampoTabelaRelacionamento());
                if ($codOutraTabela != null && count($codOutraTabela) > 0) {
                    $this->executeUpdateRelacionamento();
                }
            }
            return "\nAlteração realizada com sucesso!";
        } catch (PDOException $e) {
            $this->getConn()->rollback();
            echo "Error: " . $e->getMessage();
        }
    }

    public function executeINSERT()
    {
        try {
            $this->DBConnect();
            $this->getConn()->beginTransaction();
            $campos = "";
            $valores = "";
            $v = false;
            $tabela = $this->getModel()->getTABELANOME();
            foreach ($this->getModel()->getMAPPING() as $campo => $valor) {
                if ($campo != "regDate" && $campo != "codigo" && $campo != $this->getCampoTabelaRelacionamento()) {
                    if ($v) {
                        $campos .= ",";
                        $valores .= ",";
                    }
                    $campos .= $campo;
                    $valores .= ":$campo";
                    $v = true;
                }
            }
            $this->setSQL("INSERT INTO $tabela ($campos) VALUES ($valores)");
            //print_r("\n> " . __LINE__ . "\tPERSISTENCIA (" . $this->getModel()->getTABELANOME() . ")> " . $this->getSQL());
            $this->setStmt($this->getConn()->prepare($this->getSQL()));
            $this->bindParams();
            $this->getStmt()->execute();
            $this->getConn()->commit();
            if ($this->temRelacionamento) {
                $codOutraTabela = $this->getModel()->getValor($this->getCampoTabelaRelacionamento());
                if ($codOutraTabela != null && count($codOutraTabela) > 0) {
                    // //print_r($codOutraTabela);
                    foreach ($codOutraTabela as $codigo) {
                        $this->executeINSERTRelacionamento($codigo);
                    }
                }
            }
            return "\nInserção realizada com sucesso!";
        } catch (PDOException $e) {
            $this->getConn()->rollback();
            echo "Error: " . $e->getMessage();
        }
    }

    public function bindParams()
    {
        foreach ($this->getModel()->getMAPPING() as $campo => $valor) {
            if ($campo != "regDate" && $campo != "codigo" && $campo != $this->getCampoTabelaRelacionamento()) {
                $this->getStmt()->bindParam(":$campo", $valor["valor"]);
                // //print_r("\n\tcampo: $campo\n\tvalor: " . $valor["valor"] . "\n\ttipo: " . $valor["tipo"] . "\n");
            }
        }
    }

    public function executeSQL(string $SQL = null)
    {
        if ($SQL == null) {
            $SQL = $this->getSQL();
        }
        if (strpos($SQL, "SELECT") !== false) {
            $this->DBConnect();
            $this->setSQL($SQL);
            //print_r("\n> " . __LINE__ . "\tPERSISTENCIA (" . $this->getModel()->getTABELANOME() . ")> " . $this->getSQL());
            $this->setStmt(($this->getConn())->query($this->getSQL()));
            $this->getStmt()->execute();
            $result = $this->getStmt()->fetchAll(PDO::FETCH_ASSOC);
            //print_r("\n> " . __LINE__ . "\tPERSISTENCIA (" . $this->getModel()->getTABELANOME() . ")> Registros retornados: " . count($result));
            return $result;
        }
        try {
            $this->DBConnect();
            $this->getConn()->beginTransaction();
            $this->setStmt($this->getConn()->prepare($SQL));
            $this->getStmt()->execute();
            $tmp = $this->getConn()->commit();
            // print("\nExecução de SQL realizada com sucesso!");
            return $tmp;
        } catch (PDOException $e) {
            $this->getConn()->rollback();
            echo "Error: " . $e->getMessage();
        }
    }

    public function incluir()
    {
        //print_r("\n> " . __LINE__ . "\tPERSISTENCIA (" . $this->getModel()->getTABELANOME() . ")> EFETUANDO INSERÇÃO...\n");
        return $this->executeINSERT();
    }

    public function excluir()
    {
        //print_r("\n> " . __LINE__ . "\tPERSISTENCIA (" . $this->getModel()->getTABELANOME() . ")> EFETUANDO EXCLUSÃO...");
        return $this->executeDELETE();
    }

    public function alterar()
    {
        //print_r("\n> " . __LINE__ . "\tPERSISTENCIA (" . $this->getModel()->getTABELANOME() . ")> EFETUANDO ALTERAÇÃO...\n");
        return $this->executeUPDATE();
    }

    public function DISTINCT()
    {
        if ($this->getDistinct()) {
            return "DISTINCT ";
        } else {
            return "";
        }
    }

    /**
     * Get the value of SERVERNAME
     */
    public function getSERVERNAME()
    {
        return $this->SERVERNAME;
    }

    /**
     * Set the value of SERVERNAME
     *
     * @return  self
     */
    public function setSERVERNAME($SERVERNAME)
    {
        $this->SERVERNAME = $SERVERNAME;
        return $this;
    }

    /**
     * Get the value of DATABASE
     */
    public function getDATABASE()
    {
        return $this->DATABASE;
    }

    /**
     * Set the value of DATABASE
     *
     * @return  self
     */
    public function setDATABASE($DATABASE)
    {
        $this->DATABASE = $DATABASE;
        return $this;
    }

    /**
     * Get the value of USERNAME
     */
    public function getUSERNAME()
    {
        return $this->USERNAME;
    }

    /**
     * Set the value of USERNAME
     *
     * @return  self
     */
    public function setUSERNAME($USERNAME)
    {
        $this->USERNAME = $USERNAME;
        return $this;
    }

    /**
     * Get the value of PASSWORD
     */
    public function getPASSWORD()
    {
        return $this->PASSWORD;
    }

    /**
     * Set the value of PASSWORD
     *
     * @return  self
     */
    public function setPASSWORD($PASSWORD)
    {
        $this->PASSWORD = $PASSWORD;
        return $this;
    }

    /**
     * Get the value of SQL
     */
    public function getSQL()
    {
        return $this->SQL;
    }

    /**
     * Set the value of SQL
     *
     * @return  self
     */
    public function setSQL($SQL)
    {
        $this->SQL = $SQL;
        return $this;
    }

    /**
     * Get the value of conn
     */
    public function getConn()
    {
        return $this->conn;
    }

    /**
     * Set the value of conn
     *
     * @return  self
     */
    public function setConn($connection)
    {
        $this->conn = null;
        $this->conn = $connection;
        return $this;
    }

    /**
     * Get the value of stmt
     */
    public function getStmt()
    {
        return $this->stmt;
    }

    /**
     * Set the value of stmt
     *
     * @return  self
     */
    public function setStmt($stmt)
    {
        $this->stmt = $stmt;
        return $this;
    }

    /**
     * Get the value of Distinct
     */
    public function getDistinct()
    {
        return $this->Distinct;
    }

    /**
     * Set the value of Distinct
     *
     * @return  self
     */
    public function setDistinct()
    {
        $this->Distinct = true;
        return $this;
    }

    /**
     * Get the value of FiltroTabelas
     */
    public function getFiltroTabelas()
    {
        return $this->FiltroTabelas;
    }

    /**
     * Set the value of FiltroTabelas
     *
     * @return  self
     */
    public function setFiltroTabelas($FiltroTabelas)
    {
        $this->FiltroTabelas = $FiltroTabelas;
        return $this;
    }

    /**
     * Get the value of FiltroCampos
     */
    public function getFiltroCampos()
    {
        return $this->FiltroCampos;
    }

    /**
     * Set the value of FiltroCampos
     *
     * @return  self
     */
    public function setFiltroCampos($FiltroCampos)
    {
        if ($this->FiltroCampos == "*") {
            $this->FiltroCampos = "";
        }
        // //print_r(">> Filtro Campos : ". $this->FiltroCampos);
        $this->FiltroCampos = $FiltroCampos;
        return $this;
    }

    /**
     * Get the value of FiltroValores
     */
    public function getFiltroValores()
    {
        return $this->FiltroValores;
    }

    /**
     * Set the value of FiltroValores
     *
     * @return  self
     */
    public function setFiltroValores($FiltroValores)
    {
        if ($this->FiltroValores == "1") {
            $this->FiltroValores = "";
        }
        $this->FiltroValores = $FiltroValores;
        return $this;
    }

    public function limpaFiltros()
    {
        $this->setFiltroCampos("*");
        $this->setFiltroValores("1");
        $this->OrderBy = "";
        $this->setGroupBy("");
        return $this;
    }

    /**
     * Get the value of OrderBy
     */
    public function getOrderBy()
    {
        if ($this->OrderBy == "") {
            return $this->OrderBy;
        } else {
            return " ORDER BY " . $this->OrderBy;
        }
    }

    /**
     * Set the value of OrderBy
     *
     * @return  self
     */
    public function setOrderBy($campo, $ordemDecrescente = null)
    {
        if (($campo != null) or ($campo != "")) {
            if ($ordemDecrescente != null) {
                $this->OrderBy = $campo . " DESC";
            } else {
                $this->OrderBy = $campo . " ASC";
            }
        }
        return $this;
    }

    /**
     * Get the value of GroupBy
     */
    public function getGroupBy()
    {
        if ($this->GroupBy == "") {
            return $this->GroupBy;
        } else {
            return " GROUP BY " . $this->GroupBy;
        }
    }

    /**
     * Set the value of GroupBy
     *
     * @return  self
     */
    public function setGroupBy($campo)
    {
        $this->GroupBy = $campo;
        return $this;
    }

    /**
     * Get the value of JOIN
     */
    public function getJOIN()
    {
        return $this->Join;
    }

    /**
     * Set the value of JOIN
     *
     * @return  self
     */
    public function setJOIN($Join)
    {
        $this->Join = $Join;
        return $this;
    }

    /**
     * Get the value of identificou
     */
    public function getIdentificou()
    {
        return $this->identificou;
    }

    /**
     * Set the value of identificou
     *
     * @return  self
     */
    public function setIdentificou($identificou)
    {
        $this->identificou = $identificou;
        return $this;
    }

    /**
     * Get the value of codigo
     */
    public function getCodigo()
    {
        return $this->getModel()->getValor("codigo");
    }

    /**
     * Set the value of codigo
     *
     * @return  self
     */
    public function setCodigo($codigo)
    {
        $this->getModel()->setValor("codigo", $codigo);
        return $this;
    }

    /**
     * Get the value of regDate
     */
    public function getRegDate()
    {
        return $this->getModel()->getValor("regDate");
    }

    /**
     * Set the value of regDate
     *
     * @return  self
     */
    public function setRegDate($regDate)
    {
        $this->getModel()->setValor("regDate", $regDate);
        return $this;
    }

    public function listaByCodigo(string $codigo = null)
    {
        if ($codigo != null) {
            $this->setFiltroValores("codigo = '$codigo'");
        }
        return $this->executeSELECT();
    }

    public function listaByRegDate(string $regDate = null)
    {
        if ($regDate != null) {
            $this->setFiltroValores("regDate = '$regDate'");
        }
        return $this->executeSELECT();
    }

// ************************** RELACIONAMENTO *********************************************

/**
 * Get the value of Relacionamento
 */
    public function getRelacionamento()
    {
        return $this->Relacionamento;
    }

    // /**
    //  * Set the value of Relacionamento
    //  *
    //  * @return  self
    //  */
    // public function setRelacionamento(iPersistencia $Relacionamento)
    // {
    //     $this->Relacionamento = $Relacionamento;
    //     $this->setCampoTabelaRelacionamento('cod' . substr($this->Relacionamento->getModel()->getTABELANOME(), 1));
    //     $this->setCampoMinhaTabelaNoRelacionamento('cod' . substr($this->getModel()->getTABELANOME(), 1));
    //     $codigoRelacionamento = $this->Relacionamento->getModel()->getMAPPING()['codigo'];
    //     // $a = array($codigoRelacionamento);
    //     if(!$this->getModel()->temCampoMAPPING($this->getCampoTabelaRelacionamento())){
    //         $this->getModel()->addValorMAPPING($this->getCampoTabelaRelacionamento(), $codigoRelacionamento['tipo'], $codigoRelacionamento['valor']);
    //     }
    //     $this->buscaDadosRelacionamento();
    //     $this->temRelacionamento = true;
    //     return $this;
    // }

    public function setRelacionamento($Relacionamento)
    {
        $this->Relacionamento = $Relacionamento;
        $this->setCampoTabelaRelacionamento('cod' . substr($Relacionamento, 1));
        $this->setCampoMinhaTabelaNoRelacionamento('cod' . substr($this->getModel()->getTABELANOME(), 1));
        if (!$this->getModel()->temCampoMAPPING($this->getCampoTabelaRelacionamento())) {
            $this->getModel()->addCampoMAPPING($this->getCampoTabelaRelacionamento(), "int", "");
        }
        if ($this->getIdentificou()) {
            $this->buscaDadosRelacionamento();
        }
        $this->temRelacionamento = true;
        return $this;
    }

    /**
     * Add a value to Relacionamento
     *
     * @return  self
     */
    public function addRelacionamento($oRelacionamento)
    {
        // //print_r("\n> ".__LINE__."\tPERSISTENCIA (" . $this->getModel()->getTABELANOME() . ")> INICIALIZANDO RELACIONAMENTO...");
        if ($this->Relacionamento == null) {
            $this->Relacionamento = array();
        }
        array_push($this->Relacionamento, $oRelacionamento);
        // //print_r("\n> ".__LINE__."\tPERSISTENCIA (" . $this->getModel()->getTABELANOME() . ")> INICIALIZAÇÃO DE RELACIONAMENTO FINALIZADA.\n");
        return $this;
    }

    public function buscaDadosRelacionamento()
    {
        $result = $this->executeSELECTRelacionamento();
        // //print_r($result);
        foreach ($result as $campos) {
            $valor = $campos[$this->getCampoTabelaRelacionamento()];
            // //print_r($valor);
            $this->getModel()->setValorArray($this->getCampoTabelaRelacionamento(), $valor);
        }
        return $result;
    }

    private function executeSELECTRelacionamento()
    {
        $this->identificaSimples();
        $this->setOrderBy($this->getCampoTabelaRelacionamento());
        $this->executeSQL("SELECT " . $this->getFiltroCampos() . " FROM " . $this->getTabelaIntermediaria() . " AS tr INNER JOIN " . $this->getRelacionamento() . " AS t2 ON (tr." . $this->getCampoTabelaRelacionamento() . "=t2.codigo) WHERE tr." . $this->getCampoMinhaTabelaNoRelacionamento() . "=" . $this->getCodigo() . $this->getGroupBy() . $this->getOrderBy() . ";");
        //print_r("\n> " . __LINE__ . "\tPERSISTENCIA (" . $this->getModel()->getTABELANOME() . ") RELACIONAMENTO > " . $this->getSQL());
        return $this->executeSQL();
    }

    private function executeUPDATERelacionamento()
    {
        // $this->identificaSimples();
        $temp = $this->executeSELECTRelacionamento();
        if (count($temp) <= 0) {
            foreach ($this->getModel()->getValor($this->getCampoTabelaRelacionamento()) as $codClinica) {
                $this->executeINSERTRelacionamento($codClinica);
            }
        } else {
            $this->executeDELETERelacionamento();
            foreach ($this->getModel()->getValor($this->getCampoTabelaRelacionamento()) as $codClinica) {
                $this->executeINSERTRelacionamento($codClinica);
            }
        }
    }

    private function executeINSERTRelacionamento(string $codigo)
    {
        $this->identificaSimples();
        $this->setSQL("INSERT INTO " . $this->getTabelaIntermediaria() . " (" . $this->getCampoMinhaTabelaNoRelacionamento() . "," . $this->getCampoTabelaRelacionamento() . ") VALUES (" . $this->getCodigo() . "," . $codigo . ")");
        //print_r("\n> " . __LINE__ . "\tPERSISTENCIA (" . $this->getModel()->getTABELANOME() . ") RELACIONAMENTO > " . $this->getSQL());
        $this->executeSQL();
    }

    private function executeDELETERelacionamento()
    {
        // $this->identificaSimples();
        $this->setSQL("DELETE FROM " . $this->getTabelaIntermediaria() . " WHERE " . $this->getCampoMinhaTabelaNoRelacionamento() . "=" . $this->getCodigo() . ";");
        //print_r("\n> " . __LINE__ . "\tPERSISTENCIA (" . $this->getModel()->getTABELANOME() . ") RELACIONAMENTO > " . $this->getSQL());
        $this->executeSQL();
    }

    /**
     * Get the value of TabelaIntermediaria
     */
    public function getTabelaIntermediaria()
    {
        return $this->TabelaIntermediaria;
    }

    /**
     * Set the value of TabelaIntermediaria
     *
     * @return  self
     */
    public function setTabelaIntermediaria($TabelaIntermediaria)
    {
        $this->TabelaIntermediaria = $TabelaIntermediaria;
        return $this;
    }

    /**
     * Get the value of campoTabelaRelacionamento
     */
    public function getCampoTabelaRelacionamento()
    {
        return $this->campoTabelaRelacionamento;
    }

    /**
     * Set the value of campoTabelaRelacionamento
     *
     * @return  self
     */
    public function setCampoTabelaRelacionamento($campoTabelaRelacionamento)
    {
        $this->campoTabelaRelacionamento = $campoTabelaRelacionamento;
        return $this;
    }

    /**
     * Get the value of campoMinhaTabelaNoRelacionamento
     */
    public function getCampoMinhaTabelaNoRelacionamento()
    {
        return $this->campoMinhaTabelaNoRelacionamento;
    }

    /**
     * Set the value of campoMinhaTabelaNoRelacionamento
     *
     * @return  self
     */
    public function setCampoMinhaTabelaNoRelacionamento($campoMinhaTabelaNoRelacionamento)
    {
        $this->campoMinhaTabelaNoRelacionamento = $campoMinhaTabelaNoRelacionamento;
        return $this;
    }

}
