<?php defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );



class Post extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('postsfront_model');
        $this->load->model('tags_model');
  
    }

    public function index()
    {
        redirect(base_url());
    }
    






    public function id() {

        if (empty($this->uri->segment(2))) {
            show_404($page = '', $log_error = TRUE);
        }

        //テーブルpagesのtitleと参照
        $data['blogdata'] = $this->postsfront_model->find_by_url($this->uri->segment(2));
        
        
        //件数無しだったらページノットファウンド
        if (empty($data['blogdata'])) {
            show_404($page = '', $log_error = TRUE);
        }

        //タグの取得
        $taglist = $this->tags_model->pageTagList($data['blogdata'][0]['id']);

        

        list($year, $month, $day, $time) = preg_split(("/[\s,-]/"), $data['blogdata'][0]['opendate']);

        $this->data = array(
                    'page_title'   => $data['blogdata'][0]['title'],
                    'blog_title' => $data['blogdata'][0]['title'],
                    'blog_img_url' => $data['blogdata'][0]['img_url'],
                    'blog_opendate' => $data['blogdata'][0]['opendate'],
                    'blog_opendate_all' => date('c',strtotime($data['blogdata'][0]['opendate'])),
                    'blog_opendate_wareki' => ''.$year.'年'.$month.'月'. $day .'日',
                    'img_url' => $data['blogdata'][0]['img_url'],
                    'blog_active' => ' class="active"',
                    'blog_entries' =>  html_entity_decode($data['blogdata']['0']['contents']),
                    'blog_tags' => $taglist
                );
            

        $this->make_temp('blog_view', 'blog');

    }




    
    
}