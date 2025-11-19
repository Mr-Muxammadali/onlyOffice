<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Cache;

class UserObserver
{
    public function created(): void
    {
        $this->refreshCache();
    }

    public function updated(): void
    {
        $this->refreshCache();
    }

    public function deleted(): void
    {
        $this->refreshCache();
    }

    public function refreshCache(): void
    {
        $totalPage = User::paginate(15)->lastPage();
       foreach ($totalPage as $page) {
           if(Cache::has($page)) {
               Cache::forget($page);
           }else{
               break;
           }
       }
    }
}
