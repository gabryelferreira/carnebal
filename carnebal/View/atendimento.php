<?php

include('Layouts/head.php');
include('Layouts/headercaixa.php');

?>
<body id="this-is-body-default">
    <div class="this-is-atendimento marginHeader configPadrao">
        
        <div class="container">
            
            <div class="allCaixa">
                <div class="search-comanda deixarInvisivel">
                    <div class="search-das-comandas inputWithImg">
                        <input type="search" id="searchBoxComanda" placeholder="Procurar comanda">
                        <i class="fa fa-search fa-lg fa-fw"></i>
                    </div>
                </div>
                <div class="opcaoCaixa">
                    <h1>Olá, <?php echo $_SESSION['nomeFuncionario']?>!</h1>
                    <h3>
                        Aqui é onde você irá encerrar as comandas dos clientes
                        e registrar os pagamentos.
                    </h3>
                    <input type="button" id="verComandas" value="Comandas abertas">

                </div>





            </div>
        </div>
    </div>
    <script>

        $('#verComandas').on('click', function(){
            window.location.href = "comandas";
        })
        
    </script>