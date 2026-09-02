<?php

namespace Filippi4\Wildberries\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Custom config
 * @method static \Filippi4\Wildberries\WildberriesFeedbacks config(array $keys)
 * @method static mixed getFeedbacksParentSubjects()
 * @method static mixed getFeedbacksProductsRating(int $subjectId)
 * @method static mixed getFeedbacksProductsRatingTop(int $subjectId)
 * @method static mixed getFeedbacksProductsRatingNmid(int $nmId)
 * @method static mixed getFeedbacks(bool $isAnswered, int $take, int $skip, string $order, ?int $dateFrom = null, ?int $nmId = null)
 * @method static mixed getFeedbacksArchive(int $take, int $skip, string $order, int $dateFrom)
 * @method static mixed getQuestions(bool $isAnswered, int $take, int $skip, string $order, int $dateFrom)
 **/
class WildberriesFeedbacks extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'wildberries_feedbacks';
    }
}
