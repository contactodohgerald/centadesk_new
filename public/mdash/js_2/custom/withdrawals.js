let baseUrl = 'http://127.0.0.1:8000/';

const successDisplay = (message) => swal(message, 'successful', 'success');
const errorDisplay = (message) => swal(message, 'Failed', 'error');

function postRequest(url, params){

    return new Promise(function (resolve, reject) {
//alert($('meta[name="csrf-token"]').attr('content'))
        $.ajaxSetup({
            headers:{
                'Source': "api",
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.post(url, params, function (data, status, jqXHR) {
            if(status === 'success'){
                resolve(data)
            }else{
                reject(status)
            }
        }).fail(function(error) {//statusText: "Method Not Allowed"
            reject('A Network Error was encountered, message: ``'+error.statusText+'`` was returned. Please contact system administrator.')
        })


    })
}

function handleTheErrorStatement(error_statement, showField = 'off', useClassForFieldFocus = 'no', useModal = 'no') {

    $(".error_carrier").text('');

    var counter = 0; let theKey = '';
    let errorStatementLenght = Object.keys(error_statement).length;
    for(var i in error_statement){
        if(counter == 0){ theKey = i; }

        if(typeof error_statement[i] === 'string'){
            if(error_statement[i].indexOf(':') != -1){
                error_statement[i] = error_statement[i].split(':');
            }
        }

        var txt = ''; let incomingErrorArray = [];
        for(var j in error_statement[i]){

            incomingErrorArray.push(error_statement[i][j]);

            txt += "<p style='font-size:12px' class='f-size error_carrier t-color'><span >*</span> "+error_statement[i][j]+"</p>";
        }

        if(i === 'general_error'){
            if(useModal === 'yes'){
                //callErrorModal(txt);
                $(".errorAreaHolder p").removeClass('t-color');
            }else{
                //returnFunctions.showSuccessToaster(txt, 'warning');
                errorDisplay(txt);
                $(".error_carrier").removeClass('t-color');
            }

        }else{
            $('.err_'+i).html(txt).removeClass('hidden');

            if(parseFloat(counter) == parseFloat(errorStatementLenght - 1)){
                if(showField === 'on'){
                    scrollIntoDomView(theKey, useClassForFieldFocus);
                    //returnFunctions.showSuccessToaster('Some validation errors occurred.', 'warning');
                }

            }
            counter++;
        }

    }

}

function scrollIntoDomView(selectedElement, useClassForFieldFocus = 'yes'){
    let prefix = '';
    let offset = '';
    if(useClassForFieldFocus === 'no'){
        offset = $("#"+selectedElement).offset(); // Contains .top and .left
        prefix = '#';
    }else{
        offset = $("."+selectedElement).offset(); // Contains .top and .left
        prefix = '.';
    }

    //Subtract 20 from top and left:

    offset.left -= 200;
    offset.top -= 200;
    //Now animate the scroll-top and scroll-left CSS properties of <body> and <html>:

    $('html, body').animate({
        scrollTop: offset.top,
        scrollLeft: offset.left
    });
    $(prefix+selectedElement).focus();

}

async function makeTransferPayments(a) {

    let retVal = confirm('Do you really want to proceed with payments');
    if(retVal === true){
        let selected = $(".smallCheckBox");
        let dataArray = [];
        for(let i = 0; i < selected.length; i++){
            if($(selected[i]).is(':checked')){
                dataArray.push($(selected[i]).val());
            }
        }

        $(a).text('Loading...').attr({'disabled':true});

        if(dataArray.length == 0){
            errorDisplay('Please select at least one withdrawal to continue');
            $(a).text('Make Payment').attr({'disabled':false});
            return;
        }

        let postData = await postRequest(baseUrl+"api/handle_transfers", {withdrawalId:dataArray.join('|')});
        let {error_code, success_message, error_message} = postData;

        if(error_code == 0){
            $(a).text('Make Payment').attr({'disabled':false});
            successDisplay(success_message);
            setTimeout(function () {
                location.reload();
            }, 5000);
            return;

        }
        handleTheErrorStatement(error_message, 'off', 'no', 'yes');
    }

}

async function markAsPayed(a) {
    let retVal = confirm('Do you wish to continue?');
    if(retVal === true){
        $(a).text('Loading.....').attr({'disabled':true});
        let selected = $(".smallCheckBox");
        let dataArray = [];
        for(let i = 0; i < selected.length; i++){
            if($(selected[i]).is(':checked')){

                dataArray.push($(selected[i]).val());
            }
        }

        if(dataArray.length == 0){
            $(a).text('Confirm Withdrawals').attr({'disabled':false});
            errorDisplay('Please select at least one withdrawal to continue');
            return;
        }

        let postData = await postRequest(baseUrl+'api/confirm_withdrawal_payment', {dataArray:dataArray.join('|')});
        let {error_code, success_statement, error_message} = postData;
        if(error_code == 0){
            $(a).text('Confirm Withdrawals').attr({'disabled':false});
            successDisplay(success_statement);
            setTimeout(function () {
                location.reload();
            }, 5000)
        }else{
            $(a).text('Confirm Withdrawals').attr({'disabled':false});
            errorDisplay(error_message);
        }
    }

}