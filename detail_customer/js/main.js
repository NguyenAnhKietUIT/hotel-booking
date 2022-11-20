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
            
            html = `
                <h2 class="app__view-message">Your bookings</h2>

                <div class="app__view-list">
                    <h3 class="app__view-title">Upcoming</h3>
                    <a href="#" class="app__view-item">
                        <img src="../assets/img/others/mother_home.png" alt="Type Room" class="app__view-img">
                        <div class="app__view-item-info">
                            <h4 class="app__view-item-title">Mother's Home</h4>
                            <span class="app__view-item-desc">6 Aug - 7 Aug • Ho Chi Minh City</span>
                            <span class="app__view-item-status">Complete</span>
                        </div>
                        <h3 class="app__view-item-price">US$21</h3>
                    </a>
                    <a href="#" class="app__view-item">
                        <img src="../assets/img/others/mother_home.png" alt="Type Room" class="app__view-img">
                        <div class="app__view-item-info">
                            <h4 class="app__view-item-title">Mother's Home</h4>
                            <span class="app__view-item-desc">6 Aug - 7 Aug • Ho Chi Minh City</span>
                            <span class="app__view-item-status">Complete</span>
                        </div>
                        <h3 class="app__view-item-price">US$21</h3>
                    </a>
                </div>
                <div class="app__view-list app__view-list-status">
                    <h3 class="app__view-title">In the past</h3>
                    <a href="#" class="app__view-item">
                        <img src="../assets/img/others/mother_home.png" alt="Type Room" class="app__view-img">
                        <div class="app__view-item-info">
                            <h4 class="app__view-item-title">Mother's Home</h4>
                            <span class="app__view-item-desc">6 Aug - 7 Aug • Ho Chi Minh City</span>
                            <span class="app__view-item-status">Complete</span>
                        </div>
                        <h3 class="app__view-item-price">US$21</h3>
                    </a>
                    <a href="#" class="app__view-item">
                        <img src="../assets/img/others/mother_home.png" alt="Type Room" class="app__view-img">
                        <div class="app__view-item-info">
                            <h4 class="app__view-item-title">Mother's Home</h4>
                            <span class="app__view-item-desc">6 Aug - 7 Aug • Ho Chi Minh City</span>
                            <span class="app__view-item-status app__view-item-status--active">Canceled</span>
                        </div>
                        <h3 class="app__view-item-price">US$21</h3>
                    </a>
                </div>
            `

            mainContent.innerHTML = html
            sidebarContent.style.height = '68vh'
        }
    })
})