<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set('America/Sao_Paulo');
include_once "Persistencia.php";

class lClinica extends Persistencia
{
    private $relacionamentoNome;

    public function __construct()
    {
        parent::__construct();
        $this->setModel("tClinica");
    }

    public function incluir()
    {
        switch ($this->relacionamentoNome) {
            case 'Atendente':
                $this->setTabelaIntermediaria("tClinicaAtendente");
                $this->setRelacionamento("tAtendente");
                parent::incluir();
                break;
            case 'Medico':
                $this->setTabelaIntermediaria("tClinicaMedico");
                $this->setRelacionamento("tMedico");
                parent::incluir();
                break;
            case 'Paciente':
                $this->setTabelaIntermediaria("tClinicaPaciente");
                $this->setRelacionamento("tPaciente");
                parent::incluir();
                break;
            default:
                # code...
                break;
        }
    }

    public function alterar()
    {
        switch ($this->relacionamentoNome) {
            case 'Atendente':
                $this->setTabelaIntermediaria("tClinicaAtendente");
                $this->setRelacionamento("tAtendente");
                parent::alterar();
                break;
            case 'Medico':
                $this->setTabelaIntermediaria("tClinicaMedico");
                $this->setRelacionamento("tMedico");
                parent::alterar();
                break;
            case 'Paciente':
                $this->setTabelaIntermediaria("tClinicaPaciente");
                $this->setRelacionamento("tPaciente");
                parent::alterar();
                break;
            default:
                # code...
                break;
        }
    }

    public function excluir()
    {
        $this->setTabelaIntermediaria("tClinicaAtendente");
        $this->setRelacionamento("tAtendente");
        parent::excluir();
        $this->setTabelaIntermediaria("tClinicaMedico");
        $this->setRelacionamento("tMedico");
        parent::excluir();
        $this->setTabelaIntermediaria("tClinicaPaciente");
        $this->setRelacionamento("tPaciente");
        parent::excluir();
    }

    public function listaClinicaByNome(string $nome = null)
    {

        if ($nome != null) {
            $this->setFiltroValores("nome = '$nome'");
        }
        return $this->executeSELECT();
    }

    public function listaClinicaByCnpj(string $cnpj = null)
    {

        if ($cnpj != null) {
            $this->setFiltroValores("cnpj = '$cnpj'");
        }
        return $this->executeSELECT();
    }

    public function listaClinicaByEndereco(string $endereco = null)
    {

        if ($endereco != null) {
            $this->setFiltroValores("endereco = '$endereco'");
        }
        return $this->executeSELECT();
    }

    public function listaClinicaByCEP(string $CEP = null)
    {

        if ($CEP != null) {
            $this->setFiltroValores("CEP = '$CEP'");
        }
        return $this->executeSELECT();
    }

    public function listaClinicaByTelefone1(string $telefone1 = null)
    {

        if ($telefone1 != null) {
            $this->setFiltroValores("telefone1 = '$telefone1'");
        }
        return $this->executeSELECT();
    }

    public function listaClinicaByTelefone2(string $telefone2 = null)
    {

        if ($telefone2 != null) {
            $this->setFiltroValores("telefone2 = '$telefone2'");
        }
        return $this->executeSELECT();
    }

    public function listaClinicaByEmail(string $email = null)
    {

        if ($email != null) {
            $this->setFiltroValores("email = '$email'");
        }
        return $this->executeSELECT();
    }

    public function listaClinicaByTemaCSS(string $temaCSS = null)
    {

        if ($temaCSS != null) {
            $this->setFiltroValores("temaCSS = '$temaCSS'");
        }
        return $this->executeSELECT();
    }

    public function listaAtendentes()
    {
        $this->setTabelaIntermediaria("tClinicaAtendente");
        $this->setRelacionamento("tAtendente");
        return $this->buscaDadosRelacionamento();
    }

    public function listaMedicos()
    {
        $this->setTabelaIntermediaria("tClinicaMedico");
        $this->setRelacionamento("tMedico");
        return $this->buscaDadosRelacionamento();
    }

    /***
     * Busca os horarios de todos os medicos da clinica e que possuem horarios cadastrado pra esta clinica.
     * 
     * @return $horarios  Array de "seg" a "sex" com os horarios, no formato "[codMedico] => 000101010..."
     * 
     */
    public function listaHorariosMedicos($codClinica=null)
    {
        if($codClinica==null){
            $a = $this;
        }else{
            $a = new lClinica();
            $a->setCodigo($codClinica);
            $a->identifica();
        }
        $b = $a->listaMedicos();
        $arraySeg = array();
        $arrayTer = array();
        $arrayQua = array();
        $arrayQui = array();
        $arraySex = array();
        foreach ($b as $medicos => $medico) {
            $oMedico = new lMedico();
            $oMedico->setCodigo($medico["codigo"]);
            $oMedico->identifica();
            $horario = $oMedico->listaHorarios($a->getCodigo());
            if (count($horario) > 0) {
                $arrayTemp = array($medico["codigo"] => $horario[0]["seg"]);
                $arraySeg += $arrayTemp;
                $arrayTemp = array($medico["codigo"] => $horario[0]["ter"]);
                $arrayTer += $arrayTemp;
                $arrayTemp = array($medico["codigo"] => $horario[0]["qua"]);
                $arrayQua += $arrayTemp;
                $arrayTemp = array($medico["codigo"] => $horario[0]["qui"]);
                $arrayQui += $arrayTemp;
                $arrayTemp = array($medico["codigo"] => $horario[0]["sex"]);
                $arraySex += $arrayTemp;
            }
        }
        $horarios = array("seg" => $arraySeg);
        $horarios += array("ter" => $arrayTer);
        $horarios += array("qua" => $arrayQua);
        $horarios += array("qui" => $arrayQui);
        $horarios += array("sex" => $arraySex);
        return $horarios;
    }

    public function listaPacientes()
    {
        $this->setTabelaIntermediaria("tClinicaPaciente");
        $this->setRelacionamento("tPaciente");
        return $this->buscaDadosRelacionamento();
    }

    /**
     * Get the value of nome
     */
    public function getNome()
    {
        return $this->getModel()->getValor("nome");
    }

    /**
     * Set the value of nome
     *
     * @return  self
     */
    public function setNome($nome)
    {
        $this->getModel()->setValor("nome", $nome);
        return $this;
    }

    /**
     * Get the value of cnpj
     */
    public function getCnpj()
    {
        return $this->getModel()->getValor("cnpj");
    }

    /**
     * Set the value of cnpj
     *
     * @return  self
     */
    public function setCnpj($cnpj)
    {
        $this->getModel()->setValor("cnpj", $cnpj);
        return $this;
    }

    /**
     * Get the value of endereco
     */
    public function getEndereco()
    {
        return $this->getModel()->getValor("endereco");
    }

    /**
     * Set the value of endereco
     *
     * @return  self
     */
    public function setEndereco($endereco)
    {
        $this->getModel()->setValor("endereco", $endereco);
        return $this;
    }

    /**
     * Get the value of CEP
     */
    public function getCEP()
    {
        return $this->getModel()->getValor("CEP");
    }

    /**
     * Set the value of CEP
     *
     * @return  self
     */
    public function setCEP($CEP)
    {
        $this->getModel()->setValor("CEP", $CEP);
        return $this;
    }

    /**
     * Get the value of telefone1
     */
    public function getTelefone1()
    {
        return $this->getModel()->getValor("telefone1");
    }

    /**
     * Set the value of telefone1
     *
     * @return  self
     */
    public function setTelefone1($telefone1)
    {
        $this->getModel()->setValor("telefone1", $telefone1);
        return $this;
    }

    /**
     * Get the value of telefone2
     */
    public function getTelefone2()
    {
        return $this->getModel()->getValor("telefone2");
    }

    /**
     * Set the value of telefone2
     *
     * @return  self
     */
    public function setTelefone2($telefone2)
    {
        $this->getModel()->setValor("telefone2", $telefone2);
        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->getModel()->getValor("email");
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->getModel()->setValor("email", $email);
        return $this;
    }

    /**
     * Get the value of corPrimaria
     */
    public function getCorPrimaria()
    {
        return $this->getModel()->getValor("corPrimaria");
    }

    /**
     * Set the value of corPrimaria
     *
     * @return  self
     */
    public function setCorPrimaria($corPrimaria)
    {
        $this->getModel()->setValor("corPrimaria", $corPrimaria);
        return $this;
    }

    /**
     * Get the value of corSucesso
     */
    public function getCorSucesso()
    {
        return $this->getModel()->getValor("corSucesso");
    }

    /**
     * Set the value of corSucesso
     *
     * @return  self
     */
    public function setCorSucesso($corSucesso)
    {
        $this->getModel()->setValor("corSucesso", $corSucesso);
        return $this;
    }

    /**
     * Get the value of corFalha
     */
    public function getCorFalha()
    {
        return $this->getModel()->getValor("corFalha");
    }

    /**
     * Set the value of corFalha
     *
     * @return  self
     */
    public function setCorFalha($corFalha)
    {
        $this->getModel()->setValor("corFalha", $corFalha);
        return $this;
    }

    /**
     * Get the value of cor1
     */
    public function getCor1()
    {
        return $this->getModel()->getValor("cor1");
    }

    /**
     * Set the value of cor1
     *
     * @return  self
     */
    public function setCor1($cor1)
    {
        $this->getModel()->setValor("cor1", $cor1);
        return $this;
    }

    /**
     * Get the value of cor2
     */
    public function getCor2()
    {
        return $this->getModel()->getValor("cor2");
    }

    /**
     * Set the value of cor2
     *
     * @return  self
     */
    public function setCor2($cor2)
    {
        $this->getModel()->setValor("cor2", $cor2);
        return $this;
    }

    /**
     * Get the value of cor3
     */
    public function getCor3()
    {
        return $this->getModel()->getValor("cor3");
    }

    /**
     * Set the value of cor3
     *
     * @return  self
     */
    public function setCor3($cor3)
    {
        $this->getModel()->setValor("cor3", $cor3);
        return $this;
    }

    /**
     * Get the value of cor4
     */
    public function getCor4()
    {
        return $this->getModel()->getValor("cor4");
    }

    /**
     * Set the value of cor4
     *
     * @return  self
     */
    public function setCor4($cor4)
    {
        $this->getModel()->setValor("cor4", $cor4);
        return $this;
    }

    /**
     * Get the value of cor5
     */
    public function getCor5()
    {
        return $this->getModel()->getValor("cor5");
    }

    /**
     * Set the value of cor5
     *
     * @return  self
     */
    public function setCor5($cor5)
    {
        $this->getModel()->setValor("cor5", $cor5);
        return $this;
    }

    /**
     * Get the value of codAtendente
     */
    public function getCodAtendente()
    {
        $this->$relacionamentoNome = "Atendente";
        $this->setTabelaIntermediaria("tClinicaAtendente");
        $this->setRelacionamento("tAtendente");
        return $this->getModel()->getValor("codAtendente");
    }

    /**
     * Set the value of codAtendente
     *
     * @return  self
     */
    public function setCodAtendente($codAtendente)
    {
        $this->relacionamentoNome = "Atendente";
        $this->setTabelaIntermediaria("tClinicaAtendente");
        $this->setRelacionamento("tAtendente");
        $this->getModel()->setValorArray("codAtendente", $codAtendente);
        return $this;
    }

    /**
     * Get the value of codMedico
     */
    public function getCodMedico()
    {
        $this->relacionamentoNome = "Medico";
        $this->setTabelaIntermediaria("tClinicaMedico");
        $this->setRelacionamento("tMedico");
        return $this->getModel()->getValor("codMedico");
    }

    /**
     * Set the value of codMedico
     *
     * @return  self
     */
    public function setCodMedico($codMedico)
    {
        $this->relacionamentoNome = "Medico";
        $this->setTabelaIntermediaria("tClinicaMedico");
        $this->setRelacionamento("tMedico");
        $this->getModel()->setValorArray("codMedico", $codMedico);
        return $this;
    }

    /**
     * Get the value of codPaciente
     */
    public function getCodPaciente()
    {
        $this->$relacionamentoNome = "Paciente";
        $this->setTabelaIntermediaria("tClinicaPaciente");
        $this->setRelacionamento("tPaciente");
        return $this->getModel()->getValor("codPaciente");
    }

    /**
     * Set the value of codPaciente
     *
     * @return  self
     */
    public function setCodPaciente($codPaciente)
    {
        $this->$relacionamentoNome = "Paciente";
        $this->setTabelaIntermediaria("tClinicaPaciente");
        $this->setRelacionamento("tPaciente");
        $this->getModel()->setValorArray("codPaciente", $codPaciente);
        return $this;
    }

}
