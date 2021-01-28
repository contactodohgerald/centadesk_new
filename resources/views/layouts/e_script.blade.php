@include('basic_urls')
@php $users = auth()->user(); @endphp

<script src="{{asset('dashboard/js/vertical-responsive-menu.min.js')}}"></script>
<script src="{{asset('dashboard/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('dashboard/vendor/OwlCarousel/owl.carousel.js')}}"></script>
<script src="{{asset('dashboard/vendor/semantic/semantic.min.js')}}"></script>
<script src="{{asset('dashboard/js/custom.js')}}"></script>
<script src="{{asset('dashboard/js/night-mode.js')}}"></script>

<script src="{{asset('dashboard/js/jquery-steps.min.js')}}"></script>

<script src="{{asset('dashboard/js/datepicker.min.js')}}"></script>
<script src="{{asset('dashboard/js/datepicker.en.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function () {
        showErrors();
    });
</script>

<script src="{{asset('dashboard/js/banks/banks.js')}}"></script>
<script src="{{asset('dashboard/js/banks/custom.js')}}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="{{asset('dashboard/main/account_verifications/acount_verifications.js')}}"></script>

<script type="text/javascript">
    $('#add-course-tab').steps({
      onFinish: function () {
        alert('Wizard Completed');
      }
    });

    function bringOutModalMain(value) {
        //$(value).removeClass('hidden');
        $(value).modal('show');
    }

    function showErrors() {
        var selected = $(".invalid-feedback");
        for(let i = 0; i < selected.length; i++){
            if($(selected[i]).find('strong').text() !== ''){
                $(selected[i]).css({'display':'block'});
            }
        }
    }

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

                <a class="btn btn-primary" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
                    <button type="submit" class="btn btn-primary" >Proceed</button>
                </div>
            </form>

        </div>
    </div>
</div>



</body>

<!-- Mirrored from gambolthemes.net/html-items/cursus_demo_f12/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 18 Aug 2020 17:39:51 GMT -->
</html>
