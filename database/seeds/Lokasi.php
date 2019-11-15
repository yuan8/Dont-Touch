<?php

use Illuminate\Database\Seeder;

class Lokasi extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $provinsi=[
        	['11','ACEH','SUMATERA','ACEH'],
			['12','SUMATERA UTARA','SUMATERA','SUMUT'],
			['13','SUMATERA BARAT','SUMATERA','SUMBAR'],
			['14','RIAU','SUMATERA','RIAU'],
			['15','JAMBI','SUMATERA','JAMBI'],
			['16','SUMATERA SELATAN','SUMATERA','SUMSEL'],
			['17','BENGKULU','SUMATERA','BENGKULU'],
			['18','LAMPUNG','SUMATERA','LAMPUNG'],
			['19','KEPULAUAN BANGKA BELITUNG','SUMATERA','BABEL'],
			['21','KEPULAUAN RIAU','SUMATERA','KEPRI'],
			['31','DKI JAKARTA','JAWA-BALI','JAKARTA'],
			['32','JAWA BARAT','JAWA-BALI','JABAR'],
			['33','JAWA TENGAH','JAWA-BALI','JATENG'],
			['34','DI YOGYAKARTA','JAWA-BALI','YOGYA'],
			['35','JAWA TIMUR','JAWA-BALI','JATIM'],
			['36','BANTEN','JAWA-BALI','BANTEN'],
			['51','BALI','JAWA-BALI','BALI'],
			['52','NUSA TENGGARA BARAT','NUSA TENGGARA','N T B'],
			['53','NUSA TENGGARA TIMUR','NUSA TENGGARA','N T T'],
			['61','KALIMANTAN BARAT','KALIMANTAN','KALBAR'],
			['62','KALIMANTAN TENGAH','KALIMANTAN','KALTENG'],
			['63','KALIMANTAN SELATAN','KALIMANTAN','KALSEL'],
			['64','KALIMANTAN TIMUR','KALIMANTAN','KALTIM'],
			['65','KALIMANTAN UTARA','KALIMANTAN','KALTARA'],
			['71','SULAWESI UTARA','SULAWESI','SULUT'],
			['72','SULAWESI TENGAH','SULAWESI','SULTENG'],
			['73','SULAWESI SELATAN','SULAWESI','SULSEL'],
			['74','SULAWESI TENGGARA','SULAWESI','SULTRA'],
			['75','GORONTALO','SULAWESI','GORONTALO'],
			['76','SULAWESI BARAT','SULAWESI','SULBAR'],
			['81','MALUKU','MALUKU','MALUKU'],
			['82','MALUKU UTARA','MALUKU','MALUT'],
			['91','PAPUA','PAPUA','PAPUA'],
			['92','PAPUA BARAT','PAPUA','PAPBAR']

        ];

    DB::table('provinsi')->delete();
    DB::table('provinsi')->truncate();

    DB::connection('pgsql2')->table('provinsi')->delete();
    DB::connection('pgsql2')->table('provinsi')->truncate();


    DB::table('kabupaten')->delete();
    DB::table('kabupaten')->truncate();

    DB::connection('pgsql2')->table('kabupaten')->delete();
    DB::connection('pgsql2')->table('kabupaten')->truncate();



        foreach ($provinsi as $key => $value) {
        	DB::table('provinsi')->insert(
        		[

        		'id_provinsi'=>$value[0],
        		'nama'=>$value[1],
        		'pulau'=>$value[2],
        		'nama_singkat'=>$value[3]
        		]
        	);

        	DB::connection('pgsql2')->table('provinsi')->insert(
        		[

        		'id_provinsi'=>$value[0],
        		'nama'=>$value[1],
        		'pulau'=>$value[2],
        		'nama_singkat'=>$value[3]
        		]
        	);
        }

        $kota=[
        	['1101','KABUPATEN ACEH SELATAN',0],
			['1102','KABUPATEN ACEH TENGGARA',0],
			['1103','KABUPATEN ACEH TIMUR',0],
			['1104','KABUPATEN ACEH TENGAH',0],
			['1105','KABUPATEN ACEH BARAT',0],
			['1106','KABUPATEN ACEH BESAR',0],
			['1107','KABUPATEN PIDIE',0],
			['1108','KABUPATEN ACEH UTARA',0],
			['1109','KABUPATEN SIMEULUE',0],
			['1110','KABUPATEN ACEH SINGKIL',0],
			['1111','KABUPATEN BIREUEN',0],
			['1112','KABUPATEN ACEH BARAT DAYA',0],
			['1113','KABUPATEN GAYO LUES',0],
			['1114','KABUPATEN ACEH JAYA',0],
			['1115','KABUPATEN NAGAN RAYA',0],
			['1116','KABUPATEN ACEH TAMIANG',0],
			['1117','KABUPATEN BENER MERIAH',0],
			['1118','KABUPATEN PIDIE JAYA',0],
			['1171','KOTA BANDA ACEH',1],
			['1172','KOTA SABANG',1],
			['1173','KOTA LHOKSEUMAWE',1],
			['1174','KOTA LANGSA',1],
			['1175','KOTA SUBULUSSALAM',1],
			['1201','KABUPATEN TAPANULI TENGAH',0],
			['1202','KABUPATEN TAPANULI UTARA',0],
			['1203','KABUPATEN TAPANULI SELATAN',0],
			['1204','KABUPATEN NIAS',0],
			['1205','KABUPATEN LANGKAT',0],
			['1206','KABUPATEN KARO',0],
			['1207','KABUPATEN DELI SERDANG',0],
			['1208','KABUPATEN SIMALUNGUN',0],
			['1209','KABUPATEN ASAHAN',0],
			['1210','KABUPATEN LABUHANBATU',0],
			['1211','KABUPATEN DAIRI',0],
			['1212','KABUPATEN TOBA SAMOSIR',0],
			['1213','KABUPATEN MANDAILING NATAL',0],
			['1214','KABUPATEN NIAS SELATAN',0],
			['1215','KABUPATEN PAKPAK BHARAT',0],
			['1216','KABUPATEN HUMBANG HASUNDUTAN',0],
			['1217','KABUPATEN SAMOSIR',0],
			['1218','KABUPATEN SERDANG BEDAGAI',0],
			['1219','KABUPATEN BATU BARA',0],
			['1220','KABUPATEN PADANG LAWAS UTARA',0],
			['1221','KABUPATEN PADANG LAWAS',0],
			['1222','KABUPATEN LABUHANBATU SELATAN',0],
			['1223','KABUPATEN LABUHANBATU UTARA',0],
			['1224','KABUPATEN NIAS UTARA',0],
			['1225','KABUPATEN NIAS BARAT',0],
			['1271','KOTA MEDAN',1],
			['1272','KOTA PEMATANGSIANTAR',1],
			['1273','KOTA SIBOLGA',1],
			['1274','KOTA TANJUNG BALAI',1],
			['1275','KOTA BINJAI',1],
			['1276','KOTA TEBING TINGGI',1],
			['1277','KOTA PADANGSIDIMPUAN',1],
			['1278','KOTA GUNUNGSITOLI',1],
			['1301','KABUPATEN PESISIR SELATAN',0],
			['1302','KABUPATEN SOLOK',0],
			['1303','KABUPATEN SIJUNJUNG',0],
			['1304','KABUPATEN TANAH DATAR',0],
			['1305','KABUPATEN PADANG PARIAMAN',0],
			['1306','KABUPATEN AGAM',0],
			['1307','KABUPATEN LIMA PULUH KOTA',0],
			['1308','KABUPATEN PASAMAN',0],
			['1309','KABUPATEN KEPULAUAN MENTAWAI',0],
			['1310','KABUPATEN DHARMASRAYA',0],
			['1311','KABUPATEN SOLOK SELATAN',0],
			['1312','KABUPATEN PASAMAN BARAT',0],
			['1371','KOTA PADANG',1],
			['1372','KOTA SOLOK',1],
			['1373','KOTA SAWAHLUNTO',1],
			['1374','KOTA PADANG PANJANG',1],
			['1375','KOTA BUKITTINGGI',1],
			['1376','KOTA PAYAKUMBUH',1],
			['1377','KOTA PARIAMAN',1],
			['1401','KABUPATEN KAMPAR',0],
			['1402','KABUPATEN INDRAGIRI HULU',0],
			['1403','KABUPATEN BENGKALIS',0],
			['1404','KABUPATEN INDRAGIRI HILIR',0],
			['1405','KABUPATEN PELALAWAN',0],
			['1406','KABUPATEN ROKAN HULU',0],
			['1407','KABUPATEN ROKAN HILIR',0],
			['1408','KABUPATEN SIAK',0],
			['1409','KABUPATEN KUANTAN SINGINGI',0],
			['1410','KABUPATEN KEPULAUAN MERANTI',0],
			['1471','KOTA PEKANBARU',1],
			['1472','KOTA DUMAI',1],
			['1501','KABUPATEN KERINCI',0],
			['1502','KABUPATEN MERANGIN',0],
			['1503','KABUPATEN SAROLANGUN',0],
			['1504','KABUPATEN BATANGHARI',0],
			['1505','KABUPATEN MUARO JAMBI',0],
			['1506','KABUPATEN TANJUNG JABUNG BARAT',0],
			['1507','KABUPATEN TANJUNG JABUNG TIMUR',0],
			['1508','KABUPATEN BUNGO',0],
			['1509','KABUPATEN TEBO',0],
			['1571','KOTA JAMBI',1],
			['1572','KOTA SUNGAI PENUH',1],
			['1601','KABUPATEN OGAN KOMERING ULU',0],
			['1602','KABUPATEN OGAN KOMERING ILIR',0],
			['1603','KABUPATEN MUARA ENIM',0],
			['1604','KABUPATEN LAHAT',0],
			['1605','KABUPATEN MUSI RAWAS',0],
			['1606','KABUPATEN MUSI BANYUASIN',0],
			['1607','KABUPATEN BANYUASIN',0],
			['1608','KABUPATEN OGAN KOMERING ULU TIMUR',0],
			['1609','KABUPATEN OGAN KOMERING ULU SELATAN',0],
			['1610','KABUPATEN OGAN ILIR',0],
			['1611','KABUPATEN EMPAT LAWANG',0],
			['1612','KABUPATEN PENUKAL ABAB LEMATANG ILIR',0],
			['1613','KABUPATEN MUSI RAWAS UTARA',0],
			['1671','KOTA PALEMBANG',1],
			['1672','KOTA PAGAR ALAM',1],
			['1673','KOTA LUBUK LINGGAU',1],
			['1674','KOTA PRABUMULIH',1],
			['1701','KABUPATEN BENGKULU SELATAN',0],
			['1702','KABUPATEN REJANG LEBONG',0],
			['1703','KABUPATEN BENGKULU UTARA',0],
			['1704','KABUPATEN KAUR',0],
			['1705','KABUPATEN SELUMA',0],
			['1706','KABUPATEN MUKO MUKO',0],
			['1707','KABUPATEN LEBONG',0],
			['1708','KABUPATEN KEPAHIANG',0],
			['1709','KABUPATEN BENGKULU TENGAH',0],
			['1771','KOTA BENGKULU',1],
			['1801','KABUPATEN LAMPUNG SELATAN',0],
			['1802','KABUPATEN LAMPUNG TENGAH',0],
			['1803','KABUPATEN LAMPUNG UTARA',0],
			['1804','KABUPATEN LAMPUNG BARAT',0],
			['1805','KABUPATEN TULANG BAWANG',0],
			['1806','KABUPATEN TANGGAMUS',0],
			['1807','KABUPATEN LAMPUNG TIMUR',0],
			['1808','KABUPATEN WAY KANAN',0],
			['1809','KABUPATEN PESAWARAN',0],
			['1810','KABUPATEN PRINGSEWU',0],
			['1811','KABUPATEN MESUJI',0],
			['1812','KABUPATEN TULANG BAWANG BARAT',0],
			['1813','KABUPATEN PESISIR BARAT',0],
			['1871','KOTA BANDAR LAMPUNG',1],
			['1872','KOTA METRO',1],
			['1901','KABUPATEN BANGKA',0],
			['1902','KABUPATEN BELITUNG',0],
			['1903','KABUPATEN BANGKA SELATAN',0],
			['1904','KABUPATEN BANGKA TENGAH',0],
			['1905','KABUPATEN BANGKA BARAT',0],
			['1906','KABUPATEN BELITUNG TIMUR',0],
			['1971','KOTA PANGKAL PINANG',1],
			['2101','KABUPATEN BINTAN',0],
			['2102','KABUPATEN KARIMUN',0],
			['2103','KABUPATEN NATUNA',0],
			['2104','KABUPATEN LINGGA',0],
			['2105','KABUPATEN KEPULAUAN ANAMBAS',0],
			['2171','KOTA BATAM',1],
			['2172','KOTA TANJUNG PINANG',1],
			['3101','KABUPATEN ADM KEP SERIBU',0],
			['3171','KOTA JAKARTA PUSAT',1],
			['3172','KOTA JAKARTA UTARA',1],
			['3173','KOTA JAKARTA BARAT',1],
			['3174','KOTA JAKARTA SELATAN',1],
			['3175','KOTA JAKARTA TIMUR',1],
			['3201','KABUPATEN BOGOR',0],
			['3202','KABUPATEN SUKABUMI',0],
			['3203','KABUPATEN CIANJUR',0],
			['3204','KABUPATEN BANDUNG',0],
			['3205','KABUPATEN GARUT',0],
			['3206','KABUPATEN TASIKMALAYA',0],
			['3207','KABUPATEN CIAMIS',0],
			['3208','KABUPATEN KUNINGAN',0],
			['3209','KABUPATEN CIREBON',0],
			['3210','KABUPATEN MAJALENGKA',0],
			['3211','KABUPATEN SUMEDANG',0],
			['3212','KABUPATEN INDRAMAYU',0],
			['3213','KABUPATEN SUBANG',0],
			['3214','KABUPATEN PURWAKARTA',0],
			['3215','KABUPATEN KARAWANG',0],
			['3216','KABUPATEN BEKASI',0],
			['3217','KABUPATEN BANDUNG BARAT',0],
			['3218','KABUPATEN PANGANDARAN',0],
			['3271','KOTA BOGOR',1],
			['3272','KOTA SUKABUMI',1],
			['3273','KOTA BANDUNG',1],
			['3274','KOTA CIREBON',1],
			['3275','KOTA BEKASI',1],
			['3276','KOTA DEPOK',1],
			['3277','KOTA CIMAHI',1],
			['3278','KOTA TASIKMALAYA',1],
			['3279','KOTA BANJAR',1],
			['3301','KABUPATEN CILACAP',0],
			['3302','KABUPATEN BANYUMAS',0],
			['3303','KABUPATEN PURBALINGGA',0],
			['3304','KABUPATEN BANJARNEGARA',0],
			['3305','KABUPATEN KEBUMEN',0],
			['3306','KABUPATEN PURWOREJO',0],
			['3307','KABUPATEN WONOSOBO',0],
			['3308','KABUPATEN MAGELANG',0],
			['3309','KABUPATEN BOYOLALI',0],
			['3310','KABUPATEN KLATEN',0],
			['3311','KABUPATEN SUKOHARJO',0],
			['3312','KABUPATEN WONOGIRI',0],
			['3313','KABUPATEN KARANGANYAR',0],
			['3314','KABUPATEN SRAGEN',0],
			['3315','KABUPATEN GROBOGAN',0],
			['3316','KABUPATEN BLORA',0],
			['3317','KABUPATEN REMBANG',0],
			['3318','KABUPATEN PATI',0],
			['3319','KABUPATEN KUDUS',0],
			['3320','KABUPATEN JEPARA',0],
			['3321','KABUPATEN DEMAK',0],
			['3322','KABUPATEN SEMARANG',0],
			['3323','KABUPATEN TEMANGGUNG',0],
			['3324','KABUPATEN KENDAL',0],
			['3325','KABUPATEN BATANG',0],
			['3326','KABUPATEN PEKALONGAN',0],
			['3327','KABUPATEN PEMALANG',0],
			['3328','KABUPATEN TEGAL',0],
			['3329','KABUPATEN BREBES',0],
			['3371','KOTA MAGELANG',1],
			['3372','KOTA SURAKARTA',1],
			['3373','KOTA SALATIGA',1],
			['3374','KOTA SEMARANG',1],
			['3375','KOTA PEKALONGAN',1],
			['3376','KOTA TEGAL',1],
			['3401','KABUPATEN KULON PROGO',0],
			['3402','KABUPATEN BANTUL',0],
			['3403','KABUPATEN GUNUNGKIDUL',0],
			['3404','KABUPATEN SLEMAN',0],
			['3471','KOTA YOGYAKARTA',1],
			['3501','KABUPATEN PACITAN',0],
			['3502','KABUPATEN PONOROGO',0],
			['3503','KABUPATEN TRENGGALEK',0],
			['3504','KABUPATEN TULUNGAGUNG',0],
			['3505','KABUPATEN BLITAR',0],
			['3506','KABUPATEN KEDIRI',0],
			['3507','KABUPATEN MALANG',0],
			['3508','KABUPATEN LUMAJANG',0],
			['3509','KABUPATEN JEMBER',0],
			['3510','KABUPATEN BANYUWANGI',0],
			['3511','KABUPATEN BONDOWOSO',0],
			['3512','KABUPATEN SITUBONDO',0],
			['3513','KABUPATEN PROBOLINGGO',0],
			['3514','KABUPATEN PASURUAN',0],
			['3515','KABUPATEN SIDOARJO',0],
			['3516','KABUPATEN MOJOKERTO',0],
			['3517','KABUPATEN JOMBANG',0],
			['3518','KABUPATEN NGANJUK',0],
			['3519','KABUPATEN MADIUN',0],
			['3520','KABUPATEN MAGETAN',0],
			['3521','KABUPATEN NGAWI',0],
			['3522','KABUPATEN BOJONEGORO',0],
			['3523','KABUPATEN TUBAN',0],
			['3524','KABUPATEN LAMONGAN',0],
			['3525','KABUPATEN GRESIK',0],
			['3526','KABUPATEN BANGKALAN',0],
			['3527','KABUPATEN SAMPANG',0],
			['3528','KABUPATEN PAMEKASAN',0],
			['3529','KABUPATEN SUMENEP',0],
			['3571','KOTA KEDIRI',1],
			['3572','KOTA BLITAR',1],
			['3573','KOTA MALANG',1],
			['3574','KOTA PROBOLINGGO',1],
			['3575','KOTA PASURUAN',1],
			['3576','KOTA MOJOKERTO',1],
			['3577','KOTA MADIUN',1],
			['3578','KOTA SURABAYA',1],
			['3579','KOTA BATU',1],
			['3601','KABUPATEN PANDEGLANG',0],
			['3602','KABUPATEN LEBAK',0],
			['3603','KABUPATEN TANGERANG',0],
			['3604','KABUPATEN SERANG',0],
			['3671','KOTA TANGERANG',1],
			['3672','KOTA CILEGON',1],
			['3673','KOTA SERANG',1],
			['3674','KOTA TANGERANG SELATAN',1],
			['5101','KABUPATEN JEMBRANA',0],
			['5102','KABUPATEN TABANAN',0],
			['5103','KABUPATEN BADUNG',0],
			['5104','KABUPATEN GIANYAR',0],
			['5105','KABUPATEN KLUNGKUNG',0],
			['5106','KABUPATEN BANGLI',0],
			['5107','KABUPATEN KARANGASEM',0],
			['5108','KABUPATEN BULELENG',0],
			['5171','KOTA DENPASAR',1],
			['5201','KABUPATEN LOMBOK BARAT',0],
			['5202','KABUPATEN LOMBOK TENGAH',0],
			['5203','KABUPATEN LOMBOK TIMUR',0],
			['5204','KABUPATEN SUMBAWA',0],
			['5205','KABUPATEN DOMPU',0],
			['5206','KABUPATEN BIMA',0],
			['5207','KABUPATEN SUMBAWA BARAT',0],
			['5208','KABUPATEN LOMBOK UTARA',0],
			['5271','KOTA MATARAM',1],
			['5272','KOTA BIMA',1],
			['5301','KABUPATEN KUPANG',0],
			['5302','KABUPATEN TIMOR TENGAH SELATAN',0],
			['5303','KABUPATEN TIMOR TENGAH UTARA',0],
			['5304','KABUPATEN BELU',0],
			['5305','KABUPATEN ALOR',0],
			['5306','KABUPATEN FLORES TIMUR',0],
			['5307','KABUPATEN SIKKA',0],
			['5308','KABUPATEN ENDE',0],
			['5309','KABUPATEN NGADA',0],
			['5310','KABUPATEN MANGGARAI',0],
			['5311','KABUPATEN SUMBA TIMUR',0],
			['5312','KABUPATEN SUMBA BARAT',0],
			['5313','KABUPATEN LEMBATA',0],
			['5314','KABUPATEN ROTE NDAO',0],
			['5315','KABUPATEN MANGGARAI BARAT',0],
			['5316','KABUPATEN NAGEKEO',0],
			['5317','KABUPATEN SUMBA TENGAH',0],
			['5318','KABUPATEN SUMBA BARAT DAYA',0],
			['5319','KABUPATEN MANGGARAI TIMUR',0],
			['5320','KABUPATEN SABU RAIJUA',0],
			['5321','KABUPATEN MALAKA',0],
			['5371','KOTA KUPANG',1],
			['6101','KABUPATEN SAMBAS',0],
			['6102','KABUPATEN MEMPAWAH',0],
			['6103','KABUPATEN SANGGAU',0],
			['6104','KABUPATEN KETAPANG',0],
			['6105','KABUPATEN SINTANG',0],
			['6106','KABUPATEN KAPUAS HULU',0],
			['6107','KABUPATEN BENGKAYANG',0],
			['6108','KABUPATEN LANDAK',0],
			['6109','KABUPATEN SEKADAU',0],
			['6110','KABUPATEN MELAWI',0],
			['6111','KABUPATEN KAYONG UTARA',0],
			['6112','KABUPATEN KUBU RAYA',0],
			['6171','KOTA PONTIANAK',1],
			['6172','KOTA SINGKAWANG',1],
			['6201','KABUPATEN KOTAWARINGIN BARAT',0],
			['6202','KABUPATEN KOTAWARINGIN TIMUR',0],
			['6203','KABUPATEN KAPUAS',0],
			['6204','KABUPATEN BARITO SELATAN',0],
			['6205','KABUPATEN BARITO UTARA',0],
			['6206','KABUPATEN KATINGAN',0],
			['6207','KABUPATEN SERUYAN',0],
			['6208','KABUPATEN SUKAMARA',0],
			['6209','KABUPATEN LAMANDAU',0],
			['6210','KABUPATEN GUNUNG MAS',0],
			['6211','KABUPATEN PULANG PISAU',0],
			['6212','KABUPATEN MURUNG RAYA',0],
			['6213','KABUPATEN BARITO TIMUR',0],
			['6271','KOTA PALANGKARAYA',1],
			['6301','KABUPATEN TANAH LAUT',0],
			['6302','KABUPATEN KOTABARU',0],
			['6303','KABUPATEN BANJAR',0],
			['6304','KABUPATEN BARITO KUALA',0],
			['6305','KABUPATEN TAPIN',0],
			['6306','KABUPATEN HULU SUNGAI SELATAN',0],
			['6307','KABUPATEN HULU SUNGAI TENGAH',0],
			['6308','KABUPATEN HULU SUNGAI UTARA',0],
			['6309','KABUPATEN TABALONG',0],
			['6310','KABUPATEN TANAH BUMBU',0],
			['6311','KABUPATEN BALANGAN',0],
			['6371','KOTA BANJARMASIN',1],
			['6372','KOTA BANJARBARU',1],
			['6401','KABUPATEN PASER',0],
			['6402','KABUPATEN KUTAI KARTANEGARA',0],
			['6403','KABUPATEN BERAU',0],
			['6407','KABUPATEN KUTAI BARAT',0],
			['6408','KABUPATEN KUTAI TIMUR',0],
			['6409','KABUPATEN PENAJAM PASER UTARA',0],
			['6411','KABUPATEN MAHAKAM ULU',0],
			['6471','KOTA BALIKPAPAN',1],
			['6472','KOTA SAMARINDA',1],
			['6474','KOTA BONTANG',1],
			['6501','KABUPATEN BULUNGAN',0],
			['6502','KABUPATEN MALINAU',0],
			['6503','KABUPATEN NUNUKAN',0],
			['6504','KABUPATEN TANA TIDUNG',0],
			['6571','KOTA TARAKAN',1],
			['7101','KABUPATEN BOLAANG MONGONDOW',0],
			['7102','KABUPATEN MINAHASA',0],
			['7103','KABUPATEN KEPULAUAN SANGIHE',0],
			['7104','KABUPATEN KEPULAUAN TALAUD',0],
			['7105','KABUPATEN MINAHASA SELATAN',0],
			['7106','KABUPATEN MINAHASA UTARA',0],
			['7107','KABUPATEN MINAHASA TENGGARA',0],
			['7108','KABUPATEN BOLAANG MONGONDOW UTARA',0],
			['7109','KABUPATEN KEP SIAU TAGULANDANG BIARO',0],
			['7110','KABUPATEN BOLAANG MONGONDOW TIMUR',0],
			['7111','KABUPATEN BOLAANG MONGONDOW SELATAN',0],
			['7171','KOTA MANADO',1],
			['7172','KOTA BITUNG',1],
			['7173','KOTA TOMOHON',1],
			['7174','KOTA KOTAMOBAGU',1],
			['7201','KABUPATEN BANGGAI',0],
			['7202','KABUPATEN POSO',0],
			['7203','KABUPATEN DONGGALA',0],
			['7204','KABUPATEN TOLI TOLI',0],
			['7205','KABUPATEN BUOL',0],
			['7206','KABUPATEN MOROWALI',0],
			['7207','KABUPATEN BANGGAI KEPULAUAN',0],
			['7208','KABUPATEN PARIGI MOUTONG',0],
			['7209','KABUPATEN TOJO UNA UNA',0],
			['7210','KABUPATEN SIGI',0],
			['7211','KABUPATEN BANGGAI LAUT',0],
			['7212','KABUPATEN MOROWALI UTARA',0],
			['7271','KOTA PALU',1],
			['7301','KABUPATEN KEPULAUAN SELAYAR',0],
			['7302','KABUPATEN BULUKUMBA',0],
			['7303','KABUPATEN BANTAENG',0],
			['7304','KABUPATEN JENEPONTO',0],
			['7305','KABUPATEN TAKALAR',0],
			['7306','KABUPATEN GOWA',0],
			['7307','KABUPATEN SINJAI',0],
			['7308','KABUPATEN BONE',0],
			['7309','KABUPATEN MAROS',0],
			['7310','KABUPATEN PANGKAJENE KEPULAUAN',0],
			['7311','KABUPATEN BARRU',0],
			['7312','KABUPATEN SOPPENG',0],
			['7313','KABUPATEN WAJO',0],
			['7314','KABUPATEN SIDENRENG RAPPANG',0],
			['7315','KABUPATEN PINRANG',0],
			['7316','KABUPATEN ENREKANG',0],
			['7317','KABUPATEN LUWU',0],
			['7318','KABUPATEN TANA TORAJA',0],
			['7322','KABUPATEN LUWU UTARA',0],
			['7324','KABUPATEN LUWU TIMUR',0],
			['7326','KABUPATEN TORAJA UTARA',0],
			['7371','KOTA MAKASSAR',1],
			['7372','KOTA PARE PARE',1],
			['7373','KOTA PALOPO',1],
			['7401','KABUPATEN KOLAKA',0],
			['7402','KABUPATEN KONAWE',0],
			['7403','KABUPATEN MUNA',0],
			['7404','KABUPATEN BUTON',0],
			['7405','KABUPATEN KONAWE SELATAN',0],
			['7406','KABUPATEN BOMBANA',0],
			['7407','KABUPATEN WAKATOBI',0],
			['7408','KABUPATEN KOLAKA UTARA',0],
			['7409','KABUPATEN KONAWE UTARA',0],
			['7410','KABUPATEN BUTON UTARA',0],
			['7411','KABUPATEN KOLAKA TIMUR',0],
			['7412','KABUPATEN KONAWE KEPULAUAN',0],
			['7413','KABUPATEN MUNA BARAT',0],
			['7414','KABUPATEN BUTON TENGAH',0],
			['7415','KABUPATEN BUTON SELATAN',0],
			['7471','KOTA KENDARI',1],
			['7472','KOTA BAU BAU',1],
			['7501','KABUPATEN GORONTALO',0],
			['7502','KABUPATEN BOALEMO',0],
			['7503','KABUPATEN BONE BOLANGO',0],
			['7504','KABUPATEN PAHUWATO',0],
			['7505','KABUPATEN GORONTALO UTARA',0],
			['7571','KOTA GORONTALO',1],
			['7601','KABUPATEN MAMUJU UTARA',0],
			['7602','KABUPATEN MAMUJU',0],
			['7603','KABUPATEN MAMASA',0],
			['7604','KABUPATEN POLEWALI MANDAR',0],
			['7605','KABUPATEN MAJENE',0],
			['7606','KABUPATEN MAMUJU TENGAH',0],
			['8101','KABUPATEN MALUKU TENGAH',0],
			['8102','KABUPATEN MALUKU TENGGARA',0],
			['8103','KABUPATEN MALUKU TENGGARA BARAT',0],
			['8104','KABUPATEN BURU',0],
			['8105','KABUPATEN SERAM BAGIAN TIMUR',0],
			['8106','KABUPATEN SERAM BAGIAN BARAT',0],
			['8107','KABUPATEN KEPULAUAN ARU',0],
			['8108','KABUPATEN MALUKU BARAT DAYA',0],
			['8109','KABUPATEN BURU SELATAN',0],
			['8171','KOTA AMBON',1],
			['8172','KOTA TUAL',1],
			['8201','KABUPATEN HALMAHERA BARAT',0],
			['8202','KABUPATEN HALMAHERA TENGAH',0],
			['8203','KABUPATEN HALMAHERA UTARA',0],
			['8204','KABUPATEN HALMAHERA SELATAN',0],
			['8205','KABUPATEN KEPULAUAN SULA',0],
			['8206','KABUPATEN HALMAHERA TIMUR',0],
			['8207','KABUPATEN PULAU MOROTAI',0],
			['8208','KABUPATEN PULAU TALIABU',0],
			['8271','KOTA TERNATE',1],
			['8272','KOTA TIDORE KEPULAUAN',1],
			['9101','KABUPATEN MERAUKE',0],
			['9102','KABUPATEN JAYAWIJAYA',0],
			['9103','KABUPATEN JAYAPURA',0],
			['9104','KABUPATEN NABIRE',0],
			['9105','KABUPATEN KEPULAUAN YAPEN',0],
			['9106','KABUPATEN BIAK NUMFOR',0],
			['9107','KABUPATEN PUNCAK JAYA',0],
			['9108','KABUPATEN PANIAI',0],
			['9109','KABUPATEN MIMIKA',0],
			['9110','KABUPATEN SARMI',0],
			['9111','KABUPATEN KEEROM',0],
			['9112','KABUPATEN PEGUNUNGAN BINTANG',0],
			['9113','KABUPATEN YAHUKIMO',0],
			['9114','KABUPATEN TOLIKARA',0],
			['9115','KABUPATEN WAROPEN',0],
			['9116','KABUPATEN BOVEN DIGOEL',0],
			['9117','KABUPATEN MAPPI',0],
			['9118','KABUPATEN ASMAT',0],
			['9119','KABUPATEN SUPIORI',0],
			['9120','KABUPATEN MAMBERAMO RAYA',0],
			['9121','KABUPATEN MAMBERAMO TENGAH',0],
			['9122','KABUPATEN YALIMO',0],
			['9123','KABUPATEN LANNY JAYA',0],
			['9124','KABUPATEN NDUGA',0],
			['9125','KABUPATEN PUNCAK',0],
			['9126','KABUPATEN DOGIYAI',0],
			['9127','KABUPATEN INTAN JAYA',0],
			['9128','KABUPATEN DEIYAI',0],
			['9171','KOTA JAYAPURA',1],
			['9201','KABUPATEN SORONG',0],
			['9202','KABUPATEN MANOKWARI',0],
			['9203','KABUPATEN FAK FAK',0],
			['9204','KABUPATEN SORONG SELATAN',0],
			['9205','KABUPATEN RAJA AMPAT',0],
			['9206','KABUPATEN TELUK BINTUNI',0],
			['9207','KABUPATEN TELUK WONDAMA',0],
			['9208','KABUPATEN KAIMANA',0],
			['9209','KABUPATEN TAMBRAUW',0],
			['9210','KABUPATEN MAYBRAT',0],
			['9211','KABUPATEN MANOKWARI SELATAN',0],
			['9212','KABUPATEN PEGUNUNGAN ARFAK',0],
			['9271','KOTA SORONG',1]

        ];

        foreach ($kota as $key => $value) {
        	DB::table('kabupaten')->insert(
        		[
        		'id_kota'=>$value[0],
        		'nama'=>$value[1],
        		'status_kabupaten'=>$value[2],

        		]
        	);

        	DB::connection('pgsql2')->table('kabupaten')->insert(
        		[
        		'id_kota'=>$value[0],
        		'nama'=>$value[1],
        		'status_kabupaten'=>$value[2],

        		]
        	);
        }




        return 1;


    }
}
