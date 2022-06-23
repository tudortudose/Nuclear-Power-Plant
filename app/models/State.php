<?php
class State
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    public function insert($data)
    {
        $this->db->query('INSERT INTO pp_states ' .
            '(id_centrala,temperatura_nucleu,putere_racire,putere_produsa,putere_ceruta,putere_energie,reactoare_active) ' .
            'VALUES(:id_centrala,:temperatura_nucleu,:putere_racire,:putere_produsa,:putere_ceruta,:putere_energie,:reactoare_active)');

        $this->db->bind(':id_centrala', $data['id_centrala']);
        $this->db->bind(':temperatura_nucleu', $data['temperatura_nucleu']);
        $this->db->bind(':putere_racire', $data['putere_racire']);
        $this->db->bind(':putere_produsa', $data['putere_produsa']);
        $this->db->bind(':putere_ceruta', $data['putere_ceruta']);
        $this->db->bind(':putere_energie', $data['putere_energie']);
        $this->db->bind(':reactoare_active', 100);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function update($data)
    {
        if (isset($data['reactoare_active'])) {
            $this->db->query('UPDATE pp_states SET ' .
                'temperatura_nucleu=:temperatura_nucleu,reactoare_active=:reactoare_active,putere_racire=:putere_racire,' .
                'putere_produsa=:putere_produsa,putere_ceruta=:putere_ceruta,' .
                'putere_energie=:putere_energie WHERE id_centrala=:id_centrala');

            $this->db->bind(':id_centrala', $data['id_centrala']);
            $this->db->bind(':temperatura_nucleu', $data['temperatura_nucleu']);
            $this->db->bind(':putere_racire', $data['putere_racire']);
            $this->db->bind(':putere_produsa', $data['putere_produsa']);
            $this->db->bind(':putere_ceruta', $data['putere_ceruta']);
            $this->db->bind(':putere_energie', $data['putere_energie']);
            $this->db->bind(':reactoare_active', $data['reactoare_active']);
        } else {
            $this->db->query('UPDATE pp_states SET ' .
                'temperatura_nucleu=:temperatura_nucleu,putere_racire=:putere_racire,' .
                'putere_produsa=:putere_produsa,putere_ceruta=:putere_ceruta,' .
                'putere_energie=:putere_energie WHERE id_centrala=:id_centrala');

            $this->db->bind(':id_centrala', $data['id_centrala']);
            $this->db->bind(':temperatura_nucleu', $data['temperatura_nucleu']);
            $this->db->bind(':putere_racire', $data['putere_racire']);
            $this->db->bind(':putere_produsa', $data['putere_produsa']);
            $this->db->bind(':putere_ceruta', $data['putere_ceruta']);
            $this->db->bind(':putere_energie', $data['putere_energie']);
        }


        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getById($id)
    {
        $this->db->query('SELECT * FROM pp_states WHERE id=:id');

        //Bind value
        $this->db->bind(':id', $id);

        $this->db->execute();

        $result = $this->db->single();

        return $result;
    }

    public function getByCentralId($id_centrala)
    {
        $this->db->query('SELECT * FROM pp_states WHERE id_centrala=:id_centrala');

        //Bind value
        $this->db->bind(':id_centrala', $id_centrala);

        $this->db->execute();

        $result = $this->db->resultSet();

        return $result;
    }
}
