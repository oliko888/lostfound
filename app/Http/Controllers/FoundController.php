<?php

namespace App\Http\Controllers;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Image;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Found;

class FoundController extends Controller
{
    public function index() {
        $currentPage = 'found';
        $search = null;        
        # Grab category param if exists and form query
        if(request('search') != null) {
            $search = $this->test_input(request('search'));
            $found = Found::where('description', 'LIKE', '%'. $search. '%')
                ->orWhere('name', 'LIKE', '%'. $search. '%')
                ->orWhere('id', '=', $search)
                ->orderBy('id', 'DESC')
                ->paginate(12);
        } elseif(request('category') != null) {
            $found = Found::where('categories_id', '=', request('category'))
                ->orderBy('id', 'DESC')
                ->paginate(12);
        } else {
            $found = Found::orderBy('id', 'DESC')->paginate(12);
        }

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

        return view('found.index', compact('found'))
            ->with('categories', $categories)
            ->with('search', $search)
            ->with('currentPage', $currentPage)
            ->with('locations', $locations);
    }

    public function update(Request $request) {
        $id = request('id');
        $validatedData = $request->validate([
            'itemName' => 'required|max:100',
            'category' => 'required|max:50',
            'description' => 'nullable|max:250',
            'fileUpload' => 'mimes:jpeg,png,webp,bmp',
            'location' => 'max:50',
        ]);

        $found = Found::find($id);

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
            $found->image = $filename;

        } elseif ($request->hiddenInput == 2) {
            $filename = "1.jpg";
            $found->image = $filename;
        } 

        $found->name = $this->test_input($request->itemName);
        $found->categories_id = $this->test_input($request->category);
        $found->description = $this->test_input($request->description);
        $found->location = $this->test_input($request->location);
        $found->save();
        
        return redirect()->back();
    }

    public function destroy() {
        $id = request('id');
        $post = Found::find($id);
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
