<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\ProductsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        $file = $request->file('file');
        $path = $file->store('temp');
        try {
            Excel::import(new ProductsImport, $path);
            Storage::delete($path);
            return redirect()->back()->with('success', 'Данные успешно загружены и импортированы.');
        } catch (\Exception $e) {
            Storage::delete($path);
            return redirect()->back()->with('error', 'Ошибка при импорте данных: ' . $e->getMessage());
        }
    }
}
