$(document).ready(function(){
    var interval = null
    $('.realisasi').on('keyup', function(){
        var id = $(this).attr('id')
        var val = $(this).val()

        clearInterval(interval)
        interval = setInterval(function(){
            $.ajax({
                type: 'PUT',
                url: APP_URL+'/admin/approval-hasil-mitigasi/persetujuan-mitigasi/'+id,
                dataType: 'json',
                data: {
                    'realisasi' : val
                },
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Data berhasil diperbarui.',
                        showConfirmButton: false,
                        timer: 2000
                    });
                },
                error:function(data){
                    console.log(data);
                }
            });

            clearInterval(interval)
        }, 2000)
    })

    $('.approve').on('click', function(){
        let id = $(this).attr('id')

        $.ajax({
            type: 'PUT',
            url: APP_URL+'/admin/approval-hasil-mitigasi/approve/'+id,
            dataType: 'json',
            data: {
                'id' : id
            },
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (data) {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Data berhasil disetujui.',
                    showConfirmButton: false,
                    timer: 2000
                });
                $('#'+id).remove()
            },
            error:function(data){
                console.log(data);
            }
        });
    })
})
