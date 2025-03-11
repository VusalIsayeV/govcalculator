<?php

namespace App\Http\Controllers;

use App\Models\b1;
use App\Models\b3;
use App\Models\b4;
use App\Models\b5;
use App\Models\service_type;
use App\Models\user_group;
use Illuminate\Http\Request;

class CalculatorController extends Controller
{

    public function OneTimePaymentUserGroup()
    {
        return response()->json(user_group::all(), 200);
    }
    public function OneTimePaymentServiceType()
    {
        return response()->json(service_type::all(), 200);
    }
    public function OneTimePaymentB4()
    {
        return response()->json(b4::all(), 200);
    }
//   key olarag service_type_id gonderirik ona esasen uygun datalari bize cixarir
    public function OneTimePaymentB1B3B5(Request $request)
    {
        $serviceType = $request->input('service_type_id');
        $serviceTypeName=service_type::where('id', $serviceType)->first()->name;
        $b1Model = b1::where('service_type_id', $serviceType)->first();
        $b1Name = $serviceTypeName;
        $b1Coefficient = $b1Model ? $b1Model->coefficient : null;
        $b3Model = b3::where('service_type_id', $serviceType)->first();
        $b3Name = $b3Model ? $serviceTypeName. ' ' .($b3Model->name) : $serviceTypeName;
        $b3Coefficient = $b3Model ? $b3Model->coefficient : null;
        $b5Model = b5::where('service_type_id', $serviceType)->first();
        $b5Name = $b5Model ? $b5Model->name : null;
        $b5Coefficient = $b5Model ? $b5Model->coefficient : null;
        return response()->json([
            'B1_name' => $b1Name,
            'B1_coefficient' => $b1Coefficient,
            'B3_name' => $b3Name,
            'B3_coefficient' => $b3Coefficient,
            'B5_name' => $b5Name,
            'B5_coefficient' => $b5Coefficient
        ]);
    }

//      {
//          "UserQrup":"salam",
//          "B1":3,
//          "B2":1,
//          "B3":1,
//          "B4":1,
//          "B5":1
//      }
//          Seklinde sorgu atirig buna esasen hesablayir (UserQrup helelik nezere alinayib burada)

    public function OneTimePaymentPost(Request $request)
    {
        $data = $request->all();
        $b1Coefficient = b1::find($data['B1'])->coefficient;
        $b2Coefficient = $data['B2'];
        $b3Coefficient = b3::find($data['B3'])->coefficient;
        $b4Coefficient = b4::find($data['B4'])->coefficient;
        $b5Coefficient = b5::find($data['B5'])->coefficient;
        $Sum=$b1Coefficient*$b2Coefficient*$b3Coefficient*$b4Coefficient*$b5Coefficient;
        $FirstTotal = round($Sum / 1.18, 2);
        $TaxTotal = round(($Sum / 1.18) * 0.18, 2);
        return response()->json([
            'B1_coefficient' => $b1Coefficient,
            'B2_coefficient' => $b2Coefficient,
            'B3_coefficient' => $b3Coefficient,
            'B4_coefficient' => $b4Coefficient,
            'B5_coefficient' => $b5Coefficient,
            'Sum' => $Sum,
            'FirstTotal' => $FirstTotal,
            'TaxTotal' => $TaxTotal,
        ]);
    }
    public function TermPayment(Request $request)
    {
        //
    }
}
