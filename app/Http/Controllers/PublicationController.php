<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publication;
use Illuminate\Support\Facades\Validator;



class PublicationController extends Controller
{

    public function show($id)
    {
        return Publication::findOrFail($id);
    }

    public function update(Request $request, $post)
    { 
       $post = Publication::find($post);
       if ($post) {
        $post->update($request->all());
        return response()->json([
            'message' => 'Post atualizado com sucesso!'
        ]);
       }

       return response()->json([
        'message' => 'Erro ao atualizado post!'
    ]);


    }

    public function store(Request $request)
    {   
        $fields = $request->validate([
            'title' => 'required',
            'user_id' => 'required',
            'description' => 'required|max:255', 
        ], [
            'title.required' => 'O campo título é obrigatório.',
            'description.required' => 'O campo descrição é obrigatório.',
            'description.max' => 'O campo descrição não pode ter mais de 255 caracteres.',
        ]);

        $user = Publication::create([
            'title' => $fields['title'],
            'user_id' => $fields['user_id'],
            'description' => $fields['description']
        ]);

        if ($user) {
            return response()->json([
                'title' => $fields['title'],
                'message' => 'Publicado com sucesso!'
            ]);
        } else {
            return response()->json([
                'message' => 'Erro ao criar a publicação.'
            ]);
        }        
    }

    public function destroy($id)
    {
        if (Publication::destroy($id)){
            return response()->json([
                'message' => 'Excluido com sucesso!'
            ], 201);
        }

        return response()->json([
            'message' => 'Erro ao excluir!'
        ]);
    }
}
