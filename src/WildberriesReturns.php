<?php

namespace Filippi4\Wildberries;

use Illuminate\Validation\ValidationException;

class WildberriesReturns extends WildberriesReturnsClient
{
    /**
     * @throws ValidationException
     */
    public function config(array $keys): WildberriesReturns
    {
        $this->validateKeys($keys);

        $this->config = $keys;

        return $this;
    }

    /**
     * Метод предоставляет заявки покупателей на возврат товаров за последние 14 дней.
     *
     * @param bool $is_archive Состояние заявки
     * @param ?string $id ID заявки
     * @param ?int $limit Количество заявок в ответе [1..200]. По умолчанию 50
     * @param ?string $direction
     * @param ?int $offset После какого элемента выдавать данные >= 0. По умолчанию 0
     * @param int|null $nm_id Артикул WB
     * @return mixed
     */
    public function getReturns(
        bool $is_archive,
        string|null $id,
        int|null $limit,
        string|null $direction,
        int|null $offset,
        int|null $nm_id
    ): mixed
    {
        $is_archive = $is_archive ? 'true' : 'false';
        return (
            new WildberriesData(
                $this->getResponse(
                    'api/v1/claims',
                    compact('is_archive', 'id', 'limit', 'direction', 'offset', 'nm_id'),
                )
            )
        )->data;
    }
}