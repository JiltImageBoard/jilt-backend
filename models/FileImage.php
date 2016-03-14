<?php

namespace app\models;
use yii\web\UploadedFile;

/**
 * Class FileVideo
 * @package app\models
 * @property int $filesInfoId
 * @property int $width
 * @property int $height
 * inherited
 * @property string $filePath
 * @property string $originalName
 * @property string $hash
 * @property float $size
 * relations
 * @property FileInfo $fileInfo
 */
class FileImage extends FileInfo
{
    public static function tableName()
    {
        return 'files_images';
    }

    public function getFileInfo()
    {
        return $this->hasOne(FileInfo::className(), ['id' => 'files_info_id']);
    }

    /**
     * @param UploadedFile $file
     * @return FileInfo|
     */
    public static function saveFile($file)
    {
        if ($fileInfo = parent::saveFile($file)) {
            $fileImage = new FileImage();
            list($fileImage->width, $fileImage->height) = getimagesize($fileInfo->filePath);
            $fileImage->filesInfoId = $fileInfo->id;
            $fileImage->save();
            return $fileInfo;
        }

        return false;
    }


}