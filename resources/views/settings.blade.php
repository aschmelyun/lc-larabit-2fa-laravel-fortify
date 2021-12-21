<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Settings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (session('status') === 'two-factor-authentication-enabled')
                        <div class="mb-4 font-medium text-green-600">
                            Two factor authentication has been enabled for your account.
                        </div>
                        <div class="mb-8">
                            <h3 class="font-semibold text-lg mb-4">Scan this QR code into your authenticator app.</h3>
                            {!! request()->user()->twoFactorQrCodeSvg() !!}
                        </div>
                        <div class="mb-8">
                            <h3 class="font-semibold text-lg mb-4">Record these recovery codes in a safe place in case you can't access your authenticator app.</h3>
                            @foreach(request()->user()->recoveryCodes() as $code)
                                {{ $code }}<br>
                            @endforeach
                        </div>
                    @endif
                    @if (request()->user()->two_factor_secret)
                        <h3 class="font-semibold text-lg mb-4">You have two-factor authentication enabled.</h3>
                        <form action="/user/two-factor-authentication" method="POST">
                            @csrf
                            @method('DELETE')
                            <x-button>Disable 2FA</x-button>
                        </form>
                    @else
                        <h3 class="font-semibold text-lg mb-4">You do not have two-factor authentication enabled.</h3>
                        <form action="/user/two-factor-authentication" method="POST">
                            @csrf
                            <x-button>Enable 2FA</x-button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
