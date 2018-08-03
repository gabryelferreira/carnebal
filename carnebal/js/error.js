var timeOut;
var tempoTimeout = 4000;
var field = ".validate";
var errorDiv = ".erroDiv";
var errorName = ".erroTexto";


//funcao para tornar erros invisiveis
function tornarErrosInvisiveis(){
    $(errorName).addClass('deixarInvisivel');
}

//funcao para cancelar o timeout de deixar os erros invisíveis
function cancelTimeOut() {
    clearTimeout(timeOut);
}

function validate(){
    cancelTimeOut();
    tornarErrosInvisiveis();
    var count = 0;
    var ok = 0;
    $(field).each(function(){
        count = parseInt(count) + 1;
        console.log(this.id);
        console.log($(this).val().trim());
        if ($(this).val().trim() == ""){
            $('.' + this.id + 'ErroVazio').removeClass('deixarInvisivel');
            
            timeOut = setTimeout(tornarErrosInvisiveis, tempoTimeout);
            return false;
        } else {
            ok = parseInt(ok) + 1;
        }
    })
    
    if (count == ok){
        return true;
    } else {
        return false;
    }
}

function showEmptyError(){
    cancelTimeOut();
}


