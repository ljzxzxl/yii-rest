<?php

/**
 * This is the model class for table "{{share}}".
 *
 * The followings are the available columns in table '{{share}}':
 * @property string $share_id
 * @property integer $file_id
 * @property integer $folder_id
 * @property integer $share_type
 * @property integer $owner_uid
 * @property integer $permission
 * @property integer $share_date
 * @property integer $expiration
 * @property string $token
 * @property integer $download_date
 * @property integer $download_nums
 * @property string $share_link
 */
class Share extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Share the static model class
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
		return '{{share}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('share_type, owner_uid, permission, share_date', 'required'),
			array('file_id, folder_id, share_type, owner_uid, permission, share_date, expiration, download_date, download_nums', 'numerical', 'integerOnly'=>true),
			array('token, share_link', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('share_id, file_id, folder_id, share_type, owner_uid, permission, share_date, expiration, token, download_date, download_nums, share_link', 'safe', 'on'=>'search'),
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
			'share_id' => 'Share',
			'file_id' => 'File',
			'folder_id' => 'Folder',
			'share_type' => 'Share Type',
			'owner_uid' => 'Owner Uid',
			'permission' => 'Permission',
			'share_date' => 'Share Date',
			'expiration' => 'Expiration',
			'token' => 'Token',
			'download_date' => 'Download Date',
			'download_nums' => 'Download Nums',
			'share_link' => 'Share Link',
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

		$criteria->compare('share_id',$this->share_id,true);
		$criteria->compare('file_id',$this->file_id);
		$criteria->compare('folder_id',$this->folder_id);
		$criteria->compare('share_type',$this->share_type);
		$criteria->compare('owner_uid',$this->owner_uid);
		$criteria->compare('permission',$this->permission);
		$criteria->compare('share_date',$this->share_date);
		$criteria->compare('expiration',$this->expiration);
		$criteria->compare('token',$this->token,true);
		$criteria->compare('download_date',$this->download_date);
		$criteria->compare('download_nums',$this->download_nums);
		$criteria->compare('share_link',$this->share_link,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}