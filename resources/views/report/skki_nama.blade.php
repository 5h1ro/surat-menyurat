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
            <p style="font-size: 16pt; margin-top: -10px">
                <b><u>SURAT KETERANGAN</u></b>
            </p>
            <p style="margin-top: -20px">
                Nomor : {{ $number }}
            </p>
        </center>
        <table style="width: max-content; padding: 10px; margin-top: 10px">
            <tbody>
                <tr>
                    <td>
                        Yang bertanda tangan dibawah ini Kepala SMP Negeri 1 Slahung, Kabupaten Ponorogo, Propinsi
                        Jawa Timur menerangkan bahwa :
                    </td>
                </tr>
            </tbody>
        </table>
        <table style="width: max-content; padding: 10px; margin-top: -10px">
            <tbody>
                <tr>
                    <td style="width: 220px">Ijazah nomor seri</td>
                    <td style="width: 7px">:</td>
                    <td>{{ $request->nomor_ijazah }}</td>
                </tr>
                <tr>
                    <td style="width: 220px">Nama</td>
                    <td style="width: 7px">:</td>
                    <td>{{ $student->name }}</td>
                </tr>
                <tr>
                    <td style="width: 220px">Tempat dan tanggal lahir</td>
                    <td style="width: 7px">:</td>
                    <td>{{ $student->birthplace }}, {{ $student_date }}</td>
                </tr>
                <tr>
                    <td style="width: 220px">Nomor Induk Siswa / NISN</td>
                    <td style="width: 7px">:</td>
                    <td>{{ $student->ni }} / {{ $student->nisn }}</td>
                </tr>
                <tr>
                    <td style="width: 220px">Nomor peserta</td>
                    <td style="width: 7px">:</td>
                    <td>{{ $request->nomor_peserta }}</td>
                </tr>
                <tr>
                    <td style="width: 220px">Tahun pelajaran</td>
                    <td style="width: 7px">:</td>
                    <td>{{ $request->tahun_pelajaran }}</td>
                </tr>
            </tbody>
        </table>
        <table style="width: max-content; padding: 10px; margin-top: 10px">
            <tbody>
                <tr>
                    <td>
                        Terdapat <b>kesalahan</b> penulisan pada :
                    </td>
                </tr>
                <tr>
                    <td>
                        <p style="text-align: justify">
                            <b>Nama Siswa</b> tertulis <b>{{ $request->nama_salahns }}</b>, sesuai dengan Kutipan
                            Akta Kelahiran yang dikeluarkan oleh Kepala Dinas Kependudukan Dan
                            Pencatatan Sipil {{ $request->dispendukcapilns }}, nomor :
                            {{ $request->nomor_aktans }} ,
                            tanggal {{ $tanggal_aktans }} dan Surat Keterangan yang dikeluarkan oleh Kepala
                            {{ $request->nama_sdns }}
                            nomor : {{ $request->sk_sdns }} Tanggal : {{ $tanggal_sk_sdns }} yang benar
                            adalah <b>{{ $request->nama_benarns }}</b>
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>
        <table style="width: max-content; padding: 10px; margin-top: 10px">
            <tbody>
                <tr>
                    <td>
                        Demikian Surat keterangan ini dibuat sebagai lampiran Ijasah yang ada
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
