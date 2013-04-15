<?php
/**
 * FavoriteController class file
 * @author Xeylon Zhou <ljzxzxl@gmail.com>  
 * @date 2013-04-15 
 */
class FavoriteController extends Controller
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
					$models = UserFavorite::model()->findAll('user_id=:user_id', array(':user_id'=>$user_id));
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
			$this->_sendResponse(501, sprintf('Error: Wrong mode [%s] or Bad request method',$_GET['model']) );
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
                $model = UserFavorite::model()->findByPk($_GET['id']);
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
                $model = new UserFavorite;  
				$this->_addFavorite($model);
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
		if(intval($put_vars['user_id']) && intval($put_vars['file_id'])){
			switch($_GET['model'])
			{
				// Find respective model
				case 'update': // {{{ 
					$user_id = intval($put_vars['user_id']);
					$file_id = intval($put_vars['file_id']);
					// Find the favorite by user_id and file_id
					$model = UserFavorite::model()->find('user_id=:user_id AND file_id=:file_id', array(':user_id'=>$user_id, ':file_id'=>$file_id));                  
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
				$this->_sendResponse(200, sprintf('The favorite has been updated.') );
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
			$this->_sendResponse(501, sprintf('Error: Wrong mode [%s] or Bad request method',$_GET['model']) );
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
		if(intval($put_vars['user_id']) && intval($put_vars['file_id'])){
			switch($_GET['model'])
			{
				// Load the respective model
				case 'delete': // {{{ 
					$user_id = intval($put_vars['user_id']);
					$file_id = intval($put_vars['file_id']);
					// Find the favorite by user_id and file_id
					$model = UserFavorite::model()->find('user_id=:user_id AND file_id=:file_id', array(':user_id'=>$user_id, ':file_id'=>$file_id));                   
					break; // }}} 
				default: // {{{ 
					$this->_sendResponse(501, sprintf('Error: Wrong mode [%s] or Bad request method',$_GET['model']) );
					exit; // }}} 
			}
			// Was a model found?
			if(is_null($model)) {
				// No, raise an error
				$this->_sendResponse(400, sprintf("Error: Didn't find any favorite.") );
			}
	
			// Delete the model
			$num = $model->delete();
			if($num>0)
				$this->_sendResponse(200, sprintf("The favorite has been deleted.") );
			else
				$this->_sendResponse(500, sprintf("Error: Couldn't delete the favorite.") );
		}else{
			$this->_sendResponse(501, sprintf('Error: Wrong mode [%s] or Bad request method',$_GET['model']) );
			exit;
		}
    } // }}} 
	// {{{ _addFavorite
    /**
     * Post a new item
     * @return void
     */
    public function _addFavorite($model = '')
    {
        if(!empty($model)){
			// Try to assign POST values to attributes
			if(empty($_POST)){$_POST = json_decode(file_get_contents("php://input"),true);}
			if(is_array($_POST)){
				$user_id = trim($_POST['user_id']);
				$file_id = trim($_POST['file_id']);
				// Find the favorite by user_id and file_id
				$favorite_info = UserFavorite::model()->find('user_id=:user_id AND file_id=:file_id', array(':user_id'=>$user_id, ':file_id'=>$file_id));
				if(empty($favorite_info)){
					$_POST['memo'] = trim($_POST['memo']);
				}else{
					$this->_sendResponse(501, sprintf('Error: The favorite already exists') );
					return;
				}
			}else{
				$this->_sendResponse(501, sprintf('Error: Parameter user_id and file_id is required') );
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
    // }}} End Actions
}

/* vim:set ai sw=4 sts=4 et fdm=marker fdc=4: */
?>
