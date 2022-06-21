<?php

/* return [
    'class' => 'yii\db\Connection',
    'dsn' => 'pgsql:host=ec2-54-80-122-11.compute-1.amazonaws.com;dbname=d18f4rkfq962br',
    'username' => 'wzscnovlyzmqrf',
    'password' => '5438f70176fb444417f6723a31a2c32b53c2caa57afaed378260b656e76038ca',
    'charset' => 'utf8',
    'schemaMap' => [
        'pgsql'=> [
            'class'=>'yii\db\pgsql\Schema',
            'defaultSchema' => 'public' 
        ]
    ], 
   
]; */

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'pgsql:host=localhost;dbname=BalconDelNorte2',
    'username' => "postgres",
    'password' => '152056',
    'charset' => 'utf8',
    'schemaMap' => [
        'pgsql'=> [
            'class'=>'yii\db\pgsql\Schema',
            'defaultSchema' => 'public' //specify your schema here
        ]
    ],
];
