<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function index()
    {
        // Retourner la liste des catégories

        $categories = Category::all();
        return response()->json(['message' => 'Liste des catégories !' , 'data' => $categories]);
    }
   

     // Validation et création d'une nouvelle catégorie
    public function store(Request $request)
    {
        $request -> validate([
            'nom' => 'required', 
            
        ]);

            $categorie= new Categorie();
            $categorie->nom = $request->nom;
            $categorie->status = false;
    
            $categorie->save();
    
            return response()->json(['message' => 'Catégorie créée avec succès'], 200);    
    }

    public function show($id)
    {
        $categorie = Categorie::with('categories')->findOrFail($id);
        return response()->json(['data' => $categorie]);
        //return response()->json($fournisseur);
    }
    public function showall()
    {
        $categorie = Categorie::with('categories')->get();
        return response()->json(['data' => $categorie]);
    }

    // Modifier une categorie
    public function update(Request $request, $id)
    {
        $categorie= Categorie::findOrFail($id);

        $request -> validate([
            'nom' => 'required',
            
        ]);

        $categorie->nom = $request->nom;

        $categorie->save();

        return response()->json(['message' => 'categorie modifiée avec succès'], 200);
    }

       
    // Supprimer une catégorie
    public function destroy($id)
    {
        $categorie = Categorie::findOrFail($id);
        $categorie->delete();

        return response()->json([
            'message' => 'Catégorie supprimée avec succès']);
    }

}
