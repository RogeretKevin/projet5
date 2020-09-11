<?php
namespace Projet5;

class MessageManager extends DbConnect
{

    //RECUPERE LA LISTE DES MESSAGES
    public function getListMessages($limit, $offset)
    {
        try{
            $db = $this->dbConnect();
            $req = $db->prepare('SELECT id, name, email, IF(CHAR_LENGTH(message) > 50, CONCAT(LEFT(message, 50), " ..."), message) AS preview, DATE_FORMAT(message_date, \'%d/%m/%Y à %Hh%i\') AS creation_date_fr, resident, lu FROM form ORDER BY message_date ASC LIMIT :limit OFFSET :offset');
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
            $req = $db->prepare('SELECT id, name, email, message, DATE_FORMAT(message_date, \'%d/%m/%Y à %Hh%i\') AS creation_date_fr, resident, lu FROM form WHERE id = ?');
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