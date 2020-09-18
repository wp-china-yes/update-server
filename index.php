<?php
/**
 * Update-Server
 *
 * @copyright  Copyright (c) 2020 - WP-China-Yes
 * @license    http://www.gnu.org/licenses/gpl-3.0.html  GPLv3 License
 */
define('NEW_VERSION', '2.1.0');

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://api.wordpress.org/plugins/update-check/1.1/');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);
$response_str = curl_exec($ch);
curl_close($ch);

$plugins = json_decode($_POST['plugins'], true)['plugins'];
foreach ($plugins as $key => $plugin) {
    $plugin_index = explode('/', $key)[1];
    if ($plugin['Name'] === 'WP-China-Yes') {
        if (version_compare(NEW_VERSION, $plugin['Version'], '>')) {
            $response_array = json_decode($response_str, true);
            $response_array['plugins']['wp-china-yes/'.$plugin_index] = [
                'id' => 'w.org/plugins/wp-china-yes',
                'slug' => 'wp-china-yes',
                'plugin' => 'wp-china-yes/'.$plugin_index,
                'new_version' => NEW_VERSION,
                'url' => 'https://wordpress.org/plugins/wp-china-yes/',
                'package' => 'http://downloads.wordpress.org/plugin/wp-china-yes.' . NEW_VERSION . '.zip',
                'icons' => [
                    '1x' => 'https://ps.w.org/wp-china-yes/assets/icon-128x128.jpg'
                ],
                'banners' => [],
                'banners_rtl' => [],
                'tested' => '5.4.1',
                'requires_php' => '5.6',
                'compatibility' => []
            ];

            echo json_encode($response_array, JSON_UNESCAPED_UNICODE);
            exit;
        }
    }
}

echo $response_str;