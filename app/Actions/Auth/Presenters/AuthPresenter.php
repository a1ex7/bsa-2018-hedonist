<?php

namespace Hedonist\Actions\Auth\Presenters;

use Hedonist\Actions\Auth\Responses\AuthenticateResponseInterface;
use Hedonist\Actions\SocialAuth\Responses\SocialRedirectResponse;
use Hedonist\Actions\Auth\Responses\GetUserResponse;

class AuthPresenter
{
    public static function presentError(\Exception $exception): string
    {
        return $exception->getMessage();
    }


    public static function presentAuthenticateResponse(AuthenticateResponseInterface $response): array
    {
        return [
            'access_token' => $response->getToken(),
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ];
    }

    public static function presentUser(GetUserResponse $response): array
    {
        $user = $response->getUser();
        $userInfo = $response->getUserInfo();

        return [
            'id' => $user->id,
            'email' => $user->email,
            'first_name' => $userInfo->first_name,
            'last_name' => $userInfo->last_name,
            'avatar_url' => $userInfo->avatar_url,
            'phone_number' => $userInfo->phone_number,
            'date_of_birth' => $userInfo->date_of_birth,
            'facebook_url' => $userInfo->facebook_url,
            'instagram_url' => $userInfo->instagram_url,
            'twitter_url' => $userInfo->twitter_url,
            'language' => $userInfo->language,
        ];
    }

    public static function presentSocialRedirect(SocialRedirectResponse $response)
    {
        return ['url' => $response->getUrl()];
    }
}