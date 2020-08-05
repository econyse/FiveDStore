<?php

namespace App\Database;
use App\Services\Contracts\NosqlServiceInterface;
use MongoDB\Client;

class MongoDatabase implements NosqlServiceInterface {
    private $connection;
    private $database;

    public function __construct($host, $port, $database) {
        $this->connection = new Client("mongodb://$host:$port");
        $this->database = $this->connection->{$database};
    }

    public function find($collection, Array $criteria) {
        return $this->database->{$collection}->findOne($criteria);
    }

    public function create($collection, Array $document) {}
    public function update($collection, $id, Array $dcocument){}
    public function delete($collection, $id) {}
}