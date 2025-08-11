<?php
namespace App\Repositories\System;

interface SystemRepositoryInterface
{
    public function datatable();

    public function all();

    public function create(array $input);

    public function update(array $input);

    public function delete($id);

    public function destroy($id);

    public function restore($id);

}
