@extends('layouts.app')

@section('content')
@PHP($prix_unit = ceil(ceil($produit->prix_achat + ($produit->prix_achat * $pourcentage->pourcentage / 100))/10)*10)
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-12">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('inserer.vente', [$produit->id, $pourcentage]) }}">
                        @csrf

                        <div class="form-group row">
                            <label for="quantite" class="col-md-4 col-form-label text-md-right">{{ __('Quantité a vendre') }}</label>

                            <div class="col-md-6">
                                <input id="quantite" type="number" step="0.01" class="form-control" name="quantite" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nom_acheteur" class="col-md-4 col-form-label text-md-right">{{ __('Nom du client') }}</label>

                            <div class="col-md-6">
                                <input id="nom_acheteur" name="nom_acheteur" list="clients_list" type="text" class="form-control">  
                                <datalist id="clients_list">
                                @foreach($pourcentages as $client)
                                    <option value="{{$client->pour}}">
                                @endforeach
                                </datalist>  
                            </div>
                        </div>

                        

                        <div class="form-group row d-none" id="div_new_quantite">
                            <label for="new_quantite" class="col-md-4 col-form-label text-md-right">{{ __('Nouvelle quantité') }}</label>

                            <div class="col-md-6">
                                <input id="new_quantite" type="number" step="0.01" class="form-control" name="new_quantite" value="0" readonly required>
                            </div>
                        </div>
                        

                        <div class="form-group row d-none" id="div_nbr_boites">
                            <label for="nbr_boites" class="col-md-4 col-form-label text-md-right">{{ __('Nombre boites') }}</label>

                            <div class="col-md-6">
                                <input id="nbr_boites" type="number" class="form-control" name="nbr_boites" value="0" readonly required>
                            </div>
                        </div>


                        <div class="form-group row" id="div_prix_unite">
                            <label for="prix_unite" class="col-md-4 col-form-label text-md-right">{{ __('Prix unité') }}</label>

                            <div class="col-md-6">
                                <input id="prix_unite" type="number" class="form-control" name="prix_unite" value="{{$prix_unit}}" readonly required>
                            </div>
                        </div>

                        <div class="form-group row" id="div_prix_total">
                            <label for="prix_total" class="col-md-4 col-form-label text-md-right">{{ __('Prix total') }}</label>

                            <div class="col-md-6">
                                <input id="prix_total" type="number" step="0.01" class="form-control" name="prix_total" value="{{$prix_unit}}" readonly required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Ajouter la vente') }}
                                </button>
                                <button class="btn btn-danger" onclick="window.close()">Fermer</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="application/javascript">

var t = false
$('#quantite').focus(function () {
    var max = {{ $produit->quantite }};
    var $this = $(this)
    t = setInterval(
    function () {
        if (($this.val() < 1 || $this.val() > max) && $this.val().length != 0) {
            if ($this.val() < 1) {
                $this.val(1)
            }
            if ($this.val() > max) {
                $this.val(max)
            }
        }
    }, 50)
})

$('#quantite').blur(function () {
    if (t != false) {
        window.clearInterval(t)
        t = false;
    }
})


    jQuery(function($){
        
    var input = $('#quantite')

    input.on('keyup', function () {
        var quantite = input.val();
        var newQuantite = Math.ceil(quantite/{{$produit->colis}}) * {{$produit->colis}};
        if(newQuantite > {{ $produit->quantite }}){
            alert('Quantité insuffisante');
            input.val(1);
            newQuantite(1);

        }
        $('#div_new_quantite').addClass("d-none");
        $('#div_nbr_boites').addClass("d-none");
        $('#new_quantite').val(quantite);
        $('#nbr_boites').val(1);


        if(quantite != newQuantite){
            
          $('#new_quantite').val(newQuantite);
          $('#div_new_quantite').removeClass("d-none");

          $('#nbr_boites').val(newQuantite/{{$produit->colis}});
          $('#div_nbr_boites').removeClass("d-none");

          $('#prix_total').val(Math.ceil(Math.ceil(newQuantite*{{$prix_unit}})/10)*10);

        }else{
            $('#prix_total').val(Math.ceil(Math.ceil(quantite*{{$prix_unit}})/10)*10);
        }
        $('#nbr_boites').val(newQuantite/{{$produit->colis}});
        $('#div_nbr_boite').removeClass("d-none");

        
    });



    });
</script>

@endsection
