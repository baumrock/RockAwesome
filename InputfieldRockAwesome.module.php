<?php namespace ProcessWire;
/**
 * Inputfield for selecting Fontawesome Icons
 *
 * @author Bernhard Baumrock, 20.11.2019
 * @license Licensed under MIT
 * @link https://www.baumrock.com
 */
class InputfieldRockAwesome extends InputfieldText {

  public static function getModuleInfo() {
    return [
      'title' => __('RockAwesome', __FILE__), // Module Title
      'summary' => __('FontAwesome Icon Chooser', __FILE__), // Module Summary
      'version' => '0.0.1',
      'icon' => 'star-o',
      'requires' => ['FieldtypeRockAwesome'],
    ];
  }

  /**
   * Init module
   */
  public function init() {
    $style = $this->config->urls->templates . "ThemeUikitMaster/assets/fontawesome/css/all.css";
    $this->config->styles->add($style);
    $this->setIcons();

    $this->addHookBefore("render", function($event) {
      $n = $event->object->notes ? "\n" : "";
      $event->object->notes .= $n."Start typing to find icons...";
    });
  }

  /**
   * Render Inputfield
   * 
   * @return string
   * 
   */
  public function ___render() {
    $attrStr = $this->getAttributesString();
    $out = "<div class='RockAwesome'>"
      ."<div class='uk-inline uk-width-1-1'>"
        ."<span class='uk-form-icon'><i></i></span>"
        ."<input $attrStr />"
      ."</div>"
      ."<div class='icons uk-margin-small-top uk-child-width-1-1 uk-child-width-1-2@s uk-child-width-1-3@m uk-child-width-1-4@l' uk-grid></div>"
    ."</div>";
    return $out;
  }

  /**
   * Set JS array of all icons
   * @return void
   */
  public function ___setIcons() {
    $json = $this->config->paths->templates . 'ThemeUikitMaster/assets/fontawesome/metadata/icons.json';
    $json = json_decode(file_get_contents($json));
    
    // $out = "<div class='RockAwesomeIcons uk-margin uk-child-width-1-2 uk-child-width-1-3@m uk-child-width-1-4@l' uk-grid>";
    $icons = [];
    foreach ($json as $icon => $value) {
      foreach ($value->styles as $style) {
        $icons[] = "fa{$style[0]} fa-$icon";
      }
    }
    
    $this->config->js('RockAwesome', $icons);
  }
}
