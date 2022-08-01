<?php 

namespace Tests\Unit\Application\UseCase\Category;

use Mockery;
use stdClass;
use PHPUnit\Framework\TestCase;
use Core\Domain\Repository\PaginationInterface;
use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\Application\UseCase\Category\ListCategoriesUseCase;
use Core\Application\DTO\Category\{
    ListCategoriesInputDto,
    ListCategoriesOutputDto,
};

class ListCategoriesUseCaseUnitTest extends TestCase
{
    public function testListCategoriesEmpty()
    {
        $mockPagination = $this->mockPagination();

        $this->mockRepository = Mockery::mock(stdClass::class, CategoryRepositoryInterface::class);
        $this->mockRepository->shouldReceive('paginate')->andReturn($mockPagination);

        $this->mockInputDto = Mockery::mock(ListCategoriesInputDto::class, ['filter','order']);

        $useCase =  new ListCategoriesUseCase($this->mockRepository);        
        $response = $useCase->execute($this->mockInputDto);

        $this->assertCount(0, $response->items);
        $this->assertInstanceOf(ListCategoriesOutputDto::class, $response);   
      
        $this->spiesPagination($mockPagination, $this->mockInputDto);     
    } 

    public function testListCategories()
    {
        $mockPagination = $this->mockPagination([
            $this->register(),
        ]);

        $this->mockRepository = Mockery::mock(stdClass::class, CategoryRepositoryInterface::class);
        $this->mockRepository->shouldReceive('paginate')->andReturn($mockPagination);

        $this->mockInputDto = Mockery::mock(ListCategoriesInputDto::class, ['filter','order']);

        $useCase =  new ListCategoriesUseCase($this->mockRepository);        
        $response = $useCase->execute($this->mockInputDto);

        $this->assertCount(1, $response->items);
        $this->assertInstanceOf(stdClass::class, $response->items[0]); 
        $this->assertInstanceOf(ListCategoriesOutputDto::class, $response);    
        
    } 

    /**
     * Registro dos campos que serão utilizados na tabela
     *
     * @return void
     */
    protected function register()
    {
        $register = new stdClass();
        $register->id = 'id';
        $register->name = 'name';
        $register->description = 'description';
        $register->is_active = 'is_active';
        $register->created_at = 'created_at';
        $register->updated_at = 'updated_at';
        $register->deleted_at = 'deleted_at';

        return $register;
    }

    /**
     * Validar se os métodos do repositório realmente foram chamados pelo UseCase.
     *
     * @param $mockPagination
     * @param $mockInputDto
     * @return void
     */
    protected function spiesPagination($mockPagination, $mockInputDto):void
    {
        $this->spy = Mockery::spy(stdClass::class, CategoryRepositoryInterface::class);
        $this->spy->shouldReceive('paginate')->andReturn($mockPagination);
        $useCase =  new ListCategoriesUseCase($this->spy);        
        $useCase->execute($mockInputDto);
        $this->spy->shouldHaveReceived('paginate');
    }

    
    protected function mockPagination(array $items = [])
    {
        $this->mockPagination = Mockery::mock(stdClass::class, PaginationInterface::class);
        $this->mockPagination->shouldReceive('items')->andReturn($items);
        $this->mockPagination->shouldReceive('total')->andReturn(0);
        $this->mockPagination->shouldReceive('firstPage')->andReturn(0);
        $this->mockPagination->shouldReceive('currentPage')->andReturn(0);
        $this->mockPagination->shouldReceive('lastPage')->andReturn(0);
        $this->mockPagination->shouldReceive('perPage')->andReturn(0);
        $this->mockPagination->shouldReceive('to')->andReturn(0);
        $this->mockPagination->shouldReceive('from')->andReturn(0);

        return $this->mockPagination;
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