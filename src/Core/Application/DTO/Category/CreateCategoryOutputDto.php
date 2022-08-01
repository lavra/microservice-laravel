<?php

namespace Core\Application\DTO\Category;

class CreateCategoryOutputDto
{
    public function __construct(
        public string $id,
        public string $name,
        public string $description = '',
        public bool $isActive = true,
        public string $created_at = '',
    ) { }
}