/****************************************FUNÇÕES********************************************************/
function showToast(title,information, type_number, time){
    type = ['success','info','warning','error'];
    $.toast({
        heading: title,
        text: information,
        icon: type[type_number],
        loader: true,        // Change it to false to disable loader
        loaderBg: '#d63384',  // To change the background
        showHideTransition: 'slide',
        hideAfter: time, //toast some ao exibir msg, false fica ate usuario clicar
        position: 'top-center'

    })
}

/**
 * [Description for showQuestion]
 *
 * @return [type]
 *
 */
function showQuestionYesNo(title,question_data, callback,color='dark'){
    $.confirm({
        title: title,
        content: question_data,
        type: color,
        typeAnimated: true,
        buttons: {
            Sim: {
                text: 'SIM',
                btnClass: 'btn-'+color,
                action: callback
            },
            Nao: {
                text: 'NÃO',
                action: function(){

                }
            },
        }
    });
}

function moneyMaskValue(value, cifrao = false) {

    if(cifrao){
        var retorno = value.toLocaleString('pt-br', {style: 'currency', currency: 'BRL'});
    }else{
        var retorno = value.toLocaleString('pt-br', {minimumFractionDigits: 2});
    }
    return retorno;
}

function moneyMask(campo) {
    let value = campo.value;
    value = value.replace('.', '').replace(',', '').replace(/\D/g, '')

    const options = { minimumFractionDigits: 2 }
    const result = new Intl.NumberFormat('pt-BR', options).format(
        parseFloat(value) / 100
    )
    if(!campo.value){
        campo.value = "";
    }else{
        campo.value = result;
    }
}

function soletras(campo) {
    campo.value = campo.value.replace(/[^a-zA-Z ]/g,'');
}

function moneyRule(campo) {
    campo.value = campo.value.replace(/[^0-9 .,]/g,'');
}

function moneyRulePhp(campo) {
    campo.value = campo.value.replace(/[^0-9 .]/g,'');
}

/*****************************************FULLSCREEN*******************************************/
function GoInFullscreen() {
    var element = document.documentElement;
    if(element.requestFullscreen)
        element.requestFullscreen();
    else if(element.mozRequestFullScreen)
        element.mozRequestFullScreen();
    else if(element.webkitRequestFullscreen)
        element.webkitRequestFullscreen();
    else if(element.msRequestFullscreen)
        element.msRequestFullscreen();
}

/* Get out of full screen */
function GoOutFullscreen() {
    if(document.exitFullscreen)
        document.exitFullscreen();
    else if(document.mozCancelFullScreen)
        document.mozCancelFullScreen();
    else if(document.webkitExitFullscreen)
        document.webkitExitFullscreen();
    else if(document.msExitFullscreen)
        document.msExitFullscreen();
}

/* Is currently in full screen or not */
function IsFullScreenCurrently() {
    var full_screen_element = document.fullscreenElement || document.webkitFullscreenElement || document.mozFullScreenElement || document.msFullscreenElement || null;

    // If no element is in full-screen
    if(full_screen_element === null)
        return false;
    else
        return true;
}

function toogleFullScreen(){
    if(IsFullScreenCurrently()){
        GoOutFullscreen();
    }else{
        GoInFullscreen();
    }
}

/** Cronometro */
cronometro = {
    hora:0,
    minuto: 0,
    segundo:0,
    milesegundo:0,
}

let cron;

function returnData(input) {
    return input >= 10 ? input : `0${input}`
}

function timer(hora_id,minute_id,second_id, mlsecond_id) {
    if ((cronometro.milesegundo += 10) == 1000) {
      cronometro.milesegundo = 0;
      cronometro.segundo++;
    }
    if (cronometro.segundo == 60) {
        cronometro.segundo = 0;
        cronometro.minuto++;
    }
    if (cronometro.minuto == 60) {
        cronometro.minuto = 0;
        cronometro.hora++;
    }
    document.getElementById(hora_id).innerText = returnData(cronometro.hora);
    document.getElementById(minute_id).innerText = returnData(cronometro.minuto);
    document.getElementById(second_id).innerText = returnData(cronometro.segundo);
    //document.getElementById(mlsecond_id).innerText = returnData(cronometro.milesegundo);
  }

  function start(hora_id,minute_id,second_id, mlsecond_id) {
    pause();
    cron = setInterval(() => { timer(hora_id,minute_id,second_id, mlsecond_id); }, 10);
  }

  function pause() {
    clearInterval(cron);
  }

  function reset(hora_id,minute_id,second_id, mlsecond_id) {
    cronometro.hora = 0;
    cronometro.minuto = 0;
    cronometro.segundo = 0;
    cronometro.milesegundo = 0;

    document.getElementById(hora_id).innerText = '00';
    document.getElementById(minute_id).innerText = '00';
    document.getElementById(second_id).innerText = '00';
    //document.getElementById(mlsecond_id).innerText = '000';
  }
  /****************Converter tabela em array */

  function tableToArray(id){
    const table = document.getElementById(id)
    const arr = [...table.rows].map(r => [...r.querySelectorAll('td, th')].map(td => td.textContent))
    return arr;
  }
