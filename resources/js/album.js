/* let fileBtn = document.getElementById('file-upload'); */
let addBtn = document.getElementById('add-picture');
let popup = document.getElementById('pop_up');
let darkPopup = document.getElementById('dark_pop_up');
let closePopup = document.getElementById('close_pop_up');


/* addBtn.addEventListener('click', function(){

    fileBtn.click();
});
 */

addBtn.addEventListener('click', function(){
    popup.classList.add('show-pop-up');
});

darkPopup.addEventListener('click', function(){
    popup.classList.remove('show-pop-up');

})
closePopup.addEventListener('click', function(){
    popup.classList.remove('show-pop-up');
});
