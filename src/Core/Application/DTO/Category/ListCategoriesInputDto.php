<?php 

namespace Core\Application\DTO\Category;

class ListCategoriesInputDto
{
    /**
     * Construct function
     */
    public function __construct(
        public string $filter = '',
        public string $order = 'DESC',
        public int $page = 1,
        public int $totalPage = 15
    ) { }
}