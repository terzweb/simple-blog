<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Config_Model extends CI_Model {
    
    var $table = 'tbl_config';

    	function __construct(){
		parent::__construct();
	}

        function Listing()
        {
            $query = $this->db->get($this->table);
            return $query->result();
        }
 
        function getconfig($configname){
            $this->db->where('configname', $configname);
            $query = $this->db->get($this->table);
            return $query->row('value');
        }


        
    /**　　登録処理     */
    function addNewData($dataInfo)
    {
        $this->db->trans_start();
        $this->db->insert($this->table, $dataInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    
    
    /**　　更新処理     */
    function updateData($dataInfo, $ID)
    {
       
        $this->db->where('configid', $ID);
       
        if( $this->db->update($this->table, $dataInfo) ){
            return true;
        }else{
            return false;
        }
    }
    
    
    
    /**　　削除処理     */
    function deleteData($dataId)
    {
        $this->db->trans_start();
        $this->db->where('configid', $dataId);
        #$this->db->update('tbl_tanto', $userInfo);
        $this->db->delete($this->table);
        $this->db->trans_complete();
        if($this->db->trans_status()===false){
            $this->db->trans_rollback();
        }else{
            $this->db->trans_commit();
            return true;
        }   
    }

        
}