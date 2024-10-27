//PWA 앱 설치 유도
document.addEventListener('DOMContentLoaded', function () {
    const overlay = document.querySelector('.overlay');
    const hideButton = document.querySelector('#hideButton');

    function isPWA() {
        return window.matchMedia('(display-mode: standalone)').matches || window.navigator.standalone === true;
    }

    const now = new Date().getTime();
    const hideExpiration = localStorage.getItem('overlayHideExpiration');

    if (isPWA()) {
        document.querySelectorAll('.overlay, .pwa-app').forEach(function (element) {
            element.style.display = 'none';
        });
    } else {
        if (hideExpiration && now < hideExpiration) {
            overlay.style.display = 'none';
        } else {
            overlay.style.display = 'flex';
        }

        hideButton.addEventListener('click', function () {
            overlay.style.display = 'none';
            const expirationTime = now + (24 * 60 * 60 * 1000);
            localStorage.setItem('overlayHideExpiration', expirationTime);
        });
    }
});

// 비동기처리
document.addEventListener("DOMContentLoaded", function () {
    fetch("get_lunch.php")
        .then(response => response.text())
        .then(data => {
            document.getElementById("lunch-info").innerHTML = data;
        });

    fetch("get_timetable.php")
        .then(response => response.text())
        .then(data => {
            document.getElementById("timetable-info").innerHTML = data;
        });
});