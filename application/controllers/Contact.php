<?php defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class Contact extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('config_model');
        $this->data['page_title'] = 'お問い合わせ';
        $this->data['meta_page_title'] = 'お問い合わせ';
        $re_keys = $this->config->item('re_keys');       

        $this->data['site_key'] = $re_keys['site_key'];
        $this->data['secret_key'] = $re_keys['secret_key'];

    }

    /**
     * Index Page for this controller.
     */
    public function index()
    {
        $this->firstpage();
    }
    
    public function firstpage() 
    {

        
        $this->make_temp('contact_view', 'blog');
    }
    
    public function validation() 
    {
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name','お名前','required');
        $this->form_validation->set_rules('email','メールアドレス','trim|required|valid_email');
        $this->form_validation->set_rules('naiyou','お問い合わせ','required');
        
         if($this->form_validation->run() == FALSE)
         {
             
                $this->firstpage();
         }
         else
         {
            
             //すばらしい　recaptcha シンプルで大変つかいやすい
             if (!empty($this->input->post('recaptchaResponse')))
             {

                 $secret = $this->data['secret_key'];
                 $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$this->input->post('recaptchaResponse'));

                 $reCAPTCHA = json_decode($verifyResponse);
                 if ($reCAPTCHA->success)
			        {
                            //ヘルパー読み込み
                            $this->load->helper('admin_helper');

                            
                            //メール送信
                            $name = $this->security->xss_clean($this->input->post('name'));
                            $email = $this->security->xss_clean($this->input->post('email'));
                            
                            
                            $line = explode("\n",$this->input->post('naiyou'));

                            $txt = "";

                            foreach ($line as $k=>$v) {

                            $txt .= htmlspecialchars($v)."<br />";

                            }
                            
                             $naiyou = $txt;
                                                    
                            
                            $data1["email"] = $email;
                            $data1["contact_name"] = $name;
                            $data1["contact_email"] = $email;
                            $data1["contact_naiyou"] = $naiyou;
                            
                            $data1["bccemail"] = array(
                                $this->config->item('bccmail')
                                );
                            
                            $sendStatus = completeContactEmail($data1);

                            
                             
                             if($sendStatus){
                                 $status = "success";
                                 setFlashData($status, "お問い合わせ内容を送信しました");
                                 redirect('contact');
                             } else {
                                 $status = "error";
                                 setFlashData($status, "送信に失敗したようです。");
                                 redirect('contact');
                             }
                        #echo "reCAPTCHA solved";
                    }//endo if  if ($reCAPTCHA->success)
                    else
			            {
                            $this->session->set_flashdata('error', 'スパム判定');
                            $this->firstpage();
			            }



                } //end if (!$this->input->post('recaptchaResponse'))
    			else
                    {
                                    $this->session->set_flashdata('error', '何かたりないので処理を停止しました');
                                    $this->firstpage();
                    }
             
         }
        
    }

    
}