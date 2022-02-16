<?php namespace ProcessWire;
class InputfieldRockAwesomeConfig extends ModuleConfig {
    public function __construct() {


        $url = 'https://api.fontawesome.com/';
        $query = ['query' => 'query { releases {version} }'];
        $http = new WireHttp();
        $response = $http->post($url, $query, ['use' => 'fopen', 'fallback' => 'socket']);
        $versions = []; $version_note = '';
        if($response !== false) {
            $releases = json_decode($response)->data->releases;
            foreach ($releases AS $r) {
                $versions[$r->version] = $r->version;
            }
            // $versions = array_reverse($versions);
        }
        if ($response===false || !count($versions)) {
            $versions[] = 'latest';
            $version_note = '**Error:** The available versions could not be retrieved from the Font Awesome API.';
        }



        $this->add([
            [
                'type' => 'markup',
                'label' => 'HowTo',
                'icon' => 'question',
                'value' => 'Go to <a href="https://fontawesome.com/download">https://fontawesome.com/download</a> and download your version of FA. Then copy the CSS folder to your website and set the path below.',
            ],[
                'name' => 'stylesheet',
                'label' => 'Path to Stylesheet',
                'type' => 'text',
                'notes' => 'Relative to site root (' . $this->config->paths->root . ')',
                'required' => true,
                'value' => 'site/templates/fontawesome/css/all.css',
            // ],[
            //     'name' => 'json',
            //     'label' => 'Path to JSON',
            //     'type' => 'text',
            //     'notes' => 'Relative to site root (' . $this->config->paths->root . ')',
            //     'required' => true,
            //     'value' => 'site/templates/fontawesome/metadata/icons.json',
            ],[
                'name' => 'fa_version',
                'label' => 'Font Awesome version',
                'type' => 'select',
                'notes' => $version_note,
                'required' => true,
                'options' => $versions,
                'columnWidth' => 50,
            ],[
                'name' => 'fa_membership',
                'label' => 'Font Awesome license type',
                'type' => 'select',
                'required' => true,
                'value' => 'free',
                'options' => [
                    '1' => 'free',
                    '2' => 'pro',
                ],
                'columnWidth' => 50,
            ],[
                'name' => 'styles',
                'label' => 'Available Styles',
                'type' => 'Fieldset',
                'notes' => 'Only these styles are displayed in the results list for selection.',
                // 'required' => true,
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
                'value' => 'https://fontawesome.com/icons',
            ],
        ]);
    }
}
