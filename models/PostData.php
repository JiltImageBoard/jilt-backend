<?php

namespace app\models;

use app\common\classes\FileWrapper;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\web\UploadedFile;

/**
 * Class PostData
 * @package app\models
 *
 * @property int $id
 * @property string $name
 * @property int $messageId
 * @property string $subject
 * @property int $ip
 * @property string $session
 * @property bool $isPremoded
 * @property bool $isModPost
 * @property bool $isDeleted
 * @property \DateTime $createdAt
 * @property \DateTime $updatedAt
 * relations
 * @property PostMessage $postMessage
 * @property FileInfo[] $fileInfos
 */
class PostData extends ActiveRecordExtended
{
    /**
     * @var FileWrapper[]
     */
    public $files;

    /**
     * @var FileFormat[]
     */
    public $allowedFormats;

    /**
     * @return string
     */
    public static function tableName()
    {
        return 'post_data';
    }

    public function rules()
    {
        $extensions = [];
        foreach ($this->allowedFormats as $allowedFormat) {
            $extensions[] = $allowedFormat->extension;
        }
        $filesAllowed = !empty($extensions);

        // TODO: webm files not loading for some reason
        return [
            [
                ['files'],
                'file',
                'skipOnEmpty' => true,
                'extensions' => $filesAllowed ? $extensions : '.',
                'maxFiles' => 4,
                'wrongExtension' => $filesAllowed ? null : 'File posting is not allowed on this board'
            ]
        ];
    }

    public function getPostMessage()
    {
        return $this->hasOne(PostMessage::className(), ['id' => 'message_id']);
    }

    public function getFileInfos()
    {
        return $this->hasMany(FileInfo::className(), ['id' => 'files_info_id'])
            ->viaTable('post_data_files_info', ['post_data_id' => 'id']);
    }

    public function setFileInfos($ids)
    {
        if ($this->isNewRecord) $this->fileInfos = $ids;
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        $this->saveFiles();
        return parent::save($runValidation, $attributeNames);
    }
    
    private function saveFiles() 
    {

    }

    public function behaviors()
    {
        return [
            [ 
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ]
        ];
    }
}