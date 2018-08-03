<?php

class ComandasController extends Controller {
    
    public static function GetComandasAbertas(){
        $comanda = new Comanda;
        return $comanda->GetComandasAbertas();
    }

    public static function GetPrecoComanda($id){
        $comanda = new Comanda;
        return $comanda->GetPrecoComanda($id);
    }


}