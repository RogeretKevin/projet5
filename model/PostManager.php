<?php
namespace Projet5;

class PostManager extends DbConnect
{

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
            $req = $db->query('SELECT id, title, lien_image, IF(CHAR_LENGTH(content) > 200, CONCAT(LEFT(content, 200), " ..."), content) AS preview, DATE_FORMAT(date_post, "Publié le %d/%m/%Y") AS creation_date_fr FROM posts ORDER BY `id` DESC');
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
}