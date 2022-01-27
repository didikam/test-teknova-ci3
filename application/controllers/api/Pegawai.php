<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Pegawai extends RestController
{

   function __construct()
   {
      parent::__construct();
      $this->load->model('Pegawai_model', 'pegawai');
   }

   public function tabel_get()
   {
      $this->load->library('datatables_ssp');
      $columns = array(
         array('db' => 'id', 'dt'    => 'id'),
         array('db' => 'nip', 'dt'    => 'nip'),
         array('db' => 'nama', 'dt'    => 'nama'),
         array('db' => 'email', 'dt'    => 'email'),
         array('db' => 'jabatan', 'dt'    => 'jabatan')
      );

      $conn = [
         'user' => $this->db->username,
         'pass' => $this->db->password,
         'db' => $this->db->database,
         'host' => $this->db->hostname,
         "port"    => $this->db->port
      ];

      $table = 'pegawai';
      $primary_key = 'id';
      echo json_encode(
         Datatables_ssp::simple($_GET, $conn, $table, $primary_key, $columns)
      );
   }

   public function index_get()
   {
      $id = $this->get('id');
      if ($id === null) {
         $pegawai = $this->pegawai->getPegawai();
      } else {
         $pegawai = $this->pegawai->getPegawai($id);
      }
      if ($pegawai) {
         $this->response([
            'status' => true,
            'data' => $pegawai
         ], RestController::HTTP_OK);
      } else {
         $this->response([
            'status' => false,
            'message' => 'Tidak ada data',
         ], RestController::HTTP_UNPROCESSABLE_ENTITY);
      }
   }

   public function index_delete()
   {
      $id = $this->delete('id');

      if ($id === null) {
         $this->response([
            'status' => false,
            'message' => 'Harus ada ID',
         ], RestController::HTTP_BAD_REQUEST);
      } else {
         if ($this->pegawai->deletePegawai($id)) {
            $this->response([
               'status' => true,
               'id' => $id,
               'message' => 'Data terhapus',
            ], RestController::HTTP_OK);
         } else {
            $this->response([
               'status' => false,
               'message' => 'Tidak ada ID',
            ], RestController::HTTP_BAD_REQUEST);
         }
      }
   }

   public function index_post()
   {
      $this->validasiInput();
      $data = [
         'nip' => $this->post('nip'),
         'nama' => $this->post('nama'),
         'email' => $this->post('email'),
         'jabatan' => $this->post('jabatan'),
      ];

      if ($this->post('id')) {
         $id = $this->post('id');
         $update = $this->pegawai->updatePegawai($data, $id);
         if ($update) {
            $this->response([
               'status' => true,
               'message' => 'Data telah diubah',
            ], RestController::HTTP_OK);
         } else {
            $this->response([
               'status' => false,
               'message' => 'Gagal diubah',
            ], RestController::HTTP_BAD_REQUEST);
         }
      } else {
         if ($this->pegawai->createPegawai($data)) {
            $this->response([
               'status' => true,
               'message' => 'Data telah ditambahkan',
            ], RestController::HTTP_CREATED);
         } else {
            $this->response([
               'status' => false,
               'message' => 'Gagal ditambahkan',
            ], RestController::HTTP_BAD_REQUEST);
         }
      }
   }
   public function validasiInput()
   {
      $val = $this->get_validation();
      if (!$val) {
         $array = array(
            'nip' => form_error('nip'),
            'nama' => form_error('nama'),
            'email' => form_error('email'),
            'jabatan' => form_error('jabatan')
         );
         $this->response([
            'status' => false,
            'message' => $array,
            'data' => $val,
         ], RestController::HTTP_UNPROCESSABLE_ENTITY);
      }
   }

   private function get_validation()
   {
      $this->load->library('form_validation');
      $config = [
         [
            'field' => 'nip',
            'label' => 'NIP',
            'rules' => 'required|numeric',
            'errors' => [
               'required' => 'NIP harus diisi',
               'numeric' => 'NIP harus angka',
            ],
         ],
         [
            'field' => 'nama',
            'label' => 'Nama',
            'rules' => 'required',
            'errors' => [
               'required' => 'Nama harus diisi',
            ],
         ],
         [
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required|valid_email',
            'errors' => [
               'required' => 'Email harus diisi',
               'valid_email' => 'Email tidak valid',
            ],
         ],
         [
            'field' => 'jabatan',
            'label' => 'Jabatan',
            'rules' => 'required',
            'errors' => [
               'required' => 'Jabatan harus diisi',
            ],
         ],
      ];
      $this->form_validation->set_rules($config);
      return $this->form_validation->run();
   }
}
