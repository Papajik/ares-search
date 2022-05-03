<!doctype html>
<html lang="cs">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5.0, minimum-scale=1">
    <link rel="stylesheet" href="./../assets/css/all.min.css">
    <link href="./../assets/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="./../assets/css/style.css" type="text/css">
    <link rel="stylesheet" href="./../assets/css/bootstrap-icons.css">


    <title>ARES vyhledávání</title>

</head>
<body>
<script src="../assets/js/jquery-3.6.0.min.js"></script>
<?php require "elements/navbar.html"?>

<div id="form_enc" class="ares-center">
    <form id="ares_form" method="POST">
        <h1 class="text-center">Vyhledávání</h1>
        <div class="form-floating">
            <input type="search" class="form-control" id="icoInput" name="ico" placeholder="IČO">
            <label for="icoInput">IČO</label>
        </div>
        <div id='error' class='alert alert-danger mt-2 text-center d-none'></div>
        <div class="text-center">
            <button id="search-button" type="submit" class="btn btn-primary mt-2">
                <i class="bi bi-search"></i>
                Vyhledat
            </button>
        </div>

    </form>
</div>

<div id="ares_loader" class="d-none ares-center">
    <div class="spinner-border" role="status">
        <span class="sr-only"></span>
    </div>
</div>

<div id="ares_result" class="d-none ares-center container" style="max-width: 25em">
    <table class="table table-striped">
        <tbody>
        <tr>
            <th scope="row">IČO: </th>
            <td id="res_ico"></td>
        </tr>
        <tr>
            <th scope="row">DIČ: </th>
            <td id="res_dic"></td>
        </tr>
        <tr>
            <th scope="row">Obchodní jméno: </th>
            <td id="res_name"></td>
        </tr>
        <tr>
            <th scope="row" class="float-right">Datum vzniku: </th>
            <td id="res_date"></td>
        </tr>
        <tr>
            <th scope="row" class="float-right">Adresa: </th>
            <td id="res_add"></td>
        </tr>
        </tbody>
    </table>
</div>




<script src="../assets/js/jquery.validate.min.js"></script>

<script src="../assets/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>

<script src="../assets/js/aresSearch.js"></script>
<script>$(function () {
        $('#ares_form').validate({
            rules: {
                ico: {
                    required: true
                }
            },
            messages: {
                ico: {
                    required: ""
                }
            },
            submitHandler: function (form) {
                onFormSubmit($(form));
            }
        });
    })</script>
</body>
</html>

