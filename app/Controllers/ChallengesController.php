<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\View;

class ChallengesController extends Controller
{

    public function __invoke(): View
    {
        $start = 1;
        $end = 50;
        $filtered = array_filter(range($start, $end), static function ($number) {
            return $number % 3 === 0 || $number % 5 === 0;
        });
        session()->set('numbers', $filtered);

        $fibonacci = array_reduce(range(0, 20), static function ($sequence, $i) {
            if ($i < 2) {
                $sequence[] = $i;
            } else {
                $sequence[] = $sequence[$i - 1] + $sequence[$i - 2];
            }

            return $sequence;
        }, []);
        session()->set('fibonacci', $fibonacci);

        $primes = array_filter(range(2, 100), static function ($number) {
            for ($i = 2; $i < $number; $i++) {
                if ($number % $i === 0) {
                    return false;
                }
            }
            return true;
        });
        session()->set('primes', $primes);

        // display month names & the letter count in an associative array dynamically
        $months = array_map(static function ($month) {
            return [
                'month' => $month,
                'letter_count' => strlen($month),
            ];
        }, [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December',
        ]);
        session()->set('months', $months);

        return view("challenges", [
            'title' => 'Programming Challenges',
            'heading' => 'Programming Challenges for PHP Developers',
        ]);
    }

}