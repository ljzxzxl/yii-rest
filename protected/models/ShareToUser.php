<?php

/**
 * This is the model class for table "{{share_to_user}}".
 *
 * The followings are the available columns in table '{{share_to_user}}':
 * @property string $share_id
 * @property integer $user_id
 * @property integer $create_date
 * @property string $is_deleted
 */
class ShareToUser extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ShareToUser the static model class
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
		return '{{share_to_user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('share_id, user_id, create_date', 'required'),
			array('user_id, create_date', 'numerical', 'integerOnly'=>true),
			array('share_id', 'length', 'max'=>11),
			array('is_deleted', 'length', 'max'=>5),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('share_id, user_id, create_date, is_deleted', 'safe', 'on'=>'search'),
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
			'user_id' => 'User',
			'create_date' => 'Create Date',
			'is_deleted' => 'Is Deleted',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('create_date',$this->create_date);
		$criteria->compare('is_deleted',$this->is_deleted,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}