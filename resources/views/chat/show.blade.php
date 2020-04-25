@extends('layouts.app')
@push('styles')
    <style>
      
    </style>
@endpush


@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Chat</div>

                <div class="card-body">
                    <div class="row p-2">
                        <div class="col-10">
                            <div class="row">
                                <div class="col-md-10 border-lg p-3">
                                    <ul class="unstyled overflow-auto" id="messages" style="heigth:45vh;">
                                       
                                    </ul>
                                </div>
                            </div>
                            <form action="">
                                <div class="row py-3">
                                    <div class="col-10">
                                        <input type="text" id="message" class="form-control" autocomplete="off">
                                    </div>
                                    <div class="col-2">
                                        <button class="btn btn-primary btn block" id="send">Send</button>
                                    </div>

                                </div>
                            </form>
                        </div>
                        <div class="col-md-2">
                            <p><strong>Online On</strong></p>
                            <ul style="heigth:45vh;" id="users" class="list-unstyled overflow-auto text-info">
                               
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
       let myList = document.getElementById('users');
       let messagesElement = document.getElementById('messages');
    //    console.log();
       
        
       Echo.join('chat')
            .here(users=>{

                console.log('here',users);

                users.forEach(user => {
                    let item = document.createElement('li')      
                    item.setAttribute('id',user.id)
                    item.innerText = user.name

                    myList.appendChild(item)

                });                 
            })
            .joining(users=>{

                console.log('joining',users);
                let item = document.createElement('li')      
                item.setAttribute('id',users.id)
                item.innerText = users.name

                myList.appendChild(item)
            })
            .leaving(user=>{
                console.log('leaving',user);
                let item = document.getElementById(user.id);
                item.parentNode.removeChild(item);
            })
            .listen('MessageSend',(e)=>{
                console.log(e);

                let item = `
                    <li id="${e.user.id}">  
                        <b>  ${e.user.name}: </b>  ${ e.message }
                    </li>
                `;
                messagesElement.innerHTML += item;

            })

    </script>

    <script>
        const sendElement = document.getElementById('send');
        const messageElement = document.getElementById('message');


        sendElement.addEventListener('click',(e)=>{
            e.preventDefault();

            // console.log('click me');

            window.axios.post('/chat',{
                message: messageElement.value
            })
            messageElement.value = "";
        })
    </script>
@endpush