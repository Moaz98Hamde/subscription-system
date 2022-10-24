<?php

namespace App\Http\Controllers;

use App\Models\User;
use Yajra\DataTables\Datatables;


class DataTablesController extends Controller
{
    public function customers()
    {
        $records = User::whereHas('roles', function ($query) {
            $query->where('name', 'customer');
        })->get();


        return Datatables::of($records)
            ->addColumn('action', function ($records) {
                $activation = $records->status ?
                    '<i class="icon-copy ion-minus-circled"></i>Deactivate'
                    : '<i class="icon-copy ion-checkmark-circled"></i>Activate</i>';

                $activationRoute = $records->status ?
                    route('users.deactivate', $records->id) : route('users.activate', $records->id);

                return '<div class="dropdown">
                            <a
                                class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                href="{{$records->name}}"
                                role="button"
                                data-toggle="dropdown"
                            >
                                <i class="dw dw-more"></i>
                            </a>
                            <div
                                class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"
                            >

                                <a class="dropdown-item" href="' . $activationRoute . '">
                                ' . $activation . '</a>
                                <a class="dropdown-item" href="' . route('users.edit', $records->id) . '"
                                    ><i class="dw dw-edit2"></i> Edit</a
                                >
                            </div>
                        </div>';
            })

            ->editColumn('status', function ($records) {
                return $records->status ? 'Active' : 'Inactive';
            })
            ->rawColumns(['name', 'email', 'action'])
            ->make(true);
    }
}
