<?php

namespace App\Repositories;

interface CommitRepositoryInterface
{
    public function all();

    public function find($id);
    
    public function create(array $data);

    public function update($id, array $data);

    public function delete($id);

    public function filter(array $filters);

    public function filterFrontEndPagination(array $filters, int $perPage);

    public function filterFrontEnd(array $params);

    public function datatables(array $params);
}
