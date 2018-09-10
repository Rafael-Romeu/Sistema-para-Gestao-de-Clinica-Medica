<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set('America/Sao_Paulo');
include_once "iPersistencia.php";

class Persistencia implements iPersistencia
{

    private $SERVERNAME;
    private $DATABASE;
    private $USERNAME;
    private $PASSWORD;
    private $TABELA;
    private $TABELACAMPOS;
    private $TABELACAMPOSTIPO;
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
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function DBDisconnect()
    {
        $this->setConn(null);
    }

    public function executeSELECT()
    {
        try {
            $this->DBConnect();
            $SQL = "SELECT " . $this->DISTINCT() . $this->getFiltroCampos() . " FROM " . $this->getTABELA() . " " . $this->getJOIN() . " WHERE " . $this->getFiltroValores() . $this->getGroupBy() . $this->getOrderBy() . ";";
            print_r($SQL);
            $this->setStmt(($this->getConn())->query($SQL));
            $this->getStmt()->execute();
            $result = $this->getStmt()->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $this->DBDisconnect();
        return $result;
    }

    public function InnerJOIN($tabelaDireita, $meuCampo, $campoTabelaDireita){
        $this->setJOIN("INNER JOIN ".$tabelaDireita." ON ".$this->getTABELA().".".$meuCampo."=".$tabelaDireita.".".$campoTabelaDireita);
    }

    public function RightJOIN($tabelaDireita, $meuCampo, $campoTabelaDireita){
        $this->setJOIN("RIGHT JOIN ".$tabelaDireita." ON ".$this->getTABELA().".".$meuCampo."=".$tabelaDireita.".".$campoTabelaDireita);
    }

    public function LeftJOIN($tabelaDireita, $meuCampo, $campoTabelaDireita){
        $this->setJOIN("LEFT JOIN ".$tabelaDireita." ON ".$this->getTABELA().".".$meuCampo."=".$tabelaDireita.".".$campoTabelaDireita);
    }

    public function FullJOIN($tabelaDireita, $meuCampo, $campoTabelaDireita){
        $this->setJOIN("FULL JOIN ".$tabelaDireita." ON ".$this->getTABELA().".".$meuCampo."=".$tabelaDireita.".".$campoTabelaDireita);
    }

    // SELECT Orders.OrderID, Customers.CustomerName, Orders.OrderDate
    // FROM Orders
    // INNER JOIN Customers ON Orders.CustomerID=Customers.CustomerID;

    // public function incluir()
    // {
    //     try {
    //         $this->setCONNECTION(new PDO("mysql:host="+$this->getSERVERNAME()+";dbname="+$this->getDATABASE(), $this->getUSERNAME(), $this->getPASSWORD()));
    //         $this->getCONNECTION()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //         $this->getCONNECTION()->beginTransaction();

    //         // prepare sql and bind parameters
    //         // "INSERT INTO MyGuests (firstname, lastname, email) VALUES (?, ?, ?)"
    //         // $stmt->bind_param("sss", $firstname, $lastname, $email);
    //         $stmt = $conn->prepare("INSERT INTO "+$this->getTABELA()+" ("+$this->getTABELACAMPOS()+") VALUES ("+$this->_getTABELACAMPOS()+")");
    //         // $stmt->bindParam(':firstname', $firstname);
    //         // $stmt->bindParam(':lastname', $lastname);
    //         // $stmt->bindParam(':email', $email);

    //         $conn->commit();
    //     } catch (PDOException $e) {
    //         $conn->rollback();
    //         echo "Error: " . $e->getMessage();
    //     }

    //     $conn = null;
    // }

    // public function alterar()
    // {

    // }

    // public function excluir()
    // {

    // }

    // public function identifica()
    // {
    //     return false;
    // }

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
     * Get the value of TABELA
     */
    public function getTABELA()
    {
        return $this->TABELA;
    }

    /**
     * Set the value of TABELA
     *
     * @return  self
     */
    public function setTABELA($TABELA)
    {
        $this->TABELA = $TABELA;
        return $this;
    }

    /**
     * Get the value of TABELACAMPOS
     */
    public function getTABELACAMPOS()
    {
        return $this->TABELACAMPOS;
    }

    /**
     * Set the value of TABELACAMPOS
     *
     * @return  self
     */
    public function setTABELACAMPOS($TABELACAMPOS)
    {
        $this->TABELACAMPOS = $TABELACAMPOS;
        return $this;
    }

    /**
     * [PRIVATE] _getTABELACAMPOS
     *
     * Retorna a quantidade exata de "?" para compor o statement do INSERT
     *
     * @return $camposInterrogacao
     */
    protected function _getTABELACAMPOS()
    {
        $result = "?";
        $campos = $this->getTABELACAMPOS();
        $campos = explode(",", $campos);
        for ($i = 0; $i < count($campos) - 1; $i++) {
            $result .= ",";
            $result .= "?";
        }
        return $result;
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
     * Get the value of TABELACAMPOSTIPO
     */
    public function getTABELACAMPOSTIPO()
    {
        return $this->TABELACAMPOSTIPO;
    }

    /**
     * Set the value of TABELACAMPOSTIPO
     *
     * @return  self
     */
    public function setTABELACAMPOSTIPO($TABELACAMPOSTIPO)
    {
        $this->TABELACAMPOSTIPO = $TABELACAMPOSTIPO;
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
        if($this->FiltroCampos == "*"){
            $this->FiltroCampos = "";
        }
        $this->FiltroCampos .= $FiltroCampos;
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
        if($this->FiltroValores == "1"){
            $this->FiltroValores = "";
        }
        $this->FiltroValores .= $FiltroValores;
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
