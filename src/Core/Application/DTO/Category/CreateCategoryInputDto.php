<?php 

namespace Core\Application\DTO\Category;

class CreateCategoryInputDto
{
    /**
     * Construtor DTO Category
     *
     * @param string $name
     * @param string $description
     * @param boolean $isActive
     */
    public function __construct(
        public string $name,
        public string $description = '',
        public bool $isActive = true,
    ) { }
}