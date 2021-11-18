<?php

namespace Chessfy\Trf;

class Game
{
    public int $startrank;
    public string $color;
    public string $result;
    public string $round;
}

class Player
{
    public int $startrank;
    public string $name = '';
    public string $sex = '';
    public string $title = '';
    public int $rating = 0;
    public string $fed = '';
    public int $timeout = 0;
    public int $id;
    public float  $points = 0;
    public int $rank;
    public array $games;

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getSex()
    {
        return $this->sex;
    }
}
