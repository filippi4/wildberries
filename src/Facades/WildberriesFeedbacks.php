<?php

namespace Filippi4\Wildberries\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Custom config
 * @method static WildberriesFeedbacks \Filippi4\Wildberries\WildberriesFeedbacks config($keys)
 * @method mixed getFeedbacksParentSubjects()
 * @method mixed getFeedbacksProductsRating(int $subjectId)
 * @method mixed getFeedbacksProductsRatingTop(int $subjectId)
 * @method mixed getFeedbacksProductsRatingTop(int $subjectId)
 * @method mixed getFeedbacksProductsRatingNmid(int $nmId)
 * @method mixed getFeedbacks(bool $isAnswered, bool $hasSupplierComplaint,int $nmId,int $take, int $skip,string $order)
 **/
class WildberriesFeedbacks extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'wildberries_feedbacks';
    }
}
