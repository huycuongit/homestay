<?php
namespace App\Repositories\Ward;

interface WardRepositoryInterface
{
    public function getAllData();
    
    public function datatable();

    public function find($id);

    public function create(array $input);

    public function update($id,array $input);

    public function destroy($id);

    public function restore($id);

    public function whereCodeNotId($code, $id);

    public function getWardFromDistrict($district_code = 0);
}
