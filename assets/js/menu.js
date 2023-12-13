const body = document.body

    const burger = document.querySelector(".burger")
    const menuResponsive = document.querySelector('#menuResponsive')

    const items = document.querySelectorAll('#menuResponsive ul li')
    console.log(items)

    // gestion du menu burger 
    burger.addEventListener('click', function(){
        console.log('burger')
        menuResponsive.classList.toggle("open")
    })

    // gestion de changement de pages menu 
    items.forEach(item=>{
        item.addEventListener('click',function(){
            console.log('menu')
            menuResponsive.classList.remove("open")
        })
    })