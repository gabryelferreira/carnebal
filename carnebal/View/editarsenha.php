<?php

include('Layouts/head.php');
include('Layouts/headereditar.php');

?>
<body id="this-is-body-default">
    <div class="this-is-perfil marginHeader configPadrao">
        <?php

            if (isset($_GET['success']) && ($_GET['success'] == 'senha')){
                echo '<div class="sucesso">
                <i style="position:relative; float: left; padding-top: 22px;" class="fa fa-check fa-lg fa-fw"></i>
                <p>Senha alterada com sucesso!</p>
                <i id="fecharSucesso" class="fa fa-times fa-lg fa-fw"></i>
            </div>';
            }

        ?>
        <div class="container">
            <div class="allPerfil">

                <div class="opcoesPerfil">

                    <div class="inputWithImgPerfil">
                        <a class="colorBlack" href="<?php echo BaseUrl::getBaseUrl();?>/perfil/editar-perfil"><i class="fa fa-user fa-lg fa-fw"></i>Conta</a>
                        <a class="colorBlack" href="<?php echo BaseUrl::getBaseUrl();?>/perfil/editar-foto"><i class="fa fa-image fa-lg fa-fw"></i>Foto</a>
                        <a style="background: #27ae60; color: white;" class="opcaoPerfilSelecionada" href="<?php echo BaseUrl::getBaseUrl();?>/perfil/editar-senha"><i class="fa fa-lock fa-lg fa-fw"></i>Senha</a>
                    </div>
                </div>

                


                <form class="definirPerfil" onsubmit="return validar()" action="alterarsenha" method="POST">
                    <div class="headerPerfil">
                        <h1>Senha</h1>
                        <p>Altere sua senha com frequência.</p>
                    </div>
                    <div class="corpoPerfil">
                        

                        <?php

                        

                        if (isset($_GET['erro']) && ($_GET['erro'] == 'senha')){
                            echo '<div class="sem-sucesso">
                            <p>A senha digitada não corresponde a sua senha atual.</p>
                            <i id="fecharSemSucesso" class="fa fa-times fa-lg fa-fw"></i>
                        </div>';
                        }

                        if (isset($_GET['info']) && ($_GET['info'] == 'acesso')){
                            echo '<div class="info-acesso">
                            <p>Para ter acesso ao sistema, é necessário alterar sua senha.</p>
                            <i id="fecharInfoAcesso" class="fa fa-times fa-lg fa-fw"></i>
                        </div>';
                        }

                        ?>

                        

                        <h1>Senha atual<i style="cursor: pointer;" id="infoSenha" class="fa fa-info-circle fa-lg fa-fw"></i></h1>
                        
                        <div class="inputWithImg">
                            <input type="password" autocomplete="off" name="senha" id="senha" required class="validate" autocomplete="off" placeholder="**********">
                            <i class="fa fa-lock fa-lg fa-fw"></i>
                        </div>

                        <h1>Nova senha</h1>
                        <div class="inputWithImg">
                            <input type="password" autocomplete="off" name="senha1" id="senha1" required class="validate" autocomplete="off" placeholder="**********">
                            <i class="fa fa-lock fa-lg fa-fw"></i>
                        </div>

                        <h1>Repetir nova senha</h1>
                        <div class="inputWithImg">
                            <input style="margin-bottom: 0;" type="password" autocomplete="off" name="senha2" id="senha2" required class="validate" autocomplete="off" placeholder="**********">
                            <i class="fa fa-lock fa-lg fa-fw"></i>
                        </div>


                        <div class="deixarInvisivel erro-alterar-perfil">
                            <p>As senhas digitadas não são iguais ou sua senha é fraca (mínimo 8 caracteres com caixa alta e baixa, números e caracteres especiais)</p>
                        </div>

                        <div class="div-save-perfil">
                            <input type="submit" value="Salvar" id="btnSalvar">
                        </div>
                    </div>
                </form>

            </div>
            
        </div>
    </div>

    <div class="popupInfoSenha popupAll deixarInvisivel">

        <div class="popupInside">
            <div class="popupTitle">

                <h1 class="RobotoC">Senha default</h1>
                <input type="button" class="fecharPopup" value="X">
            </div>
            <div class="popupMessage">
                <h1>Caso seja seu primeiro acesso, sua senha é sua data de nascimento (apenas os números, no formato ddMMYYYY).</h1>
                <div class="btnsPopup">

                    <input type="button" class="btnOkPopup backImageBlue colorWhite" value="Entendi">
                </div>
            </div>

        </div>

    </div>

    <script>

        $(document).ready(function(){
            setTimeout(() => {
                $('.sucesso').addClass('deixarInvisivel');
            }, 5000);
        })

        function validar(){
            $('.erro-alterar-perfil').addClass('deixarInvisivel');
            var senha1 = $('#senha1').val();
            var senha2 = $('#senha2').val();
            if ((senha1 === senha2) && forcaPassword(senha1)){
                return true;
            } else {
                $('.erro-alterar-perfil').removeClass('deixarInvisivel');
                return false;
            }

            
        }

        function forcaPassword(string){
            return new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})").test(string);
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

            $('#senha1').on('keyup', function(e){
                if (e.which != 13){
                    $('.erro-alterar-perfil').addClass('deixarInvisivel');
                }
                
            });

            $('#senha2').on('keyup', function(e){
                if (e.which != 13){
                    $('.erro-alterar-perfil').addClass('deixarInvisivel');
                }
            });


            $('#infoSenha').on('click', function(){
                $('.popupInfoSenha').removeClass('deixarInvisivel');
                $('.popupInfoSenha').addClass('fadeIn');
            });

            $('.btnOkPopup').on('click', function(){
                $('.popupInfoSenha').addClass('deixarInvisivel');
            });

    </script>