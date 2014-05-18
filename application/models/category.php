<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends CI_Model{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model("dbHandler");
	}

	/**获取全部分类
	 * 
	 */
	function _get_categories()
	{
		$cat=$this->dbHandler->selectPartData('category','cat_fid','0');
		foreach($cat as $item){
			$item->subcat=$this->dbHandler->selectPartData('category','cat_fid',$item->cat_id);
		}
		return $cat;
	}
	/**获取一级分类
	 * 
	 */
	function _get_cat()
	{
		$cat=$this->dbHandler->selectPartData('category','cat_fid','0');
		return json_encode($subCat);
	}
	/**获取二级分类
	 * 
	 */
	function _get_sub_cat($cat)
	{
		$subCat=$this->dbHandler->selectPartData('category','cat_fid',$cat);
		return json_encode($subCat);
	}

}
?>
