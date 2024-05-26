<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class GameController extends Controller
{
    public function index()
    {
        $score = Session::get('score', 0);
        if (Auth::check()) {
            if (Auth::user()->score > $score) {
                $score = Auth::user()->score;
            }
            Session::put('score', $score);
        }

        return view('game', compact('score'));
    }

    public function play(Request $request)
    {
        $userChoice = $request->input('choice');
        $choices = ['rock', 'paper', 'scissors'];
        $computerChoice = $choices[array_rand($choices)];

        $result = $this->determineWinner($userChoice, $computerChoice);

        // Fetch the current score
        $score = Session::get('score', 0);


        // Update the score if the user wins
        if ($result === 'You win!') {
            $score += 1;
            Session::put('score', $score);
        }

        // Store the game result in the session
        Session::flash('game_data', [
            'userChoice' => $userChoice,
            'computerChoice' => $computerChoice,
            'result' => $result,
        ]);

        // Redirect to avoid form resubmission on refresh
        return redirect()->route('homegame');
    }

    private function determineWinner($userChoice, $computerChoice)
    {
        if ($userChoice === $computerChoice) {
            return 'It\'s a tie!';
        }

        if (($userChoice === 'rock' && $computerChoice === 'scissors') ||
            ($userChoice === 'paper' && $computerChoice === 'rock') ||
            ($userChoice === 'scissors' && $computerChoice === 'paper')
        ) {
            return 'You win!';
        }

        return 'You lose!';
    }
    public function reset()
    {
        // Reset the score
        Session::put('score', 0);
        $user = Auth::user();
        $user->score = 0;
        $user->save();


        // Redirect to the home game page
        return redirect()->route('homegame');
    }

    public function saveScore()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $score = Session::get('score', 0);
            $user->score = $score;
            $user->save();

            return redirect()->route('homegame')->with('status', 'Score saved successfully!');
        } else {
            return redirect()->route('register');
        }
    }
}
