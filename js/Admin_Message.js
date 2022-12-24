const checkboxSelectAll = document.getElementById('nav-select-all')
const checkboxMessage = document.querySelectorAll('.message-select')
const messageTrash = document.querySelectorAll('.message-trash')
const starNone = document.querySelectorAll('.message-icon')
const starActive = document.querySelectorAll('.message-icon-active')
const boxMessage = document.querySelectorAll('.table')
const buttonDelete = document.querySelector('.nav-message-delete')
const boxListMessage = document.querySelector('.box-list-message')
const listMessage = document.querySelectorAll('.table tr')

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

function deleteMessageChecked() {
    buttonDelete.addEventListener('click', () => {
        checkboxMessage.forEach(element => {
            if (element.checked) {
                element.parentElement.parentElement.remove()
            }
        })
    })
}

function handleReplyBox() {
    const buttonReply = document.querySelector('.btn-reply')
    const replyBox = document.querySelector('.message-home__form')
    const deleteBoxReply = document.querySelector('.message-home__delete')

    buttonReply.addEventListener('click', () => {
        replyBox.style.display = 'block'
    })

    deleteBoxReply.addEventListener('click', () => {
        replyBox.style.display = 'none'
    })
}

function watchMessage() {
    listMessage.forEach(element => {
        element.getElementsByTagName("td")[2].addEventListener('click', () => {
            boxListMessage.style.display = 'none'

            let container = document.querySelector('.content-wrapper')
            let html = ""

            html += `
                    <div class="message-home">
                        <nav class="message-home__nav m-3">
                            <span>
                                <i class="message-home__back fa-solid fa-arrow-left"></i>
                            </span>

                            <span>${element.querySelector('.message-title').textContent}</span>
                        </nav>

                        <div class="message-home__main m-3">
                            <span>${element.getElementsByTagName("td")[2].textContent}</span>
                            <p>${element.querySelector('.message-content').textContent}</p>
                        </div>
                            
                        <div class="message-home__reply">
                            <button class="btn-reply ms-3">
                                <i class="fa-solid fa-reply"></i>
                                Reply
                            </button>
                                    
                            <div class="message-home__form">
                                <form action="" method="" id="message-form">
                                    <p>${element.getElementsByTagName("td")[2].textContent}</p>
                                    <input type="text" name="message-home__subject" id="message-home__subject" placeholder="Subject">
                                    <textarea name="message-home__content" id="" cols="30" rows="6" placeholder="Your message"></textarea>
                                    <div class="message-home__action">
                                        <input type="submit" value="Send" id="message-home__submit">
                                        <span class="message-home__delete">
                                            <i class="fa-solid fa-trash"></i>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    `
            container.innerHTML = html

            handleReplyBox()
            backAdminMessage()
        })
        element.getElementsByTagName("td")[3].addEventListener('click', () => {
            boxListMessage.style.display = 'none'

            let container = document.querySelector('.content-wrapper')
            let html = ""

            html += `
                    <div class="message-home">
                        <nav class="message-home__nav m-3">
                            <span>
                                <i class="message-home__back fa-solid fa-arrow-left"></i>
                            </span>

                            <span>${element.querySelector('.message-title').textContent}</span>
                        </nav>

                        <div class="message-home__main m-3">
                            <span>${element.getElementsByTagName("td")[2].textContent}</span>
                            <p>${element.querySelector('.message-content').textContent}</p>
                        </div>
                            
                        <div class="message-home__reply">
                            <button class="btn-reply ms-3">
                                <i class="fa-solid fa-reply"></i>
                                Reply
                            </button>
                                    
                            <div class="message-home__form">
                                <form action="" method="" id="message-form">
                                    <p>${element.getElementsByTagName("td")[2].textContent}</p>
                                    <input type="text" name="message-home__subject" id="message-home__subject" placeholder="Subject">
                                    <textarea name="message-home__content" id="" cols="30" rows="6" placeholder="Your message"></textarea>
                                    <div class="message-home__action">
                                        <input type="submit" value="Send" id="message-home__submit">
                                        <span class="message-home__delete">
                                            <i class="fa-solid fa-trash"></i>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    `
            container.innerHTML = html

            handleReplyBox()
            backAdminMessage()
        })
    })
}

function backAdminMessage() {
    const backHome = document.querySelector('.message-home__back')
    const messageHome = document.querySelector('.message-home')

    backHome.addEventListener('click', () => {
        //render message
        location.reload()
    })
}

selectAll()
starMessage()
selectMessage()
deleteMessageChecked()
watchMessage()