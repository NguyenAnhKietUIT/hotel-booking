const homeContainer = document.querySelector('.app__content-home')
const homeNavigation = document.querySelector('.app__nav-item:first-child')

const categories = document.querySelectorAll('.app__category-item')
const beachContainer = document.querySelector('.app__content-beach')
const mountainContainer = document.querySelector('.app__content-mountain')
const iconicCityContainer = document.querySelector('.app__content-iconic-city')
const countrysideContainer = document.querySelector('.app__content-countryside')
const campingContainer = document.querySelector('.app__content-camping')
const tropicalContainer = document.querySelector('.app__content-tropical')

const header = document.querySelector('.app__header')
const footer = document.querySelector('.app__footer')

categories.forEach(element => {
    element.addEventListener('click', () => {
        homeContainer.style.display = 'none'

        if (element.childNodes[3].innerHTML === 'Beaches') {
            beachContainer.style.display = 'block'
            header.style.backgroundImage = "url('../assets/img/background/image_3.png')"
            element.style.color = 'white'
        }
    })
})

homeNavigation.addEventListener('click', () => {
    document.location.reload()
})