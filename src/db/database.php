<?php
class DatabaseHelper{
    private $db;

    public function __construct($servername, $username, $password, $dbname, $port){
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if ($this->db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }        
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    }

    public function getLatestOrders($n=10){
        $query = "SELECT idOrdine, email, dataPagamento, stato, 
            (SELECT GROUP_CONCAT(idMaglia, '.', quantità) 
            FROM maglia_ordinata
            WHERE maglia_ordinata.idOrdine=ordine.idOrdine
            GROUP BY maglia_ordinata.idOrdine) as maglie
            FROM ordine
            ORDER BY dataPagamento DESC 
            LIMIT ?";
        $stmt = $this->db->prepare($query);
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

    public function getProducts(){
        $stmt = $this->db->prepare("SELECT idMaglia, immagineFronte, dispMagazzino FROM maglia");
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getOrdersOfUser($email){
        $stmt = $this->db->prepare("SELECT dataPagamento, stato, totale, idOrdine FROM ordine WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getProductsInOrder($idOrder){
        $stmt = $this->db->prepare("SELECT maglia.idMaglia, quantità, nomePersonalizzato, numeroPersonalizzato, costo, immagineFronte
            FROM maglia_ordinata, maglia WHERE maglia.idMaglia = maglia_ordinata.idMaglia AND idOrdine=?");
        $stmt->bind_param("i", $idOrder);
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

    public function getFilteredShirts($generi, $colore){
        
        $gen = array();

        if (isset($generi[0])) {
            array_push($gen, $generi[0]);
        }
        if (isset($generi[1])) {
            array_push($gen, $generi[1]);
        }
        if (isset($generi[2])) {
            array_push($gen, $generi[2]);
        }

        //echo $gen[0]."   ".$colore;
        
        if (count($gen) <= 0 || count($gen) >= 3) {
            //Maglie di qualsiasi genere
            $query = "SELECT M.idMaglia, M.prezzo, M.immagineFronte, O.descrizione, G.nome FROM maglia M, modello O, genere G WHERE M.idModello = O.idModello AND M.idGenere = G.idGenere AND idColore = ? GROUP BY M.idGenere, M.idModello";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('i', $colore);

        } elseif(count($gen) == 1) {
            //Maglie di UN genere
            $query = "SELECT M.idMaglia, M.prezzo, M.immagineFronte, O.descrizione, G.nome FROM maglia M, modello O, genere G WHERE M.idModello = O.idModello AND M.idGenere = G.idGenere AND M.idGenere = ? AND idColore = ? GROUP BY M.idGenere, M.idModello";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('ii', $gen[0], $colore);
        } else {
            //Maglie di DUE generi
            $query = "SELECT M.idMaglia, M.prezzo, M.immagineFronte, O.descrizione, G.nome FROM maglia M, modello O, genere G WHERE M.idModello = O.idModello AND M.idGenere = G.idGenere AND idColore = ? AND M.idGenere IN (?, ?) GROUP BY M.idGenere, M.idModello";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('iii', $colore, $gen[0], $gen[1]);
        }
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function addToProduct($id, $qta){
        $query = "UPDATE maglia SET dispMagazzino = dispMagazzino + ? WHERE idMaglia = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $qta, $id);
        $stmt->execute();

        return $stmt->affected_rows;
    }
}
?>