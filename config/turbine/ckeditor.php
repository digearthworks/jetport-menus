<?php

return [
    'grapejs' => [

        'position' => 'right',
        'options' => [
            'startupFocus' => true,
            'allowedContent' => true,
            //'extraAllowedContent' => '*(*);*[*];ul ol li span', // allows classes, inline styles and certain elements
            'enterMode' => 'CKEDITOR.ENTER_BR',
            'extraPlugins' => 'sharedspace,justify,colorbutton,font',
            'toolbar' => [
                ['Bold', 'Italic', 'Underline', 'Strike', 'Undo', 'Redo'],
                [
                    'name' => 'links',
                    'items' => ['Link', 'Unlink'],
                ],
                [
                    'name' => 'styles',
                    'items' => ['FontSize'],
                ],
                [
                    'name' => 'paragraph',
                    'groups' => ['list', 'indent', 'blocks', 'align'],
                    'items' => ['NumberedList', 'BulletedList', 'Blockquote', '-', 'Outdent', 'Indent', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-'],
                ],
                [
                    'name' => 'colors',
                    'items' => ['TextColor', 'BGColor'],
                ],
            ],
        ],
    ],
];
