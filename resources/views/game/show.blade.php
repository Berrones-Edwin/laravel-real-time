@extends('layouts.app')
@push('styles')
    <style>
        @keyframes rotate{
            from{
                transform: rotate(0deg);
            }   
            to{

                transform: rotate(360deg);
            }

        }

        .refresh{
            animation: rotate 1.5s infinite linear;
        }
    </style>
@endpush


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Game</div>

                <div class="card-body">
                    <div class="text-center">
                        <img  class="refresh" src="{{ asset('img/circle.png') }}" alt="circle" id="circle" height="250" width="250">
                    </div>

                    <p class="display-1 d-none text-center text-primary" id="winner">
                        
                    </p>
                    <hr>

                    <div class="text-center">
                        <label for="" class="font-weight-bolt h5" >Yor Bet</label>
                        <select class="custom-select col-auto" name="" id="bet">
                            <option selected value="">Not In</option>

                            @foreach(range(1,12) as $number)

                                <option value="">{{ $number }}</option>
                            @endforeach
                        </select>
                        <hr>
                        <p class="font-weight-bol h5">Remaining Time</p>
                        <p id="timer" class="h5 text-danger">Waiting to start</p>
                        <hr>
                        <p id="result" class="h1"></p>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        const circle = document.getElementById('circle');
        const timer = document.getElementById('timer');
        const winnerEl = document.getElementById('winner');
        const betEl = document.getElementById('bet');
        const result = document.getElementById('result');

        Echo.channel('game')
            .listen('RemainingTimeChange',e=>{

                timer.innerText = e.time;
                
                circle.classList.add('refresh');
                winner.classList.add('d-none');
                
                result.innerText = '';
                
                result.classList.remove('text-success');
                result.classList.remove('text-danger');

                
            })
            .listen('WinnerNumberGenerated',e=>{

                circle.classList.remove('refresh');
                
                let winner = e.number;
                
                winnerEl.classList.remove('d-none');
                winnerEl.innerText = winner;
                

                let bet = betEl[betEl.selectedIndex].innerText;

                if(winner === bet){

                    result.innerText = 'YOU WIN';
                    result.classList.add('text-success');
                    
                }else{

                    result.innerText = 'YOU LOSER';
                    result.classList.add('text-danger');

                }

            })
    </script>
@endpush