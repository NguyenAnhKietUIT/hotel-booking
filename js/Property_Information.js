const information = document.querySelectorAll('.edit-active');
const buttonUpdate = document.querySelector('button[type="button"]');
const buttonSave = document.querySelector('input[type="submit"]');

buttonUpdate.addEventListener('click', () =>{
    information.forEach(element => {
        console.log(element)
        element.disabled = false;
    })

    buttonUpdate.disabled = true;
    buttonSave.disabled = false;
});

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