const homeContainer = document.querySelector('.app__content-home')
const homeNavigation = document.querySelector('.app__nav-item:first-child')
const triviaIcon = document.querySelector('.app__nav-name-icon')

const categories = document.querySelectorAll('.app__category-item')
const mainContainer = document.querySelector('.app__content-main')

const header = document.querySelector('.app__header')
const footer = document.querySelector('.app__footer')

categories.forEach(element => {
    element.addEventListener('click', () => {
        homeContainer.style.display = 'none'
        removeActive()
        
        element.classList.add('app__category--active')

        let categoryItem = element.childNodes[3].innerHTML

        changeCategory(categoryItem)
        favourite()
    })
})

homeNavigation.addEventListener('click', () => {
    document.location.reload()
})

triviaIcon.addEventListener('click', () => {
    document.location.reload()
})

//param: array include 4 urls
function fetchManual(element) {

    var object
    
    if (element === 'Beach') {
        object = {
            obj1 : [
                {
                    img: "../assets/img/category/beach/mauritius.png",
                    name: "Mauritius",
                    rating: 4.7,
                    desc: "3Days 4 Nights",
                    schedule: ["2 Flights", "1 Hotel", "2 Transfers", "4 Activities"],
                    detail: ["Tour combo with return airport transfer", "City Tour, Curious Corner"],
                    price: ["₹88,952", "₹88,952"]
                },
                {
                    img: "../assets/img/category/beach/havelock.jpg",
                    name: "Havelock",
                    rating: 4.9,
                    desc: "3Days 4 Nights",
                    schedule: ["2 Flights", "1 Hotel", "2 Transfers", "4 Activities"],
                    detail: ["Tour combo with return airport transfer", "City Tour, Curious Corner"],
                    price: ["₹88,952", "₹88,952"]
                },
                {
                    img: "../assets/img/category/beach/whitsunday_islands.jpg",
                    name: "Whitsunday Islands",
                    rating: 4.5,
                    desc: "3Days 4 Nights",
                    schedule: ["2 Flights", "1 Hotel", "2 Transfers", "4 Activities"],
                    detail: ["Tour combo with return airport transfer", "City Tour, Curious Corner"],
                    price: ["₹88,952", "₹88,952"]
                },
                {
                    img: "../assets/img/category/beach/mauritius.png",
                    name: "Mauritius",
                    rating: 4.7,
                    desc: "3Days 4 Nights",
                    schedule: ["2 Flights", "1 Hotel", "2 Transfers", "4 Activities"],
                    detail: ["Tour combo with return airport transfer", "City Tour, Curious Corner"],
                    price: ["₹88,952", "₹88,952"]
                },
            ],
            obj2 : [
                {
                    img: "../assets/img/category/beach/image_25.png",
                    name: "Havelock",
                    rating: 4.9,
                    desc: "3Days 4 Nights",
                    schedule: ["2 Flights", "1 Hotel", "2 Transfers", "4 Activities"],
                    detail: ["Tour combo with return airport transfer", "City Tour, Curious Corner"],
                    price: ["₹88,952", "₹88,952"]
                },
                {
                    img: "../assets/img/category/beach/image_31.png",
                    name: "Whitsunday Islands",
                    rating: 4.5,
                    desc: "3Days 4 Nights",
                    schedule: ["2 Flights", "1 Hotel", "2 Transfers", "4 Activities"],
                    detail: ["Tour combo with return airport transfer", "City Tour, Curious Corner"],
                    price: ["₹88,952", "₹88,952"]
                },
                {
                    img: "../assets/img/category/beach/image_32.png",
                    name: "Maldives",
                    rating: 4.9,
                    desc: "3Days 4 Nights",
                    schedule: ["2 Flights", "1 Hotel", "2 Transfers", "4 Activities"],
                    detail: ["Tour combo with return airport transfer", "City Tour, Curious Corner"],
                    price: ["₹88,952", "₹88,952"]
                },
                {
                    img: "../assets/img/category/beach/whitsunday_islands.jpg",
                    name: "Whitsunday Islands",
                    rating: 4.5,
                    desc: "3Days 4 Nights",
                    schedule: ["2 Flights", "1 Hotel", "2 Transfers", "4 Activities"],
                    detail: ["Tour combo with return airport transfer", "City Tour, Curious Corner"],
                    price: ["₹88,952", "₹88,952"]
                },
                {
                    img: "../assets/img/category/beach/whitsunday_islands.jpg",
                    name: "Whitsunday Islands",
                    rating: 4.5,
                    desc: "3Days 4 Nights",
                    schedule: ["2 Flights", "1 Hotel", "2 Transfers", "4 Activities"],
                    detail: ["Tour combo with return airport transfer", "City Tour, Curious Corner"],
                    price: ["₹88,952", "₹88,952"]
                },
            ],
        }
    }
    if (element === 'Mountain') {
        object = {
            obj1 : [
                {
                    img: "../assets/img/category/mountain/mountain_1.jpg",
                    name: "Mauritius",
                    rating: 4.7,
                    desc: "3Days 4 Nights",
                    schedule: ["2 Flights", "1 Hotel", "2 Transfers", "4 Activities"],
                    detail: ["Tour combo with return airport transfer", "City Tour, Curious Corner"],
                    price: ["₹88,952", "₹88,952"]
                },
                {
                    img: "../assets/img/category/mountain/mountain_2.jpg",
                    name: "Havelock",
                    rating: 4.9,
                    desc: "3Days 4 Nights",
                    schedule: ["2 Flights", "1 Hotel", "2 Transfers", "4 Activities"],
                    detail: ["Tour combo with return airport transfer", "City Tour, Curious Corner"],
                    price: ["₹88,952", "₹88,952"]
                },
                {
                    img: "../assets/img/category/mountain/mountain_3.jpg",
                    name: "Whitsunday Islands",
                    rating: 4.5,
                    desc: "3Days 4 Nights",
                    schedule: ["2 Flights", "1 Hotel", "2 Transfers", "4 Activities"],
                    detail: ["Tour combo with return airport transfer", "City Tour, Curious Corner"],
                    price: ["₹88,952", "₹88,952"]
                },
                {
                    img: "../assets/img/category/mountain/mountain_4.jpg",
                    name: "Mauritius",
                    rating: 4.7,
                    desc: "3Days 4 Nights",
                    schedule: ["2 Flights", "1 Hotel", "2 Transfers", "4 Activities"],
                    detail: ["Tour combo with return airport transfer", "City Tour, Curious Corner"],
                    price: ["₹88,952", "₹88,952"]
                },
            ],
            obj2 : [
                {
                    img: "../assets/img/category/mountain/mountain_2.jpg",
                    name: "Havelock",
                    rating: 4.9,
                    desc: "3Days 4 Nights",
                    schedule: ["2 Flights", "1 Hotel", "2 Transfers", "4 Activities"],
                    detail: ["Tour combo with return airport transfer", "City Tour, Curious Corner"],
                    price: ["₹88,952", "₹88,952"]
                },
                {
                    img: "../assets/img/category/mountain/mountain_4.jpg",
                    name: "Whitsunday Islands",
                    rating: 4.5,
                    desc: "3Days 4 Nights",
                    schedule: ["2 Flights", "1 Hotel", "2 Transfers", "4 Activities"],
                    detail: ["Tour combo with return airport transfer", "City Tour, Curious Corner"],
                    price: ["₹88,952", "₹88,952"]
                },
                {
                    img: "../assets/img/category/mountain/mountain_1.jpg",
                    name: "Maldives",
                    rating: 4.9,
                    desc: "3Days 4 Nights",
                    schedule: ["2 Flights", "1 Hotel", "2 Transfers", "4 Activities"],
                    detail: ["Tour combo with return airport transfer", "City Tour, Curious Corner"],
                    price: ["₹88,952", "₹88,952"]
                },
                {
                    img: "../assets/img/category/mountain/mountain_3.jpg",
                    name: "Whitsunday Islands",
                    rating: 4.5,
                    desc: "3Days 4 Nights",
                    schedule: ["2 Flights", "1 Hotel", "2 Transfers", "4 Activities"],
                    detail: ["Tour combo with return airport transfer", "City Tour, Curious Corner"],
                    price: ["₹88,952", "₹88,952"]
                },
            ],
        }
    }
    if (element === 'Iconic Cities') {
        object = {
            obj1 : [
                {
                    img: "../assets/img/category/iconic_city/city_1.jpg",
                    name: "Mauritius",
                    rating: 4.7,
                    desc: "3Days 4 Nights",
                    schedule: ["2 Flights", "1 Hotel", "2 Transfers", "4 Activities"],
                    detail: ["Tour combo with return airport transfer", "City Tour, Curious Corner"],
                    price: ["₹88,952", "₹88,952"]
                },
                {
                    img: "../assets/img/category/iconic_city/city_2.jpg",
                    name: "Havelock",
                    rating: 4.9,
                    desc: "3Days 4 Nights",
                    schedule: ["2 Flights", "1 Hotel", "2 Transfers", "4 Activities"],
                    detail: ["Tour combo with return airport transfer", "City Tour, Curious Corner"],
                    price: ["₹88,952", "₹88,952"]
                },
                {
                    img: "../assets/img/category/iconic_city/city_3.jpg",
                    name: "Whitsunday Islands",
                    rating: 4.5,
                    desc: "3Days 4 Nights",
                    schedule: ["2 Flights", "1 Hotel", "2 Transfers", "4 Activities"],
                    detail: ["Tour combo with return airport transfer", "City Tour, Curious Corner"],
                    price: ["₹88,952", "₹88,952"]
                },
                {
                    img: "../assets/img/category/iconic_city/city_4.png",
                    name: "Mauritius",
                    rating: 4.7,
                    desc: "3Days 4 Nights",
                    schedule: ["2 Flights", "1 Hotel", "2 Transfers", "4 Activities"],
                    detail: ["Tour combo with return airport transfer", "City Tour, Curious Corner"],
                    price: ["₹88,952", "₹88,952"]
                },
            ],
            obj2 : [
                {
                    img: "../assets/img/category/iconic_city/city_4.png",
                    name: "Havelock",
                    rating: 4.9,
                    desc: "3Days 4 Nights",
                    schedule: ["2 Flights", "1 Hotel", "2 Transfers", "4 Activities"],
                    detail: ["Tour combo with return airport transfer", "City Tour, Curious Corner"],
                    price: ["₹88,952", "₹88,952"]
                },
                {
                    img: "../assets/img/category/iconic_city/city_1.jpg",
                    name: "Whitsunday Islands",
                    rating: 4.5,
                    desc: "3Days 4 Nights",
                    schedule: ["2 Flights", "1 Hotel", "2 Transfers", "4 Activities"],
                    detail: ["Tour combo with return airport transfer", "City Tour, Curious Corner"],
                    price: ["₹88,952", "₹88,952"]
                },
                {
                    img: "../assets/img/category/iconic_city/city_3.jpg",
                    name: "Maldives",
                    rating: 4.9,
                    desc: "3Days 4 Nights",
                    schedule: ["2 Flights", "1 Hotel", "2 Transfers", "4 Activities"],
                    detail: ["Tour combo with return airport transfer", "City Tour, Curious Corner"],
                    price: ["₹88,952", "₹88,952"]
                },
                {
                    img: "../assets/img/category/iconic_city/city_2.jpg",
                    name: "Whitsunday Islands",
                    rating: 4.5,
                    desc: "3Days 4 Nights",
                    schedule: ["2 Flights", "1 Hotel", "2 Transfers", "4 Activities"],
                    detail: ["Tour combo with return airport transfer", "City Tour, Curious Corner"],
                    price: ["₹88,952", "₹88,952"]
                },
            ],
        }
    }

    return object
}

function renderManual(text) {
    let fetchAPI = fetchManual(text)
    let arr1 = fetchAPI.obj1
    let arr2 = fetchAPI.obj2

    let html = `
            <div class="app__home-location">
                <h3 class="app__home-location-title">
                    Popular ${text} Destinations
                </h3>

                <div class="row">
            `

    html += renderItem(arr1).join('')
    html += `
                </div>
            </div>

            <div class="app__home-location">
                <h3 class="app__home-location-title">
                    All Inclusive Packages!
                </h3>
    
                <div class="row">
            `

    html += renderItem(arr2).join('')
    html += `
                </div>
            </div>
        `

    return html
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

function removeActive() {
    categories.forEach(element => {
        element.classList.remove('app__category--active')
    })
}

function changeCategory(param) {
    mainContainer.style.display = 'block'
    let html

    if (param === 'Beaches') {
        header.style.backgroundImage = "url('../assets/img/background/image_3.png')"

        html = renderManual('Beach')
    } else if (param === 'Mountains') {
        header.style.backgroundImage = "url('../assets/img/background/image_4.png')"
        footer.style.backgroundImage = "url('../assets/img/background/Frame_99.png')"

        html = renderManual('Mountain')
    } else if (param === 'Iconic Cities') {
        header.style.backgroundImage = "url('../assets/img/background/image_1.png')"
        footer.style.backgroundImage = "url('../assets/img/background/Frame_100.png')"

        html = renderManual('Iconic Cities')
    } else if (param === 'Countryside') {
        header.style.backgroundImage = "url('../assets/img/background/image_33.png')"
        footer.style.backgroundImage = "url('../assets/img/background/Frame_100.png')"

        html = renderManual('Countryside')
    } else if (param === 'Camping') {
        header.style.backgroundImage = "url('../assets/img/background/image_3.png')"
        footer.style.backgroundImage = "url('../assets/img/background/Frame_100.png')"

        html = renderManual('Camping')
    } else if (param === 'Tropical') {
        header.style.backgroundImage = "url('../assets/img/background/image_4.png')"
        footer.style.backgroundImage = "url('../assets/img/background/Frame_100.png')"

        html = renderManual('Tropical')
    }

    mainContainer.innerHTML = html
}

function renderItem(arr) {
    let result = arr.map(function(element) {
        return `
            <div class="col l-3 m-6 c-6">
                <a href="#" class="home-location-item">
                    <img src="${element.img}" alt="" class="home-location-item__img">
                    <i class="home-location-item__favourite fa-regular fa-heart"></i>
                    <i class="home-location-item__favourite--active fa-solid fa-heart"></i>
                    <span class="home-location-item__title">
                        <h4 class="home-location-item__name">${element.name}</h4>
                        <span class="home-location-item__rating">
                            <i class="home-location-item__rating-icon fa-solid fa-star"></i>
                                ${element.rating}
                        </span>
                    </span>
                    <span class="home-location-item__desc">${element.desc}</span>
                    <div class="home-location-item__schedule">
                        <span class="schedule__item">
                            <i class="schedule__item-icon fa-solid fa-plane-up"></i>
                            <figcaption>${element.schedule[0]}</figcaption>
                        </span>
                        <span class="schedule__item">
                            <i class="schedule__item-icon fa-solid fa-hotel"></i>
                            <figcaption>${element.schedule[1]}</figcaption>
                        </span>
                        <span class="schedule__item">
                            <i class="schedule__item-icon fa-solid fa-car-side"></i>
                            <figcaption>${element.schedule[2]}</figcaption>
                        </span>
                        <span class="schedule__item">
                            <i class="schedule__item-icon fa-solid fa-person-walking"></i>
                            <figcaption>${element.schedule[3]}</figcaption>
                        </span>
                    </div>
                    <div class="home-location-item__detail">
                        <ul>
                            <li>${element.detail[0]}</li>
                            <li>${element.detail[1]}</li>
                            <li>${element.detail[2]}</li>
                        </ul>
                    </div>
                    <div class="home-location-item__price">
                        <span class="home-location-item__price-old">${element.price[0]}</span>
                        <span class="home-location-item__price-current">${element.price[1]}</span>
                        <span>Per person</span>
                    </div>
                </a>
            </div>
            `
    })

    return result
}