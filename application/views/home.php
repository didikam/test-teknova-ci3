<div class="container mt-5">
   <div class="row">
      <div class="col-12">
         <div class="card">
            <div class="card-body">
               <h5>Selamat datang di sistem hasil test Teknova</h5>
               <?php if (!isset($_SESSION['system_users'])) : ?>
                  <p>Silahkan login untuk mengakses data</p>
                  <a href="<?= base_url('auth') ?>" class="btn btn-success"><i class="fas fa-sign-in-alt"></i> Login</a>
               <?php endif; ?>
            </div>
         </div>
      </div>
   </div>
</div>