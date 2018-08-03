<?php

class EsqueciSenhaController extends Controller {

    public static function GerarSenha($usuario, $email){
        $funcionario = new Funcionario;
        $isUserExist = $funcionario->UserAndEmailExists($usuario, $email);
        if ($isUserExist[0][0] == "1"){
            $senha = new Senha;
            $randomPass = self::RandomPass();
            $randomPassSha1 = sha1($randomPass);
            $funcionario->GerarSenha($usuario, $email, $randomPassSha1);
            $funcionario->MandarEmailComNovaSenha($usuario, $email, $randomPass);
            header("Location: ".BaseUrl::getBaseUrl()."/esqueci-senha?success=password");
        } else {
            header("Location: ".BaseUrl::getBaseUrl()."/esqueci-senha?erro=user");
        }
    }

    public static function RandomPass(){
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@$#%';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 18; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

}