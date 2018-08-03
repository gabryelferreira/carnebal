<?php

class Funcionario extends Database {
    public static   $id,
                    $nome, 
                    $cpf, 
                    $endereco, 
                    $complemento, 
                    $ddd, 
                    $telefone, 
                    $sexo, 
                    $dtNasc, 
                    $cargo, 
                    $email, 
                    $usuario, 
                    $senha,
                    $foto;
    

    public static function GetFuncionarios(){
        self::$results = self::query("SELECT cdFuncionario, 
                                            nomeFuncionario, 
                                            dtNascimento, 
                                            cpf, 
                                            endereco, 
                                            complemento, 
                                            cargo, 
                                            sexo, 
                                            ddd, 
                                            telefone,
                                            foto 
                                            FROM tbFuncionario");
        self::$resultRetorno = [];
        if (is_array(self::$results) || is_object(self::$results)){
            foreach(self::$results as $result){
                self::$dtNasc = explode('-', $result[2]);
                $result[2] = self::$dtNasc[2] . "/". self::$dtNasc[1] . "/". self::$dtNasc[0];

                $result[3] = $result[3][0].
                            $result[3][1].
                            $result[3][2].'.'.
                            $result[3][3].
                            $result[3][4].
                            $result[3][5].'.'.
                            $result[3][6].
                            $result[3][7].
                            $result[3][8].'-'.
                            $result[3][9].
                            $result[3][10];

                if ($result[6] == "G"){
                    $result[6] = "Garçom";
                } else
                    if($result[6] == "A"){
                        $result[6] = "Admin";
                    }else {
                        $result[6] = "Caixa";
                    }
                        

                if ($result[7] == 'M')
                    $result[7] = "Masculino";
                else
                    $result[7] = "Feminino";
                
                array_push(self::$resultRetorno, $result);

            }
        }
        return self::$resultRetorno;
    }//function
    
    
    
    public static function GetFuncionario($id){
        self::$results = self::query("SELECT cdFuncionario, 
                                            nomeFuncionario, 
                                            dtNascimento, 
                                            cpf, 
                                            endereco, 
                                            complemento, 
                                            cargo, 
                                            sexo, 
                                            ddd, 
                                            telefone,
                                            email 
                                            FROM tbFuncionario 
                                            WHERE cdFuncionario = $id");
        self::$resultRetorno = [];
        if (is_array(self::$results) || is_object(self::$results)){
            foreach(self::$results as $result){
                self::$dtNasc = explode('-', $result[2]);
                $result[2] = self::$dtNasc[2] . "/". self::$dtNasc[1] . "/". self::$dtNasc[0];

                $result[3] = $result[3][0].
                            $result[3][1].
                            $result[3][2].'.'.
                            $result[3][3].
                            $result[3][4].
                            $result[3][5].'.'.
                            $result[3][6].
                            $result[3][7].
                            $result[3][8].'-'.
                            $result[3][9].
                            $result[3][10];


                if ($result[6] == "G"){
                    $result[6] = "Garçom";
                } else
                    if($result[6] == "A"){
                        $result[6] = "Admin";
                    }else {
                        $result[6] = "Caixa";
                    }
                        

                if ($result[7] == 'M')
                    $result[7] = "Masculino";
                else
                    $result[7] = "Feminino";
                
                array_push(self::$resultRetorno, $result);

            }
        }
        return self::$resultRetorno;
    }//function
    





    public static function GetFuncionarioPorId($id){
        self::$results = self::query("SELECT cdFuncionario, 
                                            nomeFuncionario, 
                                            dtNascimento, 
                                            cpf, 
                                            endereco, 
                                            complemento, 
                                            cargo, 
                                            sexo, 
                                            ddd, 
                                            telefone,
                                            email 
                                            FROM tbFuncionario 
                                            WHERE cdFuncionario = $id");
        self::$resultRetorno = [];
        if (is_array(self::$results) || is_object(self::$results)){
            foreach(self::$results as $result){
                
                $result[3] = $result[3][0].
                            $result[3][1].
                            $result[3][2].'.'.
                            $result[3][3].
                            $result[3][4].
                            $result[3][5].'.'.
                            $result[3][6].
                            $result[3][7].
                            $result[3][8].'-'.
                            $result[3][9].
                            $result[3][10];

                array_push(self::$resultRetorno, $result);

            }
        }
        return self::$resultRetorno;
    }//function






    public static function ContemFuncionarios(){
        try {
            self::$results = self::query("SELECT count(*) FROM tbFuncionario");
            if (is_array(self::$results) || is_object(self::$results)){
                foreach(self::$results as $result){
                    if ($result[0] == "0"){
                        return false;
                    } else {
                        return true;
                    }
                }
            }
        } catch (Exception $e){
            print($e);
        }
    }//function

    public static function SenhasIguais($senha1, $senha2){
        return $senha1 == $senha2;
        
    }
    
    
    public static function CpfExistenteComCargo($usuario){
        try {
            print_r($usuario);
            self::$results = self::query("SELECT count(*) FROM tbFuncionario WHERE usuario = '$usuario'");
            if (is_array(self::$results) || is_object(self::$results)){
                foreach(self::$results as $result){
                    if ($result[0] == "0"){
                        return false;
                    } else {
                        return true;
                    }
                }
            }
        } catch (Exception $e){
            print($e);
        }
    }//function


    public static function GetPathImagem($id){
        try {
            return self::query("SELECT foto
                                FROM tbFuncionario
                                WHERE cdFuncionario = $id");
        } catch (Exception $e){
            print_r($e);
        }
    }//function



    
    
    
    public static function CadastrarFuncionario(){
        self::$nome = $_POST['nome'];
        self::$dtNasc = $_POST['dtNasc'];
        self::$cpf = $_POST['cpf'];
        self::$endereco = $_POST['endereco'];
        self::$complemento = $_POST['complemento'];
        self::$ddd = $_POST['ddd'];
        self::$telefone = $_POST['telefone'];
        self::$email = $_POST['email'];
        self::$cargo = $_POST['cargo'];
        self::$sexo = $_POST['sexo'];
        self::$foto = BaseUrl::getBaseUrl().'/View/Contents/img/user.png';
        self::$usuario = self::$cpf.self::$cargo;
        self::$senha = explode('-', self::$dtNasc);
        self::$senha = self::$senha[2] . self::$senha[1] . self::$senha[0];
        self::$senha = sha1(self::$senha);
        try {
            
            self::query("INSERT INTO tbFuncionario(nomeFuncionario,
                                                    dtNascimento,
                                                    cpf,
                                                    endereco,
                                                    complemento, 
                                                    ddd, 
                                                    telefone, 
                                                    email, 
                                                    cargo, 
                                                    sexo, 
                                                    usuario, 
                                                    senha,
                                                    primeiroAcesso,
                                                    isAtivo, 
                                                    foto) 
                                                    values (
                                                        '".self::$nome."', 
                                                        '".self::$dtNasc."', 
                                                        '".self::$cpf."', 
                                                        '".self::$endereco."', 
                                                        '".self::$complemento."', 
                                                        '".self::$ddd."', 
                                                        '".self::$telefone."', 
                                                        '".self::$email."', 
                                                        '".self::$cargo."', 
                                                        '".self::$sexo."', 
                                                        '".self::$usuario."', 
                                                        '".self::$senha."',
                                                        true,
                                                        true,
                                                        '".self::$foto."')");
            self::query("SELECT cdFuncionario 
                        FROM tbFuncionario
                        WHERE usuario = '".self::$usuario."'");


            if (is_array(self::$results) || is_object(self::$results)){
                foreach(self::$results as $result){
                    if (!file_exists('View/Contents/users/'.$result[0].'/imgUser')) {
                        mkdir('View/Contents/users/'.$result[0].'/imgUser', 0777, true);
                    }
                }
            }

            

            header("Location: ".BaseUrl::getBaseUrl()."/funcionarios?sucesso=funcionario");
            
        } catch (Exception $e){
            print_r($e);
        }
        
        
        
    }//function
    


    public static function LogarUsuario($user){
        try {
            self::$results = self::query("SELECT cdFuncionario,
                                                usuario,
                                                senha,
                                                cargo,
                                                nomeFuncionario,
                                                primeiroAcesso,
                                                isAtivo,
                                                dtNascimento,
                                                email,
                                                ddd,
                                                telefone,
                                                endereco,
                                                complemento,
                                                sexo,
                                                foto,
                                                cpf
                                                FROM tbFuncionario
                                                WHERE usuario = '".$user."'");



            if (is_array(self::$results) || is_object(self::$results)){
                foreach(self::$results as $result){
                    session_start();
                    $_SESSION['cdFuncionario'] = $result[0];
                    $_SESSION['usuario'] = $result[1];
                    $_SESSION['senha'] = $result[2];
                    $_SESSION['cargo'] = $result[3];
                    $_SESSION['nomeFuncionario'] = $result[4];
                    $_SESSION['primeiroAcesso'] = $result[5];
                    $_SESSION['ativo'] = $result[6];
                    $_SESSION['dtNasc'] = $result[7];
                    $_SESSION['email'] = $result[8];
                    $_SESSION['ddd'] = $result[9];
                    $_SESSION['telefone'] = $result[10];
                    $_SESSION['endereco'] = $result[11];
                    $_SESSION['complemento'] = $result[12];
                    $_SESSION['sexo'] = $result[13];
                    $_SESSION['foto'] = $result[14];
                    $_SESSION['cpf'] = $result[15][0].
                                        $result[15][1].
                                        $result[15][2].'.'.
                                        $result[15][3].
                                        $result[15][4].
                                        $result[15][5].'.'.
                                        $result[15][6].
                                        $result[15][7].
                                        $result[15][8].'-'.
                                        $result[15][9].
                                        $result[15][10];
                    if (!file_exists('View/Contents/users/'.$_SESSION['cdFuncionario'].'/imgUser')) {
                        mkdir('View/Contents/users/'.$_SESSION['cdFuncionario'].'/imgUser', 0777, true);
                    }
                    header("Location: ".BaseUrl::getBaseUrl());
                }
            } else {
                header("Location: ".BaseUrl::getBaseUrl()."?erro=permissao");
            }

            

        } catch (Exception $e){
            print_r($e);
        }

    }//function

    public static function AlterarDados(){
        session_start();
        self::$nome = $_POST['nome'];
        self::$dtNasc = $_POST['dtNasc'];
        self::$endereco = $_POST['endereco'];
        self::$complemento = $_POST['complemento'];
        self::$ddd = $_POST['ddd'];
        self::$telefone = $_POST['telefone'];
        self::$email = $_POST['email'];
        self::$sexo = $_POST['sexo'];
        try { 
            self::query("UPDATE tbFuncionario
                        SET nomeFuncionario = '".self::$nome."',
                        dtNascimento = '".self::$dtNasc."',
                        endereco = '".self::$endereco."',
                        complemento = '".self::$complemento."',
                        ddd = '".self::$ddd."',
                        telefone = '".self::$telefone."',
                        email = '".self::$email."',
                        sexo = '".self::$sexo."'
                        WHERE cdFuncionario = ".$_SESSION['cdFuncionario']);
            session_start();
            $_SESSION['nomeFuncionario'] = self::$nome;
            $_SESSION['dtNasc'] = self::$dtNasc;
            $_SESSION['endereco'] = self::$endereco;
            $_SESSION['complemento'] = self::$complemento;
            $_SESSION['ddd'] = self::$ddd;
            $_SESSION['telefone'] = self::$telefone;
            $_SESSION['email'] = self::$email;
            $_SESSION['sexo'] = self::$sexo;
            header("Location: ".BaseUrl::getBaseUrl()."/perfil/editar-perfil?success=perfil");
        } catch (Exception $e){
            header("Location: ".BaseUrl::getBaseUrl()."/perfil/editar-perfil?erro=perfil");
        }
    }//function



    public static function AlterarPerfilOutro(){
        self::$id = $_POST['cdFuncionario'];
        self::$nome = $_POST['nome'];
        self::$dtNasc = $_POST['dtNasc'];
        self::$endereco = $_POST['endereco'];
        self::$complemento = $_POST['complemento'];
        self::$ddd = $_POST['ddd'];
        self::$telefone = $_POST['telefone'];
        self::$email = $_POST['email'];
        self::$sexo = $_POST['sexo'];
        try { 
            self::query("UPDATE tbFuncionario
                        SET nomeFuncionario = '".self::$nome."',
                        dtNascimento = '".self::$dtNasc."',
                        endereco = '".self::$endereco."',
                        complemento = '".self::$complemento."',
                        ddd = '".self::$ddd."',
                        telefone = '".self::$telefone."',
                        email = '".self::$email."',
                        sexo = '".self::$sexo."'
                        WHERE cdFuncionario = ".self::$id);
            session_start();
            if (self::$id == $_SESSION['cdFuncionario']){
                $_SESSION['nomeFuncionario'] = self::$nome;
                $_SESSION['dtNasc'] = self::$dtNasc;
                $_SESSION['endereco'] = self::$endereco;
                $_SESSION['complemento'] = self::$complemento;
                $_SESSION['ddd'] = self::$ddd;
                $_SESSION['telefone'] = self::$telefone;
                $_SESSION['email'] = self::$email;
                $_SESSION['sexo'] = self::$sexo;
            }
            
            header("Location: ".BaseUrl::getBaseUrl()."/funcionarios"."/".self::$id);
        } catch (Exception $e){
            header("Location: ".BaseUrl::getBaseUrl()."/funcionarios"."/".self::$id);
        }
    }//function




    public static function CadastrarFuncionarioLogin(){
        self::$nome = $_POST['nome'];
        self::$dtNasc = $_POST['dtNasc'];
        self::$cpf = $_POST['cpf'];
        self::$usuario = self::$cpf.'A';
        self::$foto = BaseUrl::getBaseUrl().'/View/Contents/img/user.png';
        self::$senha = explode('-', self::$dtNasc);
        self::$senha = self::$senha[2] . self::$senha[1] . self::$senha[0];
        self::$senha = sha1(self::$senha);
        try {
            
            self::query("INSERT INTO tbFuncionario(nomeFuncionario,
                                                    dtNascimento, 
                                                    cpf, 
                                                    cargo, 
                                                    usuario, 
                                                    senha, 
                                                    isAtivo, 
                                                    primeiroAcesso,
                                                    foto) 
                                                    values ('".self::$nome."', 
                                                    '".self::$dtNasc."', 
                                                    '".self::$cpf."', 
                                                    'A', 
                                                    '".self::$usuario."', 
                                                    '".self::$senha."', 
                                                    true, 
                                                    true,
                                                    '".self::$foto."')");

            self::LogarUsuario(self::$usuario);
            
            
        } catch (Exception $e){
            print_r($e);
        }
        
        
        
    }//function



    public static function AlterarSenha($id, $senha){
        self::$id = $id;
        $senha = sha1($senha);
        try {
            self::query("UPDATE tbFuncionario
                        SET senha = '$senha', primeiroAcesso = false
                         WHERE cdFuncionario = ".self::$id."");
            session_start();
            $_SESSION['primeiroAcesso'] = 0;
            $_SESSION['senha'] = $senha;
            header("Location: ".BaseUrl::getBaseUrl()."/perfil/editar-senha?success=senha");
        } catch (Exception $e){
            print_r($e);
        }
                
    }



    

    public static function GetDataPermitida(){
        $date = date('m/d/Y');
        $date2 = strtotime($date."-18 year");
        return date('Y-m-d', $date2);
    }


    public static function FazerLogin(){
        self::$usuario = $_POST['usuario'];
        self::$senha = $_POST['senha'];
        
        try {
            self::$results = self::query("SELECT cdFuncionario,
                                                usuario,
                                                senha,
                                                cargo,
                                                nomeFuncionario,
                                                primeiroAcesso,
                                                isAtivo,
                                                dtNascimento,
                                                email,
                                                ddd,
                                                telefone,
                                                endereco,
                                                complemento,
                                                sexo,
                                                foto,
                                                cpf
                                                FROM tbFuncionario
                                                 WHERE usuario = '".self::$usuario."'
                                                 AND isAtivo = true");
            $loginTipo = 0;
            if (is_array(self::$results) || is_object(self::$results)){
                foreach(self::$results as $result){
                    $loginTipo = 1;
                    print_r(sha1(self::$senha));
                    if (($result[3] == 'A') || ($result[3] == 'C')){
                        if (sha1(self::$senha) == $result[2]){
                            session_start();
                            $_SESSION['cdFuncionario'] = $result[0];
                            $_SESSION['usuario'] = $result[1];
                            $_SESSION['senha'] = $result[2];
                            $_SESSION['cargo'] = $result[3];
                            $_SESSION['nomeFuncionario'] = $result[4];
                            $_SESSION['primeiroAcesso'] = $result[5];
                            $_SESSION['ativo'] = $result[6];
                            $_SESSION['dtNasc'] = $result[7];
                            $_SESSION['email'] = $result[8];
                            $_SESSION['ddd'] = $result[9];
                            $_SESSION['telefone'] = $result[10];
                            $_SESSION['endereco'] = $result[11];
                            $_SESSION['complemento'] = $result[12];
                            $_SESSION['sexo'] = $result[13];
                            $_SESSION['foto'] = $result[14];
                            $_SESSION['cpf'] = $result[15][0].
                                                $result[15][1].
                                                $result[15][2].'.'.
                                                $result[15][3].
                                                $result[15][4].
                                                $result[15][5].'.'.
                                                $result[15][6].
                                                $result[15][7].
                                                $result[15][8].'-'.
                                                $result[15][9].
                                                $result[15][10];


                            header("Location: ".BaseUrl::getBaseUrl());
                        } else {
                            header("Location: ".BaseUrl::getBaseUrl()."?erro=senha");
                        }
                    } else {
                        header("Location: ".BaseUrl::getBaseUrl()."?erro=permissao");
                    }
                    
                    
                    
                }
            }
            if ($loginTipo == 0){
                header("Location: ".BaseUrl::getBaseUrl()."?erro=usuario");
            }
            
            
            
        } catch (Exception $e){
            print($e);
        }
        
    }//function
    
    
    public static function FazerLogout(){
        session_start();
        session_unset();
        session_destroy();
        header("Location: ".BaseUrl::getBaseUrl());
    }

    public static function GerarSenha($user, $email, $password){
        try {
            self::query("UPDATE tbFuncionario
                        SET senha = '$password',
                        primeiroAcesso = 1
                        WHERE usuario = '$user'
                        AND email = '$email'");
        } catch (Exception $e){
            print($e);
        }
    }

    public static function MandarEmailComNovaSenha($user, $email, $password){
        $to = $email;
        $subject = "Nova senha gerada";
        $msg = "Foi gerada uma nova senha para acesso ao sistema. Para ter acesso utilize a senha $password.";
        $headers = "From: Carnebal Hamburgueria <gabryel.ferreira@hotmail.com>";
        mail($to, $subject, $msg, $headers);
    }

    public static function UserAndEmailExists($user, $email){
        return self::query("SELECT count(*) 
                            FROM tbFuncionario
                            WHERE usuario = '$user'
                            AND email = '$email'");
    }
    
}