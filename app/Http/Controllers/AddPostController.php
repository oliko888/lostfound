<?php

namespace App\Http\Controllers;

use Image;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Found;
use App\Lost;
use Illuminate\Support\Facades\Validator;
use DB;

class AddPostController extends Controller
{
    public $currentPage;
    public $categories;
    public $locations;

    public function __construct() {
        $this->currentPage = 'addPost';
        $this->categories = DB::table('categories')->get();
        $this->locations = DB::table('locations')->get();
    }
    public function index() {
        
        return view('addPost.index')
            ->with('categories', $this->categories)
            ->with('locations', $this->locations)
            ->with('currentPage', $this->currentPage);
    }

    /**
     * Store a new post.
     *
     * @param  Request  $request
     * @return Response
     */

    public function store(Request $request) {

        $validatedData = $request->validate([
            'itemName' => 'required|max:100',
            'category' => 'required|max:50',
            'role' => 'required',
            'description' => 'nullable|max:250',
            'fileUpload' => 'mimes:jpeg,png,webp,bmp',
            'location' => 'required_if:role,1|max:50',
            'email' => 'required_if:role,2',
        ]);

        // Save the image
        if ($request->hasFile('fileUpload')) {
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
        } else {
            $filename = "1.jpg";
        }
        if(empty($request->description)) {
            $request->description = "-";
        }

        // Store the post...
        if($request->role == 1) {
            $found = Found::create([
                'name' => $this->test_input($request->itemName),
                'categories_id' => $this->test_input($request->category),
                'description' => $this->test_input($request->description),
                'location' => $this->test_input($request->location),
                'image' => $filename,
            ]);
        } else {
            $found = Lost::create([
                'name' => $this->test_input($request->itemName),
                'categories_id' =>$this->test_input($request->category),
                'description' => $this->test_input($request->description),
                'email' => $this->test_input($request->email),
                'image' => $filename,
            ]);
        }

        return view('addPost.index')
            ->with('success', 'Postituse salvestamine õnnestus!')
            ->with('categories', $this->categories)
            ->with('locations', $this->locations)
            ->with('currentPage', $this->currentPage);
    }

    /**
     * Prepare the data for validation.
     *
     * @return String
     */
    private function test_input(String $data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);

        return $data;
    }
}
