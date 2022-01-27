<!doctype html>
<html lang="en">

<head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
   <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css" integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous">
   <title><?= $title ?></title>

   <link rel="stylesheet" href="<?= base_url('assets/') ?>style.css">

   <!-- Toastr -->
   <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/toastr/toastr.min.css">

   <script defer src="<?= base_url('assets/fontawesome-free-5.15.4/js/all.js') ?>"></script>
   <!--load all styles -->
   <script>
      var API_URL = '<?= base_url("api/") ?>';
      var BASE_URL = "<?= base_url(); ?>";
   </script>
</head>

<body>
   <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
   <script src="<?= base_url('assets/plugins/jquerysession.js') ?>"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
   <!-- Toastr -->
   <script src="<?= base_url('assets/') ?>plugins/toastr/toastr.min.js"></script>
   <script>
      toastr.options = {
         "closeButton": true,
         "positionClass": "toast-top-right",
      }
      <?php if (isset($_SESSION['system_users'])) : ?>
         $.session.set("myKeys", '<?= $_SESSION['keys']['key'] ?>');
      <?php endif; ?>
   </script>
   <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
   <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container"><a class="navbar-brand" href="<?= base_url() ?>">Test</a>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
               <?php if (isset($_SESSION['system_users'])) : ?>
                  <li class="nav-item">
                     <a class="nav-link" href="<?= base_url('pegawai') ?>">Pegawai</a>
                  </li>
               <?php endif; ?>
            </ul>
            <div class="form-inline my-2 my-lg-0">
               <?php if (isset($_SESSION['system_users'])) : ?>
                  <a href="<?= base_url('auth/logout') ?>" class="btn btn-outline-danger my-2 my-sm-0"><i class="fas fa-sign-out-alt"></i> Logout</a>
               <?php else : ?>
                  <a href="<?= base_url('auth') ?>" class="btn btn-outline-success my-2 my-sm-0"><i class="fas fa-sign-out-alt"></i> Login</a>
               <?php endif; ?>
            </div>
         </div>
      </div>
   </nav>
   <!-- content -->
   <?php $this->load->view($pages); ?>
   <!-- end content -->
</body>

</html>