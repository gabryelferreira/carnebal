<?php

class FuncionarioEspecificoController extends Controller {
    
    public static function AlterarPerfil(){
        $funcionario = new Funcionario;
        $funcionario->AlterarPerfilOutro();
    }

    public static function GetFuncionario($id){
        $funcionario = new Funcionario;
        return $funcionario->GetFuncionarioPorId($id);
    }

    public static function GetPathImagem($id){
        $funcionario = new Funcionario;
        return $funcionario->GetPathImagem($id);
    }

    public static function AlterarFoto($file){
        $imagem = new Imagem;
        $imagem->AlterarFotoOutro($file, $_POST['cdFuncionario']);
    }


}