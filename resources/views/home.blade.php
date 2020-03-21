@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-12">

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-6 mb-3">
                            <input class="form-control form-control-lg mx-auto" id="searchInput" type="text" placeholder="Effectuer une recherche"> 
                        </div>
                        <div class="col-lg-4 mb-3">
                        
                        <input id="famille" list="familleList" type="text" placeholder="famille" class="form-control form-control-lg mx-auto">  
                            <datalist id="familleList">
                              @foreach($familles as $famille)
                                <option value="{{$famille->nom}}">
                              @endforeach
                            </datalist>  
                        
                        </div>
                        <div class="col-lg-2">
                            <select class="form-control-lg border border-muted" id="pour" name="pour">
                                @foreach($pourcentages as $pourcentage)
                                    <option value="{{ $pourcentage->id }}">{{ $pourcentage->pour }}</option> 
                                @endforeach
                            </select> 
                        </div>
                    </div>       
            </div>

            <div class="tableau" id="tableau"></div>

        </div>
    </div>
</div>

<script type="application/javascript">

    jQuery(function($){


    //setup before functions
    var typingTimer;                //timer identifier
    var doneTypingInterval = 300;  //time in ms, 5 second for example
    var input = $('#searchInput');
    var pourcentage = $('#pour');
    var famille = $('#famille');


    pourcentage.on('change', function () {
        doneTyping();
    });

    famille.on('keyup', function () {
        doneTyping();
    });


    //on keyup, start the countdown
    input.on('keyup', function () {
      clearTimeout(typingTimer);
      typingTimer = setTimeout(doneTyping, doneTypingInterval);
    });
    
    //on keydown, clear the countdown 
    input.on('keydown', function () {
      clearTimeout(typingTimer);
    });
    
    //user is "finished typing," do something
    function doneTyping () {
      //do something
        var searchInputValue = document.getElementById('searchInput').value;
        var pourcentage_pour = document.getElementById('pour').value;
        var familleValue = document.getElementById('famille').value;
        if(searchInputValue !== '' ){
        $.ajax({
            url:"{{ route('fetch.produit') }}",
            method:"GET",
            data:{searchInputValue: searchInputValue, pourcentage_pour: pourcentage_pour, famille: familleValue , _token: "{{ csrf_token() }}"},
            success:function(result)
            {
                $('#tableau').html(result);
            }
            });
        }else{
            console.log('something wrong');
        }
        }
    });

    </script>

@endsection
