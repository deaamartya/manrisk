$(document).ready(function(){
    $.ajax({
        type: 'GET',
        url: APP_URL+'/get-notification',
        dataType: 'json',
        data: {

        },
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function (results) {
            // localStorage.setItem('notif', results.data)
            if(results.message == 'ok'){
                var data = results.data
                let element = '';
                for (let i = 0; i < data.length; i++) {
                    element += `<li>`+
                                    `<p><i class="fa fa-circle-o me-3 font-info"></i>`+data[i].title+data[i].jumlah+`</p>`+
                                `</li>`;
                }
                $('#total-notif').html(data.length)
                $('#body-notif').append(element)
                $('#body-notif').append('<li></li>')
            }
        },
        error:function(data){
            console.log(data);
        }
    });

})
