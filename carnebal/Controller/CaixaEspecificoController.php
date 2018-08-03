<?php

class CaixaEspecificoController extends Controller {

    public static function GetComanda($id){
        $comanda = new Comanda;
        return $comanda->GetComanda($id);
    }

}