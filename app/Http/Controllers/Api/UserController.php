<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    /**
     * @OA\Get(
     *     path="/api/users",
     *     tags={"User"},
     *     summary="All users",
     *     description="Get users list",
     *     operationId="userIndex",
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Pagination page",
     *         required=false,
     *         @OA\Schema(
     *             type="int"
     *         )
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="successful operation"
     *     ),
     *     security={
     *         {"api_key": {}}
     *     },
     * )
     */
    public function index()
    {
        $users = User::paginate(25);

        return UserResource::collection($users);
    }

    /**
     * @OA\Post(
     *     path="/api/users",
     *     tags={"User"},
     *     summary="Store user",
     *     description="Create user",
     *     operationId="userStore",
     *     @OA\Response(
     *         response="default",
     *         description="successful operation"
     *     ),
     *     security={
     *         {"api_key": {}}
     *     },
     * )
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * @OA\Get(
     *     path="/api/users/{id}",
     *     tags={"User"},
     *     summary="Show user",
     *     description="Show user information",
     *     operationId="userShow",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="User ID",
     *         required=true,
     *         @OA\Schema(
     *             type="number"
     *         )
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="successful operation"
     *     ),
     *     security={
     *         {"api_key": {}}
     *     },
     * )
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * @OA\Delete (
     *     path="/api/users/{id}",
     *     tags={"User"},
     *     summary="Delete user",
     *     description="Delete user information",
     *     operationId="userDestroy",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="User ID",
     *         required=true,
     *         @OA\Schema(
     *             type="number"
     *         )
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="successful operation"
     *     ),
     *     security={
     *         {"api_key": {}}
     *     },
     * )
     */
    public function destroy($id)
    {
        User::destroy($id);

        DB::table('model_has_roles')->where('model_id', $id)->delete();

        return response()->json(['message' => 'Successfully delete!']);
    }
}
