async function loadNote () {
    $.ajax({
        type: "GET",
        url: `${location.origin}/api/v1/paste${location.pathname}`,
        dataType: "json",
        success: renderNote,
        error: function (jqXHR, textStatus, errorThrown) {
            console.log("Fail get note by link");
        },
        timeout: 1000,
    });
}

function renderNote(data) {
    let isValid = Array.isArray(data);
    if(isValid){
        isValid = data.length > 0 ;
    }
    if(!isValid){
        console.log("Empty data, nothing to view");
    }
    let isUnLim = false;
    let expiration = 0;
    if(isValid){

        $("#link").attr("href",data[0].link);
        $("#title").val(data[0].title);
        $("#content").val(data[0].content);
        $("#access").val(data[0].access === 1 ? "public" : "unlisted");

        expiration = data[0].expiration;
        isUnLim = isUnlimited(expiration);
    }
    if(isValid && !isUnLim){
        $("#expiration").val(formatDateTime(expiration));
    }
    if(isValid && isUnLim){
        $("#expiration").val(settings.noLimits);
    }
}
