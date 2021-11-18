<?php

use Chessfy\Trf\Tournament;
use Chessfy\Trf\Trf;

it('loads', function () {
    $trf = new Trf();
    $tour = $trf->loads('hola');
    $tour->name = 'hi';
    $this->assertInstanceOf(Tournament::class, $trf->loads('hola'));
});

it('dumps', function () {
    $trf = new Trf();
    $tour = $trf->loads('hola');

    $this->assertIsString($trf->dumps($tour));
});

it('loadtrf', function () {
    $trf = new Trf();

    //$tour = $trf->load(__DIR__."/data/real.trf");
    //dd($tour);

    // dd($trf->dumps($tour));
    $this->assertInstanceOf(Tournament::class, $trf->load(__DIR__."/data/real.trf"));
});

it('dump', function () {
  $trf = new Trf();
  $fp = tmpfile();
  $tour = $trf->load(__DIR__."/data/real.trf");
  $a = $trf->dump($fp,$tour);

  // dd($a);

  // dd($trf->dumps($tour));
  $this->assertInstanceOf(Tournament::class, $trf->load(__DIR__."/data/real.trf"));
});

it('players', function () {
  $trf = new Trf();
  $tour = $trf->load(__DIR__."/data/real.trf");
  $players = [];
  foreach ($tour->players as $player) {
    $players[] = ($player->name. ' - '. $player->points);
    // dd($player);
  }
  $fp = tmpfile();
  $a = $trf->dump($fp,$tour);

  dd($a);

  dd($players);
  $this->assertIsArray($players);
});