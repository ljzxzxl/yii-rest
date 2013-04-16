<?php

/**
 * This is the model class for table "{{share_to_group}}".
 *
 * The followings are the available columns in table '{{share_to_group}}':
 * @property integer $share_id
 * @property integer $group_id
 * @property integer $create_date
 */
class ShareToGroup extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ShareToGroup the static model class
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
		return '{{share_to_group}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('share_id, group_id, create_date', 'required'),
			array('share_id, group_id, create_date', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('share_id, group_id, create_date', 'safe', 'on'=>'search'),
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
			'group_id' => 'Group',
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
		$criteria->compare('group_id',$this->group_id);
		$criteria->compare('create_date',$this->create_date);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}