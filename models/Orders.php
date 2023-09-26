<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property int $user_id
 * @property int $afisha_id
 * @property int $counts
 * @property int $status
 * @property string $warning
 * @property string $created_at
 *
 * @property Afisha $afisha
 * @property User $user
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'afisha_id', 'counts'], 'required'],
            [['user_id', 'afisha_id', 'counts', 'status'], 'integer'],
            [['warning'], 'string'],
            [['created_at'], 'safe'],
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
            'status' => Yii::t('app', 'Status'),
            'warning' => Yii::t('app', 'Warning'),
            'created_at' => Yii::t('app', 'Created At'),
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
