$(document).ready(function() {
    $.ajax({
        type: 'GET',
        url: APP_URL + '/get_perusahaan',
        dataType: 'json',
        data: {},
        success: function(results) {
            $('#formPerusahaan').empty();
            // $('#formPerusahaan').append('<option selected disabled>Pilih perusahaan . . </option>');
            for (let i = 0; i < results.length; i++) {
                $('#formPerusahaan').append(
                    '<option value="' + results[i].company_id + '" id="option' + results[i].company_id + '">' + results[i].company_code + ' - ' + results[i].instansi + '</option>'
                );
            }
        },
        error: function(results) {
            console.log(results);
        }
    });

    $('#basic-1 tbody').on('click', '.field-status button', function() {
        let id = $(this).attr('id').slice(7)
        $.ajax({
            type: 'PUT',
            url: APP_URL + '/' + head_url + '/user/update-status/' + id,
            dataType: 'json',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(data) {
                // location.reload()
                if (data.data.status_user == 0) {
                    $('#status_' + id).removeClass('btn btn-primary btn-xs status')
                    $('#status_' + id).addClass('btn btn-info btn-xs status')
                    $('#status_' + id).html('Aktif')
                } else {
                    $('#status_' + id).removeClass('btn btn-info btn-xs status')
                    $('#status_' + id).addClass('btn btn-primary btn-xs status')
                    $('#status_' + id).html('Tidak Aktif')
                }
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Data berhasil disimpan.',
                    showConfirmButton: false,
                    timer: 2000
                });
            },
            error: function(data) {
                console.log(data);
            }
        });
    })

    $('#tambah_user').on('click', function() {
        $('#judul_modal').html('Tambah User')
        $('#formUser').attr('action', APP_URL + '/' + head_url + '/user/store')
        $('#formPerusahaan').find('option:selected').removeAttr('selected').trigger('change')
        var elements = document.getElementsByTagName("input");
        for (var i = 0; i < elements.length; i++) {
            if (elements[i].type == "text" || elements[i].type == "password") {
                elements[i].value = "";
            }
            if (elements[i].type == 'checkbox') {
                elements[i].checked = false;
            }
        }

        if (user.is_admin === true) {
            $('.is_risk_owner').hide()
            $('.is_penilai').hide()
            $('.is_penilai_indhan').hide()
        } else if (user.is_risk_officer === true) {
            $('.is_admin').hide()
            $('.is_risk_officer').hide()
        }

        $('#formPassword').attr('required', 'required')
        $('#infoPassword').hide()
            // $('.nip').hide()
        $('.jabatan').hide()
        $('#formMelakukanPenilaian').removeAttr('disabled')
        $('.melakukan_penilaian div label').html('No')

        $('#tambahUser').modal('show')
    })

    $('#basic-1 tbody').on('click', '.edit', function() {
        let id = $(this).attr('id').slice(5)
        $('#judul_modal').html('Edit User')
        $('#formUser').attr('action', APP_URL + '/' + head_url + '/user/store/' + id)
        var elements = document.getElementsByTagName("input");
        for (var i = 0; i < elements.length; i++) {
            if (elements[i].type == "text" || elements[i].type == "password") {
                elements[i].value = "";
            }
            if (elements[i].type == 'checkbox') {
                elements[i].checked = false;
            }
        }

        if (user.is_admin === true) {
            $('.is_risk_owner').hide()
            $('.is_penilai').hide()
            $('.is_penilai_indhan').hide()
        } else if (user.is_risk_officer === true) {
            $('.is_admin').hide()
        }

        $('#formPassword').removeAttr('required')
        $('#infoPassword').show()

        $.ajax({
            type: 'GET',
            url: APP_URL + '/' + head_url + '/user/get-user/' + id,
            dataType: 'json',
            data: {},
            success: function(results) {
                $('#formPerusahaan').find('option:selected').removeAttr('selected')
                $('#formName').val(results.data[0].name)
                $('#formUsername').val(results.data[0].username)
                $('#formNip').val(results.data[0].nip)
                $('#formPerusahaan option#option' + results.data[0].company_id).attr('selected', 'selected').trigger('change')
                if (results.data[0].is_admin == 1) {
                    $('#formIsAdmin').val(1)
                    $('#formIsRiskOfficer').prop('checked', true)
                } else {
                    $('#formIsAdmin').val(0)
                }
                if (results.data[0].is_risk_officer == 1) {
                    $('#formIsRiskOfficer').val(1)
                    $('#formIsRiskOfficer').prop('checked', true)
                } else {
                    $('#formIsRiskOfficer').val(0)
                }
                if (results.data[0].is_penilai == 1) {
                    $('#formIsPenilai').val(1)
                    $('#formIsPenilai').prop('checked', true)
                } else {
                    $('#formIsPenilai').val(0)
                }
                if (results.data[0].is_penilai_indhan == 1) {
                    $('#formIsPenilaiIndhan').val(1)
                    $('#formIsPenilaiIndhan').prop('checked', true)
                } else {
                    $('#formIsPenilaiIndhan').val(0)
                }
                if (results.data[0].is_risk_owner == 1) {
                    $('#formIsRiskOwner').val(1)
                    $('#formIsRiskOwner').prop('checked', true)
                } else {
                    $('#formIsRiskOwner').val(0)
                }
                if (results.data[0].is_assessment == 1) {
                    $('.melakukan_penilaian div label').html('Yes')
                    $('#formMelakukanPenilaianHidden').val(1)
                    $('#formMelakukanPenilaian').val(1)
                    $('#formMelakukanPenilaian').prop('checked', true)

                    $('#formJabatan').val(results.data[1].jabatan)
                    $('.jabatan').show()
                } else {
                    $('#formMelakukanPenilaian').val(0)
                    $('.melakukan_penilaian div label').html('No')
                        // $('.nip').hide()
                    $('.jabatan').hide()
                }
                // $('#formMelakukanPenilaian').attr('disabled', 'disabled')
            },
            error: function(results) {
                console.log(results);
            }
        });

        $('#tambahUser').modal('show')
    })

    $('#formIsRiskOfficer').on('click', function() {
        if ($('#formIsRiskOfficer:checked').val() != undefined) {
            $('#formIsRiskOfficer').val(1)
        } else {
            $('#formIsRiskOfficer').val(0)
        }
    })

    $('#formIsRiskOwner').on('click', function() {
        if ($('#formIsRiskOwner:checked').val() != undefined) {
            $('#formIsRiskOwner').val(1)
        } else {
            $('#formIsRiskOwner').val(0)
        }
    })

    $('#formIsPenilai').on('click', function() {
        if ($('#formIsPenilai:checked').val() != undefined) {
            $('#formIsPenilai').val(1)
        } else {
            $('#formIsPenilai').val(0)
        }
    })

    $('#formIsPenilaiIndhan').on('click', function() {
        if ($('#formIsPenilaiIndhan:checked').val() != undefined) {
            $('#formIsPenilaiIndhan').val(1)
        } else {
            $('#formIsPenilaiIndhan').val(0)
        }
    })

    $('#formIsAdmin').on('click', function() {
        if ($('#formIsAdmin:checked').val() != undefined) {
            $('#formIsAdmin').val(1)
        } else {
            $('#formIsAdmin').val(0)
        }
    })

    $('#formMelakukanPenilaian').on('click', function() {
        if ($('#formMelakukanPenilaian:checked').val() != undefined) {
            $('#formMelakukanPenilaianHidden').val(1)
            $('#formMelakukanPenilaian').val(1)
                // $('.nip').show()
            $('.jabatan').show()
            $('.melakukan_penilaian div label').html('Yes')
        } else {
            $('#formMelakukanPenilaianHidden').val(0)
            $('#formMelakukanPenilaian').val(0)
                // $('.nip').hide()
            $('.jabatan').hide()
            $('.melakukan_penilaian div label').html('No')
        }
    })
})