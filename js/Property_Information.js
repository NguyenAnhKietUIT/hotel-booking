function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
  
        reader.onload = function (e) {
            $('#img-property').removeAttr("hidden")
            $('#img-property').attr('src', e.target.result).width(400).height(300);
        };

        reader.readAsDataURL(input.files[0]);
    }
}