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
                <b>KETERANGAN PINDAH / MUTASI MURID</b>
            </p>
            <p style="margin-top: -20px">
                Nomor : {{ $number }}
            </p>
        </center>
        <table style="width: max-content; padding: 10px; margin-top: -10px">
            <tbody>
                <tr>
                    <td style="width: 15px"><b>1</b></td>
                    <td style="width: 200px">Nomor Induk / NISN</td>
                    <td style="width: 7px">:</td>
                    <td>{{ $user->ni }} / {{ $user->nisn }}</td>
                </tr>
                <tr>
                    <td style="width: 15px"><b>2</b></td>
                    <td style="width: 200px">Nama siswa</td>
                    <td style="width: 7px">:</td>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <td style="width: 15px"><b>3</b></td>
                    <td style="width: 200px">Jenis Kelamin</td>
                    <td style="width: 7px">:</td>
                    <td>{{ $user->gender }}</td>
                </tr>
                <tr>
                    <td style="width: 15px"><b>4</b></td>
                    <td style="width: 200px">Kelas</td>
                    <td style="width: 7px">:</td>
                    <td>{{ $user->class }}</td>
                </tr>
                <tr>
                    <td style="width: 15px"><b>5</b></td>
                    <td style="width: 200px">Agama</td>
                    <td style="width: 7px">:</td>
                    <td>{{ $user->religion }}</td>
                </tr>
                <tr>
                    <td style="width: 15px"><b>6</b></td>
                    <td style="width: 200px">Tempat / Tanggal Lahir</td>
                    <td style="width: 7px">:</td>
                    <td>{{ $user->birthplace }}, {{ $user->birthday }}</td>
                </tr>
                <tr>
                    <td style="width: 15px"><b>7</b></td>
                    <td style="width: 200px">Nama Orang Tua / Wali</td>
                    <td style="width: 7px">:</td>
                    <td>{{ $user->parent }}</td>
                </tr>
                <tr>
                    <td style="width: 15px"><b>8</b></td>
                    <td style="width: 200px">Pekerjaan Orang Tua / wali</td>
                    <td style="width: 7px">:</td>
                    <td>{{ $user->parent_job }}</td>
                </tr>
                <tr>
                    <td style="width: 15px"><b>9</b></td>
                    <td style="width: 200px">Alamat</td>
                    <td style="width: 7px">:</td>
                    <td>{{ $user->address }}</td>
                </tr>
                <tr>
                    <td style="width: 15px"><b>10</b></td>
                    <td style="width: 200px">Mulai Masuk Sekolah Ini Tanggal</td>
                    <td style="width: 7px">:</td>
                    <td>{{ $masuk }}</td>
                </tr>
                <tr>
                    <td style="width: 15px"><b>11</b></td>
                    <td style="width: 200px">Berasal Dari Sekolah</td>
                    <td style="width: 7px">:</td>
                    <td>SD Negeri 1 Slahung </td>
                </tr>
                <tr>
                    <td style="width: 15px"><b>12</b></td>
                    <td style="width: 200px">Diterima di Kelas</td>
                    <td style="width: 7px">:</td>
                    <td>{{ $user->class }}</td>
                </tr>
                <tr>
                    <td style="width: 15px"><b>13</b></td>
                    <td style="width: 200px">Tanggal Pindah Keluar</td>
                    <td style="width: 7px">:</td>
                    <td>{{ $keluar }}</td>
                </tr>
                <tr>
                    <td style="width: 15px"><b>14</b></td>
                    <td style="width: 200px">Pindah / Keluar Karena</td>
                    <td style="width: 7px">:</td>
                    <td>{{ $request->alasan_mutasi }}</td>
                </tr>
                <tr>
                    <td style="width: 15px"><b>15</b></td>
                    <td style="width: 200px">Keterangan Biaya Sekolah</td>
                    <td style="width: 7px">:</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td style="width: 15px"><b></b></td>
                    <td style="width: 200px">Pekerjaan</td>
                    <td style="width: 7px">:</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td style="width: 15px"><b></b></td>
                    <td style="width: 200px">Golongan Pembayaran</td>
                    <td style="width: 7px">:</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td style="width: 15px"><b></b></td>
                    <td style="width: 200px">Uang SPP / Komite</td>
                    <td style="width: 7px">:</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td style="width: 15px"><b></b></td>
                    <td style="width: 200px">Telah membayar s.d bulan</td>
                    <td style="width: 7px">:</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td style="width: 15px"><b>16</b></td>
                    <td style="width: 200px">Keterangan</td>
                    <td style="width: 7px">:</td>
                    <td> a. Lampiran surat ini terdiri atas buku Rapor Asli </td>
                </tr>
                <tr>
                    <td style="width: 15px"><b></b></td>
                    <td style="width: 200px"></td>
                    <td style="width: 7px"></td>
                    <td> b. Setelah keluar yang bersangkutan tidak dapat diterima kembali di sekolah ini. </td>
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
