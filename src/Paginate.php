<?php

namespace CreativeCrafts\Paginate;

use Illuminate\Container\Container;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

class Paginate
{
    /**
     * @param  Collection<string, mixed>  $collection
     * @return LengthAwarePaginator<Collection<string, mixed>>
     *
     * @throws BindingResolutionException
     */
    public static function collection(Collection $collection, ?int $itemsPerPage): LengthAwarePaginator
    {
        if (is_null($itemsPerPage)) {
            $itemsPerPage = self::defaultItemsPerPage();
        }

        $pageNumber = Paginator::resolveCurrentPage(self::defaultPageName());
        $totalPageNumber = $collection->count();

        return self::paginator($collection->forPage($pageNumber, $itemsPerPage), $totalPageNumber, $itemsPerPage, $pageNumber, [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => self::defaultPageName(),
        ]);
    }

      /**
       * Create a new length-aware paginator instance.
       *
       * @param  Collection<string, mixed>  $items
       * @return LengthAwarePaginator<Collection<string, mixed>>
       *
       * @throws BindingResolutionException
       */
      protected static function paginator(
        Collection $items,
        int $total,
        int $perPage,
        int $currentPage,
        array $options
    ): LengthAwarePaginator {
          /** @var LengthAwarePaginator<Collection<string, mixed>> $pagination */
          $pagination = Container::getInstance()->makeWith(LengthAwarePaginator::class, compact(
              'items',
              'total',
              'perPage',
              'currentPage',
              'options'
          ));

          return $pagination;
      }

      public static function defaultItemsPerPage(): int
      {
          /** @var int config('paginate-collection.items_per_page') */
          return config('paginate-collection.items_per_page');
      }

      public static function defaultPageName(): string
      {
          /** @var string config('paginate-collection.page_name') */
          return config('paginate-collection.page_name');
      }
}
