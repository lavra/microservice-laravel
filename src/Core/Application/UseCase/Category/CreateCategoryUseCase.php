<?php

namespace Core\Application\UseCase\Category;

use Core\Domain\Entity\Category;
use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\Application\DTO\Category\{
    CreateCategoryInputDto,
    CreateCategoryOutputDto
};

class CreateCategoryUseCase
{
    protected $repository;

    public function __construct(CategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(CreateCategoryInputDto $input): CreateCategoryOutputDto
    {
        $category = new Category(
            name: $input->name,
            description: $input->description,
            isActive: $input->isActive
        );

        $new_category = $this->repository->insert($category);

        return new CreateCategoryOutputDto(
            id: $new_category->id(),
            name: $new_category->name,
            description: $category->description,
            isActive: $category->isActive,
            created_at: $new_category->createdAt(),
        );
    }
}