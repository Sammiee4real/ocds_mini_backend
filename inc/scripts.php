 <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Are you sure you want to logout?</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="./logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>

   <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<!--//Metis Menu -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" type="text/javascript"></script>


  <script type="text/javascript">
    $(document).ready(function () {
         // toastr.info('Page Loaded!');
         $('.js-example-basic-single').select2();
         $('.js-example-basic-multiple').select2();
         $('.js-example-basic-multiple2').select2();


          $(".js-example-tokenizer").select2({
          tags: true,
          tokenSeparators: [',', ' '],
          maximumSelectionLength: 1
          });


          $(".js-example-tokenizer2").select2({
          tags: true,
          tokenSeparators: [',', ' ']
          });

           $(".js-example-tokenizer3").select2({
          tags: true,
          tokenSeparators: [',', ' ']
          });



          // $('#example').DataTable();
          // $('.example').DataTable();

          // js-example-basic-multiple
          $('.logintest').click(function (e) {
          e.preventDefault();
          toastr.error("Testing lllllll", "Caution!");
          });

        

        $('#cmd_admin_login').click(function (e) {
            e.preventDefault();

            $.ajax({
            url:"../ajax/admin_login.php",
            method: "POST",
            data:$('#login_form_admin').serialize(),
            beforeSend: function(){
            //$(this).html('loading...');
            $("#cmd_admin_login").attr('disabled', true);
            $("#cmd_admin_login").text('logging in...');
            },
            success:function(data){
            //alert(data);
            if(data == 200){

            toastr.success("Admin Login was successful...", "Success!");
            setTimeout( function(){ window.location.href = "home.php"; }, 2000);



            }else{
            toastr.error(data, "Caution!");


            }

            $('#cmd_admin_login').attr('disabled', false);
            $('#cmd_admin_login').text('Login');

            }


            });

            });

      


            $('#cmd_login').click(function (e) {
            e.preventDefault();

            $.ajax({
            url:"ajax/login.php",
            method: "POST",
            data:$('#login_form').serialize(),
            beforeSend: function(){
            //$(this).html('loading...');
            $("#cmd_login").attr('disabled', true);
            $("#cmd_login").text('logging in...');
            },
            success:function(data){
            //alert(data);
            if(data == 200){

            toastr.success("Login was successful...", "Success!");
            setTimeout( function(){ window.location.href = "home.php"; }, 2000);



            }else{
            toastr.error(data, "Caution!");


            }

            $('#cmd_login').attr('disabled', false);
            $('#cmd_login').text('Login');

            }


            });

            });



});


</script>

</body>

</html>