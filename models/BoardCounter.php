<?php

namespace app\models;

/**
 * Class BoardCounter
 * @package app\models
 * 
 * @property int $id
 * @property int $boardId
 * @property int $counter
 */
class BoardCounter extends ARExtended
{
    public static function tableName()
    {
        return 'board_counters';
    }
}