const burger = () => {
    const btnBurger = document.querySelector('.burger')
    if(!btnBurger) return false
    const burger = document.querySelector('.burger-block')
    const burgerInner = document.querySelector('.burger__inner')
    const close = document.querySelector('.close')

    btnBurger.addEventListener('click', () => {
        burger.classList.add('burger_active')
        burgerInner.classList.add('burger__inner_active')
    })
    close.addEventListener('click', () => {
        burger.classList.remove('burger_active')
        burgerInner.classList.remove('burger__inner_active')
    })
    burger.addEventListener('click', (event) => {
        if(event.target === burger){
            burger.classList.remove('burger_active')
            burgerInner.classList.remove('burger__inner_active')
        }
    })
}

burger();