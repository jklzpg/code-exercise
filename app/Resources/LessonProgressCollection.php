<?php


namespace App\Resources;


use Illuminate\Http\Resources\Json\ResourceCollection;

class LessonProgressCollection extends ResourceCollection
{
    public $collects = LessonProgressResource::class;


    public function toArray($request)
    {
        $this->withoutWrapping();
        return [
            'lessons' => $this->collection,
        ];
    }
}
