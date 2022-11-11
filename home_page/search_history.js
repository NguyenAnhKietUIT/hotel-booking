const inputSearch = document.querySelector('input[name="app__search-input"]')
const boxHistory = document.querySelector('.app__search-history')
const listHistory = document.querySelector('.app__search-history-list')

inputSearch.addEventListener('click', () => {
    boxHistory.style.display = 'block'
})

inputSearch.addEventListener('input', () => {
    //events find similar
})

listHistory.addEventListener('click', (events) => {
    let result = events.target.innerText

    inputSearch.value = result
    boxHistory.style.display = 'none'
})