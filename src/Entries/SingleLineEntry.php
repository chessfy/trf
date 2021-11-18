<?php

namespace Chessfy\Trf\Entries;

class SingleLineEntry extends TrfEntry
{
    public function __construct($din, $fieldname)
    {
        parent::__construct($din);
        $this->fieldname = $fieldname;
    }

    public function dump($fp, $tournament)
    {
        $value = get_object_vars($tournament)[$this->fieldname];
        $tmpfile_path = stream_get_meta_data($fp)['uri'];
        $tmpfile_content = file_get_contents($tmpfile_path)."{$this->din} {$value}\n";
        fwrite($fp, $tmpfile_content);
        fseek($fp, 0);
    }

    public function format($value)
    {
        return strval($value);
    }

    public function load($tournament, $data)
    {
        $value = $this->parse(trim($data));
        $tournament->{$this->fieldname} = $value;
    }

    public function parse($data)
    {
        return $data;
    }
}
