const inputSearch = document.querySelector('input[name="app__search-input"]')
const boxHistory = document.querySelector('.app__search-history')
const listHistory = document.querySelector('.app__search-history-list')
const itemHistory = document.querySelectorAll('.app__search-history-item')

inputSearch.addEventListener('click', () => {
    boxHistory.style.display = 'block'
})

//Sự kiện thay đổi nội dung ô tìm kiếm
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

//Lấy địa điểm được chọn gắn vào ô tìm kiếm
listHistory.addEventListener('click', (events) => {
    let result = events.target.innerText

    inputSearch.value = result
    boxHistory.style.display = 'none'
})