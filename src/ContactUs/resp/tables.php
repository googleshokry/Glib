<?php
/**
 * Created by PhpStorm.
 * User: engshokry
 * Date: 15/05/18
 * Time: 04:33 م
 */
namespace Glib\Contact;

class Tables
{


    const tables = ['contact_us'=>0];


    public static function getFields(string $table):array
    {
        return static::$table();

    }
    protected static function contact_us(): array
    {
        $fields = [
            "route"=>"ff.ssd",
            "table"=>Tables::tables['contact_us'],
            "method"=>"post",
            [
                'name' => [
                'type' => "text",
                'min' => 3,
                'max' => 3,
                ],
                'phone' => [
                'type' => "number",
                    'min' => '',
                    'max' => 3,
                ],
                'cv' => [
                'type' => "file",
                    'min' => 3,
                    'max' => '',
                ],
                'email' => [
                'type' => "email",
                    'min' => 3,
                    'max' => 3,
                ]
            ]
            ,

        ];
        return $fields;
    }
}