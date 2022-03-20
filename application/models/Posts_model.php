<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Posts_model extends CI_Model
{
    var $table = 'tbl_posts';

    function postsListingCount($searchText = '')
    {
        $this->db->select('BaseTbl.status, BaseTbl.id, BaseTbl.url, BaseTbl.title, BaseTbl.contents, BaseTbl.status, BaseTbl.opendate, BaseTbl.postdata');
        $this->db->from('tbl_posts as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.title  LIKE '%".$searchText."%'
                            OR  BaseTbl.contents  LIKE '%".$searchText."%'
                            OR  BaseTbl.contents_sub  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.status !=', 3);
        $this->db->where('BaseTbl.isDeleted', 0);
        $query = $this->db->get();
        
        return $query->num_rows();
    }
    

    function postListing($searchText = '', $page, $segment)
    {
        $this->db->select('BaseTbl.status, BaseTbl.id, BaseTbl.url, BaseTbl.title, BaseTbl.contents, BaseTbl.opendate, BaseTbl.postdata');
        $this->db->from('tbl_posts as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.title  LIKE '%".$searchText."%'
                            OR  BaseTbl.contents  LIKE '%".$searchText."%'
                            OR  BaseTbl.contents_sub  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.status !=', 3);
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->order_by('BaseTbl.postdata', 'DESC');
            $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }
 
    function getUserRoles()
    {
        $this->db->select('roleId, role');
        $this->db->from('tbl_roles');
        $this->db->where('roleId !=', 1);
        $query = $this->db->get();
        
        return $query->result();
    }


    function checkUrlExists($url)
    {
        $this->db->from("tbl_posts");
        $this->db->where("isDeleted", 0);

        $this->db->where("url", $url);

        $query = $this->db->get();

        return $query->result();
    }
    

    function addNewPost($userInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_posts', $userInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    

    function getPostInfo($id)
    {
        $this->db->where('id',$id);
        $query = $this->db->get($this->table,1);
        return $query->result();
    }
    
    

    function editPost($userInfo, $userId)
    {
        $this->db->where('id', $userId);
        $this->db->update($this->table, $userInfo);
        
        return TRUE;
    }
    
    
    function deletePost($userId, $userInfo)
    {
        $this->db->where('id', $userId);
        $this->db->update('tbl_posts', $userInfo);
        
        return $this->db->affected_rows();
    }


    function getUserInfoById($userId)
    {
        $this->db->select('userId, name, email, mobile, roleId');
        $this->db->from('tbl_users');
        $this->db->where('isDeleted', 0);
        $this->db->where('userId', $userId);
        $query = $this->db->get();
        
        return $query->row();
    }

}

  