<?php
/**
 * Copyright (c) AccountProductions and Lolmewn 2014. All Rights Reserved.
 */
include_once'pingr.php';
class serverStatus
{

  private $serverAddress;
  private $serverData;

  function __construct($address, $port)
  {
    $this->serverAddress = $address;
  }

  function fetchServerData()
  {
    $this->serverData = Pingr::getStats($this->serverAddress);
    return $this->serverData;
  }

  function isOnline()
  {
    if (isset ($this->serverData['online'])) {
      return true;
    } else {
      return false;
    }
  }

  function isDead()
  {
    if (isset ($this->serverData['online'])) {
      return false;
    } else {
      return array_key_exists("error", $this->serverData);
    }
  }

  function getOnlinePlayerCount()
  {
    if (isset ($this->serverData['online'])) {
      return $this->serverData['players'];
    } else {
      return false;
    }
  }

  function getMaxPlayerCount()
  {
    if (isset ($this->serverData['online'])) {
      return $this->serverData['maxplayers'];
    } else {
      return false;
    }
  }
}
