const roomFilter = document.getElementById('select-room')
const statusFilter = document.getElementById('select-status')
const dateFilter = document.getElementById('input-date')
const buttonClearFilter = document.querySelector('.btn-clear')

function clearFilter() {
    buttonClearFilter.addEventListener('click', () => {
        roomFilter.value = ""
        statusFilter.value = ""
        dateFilter.value = null
    })
}

clearFilter()