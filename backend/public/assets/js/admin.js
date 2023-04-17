function sessionDetailsExplode(string){
    if(string !== ''){
        let cols = string.split('|');
        let affected = [];

        if(cols[1].indexOf(',') !== -1){
            for(let i = 0; i < cols[1].split(',').length; i++){
                affected.push({
                    "id":   cols[1].split(',')[i],
                    "name": cols[2].split(',')[i]
                })
            }
        }else{
            affected.push({
                "id":   cols[1],
                "name": cols[2]
            })
        }

        return {
            "type":     cols[0],
            "affected": affected
        }
    }else{
        return {
            "type": '',
            "affected": []
        }
    }
}

function formatDate(string, format){
    var date = new Date(string);

    var get_day = date.getDate(); if(get_day.toString().length == 1) get_day = "0"+get_day;
    var get_month = (date.getMonth()+1); if(get_month.toString().length == 1) get_month = "0"+get_month;
    var get_year = date.getFullYear();

    var get_hours = date.getHours(); if(get_hours.toString().length == 1) get_hours = "0"+get_hours;
    var get_minutes = date.getMinutes(); if(get_minutes.toString().length == 1) get_minutes = "0"+get_minutes;

    if(typeof format !== 'undefined'){
        format = format.replace(/{D}/g, get_day);
        format = format.replace(/{M}/g, get_month);
        format = format.replace(/{Y}/g, get_year);
        format = format.replace(/{H}/g, get_hours);
        format = format.replace(/{I}/g, get_minutes);
        return format;
    }else{
        return get_day+"/"+get_month+"/"+get_year+" "+get_hours+":"+get_minutes;
    }
}

function formatCurrentPeriod(period, sport){
    let format = '{%PERIOD%}';
    switch (sport){
        case 1:
            format = '{%PERIOD%} Half';
            break;
        case 2:
            format = '{%PERIOD%} Period';
            break;
        case 3:
            format = '{%PERIOD%} Quarter';
            break;
        case 4:
            format = '{%PERIOD%} Set';
            break;
        case 6:
            format = '{%PERIOD%} Set';
            break;
    }
    if(parseInt(period)>0){
        format = format.replace('{%PERIOD%}', period);
    }else{
        format = '<i class="flaticon-time"></i> Processing';
    }
    return format
}

function logout(){
    var form = new FormData();
    form.append('opType', 1001);
    $.ajax({
        url: api_service,
        method: "POST",
        headers: {
            'Authorization': token
        },
        dataType: 'json',
        data: form,
        processData: false,
        contentType: false,
        success: function(result){
            if(result.resultCode === 0){
                window.location.reload();
            }else{
                swal.fire({
                    title: 'Error',
                    text: result.responseInfo,
                    type: 'error',
                    buttonsStyling: false,
                    confirmButtonText: "OK",
                    confirmButtonClass: "btn btn-sm btn-bold btn-brand",
                });
            }
        },
        error: function(er){}
    });
}

function keep_logged(){
    var form = new FormData();
    form.append('opType', 1002);
    $.ajax({
        url: api_service,
        method: "POST",
        headers: {
            'Authorization': token
        },
        dataType: 'json',
        data: form,
        processData: false,
        contentType: false,
        success: function(result){
            if(result.resultCode !== 0){
                logout()
            }
        },
        error: function(er){}
    });
}

setInterval(keep_logged, 15000);