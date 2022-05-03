<!doctype html>
<html lang="cs">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5.0, minimum-scale=1">
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style.css" type="text/css">
    <link rel="stylesheet" href="../assets/css/all.min.css">
    <title>Detail adresy</title>
</head>
<body>
<script src="../assets/js/jquery-3.6.0.min.js"></script>
{_NAVBAR_}

<div id="ares_result" class=" ares-center container" style="max-width: 25em">
    <h2>Detail adresy</h2>
    <table class="table table-striped">
        <tbody>
        <tr>
            <th scope="row">Ulice:</th>
            <td>{_ADDRESS_}</td>
        </tr>
        <tr>
            <th scope="row" class="float-right">Město:</th>
            <td>{_CITY_}</td>
        </tr>
        <tr>
            <th scope="row" class="float-right">PSČ:</th>
            <td>{_POST_}</td>
        </tr>
        <tr>
            <th scope="row">Země:</th>
            <td>{_COUNTRY_}</td>
        </tr>
        <tr>
            <th scope="row">Telefonní číslo:</th>
            <td>{_PHONE_}</td>
        </tr>
        </tbody>
    </table>
    <h4>Poslední aktualizace</h4>
    <table class="table table-striped">
        <tr>
            <th scope="row">Ulice:</th>
            <td>{_UAD_}</td>
        </tr>
        <tr>
            <th scope="row">Město:</th>
            <td>{_UCT_}</td>
        </tr>
        <tr>
            <th scope="row">Okres:</th>
            <td>{_UOK_}</td>
        </tr>
    </table>
    <h3>Zaslat tyto informace</h3>
    <form method="post" class="row align-items-center">
        <input type="hidden" name="id" value="{_ID_}"/>
        <div class="col-6">
            <label class="visually-hidden" for="inputEmail">E-mail</label>
            <input name="mail" type="email" class="form-control" id="inputEmail" placeholder="E-mail"
                   pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>
        </div>

        <div class="col-6">
            <button type="submit" class="btn btn-primary" onclick="">Odeslat</button>
        </div>
    </form>
</div>


<script src="../assets/js/address.js"></script>

<script>
    $("form").on('submit', function (event) {
        let form = $(this)[0];
        if (form.reportValidity() && !$(this).find('button')[0].hasAttribute("disabled")) {
            event.preventDefault();
            sendMail($(this));
        }
    });
</script>
</body>
</html>

