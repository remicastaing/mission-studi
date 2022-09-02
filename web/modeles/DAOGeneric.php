<?php


class DAOGeneric
{


    protected $pdo = null;
    protected $table = null;
    protected $base_request = null;
    protected $request_by_id = null;
    protected $deleteRequest = "";

    public function __construct($dsn)
    {
        try {
            $this->pdo = new PDO($dsn);
        } catch (PDOException $e) {
            exit('Erreur : ' . $e->getMessage());
        }

        $this->deleteRequest = "DELETE FROM $this->table ";
    }

    public function list()
    {

        if (!is_null($this->pdo)) {
            $stmt = $this->pdo->query($this->base_request);
        }
        $objects = [];

        while ($object = $stmt->fetchObject()) {
            $objects[] = $object;
        }

        return $objects;
    }

    public function get($id)
    {
        if (!is_null($this->pdo)) {
            $stmt = $this->pdo->prepare($this->request_by_id);
        }
        $object = null;
        if ($stmt->execute([$id])) {
            $object = $stmt->fetchObject();
            if (!is_object($object)) {
                $object = null;
            }
        }

        return $object;
    }

    public function delete($id, $col = 'id')
    {

        $deleteRequest = $this->deleteRequest . "WHERE $col = :id";

        $this->executeRequest($deleteRequest, [':id' => $id]);
    }


    public function executeRequest($request, $params)
    {
        if (!is_null($this->pdo)) {
            $stmt = $this->pdo->prepare($request);
        }
        $objects = [];

        if ($stmt->execute($params)) {
            while ($object = $stmt->fetchObject()) {
                $objects[] = $object;
            }
        }

        return $objects;
    }


    public function upsert($data)
    {
        $valeurs = '';
        $colonnes = '';
        $donnees = [];
        $index = 0;
        $liens = new stdClass;

        if ($data->id == '') {
            $data->id = $this->guidv4();

            foreach ($data as $key => $value) {
                if (!is_array($value)) {
                    $colonnes .= $index == 0 ? $key : ', ' . $key;
                    $valeurs .=  $index == 0 ? ":$key" : ", :$key";
                    $donnees[":$key"] = $value;
                    $index++;
                } else {
                    $liens->$key = $value;
                }
            }
            $request = "INSERT INTO $this->table ($colonnes) VALUES ($valeurs)";
        } else {
            $id = $data->id;

            foreach ($data as $key => $value) {
                if ($key <> 'id') {
                    if (!is_array($value)) {
                        $valeurs .=  ($index == 0 ? "" : ",") . " $key = :$key";
                        $donnees[":$key"] = $value;
                        $index++;
                    } else {
                        $liens->$key = $value;
                    }
                }
            }
            $request = "UPDATE $this->table SET $valeurs WHERE id = '$id'";
        }
        $res = $this->executeRequest($request, $donnees);


        foreach ($liens as $key => $values) {

            $res2 = $this->$key->deleteInsert($key, $values, $this->table, $data->id);
            
        }
    }

    function guidv4($data = null)
    {
        // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
        $data = $data ?? random_bytes(16);
        assert(strlen($data) == 16);

        // Set version to 0100
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        // Set bits 6-7 to 10
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

        // Output the 36 character UUID.
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }
}
