<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\warehome;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class WareHomeController extends Controller
{
    //
    public function index(){
        $warehome = warehome::with('product')->get();
        return response()->json($warehome);
    }

    public function add(Request $request){
        $user = Auth::user();
        $productId = $request->input('product');
         $product = warehome::where(['product_id' => $productId, 'user_id' => $user->id])->first();
         if(empty($product)){
            warehome::create([
                'product_id' => $productId,
                'user_id' => $user->id,
            ]);
         }
         $warehome = warehome::with('product')->get();
        return response()->json($warehome);
    }

    public function update(Request $request){
        $id = $request->input('dataId');
        $wareHouse = warehome::find($id);
        $reality = $request->input('value');
        if($reality == null){
            $wareHouse ->update([
                'reality' => null,
                'difference' => null,
                'gia_chenh_lech' => null
            ]);
        }else{
            $difference	 = $reality -  $wareHouse->product->quantity;
            $gia_chenh_lech	 = $reality * $wareHouse->product->priceBuy -  $wareHouse->product->quantity * $wareHouse->product->priceBuy;
            $wareHouse ->update([
                'reality' => $reality,
                'difference' => $difference,
                'gia_chenh_lech' => $gia_chenh_lech
            ]);
        }


        return response()->json([
            'reality' => $reality,
            'difference' => $difference ?? null,
            'gia_chenh_lech' => $gia_chenh_lech ?? null
        ]);
    }
}
