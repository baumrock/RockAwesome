<?php namespace ProcessWire;
/**
 * RockAwesome Autoload Module
 *
 * @author Bernhard Baumrock, 16.03.2020
 * @license Licensed under MIT
 * @link https://www.baumrock.com
 */
class RockAwesome extends WireData implements Module, ConfigurableModule {

  public static function getModuleInfo() {
    return [
      'title' => 'RockAwesome Autoload Module',
      'version' => '0.0.2',
      'summary' => 'Autoload Module to attach hooks',
      'autoload' => true,
      'singular' => true,
      'icon' => 'bolt',
      'requires' => ['FieldtypeRockAwesome'],
      'installs' => [],
    ];
  }

  public function init() {
    $conf = $this->modules->getConfig('InputfieldRockAwesome');
    if(!array_key_exists('stylesheet', $conf)) {
      $url = $this->pages->get(2)->url."/module/edit?name=InputfieldRockAwesome";
      $link = "<a href='$url'>InputfieldRockAwesome</a>";
      $this->warning("You need to add the stylesheet in $link", Notice::allowMarkup);
      return;
    }
    $fa = $this->modules->getConfig('InputfieldRockAwesome')['stylesheet'];
    $this->fa = trim($fa, "/");
    
    // show warning if not exists
    $file = $this->config->paths->root . $this->fa;
    if(!is_file($file)) $this->warning("$file does not exist");

    $this->fa = "/".$this->fa;
    if($this->autoloadFA) $this->loadFA();
  }

  /**
   * Load Fontawesome Styles
   * @return void
   */
  public function loadFA() {
    $this->config->styles->add($this->fa);
  }
  
  /**
  * Config inputfields
  * @param InputfieldWrapper $inputfields
  */
  public function getModuleConfigInputfields($inputfields) {
    $inputfields->add([
      'name' => 'autoloadFA',
      'label' => 'Autoload FontAwesome styles on all admin pages',
      'type' => 'checkbox',
      'notes' => 'Style is located at ' . $this->fa,
      'required' => false,
      'checked' => $this->autoloadFA ? "checked" : "",
    ]);
  }
}
