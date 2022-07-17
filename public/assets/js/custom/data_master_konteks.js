$(document).ready(function(){
    $.ajax({
        type: 'GET',
        url: APP_URL+'/admin/risiko/get-risiko',
        dataType: 'json',
        data: {},
        success: function (results) {
            $('#formIdRisk').empty();
            // $('#formIdRisk').append('<option selected disabled>Pilih resiko . . </option>');
            for(let i=0;i<results.length;i++){
                $('#formIdRisk').append(
                    '<option value="'+results[i].id_risk+'" id="option'+results[i].id_risk+'">'+results[i].id_risk+' - '+results[i].risk+'</option>'
                );
            }
        },
        error:function(results){
            console.log(results);
        }
    });

    $('#tambah_konteks').on('click', function(){
        $('#judul_modal').html('Tambah Konteks')
        $('#formKonteks').attr('action', APP_URL+'/admin/konteks/store')
        $('#formIdRisk').find('option:selected').removeAttr('selected').trigger('change')
        var elements = document.getElementsByTagName("input");
        for (var i=0; i < elements.length; i++) {
            if (elements[i].type == "text") {
                elements[i].value = "";
            }
        }
        $('#formIsiKonteks').val('')

        $('#tambahKonteks').modal('show')
    })

    $('.edit').on('click', function(){
        let id = $(this).attr('id').slice(5)
        $('#judul_modal').html('Edit Konteks')
        $('#formKonteks').attr('action', APP_URL+'/admin/konteks/store/'+id)
        var elements = document.getElementsByTagName("input");
        for (var i=0; i < elements.length; i++) {
            if (elements[i].type == "text") {
                elements[i].value = "";
            }
        }
        $.ajax({
            type: 'GET',
            url: APP_URL+'/admin/konteks/get-konteks/'+id,
            dataType: 'json',
            data: {},
            success: function (results) {
                $('#formIdRisk').find('option:selected').removeAttr('selected')
                $('#formIdRisk option#option'+results.id_risk).attr('selected', 'selected').trigger('change')
                $('#formNo').val(results.no_k)
                $('#formTahunKonteks').val(results.tahun_konteks)
                $('#formIsiKonteks').val(results.konteks)

            },
            error:function(results){
                console.log(results);
            }
        });

        $('#tambahKonteks').modal('show')
    })

    $('.delete').on('click', function(){
        let id = $(this).attr('id').slice(7)

        $.ajax({
            type: 'GET',
            url: APP_URL+'/admin/konteks/get-konteks/'+id,
            dataType: 'json',
            data: {},
            success: function (results) {
                $('#id_konteks').val(results.id_konteks)
                $('#nama_konteks').html(results.konteks)

                $('#deleteKonteks').modal('show')
            },
            error:function(results){
                console.log(results);
            }
        });
    })
})
