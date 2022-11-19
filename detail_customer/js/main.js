const mainContent = document.querySelector('.app__content .col.l-9')
const sidebarContent = document.querySelector('.app__content .col.l-3')
const options = document.querySelectorAll('.app__sidebar-item')

options.forEach(element => {
    element.addEventListener('click', () => {
        options.forEach(element => {
            element.classList.remove('app__sidebar-item--active')
        })

        element.classList.add('app__sidebar-item--active')

        if (element.innerHTML === 'Your Account') {
           document.location.reload()
        } else if (element.innerHTML === 'View all bookings') {
            let html
            // let bookingAPI = ""

            // fetch(bookingAPI)
            //         .then (function (response) {
            //             return response.json();
            //         })
            //         .then(function (bookings) {
            //             if (bookings.length === 0) {
            //                 html = `
            //                         <span class="app__view-message">You have no bookings yet.</span>
            //                         <button class="btn-view">
            //                             <a href="../../home_page/home.html" class="app__view-link">Start exploring</a>
            //                         </button>
            //                     `
            //             } else {

            //             }
            //         });
            
            

            mainContent.innerHTML = html
            sidebarContent.style.height = '68vh'
        }
    })
})