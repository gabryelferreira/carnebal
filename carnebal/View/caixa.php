
<?php

include('Layouts/head.php');
include('Layouts/header.php');

?>
<body id="this-is-body-default">
<div class="this-is-consulta marginHeader configPadrao">
        <?php
        
        if (isset($_GET['erro']) && $_GET['erro'] == 'cpfexiste'){
            echo '<div style="background: #e74c3c;" class="sucesso sucesso-cpf">
            <p>CPF já cadastrado com mesmo cargo.</p>
            <i id="fecharSucesso-cpf" class="fa fa-times fa-lg fa-fw"></i>
        </div>';
        }

        ?>
         <div class="container">
            <div class="allConsulta">
                <div class="consultaTituloPrincipal">
                    <h1 class="tituloTelaMain">Comandas</h1>
                    
                    <div class="pagination-select"></div>
                </div>
                
                <div class="consulta">

                        <?php
                        $results = CaixaController::GetComandasFinalizadas();
                        foreach($results as $result){
                            $dados = CaixaController::GetPrecoComanda($result[0]);
                            $preco;
                            foreach ($dados as $dado){
                                $preco = $dado[0];
                            }
                            echo '<div id="consultaCampos'.$result[0].'" class="consultaCampos pagination-data deixarInvisivel">
                            <div class="fotoConsulta">
                                <img src="'.BaseUrl::getBaseUrl().'/View/Contents/img/comanda.png">
                            </div>
                            <div class="dadosConsulta">
                                <div class="btnAcessar">
                                    <a href="caixa/'.$result[0].'" id="btnAcessarPerfil'.$result[0].'" class="btnCarrinho btnAcessarPerfil"><i style="margin: 0 5px 0 0;" class="fa fa-arrow-right fa-lg fa-fw"></i>Acessar</a>
                                </div>
                                <h1>R$ '.$preco.'</h1>
                                <h2>'.$result[2].'</h2>
                                <div class="dadosConsultaExtra">
                                <h3><span>Horário: </span>'.$result[3].'</h3>
                                <h3 style="height: 100%;"><span>Funcionário: </span>'.$result[1].'</h3>
                            </div>
                            </div>
                        </div>';
                        }
                        ?>
                        <div class="sem-consulta deixarInvisivel">
                            <h1>Nenhuma comanda foi encontrada.</h1>
                        </div>
                        
                    
                </div>
            </div>
        </div>   
    </div>
    <div class="container">
    <div class="pagination"></div>

    </div>


    
    <script type="text/javascript" src="<?php echo BaseUrl::getBaseUrl();?>/js/pagination.js"></script>
    <script>
        $(document).ready(function(){
            var quantidadeComandas = 0;
            $('.consultaCampos').map(function(){
                quantidadeComandas = parseInt(quantidadeComandas) + 1;
            })
            if (quantidadeComandas == 0){
                $('.sem-consulta').removeClass('deixarInvisivel');
                $('.pagination').css('display', 'none');
                $('.pagination-select').css('display', 'none');
            } 
        });

        $(document).on('click', '.consultaCampos', function(){
            var id = this.id.split('consultaCampos')[1];
            window.location.href = "caixa/" + id;
        });

    </script>
</body>
</html>