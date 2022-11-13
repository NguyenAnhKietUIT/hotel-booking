const heart = document.querySelectorAll('.home-location-item__favourite')
const heartActive = document.querySelectorAll('.home-location-item__favourite--active')

heart.forEach(element => {
    element.addEventListener('click', (e) => {
        e.preventDefault()

        element.style.zIndex = -1

        element.parentElement.querySelector('.home-location-item__favourite--active').style.zIndex = 1
    })
})

heartActive.forEach(element => {
    element.addEventListener('click', (e) => {
        e.preventDefault()

        element.style.zIndex = -1

        element.parentElement.querySelector('.home-location-item__favourite').style.zIndex = 1
    })
})