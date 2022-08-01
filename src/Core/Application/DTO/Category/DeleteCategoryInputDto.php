<?php

namespace Core\Application\DTO\Category;

class DeleteCategoryInputDto
{
    public function __construct(
        public string $id
    ) { }
}