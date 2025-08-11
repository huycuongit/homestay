<?php

namespace App\Repositories;

interface BranchRepositoryInterface
{
    public function all();

    public function getAllData(array $filter);

    public function find($id);

    public function bySlug(string $slug);

    public function create(array $data);

    public function update($id, array $data);

    public function delete($id);

    public function filter(array $filters);

    public function filterBranch(array $filters);

    public function filterFrontEndPagination(array $filters, int $perPage);

    public function filterFrontEnd();

    public function datatables(array $params);

    public function filterSelect(array $filters = []);
}
