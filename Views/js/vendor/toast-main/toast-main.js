let lib_url = "http://localhost/billingApp/Views/js/vendor/toast-main"




function quitToast(newToast) {
    newToast.classList.add("active")
    setTimeout(() => {
        newToast.parentElement.remove()
    }, 310);
}

function createToast(type, icon, title, text, isTimeOut, timer, top, isDark) {
    let notifications = document.querySelector('.notifications_toasts');

    notifications.style.top = top

    if (notifications.childElementCount < 5) {
        let newToast = document.createElement('div');


        if (isDark == true) {
            newToast.style.setProperty("--bg_color", "rgb(34, 36, 47)")
            newToast.style.color = "white"
        } else {
            newToast.style.setProperty("--bg_color", "rgb(245, 245, 245)")
            newToast.style.color = "black"
        }

        newToast.innerHTML = `
            <div class="toast ${type}" style="--pos:'${(notifications.childElementCount + 1) * 20}%';">
                <div class='dec_bar' style='position: absolute;'></div>
                <i><img style='width:30px;' src='${lib_url}/icons/${icon}'></i>
                <div class="content">
                    <div class="title">${title}</div>
                    <span>${text}</span>
                </div>
                <i class="xmark" onclick="quitToast(this.parentElement)"><img style='width:25px;' src='${lib_url}/icons/xmark-solid.svg'></i>
                <div class="progress_bar"></div>
            </div>`;

        notifications.appendChild(newToast);



        let progress_bar = newToast.querySelector(".progress_bar")

        if (isTimeOut == true) {
            progress_bar.classList.add("active")

            progress_bar.style.setProperty("--time_animation", timer + "s")

            newToast.timeOut = setTimeout(() => {
                quitToast(newToast.firstElementChild)

            }, (timer * 1000))
        } else {
            progress_bar.classList.remove("active")
        }
    }
}

document.addEventListener("DOMContentLoaded", () => {
    const body = document.querySelector("body")

    const div_notifications = document.createElement("div")

    div_notifications.classList.add("notifications_toasts")

    body.appendChild(div_notifications)

})

function createSuccessToast(title, text, isTimeOut = true, timer = 5, top = "30px", isDark = true) {
    let type = 'success';
    let icon = 'circle-check-solid.svg';
    createToast(type, icon, title, text, isTimeOut, timer, top, isDark);
}

function createErrorToast(title, text, isTimeOut = true, timer = 5, top = "30px", isDark = true) {
    let type = 'error';
    let icon = 'circle-exclamation-solid.svg';
    createToast(type, icon, title, text, isTimeOut, timer, top, isDark);
}

function createWarningToast(title, text, isTimeOut = true, timer = 5, top = "30px", isDark = true) {
    let type = 'warning';
    let icon = 'triangle-exclamation-solid.svg';
    createToast(type, icon, title, text, isTimeOut, timer, top, isDark);
}

function createInfoToast(title, text, isTimeOut = true, timer = 5, top = "30px", isDark = true) {
    let type = 'info';
    let icon = 'circle-info-solid.svg';
    createToast(type, icon, title, text, isTimeOut, timer, top, isDark);
}

