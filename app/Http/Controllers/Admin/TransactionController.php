<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Laracasts\Flash\Flash;
use Response;

class TransactionController extends Controller
{
    /**
     * Display a listing of the Admin.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        /** @var Transaction $transaction */
        $query = Transaction::query()->with('users');

        if (request()->filled('search')) {
            $query->where('transaction_id', 'LIKE', '%' . request('search') . '%');
        }
    
        $transaction = $query->orderBy('created_at', 'DESC')->paginate(10);
        
        return view('admin.transactions.index')
            ->with('admins', $transaction);
    }

    /**
     * Show the form for creating a new Admin.
     *
     * @return Response
     */
    public function create()
    {
       //
    }

    /**
     * Store a newly created Admin in storage.
     *
     * @param CreateAdminRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
       //
    }

    /**
     * Display the specified Admin.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified Admin.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified Admin in storage.
     *
     * @param int $id
     * @param UpdateAdminRequest $request
     *
     * @return Response
     */
    public function update()
    {
        //
    }

    /**
     * Remove the specified Admin from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
       //
    }
}
