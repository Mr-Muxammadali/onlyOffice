<?php

namespace App\Services;

use App\Models\User;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use App\Repositories\Interfaces\UserInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Throwable;

class UserService
{
    public function __construct(public UserInterface $repository)
    {
    }

    public function getUserById(int $id): User
    {
        return $this->repository->getUserById($id);
    }

    public function getAll(): LengthAwarePaginator
    {
        return $this->repository->getAll();
    }
    public function countUsersFromDB(): int
    {
        return $this->repository->getCount();
    }

    public function getUsersFromDB(): Collection
    {
            return  $this->repository->getUserList();
    }
############## With  cache ################

    public function getAllFromCache(): LengthAwarePaginator
    {
        return Cache::flexible('users-page-'.request('page', 1),[60*10, 60*15],function (){
            return $this->repository->getAll();
        });
    }
    public function countUsersFromCache(): int
    {
        return Cache::flexible('count', [60*10, 60*15],function () {
            return $this->repository->getCount();
        });
    }

    public function getUsersFromCache(): Collection
    {
        return Cache::flexible('users', [60*10, 60*15],function () {
            return  $this->repository->getUserList();
        });
    }

    /**
     * @param $data
     * @return array
     * @throws Throwable
     */
    public function transfer($data): array
    {
        try {
          //  Cache::lock("users")->block(10, function () use ($data) {

                DB::beginTransaction();
                $user = User::find($data['id']);

                if ($user->balance < $data['amount']) {
                    throw ValidationException::withMessages([
                        'amount' => 'Balans yetarli emas.'
                    ]);
                }
                //send request to bank
                sleep(5);

                $this->repository->saveTransfer($data['id'], $data['amount']);

                DB::commit();

           // });

            return [$data['id'], true];
        }catch (ValidationException $e){
            DB::rollBack();
            throw $e;
        }catch (Throwable $e){
            DB::rollBack();
            logger($e->getMessage());
            return [$data['id'], false];
        }
    }
}
