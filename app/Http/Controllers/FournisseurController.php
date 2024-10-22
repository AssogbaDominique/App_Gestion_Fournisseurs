<?php

namespace App\Http\Controllers;

use App\Models\Fournisseur;
use App\Models\Categorie;
use Illuminate\Http\Request;

class FournisseurController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    // Afficher tous les fournisseurs
    public function index()
    {
       // return response()->json(Fournisseur::with('categories')->get());
       //$fournisseurs = Fournisseur::where('actif', true)->get();
        //return response()->json($fournisseurs);
        $fournisseurs = Fournisseur::with('categories')->where('archived', false)->get();
        return response()->json($fournisseurs);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    // Ajouter un fournisseur
    public function store(Request $request)
    {
        $request -> validate([
            'nom' => 'required', 
            'email' => 'required', 
            'telephone' => 'required'
        ]);

            $fournisseur= new Fournisseur();
            $fournisseur->nom = $request->nom;
            $fournisseur->email= $request->email;
            $fournisseur->telephone=$request->telephone;
            $fournisseur->status = false;
            $fournisseur->archiver = false;
    
            $fournisseur->save();
    
            return response()->json(['message' => 'Données enregistrées avec succès'], 200);    
    }

    public function show($id)
    {
        $fournisseur = Fournisseur::with('categories')->findOrFail($id);
        return response()->json(['data' => $fournisseur]);
        //return response()->json($fournisseur);
    }
    public function showall()
    {
        $fournisseur = Fournisseur::with('categories')->get();
        return response()->json(['data' => $fournisseur]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    // Modifier un fournisseur
    public function update(Request $request, $id)
    {
        $fournisseur = Fournisseur::findOrFail($id);

        $request -> validate([
            'nom' => 'required',
            'email' => 'required',
            'telephone' => 'required',
        ]);

        $fournisseur->nom = $request->nom;
        $fournisseur->email= $request->email;
        $fournisseur->telephone=$request->telephone;

        $fournisseur->save();

        return response()->json(['message' => 'Données modifiée avec succès'], 203);
    }

    /*public function update(Request $request, Fournisseur $fournisseur)
    {
        $validatedData = $request->validate([
            'nom' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:fournisseurs,email,' . $fournisseur->id,
            'telephone' => 'sometimes|required|string|max:15',
        ]);

        $fournisseur->update($validatedData);
        return response()->json($fournisseur);

    }*/
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    // Méthode pour désactiver un fournisseur
    public function desactiver($id)
    {
        $fournisseur = Fournisseur::findOrFail($id);
        
        $fournisseur->status = !$fournisseur->status; 
        $fournisseur->save();

        return response()->json(['message' => 'Changement d état effectué !'], 201);
    }

    public function archiver($id)
    {
        $fournisseur = Fournisseur::findOrFail($id);
        
        $fournisseur->archiver = !$fournisseur->archiver; 
        $fournisseur->save();

        return response()->json(['message' => 'Fournisseur archiver avec succès !'], 201);
    }

    /*public function desactiverFournisseur(Fournisseur $fournisseur)
    {
        $fournisseur->update(['actif' => false]);  // Marque le fournisseur comme inactif
        return response()->json(['message' => 'Fournisseur désactivé avec succès'], 200);
    }

    // Méthode pour réactiver un fournisseur si besoin
    public function activer(Fournisseur $fournisseur)
    {
        $fournisseur->update(['actif' => true]);  // Marque le fournisseur comme actif
        return response()->json(['message' => 'Fournisseur réactivé avec succès'], 200);
    }*/

}
