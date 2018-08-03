<?php

class EditarSenhaController extends Controller {
    
    public static function AlterarSenha($senha, $novaSenha){
        session_start();
        $funcionario = new Funcionario;
        if ($funcionario->SenhasIguais($_SESSION['senha'], sha1($senha))){
            $funcionario->AlterarSenha($_SESSION['cdFuncionario'], $novaSenha);
        } else {
            header("Location: ".BaseUrl::getBaseUrl()."/perfil/editar-senha?erro=senha");
        }
    }

}