<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\BranchRepositoryInterface;
use App\Repositories\District\DistrictRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $eventRepository;
    protected $newsRepository;
    protected $tipRepository;
    protected $deveMileRepository;
    protected $branchRepository;
    protected $district;

    public function __construct(
        BranchRepositoryInterface $branchRepository,
        DistrictRepositoryInterface $district
    ) {
        $this->branchRepository = $branchRepository;
        $this->district = $district;
    }

    public function login(Request $request)
    {
        if (Auth::guard('web')->check()) {
            return redirect()->route('page.index');
        }
        return view('frontend.pages.login');
    }

    public function logout()
    {
        $customer = Auth::guard('web')->user();
        log_activity($customer, 'logout', 'Khách đăng xuất', [
            'guard' => 'Web',
        ]);
        Auth::guard('web')->logout();
        return response()->json([
            'message' => 'Đăng xuất thành công',
            'redirect' => route('page.index')
        ]);
    }

    public function submitLogin(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::guard('web')->attempt($request->only('email', 'password'))) {
            $customer = Auth::guard('web')->user();
            log_activity($customer, 'login', 'Khách đăng nhập', [
                'guard' => 'Web',
            ]);
            return response()->json(['message' => 'Đăng nhập thành công', 'user' => Auth::guard('web')->user()]);
        }

        return response()->json(['message' => 'Sai email hoặc mật khẩu'], 401);
    }
}
