function mainFunction() {
    const mainContent = document.querySelector('.app__content .col-9')
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
                viewAllBookings()
            } else if (element.innerHTML === 'Favourites') {
                viewFavorites()
            }
        })
    })

    function viewAllBookings() {
        let upcomingAPI = "";
        let pastAPI = "";
        let html = "";
        let flag = false;

        fetch (upcomingAPI)
            .then(function(response){
                return response.json();
            })
            .then(function(upcomings){
                if (upcomings.length > 0) {
                    flag = true;

                    html += `
                    <h2 class="app__view-message">Your bookings</h2>

                    <div class="app__view-list">
                        <h3 class="app__view-title">Upcoming</h3>
                    `;

                    html += upcomings.map(function(upcoming){
                        return `
                            <a href="#" class="app__view-item">
                                <img src="${upcoming.img}" alt="Type Room" class="app__view-img">
                                <div class="app__view-item-info">
                                    <h4 class="app__view-item-title">${upcoming.title}</h4>
                                    <span class="app__view-item-desc">${upcoming.desc}</span>
                                </div>
                                <h3 class="app__view-item-price">${upcoming.price}</h3>
                            </a>
                        `
                    }).join('');

                    html += `</div>`;
                }
            })
            .catch(function (err) {
                alert(err.message);
            });

        fetch (pastAPI)
            .then(function(response){
                return response.json();
            })
            .then(function(pasts){
                if (pasts.length > 0) {
                    flag = true;

                    html += `
                    <div class="app__view-list app__view-list-status">
                        <h3 class="app__view-title">In the past</h3>
                    `;

                    html += pasts.map(function(past) {
                        return `
                            <a href="#" class="app__view-item">
                                <img src="${past.img}" alt="Type Room" class="app__view-img">
                                <div class="app__view-item-info">
                                    <h4 class="app__view-item-title">${past.title}</h4>
                                    <span class="app__view-item-desc">${past.desc}</span>
                                    <span class="app__view-item-status ${(past.status === 'canceled') ? "app__view-item-status--active" : ""}">${past.status}</span>
                                </div>
                                <h3 class="app__view-item-price">${past.price}</h3>
                            </a>
                        `
                    }).join('');

                    html += `</div>`;
                }
            })
            .catch(function (err) {
                alert(err.message);
            });


        if (!flag) {
            html += `
                    <span class="app__view-message">You have no bookings yet.</span>
                    <a href="../html/Homepage.html" class="app__view-link">Start exploring</a>
                    `;
        }

        mainContent.innerHTML = html
    }

    function viewFavorites() {
        let favouriteAPI = "";
        let html = "";

        fetch (favouriteAPI)
            .then(function (response) {
                return response.json();
            })
            .then(function(favourites){
                if (favourites.length > 0) {
                    html += `
                            <div class="app__view-list app__view-list-status">
                                <h3 class="app__view-title">Your favourites</h3>
                            `;
        
                    html += favourites.map(function(favourite) {
                        return `
                            <a href="#" class="app__view-item">
                                <img src="${favourite.img}" alt="Type Room" class="app__view-img">
                                <div class="app__view-item-info">
                                    <h4 class="app__view-item-title">${favourite.title}</h4>
                                    <span class="app__view-item-desc">${favourite.desc}</span>
                                    <span class="app__view-item-status">${favourite.view}</span>
                                </div>
                                <h3 class="app__view-item-price">${favourite.price}</h3>
                            </a>
                        `
                    }).join('');
        
                    html += `</div>`;
                } else {
                    html += `
                        <div class="app__favourite-none">
                            <i class="app__favourite-none-icon fa-regular fa-heart"></i>
                            <span class="app__favourite-none-title">Save your favourites</span>
                            <p class="app__favourite-none-desc">
                                When you find something you like, use the heart to </br> 
                                save your favourites and you can find it again here.
                            </p>
                        </div>
                    `
                }
            })
            .catch(function (err) {
                alert(err.message);
            });

        mainContent.innerHTML = html
    }
}

function editDetails() {
    const information = document.querySelectorAll('.form-control.edit-active')
    const btnEditDetails = document.querySelector('.form-edit')
    const btnAccept = document.querySelector('.btn-accept')
    const avatarImg = document.querySelector('.app__main-img')
    const avatarInput = document.getElementById('app__main-input-img')

    btnEditDetails.addEventListener('click', (e) => {
        e.preventDefault()
        btnEditDetails.style.display = 'none'
        btnAccept.style.display = 'block'

        avatarInput.disabled = false;
        information.forEach(element => {
            element.disabled = false;
        })
    })

    btnAccept.addEventListener('click', () => {
        avatarInput.disabled = true;
        information.forEach(element => {
            element.disabled = true;
        })

        btnEditDetails.style.display = 'block'
        btnAccept.style.display = 'none'
    })

    avatarInput.addEventListener('change', (event) => {
        avatarImg.src = URL.createObjectURL(event.target.files[0]);
    })
}

mainFunction()

editDetails()