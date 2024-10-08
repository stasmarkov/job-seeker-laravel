<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Modules\Auth\Enums\UserRolesEnum;
use Spatie\Permission\Exceptions\RoleDoesNotExist;
use Spatie\Permission\Models\Role;

/**
 * The role select page controller.
 */
class RoleSelectController extends Controller {

  /**
   * The edit page.
   */
  public function edit() {
    return Inertia::render('Admin/RoleSelect');
  }

  /**
   * The edit page callback.
   */
  public function update(Request $request) {
    $validated = $request->validate([
      'role' => [Rule::enum(UserRolesEnum::class), 'exists:roles,name'],
    ]);

    try {
      $role = Role::findByName($validated['role']);
      Auth::user()?->assignRole($role);
    }
    catch (RoleDoesNotExist $e) {
      abort(403);
    }

    return redirect()->route('dashboard');
  }

}
