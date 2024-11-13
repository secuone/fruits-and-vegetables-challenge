<?php

declare(strict_types=1);

namespace VeggieVibe\Tests\Vegetable\Infrastructure;

use Redis;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\SerializerInterface;
use VeggieVibe\Shared\Domain\ValueObject\ItemType;
use VeggieVibe\Vegetable\Infrastructure\Persistence\Redis\RedisVegetableRepository;
use VeggieVibe\Tests\Shared\Infrastructure\NormalizerMock;
use VeggieVibe\Tests\Vegetable\Domain\VegetableIdMother;
use VeggieVibe\Tests\Vegetable\Domain\VegetableMother;

final class RedisVegetableRepositoryTest extends TestCase
{
    private readonly RedisVegetableRepository $repository;
    private readonly Redis $redisClientMock;
    private readonly SerializerInterface $normalizerMock;

    public function setUp(): void
    {
        $this->redisClientMock = $this->createMock(Redis::class);
        $this->normalizerMock = $this->createMock(NormalizerMock::class);

        $this->repository = new RedisVegetableRepository(
            $this->redisClientMock,
            $this->normalizerMock
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
}