const information = document.querySelectorAll('.form-control.edit-active')
const buttonEdit = document.querySelector('.button-handle button')
const buttonAccept = document.querySelector('.button-handle input[type="submit"]')
const avatarImg = document.querySelector('.app__main-img')
const avatarInput = document.getElementById('app__main-input-img')
const options = document.querySelectorAll('.app__sidebar-item')

options.forEach(element => {
    element.addEventListener('click', () => {
        options.forEach(element => {
            element.classList.remove('app__sidebar-item--active')
        })
        element.classList.add('app__sidebar-item--active')
    })
})

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