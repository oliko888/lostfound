<?php

namespace App\Http\Controllers;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Image;
use Illuminate\Support\Facades\Validator;
use App\Lost;
use DB;

class LostController extends Controller
{
    public function index() {
        $currentPage = 'lost';
        $search = null;
        # Grab category param if exists and form query
        if(request('search') != null) {

            $search = $this->test_input(request('search'));
            $lost = Lost::where('description', 'LIKE', '%'. $search. '%')
                ->orWhere('name', 'LIKE', '%'. $search. '%')
                ->orWhere('id', '=', $search)
                ->orderBy('id', 'DESC')
                ->paginate(12);

        } elseif(request('category') != null) {

            $lost = Lost::where('categories_id', '=', request('category'))
                ->orderBy('id', 'DESC')
                ->paginate(12);

        } else {

            $lost = Lost::orderBy('id', 'DESC')->paginate(12);

        }

        # Get all categories
        $categories = DB::select("SELECT *, (SELECT count(*) FROM losts WHERE categories_id = categories.id) AS countLost FROM categories");

        return view('lost.index', compact('lost'))
            ->with('categories', $categories)
            ->with('search', $search)
            ->with('currentPage', $currentPage);
    }

    public function update(Request $request) {
        $id = request('id');
        $validatedData = $request->validate([
            'itemName' => 'required|max:100',
            'category' => 'required|max:50',
            'description' => 'nullable|max:250',
            'fileUpload' => 'mimes:jpeg,png,webp,bmp',
            /* 'location' => 'max:50', */
        ]);

        $lost = Lost::find($id);

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
            $lost->image = $filename;

        } elseif ($request->hiddenInput == 2) {
            $filename = "1.jpg";
            $lost->image = $filename;
        } 

        $lost->name = $this->test_input($request->itemName);
        $lost->categories_id = $this->test_input($request->category);
        $lost->description = $this->test_input($request->description);
        /* $lost->location = $this->test_input($request->location); */
        $lost->save();
        
        return redirect()->back();
    }

    public function destroy() {
        $id = request('id');
        $post = Lost::find($id);
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
