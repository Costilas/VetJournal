jQuery.noConflict();

jQuery(function ($){
   disableButtonAfterSubmit($)
   searchAlerts($);
});

function searchAlerts($) {
    if($('.alert')){
        let areaToExpand = $('input.is-invalid').parents('.collapse');
        let id = areaToExpand.attr('id');
        areaToExpand.toggleClass('show')

        let scrollObject = document.querySelector('#' + id);
        if(scrollObject) {
            scrollObject.scrollIntoView({behavior: "smooth"});
        }
    }
}

function disableButtonAfterSubmit($) {
    $('form').submit(function (){
        $('[type="submit"]').attr("disabled", true)
    })
}
