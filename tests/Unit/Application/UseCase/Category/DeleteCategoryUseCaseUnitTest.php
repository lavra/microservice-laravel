<?php 

namespace Tests\Unit\Application\UseCase\Category;


use Mockery;
use stdClass;
use Ramsey\Uuid\Uuid;
use PHPUnit\Framework\TestCase;
use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\Application\UseCase\Category\DeleteCategoryUseCase;
use Core\Application\DTO\Category\{
    DeleteCategoryInputDto,
    DeleteCategoryOutputDto
};


class DeleteCategoryUseCaseUnitTest extends TestCase
{
    public function testDeleteTrue()
    {
        $uuid = (string) Uuid::uuid4()->toString();

        $this->mockRepository = Mockery::mock(stdClass::class, CategoryRepositoryInterface::class);
        $this->mockRepository->shouldReceive('delete')->andReturn(true);

        $this->mockInputDto = Mockery::mock(DeleteCategoryInputDto::class, [$uuid]);

        $useCase = new DeleteCategoryUseCase($this->mockRepository);
        $response = $useCase->execute($this->mockInputDto);

        $this->assertInstanceOf(DeleteCategoryOutputDto::class, $response);
        $this->assertTrue($response->success);

        
    }

    public function testDeleteFalse()
    {
        $uuid = (string) Uuid::uuid4()->toString();

        $this->mockRepository = Mockery::mock(stdClass::class, CategoryRepositoryInterface::class);
        $this->mockRepository->shouldReceive('delete')->andReturn(false);

        $this->mockInputDto = Mockery::mock(DeleteCategoryInputDto::class, [$uuid]);

        $useCase = new DeleteCategoryUseCase($this->mockRepository);
        $response = $useCase->execute($this->mockInputDto);

        $this->assertInstanceOf(DeleteCategoryOutputDto::class, $response);
        $this->assertFalse($response->success);

        $this->spies($this->mockInputDto);

    }

    /**
     * Validar se os métodos do repositório realmente foram chamados pelo UseCase.
     *
     * @param $mockInputDto
     * @return void
     */
    protected function spies($mockInputDto)
    {
        $this->spy = Mockery::spy(stdClass::class, CategoryRepositoryInterface::class);
        $this->spy->shouldReceive('delete')->andReturn(true);

        $useCase = new DeleteCategoryUseCase($this->spy);
        $useCase->execute($mockInputDto);

        $this->spy->shouldHaveReceived('delete');
    }

    /**
     * Chamado sempre que nossa class não está sendo utilizado.
     * importante: Implementar quando tiver mais de um teste na class.
     *
     * @return void
     */
    protected function tearDown(): void
    {
        Mockery::close();

        parent::tearDown();
    }
}
