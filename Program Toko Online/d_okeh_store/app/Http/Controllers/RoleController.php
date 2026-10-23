<?php

namespace App\Http\Controllers;

use App\Models\User;                               
use App\Http\Requests\ChangeRoleRequest;          
use App\Services\RoleManagementService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;                          
class RoleController extends Controller
{
    public function update(
        ChangeRoleRequest $request,
        User $user,
        RoleManagementService $service
    ): RedirectResponse {
        // Ambil user login dari session manual
        $actor = User::find(session('user_id'));

        // Cek apakah yang login adalah admin
        if (!$actor || $actor->role !== 'admin') {
            abort(403, 'Hanya admin yang boleh mengubah role.');
        }

        $data = $request->validated();
        $service->changeRole($actor, $user, $data['role']);

        return back()->with('status', 'Role berhasil diperbarui.');
    }
}