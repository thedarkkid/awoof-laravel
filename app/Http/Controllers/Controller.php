<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function get_pagination(Request $request, $items){
        $total = count($items);
        $page = $request->page ?? 1;
        $per_page = 10;
        $offset = ($page - 1) * $per_page;
        $items = array_slice($items, $offset, $per_page);

        return new LengthAwarePaginator($items, $total, $per_page, $page,
            [
                'path' => LengthAwarePaginator::resolveCurrentPath(),
                'query' => $request->query()
            ]);
    }
}
