<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Underconstruction extends PX_Controller {

    function __construct() {
        parent::__construct();
        $this->controller_attr = array('controller' => 'Underconstruction', 'controller_name' => 'Underconstruction', 'controller_id' => 0);
    }

    public function index() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Underconstruction', 'index');

        $this->load->view('frontend/underconstruction/index', $data);
    }

    function info() {
        phpinfo();
    }

}
