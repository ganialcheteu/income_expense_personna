<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\activityRequest;
use App\Models\activity;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;


class activityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $activities = activity::paginate(8);
        return view("admin.activity.index", compact('activities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.activity.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(activityRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $activity  = activity::create($validated);
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $file) {
                //chemin stocke dans $path dossier images accessible publiquement
                // et retourne par store
                $path = $file->store('images', 'public');
                //cree une image associe au modele activity et enregistre
                //le chemin de l'image dans le champ path
                $activity->images()->create([
                    'path' => $path,
                ]);
            }
        }

        return redirect()->route('activities')->with('info', "Activity $request->name Created Successfully.");
    }

    /**
     * Display the specified resource.
     */
    public function show($slug): View
    {
        // Récupérer l'activité avec ses images
        $activity = activity::where('slug',$slug)->with('images')->firstOrFail();
        //passer a la vue show
        return view('admin.activity.show', compact('activity'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug): View
    {
        $activity = activity::where('slug',$slug)->firstOrFail();
        return view('admin.activity.edit', compact('activity'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(activityRequest $request, string $slug): RedirectResponse
    {
        $activity = activity::where('slug',$slug)->with('images')->firstOrFail();

        // Validation des données
        $validated = $request->validated();
        // Mettre à jour les champs de l'activité
        $activity->update($validated);

        // Supprimer les anciennes images associées à l'activité si elle existent sinon la bouclce
        //n'est pas executee
        foreach ($activity->images as $image) {
            // Supprimer le fichier du stockage
            \Storage::disk('public')->delete($image->path);
            // Supprimer l'entrée dans la base de données
            $image->delete();
        }

        // Ajouter les nouvelles images
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $file) {
                $path = $file->store('images', 'public');
                $activity->images()->create([
                    'path' => $path,
                ]);
            }
        }

        return redirect()->route('activities')->with('info', "Activity $request->name Updated Successfully.");
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug): RedirectResponse
    {
        $activity = activity::where('slug',$slug)->firstOrFail();
        if ($activity) {
            $activity->delete();
            return redirect()->route('activities')->with('info', "Activity $activity->name Deleted Successfully.");
        }else{
            return redirect()->route('activities')->with('error', 'Activity not found.');
        }
    }
}
