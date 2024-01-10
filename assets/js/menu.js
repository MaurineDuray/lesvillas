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

    const sousmenu = document.querySelector('.sous-menu')
    const deroulant = document.querySelector('.deroulant')

    sousmenu.addEventListener('click',()=>{
        if(deroulant.getAttribute('open')==="open"){
            deroulant.style.display="none"
            deroulant.setAttribute("open", "noopen")
        }else{
            console.log('langage')
            deroulant.style.display="block"
            deroulant.setAttribute("open", "open")
        }
        
    })
