<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBankListRequest;
use App\Http\Requests\StoreBankListRequest;
use App\Http\Requests\UpdateBankListRequest;
use App\Models\BankList;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BankListController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('bank_list_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bankLists = BankList::all();

        return view('admin.bankLists.index', compact('bankLists'));
    }

    public function create()
    {
        abort_if(Gate::denies('bank_list_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bankLists.create');
    }

    public function store(StoreBankListRequest $request)
    {
        $bankList = BankList::create($request->all());

        return redirect()->route('admin.bank-lists.index');
    }

    public function edit(BankList $bankList)
    {
        abort_if(Gate::denies('bank_list_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bankLists.edit', compact('bankList'));
    }

    public function update(UpdateBankListRequest $request, BankList $bankList)
    {
        $bankList->update($request->all());

        return redirect()->route('admin.bank-lists.index');
    }

    public function show(BankList $bankList)
    {
        abort_if(Gate::denies('bank_list_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bankLists.show', compact('bankList'));
    }

    public function destroy(BankList $bankList)
    {
        abort_if(Gate::denies('bank_list_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bankList->delete();

        return back()->with('message', __('global.delete_account_success'));
    }

    public function massDestroy(MassDestroyBankListRequest $request)
    {
        BankList::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
