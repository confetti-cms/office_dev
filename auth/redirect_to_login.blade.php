<div
        class="flex items-center justify-center w-full h-screen bg-gray-50 dark:bg-gray-900"
>
    Redirect to login page...
</div>
@pushonce('script_login_redirect')
    <script>
        document.addEventListener('config:init', () => {
            console.log("login redirect begin");

            let apiUrl = Alpine.store('config').getApiUrl()
            if (apiUrl === undefined) {
                console.error('apiUrl is undefined')
            }
            // Get redirect url
            let xhr = new XMLHttpRequest();
            xhr.open('GET', apiUrl + '/confetti-cms/auth/login', true);
            xhr.responseType = 'json';
            xhr.setRequestHeader('Accept', 'application/json');
            xhr.onload = function () {
                let status = xhr.status;
                if (status === 200) {
                    let date = new Date();
                    date.setTime(date.getTime() + (10 * 60 * 1000));
                    let expires = "; expires=" + date.toUTCString();
                    document.cookie = "state=" + xhr.response["state"] + expires + "; path=/";
                    // set cookie to redirect to this page after login
                    document.cookie = "redirect_after_login=" + window.location.href + "; path=/";
                    window.location.href = xhr.response["redirect_url"];
                } else {
                    console.error(status, xhr.response);
                }
            };
            xhr.send()
            console.log("request send");
        });
    </script>
@endpushonce
