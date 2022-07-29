$(document).ready(function() {
    // var interval = null
    // $('.realisasi').on('keyup', function(){
    //     var id = $(this).attr('id')
    //     var val = $(this).val()

    //     clearInterval(interval)
    //     interval = setInterval(function(){
    //         $.ajax({
    //             type: 'PUT',
    //             url: APP_URL+'/admin/approval-hasil-mitigasi/persetujuan-mitigasi/'+id,
    //             dataType: 'json',
    //             data: {
    //                 'realisasi' : val
    //             },
    //             headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    //             success: function (data) {
    //                 Swal.fire({
    //                     position: 'center',
    //                     icon: 'success',
    //                     title: 'Berhasil!',
    //                     text: 'Data berhasil diperbarui.',
    //                     showConfirmButton: false,
    //                     timer: 2000
    //                 });
    //             },
    //             error:function(data){
    //                 console.log(data);
    //             }
    //         });

    //         clearInterval(interval)
    //     }, 2000)
    // })

    $('.approve').on('click', function() {
        let id = $(this).attr('id').slice(8)
        let total_realisasi = $('#realisasi_' + id).val()

        $.ajax({
            type: 'PUT',
            url: APP_URL + '/admin/approval-hasil-mitigasi/approve/' + id,
            dataType: 'json',
            data: {
                'id': id,
                'realisasi': total_realisasi
            },
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(data) {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Data berhasil disetujui.',
                    showConfirmButton: false,
                    timer: 2000
                });
                $('#' + id).attr('readonly', true)
                $('#approve_' + id).remove()
                $('#not_approve_' + id).remove()
                if (headers == 0) {
                    $('#status_h_indhan_0').remove()
                    $('#status_h_indhan').append('<span class="badge badge-success" id="status_h_indhan_1"><i class="fa fa-check"></i> Approved Admin</span>')
                }
                $('#realisasi_' + id).remove()
                $('#data_realisasi').html(total_realisasi)
            },
            error: function(data) {
                console.log(data);
            }
        });
    })

    $('.not-approve').on('click', function() {
        let id = $(this).attr('id').slice(8)
        let total_realisasi = $('#realisasi_' + id).val()

        $.ajax({
            type: 'PUT',
            url: APP_URL + '/admin/approval-hasil-mitigasi/not-approve/' + id,
            dataType: 'json',
            data: {
                'id': id,
                'realisasi': total_realisasi
            },
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(data) {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Data berhasil tidak disetujui.',
                    showConfirmButton: false,
                    timer: 2000
                });
                $('#' + id).attr('readonly', true)
                $('#approve_' + id).remove()
                $('#not_approve_' + id).remove()
                if (headers == 0) {
                    $('#status_h_indhan_0').remove()
                    $('#status_h_indhan').append('<span class="badge badge-danger" id="status_h_indhan_2"><i class="fa fa-close"></i>Not Approved Admin</span>')
                }
                $('#realisasi_' + id).remove()
                $('#data_realisasi').html(total_realisasi)
            },
            error: function(data) {
                console.log(data);
            }
        });
    })
})