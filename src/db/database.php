<?php
class DatabaseHelper{
    private $db;

    public function __construct($servername, $username, $password, $dbname, $port){
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if ($this->db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }        
    }

    public function funzioneEsempio($n){
		//inserire query qui
        $stmt = $this->db->prepare("SELECT nome FROM persona WHERE eta=?");
		//in questo caso inserisco n che è un intero (i) nel punto di domanda nella query
        $stmt->bind_param('i',$n);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAdmins(){
        $stmt = $this->db->prepare("SELECT email, nome, cognome FROM account WHERE admin=1");
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function checkLogin($email, $password){
        $query = "SELECT email, password, admin FROM account WHERE email = ? AND password = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss', $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    } 

    public function changePassword($email, $vecchiaPassword, $nuovaPassword){
        $query = "UPDATE account SET password = ? WHERE email = ? AND password = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sss', $nuovaPassword, $email, $vecchiaPassword);
        $stmt->execute();

        return $stmt->affected_rows;
    } 

    public function register($email, $nome, $cognome, $password, $telefono){
        $query = "INSERT INTO account (email, nome, cognome, password, numeroTelefono)
            VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sssss', $email, $nome, $cognome, $password, $telefono);
        $stmt->execute();

        return $stmt->affected_rows;
    } 
    
    public function alreadyRegistered($email){
        $query = "SELECT email FROM account WHERE email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>