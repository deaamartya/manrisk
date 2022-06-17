$(document).ready(function() {
    $.ajax({
        type: 'GET',
        url: APP_URL + '/get-notification',
        dataType: 'json',
        data: {

        },
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function(results) {
            // localStorage.setItem('notif', results.data)
            if (results.message == 'ok') {
                var data = results.data
                var srisiko_indhan = 0;
                var mitigasi_indhan = 0;
                var riskregister_indhan = 0;
                var hasil_mitigasi = 0;
                let element = '';
                for (let i = 0; i < data.length; i++) {
                    element += `<li>` +
                        `<p><i class="fa fa-circle-o me-3 font-info"></i>` + data[i].title + data[i].jumlah + `</p>` +
                        `</li>`;
                    if (data[i].title == 'Terdapat sumber risiko indhan yang belum disetujui sebanyak ') {
                        srisiko_indhan += data[i].jumlah;
                    }
                    if (data[i].title == 'Terdapat pengajuan mitigasi indhan yang belum disetujui sebanyak ') {
                        mitigasi_indhan += data[i].jumlah;
                    }
                    if (data[i].title == 'Terdapat risk register indhan yang belum disetujui sebanyak ') {
                        riskregister_indhan += data[i].jumlah;
                    }
                    if (data[i].title == 'Terdapat hasil mitigasi yang belum disetujui sebanyak ') {
                        hasil_mitigasi += data[i].jumlah;
                    }

                }

                $('.srisiko-indhan-notif').html(srisiko_indhan)
                $('.mitigasi-indhan-notif').html(mitigasi_indhan)
                $('.riskregister-indhan-notif').html(riskregister_indhan)
                $('.hasil-mitigasi-notif').html(hasil_mitigasi)
                $('.total-notif').html(data.length)
                $('.body-notif').append(element)
                $('.body-notif').append('<li></li>')
            }
        },
        error: function(data) {
            console.log(data);
        }
    });

})