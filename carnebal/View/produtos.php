<?php

include('Layouts/head.php');
include('Layouts/header.php');

?>
<body id="this-is-body-default">
    <div class="this-is-consulta marginHeader configPadrao">
        <?php
        
        if (isset($_GET['success']) && $_GET['success'] == 'produto'){
            echo '<div style="background: #27ae60;" class="sucesso sucesso-produto">
            <i style="position:relative; float: left; padding-top: 22px;" class="fa fa-check fa-lg fa-fw"></i>
            <p>Produto cadastrado com sucesso!</p>
            <i id="fecharSucesso-produto" class="fa fa-times fa-lg fa-fw"></i>
        </div>';
        }

        if (isset($_GET['erro']) && $_GET['erro'] == 'produto'){
            echo '<div style="background: #c0392b;" class="sucesso sem-sucesso-produto">
            <i style="position:relative; float: left; padding-top: 22px;" class="fa fa-exclamation-triangle fa-lg fa-fw"></i>
            <p>Ocorreu um erro.</p>
            <i id="fecharSemSucesso-produto" class="fa fa-times fa-lg fa-fw"></i>
        </div>';
        }

        ?>
         <div class="container">
             <div class="allConsulta">
            <div class="consultaTituloPrincipal">
                <div>
                    <input type="button" class="backImageGreen maisCadastro" id="btnCadastrarProduto" value="+">
                </div>
                <h1 class="tituloTelaMain">Produtos</h1>
                
                <div class="pagination-select"></div>
            </div>
            
            <div class="consulta">

                    <?php
                    $results = ProdutosController::GetProdutos();
                    foreach($results as $result){
                        echo '<div id="consultaCampos'.$result[0].'" class="consultaCampos pagination-data deixarInvisivel">
                        <div class="fotoConsulta">
                            <img src="'.$result[4].'">
                        </div>
                        <div class="dadosConsulta">
                            <div class="btnAcessar">
                                <a href="produtos/'.$result[0].'" class="btnCarrinho btnAcessarPerfil"><i style="margin: 0 5px 0 0;" class="fa fa-arrow-right fa-lg fa-fw"></i>Acessar</a>
                            </div>
                            <h1>'.$result[1].'</h1>
                            <h2>R$ '.$result[3].'</h2>
                            <div class="dadosConsultaExtra">
                                <h3 style="height: 100%;"><span>Descrição: </span>'.$result[2].'</h3>
                            </div>
                        </div>
                    </div>';
                    }
                    ?>
                        <div class="sem-consulta deixarInvisivel">
                            <h1>Nenhum produto foi encontrado.</h1>
                        </div>
                    
                
            </div>
            </div>
        </div>   
    </div>
    <div class="container">
    <div class="pagination"></div>

    </div>
    <div class="this-is-cadastro deixarInvisivel">
        <div class="container">
            <form class="cadastro" action="cadastrarproduto" onsubmit="return validarPreco()" method="POST">
                <div class="tituloCadastro">
                    <h1 class="tituloTelaMain">Cadastro de produtos</h1> 
                    <i id="btnFecharCadastro" class="fa fa-times fa-lg fa-fw"></i>
                </div>
                
                <div class="cadastroDiv">
                    <h2>Produto</h2>
                    <div class="inputWithImg">
                        <input type="text" name="nome" id="nome" required class="validate" autocomplete="off" placeholder="Digite o nome do produto">
                        <i class="fa fa-cutlery fa-lg fa-fw"></i>
                    </div>
                </div>
                <div class="cadastroDiv">
                    <h2>Preço unitário</h2>
                    <div class="inputWithImg">
                        <input required type="text" name="preco" id="preco" class="validate" autocomplete="off" placeholder="Digite o preço">
                        <i style="padding: 9px 12px; font-family: Roboto Condensed, sans-serif; font-size: 18px;">R$</i>
                    </div>
                    <div class="erroDiv" id="erroPreco">
                        <p class="erroTexto precoErroInvalido deixarInvisivel">Preço Inválido</p>
                    </div>
                </div>
                
                <div class="cadastroDiv">
                    <h2>Descricao</h2> 
                    <textarea required type="text" class="validate" name="descricao" id="descricao" autocomplete="off" placeholder="Digite a descrição"></textarea>
                </div>
                
                

                
                <div class="cadastroDivBtn">
                    <input type="submit" value="Cadastrar">
                </div>
            </form>
        </div>
    </div>


    
    <script type="text/javascript" src="<?php echo BaseUrl::getBaseUrl();?>/js/pagination.js"></script>
    <script>
        $(document).ready(function(){

            setTimeout(() => {
                $('.sucesso').addClass('deixarInvisivel');
            }, 5000);

            $('#fecharSucesso-produto').on('click', function(){
                $('.sucesso-produto').addClass('deixarInvisivel');
            })

            $('#fecharSemSucesso-produto').on('click', function(){
                $('.sem-sucesso-produto').addClass('deixarInvisivel');
            })



            var quantidadeProdutos = 0;
            $('.consultaCampos').map(function(){
                quantidadeProdutos = parseInt(quantidadeProdutos) + 1;
            })
            if (quantidadeProdutos == 0){
                $('.sem-consulta').removeClass('deixarInvisivel');
                $('.pagination').css('display', 'none');
                $('.pagination-select').css('display', 'none');
            } 


            $('#btnCadastrarProduto').on('click', function(){
                $('.this-is-cadastro').removeClass('deixarInvisivel');
                $('.cadastro').addClass('fadeIn');
            })//click btncadastrarfuncionario
            
            $('#btnFecharCadastro').on('click', function(){
                $('.this-is-cadastro').addClass('deixarInvisivel');
            })
            
            $(document).on('click', '.consultaCampos', function(){
                var id = this.id.split('consultaCampos')[1];
                window.location.href = "produtos/" + id;
            });
            
            
            
            $('#preco').keypress(function(e){
                var aceitar = false;
                var campo = $('#preco').val();
                var digitado = String.fromCharCode(e.which);
                var aceito = "0123456789,.";
                
                if (campo.length >= 7){
                    e.preventDefault();
                }
                
                for (i = 0; i < campo.length; i++){
                    if ((campo[i] == ",") || (campo[i] == ".")){
                        if (campo.length - i > 2){
                            e.preventDefault();
                        }
                        break;
                    }
                }
                for (i = 0; i < aceito.length; i++){
                    if (digitado == aceito[i]){
                        aceitar = true;
                        if ((digitado == ",") || (digitado == ".")){
                            for (i = 0; i < campo.length; i++){
                                if ((campo[i] == ",") || (campo[i] == ".")){
                                    aceitar = false;
                                    break;
                                }
                            }
                        }
                        
                        break;
                    }
                    
                    
                }
                if (!aceitar){
                    e.preventDefault();
                }
                
            })
            
            
            
            
            
            
        })
        var timeOut;
        var tempoTimeout = 4000;
        
        //funcao para tornar erros invisiveis
        function tornarErrosInvisiveis(){
            $('.erroTexto').addClass('deixarInvisivel');
        }

        //funcao para cancelar o timeout de deixar os erros invisíveis
        function cancelTimeOut() {
            clearTimeout(timeOut);
        }
        
        function validarPreco(){
            cancelTimeOut();
            tornarErrosInvisiveis();
            if (($('#preco').val() == ".") || ($('#preco').val() == ",")){
                $('.precoErroInvalido').removeClass('deixarInvisivel');
                $('.precoErroInvalido').addClass('fadeIn');
                
                timeOut = setTimeout(tornarErrosInvisiveis, tempoTimeout);
                return false;
            }
        }
        
        
        
        
        
        
    </script>
</body>
</html>