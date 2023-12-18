
const pictures = document.querySelectorAll('.diapo')
const diapo = document.querySelectorAll('.diaporama')

pictures.forEach(picture=>{
    picture.addEventListener('click',()=>{
        console.log('galery')
    })
})