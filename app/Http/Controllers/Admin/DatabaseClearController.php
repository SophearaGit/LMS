<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;

class DatabaseClearController extends Controller
{

    public function databaceClearIndex()
    {
        $data = [
            'pageTitle' => 'CAITD | Database Clear',
        ];
        return view('admin.pages.database-clear.index', $data);
    }
    public function databaceClear(Request $request)
    {
        try {
            $path = public_path('uploads');
            if (File::exists($path)) {
                File::cleanDirectory($path);
                Artisan::call('migrate:fresh --seed');
                Artisan::call('optimize:clear');
                return response()->json([
                    'status' => 'success',
                    'message' => 'Database cleared successfully.',
                ]);
            }
        } catch (\Throwable $th) {
            logger($th);
            throw $th;
        }
    }

}
