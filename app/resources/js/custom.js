jQuery.noConflict();

jQuery(function ($){
    //Disable button after clicking it to avoid multiple requests
   disableButtonAfterSubmit($)
    //Inititate smoothscrolling to invalid input with expanding collapsed form it form in it
   searchAlerts($);
    //WYSIWYG Adjustments
   tinymceInit()
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

function tinymceInit() {
    tinymce.init({
        selector: '#treatment, #visit_info',
        language: 'ru',
        plugins:
            'autolink ' +
            'link ' +
            'lists ' +
            'visualblocks ' +
            'casechange ' +
            'formatpainter ' +
            'linkchecker ' +
            'permanentpen ' +
            'powerpaste ' +
            'table ' +
//            'codesample ' +
//            'autocorrect ' +
//            'charmap ' +
//            'a11ychecker ' +
//            'tinymcespellchecker ' +
//            'export ' +
//            'wordcount ' +
//           'checklist ' +
//           'mediaembed ' +
//           'pageembed ' +
//           'typography ' +
//           'advtable ' +
//            'advcode ' +
//            'editimage ' +
//            'tableofcontents ' +
//           'footnotes ' +
//           'mergetags ' +
//            'emoticons ' +
//            'image ' +
//            'media ' +
//            'searchreplace ' +
//            'anchor ' +
            'inlinecss',
        toolbar:
            'undo redo ' +
            '| align lineheight ' +
            '| checklist numlist bullist indent outdent ' +
            '| bold italic underline strikethrough ' +
            '| link table ' +
            '| blocks fontfamily fontsize ' +
            '| removeformat',
//            + '| spellcheckdialog a11ycheck typography '
//            + '| addcomment showcomments '
//            + '| emoticons charmap '
        font_size_formats: '8px 10px 12px 14px 16px 18px 24px',
        menubar:
//            'file ' +
            'format'
    });
}
