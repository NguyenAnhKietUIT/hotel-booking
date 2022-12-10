const information = document.querySelectorAll('.form-control.edit-active')
const buttonEdit = document.querySelector('.button-handle button')
const buttonAccept = document.querySelector('.button-handle input[type="submit"]')
const avatarImg = document.querySelector('.app__main-img')
const avatarInput = document.getElementById('app__main-input-img')

buttonEdit.addEventListener('click', (e) => {
    buttonEdit.disabled = true;
    buttonAccept.disabled = false;
    avatarInput.disabled = false;
    information.forEach(element => {
        element.disabled = false;
    })
})

avatarInput.addEventListener('change', (event) => {
    avatarImg.src = URL.createObjectURL(event.target.files[0]);
})