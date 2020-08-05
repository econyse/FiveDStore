<?php
namespace App\Models\Auth;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use App\Services\Contracts\NosqlServiceInterface;

class User implements AuthenticatableContract {
    private $conn;

    private $username;
    private $password;
    protected $rememberTokenName = 'remember_token';

    public function __construct(NosqlServiceInterface $conn) {
        $this->conn = $conn;
    }

    public function fetchUserByCredentials(Array $credentials) {
        // Same as MongoDB
        $arr_user = $this->conn->find('Users', ['username' => $credentials['username']]);
        if (! is_null($arr_user)) {
            $this->username = $arr_user['username'];
            $this->password = $arr_user['password'];
        }

        return $this;
    }

    public function getAuthIdentifierName()
    {
        return "username";
    }

    public function getAuthIdentifier() {
        return $this->{$this->getAuthIdentifierName()};
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getRememberToken(){
        if (! empty($this->getRememberTokenName())) {
            return $this->{$this->getRememberTokenName()};
        }
    }

    public function setRememberToken($value) {
        if(! empty($this->getRememberTokenName())) {
            $this->{$this->getRememberTokenName()} = $value;
        }
    }

    public function getRememberTokenName() {
        return $this->rememberTokenName;
    }
}