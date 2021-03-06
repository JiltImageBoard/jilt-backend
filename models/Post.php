<?php

namespace app\models;

use app\common\interfaces\DeletableInterface;

/**
 * Class Post
 * @package app\models
 *
 * @property int $id
 * @property int $postDataId
 *
 * @property \app\models\PostData $postData
 */

class Post extends ARExtended implements DeletableInterface
{
    public static function tableName()
    {
        return 'posts';
    }

    public function getPostData()
    {
        return $this->hasOne(PostData::className(), ['id' => 'post_data_id']);
    }

    public static function getDeletedRows(Array &$carry)
    {
        $posts = self::find()->where(['is_deleted' => '1'])->all();

        if (empty($posts)) {
            return $carry;
        }

        foreach ($posts as $post) {
            $carry['postsIds'][] = $post->id;
        }
    }

}