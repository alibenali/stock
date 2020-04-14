<table class="table table-responsive-md">
    <thead>
      <tr>
        <th>ID</th>
        <th>Designation</th>
        <th>Fournisseur</th>
        <th>Categorie</th>
        <th>Quantité</th>
        <th>Prix Unit</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach($list as $produit)
      <tr>
        <td>{{$produit->id}}</td>
        <td>{{$produit->designation}}</td>
        <td>{{$produit->fournisseurs->nom_complet}} </td>
        <td>{{$produit->familles->nom}}</td>
        <td>{{$produit->quantite}}</td>
        <td>{{ceil(ceil($produit->prix_achat + ($produit->prix_achat * $pourcentage->pourcentage / 100)/10)*10)}}</td>

        <td>
          <button class="btn-success" onclick="window.open('{{ route('ajouter.vente', [$produit->id, $pourcentage->id]) }}', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=80,left=500,width=450,height=600');">Vendre</button>
          <button class="btn-primary mt-1" onclick="window.location.assign('{{ route('modifier.produit', $produit->id) }}')">Modifier</button>
        </td>
      </tr>
        @endforeach
    </tbody>
  </table>