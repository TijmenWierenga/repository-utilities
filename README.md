# Repository utilities for PHP applications

## The in-memory repository

The `TijmenWierenga\Repositories\InMemoryRepository` is a simple array-based storage that performs persistence related actions.

#### `all()`
Returns all items stored in the repository.

```php
$users = [
    new User(1),
    new User(2),
    new User(3),
];

$repository = new InMemoryRepository($users);

$users = $repository->all(); // returns an array with all users.
```

#### `find(Closure $criteria)`
Returns the first item that matches the criteria.

```php
$users = [
    new User(1),
    new User(2),
    new User(3),
];

$repository = new InMemoryRepository($users);

$user = $repository->find(fn (User $user): bool => $user->id === 1); // Returns user with ID of 1.
```


