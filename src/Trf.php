<?php

namespace Chessfy\Trf;

use Chessfy\Trf\Entries\Entry;

class Trf
{
    public function dump($fp, Tournament $tournament)
    {
        // Dumps the tournament and saves the trf in the file fp points to
        
        $this->_dump_tournament($fp, $tournament);
        $tmpfile_path = stream_get_meta_data($fp)['uri'];
        return fread($fp, filesize($tmpfile_path));
    }

    public function dumps(Tournament $tournament)
    {
        // Dumps the tournament and returns the trf
        $fp = tmpfile();
        $tmpfile_path = stream_get_meta_data($fp)['uri'];
        $this->_dump_tournament($fp, $tournament);
        return fread($fp, filesize($tmpfile_path));
    }

    public function load($fp): Tournament
    {
        // Parses the trf file fp points to and returns it as a tournament
        $file = fopen($fp, "r");
        $str_content = fread($file, filesize($fp));

        return $this->_parse_tournament(explode("\n", $str_content));
    }

    public function loads(string $s): Tournament
    {
        // Parses the trf in s and returns it as a tournament

        return $this->_parse_tournament(explode('\n', $s));
    }

    public function _dump_tournament($fp, $tournament)
    {
        $entryObj = new Entry();
        $tmpfile_path = stream_get_meta_data($fp)['uri'];

        foreach ($entryObj->getEntries() as $entry) {
            $entry->dump($fp, $tournament);
        }

        foreach ($tournament->xx_fields as $key => $value) {
            $tmpfile_content = file_get_contents($tmpfile_path)."{$key} {$value}\n";

            fwrite($fp, $tmpfile_content);
            fseek($fp, 0);
        }
    }

    public function _parse_tournament($lines): Tournament
    {
        $tournament = new Tournament();
        $entryObj = new Entry();
        foreach ($lines as $line) {
            foreach ($entryObj->getEntries() as $entry) {
                if (str_starts_with($line, $entry->din . ' ')) {
                    $entry->load($tournament, substr($line, 4));                    
                    break;
                }
            }
            if (str_starts_with($line, 'XX')) {
                list($field, $value) = explode(' ', $line, 2);
                $tournament->xx_fields[$field] = trim($value);
            }
        }

        return $tournament;
    }
}
