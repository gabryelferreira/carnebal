<?php

include('Layouts/head.php');
include('Layouts/headerlogin.php');
?>
<body id="this-is-login-body">
    <div class="this-is-perfil marginHeader configPadrao">
        <div class="container">
            <div style="background-color: rgba(60, 60, 60, 1); max-width: 350px; width: 100%; border-radius: 10px; margin: auto;" class="allPerfil">
                <form style="width: 100%;" class="definirPerfil" action="gerarsenha" method="POST">
                    <div class="headerPerfil">
                        <i id="voltarParaLogin" style="cursor: pointer; position: absolute; left: 25px; top: 50%; transform: translateY(-50%); background: #ccc; padding: 13px 7px; border-radius: 50%; color: black;" class="fa fa-arrow-left fa-lg fa-fw"></i>
                        <h1 style="color: white;">Senha</h1>
                        <p style="color: white;">Gerar nova Senha.</p>
                    </div>
                    <div class="corpoPerfil">


                        <?php

                            

                            if (isset($_GET['erro']) && ($_GET['erro'] == 'user')){
                                echo '<div class="sem-sucesso">
                                <p>O usuário e/ou e-mail são inválidos.</p>
                                <i id="fecharSemSucesso" class="fa fa-times fa-lg fa-fw"></i>
                            </div>';
                            }

                            if (isset($_GET['success']) && ($_GET['success'] == 'password')){
                                echo '<div style="background: #27ae60;" class="sem-sucesso">
                                <p>A senha gerada foi enviada para seu e-mail.</p>
                                <i id="fecharInfoAcesso" class="fa fa-times fa-lg fa-fw"></i>
                            </div>';
                            }

                        ?>






                        <h1 style="color: white;">Usuário</h1>
                        <div class="inputWithImg">
                            <input style="color: white; background-color: transparent;" type="text" name="usuario" id="usuario" required class="validate" autocomplete="off" placeholder="Digite seu usuário">
                            <i style="background-color: transparent;" class="fa fa-user fa-lg fa-fw"></i>
                        </div>

                        <h1 style="color: white;">E-mail</h1>
                        <div class="inputWithImg">
                            <input style="color: white; background-color: transparent;" required minlength="8" maxlength="100" type="email" name="email" id="email" class="validate" autocomplete="off" placeholder="Digite seu e-mail">
                            <i style="background-color: transparent;" class="fa fa-at fa-lg fa-fw"></i>
                        </div>

                        <div style="margin: 0; " class="div-save-perfil">
                            <input style="box-shadow: none;" type="submit" value="Confirmar" id="btnSalvar">
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <div class="fundoPopup deixarInvisivel"></div>

    <script type="text/javascript" src="js/baseurl.js"></script>
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

        $('#voltarParaLogin').on('click', function(){
            window.location.href = baseUrl;
        })


    </script>