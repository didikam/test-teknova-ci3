<div class="container mt-5">
   <div class="row">
      <div class="col-12">
         <div class="card">
            <div class="card-header">
               <button class="btn btn-success tambah">
                  <i class="fas fa-plus"></i> Tambah
               </button>
            </div>
            <div class="card-body">
               <table id="tb_pegawai" class="display" style="width:100%">
                  <thead>
                     <tr>
                        <th>NRP</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Jurusan</th>
                        <th>Aksi</th>
                     </tr>
                  </thead>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>
<script>
   var tabel = null;
   var myKeys = $.session.get("myKeys");
   $(document).ready(function() {
      $('input[name="REST-KEY"]').val(myKeys);
      tabel = $('#tb_pegawai').DataTable({
         "processing": true,
         "serverSide": true,
         "ajax": {
            "url": API_URL + "pegawai/tabel?REST-KEY=" + myKeys,
            "type": "GET"
         },
         "columns": [{
               "data": "nip"
            },
            {
               "data": "nama"
            },
            {
               "data": "email"
            },
            {
               "data": "jabatan"
            },
            {
               "data": "id",
               "render": function(data, type, row, meta) {
                  var btn = ``;
                  btn += `<button type="button" class="ml-1 btn btn-warning edit" data-id="` + row.id + `" title="Edit"><i class="fas fa-edit"></i></button>`;
                  btn += `<button type="button" class="ml-1 btn btn-danger hapus" data-id="` + row.id + `" title="Hapus"><i class="fas fa-trash"></i></button>`;
                  return btn;
               },
               className: "text-center",
               orderable: false
            },
         ]
      });
   });

   $(document).off("click", "#tb_pegawai button.hapus")
      .on("click", "#tb_pegawai button.hapus", function(e) {
         $.ajax({
            type: "DELETE",
            url: API_URL + "pegawai",
            dataType: "JSON",
            data: {
               id: $(this).data('id'),
               'REST-KEY': myKeys
            },
            complete: function(xhr, textStatus) {
               var data = JSON.parse(xhr.responseText);
               if (xhr.status === 200) {
                  tabel.ajax.reload(null, true);
               } else {
                  toastr.error(data.message);
               }
            }
         });
      });

   $(document).off("click", "#tb_pegawai button.edit")
      .on("click", "#tb_pegawai button.edit", function(e) {
         $.ajax({
            type: "GET",
            url: API_URL + "pegawai",
            dataType: "JSON",
            data: {
               id: $(this).data('id'),
               'REST-KEY': myKeys
            },
            complete: function(xhr, textStatus) {
               var data = JSON.parse(xhr.responseText);
               if (xhr.status === 200) {
                  data = data.data[0];
                  $('input[name="id"]').val(data.id);
                  $('input[name="nip"]').val(data.nip);
                  $('input[name="nama"]').val(data.nama);
                  $('input[name="email"]').val(data.email);
                  $('input[name="jabatan"]').val(data.jabatan);
                  $('#dataModal').modal('show');
                  $('#dataModalTitle').html('<i class="fas fa-edit"></i> Edit Data pegawai');
                  $(document).off("click", "#dataModalSave").on("click", "#dataModalSave", function(e) {
                     simpan();
                  });
               } else {
                  $('#dataModal').modal('hide');
                  toastr.error(data.message);
               }
            }
         });
      });

   function simpan() {
      var form_data = new FormData($('#form-data')[0]);
      var link = API_URL + 'pegawai';
      $.ajax({
         url: link,
         type: "POST",
         data: form_data,
         dataType: 'json',
         contentType: false,
         processData: false,
         beforeSend: function() {
            $('#dataModalSave').html('<i class="fas fa-spinner fa-spin"></i>');
         },
         complete: function(xhr, textStatus) {
            $('#dataModalSave').html('<i class="fas fa-save"></i> Simpan');
            // console.log(xhr.status);
            // console.log(textStatus);
            // console.log(xhr.responseText);
            var data = JSON.parse(xhr.responseText);
            if (xhr.status === 201 || xhr.status === 200) {
               $('#dataModal').modal('hide');
               toastr.success(data.message);
               tabel.ajax.reload(null, true);
            } else if (xhr.status === 422) {
               var message = data.message;
               $.each(message, function(i, item) {
                  $('#' + i + '_error').html(item);
                  $('#' + i + '_error').show();
                  if (item) {
                     $('#' + i).removeClass("is-valid").addClass("is-invalid");
                  } else {
                     $('#' + i).removeClass("is-invalid").addClass("is-valid");
                  }
               });
            } else {
               $('#dataModal').modal('hide');
               toastr.error(data.message);
            }
         }
      });
   }
   $(document).off("click", "button.tambah")
      .on("click", "button.tambah", function(e) {
         $('#dataModal').modal('show');
         $('#dataModalTitle').html('<i class="fas fa-plus-circle"></i> Tambah Data pegawai');
         $(document).off("click", "#dataModalSave").on("click", "#dataModalSave", function(e) {
            simpan();
         });
      });

   $(document).off("hidden.bs.modal", "#dataModal")
      .on("hidden.bs.modal", "#dataModal", function(e) {
         $('.text-invalid').html('');
         $('#dataModalTitle').html('');
         $('input[name="id"]').val('');
         $('input[name="nip"]').val('').removeClass("is-valid").removeClass("is-invalid");
         $('input[name="nama"]').val('').removeClass("is-valid").removeClass("is-invalid");
         $('input[name="email"]').val('').removeClass("is-valid").removeClass("is-invalid");
         $('input[name="jabatan"]').val('').removeClass("is-valid").removeClass("is-invalid");
         $("#dataModalSave").prop("onclick", null).off("click");
      });
</script>
<!-- Modal -->
<div class="modal fade" id="dataModal" role="dialog" aria-labelledby="dataModalTitle" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" id="dataModalDialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="dataModalTitle"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body" id="dataModalBody">
            <form id="form-data">
               <div class="row">
                  <div class="col-md-12">
                     <input type="hidden" name="id" value="">
                     <input type="hidden" name="REST-KEY" value="">
                     <div class="form-group">
                        <label>NIP</label>
                        <input type="text" id="nip" value="" name="nip" class="form-control" placeholder="NIP">
                        <span class="text-invalid" id="nip_error"></span>
                     </div>
                     <div class="form-group">
                        <label>Nama</label>
                        <input type="text" id="nama" value="" name="nama" class="form-control" placeholder="Nama">
                        <span class="text-invalid" id="nama_error"></span>
                     </div>
                     <div class="form-group">
                        <label>Email</label>
                        <input type="text" id="email" value="" name="email" class="form-control" placeholder="Email">
                        <span class="text-invalid" id="email_error"></span>
                     </div>
                     <div class="form-group">
                        <label>Jabatan</label>
                        <input type="text" id="jabatan" value="" name="jabatan" class="form-control" placeholder="Jabatan">
                        <span class="text-invalid" id="jabatan_error"></span>
                     </div>
                  </div>
               </div>
            </form>
         </div>
         <div class="modal-footer text-center">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" style="float: right;"><i class="fas fa-times-circle"></i> Close</button>
            <button type="button" class="btn btn-success" id="dataModalSave"><i class="fas fa-save"></i> Simpan</button>
         </div>
      </div>
   </div>
</div>