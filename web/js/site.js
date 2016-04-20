$(document).ready(function(){
    checkNotificationCode($('#sendingnotifications-code').val());

});
$(document).on('change','#sendingnotifications-code' ,function(){
    checkNotificationCode($(this).val());
});
function checkNotificationCode(value) {
    if(value === 'posts') {
        $('#sendingnotifications-article_id').attr('disabled', 'disabled');
        $('.field-sendingnotifications-article_id').hide();
    } else {
        $('#sendingnotifications-article_id').prop('disabled', false);
        $('.field-sendingnotifications-article_id').show();
    }
}