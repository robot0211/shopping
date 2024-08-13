$(function () {
    $('.checkbox_wrapper').on('click', function () {
        $(this).parents('.card_main').find('.checkbox_childrent').prop('checked', $(this).prop('checked'));
    });

    $('.checkall').on('click', function () {
        $(this).parents().find('.checkbox_childrent').prop('checked', $(this).prop('checked'));
    })
})

