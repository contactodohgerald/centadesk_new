<script>
    let baseUrl = 'http://127.0.0.1:8000/';
    let userUniqueId = "{{auth()->user()->unique_id }}";

    const successDisplay = (message) => swal(message, 'successful', 'success');
    const errorDisplay = (message) => swal(message, 'Failed', 'error');

    async function subscribeTOTeacher(a, userId, teacherId){

        $(a).text('Loading.....').attr({'disabled':true});
        let postData = await postRequest(baseUrl+'api/subscribeTOTeacher', {userId:userId, teacherId:teacherId});
        let {error_code, success_statement, error_message} = postData;
        if(error_code == 0){
            $(a).text('Subscribe').attr({'disabled':false});
            showValidatorToaster(success_statement, 'success');
        }else{
            $(a).text('Subscribe').attr({'disabled':false});
            showValidatorToaster(error_message, 'warning');
        }
    }

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

    function getRequest(url) {

        return new Promise(function (resolve, reject) {

            fetch(url)
                .then(res => res.json())
                .then(data => resolve(data))
                .then(err => reject(err));

        });
    }

    function showValidatorToaster(message, type_of_toast) {
        loader_set();
        if (type_of_toast === 'success') {
            loader_rmv();
            throw_snackbar(message, 'success');
            window.scrollTo({ top: 0, behavior: 'smooth' });
           /* setTimeout(() => {
                window.location.href = page_redirect;
            }, 2000);*/
        } else {
            loader_rmv();
            throw_snackbar(message, 'error');
            // window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    }

    function showSuccessToaster(message, tooastType) {
        if(tooastType === "warning"){
            $.toast({
                text: message,
                heading: 'Note',
                icon: 'warning',
                showHideTransition: 'slide',
                allowToastClose: true,
                hideAfter: 5000,
                stack: 5,
                position: 'top-right',
                textAlign: 'left',
                loader: true,
                loaderBg: '#9ec600',
                background: 'red',
                beforeShow: function () {},
                afterShown: function () {},
                beforeHide: function () {},
                afterHidden: function () {}
            });
        }else if(tooastType === "success"){
            $.toast({
                text: message,
                heading: 'Note',
                icon: 'success',
                showHideTransition: 'slide',
                allowToastClose: true,
                hideAfter: 5000,
                stack: 5,
                position: 'top-right',
                textAlign: 'left',
                loader: true,
                loaderBg: '#9ec600',
                background: 'green',
                beforeShow: function () {},
                afterShown: function () {},
                beforeHide: function () {},
                afterHidden: function () {}
            });
        }


    }

    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
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

    function bringOutModalMain(value) {
        $(value).modal('show');
    }

    function addUniqueIdToInputField(a){
        let txt = $(a).attr('item_id');
        $('.delete_id').val(txt);
    }

    function checkAll() {
        if($(".mainCheckBox").is(':checked')){
            $(".smallCheckBox").prop('checked', true);
        }else{
            $(".smallCheckBox").prop('checked', false);
        }
    }

    let myIndexDb = (() => {
        let db;

        function getDB(db_name, table_name) {
            if (!db) {
                db = new Promise((resolve, reject) => {
                    const openreq = indexedDB.open(db_name, 1);

                    openreq.onerror = () => {
                        reject(openreq.error);
                    };

                    openreq.onupgradeneeded = () => {
                        // First time setup: create an empty object store
                        openreq.result.createObjectStore(table_name);
                    };

                    openreq.onsuccess = () => {
                        resolve(openreq.result);
                    };
                });
            }
            return db;
        }

        async function withStore(type, callback, db_name, tb_name) {
            const db = await getDB(db_name, tb_name);
            return new Promise((resolve, reject) => {
                const transaction = db.transaction(tb_name, type);
                transaction.oncomplete = () => resolve();
                transaction.onerror = () => reject(transaction.error);
                callback(transaction.objectStore(tb_name));
            });
        }

        return {
            async get(key,db_name, tb_name) {
                let req;
                await withStore('readonly', store => {
                    req = store.get(key);
                }, db_name, tb_name);
                return req.result;
            },
            async getAll(db_name, tb_name) {
                let req;
                await withStore('readonly', store => {
                    req = store.getAll();
                },db_name, tb_name);
                return req.result;
            },
            set(key, value,db_name, tb_name) {
                return withStore('readwrite', store => {
                    store.put(value, key);
                },db_name, tb_name);
            },
            delete(key,db_name, tb_name) {
                return withStore('readwrite', store => {
                    store.delete(key);
                },db_name, tb_name);
            }
        };

    })();

</script>

<!--datatables-->
@php $dataTablePages = ['wallet', 'get_top_up_with_conditions', 'view_all_roles', 'all_user_type', 'add_role_for_user', 'confirmed_wallet', 'charge', 'show_all_withdrawals', 'show_all_confirmed_withdrawals', 'show_withdrawals_with_conditions', 'all_users', 'all_admin', 'all_super_admin', 'view_gallery_events', 'view_all_news', 'view_fags', 'getAccountDetails', 'view_investments', 'view_due_investments', 'view_investment_history', 'view_investments', 'investment_referral', 'view_due_investments']; @endphp
@php $currentPageName = Request::segment(1); @endphp
@if(in_array($currentPageName, $dataTablePages))
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js" ></script>
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>
@endif

<!--roles pages-->
@php $rolesPages = ['view_all_roles', 'all_user_type', 'add_role_for_user', 'add_roles', 'add_user_type']; @endphp
@php $currentPageName = Request::segment(1); @endphp
@if(in_array($currentPageName, $rolesPages))
    <script src="{{asset('mdash/js_2/custom/roles_js.js')}}" ></script>
@endif


{{--errors--}}
@php $pageErrorArray = ['show_top_up_transactions', 'main_settings_page', 'settings_page', 'editProfile', 'wallet', 'investments_settings', 'create_gallery_view', 'compose', 'add_funds', 'login_authenticator', 'show_all_withdrawals', 'create_news_view', 'create_faqs_page', 'create_investment_interface'];  @endphp
@if(@in_array( request()->segment(1), $pageErrorArray))
    <link type="text/css" rel="stylesheet" href="{{asset('mdash/js_2/custom/errors/error_css.css')}}">
    <script src="{{asset('mdash/js_2/custom/errors/error_helper.js')}}" ></script>
    <script>
        $(document).ready(function () {
            showErrors();
        });
    </script>
@endif

{{--profile page--}}
@php $pageProfileArray = ['profile'];  @endphp
@if(@in_array( request()->segment(1), $pageProfileArray))
    <link type="text/css" rel="stylesheet" href="{{asset('mdash/js_2/custom/errors/error_css.css')}}">
    <script src="{{asset('mdash/js_2/custom/profile.js')}}" ></script>
@endif

{{--withdrawal, wallet--}}
@php $pageWithdrawalArray = ['withdrawals', 'my_balance'];  @endphp
@php $currentPageName = Request::segment(1); @endphp
@if(in_array($currentPageName, $pageWithdrawalArray))
    @include('js_by_page.withdrawal_js')
@endif

{{--home--}}
@php $homePage = ['home'];  @endphp
@php $currentPageName = Request::segment(1); @endphp
@if(in_array($currentPageName, $homePage))
    @include('js_by_page.home_js')
@endif

{{--home--}}
@php $verifyKycPage = ['verify_kyc_page'];  @endphp
@php $currentPageName = Request::segment(1); @endphp
@if(in_array($currentPageName, $verifyKycPage))
    @include('js_by_page.kyc_verification_js')
@endif

{{--courses,--}}
@php $pageWithdrawalArray = ['view-courses', 'view_course', 'saved-course', 'explore', 'category-explore'];  @endphp
@php $currentPageName = Request::segment(1); @endphp
@if(in_array($currentPageName, $pageWithdrawalArray))
    @include('js_by_page.course_js')
@endif

<style>
    label, label > select, label > input, #myTable_info{
        color:white !important
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active {
        cursor: default;
        color: #fff !important;
        border: 1px solid transparent;
        background: transparent;
        box-shadow: none;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        box-sizing: border-box;
        display: inline-block;
        min-width: 1.5em;
        padding: 0.5em 1em;
        margin-left: 2px;
        text-align: center;
        text-decoration: none !important;
        cursor: pointer;
        *cursor: hand;
        color: #fff !important;
        border: 1px solid transparent;
        border-radius: 2px;
    }
</style>
