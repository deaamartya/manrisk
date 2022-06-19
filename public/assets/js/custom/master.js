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
                var riskregister_korporasi = 0;
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
                    if (data[i].title == 'Terdapat risk register korporasi yang belum disetujui sebanyak ') {
                        riskregister_korporasi += data[i].jumlah;
                    }
                    if (data[i].title == 'Terdapat hasil mitigasi yang belum disetujui sebanyak ') {
                        hasil_mitigasi += data[i].jumlah;
                    }

                }

                if (srisiko_indhan > 0) {
                    $('.srisiko-indhan-notif').html(srisiko_indhan)
                } else if (mitigasi_indhan > 0) {
                    $('.mitigasi-indhan-notif').html(mitigasi_indhan)
                } else if (riskregister_korporasi > 0) {
                    $('.riskregister-korporasi-notif').html(riskregister_korporasi)
                } else if (hasil_mitigasi > 0) {
                    $('.hasil-mitigasi-notif').html(hasil_mitigasi)
                }

                if (data.length > 0) {
                    $('.total-notif').html(data.length)
                    $('.body-notif').append(element)
                    $('.body-notif').append('<li></li>')
                }

            }
        },
        error: function(data) {
            console.log(data);
        }
    });

})