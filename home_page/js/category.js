const homeContainer = document.querySelector('.app__content-home')
const homeNavigation = document.querySelector('.app__nav-item:first-child')
const triviaIcon = document.querySelector('.app__nav-name-icon')

const categories = document.querySelectorAll('.app__category-item')
const beachContainer = document.querySelector('.app__content-beach')
const mountainContainer = document.querySelector('.app__content-mountain')
const iconicCityContainer = document.querySelector('.app__content-iconic-city')
const countrysideContainer = document.querySelector('.app__content-countryside')
const campingContainer = document.querySelector('.app__content-camping')
const tropicalContainer = document.querySelector('.app__content-tropical')

const header = document.querySelector('.app__header')
const footer = document.querySelector('.app__footer')

const beaches = [
    {
        img: "../assets/img/beach/mauritius.png",
        name: "Mauritius",
        rating: 4.7,
        desc: "3Days 4 Nights",
        schedule: ["2 Flights", "1 Hotel", "2 Transfers", "4 Activities"],
        detail: ["Tour combo with return airport transfer", "City Tour, Curious Corner"],
        price: ["₹88,952", "₹88,952"]
    },
    {
        img: "../assets/img/beach/havelock.jpg",
        name: "Havelock",
        rating: 4.9,
        desc: "3Days 4 Nights",
        schedule: ["2 Flights", "1 Hotel", "2 Transfers", "4 Activities"],
        detail: ["Tour combo with return airport transfer", "City Tour, Curious Corner"],
        price: ["₹88,952", "₹88,952"]
    },
    {
        img: "../assets/img/beach/whitsunday_islands.jpg",
        name: "Whitsunday Islands",
        rating: 4.5,
        desc: "3Days 4 Nights",
        schedule: ["2 Flights", "1 Hotel", "2 Transfers", "4 Activities"],
        detail: ["Tour combo with return airport transfer", "City Tour, Curious Corner"],
        price: ["₹88,952", "₹88,952"]
    },
    {
        img: "../assets/img/beach/mauritius.png",
        name: "Mauritius",
        rating: 4.7,
        desc: "3Days 4 Nights",
        schedule: ["2 Flights", "1 Hotel", "2 Transfers", "4 Activities"],
        detail: ["Tour combo with return airport transfer", "City Tour, Curious Corner"],
        price: ["₹88,952", "₹88,952"]
    },
]

const beaches2 = [
    {
        img: "../assets/img/beach/mauritius.png",
        name: "Mauritius",
        rating: 4.7,
        desc: "3Days 4 Nights",
        schedule: ["2 Flights", "1 Hotel", "2 Transfers", "4 Activities"],
        detail: ["Tour combo with return airport transfer", "City Tour, Curious Corner"],
        price: ["₹88,952", "₹88,952"]
    },
    {
        img: "../assets/img/beach/maldives.jpg",
        name: "Maldives",
        rating: 4.9,
        desc: "3Days 4 Nights",
        schedule: ["2 Flights", "1 Hotel", "2 Transfers", "4 Activities"],
        detail: ["Tour combo with return airport transfer", "City Tour, Curious Corner"],
        price: ["₹88,952", "₹88,952"]
    },
    {
        img: "../assets/img/beach/whitsunday_islands.jpg",
        name: "Whitsunday Islands",
        rating: 4.5,
        desc: "3Days 4 Nights",
        schedule: ["2 Flights", "1 Hotel", "2 Transfers", "4 Activities"],
        detail: ["Tour combo with return airport transfer", "City Tour, Curious Corner"],
        price: ["₹88,952", "₹88,952"]
    },
]

const beaches3 = [
    {
        img: "../assets/img/beach/image_25.png",
        name: "Havelock",
        rating: 4.9,
        desc: "3Days 4 Nights",
        schedule: ["2 Flights", "1 Hotel", "2 Transfers", "4 Activities"],
        detail: ["Tour combo with return airport transfer", "City Tour, Curious Corner"],
        price: ["₹88,952", "₹88,952"]
    },
    {
        img: "../assets/img/beach/image_31.png",
        name: "Whitsunday Islands",
        rating: 4.5,
        desc: "3Days 4 Nights",
        schedule: ["2 Flights", "1 Hotel", "2 Transfers", "4 Activities"],
        detail: ["Tour combo with return airport transfer", "City Tour, Curious Corner"],
        price: ["₹88,952", "₹88,952"]
    },
    {
        img: "../assets/img/beach/image_32.png",
        name: "Maldives",
        rating: 4.9,
        desc: "3Days 4 Nights",
        schedule: ["2 Flights", "1 Hotel", "2 Transfers", "4 Activities"],
        detail: ["Tour combo with return airport transfer", "City Tour, Curious Corner"],
        price: ["₹88,952", "₹88,952"]
    },
    {
        img: "../assets/img/beach/whitsunday_islands.jpg",
        name: "Whitsunday Islands",
        rating: 4.5,
        desc: "3Days 4 Nights",
        schedule: ["2 Flights", "1 Hotel", "2 Transfers", "4 Activities"],
        detail: ["Tour combo with return airport transfer", "City Tour, Curious Corner"],
        price: ["₹88,952", "₹88,952"]
    },
]

const theme = {
    img: "../assets/img/beach/summer_bonanza.png",
    title: "Summer Bonanza!",
    detail: ["Enjoy confortable transfers in shared coaches", 
    "Choose from 5 flights per week", 
    "Get a free Rapid Antigen Test at selected hotels"]
}

categories.forEach(element => {
    element.addEventListener('click', () => {
        homeContainer.style.display = 'none'
        element.style.color = 'var(--white-color)'

        if (element.childNodes[3].innerHTML === 'Beaches') {
            beachContainer.style.display = 'block'
            header.style.backgroundImage = "url('../assets/img/background/image_3.png')"

            renderBeach()
            favourite()
        }
    })
})

homeNavigation.addEventListener('click', () => {
    document.location.reload()
})

triviaIcon.addEventListener('click', () => {
    document.location.reload()
})

function renderBeach() {
    let html = `
                <div class="app__home-location">
                    <h3 class="app__home-location-title">
                        Popular Beach Destinations
                    </h3>

                <div class="row">
                `

            let topBeach = beaches.map(function(beach) {
                return `
                    <div class="col l-3 m-6 c-6">
                        <a href="#" class="home-location-item">
                            <img src="${beach.img}" alt="" class="home-location-item__img">
                            <i class="home-location-item__favourite fa-regular fa-heart"></i>
                            <i class="home-location-item__favourite--active fa-solid fa-heart"></i>
                            <span class="home-location-item__title">
                                <h4 class="home-location-item__name">${beach.name}</h4>
                                <span class="home-location-item__rating">
                                    <i class="home-location-item__rating-icon fa-solid fa-star"></i>
                                    ${beach.rating}
                                </span>
                            </span>
                            <span class="home-location-item__desc">${beach.desc}</span>
                            <div class="home-location-item__schedule">
                                <span class="schedule__item">
                                    <i class="schedule__item-icon fa-solid fa-plane-up"></i>
                                    <figcaption>${beach.schedule[0]}</figcaption>
                                </span>
                                <span class="schedule__item">
                                    <i class="schedule__item-icon fa-solid fa-hotel"></i>
                                    <figcaption>${beach.schedule[1]}</figcaption>
                                </span>
                                <span class="schedule__item">
                                    <i class="schedule__item-icon fa-solid fa-car-side"></i>
                                    <figcaption>${beach.schedule[2]}</figcaption>
                                </span>
                                <span class="schedule__item">
                                    <i class="schedule__item-icon fa-solid fa-person-walking"></i>
                                    <figcaption>${beach.schedule[3]}</figcaption>
                                </span>
                            </div>
                            <div class="home-location-item__detail">
                                <ul>
                                    <li>${beach.detail[0]}</li>
                                    <li>${beach.detail[1]}</li>
                                    <li>${beach.detail[2]}</li>
                                </ul>
                            </div>
                            <div class="home-location-item__price">
                                <span class="home-location-item__price-old">${beach.price[0]}</span>
                                <span class="home-location-item__price-current">${beach.price[1]}</span>
                                <span>Per person</span>
                            </div>
                        </a>
                    </div>
                `
            })

            html += topBeach.join('')
            html += `
                </div>
            </div>
            `

    html += `
        <div class="app__home-location">
            <h3 class="app__home-location-title">
                Recently Viewed
            </h3>

            <div class="row">
        `

        let reviewed = beaches2.map(function(beach) {
            return `
                <div class="col l-3 m-6 c-6">
                    <a href="#" class="home-location-item">
                        <img src="${beach.img}" alt="" class="home-location-item__img">
                        <i class="home-location-item__favourite fa-regular fa-heart"></i>
                        <i class="home-location-item__favourite--active fa-solid fa-heart"></i>
                        <span class="home-location-item__title">
                            <h4 class="home-location-item__name">${beach.name}</h4>
                            <span class="home-location-item__rating">
                                <i class="home-location-item__rating-icon fa-solid fa-star"></i>
                                ${beach.rating}
                            </span>
                        </span>
                        <span class="home-location-item__desc">${beach.desc}</span>
                        <div class="home-location-item__schedule">
                            <span class="schedule__item">
                                <i class="schedule__item-icon fa-solid fa-plane-up"></i>
                                <figcaption>${beach.schedule[0]}</figcaption>
                            </span>
                            <span class="schedule__item">
                                <i class="schedule__item-icon fa-solid fa-hotel"></i>
                                <figcaption>${beach.schedule[1]}</figcaption>
                            </span>
                            <span class="schedule__item">
                                <i class="schedule__item-icon fa-solid fa-car-side"></i>
                                <figcaption>${beach.schedule[2]}</figcaption>
                            </span>
                            <span class="schedule__item">
                                <i class="schedule__item-icon fa-solid fa-person-walking"></i>
                                <figcaption>${beach.schedule[3]}</figcaption>
                            </span>
                        </div>
                        <div class="home-location-item__detail">
                            <ul>
                                <li>${beach.detail[0]}</li>
                                <li>${beach.detail[1]}</li>
                                <li>${beach.detail[2]}</li>
                            </ul>
                        </div>
                        <div class="home-location-item__price">
                            <span class="home-location-item__price-old">${beach.price[0]}</span>
                            <span class="home-location-item__price-current">${beach.price[1]}</span>
                            <span>Per person</span>
                        </div>
                    </a>
                </div>
            `
        })

        html += reviewed.join('')

        html += `
            <div class="col l-3 m-6 c-6">
                <a href="#" class="home-viewed">
                    <img src="${theme.img}" alt="" class="home-viewed__img">
                    <div class="home-viewed-info">
                        <h3 class="home-viewed__title">${theme.title}</h3>
                        <ul class="home-viewed__list">
                            <li class="home-viewed-item">${theme.detail[0]}</li>
                            <li class="home-viewed-item">${theme.detail[1]}</li>
                            <li class="home-viewed-item">${theme.detail[2]}</li>
                        </ul>
                    </div>
                </a>
            </div>
        `

        html += `
                </div>
            </div>

            <div class="app__home-location">
                <h3 class="app__home-location-title app__margin-top-48">
                    All Inclusive Packages!
                </h3>
    
            <div class="row">
            `

            let package = beaches3.map(function(beach) {
                return `
                    <div class="col l-3 m-6 c-6">
                        <a href="#" class="home-location-item">
                            <img src="${beach.img}" alt="" class="home-location-item__img">
                            <i class="home-location-item__favourite fa-regular fa-heart"></i>
                            <i class="home-location-item__favourite--active fa-solid fa-heart"></i>
                            <span class="home-location-item__title">
                                <h4 class="home-location-item__name">${beach.name}</h4>
                                <span class="home-location-item__rating">
                                    <i class="home-location-item__rating-icon fa-solid fa-star"></i>
                                    ${beach.rating}
                                </span>
                            </span>
                            <span class="home-location-item__desc">${beach.desc}</span>
                            <div class="home-location-item__schedule">
                                <span class="schedule__item">
                                    <i class="schedule__item-icon fa-solid fa-plane-up"></i>
                                    <figcaption>${beach.schedule[0]}</figcaption>
                                </span>
                                <span class="schedule__item">
                                    <i class="schedule__item-icon fa-solid fa-hotel"></i>
                                    <figcaption>${beach.schedule[1]}</figcaption>
                                </span>
                                <span class="schedule__item">
                                    <i class="schedule__item-icon fa-solid fa-car-side"></i>
                                    <figcaption>${beach.schedule[2]}</figcaption>
                                </span>
                                <span class="schedule__item">
                                    <i class="schedule__item-icon fa-solid fa-person-walking"></i>
                                    <figcaption>${beach.schedule[3]}</figcaption>
                                </span>
                            </div>
                            <div class="home-location-item__detail">
                                <ul>
                                    <li>${beach.detail[0]}</li>
                                    <li>${beach.detail[1]}</li>
                                    <li>${beach.detail[2]}</li>
                                </ul>
                            </div>
                            <div class="home-location-item__price">
                                <span class="home-location-item__price-old">${beach.price[0]}</span>
                                <span class="home-location-item__price-current">${beach.price[1]}</span>
                                <span>Per person</span>
                            </div>
                        </a>
                    </div>
                `
            })

            html += package.join('')
            html += `
                </div>
            </div>
            `

    beachContainer.innerHTML = html
}

function favourite() {
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
}