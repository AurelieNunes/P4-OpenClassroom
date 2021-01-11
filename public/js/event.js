const modal = document.getElementById('modal');
const buttonModal = document.getElementById('btnModal');
const closeBtn = document.getElementById('closeBtn');
console.log(modal)

buttonModal.addEventListener("click", ()=>{
    console.log('ok')
    modal.style.display="block";
})

closeBtn.addEventListener("click", ()=> {
    modal.style.display="none";
})


