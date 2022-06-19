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

        .page_break {
            page-break-before: always;
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
                                Telp. (0352) 371166</p>
                            <p style="font-size: 10pt; margin-top: -5px">Email : smpn1slahung@gmail.com
                                <br>
                                <span style="font-size: 16pt; letter-spacing: 3pt">
                                    <b>SLAHUNG</b>
                                </span>
                            </p>
                        </center>
                    </td>
                </tr>
            </table>
            <hr style="margin-top: -10px">
        </center>
        <br />

        <table style="width: max-content; padding: 10px;margin-left: 10cm">
            <tbody>
                <tr>
                    <td style="">
                        Slahung, {{ $now }}
                        <br>
                        <br>
                        <br>
                        <span style="letter-spacing: 2pt">
                            Kepada
                        </span>
                        <br>
                        Yth. Kepala Dinas Pendidikan Kab. Ponorogo
                        <br>
                        di Jl. Basuki Rahmat
                        <br>
                        <span style="letter-spacing: 2pt">
                            <b>Ponorogo</b>
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
        <center>
            <p style="font-size: 16pt; letter-spacing: 2pt">
                <b>
                    <u>
                        SURAT PENGANTAR
                    </u>
                </b>
            </p>
            <p style="font-size: 14pt; margin-top: -20px">
                <b>
                    NOMOR : {{ $number }}
                </b>
            </p>
        </center>
        <table>
            <thead style="border: solid">
                <tr>
                    <td style="border-right: solid">
                        <center>NO.</center>
                    </td>
                    <td style="border-right: solid">
                        <center>ISI SURAT</center>
                    </td>
                    <td style="border-right: solid">
                        <center>JUMLAH</center>
                    </td>
                    <td>
                        <center>KETERANGAN</center>
                    </td>
                </tr>
            </thead>
            <tbody style="border-right: solid; border-left: solid; border-bottom: solid">
                <tr>
                    <td style="border-right: solid">
                        1.
                    </td>
                    <td style="border-right: solid; width: 10cm">
                        Daftar Usul Pensiun {{ $user->type }}:
                        <br>a.n: <br>
                        Nama : {{ $user->teacher != null ? $user->teacher->name : $user->staff->name }} <br>
                        NIP : {{ $user->teacher != null ? $user->teacher->nip : $user->staff->nip }} <br>
                        Pangkat/Gol : {{ $user->teacher != null ? $user->teacher->rank : $user->staff->rank }} /
                        {{ $user->teacher != null ? $user->teacher->class : $user->staff->class }}<br>
                        TMT Pensiun : {{ $date }}
                    </td>
                    <td style="border-right: solid">
                        4 Bendel
                    </td>
                    <td>
                        Dikirim dengan hormat untuk mendapatkan penyelesaian lebih lanjut
                    </td>
                </tr>
            </tbody>
        </table>
        <p>
            Diterima Tanggal : ..........
        </p>
        <div style="display: flex">
            <div style="width: 7cm; margin-left: 1cm; ">
                <p>
                    Yang menerima
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <span style=" font-weight: bold;"><u>..................................</u></span>
                    <br>
                    <span style="font-weight: bold;">NIP. .........................</span>
                </p>
            </div>
        </div>
        <div style="display: flex ">
            <div style="width: 7cm; margin-left: 11cm; margin-top: -4.4cm">
                <p>
                    Kepala SMPN 1 Kec. Slahung
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
        {{-- <div class="page_break"></div>
        <center>
            <table style="margin-left: 1.2cm">
                <tr>
                    <td>
                        <img src="{{ public_path('assets/images/logo.png') }}" style="width:3cm; margin-left: -1cm">
                    </td>
                    <td>
                        <center style="margin-top: -10px">
                            <p style="font-size: 12pt">
                                PEMERINTAH KABUPATEN PONOROGO<br>
                                <span style="font-size: 16pt">
                                    <b>DINAS PENDIDIKAN
                                    </b>
                                </span>
                                <br>
                                Jalan Basuki Rahmad Telp. (0352) 481479 Faxs (0352) 483542
                            </p>
                            <p style="font-size: 16pt; margin-top: -15px">
                                <b>
                                    <u>PONOROGO</u>
                                </b>
                            </p>
                            <p style="margin-left: 11cm; margin-top: -15px">
                                Kode Pos 63418
                            </p>
                        </center>
                    </td>
                </tr>
            </table>
            <div style="margin-top: -15px">

                <hr>
            </div>
        </center>
        <p style="margin-left: 13cm">Ponorogo,</p> --}}
    </div>
</body>

</html>
