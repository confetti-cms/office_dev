@php($error = null)
@if(request()->cookie('state') !== request()->parameter('state'))
    @php($error = 'Error: The state parameter is not the same as the cookie state. Please try again.')
@elseif(!request()->parameter('code'))
    @php($error = 'Error: The code parameter is not set. Please try again.')
@else
    @php
        $code = request()->parameter('code');
        if ($code === null) {
            throw new \RuntimeException('Code is null');
        }
        $response = (new \Confetti\Helpers\Client())->get('confetti-cms-auth/callback?code=' . $code);
        try {
            $contents = json_decode($response, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            throw new \RuntimeException($e->getMessage(), $e->getCode(), $e);
        }

        $accessToken = $contents['auth']['access_token'];
        setcookie('access_token', $accessToken, [
            'expires' => time()+60*60*10,
            'path' => '/',
        ]);
        $redirectAfterLogin = request()->cookie('redirect_after_login') ?? '/';
        // Clear cookie
        setcookie('redirect_after_login', '', [
            'expires' => time()+60*60,
            'path' => '/',
        ]);
        header('Location: ' . $redirectAfterLogin);
    @endphp
@endif

@if($error)
    <div class="flex items-center justify-center w-full h-screen bg-gray-50 dark:bg-gray-900">
        {{$error}}
    </div>
    <div class="flex items-center justify-center w-full h-screen bg-gray-50 dark:bg-gray-900">
        <a href="/">Go to homepage</a>
    </div>
@endif
