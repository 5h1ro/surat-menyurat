<!DOCTYPE html>
<html>

<head>
    <title>Surat Keterangan</title>
    <style>
        p {
            font-size: 12pt
        }

        .mt-05 {
            margin-top: 0.5cm;
        }

        .mt-1 {
            margin-top: 1cm;
        }

        .mt-2 {
            margin-top: 2cm;
        }

        .mt-5 {
            margin-top: 5cm;
        }

        .container {
            margin-left: 0.5cm;
            margin-top: 0cm;
            margin-right: 0.5cm;
            margin-bottom: 1.5cm;
        }

        td {
            vertical-align: top;
        }

        .point {
            width: 1cm;
        }

        .justify {
            text-align: justify;
        }

        .page_break {
            page-break-before: always;
        }

        .text {
            font-size: 11pt;
            line-height: 25px;
        }

    </style>
</head>

<body>

    <div class="container">
        <center>
            <table style="margin-left: 1.2cm">
                <tr>
                    <td>
                        <img src="{{ public_path('assets/images/logo.png') }}" style="width:2.5cm;">
                    </td>
                    <td>
                        <center style="margin-top: -10px">
                            <p style="font-size: 14pt">
                                PEMERINTAH KABUPATEN PONOROGO <br>
                                DINAS PENDIDIKAN <br>
                                <span style="font-size: 16pt">
                                    <b>SMP NEGERI 1 SLAHUNG</b>
                                </span>
                            </p>
                            <p style="font-size: 10pt; margin-top: -15px">Jl. Raya Pacitan 9 Menggare, Slahung,
                                Ponorogo.
                                Telp. (0352) 371166
                                <br>
                                <span style="font-size: 16pt; letter-spacing: 3pt">
                                    <b>SLAHUNG</b>
                                </span>
                            </p>
                        </center>
                    </td>
                </tr>
            </table>
            <hr>
        </center>
        <br />

        <table style="width: max-content; padding: 10px">
            <tbody>
                <tr>
                    <td style="width: 12cm">
                        Nomor : {{ $number }}
                        <br>
                        Lamp : -
                        <br>
                        Hal : <b>Undangan</b>
                    </td>
                    <td style="">
                        Slahung, {{ $now }}
                        <br>
                        <br>
                        <br>
                        <span style="letter-spacing: 2pt">
                            Kepada
                        </span>
                        <br>
                        Yth. Bapak/Ibu ..........
                        <br>
                        {{ $request->to }}
                        <br>
                        SMP Negeri 1 Slahung
                        <br>
                        di
                        <br>
                        <center>
                            <span style="letter-spacing: 2pt">
                                <b>TEMPAT</b>
                            </span>
                        </center>
                    </td>
                </tr>
            </tbody>
        </table>
        <table style="width: max-content; padding: 10px; margin-top: 50px">
            <tbody>
                <tr>
                    <td>
                        Mengharap kehadiran Bapak / Ibu Pengurus Komite SMP Negeri 1 Slahung besuk pada :
                    </td>
                </tr>
            </tbody>
        </table>
        <table style="width: max-content; padding: 10px; margin-top: -10px">
            <tbody>
                <tr>
                    <td style="width: 150px">
                        Hari / Tanggal
                    </td>
                    <td style="width: 7px">
                        :
                    </td>
                    <td>
                        @if ($start == $end)
                            {{ $start_day }} - {{ $end_day }}, {{ $start }} - {{ $end }}
                        @else
                            {{ $start_day }}, {{ $end }}
                        @endif

                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">
                        Jam
                    </td>
                    <td style="width: 7px">
                        :
                    </td>
                    <td>
                        {{ $request->time }} WIB
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">
                        Tempat
                    </td>
                    <td style="width: 7px">
                        :
                    </td>
                    <td>
                        {{ $request->place }}
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">
                        Keperluan
                    </td>
                    <td style="width: 7px">
                        :
                    </td>
                    <td>
                        {{ $request->necessary }}
                    </td>
                </tr>
            </tbody>
        </table>
        <div style="display: flex ">
            <div style="width: 7cm; margin-left: 11cm; margin-top: 2cm">
                <p>
                    Kepala Sekolah
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <span style="font-weight: bold;"><u>{{ $headmaster->name }}</u></span>
                    <br>
                    <span style="font-weight: bold;">NIP. {{ $headmaster->nip }}</span>
                </p>
            </div>
        </div>
    </div>
</body>

</html>
