<?php
namespace App\Extensions;

use Illuminate\Support\Str;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Auth\Authenticatable;

class MongoUserProvider implements UserProvider {
    private $model;
    
    public function __construct(\App\Models\Auth\User $userModel) {
        $this->model = $userModel;
    }

    public function retrieveByCredentials(array $credentials) {
        if (empty($credentials)) {
            return;
        }
        $user = $this->model->fetchUserByCredentials(['username' => $credentials['username']]);
        return $user;
    }

    public function validateCredentials(Authenticatable $user, Array $credentials) {
        return ($credentials['username'] == $user->getAuthIdentifier() && md5($credentials['password']) == $user->getAuthPassword());
    }

    public function retrieveById($identifier) {}
    public function retrieveByToken($identifier, $token) {}
    public function updateRememberToken(Authenticatable $user, $token) {}
}
