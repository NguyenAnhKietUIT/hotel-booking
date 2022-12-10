// Elements search bed and people
const searchQuantity = document.querySelector('.app__search-quantity')
const btnQuantity = document.querySelector('.btn-accept')
const boxQuantity = document.querySelector('.box-quantity')
const bedQuantity = document.querySelector('.app__search-quantity span:first-child');
const amountBed = document.querySelector('.amount-bed')
const btnAddBed = document.querySelector('.btn-add-bed')
const btnMinusBed = document.querySelector('.btn-minus-bed')
const peopleQuantity = document.querySelector('.app__search-quantity span:last-child');
const amountPeople = document.querySelector('.amount-people')
const btnAddPeople = document.querySelector('.btn-add-people')
const btnMinusPeople = document.querySelector('.btn-minus-people')
const buttonSearch = document.querySelector('.app__search-btn')

// Elements search dates
const divCheckIn = document.querySelector('.app__status-in')
const inputCheckIn = document.getElementById('app__check-in')
const divCheckOut = document.querySelector('.app__status-out')
const inputCheckOut = document.getElementById('app__check-out')
const toastMessageCheckIn = document.querySelector('.toast-message-in')
const toastMessageCheckOut = document.querySelector('.toast-message-out')

// Elements search history
const inputSearch = document.querySelector('input[name="app__search-input"]')
const boxHistory = document.querySelector('.app__search-history')
const listHistory = document.querySelector('.app__search-history-list')
const itemHistory = document.querySelectorAll('.app__search-history-item')

// Show box quantity
searchQuantity.addEventListener('click', () => {
    amountPeople.innerHTML = peopleQuantity.innerHTML
    amountBed.innerHTML = bedQuantity.innerHTML

    boxQuantity.style.display = 'block';
})

// hide box quantity
document.addEventListener('mouseup', function(e) {
    if (!boxQuantity.contains(e.target)) {
        boxQuantity.style.display = 'none';
    }
});

// Set value for bed and people
btnQuantity.addEventListener('click', () => {
    peopleQuantity.innerHTML = amountPeople.innerHTML
    bedQuantity.innerHTML = amountBed.innerHTML
    boxQuantity.style.display = 'none';
})

// Add one bed
btnAddBed.addEventListener('click', () => {
    let numberBed = parseInt(amountBed.innerHTML)
    numberBed++;

    if (numberBed > 1 && btnMinusBed.hasAttribute('disabled')) {
        btnMinusBed.removeAttribute('disabled');
    }

    amountBed.innerHTML = numberBed;
})

// Minus one bed
btnMinusBed.addEventListener('click', () => {
    let currentBed = parseInt(amountBed.innerHTML)

    if (currentBed <= 1) {
        btnMinusBed.setAttribute('disabled', true)
    } else {
        let numberBed = currentBed
        numberBed--;
        amountBed.innerHTML = numberBed;
    }
})

// Add one people
btnAddPeople.addEventListener('click', () => {
    let numberPeople = parseInt(amountPeople.innerHTML)
    numberPeople++;

    if (numberPeople > 1 && btnMinusPeople.hasAttribute('disabled')) {
        btnMinusPeople.removeAttribute('disabled');
    }

    amountPeople.innerHTML = numberPeople;
})

// Minus one people
btnMinusPeople.addEventListener('click', () => {
    let currentPeople = parseInt(amountPeople.innerHTML)

    if (currentPeople <= 1) {
        btnMinusPeople.setAttribute('disabled', true)
    } else {
        let numberPeople = currentPeople
        numberPeople--;
        amountPeople.innerHTML = numberPeople;
    }
})

// handle element search date check in
divCheckIn.addEventListener('click', () => {
    divCheckIn.remove()

    inputCheckIn.style.display = 'block';

    // Set min value for check in date
    inputCheckIn.value = getCurrentDate();
    inputCheckIn.min = getCurrentDate();

    if (inputCheckOut.style.display === 'block') {
        let checkOut = inputCheckOut.value;

        inputCheckIn.max = checkOut;
    }
})

// Event onchange of check in
inputCheckIn.addEventListener('change', () => {
    toastMessageCheckOut.style.display = 'none';

    if (inputCheckOut.style.display === 'block') {
        let checkIn = inputCheckIn.value;

        if (daysDifference(checkIn, inputCheckOut.value) > 30) {
            toastMessageCheckIn.style.display = 'block';
            toastMessageCheckIn.style.animation = 'fadeIn linear 0.6s, fadeOut linear 1s 3s forwards';

            inputCheckIn.value = null;
        } else {
            inputCheckOut.min = checkIn;
        }
    }
})

// handle element search date check out
divCheckOut.addEventListener('click', () => {
    divCheckOut.remove()

    inputCheckOut.style.display = 'block';

    // Set min value for check out date
    inputCheckOut.value = getCurrentDate();
    inputCheckOut.min = getCurrentDate();

    if (inputCheckIn.style.display === 'block') {
        let checkIn = inputCheckIn.value;

        inputCheckOut.value = checkIn;
        inputCheckOut.min = checkIn;
    }
})

// Event onchange of check out
inputCheckOut.addEventListener('change' , () => {
    toastMessageCheckIn.style.display = 'none'

    if (inputCheckIn.style.display === 'block') {
        let checkOut = inputCheckOut.value;

        if (daysDifference(inputCheckIn.value, checkOut) > 30) {
            toastMessageCheckOut.style.display = 'block';
            toastMessageCheckOut.style.animation = 'fadeIn linear 0.6s, fadeOut linear 1s 3s forwards';

            inputCheckOut.value = null;
        } else {
            inputCheckIn.max = checkOut;
        }
    }
})

// Show list search history
inputSearch.addEventListener('click', () => {
    boxHistory.style.display = 'block'
})

// hide list search history
document.addEventListener('mouseup', function(e) {
    if (!boxHistory.contains(e.target)) {
        boxHistory.style.display = 'none';
    }
});

// Event oninput of input search
inputSearch.addEventListener('input', () => {
    let currentInput = inputSearch.value

    itemHistory.forEach(element => {
        if (!element.innerText.includes(currentInput)) {
            element.style.display = 'none'
        } else {
            element.style.display = 'block'
        }
    })
})

// Get location and set on input search
listHistory.addEventListener('click', (events) => {
    let result = events.target.innerText

    inputSearch.value = result
    boxHistory.style.display = 'none'
})

function daysDifference(firstDate, secondDate) {
    var startDay = new Date(firstDate);
    var endDay = new Date(secondDate);

    var millisecondBetween = startDay.getTime() - endDay.getTime();
    var days = millisecondBetween / (1000 * 3600 * 24);

    return Math.round(Math.abs(days));
}

function getCurrentDate() {
    // Get current date
    let date = new Date();
    let today;
    if (date.getMonth() + 1 < 10) {
        today = date.getFullYear() + '-0' + (date.getMonth() + 1);
            
        if (date.getDate() < 10) {
            today += '-0' +  date.getDate();
        } else {
            today += '-' +  date.getDate();
        }
    } else {
        today = date.getFullYear() + '-' + (date.getMonth() + 1);

        if (date.getDate() < 10) {
            today += '-0' +  date.getDate();
        } else {
            today += '-' +  date.getDate();
        }
    }
    return today;
}

function imageInterval() {
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
}

imageInterval()