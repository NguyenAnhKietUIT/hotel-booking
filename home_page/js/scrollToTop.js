const $ = document.getElementById.bind(document);

const toTop = $('app__go-home');

window.onscroll = function () {
    scrollToTop();
};

function scrollToTop() {
    if(document.body.scrollTop > 260 || document.documentElement.scrollTop > 260) {
        toTop.style.display = 'block';
    } else {
        toTop.style.display = 'none';
    }
}