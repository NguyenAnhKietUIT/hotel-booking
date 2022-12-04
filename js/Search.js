function seeMore() {
    let actionSeeActive = document.querySelector('.action-see-active');
    let actionSeeUnactive = document.querySelector('.action-see-unactive');

    actionSeeActive.addEventListener('click', () => {
        document.querySelector('.filter-see-more').style.display = 'block';
        actionSeeActive.classList.toggle('action-see-active');
        actionSeeActive.classList.toggle('action-see-unactive');
        actionSeeUnactive.classList.toggle('action-see-active');
        actionSeeUnactive.classList.toggle('action-see-unactive');
    });

    actionSeeUnactive.addEventListener('click', () => {
        document.querySelector('.filter-see-more').style.display = 'none';
        actionSeeActive.classList.toggle('action-see-active');
        actionSeeActive.classList.toggle('action-see-unactive');
        actionSeeUnactive.classList.toggle('action-see-active');
        actionSeeUnactive.classList.toggle('action-see-unactive');
    });
}

function rangeValue () {
    const range = document.getElementById('filter-range')
    const rangeV = document.getElementById('rangeV'),
    setValue = () => {
    const newValue = Number( (range.value - range.min) * 100 / (range.max - range.min) )
    const newPosition = 10 - (newValue * 0.2);
    rangeV.innerHTML = `<span>${range.value}</span>`;
    rangeV.style.left = `calc(${newValue}% + (${newPosition}px))`;
    };

    document.addEventListener("DOMContentLoaded", setValue);
    range.addEventListener('input', setValue);
}


seeMore();
rangeValue();