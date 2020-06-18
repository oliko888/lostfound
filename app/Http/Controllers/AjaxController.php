<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Found;
use App\Lost;
use App\Auction;
use DB;

class AjaxController extends Controller
{
    public function index(Request $request) {
        # Get all locations
        $locKeys = [];
        $locValues = [];

        $locations = DB::select("SELECT * FROM locations");
        foreach ($locations as $key => $value) {
            array_push($locKeys, $value->id);
            array_push($locValues, $value->name);
        }
        $locations = array_combine($locKeys, $locValues);

        if (request('found')) {
            $id = request('found');
            $item = Found::find($id);
            $selector = "found";

            return view('ajax.index', compact('item'))
                ->with('locations', $locations)
                ->with('selector', $selector);
                
        } elseif (request('lost')) {
            $id = request('lost');
            $item = Lost::find($id);
            $selector = "lost";

            return view('ajax.index', compact('item'))
                /* ->with('locations', $locations) */
                ->with('selector', $selector);

        } elseif (request('auction')) {
            $id = request('auction');
            $item = Auction::find($id);
            $selector = "auction";

            return view('ajax.index', compact('item'))
                ->with('locations', $locations)
                ->with('selector', $selector);
                
        } elseif (request('editFound')) {
            $id = request('editFound');
            $item = Found::find($id);
            $selector = "editFound";

            # Get all categories
            $catKeys = [];
            $catValues = [];
            $categories = DB::select("SELECT * FROM categories");
            foreach ($categories as $key => $value) {
                array_push($catKeys, $value->id);
                array_push($catValues, $value->name);
            }
            $categories = array_combine($catKeys, $catValues);

            return view('ajax.index', compact('item'))
                ->with('locations', $locations)
                ->with('selector', $selector)
                ->with('categories', $categories);

        } elseif (request('editLost')) {
            $id = request('editLost');
            $item = Lost::find($id);
            $selector = "editLost";

            # Get all categories
            $catKeys = [];
            $catValues = [];
            $categories = DB::select("SELECT * FROM categories");
            foreach ($categories as $key => $value) {
                array_push($catKeys, $value->id);
                array_push($catValues, $value->name);
            }
            $categories = array_combine($catKeys, $catValues);

            return view('ajax.index', compact('item'))
               /*  ->with('locations', $locations) */
                ->with('selector', $selector)
                ->with('categories', $categories);

        } elseif (request('auctionFound')) {
            $id = request('auctionFound');
            $item = Found::find($id);
            $selector = "auctionFound";

            # Get all categories
            $catKeys = [];
            $catValues = [];
            $categories = DB::select("SELECT * FROM categories");
            foreach ($categories as $key => $value) {
                array_push($catKeys, $value->id);
                array_push($catValues, $value->name);
            }
            $categories = array_combine($catKeys, $catValues);

            return view('ajax.index', compact('item'))
                ->with('locations', $locations)
                ->with('selector', $selector)
                ->with('categories', $categories);

        } elseif (request('deleteAuction')) {
            $id = request('deleteAuction');
            $selector = "deleteAuction";

            return view('ajax.index', compact('id'))
                ->with('selector', $selector);
                
        } elseif (request('deleteFound')) {
            $id = request('deleteFound');
            $selector = "deleteFound";

            return view('ajax.index', compact('id'))
                ->with('selector', $selector);

        } elseif (request('deleteLost')) {
            $id = request('deleteLost');
            $selector = "deleteLost";

            return view('ajax.index', compact('id'))
                ->with('selector', $selector);
        }
        
    }
}
