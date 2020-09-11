<?php
namespace Projet5;

class LogManager extends DbConnect
{
    
    // ------------------------------------------LOG-----------------------------------------------
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
}