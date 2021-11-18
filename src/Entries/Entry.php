<?php

namespace Chessfy\Trf\Entries;

class Entry
{
    public array $entries;

    public function __construct()
    {
      $this->setEntries([
        new SingleLineEntry('012', 'name'),
        new SingleLineEntry('022', 'city'),
        new SingleLineEntry('032', 'federation'),
        new SingleLineEntry('042', 'startdate'),
        new SingleLineEntry('052', 'enddate'),
        new SingleLineIntEntry('062', 'numplayers'),
        new SingleLineIntEntry('072', 'numratedplayers'),
        new SingleLineIntEntry('082', 'numteams'),
        new SingleLineEntry('092', 'type'),
        new SingleLineEntry('102', 'chiefarbiter'),
        new SingleLineEntry('112', 'deputyarbiters'),
        new SingleLineEntry('122', 'rateofplay'),
        new SingleLineListEntry('132', 'rounddates', ' '),
        new TeamEntry(),
        new PlayerEntry(),
      ]);
    }

    public function setEntries($entries)
    {
        $this->entries = $entries;
    }

    public function getEntries()
    {
        return $this->entries;
    }
}
