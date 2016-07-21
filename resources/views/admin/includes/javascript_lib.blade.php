    <!-- <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script> -->
    {!! HTML::script('public/backend/plugins/jQuery/jQuery-2.1.4.min.js') !!}
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

    <!-- Bootstrap 3.3.5 -->
    <!-- <script src="bootstrap/js/bootstrap.min.js"></script> -->
    {!! HTML::script('public/backend/bootstrap/js/bootstrap.min.js') !!}
    <!-- Slimscroll -->
    <!-- <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>-->
    {!! HTML::script('public/backend/plugins/slimScroll/jquery.slimscroll.min.js') !!}
    <!-- FastClick -->
   
    <!-- <script src="dist/js/app.min.js"></script> -->
    {!! HTML::script('public/backend/dist/js/app.min.js') !!}
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <!-- <script src="dist/js/pages/dashboard.js"></script> -->
    <!-- AdminLTE for demo purposes -->
    <!-- <script src="dist/js/demo.js"></script> -->
    {!! HTML::script('public/backend/dist/js/demo.js') !!}
    {!! HTML::script('public/backend/plugins/bootstrap-validations/dist/js/bootstrapValidator.js') !!}
<!-- Thêm messages và confirm -->
@include('admin.includes.confirm')
@include('admin.includes.messages')

<!-- Thêm lib -->

@section('extra-lib')
@show