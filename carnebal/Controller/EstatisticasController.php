<?php

class EstatisticasController extends Controller {
    
    public static function GetProdutosMaisVendidos(){
        $produtos = new Produto;
        return json_encode($produtos->GetProdutosMaisVendidos());
    }
    
    
}