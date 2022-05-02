const RESULTS_PER_PAGE = 3;

function loadPage(page, limit = RESULTS_PER_PAGE) {
    updatePaginator(page, getMaxPageNumber());
    let sort = getSelectedSort();
    let filter = readFilterValue();

    loadData((page - 1) * limit, limit, filter, sort[0], sort[1]);
}


function loadData(offset, limit, filter, order_by, direction = true) {
    $('#card_0').addClass("invisible");
    $("#card_1").addClass("invisible");
    $("#card_2").addClass("invisible");
    $('#loader').removeClass('d-none');

    $.ajax({
        type: 'POST',
        url: '/calls/history.php',
        data: {
            'limit': limit,
            'offset': offset,
            'order_by': order_by,
            'direction': direction,
            'filter': filter
        }
    }).then(function (res) {
        let json = JSON.parse(res);

        if (json.status === "OK") {
            let data = json['data']['subjects'];
            let maxNumber = Math.max(Math.ceil(json['data']['max_rows'] / limit), 1)
            setMaxPageNumber(maxNumber)
            let n = Math.min(3, data?.length ?? 0);
            for (let i = 0; i < n; i++) {
                let card = $('#card_' + i);
                $(card).find("h6")[0].innerText = data[i]['name'];
                $(card).find(">div>div>div>span")[0].innerText = data[i]['ico'];
                $(card).find(">div>div>span")[0].innerText = parseFullDate(new Date(data[i]['search_date']))
                $(card).find("a").data("id", data[i]['id']).data('name', data[i]['name']);
                $(card).removeClass("invisible");
            }
            $('#loader').addClass('d-none')
            updatePaginator(getCurrentPage(), maxNumber);
        }
    })
}

function onFilterKeyDown(e) {
    if (e.keyCode === 13) {
        loadPage(getCurrentPage());
    }
}

function loadModal(modal, id, name) {
    modal.find('.modal-title').text(name);


    $.ajax({
        type: 'POST',
        url: '/calls/subject.php',
        data: "id=" + id
    }).then(function (res) {
        $('#modal-loader').addClass("d-none");
        let data = JSON.parse(res);
        if (data['status'] === 'OK') {
            modal.find('table').removeClass('d-none');
            fillModal(data['subject'])

        } else {
            let $err = $('#error');
            $err.removeClass('d-none').html(data['error']);
            modal.find('table').addClass('d-none');
        }
    })
}

function fillModal(json) {
    $("#res_ico")[0].innerText = json['ico'];
    $("#res_dic")[0].innerText = json['dic'];
    $("#res_date")[0].innerText = parseDate(new Date(json['creation_date']));
    $("#res_add")[0].innerText = json['deliveryAddress']['street'] + ", " + json['deliveryAddress']['city'];
    $('#res_search_date')[0].innerText = parseFullDate(new Date(json['search_date']));
}

function onSortClicked(btn) {
    let id = $(btn).attr('id');
    let currentIcon = findRadioIcon(id);

    if (!$(btn).attr("checked")) {
        // User clicked this type for the first time
        clearRadios();                          // hide arrows and clear "checked" attributes
        $(btn).attr("checked", "");
        currentIcon.classList.toggle("d-none");
    } else {
        currentIcon.classList.toggle("desc");   // change sort order
    }
    loadPage(1);
}

function findRadioIcon(id) {
    return $("label[for='" + id + "']").find("i")[0];
}

function clearRadios() {
    $("input[type=radio]").each(function (index, value) {
        value.removeAttribute("checked");
        $(findRadioIcon($(value).attr('id'))).removeClass("desc").addClass('d-none');
    });
}

function readFilterValue() {
    return $("input[type=search]")[0].value;
}

function updatePaginator(page, max) {
    if (page === 1) {
        $('#nav_first').addClass('disabled');
        $('#nav_previous').addClass('disabled').find('a')[0].innerText = '..';
    } else {
        $('#nav_first').removeClass('disabled');
        $('#nav_previous').removeClass('disabled').find('a')[0].innerText = page - 1;
    }
    $('#nav_current>a')[0].innerText = page;

    if (page === max) {
        $('#nav_next').addClass('disabled').find('a')[0].innerText = '..';
        $('#nav_last').addClass('disabled');
    } else {
        $('#nav_next').removeClass('disabled').find('a')[0].innerText = page + 1;
        $('#nav_last').removeClass('disabled');
    }
}


function getMaxPageNumber() {
    return parseInt($('.pagination').data('max'));
}

function setMaxPageNumber(count) {
    return parseInt($('.pagination').data('max', count));
}

function getSelectedSort() {
    let el = $("input[checked]");
    return [el.data('sort'), !$("label[for='" + $(el).attr('id') + "']>i").hasClass('desc')];
}

function getCurrentPage() {
    return parseInt($('#nav_current>a')[0].innerText);
}