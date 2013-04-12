<?php

/**
 * This is the model class for table "{{workspace}}".
 *
 * The followings are the available columns in table '{{workspace}}':
 * @property string $workspace_id
 * @property string $workspace_name
 * @property string $workspace_desc
 * @property integer $create_uid
 * @property string $create_uname
 * @property integer $create_date
 * @property integer $update_date
 * @property integer $update_uid
 * @property integer $company_id
 * @property string $is_deleted
 * @property integer $sort
 */
class Workspace extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Workspace the static model class
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
		return '{{workspace}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('workspace_name, workspace_desc, create_uid, create_uname, create_date, company_id', 'required'),
			array('create_uid, create_date, update_date, update_uid, company_id, sort', 'numerical', 'integerOnly'=>true),
			array('workspace_name, create_uname', 'length', 'max'=>255),
			array('is_deleted', 'length', 'max'=>5),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('workspace_id, workspace_name, workspace_desc, create_uid, create_uname, create_date, update_date, update_uid, company_id, is_deleted, sort', 'safe', 'on'=>'search'),
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
			'workspace_id' => 'Workspace',
			'workspace_name' => 'Workspace Name',
			'workspace_desc' => 'Workspace Desc',
			'create_uid' => 'Create Uid',
			'create_uname' => 'Create Uname',
			'create_date' => 'Create Date',
			'update_date' => 'Update Date',
			'update_uid' => 'Update Uid',
			'company_id' => 'Company',
			'is_deleted' => 'Is Deleted',
			'sort' => 'Sort',
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

		$criteria->compare('workspace_id',$this->workspace_id,true);
		$criteria->compare('workspace_name',$this->workspace_name,true);
		$criteria->compare('workspace_desc',$this->workspace_desc,true);
		$criteria->compare('create_uid',$this->create_uid);
		$criteria->compare('create_uname',$this->create_uname,true);
		$criteria->compare('create_date',$this->create_date);
		$criteria->compare('update_date',$this->update_date);
		$criteria->compare('update_uid',$this->update_uid);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('is_deleted',$this->is_deleted,true);
		$criteria->compare('sort',$this->sort);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}