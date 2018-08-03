<?php

include('Layouts/head.php');
include('Layouts/headereditar.php');

?>
<body id="this-is-body-default">
    <div class="this-is-perfil marginHeader configPadrao">

        <div class="container">



            <div class="allPerfil">





                <form style="width: 100%;" class="definirPerfil" action="alterarfoto" method="POST" enctype="multipart/form-data">
                    <div class="headerPerfil">
                        <h1>Foto</h1>
                        <p>Altere a foto do produto.</p>
                    </div>
                    <div class="corpoPerfil">
                        
                        <div class="sem-sucesso sem-sucesso-foto deixarInvisivel">
                            <p>Extensão não permitida.</p>
                            <i id="fecharSemSucesso-foto" class="fa fa-times fa-lg fa-fw"></i>
                        </div>


                        <div class="formPerfilFoto">
                            <img src="
                            <?php $id = explode('/', $_SERVER['REQUEST_URI']);
                            $results = ProdutoEspecificoController::GetPathImagem(end($id));
                            foreach($results as $result){
                                echo $result[0];
                            }

                            ?>
                            " id="fotoPerfil">
                            <img src="" id="fotoPerfilClicada" class="deixarInvisivel">
                            <?php
                            echo '<input type="text" name="cdProduto" id="cdProduto" class="deixarInvisivel" value="'.end($id).'">';
                            ?>
                        </div>
                        <div class="formPerfilFoto">
                            <div class="formPerfilFotoBtn">
                                <input type="file" name="file" id="filePerfil" value="Selecionar" style="display: none;">
                                <input disabled type="text" class="txtFilePerfil">
                                <div style="position:absolute;right:0; " class="inputWithImg">
                                    <input type="button" value="Alterar foto" id="btnFilePerfil" onclick="document.getElementById('filePerfil').click();" />
                                    <i style="background-color:transparent;cursor:pointer; pointer-events: none;" class="fa fa-camera fa-lg fa-fw"></i>
                                </div>
                            </div>
                        </div>
                        

                        

                        <div class="div-save-perfil">
                            <input style="cursor: not-allowed;" disabled type="submit" value="Salvar" id="btnSalvar">
                        </div>
                    </div>
                </form>

            </div>
        </div>









        <div style="margin-top: 40px;" class="container">
            <div class="allPerfil">




                <form style="width: 100%;" class="definirPerfil" action="alterarproduto" method="POST">
                    <div class="headerPerfil">
                        <h1>Produto</h1>
                        <p>Altere as informações do produto.</p>
                    </div>
                    <div class="corpoPerfil">



                        <?php

                        $id = explode('/', $_SERVER['REQUEST_URI']);
                        echo '<input type="text" name="cdProduto" id="cdProduto" class="deixarInvisivel" value="'.end($id).'">';


                        $results = ProdutoEspecificoController::GetProduto(end($id));
                        foreach ($results as $result){
                            echo '<h1>Produto</h1>
                            <div class="inputWithImg">
                                <input type="text" name="nome" id="nome" required class="validate" autocomplete="off" placeholder="Digite o nome do produto" value="'.$result[1].'">
                                <i class="fa fa-cutlery fa-lg fa-fw"></i>
                            </div>
    
                            <h1>Preço</h1>
                            <div class="inputWithImg">
                                <input required type="text" name="preco" id="preco" class="validate" autocomplete="off" placeholder="Digite o preço" value="'.$result[3].'">
                                <i style="padding: 9px 12px; font-family: Roboto Condensed, sans-serif; font-size: 18px;">R$</i>
                            </div>
    
                            <h1>Descrição</h1>
                            <textarea style="margin-bottom: 0;" required type="text" class="validate" name="descricao" id="descricao" autocomplete="off">'.$result[2].'</textarea>
                            <div class="div-save-perfil">
                                <input type="submit" value="Salvar" id="btnSalvar">
                            </div>';
                        }

                        ?>

                        
                        

                        
                    </div>
                </form>
                
                




            </div>
            
            


        </div>
    </div>
    <div class="fundoPopup deixarInvisivel"></div>
    <script>

        $(document).ready(function(){
            setTimeout(() => {
                $('.sucesso').addClass('deixarInvisivel');
            }, 5000);
        })

        var pathImagem = $('#fotoPerfil').attr('src');

        function avisoOff(){
            $('.aviso').addClass('deixarInvisivel');
        }


        $('#fecharSucesso-foto').on('click', function(){
            $('.sucesso-foto').addClass('deixarInvisivel');
        });

        $('#fecharSucesso-perfil').on('click', function(){
            $('.sucesso-perfil').addClass('deixarInvisivel');
        });

        $('#fecharSemSucesso-perfil').on('click', function(){
            $('.sem-sucesso-perfil').addClass('deixarInvisivel');
        });

        $('#fecharSemSucesso-foto').on('click', function(){
            $('.sem-sucesso-foto').addClass('deixarInvisivel');
        });

        $('#fecharInfoAcesso').on('click', function(){
            $('.info-acesso').addClass('deixarInvisivel');
        });

        $('.btnOkPopup').on('click', function(){
            $('.popupInfoSenha').addClass('deixarInvisivel');
        });



        $('#filePerfil').change(function(){
            var input = this;
            var url = $(this).val();
            var imagem = url.split("\\");
            imagem = imagem[imagem.length - 1];
            var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
            if (input.files && input.files[0]&& (ext == "png" || ext == "jpeg" || ext == "jpg")) 
            {

                
                
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.txtFilePerfil').val(imagem);
                    $('#fotoPerfil').attr('src', e.target.result);
                    $('.sem-sucesso-foto').addClass('deixarInvisivel');
                    $('#btnSalvar').prop('disabled', false);
                    $('#btnSalvar').css('cursor', 'pointer');
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                avisoOff();
                $('.txtFilePerfil').val(imagem);
                $('#fotoPerfil').attr('src', pathImagem);
                $('.sem-sucesso-foto').removeClass('deixarInvisivel');
                $('#btnSalvar').prop('disabled', true);
                $('#btnSalvar').css('cursor', 'not-allowed');
            }
        });


        $(document).on('click', '#fotoPerfil', function(){
            $('#fotoPerfilClicada').attr('src', $('#fotoPerfil').attr('src'));
            $('#fotoPerfilClicada').removeClass('deixarInvisivel');
            $('#fotoPerfilClicada').removeClass('fadeOut');
            $('#fotoPerfilClicada').addClass('fadeIn');
            $('.fundoPopup').removeClass('deixarInvisivel');
            $('.fundoPopup').removeClass('fadeOut');
            $('.fundoPopup').addClass('fadeIn');
        })

        $(document).on('click', '.fundoPopup', function(){
            $('#fotoPerfilClicada').removeClass('fadeIn');
            $('#fotoPerfilClicada').addClass('fadeOut');
            $('.fundoPopup').removeClass('fadeIn');
            $('.fundoPopup').addClass('fadeOut');
            setTimeout(() => {
                $('#fotoPerfilClicada').addClass('deixarInvisivel');
                $('.fundoPopup').addClass('deixarInvisivel');
            }, 150);
        })

        $(document).on('click', '#fotoPerfilClicada', function(){
            $('#fotoPerfilClicada').removeClass('fadeIn');
            $('#fotoPerfilClicada').addClass('fadeOut');
            $('.fundoPopup').removeClass('fadeIn');
            $('.fundoPopup').addClass('fadeOut');
            setTimeout(() => {
                $('#fotoPerfilClicada').addClass('deixarInvisivel');
                $('.fundoPopup').addClass('deixarInvisivel');
            }, 150);
            
        })




    </script>