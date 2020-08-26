<?php namespace ProcessWire;
class InputfieldRockAwesomeConfig extends ModuleConfig {
  public function __construct() {
    $this->add([
      [
        'type' => 'markup',
        'label' => 'HowTo',
        'icon' => 'question',
        'value' => 'Go to <a href="https://fontawesome.com/download">https://fontawesome.com/download</a> and download your version of FA. Then copy the CSS and METADATA folder to your website and set the paths below.',
      ],[
        'name' => 'stylesheet',
        'label' => 'Path to Stylesheet',
        'type' => 'text',
        'notes' => 'Relative to site root (' . $this->config->paths->root . ')',
        'required' => true,
        'value' => 'site/templates/fontawesome/css/all.css',
      ],[
        'name' => 'json',
        'label' => 'Path to JSON',
        'type' => 'text',
        'notes' => 'Relative to site root (' . $this->config->paths->root . ')',
        'required' => true,
        'value' => 'site/templates/fontawesome/metadata/icons.json',
      ],[
        'name' => 'link',
        'label' => 'Link to Icon Cheatsheat',
        'type' => 'URL',
        'required' => false,
        'value' => 'https://fontawesome.com/cheatsheet/pro',
      ],
    ]);
  }
}
