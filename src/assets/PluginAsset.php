<?php

namespace rachan\adminlte3\assets;

use yii\web\AssetBundle;

class PluginAsset extends AssetBundle
{
    public $sourcePath = '@vendor/rachan/yii2-adminlte3/src/plugins';

    public $css = [
        'css' => [
            'icheck-bootstrap/icheck-bootstrap.css',
            'overlayScrollbars/css/OverlayScrollbars.min.css'
        ],
        'js' => [
            'overlayScrollbars/js/jquery.overlayScrollbars.min.js'
        ]
    ];

    public $depends = [
        'rachan\adminlte3\assets\BaseAsset'
    ];
}
