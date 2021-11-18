<?php

namespace Chessfy\Trf;

class Team
{
    public string $name = '';
    public array $startranks;
}


class Tournament
{
    public string $name = '';
    public string $city = '';
    public string $federation = '';
    public string $startdate = '';
    public string $enddate = '';
    public int $numplayers = 0;
    public int $numratedplayers = 0;
    public int $numteams = 0;
    public string $type = '';
    public string $chiefarbiter = '';
    public string $deputyarbiters = '';
    public string $rateofplay = '';

    public array $rounddates = [];
    public array $players = [];
    public array $teams = [];
    public array $xx_fields = [];

    public function numrounds()
    {
        // An estemation of how many rounds where played in this tournament.
        if (in_array('XXR', $this->xx_fields)) {
            return intval($this->xx_fields['XXR']);
        }

        if ($this->rounddates) {
            return count($this->rounddates);
        }

        $totalgames = [];
        foreach ($this->players as $p) {
            array_push($totalgames, $p->games);
        }

        if (max(count($totalgames))) {
            return max(count($totalgames));
        } else {
            return count($this->players) - 1;
        }
    }
}
