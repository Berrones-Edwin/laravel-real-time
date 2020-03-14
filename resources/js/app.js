require('./bootstrap');


Echo.private('notifications')
    .listen('UserSessionChanged', (e) => {

        // alert(e.message + " - " +e.type);

        // notifications
        
        const elementNotification = document.getElementById('notification');

        elementNotification.innerText = e.message;
        elementNotification.classList.remove('invisible');
        elementNotification.classList.remove('alert-danger');
        elementNotification.classList.remove('alert-success');

        elementNotification.classList.add(`alert-${e.type}`);

        // $('#hola').to
    });