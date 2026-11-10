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
           return (int) ($rep[0] ?? 0);
    }

    public function donnerTouite(int $id):Touite{
        $query = "SELECT * FROM touite WHERE id=:id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['id' => $id]);
        $rep=$stmt->fetch();
        if ($rep===false) {
            return new Touite("","",[]);
        }

        $query= "SELECT username FROM Utilisateur WHERE id=:idu";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['idu' => $rep['IDUSER']]);
        $re=$stmt->fetch();

        $path='';

        if($rep['IDIMAGE']!==null){
            $query= "SELECT chemin FROM Image WHERE id=:idm";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute(['idm' => $rep['IDIMAGE']]);
            $r=$stmt->fetch();
            $path='<img src='.$r[0].'/>';
        }
        

        return new Touite(
            (string) $rep['TEXTE'],
            (string) $re[0],
            [],
            (int) $rep['ID'],
            $rep['DATE'],
            $path
        );
    }

    public function ecrireTouite(string $utilisateur, string $texte, array $tags,int $idimg){
        if ($utilisateur!=='' && $texte!==''){
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
            $query="INSERT INTO touite(iduser,texte,idimage) VALUES (:utilisateur,:texte,:idimg)";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute(['utilisateur' => $rep[0],'texte' => $texte,'idimg' => $idimg]);
            
            // faire un insert dans touite tag en recuperant le tag avec le #
            if (count($tags)>0){
                $idto=$this->donnerIdVieux();
                foreach($tags as $tag){
                    $found=$this->chercheTag($tag);
                    if (!(count($found)>0)){
                        $this->creerTag([$tag,""]);
                        $query="SELECT MAX(id) FROM Tags";
                        $stmt = $this->pdo->prepare($query);
                        $stmt->execute();
                        $found=$stmt->fetch();
                        $found=$found[0];
                    }else{
                       $found=$found[1]; 
                    }
                    $query="INSERT INTO Touitetags(idtouite,idtag) VALUES (:idto,:idta)";
                    $stmt = $this->pdo->prepare($query);
                    $stmt->execute(['idto' => $idto,'idta' => $found]);
                }
            }
            
        }
    }

    public function creerTag(array $tab){
        if (count($tab)>0){
            $found= $this->chercheTag($tab[0]);
            $libelle='#'.$tab[0];
            $desc=$tab[1];
            if (count($found)>0){
                echo 't';
                $query="UPDATE Tags SET description=:desc WHERE libelle LIKE :libelle";
                $stmt = $this->pdo->prepare($query);
                $stmt->execute(['desc' => $desc,'libelle' => $libelle]);
            }else{
                $query="INSERT INTO Tags (libelle,description) VALUES (:libelle,:desc)";
                $stmt = $this->pdo->prepare($query);
                $stmt->execute(['desc' => $desc,'libelle' => $libelle]);
            }
        }
    }

    public function donnerTouiteUser(string $user):array{
        $query="SELECT id FROM Utilisateur WHERE username LIKE :username";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['username' => $user]);
        $rep=$stmt->fetch();
        if ($rep===false){
            return [];
        }else{
            $query="SELECT id FROM touite WHERE iduser=:idus";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute(['idus'=>$rep[0]]);
            $re=$stmt->fetchAll();
            $ans=[];
            foreach ($re as $elt){
                $ans[]=$this->donnerTouite($elt[0]);
            }
            return array_reverse($ans);
        }
    }

    public function donnerTouiteTag(string $tag){
        $query="SELECT id FROM Tags WHERE libelle LIKE :libelle";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['libelle' => '#'.$tag]);
        $rep=$stmt->fetch();
        if ($rep===false){
            return [];
        }else{
            $query="SELECT idtouite FROM Touitetags WHERE idtag=:idtag";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute(['idtag'=>$rep[0]]);
            $re=$stmt->fetchAll();
            $ans=[];
            foreach ($re as $elt){
                $ans[]=$this->donnerTouite($elt[0]);
            }
            return array_reverse($ans);
        }
    }

    public function chercheTag(string $tag){
        $query = "SELECT * FROM Tags WHERE libelle LIKE :libelle";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['libelle' => '#'.$tag]);
        $rep=$stmt->fetch();
        if ($rep===false){
            $rep=[];
        }
        return $rep;
    }

    public function actualiserImages(): void
    {
        $dossier = 'img/';

        $fichiers = scandir($dossier);

        foreach ($fichiers as $fichier) {

            if ($fichier === '.' || $fichier === '..') {
                continue;
            }

            $chemin = $dossier . $fichier;

            // nom du fichier sans extension
            $description = pathinfo($fichier, PATHINFO_FILENAME);

            $stmt = $this->pdo->prepare(
                "SELECT COUNT(*) FROM Image WHERE chemin = :chemin"
            );
            $stmt->execute(['chemin' => $chemin]);

            if ($stmt->fetchColumn() == 0) {

                $stmt = $this->pdo->prepare(
                    "INSERT INTO Image (chemin, description)
                    VALUES (:chemin, :description)"
                );

                $stmt->execute([
                    'chemin' => $chemin,
                    'description' => $description
                ]);
            }
        }
    }

    public function chercheImages(): array {
        $query = "SELECT * FROM Image";

        $stmt = $this->pdo->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll();
    }
}