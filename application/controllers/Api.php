<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Api extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->helper('function_helper');

        $this->load->helpers('Jwt');
        $this->load->helpers('Authorization');

        $this->result = array();
        $this->cekMargin = 0;
    }

    public function getToken_get($data)
    {

        $token = Authorization::generateToken($data);

        echo json_encode(array('token' => $token));
    }

    public function cekToken_post()
    {
        $headers = $this->input->request_headers();
        $token = validate_token($headers);
        if ($token) {
            echo json_encode(array('message' => 'Token valid'));
        } else {
            echo json_encode(array('message' => 'Token tidak valid'));
        }
    }
}
