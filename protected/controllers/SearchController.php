<?php
/**
 * SearchController class search
 * @author Xeylon Zhou <ljzxzxl@gmail.com> 
 * @date 2013-04-15 
 */
class SearchController extends Controller
{
    // {{{ *** Members ***
    /**
     * Key which has to be in HTTP USERNAME and PASSWORD headers 
     */
    Const APPLICATION_ID = 'ASCCPE';

    private $format = 'json';
    // }}} 
    // {{{ filters
    /**
     * @return array action filters
     */
    public function filters()
    {
		return array();
    } // }}} 
    // {{{ *** Actions ***
    // {{{ actionIndex
    public function actionIndex()
    {
        //$this->_checkAuth();
        if(!empty($_GET['keyword']) && intval($_GET['user_id'])){
			$keyword = trim($_GET['keyword']);
			$user_id = intval($_GET['user_id']);
			//Prevent sql injection
			$keyword = addslashes($keyword);
			$keyword = str_replace("_","\_",$keyword);
			$keyword = str_replace("%","\%",$keyword);
			//Search file and folder
			$models_file = File::model()->findAll("owner_uid = :owner_uid AND is_deleted = :is_deleted AND file_name LIKE '%{$keyword}%'", array(':is_deleted'=>'false', ':owner_uid'=>$user_id));
			$models_folder = Folder::model()->findAll("owner_uid = :owner_uid AND is_deleted = :is_deleted AND folder_name LIKE '%{$keyword}%'", array(':is_deleted'=>'false', ':owner_uid'=>$user_id));
			if(empty($models_file) && empty($models_folder)){
				$this->_sendResponse(200, sprintf('No items where found for keyword [%s]', $_GET['keyword']) );
			}else{
				$rows = array();
				foreach($models_file as $model)
					$rows['file'][] = $model->attributes;
				foreach($models_folder as $model)
					$rows['folder'][] = $model->attributes;
				$this->_sendResponse(200, $rows);
			}
		}else{
			$this->_sendResponse(501, sprintf('Error: Parameter keyword and user_id is required') );
			exit;
		}
    } // }}} 
    // }}} End Actions
}

/* vim:set ai sw=4 sts=4 et fdm=marker fdc=4: */
?>
