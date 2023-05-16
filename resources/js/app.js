import './bootstrap';
import '../css/app.css'; 
import { transform } from 'lodash';





// // message
// const message_sent = document.getElementById('msg');
// // sender image 
// const sender_img = document.getElementById('senderimg');



// message_submit.addEventListener('click', function(e){
//     e.preventDefault();

   
     
//     let has_errors = false;

//     if(message_input.value == '')
//     {
//         alert("please enter your message first");
//         has_errors = true;
//     }
    
//     if(has_errors)
//     {
//         return;
//     }
    
//     const options = {
//         method: 'post',
//         url: "send-message/1",
//         data: {
//             message: message_input.value
//         }
//     }

//     // console.log(message_input.value);
    
//     transformResponse:[(data) => {
//         return data;
//     }]

//     axios(options);

// });


// window.Echo.channel("<?php echo auth()->user()->pusher_channel ?>").listen("App\Events\ChatEvent", (e)=> {
//         alert("in listen now"); 
//         console.log(e.data); 
//         // sender_img.innerHTML.src += "{{ asset('uploads/"+ e.sender_data.userable.profile_image +') }}';
//         message_sent.innerHTML += ' <p> ' + e.data.message + '</p>';
        

//             // addMessageToList(e.message);
//             // alert("in listen now");
//             // console.log(e);
//         });

// window.Echo.channel("new-channel").listen('.message', (e)=> {
//     // message_sent.innerHTML += '<div class="message"><strong>username : ' + e.username + ' </strong>'+ '<br>' +'message: ' + e.message + '</div>';
//         // addMessageToList(e.message);
//         alert("in listen now");
//         message_sent.innerHTML = ' <p> ' + e.data.message + '</p>';
//         console.log(e);
//     });


// window.Echo.channel("new-channel").listen('.message', (e)=> {
//     // alert("in listen now"); 
//     console.log(e.data); 
//     message_sent.innerHTML += ' <p> ' + e.data.message + '</p>';
//     // sender_img.innerHTML += ' <img src=" {{ asset('+ "'frontend-assets/images/"+e.sender_data.userable.profile_image+"'"+' ) }} "></img> ';
//         // addMessageToList(e.message);
//         // alert("in listen now");
//         // console.log(e);
//     });

// function addMessageToList(message) {
//     const newLi = `<li class="list-group-item">${message}</li>`;
//     $("#messagesList").prepend(newLi);
//     }