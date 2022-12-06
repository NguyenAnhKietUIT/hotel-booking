const buttonEditStatus = document.querySelectorAll('.btn.btn-info')

function enableEdit() {
    buttonEditStatus.forEach(element => {
        element.addEventListener('click', () => {
            let btnSuccess = element.parentElement.querySelector('.btn.btn-success');
            btnSuccess.disabled = false;
            element.disabled = true;

            let status = element.parentElement.parentElement.getElementsByTagName("td")[5].querySelector('select[name="select-status"]')
            status.disabled = false

            btnSuccess.addEventListener('click', () => {
                btnSuccess.disabled = true;
                element.disabled = false;
                status.disabled = true;
            });
        })
    })
}

enableEdit()