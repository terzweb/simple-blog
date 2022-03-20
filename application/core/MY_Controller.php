<?php defined('BASEPATH') OR exit('No direct script access allowed');



class MY_Controller extends CI_Controller {
    
    
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('config_model');
        $this->load->model('postsfront_model');
        $this->load->model('tags_model');
        $this->load->library('parser');
    }
    
    protected function make_temp($content = null, $layout = '') {
        /*サイト内コンフィグ項目読み込み*/
        $this->data['theme_folder_name'] =  $this->config_model->getconfig('theme'); #テンプレートフォルダ
        
        $this->data['site_title'] =  $this->config_model->getconfig('site_title'); #サイトタイトル
        $this->data['meta_keyword'] =  $this->config_model->getconfig('meta_keyword'); #キーワード
        $this->data['meta_description'] =  $this->config_model->getconfig('meta_description'); #説明
        $this->data['base_url'] = base_url();
        $sidebar_newblog_count = $this->config_model->getconfig('sidebar_newblog_count'); #サイドバー表示件数
        $sidebar_tags_count = $this->config_model->getconfig('sidebar_tags_count'); #サイドバー表示件数

        //最新投稿を取得    サイドバー
        $this->data['blog_newlist'] = $this->blognewlist($sidebar_newblog_count);
        //タグリストの集計
        $this->data['tags_list'] = $this->tags_model->allTagList($sidebar_tags_count);

        
        if(empty($this->data['page_title'])){
            $this->data['page_title'] = '';
        }else{
            $this->data['page_title'] = $this->data['page_title'];
        }
        if(empty($this->data['meta_page_title'])){
            $this->data['meta_page_title'] = '';
        }else{
            $this->data['meta_page_title'] = ' | '.$this->data['meta_page_title'].'';
        }
        
        
        $this->data['blog_meta'] = $this->parser->parse('themes/'.$this->data['theme_folder_name'].'/blog_meta',$this->data, TRUE);
        $this->data['blog_header'] = $this->parser->parse('themes/'.$this->data['theme_folder_name'].'/blog_header',$this->data, TRUE);
        $this->data['blog_sidebar'] = $this->parser->parse('themes/'.$this->data['theme_folder_name'].'/blog_sidebar',$this->data, TRUE);
        $this->data['blog_rogospace'] = $this->parser->parse('themes/'.$this->data['theme_folder_name'].'/blog_rogospace',$this->data, TRUE);        
        $this->data['blog_footer'] = $this->parser->parse('themes/'.$this->data['theme_folder_name'].'/blog_footer',$this->data, TRUE);
        $this->data['blog_footer_meta'] = $this->parser->parse('themes/'.$this->data['theme_folder_name'].'/blog_footer_meta',$this->data, TRUE);
        




        
        if($layout == ''){
            $this->data['blog_content'] = (is_null($content)) ? '' : $this->parser->parse('themes/'.$this->data['theme_folder_name'].'/'.$content, $this->data, TRUE);
            $this->parser->parse('themes/'.$this->data['theme_folder_name'].'/blog_layout',$this->data);
        }elseif($layout == 'blog'){
            $this->data['blog_content'] = (is_null($content)) ? '' : $this->parser->parse('themes/'.$this->data['theme_folder_name'].'/'.$content, $this->data, TRUE);
            $this->parser->parse('themes/' .$this->data['theme_folder_name']. '/blog_layout', $this->data);
        }
        
        
        
    }

    function blognewlist($count=5)
    {
        $recoard = $this->postsfront_model->Listing('', $count, 0);
        return  $recoard;
    }

    function tagslist()
    {
        $recoard = $this->postsfront_model->maketaglist();
        return  $recoard;
    }


    
    protected function bootstrap_messege($string = null,$mess = null) {
        if($string == 'errer'){
            $messegebox = '
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                '.$mess.'
              </div>
            ';
            
        }elseif($string == 'success'){
            $messegebox = '
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                '.$mess.'
              </div>
            ';
        }
        return $messegebox;
    }


	
	function paginationCompress($link, $count, $perPage = 10, $segment = 3) {
		$this->load->library ( 'pagination' );
        
		$config ['base_url'] = base_url () . $link;
		$config ['total_rows'] = $count;
		$config ['uri_segment'] = $segment;
		$config ['per_page'] = $perPage;
        $config['reuse_query_string'] = TRUE;
        $config ['page_query_string'] = TRUE;
		$config ['num_links'] = 5;
		$config ['full_tag_open'] = '<nav><ul class="pagination">';
		$config ['full_tag_close'] = '</ul></nav>';
		$config ['first_tag_open'] = '<li class="page-link">';
		$config ['first_link'] = 'First';
		$config ['first_tag_close'] = '</li>';
		$config ['prev_link'] = 'Previous';
		$config ['prev_tag_open'] = '<li class="page-link">';
		$config ['prev_tag_close'] = '</li>';
		$config ['next_link'] = 'Next';
		$config ['next_tag_open'] = '<li class="page-link">';
		$config ['next_tag_close'] = '</li>';
		$config ['cur_tag_open'] = '<li class="active page-link"><a href="#">';
		$config ['cur_tag_close'] = '</a></li>';
		$config ['num_tag_open'] = '<li class="page-link">';
		$config ['num_tag_close'] = '</li>';
		$config ['last_tag_open'] = '<li class="page-link arrow">';
		$config ['last_link'] = 'Last';
		$config ['last_tag_close'] = '</li>';
	
		$this->pagination->initialize ( $config );
		$page = $config ['per_page'];
		$segment = $this->uri->segment ( $segment );
	
		return array (
				"page" => $page,
				"segment" => $segment
		);
	}
        

    
}

