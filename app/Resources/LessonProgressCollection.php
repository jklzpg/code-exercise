<?php


namespace App\Resources;


use Illuminate\Http\Resources\Json\ResourceCollection;

class LessonProgressCollection extends ResourceCollection
{
    public $collects = LessonProgressResource::class;

    public static $wrap = null;


    public function toArray($request)
    {
        return [
            'lessons' => $this->collection,
        ];
    }
}
