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
      'title' => 'RockAwesome', // Module Title
      'summary' => 'FontAwesome Icon Chooser', // Module Summary
      'version' => '0.0.3',
      'icon' => 'star-o',
      'requires' => ['FieldtypeRockAwesome'],
    ];
  }

  /**
   * Init module
   */
  public function init() {
    $this->stylesheet = $this->config->paths->root . $this->stylesheet;
    if(!is_file($this->stylesheet)) throw new WireException("Stylesheet not found");
    $style = str_replace($this->config->paths->root, $this->config->urls->root, $this->stylesheet);
    $this->config->styles->add($style);

    $this->setIcons();

    $this->addHookBefore("render", function($event) {
      $n = $event->object->notes ? "\n" : "";
      $notes = $n.__("Start typing to find icons");

      $orgoto = __("or go to the icon cheatsheet");
      $notes .= $this->link
        ? " [$orgoto]({$this->link})."
        : "...";

      $event->object->notes .= $notes;
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
    $id = uniqid();
    $out = "<div class='RockAwesome ra_$id'>"
      ."<div class='uk-inline uk-width-1-1'>"
        ."<span class='uk-form-icon'><i></i></span>"
        ."<input $attrStr />"
      ."</div>"
      ."<div class='icons uk-margin-small-top uk-child-width-1-1 uk-child-width-1-2@s uk-child-width-1-3@m uk-child-width-1-4@l' uk-grid></div>"
    ."</div>"
    ."<script>$('.ra_$id input').change();</script>";
    return $out;
  }

  /**
   * Set JS array of all icons
   * @return void
   */
  public function ___setIcons() {
    $this->json = $this->config->paths->root . $this->json;
    if(!is_file($this->json)) throw new WireException("Json file not found");
    $json = json_decode(file_get_contents($this->json));
    
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
