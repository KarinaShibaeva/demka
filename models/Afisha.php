<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "afisha".
 *
 * @property int $id
 * @property string $name
 * @property int $category_id
 * @property string $image
 * @property float $price
 * @property string $date
 * @property int $age
 * @property int $counts
 * @property string $created_at
 *
 * @property Basket[] $baskets
 * @property Category $category
 * @property Orders[] $orders
 */
class Afisha extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'afisha';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'category_id', 'image', 'date'], 'required'],
            [['category_id', 'age', 'counts'], 'integer'],
            [['price'], 'number'],
            [['date', 'created_at'], 'safe'],
            [['name', 'image'], 'string', 'max' => 256],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'category_id' => Yii::t('app', 'Category ID'),
            'image' => Yii::t('app', 'Image'),
            'price' => Yii::t('app', 'Price'),
            'date' => Yii::t('app', 'Date'),
            'age' => Yii::t('app', 'Age'),
            'counts' => Yii::t('app', 'Counts'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * Gets query for [[Baskets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBaskets()
    {
        return $this->hasMany(Basket::class, ['afisha_id' => 'id']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    /**
     * Gets query for [[Orders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::class, ['afisha_id' => 'id']);
    }
}
