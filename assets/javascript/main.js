var Main = {
    init: function() {
        this.doEnableTynimce();
        this.initDatePicker();
    },
    
    doEnableTynimce: function() {
        jQuery('.js-enable-tinymce').on('click', function () {
            if (jQuery(this).is(':checked')) {
                tinymce.init({ selector:'.js-tinymce' });
            } else {
                tinymce.remove(".js-tinymce");
            }
        });
    },
    
    doClearFields: function() {
        //jQuery('.js-futuremail-form input, textarea, select').val('');
    },
    
    initDatePicker: function() {
        jQuery('#date').datepicker({
            dateFormat: "yy-mm-dd"
        });
    }
}

jQuery(document).ready(function($){
    Main.init();
});