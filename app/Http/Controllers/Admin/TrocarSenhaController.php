<?php

namespace App\Http\Controllers\Admin;

use Alert;
use Backpack\Base\app\Http\Requests\ChangePasswordRequest;
use Illuminate\Support\Facades\Hash;

use Backpack\Base\app\Http\Controllers\Auth\MyAccountController;

class TrocarSenhaController extends MyAccountController
{
	public function senha()
	{
	    $this->data['title'] = trans('backpack::base.my_account');
	    $this->data['user'] = $this->guard()->user();

	    return view('backpack::auth.account.change_password', $this->data);
	}

	public function salvarSenha(ChangePasswordRequest $request)
	{
	    $user = $this->guard()->user();
	    $user->password = Hash::make($request->new_password);

	    if ($user->save()) {
	        Alert::success(trans('backpack::base.account_updated'))->flash();
	    } else {
	        Alert::error(trans('backpack::base.error_saving'))->flash();
	    }

	    return redirect()->back();
	}

	/**
	 * Get the guard to be used for account manipulation.
	 *
	 * @return \Illuminate\Contracts\Auth\StatefulGuard
	 */
	protected function guard()
	{
	    return backpack_auth();
	}
}
