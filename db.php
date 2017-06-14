<?php include 'log.php' ?>
<?php
  session_start();

  class Db{
    private $servername = "127.0.0.1";
    private $username = "root";
    private $password = "vivify";
    private $dbname = "online_oglasnik";
    public $conn;
    public $error = "";
    public $log;

    public function __construct($logObj){
      try {

          $this->log = isset($logObj)? $logObj : new Log();
          $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
          // set the PDO error mode to exception
          $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      }
      catch(PDOException $e)
      {
        $this->error = $e->getMessage();
        //die();
      }
    }

    public function fetchData($query){
       //echo ($sql);
      $statement = $this->conn->prepare($query);
      // execute statement
      $statement->execute();
      // set the resulting array to associative
      $statement->setFetchMode(PDO::FETCH_ASSOC);
      // gets data from DB
      return $statement->fetchAll();
    }

    public function executeQuery($query){
      //echo ($sql);
      $statement = $this->conn->prepare($query);
      // execute statement
      $statement->execute();
      return true;
    }

    public function getAdById($adId){
      $sql = "SELECT ads.id, ads.title, ads.text, ads.created_at, ads.expires_on,categories.id as category_id,
        categories.name AS category_name, users.id AS user_id,users.email AS email,
        profiles.first_name, profiles.last_name, profiles.city, profiles.phone FROM ads
        LEFT JOIN categories ON categories.id = ads.category_id
        LEFT JOIN users ON users.id = ads.user_id
        LEFT JOIN profiles ON profiles.user_id = users.id WHERE ads.id = $adId";

      return $this->fetchData($sql);

    }

    public function updateAd($ad){
      //$this->log->writeLog("ad_id:$ad->ad_id", null);
      //$this->log->writeLog("category_id:$ad->category_id", null);
      $sqlUpdateAd = "UPDATE ads SET title = '{$ad->title}', text = '{$ad->text}', category_id = $ad->category_id WHERE ads.id = $ad->ad_id";
      //$this->log->writeLog("Update query:$updateAdQuery", null);
      $this->executeQuery($sqlUpdateAd);
    }

    public function createAd($ad){
      $sqlCreateAd = "INSERT INTO ads (ads.title, ads.text) VALUES ('{$ad->title}', '{$ad->text}', '')";
    }

  }

  class Ad{
    public $title;
    public $text;
    public $created;
    public $expires;
    public $first_name;
    public $last_name;
    public $phone;
    public $email;
    public $category_name;
    private $username;
    public $category_id;
    public $user_id;
    public $ad_id;

    public function __construct($record){

      $this->title = isset($record["title"]) ? $record["title"]:"";
      $this->text = isset($record["text"]) ? $record["text"]:"";
      $this->created = isset($record["created_at"]) ? $record["created_at"]:"";
      $this->expires = isset($record["expires_on"]) ? $record["expires_on"]:"";
      $this->first_name = isset($record["first_name"]) ? $record["first_name"]:"";
      $this->last_name = isset($record["last_name"]) ? $record["last_name"]:"";
      $this->phone = isset($record["phone"]) ? $record["phone"]:"";
      $this->email = isset($record["email"]) ? $record["email"]:"";
      $this->category_name = isset($record["category_name"]) ? $record["category_name"]:"";

      $this->user_id = isset($record["user_id"]) ? $record["user_id"]:"";
      $this->category_id = isset($record["category_id"]) ? (int)$record["category_id"]:"";

      $this->ad_id = isset($record["id"]) ? (int)$record["id"]:"";

    }




  }

  $log = new Log();

  try{
    $dbOglasnik = new Db($log);
    if($dbOglasnik->error!=""){
      echo($dbOglasnik->error);
      $log->writeLog($dbOglasnik->error, null);
      return false;
    }
  }catch(Exception $ex){
    $log->writeLog($ex->getMessage, $ex->getLine());
  }


?>
