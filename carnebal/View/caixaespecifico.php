<?php

include('Layouts/head.php');
include('Layouts/header.php');

?>
<body id="this-is-body-default">
    <form class="this-is-atendimento marginHeader configPadrao" action="finalizarcomanda" method="POST">
        
        <div class="container">
            
            <div class="allCaixa comanda-especifica">

                <div style="width: 100%;" class="comanda-especifica-direita">
                    <div class="comanda-especifica-titulo">
                        <div class="comanda-especifica-search inputWithImg">
                            <input type="search" name="searchProdutoComanda" id="searchProdutoComanda" placeholder="Procurar produto">
                            <i class="fa fa-search fa-lg fa-fw"></i>
                        </div>
                    </div>
                    <div class="comanda-especifica-produtos">
                        <div class="comanda-especifica-produtos-header">
                            <div class="width10">
                                <h1>Foto</h1>
                            </div>
                            <div class="width30">
                                <h1>Produto</h1>
                            </div>
                            <div class="width20">
                                <h1>Preço Unitário</h1>
                            </div>
                            <div class="width15">
                                <h1>Quantidade</h1>
                            </div>
                            <div class="width25">
                                <h1>Preço Total</h1>
                            </div>
                        </div>
                        <?php
                            $id = explode('/', $_SERVER['REQUEST_URI']);
                            echo '<input type="text" name="cdComanda" id="cdComanda" class="deixarInvisivel" value="'.end($id).'">';
                            $dadosComanda = CaixaEspecificoController::GetComanda(end($id));
                            $soma = 0;
                            foreach ($dadosComanda as $dadoComanda){
                                echo '<div class="comanda-especifica-produtos-produto">
                                <div class="width10">
                                    <img src="'.$dadoComanda[0].'">
                                </div>
                                <div class="width30">
                                    <h1>'.$dadoComanda[1].'</h1>
                                </div>
                                
                                <div class="width20">
                                    <h1>R$ '.$dadoComanda[2].'</h1>
                                </div>
                                <div class="width15">
                                    <h1>'.$dadoComanda[3].'</h1>
                                </div>
                                <div class="width25">
                                    <h1>R$ '.(float)$dadoComanda[2] * (float)$dadoComanda[3].'</h1>
                                </div>
                            </div>';
                            $soma = (float)$soma + ((float)$dadoComanda[2] * (float)$dadoComanda[3]);
                            }
                            echo '</div>';
                            echo '<div class="comanda-especifica-preco">
                                    <div class="width75">
                                        <h1>Total:</h1>
                                    </div>
                                    <div style="text-align: right;" class="width25">
                                        <h1 class="valorTotal" id="'.$soma.'">R$ '.$soma.'</h1>
                                    </div>
                                </div>';
                        ?>

                        
                        
                    
                </div>
            </div>
        </div>

        <div class="popupConfirmar popupAll deixarInvisivel">

            <div class="popupInside">
                <div class="popupTitle">

                    <h1 class="RobotoC">Confirmação</h1>
                    <input type="button" class="fecharPopup" value="X">
                </div>
                <div class="popupMessage">
                    <h1>Tem certeza que deseja finalizar a comanda?</h1>
                    <div class="btnsPopup">
                        <input type="submit" class="btnConfirmarPopup backImageGreen colorWhite" value="Confirmar">
                        <input type="button" class="btnCancelarPopup transparent colorGray" value="Cancelar">
                    </div>
                </div>

            </div>

        </div>


    </form>
    <script>

        $(document).ready(function(){


            $('#valorTroco').val(parseFloat($('.valorTotal').attr('id')) * (-1));
            var disabled = true;
            verificarTroco();
            

            function verificarTroco(){
                if ($('#valorTroco').val() >= 0){
                    $('.btnFinalizarComanda').css('cursor', 'pointer');
                    disabled = false;
                } else {
                    $('.btnFinalizarComanda').css('cursor', 'not-allowed');
                    disabled = true;
                }
            }


            $('#searchProdutoComanda').on('keyup', function(){
                var valor = $(this).val();
                var quantidadeProdutos = 0;
                $('.comanda-especifica-produtos-produto').map(function(){
                    if ($(this).text().toLowerCase().indexOf(valor.toLowerCase().trim()) <= -1){
                        $(this).css('display', 'none');
                    } else {
                        quantidadeProdutos = parseInt(quantidadeProdutos) + 1;
                        $(this).css('display', 'flex');
                        if (parseInt(quantidadeProdutos) % 2 == 1){
                            $(this).css('background', '#eee');
                        } else {
                            $(this).css('background', '#fff');
                        }
                    }
                });
                
                
            });

            $('.btnVoltarComanda').on('click', function(){
                window.location.href = "../comandas";
            })


            $('#valorPago').on('keyup', function(){
                var valorTotal = parseFloat($('.valorTotal').attr('id'));
                var valorPago = parseFloat($(this).val());
                var valorTroco = (valorPago - valorTotal).toFixed(2);
                valorTroco == 'NaN' ? valorTroco = parseFloat(valorTotal) * (-1) : valorTroco = valorTroco;
                $('#valorTroco').val(valorTroco);
                verificarTroco();
            })

            $('.btnFinalizarComanda').on('click', function(){
                if (disabled == false){
                    $('.popupConfirmar').removeClass('deixarInvisivel');
                    $('.popupInside').addClass('fadeIn');
                }
                
            })


            $('.btnConfirmarPopup').on('click', function(){
                $('.popupConfirmar').removeClass('deixarInvisivel');
                $('.popupInside').addClass('fadeIn');
            })

            $('.btnCancelarPopup').on('click', function(){
                $('.popupConfirmar').addClass('deixarInvisivel');
            })

        })

    </script>