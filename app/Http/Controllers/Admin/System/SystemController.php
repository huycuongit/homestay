<?php

namespace App\Http\Controllers\Admin\System;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Repositories\System\SystemRepositoryInterface;
use Illuminate\Support\Facades\Artisan;

use Illuminate\Support\Facades\Hash;

class SystemController extends Controller
{
    private $system;

    public function __construct(
        SystemRepositoryInterface $system,
    ) {
        $this->system = $system;
    }

    public function index()
    {
        $data = $this->system
            ->all()
            ->keyBy('key')
            ->toArray();
        return view("admin.systems.edit", compact("data"));
    }

    public function general()
    {
        $data = $this->system
            ->all()
            ->keyBy('key')
            ->toArray();
        return view("admin.systems.generals", compact("data"));
    }

    public function socials()
    {
        $data = $this->system
            ->all()
            ->keyBy('key')
            ->toArray();
        return view("admin.systems.socials", compact("data"));
    }

    public function services()
    {
        $data = $this->system
            ->all()
            ->keyBy('key')
            ->toArray();
        return view("admin.systems.services", compact("data"));
    }

    public function contacts()
    {
        $data = $this->system
            ->all()
            ->keyBy('key')
            ->toArray();
        return view("admin.systems.contacts", compact("data"));
    }

    public function opengraphs()
    {
        $data = $this->system
            ->all()
            ->keyBy('key')
            ->toArray();
        return view("admin.systems.opengraphs", compact("data"));
    }

    public function pages()
    {
        $data = $this->system
            ->all()
            ->keyBy('key')
            ->toArray();
        return view("admin.systems.pages", compact("data"));
    }

    public function apis()
    {
        $data = $this->system
            ->all()
            ->keyBy('key')
            ->toArray();
        return view("admin.systems.apis", compact("data"));
    }

    public function consoles()
    {
        $data = $this->system
            ->all()
            ->keyBy('key')
            ->toArray();
        return view("admin.systems.consoles", compact("data"));
    }

    public function configshareholders()
    {
        $data = $this->system
            ->all()
            ->keyBy('key')
            ->toArray();
        return view("admin.systems.bookings", compact("data"));
    }
    public function configContracts()
    {
        $data = $this->system
            ->all()
            ->keyBy('key')
            ->toArray();
        return view("admin.systems.contracts", compact("data"));
    }

    public function otps()
    {
        $data = $this->system
            ->all()
            ->keyBy('key')
            ->toArray();
        return view("admin.systems.otps", compact("data"));
    }

    public function notifications()
    {
        $data = $this->system
            ->all()
            ->keyBy('key')
            ->toArray();
        return view("admin.systems.notifications", compact("data"));
    }

    public function update(Request $request)
    {
        $input = $request->all();

        if (isset($input['api_user_password']) && !empty($input['api_user_password'])) {
            $input['api_user_password'] = Hash::make($input['api_user_password']);
        }

        $this->system->update($input);
        session()->flash('success', 'Cập nhật thành công');
        return redirect()->back();
    }

    public function runConsoles()
    {
        Artisan::call('config:clear');
        Artisan::call('config:cache');
        Artisan::call('cache:clear');
        Artisan::call('view:clear');
        Artisan::call('route:clear');
        return response()->json(['message' => 'Làm mới thành công !'], 200);
    }
}
