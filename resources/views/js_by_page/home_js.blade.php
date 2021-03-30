<script>
    // Your web app's Firebase configuration
    // For Firebase JS SDK v7.20.0 and later, measurementId is optional
    // var firebaseConfig = {
    //     apiKey: "AIzaSyCEgCLRwhOGVHEBK2h-3T9_Oo5S2Mxz2Ps",
    //     authDomain: "centadesk-c7f3e.firebaseapp.com",
    //     projectId: "centadesk-c7f3e",
    //     storageBucket: "centadesk-c7f3e.appspot.com",
    //     messagingSenderId: "138970709402",
    //     appId: "1:138970709402:web:eabc07ae6c5085fcc2ce23",
    //     measurementId: "G-1W8LNZ601C"
    // };
    // // Initialize Firebase
    // firebase.initializeApp(firebaseConfig);
    // firebase.analytics();
    // const messaging = firebase.messaging();

    // if (Notification.permission === "denied" || Notification.permission === 'default') {

    //     setTimeout(function () {
    //         bringOutModalMain('.notification-access-modal');
    //     }, 5000);
    // }else{

    //     document.getElementById('noti_man').style.display = 'none';
    // }

    function askPermission() {

        return new Promise(function (resolve, reject) {

            messaging
                .requestPermission()
                .then(function () {

                    // get the token in the form of promise
                    return messaging.getToken()
                })
                .then(function(token) {

                    resolve(token);

                }).catch(function (err) {
                reject(err)
            });

        })


    }

    async function updateUserWebFCMKey(a, user_id) {
        $(a).text('Loading...').attr({'disabled':true});

        let andriod_token = '';
        let ios_token = '';

        let web_token = await askPermission();

        let postData = await postRequest(baseUrl+"api/updateUserFCMKeys/"+user_id,  {andriod_fcm_key:andriod_token, ios_fcm_key:ios_token, web_fcm_key:web_token});
        let {error_code, success_message, error_message} = postData;
        if(error_code == 0){
            $(a).text('Saved Successfully').attr({'disabled':false});
            showValidatorToaster(success_message, 'success');
            myIndexDb.set('web_fcm_key',{fcm_key:web_token}, 'centadesk_db', 'contact_tb');
            setTimeout(function () {
                location.reload();
            }, 2000);
        }else {
            showValidatorToaster(error_message, 'warning');
        }

    }

</script>
