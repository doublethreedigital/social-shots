<?php

return [

    'collections' => [
        'pages' => [ // collection handle
            'page' => [ // blueprint handle
                'og_image' => 'open_graph',
                'twitter_image' => 'twitter',
            ],
        ],
    ],

    'storage' => [
        'container' => 'assets',
        'directory' => 'social-images',
    ],

];
