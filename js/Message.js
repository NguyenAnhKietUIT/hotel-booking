const checkboxSelectAll = document.getElementById('nav-select-all')
const checkboxMessage = document.querySelectorAll('.message-select')
const messageTrash = document.querySelectorAll('.message-trash')
const starNone = document.querySelectorAll('.message-icon')
const starActive = document.querySelectorAll('.message-icon-active')

function selectAll() {
    checkboxSelectAll.addEventListener('change', (event) => {
        if (event.currentTarget.checked) {
            checkboxMessage.forEach(element => {
                element.checked = true;
                element.parentElement.parentElement.style.backgroundColor = 'rgba(0, 0, 0, 0.4)'
            })
        } else {
            checkboxMessage.forEach(element => {
                element.checked = false;
                element.parentElement.parentElement.style.backgroundColor = 'transparent'
            })
        }
    })
}

function deleteMessage() {
    messageTrash.forEach(element => {
        element.addEventListener('click', () => {
            element.parentElement.parentElement.remove();
        })
    })
}

function starMessage() {
    starNone.forEach(element => {
        element.addEventListener('click', () => {
            element.style.display = 'none';
            element.parentElement.querySelector('.message-icon-active').style.display = 'block';
        })
    })

    starActive.forEach(element => {
        element.addEventListener('click', () => {
            element.style.display = 'none';
            element.parentElement.querySelector('.message-icon').style.display = 'block';
        })
    })
}

function selectMessage() {
    checkboxMessage.forEach(element => {
        element.addEventListener('change', () => {
            if (element.checked) {
                element.parentElement.parentElement.style.backgroundColor = 'rgba(0, 0, 0, 0.4)'
            } else {
                element.parentElement.parentElement.style.backgroundColor = 'transparent'
            }
        })
    })
}

selectAll()
deleteMessage()
starMessage()
selectMessage()