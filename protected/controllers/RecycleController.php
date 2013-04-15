<?php
/**
 * RecycleController class recycle
 * @author Xeylon Zhou <ljzxzxl@gmail.com> 
 * @date 2013-04-15 
 */
class RecycleController extends Controller
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
        echo CJSON::encode(array(1, 2, 3));
    } // }}} 
	// {{{ actionList
    public function actionAct()
    {
        //$this->_checkAuth();
		if(!empty($_GET['model']) && intval($_GET['user_id'])){
			$user_id = intval($_GET['user_id']);
			switch($_GET['model'])
			{
				case 'list': // {{{ 
					$models = UserRecycle::model()->findAll('user_id=:user_id', array(':user_id'=>$user_id));
					break; // }}} 
				case 'cancel': // {{{ 
					if(!empty($_GET['obj_type']) && intval($_GET['obj_id'])){
						$obj_type = trim($_GET['obj_type']);
						$obj_id = intval($_GET['obj_id']);
						//Update the is_deleted status
						if($obj_type == 'file'){
							$model = File::model()->findByPk($obj_id);
							$model->is_deleted = 'false';
							$model->save();
						}elseif($obj_type == 'folder'){
							$model = Folder::model()->findByPk($obj_id);
							$model->is_deleted = 'false';
							$model->save();
						}else{
							$this->_sendResponse(501, sprintf('Error: Parameter obj_type [%s] does not exist',$_GET['obj_type']) );
						}
						//Delete records of Recycle Bin
						UserRecycle::model()->deleteAll('user_id=:user_id AND obj_id=:obj_id AND obj_type=:obj_type', array(':user_id'=>$user_id, ':obj_id'=>$obj_id, ':obj_type'=>$obj_type));
						$this->_sendResponse(200, sprintf('The item has to be restored') );
					}else{
						$this->_sendResponse(501, sprintf('Error: Parameter obj_type and obj_id is required') );
					}
					break; // }}}
				case 'empty': // {{{ 
					if(!empty($user_id)){
						//Delete records of Recycle Bin
						UserRecycle::model()->deleteAll('user_id=:user_id', array(':user_id'=>$user_id));
						$this->_sendResponse(200, sprintf('All items has been deleted') );
					}else{
						$this->_sendResponse(501, sprintf('Error: Parameter user_id is required') );
					}
					break; // }}}
				default: // {{{ 
					$this->_sendResponse(501, sprintf('Error: Wrong mode [%s] or Bad request method',$_GET['model']) );
					exit; // }}} 
			}
			if(is_null($models)) {
				$this->_sendResponse(200, sprintf('No items where found for model [%s]', $_GET['model']) );
			} else {
				$rows = array();
				foreach($models as $model)
					$rows[] = $model->attributes;
				$this->_sendResponse(200, $rows);
			}
		}else{
			$this->_sendResponse(501, sprintf('Error: Parameter model and user_id is required') );
			exit;
		}
    } // }}}
    // }}} End Actions
}

/* vim:set ai sw=4 sts=4 et fdm=marker fdc=4: */
?>
