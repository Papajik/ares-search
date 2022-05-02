function onFormSubmit($form){
    // Update elements visibility
    $('#form_enc').addClass("ares-top");
    $("#ares_result").addClass("d-none");
    $('#ares_loader').removeClass("d-none");
    $('#error').addClass("d-none");

    $.ajax({
        type: 'POST',
        url: './calls/ares.php',
        data: $form.serialize()
    }).then(function (res) {
        // Update element visibility
        $('#ares_loader').addClass("d-none");

        let data = JSON.parse(res);
        if (data['status'] === 'OK'){
            fillResultTable(data['data']);
            $("#ares_result").removeClass("d-none");

        } else {
            let $err = $('#error');
            $err.removeClass('d-none').html(data['error']);
        }
    })
}


function fillResultTable(json){
    let date = new Date(json['creation_date']);
    $("#res_ico")[0].innerText = json['ico'];
    $("#res_dic")[0].innerText = json['dic'];
    $("#res_name")[0].innerText = json['name'];
    $("#res_date")[0].innerText = `${date.getDay()}.${date.getMonth()}. ${date.getFullYear()}`;
    $("#res_add")[0].innerText = json['deliveryAddress']['street']+ ", " + json['deliveryAddress']['city'];

}
