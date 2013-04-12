<?php

/**
 * This is the model class for table "{{file}}".
 *
 * The followings are the available columns in table '{{file}}':
 * @property string $file_id
 * @property string $file_name
 * @property string $path
 * @property integer $folder_id
 * @property integer $owner_uid
 * @property integer $file_size
 * @property string $file_path
 * @property integer $create_date
 * @property integer $update_date
 * @property integer $update_uid
 * @property string $mime_type
 * @property string $hash
 * @property integer $create_uid
 * @property string $create_uname
 * @property integer $company_id
 * @property integer $version_id
 * @property string $is_deleted
 * @property integer $sort
 */
class File extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return File the static model class
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
		return '{{file}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('file_name, path, folder_id, owner_uid, file_path, create_date, create_uid, create_uname, company_id', 'required'),
			array('folder_id, owner_uid, file_size, create_date, update_date, update_uid, create_uid, company_id, version_id, sort', 'numerical', 'integerOnly'=>true),
			array('file_name, file_path, hash, create_uname', 'length', 'max'=>255),
			array('mime_type', 'length', 'max'=>64),
			array('is_deleted', 'length', 'max'=>5),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('file_id, file_name, path, folder_id, owner_uid, file_size, file_path, create_date, update_date, update_uid, mime_type, hash, create_uid, create_uname, company_id, version_id, is_deleted, sort', 'safe', 'on'=>'search'),
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
			'file_id' => 'File',
			'file_name' => 'File Name',
			'path' => 'Path',
			'folder_id' => 'Folder',
			'owner_uid' => 'Owner Uid',
			'file_size' => 'File Size',
			'file_path' => 'File Path',
			'create_date' => 'Create Date',
			'update_date' => 'Update Date',
			'update_uid' => 'Update Uid',
			'mime_type' => 'Mime Type',
			'hash' => 'Hash',
			'create_uid' => 'Create Uid',
			'create_uname' => 'Create Uname',
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

		$criteria->compare('file_id',$this->file_id,true);
		$criteria->compare('file_name',$this->file_name,true);
		$criteria->compare('path',$this->path,true);
		$criteria->compare('folder_id',$this->folder_id);
		$criteria->compare('owner_uid',$this->owner_uid);
		$criteria->compare('file_size',$this->file_size);
		$criteria->compare('file_path',$this->file_path,true);
		$criteria->compare('create_date',$this->create_date);
		$criteria->compare('update_date',$this->update_date);
		$criteria->compare('update_uid',$this->update_uid);
		$criteria->compare('mime_type',$this->mime_type,true);
		$criteria->compare('hash',$this->hash,true);
		$criteria->compare('create_uid',$this->create_uid);
		$criteria->compare('create_uname',$this->create_uname,true);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('version_id',$this->version_id);
		$criteria->compare('is_deleted',$this->is_deleted,true);
		$criteria->compare('sort',$this->sort);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}