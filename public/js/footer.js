$(function(){
    /**Mascaras */
    $('.mask-cpf').mask('000.000.000-00');
    //mascar money de milhoes
    $('.mask-money').mask('000.000.000,00', {reverse:true});
    //celular
    $('.mask-celular').mask('(00) 00000-0000');
    /** Fim mascaras */

    //livewire globals
    Livewire.on('showToast',(msg_toast) => {
        showToast(msg_toast.title, msg_toast.information, msg_toast.type, msg_toast.time);
    });

    Livewire.on('showAlert',(msg) => {
        showAlert(msg.title, msg.information, msg.type);
    });

    Livewire.on('openGetRouteNewTab',(route) => {
        window.open(route);
    });

    Livewire.on('openModal',(id) => {
        $('#'+id).modal('show');
    });

    Livewire.on('closeModal',(id) => {
        $('#'+id).modal('hide');
    });


});
