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
        $this->db->query('INSERT INTO centrale ' .
            '(autor_id, nume, numar_reactoare, putere_reactor, altitudine, latitudine, longitudine) ' .
            'VALUES(:autor_id, :nume, :numar_reactoare, :putere_reactor, :altitudine, :latitudine, :longitudine)');

        //Bind values
        $this->db->bind(':autor_id', $data['autor_id']);
        $this->db->bind(':nume', $data['nume']);
        $this->db->bind(':numar_reactoare', $data['numar_reactoare']);
        $this->db->bind(':putere_reactor', $data['putere_reactor']);
        $this->db->bind(':altitudine', $data['altitudine']);
        $this->db->bind(':latitudine', $data['latitudine']);
        $this->db->bind(':longitudine', $data['longitudine']);

        //Execute function
        if ($this->db->execute()) {
            echo "daaaaaaaaaaaaaaaaaaaa";
            return true;
        } else {
            echo "nuuuuuuuuuu";
            return false;
        }
    }

    public function getById($id)
    {
        $this->db->query('SELECT * FROM centrale WHERE id=:id');

        //Bind value
        $this->db->bind(':id', $id);

        $this->db->execute();

        $result = $this->db->single();

        return $result;
    }

    public function getAll()
    {
        $this->db->query('SELECT * FROM centrale');

        $this->db->execute();

        $results = $this->db->resultSet();

        /*
        foreach($results as $result){
            
            echo "<script>console.log('Debug Data res: " . $result . "' );</script>";
        }*/

        return $results;
    }
}
