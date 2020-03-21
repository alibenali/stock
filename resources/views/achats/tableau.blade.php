<table class="table table-responsive-sm">
    <thead>
      <tr>
        <th>ID</th>
        <th>Fournisseur</th>
        <th>Designation</th>
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
        <td>{{$produit->id_fsr}}</td>
        <td>{{$produit->designation}}</td>
        <td>{{$produit->id_categorie}}</td>
        <td>{{$produit->quantite}}</td>
        <td>{{$produit->prix_achat * $pourcentage / 100}}</td>

        <td><button class="btn-success">Vendre</button></td>
      </tr>
        @endforeach
    </tbody>
  </table>