<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
    }


    public function index()
    {
        $this->isLoggedIn();
    }


    function isLoggedIn()
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn');

        if (!isset($isLoggedIn) || $isLoggedIn != TRUE) {

            $this->load->view('admin/login', '');
        } else {
            redirect(ADMINURL.'/posts');
        }
    }

    //認証
    public function loginMe()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[128]|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|max_length[32]');

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {

            $email = $this->security->xss_clean($this->input->post('email'));
            $password = $this->security->xss_clean($this->input->post('password'));

            $result = $this->login_model->loginMe($email, $password);

            if (!empty($result)) {

                $sessionArray = array(
                    'userId' => $result->userId,
                    'name' => $result->name,
                    'avaterImg' => $result->avaterImg,
                    'isLoggedIn' => TRUE
                );

                $this->session->set_userdata($sessionArray);

                redirect('./admin/posts');

            } else {
                $this->session->set_flashdata('error', 'Email 又は passwordが違うようです');

                redirect(base_url(ADMINURL));
            }
        }
    }


    public function forgotPassword()
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn');

        if (!isset($isLoggedIn) || $isLoggedIn != TRUE) {
            $this->load->view('admin/forgotPassword');
        } else {
            redirect(ADMINURL.'/posts');
        }
    }


    function resetPassword()
    {
        $status = '';

        $this->load->library('form_validation');

        $this->form_validation->set_rules('login_email', 'Email', 'trim|required|valid_email');

        if ($this->form_validation->run() == FALSE) {
            $this->forgotPassword();
        } else {
            $email = $this->security->xss_clean($this->input->post('login_email'));

            if ($this->login_model->checkEmailExist($email)) {

                $encoded_email = urlencode($email);

                $this->load->helper('string');
                $data['email'] = $email;
                $data['activation_id'] = random_string('alnum', 15);
                $data['createdDtm'] = date('Y-m-d H:i:s');
                $data['agent'] = getBrowserAgent();
                $data['client_ip'] = $this->input->ip_address();

                $save = $this->login_model->resetPasswordUser($data);

                if ($save) {
                    $data1['reset_link'] = base_url(ADMINURL) . "/resetPasswordConfirmUser/" . $data['activation_id'] . "/" . $encoded_email;
                    $userInfo = $this->login_model->getCustomerInfoByEmail($email);

                    if (!empty($userInfo)) {
                        $data1["name"] = $userInfo[0]->name;
                        $data1["email"] = $userInfo[0]->email;
                        $data1["message"] = "Reset Your Password";
                    }

                    $sendStatus = resetPasswordEmail($data1);

                    if ($sendStatus) {
                        $status = "success";
                        setFlashData($status, "リセットメールを送信しました。");
                    } else {
                        $status = "error";
                        setFlashData($status, "送信失敗");
                    }
                } else {
                    $status = 'error';
                    setFlashData($status, "It seems an error while sending your details, try again.");
                }
            } else {
                $status = 'error';
                setFlashData($status, "このメールアドレスは未登録です");
            }
            redirect(ADMINURL.'/forgotPassword');
        }
    }


    function resetPasswordConfirmUser($activation_id, $email)
    {
        // Get email and activation code from URL values at index 3-4
        $email = urldecode($email);

        // Check activation id in database
        $is_correct = $this->login_model->checkActivationDetails($email, $activation_id);

        $data['email'] = $email;
        $data['activation_code'] = $activation_id;

        if ($is_correct == 1) {
            $this->load->view('admin/newPassword', $data);
        } else {
            redirect(base_url(ADMINURL));
        }
    }


    function createPasswordUser()
    {
        $status = '';
        $message = '';
        $email = $this->input->post("email");
        $activation_id = $this->input->post("activation_code");

        $this->load->library('form_validation');

        $this->form_validation->set_rules('password', 'Password', 'required|max_length[20]');
        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|matches[password]|max_length[20]');

        if ($this->form_validation->run() == FALSE) {
            $this->resetPasswordConfirmUser($activation_id, urlencode($email));
        } else {
            $password = $this->input->post('password');
            $cpassword = $this->input->post('cpassword');

            // Check activation id in database
            $is_correct = $this->login_model->checkActivationDetails($email, $activation_id);

            if ($is_correct == 1) {
                $this->login_model->createPasswordUser($email, $password);

                $status = 'success';
                $message = 'パスワードを変更しました';
            } else {
                $status = 'error';
                $message = 'パスワードが変更できませんでした';
            }

            setFlashData($status, $message);

            redirect(base_url(ADMINURL));
        }
    }

    public function logout()
    {
        session_destroy();

        redirect(base_url(ADMINURL));
    }
}
