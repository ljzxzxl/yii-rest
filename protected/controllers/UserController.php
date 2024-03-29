<?php
/**
 * UserController class file
 * @author Xeylon Zhou <ljzxzxl@gmail.com>  
 */
class UserController extends Controller
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
        switch($_GET['model'])
        {
            case 'list': // {{{ 
                $models = User::model()->findAll($this->_getLimit());
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
    } // }}} 
	// {{{ actionList
    public function actionResource()
    {
        //$this->_checkAuth();
        switch($_GET['model'])
        {
            case 'file': // {{{ 
				if(intval($_GET['user_id'])){
					$models = File::model()->findAll('owner_uid=:user_id', array(':user_id'=>$_GET['user_id']));
				}else{
					$this->_sendResponse(401, 'Error: Parameter user_id is required');
				}
                break; // }}}
            case 'share_file': // {{{ 
				if(intval($_GET['user_id'])){
					$file_ids = '';
					$models = ShareToUser::model()->findAll('user_id=:user_id', array(':user_id'=>$_GET['user_id']));
					foreach($models as $model){
						$rows[] = $model->attributes;}
					foreach($rows as $k => $v){
						$share_id = $v['share_id'];
						$model = Share::model()->findByPk($share_id);
						$row = $model->attributes;
						if(!empty($row['file_id'])){
							$file_ids .= $row['file_id'].',';
						}
					}
					$file_ids = rtrim($file_ids,',');
					$models = File::model()->findAll("file_id IN({$file_ids}) AND is_deleted = :is_deleted", array(':is_deleted'=>'false'));
				}else{
					$this->_sendResponse(401, 'Error: Parameter user_id is required');
				}
                break; // }}}
			case 'folder': // {{{ 
				$models = Folder::model()->findAll('owner_uid=:user_id', array(':user_id'=>$_GET['user_id']));
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
                $model = User::model()->findByPk($_GET['id']);
                break; // }}} 
			case 'file': // {{{ 
                $model = File::model()->findByPk($_GET['id']);
                break; // }}}
			case 'folder': // {{{ 
                $model = Folder::model()->findByPk($_GET['id']);
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
                $model = new User;  
				$this->_addUser($model);
                break; // }}} 
			case 'regist': // {{{
                $model = new User;
				$this->_addUser($model);
                break; // }}}
			case 'login': // {{{
                $model = new User;
				$this->_checkLogin($model);
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

        switch($_GET['model'])
        {
            // Find respective model
            case 'update': // {{{ 
                $model = User::model()->findByPk($_GET['id']);                    
                break; // }}} 
            default: // {{{ 
                $this->_sendResponse(501, sprintf('Error: Wrong mode [%s] or Bad request method',$_GET['model']) );
                exit; // }}} 
        }
        if(is_null($model))
            $this->_sendResponse(400, sprintf("Error: Didn't find any model [%s] with ID [%s].",$_GET['model'], $_GET['id']) );
        
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
            $this->_sendResponse(200, sprintf('The model [%s] with id [%s] has been updated.', $_GET['model'], $_GET['id']) );
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

        switch($_GET['model'])
        {
            // Load the respective model
            case 'delete': // {{{ 
                $model = User::model()->findByPk($_GET['id']);                    
                break; // }}} 
            default: // {{{ 
                $this->_sendResponse(501, sprintf('Error: Wrong mode [%s] or Bad request method',$_GET['model']) );
                exit; // }}} 
        }
        // Was a model found?
        if(is_null($model)) {
            // No, raise an error
            $this->_sendResponse(400, sprintf("Error: Didn't find any model [%s] with ID [%s].",$_GET['model'], $_GET['id']) );
        }

        // Delete the model
        $num = $model->delete();
        if($num>0)
            $this->_sendResponse(200, sprintf("Model [%s] with ID [%s] has been deleted.",$_GET['model'], $_GET['id']) );
        else
            $this->_sendResponse(500, sprintf("Error: Couldn't delete model [%s] with ID [%s].",$_GET['model'], $_GET['id']) );
    } // }}} 
	// {{{ _addUser
    /**
     * Post a new item
     * @return void
     */
    public function _addUser($model = '')
    {
        if(!empty($model)){
			// Try to assign POST values to attributes
			if(empty($_POST)){$_POST = json_decode(file_get_contents("php://input"),true);}
			if(is_array($_POST)){
				$user_name = trim($_POST['user_name']);
				// Find the user by user_name
				$user_info=User::model()->find('user_name=:user_name', array(':user_name'=>$user_name));
				if(empty($user_info)){
					$password = trim($_POST['password']);
					$_POST['password_salt'] = $password_salt = guid(6);
					$_POST['password'] = md5(md5($password).$password_salt);
				}else{
					$this->_sendResponse(501, sprintf('Error: Parameter user_name already exists') );
					return;
				}
			}else{
				$this->_sendResponse(501, sprintf('Error: Parameter is required') );
				return;
			}
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
			$this->_sendResponse(501, sprintf('Error: Wrong mode [%s] or Bad request method',$_GET['model']) );
			return;
		}
    } // }}}
	// {{{ _checkLogin
    /**
     * Check login
     * @return void
     */
    public function _checkLogin($model = '')
    {
        if(!empty($model)){
			// Try to assign POST values to attributes
			if(empty($_POST)){$_POST = json_decode(file_get_contents("php://input"),true);}
			$user_name = trim($_POST['user_name']);
			$password = trim($_POST['password']);
			// Find the user by user_name
			$user_info=User::model()->find('user_name=:user_name', array(':user_name'=>$user_name));
			if(!empty($user_info)){
				$password_salt = $user_info['password_salt'];
				$password = md5(md5($password).$password_salt);
				// Find the user
				$model = User::model()->find('user_name=:user_name and password=:password', array(':user_name'=>$user_name,':password'=>$password));
				if(is_null($model)){
					$this->_sendResponse(401, 'Error: Parameter user_name or password is invalid');
				}else{
					$this->_sendResponse(200, $model->attributes);
				}
			}else{
				$this->_sendResponse(401, 'Error: Parameter user_name does not exist');
			}
		}else{
			$this->_sendResponse(501, sprintf('Error: Wrong mode [%s] or Bad request method',$_GET['model']) );
			return;
		}
    } // }}}
    // }}} End Actions
}

/* vim:set ai sw=4 sts=4 et fdm=marker fdc=4: */
?>
