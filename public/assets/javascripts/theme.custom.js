/* Add here all your JS customizations */

function readURL(input, id) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $(id).css('background-image', 'url('+e.target.result +')');
            $(id).hide();
            $(id).fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$(".imagem").change(function() {
    id = $(this).data('id');
    readURL(this, id);
});