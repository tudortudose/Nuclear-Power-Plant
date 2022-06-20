<?php
class Configuration{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    public function insert($data){
        $this->db->query('INSERT INTO configurations ' .
        '(id_centrala,reactoare_active,temperatura_nucleu,putere_racire,putere_produsa,putere_ceruta,vreme,data_examinare,putere_energie) ' .
        'VALUES(:id_centrala,:reactoare_active,:temperatura_nucleu,:putere_racire,:putere_produsa,:putere_ceruta,:vreme,CURRENT_TIMESTAMP(),:putere_energie)');

        $this->db->bind(':id_centrala', $data['id_centrala']);
        $this->db->bind(':reactoare_active', $data['reactoare_active']);
        $this->db->bind(':temperatura_nucleu', $data['temperatura_nucleu']);
        $this->db->bind(':putere_racire', $data['putere_racire']);
        $this->db->bind(':putere_produsa', $data['putere_produsa']);
        $this->db->bind(':putere_ceruta', $data['putere_ceruta']);
        $this->db->bind(':vreme', $data['vreme']);
        $this->db->bind(':putere_energie',$data['putere_energie']);

        if($this->db->execute()){
            return true;
        }
        else{
            return false;
        }
    }

    public function getById($id)
    {
        $this->db->query('SELECT * FROM configurations WHERE id=:id');

        //Bind value
        $this->db->bind(':id', $id);

        $this->db->execute();

        $result = $this->db->single();

        return $result;
    }

    public function getLastByIdCentrala($id_centrala,$last_n){
        $this->db->query('SELECT * FROM configurations where id_centrala=:id_centrala ORDER BY data_examinare DESC limit :last_n');

        $this->db->bind(':id_centrala',$id_centrala);
        $this->db->bind(':last_n',$last_n);

        $this->db->execute();

        $results = $this->db->resultSet();

        return $results;
    }

    public function getOneByIdCentrala($id){
        $this->db->query('SELECT reactoare_active FROM configurations where id_centrala=:id_centrala ORDER BY data_examinare DESC limit 1');

        $this->db->bind(':id_centrala',$id);

        $this->db->execute();

        $result = $this->db->single();

        return $result;
    }

    public function getCountGroupByWeather($id){
        $this->db->query("select count(*) as number,vreme from configurations where id_centrala=:id_centrala group by vreme");

        $this->db->bind(':id_centrala',$id);

        $this->db->execute();

        $result = $this->db->resultSet();

        return $result;
    }
}