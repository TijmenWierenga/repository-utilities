<?php

declare(strict_types=1);

interface UserRepository
{
    public function find(int $userId): ?User;

    public function persist(User $user): void;

    public function delete(int $userId): void;

    /**
     * @return User[]
     */
    public function all(): array;
}
