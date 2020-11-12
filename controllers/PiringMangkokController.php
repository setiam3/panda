<?php
namespace app\controllers;
use Yii;
use app\models\PiringMangkok;
use app\models\PiringMangkokSearch;
use kartik\mpdf\Pdf;
use yii\helpers\ArrayHelper;
class PiringMangkokController extends \yii\web\Controller
{
    public $bpjs_surety_id="2";
    public $jamkesda_surety_id="113";
    public function actionIndex()
    {
        $where='';
        $searchModel = new PiringMangkokSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$where);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionGeneratecol(){
        $model=(new PiringMangkok())->attributes;
//        echo "[[";
        foreach(array_keys($model) as $name){
            // echo "     [\n";
            // echo "         'class'=>'\kartik\grid\DataColumn',\n";
            // echo "         'attribute'=>'" . $name . "',\n";
            // echo "     ],\n".'<br>';
          // echo " ->andFilterWhere(['like', '".$name."', \$this->".$name."])".'<br>';
//
//            echo "'".$name."',".'<br>';

        }
        //echo "],'safe'],";
    }

    public function actionTranferIna(){
        $request = Yii::$app->request;
        $selection=(array)Yii::$app->request->post('selection');
        if (!empty($selection)){
            foreach ($selection as $row){
                $datas = PiringMangkok::find()->where(['visit_id'=>$row])->all();
                foreach ($datas as $data){

                    if ($data->surety_id == '3' || $data->surety_id == '159'){//3fgh 159 bnm,
                        $payor_id = '71' ;//erty
                        $request  = '{
					       		"metadata": {
									"method": "generate_claim_number"
					        	},
					      	  	"data": {
									"payor_id": "'.$payor_id.'"
								}
					        }';

                        //konek
                        $dt = $this->connect_inacbg($request,$data->surety_id,$this->bpjs_surety_id,$this->jamkesda_surety_id);
                        $sep_no = $dt['response']['claim_number'];

                       if (!empty($sep_no)) {
                        /*uncomment update*/
                           $date_sep = date('Y-m-d');
                           $update = Yii::$app->db->createCommand()
                               ->update('yanmed.visit', array(
                                   'sep_no'=>$sep_no,
                                   'sep_tgl'=>date('Y-m-d'),
                               ),'visit_id=:visit_id',array(':visit_id'=>$data->visit_id))->execute();
                       }

                    }else{
                        if(empty($data->sep_no)){
                        echo "Error - Pasien ".$data->px_norm." ".$data->px_name." Tidak memiliki nomer SEP";
                        die;
                        }else{
                            $sep_no=$data->sep_no;
                        }
                    }
                    //sukses

                    //klaim baru
                    $member_nomer = empty($data->pxsurety_no)? "0" : $data->pxsurety_no;
                    $sjp_no = empty($sep_no)? "000" : $sep_no;
                    $px_norm  = empty($data->px_norm)? "0" : $data->px_norm;

                    $noka = $member_nomer;
                    $nosep = $sjp_no;
                    $px_norm = $px_norm;
                    $px_name = $data->px_name;
                    $birth = $data->px_birthdate." 00:00:00";

                    if($data->px_sex == "L"){
                        $gender = "1";
                    }else{
                        $gender = "2";
                    }

                    $request = '{
                        "metadata": {
                            "method": "new_claim"
                        },
                        "data": {
                            "nomor_kartu": "'.$noka.'",
                            "nomor_sep": "'.$nosep.'",
                            "nomor_rm": "'.$px_norm.'",
                            "nama_pasien": "'.$px_name.'",
                            "tgl_lahir": "'.$birth.'",
                            "gender": "'.$gender.'"
                        }
                    }';
//                    konek

                     $dt = $this->connect_inacbg($request,$data->surety_id,$this->bpjs_surety_id,$this->jamkesda_surety_id);
                    /*uncomment update*/
                     $metadata = $dt['metadata']; //status berhasil
//                    var_dump($metadata);die();

                     if($metadata['code'] == 200 && $metadata['message'] == "Ok"){
                         $hasil = $dt['response'];
                         $item["code"] = $metadata['code'];
                         $item['message'] = $metadata['message'];
                         $item["patient_id"] =$hasil["patient_id"];
                         $item["admission_id"] =$hasil["admission_id"];
                         $item["hospital_admission_id"] =$hasil["hospital_admission_id"];
//                         $this->set_claim_data($datas,$nosep,$member_nomer);
                         $this->set_claim_data($noka,$nosep,$datas);

                     }
                     else{
                         if($metadata['code'] == 400 && $metadata['error_no'] == "E2007"){
                             $this->set_claim_data($noka,$nosep,$datas);
                         }
                         else{
                             $item['code'] = $metadata['code'];
                             $item['message'] = $metadata['message'];
                             $item['error_no'] = $metadata['error_no'];
                             $item['norm'] = $data['duplicate'][0]["nomor_rm"];

                             if (!empty($item['error_no'])) {
                                 echo "Error - ".$item['error_no']." - ".$item['message'];
                             }
                             die;
                         }
                     }
                    /*end update*/
                    /*komen*/
//                   $this->set_claim_data($datas,$nosep);
                }
            }
        }
    }

    public function set_claim_data($noka, $nosep, $param){ //$param = $data
        $member_no = $noka;
        $jamkesda_surety_id="113";
        $class_id_vip="5";
        $kode_tarif="BP";

        foreach ($param as $data){
            if ($data->klb_id == 667 || $data->klb_id == 668) {
                $covid19_status_cd = 1;
            }elseif ($data->klb_id > 668 && $data->klb_id < 673) {
                $covid19_status_cd = 2;
            }elseif ($data->klb_id > 672 && $data->klb_id <= 675) {
                $covid19_status_cd = 3;
            }else{
                $covid19_status_cd = 0;
            }

            $jenis = $data->kelas_pelayanan; //jumlah naik kelas
            foreach ($jenis as $js){
                $jenis_kelas = $js['f1']; //RI u RJ
            }

            foreach ($data->ruang_rawat_px as $row){
            $jumlah_hari_upgrade = $row['f5'];
            $surety_class_id = $row['f7'];

            }
            if ($jenis_kelas == 'RI'){
                $jenis_rawat = '1'; // rawat inap
                $kelas_rawat = $surety_class_id-1;


                if(count($jenis) >= $data->class_id && $data->class_id <= 4){//if($param['visit_class_id'] >= $param['surety_class_id'] && $param['visit_class_id'] <= 4){
                    $naik_kelas = '0';
                    $kelas_baru = '';
                    $lama_rawat = ''; //kurang jelas

                }else{
                    $naik_kelas = '1';
                    $lama_rawat =$jumlah_hari_upgrade;
                    if($data->class_id == 3){ // kelas 2
                        $kelas_baru = 'kelas_2';
                    }
                    else if($data->class_id == 2){
                        $kelas_baru = 'kelas_1';
                    }
                    else if($data->class_id == $class_id_vip){
                        $kelas_baru = 'vip';
                    }else{
                        $kelas_baru = 'vvip';
                    }
                }

                if(empty($data->visit_end_date)){
                    $visit_end_date = date('Y-m-d H:i:s');
                }else{
                    $visit_end_date = $data->visit_end_date;
                }

                $tgl_pulang = strtotime(date('Y-m-d',strtotime($data->visit_end_date)));
                $tgl_masuk  = strtotime(date('Y-m-d',strtotime($data->visit_date)));
                $los = floor(($tgl_pulang-$tgl_masuk) / (60 * 60 * 24));
                $episodes = '1;'.($los+1);

            }else{ //rawatjalan
                $naik_kelas = '0';
                $kelas_baru = '';
                $episodes = '#';
                $lama_rawat = '';
                $jenis_rawat = '2'; // rawat jalan
                $kelas_rawat = '3'; // reguler atau eksekutif
                if(empty($data->visit_end_date)){ //  bila tanggal pulang kosong, isikan dengan tanggal masuk
                    $visit_end_date = $data->visit_date;
                }
                else{
                    $visit_end_date = $data->visit_end_date;
                }
                $param['episodes'] = '#';
            }

            $billing = $data->billing_inacbg;
            $bill_ina = 0;
            foreach ($billing as $bill){
                if (!empty($bill['f2'])){
                    $bill_ina += $bill['f3'];
                }else{
                    $bill_ina = $bill['f3'];
                }

            }



            $icus = $data->ruang_rawat_px;
            $jICU = 0;
            foreach ($icus as $icu){
                $jICU += $icu['f5'];
            }
            if(empty($jICU)){
                $ke_icu = '';
                $jumlah_hari_icu = '';
            }else{
                $ke_icu = '1';
                $jumlah_hari_icu = $jICU;
            }

            if($data->visit_end_cause_id == 48 ){
                $keadaan_krs = '1'; // atas izin dokter
            }
            else if($data->visit_end_cause_id == 50 ){
                $keadaan_krs = '2'; // dirujuk ke rs lain
            }
            else if($data->visit_end_cause_id == 54 ){
                $keadaan_krs = '3'; // atas permintaan sendiri
            }
            else if($data->visit_end_cause_id == 52 ){
                $keadaan_krs = '4'; // meninggal
            }
            else if($data->visit_end_cause_id == 55 ){
                $keadaan_krs = '5'; // lain2
            }

            // 9 = p2tp2a - jkn
            // 26 = dinkes - jkn
            // 113 = jamkesda - jamkesda
            // 116 = maskin provinsi - jkn
            // 117 = penerima bantuan sosial - jamkesos
            // 118 = jampersal - jkn

            $param['nomor_kartu_t'] = 'kartu_jkn';

            if($data->surety_id == $jamkesda_surety_id){
                $payor_id = '5' ; //'5'
                $payor_cd =  '001'; //'001';
            }
            else if($data->surety_id == '117'){ // jameksos
                $payor_id = '6' ;
                $payor_cd =  'JKS';
            }else if($data->surety_id == '3' || $data->surety_id == '159' ){ // APBD/APBN
                $payor_id = '71' ;
                $payor_cd =  'COVID-';
                $member_no = $data->px_noktp;
                $param['nomor_kartu_t'] = 'nik';
            }
            else{
                $payor_id =  '3'; //'3';
                $payor_cd =  'JKN'; //'JKN' ;
            }

            $sql = "select distinct kode_tagihan from finance.mv_pendapatan where visit_id = '$data->visit_id' AND kode_tagihan in ('4.01.43','C.02')";
            $select = \Yii::$app->db->createCommand($sql)->queryAll();

            if (!empty($select)){
                foreach ($select as $key => $v) {
                    if ($v['kode_tagihan'] == '4.01.43') {
                        $select['pemulasaraan_jenazah'] = 1;
                    }

                    if ($v['kode_tagihan'] == 'C.02') {
                        $select['mobil_jenazah'] = 1;
                    }
                }
            }else{
                $select['pemulasaraan_jenazah'] = $select['mobil_jenazah'] = 0;
            }


            $request = '{
						"metadata": {
							"method": "set_claim_data",
							"nomor_sep": "'.$nosep.'"
						},
						"data": {
						    "nomor_sep": "'.$nosep.'",
							"nomor_kartu": "'.$member_no.'",
							"tgl_masuk": "'.$data->visit_date.'",
							"tgl_pulang": "'.$visit_end_date.'",
							"icu_indikator": "'.$ke_icu.'",
                            "icu_los": "'.$jumlah_hari_icu.'",
							"upgrade_class_ind": "'.$naik_kelas.'",
							"upgrade_class_class": "'.$kelas_baru.'",
                            "upgrade_class_los": "'.$lama_rawat.'",
							"jenis_rawat": "'.$jenis_rawat.'",
							"kelas_rawat": "'.$kelas_rawat.'",
							"discharge_status": "'.$keadaan_krs.'",
							"diagnosa": "'.$data->diagnosa_px.'",
							"procedure": "'.$data->tindakan_px.'",
							"tarif_rs":  '.$bill_ina.',
							"nama_dokter": "'.$data->visit_end_doctor_name.'",
							"kode_tarif": "'.$kode_tarif.'",
							"coder_nik": "245",
							"payor_id": "'.$payor_id.'",
							"payor_cd": "'.$payor_cd.'",
							"covid19_status_cd": "'.$covid19_status_cd.'",
							"nomor_kartu_t": "'.$param['nomor_kartu_t'].'",
							"pemulasaraan_jenazah": "'.$select['pemulasaraan_jenazah'].'",
							"kantong_jenazah": "0",
							"peti_jenazah": "0",
						 	"plastik_erat": "0",
							"desinfektan_jenazah": "0",
							"mobil_jenazah": "'.$select['mobil_jenazah'].'",
							"desinfektan_mobil_jenazah": "0",
							"covid19_cc_ind": "0",
							"episodes":"'.$episodes.'"
						}
					}';

            //conek server
             $dt = $this->connect_inacbg($request,$data->surety_id,$this->bpjs_surety_id,$this->jamkesda_surety_id);
            /*uncomment konek*/

             $metadata = $dt['metadata'];
            var_dump($param);
             if($metadata['code'] == 200 && $metadata['message'] == "Ok"){
                $this->actionUploadberkas($param[0]['visit_id'],$nosep);
                 Yii::$app->db->createCommand()
                     ->insert('yanmed.transfer_inacbg', array(
                     'srv_type'=>$jenis_kelas,
                     'visit_id'=>$data->visit_id,
                     'px_norm'=>$data->px_norm,
                     'px_nama'=>$data->px_name,
                     'user_id'=>164,
                     'transfer_date'=>date('Y-m-d'),
                     'transfer_act'=>date('Y-m-d'),
                 ))->execute();
//                 //update visit
                 Yii::$app->db->createCommand()
                     ->update('yanmed.visit', array(
                         'transfer_id'=>Yii::$app->db->getLastInsertID(),
                     ), 'visit_id=:visit_id',array(':visit_id'=>$data->visit_id))->execute();
                 echo json_encode($metadata);
             }
             else{
                $this->delete_claim($nosep,$param);
                 $item['code'] 	= $metadata['code'];
                 $item['message'] = $metadata['message'];
                 $item['error_no'] = $metadata['error_no'];
                 echo "Error - ".$item['error_no']." - ".$item['message'];
                 die;
             }
/*end update*/

        }

    }

//    public function actionUploadberkas($visit_id)
    public function actionUploadberkas($visit_id,$nosep)
    {
        $model = PiringMangkok::find()->where(['visit_id'=>$visit_id])->all();

        $roomRi = (new \yii\db\Query())
            ->select(['mu.unit_name',
                'r.room_name',
                'br.billingroom_qty',
                'billingroom_start_date',
                'billingroom_end_date',
                'mb.bed_no',
                's.srv_type',
                's.srv_date'])
            ->from('yanmed.services as s')
            ->join('INNER JOIN','admin.ms_unit as mu','s.unit_id = mu.unit_id')
            ->join('LEFT JOIN','yanmed.billingroom as br','br.srv_id = s.srv_id')
            ->join('LEFT JOIN','admin.ms_room as r','r.room_id = br.room_id')
            ->join('LEFT JOIN','yanmed.ms_bed as mb','br.bed_id = mb.bed_id')
            ->where(['s.visit_id' => $visit_id])
            ->orderBy('s.srv_date')
            ->all();
        /*upload ruang rawat*/
        $pdf = new Pdf;
        $pdf->destination="S";
        $pdf->content=$this->renderPartial('v_berkas_ruang_perawatan',['model'=>$model,'roomRi'=>$roomRi]);
//        return $pdf->render();die();
        $content = base64_encode($pdf->render());


         $request = '{
		 	    "metadata": {
		 	        "method": "file_upload",
		 	        "nomor_sep": "'.$nosep.'",
		 	      "file_class": "ruang_rawat",
		 	      "file_name": "ruang_rawat_pasien.pdf"
		 	    },
		 	    "data": "'.$content.'"
		 	}';

         $act = $this->connect_inacbg($request,$model[0]['surety_id'],$this->bpjs_surety_id,$this->jamkesda_surety_id);
//
        /*end upload ruang rawat*/

        /*upload berkass billing*/
        $sql = "SELECT kelompok_tagihan,concat(bill_name,'[',to_char(tgl_tagihan,'DD-MM-YYYY'),']') as deskripsi_tagihan,billing_qty as quantity_tagihan,tarifcito_value,tagihan_pasien FROM finance.mv_pendapatan WHERE visit_id = '$visit_id' order by kelompok_tagihan";
        $bea_tindakan = \Yii::$app->db->createCommand($sql)->queryAll();

        $pdf = new Pdf;
        $pdf->destination="S";
        $pdf->content=$this->renderPartial('v_tagihan_pasien',['model'=>$model,'bea_tindakan'=>$bea_tindakan]);
//       return $pdf->render();
        $content=base64_encode($pdf->render());

        $request = '{
		    "metadata": {
		        "method": "file_upload",
		        "nomor_sep": "'.$nosep.'",
		      "file_class": "tagihan",
		      "file_name": "tagihan.pdf"
		    },
		    "data": "'.$content.'"
		}';
        $act = $this->connect_inacbg($request,$model[0]['surety_id'],$this->bpjs_surety_id,$this->jamkesda_surety_id);
//        var_dump($act);die();
        /*end upload berkass billing*/

        /*obat*/
            $sql="SELECT to_char(a.date_act, 'DD-MM-YYYY HH24:MM:SS') as tgl_sale,
            (sale_total - COALESCE(sale_total_returned, 0))::numeric as sale_total,
            sale_services::numeric, a.sale_num as nomor_resep, a.doctor_name as par_name,
            sr.sr_total,
            string_agg(concat(vo.item_name, '[', sd.racikan_dosis, '] x ', sd.sale_qty), '')nama_obat
            FROM farmasi.sale a LEFT JOIN yanmed.services b ON a.visit_id = b.visit_id and a.service_id = b.srv_id
            JOIN farmasi.sale_detail sd ON sd.sale_id = a.sale_id
            JOIN farmasi.v_obat vo ON sd.item_id = vo.item_id
            LEFT JOIN ( select sr.sale_id,sum(srd.total_return+sr.sr_embalase+sr.sr_services)::numeric as sr_total
                from farmasi.sale_return sr
                inner join farmasi.sale_return_detail srd on sr.sr_id = srd.sr_id group by sr.sale_id ) sr ON sr.sale_id=a.sale_id WHERE a.visit_id = ".$visit_id."
            GROUP BY a.date_act, a.sale_total, a.sale_total_returned, a.sale_services, a.sale_num, a.doctor_name, sr.sr_total;";

            $obat=Yii::$app->db->createCommand($sql)->queryAll();
        $pdf = new Pdf;
        $pdf->destination="S";
        $pdf->content=$this->renderPartial('v_berkas_obat',['model'=>$model,'obat'=>$obat]);
//        return $pdf->render();
        $content = base64_encode($pdf->render());
        $request = '{
		    "metadata": {
		        "method": "file_upload",
		        "nomor_sep": "'.$nosep.'",
		      "file_class": "resep_obat",
		      "file_name": "resep_obat.pdf"
		    },
		    "data": "'.$content.'"
		}';
        $act = $this->connect_inacbg($request,$model[0]['surety_id'],$this->bpjs_surety_id,$this->jamkesda_surety_id);
//        var_dump($act);die();
        /*end obat*/

        /*upload hasil lab*/
        $parent = '20';
        $sql ="SELECT
				DISTINCT to_char(created_at,'DD-MM-YYYY HH24:MI:SS') as tanggal
				from yanmed.checkup c
				join yanmed.services s on c.service_id = s.srv_id
				join yanmed.ms_check mc on c.ms_check_id = mc.idcheck
				join yanmed.ms_groupcheck gc on mc.idgroup = gc.idgroup
				where s.visit_id = '$visit_id' and parentgroup != '$parent'
				order by tanggal asc ";
        $tgl_checkup=Yii::$app->db->createCommand($sql)->queryAll();
        $all1 = "";
        $all1 .= "
            <tr>
                <td width='5%' style='border-top: 0px; border-left: 0px;border-bottom: 0px;'></td><td align='center'>Pemeriksaan</td><td></td>";
        foreach ($tgl_checkup as $key => $tgl) {
            $all1 .="<td align='center'>".date('d-m-Y', strtotime($tgl['tanggal']))."<br>".date('H:i:s', strtotime($tgl['tanggal']))."</td>";
        }
        $all1 .="</tr>";


        $sql ="SELECT bill_name ,namecheck, ms_check_id
				from yanmed.checkup c
				join yanmed.ms_check mc on c.ms_check_id = mc.idcheck
				join yanmed.services s on c.service_id = s.srv_id
				join yanmed.visit v on s.visit_id = v.visit_id
				join yanmed.billing b on c.billing_id = b.billing_id
				join yanmed.ms_tarif mt on b.tarif_id = mt.tarif_id
				join yanmed.ms_bill bil on mt.bill_id = bil.bill_id
				join yanmed.ms_groupcheck gc on mc.idgroup = gc.idgroup
				where v.visit_id = '$visit_id' and parentgroup != '$parent'
				group by bill_name ,namecheck, ms_check_id
				order by bill_name asc ";
        $nama_pemeriksaan=Yii::$app->db->createCommand($sql)->queryAll();

        $sql ="SELECT
				concat(to_char(created_at,'DD-MM-YYYY HH24:MI:SS'),'-',ms_check_id) idbaru,
				result
				from yanmed.checkup c
				join yanmed.ms_check mc on c.ms_check_id = mc.idcheck
				join yanmed.services s on c.service_id = s.srv_id
				join yanmed.visit v on s.visit_id = v.visit_id
				join yanmed.billing b on c.billing_id = b.billing_id
				join yanmed.ms_tarif mt on b.tarif_id = mt.tarif_id
				join yanmed.ms_bill bil on mt.bill_id = bil.bill_id
				join yanmed.ms_groupcheck gc on mc.idgroup = gc.idgroup
				where v.visit_id = '$visit_id'
				and parentgroup != '$parent' ";
        $data_penunjang=Yii::$app->db->createCommand($sql)->queryAll();

        $all = "";
        foreach ($nama_pemeriksaan as $name) {

            $all .= "
            <tr><td  style='border-top: 0px; border-left: 0px;border-bottom: 0px;'></td><td>&nbsp;&nbsp;".$name['namecheck']."<td>";
            foreach ($tgl_checkup as $value) {
                $hasil = isset($data_penunjang['idbaru'][$value['tanggal'].'-'.$name['ms_check_id']]) ? $data_penunjang['idbaru'][$value['tanggal'].'-'.$name['ms_check_id']] : "";

                $all .="<td align='center'>".$hasil."</td>";

            }
            $all .="</tr>";
        }


        $data['all2']= $all;
        $data['all1']= $all1;

        $pdf = new Pdf;
        $pdf->content=$this->renderPartial('v_berkas_lab',['model'=>$model,'tgl_checkup'=>$tgl_checkup,'data'=>$data]);
//        return $pdf->render();
        $pdf->destination="S";
        $content = base64_encode($pdf->render());
        $request = '{
		    "metadata": {
		        "method": "file_upload",
		        "nomor_sep": "'.$nosep.'",
		      "file_class": "laboratorium",
		      "file_name": "laboratorium.pdf"
		    },
		    "data": "'.$content.'"
		}';
        $act = $this->connect_inacbg($request,$model[0]['surety_id'],$this->bpjs_surety_id,$this->jamkesda_surety_id);


        /*radiologi*/
    $sql = "SELECT
				namecheck, created_at,
				result
				from yanmed.checkup c
				join yanmed.ms_check mc on c.ms_check_id = mc.idcheck
				join yanmed.services s on c.service_id = s.srv_id
				join yanmed.visit v on s.visit_id = v.visit_id
				join yanmed.billing b on c.billing_id = b.billing_id
				join yanmed.ms_tarif mt on b.tarif_id = mt.tarif_id
				join yanmed.ms_bill bil on mt.bill_id = bil.bill_id
				join yanmed.ms_groupcheck gc on mc.idgroup = gc.idgroup
				where v.visit_id = '$visit_id'
				and parentgroup = '20'
				UNION
				SELECT 'ECHOCARDIOGRAFI',a.date_anamnese,a.hasil_echo FROM yanmed.anamnese a
				WHERE a.visit_id = '527406' AND nullif(trim(a.hasil_echo),'') is not null";
        $radiologi = \Yii::$app->db->createCommand($sql)->queryAll();

        $pdf = new Pdf;
        $pdf->destination="S";
        $pdf->content=$this->renderPartial('v_berkas_radiologi',['model'=>$model,'radiologi'=>$radiologi]);
//        return $pdf->render();
        $content = base64_encode($pdf->render());

        $request = '{
		    "metadata": {
		        "method": "file_upload",
		        "nomor_sep": "'.$nosep.'",
		      "file_class": "radiologi",
		      "file_name": "radiologi.pdf"
		    },
		    "data": "'.$content.'"
		}';
        $act = $this->connect_inacbg($request,$model[0]['surety_id'],$this->bpjs_surety_id,$this->jamkesda_surety_id);

        return $act;
    }

    function delete_claim($nosep,$param){
        var_dump($nosep);die();
        foreach ($param as $data){
            $request = '{
				"metadata": {
					"method":"delete_claim"
				},
				"data": {
					"nomor_sep":"'.$nosep.'",
					"coder_nik": "245"

				}
			}';
            $dt = $this->connect_inacbg($request,$data->surety_id,$this->bpjs_surety_id,$this->jamkesda_surety_id);
            $metadata = $dt['metadata'];

            if($metadata['code'] == 200 && $metadata['message'] == "Ok"){
                $this->delete_all_file($nosep,$param);
                return "berhasil";
            }
            else{
                return $metadata['message'];
            }
        }


    }

    public function delete_all_file($sep_no=0,$param)
	{


        foreach ($param as $data){

            $request = '{
						"metadata": {        
							"method": "file_get"    
						},    
						"data": {        
							"nomor_sep": "'.$sep_no.'"    
						} 
					}';
            $dt = $this->connect_inacbg($request,$data->surety_id,$this->bpjs_surety_id,$this->jamkesda_surety_id);
//		$act 	= $this->connect_inacbg($request,null,$this->bpjs_surety_id,$this->jamkesda_surety_id);
            var_dump($dt);die();
            if ($dt['response']['count'] > 0) {
                $berkas = $act['response']['data'];
                foreach ($berkas as $key => $value) {
                    $request = '{
								"metadata": {        
									"method": "file_delete"    
								},    
								"data": {        
									"nomor_sep": "'.$sep_no.'",
									"file_id"  : "'.$value['file_id'].'"    
								} 
							}';
                    $act = $this->connect_inacbg($request,null,$this->bpjs_surety_id,$this->jamkesda_surety_id);
                }
                return "OK";
            }else{
                return "OK";
            }
        }

	}

    public function actionSentwa($id){
        $datas = PiringMangkok::find()->where(['visit_id'=>$id])->all();
        foreach ($datas as $data){
            $list []= (empty($data->px_noktp))?'no ktp':'';
            $list []= (empty($data->pxsurety_no))?'pxsurety_no':'';
            $list []= (empty($data->sep_no))?'sep_no':'';

        }
        $pesan = implode(', ',$list);
        return $this->redirect("https://wa.me/+6282143463253?text=mohon lengkapi data $pesan ");
    }

    public function actionTarikGrouper($id){
        return $this->redirect("http:link_download_pdf", ['target' => '_blank']);
    }

    function connect_inacbg($request, $surety_id, $bpjs_surety_id, $jamkesda_surety_id){
        // 9 = p2tp2a - jkn
        // 26 = dinkes - jkn
        // 113 = jamkesda - jamkesda
        // 116 = maskin provinsi - jkn
        // 117 = penerima bantuan sosial - jamkesos
        // 118 = jampersal - jkn
        $url=Yii::$app->params['urlEklaim'];
        $key=Yii::$app->params['keyEklaim'];
        $kode_tarif = 'BP';
        // data yang akan dikirimkan dengan method POST adalah encrypted:
        $payload = $this->mc_encrypt($request, $key);
        // tentukan Content-Type pada http header
        $header = array("Content-Type: application/x-www-form-urlencoded");
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        // request dengan curl
        $valueponse = curl_exec($ch);
        // terlebih dahulu hilangkan “----BEGIN ENCRYPTED DATA----\r\n"
        // dan hilangkan “----END ENCRYPTED DATA----\r\n" dari response
        $first = strpos($valueponse, "\n") + 1;
        $last = strrpos($valueponse, "\n") - 1;
        $valueponse = substr($valueponse, $first, strlen($valueponse) - $first - $last);
        // decrypt dengan fungsi mc_decrypt
        $valueponse = $this->mc_decrypt($valueponse, $key);
        // hasil decrypt adalah format json, ditranslate kedalam array
        $data = json_decode($valueponse, true);
        return $data;
    }
    function mc_encrypt($data, $key){
        /// make binary representasion of $key
        $key = hex2bin($key);
        /// check key length, must be 256 bit or 32 bytes
        if (mb_strlen($key, "8bit") !== 32) {
            // throw new Exception("Needs a 256-bit key!");
        }
        /// create initialization vector
        $iv_size = openssl_cipher_iv_length("aes-256-cbc");
        $iv = openssl_random_pseudo_bytes($iv_size); // dengan catatan dibawah
        /// encrypt
        $encrypted = openssl_encrypt($data,
            "aes-256-cbc",
            $key,
            OPENSSL_RAW_DATA,
            $iv);
        /// create signature, against padding oracle attacks
        $signature = mb_substr(hash_hmac("sha256",
            $encrypted,
            $key,
            true), 0, 10, "8bit");
        /// combine all, encode, and format
        $encoded = chunk_split(base64_encode($signature . $iv . $encrypted));
        return $encoded;
    }
    function mc_decrypt($str, $strkey){
        /// make binary representation of $key
        $key = hex2bin($strkey);
        /// check key length, must be 256 bit or 32 bytes
        if (mb_strlen($key, "8bit") !== 32) {
            // throw new Exception("Needs a 256-bit key!");
        }
        /// calculate iv size
        $iv_size = openssl_cipher_iv_length("aes-256-cbc");
        /// breakdown parts
        $decoded = base64_decode($str);
        $signature = mb_substr($decoded,0,10,"8bit");
        $iv = mb_substr($decoded,10,$iv_size,"8bit");
        $encrypted = mb_substr($decoded,$iv_size+10,NULL,"8bit");
        /// check signature, against padding oracle attack
        $calc_signature = mb_substr(hash_hmac("sha256",
            $encrypted,
            $key,
            true),0,10,"8bit");
        if(!$this->mc_compare($signature,$calc_signature)) {
            return "SIGNATURE_NOT_MATCH"; /// signature doesn't match
        }
        $decrypted = openssl_decrypt($encrypted,
            "aes-256-cbc",
            $key,
            OPENSSL_RAW_DATA,
            $iv);
        return $decrypted;
    }
    function mc_compare($a, $b) {
        if (strlen($a) !== strlen($b)) return false;
        $valueult = 0;
        for($i = 0; $i < strlen($a); $i ++) {
            $valueult |= ord($a[$i]) ^ ord($b[$i]);
        }
        return $valueult == 0;
    }
}
