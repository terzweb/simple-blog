<?php defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

require APPPATH . '/libraries/AdminController.php';

class Profile extends AdminController
{

    public function __construct()
    {
        parent::__construct();
        $this->isLoggedIn();
        $this->load->model('user_model');
    }

    public function index()
    {
        $this->firstpage();
    }
    
    public function firstpage() {

        $this->data['profile'] = $this->user_model->getUserInfo($_SESSION['userId']);


            if(!empty($this->data['profile']))
            {

                $this->data['pageTitle'] = 'プロフィール管理';
                
                $this->loadViews("admin/profile_view", $this->data);

            }else{
                show_404();
            }


        

    }


    /**
     * update edit
     */
    function editPost()
    {

            $this->load->library('form_validation');
            
            
            $this->form_validation->set_rules('name','名前','trim');
            $this->form_validation->set_rules('email','E-メール','trim|required|valid_email');
            $this->form_validation->set_rules('password','現パスワード','required|alpha_numeric|callback_passwordcheck');
            $this->form_validation->set_rules('passwordNew','パスワード変更','trim|alpha_numeric');
            $this->form_validation->set_rules('passwordRe','パスワード変更 確認','trim|alpha_numeric|matches[passwordNew]');
            
            
            if($this->form_validation->run() == FALSE)
            {
                $this->firstpage();
            }
            else
            {



                //パスワード変更が入力されているか否か
                if(!empty($this->security->xss_clean($this->input->post('passwordRe'))))
                {
                    //パスワード更新
                  
                    $userInfo = array(
                        'name'=> $this->security->xss_clean($this->input->post('name')),
                        'email'=> $this->security->xss_clean($this->input->post('email')), 
                        'password'=>getHashedPassword($this->security->xss_clean($this->input->post('passwordNew'))),                  
           
                        'updatedDtm'=> date('Y-m-d h:i:s')
                        );
                    
         

                    $result = $this->user_model->updatedata($userInfo,$_SESSION['userId']);
                    
                    if($result == true)
                    {
                        //セッション更新
                        $sessionArray = array(
                        'name'=> $this->security->xss_clean($this->input->post('name')),
                        );

                        $this->session->set_userdata($sessionArray);


                        $this->session->set_flashdata('success', '更新しました');
                    }
                    else
                    {
                        $this->session->set_flashdata('error', '更新失敗');
                    }

                    redirect(ADMINURL.'/profile');

                    

                }
                else
                {

                    //通常更新
                    $userInfo = array(
                        'name'=> $this->security->xss_clean($this->input->post('name')),
                        'email'=> $this->security->xss_clean($this->input->post('email')), 
             
                        'updatedDtm'=> date('Y-m-d h:i:s')
                        );
                    

                    $result = $this->user_model->updatedata($userInfo,$_SESSION['userId']);

                    
                    
                    if($result == true)
                    {
                        //セッション更新
                        $sessionArray = array(
                        'name'=> $this->security->xss_clean($this->input->post('name')),
                        );

                        $this->session->set_userdata($sessionArray);


                        $this->session->set_flashdata('success', '更新しました');
                    }
                    else
                    {
                        $this->session->set_flashdata('error', '更新失敗');
                    }

                    redirect(ADMINURL.'/profile');


                }

                
            }
        
    }


    function passwordcheck($password)
    {

        //パスワードの確認
        $user = $this->user_model->getUserInfo($_SESSION['userId']);

        if(verifyHashedPassword($password, $user['0']->password)){
            //認証OK
            return true;               

        } else {
            //認証　駄目
            $this->form_validation->set_message('passwordcheck', 'パスワード認証エラーです');
            return FALSE;
            
        }        

    }
    
    
}