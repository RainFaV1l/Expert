const accordion = () => {
    const accordion = document.querySelector('.description-accordion')
    if(!accordion) return false
    const description = document.querySelector('.description__conkurs')
    const imgAccordion = document.querySelector('.description-accordion img')

    accordion.addEventListener('click', () => {
        imgAccordion.classList.toggle('imgActive')
        description.classList.toggle('description_active')
    })
}

accordion();