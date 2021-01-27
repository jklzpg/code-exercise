<?php



namespace App\Http\Controllers;

use App\Http\ViewServices\UserProgressViewService;
use App\Resources\LessonProgressCollection;

class StudentProgressController extends Controller
{
    public function get(int $userId): LessonProgressCollection
    {
        return UserProgressViewService::getUserProgress($userId);
    }
}
