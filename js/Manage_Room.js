const roomId = document.getElementById('room-id');
const roomName = document.getElementById('room-name');
const typeRoom = document.getElementById('type-room');
const bedNum = document.getElementById('bed-num');
const price = document.getElementById('price');
const imageRoom = document.getElementById('img-room');
const buttonUpdate = document.querySelectorAll('.btn.btn-info');

buttonUpdate.forEach(element => {
    element.addEventListener('click', () => {
        let array = element.parentElement.parentElement.getElementsByTagName("td");

        roomId.value = array[0].textContent;
        roomName.value = array[1].textContent;
        typeRoom.value = array[2].textContent;
        bedNum.value = array[3].textContent;
        price.value = parseInt(array[4].textContent);
        document.getElementById('image').removeAttribute("required")
        imageRoom.src = array[5].getElementsByTagName("img")[0].currentSrc;
        imageRoom.removeAttribute("hidden");
        imageRoom.style.display = "block";
        imageRoom.style.width = "300px";
        imageRoom.style.height = "200px";
    })
});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
  
        reader.onload = function (e) {
            $('#img-room').removeAttr("hidden")
            $('#img-room').attr("style", "display: block");
            $('#img-room').attr('src', e.target.result).width(300).height(200);
        };

        reader.readAsDataURL(input.files[0]);
    }
}