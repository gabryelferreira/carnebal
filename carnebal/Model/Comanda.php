<?php

class Comanda extends Database {
    public static $cdComanda,
                    $dtComanda,
                    $hrComanda,
                    $vlTotal,
                    $cdFuncionario,
                    $cdCliente,
                    $numComandaFisica,
                    $numMesa,
                    $isAtivo;

    public static function GetComandasAbertas(){
        try {
            self::$results = self::query("SELECT cdComanda,
                                            numComandaFisica,
                                            numMesa,
                                            dtComanda,
                                            vlTotal,
                                            cdFuncionario,
                                            cdCliente,
                                            isAtivo 
                                            FROM tbComanda 
                                            WHERE isAtivo = true
                                            ORDER BY numComandaFisica");
            self::$resultRetorno = [];
            if ((is_array(self::$results)) || (is_object(self::$results))){
                foreach(self::$results as $result){
                    $dtComanda = explode('-', $result[3]);
                    $result[3] = $dtComanda[2].'-'.$dtComanda[1].'-'.$dtComanda[0];
                    $result[4] = str_replace('.', ',', $result[4]);
                    array_push(self::$resultRetorno, $result);
                }
            }
            return self::$resultRetorno;
        } catch (Exception $e){
            print_r($e);
        }
    }//function


        //RETORNA TODAS AS COMANDAS
        public static function GetComandasFinalizadas(){
            self::$results = self::query("SELECT cdComanda,
                                                nomeFuncionario, 
                                                dtComanda, 
                                                hrComanda, 
                                                vlTotal 
                                                FROM tbComanda 
                                                as com 
                                                inner join tbFuncionario 
                                                as fun 
                                                on com.cdFuncionario = fun.cdFuncionario 
                                                WHERE com.isAtivo = false
                                                order by cdComanda DESC");
            self::$resultRetorno = [];
            if (is_array(self::$results) || is_object(self::$results)){
                foreach(self::$results as $result){
                    $dtComanda = explode('-', $result[2]);
                    $result[2] = $dtComanda[2].'-'.$dtComanda[1].'-'.$dtComanda[0];
                    $result[4] = str_replace('.', ',', $result[4]);
                    array_push(self::$resultRetorno, $result);
    
                }
            }
            return self::$resultRetorno;
        }//function



    public static function GetComanda($id){
        self::$cdComanda = $id;
        try {
            self::$results = self::query("SELECT foto,
                                             nomeProduto, 
                                             precoUnitario, 
                                             qtProduto 
                                             FROM tbProduto as p 
                                             inner join tbControle as c 
                                             on (p.cdProduto = c.cdProduto) 
                                             inner join tbComanda as com 
                                             on (c.cdComanda = com.cdComanda) 
                                             where com.cdComanda = ".self::$cdComanda);
            self::$resultRetorno = [];
            if (is_array(self::$results) || is_object(self::$results)){
                foreach(self::$results as $result){
                    array_push(self::$resultRetorno, $result);
                }
            }
            return self::$resultRetorno;
        } catch (Exception $e){
            print_r($e);
        }
    }//function

    public static function GetPrecoComanda($id){
        try {
            return self::query("SELECT sum(qtProduto * precoUnitario) 
                                FROM tbComanda AS comanda 
                                INNER JOIN tbControle AS controle 
                                ON comanda.cdComanda = controle.cdComanda 
                                INNER JOIN tbProduto AS produto 
                                ON controle.cdProduto = produto.cdProduto 
                                WHERE comanda.cdComanda = $id");
        } catch (Exception $e){
            print_r($e);
        }
    }


    public static function FinalizarComanda($id){
        self::$cdComanda = $id;
        try {
            self::query("UPDATE tbComanda
                            SET isAtivo = false
                            WHERE cdComanda = ".self::$cdComanda);
            header("Location: ".BaseUrl::getBaseUrl()."/comandas");
        } catch (Exception $e){
            print_r($e);
        }
    }


}