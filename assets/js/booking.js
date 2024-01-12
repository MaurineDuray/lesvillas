console.log('js')
   const btnBooking = document.querySelector('#booking')
   const formulaire = document.querySelector('.logementFormulaire')

   formulaire.style.display="none"

   btnBooking.addEventListener('click',()=>{
      console.log(formulaire)
      formulaire.style.display="block"
   })


//galerie
const pictures = document.querySelectorAll('.diapo')
pictures.forEach(picture=>{
   picture.addEventListener('click',()=>{

      const droite = document.querySelector('.arrow-right')
      const gauche = document.querySelector('.arrow-left')
      const diapo = document.querySelector('.containerGalery')
      const diapoimg = document.querySelector('.containerGalery img')
      const number = document.querySelectorAll('.diaporama img').length


      diapo.removeChild(diapoimg)
      var key = picture.getAttribute('key')
      if ((key == "00") || (key == 0)) {
         gauche.style.display="none"
         droite.style.display="flex"
      }
      if(key == number){
         droite.style.display="none"
      }
      if ((key > 0) && (key < number)) {
         gauche.style.display="flex"
         droite.style.display="flex"
      }
      var newImg = document.createElement('img');
      newImg.setAttribute('src', picture.getAttribute('src'))
      newImg.setAttribute('key', key)
      diapo.appendChild(newImg)


   })
})


const droite = document.querySelector('.arrow-right')
const gauche = document.querySelector('.arrow-left') 
const number = document.querySelectorAll('.diaporama img').length
const diapoimg = document.querySelector('.containerGalery img')

if(diapoimg.getAttribute('key') == 0){
   gauche.style.display="none"
}else{
   gauche.style.display="flex"
}

if(number === 0){
   gauche.style.display="none"
   droite.style.display="none"
}

droite.addEventListener('click',()=>{
   var test = number-1
   const diapo = document.querySelector('.containerGalery')
   const diapoimg = document.querySelector('.containerGalery img')
   const oldKey = diapoimg.getAttribute('key')
   const newKey = parseInt(oldKey) + 1
      if((diapoimg.getAttribute('key') < 0) && (diapoimg.getAttribute('key') == 0)){
         gauche.style.display="none"
      }else{
         gauche.style.display="flex"
      }
      if((newKey == 0)||(newKey == "00")){
         gauche.style.display="none"
      }
      diapo.removeChild(diapoimg)
      var src = document.querySelector('[key="0' + newKey + '"]').getAttribute('src');

      var Image = document.createElement('img');
      Image.setAttribute('src', src)
      Image.setAttribute('key', newKey)
      diapo.appendChild(Image)

      console.log(newKey)
      console.log(diapoimg.getAttribute('key'))

      if(diapoimg.getAttribute('key') >= number - 2 ){
         droite.style.display="none"
      }else{
         droite.style.display="flex"
      }
      
      
})

gauche.addEventListener('click',()=>{
   console.log("gauche")
   const diapo = document.querySelector('.containerGalery')
   const diapoimg = document.querySelector('.containerGalery img')
   const oldKey = diapoimg.getAttribute('key')
   const newKey = parseInt(oldKey) - 1
   
      if(diapoimg.getAttribute('key') < number ){
        
      }else{
         gauche.style.display="flex"
         console.log('gauche disparait')
      }

      diapo.removeChild(diapoimg)
      var src = document.querySelector('[key="0' + newKey + '"]').getAttribute('src');

      var Image = document.createElement('img');
      Image.setAttribute('src', src)
      Image.setAttribute('key', newKey)
      diapo.appendChild(Image)
      console.log("number: "+number)

      if((newKey == 0)||(newKey == "00")){
         gauche.style.display="none"
      }

      
   
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


const btnbooking = document.querySelector('#reservation_submit')
const arrivalbooking = document.querySelector('#reservation_arrival')
const departurebooking = document.querySelector('#reservation_departure')



btnbooking.addEventListener('click',()=>{
   const alertdate = document.querySelector('.alertdate')
   alertdate.style.color="red"
   const date_arrivalbooking = new Date(arrivalbooking.value)
   const date_departurebooking = new Date(departurebooking.value)
   var date_actual = new Date()
   console.log(date_arrivalbooking)
   console.log(date_departurebooking)

   if((date_arrivalbooking>date_departurebooking) || (date_arrivalbooking < date_actual) || (date_departurebooking < date_actual)){
      if(date_arrivalbooking>date_departurebooking){
         alertdate.textContent='Veuillez sélectionner une date de départ postérieure à la date de votre arrivée! / Please select a departure date that is after your arrival date! / ¡Por favor, selecciona una fecha de salida posterior a tu fecha de llegada!'
      }
      if(date_arrivalbooking < date_actual){
         alertdate.textContent="Veuillez sélectionner une date postérieure à la date d'aujourd'hui pour date d'arrivée ! / Please select a date for arrival that is after today's date! / ¡Por favor, selecciona una fecha de llegada posterior a la fecha de hoy!"
      }
      if(date_departurebooking < date_actual){
         alertdate.textContent="Veuillez sélectionner une date postérieure à la date d'aujourd'hui pour date de départ ! / Please select a departure date that is after today's date! / Por favor, selecciona una fecha de salida posterior a la fecha de hoy.</p>"
      }
   }

})