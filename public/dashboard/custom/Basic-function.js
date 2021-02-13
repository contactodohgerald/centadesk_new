// num_suffix
// setLoader
// remv_loader
// postRequest
// throwSweetalert
// getKeyByValue
// return_element_key_in_array
// ajaxRequest

function loader_set() {
    // $("#the_load_screen").animate({ opacity: '0.2' });
    $('#the_load_screen').removeAttr('style');
}
function loader_rmv() {
    $('#the_load_screen').attr('style', 'display:none');
}

function num_suffix(i) {
    var j = i % 10,
        k = i % 100;
    if (j == 1 && k != 11) {
        return i + "st";
    }
    if (j == 2 && k != 12) {
        return i + "nd";
    }
    if (j == 3 && k != 13) {
        return i + "rd";
    }
    return i + "th";
}
function set_form_data(object) {
    let form_data = new FormData();
    object.forEach(e => {
        form_data.append(e.name, e.value);
    });
    return form_data;
}

function setLoader() {
    // $('.loader').attr('style', 'display:block');
    // setTimeout(() => {
    $('.loader').show();
    $(".loader").animate({ opacity: '1' });
    // }, 1000);

}

function remvLoader() {
    $(".loader").animate({ opacity: '0.2' });
    setTimeout(() => {
        $('.loader').removeAttr('style');
    }, 500);

}

// former postRequest funtion was having a problem with formData
function ajaxRequest(url, data) {
    loader_set();
    return new Promise(function (resolve, reject) {

        $.ajax({
            type: "post",
            url: url,
            data: data,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function (response) {
                loader_rmv();
                resolve(response);
            }
        });
    })
}


/*function postRequest(url, params) {
    setLoader();
    return new Promise(function (resolve, reject) {

        $.post(url, params, function (data, status) {

            if (status === 'success') {
                remvLoader();
                resolve(data)
            } else {
                remvLoader();
                reject(status)
            }
        })

    })
}*/
function throwSweetalert(returned, page_redirect, allow_redirect) {
    if (returned.error == 1) {
        // swal('Sorry',returned.msg,'error');
        swal({
            title: 'Sorry',
            text: returned.msg,
            type: 'error',
            padding: '2em'
        })
    } else if (returned.error == 0) {
        if (allow_redirect == 1) {
            // swal('Congratulations',returned.msg,'success');
            swal({
                title: 'Congratulations',
                text: returned.msg,
                type: 'success',
                padding: '2em'
            })
            setTimeout(() => {
                window.location.href = page_redirect;
            }, 2000);
        }
    }
}

function throwToastr(returned, page_redirect, allow_redirect) {
    if (returned.error == 1) {
        // swal('Sorry',returned.msg,'error');

        toastr.error(msg)
    } else if (returned.error == 0) {
        if (allow_redirect == 1) {
            // swal('Congratulations',returned.msg,'success');

            toastr.success(returned.msg)
            setTimeout(() => {
                window.location.href = page_redirect;
            }, 2000);
        }
    }
}
function getObjKeyByValue(object, value) {
    for (var prop in object) {
        if (object.hasOwnProperty(prop)) {
            if (object[prop] === value)
                return prop;
        }
    }
}
function return_element_key_in_array(array, val_exist) {
    for (let i = 0; i < array.length; i++) {
        if (array[i] == val_exist) {
            return i;
        } else {
            return 0;
        }
    }

}

function validator(returned,page_redirect) {
    $("#errorHold").empty();
    if (returned.status == true) {
        let errorHold = `<div class="col-12 text-center"><div class="alert alert-success">${returned.message}</div></div>`;
        $("#errorHold").append(errorHold);
        window.scrollTo({ top: 0, behavior: 'smooth' });
        setTimeout(() => {
            window.location.href = page_redirect;
        }, 2000);
    } else {
        for (var key in returned.errors) {
            let error = returned.errors[key];
            if (error.length == 1) {
                let errorHold = `<div class="col-4"><div class="alert alert-danger">${returned.errors[key]}</div></div>`;
                $("#errorHold").append(errorHold);
            } else if (error.length > 1) {
                error.forEach(e => {
                    let errorHold = `<div class="col-4"><div class="alert alert-danger">${e}</div></div>`;
                    $("#errorHold").append(errorHold);
                })
            }
        }
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
}
