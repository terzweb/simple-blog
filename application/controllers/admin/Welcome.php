<?php defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );


class Welcome extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->firstpage();
    }
    
    public function firstpage() {
        #load_thema
        $this->data['home_page'] = "";
        redirect(ADMINURL.'/login');
    }
    
    
}