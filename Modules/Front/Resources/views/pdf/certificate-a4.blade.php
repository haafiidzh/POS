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

        @font-face {
            font-family: "PlusJakarta-Bold";
            src: url("{{ $fonts['PlusJakartaSans-Bold'] }}");
            font-weight: normal;
        }

        @media print {

            @page {
                margin: 0;
            }

            html,
            body {
                margin: 0;
                visibility: hidden;
            }

            .a4-container {
                visibility: visible;
            }

            .button-wrapper {
                display: none;
            }
        }


        @page {
            size: A4 landscape;
            margin: 0;
        }

        body {
            font-family: sans-serif;
            width: 29.7cm;
            height: 21cm;
            overflow: hidden;
        }
    </style>
</head>

<body>
    <div style="width: 842px; height: 595px; position: relative; background: white">
        <img style="width: 842px; height: 595px; left: 0px; top: 0px; position: absolute" src="{{ $background }}" />
        <img style="width: 106.67px; height: 60px; left: 57px; top: 55px; position: absolute" src="{{ $logo }}" />
        <div style="left: 57px; top: 125px; position: absolute">
            <div
                 style="left: 0px; top: 0px; position: absolute; color: #1F4E7E; font-size: 36px; font-family: Playfair; font-weight: 400; word-wrap: break-word">
                CERTIFICATE</div>
            <div
                 style="left: 0px; top: 55px; position: absolute; color: #1F4E7E; font-size: 14px; font-family: Playfair; font-weight: 400; white-space: nowrap;">
                Of Achievement
            </div>
        </div>

        <div style="width: 445px; left: 57px; top: 233px; position: absolute; font-weight: 400; word-wrap: break-word">
            <div
                 style="left: 0px; top: 0px; position: absolute; color: #848484; font-size: 12px; font-family: Playfair; word-wrap: break-word">
                This certificate awarded to:
            </div>
            <div
                 style="left: 0px; top: 20px; position: absolute; color: black; font-size: 40px; font-family: BonheurRoyale; word-wrap: break-word">
                {{ $customer->name }}
            </div>
        </div>
        <div
             style="width: 416px; left: 57px; top: 335px; position: absolute; color: #848484; font-size: 11px; font-family: PlusJakarta; font-weight: 400; word-wrap: break-word; line-height: 1.25">
            Yang telah berhasil menyelesaikan kelas online di <span
                  style="font-family: PlusJakarta-Bold">{{ cache('app_name') }}</span> dengan kelas
            <span style="font-family: PlusJakarta-Bold">{{ $customer_course->course->name }}</span> pada tanggal
            <span
                  style="font-family: PlusJakarta-Bold">{{ dateTimeTranslated($customer_course->completed_at, 'd M Y') }}</span>.
        </div>
        <div style="width: 728px; height: 121px; left: 57px; top: 410px; position: absolute">
            <div style="width: 223px; height: 121px; left: 0px; top: 0px; position: absolute">
                <img style="width: 148px; height: 80px; left: 0px; top: 0px; position: absolute; border-bottom: 1px #525252 solid"
                     src="{{ $signature['sign'] }}" />
                <div style="left: 0px; top: 88px; position: absolute; line-height: 0">
                    <span
                          style="color: #2C2C2C; font-size: 12px; font-family: PlusJakarta-Bold; line-height: 18px; word-wrap: break-word;">
                        {{ $signature['name'] }}
                    </span>
                    <br>
                    <span
                          style="color: #848484; font-size: 10px; font-family: PlusJakarta; font-weight: 400; line-height: 10px; word-wrap: break-word;  white-space: nowrap">
                        {{ $signature['title'] }}
                    </span>
                </div>
            </div>
            <div style="width: 350px; left: 370px; top: 62px; position: absolute; text-align: right; line-height: 1">
                <p
                   style="color: black; font-size: 9px; font-family: PlusJakarta-Bold; line-height: 13.50px; word-wrap: break-word; margin: 0">
                    Verify Certificate:
                </p>
                <p
                   style="color: #2563EB; font-size: 9px; font-family: PlusJakarta; font-weight: 400; line-height: 1.25; word-wrap: break-word; margin: 0">
                    <a href="{{ $verify_link }}">{{ $verify_link }}</a>
                </p>
                <p
                   style="color: #848484; font-size: 9px; font-family: PlusJakarta; font-weight: 400; line-height: 1; word-wrap: break-word; margin: 0">
                    The identity of these people and their participation in the course have been verified by
                    {{ cache('app_name') }}.
                </p>
            </div>
        </div>
    </div>
    {{-- <div class="a4-container">
        <div class="content">
            <div class="body">
                <img style="height: 2cm; margin-bottom: .675cm" src="{{ $logo }}" alt="">
                <div style="margin-bottom: 1cm">
                    <h1 class="font-Playfair title text-base">Certificate</h1>
                    <h2 class="font-Playfair text-base sub-title">Of Achievement</h2>
                </div>
                <p class="font-Playfair text-gray" style="font-size: 14px">This certificate awarded to:</p>
                <h1 class="font-BonheurRoyale name" style="margin: .375cm 0">
                    {{ $customer->name }}
                </h1>
                <p class="text-gray" style="font-size:12px; line-height: 1.5">
                    Yang telah berhasil menyelesaikan kelas online di <span style="font-family: PlusJakarta-Bold">{{ cache('app_name') }}</b> dengan kelas
                    <span style="font-family: PlusJakarta-Bold">{{ $customer_course->course->name }}</b> pada tanggal
                    <span style="font-family: PlusJakarta-Bold">{{ dateTimeTranslated($customer_course->completed_at, 'd M Y') }}</b>.
                </p>
            </div>

            <div class="footer">
                <div class="footer-content">
                    <div class="signature">
                        <div class="signature-wrapper">
                            <img style="width: 5cm; border-bottom: 1px solid #666666" src="{{ $signature['sign'] }}"
                                 alt="">
                            <div>
                                <p class="text-gray" style="margin-bottom: 3px">{{ $signature['name'] }}</p>
                                <p class="signature-title text-secondary">
                                    {{ $signature['title'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-content">
                    <div class="verify">
                        <b class="">Verify Certificate:</b>
                        <p class="signature-title"><a href="{{ $verify_link }}">{{ $verify_link }}</a></p>
                        <p class="text-secondary signature-title">
                            The identity of these people and their participation in the
                            course have been verified by {{ cache('app_name') }}.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
</body>

</html>
