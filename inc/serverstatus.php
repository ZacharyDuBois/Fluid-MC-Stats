<?php

/**
 * Copyright (c) AccountProductions and Lolmewn 2014. All Rights Reserved.
 */

class serverstatus {
    
    private $serverAddress;
    private $serverData;
    
    function __construct($address, $port) {
        $this->serverAddress = $address . ":" . $port;
    }
    
    function fetchServerData(){
        $this->serverData = json_decode( file_get_contents( 'http://minecraft-api.com/v1/get/?server=' . $this->serverAddress ), true ); 
        return $this->serverData;
    }
    
    function isOnline(){
        return $this->serverData['status'];
    }
    
    function isDead(){
        return array_key_exists("error", $this->serverData);
    }
    
    function getOnlinePlayerCount(){
        return $this->serverData['players']['online'];
    }
    
    function getMaxPlayerCount(){
        return $this->serverData['players']['max'];
    }
}
