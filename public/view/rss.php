<!doctype html>
<html lang="cs">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../assets/css/all.min.css">
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style.css" type="text/css">
    <link rel="stylesheet" href="../assets/css/bootstrap-icons.css">

    <title>ARES Historie</title>

</head>
<body>

<?php require "./view/elements/navbar.html" ?>

<div class="d-flex align-items-center justify-content-center">
    <div id="result" class="list-group" style="width: 23em">

    </div>

</div>

<script src="../assets/js/jquery-3.6.0.min.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script>
    console.log("test");
    $.ajax({
        type: "POST",
        url: "/calls/rss.php",
        data: {read: '1'}
    }).then(function (res) {
        $(result).append(res);
    });
</script>

</body>
</html>
