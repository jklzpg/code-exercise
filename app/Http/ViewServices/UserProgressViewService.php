<?php


namespace App\Http\ViewServices;


use App\Repositories\LessonsProgressRepository;
use App\Resources\LessonProgressCollection;

class UserProgressViewService
{

    public static function getUserProgress(int $userId): LessonProgressCollection
    {
        return new LessonProgressCollection(LessonsProgressRepository::getLessonProgressForUserId($userId));
    }

}
