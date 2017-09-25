<?php namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
	public function tokenAuthCheck (Request $request) {
		return [
			'request' => $request->get('id'),
			'auth'    => Auth::check() ? Auth::id() : -9999,
		];
	}

	public function tokenAuthUser (Request $request) {
		return [
			'request' => $request->get('id'),
			'auth'    => Auth::user()->id,
		];
	}

	public function tokenAuthId (Request $request) {
		return [
			'request' => $request->get('id'),
			'auth'    => Auth::id(),
		];
	}

	public function tokenAuthAttempt (Request $request) {
		Auth::attempt([ 'email' => $request->get('email'), 'password' => $request->get('password') ]);

		return [
			'request' => $request->get('id'),
			'auth'    => Auth::id(),
		];
	}

	public function tokenAuthOnce (Request $request) {
		Auth::once([ 'email' => $request->get('email'), 'password' => $request->get('password') ]);

		return [
			'request' => $request->get('id'),
			'auth'    => Auth::id(),
		];
	}

	public function tokenAuthLogin (Request $request) {
		Auth::login(User::find($request->get('id')));
	}

	public function tokenAuthLoginUsingId (Request $request) {
		Auth::loginUsingId($request->get('id'));

		return [
			'request' => $request->get('id'),
			'auth'    => Auth::id(),
		];
	}

	public function tokenAuthLogout (Request $request) {
		Auth::logout();

		return [
			'request' => $request->get('id'),
			'auth'    => Auth::id(),
		];
	}

	public function tokenAuthValidate (Request $request) {
		$isValidated = Auth::validate([ 'email' => $request->get('email'), 'password' => $request->get('password') ]);

		return [
			'request' => $request->get('id'),
			'auth'    => $isValidated ? $request->get('id') : -8998,
		];
	}


	public function apiAuthCheck (Request $request) {
		return [
			'request' => $request->get('id'),
			'auth'    => Auth::check() ? Auth::id() : -9999,
		];
	}

	public function apiAuthUser (Request $request) {
		return [
			'request' => $request->get('id'),
			'auth'    => Auth::user()->id,
		];
	}

	public function apiAuthId (Request $request) {
		return [
			'request' => $request->get('id'),
			'auth'    => Auth::id(),
		];
	}

	public function apiAuthAttempt (Request $request) {
		Auth::attempt([ 'email' => $request->get('email'), 'password' => $request->get('password') ]);

		return [
			'request' => $request->get('id'),
			'auth'    => Auth::id(),
		];
	}

	public function apiAuthOnce (Request $request) {
		Auth::once([ 'email' => $request->get('email'), 'password' => $request->get('password') ]);

		return [
			'request' => $request->get('id'),
			'auth'    => Auth::id(),
		];
	}

	public function apiAuthLogin (Request $request) {
		Auth::login(User::find($request->get('id')));
	}

	public function apiAuthLoginUsingId (Request $request) {
		Auth::loginUsingId($request->get('id'));

		return [
			'request' => $request->get('id'),
			'auth'    => Auth::id(),
		];
	}

	public function apiAuthLogout (Request $request) {
		Auth::logout();

		return [
			'request' => $request->get('id'),
			'auth'    => Auth::id(),
		];
	}

	public function apiAuthValidate (Request $request) {
		$isValidated = Auth::validate([ 'email' => $request->get('email'), 'password' => $request->get('password') ]);

		return [
			'request' => $request->get('id'),
			'auth'    => $isValidated ? $request->get('id') : -8998,
		];
	}
}
