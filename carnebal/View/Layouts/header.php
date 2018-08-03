<?php

session_start();

if (!isset($_SESSION['cdFuncionario'])){
    header("Location: ".BaseUrl::getBaseUrl());
}

if ((isset($_SESSION['primeiroAcesso'])) && ($_SESSION['primeiroAcesso'] == "1")){
    header("Location: ".BaseUrl::getBaseUrl()."/perfil/editar-senha?info=acesso");
}

if ((isset($_SESSION['cargo'])) && ($_SESSION['cargo'] == "C")){
    header("Location: ".BaseUrl::getBaseUrl());
}

?>
<header>
    <div class="wrapper">
        <div class="menuResponsiveIcon">
            <div class="hamburguerIcon">
            </div>
        </div>
        <div class="title">
            <img src="<?php echo BaseUrl::getBaseUrl();?>/View/Contents/img/icon.png">
            <h1>Carnebal</h1>
        </div>
    </div>   
        
</header>


<nav id="menuResponsive" class="menuResponsive">
    <ul>
        <a href="<?php echo BaseUrl::getBaseUrl();?>/principal"><li><img src="<?php echo $_SESSION['foto'];?>">Bem vindo(a), <?php echo $_SESSION['nomeFuncionario'];?>!</li></a>
        <a href="<?php echo BaseUrl::getBaseUrl();?>/perfil/editar-perfil"><li><img style="filter: invert(100%);" src="<?php echo BaseUrl::getBaseUrl();?>/View/Contents/img/perfil.png">Meu perfil</li></a>
        <a href="<?php echo BaseUrl::getBaseUrl();?>/estatisticas"><li><img src="<?php echo BaseUrl::getBaseUrl();?>/View/Contents/img/charts.png">Estatísticas</li></a>
        <a href="<?php echo BaseUrl::getBaseUrl();?>/funcionarios"><li><img src="<?php echo BaseUrl::getBaseUrl();?>/View/Contents/img/employee.png">Funcionários</li></a>
        <a href="<?php echo BaseUrl::getBaseUrl();?>/produtos"><li><img src="<?php echo BaseUrl::getBaseUrl();?>/View/Contents/img/hamburguericon.png">Produtos</li></a>
        <a href="<?php echo BaseUrl::getBaseUrl();?>/caixa"><li><img src="<?php echo BaseUrl::getBaseUrl();?>/View/Contents/img/money.png">Caixa</li></a>
        <a href="<?php echo BaseUrl::getBaseUrl();?>/fazerlogout"><li>Sair</li></a>
    </ul>
</nav>
<script>
    var height = 0;
    var ativo = false;
    var heightSalvo = 0;
    var width = 0;
    var widthSalvo = 0;
    var id;
    
    function myMove() {
        clearInterval(id);
      var elem = document.getElementById("menuResponsive");
        var height = $('#menuResponsive').height();
        var heightTeste = $('#menuResponsive').css('height');
        if (heightSalvo == 0){
            heightSalvo = height;
        }
        if (ativo == true){
            if (height == heightSalvo){
                var pos = 0;
                elem.style.height = "0px";
            } else {
                var pos = height;
            }
            
            elem.style.display = "block";
            id = setInterval(frame, 1);
            function frame() {
                if (pos >= heightSalvo) {
                  clearInterval(id);
                } else {
                  pos = parseInt(pos) + 3; 
                  elem.style.height = pos + 'px'; 
                }
              }
        } else {
            var pos = height;
            id = setInterval(frame2, 1);
            function frame2() {
                if (pos <= 0) {
                    elem.style.display = "none";
                  clearInterval(id);
                } else {
                  pos = parseInt(pos) - 3; 
                  elem.style.height = pos + 'px'; 
                }
              }
        }
    }
    
    function slideLeftToRight(id) {
        clearInterval(id);
        var idThis = id.split('#')[1];
      var elem = document.getElementById(idThis);
        var width = $(id).width();
        if (widthSalvo == 0){
            widthSalvo = width;
        }
        
        if (ativo == true){
            if (width == widthSalvo){
                elem.style.width = 0;
                var pos = 0;
            } else {
                var pos = width;
            }
            elem.style.display = "block";
            id = setInterval(slideOpen, 1);
            function slideOpen() {
                if (pos >= widthSalvo) {
                  clearInterval(id);
                } else {
                  pos = parseInt(pos) + 3; 
                  elem.style.width = pos + 'px'; 
                }
              }
        } else {
            var pos = width;
            id = setInterval(slideClose, 1);
            function slideClose() {
                if (pos <= 0) {
                    elem.style.display = "none";
                    elem.style.width = 0;
                  clearInterval(id);
                } else {
                  pos = parseInt(pos) - 3; 
                  elem.style.width = pos + 'px'; 
                }
              }
        }
    }
    
    
    
    
    function fecharMenu(){
        var elem = document.getElementById("menuResponsive");
        var width = $('#menuResponsive').width();
        var pos = width;
            id = setInterval(frame5, 1);
            function frame5() {
                if (pos <= 0) {
                    elem.style.display = "none";
                  clearInterval(id);
                } else {
                  pos = parseInt(pos) - 1; 
                  elem.style.width = pos + '%'; 
                }
              }
    }
    
    $(document).ready(function(){
        $('.menuResponsiveIcon').on('click', function(){
            $('.menuResponsiveIcon').toggleClass('menuAtivo');
            ativo = !ativo;
            $('#menuResponsive').toggleClass('toggleMenu');
            
        })
            
    })
</script>