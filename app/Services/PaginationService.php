<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;

class PaginationService
{
    protected const PER_PAGE = 10;

    static public function paginate(Collection $collection, int $page_num): array
    {
        $collection_count = $collection->count();
        $collection = $collection->slice(self::PER_PAGE * ($page_num - 1), self::PER_PAGE);

        $hasNextPage = self::hasNextPage($collection_count, $page_num);

        return [
            'data' => $collection,
            'hasNextPage' => $hasNextPage
        ];
    }

    static private function hasNextPage($collection_count, $page_num): bool
    {
        return !(ceil($collection_count / self::PER_PAGE) > $page_num);
    }
}
