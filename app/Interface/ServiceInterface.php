<?php

namespace App\Interface;

interface ServiceInterface
{
    /**
     * Dohvata listu resursa.
     *
     * @return array
     */
    public function index(): array;

    /**
     * Dohvata pojedinačni resurs prema ID-u.
     *
     * @param int $id
     * @return array|null
     */
    public function show(int $id): ?array;

    /**
     * Kreira novi resurs.
     *
     * @param array $data
     * @return int ID novog resursa
     */
    public function store(array $data): int;

    /**
     * Ažurira postojeći resurs.
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool;

    /**
     * Briše postojeći resurs.
     *
     * @param int $id
     * @return bool
     */
    public function destroy(int $id): bool;
}
