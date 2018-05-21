<?php

class Connection {

    private $hote = '127.0.0.1:3306';
    private $bd = 'sharedgifts';
    private $charset = 'UTF-8';
    private $user = 'root';
    private $password = '';

    public function __construct($db)
    {
        $this->hote = $db['hote'];
        $this->bd = $db['bd'];
        $this->charset = $db['charset'];
        $this->user = $db['user'];
        $this->password = $db['password'];
    }

    public function getHote()
    {
        return $this->hote;
    }

    public function getBd()
    {
        return $this->bd;
    }

    public function getCharset()
    {
        return $this->charset;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setHote($hote)
    {
        if ($hote != 0) {
            $this->hote = $hote;
        }
    }

    public function setBd($bd)
    {
        if ($bd != 0) {
            $this->bd = $bd;
        }
    }

    public function setCharset($charset)
    {
        if ($charset != 0) {
            $this->charset = $charset;
        }
    }

    public function setUser($user)
    {
        if ($user != 0) {
            $this->user = $user;
        }
    }

    public function setPassword($password)
    {
        if ($password != 0) {
            $this->password = $password;
        }
    }

    public function dbconnect()
    {
        try {
            $db_config = array();
            $db_config['OPTIONS'] = array(
                // Activation des exceptions PDO :
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                // Change le fetch mode par défaut sur FETCH_ASSOC ( fetch() retournera un tableau associatif ) :
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            );
            
            $pdo = new PDO(
                'mysql:host='.$this->hote . ';dbname=' . $this->bd,
                $this->user,
                $this->password,
                $db_config['OPTIONS']
                );
            unset($db_config);
            return $pdo;
        } catch (Exception $e) {
            trigger_error($e->getMessage(), E_USER_ERROR);
        }
    }
}
