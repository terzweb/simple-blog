<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/AdminController.php';


class Config extends AdminController
{

    public function __construct()
    {
        parent::__construct();
        $this->isLoggedIn();

        $this->load->model('config_model');
        $this->data['theme'] = $this->config_model->getconfig('theme');


    }


    public function index()
    {  
        $this->list();
    }

    function list()
    {
           
            
            $this->data['record'] = $this->config_model->Listing();
            
            $this->data['pageTitle'] = '設定';

            $this->loadViews("admin/settei_view", $this->data);
        
    }

    function addNew()
    {

            $this->global['pageTitle'] = '設定追加';
            $this->foot['editor'] = 'off';

            $this->loadViews("admin/setteiNew", $this->global, NULL, $this->foot);
      
    }

    function adding()
    {

        

            $this->load->library('form_validation');
            
            //$this->form_validation->set_rules('id','configid','trim|required|numeric');
            $this->form_validation->set_rules('configname','configname','trim|required|is_unique[tbl_config.configname]',array('is_unique'=>'使用済みconfignameです'));
            $this->form_validation->set_rules('value','value','trim');
            $this->form_validation->set_rules('setname','setname','trim');
         
         
            
            if($this->form_validation->run() == FALSE)
            {
                echo(json_encode(array('status'=>FALSE)));
            }
            else
            {

                
                $dataInfo = array(
                    'configname'=> $this->security->xss_clean($this->input->post('configname')),
                    'value'=> $this->security->xss_clean($this->input->post('value')),
                    'setname'=> $this->security->xss_clean($this->input->post('setname'))                  
                    );
                

                $result = $this->config_model->addNewData($dataInfo);
                
                if($result > 0)
                {
                    echo(json_encode(array('status'=>true)));
                }
                else
                {
                    echo(json_encode(array('status'=>FALSE)));
                }
                
                
            }
        
    }



    function editupdate()
    {
        
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('id','configid','trim|required|numeric');
            $this->form_validation->set_rules('value','value','trim');
            $this->form_validation->set_rules('setname','setname','trim');
            $this->form_validation->set_rules('action','action','trim|required');
         
            
            
            if($this->form_validation->run() == FALSE)
            {
                echo(json_encode(array('status'=>FALSE)));
                
            }
            else
            {
                
                $action = $this->security->xss_clean($this->input->post('action'));
                $configid = $this->security->xss_clean($this->input->post('id'));

                switch ($action) {
                    case 'edit':
                        # code...
                        
                        $value = $this->security->xss_clean($this->input->post('value'));
                        $setname = $this->security->xss_clean($this->input->post('setname'));
                        
                        $dataInfo = array(
                            'value'=> $value,
                            'setname'=> $setname
                            );
                        
        
                        $result = $this->config_model->updateData($dataInfo,$configid);
                        
                        
                        if($result == true)
                        {
                            $retrenallay = array(
                                'id' => $configid,
                                'value'=> $value,
                                'setname'=> $setname
                            );
        
                            echo json_encode($retrenallay);
                        }
                        else
                        {
                            echo(json_encode(array('status'=>FALSE)));
                        }
                        
                        break;
                    
                    case 'delete':
                        # code...
                        $result = $this->config_model->deleteData($configid);
                        if ($result > 0) {
                                $retrenallay = array(
                                    'id' => $configid,
                                    'value'=> '',
                                    'setname'=> ''
                                );
        
                            echo json_encode($retrenallay); 
                            }
                        else {
                            $retrenallay = array(
                                'id' => $configid,
                                'value'=> '',
                                'setname'=> ''
                            );
        
                            echo json_encode($retrenallay); 
                            }


                    break;
                }





                
            }
        
    }




}