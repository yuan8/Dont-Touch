<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\ClientException;
use Storage;


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class ExcelSIPD extends Controller
{
    //


    public function read(){

      $dir='public/data-source-2020.json';
      if(file_exists(storage_path('app/'.$dir))){
          $datas=file_get_contents(storage_path('app/'.$dir));
          $datas=json_decode($datas,true)['data'];
          $dt=[];
          foreach ($datas as $key => $value) {
            if($value['pagu']!=0){
                $dt[]=$value;
            }
          }
          return view('excel-sipd')->with('datas',$dt);
      }
    }

    public static function toNum($data) {
    $data=$data-1;

    $alphabet = array( 'a', 'b', 'c', 'd', 'e',
                       'f', 'g', 'h', 'i', 'j',
                       'k', 'l', 'm', 'n', 'o',
                       'p', 'q', 'r', 's', 't',
                       'u', 'v', 'w', 'x', 'y',
                       'z'
                       );
        if(($data - 26) < 0){
          return strtoupper($alphabet[$data]);
        }else{
          $looping=-1;
          do {
            $looping+=1;
            $data -=26;
          } while (($data - 26) > 26);

          return strtoupper($alphabet[$looping].$alphabet[$data]);

        }


    }


    public function getExcel(Request $request){
      $url='https://sipd.kemendagri.go.id/run/serv/api.php?tahun=2020&kodepemda='.$request->kodepemda;

      $spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();

      $result= file_get_contents($url);
      $result=json_decode($result,true);
      $kode_pemda=$result[0]['kodepemda'];

      $i=1;

      foreach ($result as $key => $value) {
        if($value['kodebidang']=='1.03'){
          $sheet->setCellValue(static::toNum(1).$i, $value['kodebidang']);
          $sheet->setCellValue(static::toNum(2).$i, $value['uraibidang']);
          $key_bidang=static::toNum(1).$i;
          $pagu=0;
          $i++;
          foreach ($value['program'] as $pr) {
            $pr=(array) $pr;

            $sheet->setCellValue(static::toNum(1).$i, $pr['kodebidang']);
            $sheet->setCellValue(static::toNum(2).$i, $pr['uraibidang']);
            $i++;

            foreach ($pr['capaian'] as $capaian) {
              // capaian
              $capaian=(array) $capaian;

              $sheet->setCellValue(static::toNum(3).$i, $capaian['kodeindikator']);
              $sheet->setCellValue(static::toNum(4).$i, $capaian['tolokukur']);
              $sheet->setCellValue(static::toNum(5).$i, $capaian['satuan']);
              $sheet->setCellValue(static::toNum(6).$i, $capaian['real_p3']);
              $sheet->setCellValue(static::toNum(7).$i, $capaian['pagu_p3']);
              $sheet->setCellValue(static::toNum(8).$i, $capaian['real_p2']);
              $sheet->setCellValue(static::toNum(9).$i, $capaian['pagu_p2']);
              $sheet->setCellValue(static::toNum(10).$i, $capaian['real_p1']);
              $sheet->setCellValue(static::toNum(11).$i, $capaian['pagu_p1']);
              $sheet->setCellValue(static::toNum(12).$i, $capaian['target']);
              $sheet->setCellValue(static::toNum(13).$i, $capaian['pagu']);
              $sheet->setCellValue(static::toNum(14).$i, $capaian['pagu_p']);
              $sheet->setCellValue(static::toNum(15).$i, $capaian['target_n1']);
              $sheet->setCellValue(static::toNum(16).$i, $capaian['pagu_n1']);
              $i++;
            }

            foreach ($pr['kegiatan'] as $keg) {
              $keg=(array) $keg;
              $sheet->setCellValue(static::toNum(1).$i, $keg['kodekegiatan']);
              $sheet->setCellValue(static::toNum(2).$i, $keg['uraikegiatan']);



              // sumber dana

                  foreach ($keg['indikator'] as $capaian) {
                    // capaian
                    $capaian=(array) $capaian;
                    $sheet->setCellValue(static::toNum(3).$i, $capaian['kodeindikator']);
                    $sheet->setCellValue(static::toNum(4).$i, $capaian['tolokukur']);
                    $sheet->setCellValue(static::toNum(5).$i, $capaian['satuan']);
                    $sheet->setCellValue(static::toNum(6).$i, $capaian['real_p3']);
                    $sheet->setCellValue(static::toNum(7).$i, $capaian['pagu_p3']);
                    $sheet->setCellValue(static::toNum(8).$i, $capaian['real_p2']);
                    $sheet->setCellValue(static::toNum(9).$i, $capaian['pagu_p2']);
                    $sheet->setCellValue(static::toNum(10).$i, $capaian['real_p1']);
                    $sheet->setCellValue(static::toNum(11).$i, $capaian['pagu_p1']);
                    $sheet->setCellValue(static::toNum(12).$i, $capaian['target']);
                    $sheet->setCellValue(static::toNum(13).$i, $capaian['pagu']);
                    $sheet->setCellValue(static::toNum(14).$i, $capaian['pagu_p']);
                    $sheet->setCellValue(static::toNum(15).$i, $capaian['target_n1']);
                    $sheet->setCellValue(static::toNum(16).$i, $capaian['pagu_n1']);
                    $i++;

                  }



                  if( is_array ($keg['sumberdana'])){
                    if(!isset($keg['sumberdana']['pagu'])){
                      foreach ($keg['sumberdana'] as $value) {
                        // code...

                        if(isset($value['pagu'])){
                          $sheet->setCellValue(static::toNum(17).$i, $value['pagu']);
                        }
                        if(isset($value['sumberdana'])){
                          $sheet->setCellValue(static::toNum(18).$i, $value['sumberdana']);
                        }
                        if(isset($value['kodesumberdana'])){
                          $sheet->setCellValue(static::toNum(19).$i, $value['kodesumberdana']);
                        }
                        $i++;
                      }

                    }else{
                      $sheet->setCellValue(static::toNum(17).$i, $keg['sumberdana']['pagu']);
                      $sheet->setCellValue(static::toNum(18).$i, $keg['sumberdana']['sumberdana']);
                      $sheet->setCellValue(static::toNum(19).$i, $keg['sumberdana']['kodesumberdana']);
                    }


                  }

                  if( is_array ($keg['prioritas'])){

                    if( $keg['prioritas']!=null and !isset($keg['prioritas']['prioritasdaerah'])){
                        if(isset( $keg['prioritas'][2]['prioritasdaerah'])){
                          $sheet->setCellValue(static::toNum(20).$i, $keg['prioritas'][2]['prioritasdaerah']);
                        }
                        if(isset($keg['prioritas'][2]['prioritasdaerah'])){
                          $sheet->setCellValue(static::toNum(21).$i, $keg['prioritas'][0]['prioritasnasional']);
                        }
                        if(isset($keg['prioritas'][1]['prioritasprovinsi'])){
                          $sheet->setCellValue(static::toNum(22).$i, $keg['prioritas'][1]['prioritasprovinsi']);
                        }

                    }else{
                      if(!empty($keg['prioritas'])){
                        $sheet->setCellValue(static::toNum(20).$i, $keg['prioritas']['prioritasdaerah']);
                        $sheet->setCellValue(static::toNum(21).$i, $keg['prioritas']['prioritasnasional']);
                        $sheet->setCellValue(static::toNum(22).$i, $keg['prioritas']['prioritasprovinsi']);
                      }

                    }

                  }


                  if( is_array ($keg['lokasi'])){
                    if(!isset($keg['lokasi']['lokasi'])){
                        // dd($keg['lokasi']);
                      foreach ($keg['lokasi'] as $key => $value) {
                        if(isset( $value['lokasi'])){
                          $sheet->setCellValue(static::toNum(23).$i, $value['lokasi']);

                        }
                        if(isset( $value['kodelokasi'])){
                          $sheet->setCellValue(static::toNum(24).$i, $value['kodelokasi']);

                        }
                        if(isset( $value['detaillokasi'])){
                          $sheet->setCellValue(static::toNum(25).$i, $value['detaillokasi']);

                        }

                        $i++;
                      }

                    }else{
                      $sheet->setCellValue(static::toNum(23).$i, $keg['lokasi']['lokasi']);
                      $sheet->setCellValue(static::toNum(24).$i, $keg['lokasi']['kodelokasi']);
                      $sheet->setCellValue(static::toNum(25).$i, $keg['lokasi']['detaillokasi']);
                    }


                  }




                  $sheet->setCellValue(static::toNum(26).$i, $keg['pagu']);
                  $sheet->setCellValue(static::toNum(26).$i, $keg['pagu_p']);
                  $i++;

                  foreach ($keg['subkegiatan'] as $sub_keg) {
                    // code...
                      $sheet->setCellValue(static::toNum(1).$i, $sub_keg['kodesubkegiatan']);
                      $sheet->setCellValue(static::toNum(2).$i, $sub_keg['uraisubkegiatan']);

                      foreach ($sub_keg['indikator'] as $capaian) {
                        // capaian
                        $sheet->setCellValue(static::toNum(3).$i, $capaian['kodeindikator']);
                        $sheet->setCellValue(static::toNum(4).$i, $capaian['tolokukur']);
                        $sheet->setCellValue(static::toNum(5).$i, $capaian['satuan']);
                        $sheet->setCellValue(static::toNum(6).$i, $capaian['real_p3']);
                        $sheet->setCellValue(static::toNum(7).$i, $capaian['pagu_p3']);
                        $sheet->setCellValue(static::toNum(8).$i, $capaian['real_p2']);
                        $sheet->setCellValue(static::toNum(9).$i, $capaian['pagu_p2']);
                        $sheet->setCellValue(static::toNum(10).$i, $capaian['real_p1']);
                        $sheet->setCellValue(static::toNum(11).$i, $capaian['pagu_p1']);
                        $sheet->setCellValue(static::toNum(12).$i, $capaian['target']);
                        $sheet->setCellValue(static::toNum(13).$i, $capaian['pagu']);
                        $sheet->setCellValue(static::toNum(14).$i, $capaian['pagu_p']);
                        $sheet->setCellValue(static::toNum(15).$i, $capaian['target_n1']);
                        $sheet->setCellValue(static::toNum(16).$i, $capaian['pagu_n1']);
                        $i++;
                      }

                      if( is_array ($sub_keg['sumberdana']) ){
                        if(isset($sub_keg['sumberdana']['pagu'])){
                          $sheet->setCellValue(static::toNum(17).$i, $sub_keg['sumberdana']['pagu']);

                        }
                        if(isset($sub_keg['sumberdana']['sumberdana'])){
                          $sheet->setCellValue(static::toNum(18).$i, $sub_keg['sumberdana']['sumberdana']);

                        }
                        if(isset($sub_keg['sumberdana']['kodesumberdana'])){
                          $sheet->setCellValue(static::toNum(19).$i, $sub_keg['sumberdana']['kodesumberdana']);

                        }

                      }

                      if( is_array ($sub_keg['prioritas'])){

                        $sheet->setCellValue(static::toNum(20).$i, $sub_keg['prioritas']['prioritasdaerah']);
                        $sheet->setCellValue(static::toNum(21).$i, $sub_keg['prioritas']['prioritasnasional']);
                        $sheet->setCellValue(static::toNum(22).$i, $sub_keg['prioritas']['prioritasprovinsi']);
                      }


                      if( is_array ($sub_keg['lokasi'])){
                        $sheet->setCellValue(static::toNum(23).$i, $sub_keg['lokasi']['lokasi']);
                        $sheet->setCellValue(static::toNum(24).$i, $sub_keg['lokasi']['kodelokasi']);
                        $sheet->setCellValue(static::toNum(25).$i, $sub_keg['lokasi']['detaillokasi']);
                      }



                      $sheet->setCellValue(static::toNum(26).$i, $sub_keg['pagu']);
                      $sheet->setCellValue(static::toNum(26).$i, $sub_keg['pagu_p']);
                      $i++;

                  }

              }
            }

            $i++;

            dd(0);
        }

      }
        // done loop

        // $sheet->setCellValue('C'.$i, $value['kodeskpd']);
        // $sheet->setCellValue('D'.$i, $value['uraiskpd']);
        return redirect('excel');

      }




}
