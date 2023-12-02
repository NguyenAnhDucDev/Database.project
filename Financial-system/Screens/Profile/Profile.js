function VisiblePass(classe1, classe2) {
    document.getElementsByClassName(classe1)[0].style.display = 'inline-block'
    document.getElementsByClassName(classe2)[0].style.display = 'none'
    if(classe1 === 'visibleBtn') {
        document.getElementById('passString').style.display = 'none'
        document.getElementById('passStringOpen').style.display = 'inline-block'
    } else if(classe1 === 'nVisibleBtn') {
        document.getElementById('passStringOpen').style.display = 'none'
        document.getElementById('passString').style.display = 'inline-block'
    }
}