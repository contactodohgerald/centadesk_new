
<script>

    async function activateCoursesStatus(a) {
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
                $(a).text('Confirm Courses Status').attr({'disabled':false});
                errorDisplay('Please select at least one course to continue');
                return;
            }

            let postData = await postRequest(baseUrl+'api/activateCoursesStatus', {dataArray:dataArray.join('|')});
            let {error_code, success_statement, error_message} = postData;
            if(error_code == 0){
                $(a).text('Confirm Courses Status').attr({'disabled':false});
                successDisplay(success_statement);
                setTimeout(function () {
                    location.reload();
                }, 5000)
            }else{
                $(a).text('Confirm Courses Status').attr({'disabled':false});
                errorDisplay(error_message);
            }
        }

    }

    async function saveCourse(a) {
        $(a).text('Loading.....').attr({'disabled':true});

        let course_id = $(".course_unique_id").val();
        let user_id = $(".user_unique_id").val();

        let postData = await postRequest(baseUrl+'api/saveCourse', {course_unique_id:course_id, user_unique_id:user_id});
        let {error_code, success_statement, error_message} = postData;
        if(error_code == 0){
            $(a).text('Course Saved').attr({'disabled':false});
            successDisplay(success_statement);
            // setTimeout(function () {
            //     location.reload();
            // }, 5000)
        }else{
            $(a).text('Save').attr({'disabled':false});
            errorDisplay(error_message);
        }

    }

</script>