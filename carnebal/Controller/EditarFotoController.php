<?php

class EditarFotoController extends Controller {
    
    public static function AlterarImagem($file){
        $imagem = new Imagem;
        $imagem->AlterarFotoUsuario($file);
    }

}