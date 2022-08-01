<?php 

namespace Core\Application\UseCase\Category;

use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\Application\DTO\Category\{
    DeleteCategoryInputDto,
    DeleteCategoryOutputDto
};

class DeleteCategoryUseCase
{
    protected $repository;

    public function __construct(CategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(DeleteCategoryInputDto $input):DeleteCategoryOutputDto
    {
        $responseDelete = $this->repository->delete($input->id);

        return new DeleteCategoryOutputDto(
            success: $responseDelete
        );
    }
}