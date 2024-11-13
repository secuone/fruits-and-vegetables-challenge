<?php

declare(strict_types=1);

namespace VeggieVibe\Tests\Fruit\Infrastructure;

use Redis;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use VeggieVibe\Fruit\Domain\Fruit;
use VeggieVibe\Shared\Domain\ValueObject\ItemType;
use VeggieVibe\Fruit\Infrastructure\Persistence\Redis\RedisFruitRepository;
use VeggieVibe\Shared\Domain\PrimitiveItem;
use VeggieVibe\Tests\Shared\Domain\PrimitiveItemMother;
use VeggieVibe\Tests\Fruit\Domain\FruitIdMother;
use VeggieVibe\Tests\Fruit\Domain\FruitMother;
use VeggieVibe\Tests\Shared\Infrastructure\NormalizerMock;

final class RedisFruitRepositoryTest extends TestCase
{
    private readonly RedisFruitRepository $repository;
    private readonly Redis $redisClientMock;
    private readonly SerializerInterface $normalizerMock;
    private readonly DenormalizerInterface $denormalizerMock;

    public function setUp(): void
    {
        $this->redisClientMock = $this->createMock(Redis::class);
        $this->normalizerMock = $this->createMock(NormalizerMock::class);
        $this->denormalizerMock = $this->createMock(DenormalizerInterface::class);

        $this->repository = new RedisFruitRepository(
            $this->redisClientMock,
            $this->normalizerMock,
            $this->denormalizerMock
        );
    }

	/** @test */
	public function test_it_should_save_a_fruit(): void
	{
		$item = FruitMother::create();

		$this->redisClientMock->expects($this->once())
            ->method('hSet')
            ->with(
                $this->equalTo(ItemType::FRUIT->value),
                $this->equalTo($item->id()->value()),
                $this->anything()
            );

        $this->normalizerMock->expects($this->once())
            ->method('serialize');
        
        $this->repository->save($item);
	}

    /** @test */
    public function test_it_should_delete_all_fruits()
    {
        $this->redisClientMock->expects($this->once())
            ->method('del')
            ->with(ItemType::FRUIT->value);
        
        $this->repository->deleteAll();
    }

    /** @test */
    public function test_it_should_delete_a_fruit_by_id()
    {
        $id = FruitIdMother::create();

        $this->redisClientMock->expects($this->once())
            ->method('hDel')
            ->with(
                ItemType::FRUIT->value,
                $id->value()
            );
        
        $this->repository->delete($id);
    }

    /** @test */
    public function test_it_should_search_by_id_and_return_null()
    {
        $id = FruitIdMother::create();

        $this->redisClientMock->expects($this->once())
            ->method('hGet')
            ->with(
                ItemType::FRUIT->value,
                $id->value()
            )
            ->willReturn(null);
        
        $result = $this->repository->findById($id);
        
        $this->assertNull($result);
    }

    /** @test */
    public function test_it_should_search_by_id_and_return_fruit()
    {
        $fruit = FruitMother::create();
        $primitiveItem = PrimitiveItemMother::create($fruit->id()->value(), 'test', ItemType::FRUIT->value);
        $json = '{"name": "test"}';

        $this->redisClientMock->expects($this->once())
            ->method('hGet')
            ->with(
                ItemType::FRUIT->value,
                $fruit->id()->value()
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
                ItemType::FRUIT->class()
            )
            ->willReturn($fruit);

        $result = $this->repository->findById($fruit->id(), ItemType::FRUIT);

        $this->assertInstanceOf(Fruit::class, $result);
    }
}