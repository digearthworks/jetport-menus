<?php

if (!function_exists('includeFilesInFolder')) {
    /**
     * Loops through a folder and requires all PHP files
     * Searches sub-directories as well.
     *
     * @param $folder
     */
    function includeFilesInFolder($folder)
    {
        try {
            $rdi = new RecursiveDirectoryIterator($folder);
            $it = new RecursiveIteratorIterator($rdi);

            while ($it->valid()) {
                if (!$it->isDot() && $it->isFile() && $it->isReadable() && $it->current()->getExtension() === 'php') {
                    require $it->key();
                }

                $it->next();
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}

if (!function_exists('includeRouteFiles')) {

    /**
     * @param $folder
     */
    function includeRouteFiles($folder)
    {
        includeFilesInFolder($folder);
    }
}

if (!function_exists('adminer_object')) {
    function adminer_object()
    {
        // required to run any plugin
        // include_once  base_path('/adminer/plugins/plugin.php');

        // autoloader
        foreach (glob(base_path('/adminer/plugins/*.php')) as $filename) {
            include_once "$filename";
        }

        $plugins = [
            // specify enabled plugins here
            // new AdminerDumpXml,
            // new AdminerTinymce,
            // new AdminerFileUpload("data/"),
            // new AdminerSlugify,
            // new AdminerTranslation,
            // new AdminerForeignSystem,
            // new AdminerDesigns;
            new AdminerTablesFilter,
            new AdminerFrames,
            new AdminerDumpAlter,
            new AdminerDumpJson,
            new AdminerJsonColumn,
        ];

        /* It is possible to combine customization and plugins:
        class AdminerCustomization extends AdminerPlugin {
        }
        return new AdminerCustomization($plugins);
        */

        return new AdminerPlugin($plugins);
    }
}
