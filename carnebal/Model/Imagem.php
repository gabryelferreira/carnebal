<?php

class Imagem extends Database {

    public static $id;

    public static function AlterarFotoUsuario($file){
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        $fileType = $file['type'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower($fileExt[1]);

        $allowed = array('jpg', 'jpeg', 'png');
        if (in_array($fileActualExt, $allowed)){
            if ($fileError === 0){
                if ($fileSize < 2000000){
                    session_start();
                    $fileNameNew = uniqid('', true).".".$fileActualExt;
                    if (!file_exists('View/Contents/users/'.$_SESSION['cdFuncionario'].'/imgUser')) {
                        mkdir('View/Contents/users/'.$_SESSION['cdFuncionario'].'/imgUser', 0777, true);
                    } else {
                        $files = glob('View/Contents/users/'.$_SESSION['cdFuncionario'].'/imgUser/*');
                        foreach($files as $file){
                        if(is_file($file))
                            unlink($file);
                        }
                    }
                    $fileDestination = 'View/Contents/users/'.$_SESSION['cdFuncionario'].'/imgUser/'.$fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    self::query("UPDATE tbFuncionario
                                 SET foto = '".BaseUrl::getBaseUrl()."/$fileDestination' 
                                 WHERE cdFuncionario = ".$_SESSION['cdFuncionario']);
                    $_SESSION['foto'] = BaseUrl::getBaseUrl()."/".$fileDestination;
                    header("Location: ".BaseUrl::getBaseUrl()."/perfil/editar-foto?success=foto");
                    
                } else {
                    header("Location: ".BaseUrl::getBaseUrl()."/perfil/editar-foto?erro=tamanho");
                }
                
                
            } else {
                header("Location: ".BaseUrl::getBaseUrl()."/perfil/editar-foto?erro=foto");
            }
            
            
        } else {
            header("Location: ".BaseUrl::getBaseUrl()."/perfil/editar-foto?erro=extensao");
        }


    }//function




    public static function AlterarFotoOutro($file, $id){
        self::$id = $id;
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        $fileType = $file['type'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower($fileExt[1]);

        $allowed = array('jpg', 'jpeg', 'png');
        if (in_array($fileActualExt, $allowed)){
            if ($fileError === 0){
                if ($fileSize < 2000000){
                    session_start();
                    $fileNameNew = uniqid('', true).".".$fileActualExt;
                    if (!file_exists('View/Contents/users/'.$id.'/imgUser')) {
                        mkdir('View/Contents/users/'.$id.'/imgUser', 0777, true);
                    } else {
                        $files = glob('View/Contents/users/'.$id.'/imgUser/*');
                        foreach($files as $file){
                        if(is_file($file))
                            unlink($file);
                        }
                    }
                    $fileDestination = 'View/Contents/users/'.$id.'/imgUser/'.$fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    try {
                        self::query("UPDATE tbFuncionario
                                    SET foto = '".BaseUrl::getBaseUrl()."/$fileDestination' 
                                    WHERE cdFuncionario = ".self::$id);
                    if (self::$id == $_SESSION['cdFuncionario']){
                        $_SESSION['foto'] = BaseUrl::getBaseUrl()."/".$fileDestination;
                    }
                    
                    header("Location: ".BaseUrl::getBaseUrl()."/funcionarios/$id");
                    } catch (Exception $e){
                        print_r($e);
                    }
                    
                } else {
                    header("Location: ".BaseUrl::getBaseUrl()."/funcionarios/$id");
                }
                
                
            } else {
                header("Location: ".BaseUrl::getBaseUrl()."/funcionarios/$id");
            }
            
            
        } else {
            header("Location: ".BaseUrl::getBaseUrl()."/funcionarios/$id");
        }


    }//function

    


    public static function AlterarFotoProduto($file, $id){
        self::$id = $id;
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        $fileType = $file['type'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower($fileExt[1]);

        $allowed = array('jpg', 'jpeg', 'png');
        if (in_array($fileActualExt, $allowed)){
            if ($fileError === 0){
                if ($fileSize < 2000000){
                    session_start();
                    $fileNameNew = uniqid('', true).".".$fileActualExt;
                    if (!file_exists('View/Contents/products/'.$id.'/imgProduct')) {
                        mkdir('View/Contents/products/'.$id.'/imgProduct', 0777, true);
                    } else {
                        $files = glob('View/Contents/products/'.$id.'/imgProduct/*');
                        foreach($files as $file){
                        if(is_file($file))
                            unlink($file);
                        }
                    }
                    $fileDestination = 'View/Contents/products/'.$id.'/imgProduct/'.$fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    try {
                        self::query("UPDATE tbProduto
                                    SET foto = '".BaseUrl::getBaseUrl()."/$fileDestination' 
                                    WHERE cdProduto = ".self::$id);
                    
                    header("Location: ".BaseUrl::getBaseUrl()."/produtos/$id");
                    } catch (Exception $e){
                        print_r($e);
                    }
                    
                } else {
                    header("Location: ".BaseUrl::getBaseUrl()."/produtos/$id");
                }
                
                
            } else {
                header("Location: ".BaseUrl::getBaseUrl()."/produtos/$id");
            }
            
            
        } else {
            header("Location: ".BaseUrl::getBaseUrl()."/produtos/$id");
        }


    }//function




}