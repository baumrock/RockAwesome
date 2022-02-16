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
                'name' => 'version',
                'label' => 'Exakte Version der installierten FontAwesome-Dateien',
                'type' => 'text',
                'notes' => 'Zur Abfrage der verfügbaren Icons, z.B. 6.0.0-beta3',
                'required' => true,
                'value' => '6.0.0-beta3',
            ],[
                'name' => 'styles',
                'label' => 'Verfügbare Styles',
                'type' => 'Fieldset',
                // 'notes' => 'Verfügbar: '.$this->styles->fas,
                // 'required' => true,
                // 'value' => '6.0.0-beta3',
                'children' => [
                    [
                        'type' => "checkbox",
                        'label' => "Solid",
                        'name' => "fas",
                        'columnWidth' => 16,
                        'value' => true,
                    ],
                    [
                        'type' => "checkbox",
                        'label' => "Regular",
                        'name' => "far",
                        'columnWidth' => 16,
                    ],
                    [
                        'type' => "checkbox",
                        'label' => "Light",
                        'name' => "fal",
                        'columnWidth' => 16,
                    ],
                    [
                        'type' => "checkbox",
                        'label' => "Thin",
                        'name' => "fat",
                        'columnWidth' => 16,
                    ],
                    [
                        'type' => "checkbox",
                        'label' => "Duotone",
                        'name' => "fad",
                        'columnWidth' => 16,
                    ],
                    [
                        'type' => "checkbox",
                        'label' => "Brands",
                        'name' => "fab",
                        'columnWidth' => 20,
                    ],
                ],
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
