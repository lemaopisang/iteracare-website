<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\ReferralCode;

class ReferralSearch extends Component
{
    public $search = '';
    public $foundUser = null;
    public $showResult = false;
    public $isLoading = false;
    public $errorMessage = '';

    public function mount($referralCode = null)
    {
        if ($referralCode) {
            $this->search = $referralCode;
            $this->searchReferral();
        }
    }

    public function searchReferral()
    {
        $this->isLoading = true;
        $this->foundUser = null;
        $this->showResult = false;
        $this->errorMessage = '';

        if (empty($this->search)) {
            $this->isLoading = false;
            $this->errorMessage = 'Silakan masukkan nama atau kode referral';
            return;
        }

        $cleanSearch = trim($this->search);
        // Basic search: exact referral code or exact name
        $user = User::where('role', 'sales')
            ->where('is_active', true)
            ->where(function($query) use ($cleanSearch) {
                $query->where('referral_code', $cleanSearch)
                      ->orWhere('name', $cleanSearch);
            })
            ->first();

        if ($user) {
            $this->foundUser = $user;
            $this->showResult = true;
        } else {
            $this->errorMessage = 'Tidak ditemukan sales representative dengan nama atau kode referral tersebut';
        }

        $this->isLoading = false;
    }

    public function clearSearch()
    {
        $this->search = '';
        $this->foundUser = null;
        $this->showResult = false;
        $this->errorMessage = '';
    }

    public function render()
    {
        return view('livewire.referral-search');
    }
}
