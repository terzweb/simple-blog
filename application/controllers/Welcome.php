<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('config_model');
        $this->load->model('postsfront_model');
        $this->load->library('parser');
        $this->load->library('form_validation');
        $this->theme = $this->config_model->getconfig('theme');
    }

	public function index()
	{

        
        $searchText = $this->security->xss_clean($this->input->get('q'));

        
        
        
        $this->load->library('pagination');        
        
        $config['offset'] = $this->security->xss_clean($this->input->get('per_page'));  

        //記事
        
        $config['total_rows'] = $this->postsfront_model->ListingCount($searchText); // 件数

        

        $newblog_count = $this->config_model->getconfig('top_newblog_count'); //Top表示件数
        
        $returns = $this->paginationCompress ( "", $config['total_rows'], $newblog_count, $config['offset']);
        
        


        $temp = $this->postsfront_model->Listing($searchText, $returns["page"], $config['offset']);
        
    

        $this->data = array(
                    'page_title'   => 'ブログリスト',
                    'blog_active' => ' class="active"',
                    'blog_entries' =>  $temp
            );

            if(!empty($temp)){
                $this->make_temp('blog_list_view', 'blog');
            }
            else
            {
                $this->make_temp('blog_nohit', 'blog');
            }


       
            
	}
}
