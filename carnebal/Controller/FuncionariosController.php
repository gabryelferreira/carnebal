<?php

class FuncionariosController extends Controller {
    
    public static function GetFuncionarios(){
        $funcionario = new Funcionario;
        return $funcionario->GetFuncionarios();
    }
 
    public static function GetDataPermitida(){
        $funcionario = new Funcionario;
        return $funcionario->GetDataPermitida();
    }

    public static function VerificarExistenciaCargoECPF($usuario){
        $funcionario = new Funcionario;
        if (!$funcionario->CpfExistenteComCargo($usuario)){
            echo "0";
        } else {
            echo "1";
        }
    }

    
    public static function CadastrarFuncionario(){
        $funcionario = new Funcionario;
        $cargo = $_POST['cargo'];
        $cpf = $_POST['cpf'];
        $usuario = $cpf.$cargo;
        if (!$funcionario->CpfExistenteComCargo($usuario)){
            $funcionario->CadastrarFuncionario();
        } else {
            header("Location: ".BaseUrl::getBaseUrl()."/funcionarios?erro=cpfexiste");
        }
        
    }//function


    
    
    public static function GetFuncionario($id){
        $funcionario = new Funcionario;
        return $funcionario->GetFuncionario($id);
    }
    
}