<?php

namespace App\Http\Controllers\Api\Dashboard;
use App\Traits\ResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class NotificationsController extends Controller
{
    use ResponseTrait;

    public function index()
    {
        $admin=Auth::user();
        return $this->showResponse($admin->notifications()->get(),'done successfully..!');
    }
}
