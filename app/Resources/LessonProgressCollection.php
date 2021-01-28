<?php


namespace App\Resources;


use Illuminate\Http\Resources\Json\ResourceCollection;

class LessonProgressCollection extends ResourceCollection
{
    public $collects = LessonProgressResource::class;

    public static $wrap = 'lessons';


    public function toArray($request)
    {
        return $this->collection;
    }
}
