<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate - {{ $customer_course->certificate_id }}</title>
    <style>
        @font-face {
            font-family: "BonheurRoyale";
            src: url("{{ $fonts['BonheurRoyale'] }}");
            font-weight: normal;
        }

        @font-face {
            font-family: "Playfair";
            src: url("{{ $fonts['PlayfairDisplay'] }}");
            font-weight: normal;
        }

        @font-face {
            font-family: "PlusJakarta";
            src: url("{{ $fonts['PlusJakartaSans'] }}");
            font-weight: normal;
        }

        /* Set A4 size */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: sans-serif
        }

        @page {
            size: a4 landscape;
            margin: 0
        }

        .font-BonheurRoyale {
            font-family: BonheurRoyale;
        }

        .font-Playfair {
            font-family: Playfair;
        }

        .title {
            text-transform: uppercase;
            font-weight: 700;
            font-size: 4.5vmin
        }

        .sub-title {
            font-size: 2.5vmin;
        }

        .name {
            font-weight: 700;
            font-size: 4.5vmin;
            color: #353535
        }

        .text-base {
            color: #1F4E7E
        }

        .text-secondary {
            color: #969696
        }

        .text-gray {
            color: #666666
        }

        .text-dark {
            color: #353535
        }

        .uppercase {
            text-transform: uppercase
        }

        .a4-container {
            width: 99vmin;
            height: 70vmin;
            margin: 0 auto;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .content {
            width: 90%;
            height: 90%;
            position: relative;
            display: flex;
            flex-direction: column;
            padding: 4vmin;
            box-sizing: border-box;
            background: url("{{ $background }}");
            background-size: cover;
            background-repeat: no-repeat;
            margin: auto;
            font-size: 1.5vmin;
        }

        .body {
            max-width: 65%;
        }

        .footer {
            display: flex;
            justify-content: space-between;
            width: 100%;
            margin-top: auto;
            padding-bottom: 3vmin;
            line-height: 1.25vmin
        }

        .footer .footer-content {
            width: 40%;
            align-self: flex-end
        }

        .footer-content p {
            font-size: 1.25vmin;
        }

        .signature hr {
            margin: .5vmin 0
        }

        .signature-wrapper {
            display: flex;
            flex-direction: column;
            gap: .75vmin;
        }

        .signature-title {
            font-size: 1vmin !important
        }

        .verify {
            text-align: right;
            font-size: 1vmin
        }

        .verify a {
            color: #2d2de6
        }

        @media print {

            @page {
                margin: 0
            }

            html,
            body {
                margin: 0;
                visibility: hidden;

            }

            .button-wrapper {
                display: none
            }
        }

        html,
        body {
            /* width: 100vw; */
            /* height: 100vh; */
            display: flex;
            flex-direction: column;
            background: whitesmoke;
            margin: 0;
            /* overflow: hidden; */
            font-family: PlusJakarta;
        }

        iframe {
            width: 90vmin;
            aspect-ratio: 7/5;
            margin: 2rem auto
        }

        .button-wrapper {
            text-align: center;
            padding-bottom: 2rem;
        }

        button {
            user-select: none;
            border-radius: 0.375rem;
            padding-top: .5rem;
            padding-bottom: .5rem;
            padding-left: .75rem;
            padding-right: .75rem;
            text-align: center;
            vertical-align: middle;
            --tw-bg-opacity: 1;
            background-color: rgb(37 99 235 / var(--tw-bg-opacity));
            --tw-text-opacity: 1;
            color: rgb(255 255 255 / var(--tw-text-opacity));
            transition-property: all;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 150ms;
            outline: none;
            border: 0;
            cursor: pointer;
        }

        button:hover {
            --tw-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --tw-shadow-colored: 0 10px 15px -3px var(--tw-shadow-color), 0 4px 6px -4px var(--tw-shadow-color);
            box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
            --tw-shadow-color: rgb(37 99 235 / 0.3);
            --tw-shadow: var(--tw-shadow-colored);
        }
    </style>
</head>

<body>
    <div class="a4-container preview">
        <div class="content">
            <div class="body">
                <img style="height: 9vmin; margin-bottom: 1vmin" src="{{ $logo }}" alt="">
                <div style="margin-bottom: 2.5vmin">
                    <h1 class="font-Playfair title text-base">Certificate</h1>
                    <h2 class="font-Playfair text-base sub-title">Of Achievement</h2>
                </div>
                <p class="font-Playfair text-gray" style="font-size: 1.5vmin">This certificate awarded to:</p>
                <h1 class="font-BonheurRoyale name" style="margin: 1.25vmin 0">
                    {{ $customer->name }}
                </h1>
                <p class="text-gray" style="font-size:1.25vmin; line-height: 1.5">
                    Yang telah berhasil menyelesaikan kelas online di <b>{{ cache('app_name') }}</b> dengan kelas
                    <b>{{ $customer_course->course->name }}</b> pada tanggal
                    <b>{{ dateTimeTranslated($customer_course->completed_at, 'd M Y') }}</b>.
                </p>
            </div>

            <div class="footer">
                <div class="footer-content">
                    <div class="signature">
                        <div class="signature-wrapper">
                            <img style="width: 16vmin; border-bottom: 1px solid #666666" src="{{ $signature['sign'] }}"
                                 alt="">
                            <div>
                                <p class="text-gray" style="margin-bottom: .375vmin">{{ $signature['name'] }}</p>
                                <p class="signature-title text-secondary">
                                    {{ $signature['title'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-content">
                    <div class="verify">
                        <b class="text-gray">Verify Certificate:</b>
                        <p class="signature-title"><a href="{{ $verify_link }}">{{ $verify_link }}</a></p>
                        <p class="text-secondary signature-title">
                            The identity of these people and their participation in the
                            course have been verified by {{ cache('app_name') }}.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (request('mode') == 'preview')
        <div class="button-wrapper">
            <button type="button" id="download">
                Download Sertifikat
            </button>
        </div>
    @endif

    <script type="text/javascript">
        (function() {
            const mode = '{{ request('mode') }}'
            const url = new URL(window.location.href);
        })()
    </script>
</body>

</html>
