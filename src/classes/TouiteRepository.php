<?php

namespace iutnc\sae;

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
    public function donnerTruc(string $name){
        $query = "SELECT * from touite where utilisateur=:utilisateur";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['utilisateur' => $name]);
        $rep=$stmt->fetch();
        if ($rep===false){
            $rep="aucun résultat trouvé";
        }
        return $rep;
    }

    public function chercheTag(string $tag){
        
    }
}