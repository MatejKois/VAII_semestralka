let scroll_to_bottom = document.getElementById('chatwindow');
scroll_to_bottom.scrollTop = scroll_to_bottom.scrollHeight;

//https://css-tricks.com/books/greatest-css-tricks/pin-scrolling-to-bottom/

// let mouseIn = true;
//
// function adHighlight() {
//     let items = document.getElementsByClassName("card");
//
//     for (let item of items) {
//         item.addEventListener('mouseover', function() {
//             mouseIn = true;
//             changeColor(255, this);
//         });
//
//         item.addEventListener('mouseout', function() {
//             mouseIn = false;
//             this.style.backgroundColor = "white";
//         });
//     }
// }
//
// function changeColor(i, item) {
//     if (i <= 180 || !mouseIn) {
//         return;
//     }
//
//     item.style.backgroundColor = 'rgb(' + i + ', ' + i + ', ' + i + ')';
//
//     setTimeout(function () {
//         changeColor(--i, item);
//     }, 1);
// }
//
// window.onload = adHighlight;
