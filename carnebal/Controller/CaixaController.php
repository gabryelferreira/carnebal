<?php

class CaixaController extends Controller {
    
    public static function GetComandasFinalizadas(){
        $comandas = new Comanda;
        return $comandas->GetComandasFinalizadas();
            
    }
    
    public static function GetTotalVendas(){
        $produto = new Produto;
        return $produto->GetTotalVendas();
    }
    
    public static function GetPrecoComanda($id){
        $comanda = new Comanda;
        return $comanda->GetPrecoComanda($id);
    }

}

?>