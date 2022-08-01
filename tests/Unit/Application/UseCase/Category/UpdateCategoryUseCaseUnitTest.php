<?php

namespace Tests\Unit\Application\UseCase\Category;


use Mockery;
use stdClass;
use Ramsey\Uuid\Uuid;
use PHPUnit\Framework\TestCase;
use Core\Domain\Entity\Category as EntityCategory;
use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\Application\UseCase\Category\UpdateCategoryUseCase;
use Core\Application\DTO\Category\{
    UpdateCategoryInputDto,
    UpdateCategoryOutputDto
};
use phpDocumentor\Reflection\DocBlock\Tags\Var_;

class UpdateCategoryUseCaseUnitTest extends TestCase
{
    public function testRenameCategory()
    {
        $uuid = (string) Uuid::uuid4()->toString();
        $categoryName = 'Name';
        $categoryDescription = 'Desc';

        $this->mockEntity = Mockery::mock(EntityCategory::class, [
            $uuid, $categoryName, $categoryDescription
        ]);

        $this->mockEntity->shouldReceive('update');
        $this->mockEntity->shouldReceive('createdAt')->andReturn(date('Y-m-d H:i:s'));

        $this->mockRepository = Mockery::mock(stdClass::class, CategoryRepositoryInterface::class);
        $this->mockRepository->shouldReceive('findById')->andReturn($this->mockEntity);
        $this->mockRepository->shouldReceive('update')->andReturn($this->mockEntity);

        $this->mockInputDto = Mockery::mock(UpdateCategoryInputDto::class, [
            $uuid,
            'new_name',
        ]);

        $useCase = new UpdateCategoryUseCase($this->mockRepository);
        $response = $useCase->execute($this->mockInputDto);

        $this->assertInstanceOf(UpdateCategoryOutputDto::class, $response);

        $this->spies($this->mockEntity, $this->mockInputDto);

    }

    /**
     * Validar se os métodos do repositório realmente foram chamados pelo UseCase.
     *
     * @param $mockEntity
     * @param $mockInputDto
     */
    protected function spies($mockEntity, $mockInputDto): void
    {
        $this->spy = Mockery::spy(stdClass::class, CategoryRepositoryInterface::class);
        $this->spy->shouldReceive('findById')->andReturn($mockEntity);
        $this->spy->shouldReceive('update')->andReturn($mockEntity);

        $useCase = new UpdateCategoryUseCase($this->spy);
        $useCase->execute($mockInputDto);

        $this->spy->shouldHaveReceived('findById');
        $this->spy->shouldHaveReceived('update');
    }

    /**
     * Chamado sempre que nossa class não está sendo utilizado.
     * importante: Implementar quando tiver mais de um teste na class.
     */
    protected function tearDown(): void
    {
        Mockery::close();

        parent::tearDown();
    }
}
