<?php

namespace App\Classes;

use App\Models\Configuration as ModelsConfiguration;

class Configuration
{

    private static $instance;

    private $configurationRecord;
    public $website_name;
    public $website_url;
    public $email;
    public $minuts_before_picks;
    public $allow_ties;
    public $create_mssing_picks;
    public $assig_role_to_user;
    public $require_points_in_picks;
    public $language;
    public $active;
    public $image;


    public function __construct()
    {
        $this->configurationRecord = ModelsConfiguration::first();
        $this->website_name = $this->configurationRecord->website_name;
        $this->website_url = $this->configurationRecord->website_url;
        $this->email = $this->configurationRecord->email;
        $this->minuts_before_picks = $this->configurationRecord->minuts_before_picks;
        $this->allow_ties = $this->configurationRecord->allow_ties;
        $this->create_mssing_picks = $this->configurationRecord->create_mssing_picks;
        $this->assig_role_to_user = $this->configurationRecord->assig_role_to_user;
        $this->require_points_in_picks = $this->configurationRecord->cfrequire_points_in_picksg;
        $this->language = $this->configurationRecord->language;
        $this->active = $this->configurationRecord->active;
        $this->image = $this->configurationRecord->image;
    }

    public static function getInstance(): self
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function get(string $key): mixed
    {
        return $this->data ?? null;
    }

    public function set(string $key, mixed $value): void
    {
        $this->data[$key] = $value;
    }


}
