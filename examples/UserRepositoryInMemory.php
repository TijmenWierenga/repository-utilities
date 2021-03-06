<?php

declare(strict_types=1);

use TijmenWierenga\Repositories\InMemoryRepository;

final class UserRepositoryInMemory implements UserRepository
{
    /**
     * @psalm-var InMemoryRepository<User>
     */
    private InMemoryRepository $storage;

    /**
     * @psalm-param InMemoryRepository<User> $storage
     */
    public function __construct(InMemoryRepository $storage)
    {
        $this->storage = $storage;
    }

    public function find(int $userId): ?User
    {
        return $this->storage->find(fn (User $user): bool => $user->id() === $userId);
    }

    public function persist(User $user): void
    {
        $this->storage->add($user);
    }

    public function delete(int $userId): void
    {
        $this->storage->remove(fn (User $user): bool => $user->id() === $userId);
    }

    public function all(): array
    {
        return $this->storage->all();
    }

    public function getUsernames(): array
    {
        return $this->storage->map(fn (User $user): string => $user->username())->all();
    }
}
