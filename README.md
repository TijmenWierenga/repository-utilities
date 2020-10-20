# Repository utilities for PHP applications

## The in-memory repository

The `TijmenWierenga\Repositories\InMemoryRepository` is a simple array-based storage that performs persistence related actions.

#### `all(): T[]`
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

#### `find(Closure $criteria): T|null`
Returns the first item that matches the criteria. Returns `null` is no match is found

```php
$users = [
    new User(1),
    new User(2),
    new User(3),
];

$repository = new InMemoryRepository($users);

$user = $repository->find(fn (User $user): bool => $user->id === 1); // Returns user with ID of 1.
```

#### `findMany(Closure $criteria): T[]`
Returns all items that match the criteria.

```php
$users = [
    new User(1),
    new User(2),
    new User(3),
];

$repository = new InMemoryRepository($users);

$user = $repository->findMany(fn (User $user): bool => $user->id > 1); // Returns all users with a ID greater than 1.
```


#### `add(T $item): void`
Adds a new item to the collection.

```php
$repository = new InMemoryRepository();

$repository->add(new User(1)); // User is now added to the collection.
```

#### `remove(Closure $criteria): void`
Removes all items from the collection that match the criteria.

```php
$users = [
    new User(1),
    new User(2),
    new User(3),
];

$repository = new InMemoryRepository($users);

$repository->remove(fn (User $user): bool => $user->id === 1); // Removes user with an ID of 1.
```

#### `first(): T|null`
Returns the first item in the collection. Returns `null` is the collection is empty.

```php
$users = [
    new User(1),
    new User(2),
    new User(3),
];

$repository = new InMemoryRepository($users);

$repository->first(); // Returns User(1)
```

#### `last(): T|null`
Returns the last item in the collection. Returns `null` is the collection is empty.

```php
$users = [
    new User(1),
    new User(2),
    new User(3),
];

$repository = new InMemoryRepository($users);

$repository->last(); // Returns User(3)
```

#### `map(Closure $function): U`
Returns a new repository instance based on the returned values of the closure.

```php
$users = [
    new User(1),
    new User(2),
    new User(3),
];

$repository = new InMemoryRepository($users);

$usernames = $repository->map(fn (User $user): string => $user->username()); // Returns InMemoryRepository<string> with usernames
```
