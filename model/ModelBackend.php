<?php
namespace Projet5;

class ModelBackend
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

    //RECUPERE LE LISTE DES ARTICLES
    public function getListPosts($limit, $offset)
    {
        try
        {
            $db = $this->dbConnect();
            $req = $db->prepare('SELECT id, IF(CHAR_LENGTH(title) > 50, CONCAT(LEFT(title, 50), " ..."), title) AS preview, lien_image, DATE_FORMAT(date_post, "%d/%m/%Y") AS creation_date_fr FROM posts ORDER BY `date_post` DESC LIMIT :limit OFFSET :offset');
            $req->bindValue(':limit', $limit, \PDO::PARAM_INT);
            $req->bindValue(':offset', $offset, \PDO::PARAM_INT);
            $req->execute();
            return $req;
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }

    //RECUPERE L'ARTICLE PAR ID
    public function getPost($postId)
    {
        try
        {
            $db = $this->dbConnect();
            $req = $db->prepare('SELECT id, title, content, lien_image, DATE_FORMAT(date_post, \'Le %d/%m/%Y\') AS creation_date_fr FROM posts WHERE id = ?');
            $req->execute(array($postId));
            $post = $req->fetch();
            return $post;
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }

    //MODIFIE L'ARTICLE
    public function editPost($newtitle, $newcontent, $id, $lienImage)
    {
        try{
            $db = $this->dbConnect();
            $req = $db->prepare('UPDATE posts SET title = :newtitle, content = :newcontent, lien_image = :image WHERE id = :id');
            $req->execute(array(
                'newtitle' => $newtitle,
                'newcontent' => $newcontent,
                'id' => $id,
                'image' => $lienImage
            ));
            return $req;
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }

    //CREER UN ARTICLE
    public function createPost($title, $content, $lienImage)
    {
        try{
            $db = $this->dbConnect();
            $req = $db->prepare('INSERT INTO posts (title, content, lien_image, date_post) VALUES(:title, :content, :image, NOW())');
            $req->execute(array(
                'title' => $title, 
                'content' => $content,
                'image' => $lienImage
            ));
            return $req;
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }

    //RECUPERE LA LISTE DES MESSAGES
    public function getListMessages($limit, $offset)
    {
        try{
            $db = $this->dbConnect();
            $req = $db->prepare('SELECT id, name, email, IF(CHAR_LENGTH(message) > 50, CONCAT(LEFT(message, 50), " ..."), message) AS preview, DATE_FORMAT(message_date, \'%d/%m/%Y\') AS creation_date_fr, resident, lu FROM form ORDER BY message_date ASC LIMIT :limit OFFSET :offset');
            $req->bindValue(':limit', $limit, \PDO::PARAM_INT);
            $req->bindValue(':offset', $offset, \PDO::PARAM_INT);
            $req->execute();
            return $req;
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }

    //RECUPERE MESSAGE PAR ID
    public function getMessage($messageId)
    {
        try{
            $db = $this->dbConnect();
            $req = $db->prepare('SELECT * FROM form WHERE id = ?');
            $req->execute(array($messageId));
            $post = $req->fetch();
            return $post;
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }

    //MARQUE LE MESSAGE COMME LU
    public function messageRead($messageId)
    {
        try{
            $db = $this->dbConnect();
            $req = $db->prepare('UPDATE form SET lu = TRUE WHERE id = ?');
            $req->execute(array($messageId));
            $post = $req->fetch();
            return $post;
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }

    //SUPPRIME UN ARTICLE
    public function deletePost($postId)
    {
        try
        {
            $db = $this->dbConnect();
            $req = $db->prepare('DELETE FROM posts WHERE id= :idcomment');
            $req->execute(array(
                'idcomment' => $postId
            ));
            return $req;
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }

    //SUPPRIME UN MESSAGE
    public function deleteMessage($messageId)
    {
        try
        {
            $db = $this->dbConnect();
            $req = $db->prepare('DELETE FROM form WHERE id= :idcomment');
            $req->execute(array(
                'idcomment' => $messageId
            ));
            return $req;
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }

    //LOGIN
    public function checkpseudo($pseudo)
    {
        try
        {
            $db = $this->dbConnect();
            $req = $db->prepare('SELECT id, password FROM users WHERE pseudo = :pseudo');
            $req->execute(array('pseudo' => $pseudo));
            $resultat = $req->fetch();
            return $resultat;
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }

    //COMPTE LE NOMBRE DE MESSAGES
    public function countMessage()
    {
        try
        {
            $db = $this->dbConnect();
            $req = $db->query('SELECT COUNT(id) FROM form');
            $result = $req->fetch();
            return $result;
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }

    //COMPTE LE NOMBRE D'ARTICLES
    public function countPost()
    {
        try
        {
            $db = $this->dbConnect();
            $req = $db->query('SELECT COUNT(id) FROM posts');
            $result = $req->fetch();
            return $result;
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }

    //COMPTE LE NOMBRE DE COMMENTAIRES
    public function countComment()
    {
        try
        {
            $db = $this->dbConnect();
            $req = $db->query('SELECT COUNT(id) FROM comments');
            $result = $req->fetch();
            return $result;
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }
}