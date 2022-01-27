<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai extends CI_Controller
{
   public function __construct()
   {
      parent::__construct();
      $this->appauth->is_logged_in();
   }
   public function index()
   {
      $data['title'] = "Pegawai";
      $data['pages'] = "pegawai";
      $this->load->view('template', $data);
   }
}
