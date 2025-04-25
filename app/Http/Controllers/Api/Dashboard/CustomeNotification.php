<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Traits\{
    FirebaseNotificationTrait,
    ResponseTrait
};
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PendingNotification;
use App\Http\Requests\Api\V1\Dashboard\{
    RequestCustomeNotification,
    UpdateCustomeNotification
};


use Exception;
use Illuminate\Support\Facades\DB;

class CustomeNotification extends Controller
{
    use ResponseTrait, FirebaseNotificationTrait;

    public function index()
    {
        return $this->showResponse(PendingNotification::get()->all(), 'done successfully...!');
    }




    public function show(string $id)
    {
        $notifi = PendingNotification::select('content')->findOrFail($id);
        return $this->showResponse($notifi, 'done successfully..!');
    }



    public function update(UpdateCustomeNotification $request, string $id)
    {
        $notification = PendingNotification::findOrFail($id);
        $notification->update($request->all());
        return $this->showResponse($notification, 'notification updated successfully..!');
    }



    public function store(RequestCustomeNotification $request)
    {


        DB::beginTransaction();
        try {
            PendingNotification::create($request->all());
            DB::commit();
            return $this->showMessage('done successfully...!');
        } catch (Exception $e) {
            DB::rollBack();
            return $this->showError($e);
        }
    }


    public function destroy(string $id)
    {

        $notifi = PendingNotification::FindOrFail($id);
        $notifi->delete();
        return $this->showMessage('Notification deleted successfully...!');
    }
}
