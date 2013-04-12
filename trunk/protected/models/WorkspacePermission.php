<?php

/**
 * This is the model class for table "{{workspace_permission}}".
 *
 * The followings are the available columns in table '{{workspace_permission}}':
 * @property string $permission_id
 * @property integer $workspace_id
 * @property integer $group_id
 * @property integer $user_id
 * @property string $create_permission
 * @property string $delete_permission
 * @property string $read_permission
 * @property string $share_permission
 */
class WorkspacePermission extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return WorkspacePermission the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{workspace_permission}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('workspace_id', 'required'),
			array('workspace_id, group_id, user_id', 'numerical', 'integerOnly'=>true),
			array('create_permission, delete_permission, read_permission, share_permission', 'length', 'max'=>5),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('permission_id, workspace_id, group_id, user_id, create_permission, delete_permission, read_permission, share_permission', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'permission_id' => 'Permission',
			'workspace_id' => 'Workspace',
			'group_id' => 'Group',
			'user_id' => 'User',
			'create_permission' => 'Create Permission',
			'delete_permission' => 'Delete Permission',
			'read_permission' => 'Read Permission',
			'share_permission' => 'Share Permission',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('permission_id',$this->permission_id,true);
		$criteria->compare('workspace_id',$this->workspace_id);
		$criteria->compare('group_id',$this->group_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('create_permission',$this->create_permission,true);
		$criteria->compare('delete_permission',$this->delete_permission,true);
		$criteria->compare('read_permission',$this->read_permission,true);
		$criteria->compare('share_permission',$this->share_permission,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}