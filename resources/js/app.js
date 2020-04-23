require('./bootstrap');

const elementNotification = document.getElementById('notification');
// console.log(elementNotification,'1')

// Echo.private('notifications')
//     .listen('UserSessionChanged', (e) => {

        
//         console.log(e)

//         elementNotification.innerText = e.message;
//         elementNotification.classList.remove('invisible');
//         elementNotification.classList.remove('alert-danger');
//         elementNotification.classList.remove('alert-success');

//         elementNotification.classList.add(`alert-${e.type}`);

//         console.log('mostrar msj')

//     });

Echo.private('notifications')
    .listen('UserSessionChanged', (e) => {

        // console.log(e)
        const elementNotification = document.getElementById('notification');

        elementNotification.innerText = e.message;

        elementNotification.classList.remove('invisible');
        elementNotification.classList.remove('alert-success');
        elementNotification.classList.remove('alert-danger');

        elementNotification.classList.add('alert-' + e.type);
    });