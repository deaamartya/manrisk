$(document).ready(function(){
    // $('#responden_table').DataTable()
    // $('#sumber_risiko_table').DataTable()

    var table_responden = $('#responden_table').DataTable({
        processing: true,
        serverSide: true,
        paging: true,
        ajax : {
            url : APP_URL+'/admin/responden_datatable',
            data: function(d) {
                d.company_id = $('#formPerusahaan').val(),
                d.tahun = $('#formTahun').val()
            }
        },
        columns:[
            {data:null,name:null},
            {data:"nama_responden",name:"nama_responden"},
            {data:"tgl_penilaian",name:"tgl_penilaian"},
            {
                data: "",
                className: "text-center",
                render: function ( data, type, row ) {
                    let html = ''
                    html += '<button type="button" class="btn btn-danger delete-responden" id="'+row.id_p+'_'+row.nama_responden+'">Hapus</button>'

                    return html
                }
            }
        ]
    });
    table_responden.on( 'order.dt search.dt', function () {
        table_responden.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

    var table_sumber_risiko = $('#sumber_risiko_table').DataTable({
        processing: true,
        serverSide: true,
        paging: true,
        ajax : {
            url : APP_URL+'/admin/sumber_risiko_datatable',
            data: function(d) {
                d.company_id = $('#formPerusahaan').val(),
                d.tahun = $('#formTahun').val()
            }
        },
        columns:[
            {data:null,name:null},
            {data:"instansi",name:"instansi"},
            {data:"konteks",name:"konteks"},
            {data:"s_risiko",name:"s_risiko"},
            {data:"tahun",name:"tahun"},
            {data:"l",name:"l"},
            {data:"c",name:"c"},
            {data:"r",name:"r"},
            {
                data: "",
                className: "text-center",
                render: function ( data, type, row ) {
                    let html = ''
                    if(row.status_s_risiko == 0){
                        html += '<span class="badge badge-warning">Belum Disetujui</span>'
                    }
                    else if(row.status_s_risiko == 1){
                        html += '<span class="badge badge-success">Disetujui</span>'
                    }
                    else if(row.status_s_risiko == 2){
                        html += '<span class="badge badge-danger">Tidak Disetujui</span>'
                    }

                    return html
                }
            },
            {
                data: "",
                className: "text-center",
                render: function ( data, type, row ) {
                    let html = '<span class="badge badge-warning">Bukan Indhan</span>'

                    return html
                }
            }
        ]
    });
    table_sumber_risiko.on( 'order.dt search.dt', function () {
        table_sumber_risiko.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

    $('#cari').on('click', function(){
        table_responden.ajax.reload()
        table_sumber_risiko.ajax.reload()
    })

    $('#responden_table tbody').on('click', '.delete-responden', function(){
        let temp = $(this).attr('id').split('_')

        $('#nama-responden').html(temp[1])
        $('#form-delete-responden').attr('action', APP_URL+'/admin/delete-responden/'+temp[0])
        $('#modalDeleteResponden').modal('show')
    })

    $('.print').on('click', function(){
        console.log('yess');
        let instansi = $('#formPerusahaan').val()
        let tahun = $('#formTahun').val()

        window.location.assign(APP_URL+"/admin/print-kompilasi-hasil-mitigasi/"+instansi+"/"+tahun)
    })
})
