const divCheckIn = document.querySelector('.app__status-in')
const inputsCheckIn = document.getElementById('app__check-in')

const divCheckOut = document.querySelector('.app__status-out')
const inputsCheckOut = document.getElementById('app__check-out')

divCheckIn.addEventListener('click', () => {
    divCheckIn.remove()

    inputsCheckIn.style.display = 'block';

    if (inputsCheckOut.style.display === 'block') {
        let checkOut = inputsCheckOut.value;

        inputsCheckIn.max = checkOut;
    }
})

inputsCheckIn.addEventListener('change', () => {
    if (inputsCheckOut.style.display === 'block') {
        let checkIn = inputsCheckIn.value;

        inputsCheckOut.value = checkIn;
        inputsCheckOut.min = checkIn;
    }
})

divCheckOut.addEventListener('click', () => {
    divCheckOut.remove()

    inputsCheckOut.style.display = 'block';

    if (inputsCheckIn.style.display === 'block') {
        let checkIn = inputsCheckIn.value;

        inputsCheckOut.value = checkIn;
        inputsCheckOut.min = checkIn;
    }
})

inputsCheckOut.addEventListener('change' , () => {
    if (inputsCheckIn.style.display === 'block') {
        let checkOut = inputsCheckOut.value;

        inputsCheckIn.max = checkOut;
    }
})