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
      'version' => '0.0.1',
      'summary' => 'Autoload Module to attach hooks',
      'autoload' => true,
      'singular' => true,
      'icon' => 'bolt',
      'requires' => ['FieldtypeRockAwesome'],
      'installs' => [],
    ];
  }

  public function init() {
    $fa = $this->modules->getConfig('InputfieldRockAwesome')['stylesheet'];
    $this->fa = "/".trim($fa, "/");
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
