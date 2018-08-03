<?php

class ComandaEspecificaController extends Controller {

    public static function GetComanda($id){
        $comanda = new Comanda;
        return $comanda->GetComanda($id);
    }

    public static function FinalizarComanda(){
        $comanda = new Comanda;
        $comanda->FinalizarComanda($_POST['cdComanda']);
    }

}