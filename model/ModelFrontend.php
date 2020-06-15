<?php
namespace Kevin\Projet5;

class ModelFrontend
{

    private function dbConnect()
    {
        try
        {
            $db = new \PDO('mysql:host=localhost;dbname=projet5;charset=utf8', 'root', '');
            return $db;
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }

    public function lastPost()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, IF(CHAR_LENGTH(content) > 500, CONCAT(LEFT(content, 500), "..."), content) AS preview, DATE_FORMAT(date_post, "Publié le %d/%m/%Y") AS creation_date_fr FROM posts ORDER BY `id` DESC LIMIT 1');
        $post = $req->fetch();
        return $post;
    }

    public function messageForm($name, $firstName, $email, $resident)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO form (name, first_name, email, message_date, resident) VALUES(:name, :firstName, :email, NOW(), :resident)');
        $req->execute(array(
            'name' => $name, 
            'firstName' => $firstName, 
            'email' => $email,
            'resident' => $resident
        ));
        return $req;
    }
}