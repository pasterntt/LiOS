$( document ).ready(function() {

    $('#mark-all').click(function(){
        $.ajax(PageUrl+'ajax/mark-read');
        $('.notification').hide();
        $('#notification-counter').hide();
        setTimeout(function() {
            toastr.options = {
                closeButton: true,
                progressBar: true,
                showMethod: 'fadeIn',
                hideMethod: 'fadeOut',
                timeOut: 5000
            };
            toastr.success('Notifications cleared successfully!', 'Notifications cleared!');
        }, 1800);
    });
    $('.add-to-cart').click(function(){
        event.preventDefault();
        alert($(this).data('id'));
    });

    $('select').select2();
});