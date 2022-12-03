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

seeMore()