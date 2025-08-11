<?php

namespace App\Repositories;

interface GalleryRepositoryInterface
{
  public function all();

  public function find($id);

  public function bySlug(string $slug);

  public function create(array $data);

  public function update($id, array $data);

  public function delete($id);

  public function filter(array $filters);

  public function datatables(array $params);
}
