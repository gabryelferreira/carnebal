<?php

class EditarPerfilController extends Controller {
    

    public static function AlterarDados(){
        $funcionario = new Funcionario;
        $funcionario->AlterarDados();
    }


}