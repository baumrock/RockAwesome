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
      'version' => '0.0.5',
      'icon' => 'star-o',
      'requires' => ['FieldtypeRockAwesome'],
    ];
  }

  /**
   * Init module
   */
  public function init() {
    $this->stylesheet = $this->config->paths->root . $this->stylesheet;
    if(!is_file($this->stylesheet)) return;

    $style = str_replace($this->config->paths->root, $this->config->urls->root, $this->stylesheet);
    $this->config->styles->add($style);

    // Gewünschte Icon-Styles in JS bekannt machen
    $this->config->js('RockAwesomeVersion', $this->version);
    $this->config->js('RockAwesomeRegular', $this->far);
    $this->config->js('RockAwesomeSolid', $this->fas);
    $this->config->js('RockAwesomeLight', $this->fal);
    $this->config->js('RockAwesomeThin', $this->fat);
    $this->config->js('RockAwesomeDuotone', $this->fad);
    $this->config->js('RockAwesomeBrands', $this->fab);

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
      ."<div class='icons uk-margin-small-top uk-child-width-1-2 uk-child-width-1-3@s uk-child-width-1-4@m uk-child-width-1-6@l uk-grid-small' uk-grid></div>"
    ."</div>"
    ."<script>$('.ra_$id input').change();</script>";
    return $out;
  }

}
