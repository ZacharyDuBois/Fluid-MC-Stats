<?php

/**
 * Copyright (c) AccountProductions and Sybren Gjaltema, 2014. All rights reserved.
 */
class serverStatus
{

  private $serverAddress;
  private $serverData;

  function __construct($address, $port)
  {
    $this->serverAddress = $address . ":" . $port;
  }

  function fetchServerData()
  {
    $this->serverData = json_decode(file_get_contents('http://minecraft-api.com/v1/get/?server=' . $this->serverAddress), true);

    return $this->serverData;
  }

  function isOnline()
  {
    if (isset ($this->serverData['status'])) {
      return true;
    } else {
      return false;
    }
  }

  function isDead()
  {
    if (isset ($this->serverData['status'])) {
      return false;
    } else {
      return array_key_exists("error", $this->serverData);
    }
  }

  function getOnlinePlayerCount()
  {
    if (isset ($this->serverData['status'])) {
      return $this->serverData['players']['online'];
    } else {
      return false;
    }
  }

  function getMaxPlayerCount()
  {
    if (isset ($this->serverData['status'])) {
      return $this->serverData['players']['max'];
    } else {
      return false;
    }
  }
}
