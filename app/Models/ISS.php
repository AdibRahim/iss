<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ISS extends Model
{
    use HasFactory;

    protected String $name;
    protected int $id;
    protected float $latitude;
    protected float $longitude;
    protected float $altitude;
    protected float $velocity;
    protected string $visibility;
    protected float $footprint;
    protected int $timestamp;
    protected float $daynum;
    protected float $solar_lat;
    protected float $solar_lon;
    protected string $units;

    public function ISS(){
      $name;
      $id;
      $latitude;
      $longitude;
      $altitude;
      $velocity;
      $visibility;
      $footprint;
      $timestamp;
      $daynum;
      $solar_lat;
      $solar_lon;
      $units;
    }
}
