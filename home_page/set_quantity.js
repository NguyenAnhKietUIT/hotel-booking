//Xử lý sự kiện chọn số lượng người và số lượng phòng
const optionNumber = document.querySelector('.app__search-option-number')
const optionSelected = document.querySelector('.btn-selected')
const number = document.querySelector('.app__search-item__option')

const textRoom = document.querySelector('.option-number-room');
const innerRoom = document.querySelector('.amount-room')
const btnAddRoom = document.querySelector('.btn-add-room')
const btnMinusRoom = document.querySelector('.btn-minus-room')

const textPeople = document.querySelector('.option-number-people');
const innerPeople = document.querySelector('.amount-people')
const btnAddPeople = document.querySelector('.btn-add-people')
const btnMinusPeople = document.querySelector('.btn-minus-people')

optionNumber.addEventListener('click', () => {
    innerPeople.innerHTML = textPeople.innerHTML
    innerRoom.innerHTML = textRoom.innerHTML

    number.style.display = 'block';
})

optionSelected.addEventListener('click', () => {
    textPeople.innerHTML = innerPeople.innerHTML
    textRoom.innerHTML = innerRoom.innerHTML
    number.style.display = 'none';
})

btnAddRoom.addEventListener('click', () => {
    let numberRoom = parseInt(innerRoom.innerHTML)
    numberRoom++;

    if (numberRoom > 1 && btnMinusRoom.hasAttribute('disabled')) {
        btnMinusRoom.removeAttribute('disabled');
    }

    innerRoom.innerHTML = numberRoom;
})

btnMinusRoom.addEventListener('click', () => {
    let currentRoom = parseInt(innerRoom.innerHTML)

    if (currentRoom <= 1) {
        btnMinusRoom.setAttribute('disabled', true)
    } else {
        let numberRoom = currentRoom
        numberRoom--;
        innerRoom.innerHTML = numberRoom;
    }
})

btnAddPeople.addEventListener('click', () => {
    let numberPeople = parseInt(innerPeople.innerHTML)
    numberPeople++;

    if (numberPeople > 1 && btnMinusPeople.hasAttribute('disabled')) {
        btnMinusPeople.removeAttribute('disabled');
    }

    innerPeople.innerHTML = numberPeople;
})

btnMinusPeople.addEventListener('click', () => {
    let currentPeople = parseInt(innerPeople.innerHTML)

    if (currentPeople <= 1) {
        btnMinusPeople.setAttribute('disabled', true)
    } else {
        let numberPeople = currentPeople
        numberPeople--;
        innerPeople.innerHTML = numberPeople;
    }
})