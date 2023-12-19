console.log('js')
   const btnBooking = document.querySelector('#booking')
   const formulaire = document.querySelector('.logementFormulaire')

   formulaire.style.display="none"

   btnBooking.addEventListener('click',()=>{
      console.log(formulaire)
      formulaire.style.display="block"
   })



const pictures = document.querySelectorAll('.diapo')
pictures.forEach(picture=>{
   picture.addEventListener('click',()=>{
      const diapo = document.querySelector('.containerGalery')
      const diapoimg = document.querySelector('.containerGalery img')
      console.log(diapoimg)
      diapo.removeChild(diapoimg)
      console.log(picture)
      var newImg = document.createElement('img');
      newImg.setAttribute('src', picture.getAttribute('src'))
      diapo.appendChild(newImg)
   })
})

