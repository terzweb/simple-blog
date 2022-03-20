<?php defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' ); 


class AdminController extends CI_Controller {
	
        protected function load_options() {
    
            $this->data['status'] = array(
                1 => '下書き',
                2 => '公開',
			);			

        }

	//ログインチェック処理
	function isLoggedIn() {
		$isLoggedIn = $this->session->userdata ( 'isLoggedIn' );
	
		if (! isset ( $isLoggedIn ) || $isLoggedIn != TRUE) {
			redirect ( ADMINURL );
		} else {
			$this->data['userid'] = $this->session->userdata ( 'userId' );
			$this->data['name'] = $this->session->userdata ( 'name' );
			$this->data['avaterImg'] = $this->session->userdata ( 'avaterImg' );			
		}
	}
	

	
	//アドミンテンプレート
    function loadViews($viewName = "", $pageInfo = NULL){

        $this->load->view('admin/includes/header', $pageInfo);
        $this->load->view($viewName, $pageInfo);
        $this->load->view('admin/includes/footer', $pageInfo);
    }
	
	//ページ送り
	function paginationCompress($link, $count, $perPage = 10, $segment = 3) {
		$this->load->library ( 'pagination' );
                
		$config ['base_url'] = base_url () . $link;
		$config ['total_rows'] = $count;
		$config ['uri_segment'] = $segment;
		$config ['per_page'] = $perPage;
        $config ['reuse_query_string'] = FALSE;
        $config ['page_query_string'] = FALSE;
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