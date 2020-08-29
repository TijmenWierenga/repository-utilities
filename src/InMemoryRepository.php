<?php

declare(strict_types=1);

namespace TijmenWierenga\Repositories;

use Closure;
use Countable;

/**
 * @psalm-template T
 */
class InMemoryRepository implements Countable
{
    /**
     * @psalm-var array<int, T>
     */
    private array $items;

    /**
     * @psalm-param array<int, T> $items
     */
    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    /**
     * @param mixed $item
     * @psalm-param T $item
     */
    public function add($item): void
    {
        $this->items[] = $item;
    }

    /**
     * @psalm-return array<int, T>
     */
    public function all(): array
    {
        return $this->items;
    }

    /**
     * @psalm-param Closure(T=):bool $function
     */
    public function remove(Closure $function): void
    {
        $this->items = array_filter($this->items, fn ($item): bool => ! $function);
    }

    /**
     * @return mixed
     * @psalm-return T|null
     */
    public function first()
    {
        if (empty($this->items)) {
            return null;
        }

        return $this->items[array_key_first($this->items)];
    }

    /**
     * @return mixed
     * @psalm-return T|null
     */
    public function last()
    {
        if (empty($this->items)) {
            return null;
        }

        return $this->items[array_key_last($this->items)];
    }

    /**
     * @psalm-param Closure(T=):bool $function
     * @psalm-return T|null
     */
    public function find(Closure $function)
    {
        $items = array_filter($this->items, $function);

        if (empty($items)) {
            return null;
        }

        return $items[array_key_first($items)];
    }

    /**
     * @psalm-param Closure(T=):bool $function
     * @psalm-return array<int, T>
     */
    public function findMany(Closure $function): array
    {
        return array_filter($this->items, $function);
    }

    public function count(): int
    {
        return count($this->items);
    }
}
