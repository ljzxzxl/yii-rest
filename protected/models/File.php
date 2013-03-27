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
 * @property integer $size
 * @property integer $create_date
 * @property integer $update_date
 * @property string $mime_type
 * @property string $hash
 * @property integer $create_uid
 * @property string $create_uname
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
			array('file_name, path', 'required'),
			array('folder_id, owner_uid, size, create_date, update_date, create_uid', 'numerical', 'integerOnly'=>true),
			array('file_name, mime_type, hash, create_uname', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('file_id, file_name, path, folder_id, owner_uid, size, create_date, update_date, mime_type, hash, create_uid, create_uname', 'safe', 'on'=>'search'),
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
			'size' => 'Size',
			'create_date' => 'Create Date',
			'update_date' => 'Update Date',
			'mime_type' => 'Mime Type',
			'hash' => 'Hash',
			'create_uid' => 'Create Uid',
			'create_uname' => 'Create Uname',
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
		$criteria->compare('size',$this->size);
		$criteria->compare('create_date',$this->create_date);
		$criteria->compare('update_date',$this->update_date);
		$criteria->compare('mime_type',$this->mime_type,true);
		$criteria->compare('hash',$this->hash,true);
		$criteria->compare('create_uid',$this->create_uid);
		$criteria->compare('create_uname',$this->create_uname,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}