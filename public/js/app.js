'use strict';



window.addEventListener('DOMContentLoaded',function(){

const del = document.getElementsByClassName("delete");
console.log(del)

for(let i = 0; i < del.length; i++){

    del[i].addEventListener('submit', e => {
    e.preventDefault();


        if (!confirm('削除しますか？')) {
            console.log('stop');
            return;
        }

        e.target.submit();
    });
    }
});

function ShowLength( str ) {
    document.getElementById("inputlength").innerHTML = str.length;
}

function modal_onclick_open(){
    document.getElementById("modal-content").style.display = "block";
    document.getElementById("modal-overlay").style.display = "block";
}

function modal_onclick_close(){
    document.getElementById("modal-content").style.display = "none";
    document.getElementById("modal-overlay").style.display = "none";
}

function edit_modal_onclick_open(){
    const editId = document.getElementById("edit").value;
    document.getElementById("edit-modal-content").style.display = "block";
    document.getElementById("edit-modal-overlay").style.display = "block";

    return editId;
}

function edit_modal_onclick_close(){
    document.getElementById("edit-modal-content").style.display = "none";
    document.getElementById("edit-modal-overlay").style.display = "none";
}

// const textarea = document.getElementById('body');
// textarea.addEventListener('keyup', onkeyup);

// function onKeyUp(){
//     return textLength = textarea.value;
// }

document.querySelector('textarea').addEventListener('input', () => {
    if(document.querySelector('textarea').value.length > 169){

        document.getElementById('inputlength').style.color = "red";
    }
    // document.getElementById('text').value.length
})


// document.getElementById('post').addEventListener('submit', e => {
//     e.preventDefault();




//     if (textLength > 200 || textLength == 0) {
//         console.log('aaa');
//         return;
//     }

//     e.target.submit();
// });
