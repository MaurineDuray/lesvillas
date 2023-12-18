const alert = document.querySelectorAll('.alert')
const okflash = document.querySelectorAll('.okeFlash')
if (alert) {
    setTimeout(alertdelete,25000)
}   
okflash.forEach(e=>{
    e.addEventListener('click',()=>{
        alertdelete()
    })
   
})
function alertdelete(){
    alert.forEach(element => {
        element.style.display= "none"
    });
}