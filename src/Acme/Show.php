<?php
namespace App\Acme;

class Show
{
    public function __construct()
    {

    }


    public function render()
    {
        $path = __DIR__ . '/../movies.php';
        
        try {
            if( !file_exist($path) ) {
                throw 'Hello, Kitty';
            }

            require $path;
        } catch (\Throwable $th) {
            
        }
    }
}