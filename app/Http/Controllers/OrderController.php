<?php

namespace App\Http\Controllers;

use App\Models\order;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function saveOrder()
    {
        try {
            $validator = Validator::make($request->all(), [
                'items' => 'required|array',
                'items.*.id' => 'required|exists:foods,id',
                'items.*.quantity' => 'required|integer|min:1'
            ]);
            if ($validator->fails()) {
                return $this->errorResponse($validator->errors(),422)
            }
            
            $order=order::createWithFood($orderdata, $request->items);
            DB::commit();

            return $this->successResponse(['order'=>$order],'la commande a été enregistré',201);

        } catch (Exception $e) {
            DB::rollBack();
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    private function successResponse($data, $message, $statusCode = 200)
    {
        return response()->json([
            'status_message' => $message,
            'data' => $data,
            'status_code' => $statusCode
        ], $statusCode);
    }
    private function errorResponse($message, $statusCode)
    {
        return response()->json([
            'status_message' => $message,
            'data' => null,
            'status_code' => $statusCode
        ], $statusCode);
    }
}
