<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Traits\ResponseTrait;
use App\Http\Resources\UserResource;
use App\Http\Requests\Api\V1\Dashboard\{
    IsBlockRequest,


};
class UserController extends Controller
{
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = User::role(['client'], 'api')
            ->when($request->has('search'), function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('first_name', 'like', '%' . $request->search . '%')
                        ->orWhere('last_name', 'like', '%' . $request->search . '%');
                });
            })
            ->get();

        return $this->showResponse(UserResource::collection($users), 'done successfully');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user=User::FindOrFail($id);
        return $this->showResponse($user,'done successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(IsBlockRequest $request, string $id)
    {

        $user=User::FindOrFail($id);
        $user->update($request->all());
         if ($request->is_blocked) {
            return $this->showMessage('delar blocked successfully');
        } else {
            return $this->showMessage('delar unblocked successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user=User::FindOrFail($id);
        $user->delete();
        return $this->showMessage('user deleted successfully');
    }


}
