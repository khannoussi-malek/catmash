<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cat;


class CatController extends Controller
{

    public function start()
    {
        $firstCat = Cat::inRandomOrder()->first();
        $rangeStep = 50;
        $eloRange = [$firstCat->rank - $rangeStep, $firstCat->rank + $rangeStep];
        $secondCat = Cat::whereBetween('rank', $eloRange)
        ->where('id', '!=', $firstCat->id)
        ->orderByRaw("ABS('rank' - ".$firstCat->rank.")")
        ->first();
        while(!$secondCat){
            $rangeStep =$rangeStep+ 50;
            $eloRange = [$firstCat->rank - $rangeStep, $firstCat->rank + $rangeStep];
                $secondCat = Cat::whereBetween('rank', $eloRange)
                ->orderByRaw("ABS('rank' - ".$firstCat->rank.")")
                ->first();
        }

        return view('start',['firstCat' => $firstCat, 'secondCat' => $secondCat]);
    }

    public function firstCat($firstCat,$secondCat)
    {
        // calculate elo of first cat and second cat
        /* Assigning the value of `secondCat` to `` */
        $oldCat = $secondCat;
        $firstCat = Cat::find($firstCat);
        $secondCat = Cat::find($secondCat);
        $expectedProbabilityWinner = round(1 / (1 + pow(10, ($firstCat->rank - $secondCat->rank) / 400)));
        $expectedProbabilityLoser = round(1 / (1 + pow(10, ($secondCat->rank - $firstCat->rank) / 400)));
        $newRankWinner = round($firstCat->rank + 32 * (1 - $expectedProbabilityWinner));
        $newRankLoser = round($secondCat->rank + 32 * (-1 - $expectedProbabilityLoser));
        Cat::where('id', $firstCat->id)->update(['rank' => $newRankWinner]);
        Cat::where('id', $secondCat->id)->update(['rank' => $newRankLoser]);
        $firstCat = Cat::find($firstCat->id);
        $rangeStep = 50;
        $eloRange = [$firstCat->rank - $rangeStep, $firstCat->rank + $rangeStep];

        $secondCat = Cat::whereBetween('rank', $eloRange)
            ->where('id', '!=', $firstCat->id)
            ->where('id', '!=', $oldCat)
            ->orderByRaw("ABS('rank' - ".$firstCat->rank.")")
            ->first();

        while(!$secondCat){
            $rangeStep =$rangeStep+ 50;
            $eloRange = [$firstCat->rank - $rangeStep, $firstCat->rank + $rangeStep];
                $secondCat = Cat::whereBetween('rank', $eloRange)
                    ->where('id', '!=', $firstCat->id)
                    ->where('id', '!=', $oldCat)
                    ->orderByRaw("ABS('rank' - ".$firstCat->rank.")")
                    ->first();
        }

        return view('start',['firstCat' => $firstCat, 'secondCat' => $secondCat]);
    }
}
