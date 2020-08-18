<?php

namespace App\Controller\Rka;

use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Delete;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * @RouteResource("rapbdreport")
 */
class RapbdReportController extends \App\Controller\ApiBaseController
{
    public function cgetAction(Request $request)
    {        
        $rpt = $request->query->get("jns_report");

        switch ($rpt) {
            
            //lamp pmk 07
            case "rapbd_lamp_pmk_ringkasan_apbd":
                return $this->getRapbdLampPmkRingkApbd($request);
            case "rapbd_lamp_pmk_ringkasan_apbd_mak":
                return $this->getRapbdLampPmkRingkApbdMak($request);
            case "rapbd_lamp_pmk07_1a":
                return $this->getRapbdLampPmk07_1a($request);
            case "rapbd_lamp_pmk07_2a2":
                return $this->getRapbdLampPmk07_2a2($request);
            case "rapbd_lamp_pmk07_2b1":
                return $this->getRapbdLampPmk07_2b1($request);
            case "rapbd_lamp_pmk07_2b2":
                return $this->getRapbdLampPmk07_2b2($request);
            case "rapbd_lamp_pmk07_2c1":
                return $this->getRapbdLampPmk07_2c1($request);
            case "rapbd_lamp_pmk07_2h":
                return $this->getRapbdLampPmk07_2h($request);
            case "rapbd_lap_se03_adk_01":
                return $this->getRapbdLapSe03Adk_01($request);
                            
            //monitoring
            case "rapbd_indikator_kegiatan":
                $idIndikatorKgtn = $request->query->get("rapbd_rapbd_id");
                return $this->getRapbdIndikatorKgtn($idIndikatorKgtn);    
            case "rapbd_bl_satker":
                $idRapbdBlSatker = $request->query->get("rapbd_rapbd_id");
                return $this->getRapbdBlSatker($idRapbdBlSatker);
            case "rapbd_kgtn_blm_ada_prioritas":
                return $this->getRapbdKgtnBlmAdaPrioritas($request);
            case "rapbd_kgtn_blm_ada_prioritas_kab":
                return $this->getRapbdKgtnBlmAdaPrioritasKab($request);
            case "rapbd_kgtn_blm_ada_prioritas_prov":
                return $this->getRapbdKgtnBlmAdaPrioritasProv($request);
            case "rapbd_kgtn_blm_ada_prioritas_nas":
                return $this->getRapbdKgtnBlmAdaPrioritasNas($request);
            case "rapbd_btl_satker":
                $idRapbdBtlSatker = $request->query->get("rapbd_rapbd_id");
                return $this->getRapbdBtlSatker($idRapbdBlSatker);
            case "rapbd_rekap_kgtn_satker":
                $idRekapKgtnSatker = $request->query->get("rapbd_rapbd_id");
                return $this->getRapbdRekapKgtnSatker($idRekapKgtnSatker);
            case "rapbd_rekap_mak_satker":
                $idRekapMakSatker = $request->query->get("rapbd_rapbd_id");
                return $this->getRapbdRekapMakSatker($idRekapMakSatker);
            case "rapbd_rekap_rek_rincian_obj":
                return $this->getRapbdRekapRekRincianObj($request);
            case "rapbd_rekap_satker_rek_rincian_obj":
                $idRekapSatkerRekRincianObj = $request->query->get("rapbd_rapbd_id");
                return $this->getRapbdRekapSatkerRekRincianObj($idRekapSatkerRekRincianObj);
            case "rapbd_rekap_satker_rincian_obj":
                $idRekapSatkerRincianObj = $request->query->get("rapbd_rapbd_id");
                return $this->getRapbdRekapSatkerRincianObj($idRekapSatkerRincianObj);
            case "rapbd_rekap_satker":
                return $this->getRapbdRekapSatker($request);
            case "rapbd_rekap_status_rka":
                return $this->getRapbdRekapStatusRka($request);
            case "rapbd_rekap_urusan":
                return $this->getRapbdRekapUrusan($request);
            case "rapbd_rincian_skpd_kgtn":
                $idRapbdRincSkpdKgtn = $request->query->get("rapbd_rapbd_id");
                return $this->getRapbdRincSkpdKgtn($idRapbdRincSkpdKgtn);
            
            //lap
            case "rapbd_dasar_hukum_rek_jenis":
                $idRapbdRekJenis = $request->query->get("id_sikd_rek_jenis");
                return $this->getRapbdDasarHukumRekJenis($request);
            case "rapbd_footer_ringkasan":
                $idlocaRapbdFooterRingkasan = $request->query->get("id_rapbd_rapbd");
                return $this->getRapbdFooterRingkasan($idRapbdFooterRingkasan);
            case "rapbd_sinkronisasi_program":
                return $this->getRapbdSinkronisasiProgram($request);    
            case "rapbd_lamp_perda_01":
                return $this->getRapbdLampPerda01($request);
            case "rapbd_lamp_perda_01_mak":
                return $this->getRapbdLampPerda01Mak($request);
            case "rapbd_lamp_perda_02":
                return $this->getRapbdLampPerda02($request);
            case "rapbd_lamp_perda_02_a":
                return $this->getRapbdLampPerda02a($request);
            case "rapbd_lamp_perda_02_b":
                return $this->getRapbdLampPerda02b($request);
            case "rapbd_lamp_perda_03":
                return $this->getRapbdLampPerda03($request);
            case "rapbd_lamp_perda_04":
                return $this->getRapbdLampPerda04($request);
            case "rapbd_lamp_perda_04_a":
                return $this->getRapbdLampPerda04a($request);
            case "rapbd_lamp_perda_04_b":
                return $this->getRapbdLampPerda04b($request);
            case "rapbd_lamp_perda_04_b_sub1":
                return $this->getRapbdLampPerda04bSub1($request);
            case "rapbd_lamp_perda_04_b_sub2":
                return $this->getRapbdLampPerda04bSub2($request);
            case "rapbd_lamp_perda_04_b_sub3":
                return $this->getRapbdLampPerda04bSub3($request);
            case "rapbd_lamp_perda_05":
                return $this->getRapbdLampPerda05($request);
            case "rapbd_lamp_perda_06":
                return $this->getRapbdLampPerda06($request);
            case "rapbd_lamp_perda_07":
                return $this->getRapbdLampPerda07($request);
            case "rapbd_lamp_perda_08":
                return $this->getRapbdLampPerda08($request);
            case "rapbd_lamp_perda_09":
                return $this->getRapbdLampPerda09($request);
            case "rapbd_lamp_perda_10":
                return $this->getRapbdLampPerda10($request);
            case "rapbd_lamp_perda_11_1":
                return $this->getRapbdLampPerda111($request);
            case "rapbd_lamp_perda_11_2":
                return $this->getRapbdLampPerda112($request);
            case "rapbd_lamp_perda_12":
                return $this->getRapbdLampPerda12($request);
            case "rapbd_lamp_perda_13":
                return $this->getRapbdLampPerda13($request);
            case "rapbd_lamp_perda_13_pak":
                return $this->getRapbdLampPerda13Pak($request);
            case "rapbd_lamp_perda_14":
                return $this->getRapbdLampPerda14($request);
            case "rapbd_lamp_pnjbrn_01_a":
                return $this->getRapbdLampPnjbrn01a($request);
            case "rapbd_lamp_pnjbrn_02_all":
                return $this->getRapbdLampPnjbrn02All($request);
            case "lap_pmk07_1a":
                return $this->getLapPmk071a($request);
            case "lap_pmk_ringkasan_apbd":
                return $this->getLapPmkRingkasanApbd($request);
            case "lap_pmk_ringkasan_apbd_mak":
                return $this->getLapPmkRingkasanApbdMak($request);
            case "lap_pmk07_2a2":
                return $this->getLapPmk072a2($request);
            case "lap_pmk07_2b1":
                return $this->getLapPmk072b1($request);
            case "lap_pmk07_2b1a":
                return $this->getLapPmk072b1a($request);
            case "lap_pmk07_2b2":
                return $this->getLapPmk072b2($request);
            case "lap_pmk07_2c1":
                return $this->getLapPmk072c1($request);
            case "lap_pmk07_2h"://sikd_gol_pegawai tidak ada
                return $this->getLapPmk072h($request);
            case "lap_se03_adk_01":
                return $this->getLapSe03Adk01($request);
            case "lap_se03_adk_01_2":
                return $this->getLapSe03Adk01($request);
            
            default:
                throw new BadRequestHttpException("Undefined report");
        }
    }
    
    private function getRapbdLampPmkRingkApbd($request) {
        try {
            $idRapbd = $request->query->get("id_rapbd_rapbd");
            $tahun = $request->query->get("tahun");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRapbd = pack('H*', str_replace('-', '', trim($idRapbd)));
            $tahun = pack('H*', str_replace('-', '', trim($tahun)));
            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                        sikd_rek_akun.`kd_rek_akun` AS sikd_rek_akun_kd_rek_akun,
                        sikd_rek_akun.`nm_rek_akun` AS sikd_rek_akun_nm_rek_akun,
                        sikd_rek_kelompok.`kd_rek_kelompok` AS sikd_rek_kelompok_kd_rek_kelompok,
                        sikd_rek_kelompok.`nm_rek_kelompok` AS sikd_rek_kelompok_nm_rek_kelompok,
                        sikd_rek_jenis.`kd_rek_jenis` AS sikd_rek_jenis_kd_rek_jenis,
                        sikd_rek_jenis.`nm_rek_jenis` AS sikd_rek_jenis_nm_rek_jenis,
                        sum(ifnull(rka_mata_anggaran.`jumlah`,0)) AS rka_mata_anggaran_jumlah,
                        if(sikd_rek_akun.`kd_rek_akun` in ('4','5'), 'rek_45', 'rek_6') AS jns_rek,
                        sum(if(sikd_rek_akun.`kd_rek_akun`='4',rka_mata_anggaran.`jumlah`,0)) AS jml_pendapatan,
                        sum(if(sikd_rek_akun.`kd_rek_akun`='5',rka_mata_anggaran.`jumlah`,0)) AS jml_belanja,
                        sum(if(sikd_rek_kelompok.`kd_rek_kelompok`='61',rka_mata_anggaran.`jumlah`,0)) AS jml_penerimaan,
                        sum(if(sikd_rek_kelompok.`kd_rek_kelompok`='62',rka_mata_anggaran.`jumlah`,0)) AS jml_pengeluaran,
                        sum(if(sikd_rek_akun.`kd_rek_akun`='4',rka_mata_anggaran.`jumlah`,0)-if(sikd_rek_akun.`kd_rek_akun`='5',rka_mata_anggaran.`jumlah`,0)) AS jml_surplus,
                        sum(if(sikd_rek_kelompok.`kd_rek_kelompok`='61',rka_mata_anggaran.`jumlah`,0)-if(sikd_rek_kelompok.`kd_rek_kelompok`='62',rka_mata_anggaran.`jumlah`,0)) AS jml_pembiayaan
                    FROM
                        `rka_rka` rka_rka INNER JOIN `rka_mata_anggaran` rka_mata_anggaran ON rka_rka.`id_rka_rka` = rka_mata_anggaran.`rka_rka_id`
                        AND rka_rka.`rapbd_rapbd_id` = :idRapbd
                        AND rka_rka.rka_perubahan = '0'
                        AND if(:statusRka = 'Final',(rka_rka.`status_rka` = 1),(rka_rka.`status_rka` = 0 OR rka_rka.`status_rka` = 2))
                        INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON rka_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                        INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                        INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                        INNER JOIN `sikd_rek_kelompok` sikd_rek_kelompok ON sikd_rek_jenis.`sikd_rek_kelompok_id` = sikd_rek_kelompok.`id_sikd_rek_kelompok`
                        INNER JOIN `sikd_rek_akun` sikd_rek_akun ON sikd_rek_kelompok.`sikd_rek_akun_id` = sikd_rek_akun.`id_sikd_rek_akun`
                        AND (sikd_rek_akun.`kd_rek_akun` IN ('4','5') OR sikd_rek_kelompok.`kd_rek_kelompok` IN ('61','62'))
                    GROUP BY
                        sikd_rek_akun.`kd_rek_akun`,
                        sikd_rek_akun.`nm_rek_akun`,
                        sikd_rek_kelompok.`kd_rek_kelompok`,
                        sikd_rek_kelompok.`nm_rek_kelompok`,
                        sikd_rek_jenis.`kd_rek_jenis`,
                        sikd_rek_jenis.`nm_rek_jenis`,
                        jns_rek
                    ORDER BY
                        sikd_rek_akun.`kd_rek_akun`,
                        sikd_rek_kelompok.`kd_rek_kelompok`,
                        sikd_rek_jenis.`kd_rek_jenis`
                    ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rapbd_rapbd", $idRapbd);
            $statement->execute();
            $rapbdLampPmkRingkApbd = $statement->fetchAll();

            return new JsonResponse($rapbdLampPmkRingkApbd);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getRapbdLampPmkRingkApbdMak($request) {
        try {
            $idRapbd = $request->query->get("id_rapbd_rapbd");
            $tahun = $request->query->get("tahun");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRapbd = pack('H*', str_replace('-', '', trim($idRapbd)));
            $tahun = pack('H*', str_replace('-', '', trim($tahun)));
            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                        sikd_rek_akun.`kd_rek_akun` AS sikd_rek_akun_kd_rek_akun,
                        sikd_rek_akun.`nm_rek_akun` AS sikd_rek_akun_nm_rek_akun,
                        sikd_rek_kelompok.`kd_rek_kelompok` AS sikd_rek_kelompok_kd_rek_kelompok_,
                        concat(substring(sikd_rek_kelompok.`kd_rek_kelompok`,1,1),".",substring(sikd_rek_kelompok.`kd_rek_kelompok`,2,1)) AS sikd_rek_kelompok_kd_rek_kelompok,
                        sikd_rek_kelompok.`nm_rek_kelompok` AS sikd_rek_kelompok_nm_rek_kelompok,
                        sikd_rek_jenis.`kd_rek_jenis` AS sikd_rek_jenis_kd_rek_jenis_,
                        concat(substring(sikd_rek_jenis.`kd_rek_jenis`,1,1),".",substring(sikd_rek_jenis.`kd_rek_jenis`,2,1),".",substring(sikd_rek_jenis.`kd_rek_jenis`,3,1)) AS sikd_rek_jenis_kd_rek_jenis,
                        sikd_rek_jenis.`nm_rek_jenis` AS sikd_rek_jenis_nm_rek_jenis,
                        sum(ifnull(rka_mata_anggaran.`jumlah`,0)) AS rka_mata_anggaran_jumlah,
                        if(sikd_rek_akun.`kd_rek_akun` in ('4','5'), 'rek_45', 'rek_6') AS jns_rek,
                        sum(if(sikd_rek_akun.`kd_rek_akun`='4',rka_mata_anggaran.`jumlah`,0)) AS jml_pendapatan,
                        sum(if(sikd_rek_akun.`kd_rek_akun`='5',rka_mata_anggaran.`jumlah`,0)) AS jml_belanja,
                        sum(if(sikd_rek_kelompok.`kd_rek_kelompok`='61',rka_mata_anggaran.`jumlah`,0)) AS jml_penerimaan,
                        sum(if(sikd_rek_kelompok.`kd_rek_kelompok`='62',rka_mata_anggaran.`jumlah`,0)) AS jml_pengeluaran,
                        sum(if(sikd_rek_akun.`kd_rek_akun`='4',rka_mata_anggaran.`jumlah`,0)-if(sikd_rek_akun.`kd_rek_akun`='5',rka_mata_anggaran.`jumlah`,0)) AS jml_surplus,
                        sum(if(sikd_rek_kelompok.`kd_rek_kelompok`='61',rka_mata_anggaran.`jumlah`,0)-if(sikd_rek_kelompok.`kd_rek_kelompok`='62',rka_mata_anggaran.`jumlah`,0)) AS jml_pembiayaan
                    FROM
                        `rka_rka` rka_rka INNER JOIN `rka_mata_anggaran` rka_mata_anggaran ON rka_rka.`id_rka_rka` = rka_mata_anggaran.`rka_rka_id`
                        AND rka_rka.`rapbd_rapbd_id` = :idRapbd
                        AND rka_rka.rka_perubahan = '0'
                        AND if(:statusRka = 'Final',(rka_rka.`status_rka` = 1),(rka_rka.`status_rka` = 0 OR rka_rka.`status_rka` = 2))
                        INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON rka_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                        INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                        INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                        INNER JOIN `sikd_rek_kelompok` sikd_rek_kelompok ON sikd_rek_jenis.`sikd_rek_kelompok_id` = sikd_rek_kelompok.`id_sikd_rek_kelompok`
                        INNER JOIN `sikd_rek_akun` sikd_rek_akun ON sikd_rek_kelompok.`sikd_rek_akun_id` = sikd_rek_akun.`id_sikd_rek_akun`
                        AND (sikd_rek_akun.`kd_rek_akun` IN ('4','5') OR sikd_rek_kelompok.`kd_rek_kelompok` IN ('61','62'))
                    GROUP BY
                        sikd_rek_akun.`kd_rek_akun`,
                        sikd_rek_akun.`nm_rek_akun`,
                        sikd_rek_kelompok.`kd_rek_kelompok`,
                        sikd_rek_kelompok.`nm_rek_kelompok`,
                        sikd_rek_jenis.`kd_rek_jenis`,
                        sikd_rek_jenis.`nm_rek_jenis`,
                        jns_rek
                    ORDER BY
                        sikd_rek_akun.`kd_rek_akun`,
                        sikd_rek_kelompok.`kd_rek_kelompok`,
                        sikd_rek_jenis.`kd_rek_jenis`
                    ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rapbd_rapbd", $idRapbd);
            $statement->execute();
            $rapbdLampPmkRingkApbdMak = $statement->fetchAll();

            return new JsonResponse($rapbdLampPmkRingkApbdMak);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getRapbdLampPmk07_1a($request) {
        try {
            $idRapbd = $request->query->get("id_rapbd_rapbd");
            $tahun = $request->query->get("tahun");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRapbd = pack('H*', str_replace('-', '', trim($idRapbd)));
            $tahun = pack('H*', str_replace('-', '', trim($tahun)));
            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                        rapbd_rapbd.`tahun` AS rapbd_rapbd_tahun,
                        sikd_fungsi.`kd_fungsi` AS sikd_fungsi_kd_fungsi,
                        sikd_fungsi.`nm_fungsi` AS sikd_fungsi_nm_fungsi,
                        sikd_urusan.`nm_urusan` AS sikd_urusan_nm_urusan,
                        CONCAT_WS('-',
                            SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 1, 8),
                            SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 9, 4),
                            SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 13, 4),
                            SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 17, 4),
                            SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 21)
                            ) AS sikd_bidang_id_sikd_bidang,
                        sikd_bidang.`kd_bidang` AS sikd_bidang_kd_bidang,
                        sikd_bidang.`nm_bidang` AS sikd_bidang_nm_bidang,
                        IF(sikd_sub_skpd.id_sikd_sub_skpd IS NULL, sikd_satker.`kode`, sikd_sub_skpd.`kode`) AS sikd_satker_kode,
                        IF(sikd_sub_skpd.id_sikd_sub_skpd IS NULL, sikd_satker.`nama`, sikd_sub_skpd.`nama`) AS sikd_satker_nama,
                        CONCAT_WS('-',
                            SUBSTR(HEX(sikd_prog.`id_sikd_prog`), 1, 8),
                            SUBSTR(HEX(sikd_prog.`id_sikd_prog`), 9, 4),
                            SUBSTR(HEX(sikd_prog.`id_sikd_prog`), 13, 4),
                            SUBSTR(HEX(sikd_prog.`id_sikd_prog`), 17, 4),
                            SUBSTR(HEX(sikd_prog.`id_sikd_prog`), 21)
                            ) AS sikd_prog_id_sikd_prog,
                        sikd_prog.`kd_prog` AS sikd_prog_kd_prog,
                        sikd_prog.`nm_prog` AS sikd_prog_nm_prog,
                        CONCAT_WS('-',
                            SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 1, 8),
                            SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 9, 4),
                            SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 13, 4),
                            SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 17, 4),
                            SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 21)
                            ) AS sikd_kgtn_id_sikd_kgtn,
                        sikd_kgtn.`kd_kgtn` AS sikd_kgtn_kd_kgtn,
                        sikd_kgtn.`nm_kgtn` AS sikd_kgtn_nm_kgtn,
                        CONCAT_WS('-',
                            SUBSTR(HEX(sikd_rek_akun.`id_sikd_rek_akun`), 1, 8),
                            SUBSTR(HEX(sikd_rek_akun.`id_sikd_rek_akun`), 9, 4),
                            SUBSTR(HEX(sikd_rek_akun.`id_sikd_rek_akun`), 13, 4),
                            SUBSTR(HEX(sikd_rek_akun.`id_sikd_rek_akun`), 17, 4),
                            SUBSTR(HEX(sikd_rek_akun.`id_sikd_rek_akun`), 21)
                            ) AS sikd_rek_akun_id_sikd_rek_akun,
                        sikd_rek_akun.`kd_rek_akun` AS sikd_rek_akun_kd_rek_akun,
                        sikd_rek_akun.`nm_rek_akun` AS sikd_rek_akun_nm_rek_akun,
                        CONCAT_WS('-',
                             SUBSTR(HEX(sikd_rek_kelompok.`id_sikd_rek_kelompok`), 1, 8),
                             SUBSTR(HEX(sikd_rek_kelompok.`id_sikd_rek_kelompok`), 9, 4),
                             SUBSTR(HEX(sikd_rek_kelompok.`id_sikd_rek_kelompok`), 13, 4),
                             SUBSTR(HEX(sikd_rek_kelompok.`id_sikd_rek_kelompok`), 17, 4),
                             SUBSTR(HEX(sikd_rek_kelompok.`id_sikd_rek_kelompok`), 21)
                             ) AS sikd_rek_kelompok_id_sikd_rek_kelompok,
                        sikd_rek_kelompok.`kd_rek_kelompok` AS sikd_rek_kelompok_kd_rek_kelompok,
                        sikd_rek_kelompok.`nm_rek_kelompok` AS sikd_rek_kelompok_nm_rek_kelompok,
                        sikd_rek_kelompok.`dasar_hukum` AS sikd_rek_kelompok_dasar_hukum,
                        CONCAT_WS('-',
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 1, 8),
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 9, 4),
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 13, 4),
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 17, 4),
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 21)
                            ) AS sikd_rek_jenis_id_sikd_rek_jenis,
                        sikd_rek_jenis.`kd_rek_jenis` AS sikd_rek_jenis_kd_rek_jenis,
                        sikd_rek_jenis.`nm_rek_jenis` AS sikd_rek_jenis_nm_rek_jenis,
                        sikd_rek_jenis.`dasar_hukum` AS sikd_rek_jenis_dasar_hukum,
                        CONCAT_WS('-',
                             SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 1, 8),
                             SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 9, 4),
                             SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 13, 4),
                             SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 17, 4),
                             SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 21)
                             ) AS sikd_rek_obj_id_sikd_rek_obj,
                        sikd_rek_obj.`kd_rek_obj` AS sikd_rek_obj_kd_rek_obj,
                        sikd_rek_obj.`nm_rek_obj` AS sikd_rek_obj_nm_rek_obj,
                        sikd_rek_obj.`dasar_hukum` AS sikd_rek_obj_dasar_hukum,
                        CONCAT_WS('-',
                             SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 1, 8),
                             SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 9, 4),
                             SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 13, 4),
                             SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 17, 4),
                             SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 21)
                             ) AS sikd_rek_rincian_obj_id_sikd_rek_rincian_obj,
                        sikd_rek_rincian_obj.`kd_rek_rincian_obj` AS sikd_rek_rincian_obj_kd_rek_rincian_obj,
                        sikd_rek_rincian_obj.`nm_rek_rincian_obj` AS sikd_rek_rincian_obj_nm_rek_rincian_obj,
                        sikd_rek_rincian_obj.`dasar_hukum` AS sikd_rek_rincian_obj_dasar_hukum,
                        CONCAT_WS('-',
                            SUBSTR(HEX(rka_mata_anggaran.`id_rka_mata_anggaran`), 1, 8),
                            SUBSTR(HEX(rka_mata_anggaran.`id_rka_mata_anggaran`), 9, 4),
                            SUBSTR(HEX(rka_mata_anggaran.`id_rka_mata_anggaran`), 13, 4),
                            SUBSTR(HEX(rka_mata_anggaran.`id_rka_mata_anggaran`), 17, 4),
                            SUBSTR(HEX(rka_mata_anggaran.`id_rka_mata_anggaran`), 21)
                            ) AS rka_mata_anggaran_id_rka_mata_anggaran,
                        rka_mata_anggaran.`jumlah` AS rka_mata_anggaran_jumlah
                    FROM
                        `rapbd_rapbd` rapbd_rapbd INNER JOIN `rka_rka` rka_rka ON rka_rka.`rapbd_rapbd_id` = rapbd_rapbd.`id_rapbd_rapbd`
                        INNER JOIN `vw_rka_skpd_skpkd_all` rka_skpd ON rka_rka.`id_rka_rka` = rka_skpd.`rka_rka_id`
                        INNER JOIN `rka_mata_anggaran` rka_mata_anggaran ON rka_skpd.`rka_rka_id` = rka_mata_anggaran.`rka_rka_id`
                        INNER JOIN `sikd_bidang` sikd_bidang ON rka_skpd.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                        INNER JOIN `sikd_urusan` sikd_urusan ON sikd_bidang.`sikd_urusan_id` = sikd_urusan.`id_sikd_urusan`
                        INNER JOIN `sikd_satker` sikd_satker ON rka_skpd.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                        LEFT OUTER JOIN `rka_skpd_kgtn` rka_skpd_kgtn ON rka_mata_anggaran.`rka_rka_id` = rka_skpd_kgtn.`id_rka_skpd_kgtn`
                        INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON rka_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                        INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                        INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                        INNER JOIN `sikd_rek_kelompok` sikd_rek_kelompok ON sikd_rek_jenis.`sikd_rek_kelompok_id` = sikd_rek_kelompok.`id_sikd_rek_kelompok`
                        INNER JOIN `sikd_rek_akun` sikd_rek_akun ON sikd_rek_kelompok.`sikd_rek_akun_id` = sikd_rek_akun.`id_sikd_rek_akun`
                        LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON rka_skpd.`sikd_sub_satker_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                        LEFT OUTER JOIN `sikd_kgtn` sikd_kgtn ON rka_skpd_kgtn.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                        LEFT OUTER JOIN `sikd_prog` sikd_prog ON sikd_kgtn.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                        LEFT OUTER JOIN `sikd_sumber_anggaran` sikd_sumber_anggaran ON rka_mata_anggaran.`sikd_sumber_anggaran_id` = sikd_sumber_anggaran.`id_sikd_sumber_anggaran`
                        LEFT OUTER JOIN `sikd_fungsi` sikd_fungsi ON sikd_bidang.`sikd_fungsi_id` = sikd_fungsi.`id_sikd_fungsi`
                    WHERE
                        rka_rka.rka_perubahan = '0'
                        AND rapbd_rapbd.`id_rapbd_rapbd` = :idRapbd
                        AND if(:statusRka = 'Final',(rka_rka.`status_rka` = 1),(rka_rka.`status_rka` = 0 OR rka_rka.`status_rka` = 2))
                    ORDER BY
                        sikd_fungsi.`kd_fungsi`,
                        sikd_bidang.`kd_bidang`,
                        sikd_satker.`kode`,
                        sikd_sub_skpd.`kode`,
                        sikd_prog.`kd_prog`,
                        sikd_kgtn.`kd_kgtn`,
                        sikd_rek_akun.`kd_rek_akun` ASC,
                        sikd_rek_kelompok.`kd_rek_kelompok` ASC,
                        sikd_rek_jenis.`kd_rek_jenis` ASC,
                        sikd_rek_obj.`kd_rek_obj` ASC,
                        sikd_rek_rincian_obj.`kd_rek_rincian_obj` ASC
                    ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rapbd_rapbd", $idRapbd);
            $statement->execute();
            $rapbdLampPmk07_1a = $statement->fetchAll();

            return new JsonResponse($rapbdLampPmk07_1a);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getRapbdLampPmk07_2a2($request) {
        try {
            $idRapbd = $request->query->get("id_rapbd_rapbd");
            $tahun = $request->query->get("tahun");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRapbd = pack('H*', str_replace('-', '', trim($idRapbd)));
            $tahun = pack('H*', str_replace('-', '', trim($tahun)));
            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                        CONCAT_WS('-',
                            SUBSTR(HEX(sikd_rek_akun.`id_sikd_rek_akun`), 1, 8),
                            SUBSTR(HEX(sikd_rek_akun.`id_sikd_rek_akun`), 9, 4),
                            SUBSTR(HEX(sikd_rek_akun.`id_sikd_rek_akun`), 13, 4),
                            SUBSTR(HEX(sikd_rek_akun.`id_sikd_rek_akun`), 17, 4),
                            SUBSTR(HEX(sikd_rek_akun.`id_sikd_rek_akun`), 21)
                            ) AS sikd_rek_akun_id_sikd_rek_akun,
                        sikd_rek_akun.`kd_rek_akun` AS sikd_rek_akun_kd_rek_akun,
                        sikd_rek_akun.`nm_rek_akun` AS sikd_rek_akun_nm_rek_akun,
                        CONCAT_WS('-',
                             SUBSTR(HEX(sikd_rek_kelompok.`id_sikd_rek_kelompok`), 1, 8),
                             SUBSTR(HEX(sikd_rek_kelompok.`id_sikd_rek_kelompok`), 9, 4),
                             SUBSTR(HEX(sikd_rek_kelompok.`id_sikd_rek_kelompok`), 13, 4),
                             SUBSTR(HEX(sikd_rek_kelompok.`id_sikd_rek_kelompok`), 17, 4),
                             SUBSTR(HEX(sikd_rek_kelompok.`id_sikd_rek_kelompok`), 21)
                             ) AS sikd_rek_kelompok_id_sikd_rek_kelompok,
                        SUBSTR(sikd_rek_kelompok.`kd_rek_kelompok`,2,1) AS sikd_rek_kelompok_kd_rek_kelompok,
                        sikd_rek_kelompok.`nm_rek_kelompok` AS sikd_rek_kelompok_nm_rek_kelompok,
                        sikd_rek_kelompok.`dasar_hukum` AS sikd_rek_kelompok_dasar_hukum,
                        CONCAT_WS('-',
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 1, 8),
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 9, 4),
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 13, 4),
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 17, 4),
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 21)
                            ) AS sikd_rek_jenis_id_sikd_rek_jenis,
                        SUBSTR(sikd_rek_jenis.`kd_rek_jenis`,3,1) AS sikd_rek_jenis_kd_rek_jenis,
                        sikd_rek_jenis.`nm_rek_jenis` AS sikd_rek_jenis_nm_rek_jenis,
                        sikd_rek_jenis.`dasar_hukum` AS sikd_rek_jenis_dasar_hukum,
                        CONCAT_WS('-',
                             SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 1, 8),
                             SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 9, 4),
                             SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 13, 4),
                             SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 17, 4),
                             SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 21)
                             ) AS sikd_rek_obj_id_sikd_rek_obj,
                        SUBSTR(sikd_rek_obj.`kd_rek_obj`,4,2) AS sikd_rek_obj_kd_rek_obj,
                        sikd_rek_obj.`nm_rek_obj` AS sikd_rek_obj_nm_rek_obj,
                        sikd_rek_obj.`dasar_hukum` AS sikd_rek_obj_dasar_hukum,
                        CONCAT_WS('-',
                             SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 1, 8),
                             SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 9, 4),
                             SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 13, 4),
                             SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 17, 4),
                             SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 21)
                             ) AS sikd_rek_rincian_obj_id_sikd_rek_rincian_obj,
                        SUBSTR(sikd_rek_rincian_obj.`kd_rek_rincian_obj`,6,2) AS sikd_rek_rincian_obj_kd_rek_rincian_obj,
                        sikd_rek_rincian_obj.`nm_rek_rincian_obj` AS sikd_rek_rincian_obj_nm_rek_rincian_obj,
                        IF(rka_mata_anggaran.`dasar_hukum` = '', sikd_rek_rincian_obj.`dasar_hukum`, 
                        rka_mata_anggaran.`dasar_hukum`) AS rka_mata_anggaran_dasar_hukum,
                        SUM(rka_mata_anggaran.`jumlah`)AS rka_mata_anggaran_jumlah
                    FROM
                        `sikd_rek_rincian_obj` sikd_rek_rincian_obj INNER JOIN `rka_mata_anggaran` rka_mata_anggaran ON sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj` = rka_mata_anggaran.`sikd_rek_rincian_obj_id`
                        INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                        INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                        INNER JOIN `sikd_rek_kelompok` sikd_rek_kelompok ON sikd_rek_jenis.`sikd_rek_kelompok_id` = sikd_rek_kelompok.`id_sikd_rek_kelompok`
                        INNER JOIN `sikd_rek_akun` sikd_rek_akun ON sikd_rek_kelompok.`sikd_rek_akun_id` = sikd_rek_akun.`id_sikd_rek_akun`
                        INNER JOIN `rka_rka` rka_rka ON rka_mata_anggaran.`rka_rka_id` = rka_rka.`id_rka_rka`
                    WHERE
                        sikd_rek_akun.kd_rek_akun = '4'
                        AND rka_rka.`rapbd_rapbd_id` = :idRapbd
                        AND rka_rka.rka_perubahan = '0'
                        AND if(:statusRka = 'Final',(rka_rka.`status_rka` = 1),(rka_rka.`status_rka` = 0 OR rka_rka.`status_rka` = 2))
                    GROUP BY
                        sikd_rek_akun_id_sikd_rek_akun,
                        sikd_rek_kelompok_id_sikd_rek_kelompok,
                        sikd_rek_jenis_id_sikd_rek_jenis,
                        sikd_rek_obj_id_sikd_rek_obj,
                        sikd_rek_rincian_obj_id_sikd_rek_rincian_obj
                    ORDER BY
                        sikd_rek_rincian_obj.`kd_rek_rincian_obj` ASC
                    ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rapbd_rapbd", $idRapbd);
            $statement->execute();
            $rapbdLampPmk07_2a2 = $statement->fetchAll();

            return new JsonResponse($rapbdLampPmk07_2a2);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getRapbdLampPmk07_2b1($request) {
        try {
            $idRapbd = $request->query->get("id_rapbd_rapbd");
            $tahun = $request->query->get("tahun");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRapbd = pack('H*', str_replace('-', '', trim($idRapbd)));
            $tahun = pack('H*', str_replace('-', '', trim($tahun)));
            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                        CONCAT_WS('-',
                            SUBSTR(HEX(sikd_fungsi.`id_sikd_fungsi`), 1, 8),
                            SUBSTR(HEX(sikd_fungsi.`id_sikd_fungsi`), 9, 4),
                            SUBSTR(HEX(sikd_fungsi.`id_sikd_fungsi`), 13, 4),
                            SUBSTR(HEX(sikd_fungsi.`id_sikd_fungsi`), 17, 4),
                            SUBSTR(HEX(sikd_fungsi.`id_sikd_fungsi`), 21)
                            ) AS sikd_fungsi_id_sikd_fungsi,
                        sikd_fungsi.`kd_fungsi` AS sikd_fungsi_kd_fungsi,
                        sikd_fungsi.`nm_fungsi` AS sikd_fungsi_nm_fungsi,
                        CONCAT_WS('-',
                            SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 1, 8),
                            SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 9, 4),
                            SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 13, 4),
                            SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 17, 4),
                            SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 21)
                            ) AS sikd_bidang_id_sikd_bidang,
                        sikd_bidang.`kd_bidang` AS sikd_bidang_kd_bidang,
                        sikd_bidang.`nm_bidang` AS sikd_bidang_nm_bidang,
                        CONCAT_WS('-',
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 1, 8),
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 9, 4),
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 13, 4),
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 17, 4),
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 21)
                            ) AS sikd_satker_id_sikd_satker,
                        CONCAT_WS('-',
                            SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 1, 8),
                            SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 9, 4),
                            SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 13, 4),
                            SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 17, 4),
                            SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 21)
                            ) AS sikd_sub_skpd_id_sikd_sub_skpd,
                        IF(sikd_sub_skpd.id_sikd_sub_skpd IS NULL, sikd_satker.`kode`, sikd_sub_skpd.`kode`) AS sikd_satker_kode,
                        IF(sikd_sub_skpd.id_sikd_sub_skpd IS NULL, sikd_satker.`nama`, sikd_sub_skpd.`nama`) AS sikd_satker_nama,
                        sikd_sub_skpd.`kode` AS sikd_sub_skpd_kode,
                        sikd_sub_skpd.`nama` AS sikd_sub_skpd_nama,
                        SUM(IF(sikd_rek_jenis.`kd_rek_jenis` = '511', rka_mata_anggaran.`jumlah`, 0)) AS jml_511,
                        SUM(IF(sikd_rek_jenis.`kd_rek_jenis` = '512', rka_mata_anggaran.`jumlah`, 0)) AS jml_512,
                        SUM(IF(sikd_rek_jenis.`kd_rek_jenis` = '513', rka_mata_anggaran.`jumlah`, 0)) AS jml_513,
                        SUM(IF(sikd_rek_jenis.`kd_rek_jenis` = '514', rka_mata_anggaran.`jumlah`, 0)) AS jml_514,
                        SUM(IF(sikd_rek_jenis.`kd_rek_jenis` = '515', rka_mata_anggaran.`jumlah`, 0)) AS jml_515,
                        SUM(IF(sikd_rek_jenis.`kd_rek_jenis` = '516', rka_mata_anggaran.`jumlah`, 0)) AS jml_516,
                        SUM(IF(sikd_rek_jenis.`kd_rek_jenis` = '517', rka_mata_anggaran.`jumlah`, 0)) AS jml_517,
                        SUM(IF(sikd_rek_jenis.`kd_rek_jenis` = '518', rka_mata_anggaran.`jumlah`, 0)) AS jml_518,
                        SUM(IF(sikd_rek_jenis.`kd_rek_jenis` = '521', rka_mata_anggaran.`jumlah`, 0)) AS jml_521,
                        SUM(IF(sikd_rek_jenis.`kd_rek_jenis` = '522', rka_mata_anggaran.`jumlah`, 0)) AS jml_522,
                        SUM(IF(sikd_rek_jenis.`kd_rek_jenis` = '523', rka_mata_anggaran.`jumlah`, 0)) AS jml_523,
                        SUM(rka_mata_anggaran.`jumlah`) AS jml_total
                    FROM
                        `rka_mata_anggaran` rka_mata_anggaran INNER JOIN `vw_rka_skpd_skpkd_all` vw_rka_skpd_skpkd_all ON rka_mata_anggaran.`rka_rka_id` = vw_rka_skpd_skpkd_all.`rka_rka_id`
                        LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON vw_rka_skpd_skpkd_all.`sikd_sub_satker_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                        INNER JOIN `sikd_satker` sikd_satker ON vw_rka_skpd_skpkd_all.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                        INNER JOIN `sikd_bidang` sikd_bidang ON vw_rka_skpd_skpkd_all.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                        INNER JOIN `sikd_fungsi` sikd_fungsi ON sikd_bidang.`sikd_fungsi_id` = sikd_fungsi.`id_sikd_fungsi`
                        INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON rka_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                        INNER JOIN `rka_rka` rka_rka ON rka_mata_anggaran.`rka_rka_id` = rka_rka.`id_rka_rka`
                        INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                        INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                        INNER JOIN `sikd_rek_kelompok` sikd_rek_kelompok ON sikd_rek_jenis.`sikd_rek_kelompok_id` = sikd_rek_kelompok.`id_sikd_rek_kelompok`
                        INNER JOIN `sikd_rek_akun` sikd_rek_akun ON sikd_rek_kelompok.`sikd_rek_akun_id` = sikd_rek_akun.`id_sikd_rek_akun`
                    WHERE
                        sikd_rek_akun.kd_rek_akun = '5'
                        AND rka_rka.rka_perubahan = '0'
                        AND rka_rka.rapbd_rapbd_id = :idRapbd
                        AND if(:statusRka = 'Final',(rka_rka.`status_rka` = 1),(rka_rka.`status_rka` = 0 OR rka_rka.`status_rka` = 2))
                    GROUP BY
                        sikd_fungsi_id_sikd_fungsi,
                        sikd_bidang_id_sikd_bidang,
                        sikd_satker_id_sikd_satker,
                        sikd_sub_skpd_id_sikd_sub_skpd
                    ORDER BY
                        sikd_fungsi.`kd_fungsi` ASC,
                        sikd_bidang.`kd_bidang` ASC,
                        sikd_satker.`kode` ASC,
                        sikd_sub_skpd.`kode` ASC
                    ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rapbd_rapbd", $idRapbd);
            $statement->execute();
            $rapbdLampPmk07_2b1 = $statement->fetchAll();

            return new JsonResponse($rapbdLampPmk07_2b1);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getRapbdLampPmk07_2b2($request) {
        try {
            $idRapbd = $request->query->get("id_rapbd_rapbd");
            $tahun = $request->query->get("tahun");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRapbd = pack('H*', str_replace('-', '', trim($idRapbd)));
            $tahun = pack('H*', str_replace('-', '', trim($tahun)));
            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                        CONCAT_WS('-',
                            SUBSTR(HEX(sikd_rek_akun.`id_sikd_rek_akun`), 1, 8),
                            SUBSTR(HEX(sikd_rek_akun.`id_sikd_rek_akun`), 9, 4),
                            SUBSTR(HEX(sikd_rek_akun.`id_sikd_rek_akun`), 13, 4),
                            SUBSTR(HEX(sikd_rek_akun.`id_sikd_rek_akun`), 17, 4),
                            SUBSTR(HEX(sikd_rek_akun.`id_sikd_rek_akun`), 21)
                            ) AS sikd_rek_akun_id_sikd_rek_akun,
                        sikd_rek_akun.`kd_rek_akun` AS sikd_rek_akun_kd_rek_akun,
                        sikd_rek_akun.`nm_rek_akun` AS sikd_rek_akun_nm_rek_akun,
                        CONCAT_WS('-',
                             SUBSTR(HEX(sikd_rek_kelompok.`id_sikd_rek_kelompok`), 1, 8),
                             SUBSTR(HEX(sikd_rek_kelompok.`id_sikd_rek_kelompok`), 9, 4),
                             SUBSTR(HEX(sikd_rek_kelompok.`id_sikd_rek_kelompok`), 13, 4),
                             SUBSTR(HEX(sikd_rek_kelompok.`id_sikd_rek_kelompok`), 17, 4),
                             SUBSTR(HEX(sikd_rek_kelompok.`id_sikd_rek_kelompok`), 21)
                             ) AS sikd_rek_kelompok_id_sikd_rek_kelompok,
                        SUBSTR(sikd_rek_kelompok.`kd_rek_kelompok`,2,1) AS sikd_rek_kelompok_kd_rek_kelompok,
                        sikd_rek_kelompok.`nm_rek_kelompok` AS sikd_rek_kelompok_nm_rek_kelompok,
                        sikd_rek_kelompok.`dasar_hukum` AS sikd_rek_kelompok_dasar_hukum,
                        CONCAT_WS('-',
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 1, 8),
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 9, 4),
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 13, 4),
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 17, 4),
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 21)
                            ) AS sikd_rek_jenis_id_sikd_rek_jenis,
                        SUBSTR(sikd_rek_jenis.`kd_rek_jenis`,3,1) AS sikd_rek_jenis_kd_rek_jenis,
                        sikd_rek_jenis.`nm_rek_jenis` AS sikd_rek_jenis_nm_rek_jenis,
                        sikd_rek_jenis.`dasar_hukum` AS sikd_rek_jenis_dasar_hukum,
                        CONCAT_WS('-',
                             SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 1, 8),
                             SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 9, 4),
                             SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 13, 4),
                             SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 17, 4),
                             SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 21)
                             ) AS sikd_rek_obj_id_sikd_rek_obj,
                        SUBSTR(sikd_rek_obj.`kd_rek_obj`,4,2) AS sikd_rek_obj_kd_rek_obj,
                        sikd_rek_obj.`nm_rek_obj` AS sikd_rek_obj_nm_rek_obj,
                        sikd_rek_obj.`dasar_hukum` AS sikd_rek_obj_dasar_hukum,
                        CONCAT_WS('-',
                             SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 1, 8),
                             SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 9, 4),
                             SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 13, 4),
                             SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 17, 4),
                             SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 21)
                             ) AS sikd_rek_rincian_obj_id_sikd_rek_rincian_obj,
                        SUBSTR(sikd_rek_rincian_obj.`kd_rek_rincian_obj`,6,2) AS sikd_rek_rincian_obj_kd_rek_rincian_obj,
                        sikd_rek_rincian_obj.`nm_rek_rincian_obj` AS sikd_rek_rincian_obj_nm_rek_rincian_obj,
                        IF(rka_mata_anggaran.`dasar_hukum` = '', sikd_rek_rincian_obj.`dasar_hukum`, 
                        rka_mata_anggaran.`dasar_hukum`) AS rka_mata_anggaran_dasar_hukum,
                        SUM(rka_mata_anggaran.`jumlah`)AS rka_mata_anggaran_jumlah
                    FROM
                        `sikd_rek_rincian_obj` sikd_rek_rincian_obj INNER JOIN `rka_mata_anggaran` rka_mata_anggaran ON sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj` = rka_mata_anggaran.`sikd_rek_rincian_obj_id`
                        INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                        INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                        INNER JOIN `sikd_rek_kelompok` sikd_rek_kelompok ON sikd_rek_jenis.`sikd_rek_kelompok_id` = sikd_rek_kelompok.`id_sikd_rek_kelompok`
                        INNER JOIN `sikd_rek_akun` sikd_rek_akun ON sikd_rek_kelompok.`sikd_rek_akun_id` = sikd_rek_akun.`id_sikd_rek_akun`
                        INNER JOIN `rka_rka` rka_rka ON rka_mata_anggaran.`rka_rka_id` = rka_rka.`id_rka_rka`
                    WHERE
                        sikd_rek_jenis.kd_rek_jenis = '511'
                        AND rka_rka.rka_perubahan = '0'
                        AND rka_rka.`rapbd_rapbd_id` = :idRapbd
                        AND if(:statusRka = 'Final',(rka_rka.`status_rka` = 1),(rka_rka.`status_rka` = 0 OR rka_rka.`status_rka` = 2))
                    GROUP BY
                        sikd_rek_akun_id_sikd_rek_akun,
                        sikd_rek_kelompok_id_sikd_rek_kelompok,
                        sikd_rek_jenis_id_sikd_rek_jenis,
                        sikd_rek_obj_id_sikd_rek_obj,
                        sikd_rek_rincian_obj_id_sikd_rek_rincian_obj
                    ORDER BY
                        sikd_rek_rincian_obj.`kd_rek_rincian_obj` ASC
                    ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rapbd_rapbd", $idRapbd);
            $statement->execute();
            $rapbdLampPmk07_2b2 = $statement->fetchAll();

            return new JsonResponse($rapbdLampPmk07_2b2);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getRapbdLampPmk07_2c1($request) {
        try {
            $idRapbd = $request->query->get("id_rapbd_rapbd");
            $tahun = $request->query->get("tahun");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRapbd = pack('H*', str_replace('-', '', trim($idRapbd)));
            $tahun = pack('H*', str_replace('-', '', trim($tahun)));
            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                        CONCAT_WS('-',
                            SUBSTR(HEX(sikd_rek_akun.`id_sikd_rek_akun`), 1, 8),
                            SUBSTR(HEX(sikd_rek_akun.`id_sikd_rek_akun`), 9, 4),
                            SUBSTR(HEX(sikd_rek_akun.`id_sikd_rek_akun`), 13, 4),
                            SUBSTR(HEX(sikd_rek_akun.`id_sikd_rek_akun`), 17, 4),
                            SUBSTR(HEX(sikd_rek_akun.`id_sikd_rek_akun`), 21)
                            ) AS sikd_rek_akun_id_sikd_rek_akun,
                        sikd_rek_akun.`kd_rek_akun` AS sikd_rek_akun_kd_rek_akun,
                        sikd_rek_akun.`nm_rek_akun` AS sikd_rek_akun_nm_rek_akun,
                        CONCAT_WS('-',
                             SUBSTR(HEX(sikd_rek_kelompok.`id_sikd_rek_kelompok`), 1, 8),
                             SUBSTR(HEX(sikd_rek_kelompok.`id_sikd_rek_kelompok`), 9, 4),
                             SUBSTR(HEX(sikd_rek_kelompok.`id_sikd_rek_kelompok`), 13, 4),
                             SUBSTR(HEX(sikd_rek_kelompok.`id_sikd_rek_kelompok`), 17, 4),
                             SUBSTR(HEX(sikd_rek_kelompok.`id_sikd_rek_kelompok`), 21)
                             ) AS sikd_rek_kelompok_id_sikd_rek_kelompok,
                        SUBSTR(sikd_rek_kelompok.`kd_rek_kelompok`,2,1) AS sikd_rek_kelompok_kd_rek_kelompok,
                        sikd_rek_kelompok.`nm_rek_kelompok` AS sikd_rek_kelompok_nm_rek_kelompok,
                        sikd_rek_kelompok.`dasar_hukum` AS sikd_rek_kelompok_dasar_hukum,
                        CONCAT_WS('-',
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 1, 8),
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 9, 4),
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 13, 4),
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 17, 4),
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 21)
                            ) AS sikd_rek_jenis_id_sikd_rek_jenis,
                        SUBSTR(sikd_rek_jenis.`kd_rek_jenis`,3,1) AS sikd_rek_jenis_kd_rek_jenis,
                        sikd_rek_jenis.`nm_rek_jenis` AS sikd_rek_jenis_nm_rek_jenis,
                        sikd_rek_jenis.`dasar_hukum` AS sikd_rek_jenis_dasar_hukum,
                        CONCAT_WS('-',
                             SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 1, 8),
                             SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 9, 4),
                             SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 13, 4),
                             SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 17, 4),
                             SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 21)
                             ) AS sikd_rek_obj_id_sikd_rek_obj,
                        SUBSTR(sikd_rek_obj.`kd_rek_obj`,4,2) AS sikd_rek_obj_kd_rek_obj,
                        sikd_rek_obj.`nm_rek_obj` AS sikd_rek_obj_nm_rek_obj,
                        sikd_rek_obj.`dasar_hukum` AS sikd_rek_obj_dasar_hukum,
                        CONCAT_WS('-',
                             SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 1, 8),
                             SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 9, 4),
                             SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 13, 4),
                             SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 17, 4),
                             SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 21)
                             ) AS sikd_rek_rincian_obj_id_sikd_rek_rincian_obj,
                        SUBSTR(sikd_rek_rincian_obj.`kd_rek_rincian_obj`,6,2) AS sikd_rek_rincian_obj_kd_rek_rincian_obj,
                        sikd_rek_rincian_obj.`nm_rek_rincian_obj` AS sikd_rek_rincian_obj_nm_rek_rincian_obj,
                        IF(rka_mata_anggaran.`dasar_hukum` = '', sikd_rek_rincian_obj.`dasar_hukum`, 
                        rka_mata_anggaran.`dasar_hukum`) AS rka_mata_anggaran_dasar_hukum,
                        SUM(rka_mata_anggaran.`jumlah`)AS rka_mata_anggaran_jumlah
                    FROM
                        `sikd_rek_rincian_obj` sikd_rek_rincian_obj INNER JOIN `rka_mata_anggaran` rka_mata_anggaran ON sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj` = rka_mata_anggaran.`sikd_rek_rincian_obj_id`
                        INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                        INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                        INNER JOIN `sikd_rek_kelompok` sikd_rek_kelompok ON sikd_rek_jenis.`sikd_rek_kelompok_id` = sikd_rek_kelompok.`id_sikd_rek_kelompok`
                        INNER JOIN `sikd_rek_akun` sikd_rek_akun ON sikd_rek_kelompok.`sikd_rek_akun_id` = sikd_rek_akun.`id_sikd_rek_akun`
                        INNER JOIN `rka_rka` rka_rka ON rka_mata_anggaran.`rka_rka_id` = rka_rka.`id_rka_rka`
                    WHERE
                        sikd_rek_akun.kd_rek_akun = '6'
                        AND rka_rka.rka_perubahan = '0'
                        AND rka_rka.`rapbd_rapbd_id` = :idRapbd
                        AND if(:statusRka = 'Final',(rka_rka.`status_rka` = 1),(rka_rka.`status_rka` = 0 OR rka_rka.`status_rka` = 2))
                    GROUP BY
                        sikd_rek_akun_id_sikd_rek_akun,
                        sikd_rek_kelompok_id_sikd_rek_kelompok,
                        sikd_rek_jenis_id_sikd_rek_jenis,
                        sikd_rek_obj_id_sikd_rek_obj,
                        sikd_rek_rincian_obj_id_sikd_rek_rincian_obj
                    ORDER BY
                        sikd_rek_rincian_obj.`kd_rek_rincian_obj` ASC
                    ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rapbd_rapbd", $idRapbd);
            $statement->execute();
            $rapbdLampPmk07_2c1 = $statement->fetchAll();

            return new JsonResponse($rapbdLampPmk07_2c1);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
        
        private function getRapbdLampPmk07_2h($request) {
        try {
            $idRapbd = $request->query->get("id_rapbd_rapbd");
            $tahun = $request->query->get("tahun");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRapbd = pack('H*', str_replace('-', '', trim($idRapbd)));
            $tahun = pack('H*', str_replace('-', '', trim($tahun)));
            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                        CONCAT_WS('-',
                            SUBSTR(HEX(sikd_rek_akun.`id_sikd_rek_akun`), 1, 8),
                            SUBSTR(HEX(sikd_rek_akun.`id_sikd_rek_akun`), 9, 4),
                            SUBSTR(HEX(sikd_rek_akun.`id_sikd_rek_akun`), 13, 4),
                            SUBSTR(HEX(sikd_rek_akun.`id_sikd_rek_akun`), 17, 4),
                            SUBSTR(HEX(sikd_rek_akun.`id_sikd_rek_akun`), 21)
                            ) AS sikd_rek_akun_id_sikd_rek_akun,
                        sikd_rek_akun.`kd_rek_akun` AS sikd_rek_akun_kd_rek_akun,
                        sikd_rek_akun.`nm_rek_akun` AS sikd_rek_akun_nm_rek_akun,
                        rapbd_rapbd.`id_rapbd_rapbd` AS rapbd_rapbd_id_rapbd_rapbd,
                        rapbd_rapbd.`tahun` AS rapbd_rapbd_tahun,
                        concat('GOLONGAN ',
                            IF(sikd_gol_pegawai.`golongan`='1', 'I',
                            IF(sikd_gol_pegawai.`golongan`='2', 'II',
                            IF(sikd_gol_pegawai.`golongan`='3', 'III',
                            IF(sikd_gol_pegawai.`golongan`='4', 'IV', ''))))) AS sikd_gol_pegawai_golongan,
                        concat('Golongan ',sikd_gol_pegawai.`nm_golongan`) AS sikd_gol_pegawai_nm_golongan,
                        rapbd_rekap_jml_pegawai.`jml_eselon_1` AS rapbd_rekap_jml_pegawai_jml_eselon_1,
                        rapbd_rekap_jml_pegawai.`jml_eselon_2` AS rapbd_rekap_jml_pegawai_jml_eselon_2,
                        rapbd_rekap_jml_pegawai.`jml_eselon_3` AS rapbd_rekap_jml_pegawai_jml_eselon_3,
                        rapbd_rekap_jml_pegawai.`jml_eselon_4` AS rapbd_rekap_jml_pegawai_jml_eselon_4,
                        rapbd_rekap_jml_pegawai.`jml_eselon_5` AS rapbd_rekap_jml_pegawai_jml_eselon_5,
                        rapbd_rekap_jml_pegawai.`jml_fungsional` AS rapbd_rekap_jml_pegawai_jml_fungsional,
                        rapbd_rekap_jml_pegawai.`jml_staf` AS rapbd_rekap_jml_pegawai_jml_staf
                    FROM
                        `rapbd_rekap_jml_pegawai` rapbd_rekap_jml_pegawai
                        INNER JOIN `sikd_gol_pegawai` sikd_gol_pegawai ON rapbd_rekap_jml_pegawai.`sikd_gol_pegawai_id` = sikd_gol_pegawai.`id_sikd_gol_pegawai`
                        RIGHT OUTER JOIN `rapbd_rapbd` rapbd_rapbd ON rapbd_rapbd.`id_rapbd_rapbd` = rapbd_rekap_jml_pegawai.`rapbd_rapbd_id`
                        ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rapbd_rapbd", $idRapbd);
            $statement->execute();
            $rapbdLampPmk07_2h = $statement->fetchAll();

            return new JsonResponse($rapbdLampPmk07_2h);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getRapbdLapSe03Adk_01($request) {
        try {
            $idRapbd = $request->query->get("id_rapbd_rapbd");
            $tahun = $request->query->get("tahun");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRapbd = pack('H*', str_replace('-', '', trim($idRapbd)));
            $tahun = pack('H*', str_replace('-', '', trim($tahun)));
            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                        sikd_rek_akun.`kd_rek_akun` AS sikd_rek_akun_kd_rek_akun,
                        sikd_rek_akun.`nm_rek_akun` AS sikd_rek_akun_nm_rek_akun,
                        SUBSTR(sikd_rek_kelompok.`kd_rek_kelompok`,2,1) AS sikd_rek_kelompok_kd_rek_kelompok,
                        sikd_rek_kelompok.`nm_rek_kelompok` AS sikd_rek_kelompok_nm_rek_kelompok,
                        SUBSTR(sikd_rek_jenis.`kd_rek_jenis`,3,1) AS sikd_rek_jenis_kd_rek_jenis,
                        sikd_rek_jenis.`nm_rek_jenis` AS sikd_rek_jenis_nm_rek_jenis,
                        SUBSTR(sikd_rek_obj.`kd_rek_obj`,4,2) AS sikd_rek_obj_kd_rek_obj,
                        sikd_rek_obj.`nm_rek_obj` AS sikd_rek_obj_nm_rek_obj,
                        SUBSTR(sikd_rek_rincian_obj.`kd_rek_rincian_obj`,6) AS sikd_rek_rincian_obj_kd_rek_rincian_obj,
                        sikd_rek_rincian_obj.`nm_rek_rincian_obj` AS sikd_rek_rincian_obj_nm_rek_rincian_obj,
                        CONCAT('0',sikd_urusan_satker.`kd_urusan`) AS sikd_urusan_kd_urusan,
                        CONCAT('Urusan ',sikd_urusan_satker.`nm_urusan`) AS sikd_urusan_nm_urusan,
                        SUBSTR(sikd_bidang_satker.`kd_bidang`,2) AS sikd_bidang_kd_bidang,
                        sikd_bidang_satker.`nm_bidang` AS sikd_bidang_nm_bidang,
                        SUBSTR(sikd_satker.`kode`,4) AS sikd_satker_kode,
                        sikd_satker.`nama` AS sikd_satker_nama,
                        sikd_prog.`kd_prog` AS sikd_prog_kd_prog,
                        sikd_prog.`nm_prog` AS sikd_prog_nm_prog,
                        SUBSTR(sikd_kgtn.`kd_kgtn`,3) AS sikd_kgtn_kd_kgtn,
                        sikd_kgtn.`nm_kgtn` AS sikd_kgtn_nm_kgtn,
                        sikd_fungsi.`kd_fungsi` AS sikd_fungsi_kd_fungsi,
                        sikd_fungsi.`nm_fungsi` AS sikd_fungsi_nm_fungsi,
                        CONCAT('0',sikd_urusan.`kd_urusan`) AS sikd_urusan_kd_urusan2,
                        CONCAT('Urusan ',sikd_urusan.`nm_urusan`) AS sikd_urusan_nm_urusan2,
                        SUBSTR(sikd_bidang.`kd_bidang`,2) AS sikd_bidang_kd_bidang2,
                        sikd_bidang.`nm_bidang` AS sikd_bidang_nm_bidang2,
                        rka_mata_anggaran.`jumlah` AS rka_mata_anggaran_jumlah
                    FROM
                        `vw_rka_skpd_skpkd_all` vw_rka_rka INNER JOIN `rka_mata_anggaran` rka_mata_anggaran ON vw_rka_rka.`rka_rka_id` = rka_mata_anggaran.`rka_rka_id`
                        INNER JOIN `rka_rka` rka_rka ON rka_rka.`id_rka_rka` = vw_rka_rka.`rka_rka_id`
                        INNER JOIN `sikd_satker` sikd_satker ON rka_rka.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                        INNER JOIN `sikd_bidang` sikd_bidang_satker ON sikd_satker.`kd_bidang_induk` = sikd_bidang_satker.`kd_bidang`
                        INNER JOIN `sikd_urusan` sikd_urusan_satker ON sikd_bidang_satker.`sikd_urusan_id` = sikd_urusan_satker.`id_sikd_urusan`
                        INNER JOIN `sikd_bidang` sikd_bidang ON vw_rka_rka.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                        INNER JOIN `sikd_fungsi` sikd_fungsi ON sikd_bidang.`sikd_fungsi_id` = sikd_fungsi.`id_sikd_fungsi`
                        INNER JOIN `sikd_urusan` sikd_urusan ON sikd_bidang.`sikd_urusan_id` = sikd_urusan.`id_sikd_urusan`
                        INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON rka_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                        INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                        INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                        INNER JOIN `sikd_rek_kelompok` sikd_rek_kelompok ON sikd_rek_jenis.`sikd_rek_kelompok_id` = sikd_rek_kelompok.`id_sikd_rek_kelompok`
                        INNER JOIN `sikd_rek_akun` sikd_rek_akun ON sikd_rek_kelompok.`sikd_rek_akun_id` = sikd_rek_akun.`id_sikd_rek_akun`
                        LEFT OUTER JOIN `rka_skpd_kgtn` rka_skpd_kgtn ON rka_rka.`id_rka_rka` = rka_skpd_kgtn.`id_rka_skpd_kgtn`
                        LEFT OUTER JOIN `sikd_kgtn` sikd_kgtn ON rka_skpd_kgtn.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                        LEFT OUTER JOIN `sikd_prog` sikd_prog ON sikd_kgtn.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                    WHERE
                        rka_mata_anggaran.`jumlah` > 0
                    AND rka_rka.rka_perubahan = '0'
                    ORDER BY
                        sikd_rek_rincian_obj.kd_rek_rincian_obj, sikd_satker.kode,
                        sikd_satker.kd_bidang_induk, sikd_prog.kd_prog, sikd_kgtn.kd_kgt
                    ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rapbd_rapbd", $idRapbd);
            $statement->execute();
            $rapbdLapSe03Adk_01 = $statement->fetchAll();

            return new JsonResponse($rapbdLapSe03Adk_01);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getRapbdIndikatorKgtn($request) {
        try {
            $idRapbd = $request->query->get("rapbd_rapbd_id");
            $tahun = $request->query->get("tahun");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRapbd = pack('H*', str_replace('-', '', trim($idRapbd)));
            $tahun = pack('H*', str_replace('-', '', trim($tahun)));
            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                        CONCAT_WS('-',
                            SUBSTR(HEX(rka_rka.`sikd_satker_id`), 1, 8),
                            SUBSTR(HEX(rka_rka.`sikd_satker_id`), 9, 4),
                            SUBSTR(HEX(rka_rka.`sikd_satker_id`), 13, 4),
                            SUBSTR(HEX(rka_rka.`sikd_satker_id`), 17, 4),
                            SUBSTR(HEX(rka_rka.`sikd_satker_id`), 21)
                            ) AS rka_rka_sikd_satker_id,
                        rka_skpd_kgtn.`kd_kegiatan` AS rka_skpd_kgtn_kd_kegiatan,
                        rka_skpd_kgtn.`nm_kegiatan` AS rka_skpd_kgtn_nm_kegiatan,
                        lpad(ifnull(rka_skpd_kgtn.`no_subkegiatan`,'0'),3,0) AS rka_skpd_kgtn_no_subkegiatan,
                        if(UPPER(rka_skpd_kgtn.`nm_kegiatan`) <> UPPER(rka_skpd_kgtn.`nm_subkegiatan`), rka_skpd_kgtn.`nm_subkegiatan`, '') AS rka_skpd_kgtn_nm_subkegiatan,
                        if(length(rka_skpd_kgtn.`kd_kegiatan`)='9',substr(rka_skpd_kgtn.`kd_kegiatan`,6,2),substr(rka_skpd_kgtn.`kd_kegiatan`,8,2))AS rka_skpd_kgtn_kd_prog,
                        rka_skpd_indktr_kinerja.`target` AS rka_skpd_indktr_kinerja_target,
                        CONCAT_WS('-',
                            SUBSTR(HEX(rka_skpd_kgtn.`id_rka_skpd_kgtn`), 1, 8),
                            SUBSTR(HEX(rka_skpd_kgtn.`id_rka_skpd_kgtn`), 9, 4),
                            SUBSTR(HEX(rka_skpd_kgtn.`id_rka_skpd_kgtn`), 13, 4),
                            SUBSTR(HEX(rka_skpd_kgtn.`id_rka_skpd_kgtn`), 17, 4),
                            SUBSTR(HEX(rka_skpd_kgtn.`id_rka_skpd_kgtn`), 21)
                            ) AS rka_skpd_kgtn_id_rka_skpd_kgtn,
                        sikd_bidang.`kd_bidang` AS sikd_bidang_kd_bidang,
                        sikd_bidang.`nm_bidang` AS sikd_bidang_nm_bidang,
                        sikd_satker.`kode` AS sikd_satker_kode,
                        sikd_satker.`nama` AS sikd_satker_nama,
                        sikd_sub_skpd.`kode` AS sikd_sub_skpd_kode,
                        sikd_sub_skpd.`nama` AS sikd_sub_skpd_nama
                    FROM
                        `rka_rka` rka_rka 
                        INNER JOIN `rka_skpd` rka_skpd ON rka_rka.`id_rka_rka` = rka_skpd.`id_rka_skpd`
                        INNER JOIN `rka_skpd_kgtn` rka_skpd_kgtn ON rka_skpd.`id_rka_skpd` = rka_skpd_kgtn.`id_rka_skpd_kgtn`
                        INNER JOIN `sikd_bidang` sikd_bidang ON rka_skpd.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                        INNER JOIN `rka_skpd_indktr_kinerja` rka_skpd_indktr_kinerja ON rka_skpd_kgtn.`id_rka_skpd_kgtn` = rka_skpd_indktr_kinerja.`rka_skpd_kgtn_id`
                        INNER JOIN `sikd_klpk_indikator` sikd_klpk_indikator ON rka_skpd_indktr_kinerja.`sikd_klpk_indikator_id` = sikd_klpk_indikator.`id_sikd_klpk_indikator`
                        INNER JOIN `sikd_satker` sikd_satker ON rka_rka.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                        LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON rka_rka.`sikd_sub_satker_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                    WHERE
                        rka_rka.`rapbd_rapbd_id` = :idRapbd
                        AND IF(:idSkpd != '', rka_rka.`sikd_satker_id` = :idSkpd, 1)
                        AND IF(:idSubSkpd != '', rka_rka.`sikd_sub_satker_id` = :idSubSkpd, 1)
                        AND (if(:statusRka='Final', rka_rka.`status_rka`='1', rka_rka.`status_rka`!='1'))
                        AND sikd_klpk_indikator.`nm_klpk_indikator`='Masukan'
                    ORDER BY
                        IF(sikd_bidang.`kd_bidang`=sikd_satker.kd_bidang_induk,0,1) ASC,
                        sikd_bidang.`kd_bidang` ASC,
                        rka_skpd_kgtn_kd_prog ASC,
                        rka_rka.`sikd_satker_id` ASC,
                        rka_rka.`sikd_sub_satker_id` ASC,
                        rka_skpd_kgtn.`kd_kegiatan` ASC
                        ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("rapbd_rapbd_id", $idRapbd);
            $statement->execute();
            $rapbdIndikatorKgtn = $statement->fetchAll();

            return new JsonResponse($rapbdIndikatorKgtn);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getRapbdBlSatker($request) {
        try {
            $idRapbd = $request->query->get("rapbd_rapbd_id");
            $tahun = $request->query->get("tahun");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRapbd = pack('H*', str_replace('-', '', trim($idRapbd)));
            $tahun = pack('H*', str_replace('-', '', trim($tahun)));
            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                        CONCAT_WS('-',
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 1, 8),
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 9, 4),
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 13, 4),
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 17, 4),
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 21)
                            ) AS sikd_satker_id_sikd_satker,
                        sikd_satker.`kode` AS sikd_satker_kode,
                        sikd_satker.`nama` AS sikd_satker_nama,
                        CONCAT_WS('-',
                            SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 1, 8),
                            SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 9, 4),
                            SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 13, 4),
                            SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 17, 4),
                            SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 21)
                            ) AS sikd_sub_skpd_id_sikd_sub_skpd,
                        sikd_sub_skpd.`kode` AS sikd_sub_skpd_kode,
                        sikd_sub_skpd.`nama` AS sikd_sub_skpd_nama,
                        CONCAT_WS('-',
                            SUBSTR(HEX(rka_rka.`id_rka_rka`), 1, 8),
                            SUBSTR(HEX(rka_rka.`id_rka_rka`), 9, 4),
                            SUBSTR(HEX(rka_rka.`id_rka_rka`), 13, 4),
                            SUBSTR(HEX(rka_rka.`id_rka_rka`), 17, 4),
                            SUBSTR(HEX(rka_rka.`id_rka_rka`), 21)
                            ) AS rka_rka_id_rka_rka,
                        rka_rka.`status_rka` AS rka_rka_status_rka,
                        CONCAT_WS('-',
                            SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 1, 8),
                            SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 9, 4),
                            SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 13, 4),
                            SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 17, 4),
                            SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 21)
                            ) AS sikd_bidang_id_sikd_bidang,
                        concat(IFNULL(sikd_sub_skpd.`kode`, sikd_satker.`kode`),".",sikd_bidang.`kd_bidang`) AS sikd_bidang_kd_bidang,
                        sikd_bidang.`nm_bidang` AS sikd_bidang_nm_bidang,
                        CONCAT_WS('-',
                            SUBSTR(HEX(sikd_prog.`id_sikd_prog), 1, 8),
                            SUBSTR(HEX(sikd_prog.`id_sikd_prog), 9, 4),
                            SUBSTR(HEX(sikd_prog.`id_sikd_prog), 13, 4),
                            SUBSTR(HEX(sikd_prog.`id_sikd_prog), 17, 4),
                            SUBSTR(HEX(sikd_prog.`id_sikd_prog), 21)
                            ) AS sikd_prog_id_sikd_prog,
                        concat(IFNULL(sikd_sub_skpd.`kode`, sikd_satker.`kode`),".",sikd_bidang.`kd_bidang`,".",sikd_prog.`kd_prog`) AS sikd_prog_kd_prog,
                        sikd_prog.`nm_prog` AS sikd_prog_nm_prog,
                        CONCAT_WS('-',
                            SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 1, 8),
                            SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 9, 4),
                            SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 13, 4),
                            SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 17, 4),
                            SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 21)
                            ) AS sikd_kgtn_id_sikd_kgtn,
                        concat(IFNULL(sikd_sub_skpd.`kode`, sikd_satker.`kode`),".",sikd_bidang.`kd_bidang`,".",sikd_prog.`kd_prog`,".",SUBSTR(rka_skpd_kgtn.`kd_kegiatan`,-2),if(rka_skpd_kgtn.`no_subkegiatan` in ('000','001'),'', concat(" - ",rka_skpd_kgtn.`no_subkegiatan`))) AS rka_skpd_kgtn_kd_kegiatan_,
                        IF(rka_skpd_kgtn.`nm_subkegiatan`!='', rka_skpd_kgtn.`nm_subkegiatan`, rka_skpd_kgtn.`nm_kegiatan`) AS rka_skpd_kgtn_nm_kegiatan_,
                        concat(IFNULL(sikd_sub_skpd.`kode`, sikd_satker.`kode`),".",sikd_bidang.`kd_bidang`,".",sikd_prog.`kd_prog`,".",SUBSTR(rka_skpd_kgtn.`kd_kegiatan`,-2)) AS rka_skpd_kgtn_kd_kegiatan,
                        rka_skpd_kgtn.`nm_kegiatan` AS rka_skpd_kgtn_nm_kegiatan,
                        rka_skpd_kgtn.`no_subkegiatan` AS rka_skpd_kgtn_no_subkegiatan,
                        rka_skpd_kgtn.`nm_subkegiatan` AS rka_skpd_kgtn_nm_subkegiatan,
                        rka_skpd_kgtn.`jml_anggaran` AS rka_skpd_kgtn_jml_anggaran,
                        CONCAT_WS('-',
                            SUBSTR(HEX(rka_mata_anggaran.`id_rka_mata_anggaran`), 1, 8),
                            SUBSTR(HEX(rka_mata_anggaran.`id_rka_mata_anggaran`), 9, 4),
                            SUBSTR(HEX(rka_mata_anggaran.`id_rka_mata_anggaran`), 13, 4),
                            SUBSTR(HEX(rka_mata_anggaran.`id_rka_mata_anggaran`), 17, 4),
                            SUBSTR(HEX(rka_mata_anggaran.`id_rka_mata_anggaran`), 21)
                            ) AS rka_mata_anggaran_id_rka_mata_anggaran,
                        SUM(IF(SUBSTR(sikd_rek_rincian_obj.`kd_rek_rincian_obj`,1,3)='521',rka_mata_anggaran.`jumlah`,0)) AS jml_bl_pegawai,
                        SUM(IF(SUBSTR(sikd_rek_rincian_obj.`kd_rek_rincian_obj`,1,3)='522',rka_mata_anggaran.`jumlah`,0)) AS jml_bl_brgjasa,
                        SUM(IF(SUBSTR(sikd_rek_rincian_obj.`kd_rek_rincian_obj`,1,3)='523',rka_mata_anggaran.`jumlah`,0)) AS jml_bl_modal,
                        SUM(IFNULL(rka_mata_anggaran.`jumlah`,0)) AS jml_bl_ttl
                    FROM
                        `rka_rka` rka_rka 
                        INNER JOIN `sikd_satker` sikd_satker ON rka_rka.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                        LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON rka_rka.`sikd_sub_satker_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                        INNER JOIN `rka_skpd` rka_skpd ON rka_rka.`id_rka_rka` = rka_skpd.`id_rka_skpd`
                        INNER JOIN `rka_skpd_kgtn` rka_skpd_kgtn ON rka_skpd.`id_rka_skpd` = rka_skpd_kgtn.`id_rka_skpd_kgtn`
                        INNER JOIN `sikd_bidang` sikd_bidang ON rka_skpd.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                        INNER JOIN `sikd_kgtn` sikd_kgtn ON rka_skpd_kgtn.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                        INNER JOIN `sikd_prog` sikd_prog ON sikd_kgtn.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                        LEFT OUTER JOIN `rka_mata_anggaran` rka_mata_anggaran ON rka_rka.`id_rka_rka` = rka_mata_anggaran.`rka_rka_id`
                        LEFT OUTER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON rka_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                        AND sikd_rek_rincian_obj.kd_rek_rincian_obj LIKE '52%'
                    WHERE
                        rka_rka.rapbd_rapbd_id = :idRapbd
                        AND rka_rka.rka_perubahan = '0'
                        AND if(:statusRka = 'Final',(rka_rka.`status_rka` = 1),(rka_rka.`status_rka` = 0 OR rka_rka.`status_rka` = 2))
                    GROUP BY
                        sikd_satker.`id_sikd_satker`,
                        sikd_sub_skpd.`id_sikd_sub_skpd`,
                        sikd_bidang.`id_sikd_bidang`,
                        sikd_prog.`id_sikd_prog`,
                        rka_skpd_kgtn_kd_kegiatan,
                        rka_skpd_kgtn.`no_subkegiatan`
                    ORDER BY
                         sikd_satker.kode ASC,
                         sikd_sub_skpd.kode ASC,
                         sikd_bidang.`kd_bidang` ASC,
                         sikd_prog.`kd_prog` ASC,
                         rka_skpd_kgtn_kd_kegiatan ASC,
                         lpad(rka_skpd_kgtn.`no_subkegiatan`,3,0)
                        ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("rapbd_rapbd_id", $idRapbd);
            $statement->execute();
            $rapbdBlSatker = $statement->fetchAll();

            return new JsonResponse($rapbdBlSatker);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getRapbdKgtnBlmAdaPrioritas($request) {
        try {
            $idRapbd = $request->query->get("id_rapbd_prog_prioritas_kgtn");
            $tahun = $request->query->get("tahun");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRapbd = pack('H*', str_replace('-', '', trim($idRapbd)));
            $tahun = pack('H*', str_replace('-', '', trim($tahun)));
            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                        CONCAT_WS('-',
                            SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 1, 8),
                            SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 9, 4),
                            SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 13, 4),
                            SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 17, 4),
                            SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 21)
                            ) AS sikd_bidang_id_sikd_bidang,
                        sikd_bidang.`kd_bidang` AS sikd_bidang_kd_bidang,
                        sikd_bidang.`nm_bidang` AS sikd_bidang_nm_bidang,
                        CONCAT_WS('-',
                            SUBSTR(HEX(sikd_prog.`id_sikd_prog), 1, 8),
                            SUBSTR(HEX(sikd_prog.`id_sikd_prog), 9, 4),
                            SUBSTR(HEX(sikd_prog.`id_sikd_prog), 13, 4),
                            SUBSTR(HEX(sikd_prog.`id_sikd_prog), 17, 4),
                            SUBSTR(HEX(sikd_prog.`id_sikd_prog), 21)
                            ) AS sikd_prog_id_sikd_prog,
                        sikd_prog.`kd_bidang` AS sikd_prog_kd_bidang,
                        sikd_prog.`kd_prog` AS sikd_prog_kd_prog,
                        sikd_prog.`nm_prog` AS sikd_prog_nm_prog,
                        CONCAT_WS('-',
                            SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 1, 8),
                            SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 9, 4),
                            SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 13, 4),
                            SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 17, 4),
                            SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 21)
                            ) AS sikd_kgtn_id_sikd_kgtn,
                        sikd_kgtn.`kd_bidang` AS sikd_kgtn_kd_bidang,
                        sikd_kgtn.`kd_kgtn` AS sikd_kgtn_kd_kgtn,
                        sikd_kgtn.`nm_kgtn` AS sikd_kgtn_nm_kgtn
                    FROM
                       `sikd_prog` sikd_prog 
                        INNER JOIN `sikd_kgtn` sikd_kgtn ON sikd_prog.`id_sikd_prog` = sikd_kgtn.`sikd_prog_id`
                        INNER JOIN `sikd_bidang` sikd_bidang ON sikd_prog.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                        INNER JOIN `rka_skpd_kgtn` rka_skpd_kgtn ON rka_skpd_kgtn.sikd_kgtn_id = sikd_kgtn.id_sikd_kgtn
                        LEFT OUTER JOIN rapbd_prog_prioritas_kgtn rapbd_prog_prioritas_kgtn ON rka_skpd_kgtn.sikd_kgtn_id = rapbd_prog_prioritas_kgtn.sikd_kgtn_id
                        LEFT OUTER JOIN rkpd_prioritas_nasional rkpd_prioritas_nasional ON rapbd_prog_prioritas_kgtn.rkpd_prioritas_id = rkpd_prioritas_nasional.id_rkpd_prioritas_nasional
                    WHERE
                        rapbd_prog_prioritas_kgtn.id_rapbd_prog_prioritas_kgtn IS NULL
                    GROUP BY
                        sikd_bidang.`kd_bidang`,
                        sikd_prog.`kd_prog`,
                        sikd_kgtn.`kd_kgtn`
                    ORDER BY
                        sikd_bidang.`kd_bidang`,
                        sikd_prog.`kd_prog`,
                        CAST(sikd_kgtn.`kd_kgtn` AS UNSIGNED),
                        sikd_kgtn.`kd_kgtn`
                    ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rapbd_prog_prioritas_kgtn", $idRapbd);
            $statement->execute();
            $rapbdKgtnBlmAdaPrioritas = $statement->fetchAll();

            return new JsonResponse($rapbdKgtnBlmAdaPrioritas);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getRapbdKgtnBlmAdaPrioritasKab($request) {
        try {
            $idRapbd = $request->query->get("id_rapbd_prog_prioritas_kgtn");
            $tahun = $request->query->get("tahun");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRapbd = pack('H*', str_replace('-', '', trim($idRapbd)));
            $tahun = pack('H*', str_replace('-', '', trim($tahun)));
            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                        CONCAT_WS('-',
                            SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 1, 8),
                            SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 9, 4),
                            SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 13, 4),
                            SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 17, 4),
                            SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 21)
                            ) AS sikd_bidang_id_sikd_bidang,
                        sikd_bidang.`kd_bidang` AS sikd_bidang_kd_bidang,
                        sikd_bidang.`nm_bidang` AS sikd_bidang_nm_bidang,
                        CONCAT_WS('-',
                            SUBSTR(HEX(sikd_prog.`id_sikd_prog), 1, 8),
                            SUBSTR(HEX(sikd_prog.`id_sikd_prog), 9, 4),
                            SUBSTR(HEX(sikd_prog.`id_sikd_prog), 13, 4),
                            SUBSTR(HEX(sikd_prog.`id_sikd_prog), 17, 4),
                            SUBSTR(HEX(sikd_prog.`id_sikd_prog), 21)
                            ) AS sikd_prog_id_sikd_prog,
                        sikd_prog.`kd_bidang` AS sikd_prog_kd_bidang,
                        sikd_prog.`kd_prog` AS sikd_prog_kd_prog,
                        sikd_prog.`nm_prog` AS sikd_prog_nm_prog,
                        CONCAT_WS('-',
                            SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 1, 8),
                            SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 9, 4),
                            SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 13, 4),
                            SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 17, 4),
                            SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 21)
                            ) AS sikd_kgtn_id_sikd_kgtn,
                        sikd_kgtn.`kd_bidang` AS sikd_kgtn_kd_bidang,
                        sikd_kgtn.`kd_kgtn` AS sikd_kgtn_kd_kgtn,
                        sikd_kgtn.`nm_kgtn` AS sikd_kgtn_nm_kgtn
                    FROM
                       `sikd_prog` sikd_prog INNER JOIN `sikd_kgtn` sikd_kgtn ON sikd_prog.`id_sikd_prog` = sikd_kgtn.`sikd_prog_id`
                        INNER JOIN `sikd_bidang` sikd_bidang ON sikd_prog.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                        INNER JOIN `rka_skpd_kgtn` rka_skpd_kgtn ON rka_skpd_kgtn.sikd_kgtn_id = sikd_kgtn.id_sikd_kgtn
                        INNER JOIN `rka_rka` rka_rka ON rka_skpd_kgtn.id_rka_skpd_kgtn = rka_rka.id_rka_rka
                        INNER JOIN `sikd_satker` sikd_satker ON rka_rka.sikd_satker_id = sikd_satker.id_sikd_satker
                        LEFT OUTER JOIN 
                        (select id_rapbd_prog_prioritas_kgtn, sikd_kgtn_id
                         from rapbd_prog_prioritas_kgtn, rkpd_prioritas_kab
                         where rkpd_prioritas_id = id_rkpd_prioritas_kab) AS rapbd_prog_prioritas_kgtn
                         ON rka_skpd_kgtn.sikd_kgtn_id = rapbd_prog_prioritas_kgtn.sikd_kgtn_id
                    WHERE
                        rapbd_prog_prioritas_kgtn.id_rapbd_prog_prioritas_kgtn IS NULL
                    GROUP BY
                        sikd_kgtn.id_sikd_kgtn
                    ORDER BY
                        sikd_bidang.`kd_bidang`,
                        sikd_prog.`kd_prog`,
                        CAST(sikd_kgtn.`kd_kgtn` AS UNSIGNED)
                    ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rapbd_prog_prioritas_kgtn", $idRapbd);
            $statement->execute();
            $rapbdKgtnBlmAdaPrioritasKab = $statement->fetchAll();

            return new JsonResponse($rapbdKgtnBlmAdaPrioritasKab);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getRapbdKgtnBlmAdaPrioritasProv($request) {
        try {
            $idRapbd = $request->query->get("id_rapbd_prog_prioritas_kgtn");
            $tahun = $request->query->get("tahun");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRapbd = pack('H*', str_replace('-', '', trim($idRapbd)));
            $tahun = pack('H*', str_replace('-', '', trim($tahun)));
            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                        CONCAT_WS('-',
                            SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 1, 8),
                            SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 9, 4),
                            SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 13, 4),
                            SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 17, 4),
                            SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 21)
                            ) AS sikd_bidang_id_sikd_bidang,
                        sikd_bidang.`kd_bidang` AS sikd_bidang_kd_bidang,
                        sikd_bidang.`nm_bidang` AS sikd_bidang_nm_bidang,
                        CONCAT_WS('-',
                            SUBSTR(HEX(sikd_prog.`id_sikd_prog), 1, 8),
                            SUBSTR(HEX(sikd_prog.`id_sikd_prog), 9, 4),
                            SUBSTR(HEX(sikd_prog.`id_sikd_prog), 13, 4),
                            SUBSTR(HEX(sikd_prog.`id_sikd_prog), 17, 4),
                            SUBSTR(HEX(sikd_prog.`id_sikd_prog), 21)
                            ) AS sikd_prog_id_sikd_prog,
                        sikd_prog.`kd_bidang` AS sikd_prog_kd_bidang,
                        sikd_prog.`kd_prog` AS sikd_prog_kd_prog,
                        sikd_prog.`nm_prog` AS sikd_prog_nm_prog,
                        CONCAT_WS('-',
                            SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 1, 8),
                            SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 9, 4),
                            SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 13, 4),
                            SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 17, 4),
                            SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 21)
                            ) AS sikd_kgtn_id_sikd_kgtn,
                        sikd_kgtn.`kd_bidang` AS sikd_kgtn_kd_bidang,
                        sikd_kgtn.`kd_kgtn` AS sikd_kgtn_kd_kgtn,
                        sikd_kgtn.`nm_kgtn` AS sikd_kgtn_nm_kgtn
                    FROM
                       `sikd_prog` sikd_prog INNER JOIN `sikd_kgtn` sikd_kgtn ON sikd_prog.`id_sikd_prog` = sikd_kgtn.`sikd_prog_id`
                        INNER JOIN `sikd_bidang` sikd_bidang ON sikd_prog.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                        INNER JOIN rka_skpd_kgtn rka_skpd_kgtn ON rka_skpd_kgtn.sikd_kgtn_id = sikd_kgtn.id_sikd_kgtn
                        LEFT OUTER JOIN 
                        (select id_rapbd_prog_prioritas_kgtn, sikd_kgtn_id
                        from rapbd_prog_prioritas_kgtn, rkpd_prioritas_prov
                        where rkpd_prioritas_id = id_rkpd_prioritas_prov) AS rapbd_prog_prioritas_kgtn
                        ON rka_skpd_kgtn.sikd_kgtn_id = rapbd_prog_prioritas_kgtn.sikd_kgtn_id
                    WHERE
                        rapbd_prog_prioritas_kgtn.id_rapbd_prog_prioritas_kgtn IS NULL
                    GROUP BY
                        sikd_kgtn.id_sikd_kgtn
                    ORDER BY
                        sikd_bidang.`kd_bidang`,
                        sikd_prog.`kd_prog`,
                        CAST(sikd_kgtn.`kd_kgtn` AS UNSIGNED)
                    ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rapbd_prog_prioritas_kgtn", $idRapbd);
            $statement->execute();
            $rapbdKgtnBlmAdaPrioritasProv = $statement->fetchAll();

            return new JsonResponse($rapbdKgtnBlmAdaPrioritasProv);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getRapbdKgtnBlmAdaPrioritasNas($request) {
        try {
            $idRapbd = $request->query->get("id_rapbd_prog_prioritas_kgtn");
            $tahun = $request->query->get("tahun");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRapbd = pack('H*', str_replace('-', '', trim($idRapbd)));
            $tahun = pack('H*', str_replace('-', '', trim($tahun)));
            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                        CONCAT_WS('-',
                            SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 1, 8),
                            SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 9, 4),
                            SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 13, 4),
                            SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 17, 4),
                            SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 21)
                            ) AS sikd_bidang_id_sikd_bidang,
                        sikd_bidang.`kd_bidang` AS sikd_bidang_kd_bidang,
                        sikd_bidang.`nm_bidang` AS sikd_bidang_nm_bidang,
                        CONCAT_WS('-',
                            SUBSTR(HEX(sikd_prog.`id_sikd_prog), 1, 8),
                            SUBSTR(HEX(sikd_prog.`id_sikd_prog), 9, 4),
                            SUBSTR(HEX(sikd_prog.`id_sikd_prog), 13, 4),
                            SUBSTR(HEX(sikd_prog.`id_sikd_prog), 17, 4),
                            SUBSTR(HEX(sikd_prog.`id_sikd_prog), 21)
                            ) AS sikd_prog_id_sikd_prog,
                        sikd_prog.`kd_bidang` AS sikd_prog_kd_bidang,
                        sikd_prog.`kd_prog` AS sikd_prog_kd_prog,
                        sikd_prog.`nm_prog` AS sikd_prog_nm_prog,
                        CONCAT_WS('-',
                            SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 1, 8),
                            SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 9, 4),
                            SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 13, 4),
                            SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 17, 4),
                            SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 21)
                            ) AS sikd_kgtn_id_sikd_kgtn,
                        sikd_kgtn.`kd_bidang` AS sikd_kgtn_kd_bidang,
                        sikd_kgtn.`kd_kgtn` AS sikd_kgtn_kd_kgtn,
                        sikd_kgtn.`nm_kgtn` AS sikd_kgtn_nm_kgtn
                    FROM
                       `sikd_prog` sikd_prog INNER JOIN `sikd_kgtn` sikd_kgtn ON sikd_prog.`id_sikd_prog` = sikd_kgtn.`sikd_prog_id`
                        INNER JOIN `sikd_bidang` sikd_bidang ON sikd_prog.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                        INNER JOIN rka_skpd_kgtn rka_skpd_kgtn ON rka_skpd_kgtn.sikd_kgtn_id = sikd_kgtn.id_sikd_kgtn
                        LEFT OUTER JOIN 
                        (select id_rapbd_prog_prioritas_kgtn, sikd_kgtn_id
                        from rapbd_prog_prioritas_kgtn, rkpd_prioritas_nasional
                        where rkpd_prioritas_id = id_rkpd_prioritas_nasional) AS rapbd_prog_prioritas_kgtn
                        ON rka_skpd_kgtn.sikd_kgtn_id = rapbd_prog_prioritas_kgtn.sikd_kgtn_id
                    WHERE
                        rapbd_prog_prioritas_kgtn.id_rapbd_prog_prioritas_kgtn IS NULL
                    GROUP BY
                        sikd_kgtn.id_sikd_kgtn
                    ORDER BY
                        sikd_bidang.`kd_bidang`,
                        sikd_prog.`kd_prog`,
                        CAST(sikd_kgtn.`kd_kgtn` AS UNSIGNED)
                    ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rapbd_prog_prioritas_kgtn", $idRapbd);
            $statement->execute();
            $rapbdKgtnBlmAdaPrioritasNas = $statement->fetchAll();

            return new JsonResponse($rapbdKgtnBlmAdaPrioritasNas);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getRapbdBtlSatker($request) {
        try {
            $idRapbd = $request->query->get("rapbd_rapbd_id");
            $tahun = $request->query->get("tahun");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRapbd = pack('H*', str_replace('-', '', trim($idRapbd)));
            $tahun = pack('H*', str_replace('-', '', trim($tahun)));
            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                        CONCAT_WS('-',
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 1, 8),
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 9, 4),
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 13, 4),
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 17, 4),
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 21)
                            ) AS sikd_satker_id_sikd_satker,
                        sikd_satker.`kode` AS sikd_satker_kode,
                        sikd_satker.`nama` AS sikd_satker_nama,
                        CONCAT_WS('-',
                            SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 1, 8),
                            SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 9, 4),
                            SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 13, 4),
                            SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 17, 4),
                            SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 21)
                            ) AS sikd_sub_skpd_id_sikd_sub_skpd,
                        sikd_sub_skpd.`kode` AS sikd_sub_skpd_kode,
                        sikd_sub_skpd.`nama` AS sikd_sub_skpd_nama,
                        CONCAT_WS('-',
                            SUBSTR(HEX(rka_rka.`id_rka_rka`), 1, 8),
                            SUBSTR(HEX(rka_rka.`id_rka_rka`), 9, 4),
                            SUBSTR(HEX(rka_rka.`id_rka_rka`), 13, 4),
                            SUBSTR(HEX(rka_rka.`id_rka_rka`), 17, 4),
                            SUBSTR(HEX(rka_rka.`id_rka_rka`), 21)
                            ) AS rka_rka_id_rka_rka,
                        rka_rka.`status_rka` AS rka_rka_status_rka,
                        CONCAT_WS('-',
                            SUBSTR(HEX(rka_mata_anggaran.`id_rka_mata_anggaran`), 1, 8),
                            SUBSTR(HEX(rka_mata_anggaran.`id_rka_mata_anggaran`), 9, 4),
                            SUBSTR(HEX(rka_mata_anggaran.`id_rka_mata_anggaran`), 13, 4),
                            SUBSTR(HEX(rka_mata_anggaran.`id_rka_mata_anggaran`), 17, 4),
                            SUBSTR(HEX(rka_mata_anggaran.`id_rka_mata_anggaran`), 21)
                            ) AS rka_mata_anggaran_id_rka_mata_anggaran,
                        CONCAT_WS('-',
                            SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 1, 8),
                            SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 9, 4),
                            SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 13, 4),
                            SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 17, 4),
                            SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 21)
                            ) AS sikd_rek_rincian_obj_id_sikd_rek_rincian_obj,
                        sikd_rek_rincian_obj.`kd_rek_rincian_obj` AS sikd_rek_rincian_obj_kd_rek_rincian_obj,
                        sikd_rek_rincian_obj.`nm_rek_rincian_obj` AS sikd_rek_rincian_obj_nm_rek_rincian_obj,
                        SUM(rka_mata_anggaran.`jumlah`) AS jumlah
                    FROM
                        `rka_rka` rka_rka INNER JOIN `rka_mata_anggaran` rka_mata_anggaran ON rka_rka.`id_rka_rka` = rka_mata_anggaran.`rka_rka_id`
                        INNER JOIN `sikd_satker` sikd_satker ON rka_rka.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                        LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON rka_rka.`sikd_sub_satker_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                        INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON rka_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                    WHERE
                        rka_rka.rapbd_rapbd_id = :idRapbd
                        AND sikd_rek_rincian_obj.kd_rek_rincian_obj like '51%'
                        AND rka_rka.rka_perubahan = '0'
                        AND if(:statusRka = 'Final',(rka_rka.`status_rka` = 1),(rka_rka.`status_rka` = 0 OR rka_rka.`status_rka` = 2))
                    GROUP BY
                        sikd_satker.`id_sikd_satker`,
                        sikd_satker.`kode`,
                        sikd_satker.`nama`,
                        sikd_sub_skpd.`id_sikd_sub_skpd`,
                        sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                    ORDER BY
                        sikd_satker.kode,
                        sikd_sub_skpd.kode,
                        sikd_rek_rincian_obj.kd_rek_rincian_obj
                        ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("rapbd_rapbd_id", $idRapbd);
            $statement->execute();
            $rapbdBtlSatker = $statement->fetchAll();

            return new JsonResponse($rapbdBtlSatker);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getRapbdRekapKgtnSatker($request) {
        try {
            $idRapbd = $request->query->get("rapbd_rapbd_id");
            $tahun = $request->query->get("tahun");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRapbd = pack('H*', str_replace('-', '', trim($idRapbd)));
            $tahun = pack('H*', str_replace('-', '', trim($tahun)));
            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                        CONCAT_WS('-',
                            SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 1, 8),
                            SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 9, 4),
                            SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 13, 4),
                            SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 17, 4),
                            SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 21)
                            ) AS sikd_bidang_id_sikd_bidang,
                        sikd_bidang.`kd_bidang` AS sikd_bidang_kd_bidang,
                        sikd_bidang.`nm_bidang` AS sikd_bidang_nm_bidang,
                        CONCAT_WS('-',
                            SUBSTR(HEX(sikd_prog.`id_sikd_prog), 1, 8),
                            SUBSTR(HEX(sikd_prog.`id_sikd_prog), 9, 4),
                            SUBSTR(HEX(sikd_prog.`id_sikd_prog), 13, 4),
                            SUBSTR(HEX(sikd_prog.`id_sikd_prog), 17, 4),
                            SUBSTR(HEX(sikd_prog.`id_sikd_prog), 21)
                            ) AS sikd_prog_id_sikd_prog,
                        CONCAT(sikd_bidang.`kd_bidang`,".",sikd_prog.`kd_prog`) AS sikd_prog_kd_prog,
                        sikd_prog.`nm_prog` AS sikd_prog_nm_prog,
                        CONCAT_WS('-',
                            SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 1, 8),
                            SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 9, 4),
                            SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 13, 4),
                            SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 17, 4),
                            SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 21)
                            ) AS sikd_kgtn_id_sikd_kgtn,
                        CONCAT(sikd_bidang.`kd_bidang`,".",sikd_prog.`kd_prog`,".",SUBSTRING(sikd_kgtn.`kd_kgtn`,3,3)) AS sikd_kgtn_kd_kgtn,
                        sikd_kgtn.`nm_kgtn` AS sikd_kgtn_nm_kgtn,
                        CONCAT_WS('-',
                            SUBSTR(HEX(rka_skpd_kgtn.`id_rka_skpd_kgtn`), 1, 8),
                            SUBSTR(HEX(rka_skpd_kgtn.`id_rka_skpd_kgtn`), 9, 4),
                            SUBSTR(HEX(rka_skpd_kgtn.`id_rka_skpd_kgtn`), 13, 4),
                            SUBSTR(HEX(rka_skpd_kgtn.`id_rka_skpd_kgtn`), 17, 4),
                            SUBSTR(HEX(rka_skpd_kgtn.`id_rka_skpd_kgtn`), 21)
                            ) AS rka_skpd_kgtn_id_rka_skpd_kgtn,
                        rka_skpd_kgtn.`kd_kegiatan` AS rka_skpd_kgtn_kd_kegiatan,
                        rka_skpd_kgtn.`nm_kegiatan` AS rka_skpd_kgtn_nm_kegiatan,
                        rka_skpd_kgtn.`nm_subkegiatan` AS rka_skpd_kgtn_nm_subkegiatan,
                        CONCAT_WS('-',
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 1, 8),
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 9, 4),
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 13, 4),
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 17, 4),
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 21)
                            ) AS sikd_satker_id_sikd_satker,
                        IFNULL(sikd_sub_skpd.`kode`, sikd_satker.`kode`) AS sikd_satker_kode,
                        IFNULL(sikd_sub_skpd.`nama`, sikd_satker.`nama`) AS sikd_satker_nama,
                        rka_skpd_kgtn.`jml_anggaran` AS rka_skpd_kgtn_jml_anggaran
                    FROM
                        `rka_rka` rka_rka INNER JOIN `rka_skpd` rka_skpd ON rka_rka.`id_rka_rka` = rka_skpd.`id_rka_skpd`
                        INNER JOIN `rka_skpd_kgtn` rka_skpd_kgtn ON rka_skpd.`id_rka_skpd` = rka_skpd_kgtn.`id_rka_skpd_kgtn`
                        INNER JOIN `sikd_kgtn` sikd_kgtn ON rka_skpd_kgtn.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                        INNER JOIN `sikd_prog` sikd_prog ON sikd_kgtn.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                        INNER JOIN `sikd_bidang` sikd_bidang ON sikd_prog.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                        INNER JOIN `sikd_satker` sikd_satker ON rka_rka.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                        LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON rka_rka.`sikd_sub_satker_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                    WHERE
                        rka_rka.`rapbd_rapbd_id` = :idRapbd
                        AND rka_rka.rka_perubahan = '0'
                        AND if(:statusRka = 'Final',(rka_rka.`status_rka` = 1),(rka_rka.`status_rka` = 0 OR rka_rka.`status_rka` = 2))
                        AND rka_skpd_kgtn.`jml_anggaran` > 0
                    ORDER BY
                        sikd_bidang.kd_bidang, sikd_prog.kd_prog, sikd_kgtn.kd_kgtn, sikd_satker.kode, sikd_sub_skpd.kode
                        ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("rapbd_rapbd_id", $idRapbd);
            $statement->execute();
            $rapbdRekapKgtnSatker = $statement->fetchAll();

            return new JsonResponse($rapbdRekapKgtnSatker);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getRapbdRekapMakSatker($request) {
        try {
            $idRapbd = $request->query->get("rapbd_rapbd_id");
            $tahun = $request->query->get("tahun");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRapbd = pack('H*', str_replace('-', '', trim($idRapbd)));
            $tahun = pack('H*', str_replace('-', '', trim($tahun)));
            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                        CONCAT_WS('-',
                            SUBSTR(HEX(sikd_rek_akun.`id_sikd_rek_akun`), 1, 8),
                            SUBSTR(HEX(sikd_rek_akun.`id_sikd_rek_akun`), 9, 4),
                            SUBSTR(HEX(sikd_rek_akun.`id_sikd_rek_akun`), 13, 4),
                            SUBSTR(HEX(sikd_rek_akun.`id_sikd_rek_akun`), 17, 4),
                            SUBSTR(HEX(sikd_rek_akun.`id_sikd_rek_akun`), 21)
                            ) AS sikd_rek_akun_id_sikd_rek_akun,
                        sikd_rek_akun.`kd_rek_akun` AS sikd_rek_akun_kd_rek_akun,
                        sikd_rek_akun.`nm_rek_akun` AS sikd_rek_akun_nm_rek_akun,
                        CONCAT_WS('-',
                            SUBSTR(HEX(sikd_rek_kelompok.`id_sikd_rek_kelompok`), 1, 8),
                            SUBSTR(HEX(sikd_rek_kelompok.`id_sikd_rek_kelompok`), 9, 4),
                            SUBSTR(HEX(sikd_rek_kelompok.`id_sikd_rek_kelompok`), 13, 4),
                            SUBSTR(HEX(sikd_rek_kelompok.`id_sikd_rek_kelompok`), 17, 4),
                            SUBSTR(HEX(sikd_rek_kelompok.`id_sikd_rek_kelompok`), 21)
                            ) AS sikd_rek_kelompok_id_sikd_rek_kelompok,
                        CONCAT(sikd_rek_akun.`kd_rek_akun`,".",
                            SUBSTRING(sikd_rek_kelompok.`kd_rek_kelompok`,2,1)) AS sikd_rek_kelompok_kd_rek_kelompok,
                        sikd_rek_kelompok.`nm_rek_kelompok` AS sikd_rek_kelompok_nm_rek_kelompok,
                        CONCAT_WS('-',
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 1, 8),
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 9, 4),
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 13, 4),
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 17, 4),
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 21)
                            ) AS sikd_rek_jenis_id_sikd_rek_jenis,
                        CONCAT(sikd_rek_akun.`kd_rek_akun`,".",
                            SUBSTRING(sikd_rek_kelompok.`kd_rek_kelompok`,2,1),".",
                            SUBSTRING(sikd_rek_jenis.`kd_rek_jenis`,3,1)) AS sikd_rek_jenis_kd_rek_jenis,
                        sikd_rek_jenis.`nm_rek_jenis` AS sikd_rek_jenis_nm_rek_jenis,
                        CONCAT_WS('-',
                            SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 1, 8),
                            SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 9, 4),
                            SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 13, 4),
                            SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 17, 4),
                            SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 21)
                            ) AS sikd_rek_obj_id_sikd_rek_obj,
                        CONCAT(sikd_rek_akun.`kd_rek_akun`,".",
                            SUBSTRING(sikd_rek_kelompok.`kd_rek_kelompok`,2,1),".",
                            SUBSTRING(sikd_rek_jenis.`kd_rek_jenis`,3,1),".",
                            SUBSTRING(sikd_rek_obj.`kd_rek_obj`,4,2)) AS sikd_rek_obj_kd_rek_obj,
                        sikd_rek_obj.`nm_rek_obj` AS sikd_rek_obj_nm_rek_obj,
                        CONCAT_WS('-',
                            SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 1, 8),
                            SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 9, 4),
                            SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 13, 4),
                            SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 17, 4),
                            SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 21)
                            ) AS sikd_rek_rincian_obj_id_sikd_rek_rincian_obj,
                        CONCAT(sikd_rek_akun.`kd_rek_akun`,".",
                            SUBSTRING(sikd_rek_kelompok.`kd_rek_kelompok`,2,1),".",
                            SUBSTRING(sikd_rek_jenis.`kd_rek_jenis`,3,1),".",
                            SUBSTRING(sikd_rek_obj.`kd_rek_obj`,4,2),".",
                            SUBSTRING(sikd_rek_rincian_obj.`kd_rek_rincian_obj`,6,2)) AS sikd_rek_rincian_obj_kd_rek_rincian_obj,
                        sikd_rek_rincian_obj.`nm_rek_rincian_obj` AS sikd_rek_rincian_obj_nm_rek_rincian_obj,
                        CONCAT_WS('-',
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 1, 8),
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 9, 4),
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 13, 4),
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 17, 4),
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 21)
                            ) AS sikd_satker_id_sikd_satker,
                        IFNULL(sikd_sub_skpd.`kode`, sikd_satker.`kode`) AS sikd_satker_kode,
                        IFNULL(sikd_sub_skpd.`nama`, sikd_satker.`nama`) AS sikd_satker_nama,
                        SUM(rka_mata_anggaran.`jumlah`) AS rka_mata_anggaran_jumlah
                    FROM
                        `rka_rka` rka_rka INNER JOIN `rka_mata_anggaran` rka_mata_anggaran ON rka_rka.`id_rka_rka` = rka_mata_anggaran.`rka_rka_id`
                        LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON rka_rka.`sikd_sub_satker_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                        INNER JOIN `sikd_satker` sikd_satker ON rka_rka.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                        INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON rka_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                        INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                        INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                        INNER JOIN `sikd_rek_kelompok` sikd_rek_kelompok ON sikd_rek_jenis.`sikd_rek_kelompok_id` = sikd_rek_kelompok.`id_sikd_rek_kelompok`
                        INNER JOIN `sikd_rek_akun` sikd_rek_akun ON sikd_rek_kelompok.`sikd_rek_akun_id` = sikd_rek_akun.`id_sikd_rek_akun`
                    WHERE
                        sikd_rek_akun.`kd_rek_akun` IN ('4','5','6')
                        AND rka_rka.rka_perubahan = '0'
                    GROUP BY
                        sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`,
                        sikd_satker.`id_sikd_satker`, sikd_sub_skpd.`id_sikd_sub_skpd`
                    ORDER BY
                        sikd_rek_rincian_obj.`kd_rek_rincian_obj`,
                        sikd_satker.`kode`, sikd_sub_skpd.`kode`
                        ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("rapbd_rapbd_id", $idRapbd);
            $statement->execute();
            $rapbdRekapMakSatker = $statement->fetchAll();

            return new JsonResponse($rapbdRekapMakSatker);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getRapbdRekapRekRincianObj($request) {
        try {
            $idRapbd = $request->query->get("rapbd_rapbd_id");
            $tahun = $request->query->get("tahun");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRapbd = pack('H*', str_replace('-', '', trim($idRapbd)));
            $tahun = pack('H*', str_replace('-', '', trim($tahun)));
            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                        sikd_rek_akun.`kd_rek_akun` AS sikd_rek_akun_kd_rek_akun,
                        sikd_rek_akun.`nm_rek_akun` AS sikd_rek_akun_nm_rek_akun,
                        sikd_rek_kelompok.`kd_rek_kelompok` AS sikd_rek_kelompok_kd_rek_kelompok,
                        sikd_rek_kelompok.`nm_rek_kelompok` AS sikd_rek_kelompok_nm_rek_kelompok,
                        sikd_rek_jenis.`kd_rek_jenis` AS sikd_rek_jenis_kd_rek_jenis,
                        sikd_rek_jenis.`nm_rek_jenis` AS sikd_rek_jenis_nm_rek_jenis,
                        sikd_rek_obj.`kd_rek_obj` AS sikd_rek_obj_kd_rek_obj,
                        sikd_rek_obj.`nm_rek_obj` AS sikd_rek_obj_nm_rek_obj,
                        sikd_rek_rincian_obj.`kd_rek_rincian_obj` AS sikd_rek_rincian_obj_kd_rek_rincian_obj,
                        sikd_rek_rincian_obj.`nm_rek_rincian_obj` AS sikd_rek_rincian_obj_nm_rek_rincian_obj,
                        sum(ifnull(rka_mata_anggaran.`jumlah`,0)) AS rka_mata_anggaran_jumlah,
                        if(sikd_rek_akun.`kd_rek_akun` in ('4','5'), 'rek_45', 'rek_6') AS jns_rek,
                        sum(if(sikd_rek_akun.`kd_rek_akun`='4',rka_mata_anggaran.`jumlah`,0)) AS jml_pendapatan,
                        sum(if(sikd_rek_akun.`kd_rek_akun`='5',rka_mata_anggaran.`jumlah`,0)) AS jml_belanja,
                        sum(if(sikd_rek_kelompok.`kd_rek_kelompok`='61',rka_mata_anggaran.`jumlah`,0)) AS jml_penerimaan,
                        sum(if(sikd_rek_kelompok.`kd_rek_kelompok`='62',rka_mata_anggaran.`jumlah`,0)) AS jml_pengeluaran,
                        sum(if(sikd_rek_akun.`kd_rek_akun`='4',rka_mata_anggaran.`jumlah`,0)-if(sikd_rek_akun.`kd_rek_akun`='5',rka_mata_anggaran.`jumlah`,0)) AS jml_surplus,
                        sum(if(sikd_rek_kelompok.`kd_rek_kelompok`='61',rka_mata_anggaran.`jumlah`,0)-if(sikd_rek_kelompok.`kd_rek_kelompok`='62',rka_mata_anggaran.`jumlah`,0)) AS jml_pembiayaan
                    FROM
                       `rka_rka` rka_rka INNER JOIN `rka_mata_anggaran` rka_mata_anggaran ON rka_rka.`id_rka_rka` = rka_mata_anggaran.`rka_rka_id`
                        AND rka_rka.`rapbd_rapbd_id` = :idRapbd AND rka_rka.rka_perubahan = '0'
                        AND if(:statusRka = 'Final',(rka_rka.`status_rka` = 1),(rka_rka.`status_rka` = 0 OR rka_rka.`status_rka` = 2))
                        INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON rka_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                        INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                        INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                        INNER JOIN `sikd_rek_kelompok` sikd_rek_kelompok ON sikd_rek_jenis.`sikd_rek_kelompok_id` = sikd_rek_kelompok.`id_sikd_rek_kelompok`
                        INNER JOIN `sikd_rek_akun` sikd_rek_akun ON sikd_rek_kelompok.`sikd_rek_akun_id` = sikd_rek_akun.`id_sikd_rek_akun`
                        AND (sikd_rek_akun.`kd_rek_akun` IN ('4','5') OR sikd_rek_kelompok.`kd_rek_kelompok` IN ('61','62'))
                    GROUP BY
                        sikd_rek_akun.`kd_rek_akun`,
                        sikd_rek_akun.`nm_rek_akun`,
                        sikd_rek_kelompok.`kd_rek_kelompok`,
                        sikd_rek_kelompok.`nm_rek_kelompok`,
                        sikd_rek_jenis.`kd_rek_jenis`,
                        sikd_rek_jenis.`nm_rek_jenis`,
                        sikd_rek_obj.`kd_rek_obj`,
                        sikd_rek_obj.`nm_rek_obj`,
                        sikd_rek_rincian_obj.`kd_rek_rincian_obj`,
                        sikd_rek_rincian_obj.`nm_rek_rincian_obj`,
                        jns_rek
                    ORDER BY
                        sikd_rek_akun.`kd_rek_akun`,
                        sikd_rek_kelompok.`kd_rek_kelompok`,
                        sikd_rek_jenis.`kd_rek_jenis`,
                        sikd_rek_obj.`kd_rek_obj`,
                        sikd_rek_rincian_obj.`kd_rek_rincian_obj`
                    ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("rapbd_rapbd_id", $idRapbd);
            $statement->execute();
            $rapbdRekapRekRincianObj = $statement->fetchAll();

            return new JsonResponse($rapbdRekapRekRincianObj);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getRapbdRekapSatkerRekRincianObj($request) {
        try {
            $idRapbd = $request->query->get("rapbd_rapbd_id");
            $tahun = $request->query->get("tahun");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRapbd = pack('H*', str_replace('-', '', trim($idRapbd)));
            $tahun = pack('H*', str_replace('-', '', trim($tahun)));
            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                        CONCAT_WS('-',
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 1, 8),
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 9, 4),
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 13, 4),
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 17, 4),
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 21)
                            ) AS sikd_satker_id_sikd_satker,
                        sikd_satker.kode AS sikd_satker_kode,
                        sikd_satker.nama AS sikd_satker_nama,
                        sikd_rek_akun.`kd_rek_akun` AS sikd_rek_akun_kd_rek_akun,
                        sikd_rek_akun.`nm_rek_akun` AS sikd_rek_akun_nm_rek_akun,
                        sikd_rek_kelompok.`kd_rek_kelompok` AS sikd_rek_kelompok_kd_rek_kelompok,
                        sikd_rek_kelompok.`nm_rek_kelompok` AS sikd_rek_kelompok_nm_rek_kelompok,
                        sikd_rek_jenis.`kd_rek_jenis` AS sikd_rek_jenis_kd_rek_jenis,
                        sikd_rek_jenis.`nm_rek_jenis` AS sikd_rek_jenis_nm_rek_jenis,
                        sikd_rek_obj.`kd_rek_obj` AS sikd_rek_obj_kd_rek_obj,
                        sikd_rek_obj.`nm_rek_obj` AS sikd_rek_obj_nm_rek_obj,
                        sikd_rek_rincian_obj.`kd_rek_rincian_obj` AS sikd_rek_rincian_obj_kd_rek_rincian_obj,
                        sikd_rek_rincian_obj.`nm_rek_rincian_obj` AS sikd_rek_rincian_obj_nm_rek_rincian_obj,
                        sum(ifnull(rka_mata_anggaran.`jumlah`,0)) AS rka_mata_anggaran_jumlah,
                        if(sikd_rek_akun.`kd_rek_akun` in ('4','5'), 'rek_45', 'rek_6') AS jns_rek,
                        sum(if(sikd_rek_akun.`kd_rek_akun`='4',rka_mata_anggaran.`jumlah`,0)) AS jml_pendapatan,
                        sum(if(sikd_rek_akun.`kd_rek_akun`='5',rka_mata_anggaran.`jumlah`,0)) AS jml_belanja,
                        sum(if(sikd_rek_kelompok.`kd_rek_kelompok`='61',rka_mata_anggaran.`jumlah`,0)) AS jml_penerimaan,
                        sum(if(sikd_rek_kelompok.`kd_rek_kelompok`='62',rka_mata_anggaran.`jumlah`,0)) AS jml_pengeluaran,
                        sum(if(sikd_rek_akun.`kd_rek_akun`='4',rka_mata_anggaran.`jumlah`,0)-if(sikd_rek_akun.`kd_rek_akun`='5',rka_mata_anggaran.`jumlah`,0)) AS jml_surplus,	sum(if(sikd_rek_kelompok.`kd_rek_kelompok`='61',rka_mata_anggaran.`jumlah`,0)-if(sikd_rek_kelompok.`kd_rek_kelompok`='62',rka_mata_anggaran.`jumlah`,0)) AS jml_pembiayaan
                    FROM
                        `rka_rka` rka_rka INNER JOIN `rka_mata_anggaran` rka_mata_anggaran ON rka_rka.`id_rka_rka` = rka_mata_anggaran.`rka_rka_id`
                        INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON rka_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                        INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                        INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                        INNER JOIN `sikd_rek_kelompok` sikd_rek_kelompok ON sikd_rek_jenis.`sikd_rek_kelompok_id` = sikd_rek_kelompok.`id_sikd_rek_kelompok`
                        INNER JOIN `sikd_rek_akun` sikd_rek_akun ON sikd_rek_kelompok.`sikd_rek_akun_id` = sikd_rek_akun.`id_sikd_rek_akun`
                        AND (sikd_rek_akun.`kd_rek_akun` IN ('4','5') OR sikd_rek_kelompok.`kd_rek_kelompok` IN ('61','62'))
                        INNER JOIN `sikd_satker` sikd_satker ON sikd_satker.id_sikd_satker = rka_rka.sikd_satker_id
                    WHERE
                        rka_rka.rapbd_rapbd_id = :idRapbd
                        AND rka_rka.rka_perubahan = '0'
                        AND if(:statusRka = 'Final',(rka_rka.`status_rka` = 1),(rka_rka.`status_rka` = 0 OR rka_rka.`status_rka` = 2))
                        AND if(:idSkpd != '', rka_rka.`sikd_satker_id` = :idSkpd, rka_rka.`sikd_satker_id` = '')
                        AND if(:idSubSkpd != '', rka_rka.`sikd_sub_satker_id` = :idSubSkpd, rka_rka.`sikd_sub_satker_id` = '')
                    GROUP BY
                        sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`,
                        jns_rek
                    ORDER BY
                        sikd_rek_rincian_obj.`kd_rek_rincian_obj`
                        ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("rapbd_rapbd_id", $idRapbd);
            $statement->execute();
            $rapbdRekapSatkerRekRincianObj = $statement->fetchAll();

            return new JsonResponse($rapbdRekapSatkerRekRincianObj);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getRapbdRekapSatkerRincianObj($request) {
        try {
            $idRapbd = $request->query->get("rapbd_rapbd_id");
            $tahun = $request->query->get("tahun");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRapbd = pack('H*', str_replace('-', '', trim($idRapbd)));
            $tahun = pack('H*', str_replace('-', '', trim($tahun)));
            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                        CONCAT_WS('-',
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 1, 8),
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 9, 4),
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 13, 4),
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 17, 4),
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 21)
                            ) AS sikd_satker_id_sikd_satker,
                        sikd_satker.kode AS sikd_satker_kode,
                        sikd_satker.nama AS sikd_satker_nama,
                        sikd_rek_akun.`kd_rek_akun` AS sikd_rek_akun_kd_rek_akun,
                        sikd_rek_akun.`nm_rek_akun` AS sikd_rek_akun_nm_rek_akun,
                        sikd_rek_kelompok.`kd_rek_kelompok` AS sikd_rek_kelompok_kd_rek_kelompok,
                        sikd_rek_kelompok.`nm_rek_kelompok` AS sikd_rek_kelompok_nm_rek_kelompok,
                        sikd_rek_jenis.`kd_rek_jenis` AS sikd_rek_jenis_kd_rek_jenis,
                        sikd_rek_jenis.`nm_rek_jenis` AS sikd_rek_jenis_nm_rek_jenis,
                        sikd_rek_obj.`kd_rek_obj` AS sikd_rek_obj_kd_rek_obj,
                        sikd_rek_obj.`nm_rek_obj` AS sikd_rek_obj_nm_rek_obj,
                        sikd_rek_rincian_obj.`kd_rek_rincian_obj` AS sikd_rek_rincian_obj_kd_rek_rincian_obj,
                        sikd_rek_rincian_obj.`nm_rek_rincian_obj` AS sikd_rek_rincian_obj_nm_rek_rincian_obj,
                        sum(ifnull(rka_mata_anggaran.`jumlah`,0)) AS rka_mata_anggaran_jumlah,
                        if(sikd_rek_akun.`kd_rek_akun` in ('4','5'), 'rek_45', 'rek_6') AS jns_rek,
                        sum(if(sikd_rek_akun.`kd_rek_akun`='4',rka_mata_anggaran.`jumlah`,0)) AS jml_pendapatan,
                        sum(if(sikd_rek_akun.`kd_rek_akun`='5',rka_mata_anggaran.`jumlah`,0)) AS jml_belanja,
                        sum(if(sikd_rek_kelompok.`kd_rek_kelompok`='61',rka_mata_anggaran.`jumlah`,0)) AS jml_penerimaan,
                        sum(if(sikd_rek_kelompok.`kd_rek_kelompok`='62',rka_mata_anggaran.`jumlah`,0)) AS jml_pengeluaran,
                        sum(if(sikd_rek_akun.`kd_rek_akun`='4',rka_mata_anggaran.`jumlah`,0)-if(sikd_rek_akun.`kd_rek_akun`='5',rka_mata_anggaran.`jumlah`,0)) AS jml_surplus,	sum(if(sikd_rek_kelompok.`kd_rek_kelompok`='61',rka_mata_anggaran.`jumlah`,0)-if(sikd_rek_kelompok.`kd_rek_kelompok`='62',rka_mata_anggaran.`jumlah`,0)) AS jml_pembiayaan
                    FROM
                        `rka_rka` rka_rka INNER JOIN `rka_mata_anggaran` rka_mata_anggaran ON rka_rka.`id_rka_rka` = rka_mata_anggaran.`rka_rka_id`
                        INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON rka_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                        INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                        INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                        INNER JOIN `sikd_rek_kelompok` sikd_rek_kelompok ON sikd_rek_jenis.`sikd_rek_kelompok_id` = sikd_rek_kelompok.`id_sikd_rek_kelompok`
                        INNER JOIN `sikd_rek_akun` sikd_rek_akun ON sikd_rek_kelompok.`sikd_rek_akun_id` = sikd_rek_akun.`id_sikd_rek_akun`
                        AND (sikd_rek_akun.`kd_rek_akun` IN ('4','5') OR sikd_rek_kelompok.`kd_rek_kelompok` IN ('61','62'))
                        INNER JOIN `sikd_satker` sikd_satker ON sikd_satker.id_sikd_satker = rka_rka.sikd_satker_id
                    WHERE
                        rka_rka.rapbd_rapbd_id = :idRapbd
                        AND rka_rka.rka_perubahan = '0'
                        AND if(:statusRka = 'Final',(rka_rka.`status_rka` = 1),(rka_rka.`status_rka` = 0 OR rka_rka.`status_rka` = 2))
                        AND if(:idSkpd != '', rka_rka.`sikd_satker_id` = :idSkpd, 1)
                        AND if(:idSubSkpd != '', rka_rka.`sikd_sub_satker_id` = :idSubSkpd, rka_rka.`sikd_sub_satker_id` = '')
                    GROUP BY
                        sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`,
                        jns_rek
                    ORDER BY
                        sikd_rek_rincian_obj.`kd_rek_rincian_obj`
                        ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("rapbd_rapbd_id", $idRapbd);
            $statement->execute();
            $rapbdRekapSatkerRincianObj = $statement->fetchAll();

            return new JsonResponse($rapbdRekapSatkerRincianObj);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getRapbdRekapSatker($request) {
        try {
            $idRapbd = $request->query->get("id_rka_rka");
            $tahun = $request->query->get("tahun");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRapbd = pack('H*', str_replace('-', '', trim($idRapbd)));
            $tahun = pack('H*', str_replace('-', '', trim($tahun)));
            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                        IFNULL(sikd_sub_skpd.`id_sikd_sub_skpd`, sikd_satker.`id_sikd_satker`) AS sikd_satker_id_sikd_satker,
                        IFNULL(sikd_sub_skpd.`kode`, sikd_satker.`kode`) AS sikd_satker_kode,
                        IFNULL(sikd_sub_skpd.`nama`, sikd_satker.`nama`) AS sikd_satker_nama,
                        CONCAT_WS('-',
                            SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 1, 8),
                            SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 9, 4),
                            SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 13, 4),
                            SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 17, 4),
                            SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 21)
                            ) AS sikd_sub_skpd_id_sikd_sub_skpd,
                        sikd_sub_skpd.`kode` AS sikd_sub_skpd_kode,
                        sikd_sub_skpd.`nama` AS sikd_sub_skpd_nama,
                        rka_rka.`status_rka` AS rka_rka_status_rka, 
                        SUM(IF(SUBSTR(rka_mata_anggaran.`kd_rekening`,1,1)='4',rka_mata_anggaran.`jumlah`,0)) AS jml_pendapatan,
                        SUM(IF(SUBSTR(rka_mata_anggaran.`kd_rekening`,1,2)='51',rka_mata_anggaran.`jumlah`,0)) AS jml_blnj_tdk_langsung,
                        SUM(IF(SUBSTR(rka_mata_anggaran.`kd_rekening`,1,2)='52',rka_mata_anggaran.`jumlah`,0)) AS jml_blnj_langsung,
                        SUM(IF(SUBSTR(rka_mata_anggaran.`kd_rekening`,1,1)='4',1,
                            IF(SUBSTR(rka_mata_anggaran.`kd_rekening`,1,1)='5',-1,0))*rka_mata_anggaran.`jumlah`) AS jml_pdpt_blnj
                    FROM
                       `rka_rka` rka_rka INNER JOIN `rka_mata_anggaran` rka_mata_anggaran ON rka_rka.`id_rka_rka` = rka_mata_anggaran.`rka_rka_id`
                        AND rka_rka.rka_perubahan = '0'
                        AND if(:statusRka = 'Final',rka_rka.`status_rka` = '1',1)
                        LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON rka_rka.`sikd_sub_satker_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                        INNER JOIN `sikd_satker` sikd_satker ON rka_rka.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                    GROUP BY
                        sikd_satker_kode,
                        sikd_satker_id_sikd_satker
                    ORDER BY
                        sikd_satker_kode,
                        sikd_satker_id_sikd_satker
                    ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rka_rka", $idRapbd);
            $statement->execute();
            $rapbdRekapSatker = $statement->fetchAll();

            return new JsonResponse($rapbdRekapSatker);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getRapbdRekapStatusRka($request) {
        try {
            $idRapbd = $request->query->get("rapbd_rapbd_id");
            $tahun = $request->query->get("tahun");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRapbd = pack('H*', str_replace('-', '', trim($idRapbd)));
            $tahun = pack('H*', str_replace('-', '', trim($tahun)));
            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                        CONCAT_WS('-',
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 1, 8),
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 9, 4),
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 13, 4),
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 17, 4),
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 21)
                            ) AS sikd_satker_id_sikd_satker,
                        sikd_satker.`kode` AS sikd_satker_kode,
                        sikd_satker.`nama` AS sikd_satker_nama,
                        sikd_sub_skpd.`kode` AS sikd_sub_skpd_kode,
                        sikd_sub_skpd.`nama` AS sikd_sub_skpd_nama,
                        if(:jnsTrx='4', 'PENDAPATAN',
                           if(:jnsTrx='51', 'BELANJA TIDAK LANGSUNG',
                           if(:jnsTrx='52', 'BELANJA LANGSUNG',
                           if(:jnsTrx='61', 'PENERIMAAN', 'PENGELUARAN')))) AS jns_rka,
                        count(distinct if(rka_rka.`status_rka`='0',rka_rka.no_rka,null)) AS jml_rka_dlm_proses,
                        count(distinct if(rka_rka.`status_rka`='1',rka_rka.no_rka,null)) AS jml_rka_disetujui,
                        count(distinct if(rka_rka.`status_rka`='2',rka_rka.no_rka,null)) AS jml_rka_ditolak,
                        sum(if(rka_rka.`status_rka`='0', rka_mata_anggaran.`jumlah`,0)) AS jml_anggaran_rka_proses,
                        sum(if(rka_rka.`status_rka`='1', rka_mata_anggaran.`jumlah`,0)) AS jml_anggaran_rka_disetujui,
                        sum(if(rka_rka.`status_rka`='2', rka_mata_anggaran.`jumlah`,0)) AS jml_anggaran_rka_ditolak
                    FROM
                        `rka_rka` rka_rka INNER JOIN `rka_mata_anggaran` rka_mata_anggaran ON rka_rka.`id_rka_rka` = rka_mata_anggaran.`rka_rka_id`
                        INNER JOIN `vw_rka_skpd_skpkd_all` vw_rka_skpd_skpkd ON rka_rka.`id_rka_rka` = vw_rka_skpd_skpkd.`rka_rka_id`
                        INNER JOIN `sikd_satker` sikd_satker ON vw_rka_skpd_skpkd.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                        LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON vw_rka_skpd_skpkd.`sikd_sub_satker_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                    WHERE
                        rka_rka.rapbd_rapbd_id = :idRapbd
                        AND rka_rka.rka_perubahan = '0'
                        AND rka_mata_anggaran.kd_rekening like concat(:jnsTrx,'%')
                    GROUP BY
                        sikd_satker.`id_sikd_satker`, sikd_sub_skpd.`kode`
                    ORDER BY
                        sikd_satker.`kode`, sikd_satker.`id_sikd_satker`
                        ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("rapbd_rapbd_id", $idRapbd);
            $statement->execute();
            $rapbdRekapStatusRka = $statement->fetchAll();

            return new JsonResponse($rapbdRekapStatusRka);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getRapbdRekapUrusan($request) {
        try {
            $idRapbd = $request->query->get("id_rka_rka");
            $tahun = $request->query->get("tahun");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRapbd = pack('H*', str_replace('-', '', trim($idRapbd)));
            $tahun = pack('H*', str_replace('-', '', trim($tahun)));
            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                        sikd_urusan.`kd_urusan` AS sikd_urusan_kd_urusan,
                        sikd_urusan.`nm_urusan` AS sikd_urusan_nm_urusan,
                        sikd_bidang.`nm_bidang` AS sikd_bidang_nm_bidang,
                        substring(sikd_bidang.`kd_bidang`,2,2)AS kd_bidang_,
                        sikd_bidang.`kd_bidang` AS kd_bidang,
                        sum(if(substring(rka_mata_anggaran.`kd_rekening`,1,1)='5',rka_mata_anggaran.`jumlah`,0))AS jml_belanja
                    FROM
                       `rka_rka` rka_rka INNER JOIN `vw_rka_skpd_skpkd_all` rka_skpd ON rka_rka.`id_rka_rka` = rka_skpd.`rka_rka_id`
                        AND rka_rka.`rapbd_rapbd_id` = :idRapbd 
                        AND rka_rka.rka_perubahan = '0'
                        AND if(:statusRka = 'Final',(rka_rka.`status_rka` = 1),(rka_rka.`status_rka` = 0 OR rka_rka.`status_rka` = 2))
                        INNER JOIN `sikd_satker` sikd_satker ON rka_skpd.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                        INNER JOIN `rka_mata_anggaran` rka_mata_anggaran ON rka_skpd.`rka_rka_id` = rka_mata_anggaran.`rka_rka_id`
                        INNER JOIN `sikd_bidang` sikd_bidang ON sikd_bidang.`id_sikd_bidang` = rka_skpd.`sikd_bidang_id`
                        INNER JOIN `sikd_urusan` sikd_urusan ON sikd_bidang.`sikd_urusan_id` = sikd_urusan.`id_sikd_urusan`
                    GROUP BY
                        sikd_urusan.`kd_urusan`,
                        sikd_bidang.`kd_bidang`
                    ORDER BY
                        sikd_urusan.`kd_urusan` ASC,
                        sikd_bidang.`kd_bidang` ASC
                    ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rka_rka", $idRapbd);
            $statement->execute();
            $rapbdRekapUrusan = $statement->fetchAll();

            return new JsonResponse($rapbdRekapUrusan);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getRapbdRincSkpdKgtn($request) {
        try {
            $idRapbd = $request->query->get("rapbd_rapbd_id");
            $tahun = $request->query->get("tahun");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRapbd = pack('H*', str_replace('-', '', trim($idRapbd)));
            $tahun = pack('H*', str_replace('-', '', trim($tahun)));
            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                        CONCAT_WS('-',
                            SUBSTR(HEX(rka_rka.`rapbd_rapbd_id`), 1, 8),
                            SUBSTR(HEX(rka_rka.`rapbd_rapbd_id`), 9, 4),
                            SUBSTR(HEX(rka_rka.`rapbd_rapbd_id`), 13, 4),
                            SUBSTR(HEX(rka_rka.`rapbd_rapbd_id`), 17, 4),
                            SUBSTR(HEX(rka_rka.`rapbd_rapbd_id`), 21)
                            ) AS rapbd_rapbd_id,
                        sikd_bidang.`kd_bidang` AS sikd_bidang_kd_bidang,
                        sikd_bidang.`nm_bidang` AS sikd_bidang_nm_bidang,
                        CONCAT_WS('-',
                            SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 1, 8),
                            SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 9, 4),
                            SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 13, 4),
                            SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 17, 4),
                            SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 21)
                            ) AS sikd_bidang_id_sikd_bidang,
                        CONCAT_WS('-',
                            SUBSTR(HEX(sikd_rek_akun.`id_sikd_rek_akun`), 1, 8),
                            SUBSTR(HEX(sikd_rek_akun.`id_sikd_rek_akun`), 9, 4),
                            SUBSTR(HEX(sikd_rek_akun.`id_sikd_rek_akun`), 13, 4),
                            SUBSTR(HEX(sikd_rek_akun.`id_sikd_rek_akun`), 17, 4),
                            SUBSTR(HEX(sikd_rek_akun.`id_sikd_rek_akun`), 21)
                            ) AS sikd_rek_akun_id_sikd_rek_akun,
                        sikd_rek_akun.`kd_rek_akun` AS sikd_rek_akun_kd_rek_akun,
                        sikd_rek_akun.`nm_rek_akun` AS sikd_rek_akun_nm_rek_akun,
                        CONCAT_WS('-',
                             SUBSTR(HEX(sikd_rek_kelompok.`id_sikd_rek_kelompok`), 1, 8),
                             SUBSTR(HEX(sikd_rek_kelompok.`id_sikd_rek_kelompok`), 9, 4),
                             SUBSTR(HEX(sikd_rek_kelompok.`id_sikd_rek_kelompok`), 13, 4),
                             SUBSTR(HEX(sikd_rek_kelompok.`id_sikd_rek_kelompok`), 17, 4),
                             SUBSTR(HEX(sikd_rek_kelompok.`id_sikd_rek_kelompok`), 21)
                             ) AS sikd_rek_kelompok_id_sikd_rek_kelompok,
                        sikd_rek_kelompok.`kd_rek_kelompok` AS sikd_rek_kelompok_kd_rek_kelompok,
                        sikd_rek_kelompok.`nm_rek_kelompok` AS sikd_rek_kelompok_nm_rek_kelompok,
                        sikd_rek_kelompok.`dasar_hukum` AS sikd_rek_kelompok_dasar_hukum,
                        CONCAT_WS('-',
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 1, 8),
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 9, 4),
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 13, 4),
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 17, 4),
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 21)
                            ) AS sikd_rek_jenis_id_sikd_rek_jenis,
                        sikd_rek_jenis.`kd_rek_jenis` AS sikd_rek_jenis_kd_rek_jenis,
                        sikd_rek_jenis.`nm_rek_jenis` AS sikd_rek_jenis_nm_rek_jenis,
                        sikd_rek_jenis.`dasar_hukum` AS sikd_rek_jenis_dasar_hukum,
                        CONCAT_WS('-',
                            SUBSTR(HEX(sikd_prog.`id_sikd_prog`), 1, 8),
                            SUBSTR(HEX(sikd_prog.`id_sikd_prog`), 9, 4),
                            SUBSTR(HEX(sikd_prog.`id_sikd_prog`), 13, 4),
                            SUBSTR(HEX(sikd_prog.`id_sikd_prog`), 17, 4),
                            SUBSTR(HEX(sikd_prog.`id_sikd_prog`), 21)
                            ) AS sikd_prog_id_sikd_prog,
                        sikd_prog.`kd_prog` AS sikd_prog_kd_prog,
                        sikd_prog.`nm_prog` AS sikd_prog_nm_prog,
                        CONCAT_WS('-',
                            SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 1, 8),
                            SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 9, 4),
                            SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 13, 4),
                            SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 17, 4),
                            SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 21)
                            ) AS sikd_kgtn_id_sikd_kgtn,
                        sikd_kgtn.`kd_kgtn` AS sikd_kgtn_kd_kgtn,
                        sikd_kgtn.`nm_kgtn` AS sikd_kgtn_nm_kgtn,
                        sikd_satker.`kode` AS sikd_satker_kode,
                        sikd_satker.`nama` AS sikd_satker_nama,
                        sum(rka_mata_anggaran.`jumlah`) AS rka_mata_anggaran_jumlah
                    FROM
                        `rka_rka` rka_rka INNER JOIN `vw_rka_skpd_skpkd_all` rka_skpd ON rka_rka.`id_rka_rka` = rka_skpd.`rka_rka_id`
                        INNER JOIN `rka_mata_anggaran` rka_mata_anggaran ON rka_skpd.`rka_rka_id` = rka_mata_anggaran.`rka_rka_id`
                        INNER JOIN `sikd_bidang` sikd_bidang ON rka_skpd.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                        INNER JOIN `sikd_satker` sikd_satker ON rka_skpd.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                        LEFT OUTER JOIN `rka_skpd_kgtn` rka_skpd_kgtn ON rka_mata_anggaran.`rka_rka_id` = rka_skpd_kgtn.`id_rka_skpd_kgtn`
                        INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON rka_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                        INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                        INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                        INNER JOIN `sikd_rek_kelompok` sikd_rek_kelompok ON sikd_rek_jenis.`sikd_rek_kelompok_id` = sikd_rek_kelompok.`id_sikd_rek_kelompok`
                        INNER JOIN `sikd_rek_akun` sikd_rek_akun ON sikd_rek_kelompok.`sikd_rek_akun_id` = sikd_rek_akun.`id_sikd_rek_akun`
                        AND sikd_rek_akun.`kd_rek_akun` in ('4','5')
                        LEFT OUTER JOIN `sikd_kgtn` sikd_kgtn ON rka_skpd_kgtn.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                        LEFT OUTER JOIN `sikd_prog` sikd_prog ON sikd_kgtn.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                    WHERE
                        rka_rka.rapbd_rapbd_id = :idRapbd
                        AND rka_rka.rka_perubahan = '0'
                        AND if(:statusRka = 'Final',(rka_rka.`status_rka` = 1),(rka_rka.`status_rka` = 0 OR rka_rka.`status_rka` = 2))
                        AND if(:idSkpd != '', rka_skpd.`sikd_satker_id` = :idSkpd, rka_skpd.`sikd_satker_id` = '')
                        AND if(:idSubSkpd != '', rka_skpd.`sikd_sub_satker_id` = :idSubSkpd, rka_skpd.`sikd_sub_satker_id` = '')
                    GROUP BY
                        rka_rka.`rapbd_rapbd_id`,
                        sikd_bidang.`id_sikd_bidang`,
                        sikd_rek_jenis.`id_sikd_rek_jenis`,
                        sikd_prog.`id_sikd_prog`,
                        sikd_kgtn.`id_sikd_kgtn`
                    ORDER BY
                        sikd_rek_akun.`kd_rek_akun` ASC,
                        sikd_rek_kelompok.`kd_rek_kelompok` ASC,
                        sikd_bidang.`kd_bidang` ASC,
                        sikd_prog.`kd_prog` ASC,
                        sikd_kgtn.`kd_kgtn` ASC,
                        sikd_rek_jenis.`kd_rek_jenis` ASC
                        ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("rapbd_rapbd_id", $idRapbd);
            $statement->execute();
            $rapbdRincSkpdKgtn = $statement->fetchAll();

            return new JsonResponse($rapbdRincSkpdKgtn);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getRapbdDasarHukumRekJenis($request) {
        try {
            $idRekJenis = $request->query->get("id_sikd_rek_jenis");
            $tahun = $request->query->get("tahun");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRekJenis = pack('H*', str_replace('-', '', trim($idRekJenis)));
            $tahun = pack('H*', str_replace('-', '', trim($tahun)));
            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                        CONCAT_WS('-',
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 1, 8),
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 9, 4),
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 13, 4),
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 17, 4),
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 21)
                            ) AS sikd_rek_jenis_id_sikd_rek_jenis,
                        IFNULL(IF(TRIM(sikd_rek_rincian_obj.`dasar_hukum`) != '', GROUP_CONCAT(distinct sikd_rek_rincian_obj.`dasar_hukum` ORDER BY sikd_rek_rincian_obj.`dasar_hukum` SEPARATOR '; '),
                            IF(TRIM(sikd_rek_obj.`dasar_hukum`) != '', GROUP_CONCAT(distinct sikd_rek_obj.`dasar_hukum` ORDER BY sikd_rek_obj.`dasar_hukum` SEPARATOR '; '),
                               GROUP_CONCAT(distinct TRIM(sikd_rek_jenis.`dasar_hukum`) ORDER BY sikd_rek_jenis.`dasar_hukum` SEPARATOR '; '))), '') AS dasar_hukum
                    FROM
                        `sikd_rek_obj` sikd_rek_obj INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                        INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON sikd_rek_obj.`id_sikd_rek_obj` = sikd_rek_rincian_obj.`sikd_rek_obj_id`
                        INNER JOIN `rka_mata_anggaran` dpa_mata_anggaran ON sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj` = dpa_mata_anggaran.`sikd_rek_rincian_obj_id`
                        INNER JOIN `rka_rka` rka_rka ON dpa_mata_anggaran.`rka_rka_id` = rka_rka.`id_rka_rka`
                    WHERE
                        sikd_rek_jenis.`id_sikd_rek_jenis` = :idRekJenis
                        AND rka_rka.sikd_satker_id = :idSkpd
                        AND if(:idSubSkpd is null, 1, rka_rka.`sikd_sub_satker_id` = :idSubSkpd)
                        AND (TRIM(sikd_rek_rincian_obj.`dasar_hukum`) != '' 
                        OR TRIM(sikd_rek_obj.`dasar_hukum`) != ''
                        OR TRIM(sikd_rek_jenis.`dasar_hukum`) != '')
                    GROUP BY
                        sikd_rek_jenis.`id_sikd_rek_jenis`
                    ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_sikd_rek_jenis", $idRekJenis);
            $statement->execute();
            $rapbdDasarHukumRekJenis = $statement->fetchAll();

            return new JsonResponse($rapbdDasarHukumRekJenis);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getRapbdFooterRingkasan($request) {
        try {
            $idRapbd = $request->query->get("rapbd_rapbd_id");
            $tahun = $request->query->get("tahun");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRapbd = pack('H*', str_replace('-', '', trim($idRapbd)));
            $tahun = pack('H*', str_replace('-', '', trim($tahun)));
            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                        IF(sikd_rek_akun.`kd_rek_akun`='4', sikd_rek_akun.`id_sikd_rek_akun`, sikd_rek_kelompok.`id_sikd_rek_kelompok`) AS sikd_rek_kelompok_id_sikd_rek_kelompok,
                        IF(sikd_rek_akun.`kd_rek_akun`='4', sikd_rek_akun.`kd_rek_akun`, sikd_rek_kelompok.`kd_rek_kelompok`) AS sikd_rek_kelompok_kd_rek_kelompok,
                        IF(sikd_rek_akun.`kd_rek_akun`='4', sikd_rek_akun.`nm_rek_akun`, sikd_rek_kelompok.`nm_rek_kelompok`) AS sikd_rek_kelompok_nm_rek_kelompok,
                        SUM(rka_mata_anggaran.`jumlah`) AS jumlah
                    FROM
                        `rka_rka` rka_rka INNER JOIN `vw_rka_skpd_skpkd_all` rka_skpd ON rka_rka.`id_rka_rka` = rka_skpd.`rka_rka_id`
                        INNER JOIN `rka_mata_anggaran` rka_mata_anggaran ON rka_skpd.`rka_rka_id` = rka_mata_anggaran.`rka_rka_id`
                        INNER JOIN `sikd_bidang` sikd_bidang ON rka_skpd.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                        INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON rka_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                        INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                        INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                        INNER JOIN `sikd_rek_kelompok` sikd_rek_kelompok ON sikd_rek_jenis.`sikd_rek_kelompok_id` = sikd_rek_kelompok.`id_sikd_rek_kelompok`
                        INNER JOIN `sikd_rek_akun` sikd_rek_akun ON sikd_rek_kelompok.`sikd_rek_akun_id` = sikd_rek_akun.`id_sikd_rek_akun`
                    WHERE
                        rka_rka.rapbd_rapbd_id = :idRapbd
                        AND rka_rka.rka_perubahan = '0'
                        AND if(:satkerType = 'SikdSkpd', rka_skpd.sikd_satker_id = :idSkpd, rka_skpd.sikd_satker_id in (:idSkpd,:idSkpd))
                        AND if(:statusRka = 'Final',(rka_rka.`status_rka` = 1),(rka_rka.`status_rka` = 0 OR rka_rka.`status_rka` = 2))
                        AND rka_skpd.`sikd_sub_satker_id` like :idSubSkpd
                        AND rka_mata_anggaran.jumlah > 0
                    GROUP BY
                        IF(sikd_rek_akun.`kd_rek_akun`='4', sikd_rek_akun.`id_sikd_rek_akun`, sikd_rek_kelompok.`id_sikd_rek_kelompok`)
                    ORDER BY
                        IF(sikd_rek_akun.`kd_rek_akun`='4', sikd_rek_akun.`kd_rek_akun`, sikd_rek_kelompok.`kd_rek_kelompok`)    
                    ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("rapbd_rapbd_id", $idRapbd);
            $statement->execute();
            $rapbdFooterRingkasan = $statement->fetchAll();

            return new JsonResponse($rapbdFooterRingkasan);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
     private function getRapbdSinkronisasiProgram($request) {
        try {
            $idRapbd = $request->query->get("id_rka_rka");
            $tahun = $request->query->get("tahun");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRapbd = pack('H*', str_replace('-', '', trim($idRapbd)));
            $tahun = pack('H*', str_replace('-', '', trim($tahun)));
            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                        CONCAT_WS('-',
                            SUBSTR(HEX(rpjmd_prog_prioritas.`id_rpjmd_prog_prioritas`), 1, 8),
                            SUBSTR(HEX(rpjmd_prog_prioritas.`id_rpjmd_prog_prioritas`), 9, 4),
                            SUBSTR(HEX(rpjmd_prog_prioritas.`id_rpjmd_prog_prioritas`), 13, 4),
                            SUBSTR(HEX(rpjmd_prog_prioritas.`id_rpjmd_prog_prioritas`), 17, 4),
                            SUBSTR(HEX(rpjmd_prog_prioritas.`id_rpjmd_prog_prioritas`), 21)
                            ) AS rpjmd_prog_prioritas_id_rpjmd_prog_prioritas,
                        rpjmd_prog_prioritas.`no_prioritas` AS rpjmd_prog_prioritas_no_prioritas,
                        rpjmd_prog_prioritas.`tag_prioritas` AS rpjmd_prog_prioritas_tag_prioritas,
                        rpjmd_prog_prioritas.`nm_program` AS rpjmd_prog_prioritas_nm_program,
                        rpjmd_prog_prioritas.`tema_program` AS rpjmd_prog_prioritas_tema_program,
                        SUM(IFNULL(rka_mata_anggaran.`jumlah`,0)) AS rka_mata_anggaran_jumlah_bl,
                        0 AS rka_mata_anggaran_jumlah_btl
                    FROM
                       `rpjmd_prog_prioritas` rpjmd_prog_prioritas
                        LEFT OUTER JOIN `rpjmd_prog_prioritas_kgtn` rpjmd_prog_prioritas_kgtn ON rpjmd_prog_prioritas_kgtn.`rpjmd_prog_prioritas_id` = rpjmd_prog_prioritas.`id_rpjmd_prog_prioritas`
                        LEFT OUTER JOIN `rka_skpd_kgtn` rka_skpd_kgtn ON rpjmd_prog_prioritas_kgtn.`sikd_kgtn_id` = rka_skpd_kgtn.`sikd_kgtn_id`
                        LEFT OUTER JOIN `rka_rka` rka_rka ON rka_rka.`id_rka_rka` = rka_skpd_kgtn.`id_rka_skpd_kgtn`
                        AND rka_rka.rka_perubahan = '0'
                        LEFT OUTER JOIN `rka_mata_anggaran` rka_mata_anggaran ON rka_rka.`id_rka_rka` = rka_mata_anggaran.`rka_rka_id`
                    GROUP BY
                        rpjmd_prog_prioritas.`id_rpjmd_prog_prioritas`,
                        rpjmd_prog_prioritas.`id_rpjmd_prog_prioritas`,
                        rpjmd_prog_prioritas.`no_prioritas`,
                        rpjmd_prog_prioritas.`tag_prioritas`,
                        rpjmd_prog_prioritas.`nm_program`,
                        rpjmd_prog_prioritas.`tema_program`
                    UNION
                    SELECT
                        CONCAT_WS('-',
                            SUBSTR(HEX(rpjmd_prog_prioritas.`id_rpjmd_prog_prioritas`), 1, 8),
                            SUBSTR(HEX(rpjmd_prog_prioritas.`id_rpjmd_prog_prioritas`), 9, 4),
                            SUBSTR(HEX(rpjmd_prog_prioritas.`id_rpjmd_prog_prioritas`), 13, 4),
                            SUBSTR(HEX(rpjmd_prog_prioritas.`id_rpjmd_prog_prioritas`), 17, 4),
                            SUBSTR(HEX(rpjmd_prog_prioritas.`id_rpjmd_prog_prioritas`), 21)
                            ) AS rpjmd_prog_prioritas_id_rpjmd_prog_prioritas,
                        rpjmd_prog_prioritas.`no_prioritas` AS rpjmd_prog_prioritas_no_prioritas,
                        rpjmd_prog_prioritas.`tag_prioritas` AS rpjmd_prog_prioritas_tag_prioritas,
                        rpjmd_prog_prioritas.`nm_program` AS rpjmd_prog_prioritas_nm_program,
                        rpjmd_prog_prioritas.`tema_program` AS rpjmd_prog_prioritas_tema_program,
                        0 AS rka_mata_anggaran_jumlah_bl,
                        SUM(IFNULL(rka_mata_anggaran.`jumlah`,0)) AS rka_mata_anggaran_jumlah_btl
                    FROM
                        `rpjmd_prog_prioritas` rpjmd_prog_prioritas
                        LEFT OUTER JOIN `rpjmd_prog_prioritas_btl` rpjmd_prog_prioritas_btl ON rpjmd_prog_prioritas.`id_rpjmd_prog_prioritas` = rpjmd_prog_prioritas_btl.`rpjmd_prog_prioritas_id`
                        LEFT OUTER JOIN `rka_mata_anggaran` rka_mata_anggaran ON rpjmd_prog_prioritas_btl.`sikd_rek_rincian_obj_id` = rka_mata_anggaran.`sikd_rek_rincian_obj_id`
                        LEFT OUTER JOIN `rka_rka` rka_rka ON rka_rka.`id_rka_rka` = rka_mata_anggaran.`rka_rka_id`
                        AND rka_rka.rka_perubahan = '0'
                    WHERE
                        rka_rka.`id_rka_rka` IS NOT NULL
                    GROUP BY
                        rpjmd_prog_prioritas.`id_rpjmd_prog_prioritas`,
                        rpjmd_prog_prioritas.`id_rpjmd_prog_prioritas`,
                        rpjmd_prog_prioritas.`no_prioritas`,
                        rpjmd_prog_prioritas.`tag_prioritas`,
                        rpjmd_prog_prioritas.`nm_program`,
                        rpjmd_prog_prioritas.`tema_program`
                    ORDER BY
                        rpjmd_prog_prioritas_no_prioritas
                    ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rka_rka", $idRapbd);
            $statement->execute();
            $rapbdSinkronisasiProgram = $statement->fetchAll();

            return new JsonResponse($rapbdSinkronisasiProgram);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getRapbdLampPerda01($request) {
        try {
            $idRapbd = $request->query->get("id_rapbd");
            $statusRka = $request->query->get("status_rka");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRapbd = pack('H*', str_replace('-', '', trim($idRapbd)));
            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                     sikd_rek_akun.`kd_rek_akun` AS sikd_rek_akun_kd_rek_akun,
                     sikd_rek_akun.`nm_rek_akun` AS sikd_rek_akun_nm_rek_akun,
                     sikd_rek_kelompok.`kd_rek_kelompok` AS sikd_rek_kelompok_kd_rek_kelompok,
                     sikd_rek_kelompok.`nm_rek_kelompok` AS sikd_rek_kelompok_nm_rek_kelompok,
                     sikd_rek_jenis.`kd_rek_jenis` AS sikd_rek_jenis_kd_rek_jenis,
                     sikd_rek_jenis.`nm_rek_jenis` AS sikd_rek_jenis_nm_rek_jenis,
                     sum(ifnull(rka_mata_anggaran.`jumlah`,0)) AS rka_mata_anggaran_jumlah,
                     if(sikd_rek_akun.`kd_rek_akun` in ('4','5'), 'rek_45', 'rek_6') AS jns_rek,
                     sum(if(sikd_rek_akun.`kd_rek_akun`='4',rka_mata_anggaran.`jumlah`,0)) AS jml_pendapatan,
                     sum(if(sikd_rek_akun.`kd_rek_akun`='5',rka_mata_anggaran.`jumlah`,0)) AS jml_belanja,
                     sum(if(sikd_rek_kelompok.`kd_rek_kelompok`='61',rka_mata_anggaran.`jumlah`,0)) AS jml_penerimaan,
                     sum(if(sikd_rek_kelompok.`kd_rek_kelompok`='62',rka_mata_anggaran.`jumlah`,0)) AS jml_pengeluaran,
                     sum(if(sikd_rek_akun.`kd_rek_akun`='4',rka_mata_anggaran.`jumlah`,0)-if(sikd_rek_akun.`kd_rek_akun`='5',rka_mata_anggaran.`jumlah`,0)) AS jml_surplus,
                     sum(if(sikd_rek_kelompok.`kd_rek_kelompok`='61',rka_mata_anggaran.`jumlah`,0)-if(sikd_rek_kelompok.`kd_rek_kelompok`='62',rka_mata_anggaran.`jumlah`,0)) AS jml_pembiayaan
                FROM
                     `rka_rka` rka_rka
                     INNER JOIN `rka_mata_anggaran` rka_mata_anggaran ON rka_rka.`id_rka_rka` = rka_mata_anggaran.`rka_rka`
                     AND rka_rka.`rapbd_rapbd_id` = :id_rapbd
                     AND rka_rka.rka_perubahan = '0'
                     AND if(:status_rka = 'Final',(rka_rka.`status_rka` = 1),(rka_rka.`status_rka` = 0 OR rka_rka.`status_rka` = 2))
                     INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON rka_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                     INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                     INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                     INNER JOIN `sikd_rek_kelompok` sikd_rek_kelompok ON sikd_rek_jenis.`sikd_rek_kelompok_id` = sikd_rek_kelompok.`id_sikd_rek_kelompok`
                     INNER JOIN `sikd_rek_akun` sikd_rek_akun ON sikd_rek_kelompok.`sikd_rek_akun_id` = sikd_rek_akun.`id_sikd_rek_akun`
                     AND (sikd_rek_akun.`kd_rek_akun` IN ('4','5') OR sikd_rek_kelompok.`kd_rek_kelompok` IN ('61','62'))
                GROUP BY
                     sikd_rek_akun.`kd_rek_akun`,
                     sikd_rek_akun.`nm_rek_akun`,
                     sikd_rek_kelompok.`kd_rek_kelompok`,
                     sikd_rek_kelompok.`nm_rek_kelompok`,
                     sikd_rek_jenis.`kd_rek_jenis`,
                     sikd_rek_jenis.`nm_rek_jenis`,
                     jns_rek
                ORDER BY
                     sikd_rek_akun.`kd_rek_akun`,
                     sikd_rek_kelompok.`kd_rek_kelompok`,
                     sikd_rek_jenis.`kd_rek_jenis`";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rapbd", $idRapbd);
            $statement->bindValue("status_rka", $statusRka);
            $statement->execute();
            $rapbdLampPerda01 = $statement->fetchAll();

            return new JsonResponse($rapbdLampPerda01);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getRapbdLampPerda01Mak($request) {
        try {
            $idRapbd = $request->query->get("id_rapbd");
            $statusRka = $request->query->get("status_rka");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRapbd = pack('H*', str_replace('-', '', trim($idRapbd)));
            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                     sikd_rek_akun.`kd_rek_akun` AS sikd_rek_akun_kd_rek_akun,
                     sikd_rek_akun.`nm_rek_akun` AS sikd_rek_akun_nm_rek_akun,
                     concat(substring(sikd_rek_kelompok.`kd_rek_kelompok`,1,1),'.',substring(sikd_rek_kelompok.`kd_rek_kelompok`,2,1)) AS sikd_rek_kelompok_kd_rek_kelompok,
                     sikd_rek_kelompok.`nm_rek_kelompok` AS sikd_rek_kelompok_nm_rek_kelompok,
                     concat(substring(sikd_rek_jenis.`kd_rek_jenis`,1,1),'.',substring(sikd_rek_jenis.`kd_rek_jenis`,2,1),'.',substring(sikd_rek_jenis.`kd_rek_jenis`,3,1)) AS sikd_rek_jenis_kd_rek_jenis,
                     sikd_rek_jenis.`nm_rek_jenis` AS sikd_rek_jenis_nm_rek_jenis,
                     sum(ifnull(rka_mata_anggaran.`jumlah`,0)) AS rka_mata_anggaran_jumlah,
                     if(sikd_rek_akun.`kd_rek_akun` in ('4','5'), 'rek_45', 'rek_6') AS jns_rek,
                     sum(if(sikd_rek_akun.`kd_rek_akun`='4',rka_mata_anggaran.`jumlah`,0)) AS jml_pendapatan,
                     sum(if(sikd_rek_akun.`kd_rek_akun`='5',rka_mata_anggaran.`jumlah`,0)) AS jml_belanja,
                     sum(if(sikd_rek_kelompok.`kd_rek_kelompok`='61',rka_mata_anggaran.`jumlah`,0)) AS jml_penerimaan,
                     sum(if(sikd_rek_kelompok.`kd_rek_kelompok`='62',rka_mata_anggaran.`jumlah`,0)) AS jml_pengeluaran,
                     sum(if(sikd_rek_akun.`kd_rek_akun`='4',rka_mata_anggaran.`jumlah`,0)-if(sikd_rek_akun.`kd_rek_akun`='5',rka_mata_anggaran.`jumlah`,0)) AS jml_surplus,
                     sum(if(sikd_rek_kelompok.`kd_rek_kelompok`='61',rka_mata_anggaran.`jumlah`,0)-if(sikd_rek_kelompok.`kd_rek_kelompok`='62',rka_mata_anggaran.`jumlah`,0)) AS jml_pembiayaan
                FROM
                     `rka_rka` rka_rka 
                     INNER JOIN `rka_mata_anggaran` rka_mata_anggaran ON rka_rka.`id_rka_rka` = rka_mata_anggaran.`rka_rka`
                         AND rka_rka.`rapbd_rapbd_id` = :id_rapbd
                         AND rka_rka.rka_perubahan = '0'
                         AND if(:status_rka = 'Final',(rka_rka.`status_rka` = 1),(rka_rka.`status_rka` = 0 OR rka_rka.`status_rka` = 2))
                     INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON rka_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                     INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                     INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                     INNER JOIN `sikd_rek_kelompok` sikd_rek_kelompok ON sikd_rek_jenis.`sikd_rek_kelompok_id` = sikd_rek_kelompok.`id_sikd_rek_kelompok`
                     INNER JOIN `sikd_rek_akun` sikd_rek_akun ON sikd_rek_kelompok.`sikd_rek_akun_id` = sikd_rek_akun.`id_sikd_rek_akun`
                         AND (sikd_rek_akun.`kd_rek_akun` IN ('4','5') OR sikd_rek_kelompok.`kd_rek_kelompok` IN ('61','62'))
                GROUP BY
                     sikd_rek_akun.`kd_rek_akun`,
                     sikd_rek_akun.`nm_rek_akun`,
                     sikd_rek_kelompok.`kd_rek_kelompok`,
                     sikd_rek_kelompok.`nm_rek_kelompok`,
                     sikd_rek_jenis.`kd_rek_jenis`,
                     sikd_rek_jenis.`nm_rek_jenis`,
                     jns_rek
                ORDER BY
                     sikd_rek_akun.`kd_rek_akun`,
                     sikd_rek_kelompok.`kd_rek_kelompok`,
                     sikd_rek_jenis.`kd_rek_jenis`";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rapbd", $idRapbd);
            $statement->bindValue("status_rka", $statusRka);
            $statement->execute();
            $rapbdLampPerda01Mak = $statement->fetchAll();

            return new JsonResponse($rapbdLampPerda01Mak);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getRapbdLampPerda02($request) {
        try {
            $idRapbd = $request->query->get("id_rapbd");
            $statusRka = $request->query->get("status_rka");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRapbd = pack('H*', str_replace('-', '', trim($idRapbd)));
            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                     sikd_bidang.`kd_bidang` AS sikd_bidang_kd_bidang,
                     sikd_bidang.`nm_bidang` AS sikd_bidang_nm_bidang,
                     sikd_satker.`kode` AS sikd_satker_kode,
                     sikd_satker.`nama` AS sikd_satker_nama,
                     sikd_urusan.`kd_urusan` AS sikd_urusan_kd_urusan,
                     sikd_urusan.`nm_urusan` AS sikd_urusan_nm_urusan,
                     substring(sikd_bidang.`kd_bidang`,2,2)AS kode_2,
                     substring(sikd_satker.`kode`,1,1)AS kd_satker_1,
                     substring(sikd_satker.`kode`,2,2)AS kd_satker_2,
                     substring(sikd_satker.`kode`,4,2)AS kd_satker_3,
                     sum(if(substring(rka_mata_anggaran.`kd_rekening`,1,1)='4',rka_mata_anggaran.`jumlah`,0))AS jml_pendapatan,
                     sum(if(substring(rka_mata_anggaran.`kd_rekening`,1,2)='51',rka_mata_anggaran.`jumlah`,0))AS jml_blnj_tdklangsung,
                     sum(if(substring(rka_mata_anggaran.`kd_rekening`,1,2)='52',rka_mata_anggaran.`jumlah`,0))AS jml_blnj_langsung
                FROM
                     `rka_rka` rka_rka
                     INNER JOIN `vw_rka_skpd_skpkd_all` rka_skpd ON rka_rka.`id_rka_rka` = rka_skpd.`rka_rka_id`
                     AND rka_rka.`rapbd_rapbd_id` = :id_rapbd
                     AND rka_rka.rka_perubahan = '0'
                     AND if(:status_rka = 'Final',(rka_rka.`status_rka` = 1),(rka_rka.`status_rka` = 0 OR rka_rka.`status_rka` = 2))
                     INNER JOIN `sikd_satker` sikd_satker ON rka_skpd.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                     INNER JOIN `rka_mata_anggaran` rka_mata_anggaran ON rka_skpd.`rka_rka_id` = rka_mata_anggaran.`rka_rka`
                     INNER JOIN `sikd_bidang` sikd_bidang ON sikd_bidang.`id_sikd_bidang` = rka_skpd.`sikd_bidang_id`
                     INNER JOIN `sikd_urusan` sikd_urusan ON sikd_bidang.`sikd_urusan_id` = sikd_urusan.`id_sikd_urusan`
                GROUP BY
                     sikd_urusan.`kd_urusan`,
                     sikd_urusan.`nm_urusan`,
                     sikd_bidang.`kd_bidang`,
                     sikd_bidang.`nm_bidang`,
                     sikd_satker.`kode`,
                     sikd_satker.`id_sikd_satker`
                ORDER BY
                     sikd_urusan.`kd_urusan` ASC,
                     sikd_bidang.`kd_bidang` ASC,
                     sikd_satker.`kode` ASC,
                     sikd_satker.`id_sikd_satker` ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rapbd", $idRapbd);
            $statement->bindValue("status_rka", $statusRka);
            $statement->execute();
            $rapbdLampPerda02 = $statement->fetchAll();

            return new JsonResponse($rapbdLampPerda02);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getRapbdLampPerda02a($request) {
        try {
            $idRapbd = $request->query->get("id_rapbd");
            $statusRka = $request->query->get("status_rka");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRapbd = pack('H*', str_replace('-', '', trim($idRapbd)));
            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                    CONCAT_WS('-',
                    SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 1, 8),
                    SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 9, 4),
                    SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 13, 4),
                    SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 17, 4),
                    SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 21)
                    ) AS sikd_satker_id_sikd_satker,
                     sikd_satker.`kode` AS sikd_satker_kode,
                     sikd_satker.`nama` AS sikd_satker_nama,
                     sikd_urusan.`kd_urusan` AS sikd_urusan_kd_urusan,
                     sikd_urusan.`nm_urusan` AS sikd_urusan_nm_urusan,
                     sikd_bidang.`kd_bidang` AS sikd_bidang_kd_bidang,
                     sikd_bidang.`nm_bidang` AS sikd_bidang_nm_bidang,
                     substring(sikd_satker.`kode`,1,1)AS kd_satker_1,
                     substring(sikd_satker.`kode`,2,2)AS kd_satker_2,
                     substring(sikd_satker.`kode`,4,2)AS kd_satker_3,
                     substring(sikd_bidang.`kd_bidang`,2,2)AS kode_2,
                     sum(if(substring(rka_mata_anggaran.`kd_rekening`,1,1)='4',rka_mata_anggaran.`jumlah`,0))AS jml_pendapatan,
                     sum(if(substring(rka_mata_anggaran.`kd_rekening`,1,2)='51',rka_mata_anggaran.`jumlah`,0))AS jml_blnj_tdklangsung,
                     sum(if(substring(rka_mata_anggaran.`kd_rekening`,1,2)='52',rka_mata_anggaran.`jumlah`,0))AS jml_blnj_langsung
                FROM
                     `rka_rka` rka_rka
                     INNER JOIN `vw_rka_skpd_skpkd_all` rka_skpd ON rka_rka.`id_rka_rka` = rka_skpd.`rka_rka_id`
                     AND rka_rka.`rapbd_rapbd_id` = :id_rapbd
                     AND rka_rka.rka_perubahan = '0'
                     AND if(:status_rka = 'Final',(rka_rka.`status_rka` = 1),(rka_rka.`status_rka` = 0 OR rka_rka.`status_rka` = 2))
                     INNER JOIN `sikd_satker` sikd_satker ON rka_skpd.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                     INNER JOIN `rka_mata_anggaran` rka_mata_anggaran ON rka_skpd.`rka_rka_id` = rka_mata_anggaran.`rka_rka`
                     INNER JOIN `sikd_bidang` sikd_bidang ON sikd_bidang.`id_sikd_bidang` = rka_skpd.`sikd_bidang_id`
                     INNER JOIN `sikd_urusan` sikd_urusan ON sikd_bidang.`sikd_urusan_id` = sikd_urusan.`id_sikd_urusan`
                GROUP BY
                     sikd_satker.`kode`,
                     sikd_satker.`id_sikd_satker`,
                     sikd_urusan.`kd_urusan`,
                     sikd_urusan.`nm_urusan`,
                     sikd_bidang.`kd_bidang`,
                     sikd_bidang.`nm_bidang`
                ORDER BY
                     sikd_satker.`kode` ASC,
                     sikd_satker.`id_sikd_satker` ASC,
                     sikd_urusan.`kd_urusan` ASC,
                     sikd_bidang.`kd_bidang` ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rapbd", $idRapbd);
            $statement->bindValue("status_rka", $statusRka);
            $statement->execute();
            $rapbdLampPerda02 = $statement->fetchAll();

            return new JsonResponse($rapbdLampPerda02);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getRapbdLampPerda02b($request) {
        try {
            $idRapbd = $request->query->get("id_rapbd");
            $statusRka = $request->query->get("status_rka");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRapbd = pack('H*', str_replace('-', '', trim($idRapbd)));
            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                     sikd_bidang.`kd_bidang` AS sikd_bidang_kd_bidang,
                     sikd_bidang.`nm_bidang` AS sikd_bidang_nm_bidang,
                    CONCAT_WS('-',
                    SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 1, 8),
                    SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 9, 4),
                    SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 13, 4),
                    SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 17, 4),
                    SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 21)
                    ) AS sikd_satker_id_sikd_satker,
                     sikd_satker.`kode` AS sikd_satker_kode,
                     sikd_satker.`nama` AS sikd_satker_nama,
                     if(CONCAT_WS('-',
                    SUBSTR(HEX(rka_rka.`sikd_sub_satker_id`), 1, 8),
                    SUBSTR(HEX(rka_rka.`sikd_sub_satker_id`), 9, 4),
                    SUBSTR(HEX(rka_rka.`sikd_sub_satker_id`), 13, 4),
                    SUBSTR(HEX(rka_rka.`sikd_sub_satker_id`), 17, 4),
                    SUBSTR(HEX(rka_rka.`sikd_sub_satker_id`), 21)
                    ) != '', CONCAT_WS('-',
                    SUBSTR(HEX(rka_rka.`sikd_sub_satker_id`), 1, 8),
                    SUBSTR(HEX(rka_rka.`sikd_sub_satker_id`), 9, 4),
                    SUBSTR(HEX(rka_rka.`sikd_sub_satker_id`), 13, 4),
                    SUBSTR(HEX(rka_rka.`sikd_sub_satker_id`), 17, 4),
                    SUBSTR(HEX(rka_rka.`sikd_sub_satker_id`), 21)
                    ), CONCAT_WS('-',
                    SUBSTR(HEX(rka_rka.`sikd_satker_id`), 1, 8),
                    SUBSTR(HEX(rka_rka.`sikd_satker_id`), 9, 4),
                    SUBSTR(HEX(rka_rka.`sikd_satker_id`), 13, 4),
                    SUBSTR(HEX(rka_rka.`sikd_satker_id`), 17, 4),
                    SUBSTR(HEX(rka_rka.`sikd_satker_id`), 21)
                    ))  AS sikd_sub_skpd_id,
                     if(CONCAT_WS('-',
                    SUBSTR(HEX(rka_rka.`sikd_sub_satker_id`), 1, 8),
                    SUBSTR(HEX(rka_rka.`sikd_sub_satker_id`), 9, 4),
                    SUBSTR(HEX(rka_rka.`sikd_sub_satker_id`), 13, 4),
                    SUBSTR(HEX(rka_rka.`sikd_sub_satker_id`), 17, 4),
                    SUBSTR(HEX(rka_rka.`sikd_sub_satker_id`), 21)
                    ) != '', sikd_sub_skpd.`kode`, sikd_satker.`kode`)  AS sikd_sub_skpd_kode,
                     if(CONCAT_WS('-',
                    SUBSTR(HEX(rka_rka.`sikd_sub_satker_id`), 1, 8),
                    SUBSTR(HEX(rka_rka.`sikd_sub_satker_id`), 9, 4),
                    SUBSTR(HEX(rka_rka.`sikd_sub_satker_id`), 13, 4),
                    SUBSTR(HEX(rka_rka.`sikd_sub_satker_id`), 17, 4),
                    SUBSTR(HEX(rka_rka.`sikd_sub_satker_id`), 21)
                    ) != '', sikd_sub_skpd.`nama`, sikd_satker.`nama`)  AS sikd_sub_skpd_nama,
                     if((select count('x') from sikd_sub_skpd a where a.sikd_satker_id = sikd_satker.id_sikd_satker) > 1, '1', '0') AS jml_sub_unit, 
                     sikd_urusan.`kd_urusan` AS sikd_urusan_kd_urusan,
                     sikd_urusan.`nm_urusan` AS sikd_urusan_nm_urusan,
                     substring(sikd_bidang.`kd_bidang`,2,2)AS kode_2,
                     substring(sikd_satker.`kode`,1,1)AS kd_satker_1,
                     substring(sikd_satker.`kode`,2,2)AS kd_satker_2,
                     substring(sikd_satker.`kode`,4,2)AS kd_satker_3,
                     sum(if(substring(rka_mata_anggaran.`kd_rekening`,1,1)='4',rka_mata_anggaran.`jumlah`,0))AS jml_pendapatan,
                     sum(if(substring(rka_mata_anggaran.`kd_rekening`,1,2)='51',rka_mata_anggaran.`jumlah`,0))AS jml_blnj_tdklangsung,
                     sum(if(substring(rka_mata_anggaran.`kd_rekening`,1,2)='52',rka_mata_anggaran.`jumlah`,0))AS jml_blnj_langsung
                FROM
                     `rka_rka` rka_rka 
                     INNER JOIN `vw_rka_skpd_skpkd_all` rka_skpd ON rka_rka.`id_rka_rka` = rka_skpd.`rka_rka_id`
                         AND rka_rka.`rapbd_rapbd_id` = :id_rapbd
                         AND rka_rka.rka_perubahan = '0'
                         AND if(:status_rka = 'Final',(rka_rka.`status_rka` = 1),(rka_rka.`status_rka` = 0 OR rka_rka.`status_rka` = 2))
                     INNER JOIN `sikd_satker` sikd_satker ON rka_skpd.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                     LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON rka_rka.`sikd_sub_satker_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                     INNER JOIN `rka_mata_anggaran` rka_mata_anggaran ON rka_skpd.`rka_rka_id` = rka_mata_anggaran.`rka_rka`
                     INNER JOIN `sikd_bidang` sikd_bidang ON sikd_bidang.`id_sikd_bidang` = rka_skpd.`sikd_bidang_id`
                     INNER JOIN `sikd_urusan` sikd_urusan ON sikd_bidang.`sikd_urusan_id` = sikd_urusan.`id_sikd_urusan`
                GROUP BY
                     sikd_urusan.`kd_urusan`,
                     sikd_urusan.`nm_urusan`,
                     sikd_bidang.`kd_bidang`,
                     sikd_bidang.`nm_bidang`,
                     sikd_satker.`id_sikd_satker`,
                     sikd_sub_skpd_kode
                ORDER BY
                     sikd_urusan.`kd_urusan` ASC,
                     sikd_bidang.`kd_bidang` ASC,
                     sikd_satker.`kode` ASC,
                     sikd_satker.`id_sikd_satker` ASC,
                     sikd_sub_skpd_kode ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rapbd", $idRapbd);
            $statement->bindValue("status_rka", $statusRka);
            $statement->execute();
            $rapbdLampPerda02 = $statement->fetchAll();

            return new JsonResponse($rapbdLampPerda02);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }

    private function getRapbdLampPerda03($request) {
        try {
            $idSkpd = $request->query->get("id_skpd");
            $idSubSkpd = $request->query->get("id_sub_skpd");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idSkpd = pack('H*', str_replace('-', '', trim($idSkpd)));
            $idSubSkpd = pack('H*', str_replace('-', '', trim($idSubSkpd)));
            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                     CONCAT_WS('-',
                    SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 1, 8),
                    SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 9, 4),
                    SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 13, 4),
                    SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 17, 4),
                    SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 21)
                    ) AS id_sikd_satker,
                     CONCAT_WS('-',
                    SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 1, 8),
                    SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 9, 4),
                    SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 13, 4),
                    SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 17, 4),
                    SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 21)
                    ) AS id_sikd_sub_skpd,
                     sikd_satker.`kode` AS sikd_satker_kode,
                     sikd_satker.`nama` AS sikd_satker_nama,
                     sikd_sub_skpd.`kode` AS sikd_sub_skpd_kode,
                     sikd_sub_skpd.`nama` AS sikd_sub_skpd_nama,
                     sikd_satker.`singkatan` AS sikd_satker_singkatan,
                     sikd_satker.`kd_bidang_induk` AS sikd_satker_kd_bidang_induk,
                     sikd_satker.`nip_ka_satker` AS sikd_satker_nip_ka_satker,
                     sikd_satker.`nm_ka_satker` AS sikd_satker_nm_ka_satker,
                     sikd_satker.`jab_ka_satker` AS sikd_satker_jab_ka_satker,
                     sikd_bidang.`nm_bidang` AS sikd_bidang_nm_bidang
                FROM
                     `sikd_satker` sikd_satker
                     INNER JOIN `sikd_bidang` sikd_bidang ON sikd_satker.`kd_bidang_induk` = sikd_bidang.`kd_bidang`
                     LEFT OUTER JOIN `sikd_sub_skpd` ON sikd_sub_skpd.sikd_satker_id = sikd_satker.id_sikd_satker
                     AND IF(:id_sub_skpd != '', sikd_sub_skpd.id_sikd_sub_skpd = :id_sub_skpd, 0)
                WHERE
                     IF(:id_skpd != '', sikd_satker.id_sikd_satker = :id_skpd, 1)
                ORDER BY
                     sikd_satker.kode, sikd_sub_skpd.kode";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_skpd", $idSkpd);
            $statement->bindValue("id_sub_skpd", $idSubSkpd);
            $statement->execute();
            $rapbdLampPerda03 = $statement->fetchAll();

            return new JsonResponse($rapbdLampPerda03);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getRapbdLampPerda04($request) {
        try {
            $idRapbd = $request->query->get("id_rapbd");
            $statusRka = $request->query->get("status_rka");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRapbd = pack('H*', str_replace('-', '', trim($idRapbd)));
            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                     sikd_urusan.`kd_urusan` AS sikd_urusan_kd_urusan,
                     sikd_urusan.`nm_urusan` AS sikd_urusan_nm_urusan,
                     sikd_bidang.`kd_bidang` AS sikd_bidang_kd_bidang,
                     sikd_bidang.`nm_bidang` AS sikd_bidang_nm_bidang,
                     CONCAT_WS('-',
                    SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 1, 8),
                    SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 9, 4),
                    SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 13, 4),
                    SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 17, 4),
                    SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 21)
                    ) AS sikd_satker_id_sikd_satker,
                     sikd_satker.`kode` AS sikd_satker_kode,
                     sikd_satker.`nama` AS sikd_satker_nama,
                     sikd_prog.`kd_prog` AS sikd_prog_kd_prog,
                     sikd_prog.`nm_prog` AS sikd_prog_nm_prog,
                     if(length(sikd_kgtn.`kd_kgtn`)=4, substring(sikd_kgtn.`kd_kgtn`,-2), substring(sikd_kgtn.`kd_kgtn`,-3)) AS sikd_kgtn_kd_kgtn,
                     sikd_kgtn.`nm_kgtn` AS sikd_kgtn_nm_kgtn,
                     substring(sikd_bidang.`kd_bidang`,2,2)AS kode_2,
                     substring(sikd_satker.`kode`,1,1) AS kd_satker_1,
                     substring(sikd_satker.`kode`,2,2) AS kd_satker_2,
                     substring(sikd_satker.`kode`,4,2) AS kd_satker_3,
                     if(substring(sikd_satker.`kode`,1,3)=sikd_bidang.`kd_bidang`, substring(sikd_satker.`kode`,4,2), sikd_satker.`kode`) AS kd_prog_3,
                     substring(sikd_prog.`kd_prog`,1,2) AS kd_prog_4,
                     substring(sikd_kgtn.`kd_kgtn`,3,if(length(sikd_kgtn.`kd_kgtn`)=5,3,2)) AS kd_kgtn_5,
                     sum(if(substring(rka_mata_anggaran.`kd_rekening`,1,3)='521',rka_mata_anggaran.`jumlah`,0)) AS jml_blnj_pegawai,
                     sum(if(substring(rka_mata_anggaran.`kd_rekening`,1,3)='522',rka_mata_anggaran.`jumlah`,0)) AS jml_blnj_barang,
                     sum(if(substring(rka_mata_anggaran.`kd_rekening`,1,3)='523',rka_mata_anggaran.`jumlah`,0)) AS jml_blnj_modal
                FROM
                     `rka_rka` rka_rka
                     INNER JOIN `rka_rka` rka_skpd ON rka_rka.`id_rka_rka` = rka_skpd.`id_rka_rka`
                     AND rka_rka.`rapbd_rapbd_id` = :id_rapbd
                     AND rka_rka.rka_perubahan = '0'
                     AND if(:status_rka = 'Final',(rka_rka.`status_rka` = 1),(rka_rka.`status_rka` = 0 OR rka_rka.`status_rka` = 2))
                     INNER JOIN `sikd_satker` sikd_satker ON rka_skpd.`sikd_skpd_id` = sikd_satker.`id_sikd_satker`
                     INNER JOIN `rka_rka` rka_skpd_kgtn ON rka_skpd.`id_rka_rka` = rka_skpd_kgtn.`id_rka_rka` AND rka_skpd_kgtn.`rka_rka_type` = 'RkaSkpdKgtn'
                     INNER JOIN `rka_mata_anggaran` rka_mata_anggaran ON rka_skpd_kgtn.`id_rka_rka` = rka_mata_anggaran.`rka_rka`
                     INNER JOIN `sikd_kgtn` sikd_kgtn ON rka_skpd_kgtn.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                     INNER JOIN `sikd_prog` sikd_prog ON sikd_kgtn.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                     INNER JOIN `sikd_bidang` sikd_bidang ON sikd_bidang.`id_sikd_bidang` = rka_skpd.`sikd_bidang_id`
                     INNER JOIN `sikd_urusan` sikd_urusan ON sikd_bidang.`sikd_urusan_id` = sikd_urusan.`id_sikd_urusan`
                GROUP BY
                     sikd_urusan.`kd_urusan`,
                     sikd_urusan.`nm_urusan`,
                     sikd_bidang.`kd_bidang`,
                     sikd_bidang.`nm_bidang`,
                     sikd_satker.`kode`,
                     sikd_satker.`id_sikd_satker`,
                     sikd_satker.`nama`,
                     sikd_prog.`kd_prog`,
                     sikd_prog.`nm_prog`,
                     sikd_kgtn.`kd_kgtn`,
                     sikd_kgtn.`nm_kgtn`
                ORDER BY
                     sikd_urusan.`kd_urusan` ASC,
                     sikd_bidang.`kd_bidang` ASC,
                     sikd_satker.`kode` ASC,
                     sikd_satker.`id_sikd_satker`,
                     sikd_prog.`kd_prog`,
                     CAST(sikd_kgtn.`kd_kgtn` AS UNSIGNED)";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rapbd", $idRapbd);
            $statement->bindValue("status_rka", $statusRka);
            $statement->execute();
            $rapbdLampPerda04 = $statement->fetchAll();

            return new JsonResponse($rapbdLampPerda04);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }

    private function getRapbdLampPerda04a($request) {
        try {
            $idRapbd = $request->query->get("id_rapbd");
            $statusRka = $request->query->get("status_rka");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRapbd = pack('H*', str_replace('-', '', trim($idRapbd)));
            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                     IFNULL(sikd_sumber_anggaran.`kd_sumber_anggaran`,
                    (select kd_sumber_anggaran from sikd_sumber_anggaran where tipe_anggaran = 'RkaDpa' order by lpad(kd_sumber_anggaran,2,0) limit 1)) AS sikd_sumber_anggaran_kd_sumber_anggaran,
                     IFNULL(sikd_sumber_anggaran.`nm_sumber_anggaran`,
                    (select nm_sumber_anggaran from sikd_sumber_anggaran where tipe_anggaran = 'RkaDpa' order by lpad(kd_sumber_anggaran,2,0) limit 1)) AS sikd_sumber_anggaran_nm_sumber_anggaran,
                     IFNULL(sikd_sumber_anggaran.`singkatan`,
                    (select singkatan from sikd_sumber_anggaran where tipe_anggaran = 'RkaDpa' order by lpad(kd_sumber_anggaran,2,0) limit 1)) AS sikd_sumber_anggaran_singkatan,
                    CONCAT_WS('-',
                    SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 1, 8),
                    SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 9, 4),
                    SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 13, 4),
                    SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 17, 4),
                    SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 21)
                    ) AS sikd_rek_jenis_id_sikd_rek_jenis,
                     SUM(IF(sikd_rek_jenis.`kd_rek_jenis`='511', rka_mata_anggaran.`jumlah`, 0)) jml_511,
                     SUM(IF(sikd_rek_kelompok.`kd_rek_kelompok`='51' AND sikd_rek_jenis.`kd_rek_jenis`!='511', rka_mata_anggaran.`jumlah`, 0)) jml_51x,
                     SUM(IF(sikd_rek_jenis.`kd_rek_jenis`='521', rka_mata_anggaran.`jumlah`, 0)) jml_521,
                     SUM(IF(sikd_rek_jenis.`kd_rek_jenis`='522', rka_mata_anggaran.`jumlah`, 0)) jml_522,
                     SUM(IF(sikd_rek_jenis.`kd_rek_jenis`='523', rka_mata_anggaran.`jumlah`, 0)) jml_523,
                     SUM(IF(sikd_rek_jenis.`kd_rek_jenis`='621', rka_mata_anggaran.`jumlah`, 0)) jml_621,
                     SUM(IF(sikd_rek_jenis.`kd_rek_jenis`='622', rka_mata_anggaran.`jumlah`, 0)) jml_622,
                     SUM(IF(sikd_rek_jenis.`kd_rek_jenis`='623', rka_mata_anggaran.`jumlah`, 0)) jml_623,
                     SUM(IF(sikd_rek_jenis.`kd_rek_jenis`='624', rka_mata_anggaran.`jumlah`, 0)) jml_624,
                     SUM(IFNULL(rka_mata_anggaran.`jumlah`, 0)) jml_total
                    FROM
                     `rka_mata_anggaran` rka_mata_anggaran
                     INNER JOIN `rka_rka` rka_rka ON rka_mata_anggaran.`rka_rka` = rka_rka.`id_rka_rka`
                     INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON rka_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                     INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                     INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                     INNER JOIN `sikd_rek_kelompok` sikd_rek_kelompok ON sikd_rek_jenis.`sikd_rek_kelompok_id` = sikd_rek_kelompok.`id_sikd_rek_kelompok`
                     LEFT OUTER JOIN `rka_rka` rka_skpd_kgtn ON rka_rka.`id_rka_rka` = rka_skpd_kgtn.`id_rka_rka` AND rka_skpd_kgtn.`rka_rka_type` = 'RkaSkpdKgtn'
                     LEFT OUTER JOIN `sikd_sumber_anggaran` sikd_sumber_anggaran ON 
                        sikd_sumber_anggaran.`id_sikd_sumber_anggaran` = if (rka_mata_anggaran.`sikd_sumber_anggaran_id` != '', rka_mata_anggaran.`sikd_sumber_anggaran_id`, rka_skpd_kgtn.`sikd_sumber_anggaran_id`)
                    WHERE
                     rka_rka.rapbd_rapbd_id = :id_rapbd
                     AND sikd_rek_kelompok.kd_rek_kelompok IN ('51','52','62')
                     AND if(:status_rka = 'Final',(rka_rka.`status_rka` = 1),(rka_rka.`status_rka` = 0 OR rka_rka.`status_rka` = 2))
                    GROUP BY
                     sikd_sumber_anggaran_kd_sumber_anggaran
                    ORDER BY
                     sikd_sumber_anggaran_kd_sumber_anggaran";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rapbd", $idRapbd);
            $statement->bindValue("status_rka", $statusRka);
            $statement->execute();
            $rapbdLampPerda04 = $statement->fetchAll();

            return new JsonResponse($rapbdLampPerda04);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getRapbdLampPerda04b($request) {
        try {
            $idRapbd = $request->query->get("id_rapbd");
            $statusRka = $request->query->get("status_rka");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRapbd = pack('H*', str_replace('-', '', trim($idRapbd)));
            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                     CONCAT_WS('-',
                    SUBSTR(HEX(rkpd_sasaran.`id_rkpd_sasaran`), 1, 8),
                    SUBSTR(HEX(rkpd_sasaran.`id_rkpd_sasaran`), 9, 4),
                    SUBSTR(HEX(rkpd_sasaran.`id_rkpd_sasaran`), 13, 4),
                    SUBSTR(HEX(rkpd_sasaran.`id_rkpd_sasaran`), 17, 4),
                    SUBSTR(HEX(rkpd_sasaran.`id_rkpd_sasaran`), 21)
                    ) AS rkpd_sasaran_id_rkpd_sasaran,
                     CONCAT_WS('-',
                    SUBSTR(HEX(rka_rka.`id_rka_rka`), 1, 8),
                    SUBSTR(HEX(rka_rka.`id_rka_rka`), 9, 4),
                    SUBSTR(HEX(rka_rka.`id_rka_rka`), 13, 4),
                    SUBSTR(HEX(rka_rka.`id_rka_rka`), 17, 4),
                    SUBSTR(HEX(rka_rka.`id_rka_rka`), 21)
                    ) AS rka_rka_id_rka_rka,
                     rka_skpd_kgtn.`no_subkegiatan` AS rka_skpd_kgtn_no_subkegiatan,
                     rka_skpd_kgtn.`nm_subkegiatan` AS rka_skpd_kgtn_nm_subkegiatan,
                     sikd_urusan.`kd_urusan` AS sikd_urusan_kd_urusan,
                     sikd_urusan.`nm_urusan` AS sikd_urusan_nm_urusan,
                     CONCAT_WS('-',
                    SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 1, 8),
                    SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 9, 4),
                    SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 13, 4),
                    SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 17, 4),
                    SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 21)
                    ) AS sikd_bidang_id_sikd_bidang,
                     sikd_bidang.`kd_bidang` AS sikd_bidang_kd_bidang,
                     sikd_bidang.`nm_bidang` AS sikd_bidang_nm_bidang,
                     CONCAT_WS('-',
                    SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 1, 8),
                    SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 9, 4),
                    SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 13, 4),
                    SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 17, 4),
                    SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 21)
                    ) AS sikd_satker_id_sikd_satker,
                     sikd_satker.`kode` AS sikd_satker_kode,
                     sikd_satker.`nama` AS sikd_satker_nama,
                     CONCAT_WS('-',
                    SUBSTR(HEX(rka_rka.`sikd_sub_satker_id`), 1, 8),
                    SUBSTR(HEX(rka_rka.`sikd_sub_satker_id`), 9, 4),
                    SUBSTR(HEX(rka_rka.`sikd_sub_satker_id`), 13, 4),
                    SUBSTR(HEX(rka_rka.`sikd_sub_satker_id`), 17, 4),
                    SUBSTR(HEX(rka_rka.`sikd_sub_satker_id`), 21)
                    ) AS sikd_sub_satker_id,
                     CONCAT_WS('-',
                    SUBSTR(HEX(sikd_prog.`id_sikd_prog`), 1, 8),
                    SUBSTR(HEX(sikd_prog.`id_sikd_prog`), 9, 4),
                    SUBSTR(HEX(sikd_prog.`id_sikd_prog`), 13, 4),
                    SUBSTR(HEX(sikd_prog.`id_sikd_prog`), 17, 4),
                    SUBSTR(HEX(sikd_prog.`id_sikd_prog`), 21)
                    ) AS sikd_prog_id_sikd_prog,
                     sikd_prog.`kd_prog` AS sikd_prog_kd_prog,
                     sikd_prog.`nm_prog` AS sikd_prog_nm_prog,
                     if(length(sikd_kgtn.`kd_kgtn`)=4, substring(sikd_kgtn.`kd_kgtn`,-2), substring(sikd_kgtn.`kd_kgtn`,-3)) AS sikd_kgtn_kd_kgtn,
                     sikd_kgtn.`nm_kgtn` AS sikd_kgtn_nm_kgtn,
                     substring(sikd_bidang.`kd_bidang`,2,2)AS kode_2,
                     substring(sikd_satker.`kode`,1,1) AS kd_satker_1,
                     substring(sikd_satker.`kode`,2,2) AS kd_satker_2,
                     substring(sikd_satker.`kode`,4,2) AS kd_satker_3,
                     if(substring(sikd_satker.`kode`,1,3)=sikd_bidang.`kd_bidang`, substring(sikd_satker.`kode`,4,2), sikd_satker.`kode`) AS kd_prog_3,
                     substring(sikd_prog.`kd_prog`,1,2) AS kd_prog_4,
                     substring(sikd_kgtn.`kd_kgtn`,3,if(length(sikd_kgtn.`kd_kgtn`)=5,3,2)) AS kd_kgtn_5,
                     sum(if(substring(rka_mata_anggaran.`kd_rekening`,1,3)='521',rka_mata_anggaran.`jumlah`,0)) AS jml_blnj_pegawai,
                     sum(if(substring(rka_mata_anggaran.`kd_rekening`,1,3)='522',rka_mata_anggaran.`jumlah`,0)) AS jml_blnj_barang,
                     sum(if(substring(rka_mata_anggaran.`kd_rekening`,1,3)='523',rka_mata_anggaran.`jumlah`,0)) AS jml_blnj_modal
                FROM
                     `rka_rka` rka_rka 
                     INNER JOIN `rka_rka` rka_skpd ON rka_rka.`id_rka_rka` = rka_skpd.`id_rka_rka`
                         AND rka_rka.`rapbd_rapbd_id` = :id_rapbd
                         AND rka_rka.rka_perubahan = '0'
                         AND if(:status_rka = 'Final',(rka_rka.`status_rka` = 1),(rka_rka.`status_rka` = 0 OR rka_rka.`status_rka` = 2))
                     INNER JOIN `sikd_satker` sikd_satker ON rka_skpd.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                     INNER JOIN `rka_rka` rka_skpd_kgtn ON rka_skpd.`id_rka_rka` = rka_skpd_kgtn.`id_rka_rka` AND rka_skpd_kgtn.`rka_rka_type` = 'RkaSkpdKgtn'
                     INNER JOIN `rka_mata_anggaran` rka_mata_anggaran ON rka_skpd_kgtn.`id_rka_rka` = rka_mata_anggaran.`rka_rka`
                     INNER JOIN `sikd_kgtn` sikd_kgtn ON rka_skpd_kgtn.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                     INNER JOIN `sikd_prog` sikd_prog ON sikd_kgtn.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                     INNER JOIN `sikd_bidang` sikd_bidang ON sikd_bidang.`id_sikd_bidang` = rka_skpd.`sikd_bidang_id`
                     INNER JOIN `sikd_urusan` sikd_urusan ON sikd_bidang.`sikd_urusan_id` = sikd_urusan.`id_sikd_urusan`
                     LEFT OUTER JOIN (select a.id_rkpd_sasaran, b.sikd_bidang_id, b.sikd_prog_id,
                                 c.sikd_satker_id, c.sikd_sub_skpd_id 
                              from rkpd_sasaran a
                               inner join renja_sasaran d on a.id_rkpd_sasaran = d.rkpd_sasaran_id
                               inner join renja_program b on d.renja_renja_id = b.renja_renja_id
                               inner join renja_renja c on b.renja_renja_id = c.id_renja_renja
                                   and c.jns_renja = 'Renja-F'
                              group by a.id_rkpd_sasaran, c.sikd_satker_id, c.sikd_sub_skpd_id, b.sikd_bidang_id, b.sikd_prog_id) AS rkpd_sasaran
                      ON rkpd_sasaran.sikd_bidang_id = sikd_bidang.id_sikd_bidang
                     AND rkpd_sasaran.sikd_prog_id = sikd_prog.id_sikd_prog
                     AND rkpd_sasaran.sikd_satker_id = rka_rka.`sikd_satker_id`
                     AND rkpd_sasaran.sikd_sub_skpd_id = rka_rka.`sikd_sub_satker_id`
                GROUP BY
                     rkpd_sasaran.`id_rkpd_sasaran`,
                     sikd_urusan.`kd_urusan`,
                     sikd_bidang.`kd_bidang`,
                     sikd_satker.`id_sikd_satker`,
                     sikd_prog.`kd_prog`,
                     sikd_kgtn.`kd_kgtn`,
                     rka_rka.`id_rka_rka`
                ORDER BY
                     rkpd_sasaran.`id_rkpd_sasaran`,
                     sikd_urusan.`kd_urusan` ASC,
                     sikd_bidang.`kd_bidang` ASC,
                     sikd_satker.`kode` ASC,
                     sikd_satker.`id_sikd_satker`,
                     sikd_prog.`kd_prog`,
                     sikd_kgtn.`kd_kgtn`,
                     CAST(sikd_kgtn.`kd_kgtn` AS UNSIGNED),
                     LPAD(rka_skpd_kgtn.`no_subkegiatan`,3,0)";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rapbd", $idRapbd);
            $statement->bindValue("status_rka", $statusRka);
            $statement->execute();
            $rapbdLampPerda04 = $statement->fetchAll();

            return new JsonResponse($rapbdLampPerda04);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getRapbdLampPerda04bSub1($request) {
        try {
            $idSasaran = $request->query->get("id_sasaran");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idSasaran = pack('H*', str_replace('-', '', trim($idSasaran)));
            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                     '01' AS kd_klpk_indikator,
                     'Sasaran' AS nm_klpk_indikator,
                     rkpd_sasaran_indikator.`no_indikator` AS no_indikator,
                     rkpd_sasaran_indikator.`uraian_indikator` AS rka_skpd_indktr_kinerja_uraian,
                     rkpd_sasaran_indikator.`target_thn_ini` AS rka_skpd_indktr_kinerja_target,
                     rkpd_sasaran_indikator.`satuan` AS rka_skpd_indktr_kinerja_satuan
                FROM
                     `rkpd_sasaran` rkpd_sasaran 
                     LEFT OUTER JOIN `rkpd_sasaran_indikator` rkpd_sasaran_indikator ON rkpd_sasaran.`id_rkpd_sasaran` = rkpd_sasaran_indikator.`rkpd_sasaran_id`
                         AND rkpd_sasaran.`id_rkpd_sasaran` = :id_sasaran
                ORDER BY
                     kd_klpk_indikator ASC,
                     lpad(no_indikator,2,0) ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_sasaran", $idSasaran);
            $statement->execute();
            $rapbdLampPerda04 = $statement->fetchAll();

            return new JsonResponse($rapbdLampPerda04);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getRapbdLampPerda04bSub2($request) {
        try {
            $idBidang = $request->query->get("id_bidang");
            $idProg = $request->query->get("id_prog");
            $idSatker = $request->query->get("id_satker");
            $idSubSkpd = $request->query->get("id_sub_skpd");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idBidang = pack('H*', str_replace('-', '', trim($idBidang)));
            $idProg = pack('H*', str_replace('-', '', trim($idProg)));
            $idSatker = pack('H*', str_replace('-', '', trim($idSatker)));
            $idSubSkpd = pack('H*', str_replace('-', '', trim($idSubSkpd)));
            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                     '02' AS kd_klpk_indikator,
                     'Outcome/Hasil' AS nm_klpk_indikator,
                     renja_program_indikator.`no_indikator` AS no_indikator,
                     renja_program_indikator.`uraian_indikator` AS rka_skpd_indktr_kinerja_uraian,
                     renja_program_indikator.`target_thn_ini` AS rka_skpd_indktr_kinerja_target,
                     renja_program_indikator.`satuan` AS rka_skpd_indktr_kinerja_satuan
                FROM
                     `renja_renja` renja_renja 
                     INNER JOIN `renja_program` renja_program ON renja_renja.`id_renja_renja` = renja_program.`renja_renja_id`
                         AND renja_program.`sikd_bidang_id` = :id_bidang
                         AND renja_program.`sikd_prog_id` = :id_prog
                         AND renja_renja.`jns_renja` = 'Renja-F'
                         AND renja_renja.`sikd_satker_id` = :id_satker
                         AND IF(:id_sub_skpd != '', renja_renja.`sikd_sub_skpd_id` = :id_sub_skpd, 1)
                     LEFT OUTER JOIN `renja_program_indikator` renja_program_indikator ON renja_program.`id_renja_program` = renja_program_indikator.`renja_program_id`
                ORDER BY
                     kd_klpk_indikator ASC,
                     lpad(no_indikator,2,0) ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_bidang", $idBidang);
            $statement->bindValue("id_prog", $idProg);
            $statement->bindValue("id_satker", $idSatker);
            $statement->bindValue("id_sub_skpd", $idSubSkpd);
            $statement->execute();
            $rapbdLampPerda04 = $statement->fetchAll();

            return new JsonResponse($rapbdLampPerda04);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }

    private function getRapbdLampPerda04bSub3($request) {
        try {
            $idRka = $request->query->get("id_rka");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRka = pack('H*', str_replace('-', '', trim($idRka)));

            $this->connection = $conn->getConnection();

            $sql = "SELECT
                     sikd_klpk_indikator.`kd_klpk_indikator` AS kd_klpk_indikator,
                     IF(sikd_klpk_indikator.`kd_klpk_indikator` = '03', 'Output/Keluaran', 
                    sikd_klpk_indikator.`nm_klpk_indikator`) AS nm_klpk_indikator,
                     rka_skpd_indktr_kinerja.`no_indikator` AS no_indikator,
                     rka_skpd_indktr_kinerja.`uraian_indikator` AS rka_skpd_indktr_kinerja_uraian,
                     rka_skpd_indktr_kinerja.`target` AS rka_skpd_indktr_kinerja_target,
                     rka_skpd_indktr_kinerja.`satuan` AS rka_skpd_indktr_kinerja_satuan
                FROM
                     `rka_skpd_indktr_kinerja` rka_skpd_indktr_kinerja 
                     INNER JOIN `rka_rka` rka_skpd_kgtn ON rka_skpd_indktr_kinerja.`rka_skpd_kgtn_id` = rka_skpd_kgtn.`id_rka_rka` AND rka_skpd_kgtn.`rka_rka_type` = 'RkaSkpdKgtn'
                     AND rka_skpd_kgtn.`id_rka_rka` = :id_rka
                     INNER JOIN `rka_rka` rka_rka ON rka_skpd_kgtn.`id_rka_rka` = rka_rka.`id_rka_rka`
                     INNER JOIN `sikd_klpk_indikator` sikd_klpk_indikator ON rka_skpd_indktr_kinerja.`sikd_klpk_indikator_id` = sikd_klpk_indikator.`id_sikd_klpk_indikator`
                     AND sikd_klpk_indikator.`kd_klpk_indikator` in ('03','04')
                     RIGHT OUTER JOIN `rapbd_rapbd` rapbd_rapbd ON rka_rka.`rapbd_rapbd_id` = rapbd_rapbd.`id_rapbd_rapbd`

                ORDER BY
                     kd_klpk_indikator ASC,
                     lpad(no_indikator,2,0) ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rka", $idRka);
            $statement->execute();
            $rapbdLampPerda04 = $statement->fetchAll();

            return new JsonResponse($rapbdLampPerda04);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }

    private function getRapbdLampPerda05($request) {
        try {
            $statusRka = $request->query->get("status_rka");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                     sikd_fungsi.`kd_fungsi` AS sikd_fungsi_kd_fungsi,
                     sikd_fungsi.`nm_fungsi` AS sikd_fungsi_nm_fungsi,
                     sikd_bidang.`kd_bidang` AS sikd_bidang_kd_bidang,
                     sikd_bidang.`nm_bidang` AS sikd_bidang_nm_bidang,
                     substring(sikd_bidang.`kd_bidang`,1,1) AS kd_bid_2,
                     substring(sikd_bidang.`kd_bidang`,2,2) AS kd_bid_3,
                     sum(if(substring(rka_mata_anggaran.`kd_rekening`,1,3)='511',rka_mata_anggaran.`jumlah`,0)) AS jml_btl_pegawai,
                     sum(if((substring(rka_mata_anggaran.`kd_rekening`,1,2)='51' && substring(rka_mata_anggaran.`kd_rekening`,1,3)!='511'),rka_mata_anggaran.`jumlah`,0)) AS jml_btl_lainlain,
                     sum(if(substring(rka_mata_anggaran.`kd_rekening`,1,3)='521',rka_mata_anggaran.`jumlah`,0)) AS jml_bl_pegawai,
                     sum(if(substring(rka_mata_anggaran.`kd_rekening`,1,3)='522',rka_mata_anggaran.`jumlah`,0)) AS jml_bl_barang,
                     sum(if(substring(rka_mata_anggaran.`kd_rekening`,1,3)='523',rka_mata_anggaran.`jumlah`,0)) AS jml_bl_modal,
                     sum(rka_mata_anggaran.`jumlah`) AS jml_belanja
                FROM
                     `rka_rka` rka_rka
                     INNER JOIN `rka_mata_anggaran` rka_mata_anggaran ON rka_rka.`id_rka_rka` = rka_mata_anggaran.`rka_rka`
                     AND rka_rka.rka_perubahan = '0'
                     AND rka_mata_anggaran.`kd_rekening` LIKE '5%'
                     AND if(:status_rka = 'Final',(rka_rka.`status_rka` = 1),(rka_rka.`status_rka` = 0 OR rka_rka.`status_rka` = 2))
                     INNER JOIN `vw_rka_skpd_skpkd_all` vw_rka_skpd_skpkd_all ON rka_mata_anggaran.`rka_rka` = vw_rka_skpd_skpkd_all.`rka_rka_id`
                     RIGHT OUTER JOIN `sikd_bidang` sikd_bidang ON vw_rka_skpd_skpkd_all.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                     RIGHT OUTER JOIN `sikd_fungsi` sikd_fungsi ON sikd_bidang.`sikd_fungsi_id` = sikd_fungsi.`id_sikd_fungsi`
                GROUP BY
                     sikd_fungsi.`kd_fungsi`,
                     sikd_fungsi.`nm_fungsi`,
                     sikd_bidang.`kd_bidang`,
                     sikd_bidang.`nm_bidang`
                ORDER BY
                     sikd_fungsi.`kd_fungsi` ASC,
                     sikd_bidang.`kd_bidang` ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("status_rka", $statusRka);
            $statement->execute();
            $rapbdLampPerda04 = $statement->fetchAll();

            return new JsonResponse($rapbdLampPerda04);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getRapbdLampPerda06($request) {
        try {
            $idRapbd = $request->query->get("id_rapbd");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRapbd = pack('H*', str_replace('-', '', trim($idRapbd)));

            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                     if(golongan = '1','I',if(golongan = '2','II',if(golongan = '3','III','IV'))) AS golongan,
                     concat('Golongan ',sikd_gol_pegawai.`nm_golongan`) AS sikd_gol_pegawai_nm_golongan,
                     ifnull(rapbd_rekap_jml_pegawai.`jml_eselon_1`,0),
                     ifnull(rapbd_rekap_jml_pegawai.`jml_eselon_2`,0),
                     ifnull(rapbd_rekap_jml_pegawai.`jml_eselon_3`,0),
                     ifnull(rapbd_rekap_jml_pegawai.`jml_eselon_4`,0),
                     ifnull(rapbd_rekap_jml_pegawai.`jml_eselon_5`,0),
                     ifnull(rapbd_rekap_jml_pegawai.`jml_fungsional`,0),
                     ifnull(rapbd_rekap_jml_pegawai.`jml_staf`,0),
                     ifnull((rapbd_rekap_jml_pegawai.`jml_eselon_1`+rapbd_rekap_jml_pegawai.`jml_eselon_2`+rapbd_rekap_jml_pegawai.`jml_eselon_3`+rapbd_rekap_jml_pegawai.`jml_eselon_4`+rapbd_rekap_jml_pegawai.`jml_eselon_5`+rapbd_rekap_jml_pegawai.`jml_fungsional`+rapbd_rekap_jml_pegawai.`jml_staf`),0) AS jumlah
                FROM
                     `rapbd_rekap_jml_pegawai` rapbd_rekap_jml_pegawai 
                      INNER JOIN `sikd_gol_pegawai` sikd_gol_pegawai ON rapbd_rekap_jml_pegawai.`sikd_gol_pegawai_id` = sikd_gol_pegawai.`id_sikd_gol_pegawai`
                        AND rapbd_rekap_jml_pegawai.`rapbd_rapbd_id` = :id_rapbd
                      RIGHT OUTER JOIN `rapbd_rapbd` rapbd_rapbd ON rapbd_rekap_jml_pegawai.`rapbd_rapbd_id` = rapbd_rapbd.`id_rapbd_rapbd`
                ORDER BY
                      sikd_gol_pegawai.`golongan`,
                      sikd_gol_pegawai.`ruang`";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rapbd", $idRapbd);
            $statement->execute();
            $rapbdLampPerda04 = $statement->fetchAll();

            return new JsonResponse($rapbdLampPerda04);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getRapbdLampPerda07($request) {
        try {
            $idRapbd = $request->query->get("id_rapbd");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRapbd = pack('H*', str_replace('-', '', trim($idRapbd)));

            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                     CONCAT_WS('-',
                    SUBSTR(HEX(rapbd_rapbd.`id_rapbd_rapbd`), 1, 8),
                    SUBSTR(HEX(rapbd_rapbd.`id_rapbd_rapbd`), 9, 4),
                    SUBSTR(HEX(rapbd_rapbd.`id_rapbd_rapbd`), 13, 4),
                    SUBSTR(HEX(rapbd_rapbd.`id_rapbd_rapbd`), 17, 4),
                    SUBSTR(HEX(rapbd_rapbd.`id_rapbd_rapbd`), 21)
                    ) AS rapbd_rapbd_id_rapbd_rapbd,
                     rapbd_rekap_piutang.`no_item` AS rapbd_rekap_piutang_no_item,
                     rapbd_rekap_piutang.`rincian_piutang` AS rapbd_rekap_piutang_rincian_piutang,
                     rapbd_rekap_piutang.`thn_pengakuan` AS rapbd_rekap_piutang_thn_pengakuan,
                     ifnull(rapbd_rekap_piutang.`jml_piutang_n_2`,0),
                     ifnull(rapbd_rekap_piutang.`jml_penambahan_n_1`,0),
                     ifnull(rapbd_rekap_piutang.`jml_pengurangan_n_1`,0),
                     ifnull((rapbd_rekap_piutang.`jml_piutang_n_2`+rapbd_rekap_piutang.`jml_penambahan_n_1`-rapbd_rekap_piutang.`jml_pengurangan_n_1`),0) AS saldo_akhir_thn_n_1
                FROM
                     `rapbd_rekap_piutang` rapbd_rekap_piutang
                      RIGHT OUTER JOIN `rapbd_rapbd` rapbd_rapbd ON rapbd_rekap_piutang.`rapbd_rapbd_id` = rapbd_rapbd.`id_rapbd_rapbd`
                        AND rapbd_rekap_piutang.`rapbd_rapbd_id` = :id_rapbd";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rapbd", $idRapbd);
            $statement->execute();
            $rapbdLampPerda04 = $statement->fetchAll();

            return new JsonResponse($rapbdLampPerda04);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getRapbdLampPerda08($request) {
        try {
            $idRapbd = $request->query->get("id_rapbd");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRapbd = pack('H*', str_replace('-', '', trim($idRapbd)));

            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                     rapbd_rekap_investasi.`no_item` AS rapbd_rekap_investasi_no_item,
                     rapbd_rekap_investasi.`thn_penyertaan` AS rapbd_rekap_investasi_thn_penyertaan,
                     rapbd_rekap_investasi.`nm_badan` AS rapbd_rekap_investasi_nm_badan,
                     rapbd_rekap_investasi.`dasar_hukum` AS rapbd_rekap_investasi_dasar_hukum,
                     rapbd_rekap_investasi.`bentuk_penyertaan` AS rapbd_rekap_investasi_bentuk_penyertaan,
                     ifnull(rapbd_rekap_investasi.`ttl_penyertaan`,0),
                     ifnull(rapbd_rekap_investasi.`jml_thn_lalu`,0),
                     ifnull(rapbd_rekap_investasi.`jml_penyertaan_thn_ini`,0),
                     ifnull((rapbd_rekap_investasi.`jml_thn_lalu`+rapbd_rekap_investasi.`jml_penyertaan_thn_ini`),0) AS jml_col_9,
                     ifnull((rapbd_rekap_investasi.`ttl_penyertaan`-rapbd_rekap_investasi.`jml_thn_lalu`-rapbd_rekap_investasi.`jml_penyertaan_thn_ini`),0) AS jml_col_10,
                     ifnull(rapbd_rekap_investasi.`hasil_thn_ini`,0),
                     ifnull(rapbd_rekap_investasi.`jml_diterima_thn_ini`,0),
                     ifnull((rapbd_rekap_investasi.`jml_thn_lalu`+rapbd_rekap_investasi.`jml_penyertaan_thn_ini`-rapbd_rekap_investasi.`jml_diterima_thn_ini`),0) AS jml_col_13
                FROM
                     `rapbd_rekap_investasi` rapbd_rekap_investasi
                     RIGHT OUTER JOIN `rapbd_rapbd` rapbd_rapbd ON rapbd_rekap_investasi.`rapbd_rapbd_id` = rapbd_rapbd.`id_rapbd_rapbd`
                        AND rapbd_rekap_investasi.`rapbd_rapbd_id` = :id_rapbd";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rapbd", $idRapbd);
            $statement->execute();
            $rapbdLampPerda04 = $statement->fetchAll();

            return new JsonResponse($rapbdLampPerda04);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getRapbdLampPerda09($request) {
        try {
            $idRapbd = $request->query->get("id_rapbd");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRapbd = pack('H*', str_replace('-', '', trim($idRapbd)));

            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                     rapbd_rekap_aset.`no_item` AS rapbd_rekap_aset_no_item,
                     sikd_rek_jenis.`nm_rek_jenis` AS sikd_jns_aset_nm_jns_aset,
                     ifnull(rapbd_rekap_aset.`jml_saldo_n_2`,0),
                     ifnull(rapbd_rekap_aset.`jml_penambahan_n_1`,0),
                     ifnull(rapbd_rekap_aset.`jml_pengurangan_n_1`,0),
                     ifnull((rapbd_rekap_aset.`jml_saldo_n_2`+rapbd_rekap_aset.`jml_penambahan_n_1`-rapbd_rekap_aset.`jml_pengurangan_n_1`),0) AS jml_col_6
                FROM
                     `rapbd_rekap_aset` rapbd_rekap_aset 
                     INNER JOIN `sikd_jns_aset` a ON rapbd_rekap_aset.sikd_jns_aset_id = a.id_sikd_jns_aset
                     INNER JOIN `sikd_rek_obj` b ON a.sikd_rek_obj_id = b.id_sikd_rek_obj
                     INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON b.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                       AND rapbd_rekap_aset.`rapbd_rapbd_id` = :id_rapbd
                       -- AND rapbd_rekap_aset.`kd_rekening` like '13%'
                       AND a.`kd_jns_aset` like '13%'
                     RIGHT OUTER JOIN `rapbd_rapbd` rapbd_rapbd ON rapbd_rekap_aset.`rapbd_rapbd_id` = rapbd_rapbd.`id_rapbd_rapbd`";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rapbd", $idRapbd);
            $statement->execute();
            $rapbdLampPerda04 = $statement->fetchAll();

            return new JsonResponse($rapbdLampPerda04);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getRapbdLampPerda10($request) {
        try {
            $idRapbd = $request->query->get("id_rapbd");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRapbd = pack('H*', str_replace('-', '', trim($idRapbd)));

            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                     rapbd_rekap_aset.`no_item` AS rapbd_rekap_aset_no_item,
                     sikd_rek_jenis.`nm_rek_jenis` AS sikd_jns_aset_nm_jns_aset,
                     ifnull(rapbd_rekap_aset.`jml_saldo_n_2`,0),
                     ifnull(rapbd_rekap_aset.`jml_penambahan_n_1`,0),
                     ifnull(rapbd_rekap_aset.`jml_pengurangan_n_1`,0),
                     ifnull((rapbd_rekap_aset.`jml_saldo_n_2`+rapbd_rekap_aset.`jml_penambahan_n_1`-rapbd_rekap_aset.`jml_pengurangan_n_1`),0) AS jml_col_6
                FROM
                     `rapbd_rekap_aset` rapbd_rekap_aset 
                     INNER JOIN `sikd_jns_aset` a ON rapbd_rekap_aset.sikd_jns_aset_id = a.id_sikd_jns_aset
                     INNER JOIN `sikd_rek_obj` b ON a.sikd_rek_obj_id = b.id_sikd_rek_obj
                     INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON b.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                        AND rapbd_rekap_aset.`rapbd_rapbd_id` = :id_rapbd
                    AND a.`kd_jns_aset` like '15%'
                     RIGHT OUTER JOIN `rapbd_rapbd` rapbd_rapbd ON rapbd_rekap_aset.`rapbd_rapbd_id` = rapbd_rapbd.`id_rapbd_rapbd`";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rapbd", $idRapbd);
            $statement->execute();
            $rapbdLampPerda04 = $statement->fetchAll();

            return new JsonResponse($rapbdLampPerda04);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getRapbdLampPerda111($request) {
        try {
            $idRapbd = $request->query->get("id_rapbd");
            $jnsKgtnLanjutan = $request->query->get("jns_kgtn_lanjutan");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRapbd = pack('H*', str_replace('-', '', trim($idRapbd)));

            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                     rapbd_rekap_kgtn_lanjutan.`no_item` AS rapbd_rekap_kgtn_lanjutan_no_item,
                     rapbd_rekap_kgtn_lanjutan.`kd_kgtn` AS rapbd_rekap_kgtn_lanjutan_kd_kegiatan,
                     rapbd_rekap_kgtn_lanjutan.`nm_kegiatan` AS rapbd_rekap_kgtn_lanjutan_nm_kegiatan,
                     ifnull(rapbd_rekap_kgtn_lanjutan.`jml_apbd_n_2`,0),
                     ifnull(rapbd_rekap_kgtn_lanjutan.`jml_apbd_p_n_2`,0),
                     ifnull(rapbd_rekap_kgtn_lanjutan.`jml_realisasi_n_2`,0),
                     ifnull(rapbd_rekap_kgtn_lanjutan.`jml_apbd_n_1`,0),
                     ifnull(rapbd_rekap_kgtn_lanjutan.`jml_apbd_p_n_1`,0),
                     ifnull(rapbd_rekap_kgtn_lanjutan.`jml_realisasi_n_1`,0),
                     ifnull(rapbd_rekap_kgtn_lanjutan.`jml_apbd`,0),
                     ifnull(rapbd_rekap_kgtn_lanjutan.`jml_apbd_p`,0)
                FROM
                     `rapbd_rekap_kgtn_lanjutan` rapbd_rekap_kgtn_lanjutan 
                     INNER JOIN `sikd_satker` sikd_satker ON rapbd_rekap_kgtn_lanjutan.`sikd_skpd_id` = sikd_satker.`id_sikd_satker`
                      AND rapbd_rekap_kgtn_lanjutan.`rapbd_rapbd_id` = :id_rapbd
                      AND rapbd_rekap_kgtn_lanjutan.`jns_kgtn_lanjutan` = :jns_kgtn_lanjutan";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rapbd", $idRapbd);
            $statement->bindValue("jns_kgtn_lanjutan", $jnsKgtnLanjutan);
            $statement->execute();
            $rapbdLampPerda04 = $statement->fetchAll();

            return new JsonResponse($rapbdLampPerda04);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getRapbdLampPerda112($request) {
        try {
            $idRapbd = $request->query->get("id_rapbd");
            $jnsKgtnLanjutan = $request->query->get("jns_kgtn_lanjutan");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRapbd = pack('H*', str_replace('-', '', trim($idRapbd)));

            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                     rapbd_rekap_kgtn_lanjutan.`no_item` AS rapbd_rekap_kgtn_lanjutan_no_item,
                     rapbd_rekap_kgtn_lanjutan.`kd_kgtn` AS rapbd_rekap_kgtn_lanjutan_kd_kegiatan,
                     rapbd_rekap_kgtn_lanjutan.`nm_kegiatan` AS rapbd_rekap_kgtn_lanjutan_nm_kegiatan,
                     ifnull(rapbd_rekap_kgtn_lanjutan.`jml_apbd_n_2`,0),
                     ifnull(rapbd_rekap_kgtn_lanjutan.`jml_apbd_p_n_2`,0),
                     ifnull(rapbd_rekap_kgtn_lanjutan.`jml_realisasi_n_2`,0),
                     ifnull(rapbd_rekap_kgtn_lanjutan.`jml_apbd_n_1`,0),
                     ifnull(rapbd_rekap_kgtn_lanjutan.`jml_apbd_p_n_1`,0),
                     ifnull(rapbd_rekap_kgtn_lanjutan.`jml_realisasi_n_1`,0),
                     ifnull(rapbd_rekap_kgtn_lanjutan.`jml_apbd`,0),
                     ifnull(rapbd_rekap_kgtn_lanjutan.`jml_apbd_p`,0)
                FROM
                     `rapbd_rekap_kgtn_lanjutan` rapbd_rekap_kgtn_lanjutan 
                     INNER JOIN `sikd_satker` sikd_satker ON rapbd_rekap_kgtn_lanjutan.`sikd_skpd_id` = sikd_satker.`id_sikd_satker`
                      AND rapbd_rekap_kgtn_lanjutan.`rapbd_rapbd_id` = :id_rapbd
                      AND rapbd_rekap_kgtn_lanjutan.`jns_kgtn_lanjutan` = :jns_kgtn_lanjutan";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rapbd", $idRapbd);
            $statement->bindValue("jns_kgtn_lanjutan", $jnsKgtnLanjutan);
            $statement->execute();
            $rapbdLampPerda04 = $statement->fetchAll();

            return new JsonResponse($rapbdLampPerda04);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getRapbdLampPerda12($request) {
        try {
            $idRapbd = $request->query->get("id_rapbd");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRapbd = pack('H*', str_replace('-', '', trim($idRapbd)));

            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                     rapbd_rekap_dana_cadangan.`no_item` AS rapbd_rekap_dana_cadangan_no_item,
                     rapbd_rekap_dana_cadangan.`tujuan` AS rapbd_rekap_dana_cadangan_tujuan,
                     rapbd_rekap_dana_cadangan.`dasar_hukum` AS rapbd_rekap_dana_cadangan_dasar_hukum,
                     ifnull(rapbd_rekap_dana_cadangan.`jml_dana`,0),
                     ifnull(rapbd_rekap_dana_cadangan.`jml_saldo_awal`,0),
                     ifnull(rapbd_rekap_dana_cadangan.`jml_transfer_kas_dari`,0),
                     ifnull(rapbd_rekap_dana_cadangan.`jml_transfer_kas_ke`,0),
                     ifnull(rapbd_rekap_dana_cadangan.`jml_saldo_akhir`,0),
                     ifnull(rapbd_rekap_dana_cadangan.`jml_sisa_dana`,0)
                FROM
                     `rapbd_rekap_dana_cadangan` rapbd_rekap_dana_cadangan
                     RIGHT OUTER JOIN `rapbd_rapbd` rapbd_rapbd ON rapbd_rekap_dana_cadangan.`rapbd_rapbd_id` = rapbd_rapbd.`id_rapbd_rapbd`
                     AND rapbd_rekap_dana_cadangan.`rapbd_rapbd_id` = :id_rapbd";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rapbd", $idRapbd);
            $statement->execute();
            $rapbdLampPerda04 = $statement->fetchAll();

            return new JsonResponse($rapbdLampPerda04);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getRapbdLampPerda13($request) {
        try {
            $idRapbd = $request->query->get("id_rapbd");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRapbd = pack('H*', str_replace('-', '', trim($idRapbd)));

            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                     rapbd_rekap_pinjaman.`no_item` AS rapbd_rekap_pinjaman_no_item,
                     rapbd_rekap_pinjaman.`sumber_pinjaman` AS rapbd_rekap_pinjaman_sumber_pinjaman,
                     rapbd_rekap_pinjaman.`dasar_hukum` AS rapbd_rekap_pinjaman_dasar_hukum,
                     rapbd_rekap_pinjaman.`tgl_pinjaman` AS rapbd_rekap_pinjaman_tgl_pinjaman,
                     ifnull(rapbd_rekap_pinjaman.`jml_pinjaman`,0),
                     rapbd_rekap_pinjaman.`jangka_waktu` AS rapbd_rekap_pinjaman_jangka_waktu,
                     ifnull(rapbd_rekap_pinjaman.`bunga`,0),
                     rapbd_rekap_pinjaman.`tujuan_penggunaan` AS rapbd_rekap_pinjaman_tujuan_penggunaan,
                     ifnull(rapbd_rekap_pinjaman.`jml_bayar_pokok`,0),
                     ifnull(rapbd_rekap_pinjaman.`jml_bayar_bunga`,0),
                     ifnull(rapbd_rekap_pinjaman.`jml_sisa_pokok`,0),
                     ifnull(rapbd_rekap_pinjaman.`jml_sisa_bunga`,0)
                FROM
                     `rapbd_rekap_pinjaman` rapbd_rekap_pinjaman
                WHERE
                     rapbd_rekap_pinjaman.`rapbd_rapbd_id` = :id_rapbd";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rapbd", $idRapbd);
            $statement->execute();
            $rapbdLampPerda04 = $statement->fetchAll();

            return new JsonResponse($rapbdLampPerda04);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getRapbdLampPerda13Pak($request) {
        try {
            $idRapbd = $request->query->get("id_rapbd");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRapbd = pack('H*', str_replace('-', '', trim($idRapbd)));

            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                     rapbd_rekap_pinjaman.`no_item` AS rapbd_rekap_pinjaman_no_item,
                     rapbd_rekap_pinjaman.`sumber_pinjaman` AS rapbd_rekap_pinjaman_sumber_pinjaman,
                     rapbd_rekap_pinjaman.`dasar_hukum` AS rapbd_rekap_pinjaman_dasar_hukum,
                     rapbd_rekap_pinjaman.`tgl_pinjaman` AS rapbd_rekap_pinjaman_tgl_pinjaman,
                     ifnull(rapbd_rekap_pinjaman.`jml_pinjaman`,0),
                     rapbd_rekap_pinjaman.`jangka_waktu` AS rapbd_rekap_pinjaman_jangka_waktu,
                     ifnull(rapbd_rekap_pinjaman.`bunga`,0),
                     rapbd_rekap_pinjaman.`tujuan_penggunaan` AS rapbd_rekap_pinjaman_tujuan_penggunaan,
                     ifnull(rapbd_rekap_pinjaman.`jml_bayar_pokok`,0),
                     ifnull(rapbd_rekap_pinjaman.`jml_bayar_bunga`,0),
                     ifnull(rapbd_rekap_pinjaman.`jml_sisa_pokok`,0),
                     ifnull(rapbd_rekap_pinjaman.`jml_sisa_bunga`,0)
                FROM
                     `rapbd_rekap_pinjaman` rapbd_rekap_pinjaman
                WHERE
                     rapbd_rekap_pinjaman.`rapbd_rapbd_id` = :id_rapbd";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rapbd", $idRapbd);
            $statement->execute();
            $rapbdLampPerda04 = $statement->fetchAll();

            return new JsonResponse($rapbdLampPerda04);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getRapbdLampPerda14($request) {
        try {
            $idRapbd = $request->query->get("id_rapbd");
            $statusRka = $request->query->get("status_rka");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRapbd = pack('H*', str_replace('-', '', trim($idRapbd)));

            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                     sikd_rek_akun.`kd_rek_akun` AS sikd_rek_akun_kd_rek_akun,
                     sikd_rek_akun.`nm_rek_akun` AS sikd_rek_akun_nm_rek_akun,
                     sikd_rek_kelompok.`kd_rek_kelompok` AS sikd_rek_kelompok_kd_rek_kelompok_,
                     concat(substring(sikd_rek_kelompok.`kd_rek_kelompok`,1,1),'.',substring(sikd_rek_kelompok.`kd_rek_kelompok`,2,1)) AS sikd_rek_kelompok_kd_rek_kelompok,
                     sikd_rek_kelompok.`nm_rek_kelompok` AS sikd_rek_kelompok_nm_rek_kelompok,
                     sikd_rek_jenis.`kd_rek_jenis` AS sikd_rek_jenis_kd_rek_jenis_,
                     concat(substring(sikd_rek_jenis.`kd_rek_jenis`,1,1),'.',substring(sikd_rek_jenis.`kd_rek_jenis`,2,1),'.',
                        substring(sikd_rek_jenis.`kd_rek_jenis`,3,1)) AS sikd_rek_jenis_kd_rek_jenis,
                     sikd_rek_jenis.`nm_rek_jenis` AS sikd_rek_jenis_nm_rek_jenis,
                     sikd_rek_obj.`kd_rek_obj` AS sikd_rek_obj_kd_rek_obj_,
                     concat(substring(sikd_rek_obj.`kd_rek_obj`,1,1),'.',substring(sikd_rek_obj.`kd_rek_obj`,2,1),'.',
                        substring(sikd_rek_obj.`kd_rek_obj`,3,1),'.',substring(sikd_rek_obj.`kd_rek_obj`,4,2)) AS sikd_rek_obj_kd_rek_obj,
                     sikd_rek_obj.`nm_rek_obj` AS sikd_rek_obj_nm_rek_obj,
                     sikd_rek_rincian_obj.`kd_rek_rincian_obj` AS sikd_rek_rincian_obj_kd_rek_rincian_obj_,
                     concat(substring(sikd_rek_rincian_obj.`kd_rek_rincian_obj`,1,1),'.',substring(sikd_rek_rincian_obj.`kd_rek_rincian_obj`,2,1),'.',
                        substring(sikd_rek_rincian_obj.`kd_rek_rincian_obj`,3,1),'.',substring(sikd_rek_rincian_obj.`kd_rek_rincian_obj`,4,2),'.',
                        substring(sikd_rek_rincian_obj.`kd_rek_rincian_obj`,6,2)) AS sikd_rek_rincian_obj_kd_rek_rincian_obj,
                     sikd_rek_rincian_obj.`nm_rek_rincian_obj` AS sikd_rek_rincian_obj_nm_rek_rincian_obj,
                     sum(ifnull(rka_mata_anggaran.`jumlah`,0)) AS rka_mata_anggaran_jumlah,
                     if(sikd_rek_akun.`kd_rek_akun` in ('4','5'), 'rek_45', 'rek_6') AS jns_rek,
                     sum(if(sikd_rek_akun.`kd_rek_akun`='4',rka_mata_anggaran.`jumlah`,0)) AS jml_pendapatan,
                     sum(if(sikd_rek_akun.`kd_rek_akun`='5',rka_mata_anggaran.`jumlah`,0)) AS jml_belanja,
                     sum(if(sikd_rek_kelompok.`kd_rek_kelompok`='61',rka_mata_anggaran.`jumlah`,0)) AS jml_penerimaan,
                     sum(if(sikd_rek_kelompok.`kd_rek_kelompok`='62',rka_mata_anggaran.`jumlah`,0)) AS jml_pengeluaran,
                     sum(if(sikd_rek_akun.`kd_rek_akun`='4',rka_mata_anggaran.`jumlah`,0)-if(sikd_rek_akun.`kd_rek_akun`='5',rka_mata_anggaran.`jumlah`,0)) AS jml_surplus,
                     sum(if(sikd_rek_kelompok.`kd_rek_kelompok`='61',rka_mata_anggaran.`jumlah`,0)-if(sikd_rek_kelompok.`kd_rek_kelompok`='62',rka_mata_anggaran.`jumlah`,0)) AS jml_pembiayaan
                FROM
                     `rka_rka` rka_rka 
                     INNER JOIN `rka_mata_anggaran` rka_mata_anggaran ON rka_rka.`id_rka_rka` = rka_mata_anggaran.`rka_rka`
                     AND rka_rka.`rapbd_rapbd_id` = :id_rapbd
                     AND if(:status_rka = 'Final',(rka_rka.`status_rka` = 1),(rka_rka.`status_rka` = 0 OR rka_rka.`status_rka` = 2))
                     INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON rka_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                     INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                     INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                     INNER JOIN `sikd_rek_kelompok` sikd_rek_kelompok ON sikd_rek_jenis.`sikd_rek_kelompok_id` = sikd_rek_kelompok.`id_sikd_rek_kelompok`
                     INNER JOIN `sikd_rek_akun` sikd_rek_akun ON sikd_rek_kelompok.`sikd_rek_akun_id` = sikd_rek_akun.`id_sikd_rek_akun`
                     AND (sikd_rek_akun.`kd_rek_akun` IN ('4','5') OR sikd_rek_kelompok.`kd_rek_kelompok` IN ('61','62'))
                GROUP BY
                     sikd_rek_akun.`kd_rek_akun`,
                     sikd_rek_akun.`nm_rek_akun`,
                     sikd_rek_kelompok.`kd_rek_kelompok`,
                     sikd_rek_kelompok.`nm_rek_kelompok`,
                     sikd_rek_jenis.`kd_rek_jenis`,
                     sikd_rek_jenis.`nm_rek_jenis`,
                     sikd_rek_obj.`kd_rek_obj`,
                     sikd_rek_obj.`nm_rek_obj`,
                     sikd_rek_rincian_obj.`kd_rek_rincian_obj`,
                     sikd_rek_rincian_obj.`nm_rek_rincian_obj`,
                     jns_rek
                ORDER BY
                     sikd_rek_akun.`kd_rek_akun`,
                     sikd_rek_kelompok.`kd_rek_kelompok`,
                     sikd_rek_jenis.`kd_rek_jenis`,
                     sikd_rek_obj.`kd_rek_obj`,
                     sikd_rek_rincian_obj.`kd_rek_rincian_obj`";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rapbd", $idRapbd);
            $statement->bindValue("status_rka", $statusRka);
            $statement->execute();
            $rapbdLampPerda04 = $statement->fetchAll();

            return new JsonResponse($rapbdLampPerda04);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getRapbdLampPnjbrn01a($request) {
        try {
            $idRapbd = $request->query->get("id_rapbd");
            $statusRka = $request->query->get("status_rka");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRapbd = pack('H*', str_replace('-', '', trim($idRapbd)));

            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                     SUBSTR(sikd_rek_rincian_obj.`kd_rek_rincian_obj`,1,1) AS sikd_rek_akun_kd_rek_akun,
                     sikd_rek_akun.`nm_rek_akun` AS sikd_rek_akun_nm_rek_akun,
                     CONCAT(SUBSTR(sikd_rek_rincian_obj.`kd_rek_rincian_obj`,1,1),'.',
                        SUBSTR(sikd_rek_rincian_obj.`kd_rek_rincian_obj`,2,1)) AS sikd_rek_kelompok_kd_rek_kelompok,
                     sikd_rek_kelompok.`nm_rek_kelompok` AS sikd_rek_kelompok_nm_rek_kelompok,
                     CONCAT(SUBSTR(sikd_rek_rincian_obj.`kd_rek_rincian_obj`,1,1),'.',
                        SUBSTR(sikd_rek_rincian_obj.`kd_rek_rincian_obj`,2,1),'.',
                        SUBSTR(sikd_rek_rincian_obj.`kd_rek_rincian_obj`,3,1)) AS sikd_rek_jenis_kd_rek_jenis,
                     sikd_rek_jenis.`nm_rek_jenis` AS sikd_rek_jenis_nm_rek_jenis,
                     CONCAT(SUBSTR(sikd_rek_rincian_obj.`kd_rek_rincian_obj`,1,1),'.',
                        SUBSTR(sikd_rek_rincian_obj.`kd_rek_rincian_obj`,2,1),'.',
                        SUBSTR(sikd_rek_rincian_obj.`kd_rek_rincian_obj`,3,1),'.',
                        SUBSTR(sikd_rek_rincian_obj.`kd_rek_rincian_obj`,4,2)) AS sikd_rek_obj_kd_rek_obj,
                     sikd_rek_obj.`nm_rek_obj` AS sikd_rek_obj_nm_rek_obj,
                     CONCAT(SUBSTR(sikd_rek_rincian_obj.`kd_rek_rincian_obj`,1,1),'.',
                        SUBSTR(sikd_rek_rincian_obj.`kd_rek_rincian_obj`,2,1),'.',
                        SUBSTR(sikd_rek_rincian_obj.`kd_rek_rincian_obj`,3,1),'.',
                        SUBSTR(sikd_rek_rincian_obj.`kd_rek_rincian_obj`,4,2),'.',
                        SUBSTR(sikd_rek_rincian_obj.`kd_rek_rincian_obj`,6,2)) AS sikd_rek_rincian_obj_kd_rek_rincian_obj,
                     sikd_rek_rincian_obj.`nm_rek_rincian_obj` AS sikd_rek_rincian_obj_nm_rek_rincian_obj,
                     sum(ifnull(rka_mata_anggaran.`jumlah`,0)) AS rka_mata_anggaran_jumlah,
                     if(sikd_rek_akun.`kd_rek_akun` in ('4','5'), 'rek_45', 'rek_6') AS jns_rek,
                     sum(if(sikd_rek_akun.`kd_rek_akun`='4',rka_mata_anggaran.`jumlah`,0)) AS jml_pendapatan,
                     sum(if(sikd_rek_akun.`kd_rek_akun`='5',rka_mata_anggaran.`jumlah`,0)) AS jml_belanja,
                     sum(if(sikd_rek_kelompok.`kd_rek_kelompok`='61',rka_mata_anggaran.`jumlah`,0)) AS jml_penerimaan,
                     sum(if(sikd_rek_kelompok.`kd_rek_kelompok`='62',rka_mata_anggaran.`jumlah`,0)) AS jml_pengeluaran,
                     sum(if(sikd_rek_akun.`kd_rek_akun`='4',rka_mata_anggaran.`jumlah`,0)-if(sikd_rek_akun.`kd_rek_akun`='5',rka_mata_anggaran.`jumlah`,0)) AS jml_surplus,
                     sum(if(sikd_rek_kelompok.`kd_rek_kelompok`='61',rka_mata_anggaran.`jumlah`,0)-if(sikd_rek_kelompok.`kd_rek_kelompok`='62',rka_mata_anggaran.`jumlah`,0)) AS jml_pembiayaan
                FROM
                     `rka_rka` rka_rka 
                     INNER JOIN `rka_mata_anggaran` rka_mata_anggaran ON rka_rka.`id_rka_rka` = rka_mata_anggaran.`rka_rka`
                     AND rka_rka.`rapbd_rapbd_id` = :id_rapbd
                     AND rka_rka.rka_perubahan = '0'
                     AND if(:status_rka = 'Final',(rka_rka.`status_rka` = 1),(rka_rka.`status_rka` = 0 OR rka_rka.`status_rka` = 2))
                     INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON rka_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                     INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                     INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                     INNER JOIN `sikd_rek_kelompok` sikd_rek_kelompok ON sikd_rek_jenis.`sikd_rek_kelompok_id` = sikd_rek_kelompok.`id_sikd_rek_kelompok`
                     INNER JOIN `sikd_rek_akun` sikd_rek_akun ON sikd_rek_kelompok.`sikd_rek_akun_id` = sikd_rek_akun.`id_sikd_rek_akun`
                     AND (sikd_rek_akun.`kd_rek_akun` IN ('4','5') OR sikd_rek_kelompok.`kd_rek_kelompok` IN ('61','62'))
                GROUP BY
                     sikd_rek_akun.`kd_rek_akun`,
                     sikd_rek_kelompok.`kd_rek_kelompok`,
                     sikd_rek_jenis.`kd_rek_jenis`,
                     sikd_rek_obj.`kd_rek_obj`,
                     sikd_rek_rincian_obj.`kd_rek_rincian_obj`,
                     jns_rek
                ORDER BY
                     sikd_rek_akun.`kd_rek_akun`,
                     sikd_rek_kelompok.`kd_rek_kelompok`,
                     sikd_rek_jenis.`kd_rek_jenis`,
                     sikd_rek_obj.`kd_rek_obj`,
                     sikd_rek_rincian_obj.`kd_rek_rincian_obj`";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rapbd", $idRapbd);
            $statement->bindValue("status_rka", $statusRka);
            $statement->execute();
            $rapbdLampPerda04 = $statement->fetchAll();

            return new JsonResponse($rapbdLampPerda04);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getRapbdLampPnjbrn02All($request) {
        try {
            $idRapbd = $request->query->get("id_rapbd");
            $statusRka = $request->query->get("status_rka");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRapbd = pack('H*', str_replace('-', '', trim($idRapbd)));

            
            $this->connection = $conn->getConnection();

            $sql = "SELECT 
                     IF(:id_skpkd != '', sikd_skpkd.`id_sikd_skpkd`, '') AS id_sikd_skpkd,
                     IF(sikd_skpkd.id_sikd_skpkd IS NULL || :id_skpkd = '', 'SikdSkpd', 'SikdSkpkd') AS sikd_satker_type,
                     sikd_satker.id_sikd_satker AS id_sikd_satker, 
                     sikd_satker.kode as kd_skpd, 
                     sikd_satker.nama as nm_skpd,
                     if($:id_sub_skpd = '', '', rka_rka.sikd_sub_satker_id) AS id_sikd_sub_skpd__,
                     IF(:id_sub_skpd != '', :id_sub_skpd, '') AS id_sikd_sub_skpd,
                     IF(rka_rka.sikd_sub_satker_id != '', sikd_sub_skpd.kode, sikd_satker.kode) AS kd_sub_skpd,
                     IF(rka_rka.sikd_sub_satker_id != '', sikd_sub_skpd.nama, sikd_satker.nama) AS nm_sub_skpd,
                     sikd_bidang.kd_bidang, sikd_bidang.nm_bidang
                FROM
                     `rka_rka` rka_rka
                     INNER JOIN `sikd_satker` sikd_satker ON rka_rka.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                     LEFT OUTER JOIN `sikd_sub_skpd` ON rka_rka.sikd_sub_satker_id = sikd_sub_skpd.id_sikd_sub_skpd
                     INNER JOIN `sikd_bidang` sikd_bidang ON sikd_satker.`kd_bidang_induk` = sikd_bidang.`kd_bidang`
                     LEFT OUTER JOIN `sikd_skpkd` ON sikd_skpkd.sikd_skpd_id = sikd_satker.id_sikd_satker
                WHERE
                     IF(:id_skpd != '', rka_rka.`sikd_satker_id` = :id_skpd, 1)
                 AND IF(:id_skpd != '', rka_rka.sikd_sub_satker_id like :id_sub_skpd, 1)
                 AND IF(:lap_dppkad = '1', sikd_satker.sikd_satker_type != 'SikdSkpkd', 1)
                GROUP BY
                     sikd_satker.id_sikd_satker, 
                     if(:id_sub_skpd != '%', sikd_sub_skpd.kode, '')
                ORDER BY
                     sikd_satker.kode,
                     sikd_satker.id_sikd_satker, 
                     sikd_sub_skpd.kod";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rapbd", $idRapbd);
            $statement->bindValue("status_rka", $statusRka);
            $statement->execute();
            $rapbdLampPerda04 = $statement->fetchAll();

            return new JsonResponse($rapbdLampPerda04);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getLapPmk071a($request) {
        try {
            $idRapbd = $request->query->get("id_rapbd");
            $statusRka = $request->query->get("status_rka");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRapbd = pack('H*', str_replace('-', '', trim($idRapbd)));

            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                 rapbd_rapbd.`tahun` AS rapbd_rapbd_tahun,
                 sikd_fungsi.`kd_fungsi` AS sikd_fungsi_kd_fungsi,
                 sikd_fungsi.`nm_fungsi` AS sikd_fungsi_nm_fungsi,
                 sikd_urusan.`nm_urusan` AS sikd_urusan_nm_urusan,
                 CONCAT_WS('-',
                SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 1, 8),
                SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 9, 4),
                SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 13, 4),
                SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 17, 4),
                SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 21)
                ) AS sikd_bidang_id_sikd_bidang,
                 sikd_bidang.`kd_bidang` AS sikd_bidang_kd_bidang,
                 sikd_bidang.`nm_bidang` AS sikd_bidang_nm_bidang,
                 IF(CONCAT_WS('-',
                SUBSTR(HEX(sikd_sub_skpd.id_sikd_sub_skpd), 1, 8),
                SUBSTR(HEX(sikd_sub_skpd.id_sikd_sub_skpd), 9, 4),
                SUBSTR(HEX(sikd_sub_skpd.id_sikd_sub_skpd), 13, 4),
                SUBSTR(HEX(sikd_sub_skpd.id_sikd_sub_skpd), 17, 4),
                SUBSTR(HEX(sikd_sub_skpd.id_sikd_sub_skpd), 21)
                ) IS NULL, sikd_satker.`kode`, sikd_sub_skpd.`kode`) AS sikd_satker_kode,
                 IF(CONCAT_WS('-',
                SUBSTR(HEX(sikd_sub_skpd.id_sikd_sub_skpd), 1, 8),
                SUBSTR(HEX(sikd_sub_skpd.id_sikd_sub_skpd), 9, 4),
                SUBSTR(HEX(sikd_sub_skpd.id_sikd_sub_skpd), 13, 4),
                SUBSTR(HEX(sikd_sub_skpd.id_sikd_sub_skpd), 17, 4),
                SUBSTR(HEX(sikd_sub_skpd.id_sikd_sub_skpd), 21)
                ) IS NULL, sikd_satker.`nama`, sikd_sub_skpd.`nama`) AS sikd_satker_nama,
                 CONCAT_WS('-',
                SUBSTR(HEX(sikd_prog.`id_sikd_prog`), 1, 8),
                SUBSTR(HEX(sikd_prog.`id_sikd_prog`), 9, 4),
                SUBSTR(HEX(sikd_prog.`id_sikd_prog`), 13, 4),
                SUBSTR(HEX(sikd_prog.`id_sikd_prog`), 17, 4),
                SUBSTR(HEX(sikd_prog.`id_sikd_prog`), 21)
                ) AS sikd_prog_id_sikd_prog,
                 sikd_prog.`kd_prog` AS sikd_prog_kd_prog,
                 sikd_prog.`nm_prog` AS sikd_prog_nm_prog,
                 CONCAT_WS('-',
                SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 1, 8),
                SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 9, 4),
                SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 13, 4),
                SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 17, 4),
                SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 21)
                ) AS sikd_kgtn_id_sikd_kgtn,
                 sikd_kgtn.`kd_kgtn` AS sikd_kgtn_kd_kgtn,
                 sikd_kgtn.`nm_kgtn` AS sikd_kgtn_nm_kgtn,
                 CONCAT_WS('-',
                SUBSTR(HEX(sikd_rek_akun.`id_sikd_rek_akun`), 1, 8),
                SUBSTR(HEX(sikd_rek_akun.`id_sikd_rek_akun`), 9, 4),
                SUBSTR(HEX(sikd_rek_akun.`id_sikd_rek_akun`), 13, 4),
                SUBSTR(HEX(sikd_rek_akun.`id_sikd_rek_akun`), 17, 4),
                SUBSTR(HEX(sikd_rek_akun.`id_sikd_rek_akun`), 21)
                ) AS sikd_rek_akun_id_sikd_rek_akun,
                 sikd_rek_akun.`kd_rek_akun` AS sikd_rek_akun_kd_rek_akun,
                 sikd_rek_akun.`nm_rek_akun` AS sikd_rek_akun_nm_rek_akun,
                 CONCAT_WS('-',
                SUBSTR(HEX(sikd_rek_kelompok.`id_sikd_rek_kelompok`), 1, 8),
                SUBSTR(HEX(sikd_rek_kelompok.`id_sikd_rek_kelompok`), 9, 4),
                SUBSTR(HEX(sikd_rek_kelompok.`id_sikd_rek_kelompok`), 13, 4),
                SUBSTR(HEX(sikd_rek_kelompok.`id_sikd_rek_kelompok`), 17, 4),
                SUBSTR(HEX(sikd_rek_kelompok.`id_sikd_rek_kelompok`), 21)
                ) AS sikd_rek_kelompok_id_sikd_rek_kelompok,
                 sikd_rek_kelompok.`kd_rek_kelompok` AS sikd_rek_kelompok_kd_rek_kelompok,
                 sikd_rek_kelompok.`nm_rek_kelompok` AS sikd_rek_kelompok_nm_rek_kelompok,
                 -- sikd_rek_kelompok.`dasar_hukum` AS sikd_rek_kelompok_dasar_hukum,
                 CONCAT_WS('-',
                SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 1, 8),
                SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 9, 4),
                SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 13, 4),
                SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 17, 4),
                SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 21)
                ) AS sikd_rek_jenis_id_sikd_rek_jenis,
                 sikd_rek_jenis.`kd_rek_jenis` AS sikd_rek_jenis_kd_rek_jenis,
                 sikd_rek_jenis.`nm_rek_jenis` AS sikd_rek_jenis_nm_rek_jenis,
                 sikd_rek_jenis.`dasar_hukum` AS sikd_rek_jenis_dasar_hukum,
                 CONCAT_WS('-',
                SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 1, 8),
                SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 9, 4),
                SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 13, 4),
                SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 17, 4),
                SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 21)
                ) AS sikd_rek_obj_id_sikd_rek_obj,
                 sikd_rek_obj.`kd_rek_obj` AS sikd_rek_obj_kd_rek_obj,
                 sikd_rek_obj.`nm_rek_obj` AS sikd_rek_obj_nm_rek_obj,
                 sikd_rek_obj.`dasar_hukum` AS sikd_rek_obj_dasar_hukum,
                 CONCAT_WS('-',
                SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 1, 8),
                SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 9, 4),
                SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 13, 4),
                SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 17, 4),
                SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 21)
                ) AS sikd_rek_rincian_obj_id_sikd_rek_rincian_obj,
                 sikd_rek_rincian_obj.`kd_rek_rincian_obj` AS sikd_rek_rincian_obj_kd_rek_rincian_obj,
                 sikd_rek_rincian_obj.`nm_rek_rincian_obj` AS sikd_rek_rincian_obj_nm_rek_rincian_obj,
                 sikd_rek_rincian_obj.`dasar_hukum` AS sikd_rek_rincian_obj_dasar_hukum,
                 CONCAT_WS('-',
                SUBSTR(HEX(rka_mata_anggaran.`id_rka_mata_anggaran`), 1, 8),
                SUBSTR(HEX(rka_mata_anggaran.`id_rka_mata_anggaran`), 9, 4),
                SUBSTR(HEX(rka_mata_anggaran.`id_rka_mata_anggaran`), 13, 4),
                SUBSTR(HEX(rka_mata_anggaran.`id_rka_mata_anggaran`), 17, 4),
                SUBSTR(HEX(rka_mata_anggaran.`id_rka_mata_anggaran`), 21)
                ) AS rka_mata_anggaran_id_rka_mata_anggaran,
                 rka_mata_anggaran.`jumlah` AS rka_mata_anggaran_jumlah
            FROM
                 `rapbd_rapbd` rapbd_rapbd 
                 INNER JOIN `rka_rka` rka_rka ON rka_rka.`rapbd_rapbd_id` = rapbd_rapbd.`id_rapbd_rapbd`
                 INNER JOIN `vw_rka_skpd_skpkd_all` rka_skpd ON rka_rka.`id_rka_rka` = rka_skpd.`rka_rka_id`
                 INNER JOIN `rka_mata_anggaran` rka_mata_anggaran ON rka_skpd.`rka_rka_id` = rka_mata_anggaran.`rka_rka`
                 INNER JOIN `sikd_bidang` sikd_bidang ON rka_skpd.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                 INNER JOIN `sikd_urusan` sikd_urusan ON sikd_bidang.`sikd_urusan_id` = sikd_urusan.`id_sikd_urusan`
                 INNER JOIN `sikd_satker` sikd_satker ON rka_skpd.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                 LEFT OUTER JOIN `rka_rka` rka_skpd_kgtn ON rka_mata_anggaran.`rka_rka` = rka_skpd_kgtn.`id_rka_rka` AND rka_skpd_kgtn.`rka_rka_type` = 'RkaSkpdKgtn'
                 INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON rka_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                 INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                 INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                 INNER JOIN `sikd_rek_kelompok` sikd_rek_kelompok ON sikd_rek_jenis.`sikd_rek_kelompok_id` = sikd_rek_kelompok.`id_sikd_rek_kelompok`
                 INNER JOIN `sikd_rek_akun` sikd_rek_akun ON sikd_rek_kelompok.`sikd_rek_akun_id` = sikd_rek_akun.`id_sikd_rek_akun`
                 LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON rka_skpd.`sikd_sub_satker_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                 LEFT OUTER JOIN `sikd_kgtn` sikd_kgtn ON rka_skpd_kgtn.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                 LEFT OUTER JOIN `sikd_prog` sikd_prog ON sikd_kgtn.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                 LEFT OUTER JOIN `sikd_sumber_anggaran` sikd_sumber_anggaran ON rka_mata_anggaran.`sikd_sumber_anggaran_id` = sikd_sumber_anggaran.`id_sikd_sumber_anggaran`
                 LEFT OUTER JOIN `sikd_fungsi` sikd_fungsi ON sikd_bidang.`sikd_fungsi_id` = sikd_fungsi.`id_sikd_fungsi`
            WHERE
                 rka_rka.rka_perubahan = '0'
                 AND rapbd_rapbd.`id_rapbd_rapbd` = :id_rapbd
                 AND if(:status_rka = 'Final',(rka_rka.`status_rka` = 1),(rka_rka.`status_rka` = 0 OR rka_rka.`status_rka` = 2))
            ORDER BY
                 sikd_fungsi.`kd_fungsi`,
                 sikd_bidang.`kd_bidang`,
                 sikd_satker.`kode`,
                 sikd_sub_skpd.`kode`,
                 sikd_prog.`kd_prog`,
                 sikd_kgtn.`kd_kgtn`,
                 sikd_rek_akun.`kd_rek_akun` ASC,
                 sikd_rek_kelompok.`kd_rek_kelompok` ASC,
                 sikd_rek_jenis.`kd_rek_jenis` ASC,
                 sikd_rek_obj.`kd_rek_obj` ASC,
                 sikd_rek_rincian_obj.`kd_rek_rincian_obj` ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rapbd", $idRapbd);
            $statement->bindValue("status_rka", $statusRka);
            $statement->execute();
            $rapbdLampPerda04 = $statement->fetchAll();

            return new JsonResponse($rapbdLampPerda04);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getLapPmkRingkasanApbd($request) {
        try {
            $idRapbd = $request->query->get("id_rapbd");
            $statusRka = $request->query->get("status_rka");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRapbd = pack('H*', str_replace('-', '', trim($idRapbd)));

            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                     sikd_rek_akun.`kd_rek_akun` AS sikd_rek_akun_kd_rek_akun,
                     sikd_rek_akun.`nm_rek_akun` AS sikd_rek_akun_nm_rek_akun,
                     sikd_rek_kelompok.`kd_rek_kelompok` AS sikd_rek_kelompok_kd_rek_kelompok,
                     sikd_rek_kelompok.`nm_rek_kelompok` AS sikd_rek_kelompok_nm_rek_kelompok,
                     sikd_rek_jenis.`kd_rek_jenis` AS sikd_rek_jenis_kd_rek_jenis,
                     sikd_rek_jenis.`nm_rek_jenis` AS sikd_rek_jenis_nm_rek_jenis,
                     sum(ifnull(rka_mata_anggaran.`jumlah`,0)) AS rka_mata_anggaran_jumlah,
                     if(sikd_rek_akun.`kd_rek_akun` in ('4','5'), 'rek_45', 'rek_6') AS jns_rek,
                     sum(if(sikd_rek_akun.`kd_rek_akun`='4',rka_mata_anggaran.`jumlah`,0)) AS jml_pendapatan,
                     sum(if(sikd_rek_akun.`kd_rek_akun`='5',rka_mata_anggaran.`jumlah`,0)) AS jml_belanja,
                     sum(if(sikd_rek_kelompok.`kd_rek_kelompok`='61',rka_mata_anggaran.`jumlah`,0)) AS jml_penerimaan,
                     sum(if(sikd_rek_kelompok.`kd_rek_kelompok`='62',rka_mata_anggaran.`jumlah`,0)) AS jml_pengeluaran,
                     sum(if(sikd_rek_akun.`kd_rek_akun`='4',rka_mata_anggaran.`jumlah`,0)-if(sikd_rek_akun.`kd_rek_akun`='5',rka_mata_anggaran.`jumlah`,0)) AS jml_surplus,
                     sum(if(sikd_rek_kelompok.`kd_rek_kelompok`='61',rka_mata_anggaran.`jumlah`,0)-if(sikd_rek_kelompok.`kd_rek_kelompok`='62',rka_mata_anggaran.`jumlah`,0)) AS jml_pembiayaan
                FROM
                     `rka_rka` rka_rka 
                     INNER JOIN `rka_mata_anggaran` rka_mata_anggaran ON rka_rka.`id_rka_rka` = rka_mata_anggaran.`rka_rka`
                     AND rka_rka.`rapbd_rapbd_id` = :id_rapbd
                     AND rka_rka.rka_perubahan = '0'
                     AND if(:status_rka = 'Final',(rka_rka.`status_rka` = 1),(rka_rka.`status_rka` = 0 OR rka_rka.`status_rka` = 2))
                     INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON rka_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                     INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                     INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                     INNER JOIN `sikd_rek_kelompok` sikd_rek_kelompok ON sikd_rek_jenis.`sikd_rek_kelompok_id` = sikd_rek_kelompok.`id_sikd_rek_kelompok`
                     INNER JOIN `sikd_rek_akun` sikd_rek_akun ON sikd_rek_kelompok.`sikd_rek_akun_id` = sikd_rek_akun.`id_sikd_rek_akun`
                     AND (sikd_rek_akun.`kd_rek_akun` IN ('4','5') OR sikd_rek_kelompok.`kd_rek_kelompok` IN ('61','62'))
                GROUP BY
                     sikd_rek_akun.`kd_rek_akun`,
                     sikd_rek_akun.`nm_rek_akun`,
                     sikd_rek_kelompok.`kd_rek_kelompok`,
                     sikd_rek_kelompok.`nm_rek_kelompok`,
                     sikd_rek_jenis.`kd_rek_jenis`,
                     sikd_rek_jenis.`nm_rek_jenis`,
                     jns_rek
                ORDER BY
                     sikd_rek_akun.`kd_rek_akun`,
                     sikd_rek_kelompok.`kd_rek_kelompok`,
                     sikd_rek_jenis.`kd_rek_jenis`";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rapbd", $idRapbd);
            $statement->bindValue("status_rka", $statusRka);
            $statement->execute();
            $rapbdLampPerda04 = $statement->fetchAll();

            return new JsonResponse($rapbdLampPerda04);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getLapPmkRingkasanApbdMak($request) {
        try {
            $idRapbd = $request->query->get("id_rapbd");
            $statusRka = $request->query->get("status_rka");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRapbd = pack('H*', str_replace('-', '', trim($idRapbd)));

            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                     sikd_rek_akun.`kd_rek_akun` AS sikd_rek_akun_kd_rek_akun,
                     sikd_rek_akun.`nm_rek_akun` AS sikd_rek_akun_nm_rek_akun,
                     sikd_rek_kelompok.`kd_rek_kelompok` AS sikd_rek_kelompok_kd_rek_kelompok_,
                     concat(substring(sikd_rek_kelompok.`kd_rek_kelompok`,1,1),'.',substring(sikd_rek_kelompok.`kd_rek_kelompok`,2,1)) AS sikd_rek_kelompok_kd_rek_kelompok,
                     sikd_rek_kelompok.`nm_rek_kelompok` AS sikd_rek_kelompok_nm_rek_kelompok,
                     sikd_rek_jenis.`kd_rek_jenis` AS sikd_rek_jenis_kd_rek_jenis_,
                     concat(substring(sikd_rek_jenis.`kd_rek_jenis`,1,1),'.',substring(sikd_rek_jenis.`kd_rek_jenis`,2,1),'.',substring(sikd_rek_jenis.`kd_rek_jenis`,3,1)) AS sikd_rek_jenis_kd_rek_jenis,
                     sikd_rek_jenis.`nm_rek_jenis` AS sikd_rek_jenis_nm_rek_jenis,
                     sum(ifnull(rka_mata_anggaran.`jumlah`,0)) AS rka_mata_anggaran_jumlah,
                     if(sikd_rek_akun.`kd_rek_akun` in ('4','5'), 'rek_45', 'rek_6') AS jns_rek,
                     sum(if(sikd_rek_akun.`kd_rek_akun`='4',rka_mata_anggaran.`jumlah`,0)) AS jml_pendapatan,
                     sum(if(sikd_rek_akun.`kd_rek_akun`='5',rka_mata_anggaran.`jumlah`,0)) AS jml_belanja,
                     sum(if(sikd_rek_kelompok.`kd_rek_kelompok`='61',rka_mata_anggaran.`jumlah`,0)) AS jml_penerimaan,
                     sum(if(sikd_rek_kelompok.`kd_rek_kelompok`='62',rka_mata_anggaran.`jumlah`,0)) AS jml_pengeluaran,
                     sum(if(sikd_rek_akun.`kd_rek_akun`='4',rka_mata_anggaran.`jumlah`,0)-if(sikd_rek_akun.`kd_rek_akun`='5',rka_mata_anggaran.`jumlah`,0)) AS jml_surplus,
                     sum(if(sikd_rek_kelompok.`kd_rek_kelompok`='61',rka_mata_anggaran.`jumlah`,0)-if(sikd_rek_kelompok.`kd_rek_kelompok`='62',rka_mata_anggaran.`jumlah`,0)) AS jml_pembiayaan
                FROM
                     `rka_rka` rka_rka 
                     INNER JOIN `rka_mata_anggaran` rka_mata_anggaran ON rka_rka.`id_rka_rka` = rka_mata_anggaran.`rka_rka`
                     AND rka_rka.`rapbd_rapbd_id` = :id_rapbd
                     AND rka_rka.rka_perubahan = '0'
                     AND if(:status_rka = 'Final',(rka_rka.`status_rka` = 1),(rka_rka.`status_rka` = 0 OR rka_rka.`status_rka` = 2))
                     INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON rka_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                     INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                     INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                     INNER JOIN `sikd_rek_kelompok` sikd_rek_kelompok ON sikd_rek_jenis.`sikd_rek_kelompok_id` = sikd_rek_kelompok.`id_sikd_rek_kelompok`
                     INNER JOIN `sikd_rek_akun` sikd_rek_akun ON sikd_rek_kelompok.`sikd_rek_akun_id` = sikd_rek_akun.`id_sikd_rek_akun`
                     AND (sikd_rek_akun.`kd_rek_akun` IN ('4','5') OR sikd_rek_kelompok.`kd_rek_kelompok` IN ('61','62'))
                GROUP BY
                     sikd_rek_akun.`kd_rek_akun`,
                     sikd_rek_akun.`nm_rek_akun`,
                     sikd_rek_kelompok.`kd_rek_kelompok`,
                     sikd_rek_kelompok.`nm_rek_kelompok`,
                     sikd_rek_jenis.`kd_rek_jenis`,
                     sikd_rek_jenis.`nm_rek_jenis`,
                     jns_rek
                ORDER BY
                     sikd_rek_akun.`kd_rek_akun`,
                     sikd_rek_kelompok.`kd_rek_kelompok`,
                     sikd_rek_jenis.`kd_rek_jenis`";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rapbd", $idRapbd);
            $statement->bindValue("status_rka", $statusRka);
            $statement->execute();
            $rapbdLampPerda04 = $statement->fetchAll();

            return new JsonResponse($rapbdLampPerda04);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getLapPmk072a2($request) {
        try {
            $idRapbd = $request->query->get("id_rapbd");
            $statusRka = $request->query->get("status_rka");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRapbd = pack('H*', str_replace('-', '', trim($idRapbd)));

            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                    CONCAT_WS('-',
                    SUBSTR(HEX(sikd_rek_akun.`id_sikd_rek_akun`), 1, 8),
                    SUBSTR(HEX(sikd_rek_akun.`id_sikd_rek_akun`), 9, 4),
                    SUBSTR(HEX(sikd_rek_akun.`id_sikd_rek_akun`), 13, 4),
                    SUBSTR(HEX(sikd_rek_akun.`id_sikd_rek_akun`), 17, 4),
                    SUBSTR(HEX(sikd_rek_akun.`id_sikd_rek_akun`), 21)
                    ) AS sikd_rek_akun_id_sikd_rek_akun,
                     sikd_rek_akun.`kd_rek_akun` AS sikd_rek_akun_kd_rek_akun,
                     sikd_rek_akun.`nm_rek_akun` AS sikd_rek_akun_nm_rek_akun,
                    CONCAT_WS('-',
                    SUBSTR(HEX(sikd_rek_kelompok.`id_sikd_rek_kelompok`), 1, 8),
                    SUBSTR(HEX(sikd_rek_kelompok.`id_sikd_rek_kelompok`), 9, 4),
                    SUBSTR(HEX(sikd_rek_kelompok.`id_sikd_rek_kelompok`), 13, 4),
                    SUBSTR(HEX(sikd_rek_kelompok.`id_sikd_rek_kelompok`), 17, 4),
                    SUBSTR(HEX(sikd_rek_kelompok.`id_sikd_rek_kelompok`), 21)
                    ) AS sikd_rek_kelompok_id_sikd_rek_kelompok,
                     SUBSTR(sikd_rek_kelompok.`kd_rek_kelompok`,2,1) AS sikd_rek_kelompok_kd_rek_kelompok,
                     sikd_rek_kelompok.`nm_rek_kelompok` AS sikd_rek_kelompok_nm_rek_kelompok,
                     -- sikd_rek_kelompok.`dasar_hukum` AS sikd_rek_kelompok_dasar_hukum,
                     CONCAT_WS('-',
                    SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 1, 8),
                    SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 9, 4),
                    SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 13, 4),
                    SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 17, 4),
                    SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 21)
                    ) AS sikd_rek_jenis_id_sikd_rek_jenis,
                     SUBSTR(sikd_rek_jenis.`kd_rek_jenis`,3,1) AS sikd_rek_jenis_kd_rek_jenis,
                     sikd_rek_jenis.`nm_rek_jenis` AS sikd_rek_jenis_nm_rek_jenis,
                     sikd_rek_jenis.`dasar_hukum` AS sikd_rek_jenis_dasar_hukum,
                     CONCAT_WS('-',
                    SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 1, 8),
                    SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 9, 4),
                    SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 13, 4),
                    SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 17, 4),
                    SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 21)
                    ) AS sikd_rek_obj_id_sikd_rek_obj,
                     SUBSTR(sikd_rek_obj.`kd_rek_obj`,4,2) AS sikd_rek_obj_kd_rek_obj,
                     sikd_rek_obj.`nm_rek_obj` AS sikd_rek_obj_nm_rek_obj,
                     sikd_rek_obj.`dasar_hukum` AS sikd_rek_obj_dasar_hukum,
                     CONCAT_WS('-',
                    SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 1, 8),
                    SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 9, 4),
                    SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 13, 4),
                    SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 17, 4),
                    SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 21)
                    ) AS sikd_rek_rincian_obj_id_sikd_rek_rincian_obj,
                     SUBSTR(sikd_rek_rincian_obj.`kd_rek_rincian_obj`,6,2) AS sikd_rek_rincian_obj_kd_rek_rincian_obj,
                     sikd_rek_rincian_obj.`nm_rek_rincian_obj` AS sikd_rek_rincian_obj_nm_rek_rincian_obj,
                     IF(rka_mata_anggaran.`dasar_hukum` = '', sikd_rek_rincian_obj.`dasar_hukum`, 
                    rka_mata_anggaran.`dasar_hukum`) AS rka_mata_anggaran_dasar_hukum,
                     SUM(rka_mata_anggaran.`jumlah`)AS rka_mata_anggaran_jumlah
                FROM
                     `sikd_rek_rincian_obj` sikd_rek_rincian_obj 
                     INNER JOIN `rka_mata_anggaran` rka_mata_anggaran ON sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj` = rka_mata_anggaran.`sikd_rek_rincian_obj_id`
                     INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                     INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                     INNER JOIN `sikd_rek_kelompok` sikd_rek_kelompok ON sikd_rek_jenis.`sikd_rek_kelompok_id` = sikd_rek_kelompok.`id_sikd_rek_kelompok`
                     INNER JOIN `sikd_rek_akun` sikd_rek_akun ON sikd_rek_kelompok.`sikd_rek_akun_id` = sikd_rek_akun.`id_sikd_rek_akun`
                     INNER JOIN `rka_rka` rka_rka ON rka_mata_anggaran.`rka_rka` = rka_rka.`id_rka_rka`
                WHERE
                     sikd_rek_akun.kd_rek_akun = '4'
                 AND rka_rka.`rapbd_rapbd_id` = :id_rapbd
                 AND rka_rka.rka_perubahan = '0'
                 AND if(:status_rka = 'Final',(rka_rka.`status_rka` = 1),(rka_rka.`status_rka` = 0 OR rka_rka.`status_rka` = 2))
                GROUP BY
                     sikd_rek_akun_id_sikd_rek_akun,
                     sikd_rek_kelompok_id_sikd_rek_kelompok,
                     sikd_rek_jenis_id_sikd_rek_jenis,
                     sikd_rek_obj_id_sikd_rek_obj,
                     sikd_rek_rincian_obj_id_sikd_rek_rincian_obj
                ORDER BY
                     sikd_rek_rincian_obj.`kd_rek_rincian_obj` ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rapbd", $idRapbd);
            $statement->bindValue("status_rka", $statusRka);
            $statement->execute();
            $rapbdLampPerda04 = $statement->fetchAll();

            return new JsonResponse($rapbdLampPerda04);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getLapPmk072b1($request) {
        try {
            $idRapbd = $request->query->get("id_rapbd");
            $statusRka = $request->query->get("status_rka");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRapbd = pack('H*', str_replace('-', '', trim($idRapbd)));

            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                     CONCAT_WS('-',
                    SUBSTR(HEX(sikd_fungsi.`id_sikd_fungsi`), 1, 8),
                    SUBSTR(HEX(sikd_fungsi.`id_sikd_fungsi`), 9, 4),
                    SUBSTR(HEX(sikd_fungsi.`id_sikd_fungsi`), 13, 4),
                    SUBSTR(HEX(sikd_fungsi.`id_sikd_fungsi`), 17, 4),
                    SUBSTR(HEX(sikd_fungsi.`id_sikd_fungsi`), 21)
                    ) AS sikd_fungsi_id_sikd_fungsi,
                     sikd_fungsi.`kd_fungsi` AS sikd_fungsi_kd_fungsi,
                     sikd_fungsi.`nm_fungsi` AS sikd_fungsi_nm_fungsi,
                     CONCAT_WS('-',
                    SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 1, 8),
                    SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 9, 4),
                    SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 13, 4),
                    SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 17, 4),
                    SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 21)
                    ) AS sikd_bidang_id_sikd_bidang,
                     sikd_bidang.`kd_bidang` AS sikd_bidang_kd_bidang,
                     sikd_bidang.`nm_bidang` AS sikd_bidang_nm_bidang,
                     CONCAT_WS('-',
                    SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 1, 8),
                    SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 9, 4),
                    SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 13, 4),
                    SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 17, 4),
                    SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 21)
                    ) AS sikd_satker_id_sikd_satker,
                     CONCAT_WS('-',
                    SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 1, 8),
                    SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 9, 4),
                    SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 13, 4),
                    SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 17, 4),
                    SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 21)
                    ) AS sikd_sub_skpd_id_sikd_sub_skpd,
                     IF(CONCAT_WS('-',
                    SUBSTR(HEX(sikd_sub_skpd.id_sikd_sub_skpd), 1, 8),
                    SUBSTR(HEX(sikd_sub_skpd.id_sikd_sub_skpd), 9, 4),
                    SUBSTR(HEX(sikd_sub_skpd.id_sikd_sub_skpd), 13, 4),
                    SUBSTR(HEX(sikd_sub_skpd.id_sikd_sub_skpd), 17, 4),
                    SUBSTR(HEX(sikd_sub_skpd.id_sikd_sub_skpd), 21)
                    ) IS NULL, sikd_satker.`kode`, sikd_sub_skpd.`kode`) AS sikd_satker_kode,
                     IF(CONCAT_WS('-',
                    SUBSTR(HEX(sikd_sub_skpd.id_sikd_sub_skpd), 1, 8),
                    SUBSTR(HEX(sikd_sub_skpd.id_sikd_sub_skpd), 9, 4),
                    SUBSTR(HEX(sikd_sub_skpd.id_sikd_sub_skpd), 13, 4),
                    SUBSTR(HEX(sikd_sub_skpd.id_sikd_sub_skpd), 17, 4),
                    SUBSTR(HEX(sikd_sub_skpd.id_sikd_sub_skpd), 21)
                    ) IS NULL, sikd_satker.`nama`, sikd_sub_skpd.`nama`) AS sikd_satker_nama,
                     sikd_sub_skpd.`kode` AS sikd_sub_skpd_kode,
                     sikd_sub_skpd.`nama` AS sikd_sub_skpd_nama,
                     SUM(IF(sikd_rek_jenis.`kd_rek_jenis` = '511', rka_mata_anggaran.`jumlah`, 0)) AS jml_511,
                     SUM(IF(sikd_rek_jenis.`kd_rek_jenis` = '512', rka_mata_anggaran.`jumlah`, 0)) AS jml_512,
                     SUM(IF(sikd_rek_jenis.`kd_rek_jenis` = '513', rka_mata_anggaran.`jumlah`, 0)) AS jml_513,
                     SUM(IF(sikd_rek_jenis.`kd_rek_jenis` = '514', rka_mata_anggaran.`jumlah`, 0)) AS jml_514,
                     SUM(IF(sikd_rek_jenis.`kd_rek_jenis` = '515', rka_mata_anggaran.`jumlah`, 0)) AS jml_515,
                     SUM(IF(sikd_rek_jenis.`kd_rek_jenis` = '516', rka_mata_anggaran.`jumlah`, 0)) AS jml_516,
                     SUM(IF(sikd_rek_jenis.`kd_rek_jenis` = '517', rka_mata_anggaran.`jumlah`, 0)) AS jml_517,
                     SUM(IF(sikd_rek_jenis.`kd_rek_jenis` = '518', rka_mata_anggaran.`jumlah`, 0)) AS jml_518,
                     SUM(IF(sikd_rek_jenis.`kd_rek_jenis` = '521', rka_mata_anggaran.`jumlah`, 0)) AS jml_521,
                     SUM(IF(sikd_rek_jenis.`kd_rek_jenis` = '522', rka_mata_anggaran.`jumlah`, 0)) AS jml_522,
                     SUM(IF(sikd_rek_jenis.`kd_rek_jenis` = '523', rka_mata_anggaran.`jumlah`, 0)) AS jml_523,
                     SUM(rka_mata_anggaran.`jumlah`) AS jml_total
                FROM
                     `rka_mata_anggaran` rka_mata_anggaran 
                     INNER JOIN `vw_rka_skpd_skpkd_all` vw_rka_skpd_skpkd_all ON rka_mata_anggaran.`rka_rka` = vw_rka_skpd_skpkd_all.`rka_rka_id`
                     LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON vw_rka_skpd_skpkd_all.`sikd_sub_satker_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                     INNER JOIN `sikd_satker` sikd_satker ON vw_rka_skpd_skpkd_all.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                     INNER JOIN `sikd_bidang` sikd_bidang ON vw_rka_skpd_skpkd_all.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                     INNER JOIN `sikd_fungsi` sikd_fungsi ON sikd_bidang.`sikd_fungsi_id` = sikd_fungsi.`id_sikd_fungsi`
                     INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON rka_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                     INNER JOIN `rka_rka` rka_rka ON rka_mata_anggaran.`rka_rka` = rka_rka.`id_rka_rka`
                     INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                     INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                     INNER JOIN `sikd_rek_kelompok` sikd_rek_kelompok ON sikd_rek_jenis.`sikd_rek_kelompok_id` = sikd_rek_kelompok.`id_sikd_rek_kelompok`
                     INNER JOIN `sikd_rek_akun` sikd_rek_akun ON sikd_rek_kelompok.`sikd_rek_akun_id` = sikd_rek_akun.`id_sikd_rek_akun`
                WHERE
                     sikd_rek_akun.kd_rek_akun = '5'
                     AND rka_rka.rka_perubahan = '0'
                     AND rka_rka.rapbd_rapbd_id = :id_rapbd
                     AND if(:status_rka = 'Final',(rka_rka.`status_rka` = 1),(rka_rka.`status_rka` = 0 OR rka_rka.`status_rka` = 2))
                GROUP BY
                     sikd_fungsi_id_sikd_fungsi,
                     sikd_bidang_id_sikd_bidang,
                     sikd_satker_id_sikd_satker,
                     sikd_sub_skpd_id_sikd_sub_skpd
                ORDER BY
                     sikd_fungsi.`kd_fungsi` ASC,
                     sikd_bidang.`kd_bidang` ASC,
                     sikd_satker.`kode` ASC,
                     sikd_sub_skpd.`kode` ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rapbd", $idRapbd);
            $statement->bindValue("status_rka", $statusRka);
            $statement->execute();
            $rapbdLampPerda04 = $statement->fetchAll();

            return new JsonResponse($rapbdLampPerda04);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getLapPmk072b1a($request) {
        try {
            $idRapbd = $request->query->get("id_rapbd");
            $statusRka = $request->query->get("status_rka");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRapbd = pack('H*', str_replace('-', '', trim($idRapbd)));

            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                     CONCAT_WS('-',
                    SUBSTR(HEX(sikd_rek_akun.`id_sikd_rek_akun`), 1, 8),
                    SUBSTR(HEX(sikd_rek_akun.`id_sikd_rek_akun`), 9, 4),
                    SUBSTR(HEX(sikd_rek_akun.`id_sikd_rek_akun`), 13, 4),
                    SUBSTR(HEX(sikd_rek_akun.`id_sikd_rek_akun`), 17, 4),
                    SUBSTR(HEX(sikd_rek_akun.`id_sikd_rek_akun`), 21)
                    ) AS sikd_rek_akun_id_sikd_rek_akun,
                     sikd_rek_akun.`kd_rek_akun` AS sikd_rek_akun_kd_rek_akun,
                     sikd_rek_akun.`nm_rek_akun` AS sikd_rek_akun_nm_rek_akun,
                     CONCAT_WS('-',
                    SUBSTR(HEX(sikd_rek_kelompok.`id_sikd_rek_kelompok`), 1, 8),
                    SUBSTR(HEX(sikd_rek_kelompok.`id_sikd_rek_kelompok`), 9, 4),
                    SUBSTR(HEX(sikd_rek_kelompok.`id_sikd_rek_kelompok`), 13, 4),
                    SUBSTR(HEX(sikd_rek_kelompok.`id_sikd_rek_kelompok`), 17, 4),
                    SUBSTR(HEX(sikd_rek_kelompok.`id_sikd_rek_kelompok`), 21)
                    ) AS sikd_rek_kelompok_id_sikd_rek_kelompok,
                     SUBSTR(sikd_rek_kelompok.`kd_rek_kelompok`,2,1) AS sikd_rek_kelompok_kd_rek_kelompok,
                     sikd_rek_kelompok.`nm_rek_kelompok` AS sikd_rek_kelompok_nm_rek_kelompok,
                     -- sikd_rek_kelompok.`dasar_hukum` AS sikd_rek_kelompok_dasar_hukum,
                     CONCAT_WS('-',
                    SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 1, 8),
                    SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 9, 4),
                    SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 13, 4),
                    SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 17, 4),
                    SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 21)
                    ) AS sikd_rek_jenis_id_sikd_rek_jenis,
                     SUBSTR(sikd_rek_jenis.`kd_rek_jenis`,3,1) AS sikd_rek_jenis_kd_rek_jenis,
                     sikd_rek_jenis.`nm_rek_jenis` AS sikd_rek_jenis_nm_rek_jenis,
                     sikd_rek_jenis.`dasar_hukum` AS sikd_rek_jenis_dasar_hukum,
                     CONCAT_WS('-',
                    SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 1, 8),
                    SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 9, 4),
                    SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 13, 4),
                    SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 17, 4),
                    SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 21)
                    ) AS sikd_rek_obj_id_sikd_rek_obj,
                     SUBSTR(sikd_rek_obj.`kd_rek_obj`,4,2) AS sikd_rek_obj_kd_rek_obj,
                     sikd_rek_obj.`nm_rek_obj` AS sikd_rek_obj_nm_rek_obj,
                     sikd_rek_obj.`dasar_hukum` AS sikd_rek_obj_dasar_hukum,
                     CONCAT_WS('-',
                    SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 1, 8),
                    SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 9, 4),
                    SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 13, 4),
                    SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 17, 4),
                    SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 21)
                    ) AS sikd_rek_rincian_obj_id_sikd_rek_rincian_obj,
                     SUBSTR(sikd_rek_rincian_obj.`kd_rek_rincian_obj`,6,2) AS sikd_rek_rincian_obj_kd_rek_rincian_obj,
                     sikd_rek_rincian_obj.`nm_rek_rincian_obj` AS sikd_rek_rincian_obj_nm_rek_rincian_obj,
                     IF(rka_mata_anggaran.`dasar_hukum` = '', sikd_rek_rincian_obj.`dasar_hukum`, 
                    rka_mata_anggaran.`dasar_hukum`) AS rka_mata_anggaran_dasar_hukum,
                     SUM(rka_mata_anggaran.`jumlah`)AS rka_mata_anggaran_jumlah
                FROM
                     `sikd_rek_rincian_obj` sikd_rek_rincian_obj 
                     INNER JOIN `rka_mata_anggaran` rka_mata_anggaran ON sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj` = rka_mata_anggaran.`sikd_rek_rincian_obj_id`
                     INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                     INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                     INNER JOIN `sikd_rek_kelompok` sikd_rek_kelompok ON sikd_rek_jenis.`sikd_rek_kelompok_id` = sikd_rek_kelompok.`id_sikd_rek_kelompok`
                     INNER JOIN `sikd_rek_akun` sikd_rek_akun ON sikd_rek_kelompok.`sikd_rek_akun_id` = sikd_rek_akun.`id_sikd_rek_akun`
                     INNER JOIN `rka_rka` rka_rka ON rka_mata_anggaran.`rka_rka` = rka_rka.`id_rka_rka`
                WHERE
                     sikd_rek_jenis.kd_rek_jenis = '523'
                 AND rka_rka.`rapbd_rapbd_id` = :id_rapbd
                 AND rka_rka.rka_perubahan = '0'
                 AND if(:status_rka = 'Final',(rka_rka.`status_rka` = 1),(rka_rka.`status_rka` = 0 OR rka_rka.`status_rka` = 2))
                GROUP BY
                     sikd_rek_akun_id_sikd_rek_akun,
                     sikd_rek_kelompok_id_sikd_rek_kelompok,
                     sikd_rek_jenis_id_sikd_rek_jenis,
                     sikd_rek_obj_id_sikd_rek_obj,
                     sikd_rek_rincian_obj_id_sikd_rek_rincian_obj
                ORDER BY
                     sikd_rek_rincian_obj.`kd_rek_rincian_obj` ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rapbd", $idRapbd);
            $statement->bindValue("status_rka", $statusRka);
            $statement->execute();
            $rapbdLampPerda04 = $statement->fetchAll();

            return new JsonResponse($rapbdLampPerda04);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getLapPmk072b2($request) {
        try {
            $idRapbd = $request->query->get("id_rapbd");
            $statusRka = $request->query->get("status_rka");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRapbd = pack('H*', str_replace('-', '', trim($idRapbd)));

            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                     CONCAT_WS('-',
                    SUBSTR(HEX(sikd_rek_akun.`id_sikd_rek_akun`), 1, 8),
                    SUBSTR(HEX(sikd_rek_akun.`id_sikd_rek_akun`), 9, 4),
                    SUBSTR(HEX(sikd_rek_akun.`id_sikd_rek_akun`), 13, 4),
                    SUBSTR(HEX(sikd_rek_akun.`id_sikd_rek_akun`), 17, 4),
                    SUBSTR(HEX(sikd_rek_akun.`id_sikd_rek_akun`), 21)
                    ) AS sikd_rek_akun_id_sikd_rek_akun,
                     sikd_rek_akun.`kd_rek_akun` AS sikd_rek_akun_kd_rek_akun,
                     sikd_rek_akun.`nm_rek_akun` AS sikd_rek_akun_nm_rek_akun,
                     CONCAT_WS('-',
                    SUBSTR(HEX(sikd_rek_kelompok.`id_sikd_rek_kelompok`), 1, 8),
                    SUBSTR(HEX(sikd_rek_kelompok.`id_sikd_rek_kelompok`), 9, 4),
                    SUBSTR(HEX(sikd_rek_kelompok.`id_sikd_rek_kelompok`), 13, 4),
                    SUBSTR(HEX(sikd_rek_kelompok.`id_sikd_rek_kelompok`), 17, 4),
                    SUBSTR(HEX(sikd_rek_kelompok.`id_sikd_rek_kelompok`), 21)
                    ) AS sikd_rek_kelompok_id_sikd_rek_kelompok,
                     SUBSTR(sikd_rek_kelompok.`kd_rek_kelompok`,2,1) AS sikd_rek_kelompok_kd_rek_kelompok,
                     sikd_rek_kelompok.`nm_rek_kelompok` AS sikd_rek_kelompok_nm_rek_kelompok,
                     -- sikd_rek_kelompok.`dasar_hukum` AS sikd_rek_kelompok_dasar_hukum,
                     CONCAT_WS('-',
                    SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 1, 8),
                    SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 9, 4),
                    SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 13, 4),
                    SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 17, 4),
                    SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 21)
                    ) AS sikd_rek_jenis_id_sikd_rek_jenis,
                     SUBSTR(sikd_rek_jenis.`kd_rek_jenis`,3,1) AS sikd_rek_jenis_kd_rek_jenis,
                     sikd_rek_jenis.`nm_rek_jenis` AS sikd_rek_jenis_nm_rek_jenis,
                     sikd_rek_jenis.`dasar_hukum` AS sikd_rek_jenis_dasar_hukum,
                     CONCAT_WS('-',
                    SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 1, 8),
                    SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 9, 4),
                    SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 13, 4),
                    SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 17, 4),
                    SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 21)
                    ) AS sikd_rek_obj_id_sikd_rek_obj,
                     SUBSTR(sikd_rek_obj.`kd_rek_obj`,4,2) AS sikd_rek_obj_kd_rek_obj,
                     sikd_rek_obj.`nm_rek_obj` AS sikd_rek_obj_nm_rek_obj,
                     sikd_rek_obj.`dasar_hukum` AS sikd_rek_obj_dasar_hukum,
                     CONCAT_WS('-',
                    SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 1, 8),
                    SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 9, 4),
                    SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 13, 4),
                    SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 17, 4),
                    SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 21)
                    ) AS sikd_rek_rincian_obj_id_sikd_rek_rincian_obj,
                     SUBSTR(sikd_rek_rincian_obj.`kd_rek_rincian_obj`,6,2) AS sikd_rek_rincian_obj_kd_rek_rincian_obj,
                     sikd_rek_rincian_obj.`nm_rek_rincian_obj` AS sikd_rek_rincian_obj_nm_rek_rincian_obj,
                     IF(rka_mata_anggaran.`dasar_hukum` = '', sikd_rek_rincian_obj.`dasar_hukum`, 
                    rka_mata_anggaran.`dasar_hukum`) AS rka_mata_anggaran_dasar_hukum,
                     SUM(rka_mata_anggaran.`jumlah`)AS rka_mata_anggaran_jumlah
                FROM
                     `sikd_rek_rincian_obj` sikd_rek_rincian_obj
                     INNER JOIN `rka_mata_anggaran` rka_mata_anggaran ON sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj` = rka_mata_anggaran.`sikd_rek_rincian_obj_id`
                     INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                     INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                     INNER JOIN `sikd_rek_kelompok` sikd_rek_kelompok ON sikd_rek_jenis.`sikd_rek_kelompok_id` = sikd_rek_kelompok.`id_sikd_rek_kelompok`
                     INNER JOIN `sikd_rek_akun` sikd_rek_akun ON sikd_rek_kelompok.`sikd_rek_akun_id` = sikd_rek_akun.`id_sikd_rek_akun`
                     INNER JOIN `rka_rka` rka_rka ON rka_mata_anggaran.`rka_rka` = rka_rka.`id_rka_rka`
                WHERE
                     sikd_rek_jenis.kd_rek_jenis = '511'
                 AND rka_rka.rka_perubahan = '0'
                 AND rka_rka.`rapbd_rapbd_id` = :id_rapbd
                 AND if(:status_rka = 'Final',(rka_rka.`status_rka` = 1),(rka_rka.`status_rka` = 0 OR rka_rka.`status_rka` = 2))
                GROUP BY
                     sikd_rek_akun_id_sikd_rek_akun,
                     sikd_rek_kelompok_id_sikd_rek_kelompok,
                     sikd_rek_jenis_id_sikd_rek_jenis,
                     sikd_rek_obj_id_sikd_rek_obj,
                     sikd_rek_rincian_obj_id_sikd_rek_rincian_obj
                ORDER BY
                     sikd_rek_rincian_obj.`kd_rek_rincian_obj` ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rapbd", $idRapbd);
            $statement->bindValue("status_rka", $statusRka);
            $statement->execute();
            $rapbdLampPerda04 = $statement->fetchAll();

            return new JsonResponse($rapbdLampPerda04);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getLapPmk072c1($request) {
        try {
            $idRapbd = $request->query->get("id_rapbd");
            $statusRka = $request->query->get("status_rka");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRapbd = pack('H*', str_replace('-', '', trim($idRapbd)));

            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                     CONCAT_WS('-',
                    SUBSTR(HEX(sikd_rek_akun.`id_sikd_rek_akun`), 1, 8),
                    SUBSTR(HEX(sikd_rek_akun.`id_sikd_rek_akun`), 9, 4),
                    SUBSTR(HEX(sikd_rek_akun.`id_sikd_rek_akun`), 13, 4),
                    SUBSTR(HEX(sikd_rek_akun.`id_sikd_rek_akun`), 17, 4),
                    SUBSTR(HEX(sikd_rek_akun.`id_sikd_rek_akun`), 21)
                    ) AS sikd_rek_akun_id_sikd_rek_akun,
                     sikd_rek_akun.`kd_rek_akun` AS sikd_rek_akun_kd_rek_akun,
                     sikd_rek_akun.`nm_rek_akun` AS sikd_rek_akun_nm_rek_akun,
                     CONCAT_WS('-',
                    SUBSTR(HEX(sikd_rek_kelompok.`id_sikd_rek_kelompok`), 1, 8),
                    SUBSTR(HEX(sikd_rek_kelompok.`id_sikd_rek_kelompok`), 9, 4),
                    SUBSTR(HEX(sikd_rek_kelompok.`id_sikd_rek_kelompok`), 13, 4),
                    SUBSTR(HEX(sikd_rek_kelompok.`id_sikd_rek_kelompok`), 17, 4),
                    SUBSTR(HEX(sikd_rek_kelompok.`id_sikd_rek_kelompok`), 21)
                    ) AS sikd_rek_kelompok_id_sikd_rek_kelompok,
                     SUBSTR(sikd_rek_kelompok.`kd_rek_kelompok`,2,1) AS sikd_rek_kelompok_kd_rek_kelompok,
                     sikd_rek_kelompok.`nm_rek_kelompok` AS sikd_rek_kelompok_nm_rek_kelompok,
                     -- sikd_rek_kelompok.`dasar_hukum` AS sikd_rek_kelompok_dasar_hukum,
                     CONCAT_WS('-',
                    SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 1, 8),
                    SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 9, 4),
                    SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 13, 4),
                    SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 17, 4),
                    SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 21)
                    ) AS sikd_rek_jenis_id_sikd_rek_jenis,
                     SUBSTR(sikd_rek_jenis.`kd_rek_jenis`,3,1) AS sikd_rek_jenis_kd_rek_jenis,
                     sikd_rek_jenis.`nm_rek_jenis` AS sikd_rek_jenis_nm_rek_jenis,
                     sikd_rek_jenis.`dasar_hukum` AS sikd_rek_jenis_dasar_hukum,
                     CONCAT_WS('-',
                    SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 1, 8),
                    SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 9, 4),
                    SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 13, 4),
                    SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 17, 4),
                    SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 21)
                    ) AS sikd_rek_obj_id_sikd_rek_obj,
                     SUBSTR(sikd_rek_obj.`kd_rek_obj`,4,2) AS sikd_rek_obj_kd_rek_obj,
                     sikd_rek_obj.`nm_rek_obj` AS sikd_rek_obj_nm_rek_obj,
                     sikd_rek_obj.`dasar_hukum` AS sikd_rek_obj_dasar_hukum,
                     CONCAT_WS('-',
                    SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 1, 8),
                    SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 9, 4),
                    SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 13, 4),
                    SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 17, 4),
                    SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 21)
                    ) AS sikd_rek_rincian_obj_id_sikd_rek_rincian_obj,
                     SUBSTR(sikd_rek_rincian_obj.`kd_rek_rincian_obj`,6,2) AS sikd_rek_rincian_obj_kd_rek_rincian_obj,
                     sikd_rek_rincian_obj.`nm_rek_rincian_obj` AS sikd_rek_rincian_obj_nm_rek_rincian_obj,
                     IF(rka_mata_anggaran.`dasar_hukum` = '', sikd_rek_rincian_obj.`dasar_hukum`, 
                    rka_mata_anggaran.`dasar_hukum`) AS rka_mata_anggaran_dasar_hukum,
                     SUM(rka_mata_anggaran.`jumlah`)AS rka_mata_anggaran_jumlah
                FROM
                     `sikd_rek_rincian_obj` sikd_rek_rincian_obj 
                     INNER JOIN `rka_mata_anggaran` rka_mata_anggaran ON sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj` = rka_mata_anggaran.`sikd_rek_rincian_obj_id`
                     INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                     INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                     INNER JOIN `sikd_rek_kelompok` sikd_rek_kelompok ON sikd_rek_jenis.`sikd_rek_kelompok_id` = sikd_rek_kelompok.`id_sikd_rek_kelompok`
                     INNER JOIN `sikd_rek_akun` sikd_rek_akun ON sikd_rek_kelompok.`sikd_rek_akun_id` = sikd_rek_akun.`id_sikd_rek_akun`
                     INNER JOIN `rka_rka` rka_rka ON rka_mata_anggaran.`rka_rka` = rka_rka.`id_rka_rka`
                WHERE
                     sikd_rek_akun.kd_rek_akun = '6'
                 AND rka_rka.rka_perubahan = '0'
                 AND rka_rka.`rapbd_rapbd_id` = :id_rapbd
                 AND if(:status_rka = 'Final',(rka_rka.`status_rka` = 1),(rka_rka.`status_rka` = 0 OR rka_rka.`status_rka` = 2))
                GROUP BY
                     sikd_rek_akun_id_sikd_rek_akun,
                     sikd_rek_kelompok_id_sikd_rek_kelompok,
                     sikd_rek_jenis_id_sikd_rek_jenis,
                     sikd_rek_obj_id_sikd_rek_obj,
                     sikd_rek_rincian_obj_id_sikd_rek_rincian_obj
                ORDER BY
                     sikd_rek_rincian_obj.`kd_rek_rincian_obj` ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rapbd", $idRapbd);
            $statement->bindValue("status_rka", $statusRka);
            $statement->execute();
            $rapbdLampPerda04 = $statement->fetchAll();

            return new JsonResponse($rapbdLampPerda04);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getLapPmk072h($request) {
        try {
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                     CONCAT_WS('-',
                    SUBSTR(HEX(rapbd_rapbd.`id_rapbd_rapbd`), 1, 8),
                    SUBSTR(HEX(rapbd_rapbd.`id_rapbd_rapbd`), 9, 4),
                    SUBSTR(HEX(rapbd_rapbd.`id_rapbd_rapbd`), 13, 4),
                    SUBSTR(HEX(rapbd_rapbd.`id_rapbd_rapbd`), 17, 4),
                    SUBSTR(HEX(rapbd_rapbd.`id_rapbd_rapbd`), 21)
                    ) AS rapbd_rapbd_id_rapbd_rapbd,
                     rapbd_rapbd.`tahun` AS rapbd_rapbd_tahun,
                     concat('GOLONGAN ',
                         IF(sikd_gol_pegawai.`golongan`='1', 'I',
                         IF(sikd_gol_pegawai.`golongan`='2', 'II',
                         IF(sikd_gol_pegawai.`golongan`='3', 'III',
                         IF(sikd_gol_pegawai.`golongan`='4', 'IV', ''))))) AS sikd_gol_pegawai_golongan,
                     concat('Golongan ',sikd_gol_pegawai.`nm_golongan`) AS sikd_gol_pegawai_nm_golongan,
                     rapbd_rekap_jml_pegawai.`jml_eselon_1` AS rapbd_rekap_jml_pegawai_jml_eselon_1,
                     rapbd_rekap_jml_pegawai.`jml_eselon_2` AS rapbd_rekap_jml_pegawai_jml_eselon_2,
                     rapbd_rekap_jml_pegawai.`jml_eselon_3` AS rapbd_rekap_jml_pegawai_jml_eselon_3,
                     rapbd_rekap_jml_pegawai.`jml_eselon_4` AS rapbd_rekap_jml_pegawai_jml_eselon_4,
                     rapbd_rekap_jml_pegawai.`jml_eselon_5` AS rapbd_rekap_jml_pegawai_jml_eselon_5,
                     rapbd_rekap_jml_pegawai.`jml_fungsional` AS rapbd_rekap_jml_pegawai_jml_fungsional,
                     rapbd_rekap_jml_pegawai.`jml_staf` AS rapbd_rekap_jml_pegawai_jml_staf
                FROM
                     `rapbd_rekap_jml_pegawai` rapbd_rekap_jml_pegawai
                     INNER JOIN `sikd_gol_pegawai` sikd_gol_pegawai ON rapbd_rekap_jml_pegawai.`sikd_gol_pegawai_id` = sikd_gol_pegawai.`id_sikd_gol_pegawai`
                     RIGHT OUTER JOIN `rapbd_rapbd` rapbd_rapbd ON rapbd_rapbd.`id_rapbd_rapbd` = rapbd_rekap_jml_pegawai.`rapbd_rapbd_id`";
            
            $statement = $this->connection->prepare($sql);
            $statement->execute();
            $rapbdLampPerda04 = $statement->fetchAll();

            return new JsonResponse($rapbdLampPerda04);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getLapSe03Adk01($request) {
        try {
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                     sikd_rek_akun.`kd_rek_akun` AS sikd_rek_akun_kd_rek_akun,
                     sikd_rek_akun.`nm_rek_akun` AS sikd_rek_akun_nm_rek_akun,
                     SUBSTR(sikd_rek_kelompok.`kd_rek_kelompok`,2,1) AS sikd_rek_kelompok_kd_rek_kelompok,
                     sikd_rek_kelompok.`nm_rek_kelompok` AS sikd_rek_kelompok_nm_rek_kelompok,
                     SUBSTR(sikd_rek_jenis.`kd_rek_jenis`,3,1) AS sikd_rek_jenis_kd_rek_jenis,
                     sikd_rek_jenis.`nm_rek_jenis` AS sikd_rek_jenis_nm_rek_jenis,
                     SUBSTR(sikd_rek_obj.`kd_rek_obj`,4,2) AS sikd_rek_obj_kd_rek_obj,
                     sikd_rek_obj.`nm_rek_obj` AS sikd_rek_obj_nm_rek_obj,
                     SUBSTR(sikd_rek_rincian_obj.`kd_rek_rincian_obj`,6) AS sikd_rek_rincian_obj_kd_rek_rincian_obj,
                     sikd_rek_rincian_obj.`nm_rek_rincian_obj` AS sikd_rek_rincian_obj_nm_rek_rincian_obj,
                     CONCAT('0',sikd_urusan_satker.`kd_urusan`) AS sikd_urusan_kd_urusan,
                     CONCAT('Urusan ',sikd_urusan_satker.`nm_urusan`) AS sikd_urusan_nm_urusan,
                     SUBSTR(sikd_bidang_satker.`kd_bidang`,2) AS sikd_bidang_kd_bidang,
                     sikd_bidang_satker.`nm_bidang` AS sikd_bidang_nm_bidang,
                     SUBSTR(sikd_satker.`kode`,4) AS sikd_satker_kode,
                     sikd_satker.`nama` AS sikd_satker_nama,
                     sikd_prog.`kd_prog` AS sikd_prog_kd_prog,
                     sikd_prog.`nm_prog` AS sikd_prog_nm_prog,
                     SUBSTR(sikd_kgtn.`kd_kgtn`,3) AS sikd_kgtn_kd_kgtn,
                     sikd_kgtn.`nm_kgtn` AS sikd_kgtn_nm_kgtn,
                     sikd_fungsi.`kd_fungsi` AS sikd_fungsi_kd_fungsi,
                     sikd_fungsi.`nm_fungsi` AS sikd_fungsi_nm_fungsi,
                     CONCAT('0',sikd_urusan.`kd_urusan`) AS sikd_urusan_kd_urusan2,
                     CONCAT('Urusan ',sikd_urusan.`nm_urusan`) AS sikd_urusan_nm_urusan2,
                     SUBSTR(sikd_bidang.`kd_bidang`,2) AS sikd_bidang_kd_bidang2,
                     sikd_bidang.`nm_bidang` AS sikd_bidang_nm_bidang2,
                     rka_mata_anggaran.`jumlah` AS rka_mata_anggaran_jumlah
                FROM
                     `vw_rka_skpd_skpkd_all` vw_rka_rka INNER JOIN `rka_mata_anggaran` rka_mata_anggaran ON vw_rka_rka.`rka_rka_id` = rka_mata_anggaran.`rka_rka`
                     INNER JOIN `rka_rka` rka_rka ON rka_rka.`id_rka_rka` = vw_rka_rka.`rka_rka_id`
                     INNER JOIN `sikd_satker` sikd_satker ON rka_rka.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                     INNER JOIN `sikd_bidang` sikd_bidang_satker ON sikd_satker.`kd_bidang_induk` = sikd_bidang_satker.`kd_bidang`
                     INNER JOIN `sikd_urusan` sikd_urusan_satker ON sikd_bidang_satker.`sikd_urusan_id` = sikd_urusan_satker.`id_sikd_urusan`
                     INNER JOIN `sikd_bidang` sikd_bidang ON vw_rka_rka.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                     INNER JOIN `sikd_fungsi` sikd_fungsi ON sikd_bidang.`sikd_fungsi_id` = sikd_fungsi.`id_sikd_fungsi`
                     INNER JOIN `sikd_urusan` sikd_urusan ON sikd_bidang.`sikd_urusan_id` = sikd_urusan.`id_sikd_urusan`
                     INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON rka_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                     INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                     INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                     INNER JOIN `sikd_rek_kelompok` sikd_rek_kelompok ON sikd_rek_jenis.`sikd_rek_kelompok_id` = sikd_rek_kelompok.`id_sikd_rek_kelompok`
                     INNER JOIN `sikd_rek_akun` sikd_rek_akun ON sikd_rek_kelompok.`sikd_rek_akun_id` = sikd_rek_akun.`id_sikd_rek_akun`
                     LEFT OUTER JOIN `rka_rka` rka_skpd_kgtn ON rka_rka.`id_rka_rka` = rka_skpd_kgtn.`id_rka_rka` AND rka_skpd_kgtn.`rka_rka_type` = 'RkaSkpdKgtn'
                     LEFT OUTER JOIN `sikd_kgtn` sikd_kgtn ON rka_skpd_kgtn.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                     LEFT OUTER JOIN `sikd_prog` sikd_prog ON sikd_kgtn.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                WHERE
                     rka_mata_anggaran.`jumlah` > 0
                 AND rka_rka.rka_perubahan = '0'
                ORDER BY
                     sikd_rek_rincian_obj.kd_rek_rincian_obj, sikd_satker.kode,
                     sikd_satker.kd_bidang_induk, sikd_prog.kd_prog, sikd_kgtn.kd_kgtn";
            
            $statement = $this->connection->prepare($sql);
            $statement->execute();
            $rapbdLampPerda04 = $statement->fetchAll();

            return new JsonResponse($rapbdLampPerda04);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getLapSe03Adk012($request) {
        try {
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            
            $this->connection = $conn->getConnection();

            $sql = "";
            
            $statement = $this->connection->prepare($sql);
            $statement->execute();
            $rapbdLampPerda04 = $statement->fetchAll();

            return new JsonResponse($rapbdLampPerda04);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
}
