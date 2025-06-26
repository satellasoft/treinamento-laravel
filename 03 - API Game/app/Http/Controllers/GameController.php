<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GameController extends Controller
{
    public function index()
    {
        return response()->json([
            'message' => 'List of games',
            'data' => Game::all()
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'name'         => 'required|string|max:255',
            'description'  => 'required|string|max:500',
            'thumb'        => 'nullable|url',
            'video'        => 'nullable|url',
            'release_date' => 'required|date',
        ];

        $messages = [
            'name.required' => 'O nome do jogo é obrigatório.',
            'name.string' => 'O nome do jogo deve ser uma string válida.',
            'name.max' => 'O nome do jogo deve ter no máximo 255 caracteres.',
            'description.required' => 'A descrição do jogo é obrigatória.',
            'description.string' => 'A descrição deve ser uma string válida.',
            'description.max' => 'A descrição deve ter no máximo 500 caracteres.',
            'thumb.url' => 'A imagem do jogo (thumb) deve ser uma URL válida.',
            'video.url' => 'O vídeo do jogo deve ser uma URL válida.',
            'release_date.required' => 'A data de lançamento é obrigatória.',
            'release_date.date' => 'A data de lançamento deve ser uma data válida.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Erro de validação',
                'errors' => $validator->errors()
            ], 422);
        }

        $forms = $request->all();
        $game = new Game();

        $game->name = $forms['name'];
        $game->description = $forms['description'];
        $game->thumb = $forms['thumb'];
        $game->video = $forms['video'];
        $game->release_date = $forms['release_date'];

        if (!$game->save()) {
            return response()->json([
                'message' => 'Failed to create game',
                'data' => []
            ], 500);
        }

        return response()->json([
            'message' => 'Game created successfully',
            'data' => $game
        ], 201);
    }

    public function show(int $id)
    {
        $game = Game::find($id);

        if (!$game) {
            return response()->json([
                'message' => 'Game not found',
                'data' => []
            ], 404);
        }

        return response()->json([
            'message' => 'Game details',
            'data' => $game
        ], 200);
    }

    public function delete(int $id)
    {
        $game = Game::find($id);

        if (!$game) {
            return response()->json([
                'message' => 'Game not found',
                'data' => []
            ], 404);
        }

        if (!$game->delete()) {
            return response()->json([
                'message' => 'Failed to delete game',
                'data' => []
            ], 500);
        }

        return response()->json([
            'message' => 'Game deleted successfully',
            'data' => []
        ], 200);
    }

    public function update(Request $request, int $id)
    {
        $rules = [
            'name'         => 'required|string|max:255',
            'description'  => 'required|string|max:500',
            'thumb'        => 'nullable|url',
            'video'        => 'nullable|url',
            'release_date' => 'required|date',
        ];

        $messages = [
            'name.required' => 'O nome do jogo é obrigatório.',
            'name.string' => 'O nome do jogo deve ser uma string válida.',
            'name.max' => 'O nome do jogo deve ter no máximo 255 caracteres.',
            'description.required' => 'A descrição do jogo é obrigatória.',
            'description.string' => 'A descrição deve ser uma string válida.',
            'description.max' => 'A descrição deve ter no máximo 500 caracteres.',
            'thumb.url' => 'A imagem do jogo (thumb) deve ser uma URL válida.',
            'video.url' => 'O vídeo do jogo deve ser uma URL válida.',
            'release_date.required' => 'A data de lançamento é obrigatória.',
            'release_date.date' => 'A data de lançamento deve ser uma data válida.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Erro de validação',
                'errors' => $validator->errors()
            ], 422);
        }

        $game = Game::find($id);

        $game->name = $request->input('name');
        $game->description = $request->input('description');
        $game->thumb = $request->input('thumb');
        $game->video = $request->input('video');
        $game->release_date = $request->input('release_date');

        if (!$game->save()) {
            return response()->json([
                'message' => 'Failed to update game',
                'data' => []
            ], 500);
        }

        return response()->json([
            'message' => 'Game updated successfully',
            'data' => $game
        ], 201);
    }
}
