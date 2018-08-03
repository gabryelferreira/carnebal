<?php

class ProdutosController extends Controller {
    
    public static function GetProdutos(){
        $produto = new Produto;
        return $produto->GetProdutos();
    }
    
    public static function CadastrarProduto(){
        $produto = new Produto;
        $produto->CadastrarProduto();
    }
    
    public static function GetProduto($id){
        $produto = new Produto;
        return $produto->GetProduto($id);
    }
    
}