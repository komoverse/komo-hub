<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Komoverse Hub Login</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/b71ce7388c.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <script src="https://unpkg.com/@solana/web3.js@latest/lib/index.iife.min.js"></script>
      <script src="https://cdn.jsdelivr.net/gh/ethereumjs/browser-builds/dist/ethereumjs-tx/ethereumjs-tx-1.3.3.min.js"></script>
        <style>
            .red {
                color: red;
            }
            .green {
                color: lime;
            }
            a {
                color: lime;
                text-decoration: none;
            }
        </style>
    </head>
    <body style="background: #aaa">
        @yield('content')
        @yield('script')
        <div style="display: none">
            <form action="{{ url('phantom-login') }}" id="phantomLoginForm" method="POST">
                @csrf
                <input type="hidden" name="wallet_pubkey" id="phantomWalletPubkey">    
            </form>
        </div>
    <script>
            var isPhantomConnected = false;
            const isPhantomInstalled = window.phantom?.solana?.isPhantom;

            $(document).ready(function() {
                console.log("phantom " + isPhantomInstalled);
                // cekWallet();
                console.log(solanaWeb3);
            });

            function phantomLogin() {
                event.preventDefault();
                if (isPhantomInstalled) {
                    window.phantom.solana.connect();
                    // Check for Solana & Phantom
                    provider = window.solana;
                    provider.connect().then(function(value){
                        console.log(value.publicKey.toString());
                        $('#phantomWalletPubkey').val(value.publicKey.toString());
                        $('#phantomLoginForm').submit();
                    });
                }
            }
        </script>
    </body>
    </html>
