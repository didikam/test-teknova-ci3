<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Appauth
{
    public function login($user, $pass)
    {
        $ci = get_instance();
        $ci->db->select('*');
        $ci->db->from('system_users');
        $ci->db->where('usr_username', $user);
        $ci->db->limit(1);
        $query = $ci->db->get();
        $result = false;
        if ($query->num_rows() == 1) {
            $userpass = $query->result_array()[0]['usr_password'];
            if (password_verify($pass, $userpass)) {
                $result = $query->row_array();
            } else {
                echo json_encode(array('status' => 0, 'pesan' => 'Password tidak sesuai !!'));
                die;
            }
        } else {
            echo json_encode(array('status' => 0, 'pesan' => 'Username tidak terdaftar !!'));
            die;
        }
        if ($result) {
            $ses['system_users'] = $result;
            $ci->session->set_userdata($ses);
            $this->setKeys($result['usr_id']);
            echo json_encode(array('status' => 1, 'pesan' => 'Berhasil masuk !!'));
        } else {
            echo json_encode(array('status' => 0, 'pesan' => 'Gagal Masuk !!'));
        }
    }

    public function logout()
    {
        $ci = get_instance();
        $ci->db->delete('keys', ['user_id' => $_SESSION['keys']['user_id']]);
        $sess_array = array(
            'system_users',
            'keys'
        );
        $ci->session->unset_userdata($sess_array);
    }

    public function is_logged_in()
    {
        $ci = get_instance();
        if (!$ci->session->userdata('system_users')) {
            redirect('/auth');
        }
    }

    public function generatePasswordHash($string)
    {
        $string = is_string($string) ? $string : strval($string);
        $pwHash = password_hash($string, PASSWORD_BCRYPT);
        if (password_needs_rehash($pwHash, PASSWORD_BCRYPT)) {
            $pwHash = password_hash($string, PASSWORD_BCRYPT);
        }
        return $pwHash;
    }

    public function setKeys($id = null)
    {
        $ci = get_instance();
        if ($id) {
            $key = random_string("alnum", 20);
            $data = [
                'user_id' => $id,
                'key' => $key,
            ];
            $ci->db->insert('keys', $data);
            $ses['keys'] = $data;
            $ci->session->set_userdata($ses);
        }
    }
}
