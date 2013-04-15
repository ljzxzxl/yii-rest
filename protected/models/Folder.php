<?php

/**
 * This is the model class for table "{{folder}}".
 *
 * The followings are the available columns in table '{{folder}}':
 * @property string $folder_id
 * @property string $folder_name
 * @property integer $parent_id
 * @property string $path
 * @property integer $owner_uid
 * @property integer $create_uid
 * @property string $create_uname
 * @property integer $create_date
 * @property integer $update_date
 * @property integer $update_uid
 * @property integer $company_id
 * @property integer $version_id
 * @property string $is_deleted
 * @property integer $sort
 */
class Folder extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Folder the static model class
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
		return '{{folder}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('folder_name, parent_id, path, owner_uid, create_uid, create_uname, create_date', 'required'),
			array('parent_id, owner_uid, create_uid, create_date, update_date, update_uid, company_id, version_id, sort', 'numerical', 'integerOnly'=>true),
			array('folder_name, create_uname', 'length', 'max'=>255),
			array('path', 'length', 'max'=>300),
			array('is_deleted', 'length', 'max'=>5),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('folder_id, folder_name, parent_id, path, owner_uid, create_uid, create_uname, create_date, update_date, update_uid, company_id, version_id, is_deleted, sort', 'safe', 'on'=>'search'),
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
			'folder_id' => 'Folder',
			'folder_name' => 'Folder Name',
			'parent_id' => 'Parent',
			'path' => 'Path',
			'owner_uid' => 'Owner Uid',
			'create_uid' => 'Create Uid',
			'create_uname' => 'Create Uname',
			'create_date' => 'Create Date',
			'update_date' => 'Update Date',
			'update_uid' => 'Update Uid',
			'company_id' => 'Company',
			'version_id' => 'Version',
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

		$criteria->compare('folder_id',$this->folder_id,true);
		$criteria->compare('folder_name',$this->folder_name,true);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('path',$this->path,true);
		$criteria->compare('owner_uid',$this->owner_uid);
		$criteria->compare('create_uid',$this->create_uid);
		$criteria->compare('create_uname',$this->create_uname,true);
		$criteria->compare('create_date',$this->create_date);
		$criteria->compare('update_date',$this->update_date);
		$criteria->compare('update_uid',$this->update_uid);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('version_id',$this->version_id);
		$criteria->compare('is_deleted',$this->is_deleted,true);
		$criteria->compare('sort',$this->sort);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}