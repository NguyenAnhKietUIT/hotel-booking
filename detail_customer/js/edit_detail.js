const information = document.querySelectorAll('.form-control')
const btnEditDetails = document.querySelector('.form-edit')
const btnAccept = document.querySelector('.btn-accept')

btnEditDetails.addEventListener('click', (e) => {
    e.preventDefault()
    btnEditDetails.style.display = 'none'
    btnAccept.style.display = 'block'

    information.forEach(element => {
        element.disabled = false;
    })
})

btnAccept.addEventListener('click', (e) => {
    e.preventDefault()
    
    let name = document.getElementById('yourname')
    let email = document.getElementById('email')
    let country = document.getElementById('country')
    let phone = document.getElementById('phonenumber')

    name.value = name.value
    email.value = email.value
    country.value = country.value
    phone.value = phone.value

    information.forEach(element => {
        element.disabled = true;
    })

    btnEditDetails.style.display = 'block'
    btnAccept.style.display = 'none'
})