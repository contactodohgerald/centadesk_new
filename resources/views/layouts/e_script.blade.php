@include('basic_urls')

@include('modal')

@php $users = auth()->user(); @endphp

<script src="{{asset('dashboard/js/vertical-responsive-menu.min.js')}}"></script>
<script src="{{asset('dashboard/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('dashboard/vendor/OwlCarousel/owl.carousel.js')}}"></script>
<script src="{{asset('dashboard/vendor/semantic/semantic.min.js')}}"></script>
<script src="{{asset('dashboard/js/custom.js')}}"></script>
<script src="{{asset('dashboard/js/night-mode.js')}}"></script>

<script src="{{asset('dashboard/js/jquery-steps.min.js')}}"></script>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>

<script src="{{asset('dashboard/js/datepicker.min.js')}}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="{{asset('dashboard/custom/custom-tinymce.js')}}"></script>
<script src="{{asset('dashboard/custom/Basic-function.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
<!-- <script src="{{asset('dashboard/custom/validatorClass.js')}}"></script> -->
<script src="{{asset('dashboard/assets/loader.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
<script src="{{asset('toast/jquery.toast.js')}}"></script>

@include('js_files.js_by_page')

<script type="text/javascript">
    function closeErrorCarrierBox(a) {
        // console.log('yh')
        $(a).addClass('hidden');
    }

    $(document).ready(function() {
        // showErrors();

        // toastr.options = {
        //     "closeButton": false,
        //     "debug": false,
        //     "newestOnTop": false,
        //     "progressBar": false,
        //     "positionClass": "toast-top-right",
        //     "preventDuplicates": false,
        //     "onclick": null,
        //     "showDuration": "300",
        //     "hideDuration": "1000",
        //     "timeOut": "5000",
        //     "extendedTimeOut": "1000",
        //     "showEasing": "swing",
        //     "hideEasing": "linear",
        //     "showMethod": "show",
        //     "hideMethod": "fadeOut"
        // }
        $('#add-course-tab').steps({
            // onFinish: function() {
            //     // alert('Wizard Completed');
            // }
        });


        function showErrors() {
            var selected = $(".invalid-feedback");
            for (let i = 0; i < selected.length; i++) {
                if ($(selected[i]).find('strong').text() !== '') {
                    $(selected[i]).css({
                        'display': 'block'
                    });
                }
            }
        }
    });
</script>


<!-- The Modal -->
<div class="modal logout" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: #333 !important;">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Sign Out</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="text-center">Are You Sure You Want To Sign Out?</h3>
                    </div>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <a class="btn btn-primary" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Sign Out
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>

<!-- The Modal -->
<div class="modal accountTopUp" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: #333 !important;">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Account TopUp</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form action="{{route('top_up' )}}" method="POST">
                @csrf
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="ui search focus mt-30">
                                <label for="topUpAmount">Enter Amount In ({{$users->getBalanceForView()['data']['currency']}})</label>
                                <input class="form-control" type="number" name="topUpAmount" id="topUpAmount" required placeholder="Enter Amount" autofocus>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Proceed</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- The Modal -->
<div class="modal notification-access-modal" id="notification-access-modal">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: #333 !important;">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Allow Push Notification</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 offset-5">
                        <img src="{{asset('dashboard/images/logo.svg')}}" alt="">
                    </div>
                    <div class="col-md-12 center">
                        <h4>{{env('APP_NAME')}} would want to send you push notification, so that you could always keep track of your notifications.</h4>
                    </div>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" onclick="updateUserWebFCMKey(this, '{{auth()->user()->unique_id}}')">Grant Permission</button>
            </div>
        </div>
    </div>
</div>

</body>

</html>
