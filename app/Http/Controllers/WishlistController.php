<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;

class WishlistController extends Controller
{
    // Wishlist Page
    public function index()
    {
        $ip = request()->ip();
        $user_id = auth()->id();

        $wishlists = Wishlist::with('product')
            ->where(function($query) use ($ip, $user_id) {
                $query->where('user_ip', $ip);
                if ($user_id) {
                    $query->orWhere('user_id', $user_id);
                }
            })
            ->get();

        return view('website.wishlist', compact('wishlists'));
    }

    // Add to Wishlist
    public function add(Request $request)
    {
        $ip = $request->ip();
        $user_id = auth()->id();
        $product_id = $request->product_id;

        // Already added check
        $exists = Wishlist::where('product_id', $product_id)
            ->where(function($query) use ($ip, $user_id) {
                $query->where('user_ip', $ip);
                if ($user_id) {
                    $query->orWhere('user_id', $user_id);
                }
            })
            ->first();

        if (!$exists) {
            Wishlist::create([
                'product_id' => $product_id,
                'user_ip' => $ip,
                'user_id' => $user_id,
            ]);
            $message = 'Added to Wishlist Successfully!';
        } else {
            $message = 'Product is already in your Wishlist!';
        }

        return response()->json([
            'status' => 'success',
            'message' => $message,
            'wishlistCount' => Wishlist::where(function($query) use ($ip, $user_id) {
                $query->where('user_ip', $ip);
                if ($user_id) {
                    $query->orWhere('user_id', $user_id);
                }
            })->count()
        ]);
    }

    // Remove item
    public function remove(Request $request)
    {
        $item = Wishlist::find($request->id);
        if ($item) {
            $item->delete();
        }

        $ip = request()->ip();
        $user_id = auth()->id();
        $wishlistCount = Wishlist::where(function($query) use ($ip, $user_id) {
                $query->where('user_ip', $ip);
                if ($user_id) {
                    $query->orWhere('user_id', $user_id);
                }
            })
            ->count();

        return response()->json([
            'status' => 'success',
            'message' => 'Removed Successfully!',
            'wishlistCount' => $wishlistCount
        ]);
    }
}


