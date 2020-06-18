<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Auction;
use App\Found;


class AuctionController extends Controller
{
    public function index() {

        $currentPage = 'auction';

        $auction = Auction::orderBy('id', 'DESC')->paginate(12);
        # Get all categories
        $categories = DB::select("SELECT *, (SELECT count(*) FROM founds WHERE categories_id = categories.id) AS countFound FROM categories");

        # Get all locations
        $locKeys = [];
        $locValues = [];

        $locations = DB::select("SELECT * FROM locations");
        foreach ($locations as $key => $value) {
            array_push($locKeys, $value->id);
            array_push($locValues, $value->name);
        }
        $locations = array_combine($locKeys, $locValues);

        return view('auction.index', compact('auction'))
            ->with('categories', $categories)
            ->with('currentPage', $currentPage)
            ->with('locations', $locations);
    }

    public function store(Request $request) {
        $id = request('id');
        $validatedData = $request->validate([
            'itemName' => 'required|max:100',
            'category' => 'required|max:50',
            'description' => 'nullable|max:250',
            'fileUpload' => 'mimes:jpeg,png,webp,bmp',
            'location' => 'max:50',
        ]);
        
        $found = Found::find($id);
        $auction = new Auction;

        if ($request->hiddenInput == 3) {
            // Save the image
            $image = $request->fileUpload;
            $filename = (microtime(1) * 10000). '.'. $image->extension();

            $imageResize = Image::make($image->getRealPath());
            // Save resized orig
            $imageResize->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            /* $imageResize->save(public_path('images/600x400/' .$filename)); */
            $imageResize->save(public_path('../../htdocs/lostfound/images/600x400/' .$filename));
            // Save thumbnail
            $imageResize->fit(250, 250, function ($constraint) {
                $constraint->upsize();
            });
            /* $imageResize->save(public_path('images/250x250/' .$filename)); */
            $imageResize->save(public_path('../../htdocs/lostfound/images/250x250/' .$filename));
            $imageResize->destroy();
            $auction->image = $filename;

        } elseif ($request->hiddenInput == 2) {
            $filename = "1.jpg";
            $auction->image = $filename;
        } else {
            $auction->image = $found->image;
        }
        
        $auction->name = $this->test_input($request->itemName);
        $auction->categories_id = $this->test_input($request->category);
        $auction->description = $this->test_input($request->description);
        $auction->location = $this->test_input($request->location);

        if($auction->save()) {
            $found->delete();
        }
        
        return redirect()->back();
    }

    public function destroy() {
        $id = request('id');
        $post = Auction::find($id);
        $post->delete();

        return redirect()->back();
    }

    public function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);

        return $data;
    }

}
