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
                var pengukuran_risiko = 0;
                var pengukuran_risiko_indhan = 0;
                var mitigasi_indhan = 0;
                var riskregister_korporasi = 0;
                var hasil_mitigasi = 0;
                var hasil_mitigasi_indhan = 0;
                var deadline_mitigasi = 0;
                var mitigasi_risiko = 0;
                let element = '';
                for (let i = 0; i < data.length; i++) {
                    element += `<li>` +
                        `<a href='` + data[i].link + `'><p><i class="fa fa-circle-o me-3 font-info"></i>` + data[i].title + data[i].jumlah + `</p></a>` +
                        `</li>`;
                    if (data[i].title == 'Terdapat sumber risiko yang belum disetujui sebanyak ') {
                        srisiko_indhan += data[i].jumlah;
                    }
                    if (data[i].title == 'Terdapat pengajuan mitigasi yang belum disetujui sebanyak ') {
                        mitigasi_indhan += data[i].jumlah;
                    }
                    if (data[i].title == 'Terdapat risk register korporasi yang belum disetujui sebanyak ') {
                        riskregister_korporasi += data[i].jumlah;
                    }
                    if (data[i].title == 'Terdapat hasil mitigasi yang belum disetujui sebanyak ') {
                        hasil_mitigasi += data[i].jumlah;
                    }
                    if (data[i].title == 'Terdapat mitigasi indhan yang kurang dari 100% sebanyak ') {
                        hasil_mitigasi_indhan += data[i].jumlah;
                    }
                    if (data[i].title == 'Terdapat risiko telah melewati tanggal jatuh tempo sebanyak ') {
                        deadline_mitigasi += data[i].jumlah;
                    }
                    if (data[i].title == 'Terdapat pengukuran risiko korporasi sebanyak ') {
                        pengukuran_risiko += data[i].jumlah;
                    }
                    if (data[i].title == 'Terdapat pengukuran risiko indhan sebanyak ') {
                        pengukuran_risiko_indhan += data[i].jumlah;
                    }
                    if (data[i].title == 'Terdapat detail risiko yang belum dimitigasi sebanyak ') {
                        mitigasi_risiko += data[i].jumlah;
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
                } else if (deadline_mitigasi > 0) {
                    $('.deadline-mitigasi-notif').html(deadline_mitigasi)
                } else if (pengukuran_risiko > 0) {
                    $('.pengukuran-risiko-notif').html(pengukuran_risiko)
                } else if (pengukuran_risiko_indhan > 0) {
                    $('.pengukuran-risiko-indhan-notif').html(pengukuran_risiko_indhan)
                } else if (mitigasi_risiko > 0) {
                    $('.mitigasi-risiko-notif').html(mitigasi_risiko)
                } else if (hasil_mitigasi_indhan> 0) {
                    $('.hasil-mitigasi-indhan-notif').html(hasil_mitigasi_indhan)
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
