<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Tags_model extends CI_Model
{

    //プルダウン用
    function pulldown_list(){

        $this->db->order_by('id','asc');
        
        $query = $this->db->get('tbl_tag');
                //$data = array('' => '');
                
                if ($query->num_rows() > 0) {
                    foreach ($query->result_array() as $row) {
                        $data[$row['id']] = $row['tagName'];
                    }
                }
                return $data;
    }

    //タグマップ参照
    function deliteByNotTagId($postid = 0, $tags = null)
    {
        $this->db->where('post_id',$postid);
        $this->db->where_not_in('tag_id',$tags);
        $this->db->delete('tbl_tag_map');
    }


    function find_by_id($id){
		$this->db->where('id',$id);
		$query = $this->db->get('tbl_tag',1);
        $result = $query->row_array();
        return $result;
	}

    function checkTblmapdata($postid = 0, $tagid = null)
    {

        $this->db->where('post_id',$postid);
        $this->db->where('tag_id',$tagid);
        $query = $this->db->get('tbl_tag_map',1);  
        $nom = $query->num_rows();

        if($nom < 1){
            return true;
        }
        else
        {
            return false;
        }
    }

    function insertTagMap($post_tag)
    {
        $this->db->insert('tbl_tag_map',$post_tag);
    }

    function insertTag($newTag)
    {
        $this->db->insert('tbl_tag',$newTag);
        $tag_id = $this->db->insert_id();
        return $tag_id;

    }

    //タグマップよりpostのタグを取得
    function getTaglist($postid=null){

        $this->db->select('tag_id');
        $this->db->from('tbl_tag_map');
        $this->db->where('post_id',$postid);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;

    }

    function pageTagList($postid=null)
    {
        $baseurl = base_url('tag/');
        $this->db->select('TblTag.tagName, CONCAT("'.$baseurl.'", TblTag.tagslug) as taglink');
        $this->db->from('tbl_tag_map as TblTagmap');
        $this->db->join('tbl_tag as TblTag','TblTag.id = TblTagmap.tag_id');
        $this->db->where('post_id',$postid);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;

    }

    //タグオールリスト
    function allTagList($kensu = 5)
    {
        $baseurl = base_url('tag/');
        $this->db->select('TblTag.tagName, CONCAT("'.$baseurl.'", TblTag.tagslug) as taglink');
        $this->db->from('tbl_tag_map as TblTagmap');
        $this->db->join('tbl_tag as TblTag','TblTag.id = TblTagmap.tag_id');
        $this->db->group_by('TblTagmap.tag_id');
        $this->db->limit($kensu, 0);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;

    }



}