<?php

include('Layouts/head.php');
include('Layouts/headereditar.php');

?>
<body id="this-is-body-default">
    <div class="this-is-perfil marginHeader configPadrao">

        <?php


            if (isset($_GET['success']) && ($_GET['success'] == 'perfil')){
                echo '<div class="sucesso">
                <i style="position:relative; float: left; padding-top: 22px;" class="fa fa-check fa-lg fa-fw"></i>
                <p>Perfil alterado com sucesso!</p>
                <i id="fecharSucesso" class="fa fa-times fa-lg fa-fw"></i>
            </div>';
            }

        ?>

        <div class="container">
            <div class="allPerfil">

                <div class="opcoesPerfil">

                    <div class="inputWithImgPerfil">
                        <a style="background: #27ae60; color: white;" class="opcaoPerfilSelecionada" href="<?php echo BaseUrl::getBaseUrl();?>/perfil/editar-perfil"><i class="fa fa-user fa-lg fa-fw"></i>Conta</a>
                        <a class="colorBlack" href="<?php echo BaseUrl::getBaseUrl();?>/perfil/editar-foto"><i class="fa fa-image fa-lg fa-fw"></i>Foto</a>
                        <a class="colorBlack" href="<?php echo BaseUrl::getBaseUrl();?>/perfil/editar-senha"><i class="fa fa-lock fa-lg fa-fw"></i>Senha</a>
                    </div>
                </div>




                <form class="definirPerfil" action="alterarperfil" method="POST">
                    <div class="headerPerfil">
                        <h1>Perfil</h1>
                        <p>Altere as configurações do perfil.</p>
                    </div>
                    <div class="corpoPerfil">



                        <?php



                        if (isset($_GET['erro']) && ($_GET['erro'] == 'perfil')){
                            echo '<div class="sem-sucesso">
                            <p>Ocorreu um erro. Tente novamente.</p>
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




                        <h1>Nome completo</h1>
                        <div class="inputWithImg">
                            <input type="text" name="nome" id="nome" required class="validate" autocomplete="off" placeholder="Digite o nome" value="<?php echo $_SESSION['nomeFuncionario']; ?>">
                            <i class="fa fa-user fa-lg fa-fw"></i>
                        </div>

                        <h1>CPF</h1>
                        <div class="inputWithImg">
                            <input disabled type="text" name="cpf" id="cpf" class="validate" autocomplete="off" placeholder="CPF" value="<?php echo $_SESSION['cpf']; ?>">
                            <i class="fa fa-address-card fa-lg fa-fw"></i>
                        </div>

                        <h1>Data de nascimento</h1>
                        <div class="inputWithImg">
                            <input required type="date" min="1940-01-01" max="<?php echo FuncionariosController::GetDataPermitida();?>" name="dtNasc" id="dtNasc" class="validate" autocomplete="off" value="<?php echo $_SESSION['dtNasc']; ?>">
                            <i class="fa fa-calendar fa-lg fa-fw"></i>
                        </div>

                        <h1>Endereço</h1>
                        <div class="inputWithImg">
                            <input required maxlength="200" type="text" name="endereco" id="endereco" class="validate" autocomplete="off" placeholder="Digite o endereço" value="<?php echo $_SESSION['endereco']; ?>">
                            <i class="fa fa-home fa-lg fa-fw"></i>
                        </div>

                        <h1>Complemento</h1>
                        <div class="inputWithImg">
                            <input required maxlength="50" type="text" name="complemento" id="complemento" class="validate" autocomplete="off" placeholder="Digite o complemento" value="<?php echo $_SESSION['complemento']; ?>">
                            <i class="fa fa-home fa-lg fa-fw"></i>
                        </div>

                        <h1>DDD</h1>
                        <div class="inputWithImg">
                            <input required type="text" minlength="2" maxlength="2" name="ddd" id="ddd" class="validate" autocomplete="off" placeholder="Digite o DDD" value="<?php echo $_SESSION['ddd']; ?>">
                            <i class="fa fa-phone fa-lg fa-fw"></i>
                        </div>

                        <h1>Telefone</h1>
                        <div class="inputWithImg">
                            <input required minlength="8" maxlength="9" type="text" name="telefone" id="telefone" class="validate" autocomplete="off" placeholder="Digite o telefone" value="<?php echo $_SESSION['telefone']; ?>">
                            <i class="fa fa-phone fa-lg fa-fw"></i>
                        </div>

                        <h1>E-mail</h1>
                        <div class="inputWithImg">
                            <input required minlength="8" maxlength="100" type="email" name="email" id="email" class="validate" autocomplete="off" placeholder="Digite o e-mail" value="<?php echo $_SESSION['email']; ?>">
                            <i class="fa fa-at fa-lg fa-fw"></i>
                        </div>

                        <h1>Cargo</h1>
                        <div class="inputWithImg">
                            <select disabled required name="cargo" id="cargo">
                                <option value="C" <?php echo $_SESSION['cargo']=='C'?'selected':'' ?>>Caixa</option>
                                <option value="G" <?php echo $_SESSION['cargo']=='G'?'selected':'' ?>>Garçom</option>
                                <option value="A" <?php echo $_SESSION['cargo']=='A'?'selected':'' ?>>Admin</option>
                            </select>
                        </div>

                        <h1>Sexo</h1>
                        <div class="inputWithImg">
                            <select style="margin-bottom: 0;" required name="sexo" id="sexo">
                                <option value="M" <?php echo $_SESSION['sexo']=='M'?'selected':'' ?>>Masculino</option>
                                <option value="F"<?php echo $_SESSION['sexo']=='F'?'selected':'' ?>>Feminino</option>
                            </select>
                        </div>
                        <div class="div-save-perfil">
                            <input type="submit" value="Salvar" id="btnSalvar">
                        </div>
                    </div>
                </form>

            </div>
            
        </div>
    </div>
    <script>

        $(document).ready(function(){
            setTimeout(() => {
                $('.sucesso').addClass('deixarInvisivel');
            }, 5000);
        })


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

        


    </script>