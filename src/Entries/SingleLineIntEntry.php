<?php

namespace Chessfy\Trf\Entries;

class SingleLineIntEntry extends SingleLineEntry
{
    public function __construct($din, $fieldname)
    {
        parent::__construct($din, $fieldname);
        $this->fieldname = $fieldname;
    }

    public function parse($data)
    {
        return intval($data);
    }
}
