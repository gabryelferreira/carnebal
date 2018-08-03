<?php

class ProdutoEspecificoController extends Controller {

    public static function AlterarProduto(){
        $produto = new Produto;
        $produto->AlterarProduto();
    }

    public static function GetProduto($id){
        $produto = new Produto;
        return $produto->GetProdutoPorId($id);
    }

    public static function GetPathImagem($id){
        $produto = new Produto;
        return $produto->GetPathImagem($id);
    }

    public static function AlterarFoto($file){
        $imagem = new Imagem;
        $imagem->AlterarFotoProduto($file, $_POST['cdProduto']);
    }

}