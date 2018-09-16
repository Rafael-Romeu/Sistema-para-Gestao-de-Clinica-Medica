<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set('America/Sao_Paulo');
include_once "iPersistencia.php";
include_once "Model.php";
include_once "Filtro.php";

class Persistencia implements iPersistencia
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

    public function DBConnect()
    {
        try {
            $this->setConn(new PDO("mysql:host=" . $this->getSERVERNAME() . ";dbname=" . $this->getDATABASE(), $this->getUSERNAME(), $this->getPASSWORD()));
            $this->getConn()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            print_r("\nPERSISTENCIA > Connect\n");
            return $this->getConn();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function DBDisconnect()
    {
        print_r("\nPERSISTENCIA > Disconnect\n");
        $this->setConn(null);
    }

    public function executeSELECT()
    {
        try {
            $this->DBConnect();
            $SQL = "SELECT " . $this->DISTINCT() . $this->getFiltroCampos() . " FROM " . $this->getModel()->getTABELANOME() . " " . $this->getJOIN() . " WHERE " . $this->getFiltroValores() . $this->getGroupBy() . $this->getOrderBy() . ";";
            print_r("\nPERSISTENCIA > " . $SQL . "\n\n");
            $this->setStmt(($this->getConn())->query($SQL));
            $this->getStmt()->execute();
            $result = $this->getStmt()->fetchAll(PDO::FETCH_ASSOC);
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

    public function schema($table)
    {
        $q = $this->DBConnect()->prepare("SHOW COLUMNS FROM `$table`");
        $q->execute();
        $q = $q->fetchAll();
        $this->DBDisconnect();
        return $q;
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
            foreach ($this->getModel()->getTABELACAMPOS() as $campo) {
                if ($campo[0] != "codigo" && $campo[0] != "regDate") {
                    if ($v) {
                        $campos .= ",";
                        $valores .= ",";
                    }
                    $campos .= $campo[0];
                    $valores .= ":$campo[0]";
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
            $SQL = "INSERT INTO $tabela ($campos) VALUES ($valores)";
            print_r("\n" . $SQL . "\n");
            $this->setStmt($this->getConn()->prepare($SQL));
            print("\n\n\n> Antes: \n");
            print_r($this->getStmt());
            foreach ($this->getModel()->getTABELACAMPOS() as $campo) {
                if ($campo[0] != "codigo" && $campo[0] != "regDate") {
                    $this->getStmt()->bindParam(":$campo[0]", $this->getModel()->getMAPPING()[$campo[0]]["valor"]);
                }
            }
            print("\n\n\n> Depois: \n");
            $this->getStmt()->execute();
            // print_r($this->getStmt());
            // $stmt->bindParam(':firstname', $firstname);
            // $stmt->bindParam(':lastname', $lastname);
            // $stmt->bindParam(':email', $email);
            $this->getConn()->commit();
            // $conn->commit();
            return "Inserção realizada com sucesso!";
        } catch (PDOException $e) {
            $this->getConn()->rollback();
            echo "Error: " . $e->getMessage();
        }
    }

    public function bindParams()
    {
        # Necessario ser reimplementada em cada sub-classe
    }

    public function alterar()
    {

    }

    public function excluir()
    {

    }

    public function getValor(string $campo)
    {

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

}
