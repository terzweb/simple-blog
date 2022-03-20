<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tags extends MY_Controller {
    
    
        public function __construct()
        {
            parent::__construct();

            // 独自処理
            $this->load->helper('url');
            $this->load->model('postsfront_model');
            $this->load->model('tags_model');
        }
    
	public function index(){
        redirect(base_url());
	}
        
    function id($tag = null){

        if (empty($this->uri->segment(2))) {
            show_404($page = '', $log_error = TRUE);
        }


        $str = $this->security->xss_clean($tag);


        $delimiter = "\x20";
        $datalist = preg_replace('/[\x{a0}\x{3000}]/u', $delimiter, $str);
        
        $parts = explode($delimiter, $datalist);
        
        if(!empty($parts['1'])){
            redirect( base_url('tags/'.$parts['0']) );
        }


        $searchTag = $parts['0'];
        $data['searchTag'] = $searchTag;


        
        $this->load->library('pagination'); 
        
        $config['offset'] = $this->security->xss_clean($this->input->get('per_page'));  

        //記事
        
        $config['total_rows'] = $this->postsfront_model->ListingCount($searchTag); // 件数
        
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
        $returns = $this->paginationCompress ( "tags/".$searchTag."/", $config['total_rows'], $config['offset']);

        $temp = $this->postsfront_model->tagListing($searchTag, $returns["page"], $config['offset']);


        $this->data = array(
            'tag_word_count'=>$config['total_rows'],
                    'tag_word' => $data['searchTag'],
                    'page_title'   => 'タグ検索 '.$data['searchTag'],
                    'blog_active' => ' class="active"',
                    'blog_entries' =>  $temp
            );




        $this->make_temp('blog_list_view', 'blog');

        

    }

}