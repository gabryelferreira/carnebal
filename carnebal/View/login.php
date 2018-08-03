<?php
session_start();

if (isset($_SESSION['cargo']) && $_SESSION['cargo'] == 'A'){
    header("Location: ".BaseUrl::getBaseUrl()."/principal");
}

if (isset($_SESSION['cargo']) && $_SESSION['cargo'] == 'C'){
    header("Location: ".BaseUrl::getBaseUrl()."/atendimento");
}

include("Layouts/head.php");
include('Layouts/headerlogin.php');

?>
<body id="this-is-login-body">
    <div style="margin-top: 65px;" class="this-is-login">
        <?php
            if (isset($_GET["erro"]) && $_GET["erro"] == 'permissao') {
                echo '<div class="erroPermissao">
                        <h4>Você não tem permissão para acessar o sistema.</h4>
                        <p class="btnFecharErroPermissao">X</p>
                    </div>';
            }
        ?>
        
        <?php
            $countFunc = LoginController::ContemFuncionarios();
            if ($countFunc != 0){
                echo '<form class="login" action="fazerlogin" method="POST"> 

                <tr>
    
                    <td><h2>Nome de usuário</h2></td>
    
                    <td>
                        <div class="inputWithImg">
                            <input style="color: white;" required type="text" name="usuario" id="usuario" autocomplete="off" placeholder="Usuário">
                            <i style="background-color: transparent;" class="fa fa-user fa-lg fa-fw"></i>
                        </div>
                    </td>';

                if (isset($_GET["erro"]) && $_GET["erro"] == 'usuario') {
                    echo '<div class="erroDadosIncorretos">
                        <h4>Usuário incorreto</h4>
                        <p class="btnFecharErroDados">X</p>
                    </div>';
                }

                echo '</tr>
                <tr>
    
                    <td><h2 class="marginTop20">Senha</h2></td>
                    <td>
                    <div class="inputWithImg">
                        <input style="color: white;" required type="password" name="senha" id="senha" placeholder="**********">
                        <i style="background-color: transparent;" class="fa fa-lock fa-lg fa-fw"></i>
                    </div>
                    </td>';

                if (isset($_GET["erro"]) && $_GET["erro"] == 'senha') {
                    echo '<div class="erroDadosIncorretos">
                        <h4>Senha incorreta</h4>
                        <p class="btnFecharErroDados">X</p>
                    </div>';
                }

                echo '</tr>
                <tr>
                    <td><input type="submit" class="marginTop20" id="btnEntrar" value="Entrar"></td> 
                </tr>
                <tr>
                    <td><a class="esqueceu-a-senha-label" href="'; echo BaseUrl::getBaseUrl(); echo '/esqueci-senha">Esqueceu a senha?</a></td>
                </tr>
                    
    
            </form>';

            } else {
                echo '<form class="cadastre" action="cadastrarlogin" onsubmit="return validar()" method="POST"> 

                <tr>

                    <td><h2>Nome completo</h2></td>

                    <td>
                        <div class="inputWithImg">
                            <input style="color: white;" required type="text" maxlength="100" name="nome" id="nome" autocomplete="off" placeholder="Digite seu nome">
                            <i style="background-color: transparent;" class="fa fa-user fa-lg fa-fw"></i>
                        </div>
                    </td>

                </tr>
                <tr>

                    <td><h2 class="marginTop20">Data de nascimento</h2></td>
                    <td>
                        <div class="inputWithImg">
                            <input style="color: white;" required type="date" min="1940-01-01" max="<?php echo FuncionariosController::GetDataPermitida();?>" name="dtNasc" id="dtNasc">
                            <i style="background-color: transparent;" class="fa fa-calendar fa-lg fa-fw"></i>
                        </div>
                    </td>
                </tr>
                <tr>

                    <td><h2 class="marginTop20">CPF</h2></td>
                    <td>
                        <div class="inputWithImg">
                            <input style="color: white;" required type="text" minlength="11" maxlength="11" name="cpf" id="cpf" placeholder="Digite seu CPF">
                            <i style="background-color: transparent;" class="fa fa-address-card fa-lg fa-fw"></i>
                        </div>
                    </td>
                    <div class="erroDiv" id="erroCPF">
                        <p class="erroTexto cpfErroInvalido deixarInvisivel">CPF Invalido</p>
                    </div>
                </tr>
                
                
                <tr>
                    <td><input type="submit" class="marginTop20" id="btnCadastrar" value="Cadastrar"></td> 
                </tr>

            </form>';
            }
        ?>

        
            
        <?php
        //funcao que retorna a quantidade de administradores do sistema
//        $results = Admin::GetCountAdmin();
//        foreach($results as $result){
//            if ($result[0] == 0)
//                $result = 0;
//            else
//                $result = 1;
//            
//        } 
//        //caso nao tenha nenhum administrador, o sistema libera a criação de uma conta, pois o sistema é composto por apenas um admin
//        if ($result == 0){
//            echo '<div class="cadastroForm"> 
//                <h2>Não possui uma conta?</h2>
//                <a href="cadastro/admin"><input type="submit" id="btnCadastrar" class="backImageLinearBlue" value="Cadastre-se"></a> 
//        </div>';
//        }
        ?>
        
    </div>
    <script>
        
        $(document).ready(function(){
            $('#login-option').on('click', function(){
                $('#login-option').addClass('borderLoginOption');
                $('#cadastre-option').removeClass('borderCadastreOption');
                $('.login').removeClass('formInativo');
                $('.cadastre').addClass('formInativo');
                $('.login').addClass('zIndex9999');
                $('.cadastre').removeClass('zIndex9999');
            })
            $('#cadastre-option').on('click', function(){
                $('#cadastre-option').addClass('borderCadastreOption');
                $('#login-option').removeClass('borderLoginOption');
                $('.cadastre').removeClass('formInativo');
                $('.login').addClass('formInativo');
                $('.cadastre').addClass('zIndex9999');
                $('.login').removeClass('zIndex9999');
            })
        })
        
        var timeOut;
        var tempoTimeout = 4000;
        
        
        
        setTimeout(tornarErroDadosInvisiveis, 5000);
        
        //funcao que torna os erros de usuário e senha invisíveis
        function tornarErroDadosInvisiveis(){
            $('.erroDadosIncorretos').addClass('deixarInvisivel');
        }
        
        //funcao que torna os erros invisíveis
        function tornarErrosInvisiveis(){
            $('.erroTexto').addClass('deixarInvisivel');
        }
        
        //funcao de cancelarTimeout de tornar o erros erros invisiveis
        function cancelarTimeOut() {
            clearTimeout(timeOut);
        }
        
        
        //funcao que fecha os erros de usuário e senha
        $(document).ready(function(){
            $(document).on('click', '.btnFecharErroDados', function(){
                $('.erroDadosIncorretos').addClass('deixarInvisivel');
            })
            
            $(document).on('click', '.btnFecharErroPermissao', function(){
                $('.erroPermissao').addClass('deixarInvisivel');
            })
        })
        
        
        function validar(){
            var cpf = $('#cpf').val();
            if (!validarCPF(cpf)){
                $('.cpfErroInvalido').removeClass('deixarInvisivel');
            
                timeOut = setTimeout(tornarErrosInvisiveis, tempoTimeout);
                return false;
            } else {
                return true;
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

            resto = (soma * 10) % 11;
            if (resto == 10) resto = 0;
            if (resto == parseInt(cpf[9]))
            {

                soma = 0;
                resto = 0;

                for (i = 0; i < 10; i++)
                {
                    soma += parseInt(cpf[i]) * (11 - i);
                }

                resto = (soma * 10) % 11;
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