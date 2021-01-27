<?php


namespace App\Resources;


use App\Factories\LessonDifficultyFactory;
use Illuminate\Http\Resources\Json\JsonResource;

class LessonProgressResource extends JsonResource
{

    public function toArray($request)
    {
        $resource = $this->resource;
        return [
            'id' => $resource->id,
            'difficulty' => LessonDifficultyFactory::getCategoryName($resource->difficulty),
            'isComplete' => !!$resource->isComplete,
        ];
    }
}
