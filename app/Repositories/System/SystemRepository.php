<?php

namespace App\Repositories\System;

use App\Repositories\System\SystemRepositoryInterface;
use App\Models\System;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class SystemRepository implements SystemRepositoryInterface
{

    protected $model;

    public function __construct(System $model)
    {
        $this->model = $model;
    }

    public function getModel()
    {
        return System::class;
    }

    public function all()
    {
        return $this->model
            ->select('*')
            ->get();
    }
    public function datatable($input = array())
    {
        $sql = $this->model;

        if (empty($input)) {
            return System::count();
        }

        $start = array_key_exists('start', $input) ? $input['start'] : 0;
        $limit = array_key_exists('length', $input) ? $input['length'] : 0;

        $sql = $sql->select('*')
            ->orderBy('order', 'asc')
            ->orderBy('created_at', 'desc');

        if ($limit > 0) {
            $sql = $sql->skip($start)->take($limit);
        }

        if (array_key_exists('keyword', $input)) {
            $keyword = $input['keyword'];
            $sql = $sql->where(function ($subKey) use ($keyword) {
                $subKey->orWhere('key', 'LIKE', "%$keyword%")
                    ->orWhere('content', 'LIKE', "%$keyword%");
            });
        }

        if (array_key_exists('active', $input)) {
            if (!is_null($input['active']) && $input['active'] != 'all') {
                $active = $input['active'];
                $sql = $sql->where('active', $active);
            }
        }

        $data = $sql->get();
        return $limit > 0 ? $data : count($data);
    }

    public function create(array $input)
    {
        $input['active'] = !empty($input['active']) ? 1 : 0;
        $model = $this->model->create($input);
        return $model;
    }

    public function update(array $input)
    {
        $systemKey = $this->model->system_key;
        if (isset($input['password']) && $input['password'] === null) {
            unset($input['password']);
        }
        // if (isset($input['logo_app'])) {
        //     $directoryLogo = [
        //         'systems',
        //         "logo-app",
        //         'logo_app'
        //     ];
        //     $input['logo_app'] = $this->_uploadImage($directoryLogo, $input['logo_app'], 'logo_app') ?? $this->model->content('logo_app');
        // }
        $imageKeys = [
            'logo_app',
            'logo_app_2',
            'report_banner',
            'brand_img_1', 
            'director_image', 
            'mission_img_2', 
            'mission_img_3',
            'gallery_img_1', 
            'gallery_img_2', 
            'gallery_img_3',
            'gallery_img_4',
            'gallery_img_5',
            'project_img_1', 
            'project_img_2', 
            'project_img_3',
            'project_img_4',
            'project_img_5',
        ];
        $this->handleImageUploads($input, $imageKeys);

        if (isset($input['banner_app'])) {
            $directoryBanner = [
                'systems',
                "banner-app",
                'banner_app'
            ];
            $input['banner_app'] = $this->_uploadImage($directoryBanner, $input['banner_app'], 'banner_app') ?? $this->model->content('banner_app');
        }
        if (isset($input['background-btn-private'])) {
            $directoryBanner = [
                'systems',
                "background-menu-coach",
                'background-btn-private'
            ];
            $input['background-btn-private'] = $this->_uploadImage($directoryBanner, $input['background-btn-private'], 'background-btn-private') ?? $this->model->content('background-btn-private');
        }

        if (isset($input['background-btn-general'])) {
            $directoryBanner = [
                'systems',
                "menu-private-coach",
                'background-btn-general'
            ];
            $input['background-btn-general'] = $this->_uploadImage($directoryBanner, $input['background-btn-general'], 'background-btn-general') ?? $this->model->content('background-btn-general');
        }

        if (isset($input['background-btn-practice'])) {
            $directoryBanner = [
                'systems',
                "background-btn-practice",
                'background-btn-practice'
            ];
            $input['background-btn-practice'] = $this->_uploadImage($directoryBanner, $input['background-btn-practice'], 'background-btn-practice') ?? $this->model->content('background-btn-practice');
        }


        $input['is_maintenance'] = isset($input['is_maintenance']) ? 1 : 0;
        $input['app_is_force_update'] = isset($input['app_is_force_update']) ? 1 : 0;
        $input['app_is_require_force_update'] = isset($input['app_is_require_force_update']) ? 1 : 0;
        foreach ($systemKey as $key) {
            if (array_key_exists($key, $input)) {
                $this->model->updateOrCreate(
                    ['key' => $key],
                    ['content' => $input[$key] ?? null]
                );
            }
        }
    }

    private function handleImageUploads(array &$input, array $keys)
    {

        foreach ($keys as $key) {
            if (isset($input[$key])) {
                $directoryLogo = ['systems'];
                $uploadedImage = $this->_uploadImage($directoryLogo, $input[$key], $key);
                $input[$key] = $uploadedImage ?? $this->model->content($key);
            }
        }
    }

    public function delete($id)
    {
        $model = $this->model->find($id);
        if ($model) {
            return $model->delete();
        }
    }

    public function destroy($id)
    {
        $model = $this->model->find($id);
        $input['active'] = 0;
        return $model->update($input);
    }

    public function restore($id)
    {
        $model = $this->model->find($id);
        $input['active'] = 1;
        $now = Carbon::now();
        $input['active_at'] = $now;
        return $model->update($input);
    }

    public function findByName($code, $id)
    {
        return $this->model->where('name', $code)->where('id', '<>', $id)->first();
    }

    private function _uploadImage(array $directoryParts, $imageContent, $column = 'image_path')
    {
        if (isValidBase64Image($imageContent)) {
            $directory = implode('/', $directoryParts) . '/';
            Storage::disk('public')->makeDirectory($directory);
            $existingFiles = Storage::disk('public')->files($directory);
            $timeNow = Carbon::now()->format('Ymd_His');
            $filename = "{$column}-{$timeNow}.png";
            foreach ($existingFiles as $file) {
                // Storage::disk('public')->delete($file);
            }
            $imageData = $this->decodeBase64Image($imageContent);
            $imagePath = $directory . $filename;
            Storage::disk('public')->put($imagePath, $imageData);
            return $imagePath;
        }
    }

    private function decodeBase64Image($base64String)
    {
        list($type, $data) = explode(';', $base64String);
        list(, $data) = explode(',', $data);
        return base64_decode($data);
    }

    public function uploadFile($model, array $directoryParts, $file, $column = 'file_path')
    {
        $directory = implode('/', $directoryParts) . '/';
        Storage::disk('public')->makeDirectory($directory);
        $extension = $file->getClientOriginalExtension();
        $timeNow = Carbon::now()->format('Ymd_His');
        $filename = "{$column}-{$timeNow}-{$model->id}.{$extension}";
        $existingFiles = Storage::disk('public')->files($directory);
        foreach ($existingFiles as $existingFile) {
            Storage::disk('public')->delete($existingFile);
        }
        $filePath = $directory . $filename;
        $file->storeAs($directory, $filename, 'public');
        $model->{$column} = $filePath;
        $model->save();
    }
}
