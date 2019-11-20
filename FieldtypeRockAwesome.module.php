<?php namespace ProcessWire;
/**
 * RockAwesome Fieldtype
 *
 * @author Bernhard Baumrock, 20.11.2019
 * @license Licensed under MIT
 * @link https://www.baumrock.com
 */
class FieldtypeRockAwesome extends FieldtypeText {

  public static function getModuleInfo() {
    return [
      'title' => 'RockAwesome',
      'version' => '0.0.1',
      'summary' => 'Field that stores a FontAwesome icon string',
      'icon' => 'star-o',
      'installs' => ['InputfieldRockAwesome'],
    ];
  }

  /**
   * Return the associated Inputfield
   * 
   * @param Page $page
   * @param Field $field
   * @return Inputfield
   *
   */
  public function getInputfield(Page $page, Field $field) {
    $inputField = $this->wire('modules')->get('InputfieldRockAwesome');
    return $inputField;
  }
}
