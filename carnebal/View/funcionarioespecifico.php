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
                        <p>Altere a foto do perfil.</p>
                    </div>
                    <div class="corpoPerfil">
                        
                        <div class="sem-sucesso sem-sucesso-foto deixarInvisivel">
                            <p>Extensão não permitida.</p>
                            <i id="fecharSemSucesso-foto" class="fa fa-times fa-lg fa-fw"></i>
                        </div>


                        <div class="formPerfilFoto">
                            <img src="
                            <?php $id = explode('/', $_SERVER['REQUEST_URI']);
                            $results = FuncionarioEspecificoController::GetPathImagem(end($id));
                            foreach($results as $result){
                                echo $result[0];
                            }

                            ?>
                            " id="fotoPerfil">
                            <img src="" id="fotoPerfilClicada" class="deixarInvisivel">
                            <?php
                            echo '<input type="text" name="cdFuncionario" id="cdFuncionario" class="deixarInvisivel" value="'.end($id).'">';
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




                <form style="width: 100%;" class="definirPerfil" action="alterarperfil" method="POST">
                    <div class="headerPerfil">
                        <h1>Perfil</h1>
                        <p>Altere as configurações do perfil.</p>
                    </div>
                    <div class="corpoPerfil">



                        <?php



                        $id = explode('/', $_SERVER['REQUEST_URI']);
                        echo '<input type="text" name="cdFuncionario" id="cdFuncionario" class="deixarInvisivel" value="'.end($id).'">';


                        $results = FuncionarioEspecificoController::GetFuncionario(end($id));
                        foreach ($results as $result){
                            echo '<h1>Nome completo</h1>
                            <div class="inputWithImg">
                                <input type="text" name="nome" id="nome" required class="validate" autocomplete="off" placeholder="Digite o nome" value="'.$result[1].'">
                                <i class="fa fa-user fa-lg fa-fw"></i>
                            </div>
        
                            <h1>CPF</h1>
                            <div class="inputWithImg">
                                <input disabled type="text" name="cpf" id="cpf" class="validate" autocomplete="off" placeholder="CPF" value="'.$result[3].'">
                                <i class="fa fa-address-card fa-lg fa-fw"></i>
                            </div>

                            <h1>Data de nascimento</h1>
                            <div class="inputWithImg">
                                <input required type="date" min="1940-01-01" max="'.FuncionariosController::GetDataPermitida().'" name="dtNasc" id="dtNasc" class="validate" autocomplete="off" value="'.$result[2].'">
                                <i class="fa fa-calendar fa-lg fa-fw"></i>
                            </div>


                            <h1>Endereço</h1>
                            <div class="inputWithImg">
                                <input required maxlength="200" type="text" name="endereco" id="endereco" class="validate" autocomplete="off" placeholder="Digite o endereço" value="'.$result[4].'">
                                <i class="fa fa-home fa-lg fa-fw"></i>
                            </div>
    
                            <h1>Complemento</h1>
                            <div class="inputWithImg">
                                <input required maxlength="50" type="text" name="complemento" id="complemento" class="validate" autocomplete="off" placeholder="Digite o complemento" value="'.$result[5].'">
                                <i class="fa fa-home fa-lg fa-fw"></i>
                            </div>
    
                            <h1>DDD</h1>
                            <div class="inputWithImg">
                                <input required type="text" minlength="2" maxlength="2" name="ddd" id="ddd" class="validate" autocomplete="off" placeholder="Digite o DDD" value="'.$result[8].'">
                                <i class="fa fa-phone fa-lg fa-fw"></i>
                            </div>
    
                            <h1>Telefone</h1>
                            <div class="inputWithImg">
                                <input required minlength="8" maxlength="9" type="text" name="telefone" id="telefone" class="validate" autocomplete="off" placeholder="Digite o telefone" value="'.$result[9].'">
                                <i class="fa fa-phone fa-lg fa-fw"></i>
                            </div>
    
                            <h1>E-mail</h1>
                            <div class="inputWithImg">
                                <input required minlength="8" maxlength="100" type="email" name="email" id="email" class="validate" autocomplete="off" placeholder="Digite o e-mail" value="'.$result[10].'">
                                <i class="fa fa-at fa-lg fa-fw"></i>
                            </div>
    
                            <h1>Cargo</h1>
                            <div class="inputWithImg">
                                <select disabled required name="cargo" id="cargo">';
                                if ($result[6] == 'C'){
                                    echo '<option value="C" selected>Caixa</option>
                                    <option value="G">Garçom</option>
                                    <option value="A">Admin</option>';
                                } else
                                if ($result[6] == 'G'){
                                    echo '<option value="C">Caixa</option>
                                    <option value="G" selected>Garçom</option>
                                    <option value="A">Admin</option>';
                                } else
                                if ($result[6] == 'A'){
                                    echo '<option value="C">Caixa</option>
                                    <option value="G">Garçom</option>
                                    <option value="A" selected>Admin</option>';
                                }
                                echo '</select>
                            </div>
    
                            <h1>Sexo</h1>
                            <div class="inputWithImg">
                                <select style="margin-bottom: 0;" required name="sexo" id="sexo">';
                                if ($result[7] == 'F'){
                                    echo '<option value="M">Masculino</option>
                                    <option value="F" selected>Feminino</option>';
                                } else {
                                    echo '<option value="M" selected>Masculino</option>
                                    <option value="F">Feminino</option>';
                                }
                                
                                echo '</select>
                            </div>
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