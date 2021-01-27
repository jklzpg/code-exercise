<?php


namespace App\Factories;


class LessonDifficultyFactory
{


    public static function getCategoryName(int $difficultyLevelId): string
    {
        //
        switch (ceil($difficultyLevelId / 3)) {
            case 1:
                return "Rookie";
            case 2:
                return "Intermediate";
            case 3:
                return "Advanced";
        }
        return "unknown";
    }

}
