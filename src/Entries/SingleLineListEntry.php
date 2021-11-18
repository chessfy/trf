<?php

namespace Chessfy\Trf\Entries;

class SingleLineListEntry extends SingleLineEntry
{
    public function __construct($din, $fieldname, $delim)
    {
        parent::__construct($din, $fieldname);
        $this->delim = $delim;
    }

    public function dump($fp, $tournament)
    {
        $value = get_object_vars($tournament)[$this->fieldname];
        $data = implode(' ', $value);
        $tmpfile_path = stream_get_meta_data($fp)['uri'];
        $tmpfile_content = file_get_contents($tmpfile_path)."{$this->din} {$data}\n";

        fwrite($fp, $tmpfile_content);
        fseek($fp, 0);
    }

    public function load($tournament, $data)
    {
        // $value = [self.parse(s) for s in data.strip().split(self.delim) if s]
    // $tournament.__dict__[self.fieldname] = value
    }
}
