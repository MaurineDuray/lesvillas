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


// Simulation du coût //
const arrival = document.querySelector('#dateArrivee')
const departure = document.querySelector('#dateDepart')
const estimate = document.querySelector("#estimate")
const result = document.querySelector('.result p')
result.style.display="none"
const days = document.querySelector('#days')
const tarif = document.querySelector('#tarif')


estimate.addEventListener('click',(e)=>{
   const alert = document.querySelector("#alert")
   alert.style.color="red"
   var now = new Date()
   var date_arrival = new Date(arrival.value)
   var date_departure = new Date(departure.value)
   console.log(alert)
   console.log(result)
   
   console.log(price)
   if((date_arrival>date_departure) || (date_arrival < now) || (date_departure < now)){
      if(date_arrival>date_departure){
         alert.textContent='Veuillez sélectionner une date de départ postérieure à la date de votre arrivée!'
      }
      if(date_arrival < now){
         alert.textContent="Veuillez sélectionner une date postérieure à la date d'aujourd'hui pour date d'arrivée !"
      }
      if(date_departure < now){
         alert.textContent="Veuillez sélectionner une date postérieure à la date d'aujourd'hui pour date de départ !"
      }
   }else{
      var price = Number(document.querySelector('.prix').textContent)

      console.log(price)

      var nights = (date_departure.getTime()-date_arrival.getTime())
      var nights = Math.ceil(nights/(1000*60*60*24))
      
      console.log('nights=' + nights)
      result.style.display="block"

      total = price*nights
      
      days.textContent= nights +' '
      tarif.textContent= total + ' '
   }
})
