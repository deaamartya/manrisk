$(document).ready(function(){
    $('#tambah_perusahaan').on('click', function(){
        $('#judul_modal').html('Tambah Perusahaan')
        $('#formPerusahaan').attr('action', APP_URL+'/admin/perusahaan/store')
        var elements = document.getElementsByTagName("input");
        for (var i=0; i < elements.length; i++) {
            if (elements[i].type == "text") {
                elements[i].value = "";
            }
        }

        $('#tambahPerusahaan').modal('show')
    })

    $('.edit').on('click', function(){
        let id = $(this).attr('id').slice(5)
        $('#judul_modal').html('Edit Perusahaan')
        $('#formPerusahaan').attr('action', APP_URL+'/admin/perusahaan/store/'+id)
        var elements = document.getElementsByTagName("input");
        for (var i=0; i < elements.length; i++) {
            if (elements[i].type == "text") {
                elements[i].value = "";
            }
        }
        $.ajax({
            type: 'GET',
            url: APP_URL+'/admin/perusahaan/get-perusahaan/'+id,
            dataType: 'json',
            data: {},
            success: function (results) {
                $('#formCompanyCode').val(results.company_code)
                $('#formInstansi').val(results.instansi)

            },
            error:function(results){
                console.log(results);
            }
        });

        $('#tambahPerusahaan').modal('show')
    })

    $('.delete').on('click', function(){
        let id = $(this).attr('id').slice(7)

        $.ajax({
            type: 'GET',
            url: APP_URL+'/admin/perusahaan/get-perusahaan/'+id,
            dataType: 'json',
            data: {},
            success: function (results) {
                $('#id_perusahaan').val(results.company_id)
                $('#nama_perusahaan').html(results.instansi)

                $('#deletePerusahaan').modal('show')
            },
            error:function(results){
                console.log(results);
            }
        });
    })
})
