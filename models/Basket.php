<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "basket".
 *
 * @property int $id
 * @property int $user_id
 * @property int $afisha_id
 * @property int $counts
 *
 * @property Afisha $afisha
 * @property User $user
 */
class Basket extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'basket';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'afisha_id', 'counts'], 'required'],
            [['user_id', 'afisha_id', 'counts'], 'integer'],
            [['afisha_id'], 'exist', 'skipOnError' => true, 'targetClass' => Afisha::class, 'targetAttribute' => ['afisha_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'afisha_id' => Yii::t('app', 'Afisha ID'),
            'counts' => Yii::t('app', 'Counts'),
        ];
    }

    /**
     * Gets query for [[Afisha]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAfisha()
    {
        return $this->hasOne(Afisha::class, ['id' => 'afisha_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
