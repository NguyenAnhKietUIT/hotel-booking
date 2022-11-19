const mainContent = document.querySelector('.app__content .col.l-9')
const options = document.querySelectorAll('.app__sidebar-item')

options.forEach(element => {
    element.addEventListener('click', () => {
        options.forEach(element => {
            element.classList.remove('app__sidebar-item--active')
        })

        element.classList.add('app__sidebar-item--active')

        if (element.innerHTML === 'Your Account') {
           document.location.reload()
        }
    })
})