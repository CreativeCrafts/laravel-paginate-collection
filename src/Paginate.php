<?php

namespace CreativeCrafts\Paginate;

use Illuminate\Container\Container;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;

class Paginate implements PaginateContract
{
    /**
     * Paginates a collection of items.
     *
     * This method creates a length-aware paginator for the given collection,
     * allowing for easy pagination of collection data.
     *
     * @param  Collection<string, mixed>  $collection  The collection to paginate
     * @param  ?int  $itemsPerPage  Number of items to display per page, uses default if null
     * @return LengthAwarePaginator<Collection<string, mixed>> A paginator instance for the collection
     *
     * @throws BindingResolutionException If the paginator cannot be resolved from the container
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
     * This method creates and configures a LengthAwarePaginator instance with the provided
     * collection items and pagination parameters.
     *
     * @param  Collection<string, mixed>  $items  The collection of items for the current page
     * @param  int  $total  The total number of items being paginated
     * @param  int  $perPage  The number of items to display per page
     * @param  int  $currentPage  The current page number
     * @param  array  $options  Additional options for the paginator (e.g., 'path', 'pageName')
     * @return LengthAwarePaginator<Collection<string, mixed>> A configured paginator instance
     *
     * @throws BindingResolutionException If the paginator cannot be resolved from the container
     */
    public static function paginator(
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

    /**
     * Get the default number of items to display per page.
     *
     * This method retrieves the configured default number of items per page from the
     * application's configuration, or falls back to 10 if not specified.
     *
     * @return int The default number of items to display per page
     */
    public static function defaultItemsPerPage(): int
    {
        return Config::integer(key: 'paginate-collection.items_per_page', default: 10);
    }

    /**
     * Get the default page name used for pagination.
     *
     * This method retrieves the configured default page name from the
     * application's configuration, or falls back to 'page' if not specified.
     *
     * @return string The default page name used in pagination URLs
     */
    public static function defaultPageName(): string
    {
        return Config::string(key: 'paginate-collection.page_name', default: 'page');
    }
}
