let btnShow = document.querySelector('#update-btn');

btnShow.addEventListener('click', () => {
    swal({
        title: 'My Title',
        text: 'Hello World',
        icon: 'success',
        button: 'Custom Button'
    });
});