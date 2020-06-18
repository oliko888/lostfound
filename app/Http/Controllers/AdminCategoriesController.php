<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AdminCategoriesController extends Controller
{
    public $currentPage;

    public function __construct() {
        $this->middleware('auth');
        $this->currentPage = 'categories';
    }
    
    public function index() {

        $categories = DB::select("SELECT *, (SELECT count(*) FROM founds WHERE categories_id = categories.id) AS countFound, (SELECT count(*) FROM losts WHERE categories_id = categories.id) AS countLost FROM categories");

        return view('admin.categories')
            ->with('categories', $categories)
            ->with('currentPage', $this->currentPage);
    }

    public function store(Request $request) {

        if(!empty($request->newCat)) {
            $newCat = $this->test_input($request->newCat);
            DB::insert('INSERT INTO categories (name) VALUES (?)', [$newCat]);
        }
        
        $categories = DB::select("SELECT *, (SELECT count(*) FROM founds WHERE categories_id = categories.id) AS countFound, (SELECT count(*) FROM losts WHERE categories_id = categories.id) AS countLost FROM categories");

        return view('admin.categories')
            ->with('categories', $categories)
            ->with('currentPage', $this->currentPage);
    }

    public function update($id, Request $request) {

        $name = $this->test_input($request->newCatName);
        DB::update('UPDATE categories SET name = ? WHERE id = ?', [$name, $id]);

        return redirect()->back();
    }

    public function destroy($id) {

        DB::delete('DELETE FROM categories WHERE id = :id', ['id' => $id]);

        return redirect()->back();
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
