<?php

namespace solbianca\fias\console\controllers;

use solbianca\fias\console\base\Loader;
use solbianca\fias\console\components\ImportFiasComponent;
use solbianca\fias\console\components\UpdateFiasComponent;
use solbianca\fias\helpers\FileHelper;
use solbianca\fias\Module;
use yii\console\Controller;
use yii\di\Instance;
use yii\helpers\Console;

class FiasController extends Controller
{
    /**
     * Init fias data in base.
     * If given parameter $file is null try to download full file, else try to use given file.
     *
     * @param string|null $file
     *
     * @throws \Exception
     */
    public function actionInstall($file = null)
    {
        /** @var ImportFiasComponent $import */
        $import = Instance::ensure('importFias', ImportFiasComponent::class, Module::getInstance());
        $import->import($file);
    }

    /**
     * Update fias data in base
     *
     * @throws \Exception
     */
    public function actionUpdate()
    {
        /** @var UpdateFiasComponent $update */
        $update = Instance::ensure('updateFias', UpdateFiasComponent::class, Module::getInstance());
        $update->update();
    }

    /**
     * @throws \yii\base\InvalidConfigException
     * Clear directory for upload/extract files
     */
    public function actionClearDirectory()
    {
        /** @var Loader $loader */
        $loader    = Instance::ensure('loader', Loader::class, $this->module);
        $directory = $loader->fileDirectory;
        FileHelper::clearDirectory($directory);
        Console::output("Очистка каталога '{$directory}' завершена.");

    }

}