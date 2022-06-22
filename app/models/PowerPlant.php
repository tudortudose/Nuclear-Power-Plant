<?php
class PowerPlant
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    public function insert($data)
    {
        echo "<script>console.log('Debug Objects: " . "baaaaaaaa" . "' );</script>";
        $this->db->query('INSERT INTO power_plants ' .
            '(author_id, name, reactorCount, reactorPower, altitude, latitude, longitude) ' .
            'VALUES(:author_id, :name, :reactorCount, :reactorPower, :altitude, :latitude, :longitude)');

        //Bind values
        $this->db->bind(':author_id', $data['author_id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':reactorCount', $data['reactorCount']);
        $this->db->bind(':reactorPower', $data['reactorPower']);
        $this->db->bind(':altitude', $data['altitude']);
        $this->db->bind(':latitude', $data['latitude']);
        $this->db->bind(':longitude', $data['longitude']);

        //Execute function
        if ($this->db->execute()) {
            echo "daaaaaaaaaaaaaaaaaaaa";
            return true;
        } else {
            echo "nuuuuuuuuuu";
            return false;
        }
    }

    public function update($data)
    {
        $this->db->query('UPDATE power_plants SET name = :name, reactorCount = :reactorCount, reactorPower = :reactorPower WHERE id=:id');

        //Bind values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':reactorCount', $data['reactorCount']);
        $this->db->bind(':reactorPower', $data['reactorPower']);
        $this->db->bind(':id', $data['id']);

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($id)
    {
        $this->db->query('DELETE FROM power_plants WHERE id=:id');

        //Bind values
        $this->db->bind(':id', $id);

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getById($id)
    {
        $this->db->query('SELECT * FROM power_plants WHERE id=:id');

        //Bind value
        $this->db->bind(':id', $id);

        $this->db->execute();

        $result = $this->db->single();

        return $result;
    }

    public function getByName($name)
    {
        $this->db->query('SELECT * FROM power_plants WHERE name=:name');

        //Bind value
        $this->db->bind(':name', $name);

        $this->db->execute();

        $result = $this->db->single();

        return $result;
    }

    public function getAll()
    {
        $this->db->query('SELECT * FROM power_plants');

        $this->db->execute();

        $results = $this->db->resultSet();

        /*
        foreach($results as $result){
            
            echo "<script>console.log('Debug Data res: " . $result . "' );</script>";
        }*/

        return $results;
    }
}
