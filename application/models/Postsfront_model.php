<?php

class Postsfront_model extends CI_Model {
    
    var $table = 'tbl_posts';
	
        protected $base_assets_url = '';
    
	function __construct(){
		parent::__construct();
	}
	
	
        function find_by_url($url) {

            $this->db->where('status',2);
            $this->db->where('url', $url);
            $this->db->where('isDeleted',0);
            $query = $this->db->get($this->table);
            return $query->result_array();
        }

        function ListingCount($searchText = '')
        {
            $this->db->select('BaseTbl.url, BaseTbl.title, BaseTbl.contents, BaseTbl.opendate');
            $this->db->from('tbl_posts as BaseTbl');
            if(!empty($searchText)) {
                $this->db->like('BaseTbl.title',$searchText, 'both');
                $this->db->or_like('BaseTbl.contents',$searchText, 'both');
            }
            $this->db->where('BaseTbl.isDeleted', 0);
            $this->db->where('BaseTbl.status', 2);
            $query = $this->db->get();

        
            return $query->num_rows();
        }
        
        function Listing($searchText = '', $page, $segment=0)
        {
            $this->db->select('BaseTbl.url, BaseTbl.title, BaseTbl.img_url, BaseTbl.contents, BaseTbl.opendate, DATE_FORMAT( BaseTbl.opendate, "%Y年 %m月 %d日 ") as blogopendate');
            $this->db->from('tbl_posts as BaseTbl');

            if(!empty($searchText)) {
                $this->db->like('BaseTbl.title',$searchText, 'both');
                $this->db->or_like('BaseTbl.contents',$searchText, 'both');
            }

            $this->db->where('BaseTbl.isDeleted', 0);
            $this->db->where('BaseTbl.status', 2);
            $this->db->where('BaseTbl.opendate <=',date("Y/m/d H:i") );
            $this->db->order_by('BaseTbl.opendate', 'DESC');
            $this->db->limit($page, $segment);
            $query = $this->db->get();

            $result = $query->result_array();
            
            //ブログリスト展開ｇ
            if(!empty( $result )):
            $i=0;
            foreach ($result as $postitem)
            {
                $temp[$i]['title'] = $postitem['title'];
                $temp[$i]['url'] = base_url('post/'.$postitem['url']);
                $temp[$i]['img_url'] = base_url($postitem['img_url']);
                $temp[$i]['contents'] = mb_substr(strip_tags(html_entity_decode($postitem['contents'])),0,40);
                list($year, $month, $day, $time) = preg_split(("/[\s,-]/"), $postitem['opendate']);
                $temp[$i]['open_month'] = $month;
                $temp[$i]['open_day'] = $day;
                $temp[$i]['opendate_wareki'] = ''.$year.'年'.$month.'月'. $day .'日';
                $temp[$i]['blog_tags'] = $day;
                $i++;
            }
        else:
            $temp = array();
        endif;


            return $temp;
            
        }





        function tagListing($searchTag = '', $page, $segment=0)
        {
            $this->db->select('tp.url, tp.title, tp.img_url, tp.contents, tp.opendate, DATE_FORMAT( tp.opendate, "%Y年 %m月 %d日 ") as blogopendate');
            $this->db->from('tbl_tag_map as ttm');
            
            $this->db->join('tbl_tag tt','ttm.tag_id = tt.id');
            $this->db->join('tbl_posts tp','ttm.post_id = tp.id');

            $this->db->where('tt.tagslug',$searchTag);

            $this->db->where('tp.isDeleted', 0);
            $this->db->where('tp.status', 2);
            $this->db->where('tp.opendate <=',date("Y/m/d H:i") );
            $this->db->group_by('ttm.post_id');
            $this->db->order_by('tp.opendate', 'DESC');
            $this->db->limit($page, $segment);
            $query = $this->db->get();

            $result = $query->result_array();
            
            //ブログリスト展開ｇ
            if(!empty( $result )):
            $i=0;
            foreach ($result as $postitem)
            {
                $temp[$i]['title'] = $postitem['title'];
                $temp[$i]['url'] = base_url('post/'.$postitem['url']);
                $temp[$i]['img_url'] = base_url($postitem['img_url']);
                $temp[$i]['contents'] = mb_substr(strip_tags(html_entity_decode($postitem['contents'])),0,40);
                list($year, $month, $day, $time) = preg_split(("/[\s,-]/"), $postitem['opendate']);
                $temp[$i]['open_month'] = $month;
                $temp[$i]['open_day'] = $day;
                $temp[$i]['opendate_wareki'] = ''.$year.'年'.$month.'月'. $day .'日';
                $temp[$i]['blog_tags'] = $day;
                $i++;
            }
        else:
            $temp = array();
        endif;


            return $temp;
            
        }



        
     

}

?>
