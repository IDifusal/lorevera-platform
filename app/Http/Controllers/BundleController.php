<?php

namespace App\Http\Controllers;

use App\Models\Bundle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BundleController extends Controller
{

    public function index()
    {
        $bundles = Bundle::with(['programs'])->get();
        return response()->json($bundles);
    }
    public function store(Request $request)
    {
        $bundle = Bundle::create([
            'name' => $request->name,
            'subtitle' => $request->subtitle,
            'normal_price' => $request->normal_price,
            'sale_price' => $request->sale_price,
        ]);

        // Attach the programs to the bundle
        if (!empty($request->program_ids)) {
            $bundle->programs()->attach($request->program_ids);
        }

        return response()->json(['message' => 'Bundle created successfully', 'bundle' => $bundle]);
    }
    public function mobileList()
    {
        $bundles = Bundle::with('programs')->get();

        $disclaimer = DB::table('shop_info')->where('title', 'Disclaimer')->first();
        $faqs = DB::table('shop_info')->where('title', 'FAQs')->first();

        return response()->json([
            'bundles' => $bundles,
            'disclaimer' => $disclaimer,
            'faqs' => $faqs
        ]);
    }
}
