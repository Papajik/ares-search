<!doctype html>
<html lang="cs">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5.0, minimum-scale=1">
    <link rel="stylesheet" href="../assets/css/all.min.css">
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style.css" type="text/css">
    <link rel="stylesheet" href="../assets/css/bootstrap-icons.css">

    <title>ARES Historie</title>

</head>
<body>
<div class="modal fade" id="subjectDetail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="subject_name">Jméno</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="modal-loader" class="d-flex ares-center">
                    <div class="spinner-border" role="status">
                        <span class="sr-only"></span>
                    </div>
                </div>
                <div id='error' class='alert alert-danger mt-2 text-center d-none'></div>
                <table class="table table-borderless table-striped">
                    <tbody>
                    <tr>
                        <th scope="row">IČO:</th>
                        <td id="res_ico"></td>
                    </tr>
                    <tr>
                        <th scope="row">DIČ:</th>
                        <td id="res_dic"></td>
                    </tr>
                    <tr>
                        <th scope="row" class="float-right">Datum vzniku:</th>
                        <td id="res_date"></td>
                    </tr>
                    <tr>
                        <th scope="row" class="float-right">Adresa:</th>
                        <td id="res_add"></td>
                    </tr>
                    <tr>
                        <th scope="row" class="float-right">Hledáno:</th>
                        <td id="res_search_date"></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="../assets/js/jquery-3.6.0.min.js"></script>
<?php require "./view/elements/navbar.html" ?>

<div class="ares-center container" style="max-width: 25em">
    <div class="btn-toolbar mb-2" role="toolbar">
        <div class="btn-group  w-100" role="group">
            <div class="input-group-text " id="btnGroupAddon">Řadit dle:</div>
            <input type="radio" class="btn-check" data-sort="name_date" name="sort_radio" id="sort_radio_1"
                   autocomplete="off" checked>
            <label class="btn btn-outline-primary" for="sort_radio_1">
                Jméno firmy
                <i id="sort_icon_1" class="fas fa-arrow-up asc"></i>
            </label>
            <input type="radio" class="btn-check" data-sort="date" name="sort_radio" id="sort_radio_2"
                   autocomplete="off">
            <label class="btn btn-outline-primary" for="sort_radio_2">
                Čas vyhledání
                <i id="sort_icon_2" class="fas fa-arrow-up asc d-none"></i>
            </label>
        </div>
    </div>
    <div class="btn-toolbar mb-2 justify-content-between" role="toolbar">
        <div class="input-group">
            <div class="input-group-text" id="btnGroupAddon" style="width: 8em">Filtrovat podle:</div>
            <input type="search" class="form-control" style="min-width: 4em; max-width: 13em" placeholder="Jméno firmy">
            <button id="search-button" style="max-width: 3em" type="button" class="btn btn-primary"
                    onclick="loadPage(1)">
                <i class="bi bi-search"></i>
            </button>
        </div>
    </div>
    <div>
        <div class="card mb-2 invisible" id="card_0">
            <div class="card-body">
                <h6 class="card-title"></h6>
                <div class="row">
                    <div class="col-6">
                        IČO: <span></span>
                    </div>
                    <span class="col-6"></span>
                </div>
                <a href="#subjectDetail" onclick="" class="stretched-link" data-bs-toggle="modal"></a>
            </div>
        </div>


        <div class="card mb-2 invisible" id="card_1">
            <div class="card-body">
                <h6 class="card-title"></h6>
                <div class="row">
                    <div class="col-6">
                        IČO: <span></span>
                    </div>
                    <span class="col-6"></span>
                </div>
                <a href="#subjectDetail" onclick="" class="stretched-link" data-bs-toggle="modal"></a>
            </div>
        </div>

        <div class="card mb-2 invisible" id="card_2">
            <div class="card-body">
                <h6 class="card-title"></h6>
                <div class="row">
                    <div class="col-6">
                        IČO: <span></span>
                    </div>
                    <span class="col"></span>
                </div>
                <a href="#subjectDetail" onclick="" class="stretched-link" data-bs-toggle="modal"></a>
            </div>
        </div>
    </div>
    <div id="loader" class="d-flex ares-center">
        <div class="spinner-border" role="status">
            <span class="sr-only"></span>
        </div>
    </div>


    <nav class="d-flex justify-content-center flex-nowrap">
        <ul class="pagination" data-max="3">
            <li class="page-item disabled" id="nav_first">
                <a class="page-link" onclick="loadPage(1)">První</a>
            </li>
            <li class="page-item disabled" id="nav_previous">
                <a class="page-link" href="#" onclick="loadPage(getCurrentPage()-1)">0</a>
            </li>
            <li class="page-item active" id="nav_current">
                <a href="#" class="page-link">1</a>
            </li>
            <li class="page-item" id="nav_next">
                <a class="page-link" href="#" onclick="loadPage(getCurrentPage()+1)">2</a>
            </li>
            <li class="page-item" id="nav_last">
                <a class="page-link" href="#" onclick="loadPage(getMaxPageNumber())">Poslední</a>
            </li>
        </ul>
    </nav>
</div>



<script src="../assets/js/time.js"></script>
<script src="../assets/js/history.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>

<script>
    $(function () {
        // Load First Page
        loadPage(1);

        // Fire search function by pressing "Enter"
        $("input[type='search']")[0].addEventListener("keydown", onFilterKeyDown);

        // Sort interaction
        $("input[type='radio']").on('click', function () {
            onSortClicked(this);
        });

        // Load data into modal
        $('#subjectDetail').on('show.bs.modal', function (event) {
            let btn = $(event.relatedTarget);
            loadModal($(this), btn.data('id'), btn.data('name'));
        })

    });
</script>
</body>
</html>

