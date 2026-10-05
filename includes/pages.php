<?php
/**
 * サイト内の公開ページ一覧（サイトマップ生成の元データ）。
 *
 * ページを追加・削除したらここだけ直せばよい。
 * priority はサイトマップにおける相対的な重要度（0.0〜1.0）。
 */
return [
    ['path' => '/index.php',                          'priority' => '1.0'],
    ['path' => '/pages/progress.php',                 'priority' => '0.8'],
    ['path' => '/pages/gameinfo.php',                 'priority' => '0.8'],
    ['path' => '/pages/system.php',                   'priority' => '0.8'],
    ['path' => '/pages/cont.php',                     'priority' => '0.8'],
    ['path' => '/pages/contact.php',                  'priority' => '0.8'],
    ['path' => '/pages/copyright.php',                'priority' => '0.5'],
    ['path' => '/pages/gameinfos/connect.php',        'priority' => '0.9'],
    ['path' => '/pages/gameinfos/tools.php',          'priority' => '0.6'],
    ['path' => '/pages/gameinfos/wra.php',            'priority' => '0.7'],
    ['path' => '/pages/gameinfos/build-manual.php',   'priority' => '0.7'],
];
