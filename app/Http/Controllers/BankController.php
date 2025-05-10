<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BankController extends Controller
{
    // عرض جميع السجلات
    public function index()
    {
        $banks = Bank::all();
        return response()->json($banks);
    }

    // عرض سجل واحد
    public function show($id)
    {
        $bank = Bank::find($id);
        if (!$bank) {
            return response()->json(['message' => 'السجل غير موجود'], 404);
        }
        return response()->json($bank);
    }

    // إنشاء سجل جديد مع رفع الملف
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|string',
            'file' => 'required|file',
            'user_id' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $path = $request->file('file')->store('bank_files');

        $bank = Bank::create([
            'product_id' => $request->product_id,
            'file' => $path,
            'user_id' => $request->user_id,
        ]);

        return response()->json($bank, 201);
    }

    // تعديل سجل
    public function update(Request $request, $id)
    {
        $bank = Bank::find($id);
        if (!$bank) {
            return response()->json(['message' => 'السجل غير موجود'], 404);
        }

        $validator = Validator::make($request->all(), [
            'product_id' => 'sometimes|string',
            'file' => 'sometimes|file',
            'user_id' => 'sometimes|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if ($request->hasFile('file')) {
            Storage::delete($bank->file);
            $bank->file = $request->file('file')->store('bank_files');
        }

        $bank->product_id = $request->product_id ?? $bank->product_id;
        $bank->user_id = $request->user_id ?? $bank->user_id;

        $bank->save();

        return response()->json($bank);
    }

    // حذف سجل
    public function destroy($id)
    {
        $bank = Bank::find($id);
        if (!$bank) {
            return response()->json(['message' => 'السجل غير موجود'], 404);
        }

        Storage::delete($bank->file);
        $bank->delete();

        return response()->json(['message' => 'تم حذف السجل بنجاح']);
    }
}
