<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DbHandler extends CI_Model{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	 public function insertdata($table,$data)
	 {
        $this->db->insert($table, $data);
        return $this->db->affected_rows();
	 }
	 public function deletedata($table,$where,$content)
	 {
	 	$this->db->where($where,$content);
		$this->db->delete($table);
	 }
	 public function  updatedata($table,$data,$where,$content)
	 {
	 	$this->db->where($where,$content);
		$this->db->update($table, $data);
		return $this->db->affected_rows();
	 }
	 public function selectdata($table,$where,$content,$limit,$offset,$ordercol,$orderby)
	 {
		$this->db->where($where,$content);
		$this->db->limit($limit,$offset);
		$this->db->from($table);
		$this->db->order_by($ordercol,$orderby);
	 	return $query = $this->db->get()->result();
	 }
	  public function selectdata_no_condition($table,$limit,$offset,$ordercol,$orderby)
	 {
		$this->db->limit($limit,$offset);
		$this->db->from($table);
		$this->db->order_by($ordercol,$orderby);
	 	return $query = $this->db->get()->result();
	 }
	 public function selectPartData($table,$where,$content)
	 {
		$this->db->where($where,$content);
		$this->db->from($table);
		//$this->db->orderby($ordercol,$orderby);
	 	return $query = $this->db->get()->result();
	 }
	 public function selectPartDataOrder($table,$where,$content,$ordercol,$orderby)
	 {
		$this->db->where($where,$content);
		$this->db->from($table);
		$this->db->order_by($ordercol,$orderby);
	 	return $query = $this->db->get()->result();
	 }
	 public function selectAllData($table)
	 {
	 	return $query = $this->db->get($table)->result();
	 }
	 public function selectalldatadesc($table,$ordercol)
	 {
	 	$this->db->order_by($ordercol,"desc");
	 	return $query = $this->db->get($table);
	 }
	 public function amount_data($table,$where,$content)
	 {
	 	$this->db->where($where,$content);
		$this->db->from($table);
		return $total = $this->db->count_all_results();
	 }
	 public function amount_data_no_condition($table)
	 {
		return $total = $this->db->count_all($table);
	 }
	public function amount_data_by_like($table,$like,$condition)
	 {
		foreach($like as $col=>$value){
			$this->db->like($col,$value);
		}
		foreach($condition as $col=>$value){
			$this->db->where($col,$value);
		}
		$this->db->from($table);
		return $total = $this->db->count_all_results();
	 }
	 public function select_data_by_like($table,$like,$condition,$limit,$offset,$ordercol,$orderby)
	 {
		foreach($like as $col=>$value){
			$this->db->like($col,$value);
		}
		foreach($condition as $col=>$value){
			$this->db->where($col,$value);
		}
		$this->db->limit($limit,$offset);
		$this->db->from($table);
		$this->db->order_by($ordercol,$orderby);
	 	return $query = $this->db->get()->result();
	 }

}
?>
