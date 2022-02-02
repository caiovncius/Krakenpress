const provipay = {
    init: function () {
        console.log('Starting front...')
    },
    handle_masks: function() {
        jQuery('input#provipay_cpf').mask('000.000.000-00', {reverse: true});
    }
};

provipay.init();
