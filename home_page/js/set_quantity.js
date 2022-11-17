//Xử lý sự kiện chọn số lượng người và số lượng phòng
const textQuantity = document.querySelector('.app__search-quantity')
const btnQuantity = document.querySelector('.btn-quantity')
const boxQuantity = document.querySelector('.box-quantity')

const roomQuantity = document.querySelector('.room-quantity');
const amountRoom = document.querySelector('.amount-room')
const btnAddRoom = document.querySelector('.btn-add-room')
const btnMinusRoom = document.querySelector('.btn-minus-room')

const peopleQuantity = document.querySelector('.people-quantity');
const amountPeople = document.querySelector('.amount-people')
const btnAddPeople = document.querySelector('.btn-add-people')
const btnMinusPeople = document.querySelector('.btn-minus-people')

textQuantity.addEventListener('click', () => {
    amountPeople.innerHTML = peopleQuantity.innerHTML
    amountRoom.innerHTML = roomQuantity.innerHTML

    boxQuantity.style.display = 'block';
})

btnQuantity.addEventListener('click', () => {
    peopleQuantity.innerHTML = amountPeople.innerHTML
    roomQuantity.innerHTML = amountRoom.innerHTML
    boxQuantity.style.display = 'none';
})

btnAddRoom.addEventListener('click', () => {
    let numberRoom = parseInt(amountRoom.innerHTML)
    numberRoom++;

    if (numberRoom > 1 && btnMinusRoom.hasAttribute('disabled')) {
        btnMinusRoom.removeAttribute('disabled');
    }

    amountRoom.innerHTML = numberRoom;
})

btnMinusRoom.addEventListener('click', () => {
    let currentRoom = parseInt(amountRoom.innerHTML)

    if (currentRoom <= 1) {
        btnMinusRoom.setAttribute('disabled', true)
    } else {
        let numberRoom = currentRoom
        numberRoom--;
        amountRoom.innerHTML = numberRoom;
    }
})

btnAddPeople.addEventListener('click', () => {
    let numberPeople = parseInt(amountPeople.innerHTML)
    numberPeople++;

    if (numberPeople > 1 && btnMinusPeople.hasAttribute('disabled')) {
        btnMinusPeople.removeAttribute('disabled');
    }

    amountPeople.innerHTML = numberPeople;
})

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

//click bên ngoài ô chọn số lượng thì ẩn đi ô chọn số lượng
document.addEventListener('mouseup', function(e) {
    if (!boxQuantity.contains(e.target)) {
        boxQuantity.style.display = 'none';
    }
});