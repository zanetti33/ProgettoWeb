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

    public function mostSold($n = 3){
        $query = "SELECT idMaglia, immagineFronte FROM maglia ORDER BY vendite DESC LIMIT ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$n);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getModels(){
        $stmt = $this->db->prepare("SELECT idModello, nome FROM modello");
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getColors(){
        $stmt = $this->db->prepare("SELECT idColore, nome FROM colore");
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getGenders(){
        $stmt = $this->db->prepare("SELECT idGenere, nome FROM genere");
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getSizes(){
        $stmt = $this->db->prepare("SELECT taglia FROM maglia GROUP BY taglia");
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
        $stmt = $this->db->prepare("SELECT maglia.idMaglia, quantità, nomePersonalizzato, numeroPersonalizzato, costo, immagineFronte, taglia
            FROM maglia_ordinata, maglia WHERE maglia.idMaglia = maglia_ordinata.idMaglia AND idOrdine=?");
        $stmt->bind_param("i", $idOrder);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getProductsInCart($email){
        $stmt = $this->db->prepare("SELECT idRiga, maglia.idMaglia, quantità, nomePersonalizzato, numeroPersonalizzato, costo, immagineFronte, taglia
            FROM maglia_in_carrello, maglia WHERE maglia.idMaglia = maglia_in_carrello.idMaglia AND email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getProductById($id){
        $stmt = $this->db->prepare("SELECT immagineFronte, immagineRetro, modello.idModello as idModello, modello.nome as modello, modello.descrizione as descrizione, colore.nome as colore, colore.idColore as idColore, genere.nome as genere, genere.idGenere as idGenere, prezzo, taglia, idMaglia, dispMagazzino
            FROM maglia, modello, genere, colore WHERE maglia.idModello = modello.idModello AND
            maglia.idColore = colore.idColore AND maglia.idGenere = genere.idGenere AND
            maglia.idMaglia=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getProductBySize($genere, $colore, $modello, $taglia) {
        $stmt = $this->db->prepare("SELECT idMaglia FROM maglia WHERE idGenere = ? AND idColore = ? AND idModello = ? AND taglia = ?");
        $stmt->bind_param("iiii", $genere, $colore, $modello, $taglia);
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

    public function getFilteredShirts($generi, $colore = 2){
              
        if (count($generi) <= 0 || count($generi) >= 3) {
            //Maglie di qualsiasi genere
            $query = "SELECT M.idMaglia, M.prezzo, M.immagineFronte, O.nome as modello, G.nome as genere FROM maglia M, modello O, genere G WHERE M.dispMagazzino > 0 AND  M.idModello = O.idModello AND M.idGenere = G.idGenere AND idColore = ? GROUP BY M.idGenere, M.idModello";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('i', $colore);

        } elseif(count($generi) == 1) {
            //Maglie di UN genere
            $query = "SELECT M.idMaglia, M.prezzo, M.immagineFronte, O.nome as modello, G.nome as genere FROM maglia M, modello O, genere G WHERE M.dispMagazzino > 0 AND M.idModello = O.idModello AND M.idGenere = G.idGenere AND M.idGenere = ? AND idColore = ? GROUP BY M.idGenere, M.idModello";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('ii', $generi[0], $colore);
        } else {
            //Maglie di DUE generi
            $query = "SELECT M.idMaglia, M.prezzo, M.immagineFronte, O.nome as modello, G.nome as genere FROM maglia M, modello O, genere G WHERE M.dispMagazzino > 0 AND M.idModello = O.idModello AND M.idGenere = G.idGenere AND idColore = ? AND M.idGenere IN (?, ?) GROUP BY M.idGenere, M.idModello";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('iii', $colore, $generi[0], $generi[1]);
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

    public function insertProduct($modello, $colore, $taglia, $genere, $dispMagazzino, $prezzo, $imgFronte, $imgRetro){
        $query = "INSERT INTO maglia (idModello, idColore, taglia, idGenere, dispMagazzino,
            prezzo, immagineFronte, immagineRetro) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('iisiiiss', $modello, $colore, $taglia, $genere, $dispMagazzino,
            $prezzo, $imgFronte, $imgRetro);
        $stmt->execute();

        return $stmt->insert_id;
    }

    public function updateProduct($id, $prezzo, $taglia, $immagineFronte, $immagineRetro, $dispMagazzino){
        $query = "UPDATE maglia SET dispMagazzino = ?, prezzo = ?, taglia = ?,
        immagineFronte = ?, immagineRetro = ? WHERE idMaglia = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('iisssi', $dispMagazzino, $prezzo, $taglia,
            $immagineFronte, $immagineRetro, $id);
        $stmt->execute();

        return $stmt->affected_rows;
    }

    public function removeProduct($id){
        $query = "UPDATE maglia SET dispMagazzino = 0 WHERE idMaglia = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();

        return $stmt->affected_rows;
    }

    public function stock($id){
        $query = "SELECT dispMagazzino FROM maglia WHERE idMaglia=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->getResult();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function numberOfProductInCart($id, $email){
        $query = "SELECT quantità FROM maglia_in_ordine WHERE idMaglia=? AND email=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('is', $id, $email);
        $stmt->execute();
        $result = $stmt->getResult();

        $tot = 0;
        foreach($result as $value){
            $tot += $value["quantità"];
        }

        return $tot;
    }

    public function executeOrder($email){
        $error = false;
        //inserimento ordine
        $query = "INSERT INTO ordine (email, dataPagamento, stato, totale) 
            VALUES (?, CURRENT_TIMESTAMP(), ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssi', $email, $stato, $totale);
        $stmt->execute();

        $idOrder = $stmt->insert_id;
        if(!($idOrder>0)){
            return true;
        }

        //inserimento delle maglie nell'ordine
        $query = "INSERT INTO maglia_ordinata (idMaglia, idOrdine, quantità, nomePersonalizzato, numeroPersonalizzato, costo) 
            VALUES (?, ?, ?, ?, ?, ?)";
        $maglie = $this->getProductsInCart($email);
        if(count($maglie) == 0){
            return true;
        }
        foreach($maglie as $maglia){
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('iiisii', $maglia["idMaglia"], $idOrder,
                $maglia["quantità"], $maglia["nomePersonalizzato"],
                $maglia["numeroPersonalizzato"], $maglia["costo"]);
            $stmt->execute();
            $id = $stmt->insert_id;
            if(!($idOrder>0)){
                return true;
            }
        }

        //cancellazione delle maglie nel carrello
        $query = "DELETE FROM maglia_in_carrello WHERE email=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        if(!($stmt->affected_rows>0)){
            return true;
        }
        return false;
    }

    public function removeFromCart($idRiga){
        $query = "DELETE FROM maglia_in_carrello WHERE idRiga = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $idRiga);
        $stmt->execute();

        return $stmt->affected_rows;
    }
}
?>
