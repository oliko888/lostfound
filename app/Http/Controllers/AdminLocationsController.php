<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AdminLocationsController extends Controller
{
    public $currentPage;

    public function __construct() {
        $this->middleware('auth');
        $this->currentPage = 'locations';
    }
    
    public function index() {
        $locations = DB::select("SELECT *, (SELECT count(*) FROM founds WHERE location = locations.id) AS countLocFound FROM locations");
        
        return view('admin.locations', compact('locations'))
            ->with('currentPage', $this->currentPage);
    }

    public function store(Request $request) {
        if(!empty($request->newLoc)) {
            $newLoc = $this->test_input($request->newLoc);
            DB::insert('INSERT INTO locations (name) VALUES (?)', [$newLoc]);
        }
        $locations = DB::select("SELECT *, (SELECT count(*) FROM founds WHERE location = locations.id) AS countLocFound FROM locations");

        

        return view('admin.locations')
            ->with('locations', $locations)
            ->with('currentPage', $this->currentPage);
    }

    public function update($id, Request $request) {

        $name = $this->test_input($request->newLocName);
        DB::update('UPDATE locations SET name = ? WHERE id = ?', [$name, $id]);


        return redirect()->back();
    }


    public function destroy($id) {

        DB::delete('DELETE FROM locations WHERE id = :id', ['id' => $id]);


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
