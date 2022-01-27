<div class="container mt-5">
   <div class="row justify-content-center">
      <div class="col-6">
         <div class="card">
            <div class="card-body">
               <p class="login-box-msg">Masuk dengan akun anda</p>
               <div id="alert"> </div>
               <form id="form-data" method="post">
                  <div class="input-group mb-3">
                     <input type="text" name="username" id="username" class="form-control" placeholder="Username">
                     <div class="input-group-append">
                        <div class="input-group-text">
                           <span class="fas fa-envelope"></span>
                        </div>
                     </div>
                     <div class="text-invalid" id="username_error"></div>
                  </div>
                  <div class="input-group mb-3">
                     <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                     <div class="input-group-append">
                        <div class="input-group-text" id="lock">
                           <span id="loc" class="fas fa-eye-slash"></span>
                        </div>
                     </div>
                     <div class="text-invalid" id="password_error"></div>
                  </div>
                  <button class="btn btn-block btn-success">
                     <i class="fas fa-sign-in-alt mr-2"></i> Masuk
                  </button>
                  <a href="<?= base_url(); ?>" class="btn btn-block btn-secondary">
                     <i class="fas fa-arrow-circle-left mr-2"></i> Home
                  </a>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<script>
   $("#form-data").submit(function(event) {
      masuk();
      event.preventDefault();
   });
   $('#lock').on('click', function() {
      var a = $('#password').attr("type");
      if (a == 'password') {
         $('#password').attr("type", 'text');
         $('#loc').attr("class", 'fas fa-eye');
      } else {
         $('#password').attr("type", 'password');
         $('#loc').attr("class", 'fas fa-eye-slash');
      }
   });

   function masuk() {
      var form_data = new FormData($('#form-data')[0]);
      var link = BASE_URL + 'auth/login';
      $.ajax({
         url: link,
         type: "POST",
         data: form_data,
         dataType: 'json',
         contentType: false,
         processData: false,
         beforeSend: function() {
            $('.text-invalid').html('');
            $('.form-control').removeClass("is-invalid").removeClass("is-valid");
         },
         success: function(data) {
            if (data.status == 1) {
               $('#alert').html('<div class="alert alert-success" role="alert">' + data.pesan + '</div>')
               setTimeout(function() {
                  window.location.href = BASE_URL + "home";
               }, 2000);
            } else if (data.status == 3) {
               $.each(data.pesan, function(i, item) {
                  $('#' + i + '_error').html(item);
                  $('#' + i + '_error').show();
                  if (item) {
                     $('#' + i).removeClass("is-valid").addClass("is-invalid");
                  } else {
                     $('#' + i).removeClass("is-invalid").addClass("is-valid");
                  }
               });
            } else {
               $('#alert').html('<div class="alert alert-danger" role="alert">' + data.pesan + '</div>')
               setTimeout(function() {
                  $('#alert').html('');
               }, 2000);
            }
         }
      });
   }
</script>