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

    // Set min value for check in date
    inputCheckIn.value = today;
    inputCheckIn.min = today;

    if (inputCheckOut.style.display === 'block') {
        let checkOut = inputCheckOut.value;

        inputCheckIn.max = checkOut;
    }
})

// Event onchange of check in
inputCheckIn.addEventListener('change', () => {
    if (inputCheckOut.style.display === 'block') {
        let checkIn = inputCheckIn.value;

        inputCheckOut.value = checkIn;
        inputCheckOut.min = checkIn;
    }
})

// handle element search date check out
divCheckOut.addEventListener('click', () => {
    divCheckOut.remove()

    inputCheckOut.style.display = 'block';

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

    // Set min value for check out date
    inputCheckOut.value = today;
    inputCheckOut.min = today;

    if (inputCheckIn.style.display === 'block') {
        let checkIn = inputCheckIn.value;

        inputCheckOut.value = checkIn;
        inputCheckOut.min = checkIn;
    }
})

// Event onchange of check out
inputCheckOut.addEventListener('change' , () => {
    if (inputCheckIn.style.display === 'block') {
        let checkOut = inputCheckOut.value;

        inputCheckIn.max = checkOut;
    }
})

function handleNavigation() {
    const navMain = document.querySelector('.app__navigation')
    const navList = document.querySelectorAll('.app__navigation a');

    navList.forEach(function(element) {
        element.addEventListener('click', () => {
            navList.forEach(function(element) {
                element.classList.remove('nav-active')
                element.style.color = 'black'
                element.style.borderColor = 'black'
            })
            element.classList.add('nav-active')
            element.style.color = 'red'
            element.style.borderColor = 'red'
        })
    })

    window.addEventListener('scroll', () => {
        if (window.scrollY > 500) {
            navMain.classList.add('sticky')
        } else {
            navMain.classList.remove('sticky')
        }
    })
}

handleNavigation()