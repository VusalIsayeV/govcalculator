<?php

namespace App\Http\Controllers;

use App\Models\b1;
use App\Models\b3;
use App\Models\b4;
use App\Models\b5;
use App\Models\m1;
use App\Models\m3;
use App\Models\m5;
use App\Models\m6;
use App\Models\m7;
use App\Models\pl_radi_tezlik_zolagi;
use App\Models\service_type;
use App\Models\user_group;
use Illuminate\Http\Request;

class CalculatorController extends Controller
{

    public function OneTimePaymentUserGroup()
    {
        return response()->json(user_group::all(), 200);
    }
    //    ?payment_type_id=1 or 2 seklinde parametir oturulur burda
    public function OneTimePaymentServiceType(Request $request)
    {
        $paymentTypeId = $request->input('payment_type_id');
        $query = service_type::query();

        if ($paymentTypeId) {
            $query->where('payment_type_id', $paymentTypeId);
        }

        return response()->json($query->get(), 200);
    }
    public function OneTimePaymentB4()
    {
        return response()->json(b4::all(), 200);
    }
    //   key olarag service_type_id gonderirik ona esasen uygun datalari bize cixarir
    public function OneTimePaymentB1B3B5(Request $request)
    {
        $serviceType = $request->input('service_type_id');
        $serviceTypeName = service_type::where('id', $serviceType)->first()->name;
        $b1Model = b1::where('service_type_id', $serviceType)->first();
        $b1Name = $serviceTypeName;
        $b3Model = b3::where('service_type_id', $serviceType)->first();
        $b3Name = $b3Model ? $serviceTypeName . ' ' . ($b3Model->name) : $serviceTypeName;
        $b5Model = b5::where('service_type_id', $serviceType)->first();
        $b5Name = $b5Model ? $b5Model->name : null;
        return response()->json([
            'b1' => array_merge($b1Model->toArray(), ['name' => $b1Name]),
            'b3' => array_merge($b3Model->toArray(), ['name' => $b3Name]),
            'b5' => array_merge($b5Model->toArray(), ['name' => $b5Name])
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
        $UserGroupCoefficient = user_group::find($data['UserQrup'])->coefficient;
        $b1Coefficient = b1::find($data['B1'])->coefficient;
        $b2Coefficient = $data['B2'];
        $b3Coefficient = b3::find($data['B3'])->coefficient;
        $b4Coefficient = b4::find($data['B4'])->coefficient;
        $b5Coefficient = b5::find($data['B5'])->coefficient;
        $Sum = $b1Coefficient * $b2Coefficient * $b3Coefficient * $b4Coefficient * $b5Coefficient * $UserGroupCoefficient;
        $FirstTotal = round($Sum / 1.18, 2);
        $TaxTotal = round(($Sum / 1.18) * 0.18, 2);
        return response()->json([
            'UserGroup_coefficient' => $UserGroupCoefficient,
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
    public function SellularTermPaymentGet()
    {
        $ZE1 = 1;
        $ZE2 = 0.90;
        $ZE3 = 0.70;
        $ZE4 = 0.60;
        $ZE5 = 0.30;
        $ZE6 = 0.20;
        $ZE7 = 0.08;
        $SD = 600;
        $TES = 100;
        $TED = 1;
        return response()->json([
            'ZE1' => $ZE1,
            'ZE2' => $ZE2,
            'ZE3' => $ZE3,
            'ZE4' => $ZE4,
            'ZE5' => $ZE5,
            'ZE6' => $ZE6,
            'ZE7' => $ZE7,
            'SD' => $SD,
            'TES' => $TES,
            'TED' => $TED
        ]);
    }

    //Dusturu gozden keciremk lazimdir buradaki qurulmus dustur isleyri duz hesablayir sadece Govdaki ile eyni neticeni vermir menim ucun
    public function SellularTermPayment(Request $request)
    {
        $SGZ1 = $request->input('SGZ1');
        $SGZ2 = $request->input('SGZ2');
        $SGZ3 = $request->input('SGZ3');
        $SGZ4 = $request->input('SGZ4');
        $SGZ5 = $request->input('SGZ5');
        $SGZ6 = $request->input('SGZ6');
        $SGZ7 = $request->input('SGZ7');
        $DGZ1 = $request->input('DGZ1');
        $DGZ2 = $request->input('DGZ2');
        $DGZ3 = $request->input('DGZ3');
        $DGZ4 = $request->input('DGZ4');
        $DGZ5 = $request->input('DGZ5');
        $DGZ6 = $request->input('SGZ6');
        $DGZ7 = $request->input('SGZ7');
        $T = round($request['T'] / 365, 2);
        $ZE1 = 1;
        $ZE2 = 0.90;
        $ZE3 = 0.70;
        $ZE4 = 0.60;
        $ZE5 = 0.30;
        $ZE6 = 0.20;
        $ZE7 = 0.08;
        $SD = 600;
        $TES = 100;
        $TED = 1;
        $s_sum = $SD * $TES * $T * ($SGZ1 * $ZE1 + $SGZ2 * $ZE2 + $SGZ3 * $ZE3 + $SGZ4 * $ZE4 + $SGZ5 * $ZE5 + $SGZ6 * $ZE6 + $SGZ7 * $ZE7);
        $d_sum = $SD * $TED * $T * ($DGZ1 * $ZE1 + $DGZ2 * $ZE2 + $DGZ3 * $ZE3 + $DGZ4 * $ZE4 + $DGZ5 * $ZE5 + $DGZ6 * $ZE6 + $DGZ7 * $ZE7);
        $Sum = $s_sum + $d_sum;
        $FirstTotal = round($Sum / 1.18, 2);
        $TaxTotal = round(($Sum / 1.18) * 0.18, 2);
        return response()->json([
            'T' => $T,
            's_sum' => $s_sum,
            'd_sum' => $d_sum,
            'Sum' => $Sum,
            'FirstTotal' => $FirstTotal,
            'TaxTotal' => $TaxTotal,
        ]);
    }
    public function OtherTermPaymentM1M3M5M6M7(Request $request)
    {
        $serviceType = $request->input('service_type_id');
        $serviceTypeName = service_type::where('id', $serviceType)->first()->name;
        $m1Model = m1::where('service_type_id', $serviceType)->first();
        $m1Name = $serviceTypeName;
        $m3Model = m3::where('service_type_id', $serviceType)->first();
        $m3Name = $m3Model ? $serviceTypeName . ' ' . ($m3Model->name) : $serviceTypeName;
        $m6Models = m6::where('service_type_id', $serviceType)->pluck('radio_tezlik_zolagi_id');
        $plRadioTezlikZolagi = pl_radi_tezlik_zolagi::whereIn('id', $m6Models)
            ->get(['id', 'name', 'coefficient']);
        $m7Model = m7::where('service_type_id', $serviceType)->first();
        $m7Name = $m7Model ? $serviceTypeName . ' ' . ($m7Model->name) : $serviceTypeName;
        return response()->json([

            'm1' => array_merge($m1Model->toArray(), ['name' => $m1Name]),
            'm3' => array_merge($m3Model->toArray(), ['name' => $m3Name]),
            'm6' => $plRadioTezlikZolagi->toArray(),
            'm7' => array_merge($m7Model->toArray(), ['name' => $m7Name])
        ]);
    }
    public function M5(Request $request)
    {
        $data = $request->all();
        $serviceTypeId = service_type::find($data['ServiceType']);
        $value = $request->input('M5');
        $m5Coefficient = m5::where('service_type_id', $serviceTypeId->id)
            ->where(function ($query) use ($value) {
                $query->whereNull('m5_min')->orWhere('m5_min', '<=', $value);
            })
            ->where(function ($query) use ($value) {
                $query->whereNull('m5_max')->orWhere('m5_max', '>=', $value);
            })
            ->first()->coefficient;
        return response()->json([
            'M5_coefficient' => $m5Coefficient,
        ]);
    }
    public function OtherTermPayment(Request $request)
    {
        $data = $request->all();
        $serviceTypeId = service_type::find($data['ServiceType']);
        $value = $request->input('M5');
        $UserGroupCoefficient = user_group::find($data['UserQrup'])->coefficient;
        $m1Coefficient = m1::find($data['M1'])->coefficient;
        $m2Coefficient = $data['M2'];
        $m3Coefficient = m3::find($data['M3'])->coefficient;
        $m4Coefficient = b4::find($data['M4'])->coefficient;
        $m5Coefficient = m5::where('service_type_id', $serviceTypeId->id)
            ->where(function ($query) use ($value) {
                $query->whereNull('m5_min')->orWhere('m5_min', '<=', $value);
            })
            ->where(function ($query) use ($value) {
                $query->whereNull('m5_max')->orWhere('m5_max', '>=', $value);
            })
            ->first()->coefficient;
        $m6Coefficient = pl_radi_tezlik_zolagi::find($data['M6'])->coefficient;
        $m7Coefficient = m7::find($data['M7'])->coefficient;
        $m8Coefficient = round($data['M8'] / 365, 2);
        if ($serviceTypeId->key == "Radio yayımı (T_DAB)" || $serviceTypeId->key == "TV yayımı (DVB-T)") {
            $rCoefficient = 1; //r::find($data['R'])->coefficient;; //Data ELave Olunalidir r
            $Sum = $m1Coefficient * $m2Coefficient * $m3Coefficient * $m4Coefficient * $m5Coefficient * $m6Coefficient * $m7Coefficient * $m8Coefficient * $rCoefficient * $UserGroupCoefficient;
        } else {
            $Sum = $m1Coefficient * $m2Coefficient * $m3Coefficient * $m4Coefficient * $m5Coefficient * $m6Coefficient * $m7Coefficient * $m8Coefficient * $UserGroupCoefficient;
        }
        $FirstTotal = round($Sum / 1.18, 2);
        $TaxTotal = round(($Sum / 1.18) * 0.18, 2);
        return response()->json([
            'UserGroup_coefficient' => $UserGroupCoefficient,
            'M1_coefficient' => $m1Coefficient,
            'M2_coefficient' => $m2Coefficient,
            'M3_coefficient' => $m3Coefficient,
            'M4_coefficient' => $m4Coefficient,
            'M5_coefficient' => $m5Coefficient,
            'M6_coefficient' => $m6Coefficient,
            'M7_coefficient' => $m7Coefficient,
            'M8_coefficient' => $m8Coefficient,
            'Sum' => $Sum,
            'FirstTotal' => $FirstTotal,
            'TaxTotal' => $TaxTotal,
        ]);
    }
}
