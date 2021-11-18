<?php

namespace Chessfy\Trf\Entries;

use Chessfy\Trf\Game;
use Chessfy\Trf\Player;

class PlayerEntry extends TrfEntry
{
  public string $PLAYER_LINE_PATTERN = '/(?P<startrank>[ \d]{4}) (?P<sex>[\w ]) (?P<title>[\w ]{2}) (?P<name>.{33}) (?P<rating>[ \d]{4}) (?P<fed>[\w ]{3}) (?P<id>[ \d]{11}) (?P<birthdate>.{10}) (?P<points>[ \d.]{4}) (?P<rank>[ \d]{4})(?P<games>(?i:  [ \d]{4} [bsw\- ] [1=0+wdl\-hfuz ]| {10})*)\s*$/';

  public function __construct()
  {
    parent::__construct('001');
  }

  public function dump($fp, $tournament)
  {
    $tmpfile_path = stream_get_meta_data($fp)['uri'];

    foreach ($tournament->players as $player) {
      $this->dump_player($fp, $player);
      $tmpfile_content = file_get_contents($tmpfile_path) . "\n";
      fwrite($fp, $tmpfile_content);
      fseek($fp, 0);
    }
  }

  public function dump_player($fp, $player)
  {
    $tmpfile_path = stream_get_meta_data($fp)['uri'];
    $str = '001';
    $str .= str_pad($player->startrank, 5, ' ', STR_PAD_LEFT);
    $str .= str_pad($player->sex, 2, ' ', STR_PAD_LEFT);
    $str .= str_pad($player->title, 3, ' ', STR_PAD_LEFT);
    $str .= ' ';
    $str .= str_pad($player->name, 34, ' ', STR_PAD_RIGHT);
    $str .= ($player->rating != 0) ? str_pad($player->rating, 4, ' ', STR_PAD_RIGHT) : str_pad($player->rating, 4, ' ', STR_PAD_LEFT);
    $str .= str_pad($player->fed, 4, ' ', STR_PAD_LEFT);
    $str .= ($player->id != 0) ? str_pad($player->id, 12, ' ', STR_PAD_LEFT) : str_pad($player->id, 12, ' ', STR_PAD_LEFT);
    $str .= str_pad($player->birthdate, 5, ' ', STR_PAD_LEFT);
    $str .= str_pad(number_format($player->points,1), 11, ' ', STR_PAD_LEFT);
    $str .= str_pad($player->rank, 5, ' ', STR_PAD_LEFT);

    foreach ($player->games as $game) {
      $sr = ($game->startrank == 0) ? '0000' : $game->startrank;
      $str .= str_pad($sr, 6, ' ', STR_PAD_LEFT);
      $str .= str_pad($game->color, 2, ' ', STR_PAD_LEFT);
      $str .= str_pad($game->result, 2, ' ', STR_PAD_LEFT);
    }

    $tmpfile_content = file_get_contents($tmpfile_path) . $str;
    fwrite($fp, $tmpfile_content);
    fseek($fp, 0);
  }

  public function load($tournament, $data)
  {
    $match = null;
    preg_match($this->PLAYER_LINE_PATTERN, $data, $match);
    if (!$match) {
      throw new Exception('Player data not matching pattern. ' + $data);
    }

    $player = new Player();
    $player->startrank = intval($match['startrank']);
    $player->sex = $match['sex'];
    $player->title = trim($match['title']);
    $player->name = trim($match['name']);
    $player->rating = $this->int_or_default($match['rating'],0);
    $player->fed = trim($match['fed']);
    $player->id = (int) $this->int_or_default($match['id']);
    $player->birthdate = trim($match['birthdate']);
    $player->points = floatval($match['points']);
    $player->rank = $this->int_or_default($match['rank']);
    $player->games = $this->parse_games(rtrim(substr($match['games'], 2)));

    array_push($tournament->players, $player);
  }

  public function parse_games($string)
  {
    $round = 1;
    $games = [];
    while (strlen($string) >= 8) {
      $game = new Game();
      $game->startrank = (int) substr($string, 0, 4);
      $game->color = substr($string, 5, 1);
      $game->result = substr($string, 7, 1);
      $game->round = $round;
      $round++;
      $string = substr($string, 10);
      array_push($games, $game);
    }

    return $games;
  }

  public function int_or_default($string, $default = null)
  {
    if ($string == '' || ctype_space($string)) {
      return $default;
    }

    return intval($string);
  }
}
