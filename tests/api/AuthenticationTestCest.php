<?php


class AuthenticationTestCest
{
    protected $user;


    protected function _inject(App\User $user)
    {
        $this->user = $user;
    }

    protected function getToken($user){
        $user = $user->find(1)->first();
        $token = \JWTAuth::fromUser($user);
        \JWTAuth::setToken($token);

        return $token;

    }

    public function testAuthenticate(ApiTester $I)
    {
        $I->wantTo('Login via API');
        $I->sendPOST('/api/authenticate', ['email' => 'jaskolski.pablo@example.org', 'password' => 'jaskolski.pablo@example.org']);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType([
            'token' => 'string'
        ]);

    }

    public function testGetCurrentUser(ApiTester $I)
    {
        $I->wantTo('Get current user');
        $I->amBearerAuthenticated($this->getToken($this->user));
        $I->sendGET('/api/currentAuthUser');
        $I->seeResponseIsJson();
    }
}
