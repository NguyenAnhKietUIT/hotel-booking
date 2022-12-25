const boxMessage = document.querySelector('.app__inbox-message')
const itemMessages = document.querySelectorAll('.app__inbox-item')

function showBoxSend() {
    const btnReply = document.querySelector('.app__inbox-message-reply')
    const boxSend = document.querySelector('.app__inbox-message-send')

    btnReply.addEventListener('click', () => {
        boxSend.style.display = 'flex'
    })
}

function loadMessage(usernameSend, usernameReceive, role) {
    itemMessages.forEach(element => {
        element.addEventListener('click', () => {
            element.style.backgroundColor = 'white'

            let html = ""

            html += `
                    <div class="app__inbox-message-header">
                        <p class="px-3 py-2 app__inbox-message-title">${element.querySelector('.app__inbox-item-title').textContent}</p>
                        <button class="me-3 px-3 app__inbox-message-reply">Reply</button>
                    </div>

                    <div class="px-3 py-2 d-flex flex-column justify-content-between" style="height: calc(100vh - 56px);">
                        <p class="app__inbox-message-main">${element.querySelector('.app__inbox-item-content').textContent}</p>

                        <form action="../php/HandleAnother.php?Insert=1&role=${role}" method="POST" class="justify-content-between app__inbox-message-send">
                            <input type="text" hidden value="${usernameSend}" name="usernameSend" >
                            <input type="text" hidden value="${usernameReceive}" name="usernameReceive" >
                            <textarea name="app__inbox-message-textarea" id="app__inbox-message-textarea" cols="30" rows="8" placeholder="Enter message"></textarea>
                            <input type="submit" value="Send" class="app__inbox-message-input px-3">
                        </form>
                    </div>
                    `

            boxMessage.innerHTML = html;

            showBoxSend()

        })
    })
}