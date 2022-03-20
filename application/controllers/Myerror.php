<?php defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

/* 
 * カスタムエラーページ
 */

class Myerror extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

    }


    public function error_404() 
    {
        $this->global['pagetitle'] = '404 エラー';

        $this->data = array(
            'meta_page_title'   => "404 Page Not Found",
            'page_title'   => "404 Page Not Found"
        );
        
        $this->output->set_status_header('404');
        $this->make_temp('404', '');
        
    }

    
    
}