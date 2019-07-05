async function postText(paste) {

    paste._token = getToken();
    $.ajax({
        type: "POST",
        url: `/api/v1/paste`,
        dataType: "json",
        data: paste,
        success: redirectToNote,
        error: function (jqXHR, textStatus, errorThrown) {
            console.log("Fail post note data");
        },
        timeout: 1000,
    });
}

function redirectToNote(data) {
    if (data.success) {
        location.replace(`${data.link}`)
    }
    if(!data.success){
        console.log("Fail share note");
    }
}

async function updateList() {
    $.ajax({
        type: "GET",
        url: `/api/v1/paste`,
        dataType: "json",
        success: renderNoteList,
        error: function (jqXHR, textStatus, errorThrown) {
            console.log("Fail obtain notes");
        },
        timeout: 1000,
    });
}

function renderNoteList(data) {
    const table = $('<table>').addClass("table table-hover table-bordered");
    table.append(
        $('<thead>').append(
            $('<tr>')
                .append($('<th>').text('Название'))
                .append($('<th>').text('Срок годности'))
        )
    );
    const content = $('<tbody>');
    $.each(data, function (key, value) {

        const expiration = value.expiration ;
        const isUnLim = isUnlimited(expiration);
        let expirationAsString = '';
        if(!isUnLim){
            expirationAsString = formatDateTime(value.expiration);
        }
        if(isUnLim){
            expirationAsString = settings.noLimits;
        }

        const title = value.title.length === 0 ? "Заметка без названия" :
            value.title;

        content.append(
            $('<tr>')
                .append($('<td>').append($('<a>').attr('href', `${location}${value.link}`).text(title)))
                .append($('<td>').text(expirationAsString))
        );
    });
    const target = $('#public-share');
    target.empty();
    target.html(table.append(content));
}

function getToken() {
    return Cookies.get("XSRF-TOKEN");
}
