<?php

class Pegawai_model extends CI_Model
{
   public function getPegawai($id = null)
   {
      if ($id != null) {
         $this->db->where('id', $id);
      }
      return $this->db->get('pegawai')->result_array();
   }

   public function deletePegawai($id)
   {
      $this->db->delete('pegawai', ['id' => $id]);
      return $this->db->affected_rows();
   }

   public function createPegawai($data)
   {
      $this->db->insert('pegawai', $data);
      return $this->db->affected_rows();
   }

   public function updatePegawai($data, $id)
   {
      if ($this->getPegawai($id)) {
         $this->db->update('pegawai', $data, ['id' => $id]);
         $this->db->trans_complete();
         return $this->db->trans_status();
      } else {
         return false;
      }
   }
}
