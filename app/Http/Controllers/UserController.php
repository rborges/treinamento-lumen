<?php

namespace App\Http\Controllers;

//use App\Http\Controllers\Controller;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Request as FacadesRequest;

class UserController extends BaseController
{
    protected string $model = User::class;

    public function indexByUri(Request $request)
    {
        //http://localhost:8000/api/v1/user?page=2&per_page=5

        $offset = ($request->page - 1) * $request->per_page;

        return $this->model::query()
            ->offset($offset)
            ->limit($request->per_page)
            ->get();
    }

    public function index(Request $request)
    {
        $resources = $this->model::paginate();
        return response()->json($resources, 200);
    }

    /**
     * Retrieve the user for the given ID.
     *
     * @param  string  $id
     * @return Response
     */
    public function show($id)
    {
        $resource = $this->model::findOrFail($id);
        return response()->json($resource, 200);
    }

    public function showUserWithAddress($id)
    {
        $resource = $this->model::with('address')
            ->findOrFail($id);
        return response()->json($resource, 200);
    }

    public function showUserWithAddressAndPosts($id)
    {
        $resource = $this->model::with([
            'address',
            'posts'
        ])->findOrFail($id);

        return response()->json($resource, 200);
    }



    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $rules =
            [
                "nome" => "required",
                "email" => "required|email",
                "password" => "required|min:5"
            ];

        $messages = [
            "required" => "O campo :attribute é requerido.",
            "min" => "O tamanho mínimo para o campo :attribute"
        ];

        $this->validate($request, $rules, $messages);

        $resource = new $this->model;
        $resource->fill($request->all())->save();

        return response()->json($resource, 201);
    }

    public function update($id, Request $request)
    {
        $resource = $this->model::find($id);

        if (is_null($resource)) {
            return response()->json([
                'error' => true,
                'message' => 'Recurso não encontrado'
            ], 404);
        }

        $resource->fill($request->all())->update();

        return response()->json($resource, 200);
    }

    public function destroy($id)
    {
        $resource = $this->model::destroy($id);

        if (!$resource) {
            return response()->json(
                ["error" => "recurso não encontrado"],
                404
            );
        }
        return response()->json('', 204);
    }
}
