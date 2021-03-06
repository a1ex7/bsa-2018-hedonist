<?php

namespace Hedonist\Policies;

use Hedonist\Entities\User\User;
use Hedonist\Entities\UserList\UserList;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserListPolicy
{
    use HandlesAuthorization;

    public function delete(User $user, UserList $userList)
    {
        return $user->id === $userList->user_id;
    }

    public function update(User $user, UserList $userList)
    {
        return $user->id === $userList->user_id;
    }

    public function attachPlace(User $user, UserList $userList)
    {
        return $user->id === $userList->user->id;
    }

    public function detachPlace(User $user, UserList $userList)
    {
        return $user->id === $userList->user->id;
    }

    public function deleteImg(User $user, UserList $userList)
    {
        return $user->id === $userList->user_id;
    }
}
