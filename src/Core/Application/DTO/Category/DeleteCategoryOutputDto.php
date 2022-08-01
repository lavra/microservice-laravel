<?php

namespace Core\Application\DTO\Category;

class DeleteCategoryOutputDto
{
    public function __construct(
        public bool $success = true
    ) { }
}