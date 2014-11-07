<?php 
  class Link {
    private $icon = '';
    
    private $name = '';
    
    private $target = '';
    
    /**
     * Generates an new link-object.
     * 
     * @param unknown $name   The name of the link (e.g. Player List).
     * @param unknown $target The link-target (e.g. /player-list).
     * @param unknown $icon   The icon-class (e.g. fa-list).
     */
    public function __construct($name, $target, $icon) {
      $this->name = $name;
      $this->icon = $icon;
      $this->target = $target;
    }
    
    
    /**
     * Returns the icon for this link.
     * 
     * @return string
     */
    public function getIcon() {
      return $this->icon;
    }
    
    
    /**
     * Returns the name of this link.
     * 
     * @return string
     */
    public function getName() {
      return $this->name;
    }
    
    
    /**
     * Returns the target for this link.
     * 
     * @return string
     */
    public function getTarget() {
      return $this->target;
    }
    
    
    /**
     * Returns the HTML for this link.
     * 
     * @return string
     */
    public function __toString() {
      return '<a href="'.$this->getTarget().'"><i class="fa '.$this->getIcon().'"></i>'.$this->getName().'</a>';
    }
  }
?>