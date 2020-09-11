<?php
namespace Projet5;

class CommentManager extends DbConnect
{

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


    //COMPTE LE NOMBRE DE COMMENTAIRES
    public function countComments()
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

    //COMPTE LE NOMBRE DE COMMENTAIRES PAR ID
    public function countComment($id)
    {
        try
        {
            $db = $this->dbConnect();
            $req = $db->prepare('SELECT COUNT(id) FROM comments WHERE id_post = ?');
            $req->execute(array($id));
            $result = $req->fetch();
            return $result;
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }

    //RECUPERE LA LISTE DES COMMENTAIRES
    public function getListComments($id, $limit, $offset)
    {
        try{
            $db = $this->dbConnect();
            $req = $db->prepare('SELECT id, id_post, pseudo, IF(CHAR_LENGTH(comment) > 50, CONCAT(LEFT(comment, 50), " ..."), comment) AS preview, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%i\') AS creation_date_fr, report FROM comments WHERE id_post = :id ORDER BY comment_date ASC LIMIT :limit OFFSET :offset');
            $req->bindValue(':id', $id, \PDO::PARAM_INT);
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

    //RECUPERE COMMENTAIRE PAR ID
    public function getComment($id)
    {
        try{
            $db = $this->dbConnect();
            $req = $db->prepare('SELECT id, id_post, pseudo, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%i\') AS creation_date_fr, report FROM comments WHERE id = ?');
            $req->execute(array($id));
            $post = $req->fetch();
            return $post;
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }

    //SUPPRIME UN COMMENTAIRE
    public function deleteComment($id)
    {
        try
        {
            $db = $this->dbConnect();
            $req = $db->prepare('DELETE FROM comments WHERE id= ?');
            $req->execute(array($id));  
            return $req;
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }

    //VALIDE UN COMMENTAIRE
    public function validComment($id)
    {
        try{
            $db = $this->dbConnect();
            $req = $db->prepare('UPDATE comments SET report = -1 WHERE id = ?');
            $req->execute(array($id));
            $post = $req->fetch();
            return $post;
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }
}