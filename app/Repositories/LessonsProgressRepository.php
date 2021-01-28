<?php


namespace App\Repositories;


use App\Models\Lesson;
use App\Models\PracticeRecord;
use App\Models\Segment;
use App\Models\User;
use App\Services\ModelTableInfoService;

class LessonsProgressRepository
{

    public static function getLessonProgressForUserId(int $userId)
    {

        $lessonTable = ModelTableInfoService::getTableName(Lesson::class);
        $segmentTable = ModelTableInfoService::getTableName(Segment::class);

        $scorePercentRawQuery = "MAX(FLOOR(" . PracticeRecord::COLUMN_QTY_CORRECTLY_PLAYED_NOTES . "/(" . PracticeRecord::COLUMN_QTY_AVAILABLE_NOTES . " + " . PracticeRecord::COLUMN_QTY_INCORRECTLY_PLAYED_NOTES . ") * 100)) as max_score_percent";
        $practiceRecordSubQuery = PracticeRecord::query()
            ->select([
                PracticeRecord::COLUMN_SEGMENT_ID,
            ])
            ->selectRaw($scorePercentRawQuery)
            ->where(PracticeRecord::COLUMN_USER_ID, $userId)
            ->groupBy([
                PracticeRecord::COLUMN_SEGMENT_ID,
                PracticeRecord::COLUMN_USER_ID,
            ]);
        $segmentSubQuery = Segment::query()
            ->leftJoinSub(
                $practiceRecordSubQuery,
                'pr',
                "pr.".PracticeRecord::COLUMN_SEGMENT_ID,
                $segmentTable.".".Segment::COLUMN_ID
            )
            ->select([
                'segments.lesson_id as lessons_id',
                "segments.id as segments_id",
                "max_score_percent",
            ])
            ->selectRaw("COALESCE(max_score_percent, 0) AS segment_score");

        return Lesson::query()
            ->leftJoinSub(
                $segmentSubQuery,
                'segment_best_pr',
                $lessonTable.".".Lesson::COLUMN_ID,
                "segment_best_pr.lessons_id",
            )
            // lesson should be published
            ->where($lessonTable.".".Lesson::COLUMN_IS_PUBLISHED, 1)
            // will need to output column results for lesson_id
            ->select([
                'lessons.id as id',
                'lessons.difficulty as difficulty'
            ])
            // output only passed if user has above 80% for all segments in the lesson
            ->selectRaw('IF(MIN(segment_best_pr.segment_score) >= 80, true, false) as isComplete')
            /**
             * group by lesson id, only need 1 result per lesson
             * this also allows us to make use of
             *  MIN(segment_best_pr.segment_score)
             *  MAX(segment_best_pr.segment_score)
             */
            ->groupBy([
                'lessons.id',
            ])
            // user needs a practice record score for lesson to be returned
            ->havingRaw('MAX(segment_best_pr.segment_score) > 0')
            // order by
            ->orderBy('lessons.id')
            ->paginate(10);

    }
}
