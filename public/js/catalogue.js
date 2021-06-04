function changePicture(id) {
    let active = document.getElementsByClassName('active');

    for (const key in active) {
        if (Object.hasOwnProperty.call(active, key)) {
            const element = active[key];
            element.classList.remove('active');
        }
    }

    event.target.parentNode.classList.add('active');
    document.getElementById(id).src = event.target.src;
}