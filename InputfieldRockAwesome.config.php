<?php namespace ProcessWire;
class InputfieldRockAwesomeConfig extends ModuleConfig {
  public function __construct() {
    $this->add([
      [
        'name' => 'stylesheet',
        'label' => 'Path to Stylesheet',
        'type' => 'text',
        'notes' => 'Relative to site root (' . $this->config->paths->root . ')',
        'required' => true,
        'value' => 'site/templates/ThemeUikitMaster/assets/fontawesome/css/all.css',
      ],[
        'name' => 'json',
        'label' => 'Path to JSON',
        'type' => 'text',
        'notes' => 'Relative to site root (' . $this->config->paths->root . ')',
        'required' => true,
        'value' => 'site/templates/ThemeUikitMaster/assets/fontawesome/metadata/icons.json',
      ],
    ]);
  }
}
