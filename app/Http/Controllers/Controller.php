<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;

use Laravel\Lumen\Routing\Controller as BaseController;

abstract class Controller extends BaseController
{
    protected string $model;

    public function index()
    {
        $resources = $this->model::paginate();
        return response()->json($resources, 200);
    }

    /**
     * Retrieve the user for the given ID.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(int $id)
    {
        $resource = $this->model::findOrFail($id);
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
        $resource = new $this->model;
        $resource->fill($request->all())->save();

        return response()->json($resource, 201);
    }

    public function update(int $id, Request $request)
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

    public function destroy(int $id)
    {
        $resource = $this->model::destroy($id);
        //$resource = $this->model::find($id)->delete();

        if (!$resource) {
            return response()->json(
                ["error" => "recurso não encontrado"],
                404
            );
        }
        return response()->json('', 204);
    }
}
