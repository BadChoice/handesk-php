<?php

namespace BadChoice\Handesk;

use Carbon\Carbon;

class Handesk{

    public static $url      = "http://handesk.dev/api";
    public static $apiToken = 'the-api-token';

    protected $attributes   = [];
    protected $dates        = ["created_at", "updated_at"];
    protected $objects      = [];

    public static function setup($url, $apiToken){
        static::$url = $url;
        static::$apiToken= $apiToken;
    }

    public function __construct($attributed = []){
        $this->attributes = $attributed;
    }

    public function __get($value){
        try {
            if (in_array($value, $this->dates)) {
                return Carbon::parse($this->attributes[$value]);
            }
            if(in_array($value, $this->objects)){
                return (object) $this->attributes[$value];
            }
            return $this->attributes[$value];
        }catch(\Exception $e){
            dd($this->attributes,$value);
        }
    }

}