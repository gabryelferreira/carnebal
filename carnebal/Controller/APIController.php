<?php

class APIController extends Controller {
    public static $conexaoDB;


    //FUNCTION GET PRODUCTS --------
    public static function getProducts(){
        $headers = apache_request_headers();
        if (!$headers) {
            $headers = http_get_request_headers();
        }

        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET,POST');
        header('Access-Control-Allow-Headers: Authorization, Content-Type');

        include('Model/banco.php');
        $db = new conexao();
        self::$conexaoDB = $db->getConexao();

        $request_method = $_SERVER["REQUEST_METHOD"];

        switch ($request_method) {
            case 'GET':
                if (!empty($_GET["id"])) {
                    $id = intval($_GET["id"]);
                    self::get_Products($id);
                } else {
                    self::get_Products(-1);
                }
                break;
            default:
                header("HTTP/1.0 405 METHOD NOT VALID");
                break;
        }
    }

    public static function get_Products($id) {
        $query = "SELECT tbProduto.cdProduto, foto, nomeProduto, descricao, precoUnitario, 0 AS qtProduto, 0 AS cdComanda FROM tbProduto";
        if ($id != -1) {
            $query = "SELECT p.cdProduto, foto, nomeProduto, descricao, precoUnitario, qtProduto FROM tbProduto AS p INNER JOIN tbControle AS c ON (p.cdProduto = c.cdProduto) INNER JOIN tbComanda AS com ON (c.cdComanda = com.cdComanda) WHERE com.cdComanda =" . $id . " AND isAtivo=1";
        }
        $response = array();
        $result = mysqli_query(self::$conexaoDB, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $response[] = $row;
        }

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($response, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
    }
    
    public static function login(){
        $headers = apache_request_headers();
        if (!$headers) {
            $headers = http_get_request_headers();
        }

        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET,POST');
        header('Access-Control-Allow-Headers: Authorization, Content-Type');

        require_once('Model/banco.php');
        $db = new conexao();
        $conexaoDB = $db->getConexao();
            //$data = json_decode(file_get_contents('php://input'), true);
        $CPF = $_POST['cpf'];
        $Senha = $_POST['senha'];
        $Senha = sha1($Senha);
        $sql = "SELECT cdFuncionario, foto, nomeFuncionario, primeiroAcesso FROM tbFuncionario WHERE cpf='$CPF' AND senha='$Senha' AND (cargo = 'A' or cargo = 'G') ";

        $result = mysqli_query($conexaoDB, $sql);
        $resultCheck = mysqli_num_rows($result);
        $response = array();
        if ($resultCheck > 0) {
            $result = mysqli_query($conexaoDB, $sql);
            $row = mysqli_fetch_assoc($result);
            $response[] = $row;
            echo json_encode($response, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
        } else {
            echo "0";
        }
    }

    public static function newComanda(){
        $headers = apache_request_headers();
        if (!$headers) {
            $headers = http_get_request_headers();
        }

        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET,POST');
        header('Access-Control-Allow-Headers: Authorization');
        header('Content-Type:application/json');

        require_once('Model/banco.php');
        $db = new conexao();
        $conexaoDB = $db->getConexao();

        $numComandaFisica = $_POST['numComandaFisica'];
        $numMesa = $_POST['numMesa'];
        $cdFuncionario = $_POST['cdFuncionario'];
        $numComandaFisica = trim($numComandaFisica);
        $numMesa = trim($numMesa);
        $query = "SELECT * FROM tbComanda WHERE numComandaFisica = $numComandaFisica AND isAtivo= 1";
        $result = mysqli_query($conexaoDB, $query);
            //print_r($result);
        if (mysqli_num_rows($result) == 0) {
            $query = "insert into tbComanda (cdFuncionario, numComandaFisica,numMesa,dtComanda, hrComanda, vlTotal, isAtivo) values($cdFuncionario ,$numComandaFisica, $numMesa, CURDATE(), CURTIME(), 0.00, 1)";
            $result = mysqli_query($conexaoDB, $query);
                //echo json_encode($result);
            $query = "SELECT cdComanda FROM tbComanda WHERE numComandaFisica = $numComandaFisica AND isAtivo= 1";
            $result = mysqli_query($conexaoDB, $query);
            $row = $result->fetch_assoc();
            echo json_encode($row['cdComanda']);

        } else {
            echo "0";
        }
    }  


    public static function getComandasAbertas(){
        $headers = apache_request_headers();
        if (!$headers) {
            $headers = http_get_request_headers();
        }

        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET,POST');
        header('Access-Control-Allow-Headers: Authorization, Content-Type');


        require_once('Model/banco.php');
        $db = new conexao();
        $conexaoDB = $db->getConexao();

        $query = 'SELECT cdComanda, numMesa, numComandaFisica, TIME_FORMAT(hrComanda, "%H:%i") AS hrComanda FROM tbComanda WHERE isAtivo=1 and vlTotal = 0.00';

        $response = array();
        $result = mysqli_query($conexaoDB, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $response[] = $row;
        }
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($response, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
    }
    
    public static function firstLogin(){
        $headers = apache_request_headers();
        if (!$headers) {
            $headers = http_get_request_headers();
        }
        
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET,POST');
        header('Access-Control-Allow-Headers: Authorization, Content-Type');
        header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
        header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
        header('Access-Control-Max-Age: 1000');
        header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
        
        require_once('Model/banco.php');
        $db = new conexao();
        $conexaoDB = $db->getConexao();
            //$data = json_decode(file_get_contents('php://input'), true);
        $CPF = $_POST['cpf'];
        $Senha = $_POST['senha'];
        $Senha = sha1($Senha);
        $sql = "UPDATE tbFuncionario SET senha='$Senha', primeiroAcesso = 0 WHERE cpf= '$CPF'";
        $result = mysqli_query($conexaoDB, $sql);
        $sql = "SELECT cdFuncionario, foto, nomeFuncionario, primeiroAcesso FROM tbFuncionario WHERE cpf='$CPF' AND senha='$Senha'";
        
        $result = mysqli_query($conexaoDB, $sql);
        $resultCheck = mysqli_num_rows($result);
        $response = array();
        if ($resultCheck > 0) {
            $result = mysqli_query($conexaoDB, $sql);
            $row = mysqli_fetch_assoc($result);
            $response[] = $row;
            echo json_encode($response, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
        } else {
            echo "0";
        }  
    }

    public static function closeComanda(){
    
        require_once('Model/banco.php');
        $db = new conexao();
        $conexaoDB = $db->getConexao();
        $headers = apache_request_headers();
        if (!$headers) {
            $headers = http_get_request_headers();
        }

        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST');
        header('Access-Control-Allow-Headers: Authorization, Content-Type');
        $json = file_get_contents('php://input');
        $item = json_decode($json, true);
        $query = " UPDATE tbComanda
            SET vlTotal = (SELECT sum(vlControle) from tbControle where cdComanda=" . $item['cdComanda'] . ")
            WHERE cdComanda=" . $item['cdComanda'];

        $result = mysqli_query($conexaoDB, $query);
            // print_r($item[0]);
        if ($result) {
            echo "1";
        } else {
            echo "0";
        }   
    }

    public static function addItems(){
        require_once('Model/banco.php');
        $db = new conexao();
        $conexaoDB = $db->getConexao();
        $headers = apache_request_headers();
        if (!$headers) {
            $headers = http_get_request_headers();
        }

        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST');
        header('Access-Control-Allow-Headers: Authorization, Content-Type');
        $json = file_get_contents('php://input');
        $obj = json_decode($json, true);

        foreach($obj as $item) {
        $query="insert into tbControle (cdProduto, qtProduto,vlControle,cdComanda) 
        select ".$item['cdProduto']." ,".$item['qtProduto']."," .$item['qtProduto']. "* precoUnitario ," .$item['cdComanda']." 
        from tbProduto where cdProduto =".$item['cdProduto']." ON DUPLICATE KEY UPDATE qtProduto= ".$item['qtProduto'];
        $result = mysqli_query($conexaoDB, $query);
     }
     if($result){
         echo "1";
     }else{
         echo "0";
     }
    }


        //-------------------------------------
        //-------------------------------------



        

}