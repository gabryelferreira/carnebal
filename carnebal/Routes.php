<?php

Route::set('/', function(){
    LoginController::CreateView('login');
});
    
Route::set('index.php', function(){
    LoginController::CreateView('login');
});
    
Route::set('login', function(){
    LoginController::CreateView('login');
});

Route::set('api/getProducts.php', function(){
    APIController::getProducts();
});

$comandas = ComandasController::GetComandasAbertas();
foreach ($comandas as $comanda){
    $id = $comanda[0];
    Route::set('api/getProducts.php?id='.$id, function(){
        APIController::getProducts();
    });
};

Route::set('api/addItems.php', function(){
    APIController::addItems();
});

Route::set('api/closeComanda.php', function(){
    APIController::closeComanda();
});

Route::set('api/firstLogin.php', function(){
    APIController::firstLogin();
});

Route::set('api/getComandasAbertas.php', function(){
    APIController::getComandasAbertas();
});

Route::set('api/login.php', function(){
    APIController::login();
});

Route::set('api/newComanda.php', function(){
    APIController::newComanda();
});

Route::set('esqueci-senha', function(){
    EsqueciSenhaController::CreateView('esqueci-senha');
});

Route::set('gerarsenha', function(){
    EsqueciSenhaController::GerarSenha($_POST['usuario'], $_POST['email']);
});

Route::set('fazerlogin', function(){
    LoginController::FazerLogin();
});

Route::set('fazerlogout', function(){
    LoginController::FazerLogout();
});

Route::set('principal', function(){
    PrincipalController::CreateView('principal');
});

Route::set('estatisticas', function(){
    EstatisticasController::CreateView('estatisticas');
});

Route::set('funcionarios', function(){
    FuncionariosController::CreateView('funcionarios');
});

Route::set('funcionarios/verificarexistenciacargoecpf', function(){
    echo FuncionariosController::VerificarExistenciaCargoECPF($_POST['usuario']);
});

Route::set('funcionarios/alterarperfil', function(){
    FuncionarioEspecificoController::AlterarPerfil();
});


$funcionarios = FuncionariosController::GetFuncionarios();
foreach ($funcionarios as $funcionario){
    $id = $funcionario[0];
    Route::set('funcionarios/'.$id, function(){
        $id = explode('/', $_SERVER['REQUEST_URI']);
        $funcionario = FuncionariosController::GetFuncionario(end($id));
        FuncionarioEspecificoController::CreateView('funcionarioespecifico');
    });
};

Route::set('produtos', function(){
    ProdutosController::CreateView('produtos');
});

Route::set('produtos/alterarproduto', function(){
    ProdutoEspecificoController::AlterarProduto();
});

$produtos = ProdutosController::GetProdutos();
foreach ($produtos as $produto){
    $id = $produto[0];
    Route::set('produtos/'.$id, function(){
        $id = explode('/', $_SERVER['REQUEST_URI']);
        $produto = ProdutosController::GetProduto(end($id));
        ProdutoEspecificoController::CreateView('produtoespecifico');
    });
};



Route::set('caixa', function(){
    CaixaController::CreateView('caixa');
});

Route::set('atendimento', function(){
    AtendimentoController::CreateView('atendimento');
});

Route::set('comandas', function(){
    ComandasController::CreateView('comandas');
});

Route::set('comandas/getcomandasabertas', function(){
    echo json_encode(ComandasController::GetComandasAbertas());
});

$comandas = ComandasController::GetComandasAbertas();
foreach ($comandas as $comanda){
    $id = $comanda[0];
    Route::set('comandas/'.$id, function(){
        ComandaEspecificaController::CreateView('comandaespecifica');
    });
};

$comandas = CaixaController::GetComandasFinalizadas();
foreach ($comandas as $comanda){
    $id = $comanda[0];
    Route::set('caixa/'.$id, function(){
        CaixaEspecificoController::CreateView('caixaespecifico');
    });
};

Route::set('comandas/finalizarcomanda', function(){
    ComandaEspecificaController::FinalizarComanda();
});

Route::set('getprodutos', function(){
    $produto = new Produto;
    echo json_encode($produto->GetProdutosMaisVendidos($_POST['mes'], $_POST['ano']));
});

Route::set('getqtdprodutos', function(){
    $produto = new Produto;
    echo json_encode($produto->GetQuantidadeProdutosVendidos($_POST['mes'], $_POST['ano']));
});

Route::set('getmesesvendas', function(){
    $produto = new Produto;
    echo json_encode($produto->GetMesesVendas());
});


Route::set('getacessoscomanda', function(){
    $produto = new Produto;
    echo json_encode($produto->GetAcessosComanda($_POST['mes'], $_POST['ano'], $_POST['diaDaSemana']));
});


Route::set('cadastrarfuncionario', function(){
    FuncionariosController::CadastrarFuncionario();
});

Route::set('cadastrarlogin', function(){
   LoginController::CadastrarFuncionario(); 
});

Route::set('cadastrarproduto', function(){
    ProdutosController::CadastrarProduto();
});

Route::set('perfil/editar-perfil', function(){
    EditarPerfilController::CreateView('editarperfil');
});

Route::set('perfil/editar-foto', function(){
    EditarFotoController::CreateView('editarfoto');
});

Route::set('perfil/editar-senha', function(){
    EditarSenhaController::CreateView('editarsenha');
});

Route::set('perfil/alterarperfil', function(){
    EditarPerfilController::AlterarDados();
});

Route::set('perfil/alterarsenha', function(){
    EditarSenhaController::AlterarSenha($_POST['senha'], $_POST['senha1']);
});

Route::set('perfil/alterarfoto', function(){
    EditarFotoController::AlterarImagem($_FILES['file']);
});



Route::set('funcionarios/alterarfoto', function(){
    FuncionarioEspecificoController::AlterarFoto($_FILES['file']);
});


Route::set('produtos/alterarfoto', function(){
    ProdutoEspecificoController::AlterarFoto($_FILES['file']);
});