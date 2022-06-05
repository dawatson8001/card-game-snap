@extends('layouts.base')

@section('content')

    <div class="row mt-2">
        <div class="col-12 text-center">
        <h1 class="mt-5 text-center">Let's play Snap!</h1>
            <img id="card-start" class="mt-3" src="{{ url('images/playing_cards/card-start.jpg') }}" alt="Card Table">
        </div>
    </div>

    <div id="winner_container" class="row mt-5" style="display:none;">
        <div class="col-12 text-center">
            <h1 id="winning_player" class="mt-5 text-center"></h1>
        </div>
    </div>

    @php $colSize = 12 / count($playerCards); @endphp

    <div class="row mt-5">
        @foreach($playerCards as $player => $card)
            <div class="col-{{$colSize}} text-center">
                <h2 class="text-center">Player {{$player}}</h2>
                <img id="player_{{$player}}_card" class="mt-3 card-images" src="{{ url('images/playing_cards/cards').'/'.$currentCards[$player].'.png' }}" alt="">
            </div>
        @endforeach
    </div>

@endSection

@section('scripts')
    <script>
        let winner = false,
            failSafe = 0,
            currentPlayer = 1,
            usedCards = [],
            playerCards = {!! json_encode($playerCards) !!};

            dealCards();

        function dealCards()
        {
            setInterval(() => {
                let playersLeft = 0;
                
                if (playerCards[currentPlayer].length > 0) {
                    let card = playerCards[currentPlayer][0];
                    console.log('Played Card: ', card);
                    document.getElementById('player_'+currentPlayer+'_card').src = 'images/playing_cards/cards/'+card+'.png';

                    usedCards.push(playerCards[currentPlayer][0]);
                    playerCards[currentPlayer].shift()

                    let lastCard = (usedCards.length > 1) ? usedCards[usedCards.length-2].split('_')[1] : 0,
                        currentCard = card.split('_')[1];

                    if (lastCard === currentCard) {
                        console.log('Last Card: ', lastCard, 'Current Card: ', currentCard);
                        playerCards[currentPlayer] = playerCards[currentPlayer].concat(usedCards);
                        usedCards = [];
                    } 
                    else {
                        currentPlayer++;

                        if (currentPlayer > Object.keys(playerCards).length  ) {
                            currentPlayer = 1;
                        }
                    }

                    for (let i = 1; i <= Object.keys(playerCards).length; i++) {
                        if (playerCards[i].length > 0) {
                            playersLeft++;
                        }
                    }

                    if (playersLeft < 2) {
                        console.log('Player Cards: ', playerCards)
                        winner = true;
                    }
                }
                failSafe++;

                if (!winner && failSafe < 50) {
                    dealCards();
                } 
                else {
                    if (winner) {
                        winnerText = 'Player '+currentPlayer+' Wins!!';
                    }
                    else {
                        winnerText = 'Looks like a draw, try again!';
                    }

                    document.getElementById('winning_player').innerHTML = winnerText;
                    document.getElementById('winner_container').style.display='block';
                }
            }, 2000);
        }
    </script>
@endSection