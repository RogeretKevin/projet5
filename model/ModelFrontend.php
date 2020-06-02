<?php
class ModelFrontend
{

    private function dbConnect()
    {
        try
        {
            $db = new PDO('mysql:host=localhost;dbname=projet5;charset=utf8', 'root', '');
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
        $req = $db->query('SELECT id, title, IF(CHAR_LENGTH(content) > 200, CONCAT(LEFT(content, 200), "..."), content) AS preview, DATE_FORMAT(date_post, "Publié le %d/%m/%Y") AS creation_date_fr FROM posts ORDER BY `id` DESC LIMIT 1');
        $post = $req->fetch();
        return $post;
    }
}