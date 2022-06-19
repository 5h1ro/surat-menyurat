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
            <p style="font-size: 14pt; margin-top: -20px">
                <b>SURAT KETERANGAN <br>PENGGANTI IJAZAH / STTB YANG HILANG</b>
            </p>
            <p style="margin-top: -20px">
                Nomor : {{ $number }}
            </p>
        </center>
        <table style="width: max-content; padding: 10px; margin-top: -10px">
            <tbody>
                <tr>
                    <td>
                        Yang bertanda tangan dibawah ini Kepala SMP Negeri 1 Kec. Slahung
                    </td>
                </tr>
                <tr>
                    <td>
                        Kecamatan : Slahung
                    </td>
                </tr>
                <tr>
                    <td>
                        Kabupaten : Ponorogo
                    </td>
                </tr>
            </tbody>
        </table>
        <center style="margin-top: -10px">
            <b>PROPINSI JAWA TIMUR</b>
        </center>
        <table style="width: max-content; padding: 10px; margin-top: -10px">
            <tbody>
                <tr>
                    <td>
                        Menerangkan bahwa
                    </td>
                </tr>
            </tbody>
        </table>
        <table style="width: max-content; padding: 10px; margin-top: -20px">
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
                    <td style="width: 170px">Anak Tuan / Nyonya</td>
                    <td style="width: 7px">:</td>
                    <td>{{ $request->ayahsih }} / {{ $request->ibusih }}</td>
                </tr>
            </tbody>
        </table>
        <table style="width: max-content; padding: 10px; margin-top: -10px">
            <tbody>
                <tr>
                    <td>
                        Telah menamatkan pelajaran pada Sekolah tersebut di atas, dan telah:
                    </td>
                </tr>
            </tbody>
        </table>
        <center><b>LULUS ( Berhasil )</b></center>
        <table style="width: max-content; padding: 10px; margin-top: 0px">
            <tbody>
                <tr>
                    <td>
                        Dalam menempuh ujian akhir ( Evaluasi Belajar Tahap Akhir ) pada Tahun Ajaran
                        {{ $request->tahun_ajaransih }} dan
                        telah mendapat ijasah / STTB dengan Nomor : {{ $request->no_ijazahsih }}
                        Yang bersangkutan terakhir tercatat sebagai murid dengan Nomor Induk :
                        {{ $user->ni }}
                        Keterangan ini dikeluarkan setelah diadakan penelitian berdasarkan bukti-bukti yang sah menurut
                        hukum, berupa :
                    </td>
                </tr>
            </tbody>
        </table>
        <table style="width: max-content; padding: 10px; margin-top: -10px">
            <tbody>
                <tr>
                    <td style="width: 15px"><b>1</b></td>
                    <td style="width: 7px">:</td>
                    <td>Surat Lapor dari POLSEK Slahung tanggal 20 Pebruari 2009 No. STLKB/122/11/2009/POLSEK</td>
                </tr>
                <tr>
                    <td style="width: 15px"><b>2</b></td>
                    <td style="width: 7px">:</td>
                    <td>Surat permohonan ybs kepada Kepala SMPN 1 Slahung bermaterai Rp. 6.000,-</td>
                </tr>
                <tr>
                    <td style="width: 15px"><b>3</b></td>
                    <td style="width: 7px">:</td>
                    <td>Surat pernyataan kehilangan bermaterai Rp. 6.000,-</td>
                </tr>
                <tr>
                    <td style="width: 15px"><b>4</b></td>
                    <td style="width: 7px">:</td>
                    <td>Surat Keterangan telah disiarkan media elektronika.</td>
                </tr>
                <tr>
                    <td style="width: 15px"><b>5</b></td>
                    <td style="width: 7px">:</td>
                    <td>Foto kopi Raport yang dilegalisir dan menunjukkan Aslinya</td>
                </tr>
                <tr>
                    <td style="width: 15px"><b>6</b></td>
                    <td style="width: 7px">:</td>
                    <td>Foto kopi Buku Induk yang dilegalisir dan menunjukkan Aslinya</td>
                </tr>
                <tr>
                    <td style="width: 15px"><b>7</b></td>
                    <td style="width: 7px">:</td>
                    <td>Foto kopi KTP.</td>
                </tr>
                <tr>
                    <td style="width: 15px"><b>8</b></td>
                    <td style="width: 7px">:</td>
                    <td>Foto kopi ijazah di bawahnya</td>
                </tr>
            </tbody>
        </table>
        <table style="width: max-content; padding: 10px; margin-top: -10px">
            <tbody>
                <tr>
                    <td>
                        Demikian surat keterangan ini diberikan sebagai pengganti IJAZAH / STTB yang hilang untuk dapat
                        dipergunakan sebagaimana mestinya.
                    </td>
                </tr>
            </tbody>
        </table>
        <div style=" display: flex ">
            <div style="width: 7cm; margin-left: 11cm; margin-top: -10px">
                <p>
                    Slahung, {{ $now }}
                    <br>
                    Kepala Sekolah
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
