<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});


$router->group(['prefix' => 'penjualan'], function () use ($router) {
    $router->get('/', function () {
        $data =
            [
                [
                    "id" => 1,
                    "nomor" => "SA001",
                    "customer" => "Joko",
                ],
                [
                    "id" => 1,
                    "nomor" => "SA001",
                    "customer" => "Joko",
                ],
                [
                    "id" => 2,
                    "nomor" => "SA001",
                    "customer" => "Joko",
                ],
                [
                    "id" => 3,
                    "nomor" => "SA001",
                    "customer" => "Joko",
                ],
                [
                    "id" => 4,
                    "nomor" => "SA001",
                    "customer" => "Joko",
                ],
            ];
        return response()->json($data);
    });

    $router->get('/{id}', function ($id) {
        $data =
            [
                [
                    "id" => $id,
                    "nomor" => "SA001",
                    "customer" => "Joko",
                    "total" => 110000,
                    "alamat" => "Jl. Jalan Aja",
                ],

            ];
        return response()->json($data);
    });

    $router->post('/', function () use ($router) {
        return response()->json(['msg' => 'berhasil', 'id' => 4]);
    });

    $router->put('/{id}', function ($id, Request $request) {
        $nomor = $request->input('nomor');
        $data =
            [
                [
                    "id" => $id,
                    "nomor" => $nomor,
                    "customer" => "Joko",
                    "total" => 110000,
                    "alamat" => "Jl. Jalan Aja",
                ],

            ];
        return response()->json($data);
    });

    $router->delete('/{id}', function ($id) {
        return response()->json(['msg' => 'berhasil di delete']);
    });

    $router->get('/{id}/confirm', function ($id, Request $request) {
        $user = $request->user();

        // Log::debug($user);
        // Log::debug($request);

        if ($user == null) {
            return response()->json(['error' => 'Unauthorized'], 401, ['X-Header-One' => 'Header Value']);
        }
        return response()->json(['msg' => 'api berhasil di terima']);
    });

    $router->get('/{id}/send-email', function ($id, Request $request) {
        $user = $request->user();

        Mail::raw('this is the email body', function ($message) {
            $message->to('m@gmail.com')->subject('Lumen email test');
        });

        if ($user == null) {
            return response()->json(['error' => 'Unauthorized'], 401, ['X-Header-One' => 'Header Value']);
        }
        return response()->json(['msg' => 'berhasil mengirim email']);
    });
});
