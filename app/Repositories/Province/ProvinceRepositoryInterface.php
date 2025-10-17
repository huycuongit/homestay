<?php
namespace App\Repositories\Province;

interface ProvinceRepositoryInterface
{
    public function getAllData();

    public function find($id);
    
    public function datatable();

    public function create(array $input);

    public function update($id,array $input);

    public function destroy($id);

    public function restore($id);

    public function whereCodeNotId($code, $id);

    public function wherePhoneNotIn($phone_code,$id);

}
