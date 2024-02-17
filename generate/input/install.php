<?php

// Exit if accessed directly.
if (!defined('ABSPATH')) exit;

// Create table class.
require_once |UNIQUESTRING|_PLUGIN_ABS_PATH . 'includes/core/create-table.php';

/**
 * The |UNIQUESTRING|BasisPluginClass class.
 *
 * This class runs when you activate the plugin.
 * In this place you can eg. create a custom table.
 */
class |UNIQUESTRING|BasisPluginClass
{

    private static $tableSlug = |UNIQUESTRING|_TABLE_SLUG;

    public static $data = [
        // https://mobile-magazine.com/articles/top-10-most-popular-personal-robots
        [
            'title'       => 'Aibo',
            'description' => 'Aibo is the ultimate virtual pet, and a fantastic demonstration of just how far this field has come. 
                This AI robot puppy is extremely curious, playful (coming with its own little toys) and friendly. In fact, Aibo actually translates as the Japanese word for ‘friend’.
                It can independently wander about your home, then when it’s with you, it can play, speak and do tricks. And what’s more, your Aibo’s facial recognition software will mean that, not only does it actively engage with people, but over time it can also identify the face of its owner.',
            'status'      => 'publish',
        ],
        [
            'title'       => 'Jibo',
            'description' => 'Jibo has precisely been designed to support the fields of children’s education, telehealth and hospitals. 
                This sophisticated companion robot is most commonly used to support elderly or chronically ill patients, help to care for anyone receiving long-term hospital treatment, or to assist with education, particularly for children with special educational needs.',
            'status'      => 'publish',
        ],
        [
            'title'       => 'Misa',
            'description' => 'Beyond being a sweet, friendly addition to the family, Misa is a family robot that can help you to manage the family calendar and enhance your children’s home learning. 
                Through its Misa Connect software, this intelligent little bot can respond to your voice, manage your calendar and even offer you health and nutritional advice. In addition to these useful features, it is also built with a high quality visual display, designed to take home schooling to another level.',
            'status'      => 'publish',
        ],
        [
            'title'       => 'Misty',
            'description' => 'Misty is a personal social robot, which is also designed to assist with business tasks. 
                Alongside its friendly face and big round eyes, Misty can record audio, act on your voice commands, stream videos, and even collect and share data. 
                Misty is also equipped with a camera, which gives it its in-built facial recognition capabilities.',
            'status'      => 'publish',
        ],
        [
            'title'       => 'Willow',
            'description' => 'Willow is a multi-purpose personal robot, which can tick both the boxes of household chores and companionship. 
                Willow’s primary purpose is to autonomously mow lawns, without the need for wires, or even perimeter cables. It also has the ability to shred and collect leaves, guard your property at night, and sweeping your patio. 
                Its abilities can be expanded even further, as you can use your phone or computer to teach Willow new jobs.',
            'status'      => 'publish',
        ],
        [
            'title'       => 'Eilik',
            'description' => 'Eilik is a small companion robot, which embodies its slogan ‘tech with heart’. 
                With its charming personality and perceptive emotional responses, the robot is designed to be a little household pal.
                And one of the qualities that makes it unique is the shared nature of its interactions with you. For instance, Eilik doesn’t like being picked up, unless it’s by you.',
            'status'      => 'publish',
        ],
        [
            'title'       => 'Lovot',
            'description' => '‘Powered by love’, the Lovot is a companion robot that is simply designed to help its user to feel happy.
                The Lovot robot has a highly sophisticated level of emotional awareness, including the ability to provide caring companionship, understand and respond to moods, and to learn how best to make users happy.',
            'status'      => 'trash',
        ],
        [
            'title'       => 'Unitree Go1',
            'description' => 'Unitree Go1 is the world’s first bionic companion robot.
                With its AI human recognition, side-follow system and sensory system, it is a remarkable piece of technology.
                Through this software and its flexible, adaptive joints, the Unitree Go1 behaves, walks with and responds to its owner exactly like a real dog.',
            'status'      => 'trash',
        ],
    ];

    public static function activate()
    {

        // Set option for rewrite rules CPT.
        self::createOptionForActivation();

        // Create table.
        global $wpdb;

        // Table name.
        $tableName    = $wpdb->prefix . self::$tableSlug;

        $productTable = new |UNIQUESTRING|CreateTable( $tableName );

        /**
         *  Add some columns.
         */
            // title
            $productTable->varchar( 'title', 200, true, 'text' );

            // longtext
            $productTable->longtext( 'description' );

            // statue
            $productTable->varchar( 'status', 20, true, 'publish' );

            // created
            $productTable->datetime( 'created_at' );

        // Create an "id" column as AUTO_INCREMENT
        $productTable->create_columns();

        // Create table.
        $tableCreated = $productTable->createTable();

        // If the table has been created - insert a dummy data.
        if ($tableCreated == 1) {

            foreach (self::$data as $value) {
                
                $wpdb->insert(

                    $tableName,
    
                    [
                        'title'       => $value['title'],
                        'description' => $value['description'],
                        'status'      => $value['status'],
                        'created_at'  => date('Y-m-d H:i:s'),
                    ],
    
                    [
                        '%s',
                        '%s',
                        '%s',
                        '%s',
                    ]
    
                );

            }
        }
    }

    public static function deactivate()
    {

        // Rewrite rules via installation.
        flush_rewrite_rules();
    }

    /*
    * This function sets the option for CPT rewrite rules.
    */
    public static function createOptionForActivation()
    {

        add_option( '|uniquestring|_flush_rewrite_rules', 'go_flush_rewrite_rules' );
    }

}
