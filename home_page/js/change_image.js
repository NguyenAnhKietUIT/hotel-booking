let locations = [
    "../assets/img/home_page/ho_chi_minh.png",
    "../assets/img/home_page/hoi_an.png",
    "../assets/img/home_page/ha_giang.png",
    "../assets/img/home_page/nha_trang.png"
]

let destinations = document.querySelectorAll('.app__selection-item-link')
let index = 1
let nIntervalId

destinations.forEach(element => {
    if(element.childNodes[3].innerHTML === 'Ho Chi Minh') {
        element.addEventListener('mouseover', () => {
            if (!nIntervalId) {
                    nIntervalId = setInterval(() => {
                    element.childNodes[1].src = locations[index]
                    index++
                    console.log(index)

                    if (index >= locations.length) {
                        index = 0
                    }
                }, 2500)
            }
        })

        element.addEventListener('mouseleave', () => {
            clearInterval(nIntervalId)
            nIntervalId = null
            element.childNodes[1].src = locations[0]
        })
    }
})