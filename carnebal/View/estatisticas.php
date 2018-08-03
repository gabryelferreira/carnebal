<?php



include("Layouts/head.php");
include("Layouts/header.php");

?>
<body id="this-is-body-default">
    <div class="this-is-estatisticas marginHeader">
        <div class="estatisticas-first">
            <h1 id="tituloData"><span>Todo o período</span></h1>
            <input type="button" id="btnAlterarData" value="Alterar data">
        </div>
        
        
    <div class="popupConfirmar popupAll deixarInvisivel">

        <div class="popupInside">
            <div class="popupTitle">

                <h1 class="RobotoC">Carnebal Info</h1>
                <input type="button" class="fecharPopup" value="X">
            </div>
            <div class="popupMessage">
                <h1>Selecione abaixo o mês para consulta:</h1>
                <select class="selectPopup">
                </select>
                <div class="btnsPopup">

                    <input type="button" class="btnConfirmarPopup backImageGreen colorWhite" value="Confirmar">
                    <input type="button" class="btnCancelarPopup transparent colorGray" value="Cancelar">
                </div>
            </div>

        </div>

    </div>
        
        
        
        
        <div class="graficos">
            <div id="donutchart" style="width: 900px; height: 500px; margin: auto; border-bottom: 1px solid #dddfe2;  box-shadow: 0 4px 4px #777;"></div>
            <div id="chart_div" style="width: 900px; height: 500px; margin: auto; border: 1px solid #dddfe2; box-shadow: 0 4px 4px #777;"></div> 
        </div>
        
        
        <script type="text/javascript" src="js/baseurl.js"></script>
        <script>
        </script>
        <script>
            var produtos;
            var qtdProdutos;
            var soma = 0;
            var mes = 9999;
            var ano = 9999;
            var count = 0, count2 = 0;
            var diaDaSemana = 4;
            var diasDaSemana = ['Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado', 'Domingo'];
            var coresSemana = ['color: #3498db', 'color: #2ecc71', 'color: #f1c40f', 'color: #e67e22', 'color: #e74c3c', 'color: #34495e', 'color: #1abc9c'];
            var acessosSemana = [];
            getProdutosMaisVendidos(9999, 9999);
            getMesesVendas();
            for (i = 0; i < diasDaSemana.length; i++){
                
                getAcessosComanda(mes, ano, i);
            }
            
            function getProdutosMaisVendidos(mes, ano){
                $.ajax({
                    url: baseUrl + '/getprodutos',
                    type: "post",
                    async: false,
                    data: {
                        mes: mes,
                        ano: ano
                    },
                    success: function(jsonData){
                        produtos = JSON.parse(jsonData);
                        getQuantidadeProdutosVendidos(mes, ano);
                    }
                });
            }
            
            function getQuantidadeProdutosVendidos(mes, ano){
                $.ajax({
                    url: baseUrl + '/getqtdprodutos',
                    type: 'post',
                    async: false,
                    data: {
                        mes: mes,
                        ano: ano
                    },
                    success: function(jsonData){
                        qtdProdutos = JSON.parse(jsonData);
                        if (count != 0){
                            drawChart();
                        }
                        count = 1;
                    }
                });
            }
            
            function getMesesVendas(){
                $.ajax({
                    url: baseUrl + '/getmesesvendas',
                    type: 'JSON',
                    async: false,
                    success: function(jsonData){
                        meses = JSON.parse(jsonData);
                        $('.selectPopup').append('<option value="9999-9999">Todo o período</option>');
                        for (x in meses){
                            var mes = meses[x];
                            mes[0] = mes[0].split('-');
                            var mesPesquisa = mes[0][1];
                            mes[0][1] = arrumarMes(mes[0][1]);
                            $('.selectPopup').append('<option value="' + mesPesquisa + '-' + mes[0][2] + '">' + mes[0][1] + " " + mes[0][2] + '</option>');
                        }
                    }
                });
            }
            
            function getAcessosComanda(mes, ano, diaDaSemana){
                $.ajax({
                    url: baseUrl + '/getacessoscomanda',
                    type: 'post',
                    async: false,
                    data: {
                        mes: mes,
                        ano: ano,
                        diaDaSemana: diaDaSemana
                    },
                    success: function(jsonData){
                        if (acessosSemana.length >= 7){
                            acessosSemana = [JSON.parse(jsonData)];
                        } else {
                            acessosSemana.push(JSON.parse(jsonData));
                            if (acessosSemana.length == 7){
                                if (count2 == 1){
                                    drawVisualization();
                                } else {
                                    count2 = 1;
                                }
                            }
                        }
                        
                        
                    }
                });
            }
            
            
            function arrumarMes(mes){
                switch(mes){
                    case "01":
                        return "Janeiro";
                        break;
                    case "02":
                        return "Fevereiro";
                        break;
                    case "03":
                        return "Março";
                        break;
                    case "04":
                        return "Abril";
                        break;
                    case "05":
                        return "Maio";
                        break;
                    case "06":
                        return "Junho";
                        break;
                    case "07":
                        return "Julho";
                        break;
                    case "08":
                        return "Agosto";
                        break;
                    case "09":
                        return "Setembro";
                        break;
                    case "10":
                        return "Outubro";
                        break;
                    case "11":
                        return "Novembro";
                        break;
                    case "12":
                        return "Dezembro";
                        break;
                    default:
                        return ""
                }
            }
            
        </script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        
    <script type="text/javascript">
                

        
        $('#btnAlterarData').on('click', function(){
            $('.popupAll').removeClass('deixarInvisivel');
            $('.popupInside').addClass('fadeIn');
        });
        
        $('.fecharPopup').on('click', function(){
            $('.popupAll').addClass('deixarInvisivel');
        });
        
        $('.btnCancelarPopup').on('click', function(){
            $('.popupAll').addClass('deixarInvisivel');
        });
        
        $('.btnConfirmarPopup').on('click', function(){
            $('.popupAll').addClass('deixarInvisivel');
            var params = $('.selectPopup').val();
            params = params.split('-');
            mes = params[0];
            ano = params[1];
            getProdutosMaisVendidos(params[0], params[1]);
            for (i = 0; i < diasDaSemana.length; i++){
                
                getAcessosComanda(mes, ano, i);
            }
            if (params[0] == "9999"){
                $('#tituloData span').text("Todo o período");
            } else {
                var month = arrumarMes(params[0]);
                $('#tituloData span').text(month + " " + params[1]);
            }
            
        });
        
        
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
//          $.ajax({
//                url: '/carnebal/getprodutos',
//                type: 'JSON',
//                success: function(data){
//                    produtos = JSON.parse(data);
//                    
//
//                }
//            })
        var data = new google.visualization.DataTable();
		data.addColumn('string', 'Produto');
		data.addColumn('number', 'Vendas');
          soma = 0;
          for (x in produtos){
              soma = parseInt(soma) + parseInt(produtos[x][1]);
              data.addRow([produtos[x][0].toString(), parseInt(produtos[x][1])]);
          }
          
          if (qtdProdutos > soma){
              data.addRow(['Outros', parseInt(qtdProdutos) - parseInt(soma)]);
          }
          
        var options = {
            title: 'Produtos vendidos',
            titleTextStyle: {
                fontSize: 22,
            },
            pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
        
        
        
        
        
        google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);

    function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Dia');
        data.addColumn('number', 'Acessos');
        data.addColumn({type: 'string', role: 'style'});
        
        var somaDias = 0;
        for (i = 0; i < diasDaSemana.length; i++){
            somaDias = parseInt(somaDias) + parseInt(acessosSemana[i]);
            data.addRow([diasDaSemana[i], parseInt(acessosSemana[i]), coresSemana[i]]);
        }
         

    var options = {
        title : 'Acessos no período',
        titleTextStyle: {
            fontSize: 22,
        },
        vAxis: {title: 'Acessos'},
        hAxis: {title: 'Dias da semana'},
        seriesType: 'bars',
        series: {5: {type: 'line'}}
    };

    var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
    chart.draw(data, options);
  }
        
        
        
    </script>
        
        
        
        
    </div>
</body>
</html>