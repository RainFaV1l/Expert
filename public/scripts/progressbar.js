const progressbar = () => {
    const progressbar = document.querySelector('.progressbar')
    if(!progressbar) return false
    const progressbarInner = progressbar.querySelector('.progressbar-inner')
    const procentProgressbar = document.querySelector('.procent-progressbar')

    const activeBtns = document.querySelectorAll('.btn-kritery_active')
    const kriteryBtns = document.querySelectorAll('.btn-kritery')
    const widthProcent = 100

    const lengthArr = kriteryBtns.length
    const addWidth = widthProcent/lengthArr

    const lengthArrActive = activeBtns.length
    const addWidthActive = widthProcent/lengthArrActive

    const addWidthRound = Math.round(addWidth)


    const move = () => {
        let width = 0

        width += addWidthRound * lengthArrActive
        progressbarInner.style.width = width + '%'
        procentProgressbar.innerHTML = width * 1 + '%'

    }

    move()
}

progressbar();