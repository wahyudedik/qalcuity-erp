<?php

namespace App\Services\Modul\Finance\Accounting;

use App\Models\Modul\Finance\Accounting\ChartOfAccount;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ChartOfAccountService
{
    public function getAll($filters = [])
    {
        $query = ChartOfAccount::with('parentAccount');
        
        if (isset($filters['type'])) {
            $query->where('type', $filters['type']);
        }
        
        if (isset($filters['is_active'])) {
            $query->where('is_active', $filters['is_active']);
        }
        
        if (isset($filters['branch_id'])) {
            $query->where('branch_id', $filters['branch_id']);
        }
        
        return $query->orderBy('account_code')->get();
    }
    
    public function getById($id)
    {
        return ChartOfAccount::with('parentAccount')->findOrFail($id);
    }
    
    public function create($data)
    {
        return DB::transaction(function () use ($data) {
            $data['created_by'] = Auth::id();
            
            return ChartOfAccount::create($data);
        });
    }
    
    public function update($id, $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $account = ChartOfAccount::findOrFail($id);
            $data['updated_by'] = Auth::id();
            
            $account->update($data);
            return $account;
        });
    }
    
    public function delete($id)
    {
        return DB::transaction(function () use ($id) {
            $account = ChartOfAccount::findOrFail($id);
            
            // Check if account has child accounts
            if ($account->childAccounts()->count() > 0) {
                throw new \Exception('Cannot delete account with child accounts');
            }
            
            // Check if account has journal entries
            if ($account->journalDetails()->count() > 0) {
                throw new \Exception('Cannot delete account with journal entries');
            }
            
            return $account->delete();
        });
    }
    
    public function getAccountTree()
    {
        $accounts = ChartOfAccount::with('childAccounts')
                    ->whereNull('parent_account_id')
                    ->orderBy('account_code')
                    ->get();
                    
        return $this->buildTree($accounts);
    }
    
    private function buildTree($accounts)
    {
        $tree = [];
        
        foreach ($accounts as $account) {
            $item = [
                'id' => $account->id,
                'account_code' => $account->account_code,
                'name' => $account->name,
                'type' => $account->type,
                'balance' => $account->balance,
                'is_active' => $account->is_active,
            ];
            
            if ($account->childAccounts->count() > 0) {
                $item['children'] = $this->buildTree($account->childAccounts);
            }
            
            $tree[] = $item;
        }
        
        return $tree;
    }
}