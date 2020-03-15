window.axios.get('api/users')
    .then((response) => {

        let myList = document.getElementById('users');
        let users = response.data.data;

        let item = "";
        users.forEach(user => {

            
            item += `
                <li id="${user.id}"> ${user.name} </li>
               `;
        });
        myList.innerHTML = item;


    });


Echo.channel('users')
    .listen('UserCreated', (e) => {

        let myList = document.getElementById('users');
        let item = document.createElement('li');

        item.setAttribute('id', e.user.id);
        item.innerText = e.user.name;

        console.log(item);
        

        myList.appendChild(item);

        console.log(myList);
        
    })
    .listen('UserUpdated', (e) => {
        let item = document.getElementById(e.user.id);
        item.innerText = e.user.name;
    })
    .listen('UserDeleted', (e) => {
        let item = document.getElementById(e.user.id);
        item.parentNode.removeChild(item);
    })