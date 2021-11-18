<?php

namespace Chessfy\Trf\Entries;

class TeamEntry extends TrfEntry
{
    public function __construct()
    {
        parent::__construct('013');
    }

    public function dump($fp, $tournament)
    {
        // for team in tournament.teams:
        // 	startranks = ' '.join(f'{s:>4}' for s in team.startranks)
        // 	fp.write(f'013 {team.name:32} {startranks}\n')
    }

    public function load($tournament, $data)
    {
        // name = data[:32].strip()
        // 	startranks = [int(s) for s in data[32:].strip().split() if s]
        // 	tournament.teams.append(Team(name, startranks))
    }
}
