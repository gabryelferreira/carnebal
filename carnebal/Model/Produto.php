<?php

class Produto extends Database {
    
    public static $id, 
                    $nome, 
                    $descricao, 
                    $preco, 
                    $foto;
    
    
    
    public static function CadastrarProduto(){
        self::$nome = $_POST['nome'];
        self::$descricao = $_POST['descricao'];
        self::$preco = $_POST['preco'];
        self::$preco = str_replace(',', '.', self::$preco);
        self::$foto = BaseUrl::getBaseUrl().'/View/Contents/img/product.png';
        
        try {
            
            self::query("INSERT INTO tbProduto(nomeProduto, 
                                                descricao, 
                                                precoUnitario,
                                                foto) 
                                                values('".self::$nome."', 
                                                '".self::$descricao."', 
                                                '".self::$preco."', 
                                                '".self::$foto."')");
            self::query("SELECT cdProduto 
                        FROM tbProduto
                        WHERE nomeProduto = '".self::$nome."' 
                        AND descricao = '".$descricao."'");


            if (is_array(self::$results) || is_object(self::$results)){
                foreach(self::$results as $result){
                    if (!file_exists('View/Contents/products/'.$result[0].'/imgProduct')) {
                        mkdir('View/Contents/products/'.$result[0].'/imgProduct', 0777, true);
                    }
                }
            }
            header("Location: ".BaseUrl::getBaseUrl()."/produtos?success=produto");
            
        } catch (Exception $e){
            header("Location: ".BaseUrl::getBaseUrl()."/produtos?erro=produto");
        }
        
    }//function



    public static function AlterarProduto(){
        self::$id = $_POST['cdProduto'];
        self::$nome = $_POST['nome'];
        self::$descricao = $_POST['descricao'];
        self::$preco = $_POST['preco'];
        self::$preco = str_replace(',', '.', self::$preco);
        try { 
            self::query("UPDATE tbProduto
                        SET nomeProduto = '".self::$nome."',
                        descricao = '".self::$descricao."',
                        precoUnitario = '".self::$preco."' 
                        WHERE cdProduto = ".self::$id);

            header("Location: ".BaseUrl::getBaseUrl()."/produtos"."/".self::$id);

        } catch (Exception $e){
            header("Location: ".BaseUrl::getBaseUrl()."/produtos"."/".self::$id);
        }
    }//function




    public static function GetPathImagem($id){
        try {
            return self::query("SELECT foto
                                FROM tbProduto
                                WHERE cdProduto = $id");
        } catch (Exception $e){
            print_r($e);
        }
    }//function






    public static function GetProdutoPorId($id){
        self::$results = self::query("SELECT cdProduto, 
                                            nomeProduto, 
                                            descricao, 
                                            precoUnitario
                                            FROM tbProduto 
                                            WHERE cdProduto = $id");
        self::$resultRetorno = [];
        if (is_array(self::$results) || is_object(self::$results)){
            foreach(self::$results as $result){
                $result[3] = str_replace('.', ',', $result[3]);
                array_push(self::$resultRetorno, $result);

            }
        }
        return self::$resultRetorno;
    }//function
    
    
    
    
    
    
    //RETORNA TODOS OS PRODUTOS
    public static function GetProdutos(){
        self::$results = self::query("SELECT cdProduto, nomeProduto, descricao, precoUnitario, foto FROM tbProduto");
        self::$resultRetorno = [];
        if (is_array(self::$results) || is_object(self::$results)){
            foreach(self::$results as $result){
                $result[3] = str_replace('.', ',', $result[3]);
                
                array_push(self::$resultRetorno, $result);

            }
        }
        return self::$resultRetorno;
    }//function
    
    
    //RETORNA UM PRODUTO ESPECIFICO
    public static function GetProduto($id){
        self::$results = self::query("SELECT cdProduto, nomeProduto, descricao, precoUnitario FROM tbProduto WHERE cdProduto = $id");
        self::$resultRetorno = [];
        if (is_array(self::$results) || is_object(self::$results)){
            foreach(self::$results as $result){
                $result[3] = str_replace('.', ',', $result[3]);
                
                array_push(self::$resultRetorno, $result);

            }
        }
        return self::$resultRetorno;
    }//function
    
    
    

    
    
    
    //RETORNA O VALOR TOTAL DE VENDAS
    public static function GetTotalVendas(){
        self::$results = self::query("SELECT sum(vlTotal) from tbComanda");
        if (is_array(self::$results) || is_object(self::$results)){
            foreach(self::$results as $result){
                $result[0] = str_replace('.', ',', $result[0]);
                array_push(self::$resultRetorno, $result);
                return $result[0];
            }
        }
        return 0;
    }//function
    
    
    
    //RETORNA OS CINCO PRODUTOS MAIS VENDIDOS
    public static function GetProdutosMaisVendidos($mes, $ano){
        if (($mes == "9999") && ($ano == "9999")){
            self::$results = self::query("SELECT nomeProduto, sum(qtProduto) FROM tbControle as con INNER JOIN tbProduto as pro on con.cdProduto = pro.cdProduto GROUP BY nomeProduto ORDER BY sum(qtProduto) DESC LIMIT 5");
        } else {
            self::$results = self::query("SELECT nomeProduto, sum(qtProduto) FROM tbControle as con INNER JOIN tbProduto as pro on con.cdProduto = pro.cdProduto INNER JOIN tbComanda as comanda on con.cdComanda = comanda.cdComanda WHERE MONTH(dtComanda) = 06 and YEAR(dtComanda) = 2018 GROUP BY nomeProduto ORDER BY sum(qtProduto) DESC LIMIT 5");
        }
            
        
        self::$resultRetorno = [];
        if (is_array(self::$results) || is_object(self::$results)){
            foreach(self::$results as $result){
                array_push(self::$resultRetorno, $result);
            }
        }
        return self::$resultRetorno;
    }//function
    
    
    
    
    //RETORNA A QUANTIDADE DE PRODUTOS VENDIDOS
    public static function GetQuantidadeProdutosVendidos($mes, $ano){
        if (($mes == "9999") && ($ano == "9999")){
            self::$results = self::query("SELECT sum(qtProduto) from tbControle");
        } else {
            self::$results = self::query("SELECT sum(qtProduto) from tbControle as con INNER JOIN tbComanda as comanda on con.cdComanda = comanda.cdComanda WHERE MONTH(dtComanda) = '$mes' and YEAR(dtComanda) = '$ano'");
        }
        
        
        if (is_array(self::$results) || is_object(self::$results)){
            foreach(self::$results as $result){
                return $result[0];
            }
        }
        return 0;
        
    }//function
    
    
    
    public static function GetMesesVendas(){
        try {
            self::$results = self::query("SELECT dtComanda FROM tbComanda GROUP BY MONTH(dtComanda), YEAR(dtComanda) ORDER BY dtComanda DESC");
            self::$resultRetorno = [];
            if (is_array(self::$results) || is_object(self::$results)){
                foreach(self::$results as $result){
                    $dtControle = explode('-', $result[0]);
                    $result[0] = $dtControle[2] . "-". $dtControle[1] . "-". $dtControle[0];
                    array_push(self::$resultRetorno, $result);
                }
            }
            return self::$resultRetorno;
        } catch (Exception $e){
            echo $e;
        }
    }//function
    
    
    
    
    public static function GetAcessosComanda($mes, $ano, $diaDaSemana){
        if (($mes == "9999") && ($ano == "9999")){
            self::$results = self::query("SELECT count(*) FROM tbComanda WHERE WEEKDAY(dtComanda) = $diaDaSemana");
        } else {
            self::$results = self::query("SELECT count(*) FROM tbComanda WHERE MONTH(dtComanda) = '$mes' AND YEAR(dtComanda) = '$ano' AND WEEKDAY(dtComanda) = $diaDaSemana");
        }
        self::$resultRetorno = [];
        if (is_array(self::$results) || is_object(self::$results)){
            foreach(self::$results as $result){
                return $result[0];
                array_push(self::$resultRetorno, $result);
            }
        }
        return self::$resultRetorno;
        
    }//function
    
    
    
    
    
    
    
    
    
}