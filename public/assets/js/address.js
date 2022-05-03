function sendMail(form) {
    // disable send button
    $(form).find('button').attr("disabled", "true");
    $.ajax({
        type: 'POST',
        url: '/calls/mail.php',
        data: form.serialize()
    }).then(function (res) {
        $(form).find("input[name='mail']").val('');
        let json = JSON.parse(res);
        if (json['status'] === "OK") {
            alert(json['message']);
        } else {
            alert(json['error']);
        }
        $(form).find('button').removeAttr("disabled");
    })
}