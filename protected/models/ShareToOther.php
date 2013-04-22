<?php

/**
 * This is the model class for table "{{share_to_other}}".
 *
 * The followings are the available columns in table '{{share_to_other}}':
 * @property integer $share_id
 * @property integer $file_id
 * @property string $share_link
 * @property integer $download_nums
 * @property integer $create_date
 */
class ShareToOther extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ShareToOther the static model class
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
		return '{{share_to_other}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('share_id, file_id, create_date', 'required'),
			array('share_id, file_id, download_nums, create_date', 'numerical', 'integerOnly'=>true),
			array('share_link', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('share_id, file_id, share_link, download_nums, create_date', 'safe', 'on'=>'search'),
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
			'share_link' => 'Share Link',
			'download_nums' => 'Download Nums',
			'create_date' => 'Create Date',
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

		$criteria->compare('share_id',$this->share_id);
		$criteria->compare('file_id',$this->file_id);
		$criteria->compare('share_link',$this->share_link,true);
		$criteria->compare('download_nums',$this->download_nums);
		$criteria->compare('create_date',$this->create_date);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}