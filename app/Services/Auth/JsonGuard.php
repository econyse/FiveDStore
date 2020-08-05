<?php
namespace App\Services\Auth;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\UserProvider;
use GuzzleHttp\json_decode;
use phpDocumentor\Reflection\Types\Array_;
use Illuminate\Contracts\Auth\Authenticatable;

class JsonGuard implements Guard {
    protected $request;
    protected $provider;
    protected $user;

    public function __construct(UserProvider $provider, Request $request) {
        $this->request = $request;
        $this->provider = $provider;
        $this->user = NULL;
    }

    public function check()
    {
        return ! is_null($this->user());
    }

    public function guest() {
        return ! $this->check();
    }

    public function user() {
        if (! is_null($this->user)) {
            return $this->user;
        }
    }

    public function getJsonPrams() {
        $jsondata = $this->request->query('jsondata');
        return (!empty($jsondata) ? json_decode($jsondata, TRUE) : NULL);
    }

    public function id() {
        if ($user = $this->user()) {
            return $this->user()->getAuthIdentirfier();
        }
    }

    public function validate(Array $credentials=[]){
        // echo $credentials['username']." ".$credentials['password'];
        if(empty($credentials['username']) || empty($credentials['password'])) {
            if (!$credentials = $this->getJsonPrams()) {
                return false;
            }
        }
        $user = $this->provider->retrieveByCredentials($credentials);
        if (! is_null($user) && $this->provider->validateCredentials($user, $credentials)) {
            $this->setUser($user);
            return true;
        } else {
            return false;
        }
    }

    public function setUser(Authenticatable $user) {
        $this->user = $user;
        return $this;
    }
}