<?php 

namespace Core\Application\UseCase\Category;

use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\Application\DTO\Category\{
    UpdateCategoryInputDto,
    UpdateCategoryOutputDto
};

class UpdateCategoryUseCase
{
    protected $repository;

    public function __construct(CategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(UpdateCategoryInputDto $input):UpdateCategoryOutputDto
    {
        $category = $this->repository->findById($input->id);

        $category->update(
            name: $input->name,
            description: $input->description ?? $category->description,
        );

        $update = $this->repository->update($category);

        return new UpdateCategoryOutputDto(
            id: $update->id,
            name: $update->name,
            description: $update->description,
            isActive: $update->isActive,
            created_at: $update->createdAt(),
        );
    }
}