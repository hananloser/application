$('.tombol-hapus').on('click', function (e) {
    e.preventDefaut();
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Something went wrong!',
        footer: '<a href>Why do I have this issue?</a>'
    })
});