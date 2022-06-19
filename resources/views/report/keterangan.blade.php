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

        <center>
            <p style="font-size: 18pt; margin-top: -20px">
                <b><u>SURAT KETERANGAN</u></b>
            </p>
            <p style="margin-top: -25px">
                Nomor : {{ $number }}
            </p>
        </center>
        <table style="width: max-content; padding: 10px; margin-top: 10px">
            <tbody>
                <tr>
                    <td>
                        Yang bertanda tangan dibawah ini :
                    </td>
                </tr>
            </tbody>
        </table>
        <table style="width: max-content; padding: 10px; margin-top: -10px">
            <tbody>
                <tr>
                    <td style="width: 170px">Nama</td>
                    <td style="width: 7px">:</td>
                    <td>{{ $headmaster->name }}</td>
                </tr>
                <tr>
                    <td style="width: 170px">NIP</td>
                    <td style="width: 7px">:</td>
                    <td>{{ $headmaster->nip }}</td>
                </tr>
                <tr>
                    <td style="width: 170px">Pangkat/Golongan</td>
                    <td style="width: 7px">:</td>
                    <td>{{ $headmaster->rank }}, {{ $headmaster->class }}</td>
                </tr>
                <tr>
                    <td style="width: 170px">Jabatan</td>
                    <td style="width: 7px">:</td>
                    <td>Kepala Sekolah</td>
                </tr>
            </tbody>
        </table>
        <table style="width: max-content; padding: 10px; margin-top: 10px">
            <tbody>
                <tr>
                    <td>
                        Dengan ini Menyatakan Bahwa :
                    </td>
                </tr>
            </tbody>
        </table>
        <table style="width: max-content; padding: 10px; margin-top: -10px">
            <tbody>
                <tr>
                    <td style="width: 170px">Nama</td>
                    <td style="width: 7px">:</td>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <td style="width: 170px">Tempat tanggal lahir</td>
                    <td style="width: 7px">:</td>
                    <td>{{ $user->birthplace }}, {{ $user->birthday }}</td>
                </tr>
                <tr>
                    <td style="width: 170px">Asal Sekolah</td>
                    <td style="width: 7px">:</td>
                    <td>SMP Negeri 1 Slahung</td>
                </tr>
                <tr>
                    <td style="width: 170px">Nomor induk / NISN</td>
                    <td style="width: 7px">:</td>
                    <td>{{ $user->ni }} / {{ $user->nisn }}</td>
                </tr>
            </tbody>
        </table>
        <table style="width: max-content; padding: 10px; margin-top: 10px">
            <tbody>
                <tr>
                    <td>
                        Anak tersebut adalah siswa SMP Negeri 1 Slahung kelas {{ $user->class }} dan telah mengikuti
                        Ujian Sekolah
                        pada tahun pelajaran {{ $setup->periode }}
                    </td>
                </tr>
            </tbody>
        </table>
        <table style="width: max-content; padding: 10px; margin-top: 10px">
            <tbody>
                <tr>
                    <td>
                        Demikian Surat Keterangan ini kami buat dengan sebenarnya, untuk dipergunakan
                        sebagaimana mestinya.
                    </td>
                </tr>
            </tbody>
        </table>
        <div style=" display: flex ">
            <div style="width: 7cm; margin-left: 11cm; margin-top: 2cm">
                <p>
                    Slahung, {{ $now }}
                    <br>
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
