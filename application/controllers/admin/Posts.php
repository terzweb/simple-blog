<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/AdminController.php';

class Posts extends AdminController
{

    public function __construct()
    {
        parent::__construct();
        $this->isLoggedIn();

        $this->load->model('posts_model');
        $this->load->model('tags_model');
        $this->load->model('config_model');
        $this->data['theme'] = $this->config_model->getconfig('theme');
        
    }
    
    public function index(){       
        
        $this->postList();
    }
    

    function postList()
    {
       
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $this->data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->posts_model->postsListingCount($searchText);

			$returns = $this->paginationCompress ( ADMINURL."/posts/postList/", $count, 10, 4 );
            
            $this->data['postsRecords'] = $this->posts_model->postListing($searchText, $returns["page"], $returns["segment"]);
            $this->load_options();
            
            
            $this->data['pageTitle'] = '記事リスト';
            
            $this->loadViews("admin/posts_list_view", $this->data);
       
    }

    function addNew()
    {
            
            $this->load_options();

            //タグリスト
            $this->load->model('tags_model');           
            $this->data['tags'] = $this->tags_model->pulldown_list();
            
            $this->data['pageTitle'] = '新規作成';
            
            $this->loadViews("admin/posts_addnew_view", $this->data);
       
    }


    
    function addNewPost()
    {

            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('title','タイトル','trim|required|max_length[128]');
            $this->form_validation->set_rules('url','URL','trim|required|max_length[128]');
            $this->form_validation->set_rules('content','内容','required');
            $this->form_validation->set_rules('status','ステータス','trim|required|numeric');
            $this->form_validation->set_rules('opendate','公開日時','required');
            
            
            if($this->form_validation->run() == FALSE)
            {
                $this->addNew();
            }
            else
            {
               
                $title = $this->security->xss_clean($this->input->post('title'));
                $url = urlencode($this->security->xss_clean($this->input->post('url')));
                $img_url = urldecode($this->security->xss_clean($this->input->post('img_url')));
                $content = html_escape($this->input->post('content'));
                $tags = $this->security->xss_clean($this->input->post('tag[]'));
                $status = $this->input->post('status');
                $opendate = $this->security->xss_clean($this->input->post('opendate'));

                
                $userInfo = array(
                    'title'=>$title,
                    'url'=>$url,
                    'img_url' => $img_url,
                    'contents'=>$content,
                    'status'=>$status,
                    'opendate'=>$opendate
                    );
                
                $result = $this->posts_model->addNewPost($userInfo);
                
                if($result > 0)
                {
                    if(!empty($tags)){

    
                        foreach($tags as $key => $tag){
                            $exitTag = $this->tags_model->find_by_id($tag);
    
                            if(!empty($exitTag))
                            {
                                //
                                if($this->tags_model->checkTblmapdata($result,$tag) == true){
                                    $post_tag = array(
                                        'post_id' => $result,
                                        'tag_id' => $tag
                                    );
                                    $this->tags_model->insertTagMap($post_tag);
                                    
                                }
    
                            }else{
    
                                    
                                $newTag = array(
                                    'tagName' => $tag,
                                    'tagslug' => url_title($tag,'-',true)
                                );
                                $tag_id = $this->tags_model->insertTag($newTag);
    
                                $post_tag = array(
                                    'post_id' => $result,
                                    'tag_id' => $tag_id
                                );
                                $this->tags_model->insertTagMap($post_tag);
    
                            }
    
                        }
    
    
                    }
                    $this->session->set_flashdata('success', '新規投稿に成功しました');
                }
                else
                {
                    $this->session->set_flashdata('error', '投稿に失敗しました');
                }
                
                redirect(ADMINURL.'/posts');
            }
       
    }

    

    function editOld($postid = NULL)
    {

            if($postid == null)
            {
                redirect('postList');
            }

            $this->load_options();

            
            $postInfo = $this->posts_model->getPostInfo($postid);   //データ参照
            $this->data['postInfo'] = $postInfo[0];

            //投稿タグ取得
            $tagsInfo = $this->tags_model->getTaglist($postid);
            //表示用にIDのみに調整
            $tag_ids = array();
            if(!empty($tagsInfo)){
                foreach($tagsInfo as $tagids){
                    $tag_ids[] = $tagids['tag_id'];
                }
            }
            $this->data['gettagids'] = $tag_ids;


            //タグリスト
            $this->load->model('tags_model');           
            $this->data['tags'] = $this->tags_model->pulldown_list();

            $this->data['pageTitle'] = 'ブログ編集';

            $this->loadViews("admin/posts_edit_old", $this->data);      
    }
    
    

    function editPost()
    {

            $this->load->library('form_validation');
            
            $postid = $this->input->post('id');
            
            $this->form_validation->set_rules('title','タイトル','trim|required|max_length[128]');
            $this->form_validation->set_rules('url','URL','trim|required|max_length[128]');
            $this->form_validation->set_rules('content','内容','required');            
            $this->form_validation->set_rules('status','ステータス','trim|required|numeric');
            $this->form_validation->set_rules('opendate','公開日時','required');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->editOld($postid);
            }
            else
            {
                $title = $this->security->xss_clean($this->input->post('title'));
                $url = urlencode($this->security->xss_clean($this->input->post('url')));
                $img_url = urldecode($this->security->xss_clean($this->input->post('img_url')));
                $content = html_escape($this->input->post('content'));                
                $status = $this->input->post('status');
                $opendate = $this->security->xss_clean($this->input->post('opendate'));
                $tags = $this->security->xss_clean($this->input->post('tag[]'));

       




                
                $updateInfo = array(
                    'title'=>$title,
                    'url'=>$url, 
                    'img_url' => $img_url,
                    'contents'=>$content,
                    'status'=>$status,
                    'opendate'=>$opendate
                );
                
                $result = $this->posts_model->editPost($updateInfo, $postid);
                
                if($result == true)
                {
                    if(!empty($tags)){

                        //postIdとタグIDと不マッチを参照して削除する tbltagmap
                        $this->load->model('tags_model');
                        $this->tags_model->deliteByNotTagId($postid,$tags);
    
    
                        foreach($tags as $key => $tag){
                            $exitTag = $this->tags_model->find_by_id($tag);
    
                            if(!empty($exitTag))
                            {
                                //
                                if($this->tags_model->checkTblmapdata($postid,$tag) == true){
                                    $post_tag = array(
                                        'post_id' => $postid,
                                        'tag_id' => $tag
                                    );
                                    $this->tags_model->insertTagMap($post_tag);
                                    
                                }
    
                            }else{
    
                                    
                                $newTag = array(
                                    'tagName' => $tag,
                                    'tagslug' => url_title($tag,'-',true)
                                );
                                $tag_id = $this->tags_model->insertTag($newTag);
    
                                $post_tag = array(
                                    'post_id' => $postid,
                                    'tag_id' => $tag_id
                                );
                                $this->tags_model->insertTagMap($post_tag);
    
                            }
    
                        }
    
    
                    }

                    $this->session->set_flashdata('success', '投稿を更新しました');
                }
                else
                {
                    $this->session->set_flashdata('error', '投稿更新失敗');
                }
                
                redirect(ADMINURL.'/posts/editOld/'.$postid.'');
            }
       
    }
    
        function deletePost()
    {
        if ($this->input->is_ajax_request())
        {

            $userId = $this->input->post('postId');
            $userInfo = array('isDeleted'=>1);  //削除
            
            $result = $this->posts_model->deletePost($userId, $userInfo);
            
            if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            else { echo(json_encode(array('status'=>FALSE))); }

        }
        else
        {
            return;
        }
       
    }



    function checkUrlExists()
    {
        if ($this->input->is_ajax_request())
        {
        $urlId = $this->input->post("url");

            if(!empty($urlId)){
                $result = $this->posts_model->checkUrlExists($urlId);
                

                if(empty($result)){ echo("true"); }
                else { echo("false"); }

            }
        }
        else
        {
            return;
        }
    }


    

}
