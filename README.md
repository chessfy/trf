# TRF (PHP)
---
##### This repo is a clone of https://github.com/sklangen/TRF repository using php.
---

A parser and dumper for the fide approved tournament report format: trf
The trf file format is used by the [Fide](https://en.wikipedia.org/wiki/FIDE) to report tournament results and calculate elo ratings based on them.

- Specification: <https://www.fide.com/FIDE/handbook/C04Annex2_TRF16.pdf>
- Example: <http://ratings.fide.com/download/example1.txt>

## Simple usage exmaple

```php
use Chessfy\Trf\Trf;

$trf = new Trf();
$tour = $trf->load(__DIR__."/data/real.trf");
$players = [];
foreach ($tour->players as $player) {
    $players[] = ($player->name. ' - '. $player->points);
}
echo $tour->name;
dd($players);
```
