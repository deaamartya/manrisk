$(document).ready(function(){
    $('#tambah_risiko').on('click', function(){
        $('#judul_modal').html('Tambah Risiko')
        $('#formResiko').attr('action', APP_URL+'/admin/risiko/store')
        var elements = document.getElementsByTagName("input");
        for (var i=0; i < elements.length; i++) {
            if (elements[i].type == "text") {
                elements[i].value = "";
            }
        }

        $('#tambahResiko').modal('show')
    })

    $('.edit').on('click', function(){
        let id = $(this).attr('id').slice(5)
        $('#judul_modal').html('Edit Resiko')
        $('#formResiko').attr('action', APP_URL+'/admin/risiko/store/'+id)
        var elements = document.getElementsByTagName("input");
        for (var i=0; i < elements.length; i++) {
            if (elements[i].type == "text") {
                elements[i].value = "";
            }
        }
        $.ajax({
            type: 'GET',
            url: APP_URL+'/admin/risiko/get-risiko/'+id,
            dataType: 'json',
            data: {},
            success: function (results) {
                $('#formCode').val(results[0].id_risk)
                $('#formRisk').val(results[0].risk)

            },
            error:function(results){
                console.log(results);
            }
        });

        $('#tambahResiko').modal('show')
    })

    $('.delete').on('click', function(){
        let id = $(this).attr('id').slice(7)

        $.ajax({
            type: 'GET',
            url: APP_URL+'/admin/risiko/get-risiko/'+id,
            dataType: 'json',
            data: {},
            success: function (results) {
                $('#id_resiko').val(results[0].id_risk)
                $('#nama_resiko').html(results[0].risk)

                $('#deleteResiko').modal('show')
            },
            error:function(results){
                console.log(results);
            }
        });
    })
})
