<?php

include('Layouts/head.php');
include('Layouts/header.php');

?>
<body id="this-is-body-default">
    <div class="this-is-consulta marginHeader configPadrao">
        <?php
        
        if (isset($_GET['erro']) && $_GET['erro'] == 'cpfexiste'){
            echo '<div style="background: #e74c3c;" class="sucesso sucesso-cpf">
            <i style="position:relative; float: left; padding-top: 22px;" class="fa fa-exclamation-triangle fa-lg fa-fw"></i>
            <p>CPF já cadastrado com mesmo cargo.</p>
            <i id="fecharSucesso-cpf" class="fa fa-times fa-lg fa-fw"></i>
        </div>';
        }

        if (isset($_GET['sucesso']) && $_GET['sucesso'] == 'funcionario'){
            echo '<div style="background: #27ae60;" class="sucesso sucesso-funcionario">
            <i style="position:relative; float: left; padding-top: 22px;" class="fa fa-check fa-lg fa-fw"></i>
            <p>Funcionário cadastrado com sucesso!</p>
            <i id="fecharSucesso-funcionario" class="fa fa-times fa-lg fa-fw"></i>
        </div>';
        }

        ?>
         <div class="container">
             <div class="allConsulta">
            <div class="consultaTituloPrincipal">
                <div>
                    <input type="button" class="backImageGreen maisCadastro" id="btnCadastrarFuncionario" value="+">
                </div>
                <h1 class="tituloTelaMain">Funcionários</h1>
                
                <div class="pagination-select"></div>
            </div>
            
            <div class="consulta">
                    <?php
                    $results = FuncionariosController::GetFuncionarios();
                    foreach($results as $result){
                        echo '<div id="consultaCampos'.$result[0].'" class="consultaCampos pagination-data deixarInvisivel">
                        <div class="fotoConsulta">
                            <img src="'.$result[10].'">
                        </div>
                        <div class="dadosConsulta">
                            
                            <h1>'.$result[1].'</h1>
                            <h2>'.$result[6].'</h2>
                            <div class="dadosConsultaExtra">
                                <h3><span>Nascimento: </span>'.$result[2].'</h3>
                                <h3><span>Sexo: </span>'.$result[7].'</h3>
                                <h3><span>CPF: </span>'.$result[3].'</h3>
                            </div>
                        </div>
                    </div>';
                    }
                    ?>
                    
                    
                    <div class="sem-consulta deixarInvisivel">
                        <h1>Nenhum funcionário foi encontrado.</h1>
                    </div>
                
                    
                    
                
            </div>
            </div>
        </div>   
    </div>
    <div class="container">
    <div class="pagination"></div>

    </div>
    
    <div class="popupTelefone popupAll deixarInvisivel">

        <div class="popupInside">
            <div class="popupTitle">

                <h1 class="RobotoC">Telefone</h1>
                <input type="button" class="fecharPopup" value="X">
            </div>
            <div class="popupMessage">
                <h1><span class="spanTelefone"></span></h1>
                <div class="btnsPopup">

                    <input type="button" class="btnOkPopup backImageBlue colorWhite" value="Entendi">
                </div>
            </div>

        </div>

    </div>
    
    
    
    <div class="this-is-cadastro deixarInvisivel">
        <div class="container">
        <form class="cadastro" action="cadastrarfuncionario" onsubmit="return validarForm()" method="POST">
            <div class="tituloCadastro">
                <h1 class="tituloTelaMain">Cadastro de funcionários</h1> 
                <i id="btnFecharCadastro" class="fa fa-times fa-lg fa-fw"></i>
            </div>
            
            <div class="cadastroDiv">
                <h2>Nome completo</h2>
                <div class="inputWithImg">
                    <input type="text" name="nome" id="nome" required class="validate" autocomplete="off" placeholder="Digite o nome">
                    <i class="fa fa-user fa-lg fa-fw"></i>
                </div>
                <div class="erroDiv" id="erroNome">
                    <p class="erroTexto nomeErroVazio deixarInvisivel">Preencha este campo</p>
                    <p class="erroTexto erroNomeInvalido deixarInvisivel">Nome inválido</p>
                </div>
            </div>
            <div class="cadastroDiv">
                <h2>Data de Nascimento</h2>
                <div class="inputWithImg">
                    <input required type="date" min="1940-01-01" max="<?php echo FuncionariosController::GetDataPermitida();?>" name="dtNasc" id="dtNasc" class="validate" autocomplete="off">
                    <i class="fa fa-calendar fa-lg fa-fw"></i>
                </div>
                <div class="erroDiv" id="erroDtNasc">
                    <p class="erroTexto dtNascErroVazio deixarInvisivel">Preencha este campo</p>
                </div>
            </div>
            
            <div class="cadastroDiv">
                <h2>CPF</h2>
                <div class="inputWithImg">
                    <input required type="number" minlength="11" maxlength="11" class="validate" name="cpf" id="cpf" autocomplete="off" placeholder="Digite o CPF">
                    <i class="fa fa-address-card fa-lg fa-fw"></i>
                </div>
                <div class="erroDiv" id="erroCPF">
                    <p class="erroTexto cpfErroInvalido deixarInvisivel">CPF Invalido</p>
                    <p class="erroTexto cpfErroCadastrado deixarInvisivel">CPF já cadastrado com mesmo cargo</p>

                </div>
            </div>
            
            <div class="cadastroDiv">
                <h2>Endereço</h2>
                <div class="inputWithImg">
                    <input required maxlength="200" type="text" name="endereco" id="endereco" class="validate" autocomplete="off" placeholder="Digite o endereço">
                    <i class="fa fa-envelope fa-lg fa-fw"></i>
                </div>
                <div class="erroDiv" id="erroEndereco">
                    <p class="erroTexto enderecoErroVazio deixarInvisivel">Preencha este campo</p>
                </div>
            </div>
            
            <div class="cadastroDiv">
                <h2>Complemento</h2>
                <div class="inputWithImg">
                    <input required maxlength="50" type="text" name="complemento" id="complemento" class="validate" autocomplete="off" placeholder="Digite o complemento">
                    <i class="fa fa-envelope fa-lg fa-fw"></i>
                </div>
                <div class="erroDiv" id="erroComplemento">
                    <p class="erroTexto complementoErroVazio deixarInvisivel">Preencha este campo</p>
                </div>
            </div>
            
            <div class="cadastroDiv">
                <h2>DDD</h2>
                <div class="inputWithImg">
                    <input required type="text" minlength="2" maxlength="2" name="ddd" id="ddd" class="validate" autocomplete="off" placeholder="Digite o DDD">
                    <i class="fa fa-phone fa-lg fa-fw"></i>
                </div>
                <div class="erroDiv" id="erroDDD">
                    <p class="erroTexto dddErroVazio deixarInvisivel">Preencha este campo</p>
                </div>
            </div>
            
            <div class="cadastroDiv">
                <h2>Telefone</h2>
                <div class="inputWithImg">
                    <input required minlength="8" maxlength="9" type="text" name="telefone" id="telefone" class="validate" autocomplete="off" placeholder="Digite o telefone">
                    <i class="fa fa-phone fa-lg fa-fw"></i>
                </div>
                <div class="erroDiv" id="erroTelefone">
                    <p class="erroTexto telefoneErroVazio deixarInvisivel">Preencha este campo</p>
                </div>
            </div>
            
            <div class="cadastroDiv">
                <h2>E-mail</h2>
                <div class="inputWithImg">
                    <input required minlength="8" maxlength="100" type="email" name="email" id="email" class="validate" autocomplete="off" placeholder="Digite o e-mail">
                    <i class="fa fa-envelope fa-lg fa-fw"></i>
                </div>
                <div class="erroDiv" id="erroEmail">
                    <p class="erroTexto emailErroVazio deixarInvisivel">Preencha este campo</p>
                </div>
            </div>
            
            <div class="cadastroDiv">
                <h2>Cargo</h2>
                <div class="inputWithImg">
                    <select required name="cargo" id="cargo">
                        <option value="C">Caixa</option>
                        <option value="G">Garçom</option>
                        <option value="A">Admin</option>
                    </select>
                </div>
            </div>
            
            <div class="cadastroDiv">
                <h2>Sexo</h2>
                <div class="inputWithImg">
                    <select required name="sexo" id="sexo">
                        <option value="M">Masculino</option>
                        <option value="F">Feminino</option>
                    </select>
                </div>
            </div>
            
            <div class="cadastroDivBtn">
                <input type="submit" value="Cadastrar">
            </div>
        </form>
        </div>
    </div>

    
    <script type="text/javascript" src="<?php echo BaseUrl::getBaseUrl();?>/js/pagination.js"></script>
    <script type="text/javascript" src="js/baseurl.js"></script>

    <script>
        $(document).ready(function(){

            var quantidadeFuncionarios = 0;
            $('.consultaCampos').map(function(){
                quantidadeFuncionarios = parseInt(quantidadeFuncionarios) + 1;
            })
            if (quantidadeFuncionarios == 0){
                $('.sem-consulta').removeClass('deixarInvisivel');
                $('.pagination').css('display', 'none');
                $('.pagination-select').css('display', 'none');
            } 

            setTimeout(() => {
                $('.sucesso').addClass('deixarInvisivel');
            }, 5000);

            $('#fecharSucesso-cpf').on('click', function(){
                $('.sucesso-cpf').addClass('deixarInvisivel');
            })

            $('#fecharSucesso-funcionario').on('click', function(){
                $('.sucesso-funcionario').addClass('deixarInvisivel');
            })

            $('#btnCadastrarFuncionario').on('click', function(){
                $('.this-is-cadastro').removeClass('deixarInvisivel');
                $('.cadastro').addClass('fadeIn');
            })//click btncadastrarfuncionario
            
            $('#btnFecharCadastro').on('click', function(){
                $('.this-is-cadastro').addClass('deixarInvisivel');
            })
            
            $(document).on('click', '.telefoneIcon', function(event){
                event.stopPropagation();
                $('.spanTelefone').text(this.id);
                $('.popupTelefone').removeClass('deixarInvisivel');
                $('.popupInside').addClass('fadeIn');
            })
            
            $('.btnOkPopup').on('click', function(){
                $('.popupAll').addClass('deixarInvisivel');
            });
            
            $(document).on('click', '.consultaCampos', function(){
                var id = this.id.split('consultaCampos')[1];
                window.location.href = "funcionarios/" + id;
            });

            
            
        })
        
        
        var timeOut;
        var tempoTimeout = 4000;
        
        function tornarErrosInvisiveis(){
            $('.erroTexto').addClass('deixarInvisivel');
        }
        
        
        //funcao para cancelar o timeout de deixar os erros invisíveis
        function cancelTimeOut() {
            clearTimeout(timeOut);
        }
        
        
        
        function validarForm(){
            var cpf = $('#cpf').val();
            var cargo = $('#cargo').val();
            cancelTimeOut();
            if (cpf.length != 11){
                $('.cpfErroInvalido').removeClass('deixarInvisivel');
                timeOut = setTimeout(tornarErrosInvisiveis, tempoTimeout);
                return false;
            } else {
                $('.cpfErroInvalido').addClass('deixarInvisivel');
                if (!validarCPF(cpf)){
                    $('.cpfErroInvalido').removeClass('deixarInvisivel');
                
                    timeOut = setTimeout(tornarErrosInvisiveis, tempoTimeout);
                    return false;
                } else {
                    $('.cpfErroInvalido').addClass('deixarInvisivel');
                    
                    if (verificarExistenciaCargoECPF(cpf, cargo)){
                        
                        $('.cpfErroCadastrado').removeClass('deixarInvisivel');
                        timeOut = setTimeout(tornarErrosInvisiveis, tempoTimeout);
                        return false;
                    } else {
                        $('.cpfErroCadastrado').addClass('deixarInvisivel');
                        return true;
                    }
                }
            }
            
            
        }//function
        
        
        function verificarExistenciaCargoECPF(cpf, cargo){
            
            var existe;
            var usuario = cpf + cargo;
            $.ajax({
                url: baseUrl + '/funcionarios/verificarexistenciacargoecpf',
                type: 'post',
                async: false,
                data: {
                    usuario: usuario
                },
                success: function(data){
                    existe = data.split(usuario)[1];
                    
                },
                error: function(){
                    alert("Erro de conexão");
                }
            });
            
            if (existe == "1"){
                return true;
            } else {
                return false;
            }
        }


        function validarCPF(cpf){

            if (cpf.length != 11){
                return false;
            }

            var cpfValido = true;
            var soma = 0;
            var resto = 0;
            var numerosIguais = 0;
            var primeiroNumero = cpf[0];
            



            for (i = 0; i < 11; i++){
                if (cpf[i] == primeiroNumero){
                    numerosIguais += 1;
                }
            }
            if (numerosIguais == 11){
                return false;
            }

            for (i = 0; i < 9; i++)
            {
                soma += parseInt(cpf[i]) * (10 - i);
            }

            resto = parseInt((parseInt(soma) * 10) % 11);
            if (resto == 10) resto = 0;
            if (resto == parseInt(cpf[9]))
            {

                soma = 0;
                resto = 0;

                for (i = 0; i < 10; i++)
                {
                    soma += parseInt(cpf[i]) * (11 - i);
                }

                resto = parseInt((parseInt(soma) * 10) % 11);
                if (resto == 10) resto = 0;


                if (resto == parseInt(cpf[10])){
                    cpfValido = true;
                } else {
                    cpfValido = false;
                }


            }
            else
            {
                cpfValido = false;
            }
            return cpfValido;
        }//function cpf
        
        
    </script>
</body>
</html>