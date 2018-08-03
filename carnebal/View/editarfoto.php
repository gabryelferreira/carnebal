<?php

include('Layouts/head.php');
include('Layouts/headereditar.php');

?>
<body id="this-is-body-default">
    <div class="this-is-perfil marginHeader configPadrao">

        <?php

            if (isset($_GET['success']) && ($_GET['success'] == 'foto')){
                echo '<div class="sucesso aviso">
                <i style="position:relative; float: left; padding-top: 22px;" class="fa fa-check fa-lg fa-fw"></i>
                <p>Foto alterada com sucesso!</p>
                <i id="fecharSucesso" class="fa fa-times fa-lg fa-fw"></i>
            </div>';
            }

        ?>

        <div class="container">
            <div class="allPerfil">

                <div class="opcoesPerfil">

                    <div class="inputWithImgPerfil">
                        <a class="colorBlack" href="<?php echo BaseUrl::getBaseUrl();?>/perfil/editar-perfil"><i class="fa fa-user fa-lg fa-fw"></i>Conta</a>
                        <a style="background: #27ae60; color: white;" class="opcaoPerfilSelecionada" href="<?php echo BaseUrl::getBaseUrl();?>/perfil/editar-foto"><i class="fa fa-image fa-lg fa-fw"></i>Foto</a>
                        <a class="colorBlack" href="<?php echo BaseUrl::getBaseUrl();?>/perfil/editar-senha"><i class="fa fa-lock fa-lg fa-fw"></i>Senha</a>
                    </div>
                </div>

                


                <form class="definirPerfil" action="alterarfoto" method="POST" enctype="multipart/form-data">
                    <div class="headerPerfil">
                        <h1>Foto</h1>
                        <p>Altere a foto de seu perfil.</p>
                    </div>
                    <div class="corpoPerfil">
                        

                        <?php

                        if (isset($_GET['erro']) && ($_GET['erro'] == 'senha')){
                            echo '<div class="sem-sucesso aviso">
                            <p>A senha digitada está incorreta.</p>
                            <i id="fecharSemSucesso" class="fa fa-times fa-lg fa-fw"></i>
                        </div>';
                        }

                        if (isset($_GET['info']) && ($_GET['info'] == 'acesso')){
                            echo '<div class="info-acesso aviso">
                            <p>Para ter acesso ao sistema, é necessário alterar sua senha.</p>
                            <i id="fecharInfoAcesso" class="fa fa-times fa-lg fa-fw"></i>
                        </div>';
                        }

                        ?>
                        
                        <div class="sem-sucesso deixarInvisivel">
                            <p>Extensão não permitida.</p>
                            <i id="fecharSemSucesso" class="fa fa-times fa-lg fa-fw"></i>
                        </div>


                        <div class="formPerfilFoto">
                            <img src="<?php echo $_SESSION['foto'];?>" id="fotoPerfil">
                            <img src="" id="fotoPerfilClicada" class="deixarInvisivel">
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

            $('#fecharSucesso').on('click', function(){
                $('.sucesso').addClass('deixarInvisivel');
            });

            $('#fecharSemSucesso').on('click', function(){
                $('.sem-sucesso').addClass('deixarInvisivel');
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
                        $('.sem-sucesso').addClass('deixarInvisivel');
                        $('#btnSalvar').prop('disabled', false);
                        $('#btnSalvar').css('cursor', 'pointer');
                    }
                    reader.readAsDataURL(input.files[0]);
                } else {
                    avisoOff();
                    $('.txtFilePerfil').val(imagem);
                    $('#fotoPerfil').attr('src', pathImagem);
                    $('.sem-sucesso').removeClass('deixarInvisivel');
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