<?php 

namespace Core\Application\DTO\Category;

class ListCategoryInputDto
{
    /**
     * Construct function
     *
     * @param string $id
     */
    public function __construct(
        public string $id
    ) { }
}