console.log('js')
   const btnBooking = document.querySelector('#booking')
   const formulaire = document.querySelector('.logementFormulaire')

   formulaire.style.display="none"

   btnBooking.addEventListener('click',()=>{
      console.log(formulaire)
      formulaire.style.display="block"
   })