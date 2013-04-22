<?php
/**
 * ShareController class file
 * @author Xeylon Zhou <ljzxzxl@gmail.com> 
 * @date 2013-04-15 
 */
class ShareController extends Controller
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
		echo guid();
		echo Yii::t('api', 'language test');
    } // }}} 
	// {{{ actionList
    public function actionList()
    {
        //$this->_checkAuth();
		if(!empty($_GET['model']) && intval($_GET['user_id'])){
			$user_id = intval($_GET['user_id']);
			switch($_GET['model'])
			{
				case 'list': // {{{ 
					$models = Share::model()->findAll('owner_uid=:user_id', array(':user_id'=>$user_id));
					break; // }}} 
				default: // {{{ 
					$this->_sendResponse(501, sprintf('Error: Wrong mode [%s] or Bad request method',$_GET['model']) );
					exit; // }}} 
			}
			if(empty($models)) {
				$this->_sendResponse(200, sprintf('No items where found for model [%s]', $_GET['model']) );
			} else {
				$rows = array();
				foreach($models as $model)
					$rows[] = $model->attributes;
	
				$this->_sendResponse(200, $rows);
			}
		}else{
			$this->_sendResponse(501, sprintf('Error: Parameter user_id and obj_id is required') );
			exit;
		}
    } // }}} 
    // {{{ actionView
    /* Shows a single item
     * 
     * @access public
     * @return void
     */
    public function actionGet()
    {
        //$this->_checkAuth();
        // Check if id was submitted via GET
        if(!isset($_GET['id']))
            $this->_sendResponse(500, 'Error: Parameter <b>id</b> is missing' );

        switch($_GET['model'])
        {
            // Find respective model    
            case 'view': // {{{ 
                $model = Share::model()->findByPk($_GET['id']);
                break; // }}} 
            default: // {{{ 
                $this->_sendResponse(501, sprintf('Error: Wrong mode [%s] or Bad request method',$_GET['model']) );
                exit; // }}} 
        }
        if(is_null($model)) {
            $this->_sendResponse(404, 'No Item found with id '.$_GET['id']);
        } else {
            $this->_sendResponse(200, $model->attributes);
        }
    } // }}} 
    // {{{ actionCreate
    /**
     * Post a new item
     * 
     * @access public
     * @return void
     */
    public function actionPost()
    {
        //$this->_checkAuth();

        switch($_GET['model'])
        {
            // Get an instance of the respective model
            case 'create': // {{{ 
				$this->_addShare($model);
                break; // }}} 
			case 'toUser': // {{{ 
				$this->_addShareToUser();
                break; // }}}
			case 'toGroup': // {{{ 
				$this->_addShareToGroup();
                break; // }}}
            default: // {{{ 
                $this->_sendResponse(501, sprintf('Error: Wrong mode [%s] or Bad request method',$_GET['model']) );
                exit; // }}} 
        }
    } // }}}     
    // {{{ actionUpdate
    /**
     * Update a single iten
     * 
     * @access public
     * @return void
     */
    public function actionUpdate()
    {
        //$this->_checkAuth();

        // Get PUT parameters
        //parse_str(file_get_contents('php://input'), $put_vars);
		$put_vars = json_decode(file_get_contents("php://input"),true);
		if(intval($put_vars['user_id']) && intval($put_vars['share_id'])){
			switch($_GET['model'])
			{
				// Find respective model
				case 'update': // {{{ 
					$user_id = intval($put_vars['user_id']);
					$share_id = intval($put_vars['share_id']);
					$put_vars['owner_uid'] = intval($user_id);
					unset($put_vars['user_id']);
					// Find the share by user_id and obj_id
					$model = Share::model()->find('owner_uid=:user_id AND share_id=:share_id', array(':user_id'=>$user_id, ':share_id'=>$share_id));                  
					break; // }}} 
				default: // {{{ 
					$this->_sendResponse(501, sprintf('Error: Wrong mode [%s] or Bad request method',$_GET['model']) );
					exit; // }}} 
			}
			if(is_null($model))
				$this->_sendResponse(400, sprintf("Error: Didn't find any item.") );
			
			// Try to assign PUT parameters to attributes
			foreach($put_vars as $var=>$value) {
				// Does model have this attribute?
				if($model->hasAttribute($var)) {
					$model->$var = $value;
				} else {
					// No, raise error
					$this->_sendResponse(500, sprintf('Parameter [%s] is not allowed for model [%s]', $var, $_GET['model']) );
				}
			}
			// Try to save the model
			if($model->save()) {
				$this->_sendResponse(200, sprintf('The share has been updated.') );
			} else {
				$msg = "<h1>Error</h1>";
				$msg .= sprintf("Couldn't update model [%s]", $_GET['model']);
				$msg .= "<ul>";
				foreach($model->errors as $attribute=>$attr_errors) {
					$msg .= "<li>Attribute: $attribute</li>";
					$msg .= "<ul>";
					foreach($attr_errors as $attr_error) {
						$msg .= "<li>$attr_error</li>";
					}        
					$msg .= "</ul>";
				}
				$msg .= "</ul>";
				$this->_sendResponse(500, $msg );
			}
		}else{
			$this->_sendResponse(501, sprintf('Error: Parameter user_id and share_id is required') );
			exit;
		}
    } // }}} 
    // {{{ actionDelete
    /**
     * Deletes a single item
     * 
     * @access public
     * @return void
     */
    public function actionDelete()
    {
        //$this->_checkAuth();
		$put_vars = json_decode(file_get_contents("php://input"),true);
		if(intval($put_vars['user_id']) && intval($put_vars['share_id'])){
			switch($_GET['model'])
			{
				// Load the respective model
				case 'delete': // {{{ 
					$user_id = intval($put_vars['user_id']);
					$share_id = intval($put_vars['share_id']);
					$put_vars['owner_uid'] = intval($user_id);
					unset($put_vars['user_id']);
					// Find the share by user_id and obj_id
					$model = Share::model()->find('owner_uid=:user_id AND share_id=:share_id', array(':user_id'=>$user_id, ':share_id'=>$share_id));                  
					break; // }}} 
				default: // {{{ 
					$this->_sendResponse(501, sprintf('Error: Wrong mode [%s] or Bad request method',$_GET['model']) );
					exit; // }}} 
			}
			// Was a model found?
			if(is_null($model)) {
				// No, raise an error
				$this->_sendResponse(400, sprintf("Error: Didn't find any share.") );
			}
	
			// Delete the model
			$num = $model->delete();
			if($num>0)
				$this->_sendResponse(200, sprintf("The share has been deleted.") );
			else
				$this->_sendResponse(500, sprintf("Error: Couldn't delete the share.") );
		}else{
			$this->_sendResponse(501, sprintf('Error: Parameter user_id and share_id is required') );
			exit;
		}
    } // }}} 
	// {{{ _addShare
    /**
     * Post a new item
     * @return void
     */
    public function _addShare($model = '')
    {
        if(empty($_POST)){$_POST = json_decode(file_get_contents("php://input"),true);}
		if(intval($_POST['user_id']) && !empty($_POST['obj_id']) && !empty($_POST['obj_type'])){
			// Try to assign POST values to attributes
			$user_id = trim($_POST['user_id']);
			$obj_id = trim($_POST['obj_id']);
			$obj_type = trim($_POST['obj_type']);
			$_POST['owner_uid'] = intval($user_id);
			unset($_POST['user_id']);
			$model = new Share;
			foreach($_POST as $var=>$value) {
				// Does the model have this attribute?
				if($model->hasAttribute($var)) {
					$model->$var = $value;
				} else {
					// No, raise an error
					$this->_sendResponse(500, sprintf('Parameter [%s] is not allowed for model [%s]', $var, $_GET['model']) );
				}
			}
			// Try to save the model
			if($model->save()) {
				// Saving was OK
				$share_info = $model->attributes;
				$share_id = $share_info['share_id'];
				// When other type 当是对外分享时需执行
				if($obj_type == 'other'){
					$obj_arr = explode(',',rtrim($share_info['obj_id'],','));
					foreach($obj_arr as $k=>$v){
						$other_model = new ShareToOther;
						$file_id = $v;
						$file_info = File::model()->findByPk($file_id);
						$file_path = $file_info['path'];
						$share_arr = array();
						$share_arr['share_id'] = $share_id;
						$share_arr['file_id'] = $file_id;
						$share_arr['share_link'] = $file_path;
						$share_arr['create_date'] = time();
						$share_data = ShareToOther::model()->find('file_id=:file_id AND share_id=:share_id', array(':file_id'=>$share_arr['file_id'], ':share_id'=>$share_arr['share_id']));
						if(empty($share_data)){
							foreach($share_arr as $var=>$value) {
								// Does the model have this attribute?
								if($other_model->hasAttribute($var)) {
									$other_model->$var = $value;
								} else {
									// No, raise an error
									$this->_sendResponse(500, sprintf('Parameter [%s] is not allowed for model [%s]', $var, $other_model) );
								}
							}
						}
						// Try to save the model
						$other_model->save();
						$share_info['share_link'] .= $share_arr['share_link'].',';
					}
					$share_info['share_link'] = rtrim($share_info['share_link'],',');
					$model->share_link = $share_info['share_link'];
					$model->save();
				}
				$this->_sendResponse(200, $model->attributes);
			} else {
				// Errors occurred
				$msg = "<h1>Error</h1>";
				$msg .= sprintf("Couldn't create model [%s]", $_GET['model']);
				$msg .= "<ul>";
				foreach($model->errors as $attribute=>$attr_errors) {
					$msg .= "<li>Attribute: $attribute</li>";
					$msg .= "<ul>";
					foreach($attr_errors as $attr_error) {
						$msg .= "<li>$attr_error</li>";
					}        
					$msg .= "</ul>";
				}
				$msg .= "</ul>";
				$this->_sendResponse(500, $msg );
				return;
			}
		}else{
			$this->_sendResponse(501, sprintf('Error: Parameter user_id,obj_id and obj_type is required') );
			return;
		}
    } 
	/**
     * Post a new item
     * @return void
     */
    public function _addShareToUser()
    {
        if(empty($_POST)){$_POST = json_decode(file_get_contents("php://input"),true);}
		if(!empty($_POST['user_ids']) && intval($_POST['share_id'])){
			// Try to assign POST values to attributes
			$share_arr = array();
			$share_arr['share_id'] = intval($_POST['share_id']);
			$share_arr['create_date'] = intval($_POST['create_date']);
			$user_ids = trim($_POST['user_ids']);
			$user_arr = explode(',',rtrim($user_ids,','));
			$i = 0;
			foreach($user_arr as $k=>$v){
				$model = new ShareToUser;
				$share_arr['user_id'] = intval($v);
				// Find the item by user_id and share_id
				$share_info = ShareToUser::model()->find('user_id=:user_id AND share_id=:share_id', array(':user_id'=>$share_arr['user_id'], ':share_id'=>$share_arr['share_id']));
				if(empty($share_info)){
					foreach($share_arr as $var=>$value) {
						// Does the model have this attribute?
						if($model->hasAttribute($var)) {
							$model->$var = $value;
						} else {
							// No, raise an error
							$this->_sendResponse(500, sprintf('Parameter [%s] is not allowed for model [%s]', $var, $_GET['model']) );
						}
					}
				}
				// Try to save the model
				if($model->save()){
					$i++;
				}
			}
			$this->_sendResponse(200, sprintf('There are [%s] new items has been pushed.', $i) );
		}else{
			$this->_sendResponse(501, sprintf('Error: Parameter share_id and user_ids is required') );
			return;
		}
    }
	/**
     * Post a new item
     * @return void
     */
    public function _addShareToGroup()
    {
        if(empty($_POST)){$_POST = json_decode(file_get_contents("php://input"),true);}
		if(!empty($_POST['group_ids']) && intval($_POST['share_id'])){
			// Try to assign POST values to attributes
			$share_arr = array();
			$share_arr['share_id'] = intval($_POST['share_id']);
			$share_arr['create_date'] = intval($_POST['create_date']);
			$group_ids = trim($_POST['group_ids']);
			$group_arr = explode(',',rtrim($group_ids,','));
			$i = 0;
			foreach($group_arr as $k=>$v){
				$model = new ShareToGroup;
				$share_arr['group_id'] = intval($v);
				// Find the item by group_id and share_id
				$share_info = ShareToGroup::model()->find('group_id=:group_id AND share_id=:share_id', array(':group_id'=>$share_arr['group_id'], ':share_id'=>$share_arr['share_id']));
				if(empty($share_info)){
					foreach($share_arr as $var=>$value) {
						// Does the model have this attribute?
						if($model->hasAttribute($var)) {
							$model->$var = $value;
						} else {
							// No, raise an error
							$this->_sendResponse(500, sprintf('Parameter [%s] is not allowed for model [%s]', $var, $_GET['model']) );
						}
					}
				}
				// Try to save the model
				if($model->save()){
					$i++;
				}
			}
			$this->_sendResponse(200, sprintf('There are [%s] new items has been pushed.', $i) );
		}else{
			$this->_sendResponse(501, sprintf('Error: Parameter share_id and group_ids is required') );
			return;
		}
    }// }}}
    // }}} End Actions
}

/* vim:set ai sw=4 sts=4 et fdm=marker fdc=4: */
?>
