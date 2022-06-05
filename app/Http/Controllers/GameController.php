<?php

namespace App\Http\Controllers;

class GameController extends Controller
{
    private $players = 2;
    private $cardPacks = 1;

    public function start() 
    {
        $cards = $this->getShuffledCards($this->cardPacks);
        $playerCards = $this->dealCards($this->players, $cards);
        $currentCards = $this->getCurrentCards($this->players);

        return view('Game.table', [
            'playerCards' => $playerCards,
            'currentCards' => $currentCards,
        ]);
    }

    /**
     * Set the initial cards for the players
     * @param int $players
     * @return array $currentCards
     */
    private function getCurrentCards($players) 
    {
        $currentCards = array();

        for ($player = 1; $player <= $players; $player++) {
            $currentCards[$player] = 'card-back';
        }

        return $currentCards;
    }

    /**
     * Creates a shuffled array of cards
     * @param int $cardPacks
     * @return array $cardsArray
     */
    private function getShuffledCards($cardPacks)
    {
        if ($cardPacks <= 0) {
            dd('You need at least 1 pack of cards to play with.');
        }

        $cards = array();
        $cardTypes = array('hearts','diamonds','clubs','spades');

        //push cards in to the array as type_number
        for ($pack = 1; $pack <= $cardPacks; $pack++) {
            foreach ($cardTypes as $cardType) {
                for ($i = 1; $i <= 13; $i++) {
                    array_push($cards, $cardType.'_'.$i);
                }
            }
        }

        shuffle($cards);

        return $cards;
    }

    /**
     * Splits the cards between the players
     * @param int $players
     * @return array $playerCards
     */
    private function dealCards($players, $cards)
    {
        if ($players <= 1) {
            dd("More players needed to play.");
        }

        $playerCards = array();

        //add players to array
        for ($i = 1; $i <= $players; $i++) {
            $playerCards[$i] = array();
        }

        //loop through cards and players to deal cards
        $card = 0;
        while ($card < count($cards)) {
            for ($player = 1; $player <= $players; $player++) {
                array_push($playerCards[$player], $cards[$card]);
                $card++;
            }
        }

        //reverse so we are playing from the top of the deck
        foreach ($playerCards as $player => $playerCard) {
            $playerCards[$player] = array_reverse($playerCard);
        }

        return $playerCards;
    }
}
