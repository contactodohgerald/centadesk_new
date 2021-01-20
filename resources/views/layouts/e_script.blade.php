<script src="{{asset('dashboard/js/vertical-responsive-menu.min.js')}}"></script>
<script src="{{asset('dashboard/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('dashboard/vendor/OwlCarousel/owl.carousel.js')}}"></script>
<script src="{{asset('dashboard/vendor/semantic/semantic.min.js')}}"></script>
<script src="{{asset('dashboard/js/custom.js')}}"></script>
<script src="{{asset('dashboard/js/night-mode.js')}}"></script>

<script type="text/javascript">

    function bringOutModalMain(value) {
        //$(value).removeClass('hidden');
        $(value).modal('show');
    }


</script>

<!-- Modal -->
<div class="modal fade logout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" >
            <div class="modal-header" style="background-color: #800080 !important;">
                <h5  class="modal-title" style="color:white !important; ">Log Out</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" >
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="text-center">Are You Sure You Want To Logout?</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                <a class="btn guoBtn" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>


</body>

<!-- Mirrored from gambolthemes.net/html-items/cursus_demo_f12/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 18 Aug 2020 17:39:51 GMT -->
</html>