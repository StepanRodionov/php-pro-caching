<?php

declare(strict_types=1);

namespace App\Contract;

interface DatabaseInterface
{
    /**
     * Ищет сущность по идентификатору (первичному ключу).
     *
     * @param int $id
     * @return object|null
     */
    public function findById(int $id): ?object;

    /**
     * Обновляет сущность в БД.
     *
     * @param object $entity
     */
    public function update(object $entity): void;

    /**
     * Выполняет произвольный SQL-запрос.
     *
     * @param string $query
     */
    public function executeQuery(string $query);
}