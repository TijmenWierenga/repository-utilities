<?php

declare(strict_types=1);

namespace TijmenWierenga\Repositories;

use PHPUnit\Framework\TestCase;

class InMemoryRepositoryTest extends TestCase
{
    public function testItReturnsAllItems(): void
    {
        $repository = new InMemoryRepository([new User(1, 'tijmen')]);

        $all = $repository->all();

        static::assertCount(1, $all);
    }

    public function testItStoresAValue(): void
    {
        $repository = new InMemoryRepository();
        $user = new User(1, 'tijmen');

        $repository->add($user);

        static::assertCount(1, $repository);
        static::assertEquals($user, $repository->first());
    }

    public function testItRemovesAValueFromTheStoreBasedOnCondition(): void
    {
        $repository = new InMemoryRepository([new User(1, 'tijmen')]);

        $repository->remove(fn (User $user): bool => $user->id() === 1);

        static::assertCount(0, $repository);
    }

    public function testItFindsTheFirstMatchingValueBasedOnCondition(): void
    {
        $user = new User(1, 'tijmen');
        $repository = new InMemoryRepository([$user]);

        $result = $repository->find(fn (User $user): bool => $user->id() === 1);

        static::assertEquals($user, $result);

        $result = $repository->find(fn (User $user): bool => $user->id() === 2);

        static::assertNull($result);
    }

    public function testItFindsMultipleValuesBasedOnACondition(): void
    {
        $first = new User(1, 'tijmen');
        $second = new User(2, 'barack');
        $third = new User(3, 'donald');
        $repository = new InMemoryRepository([$first, $second, $third]);

        $result = $repository->findMany(
            fn (User $user): bool => $user->username() === 'tijmen' || $user->username() === 'barack'
        );

        static::assertCount(2, $result);
        static::assertContains($first, $result);
        static::assertContains($second, $result);
    }
}
