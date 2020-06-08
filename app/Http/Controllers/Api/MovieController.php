<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Models\Movie;
use App\Models\Cast;

class MovieController extends Controller
{
    public function __construct(Movie $movies, Request $request) {
        $this->movies = $movies;
        $this->request = $request;
    }

    public function index()
    {
        $data = $this->movies->all();
        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->movies->rules());

        $dataForm = $request->all();

        $data = $this->movies->create($dataForm);
        $data->movieCast()->attach($request->actors_id);

        return response()->json($data, 201);
    }

    public function show($id)
    {
        $data = $this->movies->with('director')->with('movieCast')->find($id);

        if (!$data)
            return response()->json(['error' => 'Nenhum registro encontrado.'], 404);
        else
            return response()->json($data, 200);
    }

    public function update(Request $request, $id)
    {
        if (!$data = $this->movies->find($id))
            return response()->json(['error' => 'Não foi possível atualizar. Nenhum registro encontrado.'], 404);
        else {
            $dataForm = $request->all();

            $data->update($dataForm);

            return response()->json([
                'sucess' => 'Dados atualizados com sucesso.',
                'data' => $data], 200);
        }
    }

    public function destroy($id)
    {
        $data = $this->movies->find($id);

        if (!$data)
            return response()->json(['error' => 'Nenhum registro encontrado.'], 404);
        else {
            $data->delete();
            return response()->json(['success' => 'Registro deletado com sucesso.'], 200);
        }
    }
}
