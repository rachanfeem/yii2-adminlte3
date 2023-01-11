<?php

namespace rachanfeem\adminlte3\assets;

use yii\web\AssetBundle;

class AdminLteAsset extends AssetBundle
{
    public $sourcePath = '@vendor/rachanfeem/yii2-adminlte3/src/dist';

    public $css = [
        'css/adminlte.min.css'
    ];

    public $js = [
        'js/adminlte.min.js'
    ];

    public $depends = [
        'rachan\adminlte3\assets\BaseAsset',
        'rachan\adminlte3\assets\PluginAsset'
    ];
}
