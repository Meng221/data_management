<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Type;
use App\Models\ThesisTopic;
use App\Models\StudentGroup;
use App\Models\Plans;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function index(Request $request)
    {
        $count = $this->topicType('database');
        $netcount = $this->topicType('network');
        $iotcount = $this->topicType('iot');
        $animecount = $this->topicType('animation');

        $topicsWithDatabaseAndBookId = $this->countTopicsWithBookIdAndType('Database');
        $topicsWithIOTAndBookId = $this->countTopicsWithBookIdAndType('IOT');
        $topicsWithNetworkAndBookId = $this->countTopicsWithBookIdAndType('Network');
        $topicsWithAnimeAndBookId = $this->countTopicsWithBookIdAndType('Animation');

        $topicsWithDatabaseAndNullBookId = $this->countTopicsWithNullBookIdAndType('Database');
        $topicsWithNetAndNullBookId = $this->countTopicsWithNullBookIdAndType('Network');
        $topicsWithIOTAndNullBookId = $this->countTopicsWithNullBookIdAndType('IOT');
        $topicsWithAnimeAndNullBookId = $this->countTopicsWithNullBookIdAndType('Animation');

        $topicsWithBookId = ThesisTopic::whereNotNull('book_id')->count();
        $topicsNull = ThesisTopic::whereNull('book_id')->count();
        $topics = ThesisTopic::count();
        $types = Type::all();
        return view('admin.dashboard', compact('types','topics', 'topicsWithBookId', 'topicsNull','count',
            'netcount','iotcount', 'animecount','topicsWithDatabaseAndBookId',
            'topicsWithDatabaseAndNullBookId','topicsWithNetworkAndBookId',
            'topicsWithIOTAndBookId', 'topicsWithAnimeAndBookId', 'topicsWithNetAndNullBookId',
            'topicsWithIOTAndNullBookId','topicsWithAnimeAndNullBookId'
        ));
    }
    private function topicType($typename) {
        $databaseType = Type::where('name', $typename)->first();

        // Check if the type exists
        if ($databaseType) {
            // Count the number of thesis topics with the type_id of "Database"
            $count = ThesisTopic::where('type_id', $databaseType->id)->count();
        } else {
            // If the type "Database" does not exist, set count to 0
            $count = 0;
        }
        return $count;
    }

    private function countTopicsWithBookIdAndType($typeName) {
        // Find the type by name
        $type = Type::where('name', $typeName)->first();

        // If the type exists, count topics with that type_id and a non-null book_id
        if ($type) {
            $count = ThesisTopic::where('type_id', $type->id)->whereNotNull('book_id')->count();
        } else {
            // If the type does not exist, return 0
            $count = 0;
        }

        return $count;
    }

    private function countTopicsWithNullBookIdAndType($typeName) {
        // Find the type by name
        $type = Type::where('name', $typeName)->first();

        // If the type exists, count topics with that type_id and a null book_id
        if ($type) {
            $count = ThesisTopic::where('type_id', $type->id)->whereNull('book_id')->count();
        } else {
            // If the type does not exist, return 0
            $count = 0;
        }

        return $count;
    }

    function getPost() {
        $posts = Plans::all();
        return view('plan', compact('posts'));
    }

    function groupview() {
        $studentGroups = StudentGroup::with(['students', 'thesisTopic.type'])->get();
        return view('admin.group', compact('studentGroups'));
    }

    function defense() {
        $studentGroups = StudentGroup::with(['students', 'thesisTopic.type'])->get();

        return view('admin.defense', compact('studentGroups'));
    }
}
