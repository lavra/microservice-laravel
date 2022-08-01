<?php

namespace Core\Application\DTO\Category;

class UpdateCategoryInputDto
{
    public function __construct(
        public string $id,
        public string $name,
        public string|null $description = null,
        public bool $isActive = true,
    ) { }
}