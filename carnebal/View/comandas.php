<?php

include('Layouts/head.php');
include('Layouts/headercaixa.php');

?>
<body id="this-is-body-default">
    <div class="this-is-atendimento marginHeader configPadrao">
        
        <div class="container">
            
            <div class="allCaixa todas-comandas">
                
                <div class="search-comanda">
                    <div class="search-das-comandas inputWithImg">
                        <input type="search" id="searchBoxComanda" placeholder="Procurar comanda">
                        <i class="fa fa-search fa-lg fa-fw"></i>
                    </div>
                </div>



                <div class="comandas-abertas">
                    <?php 
                    $results = ComandasController::GetComandasAbertas();
                    foreach ($results as $result){
                        $dados = ComandasController::GetPrecoComanda($result[0]);
                        $preco;
                        foreach ($dados as $dado){
                            $preco = $dado[0];
                        }
                        echo '<div id="'.$result[1].'" class="comanda-aberta">
                        <img src="'.BaseUrl::getBaseUrl().'/View/Contents/img/comanda.png">
                        <div class="dados-comanda-aberta">
                            <h1>Número da comanda: '.$result[1].'</h1>
                            <h2>R$ '.$preco.'</h2>
                        </div>
                        <a id="fechar'.$result[0].'" class="btnCarrinho btnFecharComanda"><i style="margin: 0 5px 0 0; color: #fff;" class="fa fa-shopping-cart fa-lg fa-fw"></i>Fechar</a>
                    </div>';
                    }
                    ?>
                    <div class="sem-comandas deixarInvisivel">
                        <h1>Nenhuma comanda foi encontrada.</h1>
                    </div>
                </div>
                


            </div>
        </div>
    </div>
    <script type="text/javascript" src="js/baseurl.js"></script>
    <script>
        $(document).ready(function(){
            var quantidadeComandas = 0;

            $('.comanda-aberta').map(function(){
                quantidadeComandas = parseInt(quantidadeComandas) + 1;
            })

            var todasComandas = [];
            
            function mapComandas(){
                quantidadeComandas = 0;
                for (x in todasComandas){
                    quantidadeComandas = parseInt(quantidadeComandas) + 1;
                    var comanda = todasComandas[x];
                    var html = '<div id="' + comanda['numero'] + '" class="comanda-aberta"><img src="' + baseUrl + '/View/Contents/img/comanda.png"><div class="dados-comanda-aberta"><h1>Número da comanda: ' + comanda['numero'] + '</h1><h2>R$ ' + comanda['preco'] + '</h2></div><a id="fechar' + comanda['id'] + '" class="btnCarrinho btnFecharComanda"><i style="margin: 0 5px 0 0; color: #fff;" class="fa fa-shopping-cart fa-lg fa-fw"></i>Fechar</a></div>';
                    if (x == 0){
                        $('.comandas-abertas').html(html);
                    } else {
                        $('.comandas-abertas').append(html);

                    }
                }
                contarComandas();
            }

            contarComandas();
            function contarComandas(){
                if (quantidadeComandas == 0){
                    $('.sem-comandas').removeClass('deixarInvisivel');
                } else {
                    $('.sem-comandas').addClass('deixarInvisivel');
                }

            }

            $('#searchBoxComanda').on('keyup', function(){
                var valor = $(this).val();
                quantidadeComandas = 0;
                $('.comanda-aberta').map(function(){
                    if (this.id.indexOf(valor.trim()) <= -1){
                        $(this).css('display', 'none');
                    } else {
                        quantidadeComandas = parseInt(quantidadeComandas) + 1;
                        $(this).css('display', 'block');
                        if (parseInt(quantidadeComandas) % 2 == 1){
                            $(this).css('background', '#eee');
                        } else {
                            $(this).css('background', '#fff');
                        }
                    }
                });
                contarComandas();
                
                
            });



            $(document).on('click', '.btnFecharComanda', function(){
                var id = $(this).attr('id').split('fechar')[1];
                window.location.href = 'comandas/' + id;
            })



        })

    </script>