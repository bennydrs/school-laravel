$(document).ready(function () {
    $('.delete').on('click', function (e) {

        e.preventDefault();
        const form = $(this).attr('action');

        Swal.fire({
            title: 'Apa kamu yakin?',
            text: "Data siswa dan user ini akan hilang!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.value) {
                $('.delete').submit();
            }
        })
    });
});
