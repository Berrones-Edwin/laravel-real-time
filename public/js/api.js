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

        
    })