<?php

namespace iutnc\sae;

require_once('src/classes/Touite.php');
use iutnc\sae\Touite;

class TouiteRepository
{
    private \PDO $pdo;
    private static ?TouiteRepository $instance = null;
    private static array $config = [ ];

    private function __construct(array $conf) {
        $this->pdo = new \PDO($conf['dsn'], $conf['user'], $conf['pass'],[\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]);
    }

    public static function getInstance(){
        if (is_null(self::$instance)) {
            self::$instance = new TouiteRepository(self::$config);
        }
        return self::$instance;
    }

    public static function setConfig(string $file) {
        $conf = parse_ini_file($file);
        if ($conf === false) {
            throw new \Exception("Error reading configuration file");
        }
        self::$config = [ 'dsn'=> $conf['driver']
    . ':host=' . $conf['host']
    . ';dbname=' . $conf['database']
    . ';charset=utf8','user'=> $conf['username'],'pass'=> $conf['password'] ];
    }

    public function donnerIdVieux():int{
        $query="SELECT MAX(id) FROM touite";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $rep=$stmt->fetch();
        if ($rep===false){
            $i=0;
        }else{
            $i=$rep[0];
        }
        return $i;
    }

    public function donnerTouite(int $id):Touite{
        $query = "SELECT * from touite where id=:id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['id' => $id]);
        $rep=$stmt->fetch();
        if ($rep===false){
            $rep="aucun résultat trouvé";
            $t=new Touite("","",[]);
        }else{
            $query= "SELECT username from Utilisateur where id=:idu";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute(['idu'=>$rep[0]]);
            $re=$stmt->fetch();
            $t=new Touite($rep[1],$re[0],[]);
        }
        return $t;
    }

    public function ecrireTouite(string $utilisateur, string $texte){
        $query = "SELECT id FROM Utilisateur WHERE username LIKE :utilisateur";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['utilisateur' => $utilisateur]);
        $rep=$stmt->fetch();
        if ($rep===false){
            $query="INSERT INTO Utilisateur (username) VALUES (:utilisateur)";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute(['utilisateur' => $utilisateur]);
            $query = "SELECT id FROM Utilisateur WHERE username LIKE :utilisateur";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute(['utilisateur' => $utilisateur]);
            $rep=$stmt->fetch();
        }
        $query="INSERT INTO touite(iduser,texte) VALUES (:utilisateur,:texte)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['utilisateur' => $rep[0],'texte' => $texte]);

        // faire un insert dans touite tag en recuperant le tag avec le #
    }

    public function chercheTag(string $tag){
        $query = "SELECT * FROM TOUITETAG WHERE TAG LIKE '#:tag'";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['tag' => $tag]);
        $rep=$stmt->fetch();
        if ($rep===false){
            $rep="aucun résultat trouvé";
        }
        return $rep;
    }
}