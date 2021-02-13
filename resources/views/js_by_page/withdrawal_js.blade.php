
<script>

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

    async function triggerTopup(a) {//flutter_wave_top_up bank_top_up

        let retVal = confirm('Please Click `OK` to continue');
        if(retVal === true){
            $(a).text('Loading.....').attr({'disabled':true});
            let Amount = $("#account_topUp").val();
            let option_for_payment = $("#option_for_payment").val();

            if(option_for_payment === ''){
                errorDisplay('Payment Option/Method is required')
                $(a).text('Add Fund').attr({'disabled':false});
                return;
            }

            if(Amount === ''){
                errorDisplay('Amount is required');
                $(a).text('Add Fund').attr({'disabled':false});
                return;
            }

            if(isNaN(Amount)){
                errorDisplay('Amount must be numeric');
                $(a).text('Add Fund').attr({'disabled':false});
                return;
            }

            let amount = parseFloat(Amount).toString();
            let encodedAmount = btoa(amount);
            window.location.href = RequestHandler.BaseUrl+'store_new_transaction/'+encodedAmount+'/top_up/'+option_for_payment;

        }

    }

    //confirm a transaction manually
    async function confirmTopUp(a) {
        let retVal = confirm('Do you wish to continue?');
        if(retVal === true){
            $(a).text('Loading').attr({'disabled':true});
            let selected = $(".smallCheckBox");
            let dataArray = [];
            for(let i = 0; i < selected.length; i++){
                if($(selected[i]).is(':checked')){

                    dataArray.push($(selected[i]).val());
                }
            }

            if(dataArray.length == 0){
                $(a).text('Confirm Top Ups').attr({'disabled':false});
                errorDisplay('Please select at least one withdrawal to continue');
                return;
            }

            let postData = await theRequestHandler.postRequest(RequestHandler.BaseUrl+'confirmTop', {dataArray:dataArray});
            if(postData.error_code == 0){
                $(a).text('Confirm Top Ups').attr({'disabled':false});
                successDisplay(postData.success_statement);
                setTimeout(function () {
                    location.reload();
                }, 5000)
            }else{
                $(a).text('Confirm Top Ups').attr({'disabled':false});
                errorDisplay(postData.error_message);
            }
        }
    }

    //delete selected transactions
    async function deleteSelectedTopUp(a) {

        let retVal = confirm('Do you wish to continue?');
        if(retVal === true){
            $(a).text('Loading...').attr({'disabled':true});
            let selected = $(".smallCheckBox");
            let dataArray = [];
            for(let i = 0; i < selected.length; i++){
                if($(selected[i]).is(':checked')){

                    dataArray.push($(selected[i]).val());
                }
            }

            if(dataArray.length == 0){
                $(a).text('Delete Transaction(s)').attr({'disabled':false});
                errorDisplay('Please select at least one Transaction detail to continue');
                return;
            }

            let postData = await theRequestHandler.postRequest(RequestHandler.BaseUrl+'/deleteTransactionDetails', {dataArray:dataArray});
            if(postData.error_code == 0){
                $(a).text('Delete Transaction(s)').attr({'disabled':false});
                successDisplay(postData.success_statement);
                setTimeout(function () {
                    location.reload();
                }, 5000)
            }else{
                $(a).text('Delete Transaction(s)').attr({'disabled':false});
                errorDisplay(postData.error_message);
            }
        }

    }

</script>