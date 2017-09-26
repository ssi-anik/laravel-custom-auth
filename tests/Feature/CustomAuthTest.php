<?php

namespace Tests\Feature;

use App\Token;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CustomAuthTest extends TestCase
{
	use DatabaseMigrations;
	use DatabaseTransactions;

	protected $prefixes = [ 'token', 'api' ];
	protected $urls = [
		'auth-attempt',
		'auth-check',
		'auth-id',
		'auth-login-using-id',
		'auth-once',
		'auth-user',
		'auth-validate',
	];
	private $apiToken = '';
	private $accessToken = '';
	private $email = '';
	private $password = '';
	private $userId = 0;

	public function setUp () {
		parent::setUp();
		factory(User::class, 20)->create();
		factory(Token::class, 30)->create();

		// take any random integer
		$this->userId = rand(1, 20);

		// fetch the user by that id
		$user = User::with('tokens')->find($this->userId);

		// fetch the token or create a new
		if ($user->tokens->count() > 0) {
			$token = $user->tokens->first();
		} else {
			factory(Token::class)->create([ 'user_id' => $this->userId ]);

			$token = Token::latest('id')->first();
		}
		$this->email = $user->email;
		$this->password = 'secret';
		$this->apiToken = $user->api_token;
		$this->accessToken = $token->access_token;
	}

	/**
	 * PROCESS - HOW IT WORKS!
	 * =================================================================================================
	 * ATTEMPT: Tries to validate CREDENTIALS and Attempts to login.
	 * CHECK: Check if the user is logged in or not. For APIs, pass access token - check if user exists.
	 * ID: Get the ID of the currently passed ACCESS_TOKEN
	 * LOGIN USING ID: Get the USER by PASSING the USER ID to AUTH
	 * ONCE: Verify USER CREDENTIALS. For ONCE.
	 * USER: Get the USER from CREDENTIALS/ACCESS TOKEN
	 * VALIDATE: Validate User CREDENTIALS.
	 * =================================================================================================
	 */

	public function testSuccessAuthAttempt () {
		$response = $this->post("/api/token/auth-attempt", [
			'email'    => $this->email,
			'password' => $this->password,
			'id'       => $this->userId,
		], [ 'Accept' => 'application/json' ]);
		$decoded = $response->decodeResponseJson();
		$this->assertEquals($decoded['request'], $decoded['auth']);
		$this->assertEquals($response->getStatusCode(), 200);

		$response = $this->post("/api/api/auth-attempt", [
			'email'    => $this->email,
			'password' => $this->password,
			'id'       => $this->userId,
		], [ 'Accept' => 'application/json' ]);
		$decoded = $response->decodeResponseJson();
		$this->assertEquals($decoded['request'], $decoded['auth']);
		$this->assertEquals($response->getStatusCode(), 200);
	}

	public function testSuccessAuthCheck () {
		$response = $this->post("/api/token/auth-check", [
			'id' => $this->userId,
		], [ 'Accept' => 'application/json', 'Authorization' => "Bearer " . $this->accessToken ]);
		$decoded = $response->decodeResponseJson();
		$this->assertEquals($decoded['request'], $decoded['auth']);
		$this->assertEquals($response->getStatusCode(), 200);

		$response = $this->post("/api/api/auth-check", [
			'email'    => $this->email,
			'password' => $this->password,
			'id'       => $this->userId,
		], [ 'Accept' => 'application/json', 'Authorization' => "Bearer " . $this->apiToken ]);
		$decoded = $response->decodeResponseJson();
		$this->assertEquals($decoded['request'], $decoded['auth']);
		$this->assertEquals($response->getStatusCode(), 200);
	}

	public function testSuccessAuthId () {
		$response = $this->post("/api/token/auth-id", [
			'id' => $this->userId,
		], [ 'Accept' => 'application/json', 'Authorization' => "Bearer " . $this->accessToken ]);
		$decoded = $response->decodeResponseJson();
		$this->assertEquals($decoded['request'], $decoded['auth']);
		$this->assertEquals($response->getStatusCode(), 200);

		$response = $this->post("/api/api/auth-id", [
			'email'    => $this->email,
			'password' => $this->password,
			'id'       => $this->userId,
		], [ 'Accept' => 'application/json', 'Authorization' => "Bearer " . $this->apiToken ]);
		$decoded = $response->decodeResponseJson();
		$this->assertEquals($decoded['request'], $decoded['auth']);
		$this->assertEquals($response->getStatusCode(), 200);
	}

	public function testSuccessAuthLoginUsingId () {
		$response = $this->post("/api/token/auth-login-using-id", [
			'id' => $this->userId,
		], [ 'Accept' => 'application/json', 'Authorization' => "Bearer " . $this->accessToken ]);
		$decoded = $response->decodeResponseJson();
		$this->assertEquals($decoded['request'], $decoded['auth']);
		$this->assertEquals($response->getStatusCode(), 200);

		$response = $this->post("/api/api/auth-login-using-id", [
			'email'    => $this->email,
			'password' => $this->password,
			'id'       => $this->userId,
		], [ 'Accept' => 'application/json', 'Authorization' => "Bearer " . $this->apiToken ]);
		$decoded = $response->decodeResponseJson();
		$this->assertEquals($decoded['request'], $decoded['auth']);
		$this->assertEquals($response->getStatusCode(), 200);
	}

	public function testSuccessAuthOnce () {
		$response = $this->post("/api/token/auth-once", [
			'email'    => $this->email,
			'password' => $this->password,
			'id'       => $this->userId,
		], [ 'Accept' => 'application/json', 'Authorization' => "Bearer " . $this->accessToken ]);
		$decoded = $response->decodeResponseJson();
		$this->assertEquals($decoded['request'], $decoded['auth']);
		$this->assertEquals($response->getStatusCode(), 200);

		$response = $this->post("/api/api/auth-once", [
			'email'    => $this->email,
			'password' => $this->password,
			'id'       => $this->userId,
		], [ 'Accept' => 'application/json', 'Authorization' => "Bearer " . $this->apiToken ]);
		$decoded = $response->decodeResponseJson();
		$this->assertEquals($decoded['request'], $decoded['auth']);
		$this->assertEquals($response->getStatusCode(), 200);
	}

	public function testSuccessAuthUser () {
		$response = $this->post("/api/token/auth-user", [
			'id' => $this->userId,
		], [ 'Accept' => 'application/json', 'Authorization' => "Bearer " . $this->accessToken ]);
		$decoded = $response->decodeResponseJson();
		$this->assertEquals($decoded['request'], $decoded['auth']);
		$this->assertEquals($response->getStatusCode(), 200);

		$response = $this->post("/api/api/auth-user", [
			'id' => $this->userId,
		], [ 'Accept' => 'application/json', 'Authorization' => "Bearer " . $this->apiToken ]);
		$decoded = $response->decodeResponseJson();
		$this->assertEquals($decoded['request'], $decoded['auth']);
		$this->assertEquals($response->getStatusCode(), 200);
	}

	public function testSuccessAuthValidate () {
		$response = $this->post("/api/token/auth-validate", [
			'email'    => $this->email,
			'password' => $this->password,
			'id'       => $this->userId,
		], [ 'Accept' => 'application/json', 'Authorization' => "Bearer " . $this->accessToken ]);
		$decoded = $response->decodeResponseJson();
		$this->assertEquals($decoded['request'], $decoded['auth']);
		$this->assertEquals($response->getStatusCode(), 200);

		$response = $this->post("/api/api/auth-validate", [
			'email'    => $this->email,
			'password' => $this->password,
			'id'       => $this->userId,
		], [ 'Accept' => 'application/json', 'Authorization' => "Bearer " . $this->apiToken ]);
		$decoded = $response->decodeResponseJson();
		$this->assertEquals($decoded['request'], $decoded['auth']);
		$this->assertEquals($response->getStatusCode(), 200);
	}
}
