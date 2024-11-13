<?php

declare(strict_types=1);

namespace VeggieVibe\Tests\Fruit\Infrastructure;

use Redis;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\SerializerInterface;
use VeggieVibe\Shared\Domain\ValueObject\ItemType;
use VeggieVibe\Fruit\Infrastructure\Persistence\Redis\RedisFruitRepository;
use VeggieVibe\Tests\Fruit\Domain\FruitIdMother;
use VeggieVibe\Tests\Fruit\Domain\FruitMother;
use VeggieVibe\Tests\Shared\Infrastructure\NormalizerMock;

final class RedisFruitRepositoryTest extends TestCase
{
    private readonly RedisFruitRepository $repository;
    private readonly Redis $redisClientMock;
    private readonly SerializerInterface $normalizerMock;

    public function setUp(): void
    {
        $this->redisClientMock = $this->createMock(Redis::class);
        $this->normalizerMock = $this->createMock(NormalizerMock::class);

        $this->repository = new RedisFruitRepository(
            $this->redisClientMock,
            $this->normalizerMock
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
}