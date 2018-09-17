<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set('America/Sao_Paulo');
include_once "Model.php";
include_once "Filtro.php";

class Persistencia
{
    private $Model;
    private $SERVERNAME;
    private $DATABASE;
    private $USERNAME;
    private $PASSWORD;
    private $SQL;

    private $conn;
    private $stmt;
    private $FiltroCampos;
    private $FiltroValores;
    private $Join;
    private $Distinct;
    private $OrderBy;
    private $AscDesc;
    private $GroupBy;

    private $identificou;

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
        $this->Model = new Model();
        $this->Model->setTABELANOME($Tabela);
        $this->Model->setSCHEMA($this->schema($Tabela));
        return $this;
    }

    public function DBConnect()
    {
        try {
            $this->setConn(new PDO("mysql:host=" . $this->getSERVERNAME() . ";dbname=" . $this->getDATABASE(), $this->getUSERNAME(), $this->getPASSWORD()));
            $this->getConn()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            print_r("\nPERSISTENCIA (".$this->getModel()->getTABELANOME().")> Connect");
            return $this->getConn();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function DBDisconnect()
    {
        print_r("\nPERSISTENCIA (".$this->getModel()->getTABELANOME().")> Disconnect\n");
        $this->setConn(null);
    }

    public function schema($table)
    {
        $q = $this->DBConnect()->prepare("SHOW COLUMNS FROM `$table`");
        $q->execute();
        $q = $q->fetchAll();
        print_r("\nPERSISTENCIA (".$this->getModel()->getTABELANOME().")> Preenchendo Model...");
        // print_r($q);
        $this->DBDisconnect();
        return $q;
    }

    public function identifica()
    {
        $oFiltro = new Filtro();
        foreach ($this->getModel()->getMAPPING() as $campo => $valor) {
            if ($valor["valor"] != null && $valor["valor"] != "" && $valor["valor"] != "1900-01-01") {
                if($campo != "regDate"){
                    $oFiltro->equals($campo, $valor["valor"]);
                }
            }
        }
        $this->setFiltroValores($oFiltro->toString());
        $result = $this->executeSELECT();
        if (count($result) == 1) {
            foreach ($result[0] as $campo => $valor) {
                $this->getModel()->setValor($campo, $valor);
            }
            // print_r($result);
            print_r("\nPERSISTENCIA (".$this->getModel()->getTABELANOME().")> Identifica True\n");
            $this->setIdentificou(true);
            return true;
        } else {
            print_r("\nPERSISTENCIA (".$this->getModel()->getTABELANOME().")> Identifica False\n");
            $this->setIdentificou(false);
            return false;
        }
    }

    /***
     * Identifica e NÃO preenche os campos do Model
     */
    public function identificaSimples()
    {
        $oFiltro = new Filtro();
        foreach ($this->getModel()->getMAPPING() as $campo => $valor) {
            if ($valor["valor"] != null && $valor["valor"] != "" && $valor["valor"] != "1900-01-01") {
                $oFiltro->equals($campo, $valor["valor"]);
            }
        }
        $this->setFiltroValores($oFiltro->toString());
        $result = $this->executeSELECT();
        if (count($result) == 1) {
            print_r("\nPERSISTENCIA (".$this->getModel()->getTABELANOME().")> Identifica Simples True\n");
            return true;
        } else {
            print_r("\nPERSISTENCIA (".$this->getModel()->getTABELANOME().")> Identifica Simples False\n");
            return false;
        }
    }

    public function executeSELECT()
    {
        try {
            $this->DBConnect();
            // print_r(">>> FILTRO CAMPOS (".$this->getModel()->getTABELANOME()."): ".$this->getFiltroCampos());
            $this->setSQL("SELECT " . $this->DISTINCT() . $this->getFiltroCampos() . " FROM " . $this->getModel()->getTABELANOME() . " " . $this->getJOIN() . " WHERE " . $this->getFiltroValores() . $this->getGroupBy() . $this->getOrderBy() . ";");
            print_r("\nPERSISTENCIA (".$this->getModel()->getTABELANOME().")> " . $this->getSQL());
            $this->setStmt(($this->getConn())->query($this->getSQL()));
            $this->getStmt()->execute();
            $result = $this->getStmt()->fetchAll(PDO::FETCH_ASSOC);
            print_r("\nPERSISTENCIA (".$this->getModel()->getTABELANOME().")> Registros retornados: " . count($result));
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $this->DBDisconnect();
        return $result;
    }

    public function InnerJOIN($tabelaDireita, $meuCampo, $campoTabelaDireita)
    {
        $this->setJOIN("INNER JOIN " . $tabelaDireita . " ON " . $this->getTABELANOME() . "." . $meuCampo . "=" . $tabelaDireita . "." . $campoTabelaDireita);
    }

    public function RightJOIN($tabelaDireita, $meuCampo, $campoTabelaDireita)
    {
        $this->setJOIN("RIGHT JOIN " . $tabelaDireita . " ON " . $this->getTABELANOME() . "." . $meuCampo . "=" . $tabelaDireita . "." . $campoTabelaDireita);
    }

    public function LeftJOIN($tabelaDireita, $meuCampo, $campoTabelaDireita)
    {
        $this->setJOIN("LEFT JOIN " . $tabelaDireita . " ON " . $this->getTABELANOME() . "." . $meuCampo . "=" . $tabelaDireita . "." . $campoTabelaDireita);
    }

    public function executeDELETE()
    {
        if (!$this->identifica()) {
            print_r("\nPERSISTENCIA (".$this->getModel()->getTABELANOME().")> Não foi possível identificar o registro. Informe mais parâmetros.\n");
            return "Não foi possível identificar o registro. Informe mais parâmetros.\n";
        }
        $this->setFiltroValores("codigo='" . $this->getModel()->getMAPPING()["codigo"]["valor"]."'");
        return ($this->executeDELETEcompleto());
    }

    public function executeDELETEcompleto()
    {
        try {
            $this->DBConnect();
            $this->setSQL("DELETE FROM " . $this->getModel()->getTABELANOME() . " WHERE " . $this->getFiltroValores() . ";");
            print_r("\nPERSISTENCIA (".$this->getModel()->getTABELANOME().")> " . $this->getSQL());
            $this->setStmt(($this->getConn())->prepare($this->getSQL()));
            $this->getStmt()->execute();
            print_r("\nPERSISTENCIA (".$this->getModel()->getTABELANOME().")> Exclusão efetuada com sucesso!\n");
            $this->DBDisconnect();
            return "Exclusão efetuada com sucesso!\n";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            $this->DBDisconnect();
        }
    }

    public function executeUPDATE()
    {
        if (!$this->identificaSimples()) {
            print_r("\nPERSISTENCIA (".$this->getModel()->getTABELANOME().")> Não foi possível identificar o registro. Informe mais parâmetros.\n");
            return "Não foi possível identificar o registro. Informe mais parâmetros.\n";
        }
        $this->setFiltroValores("codigo=" . $this->getModel()->getMAPPING()["codigo"]["valor"]);
        return ($this->executeUPDATEcompleto());
    }

    /***
     * @param string $campos Campos a serem alterados, separados por virgula (ex: "codigo,nome");
     */
    public function executeUPDATEcompleto($camposSelecionados = null)
    {
        // print_r($this->getModel()->getMAPPING());
        try {
            $this->DBConnect();
            $this->getConn()->beginTransaction();
            $campos = "";

            // print_r($this->getModel()->getMAPPING());
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
                    if ($campo != "codigo" && $campo != "regDate") {
                        if ($v) {
                            $campos .= ",";
                        }
                        $campos .= "$campo='" . $valor["valor"] . "'";
                        $v = true;
                    }
                }
            }
            print("\ncampos: $campos\n");
            $this->setSQL("UPDATE $tabela SET $campos WHERE " . $this->getFiltroValores() . ";");
            print_r("\nPERSISTENCIA (".$this->getModel()->getTABELANOME().")> " . $this->getSQL() . "\n");
            $this->setStmt($this->getConn()->prepare($this->getSQL()));
            $this->bindParams();
            $this->getStmt()->execute();
            $this->getConn()->commit();
            return "Alteração realizada com sucesso!";
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
            // print_r($this->getModel());
            $tabela = $this->getModel()->getTABELANOME();
            foreach ($this->getModel()->getMAPPING() as $campo => $valor) {
                if ($campo != "regDate") {
                    if ($v) {
                        $campos .= ",";
                        $valores .= ",";
                    }
                    $campos .= $campo;
                    $valores .= ":$campo";
                    $v = true;
                }
            }
            // for ($i = 1; $i < count($this->getModel()->getTABELACAMPOS()) - 1; $i++) {
            //     $campo = $this->getModel()->getTABELACAMPOS()[$i];
            //     $campos .= ($i == 1) ? "" : ",";
            //     $campos .= $campo;
            //     $valores .= ($i == 1) ? ":$campo" : ",:$campo";
            //     // $valores .= ($this->getModel()->getMAPPING()[$campo] == "")? "''": $this->getModel()->getMAPPING()[$campo];
            // }
            // print("\ncampos: $campos\nvalores: $valores\n");
            $this->setSQL("INSERT INTO $tabela ($campos) VALUES ($valores)");
            print_r("\nPERSISTENCIA (".$this->getModel()->getTABELANOME().")> " . $this->getSQL() . "\n");
            $this->setStmt($this->getConn()->prepare($this->getSQL()));
            // print("\n\n\n> Antes: \n");
            // print_r($this->getStmt());
            $this->bindParams();
            // print("\n\n\n> Depois: \n");
            // print_r($this->getStmt());
            $this->getStmt()->execute();
            $this->getConn()->commit();
            return "Inserção realizada com sucesso!";
        } catch (PDOException $e) {
            $this->getConn()->rollback();
            echo "Error: " . $e->getMessage();
        }
    }

    public function bindParams()
    {
        // print_r($this->getModel()->getMAPPING());
        foreach ($this->getModel()->getMAPPING() as $campo => $valor) {
            print_r("\n\tcampo: $campo\n\tvalor: " . $valor["valor"] . "\n\ttipo: " . $valor["tipo"] . "\n");
            if ($campo != "regDate") {
                $this->getStmt()->bindParam(":$campo", $valor["valor"]);
            }
        }
    }

    public function executeSQL(string $SQL = null)
    {
        if ($SQL == null) {
            $SQL = $this->getSQL();
        }
        try {
            $this->DBConnect();
            $this->getConn()->beginTransaction();
            $this->setStmt($this->getConn()->prepare($SQL));
            // $this->bindParams();
            $this->getStmt()->execute();
            $this->getConn()->commit();
            return "Inserção realizada com sucesso!";
        } catch (PDOException $e) {
            $this->getConn()->rollback();
            echo "Error: " . $e->getMessage();
        }
    }

    public function incluir()
    {
        return $this->executeINSERT();
    }

    public function excluir()
    {
        return $this->executeDELETE();
    }

    public function alterar()
    {
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
        // print_r(">> Filtro Campos : ". $this->FiltroCampos);
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
}
