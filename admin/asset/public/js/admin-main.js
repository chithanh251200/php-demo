// // xử lý xuất thông báo cho danh mục sản phẩm 

// const btnDelete = document.querySelectorAll('.btn-delete');
// const modalNotification = document.querySelector('.modal__notification');
// const dataDelete = document.querySelector('.count-index')

// const indexbtn = btnDelete.length;
// console.log(indexbtn)

// console.log(dataDelete)


// // btnDelete.forEach((item, index) => {
// //     console.log(item)

// //     item.onload = function(e) {
// //         console.log(123)
// //         e.preventDefault();
// //     }
// // })



// const index = dataDelete.getAttribute('data-deleteDefault');
// console.log(index);






// document.addEventListener('readystatechange', event => {

//     // When HTML/DOM elements are ready:
//     if (event.target.readyState === "interactive") { //does same as:  ..addEventListener("DOMContentLoaded"..
//         // alert("bắt đầu load");
//     }

//     // When window loaded ( external resources are loaded too- `css`,`src`, etc...) 
//     if (event.target.readyState === "complete") {
//         // alert("hi 2");
//         switch (index >= indexbtn) {
//             case index == indexbtn:
//                 modalNotification.classList.add('active_notification');
//                 console.log('hiện thông báo == index')
//                 break;
//             case index > indexbtn:
//                 modalNotification.classList.remove('active_notification');
//                 console.log('hiện thông báo')
//                     // // xóa thông báo trong khoảng thời gian 2s
//                 setTimeout(() => {
//                     modalNotification.classList.add('active_notification');
//                     console.log('ẩn thông báo');
//                 }, 1000);
//                 break;
//             case btnDelete.length == 0:
//                 modalNotification.classList.add('active_notification');
//                 console.log('hiện thông báo == 0')
//                 break;
//             default:
//                 modalNotification.classList.add('active_notification');

//         }

//     }
// });