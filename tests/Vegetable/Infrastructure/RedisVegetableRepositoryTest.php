<?php

declare(strict_types=1);

namespace VeggieVibe\Tests\Vegetable\Infrastructure;

use Redis;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use VeggieVibe\Shared\Domain\PrimitiveItem;
use VeggieVibe\Shared\Domain\ValueObject\ItemType;
use VeggieVibe\Tests\Shared\Domain\PrimitiveItemMother;
use VeggieVibe\Vegetable\Infrastructure\Persistence\Redis\RedisVegetableRepository;
use VeggieVibe\Tests\Shared\Infrastructure\NormalizerMock;
use VeggieVibe\Tests\Vegetable\Domain\VegetableIdMother;
use VeggieVibe\Tests\Vegetable\Domain\VegetableMother;
use VeggieVibe\Vegetable\Domain\Vegetable;

final class RedisVegetableRepositoryTest extends TestCase
{
    private readonly RedisVegetableRepository $repository;
    private readonly Redis $redisClientMock;
    private readonly SerializerInterface $normalizerMock;
    private readonly DenormalizerInterface $denormalizerMock;

    public function setUp(): void
    {
        $this->redisClientMock = $this->createMock(Redis::class);
        $this->normalizerMock = $this->createMock(NormalizerMock::class);
        $this->denormalizerMock = $this->createMock(DenormalizerInterface::class);

        $this->repository = new RedisVegetableRepository(
            $this->redisClientMock,
            $this->normalizerMock,
            $this->denormalizerMock
        );
    }

	/** @test */
	public function test_it_should_save_a_vegetable(): void
	{
		$item = VegetableMother::create();

		$this->redisClientMock->expects($this->once())
            ->method('hSet')
            ->with(
                $this->equalTo(ItemType::VEGETABLE->value),
                $this->equalTo($item->id()->value()),
                $this->anything()
            );

        $this->normalizerMock->expects($this->once())
            ->method('serialize');
        
        $this->repository->save($item);
	}

    /** @test */
    public function test_it_should_delete_all_vegetables()
    {
        $this->redisClientMock->expects($this->once())
        ->method('del')
        ->with(ItemType::VEGETABLE->value);
        
        $this->repository->deleteAll();
    }

    /** @test */
    public function test_it_should_delete_a_vegetable_by_id()
    {
        $id = VegetableIdMother::create();

        $this->redisClientMock->expects($this->once())
        ->method('hDel')
        ->with(
            ItemType::VEGETABLE->value,
            $id->value()
        );
        
        $this->repository->delete($id);
    }

    /** @test */
    public function test_it_should_search_by_id_and_return_null()
    {
        $id = VegetableIdMother::create();

        $this->redisClientMock->expects($this->once())
            ->method('hGet')
            ->with(
                ItemType::VEGETABLE->value,
                $id->value()
            )
            ->willReturn(null);
        
        $result = $this->repository->findById($id);
        
        $this->assertNull($result);
    }

    /** @test */
    public function test_it_should_search_by_id_and_return_vegetable()
    {
        $vegetable = VegetableMother::create();
        $primitiveItem = PrimitiveItemMother::create($vegetable->id()->value(), 'test', ItemType::VEGETABLE->value);
        $json = '{"name": "test"}';

        $this->redisClientMock->expects($this->once())
            ->method('hGet')
            ->with(
                ItemType::VEGETABLE->value,
                $vegetable->id()->value()
            )
            ->willReturn($json);

        $this->normalizerMock->expects($this->once())
            ->method('deserialize')
            ->with(
                $json,
                PrimitiveItem::class,
                'json'
            )
            ->willReturn($primitiveItem);
        
        $this->denormalizerMock->expects($this->once())
            ->method('denormalize')
            ->with(
                $primitiveItem,
                ItemType::VEGETABLE->class()
            )
            ->willReturn($vegetable);

        $result = $this->repository->findById($vegetable->id(), ItemType::VEGETABLE);

        $this->assertInstanceOf(Vegetable::class, $result);
    }
}