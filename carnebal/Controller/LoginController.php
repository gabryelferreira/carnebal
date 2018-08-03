<?php

class LoginController extends Controller {
    
    public static function FazerLogin(){
        $funcionario = new Funcionario;
        $funcionario->FazerLogin();
    }
    
    public static function FazerLogout(){
        $funcionario = new Funcionario;
        $funcionario->FazerLogout();
    }
    
    public static function CadastrarFuncionario(){
        $funcionario = new Funcionario;
        if (!$funcionario->ContemFuncionarios()){
            $funcionario = new Funcionario;
            $funcionario->CadastrarFuncionarioLogin();
        } else {
            header("Location: ".BaseUrl::getBaseUrl()."?erro=permissao");
        }
    }

    public static function ContemFuncionarios(){
        $funcionario = new Funcionario;
        return $funcionario->ContemFuncionarios();
    }
    
}