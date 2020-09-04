<?php
namespace Projet5;

class ModelFrontend
{

    //CONNECTION A LA BDD
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

    // ------------------------------------------ARTICLES-----------------------------------------------
    //RECUPERE LES 4 DERNIERS ARTICLES
    public function lastPost()
    {
        try
        {
            $db = $this->dbConnect();
            $req = $db->query('SELECT id, IF(CHAR_LENGTH(title) > 30, CONCAT(LEFT(title, 30), " ..."), title) AS preview, lien_image, DATE_FORMAT(date_post, "Publié le %d/%m/%Y") AS creation_date_fr FROM posts ORDER BY `id` DESC LIMIT 4');
            return $req;
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }

    //RECUPERE LES ARTICLES
    public function getPosts()
    {
        try
        {
            $db = $this->dbConnect();
            $req = $db->query('SELECT id, title, lien_image, IF(CHAR_LENGTH(content) > 200, CONCAT(LEFT(content, 200), " ..."), content) AS preview, DATE_FORMAT(date_post, "Publié le %d/%m/%Y") AS creation_date_fr FROM posts ORDER BY `id` DESC LIMIT 4');
            return $req;
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }

    //RECUPERE L'ARTICLE PAR ID
    public function getPost($id)
    {
        try
        {
            $db = $this->dbConnect();
            $req = $db->prepare('SELECT id, title, content, lien_image, DATE_FORMAT(date_post, "Publié le %d/%m/%Y") AS creation_date_fr FROM posts WHERE id = ?');
            $req->execute(array($id));
            $post = $req->fetch();
            return $post;
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }

    // ------------------------------------------COMMENTAIRES-----------------------------------------------
    //ENVOIE UN COMMENTAIRE
    public function sendComment($pseudo, $commentaire, $postId)
    {
        try
        {
            $db = $this->dbConnect();
            $req = $db->prepare('INSERT INTO comments (pseudo, comment, id_post, comment_date) VALUES(:pseudo, :comment, :postid, NOW())');
            $req->execute(array(
                'pseudo' => $pseudo, 
                'comment' => $commentaire, 
                'postid' => $postId
            ));
            return $req;
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }

    //RECUPERE LES COMMENTAIRES
    public function getComments($postId)
    {
        try
        {
            $db = $this->dbConnect();
            $comments = $db->prepare('SELECT id, pseudo, comment, report, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%i\') AS comment_date_fr FROM comments WHERE id_post = ? ORDER BY comment_date DESC');
            $comments->execute(array($postId));
            return $comments;
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }

    //NOMBRE DE COMMENTAIRES PAR POST
    public function nbComment($postId)
    {
        try
        {
            $db = $this->dbConnect();
            $req = $db->prepare('SELECT COUNT(*) AS nbcomment FROM comments WHERE id_post = ?');
            $req->execute(array($postId));
            $result = $req->fetch();
            return $result;
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }

    //REPORT UN COMMENTAIRE
    public function reportComment($id)
    {
        try
        {
            $db = $this->dbConnect();
            $req = $db->prepare('UPDATE comments SET report = report + 1 WHERE id = :id');
            $req->execute(array(
                'id' => $id,
            ));
            return $req;
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }

    // ------------------------------------------MESSAGES-----------------------------------------------
    //ENVOIE DE MESSAGE DEPUIS LE FORMULAIRE
    public function messageForm($name, $email, $message, $resident)
    {
        try
        {
            $db = $this->dbConnect();
            $req = $db->prepare('INSERT INTO form (name, email, message, message_date, resident) VALUES(:name, :email, :message, NOW(), :resident)');
            $req->execute(array(
                'name' => $name, 
                'email' => $email,
                'message' => $message,
                'resident' => $resident
            ));
            return $req;
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }
}