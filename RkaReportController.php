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
 * @RouteResource("rkareport")
 */
class RkaReportController extends \App\Controller\ApiBaseController

{
    public function cgetAction(Request $request)
    {        
        $rpt = $request->query->get("jns_report");
        //print_r($rpt);exit;
        switch ($rpt) {
            case "rka_skpd_pendapatan":
                return $this->getRkaSkpdPendapatan($request);
            case "rka_rinc_mataanggaran":
                return $this->getRkaRincMataAnggaran($request);
            case "rka_hasil_pembahasan":
                return $this->getRkaHasilPembahasan($request);
            case "rka_tim_anggaran":
                return $this->getRkaTimAnggaran($request);
            case "rka_skpd_blnj_tdk_langsung":
                return $this->getRkaSkpdBlnjTdkLangsung($request);
            case "rka_skpd_blnj_langsung":
                return $this->getRkaSkpdBlnjLangsung($request);
            case "rka_skpd_blnj_langsung_detail":
                return $this->getRkaSkpdBlnjLangsungDetail($request);
            case "rka_skpd_indktr_knrj":
                return $this->getRkaSkpdIndktrKnrj($request);
            case "rka_skpkd_pendapatan":
                return $this->getRkaSkpkdPendapatan($request);
            case "rka_skpkd_blnj_tdk_langsung":
                return $this->getRkaSkpkdBlnjTdkLangsung($request);
            case "rka_skpkd_penerimaan":
                return $this->getRkaSkpkdPenerimaan($request);
            case "rka_skpkd_rincian_mata_anggaran_pembiayaan":
                return $this->getRkaSkpkdRincMataAnggaranPembiayaan($request);
            case "rka_skpkd_pengeluaran":
                return $this->getRkaSkpkdPengeluaran($request);
            case "rka_rekap_skpd":
                return $this->getRkaRekapSkpd($request);
            case "rka_rekap_skpd_sub":
                return $this->getRkaRekapSkpdSub($request);
            case "rka_rekap_skpd_blnj_langsung":
                return $this->getRkaRekapSkpdBlnjLangsung($request);
            case "rka_rekap_skpkd":
                return $this->getRkaRekapSkpkd($request);
            case "rka_rekap_skpkd_sub":
                return $this->getRkaRekapSkpkdSub($request);

            // RKA Monitoring
            case "rka_anomali_rinc_anggaran":
                return $this->getRkaAnomaliRincAnggaran($request);

            case "rka_anomali_ppas":
                return $this->getRkaAnomaliPpas($request);

            case "rka_rekap_ppkd_pembiayaan":
                return $this->getRkaRekapPpkdPembiayaan($request);
            case "rka_rekap_skpd_blnjlangsung_bant":
                return $this->getRkaSkpdBlnjlangsungBant($request);
            case "rka_skpd_indktr_knrj_renja":
                return $this->getRkaSkpdIndktrKnrjRenja($request);
                        
            case "rka_anomali_rinc_no_item":
                return $this->getRkaAnomaliRincNoItem($request);
            case "rka_daftar_rekening":
                return $this->getRkaDaftarRekening($request);
            case "rka_pengadaan_barang":
                return $this->getRkaPengadaanBarang($request);
            case "rka_pengawasan_pagu_ppas_bl":
                return $this->getRkaPengawasanPaguPpasBl($request);
            case "rka_pengawasan_pagu_ppas":
                return $this->getRkaPengawasanPaguPpas($request);
            case "rka_sumber_dana_kegiatan":
                return $this->getRkaSumberDanaKegiatan($request);
            default:
                throw new BadRequestHttpException("Undefined report");
        }
    }
    
    private function getRkaRekapSkpd($request) {
        try {
            $tahun = $request->query->get("tahun");
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                        rapbd_rapbd.`tahun` AS rapbd_rapbd_tahun
                    FROM
                        `rapbd_rapbd` rapbd_rapbd
                    WHERE
                        rapbd_rapbd.`tahun` = :tahun limit 1
                    ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("tahun", $tahun);
            $statement->execute();
            $rekapSkpd = $statement->fetchAll();

            return new JsonResponse($rekapSkpd);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
        
    }

     private function getRkaRekapSkpdSub($request) {
        try {
            //$tahun = $request->query->get("tahun");
            $status_rka = $request->query->get("status_rka");
            $sikd_satker_id = $request->query->get("sikd_satker_id");
            $sikd_satker_id = pack('H*', str_replace('-', '', trim($sikd_satker_id)));
            $sikd_sub_skpd_id = $request->query->get("sikd_sub_skpd_id");
            $sikd_sub_skpd_id = pack('H*', str_replace('-', '', trim($sikd_sub_skpd_id)));
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                         sikd_rek_akun.`kd_rek_akun` AS sikd_rek_akun_kd_rek_akun,
                         sikd_rek_akun.`nm_rek_akun` AS sikd_rek_akun_nm_rek_akun,
                         sikd_rek_kelompok.`kd_rek_kelompok` AS sikd_rek_kelompok_kd_rek_kelompok,
                         sikd_rek_kelompok.`nm_rek_kelompok` AS sikd_rek_kelompok_nm_rek_kelompok,
                         sikd_rek_jenis.`kd_rek_jenis` AS sikd_rek_jenis_kd_rek_jenis,
                         sikd_rek_jenis.`nm_rek_jenis` AS sikd_rek_jenis_nm_rek_jenis,
                         substring(sikd_rek_kelompok.`kd_rek_kelompok`,2,1) kode_2,
                         substring(sikd_rek_jenis.`kd_rek_jenis`,3,1) kode_3,
                         if(:status_rka='1','',if(:status_rka='2','DITOLAK',
                            if(:status_rka='0','DRAFT','SEMUA'))) AS status_rka,
                         sum(if(rka_mata_anggaran.`jumlah` is not null, rka_mata_anggaran.`jumlah`, 0)) AS jumlah,
                         sum(if(sikd_rek_akun.`kd_rek_akun` in ('4'), 1, -1)* ifnull(rka_mata_anggaran.`jumlah`, 0)) AS jumlah_surpl_dfst   
                    FROM
                                `rka_mata_anggaran` rka_mata_anggaran
                         INNER JOIN `rka_rka` rka_rka ON rka_mata_anggaran.`rka_rka` = rka_rka.`id_rka_rka`
                         AND rka_rka.rka_perubahan = '0' AND rka_rka.sikd_satker_id = :sikd_satker_id
                         AND IF(:sikd_sub_skpd_id != '', rka_rka.sikd_sub_satker_id LIKE :sikd_sub_skpd_id, 1)
                         AND if(:status_rka='-1', rka_rka.`status_rka` like '%', rka_rka.`status_rka` = :status_rka)
                         RIGHT OUTER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON rka_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                         INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                         INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                         INNER JOIN `sikd_rek_kelompok` sikd_rek_kelompok ON sikd_rek_jenis.`sikd_rek_kelompok_id` = sikd_rek_kelompok.`id_sikd_rek_kelompok`
                         INNER JOIN `sikd_rek_akun` sikd_rek_akun ON sikd_rek_kelompok.`sikd_rek_akun_id` = sikd_rek_akun.`id_sikd_rek_akun`
                         AND sikd_rek_akun.`kd_rek_akun` in ('4','5')
                    GROUP BY
                         sikd_rek_akun.`kd_rek_akun`,
                         sikd_rek_kelompok.`kd_rek_kelompok`,
                         sikd_rek_jenis.`kd_rek_jenis`
                    ORDER BY
                         sikd_rek_akun.`kd_rek_akun`,
                         sikd_rek_kelompok.`kd_rek_kelompok`,
                         sikd_rek_jenis.`kd_rek_jenis`
                    ";
            
            $statement = $this->connection->prepare($sql);
            //$statement->bindValue("tahun", $tahun);
            $statement->bindValue("status_rka", $status_rka);
            $statement->bindValue("sikd_satker_id", $sikd_satker_id);
            $statement->bindValue("sikd_sub_skpd_id", $sikd_sub_skpd_id);
            $statement->execute();
            $rekapSkpd = $statement->fetchAll();

            return new JsonResponse($rekapSkpd);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
        
    }

     private function getRkaRekapSkpdBlnjLangsung($request) {
        try {
            $sikd_bidang_id = $request->query->get("sikd_bidang_id");
            $sikd_bidang_id = pack('H*', str_replace('-', '', trim($sikd_bidang_id)));
            $sikd_satker_id = $request->query->get("sikd_satker_id");
            $sikd_satker_id = pack('H*', str_replace('-', '', trim($sikd_satker_id)));
            $sikd_sub_skpd_id = $request->query->get("sikd_sub_skpd_id");
            $sikd_sub_skpd_id = pack('H*', str_replace('-', '', trim($sikd_sub_skpd_id)));
            $status_rka = $request->query->get("status_rka");
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                     CONCAT_WS('-',
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 1, 8),
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 9, 4),
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 13, 4),
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 17, 4),
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 21)
                            ) AS id_satker,
                     sikd_satker.kode AS kd_satker,
                     sikd_satker.nama AS nm_satker,
                     CONCAT_WS('-',
                            SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 1, 8),
                            SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 9, 4),
                            SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 13, 4),
                            SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 17, 4),
                            SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 21)
                            ) AS id_sub_skpd,
                     sikd_sub_skpd.kode AS kd_sub_skpd,
                     sikd_sub_skpd.nama AS nm_sub_skpd,
                     CONCAT_WS('-',
                            SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 1, 8),
                            SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 9, 4),
                            SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 13, 4),
                            SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 17, 4),
                            SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 21)
                            ) AS id_sikd_bidang,
                     sikd_bidang.kd_bidang AS sikd_bidang_kd_bidang,
                     sikd_bidang.nm_bidang AS sikd_bidang_nm_bidang,
                     rka_rka.rka_perubahan,
                     CONCAT_WS('-',
                            SUBSTR(HEX(sikd_prog.`id_sikd_prog`), 1, 8),
                            SUBSTR(HEX(sikd_prog.`id_sikd_prog`), 9, 4),
                            SUBSTR(HEX(sikd_prog.`id_sikd_prog`), 13, 4),
                            SUBSTR(HEX(sikd_prog.`id_sikd_prog`), 17, 4),
                            SUBSTR(HEX(sikd_prog.`id_sikd_prog`), 21)
                            ) AS sikd_prog_id_sikd_prog,
                     concat(sikd_bidang.kd_bidang,'.',sikd_prog.`kd_prog`) AS sikd_prog_kd_prog,
                     sikd_prog.`nm_prog` AS sikd_prog_nm_prog,
                     CONCAT_WS('-',
                            SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 1, 8),
                            SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 9, 4),
                            SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 13, 4),
                            SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 17, 4),
                            SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 21)
                            ) AS sikd_kgtn_id_sikd_kgtn,
                     substring(sikd_kgtn.`kd_kgtn`,3,3)AS sikd_kgtn_kd_kgtn,
                     sikd_kgtn.`nm_kgtn` AS sikd_kgtn_nm_kgtn,
                     CONCAT_WS('-',
                            SUBSTR(HEX(rka_rka.`id_rka_rka`), 1, 8),
                            SUBSTR(HEX(rka_rka.`id_rka_rka`), 9, 4),
                            SUBSTR(HEX(rka_rka.`id_rka_rka`), 13, 4),
                            SUBSTR(HEX(rka_rka.`id_rka_rka`), 17, 4),
                            SUBSTR(HEX(rka_rka.`id_rka_rka`), 21)
                            ) AS id_rka_skpd_kgtn,
                     LPAD(IFNULL(trim(rka_rka.`no_subkegiatan`),''),3,0) AS rka_skpd_kgtn_no_subkegiatan,
                     IFNULL(TRIM(rka_rka.`nm_subkegiatan`),'') AS rka_skpd_kgtn_nm_subkegiatan,
                     IF(length(TRIM(rka_rka.lokasi_kgtn)) != '', rka_rka.lokasi_kgtn, concat(sikd_pemda.klasf_daerah,' ',sikd_pemda.nm_daerah)) AS nm_lokasi_kgtn,
                     IF(length(TRIM(rka_rka.`target_kinerja`)) != '', rka_rka.`target_kinerja`, '') AS rka_skpd_kgtn_target_kinerja,
                     IFNULL((Select GROUP_CONCAT(DISTINCT b.lokasi_kgtn ORDER BY lpad(b.no_subkegiatan,3,0) DESC SEPARATOR ' ; ')
                             From rka_rka a, rka_rka b
                             Where a.no_rka = rka_rka.no_rka 
                               and a.sikd_sub_satker_id = rka_rka.sikd_sub_satker_id 
                               and a.id_rka_rka = b.id_rka_rka), concat(sikd_pemda.klasf_daerah,' ',sikd_pemda.nm_daerah)) AS rka_skpd_kgtn_lokasi_kgtn_rekap,
                     IFNULL((Select GROUP_CONCAT(b.target_kinerja ORDER BY lpad(b.no_subkegiatan,3,0) DESC SEPARATOR ' ; ')
                             From rka_rka a, rka_rka b
                             Where a.no_rka = rka_rka.no_rka 
                               and a.sikd_sub_satker_id = rka_rka.sikd_sub_satker_id 
                               and a.id_rka_rka = b.id_rka_rka), '-') AS rka_skpd_kgtn_target_kinerja_rekap,
                     IFNULL(rka_rka.`jml_thn_ssdh`,0)AS rka_skpd_kgtn_jml_thn_ssdh,
                     if(:status_rka='1','',if(:status_rka='2','DITOLAK',
                        if(:status_rka='0','DRAFT','SEMUA'))) AS status_rka,
                     sum(if(substring(sikd_rek_rincian_obj.`kd_rek_rincian_obj`,1,3)='521',rka_mata_anggaran.`jumlah`,0)) AS jml_blnj_pegawai,
                     sum(if(substring(sikd_rek_rincian_obj.`kd_rek_rincian_obj`,1,3)='522',rka_mata_anggaran.`jumlah`,0)) AS jml_blnj_barang,
                     sum(if(substring(sikd_rek_rincian_obj.`kd_rek_rincian_obj`,1,3)='523',rka_mata_anggaran.`jumlah`,0)) AS jml_blnj_modal,
                     sum(if(substring(sikd_rek_rincian_obj.`kd_rek_rincian_obj`,1,2)='52',rka_mata_anggaran.`jumlah`,0)) AS jumlah
                FROM
                     `rka_rka` rka_rka 
                     INNER JOIN `sikd_satker` sikd_satker ON rka_rka.sikd_satker_id = sikd_satker.`id_sikd_satker`
                     AND rka_rka.`sikd_satker_id` = :sikd_satker_id
                         AND IF(:sikd_sub_skpd_id != '', rka_rka.`sikd_sub_skpd_id` LIKE :sikd_sub_skpd_id, 1)
                         AND IF(:sikd_bidang_id != '', rka_rka.`sikd_bidang_id` = :sikd_bidang_id, 1)
                     LEFT OUTER JOIN sikd_sub_skpd sikd_sub_skpd ON rka_rka.sikd_sub_satker_id = sikd_sub_skpd.id_sikd_sub_skpd
                     INNER JOIN `sikd_bidang` sikd_bidang ON rka_rka.`sikd_bidang_id` = sikd_bidang.id_sikd_bidang
                     AND (rka_rka.rka_perubahan is NULL OR rka_rka.rka_perubahan = '0')
                         AND if(:status_rka='-1', rka_rka.`status_rka` like '%', rka_rka.`status_rka` = :status_rka)
                     INNER JOIN `sikd_kgtn` sikd_kgtn ON rka_rka.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                     INNER JOIN `rka_mata_anggaran` rka_mata_anggaran ON rka_rka.id_rka_rka = rka_mata_anggaran.`rka_rka`
                     LEFT OUTER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON rka_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                     AND sikd_rek_rincian_obj.`kd_rek_rincian_obj` like '52%'
                     INNER JOIN `sikd_prog` ON sikd_kgtn.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                     LEFT OUTER JOIN `sikd_pemda` sikd_pemda ON sikd_pemda.id_sikd_pemda = '1'
                GROUP BY
                     sikd_bidang.`kd_bidang`,
                     sikd_prog.`kd_prog`,
                     sikd_kgtn.`kd_kgtn`,
                     rka_rka.`id_rka_rka`
                ORDER BY
                     if(sikd_bidang.`kd_bidang`=sikd_satker.kd_bidang_induk, 1, 2) ASC,
                     sikd_bidang.`kd_bidang`,
                     sikd_prog.`kd_prog` ASC,
                     sikd_kgtn.`kd_kgtn` ASC,
                     lpad(rka_rka.`no_subkegiatan`,3,0) ASC,
                     rka_rka.`id_rka_rka`
                    ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("sikd_bidang_id", $sikd_bidang_id);
            $statement->bindValue("sikd_satker_id", $sikd_satker_id);
            $statement->bindValue("sikd_sub_skpd_id", $sikd_sub_skpd_id);
            $statement->bindValue("status_rka", $status_rka);
            $statement->execute();
            $rekapSkpd = $statement->fetchAll();

            return new JsonResponse($rekapSkpd);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
        
    }
    
    private function getRkaSkpdBlnjLangsung($request) {
        try {
            $id_rka_rka = $request->query->get("id_rka_rka");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $id_rka_rka = pack('H*', str_replace('-', '', trim($id_rka_rka)));
            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                         rka_rka.`nm_kegiatan` AS rka_skpd_kgtn_nm_kegiatan,
                         ifnull(rka_rka.`lokasi_kgtn`,'') AS rka_skpd_kgtn_lokasi_kgtn,
                         ifnull(rka_rka.`jml_anggaran`,0) AS rka_rka_jml_anggaran,
                         ifnull(rka_rka.`jml_thn_sblm`,0) AS rka_rka_jml_thn_sblm,
                         ifnull(rka_rka.`jml_thn_ssdh`,0) AS rka_rka_jml_thn_ssdh,
                         rka_rka.`klpk_sasaran` AS rka_skpd_kgtn_klpk_sasaran,
                         CONCAT_WS('-',
                            SUBSTR(HEX(rka_rka.`sikd_skpd_id`), 1, 8),
                            SUBSTR(HEX(rka_rka.`sikd_skpd_id`), 9, 4),
                            SUBSTR(HEX(rka_rka.`sikd_skpd_id`), 13, 4),
                            SUBSTR(HEX(rka_rka.`sikd_skpd_id`), 17, 4),
                            SUBSTR(HEX(rka_rka.`sikd_skpd_id`), 21)
                            ) AS rka_skpd_sikd_skpd_id,
                        CONCAT_WS('-',
                            SUBSTR(HEX(rka_rka.`sikd_sub_skpd_id`), 1, 8),
                            SUBSTR(HEX(rka_rka.`sikd_sub_skpd_id`), 9, 4),
                            SUBSTR(HEX(rka_rka.`sikd_sub_skpd_id`), 13, 4),
                            SUBSTR(HEX(rka_rka.`sikd_sub_skpd_id`), 17, 4),
                            SUBSTR(HEX(rka_rka.`sikd_sub_skpd_id`), 21)
                            ) AS rka_skpd_sikd_sub_skpd_id,
                        CONCAT_WS('-',
                            SUBSTR(HEX(rka_rka.`sikd_bidang_id`), 1, 8),
                            SUBSTR(HEX(rka_rka.`sikd_bidang_id`), 9, 4),
                            SUBSTR(HEX(rka_rka.`sikd_bidang_id`), 13, 4),
                            SUBSTR(HEX(rka_rka.`sikd_bidang_id`), 17, 4),
                            SUBSTR(HEX(rka_rka.`sikd_bidang_id`), 21)
                            ) AS rka_skpd_sikd_bidang_id,
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
                         CONCAT_WS('-',
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 1, 8),
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 9, 4),
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 13, 4),
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 17, 4),
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 21)
                            ) AS sikd_rek_jenis_id_sikd_rek_jenis,
                         sikd_rek_jenis.`kd_rek_jenis` AS sikd_rek_jenis_kd_rek_jenis,
                         sikd_rek_jenis.`nm_rek_jenis` AS sikd_rek_jenis_nm_rek_jenis,
                         CONCAT_WS('-',
                            SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 1, 8),
                            SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 9, 4),
                            SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 13, 4),
                            SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 17, 4),
                            SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 21)
                            ) AS sikd_rek_obj_id_sikd_rek_obj,
                         sikd_rek_obj.`kd_rek_obj` AS sikd_rek_obj_kd_rek_obj,
                         sikd_rek_obj.`nm_rek_obj` AS sikd_rek_obj_nm_rek_obj,
                         CONCAT_WS('-',
                            SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 1, 8),
                            SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 9, 4),
                            SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 13, 4),
                            SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 17, 4),
                            SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 21)
                            ) AS sikd_rek_rincian_obj_id_sikd_rek_rincian_obj,
                         sikd_rek_rincian_obj.`kd_rek_rincian_obj` AS sikd_rek_rincian_obj_kd_rek_rincian_obj,
                         sikd_rek_rincian_obj.`nm_rek_rincian_obj` AS sikd_rek_rincian_obj_nm_rek_rincian_obj,
                         rka_rincian_mata_anggaran.`uraian` AS rka_rincian_mata_anggaran_uraian,
                         rka_rincian_mata_anggaran.`volume` AS rka_rincian_mata_anggaran_volume,
                         rka_rincian_mata_anggaran.`satuan` AS rka_rincian_mata_anggaran_satuan,
                         rka_rincian_mata_anggaran.`harga` AS rka_rincian_mata_anggaran_harga,
                         rka_rincian_mata_anggaran.`jumlah` AS rka_rincian_mata_anggaran_jumlah,
                         if(rka_rka.`status_rka` = '0', 'DRAFT',if(rka_rka.`status_rka` = '2', 'DITOLAK', '')) AS rka_status_rka,
                         rka_rka.`keterangan` AS rka_keterangan,
                         rka_rincian_mata_anggaran.`header` AS rka_rincian_mata_anggaran_header,
                         rka_rincian_mata_anggaran.`subheader` AS rka_rincian_mata_anggaran_subheader,
                         rka_mata_anggaran.`volume` AS rka_mata_anggaran_volume,
                         rka_mata_anggaran.`satuan` AS rka_mata_anggaran_satuan,
                         rka_mata_anggaran.`harga` AS rka_mata_anggaran_harga,
                         rka_mata_anggaran.`jumlah` AS rka_mata_anggaran_jumlah,
                         rka_mata_anggaran.`jml_thn_ssdh` AS rka_mata_anggaran_jml_thn_ssdh,
                         rka_rka.rka_perubahan AS rka_perubahan,
                         CONCAT_WS('-',
                            SUBSTR(HEX(rka_rka.id_rka_rka), 1, 8),
                            SUBSTR(HEX(rka_rka.`id_rka_rka`), 9, 4),
                            SUBSTR(HEX(rka_rka.`id_rka_rka`), 13, 4),
                            SUBSTR(HEX(rka_rka.`id_rka_rka`), 17, 4),
                            SUBSTR(HEX(rka_rka.`id_rka_rka`), 21)
                            ) AS rka_rka_id_rka_rka
                    FROM
                         `rka_rka` rka_rka
                         INNER JOIN `rka_mata_anggaran` rka_mata_anggaran ON rka_rka.`id_rka_rka` = rka_mata_anggaran.rka_rka
                         LEFT OUTER JOIN `rka_rincian_mata_anggaran` rka_rincian_mata_anggaran ON rka_mata_anggaran.`id_rka_mata_anggaran` = rka_rincian_mata_anggaran.`rka_mata_anggaran_id`
                         INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON rka_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                         INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                         INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                         INNER JOIN `sikd_rek_kelompok` sikd_rek_kelompok ON sikd_rek_jenis.`sikd_rek_kelompok_id` = sikd_rek_kelompok.`id_sikd_rek_kelompok`
                         INNER JOIN `sikd_rek_akun` sikd_rek_akun ON sikd_rek_kelompok.`sikd_rek_akun_id` = sikd_rek_akun.`id_sikd_rek_akun`
                    WHERE
                         rka_rka.id_rka_rka = :id_rka_rka
                         AND rka_rka.rka_rka_type = 'RkaSkpdKgtn'
                    ORDER BY
                         rka_mata_anggaran.kd_rekening ASC
                    ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("status", $id_rka_rka);
            $statement->execute();
            $rkaSkpdBlnjLangsung = $statement->fetchAll();

            return new JsonResponse($rkaSkpdBlnjLangsung);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
        
    }

    private function getRkaSkpdBlnjLangsungDetail($request) {
        try {
            $id_rka_rka = $request->query->get("id_rka_rka");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $id_rka_rka = pack('H*', str_replace('-', '', trim($id_rka_rka)));
            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                         CONCAT_WS('-',
                            SUBSTR(HEX(rka_rka.`klpk_sasaran`), 1, 8),
                            SUBSTR(HEX(rka_rka.`klpk_sasaran`), 9, 4),
                            SUBSTR(HEX(rka_rka.`klpk_sasaran`), 13, 4),
                            SUBSTR(HEX(rka_rka.`klpk_sasaran`), 17, 4),
                            SUBSTR(HEX(rka_rka.`klpk_sasaran`), 21)
                            ) AS rka_skpd_kgtn_klpk_sasaran,
                         CONCAT_WS('-',
                            SUBSTR(HEX(rka_rka.`sikd_skpd_id`), 1, 8),
                            SUBSTR(HEX(rka_rka.`sikd_skpd_id`), 9, 4),
                            SUBSTR(HEX(rka_rka.`sikd_skpd_id`), 13, 4),
                            SUBSTR(HEX(rka_rka.`sikd_skpd_id`), 17, 4),
                            SUBSTR(HEX(rka_rka.`sikd_skpd_id`), 21)
                            ) AS rka_skpd_sikd_skpd_id,
                         CONCAT_WS('-',
                            SUBSTR(HEX(rka_rka.`sikd_bidang_id`), 1, 8),
                            SUBSTR(HEX(rka_rka.`sikd_bidang_id`), 9, 4),
                            SUBSTR(HEX(rka_rka.`sikd_bidang_id`), 13, 4),
                            SUBSTR(HEX(rka_rka.`sikd_bidang_id`), 17, 4),
                            SUBSTR(HEX(rka_rka.`sikd_bidang_id`), 21)
                            ) AS rka_skpd_sikd_bidang_id,
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
                         CONCAT_WS('-',
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 1, 8),
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 9, 4),
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 13, 4),
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 17, 4),
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 21)
                            ) AS sikd_rek_jenis_id_sikd_rek_jenis,
                         sikd_rek_jenis.`kd_rek_jenis` AS sikd_rek_jenis_kd_rek_jenis,
                         sikd_rek_jenis.`nm_rek_jenis` AS sikd_rek_jenis_nm_rek_jenis,
                         CONCAT_WS('-',
                            SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 1, 8),
                            SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 9, 4),
                            SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 13, 4),
                            SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 17, 4),
                            SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 21)
                            ) AS sikd_rek_obj_id_sikd_rek_obj,
                         sikd_rek_obj.`kd_rek_obj` AS sikd_rek_obj_kd_rek_obj,
                         sikd_rek_obj.`nm_rek_obj` AS sikd_rek_obj_nm_rek_obj,
                         CONCAT_WS('-',
                            SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 1, 8),
                            SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 9, 4),
                            SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 13, 4),
                            SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 17, 4),
                            SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 21)
                            ) AS sikd_rek_rincian_obj_id_sikd_rek_rincian_obj,
                         sikd_rek_rincian_obj.`kd_rek_rincian_obj` AS sikd_rek_rincian_obj_kd_rek_rincian_obj,
                         sikd_rek_rincian_obj.`nm_rek_rincian_obj` AS sikd_rek_rincian_obj_nm_rek_rincian_obj,
                         rka_rka.`keterangan` AS rka_keterangan,
                         CONCAT_WS('-',
                            SUBSTR(HEX(rka_mata_anggaran.`id_rka_mata_anggaran`), 1, 8),
                            SUBSTR(HEX(rka_mata_anggaran.`id_rka_mata_anggaran`), 9, 4),
                            SUBSTR(HEX(rka_mata_anggaran.`id_rka_mata_anggaran`), 13, 4),
                            SUBSTR(HEX(rka_mata_anggaran.`id_rka_mata_anggaran`), 17, 4),
                            SUBSTR(HEX(rka_mata_anggaran.`id_rka_mata_anggaran`), 21)
                            ) AS id_rka_mata_anggaran,
                         rka_mata_anggaran.`volume` AS rka_mata_anggaran_volume,
                         rka_mata_anggaran.`satuan` AS rka_mata_anggaran_satuan,
                         rka_mata_anggaran.`harga` AS rka_mata_anggaran_harga,
                         rka_mata_anggaran.`jumlah` AS rka_mata_anggaran_jumlah,
                         rka_mata_anggaran.`jml_thn_ssdh` AS rka_mata_anggaran_jml_thn_ssdh
                    FROM
                         `rka_rka` rka_rka
                         INNER JOIN `rka_mata_anggaran` rka_mata_anggaran ON rka_rka.`id_rka_rka` = rka_mata_anggaran.rka_rka
                         INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON rka_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                         INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                         INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                         INNER JOIN `sikd_rek_kelompok` sikd_rek_kelompok ON sikd_rek_jenis.`sikd_rek_kelompok_id` = sikd_rek_kelompok.`id_sikd_rek_kelompok`
                         INNER JOIN `sikd_rek_akun` sikd_rek_akun ON sikd_rek_kelompok.`sikd_rek_akun_id` = sikd_rek_akun.`id_sikd_rek_akun`
                    WHERE
                         rka_rka.`id_rka_rka` = :id_rka_rka
                    ORDER BY
                         rka_mata_anggaran.`kd_rekening` ASC"
                    ;
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rka_rka", $id_rka_rka);
            $statement->execute();
            $rkaSkpdBlnjLangsung = $statement->fetchAll();

            return new JsonResponse($rkaSkpdBlnjLangsung);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
        
    }
    
    private function getRkaRekapSkpkd($request) {
        try {
            //$idRkaSkpdKgtn = $request->query->get("rka_skpd_kgtn_id");
            $tahun = $request->query->get("tahun");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            //$idRkaSkpdKgtn = pack('H*', str_replace('-', '', trim($idRkaSkpdKgtn)));
            //$tahun = pack('H*', str_replace('-', '', trim($tahun)));
            //print_r($tahun);exit;
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                         rapbd_rapbd.`tahun` AS rapbd_rapbd_tahun
                    FROM
                         `rapbd_rapbd` rapbd_rapbd
                    WHERE
                         rapbd_rapbd.`tahun` = :tahun limit 1
                    ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("tahun", $tahun);
            $statement->execute();
            $rkaRekapSkpdPpkd = $statement->fetchAll();

            return new JsonResponse($rkaRekapSkpdPpkd);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
        
    }

    private function getRkaRekapSkpkdSub($request){
        try {
            $status_rka = $request->query->get("status_rka");
            $tahun = $request->query->get("tahun");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            //$idRkaSkpdKgtn = pack('H*', str_replace('-', '', trim($idRkaSkpdKgtn)));
            //$tahun = pack('H*', str_replace('-', '', trim($tahun)));
            //print_r($tahun);exit;
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                     sikd_rek_akun.`kd_rek_akun` AS sikd_rek_akun_kd_rek_akun,
                     sikd_rek_akun.`nm_rek_akun` AS sikd_rek_akun_nm_rek_akun,
                     sikd_rek_kelompok.`kd_rek_kelompok` AS sikd_rek_kelompok_kd_rek_kelompok,
                     sikd_rek_kelompok.`nm_rek_kelompok` AS sikd_rek_kelompok_nm_rek_kelompok,
                     sikd_rek_jenis.`kd_rek_jenis` AS sikd_rek_jenis_kd_rek_jenis,
                     sikd_rek_jenis.`nm_rek_jenis` AS sikd_rek_jenis_nm_rek_jenis,
                     substring(sikd_rek_kelompok.`kd_rek_kelompok`,2,1) kode_2,
                     substring(sikd_rek_jenis.`kd_rek_jenis`,3,1) kode_3,
                     if(:status_rka='1','',if(:status_rka='2','DITOLAK',
                        if(:status_rka='0','DRAFT','SEMUA'))) AS status_rka,
                     sum(if(rka_mata_anggaran.`jumlah` is not null, rka_mata_anggaran.`jumlah`, 0)) AS jumlah,
                     sum((if(sikd_rek_akun.`kd_rek_akun` = '4', 1, if(sikd_rek_akun.`kd_rek_akun` = '5', -1, 0))) * rka_mata_anggaran.`jumlah`) AS jml_surplus_defisit,
                     sum((if(sikd_rek_kelompok.`kd_rek_kelompok` = '61', 1, if(sikd_rek_kelompok.`kd_rek_kelompok` = '62', -1, 0))) * rka_mata_anggaran.`jumlah`) AS jml_netto,
                     rka_rka.rka_perubahan
                FROM
                     `rka_mata_anggaran` rka_mata_anggaran
                     INNER JOIN `rka_rka` rka_rka ON rka_mata_anggaran.`rka_rka` = rka_rka.`id_rka_rka`
                     AND (rka_rka.rka_perubahan = '0' OR rka_rka.rka_perubahan IS NULL)
                     AND if(:status_rka='-1', rka_rka.`status_rka` like '%', rka_rka.`status_rka` = :status_rka)
                     RIGHT OUTER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON rka_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                     INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                     INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                     INNER JOIN `sikd_rek_kelompok` sikd_rek_kelompok ON sikd_rek_jenis.`sikd_rek_kelompok_id` = sikd_rek_kelompok.`id_sikd_rek_kelompok`
                     AND sikd_rek_kelompok.`kd_rek_kelompok` not in ('52', '63', '64')
                     INNER JOIN `sikd_rek_akun` sikd_rek_akun ON sikd_rek_kelompok.`sikd_rek_akun_id` = sikd_rek_akun.`id_sikd_rek_akun`
                     AND sikd_rek_akun.`kd_rek_akun` in ('4', '5', '6')
                GROUP BY
                     sikd_rek_akun.`kd_rek_akun`,
                     sikd_rek_akun.`nm_rek_akun`,
                     sikd_rek_kelompok.`kd_rek_kelompok`,
                     sikd_rek_kelompok.`nm_rek_kelompok`,
                     sikd_rek_jenis.`kd_rek_jenis`,
                     sikd_rek_jenis.`nm_rek_jenis`
                ORDER BY
                     sikd_rek_akun.`kd_rek_akun`,
                     sikd_rek_kelompok.`kd_rek_kelompok`,
                     sikd_rek_jenis.`kd_rek_jenis`
                    ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("status_rka", $status_rka);
            $statement->execute();
            $rkaRekapSkpdPpkd = $statement->fetchAll();

            return new JsonResponse($rkaRekapSkpdPpkd);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getRkaHasilPembahasan($request) {
        try {

            //print_r($request);exit;
            $id_rka_rka = $request->query->get("id_rka_rka");
            $id_rka_rka = pack('H*', str_replace('-', '', trim($id_rka_rka)));
            //print_r($id_rka_rka);exit;
            $tahun = $request->query->get("tahun");
            /*$id_rka_pembahasan = $request->query->get("id_rka_pembahasan");
            $id_rka_pembahasan = pack('H*', str_replace('-', '', trim($id_rka_pembahasan)));
            $tgl_pembahasan = $request->query->get("tgl_pembahasan");*/

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            
            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                         rka_hsl_pembahasan.`no_catatan` AS rka_hsl_pembahasan_no_catatan,
                         rka_hsl_pembahasan.`catatan` AS rka_hsl_pembahasan_catatan,
                         rka_pembahasan.tgl_pembahasan AS tgl_pembahasan,
                          rka_pembahasan.keterangan AS keterangan
                    FROM
                         `rka_hsl_pembahasan` rka_hsl_pembahasan 
                         INNER JOIN `rka_pembahasan` rka_pembahasan ON rka_hsl_pembahasan.`rka_pembahasan_id` = rka_pembahasan.`id_rka_pembahasan`
                         RIGHT OUTER JOIN `rka_rka` rka_rka ON rka_pembahasan.`rka_rka_id` = rka_rka.`id_rka_rka`
                    WHERE
                         rka_rka.`id_rka_rka` = :id_rka_rka
                    ORDER BY
                         rka_pembahasan.tgl_pembahasan ASC, no_catatan ASC 
                    ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rka_rka", $id_rka_rka);
            $statement->execute();
            $rkaHasilPembahasan = $statement->fetchAll();

            return new JsonResponse($rkaHasilPembahasan);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
        
    }
    
    private function getRkaRekapPpkdPembiayaan($request) {
        try {
            $idRkaMataAnggaran = $request->query->get("id_rka_mata_anggaran");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRkaMataAnggaran = pack('H*', str_replace('-', '', trim($idRkaMataAnggaran)));
            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                       sikd_rek_akun.`kd_rek_akun` AS sikd_rek_akun_kd_rek_akun,
                       sikd_rek_akun.`nm_rek_akun` AS sikd_rek_akun_nm_rek_akun,
                       sikd_rek_kelompok.`kd_rek_kelompok` AS sikd_rek_kelompok_kd_rek_kelompok,
                       sikd_rek_kelompok.`nm_rek_kelompok` AS sikd_rek_kelompok_nm_rek_kelompok,
                       sikd_rek_jenis.`kd_rek_jenis` AS sikd_rek_jenis_kd_rek_jenis,
                       sikd_rek_jenis.`nm_rek_jenis` AS sikd_rek_jenis_nm_rek_jenis,
                       substring(sikd_rek_kelompok.`kd_rek_kelompok`,2,1) kode_2,
                       substring(sikd_rek_jenis.`kd_rek_jenis`,3,1) kode_3,
                       sum(if(rka_mata_anggaran.`jumlah` is not null, rka_mata_anggaran.`jumlah`, 0)) AS jumlah,
                       sum(if(sikd_rek_kelompok.`kd_rek_kelompok`='61',rka_mata_anggaran.`jumlah`,0)) AS jml_penerimaan,
                       sum(if(sikd_rek_kelompok.`kd_rek_kelompok`='62',rka_mata_anggaran.`jumlah`,0)) AS jml_pengeluaran
                    FROM
                       `rka_mata_anggaran` rka_mata_anggaran
                       INNER JOIN `rka_skpkd` rka_skpkd ON rka_mata_anggaran.`rka_rka_id` = rka_skpkd.`id_rka_skpkd`
                       INNER JOIN `rka_rka` rka_rka ON rka_mata_anggaran.`rka_rka_id` = rka_rka.`id_rka_rka`
                       AND rka_rka.rka_perubahan = '0'
                       AND if(:statusRka} = 'Final',(rka_rka.`status_rka` = 1),(rka_rka.`status_rka` = 0 OR rka_rka.`status_rka` = 2))
                       RIGHT OUTER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON rka_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                       INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                       INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                       INNER JOIN `sikd_rek_kelompok` sikd_rek_kelompok ON sikd_rek_jenis.`sikd_rek_kelompok_id` = sikd_rek_kelompok.`id_sikd_rek_kelompok`
                       INNER JOIN `sikd_rek_akun` sikd_rek_akun ON sikd_rek_kelompok.`sikd_rek_akun_id` = sikd_rek_akun.`id_sikd_rek_akun`
                       AND sikd_rek_akun.`kd_rek_akun` in ('6')
                    GROUP BY
                       sikd_rek_akun.`kd_rek_akun`,
                       sikd_rek_akun.`nm_rek_akun`,
                       sikd_rek_kelompok.`kd_rek_kelompok`,
                       sikd_rek_kelompok.`nm_rek_kelompok`,
                       sikd_rek_jenis.`kd_rek_jenis`,
                       sikd_rek_jenis.`nm_rek_jenis`
                    ORDER BY
                       sikd_rek_akun.`kd_rek_akun`,
                       sikd_rek_kelompok.`kd_rek_kelompok`,
                       sikd_rek_jenis.`kd_rek_jenis`
                    ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rka_mata_anggaran", $idRkaMataAnggaran);
            $statement->execute();
            $rkaRekapPpkdPembiayaan = $statement->fetchAll();

            return new JsonResponse($rkaRekapPpkdPembiayaan);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getRkaSkpdBlnjlangsungBant($request) {
        try {
            $idRkaSkpdKgtn = $request->query->get("rka_skpd_kgtn_id");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRkaSkpdKgtn = pack('H*', str_replace('-', '', trim($idRkaSkpdKgtn)));
            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                       CONCAT_WS('-',
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 1, 8),
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 9, 4),
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 13, 4),
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 17, 4),
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 21)
                            ) AS sikd_satker_id_satker,
                       sikd_satker.`kode` AS kd_satker,
                       sikd_satker.`nama` AS nm_satker,
                       CONCAT_WS('-',
                            SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 1, 8),
                            SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 9, 4),
                            SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 13, 4),
                            SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 17, 4),
                            SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 21)
                            ) AS sikd_sub_skpd_id_sub_skpd,
                       sikd_sub_skpd.`kode` AS kd_sub_skpd,
                       sikd_sub_skpd.`nama` AS nm_sub_skpd,
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
                            SUBSTR(HEX(sikd_prog.`id_sikd_prog`), 1, 8),
                            SUBSTR(HEX(sikd_prog.`id_sikd_prog`), 9, 4),
                            SUBSTR(HEX(sikd_prog.`id_sikd_prog`), 13, 4),
                            SUBSTR(HEX(sikd_prog.`id_sikd_prog`), 17, 4),
                            SUBSTR(HEX(sikd_prog.`id_sikd_prog`), 21)
                            ) AS sikd_prog_id_sikd_prog,
                       concat(sikd_bidang.kd_bidang,".",sikd_prog.`kd_prog`) AS sikd_prog_kd_prog,
                       sikd_prog.`nm_prog` AS sikd_prog_nm_prog,
                       CONCAT_WS('-',
                            SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 1, 8),
                            SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 9, 4),
                            SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 13, 4),
                            SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 17, 4),
                            SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 21)
                            ) AS sikd_kgtn_id_sikd_kgtn,
                       substring(sikd_kgtn.`kd_kgtn`,3,3)AS sikd_kgtn_kd_kgtn_,
                       if(length(sikd_kgtn.`kd_kgtn`) = 4, substring(sikd_kgtn.`kd_kgtn`,3,2),
                       if(length(sikd_kgtn.`kd_kgtn`) = 5, substring(sikd_kgtn.`kd_kgtn`,3,3), substring(sikd_kgtn.`kd_kgtn`,3,4)))AS sikd_kgtn_kd_kgtn,
                       sikd_kgtn.`nm_kgtn` AS sikd_kgtn_nm_kgtn,
                       CONCAT_WS('-',
                            SUBSTR(HEX(rka_skpd_kgtn.`id_rka_skpd_kgtn`), 1, 8),
                            SUBSTR(HEX(rka_skpd_kgtn.`id_rka_skpd_kgtn`), 9, 4),
                            SUBSTR(HEX(rka_skpd_kgtn.`id_rka_skpd_kgtn`), 13, 4),
                            SUBSTR(HEX(rka_skpd_kgtn.`id_rka_skpd_kgtn`), 17, 4),
                            SUBSTR(HEX(rka_skpd_kgtn.`id_rka_skpd_kgtn`), 21)
                            ) AS id_rka_skpd_kgtn,
                       LPAD(IFNULL(trim(rka_skpd_kgtn.`no_subkegiatan`),''),3,0) AS rka_skpd_kgtn_no_subkegiatan,
                       IFNULL(TRIM(rka_skpd_kgtn.`nm_subkegiatan`),'') AS rka_skpd_kgtn_nm_subkegiatan,
                       IF(length(TRIM(rka_skpd_kgtn.lokasi_kgtn)) != '', rka_skpd_kgtn.lokasi_kgtn, concat(sikd_pemda.klasifikasi,' ',sikd_pemda.nm_daerah)) AS nm_lokasi_kgtn,
                       IF(length(TRIM(rka_skpd_kgtn.`target_kinerja`)) != '', rka_skpd_kgtn.`target_kinerja`, '') AS rka_skpd_kgtn_target_kinerja,
                       IFNULL((Select GROUP_CONCAT(DISTINCT b.lokasi_kgtn ORDER BY lpad(b.no_subkegiatan,3,0) DESC SEPARATOR ' ; ')
                            From rka_rka a, rka_skpd_kgtn b
                            Where a.no_rka = rka_rka.no_rka 
                            and a.sikd_sub_satker_id = rka_rka.sikd_sub_satker_id 
                            and a.id_rka_rka = b.id_rka_skpd_kgtn), concat(sikd_pemda.klasifikasi,' ',sikd_pemda.nm_daerah)) AS rka_skpd_kgtn_lokasi_kgtn_rekap,
                       IFNULL(target_hasil.target_kinerja, '-') AS rka_skpd_kgtn_target_hasil,
                       IFNULL(target_keluaran.target_kinerja, '-') AS rka_skpd_kgtn_target_kinerja_rekap,
                       IFNULL(rka_skpd_kgtn.`jml_thn_ssdh`,0)AS rka_skpd_kgtn_jml_thn_ssdh,
                       if(:statusRka='1','',if(:statusRka='2','DITOLAK',
                       if(:statusRka='0','DRAFT','SEMUA'))) AS status_rka,
                       sum(if(substring(sikd_rek_rincian_obj.`kd_rek_rincian_obj`,1,3)='521',rka_mata_anggaran.`jumlah`,0)) AS jml_blnj_pegawai,
                       sum(if(substring(sikd_rek_rincian_obj.`kd_rek_rincian_obj`,1,3)='522',rka_mata_anggaran.`jumlah`,0)) AS jml_blnj_barang,
                       sum(if(substring(sikd_rek_rincian_obj.`kd_rek_rincian_obj`,1,3)='523',rka_mata_anggaran.`jumlah`,0)) AS jml_blnj_modal,
                       sum(if(substring(sikd_rek_rincian_obj.`kd_rek_rincian_obj`,1,2)='52',rka_mata_anggaran.`jumlah`,0)) AS jumlah
                    FROM
                       `rka_skpd` rka_skpd
                       INNER JOIN `sikd_satker` sikd_satker ON rka_skpd.`sikd_skpd_id` = sikd_satker.`id_sikd_satker`
                       AND rka_skpd.`sikd_skpd_id` = :idSatker
                       AND IF(:idSatker != '', rka_skpd.`sikd_sub_skpd_id` LIKE :idSubSkpd, 1)
                       AND IF(:idBidang != '', rka_skpd.`sikd_bidang_id` = :idBidang, 1)
                       LEFT OUTER JOIN sikd_sub_skpd sikd_sub_skpd ON rka_skpd.sikd_sub_skpd_id = sikd_sub_skpd.id_sikd_sub_skpd
                       INNER JOIN `sikd_bidang` sikd_bidang ON rka_skpd.`sikd_bidang_id` = sikd_bidang.id_sikd_bidang
                       INNER JOIN `rka_skpd_kgtn` rka_skpd_kgtn ON rka_skpd.`id_rka_skpd` = rka_skpd_kgtn.`id_rka_skpd_kgtn`
                       INNER JOIN `rka_rka` rka_rka ON rka_skpd.`id_rka_skpd` = rka_rka.`id_rka_rka`
                       AND rka_rka.rka_perubahan = '0'
                       AND if(:statusRka='-1', rka_rka.`status_rka` like '%', rka_rka.`status_rka` = :statusRka)
                       INNER JOIN `sikd_kgtn` sikd_kgtn ON rka_skpd_kgtn.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                       INNER JOIN `rka_mata_anggaran` rka_mata_anggaran ON rka_skpd_kgtn.`id_rka_skpd_kgtn` = rka_mata_anggaran.`rka_rka_id`
                       LEFT OUTER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON rka_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                       AND sikd_rek_rincian_obj.`kd_rek_rincian_obj` like '52%'
                       INNER JOIN `sikd_prog` ON sikd_kgtn.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                       LEFT OUTER JOIN (select rka_skpd_kgtn_id, GROUP_CONCAT(c.no_indikator,'. ', c.uraian, ',  ', c.target, ' ', c.satuan 
                    ORDER BY lpad(b.no_subkegiatan,3,0) DESC, c.no_indikator ASC SEPARATOR ' ;\n ') as target_kinerja
                       from rka_rka a, rka_skpd_kgtn b, rka_skpd_indktr_kinerja c
                       Where a.rka_perubahan = '0' 
                        and a.sikd_satker_id = :idSatker 
               		and a.sikd_sub_satker_id like != :idSubSkpd 
               		and a.id_rka_rka = b.id_rka_skpd_kgtn
               		and b.id_rka_skpd_kgtn = c.rka_skpd_kgtn_id
               		and c.sikd_klpk_indikator_id = '3'
		      group by rka_skpd_kgtn_id) AS target_keluaran
                    ON target_keluaran.rka_skpd_kgtn_id = rka_skpd_kgtn.`id_rka_skpd_kgtn`
                    LEFT OUTER JOIN (select d.sikd_prog_id, GROUP_CONCAT(c.no_indikator,'. ', c.uraian, ',  ', c.target, ' ', c.satuan 
		    ORDER BY d.sikd_prog_id DESC, c.no_indikator ASC SEPARATOR ' ;\n ') as target_kinerja
		      from rka_rka a, rka_skpd_kgtn b, rka_skpd_indktr_kinerja c, sikd_kgtn d
             	      Where a.rka_perubahan = '0' 
               		and a.sikd_satker_id = :idSatker 
               		and a.sikd_sub_satker_id like !=:idSubSkpd 
               		and a.id_rka_rka = b.id_rka_skpd_kgtn
               		and b.id_rka_skpd_kgtn = c.rka_skpd_kgtn_id
               		and c.sikd_klpk_indikator_id = '4'
               		and b.sikd_kgtn_id = d.id_sikd_kgtn
		      group by sikd_prog_id) AS target_hasil
                    ON target_hasil.sikd_prog_id = sikd_prog.`id_sikd_prog`
                    LEFT OUTER JOIN `sikd_pemda` sikd_pemda ON sikd_pemda.id_sikd_pemda = '1'
                    GROUP BY
                       sikd_bidang.`kd_bidang`,
                       sikd_prog.`kd_prog`,
                       sikd_kgtn.`kd_kgtn`,
                       rka_skpd_kgtn.`id_rka_skpd_kgtn`
                    ORDER BY
                       if(sikd_bidang.`kd_bidang`=sikd_satker.kd_bidang_induk, 1, 2) ASC,
                       sikd_bidang.`kd_bidang`,
                       sikd_prog.`kd_prog` ASC,
                       sikd_kgtn.`kd_kgtn` ASC,
                       lpad(rka_skpd_kgtn.`no_subkegiatan`,3,0) ASC,
                       rka_skpd_kgtn.`id_rka_skpd_kgtn`
                    ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("rka_skpd_kgtn_id", $idRkaSkpdKgtn);
            $statement->execute();
            $rkaSkpdBlnjlangsungBant = $statement->fetchAll();

            return new JsonResponse($rkaSkpdBlnjlangsungBant);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getRkaRincMataAnggaran($request) {
        try {
            $id_rka_mata_anggaran = $request->query->get("id_rka_mata_anggaran");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $id_rka_mata_anggaran = pack('H*', str_replace('-', '', trim($id_rka_mata_anggaran)));
            
            $this->connection = $conn->getConnection();

            $sql = 
                "SELECT
                    CONCAT_WS('-',
                            SUBSTR(HEX(rka_rincian_mata_anggaran.`rka_mata_anggaran_id`), 1, 8),
                            SUBSTR(HEX(rka_rincian_mata_anggaran.`rka_mata_anggaran_id`), 9, 4),
                            SUBSTR(HEX(rka_rincian_mata_anggaran.`rka_mata_anggaran_id`), 13, 4),
                            SUBSTR(HEX(rka_rincian_mata_anggaran.`rka_mata_anggaran_id`), 17, 4),
                            SUBSTR(HEX(rka_rincian_mata_anggaran.`rka_mata_anggaran_id`), 21)
                            ) AS rka_rincian_mata_anggaran_rka_mata_anggaran_id,
                    rka_rincian_mata_anggaran.`no_item_h` AS rka_rincian_mata_anggaran_no_item_h,
                    rka_rincian_mata_anggaran.`no_item_s` AS rka_rincian_mata_anggaran_no_item_s,
                    rka_rincian_mata_anggaran.`no_item` AS rka_rincian_mata_anggaran_no_item,
                    rka_rincian_mata_anggaran.`jns_item` AS rka_rincian_mata_anggaran_jns_item,
                    rka_rincian_mata_anggaran.`header` AS rka_rincian_mata_anggaran_header,
                    rka_rincian_mata_anggaran.`subheader` AS rka_rincian_mata_anggaran_subheader,
                    rka_rincian_mata_anggaran.`uraian` AS rka_rincian_mata_anggaran_uraian,
                    rka_rincian_mata_anggaran.`volume` AS rka_rincian_mata_anggaran_volume,
                    rka_rincian_mata_anggaran.`satuan` AS rka_rincian_mata_anggaran_satuan,
                    rka_rincian_mata_anggaran.`harga` AS rka_rincian_mata_anggaran_harga,
                    rka_rincian_mata_anggaran.`jumlah` AS rka_rincian_mata_anggaran_jumlah
                FROM
                    `rka_rincian_mata_anggaran` rka_rincian_mata_anggaran 
                WHERE
                    rka_rincian_mata_anggaran.`rka_mata_anggaran_id` = :id_rka_mata_anggaran
                GROUP BY
                    rka_rincian_mata_anggaran.`no_item_h`,
                    rka_rincian_mata_anggaran.`no_item_s`,
                    rka_rincian_mata_anggaran.`no_item`
                ORDER BY
                    cast(rka_rincian_mata_anggaran.`no_item_h` as unsigned),
                    cast(rka_rincian_mata_anggaran.`no_item_s` as unsigned),
                    cast(rka_rincian_mata_anggaran.`no_item` as unsigned)
                ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rka_mata_anggaran", $id_rka_mata_anggaran);
            $statement->execute();
            $rkaRincMataAnggaran = $statement->fetchAll();

            return new JsonResponse($rkaRincMataAnggaran);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }  
    }
    
    private function getRkaSkpdBlnjTdkLangsung($request) {
        try {
            $id_rka_rka = $request->query->get("id_rka_rka");
            $id_rka_rka = pack('H*', str_replace('-', '', trim($id_rka_rka)));

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                         rka_rka.nm_kegiatan AS rka_skpd_kgtn_nm_kegiatan,
                         ifnull(rka_rka.`lokasi_kgtn`,0) AS rka_skpd_kgtn_lokasi_kgtn,
                         ifnull(rka_rka.`jml_anggaran`,0),
                         ifnull(rka_rka.`jml_thn_sblm`,0),
                         ifnull(rka_rka.`jml_thn_ssdh`,0),
                         rka_rka.`klpk_sasaran` AS rka_skpd_kgtn_klpk_sasaran,
                         CONCAT_WS('-',
                            SUBSTR(HEX(rka_rka.`sikd_satker_id`), 1, 8),
                            SUBSTR(HEX(rka_rka.`sikd_satker_id`), 9, 4),
                            SUBSTR(HEX(rka_rka.`sikd_satker_id`), 13, 4),
                            SUBSTR(HEX(rka_rka.`sikd_satker_id`), 17, 4),
                            SUBSTR(HEX(rka_rka.`sikd_satker_id`), 21)
                            ) AS rka_skpd_sikd_skpd_id,
                         CONCAT_WS('-',
                            SUBSTR(HEX(rka_rka.`sikd_sub_satker_id`), 1, 8),
                            SUBSTR(HEX(rka_rka.`sikd_sub_satker_id`), 9, 4),
                            SUBSTR(HEX(rka_rka.`sikd_sub_satker_id`), 13, 4),
                            SUBSTR(HEX(rka_rka.`sikd_sub_satker_id`), 17, 4),
                            SUBSTR(HEX(rka_rka.`sikd_sub_satker_id`), 21)
                            ) AS rka_skpd_sikd_sub_skpd_id,
                         CONCAT_WS('-',
                            SUBSTR(HEX(rka_rka.`sikd_bidang_id`), 1, 8),
                            SUBSTR(HEX(rka_rka.`sikd_bidang_id`), 9, 4),
                            SUBSTR(HEX(rka_rka.`sikd_bidang_id`), 13, 4),
                            SUBSTR(HEX(rka_rka.`sikd_bidang_id`), 17, 4),
                            SUBSTR(HEX(rka_rka.`sikd_bidang_id`), 21)
                            ) AS rka_skpd_sikd_bidang_id,
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
                         CONCAT_WS('-',
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 1, 8),
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 9, 4),
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 13, 4),
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 17, 4),
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 21)
                            ) AS sikd_rek_jenis_id_sikd_rek_jenis,
                         sikd_rek_jenis.`kd_rek_jenis` AS sikd_rek_jenis_kd_rek_jenis,
                         sikd_rek_jenis.`nm_rek_jenis` AS sikd_rek_jenis_nm_rek_jenis,
                         CONCAT_WS('-',
                            SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 1, 8),
                            SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 9, 4),
                            SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 13, 4),
                            SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 17, 4),
                            SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 21)
                            ) AS sikd_rek_obj_id_sikd_rek_obj,
                         sikd_rek_obj.`kd_rek_obj` AS sikd_rek_obj_kd_rek_obj,
                         sikd_rek_obj.`nm_rek_obj` AS sikd_rek_obj_nm_rek_obj,
                         CONCAT_WS('-',
                            SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 1, 8),
                            SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 9, 4),
                            SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 13, 4),
                            SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 17, 4),
                            SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 21)
                            ) AS sikd_rek_rincian_obj_id_sikd_rek_rincian_obj,
                         sikd_rek_rincian_obj.`kd_rek_rincian_obj` AS sikd_rek_rincian_obj_kd_rek_rincian_obj,
                         sikd_rek_rincian_obj.`nm_rek_rincian_obj` AS sikd_rek_rincian_obj_nm_rek_rincian_obj,
                         rka_rincian_mata_anggaran.`uraian` AS rka_rincian_mata_anggaran_uraian,
                         rka_rincian_mata_anggaran.`volume` AS rka_rincian_mata_anggaran_volume,
                         rka_rincian_mata_anggaran.`satuan` AS rka_rincian_mata_anggaran_satuan,
                         rka_rincian_mata_anggaran.`harga` AS rka_rincian_mata_anggaran_harga,
                         rka_rincian_mata_anggaran.`jumlah` AS rka_rincian_mata_anggaran_jumlah,
                         if(rka_rka.`status_rka` = '0', 'DRAFT',if(rka_rka.`status_rka` = '2', 'DITOLAK', '')) AS rka_status_rka,
                         rka_rka.`keterangan` AS rka_keterangan,
                         rka_rincian_mata_anggaran.`header` AS rka_rincian_mata_anggaran_header,
                         rka_rincian_mata_anggaran.`subheader` AS rka_rincian_mata_anggaran_subheader,
                         rka_mata_anggaran.`volume` AS rka_mata_anggaran_volume,
                         rka_mata_anggaran.`satuan` AS rka_mata_anggaran_satuan,
                         rka_mata_anggaran.`harga` AS rka_mata_anggaran_harga,
                         rka_mata_anggaran.`jumlah` AS rka_mata_anggaran_jumlah,
                         rka_mata_anggaran.`jml_thn_ssdh` AS rka_mata_anggaran_jml_thn_ssdh,
                         rka_rka.rka_perubahan AS rka_perubahan,
                         CONCAT_WS('-',
                            SUBSTR(HEX(rka_rka.id_rka_rka), 1, 8),
                            SUBSTR(HEX(rka_rka.`id_rka_rka`), 9, 4),
                            SUBSTR(HEX(rka_rka.`id_rka_rka`), 13, 4),
                            SUBSTR(HEX(rka_rka.`id_rka_rka`), 17, 4),
                            SUBSTR(HEX(rka_rka.`id_rka_rka`), 21)
                            ) AS rka_rka_id_rka_rka
                    FROM
                         `rka_rka` rka_rka
                         INNER JOIN `rka_mata_anggaran` rka_mata_anggaran ON rka_rka.`id_rka_rka` = rka_mata_anggaran.rka_rka
                         LEFT OUTER JOIN `rka_rincian_mata_anggaran` rka_rincian_mata_anggaran ON rka_mata_anggaran.`id_rka_mata_anggaran` = rka_rincian_mata_anggaran.`rka_mata_anggaran_id`
                         INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON rka_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                         INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                         INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                         INNER JOIN `sikd_rek_kelompok` sikd_rek_kelompok ON sikd_rek_jenis.`sikd_rek_kelompok_id` = sikd_rek_kelompok.`id_sikd_rek_kelompok`
                         INNER JOIN `sikd_rek_akun` sikd_rek_akun ON sikd_rek_kelompok.`sikd_rek_akun_id` = sikd_rek_akun.`id_sikd_rek_akun`
                    WHERE
                         rka_rka.`id_rka_rka` =:id_rka_rka
                         AND rka_rka.rka_rka_type = 'RkaSkpdBlnjTdkLangsung'
                    ORDER BY
                         rka_mata_anggaran.kd_rekening ASC
                    ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rka_rka", $id_rka_rka);
            $statement->execute();
            $rkaSkpdBlnjTdkLangsung = $statement->fetchAll();

            return new JsonResponse($rkaSkpdBlnjTdkLangsung);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getRkaSkpdIndktrKnrjRenja($request) {
        try {
            $idRkaSkpdKgtn = $request->query->get("id_rka_skpd_kgtn");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRkaSkpdKgtn = pack('H*', str_replace('-', '', trim($idRkaSkpdKgtn)));
            
            $this->connection = $conn->getConnection();

            $sql = 
                "SELECT '02' AS kd_klpk_indikator,
                    'Masukan' AS nm_klpk_indikator,
                    '' AS no_indikator,
                    'Dana / Anggaran' AS uraian,
                    sum(ifnull(rka_mata_anggaran.jumlah, 0)) AS target,
                    'Rp.' AS satuan
                FROM
                    `rka_skpd_kgtn` rka_skpd_kgtn
                    INNER JOIN `rka_rka` rka_rka ON rka_skpd_kgtn.id_rka_skpd_kgtn = rka_rka.id_rka_rka
                    AND rka_rka.`id_rka_rka` = :idRka
                    INNER JOIN `rka_mata_anggaran` rka_mata_anggaran ON rka_rka.`id_rka_rka` = rka_mata_anggaran.rka_rka_id
                    RIGHT OUTER JOIN `rapbd_rapbd` rapbd_rapbd ON rka_rka.rapbd_rapbd_id = rapbd_rapbd.id_rapbd_rapbd
                UNION
                SELECT
                    sikd_klpk_indikator.`kd_klpk_indikator` AS kd_klpk_indikator,
                    sikd_klpk_indikator.`nm_klpk_indikator` AS nm_klpk_indikator,
                    rka_skpd_indktr_kinerja.`no_indikator` AS no_indikator,
                    rka_skpd_indktr_kinerja.`uraian` AS uraian,
                    rka_skpd_indktr_kinerja.`target` AS target,
                    rka_skpd_indktr_kinerja.`satuan` AS satuan
                FROM
                    `rka_skpd_kgtn` rka_skpd_kgtn
                    INNER JOIN `rka_rka` rka_rka ON rka_skpd_kgtn.id_rka_skpd_kgtn = rka_rka.id_rka_rka
                    AND rka_rka.`id_rka_rka` = :idRka
                    INNER JOIN `rka_skpd_indktr_kinerja` rka_skpd_indktr_kinerja ON rka_skpd_kgtn.id_rka_skpd_kgtn = rka_skpd_indktr_kinerja.rka_skpd_kgtn_id
                    INNER JOIN `sikd_klpk_indikator` sikd_klpk_indikator ON rka_skpd_indktr_kinerja.`sikd_klpk_indikator_id` = sikd_klpk_indikator.`id_sikd_klpk_indikator`
                    AND sikd_klpk_indikator.`kd_klpk_indikator` IN ('_02','03')
                    RIGHT OUTER JOIN `rapbd_rapbd` rapbd_rapbd ON rka_rka.rapbd_rapbd_id = rapbd_rapbd.id_rapbd_rapbd
                UNION
                SELECT
                    '04' AS kd_klpk_indikator,
                    'Hasil' AS nm_klpk_indikator,
                    renja_program_indikator.`no_indikator` AS no_indikator,
                    renja_program_indikator.`uraian_indikator` AS uraian,
                    renja_program_indikator.`target_thn_ini` AS target,
                    renja_program_indikator.`satuan` AS satuan
                FROM
                    `rka_skpd_kgtn` rka_skpd_kgtn
                    INNER JOIN `rka_rka` rka_rka ON rka_skpd_kgtn.id_rka_skpd_kgtn = rka_rka.id_rka_rka
                    AND `rka_rka`.`id_rka_rka` = :idRka
                    INNER JOIN `ppas_blnj_langsung` ppas_blnj_langsung ON rka_skpd_kgtn.ppas_blnj_langsung_id = ppas_blnj_langsung.id_ppas_blnj_langsung
                    INNER JOIN `rkpd_kegiatan` rkpd_kegiatan ON ppas_blnj_langsung.rkpd_kegiatan_id = rkpd_kegiatan.id_rkpd_kegiatan
                    INNER JOIN `renja_kegiatan` renja_kegiatan ON rkpd_kegiatan.id_rkpd_kegiatan = renja_kegiatan.rkpd_kegiatan_id
                    INNER JOIN `renja_program` renja_program ON renja_kegiatan.renja_program_id = renja_program.id_renja_program
                    INNER JOIN `renja_program_indikator` renja_program_indikator ON renja_program.id_renja_program = renja_program_indikator.renja_program_id
                    RIGHT OUTER JOIN `rapbd_rapbd` rapbd_rapbd ON rka_rka.rapbd_rapbd_id = rapbd_rapbd.id_rapbd_rapbd
                ORDER BY
                    kd_klpk_indikator,
                    no_indikator
                ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rka_skpd_kgtn", $idRkaSkpdKgtn);
            $statement->execute();
            $rkaSkpdIndktrKnrjRenja = $statement->fetchAll();

            return new JsonResponse($rkaSkpdIndktrKnrjRenja);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }  
    }
    
    private function getRkaSkpdIndktrKnrj($request) {
        try {
            $id_rka_rka = $request->query->get("id_rka_rka");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $id_rka_rka = pack('H*', str_replace('-', '', trim($id_rka_rka)));
            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                     CONCAT_WS('-',
                            SUBSTR(HEX(rka_skpd_indktr_kinerja.`sikd_klpk_indikator_id`), 1, 8),
                            SUBSTR(HEX(rka_skpd_indktr_kinerja.`sikd_klpk_indikator_id`), 9, 4),
                            SUBSTR(HEX(rka_skpd_indktr_kinerja.`sikd_klpk_indikator_id`), 13, 4),
                            SUBSTR(HEX(rka_skpd_indktr_kinerja.`sikd_klpk_indikator_id`), 17, 4),
                            SUBSTR(HEX(rka_skpd_indktr_kinerja.`sikd_klpk_indikator_id`), 21)
                            ) AS sikd_klpk_indikator_id,
                     rka_skpd_indktr_kinerja.`no_indikator` AS rka_skpd_indktr_kinerja_no_indikator,
                     rka_skpd_indktr_kinerja.`uraian_indikator` AS rka_skpd_indktr_kinerja_uraian,
                     rka_skpd_indktr_kinerja.`target` AS rka_skpd_indktr_kinerja_target,
                     ifnull (rka_skpd_indktr_kinerja.`satuan`,'') AS rka_skpd_indktr_kinerja_satuan,
                     ifnull (rka_skpd_indktr_kinerja.`target`,0) AS rka_skpd_indktr_kinerja_target,
                     sikd_klpk_indikator.`nm_klpk_indikator` AS sikd_klpk_indikator_nm_klpk_indikator
                FROM
                     `rka_skpd_indktr_kinerja` rka_skpd_indktr_kinerja 
                      RIGHT OUTER JOIN `sikd_klpk_indikator` sikd_klpk_indikator ON rka_skpd_indktr_kinerja.`sikd_klpk_indikator_id` = sikd_klpk_indikator.`id_sikd_klpk_indikator`
                      AND `rka_skpd_indktr_kinerja`.`rka_skpd_kgtn_id` = :id_rka_rka
                ORDER BY
                      sikd_klpk_indikator.`id_sikd_klpk_indikator`,
                      rka_skpd_indktr_kinerja.`no_indikator`";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rka_rka", $id_rka_rka);
            $statement->execute();
            $rkaSkpdIndktrKnrj = $statement->fetchAll();

            return new JsonResponse($rkaSkpdIndktrKnrj);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }  
    }
    
    private function getRkaSkpdPendapatan($request) {
        try {
            $id_rka_rka = $request->query->get("id_rka_rka");
            $tahun = $request->query->get("tahun");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $id_rka_rka = pack('H*', str_replace('-', '', trim($id_rka_rka)));
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                          CONCAT_WS('-',
                            SUBSTR(HEX(rka_mata_anggaran.`id_rka_mata_anggaran`), 1, 8),
                            SUBSTR(HEX(rka_mata_anggaran.`id_rka_mata_anggaran`), 9, 4),
                            SUBSTR(HEX(rka_mata_anggaran.`id_rka_mata_anggaran`), 13, 4),
                            SUBSTR(HEX(rka_mata_anggaran.`id_rka_mata_anggaran`), 17, 4),
                            SUBSTR(HEX(rka_mata_anggaran.`id_rka_mata_anggaran`), 21)
                            ) AS rka_mata_anggaran_id_rka_mata_anggaran,
                         CONCAT_WS('-',
                            SUBSTR(HEX(rka_rka.`sikd_satker_id`), 1, 8),
                            SUBSTR(HEX(rka_rka.`sikd_satker_id`), 9, 4),
                            SUBSTR(HEX(rka_rka.`sikd_satker_id`), 13, 4),
                            SUBSTR(HEX(rka_rka.`sikd_satker_id`), 17, 4),
                            SUBSTR(HEX(rka_rka.`sikd_satker_id`), 21)
                            ) AS rka_skpd_sikd_skpd_id,
                         CONCAT_WS('-',
                            SUBSTR(HEX(rka_rka.`sikd_sub_satker_id`), 1, 8),
                            SUBSTR(HEX(rka_rka.`sikd_sub_satker_id`), 9, 4),
                            SUBSTR(HEX(rka_rka.`sikd_sub_satker_id`), 13, 4),
                            SUBSTR(HEX(rka_rka.`sikd_sub_satker_id`), 17, 4),
                            SUBSTR(HEX(rka_rka.`sikd_sub_satker_id`), 21)
                            ) AS rka_skpd_sikd_sub_skpd_id,
                         CONCAT_WS('-',
                            SUBSTR(HEX(rka_rka.`sikd_bidang_id`), 1, 8),
                            SUBSTR(HEX(rka_rka.`sikd_bidang_id`), 9, 4),
                            SUBSTR(HEX(rka_rka.`sikd_bidang_id`), 13, 4),
                            SUBSTR(HEX(rka_rka.`sikd_bidang_id`), 17, 4),
                            SUBSTR(HEX(rka_rka.`sikd_bidang_id`), 21)
                            ) AS rka_skpd_sikd_bidang_id,
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
                         CONCAT_WS('-',
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 1, 8),
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 9, 4),
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 13, 4),
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 17, 4),
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 21)
                            ) AS sikd_rek_jenis_id_sikd_rek_jenis,
                         sikd_rek_jenis.`kd_rek_jenis` AS sikd_rek_jenis_kd_rek_jenis,
                         sikd_rek_jenis.`nm_rek_jenis` AS sikd_rek_jenis_nm_rek_jenis,
                         CONCAT_WS('-',
                            SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 1, 8),
                            SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 9, 4),
                            SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 13, 4),
                            SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 17, 4),
                            SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 21)
                            ) AS sikd_rek_obj_id_sikd_rek_obj,
                         sikd_rek_obj.`kd_rek_obj` AS sikd_rek_obj_kd_rek_obj,
                         sikd_rek_obj.`nm_rek_obj` AS sikd_rek_obj_nm_rek_obj,
                         CONCAT_WS('-',
                            SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 1, 8),
                            SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 9, 4),
                            SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 13, 4),
                            SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 17, 4),
                            SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 21)
                            ) AS sikd_rek_rincian_obj_id_sikd_rek_rincian_obj,
                         sikd_rek_rincian_obj.`kd_rek_rincian_obj` AS sikd_rek_rincian_obj_kd_rek_rincian_obj,
                         sikd_rek_rincian_obj.`nm_rek_rincian_obj` AS sikd_rek_rincian_obj_nm_rek_rincian_obj,
                         if(rka_rka.`status_rka` = '0', 'DRAFT',if(rka_rka.`status_rka` = '2', 'DITOLAK', '')) AS rka_status_rka,
                         rka_rka.`keterangan` AS rka_keterangan,
                         CONCAT_WS('-',
                            SUBSTR(HEX(rka_mata_anggaran.`id_rka_mata_anggaran`), 1, 8),
                            SUBSTR(HEX(rka_mata_anggaran.`id_rka_mata_anggaran`), 9, 4),
                            SUBSTR(HEX(rka_mata_anggaran.`id_rka_mata_anggaran`), 13, 4),
                            SUBSTR(HEX(rka_mata_anggaran.`id_rka_mata_anggaran`), 17, 4),
                            SUBSTR(HEX(rka_mata_anggaran.`id_rka_mata_anggaran`), 21)
                            ) AS id_rka_mata_anggaran,
                         rka_mata_anggaran.`volume` AS rka_mata_anggaran_volume,
                         rka_mata_anggaran.`satuan` AS rka_mata_anggaran_satuan,
                         rka_mata_anggaran.`harga` AS rka_mata_anggaran_harga,
                         ifnull(rka_mata_anggaran.`jumlah`,0) AS rka_mata_anggaran_jumlah,
                         rka_rka.rka_rka_type,
                         CONCAT_WS('-',
                            SUBSTR(HEX(rka_rka.id_rka_rka), 1, 8),
                            SUBSTR(HEX(rka_rka.`id_rka_rka`), 9, 4),
                            SUBSTR(HEX(rka_rka.`id_rka_rka`), 13, 4),
                            SUBSTR(HEX(rka_rka.`id_rka_rka`), 17, 4),
                            SUBSTR(HEX(rka_rka.`id_rka_rka`), 21)
                            ) AS rka_rka_id_rka_rka
                    FROM
                         `rka_rka` rka_rka
                         INNER JOIN `rka_mata_anggaran` rka_mata_anggaran ON rka_rka.`id_rka_rka` = rka_mata_anggaran.rka_rka
                         INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON rka_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                         INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                         INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                         INNER JOIN `sikd_rek_kelompok` sikd_rek_kelompok ON sikd_rek_jenis.`sikd_rek_kelompok_id` = sikd_rek_kelompok.`id_sikd_rek_kelompok`
                         INNER JOIN `sikd_rek_akun` sikd_rek_akun ON sikd_rek_kelompok.`sikd_rek_akun_id` = sikd_rek_akun.`id_sikd_rek_akun`
                    WHERE
                         rka_rka.id_rka_rka = :id_rka_rka
                         AND rka_rka.rka_rka_type = 'RkaSkpdPendapatan'
                    ORDER BY
                         rka_mata_anggaran.`kd_rekening` ASC
                    ";

                    //WHERE
                         //rka_mata_anggaran.id_rka_mata_anggaran = :id_rka_rka
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rka_rka", $id_rka_rka);
            $statement->execute();
            $rkaSkpdPendapatan = $statement->fetchAll();

            return new JsonResponse($rkaSkpdPendapatan);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
        
    }
    
    private function getRkaSkpkdBlnjTdkLangsung($request) {
        try {
            $id_rka_rka = $request->query->get("id_rka_rka");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $id_rka_rka = pack('H*', str_replace('-', '', trim($id_rka_rka)));
            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                         CONCAT_WS('-',
                            SUBSTR(HEX(rka_rka.`sikd_satker_id`), 1, 8),
                            SUBSTR(HEX(rka_rka.`sikd_satker_id`), 9, 4),
                            SUBSTR(HEX(rka_rka.`sikd_satker_id`), 13, 4),
                            SUBSTR(HEX(rka_rka.`sikd_satker_id`), 17, 4),
                            SUBSTR(HEX(rka_rka.`sikd_satker_id`), 21)
                            ) AS rka_skpd_sikd_skpkd_id,
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
                         CONCAT_WS('-',
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 1, 8),
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 9, 4),
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 13, 4),
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 17, 4),
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 21)
                            ) AS sikd_rek_jenis_id_sikd_rek_jenis,
                         sikd_rek_jenis.`kd_rek_jenis` AS sikd_rek_jenis_kd_rek_jenis,
                         sikd_rek_jenis.`nm_rek_jenis` AS sikd_rek_jenis_nm_rek_jenis,
                         CONCAT_WS('-',
                            SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 1, 8),
                            SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 9, 4),
                            SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 13, 4),
                            SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 17, 4),
                            SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 21)
                            ) AS sikd_rek_obj_id_sikd_rek_obj,
                         sikd_rek_obj.`kd_rek_obj` AS sikd_rek_obj_kd_rek_obj,
                         sikd_rek_obj.`nm_rek_obj` AS sikd_rek_obj_nm_rek_obj,
                         CONCAT_WS('-',
                            SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 1, 8),
                            SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 9, 4),
                            SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 13, 4),
                            SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 17, 4),
                            SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 21)
                            ) AS sikd_rek_rincian_obj_id_sikd_rek_rincian_obj,
                         sikd_rek_rincian_obj.`kd_rek_rincian_obj` AS sikd_rek_rincian_obj_kd_rek_rincian_obj,
                         sikd_rek_rincian_obj.`nm_rek_rincian_obj` AS sikd_rek_rincian_obj_nm_rek_rincian_obj,
                         CONCAT_WS('-',
                            SUBSTR(HEX(rka_mata_anggaran.`id_rka_mata_anggaran`), 1, 8),
                            SUBSTR(HEX(rka_mata_anggaran.`id_rka_mata_anggaran`), 9, 4),
                            SUBSTR(HEX(rka_mata_anggaran.`id_rka_mata_anggaran`), 13, 4),
                            SUBSTR(HEX(rka_mata_anggaran.`id_rka_mata_anggaran`), 17, 4),
                            SUBSTR(HEX(rka_mata_anggaran.`id_rka_mata_anggaran`), 21)
                            ) AS id_rka_mata_anggaran,
                         if(rka_rka.`status_rka` = '0', 'DRAFT',if(rka_rka.`status_rka` = '2', 'DITOLA', '')) AS rka_status_rka,
                         rka_rka.`keterangan` AS rka_keterangan,
                         CONCAT_WS('-',
                            SUBSTR(HEX(rka_mata_anggaran.`id_rka_mata_anggaran`), 1, 8),
                            SUBSTR(HEX(rka_mata_anggaran.`id_rka_mata_anggaran`), 9, 4),
                            SUBSTR(HEX(rka_mata_anggaran.`id_rka_mata_anggaran`), 13, 4),
                            SUBSTR(HEX(rka_mata_anggaran.`id_rka_mata_anggaran`), 17, 4),
                            SUBSTR(HEX(rka_mata_anggaran.`id_rka_mata_anggaran`), 21)
                            ) AS id_rka_mata_anggaran,
                         rka_mata_anggaran.`volume` AS rka_mata_anggaran_volume,
                         rka_mata_anggaran.`satuan` AS rka_mata_anggaran_satuan,
                         rka_mata_anggaran.`harga` AS rka_mata_anggaran_harga,
                         rka_mata_anggaran.`jumlah` AS rka_mata_anggaran_jumlah,
                         rka_mata_anggaran.`jml_thn_ssdh` AS rka_mata_anggaran_jml_thn_ssdh,
                         CONCAT_WS('-',
                            SUBSTR(HEX(rka_rka.`id_rka_rka`), 1, 8),
                            SUBSTR(HEX(rka_rka.`id_rka_rka`), 9, 4),
                            SUBSTR(HEX(rka_rka.`id_rka_rka`), 13, 4),
                            SUBSTR(HEX(rka_rka.`id_rka_rka`), 17, 4),
                            SUBSTR(HEX(rka_rka.`id_rka_rka`), 21)
                            ) AS rka_rka_id_rka_rka
                    FROM
                         `rka_rka` rka_rka
                         INNER JOIN `rka_mata_anggaran` rka_mata_anggaran ON rka_rka.`id_rka_rka` = rka_mata_anggaran.`rka_rka`
                         INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON rka_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                         INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                         INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                         INNER JOIN `sikd_rek_kelompok` sikd_rek_kelompok ON sikd_rek_jenis.`sikd_rek_kelompok_id` = sikd_rek_kelompok.`id_sikd_rek_kelompok`
                         INNER JOIN `sikd_rek_akun` sikd_rek_akun ON sikd_rek_kelompok.`sikd_rek_akun_id` = sikd_rek_akun.`id_sikd_rek_akun`
                    WHERE
                         rka_rka.id_rka_rka = :id_rka_rka and rka_rka.rka_rka_type ='RkaSkpkdBlnjTdkLangsung'
                    ORDER BY
                         rka_mata_anggaran.`kd_rekening` ASC";

           
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rka_rka", $id_rka_rka);
            $statement->execute();
            $rkaSkpkdBlnjTdkLangsung = $statement->fetchAll();

            return new JsonResponse($rkaSkpkdBlnjTdkLangsung);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getRkaSkpkdPendapatan($request) {
        try {
            $id_rka_rka = $request->query->get("id_rka_rka");
            $tahun = $request->query->get("tahun");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $id_rka_rka = pack('H*', str_replace('-', '', trim($id_rka_rka)));
            $this->connection = $conn->getConnection();

            $sql = 
                    "SELECT
                        CONCAT_WS('-',
                            SUBSTR(HEX(rka_rka.`sikd_satker_id`), 1, 8),
                            SUBSTR(HEX(rka_rka.`sikd_satker_id`), 9, 4),
                            SUBSTR(HEX(rka_rka.`sikd_satker_id`), 13, 4),
                            SUBSTR(HEX(rka_rka.`sikd_satker_id`), 17, 4),
                            SUBSTR(HEX(rka_rka.`sikd_satker_id`), 21)
                            ) AS rka_skpkd_sikd_skpkd_id,
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
                        CONCAT_WS('-',
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 1, 8),
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 9, 4),
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 13, 4),
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 17, 4),
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 21)
                            ) AS sikd_rek_jenis_id_sikd_rek_jenis,
                        sikd_rek_jenis.`kd_rek_jenis` AS sikd_rek_jenis_kd_rek_jenis,
                        sikd_rek_jenis.`nm_rek_jenis` AS sikd_rek_jenis_nm_rek_jenis,
                        CONCAT_WS('-',
                            SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 1, 8),
                            SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 9, 4),
                            SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 13, 4),
                            SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 17, 4),
                            SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 21)
                            ) AS sikd_rek_obj_id_sikd_rek_obj,
                        sikd_rek_obj.`kd_rek_obj` AS sikd_rek_obj_kd_rek_obj,
                        sikd_rek_obj.`nm_rek_obj` AS sikd_rek_obj_nm_rek_obj,
                        CONCAT_WS('-',
                            SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 1, 8),
                            SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 9, 4),
                            SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 13, 4),
                            SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 17, 4),
                            SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 21)
                            ) AS sikd_rek_rincian_obj_id_sikd_rek_rincian_obj,
                        sikd_rek_rincian_obj.`kd_rek_rincian_obj` AS sikd_rek_rincian_obj_kd_rek_rincian_obj,
                        sikd_rek_rincian_obj.`nm_rek_rincian_obj` AS sikd_rek_rincian_obj_nm_rek_rincian_obj,
                        if(rka_rka.`status_rka` = '0', 'DRAFT',if(rka_rka.`status_rka` = '2', 'DITOLAK', '')) AS rka_status_rka,
                        rka_rka.`keterangan` AS rka_keterangan,
                        CONCAT_WS('-',
                            SUBSTR(HEX(rka_mata_anggaran.`id_rka_mata_anggaran`), 1, 8),
                            SUBSTR(HEX(rka_mata_anggaran.`id_rka_mata_anggaran`), 9, 4),
                            SUBSTR(HEX(rka_mata_anggaran.`id_rka_mata_anggaran`), 13, 4),
                            SUBSTR(HEX(rka_mata_anggaran.`id_rka_mata_anggaran`), 17, 4),
                            SUBSTR(HEX(rka_mata_anggaran.`id_rka_mata_anggaran`), 21)
                            ) AS id_rka_mata_anggaran,
                        rka_mata_anggaran.`volume` AS rka_mata_anggaran_volume,
                        rka_mata_anggaran.`satuan` AS rka_mata_anggaran_satuan,
                        rka_mata_anggaran.`harga` AS rka_mata_anggaran_harga,
                        rka_mata_anggaran.`jumlah` AS rka_mata_anggaran_jumlah,
                         CONCAT_WS('-',
                            SUBSTR(HEX(rka_rka.`id_rka_rka`), 1, 8),
                            SUBSTR(HEX(rka_rka.`id_rka_rka`), 9, 4),
                            SUBSTR(HEX(rka_rka.`id_rka_rka`), 13, 4),
                            SUBSTR(HEX(rka_rka.`id_rka_rka`), 17, 4),
                            SUBSTR(HEX(rka_rka.`id_rka_rka`), 21)
                            ) AS rka_rka_id_rka_rka
                    FROM
                                `rka_rka` rka_rka
                        INNER JOIN `rka_mata_anggaran` rka_mata_anggaran ON rka_rka.`id_rka_rka` = rka_mata_anggaran.`rka_rka`
                        INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON rka_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                        INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                        INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                        INNER JOIN `sikd_rek_kelompok` sikd_rek_kelompok ON sikd_rek_jenis.`sikd_rek_kelompok_id` = sikd_rek_kelompok.`id_sikd_rek_kelompok`
                        INNER JOIN `sikd_rek_akun` sikd_rek_akun ON sikd_rek_kelompok.`sikd_rek_akun_id` = sikd_rek_akun.`id_sikd_rek_akun`
                   WHERE
                        rka_rka.`id_rka_rka` = :id_rka_rka AND rka_rka.rka_rka_type = 'RkaSkpdPendapatan'
                   ORDER BY
                        rka_mata_anggaran.`kd_rekening` ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rka_rka", $id_rka_rka);
            $statement->execute();
            $rkaSkpkdPendapatan = $statement->fetchAll();

            return new JsonResponse($rkaSkpkdPendapatan);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
        
    }
    
    private function getRkaSkpkdPenerimaan($request) {
        try {
            $id_rka_rka = $request->query->get("id_rka_rka");
            $tahun = $request->query->get("tahun");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $id_rka_rka = pack('H*', str_replace('-', '', trim($id_rka_rka)));
            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                          CONCAT_WS('-',
                            SUBSTR(HEX(rka_rka.`sikd_satker_id`), 1, 8),
                            SUBSTR(HEX(rka_rka.`sikd_satker_id`), 9, 4),
                            SUBSTR(HEX(rka_rka.`sikd_satker_id`), 13, 4),
                            SUBSTR(HEX(rka_rka.`sikd_satker_id`), 17, 4),
                            SUBSTR(HEX(rka_rka.`sikd_satker_id`), 21)
                            ) AS rka_skpkd_sikd_skpkd_id,
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
                         CONCAT_WS('-',
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 1, 8),
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 9, 4),
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 13, 4),
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 17, 4),
                            SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 21)
                            ) AS sikd_rek_jenis_id_sikd_rek_jenis,
                         sikd_rek_jenis.`kd_rek_jenis` AS sikd_rek_jenis_kd_rek_jenis,
                         sikd_rek_jenis.`nm_rek_jenis` AS sikd_rek_jenis_nm_rek_jenis,
                         CONCAT_WS('-',
                            SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 1, 8),
                            SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 9, 4),
                            SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 13, 4),
                            SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 17, 4),
                            SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 21)
                            ) AS sikd_rek_obj_id_sikd_rek_obj,
                         sikd_rek_obj.`kd_rek_obj` AS sikd_rek_obj_kd_rek_obj,
                         sikd_rek_obj.`nm_rek_obj` AS sikd_rek_obj_nm_rek_obj,
                         CONCAT_WS('-',
                            SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 1, 8),
                            SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 9, 4),
                            SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 13, 4),
                            SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 17, 4),
                            SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 21)
                            ) AS sikd_rek_rincian_obj_id_sikd_rek_rincian_obj,
                         sikd_rek_rincian_obj.`kd_rek_rincian_obj` AS sikd_rek_rincian_obj_kd_rek_rincian_obj,
                         sikd_rek_rincian_obj.`nm_rek_rincian_obj` AS sikd_rek_rincian_obj_nm_rek_rincian_obj,
                         if(rka_rka.`status_rka` = '0', 'DRAFT',if(rka_rka.`status_rka` = '2', 'DITOLAK', '')) AS rka_status_rka,
                         rka_rka.`keterangan` AS rka_keterangan,
                         CONCAT_WS('-',
                            SUBSTR(HEX(rka_mata_anggaran.`id_rka_mata_anggaran`), 1, 8),
                            SUBSTR(HEX(rka_mata_anggaran.`id_rka_mata_anggaran`), 9, 4),
                            SUBSTR(HEX(rka_mata_anggaran.`id_rka_mata_anggaran`), 13, 4),
                            SUBSTR(HEX(rka_mata_anggaran.`id_rka_mata_anggaran`), 17, 4),
                            SUBSTR(HEX(rka_mata_anggaran.`id_rka_mata_anggaran`), 21)
                            ) AS id_rka_mata_anggaran,
                         rka_mata_anggaran.`volume` AS rka_mata_anggaran_volume,
                         rka_mata_anggaran.`satuan` AS rka_mata_anggaran_satuan,
                         rka_mata_anggaran.`harga` AS rka_mata_anggaran_harga,
                         rka_mata_anggaran.`jumlah` AS rka_mata_anggaran_jumlah,
                         CONCAT_WS('-',
                            SUBSTR(HEX(rka_rka.`id_rka_rka`), 1, 8),
                            SUBSTR(HEX(rka_rka.`id_rka_rka`), 9, 4),
                            SUBSTR(HEX(rka_rka.`id_rka_rka`), 13, 4),
                            SUBSTR(HEX(rka_rka.`id_rka_rka`), 17, 4),
                            SUBSTR(HEX(rka_rka.`id_rka_rka`), 21)
                            ) AS rka_rka_id_rka_rka

                    FROM
                         `rka_rka` rka_rka
                         INNER JOIN `rka_mata_anggaran` rka_mata_anggaran ON rka_rka.`id_rka_rka` = rka_mata_anggaran.`rka_rka`
                         INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON rka_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                         INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                         INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                         INNER JOIN `sikd_rek_kelompok` sikd_rek_kelompok ON sikd_rek_jenis.`sikd_rek_kelompok_id` = sikd_rek_kelompok.`id_sikd_rek_kelompok`
                         INNER JOIN `sikd_rek_akun` sikd_rek_akun ON sikd_rek_kelompok.`sikd_rek_akun_id` = sikd_rek_akun.`id_sikd_rek_akun`
                    WHERE
                        rka_rka.`id_rka_rka` = :id_rka_rka AND rka_rka.rka_rka_type = 'RkaSkpkdPenerimaan'
                    ORDER BY
                        rka_mata_anggaran.`kd_rekening` ASC
                                        ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rka_rka", $id_rka_rka);
            $statement->execute();
            $rkaSkpkdPenerimaan = $statement->fetchAll();

            return new JsonResponse($rkaSkpkdPenerimaan);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
        
    }

    private function getRkaSkpkdRincMataAnggaranPembiayaan($request) {
        try {
            $id_rka_mata_anggaran = $request->query->get("id_rka_mata_anggaran");
            $tahun = $request->query->get("tahun");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $id_rka_mata_anggaran = pack('H*', str_replace('-', '', trim($id_rka_mata_anggaran)));
            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                         CONCAT_WS('-',
                            SUBSTR(HEX(rka_rincian_mata_anggaran.`rka_mata_anggaran_id`), 1, 8),
                            SUBSTR(HEX(rka_rincian_mata_anggaran.`rka_mata_anggaran_id`), 9, 4),
                            SUBSTR(HEX(rka_rincian_mata_anggaran.`rka_mata_anggaran_id`), 13, 4),
                            SUBSTR(HEX(rka_rincian_mata_anggaran.`rka_mata_anggaran_id`), 17, 4),
                            SUBSTR(HEX(rka_rincian_mata_anggaran.`rka_mata_anggaran_id`), 21)
                            ) AS rka_rincian_mata_anggaran_rka_mata_anggaran_id,
                         rka_rincian_mata_anggaran.`no_item_h` AS rka_rincian_mata_anggaran_no_item_h,
                         rka_rincian_mata_anggaran.`no_item_s` AS rka_rincian_mata_anggaran_no_item_s,
                         rka_rincian_mata_anggaran.`no_item` AS rka_rincian_mata_anggaran_no_item,
                         rka_rincian_mata_anggaran.`jns_item` AS rka_rincian_mata_anggaran_jns_item,
                         rka_rincian_mata_anggaran.`header` AS rka_rincian_mata_anggaran_header,
                         rka_rincian_mata_anggaran.`subheader` AS rka_rincian_mata_anggaran_subheader,
                         rka_rincian_mata_anggaran.`uraian` AS rka_rincian_mata_anggaran_uraian,
                         rka_rincian_mata_anggaran.`volume` AS rka_rincian_mata_anggaran_volume,
                         rka_rincian_mata_anggaran.`satuan` AS rka_rincian_mata_anggaran_satuan,
                         rka_rincian_mata_anggaran.`harga` AS rka_rincian_mata_anggaran_harga,
                         rka_rincian_mata_anggaran.`jumlah` AS rka_rincian_mata_anggaran_jumlah
                    FROM
                         `rka_rincian_mata_anggaran` rka_rincian_mata_anggaran
                    WHERE
                         rka_rincian_mata_anggaran.`rka_mata_anggaran_id` = :id_rka_mata_anggaran
                    GROUP BY
                        rka_rincian_mata_anggaran.`no_item_h`,
                        rka_rincian_mata_anggaran.`no_item_s`,
                        rka_rincian_mata_anggaran.`no_item`
                    ORDER BY
                        cast(rka_rincian_mata_anggaran.`no_item_h` as unsigned),
                        cast(rka_rincian_mata_anggaran.`no_item_s` as unsigned),
                        cast(rka_rincian_mata_anggaran.`no_item` as unsigned)
                                        ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rka_mata_anggaran", $id_rka_mata_anggaran);
            $statement->execute();
            $rkaSkpkdPenerimaan = $statement->fetchAll();

            return new JsonResponse($rkaSkpkdPenerimaan);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
        
    }
    
    private function getRkaSkpkdPengeluaran($request) {
        try {
            $id_rka_rka = $request->query->get("id_rka_rka");
            $tahun = $request->query->get("tahun");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $id_rka_rka = pack('H*', str_replace('-', '', trim($id_rka_rka)));
            $this->connection = $conn->getConnection();

            $sql = 
                    "SELECT
                         CONCAT_WS('-',
                                SUBSTR(HEX(rka_rka.`sikd_satker_id`), 1, 8),
                                SUBSTR(HEX(rka_rka.`sikd_satker_id`), 9, 4),
                                SUBSTR(HEX(rka_rka.`sikd_satker_id`), 13, 4),
                                SUBSTR(HEX(rka_rka.`sikd_satker_id`), 17, 4),
                                SUBSTR(HEX(rka_rka.`sikd_satker_id`), 21)
                                ) AS rka_skpkd_sikd_skpkd_id,
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
                         CONCAT_WS('-',
                                SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 1, 8),
                                SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 9, 4),
                                SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 13, 4),
                                SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 17, 4),
                                SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 21)
                                ) AS sikd_rek_jenis_id_sikd_rek_jenis,
                         sikd_rek_jenis.`kd_rek_jenis` AS sikd_rek_jenis_kd_rek_jenis,
                         sikd_rek_jenis.`nm_rek_jenis` AS sikd_rek_jenis_nm_rek_jenis,
                         CONCAT_WS('-',
                                SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 1, 8),
                                SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 9, 4),
                                SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 13, 4),
                                SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 17, 4),
                                SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 21)
                                ) AS sikd_rek_obj_id_sikd_rek_obj,
                         sikd_rek_obj.`kd_rek_obj` AS sikd_rek_obj_kd_rek_obj,
                         sikd_rek_obj.`nm_rek_obj` AS sikd_rek_obj_nm_rek_obj,
                         CONCAT_WS('-',
                                SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 1, 8),
                                SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 9, 4),
                                SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 13, 4),
                                SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 17, 4),
                                SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 21)
                                ) AS sikd_rek_rincian_obj_id_sikd_rek_rincian_obj,
                         sikd_rek_rincian_obj.`kd_rek_rincian_obj` AS sikd_rek_rincian_obj_kd_rek_rincian_obj,
                         sikd_rek_rincian_obj.`nm_rek_rincian_obj` AS sikd_rek_rincian_obj_nm_rek_rincian_obj,
                         if(rka_rka.`status_rka` = '0', 'DRAFT',if(rka_rka.`status_rka` = '2', 'DITOLAK', '')) AS rka_status_rka,
                         rka_rka.`keterangan` AS rka_keterangan,
                         CONCAT_WS('-',
                                SUBSTR(HEX(rka_mata_anggaran.`id_rka_mata_anggaran`), 1, 8),
                                SUBSTR(HEX(rka_mata_anggaran.`id_rka_mata_anggaran`), 9, 4),
                                SUBSTR(HEX(rka_mata_anggaran.`id_rka_mata_anggaran`), 13, 4),
                                SUBSTR(HEX(rka_mata_anggaran.`id_rka_mata_anggaran`), 17, 4),
                                SUBSTR(HEX(rka_mata_anggaran.`id_rka_mata_anggaran`), 21)
                                ) AS id_rka_mata_anggaran,
                         rka_mata_anggaran.`volume` AS rka_mata_anggaran_volume,
                         rka_mata_anggaran.`satuan` AS rka_mata_anggaran_satuan,
                         rka_mata_anggaran.`harga` AS rka_mata_anggaran_harga,
                         rka_mata_anggaran.`jumlah` AS rka_mata_anggaran_jumlah,
                          CONCAT_WS('-',
                            SUBSTR(HEX(rka_rka.`id_rka_rka`), 1, 8),
                            SUBSTR(HEX(rka_rka.`id_rka_rka`), 9, 4),
                            SUBSTR(HEX(rka_rka.`id_rka_rka`), 13, 4),
                            SUBSTR(HEX(rka_rka.`id_rka_rka`), 17, 4),
                            SUBSTR(HEX(rka_rka.`id_rka_rka`), 21)
                            ) AS rka_rka_id_rka_rka
                    FROM
                         `rka_rka` rka_rka
                         INNER JOIN `rka_mata_anggaran` rka_mata_anggaran ON rka_rka.`id_rka_rka` = rka_mata_anggaran.`rka_rka`
                         INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON rka_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                         INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                         INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                         INNER JOIN `sikd_rek_kelompok` sikd_rek_kelompok ON sikd_rek_jenis.`sikd_rek_kelompok_id` = sikd_rek_kelompok.`id_sikd_rek_kelompok`
                         INNER JOIN `sikd_rek_akun` sikd_rek_akun ON sikd_rek_kelompok.`sikd_rek_akun_id` = sikd_rek_akun.`id_sikd_rek_akun`
                    WHERE 
                        rka_rka.`id_rka_rka` = :id_rka_rka AND rka_rka.rka_rka_type ='RkaSkpkdPengeluaran'
                    ORDER BY
                        rka_mata_anggaran.`kd_rekening` ASC
                    ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rka_rka", $id_rka_rka);
            $statement->execute();
            $rkaSkpkdPengeluaran = $statement->fetchAll();

            return new JsonResponse($rkaSkpkdPengeluaran);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
        
    }
    
    private function getRkaTimAnggaran($request) {
        try {
            $id_skpd = $request->query->get("id_skpd");
            $id_skpd = pack('H*', str_replace('-', '', trim($id_skpd)));
            $id_sub_skpd = $request->query->get("id_sub_skpd");
            $tahun = $request->query->get("tahun");
            $id_sub_skpd = pack('H*', str_replace('-', '', trim($id_sub_skpd)));
            $id_skpd = '';
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                        sikd_tim_anggaran.`nip` AS sikd_tim_anggaran_nip,
                        sikd_tim_anggaran.`nama` AS sikd_tim_anggaran_nama,
                        sikd_tim_anggaran.`jabatan` AS sikd_tim_anggaran_jabatan
                    FROM
                        `sikd_tim_anggaran` sikd_tim_anggaran
                    WHERE
                        sikd_tim_anggaran.`tahun` = :tahun
                        AND ((select count('x') from sikd_tim_anggaran_skpd) = 0
                        or (id_sikd_tim_anggaran in (select sikd_tim_anggaran_id 
            from sikd_tim_anggaran_skpd
                        where sikd_satker_id = :id_skpd
            )))
                    ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_skpd", $id_skpd);
            //$statement->bindValue("id_sub_skpd", $id_sub_skpd);
            $statement->bindValue("tahun", $tahun);
            $statement->execute();
            $rkaTimAnggaran = $statement->fetchAll();

            return new JsonResponse($rkaTimAnggaran);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
        
    }
    
    private function getRkaAnomaliPpas($request) {
        try {
            $idRkaSkpdKgtn = $request->query->get("id_rka_skpd_kgtn");
            $tahun = $request->query->get("tahun");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRkaSkpdKgtn = pack('H*', str_replace('-', '', trim($idRkaSkpdKgtn)));
            $tahun = pack('H*', str_replace('-', '', trim($tahun)));
            
            $this->connection = $conn->getConnection();

            $sql = "select 
                    '1' kd_jns_anomali,
                    'Kegiatan Ada Di PPAS Tidak Ada di RKA' jns_anomali,
                    sikd_satker.id_sikd_satker id_satker, sikd_satker.kode kd_satker, sikd_satker.nama nm_satker,
                    kua_skpd_kgtn.kd_kgtn kua_kd_kgtn, kua_skpd_kgtn.nm_kgtn kua_nm_kgtn, kua_skpd_kgtn.nm_subkgtn kua_nm_subkgtn, 
                    '' rka_kd_kgtn, '' rka_no_subkgtn, '' rka_nm_kgtn, '' rka_nm_subkgtn, 
                    sum(kua_skpd_lokasi_kgtn.jml_anggaran) jml_anggaran_kua, 0 jml_anggaran_rka
                from 
                    kua_skpd_kgtn
                    inner join kua_skpd_lokasi_kgtn on kua_skpd_kgtn.id_kua_skpd_kgtn = kua_skpd_lokasi_kgtn.kua_skpd_kgtn_id
                    inner join sikd_bidang on kua_skpd_kgtn.sikd_bidang_id = sikd_bidang.id_sikd_bidang
                    inner join sikd_satker on kua_skpd_kgtn.sikd_skpd_id = sikd_satker.id_sikd_satker
                    left outer join rka_skpd_kgtn on kua_skpd_kgtn.id_kua_skpd_kgtn = rka_skpd_kgtn.kua_skpd_kgtn_id
                where
                    rka_skpd_kgtn.id_rka_skpd_kgtn is null
                    and if ($P{ID_SATKER} != '', kua_skpd_kgtn.sikd_skpd_id = $P{ID_SATKER}, 1)
                    and substr(sikd_bidang.kd_bidang,1,1) in ('1','2')
                group by
                    kua_skpd_kgtn.id_kua_skpd_kgtn
                UNION
                select 
                    '2' kd_jns_anomali,
                    'Kegiatan Ada Di RKA Tidak Ada di PPAS' jns_anomali,
                    sikd_satker.id_sikd_satker id_satker, sikd_satker.kode kd_satker, sikd_satker.nama nm_satker,
                    null kua_kd_kgtn, null kua_nm_kgtn, null kua_nm_subkgtn, 
                    rka_rka.no_rka rka_kd_kgtn, rka_rka.no_rka_subkegiatan rka_no_subkgtn, 
                    rka_rka.judul_rka rka_nm_kgtn, rka_rka.judul_rka_subkegiatan rka_nm_subkgtn, 
                    0 jml_anggaran_kua,
                    sum(rka_mata_anggaran.jumlah) jml_anggaran_rka
                from 
                    rka_skpd_kgtn
                    inner join rka_rka on rka_skpd_kgtn.id_rka_skpd_kgtn = rka_rka.id_rka_rka
                    inner join rka_mata_anggaran on rka_rka.id_rka_rka = rka_mata_anggaran.rka_rka_id
                    inner join sikd_satker on rka_rka.sikd_satker_id = sikd_satker.id_sikd_satker
                    left outer join kua_skpd_kgtn on kua_skpd_kgtn.id_kua_skpd_kgtn = rka_skpd_kgtn.kua_skpd_kgtn_id
                where
                    kua_skpd_kgtn.id_kua_skpd_kgtn is null
                    and if ($P{ID_SATKER} != '', rka_rka.sikd_satker_id = $P{ID_SATKER}, 1)
                group by
                    rka_skpd_kgtn.id_rka_skpd_kgtn
                order by 
                    kd_satker, kd_jns_anomali, kua_kd_kgtn, rka_kd_kgtn, rka_no_subkgtn
                ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rka_skpd_kgtn", $idRkaSkpdKgtn);
            $statement->execute();
            $rkaAnomaliPpas = $statement->fetchAll();

            return new JsonResponse($rkaAnomaliPpas);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }  
    }
    
    private function getRkaAnomaliRincAnggaran($request) {
        try {
            $rapbd_rapbd_id = $request->query->get("rapbd_rapbd_id");
            $sikd_satker_id = $request->query->get("sikd_satker_id");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $rapbd_rapbd_id = pack('H*', str_replace('-', '', trim($rapbd_rapbd_id)));
            $sikd_satker_id = pack('H*', str_replace('-', '', trim($sikd_satker_id)));
            
            $this->connection = $conn->getConnection();

            $sql = 
                "SELECT
                     sikd_satker.`id_sikd_satker` AS id_satker,
                     sikd_satker.`kode` AS kd_satker,
                     sikd_satker.`nama` AS nm_satker,
                     sikd_sub_skpd.`id_sikd_sub_skpd` AS id_sikd_sub_skpd,
                     sikd_sub_skpd.`kode` AS kd_sub_skpd,
                     sikd_sub_skpd.`nama` AS nm_sub_skpd,
                     rka_rka.`no_rka` AS no_rka,
                     rka_rka.`id_rka_rka` AS id_rka_rka,
                     rka_rka.rka_rka_type AS rka_type,
                     rka_rka.kd_kegiatan AS kd_kegiatan,
                     IF(rka_rka_type='RkaSkpdPendapatan', 'RKA SKPD Pendapatan',
                       IF(rka_rka_type='RkaSkpdBlnjTdkLangsung', 'RKA SKPD Belanja Tdk Langsung',
                       IF(rka_rka_type='RkaSkpdKgtn', rka_rka.nm_kegiatan, 'RKA - '))) AS judul_rka,
                     trim(rka_rka.nm_subkegiatan) AS nm_subkegiatan,
                     rka_mata_anggaran.`id_rka_mata_anggaran` AS id_rka_mata_anggaran,
                     rka_mata_anggaran.`kd_rekening` AS kd_rekening,
                     sikd_rek_rincian_obj.`nm_rek_rincian_obj` AS nm_rekening,
                     rka_mata_anggaran.`jumlah` AS jml_mak,
                     SUM(rka_rincian_mata_anggaran.`jumlah`) AS jml_rincian_mak,
                     rka_rka.rapbd_rapbd_id
                FROM
                     `sikd_satker` sikd_satker 
                     INNER JOIN `rka_rka` rka_rka ON sikd_satker.`id_sikd_satker` = rka_rka.`sikd_satker_id`
                     LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON rka_rka.`sikd_sub_satker_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                     INNER JOIN `rka_mata_anggaran` rka_mata_anggaran ON rka_rka.`id_rka_rka` = rka_mata_anggaran.`rka_rka`
                     INNER JOIN `rka_rincian_mata_anggaran` rka_rincian_mata_anggaran ON rka_mata_anggaran.`id_rka_mata_anggaran` = rka_rincian_mata_anggaran.`rka_mata_anggaran_id`
                     INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON rka_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                WHERE
                     rka_rka.rapbd_rapbd_id = :rapbd_rapbd_id
                     AND IF(:sikd_satker_id != '', rka_rka.sikd_satker_id = :sikd_satker_id, 1)
                GROUP BY
                     rka_mata_anggaran.id_rka_mata_anggaran
                HAVING
                     FORMAT(rka_mata_anggaran.`jumlah`,2) <> FORMAT(SUM(rka_rincian_mata_anggaran.`jumlah`),2)
                UNION
                SELECT
                     sikd_satker.`id_sikd_satker` AS id_satker,
                     sikd_satker.`kode` AS kd_satker,
                     sikd_satker.`nama` AS nm_satker,
                     sikd_sub_skpd.`id_sikd_sub_skpd` AS id_sikd_sub_skpd,
                     sikd_sub_skpd.`kode` AS kd_sub_skpd,
                     sikd_sub_skpd.`nama` AS nm_sub_skpd,
                     rka_rka.`no_rka` AS no_rka,
                     rka_rka.`id_rka_rka` AS id_rka_rka,
                     rka_rka.rka_rka_type AS rka_type,
                     rka_rka.kd_kegiatan AS kd_kegiatan,
                     IF(rka_rka_type=RkaSkpkdPendapatan', 'RKA SKPKD Pendapatan',
                       IF(rka_rka_type='RkaSkpkdBlnjTdkLangsung', 'RKA SKPKD Belanja Tdk LAngsung',
                       IF(rka_rka_type='RkaSkpkdPenerimaan', 'RKA SKPKD Penerimaan',
                       IF(rka_rka_type='RkaSkpkdPengeluaran','RKA SKPKD Pengeluaran', 'RKA - '')))) AS judul_rka,
                     trim(rka_rka.`nm_subkegiatan`) AS nm_subkegiatan,
                     rka_mata_anggaran.`id_rka_mata_anggaran` AS id_rka_mata_anggaran,
                     rka_mata_anggaran.`kd_rekening` AS kd_rekening,
                     sikd_rek_rincian_obj.`nm_rek_rincian_obj` AS nm_rekening,
                     rka_mata_anggaran.`jumlah` AS jml_mak,
                     SUM(rka_rincian_mata_anggaran.`jumlah`) AS jml_rincian_mak,
                     rka_rka.rapbd_rapbd_id
                FROM
                     `sikd_satker` sikd_satker 
                     INNER JOIN `rka_rka` rka_rka ON sikd_satker.`id_sikd_satker` = rka_rka.`sikd_satker_id`
                     LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON rka_rka.`sikd_sub_satker_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                     INNER JOIN `rka_mata_anggaran` rka_mata_anggaran ON rka_rka.`id_rka_rka` = rka_mata_anggaran.`rka_rka`
                     INNER JOIN `rka_rincian_mata_anggaran` rka_rincian_mata_anggaran ON rka_mata_anggaran.`id_rka_mata_anggaran` = rka_rincian_mata_anggaran.`rka_mata_anggaran_id`
                     INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON rka_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                WHERE
                     rka_rka.rapbd_rapbd_id = :rapbd_rapbd_id
                     AND IF(:sikd_satker_id != '', rka_rka.sikd_satker_id = :sikd_satker_id, 1)
                GROUP BY
                     rka_mata_anggaran.id_rka_mata_anggaran
                HAVING
                     FORMAT(rka_mata_anggaran.`jumlah`,2) <> FORMAT(SUM(rka_rincian_mata_anggaran.`jumlah`),2)
                ORDER BY
                     kd_satker, kd_sub_skpd,
                     IF(rka_type='RkaSkpdPendapatan', 0,
                       IF(rka_type='RkaSkpdBlnjTdkLangsung', 1,
                       IF(rka_type='RkaSkpdKgtn', 2,
                       IF(rka_type='RkaSkpkdPendapatan', 3,
                       IF(rka_type='RkaSkpkdBlnjTdkLangsung', 4,
                       IF(rka_type='RkaSkpkdPenerimaan', 5,
                       IF(rka_type='RkaSkpkdPengeluaran', 6, 7))))))),
                     kd_kegiatan, 
                     nm_subkegiatan,
                     kd_rekening
                ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("rapbd_rapbd_id", $rapbd_rapbd_id);
            $statement->bindValue("sikd_satker_id", $sikd_satker_id);
            $statement->execute();
            $rkaAnomaliRincAnggaran = $statement->fetchAll();

            return new JsonResponse($rkaAnomaliRincAnggaran);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }  
    }
    
    private function getRkaAnomaliRincNoItem($request) {
        try {
            $idRapbd = $request->query->get("rapbd_rapbd_id");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRapbd = pack('H*', str_replace('-', '', trim($idRapbd)));
            
            $this->connection = $conn->getConnection();

            $sql = 
                "SELECT
                    CONCAT_WS('-',
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 1, 8),
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 9, 4),
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 13, 4),
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 17, 4),
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 21)
                            ) AS id_satker,
                    sikd_satker.`kode` AS kd_satker,
                    sikd_satker.`nama` AS nm_satker,
                    CONCAT_WS('-',
                            SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 1, 8),
                            SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 9, 4),
                            SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 13, 4),
                            SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 17, 4),
                            SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 21)
                            ) AS id_sikd_sub_skpd,
                    sikd_sub_skpd.`kode` AS kd_sub_skpd,
                    sikd_sub_skpd.`nama` AS nm_sub_skpd,
                    rka_rka.`no_rka` AS no_rka,
                    CONCAT_WS('-',
                            SUBSTR(HEX(rka_rka.`id_rka_rka`), 1, 8),
                            SUBSTR(HEX(rka_rka.`id_rka_rka`), 9, 4),
                            SUBSTR(HEX(rka_rka.`id_rka_rka`), 13, 4),
                            SUBSTR(HEX(rka_rka.`id_rka_rka`), 17, 4),
                            SUBSTR(HEX(rka_rka.`id_rka_rka`), 21)
                            ) AS id_rka_rka,
                    rka_skpd.`rka_skpd_type` AS rka_type,
                    rka_skpd_kgtn.`kd_kegiatan` AS kd_kegiatan,
                IF(rka_skpd_type='RkaSkpdPendapatan', 'RKA SKPD Pendapatan',
                IF(rka_skpd_type='RkaSkpdBlnjTdkLangsung', 'RKA SKPD Belanja Tdk Langsung',
                IF(rka_skpd_type='RkaSkpdKgtn', rka_skpd_kgtn.`nm_kegiatan`, 'RKA - '))) AS judul_rka,
                    trim(rka_skpd_kgtn.`nm_subkegiatan`) AS nm_subkegiatan,
                    CONCAT_WS('-',
                            SUBSTR(HEX(rka_mata_anggaran.`id_rka_mata_anggaran`), 1, 8),
                            SUBSTR(HEX(rka_mata_anggaran.`id_rka_mata_anggaran`), 9, 4),
                            SUBSTR(HEX(rka_mata_anggaran.`id_rka_mata_anggaran`), 13, 4),
                            SUBSTR(HEX(rka_mata_anggaran.`id_rka_mata_anggaran`), 17, 4),
                            SUBSTR(HEX(rka_mata_anggaran.`id_rka_mata_anggaran`), 21)
                            ) AS id_rka_mata_anggaran,
                    rka_mata_anggaran.`kd_rekening` AS kd_rekening,
                    sikd_rek_rincian_obj.`nm_rek_rincian_obj` AS nm_rekening,
                    rka_mata_anggaran.`jumlah` AS jml_mak,
                    CONCAT_WS('-',
                            SUBSTR(HEX(rka_rincian_mata_anggaran.`id_rka_rincian_mata_anggaran`), 1, 8),
                            SUBSTR(HEX(rka_rincian_mata_anggaran.`id_rka_rincian_mata_anggaran`), 9, 4),
                            SUBSTR(HEX(rka_rincian_mata_anggaran.`id_rka_rincian_mata_anggaran`), 13, 4),
                            SUBSTR(HEX(rka_rincian_mata_anggaran.`id_rka_rincian_mata_anggaran`), 17, 4),
                            SUBSTR(HEX(rka_rincian_mata_anggaran.`id_rka_rincian_mata_anggaran`), 21)
                            ) AS id_rka_rincian_mata_anggaran,
                    rka_rincian_mata_anggaran.`no_item_h` AS no_item_h,
                    rka_rincian_mata_anggaran.`no_item_s` AS no_item_s,
                    rka_rincian_mata_anggaran.`no_item` AS no_item,
                    IF(rka_rincian_mata_anggaran.`jns_item`='H','Header',
                      IF(rka_rincian_mata_anggaran.`jns_item`='S','Sub Header', 'Item MAK')) AS jns_item,
                    rka_rincian_mata_anggaran.`header` AS item_header,
                    rka_rincian_mata_anggaran.`subheader` AS item_subheader,
                    rka_rincian_mata_anggaran.`uraian` AS item_uraian,
                    rka_rincian_mata_anggaran.`jumlah` AS jml_rincian_mak
                FROM
                    `sikd_satker` sikd_satker 
                    INNER JOIN `rka_rka` rka_rka ON sikd_satker.`id_sikd_satker` = rka_rka.`sikd_satker_id`
                    LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON rka_rka.`sikd_sub_satker_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                    INNER JOIN `rka_skpd` rka_skpd ON rka_rka.`id_rka_rka` = rka_skpd.`id_rka_skpd`
                    INNER JOIN `rka_mata_anggaran` rka_mata_anggaran ON rka_rka.`id_rka_rka` = rka_mata_anggaran.`rka_rka_id`
                    LEFT OUTER JOIN `rka_skpd_kgtn` rka_skpd_kgtn ON rka_rka.`id_rka_rka` = rka_skpd_kgtn.`id_rka_skpd_kgtn`
                    INNER JOIN `rka_rincian_mata_anggaran` rka_rincian_mata_anggaran ON rka_mata_anggaran.`id_rka_mata_anggaran` = rka_rincian_mata_anggaran.`rka_mata_anggaran_id`
                    INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON rka_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                WHERE
                    rka_rka.rapbd_rapbd_id = :idRapbd
                AND IF(:idSatker != '', rka_rka.sikd_satker_id = :idSatker, 1)
                GROUP BY
                    rka_rincian_mata_anggaran.rka_mata_anggaran_id,
                    rka_rincian_mata_anggaran.no_item_h, 
                    rka_rincian_mata_anggaran.no_item_s, 
                    rka_rincian_mata_anggaran.no_item
                HAVING
                    count('x') > 1
                UNION
                SELECT
                    CONCAT_WS('-',
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 1, 8),
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 9, 4),
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 13, 4),
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 17, 4),
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 21)
                            ) AS id_satker,
                    sikd_satker.`kode` AS kd_satker,
                    sikd_satker.`nama` AS nm_satker,
                    CONCAT_WS('-',
                            SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 1, 8),
                            SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 9, 4),
                            SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 13, 4),
                            SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 17, 4),
                            SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 21)
                            ) AS id_sikd_sub_skpd,
                    sikd_sub_skpd.`kode` AS kd_sub_skpd,
                    sikd_sub_skpd.`nama` AS nm_sub_skpd,
                    rka_rka.`no_rka` AS no_rka,
                    CONCAT_WS('-',
                            SUBSTR(HEX(rka_rka.`id_rka_rka`), 1, 8),
                            SUBSTR(HEX(rka_rka.`id_rka_rka`), 9, 4),
                            SUBSTR(HEX(rka_rka.`id_rka_rka`), 13, 4),
                            SUBSTR(HEX(rka_rka.`id_rka_rka`), 17, 4),
                            SUBSTR(HEX(rka_rka.`id_rka_rka`), 21)
                            ) AS id_rka_rka,
                    rka_skpkd.`rka_skpkd_type` AS rka_type,
                    rka_skpd_kgtn.`kd_kegiatan` AS kd_kegiatan,
                    IF(rka_skpkd_type='RkaSkpkdPendapatan', 'RKA SKPKD Pendapatan',
                    IF(rka_skpkd_type='RkaSkpkdBlnjTdkLangsung', 'RKA SKPKD Belanja Tdk LAngsung',
                    IF(rka_skpkd_type='RkaSkpkdPenerimaan', 'RKA SKPKD Penerimaan',
                    IF(rka_skpkd_type='RkaSkpkdPengeluaran', 'RKA SKPKD Pengeluaran', 'RKA - ')))) AS judul_rka,
                    trim(rka_skpd_kgtn.`nm_subkegiatan`) AS nm_subkegiatan,
                    rka_mata_anggaran.`id_rka_mata_anggaran` AS id_rka_mata_anggaran,
                    rka_mata_anggaran.`kd_rekening` AS kd_rekening,
                    sikd_rek_rincian_obj.`nm_rek_rincian_obj` AS nm_rekening,
                    rka_mata_anggaran.`jumlah` AS jml_mak,
                    rka_rincian_mata_anggaran.`id_rka_rincian_mata_anggaran` AS id_rka_rincian_mata_anggaran,
                    rka_rincian_mata_anggaran.`no_item_h` AS no_item_h,
                    rka_rincian_mata_anggaran.`no_item_s` AS no_item_s,
                    rka_rincian_mata_anggaran.`no_item` AS no_item,
                    IF(rka_rincian_mata_anggaran.`jns_item`='H','Header',
                    IF(rka_rincian_mata_anggaran.`jns_item`='S','Sub Header', 'Item MAK')) AS jns_item,
                    rka_rincian_mata_anggaran.`header` AS item_header,
                    rka_rincian_mata_anggaran.`subheader` AS item_subheader,
                    rka_rincian_mata_anggaran.`uraian` AS item_uraian,
                    rka_rincian_mata_anggaran.`jumlah` AS jml_rincian_mak
                FROM
                    `sikd_satker` sikd_satker 
                    INNER JOIN `rka_rka` rka_rka ON sikd_satker.`id_sikd_satker` = rka_rka.`sikd_satker_id`
                    LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON rka_rka.`sikd_sub_satker_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                    INNER JOIN `rka_skpkd` rka_skpkd ON rka_rka.`id_rka_rka` = rka_skpkd.`id_rka_skpkd`
                    LEFT OUTER JOIN `rka_skpd_kgtn` rka_skpd_kgtn ON rka_rka.`id_rka_rka` = rka_skpd_kgtn.`id_rka_skpd_kgtn`
                    INNER JOIN `rka_mata_anggaran` rka_mata_anggaran ON rka_rka.`id_rka_rka` = rka_mata_anggaran.`rka_rka_id`
                    INNER JOIN `rka_rincian_mata_anggaran` rka_rincian_mata_anggaran ON rka_mata_anggaran.`id_rka_mata_anggaran` = rka_rincian_mata_anggaran.`rka_mata_anggaran_id`
                    INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON rka_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                WHERE
                    rka_rka.rapbd_rapbd_id = :idRapbd
                AND IF(:idSatker != '', rka_rka.sikd_satker_id = :idSatker, 1)
                GROUP BY
                    rka_rincian_mata_anggaran.rka_mata_anggaran_id,
                    rka_rincian_mata_anggaran.no_item_h,
                    rka_rincian_mata_anggaran.no_item_s,
                    rka_rincian_mata_anggaran.no_item
               HAVING
                    count('x') > 1
                FORMAT(rka_mata_anggaran.`jumlah`,2) <> FORMAT(SUM(rka_rincian_mata_anggaran.`jumlah`),2)
                ORDER BY
                    kd_satker, 
                    kd_sub_skpd,
                    IF(rka_type='RkaSkpdPendapatan', 0,
                    IF(rka_type='RkaSkpdBlnjTdkLangsung', 1,
                    IF(rka_type='RkaSkpdKgtn', 2,
                    IF(rka_type='RkaSkpkdPendapatan', 3,
                    IF(rka_type='RkaSkpkdBlnjTdkLangsung', 4,
                    IF(rka_type='RkaSkpkdPenerimaan', 5,
                    IF(rka_type='RkaSkpkdPengeluaran', 6, 7))))))),
                    kd_kegiatan, 
                    nm_subkegiatan,
                    kd_rekening
                ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("rapbd_rapbd_id", $idRapbd);
            $statement->execute();
            $rkaAnomaliRincNoItem = $statement->fetchAll();

            return new JsonResponse($rkaAnomaliRincNoItem);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }  
    }
    
    private function getRkaDaftarRekening($request) {
        try {
            $idSikdRekAkun = $request->query->get("id_sikd_rek_akun");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idSikdRekAkun = pack('H*', str_replace('-', '', trim($idSikdRekAkun)));
            
            $this->connection = $conn->getConnection();

            $sql = 
                    "SELECT
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
                        sikd_rek_rincian_obj.`dasar_hukum` AS sikd_rek_rincian_obj_dasar_hukum
                    FROM
                        `sikd_rek_akun` sikd_rek_akun 
                        INNER JOIN `sikd_rek_kelompok` sikd_rek_kelompok ON sikd_rek_akun.`id_sikd_rek_akun` = sikd_rek_kelompok.`sikd_rek_akun_id`
                        INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_kelompok.`id_sikd_rek_kelompok` = sikd_rek_jenis.`sikd_rek_kelompok_id`
                        INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_jenis.`id_sikd_rek_jenis` = sikd_rek_obj.`sikd_rek_jenis_id`
                        INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON sikd_rek_obj.`id_sikd_rek_obj` = sikd_rek_rincian_obj.`sikd_rek_obj_id`
                   WHERE
                        sikd_rek_rincian_obj.`kd_rek_rincian_obj` like concat(IFNULL(:jnsRek,''), '%')
                   ORDER BY
                        sikd_rek_akun.`kd_rek_akun`,
                        sikd_rek_kelompok.`kd_rek_kelompok`,
                        sikd_rek_jenis.`kd_rek_jenis`,
                        sikd_rek_obj.`kd_rek_obj`,
                        sikd_rek_rincian_obj.`kd_rek_rincian_obj`
                    ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_sikd_rek_akun", $idSikdRekAkun);
            $statement->execute();
            $rkaDaftarRekening = $statement->fetchAll();

            return new JsonResponse($rkaDaftarRekening);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getRkaPengadaanBarang($request) {
        try {
            $idRkaRka = $request->query->get("id_rka_rka");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRkaRka = pack('H*', str_replace('-', '', trim($idRkaRka)));
            
            $this->connection = $conn->getConnection();

            $sql = 
                "SELECT
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
                    rka_skpd_kgtn.`kd_kegiatan` AS rka_skpd_kgtn_kd_kegiatan,
                    rka_skpd_kgtn.`nm_kegiatan` AS rka_skpd_kgtn_nm_kegiatan,
                    rka_skpd_kgtn.`nm_subkegiatan` AS rka_skpd_kgtn_nm_subkegiatan,
                    rka_mata_anggaran.`kd_rekening` AS rka_mata_anggaran_kd_rekening,
                    sikd_rek_rincian_obj.`nm_rek_rincian_obj` AS sikd_rek_rincian_obj_nm_rek_rincian_obj,
                    rka_rincian_mata_anggaran.`bmd_kd_barang_id` AS rka_rincian_mata_anggaran_bmd_kd_barang_id,
                    bmd_kd_barang.`kd_barang` AS bmd_kd_barang_kd_barang,
                    bmd_kd_barang.`nm_barang` AS bmd_kd_barang_nm_barang,
                    rka_rincian_mata_anggaran.`no_item_h` AS rka_rincian_mata_anggaran_no_item_h,
                    rka_rincian_mata_anggaran.`no_item_s` AS rka_rincian_mata_anggaran_no_item_s,
                    rka_rincian_mata_anggaran.`no_item` AS rka_rincian_mata_anggaran_no_item,
                    rka_rincian_mata_anggaran.`uraian` AS rka_rincian_mata_anggaran_uraian,
                    rka_rincian_mata_anggaran.`volume` AS rka_rincian_mata_anggaran_volume,
                    rka_rincian_mata_anggaran.`satuan` AS rka_rincian_mata_anggaran_satuan,
                    rka_rincian_mata_anggaran.`harga` AS rka_rincian_mata_anggaran_harga,
                    rka_rincian_mata_anggaran.`jumlah` AS rka_rincian_mata_anggaran_jumlah,
                        (rka_rincian_mata_anggaran.`jumlah` / rincian_anggaran_barang.nilai_barang) * rincian_anggaran_barang.nilai_kapitalisasi AS nilai_kapitalisasi,
                    rka_mata_anggaran.`jumlah` AS rka_mata_anggaran_jumlah
                FROM
                    `rka_rka` rka_rka 
                    INNER JOIN `sikd_satker` sikd_satker ON rka_rka.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                        LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON rka_rka.`sikd_sub_satker_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                    INNER JOIN `rka_mata_anggaran` rka_mata_anggaran ON rka_rka.`id_rka_rka` = rka_mata_anggaran.`rka_rka_id`
                    INNER JOIN `rka_skpd_kgtn` rka_skpd_kgtn ON rka_rka.`id_rka_rka` = rka_skpd_kgtn.`id_rka_skpd_kgtn`
                    INNER JOIN `rka_rincian_mata_anggaran` rka_rincian_mata_anggaran ON rka_mata_anggaran.`id_rka_mata_anggaran` = rka_rincian_mata_anggaran.`rka_mata_anggaran_id`
                    INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON rka_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                    INNER JOIN `bmd_kd_barang` bmd_kd_barang ON rka_rincian_mata_anggaran.`bmd_kd_barang_id` = bmd_kd_barang.`id_bmd_kd_barang`
                    INNER JOIN 
                        (SELECT rka_mata_anggaran_id,
                                SUM(IF(bmd_kd_barang_id != '', jumlah, 0)) nilai_barang,  
                                SUM(IF(bmd_kd_barang_id = '', jumlah, 0)) nilai_kapitalisasi  
                        FROM rka_rincian_mata_anggaran
                        GROUP BY rka_mata_anggaran_id) AS rincian_anggaran_barang
                        ON rincian_anggaran_barang.rka_mata_anggaran_id = rka_mata_anggaran.`id_rka_mata_anggaran`
                WHERE
                    rka_rincian_mata_anggaran.bmd_kd_barang_id != ''
                ORDER BY
                    sikd_satker.kode, sikd_sub_skpd.kode, 
                    rka_skpd_kgtn.kd_kegiatan, rka_mata_anggaran.kd_rekening, 
                    bmd_kd_barang.kd_barang
                ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rka_rka", $idRkaRka);
            $statement->execute();
            $rkaPengadaanBarang = $statement->fetchAll();

            return new JsonResponse($rkaPengadaanBarang);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }  
    }
    
    private function getRkaPengawasanPaguPpasBl($request) {
        try {
            $idRkaRka = $request->query->get("id_rka_rka");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRkaRka = pack('H*', str_replace('-', '', trim($idRkaRka)));
            
            $this->connection = $conn->getConnection();

            $sql = 
                "SELECT
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
                            SUBSTR(HEX(sikd_urusan.`id_sikd_urusan`), 1, 8),
                            SUBSTR(HEX(sikd_urusan.`id_sikd_urusan`), 9, 4),
                            SUBSTR(HEX(sikd_urusan.`id_sikd_urusan`), 13, 4),
                            SUBSTR(HEX(sikd_urusan.`id_sikd_urusan`), 17, 4),
                            SUBSTR(HEX(sikd_urusan.`id_sikd_urusan`), 21)
                            ) AS sikd_urusan_id_sikd_urusan,
                    sikd_urusan.`kd_urusan` AS sikd_urusan_kd_urusan,
                    sikd_urusan.`nm_urusan` AS sikd_urusan_nm_urusan,
                    sikd_satker.`kd_bidang_induk` AS sikd_satker_kd_bidang,
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
                            SUBSTR(HEX(sikd_prog.`id_sikd_prog`), 1, 8),
                            SUBSTR(HEX(sikd_prog.`id_sikd_prog`), 9, 4),
                            SUBSTR(HEX(sikd_prog.`id_sikd_prog`), 13, 4),
                            SUBSTR(HEX(sikd_prog.`id_sikd_prog`), 17, 4),
                            SUBSTR(HEX(sikd_prog.`id_sikd_prog`), 21)
                            ) AS sikd_prog_id_sikd_prog,
                    sikd_prog.`nm_prog` AS sikd_prog_nm_prog,
                    concat(sikd_bidang.`kd_bidang`,sikd_prog.`kd_prog`) AS sikd_prog_kd_prog,
                    CONCAT_WS('-',
                            SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 1, 8),
                            SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 9, 4),
                            SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 13, 4),
                            SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 17, 4),
                            SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 21)
                            ) AS sikd_kgtn_id_sikd_kgtn,
                    concat(sikd_bidang.`kd_bidang`,sikd_kgtn.`kd_kgtn`) AS sikd_kgtn_kd_kgtn,
                    sikd_kgtn.`nm_kgtn` AS sikd_kgtn_nm_kgtn,
                    SUM(IF(ppas_ppas.tahapan_ppas='1', ppas_anggaran.jml_final, ppas_anggaran.jml_usulan)) AS jml_pagu_ppas,
                    0 AS jml_pagu_rka        
                FROM
                    ppas_ppas ppas_ppas
                    INNER JOIN ppas_anggaran ppas_anggaran ON ppas_ppas.id_ppas_ppas = ppas_anggaran.ppas_ppas_id
                    INNER JOIN ppas_blnj_langsung ppas_blnj_langsung ON ppas_anggaran.id_ppas_anggaran = ppas_blnj_langsung.id_ppas_blnj_langsung
                    INNER JOIN `sikd_satker` sikd_satker ON ppas_anggaran.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                    INNER JOIN `sikd_bidang` sikd_bidang ON ppas_blnj_langsung.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                    INNER JOIN `sikd_urusan` sikd_urusan ON sikd_bidang.`sikd_urusan_id` = sikd_urusan.`id_sikd_urusan`
                    INNER JOIN `sikd_kgtn` sikd_kgtn ON ppas_blnj_langsung.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                    INNER JOIN `sikd_prog` sikd_prog ON sikd_kgtn.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                    LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON ppas_anggaran.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                WHERE
                    ppas_ppas.tahun = :tahun
                AND ppas_ppas.jns_ppas = 'PPAS-A'
                AND IF (:idSkpd != '%', ppas_anggaran.sikd_satker_id = :idSkpd, 1)
                AND IF (:idSubSkpd != '', ppas_anggaran.sikd_sub_skpd_id = :idSubSkpd, 1)
                GROUP BY
                    ppas_anggaran.id_ppas_anggaran
                UNION
                SELECT
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
                            SUBSTR(HEX(sikd_urusan.`id_sikd_urusan`), 1, 8),
                            SUBSTR(HEX(sikd_urusan.`id_sikd_urusan`), 9, 4),
                            SUBSTR(HEX(sikd_urusan.`id_sikd_urusan`), 13, 4),
                            SUBSTR(HEX(sikd_urusan.`id_sikd_urusan`), 17, 4),
                            SUBSTR(HEX(sikd_urusan.`id_sikd_urusan`), 21)
                            ) AS sikd_urusan_id_sikd_urusan,
                    sikd_urusan.`kd_urusan` AS sikd_urusan_kd_urusan,
                    sikd_urusan.`nm_urusan` AS sikd_urusan_nm_urusan,
                    sikd_satker.`kd_bidang_induk` AS sikd_satker_kd_bidang,
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
                            SUBSTR(HEX(sikd_prog.`id_sikd_prog`), 1, 8),
                            SUBSTR(HEX(sikd_prog.`id_sikd_prog`), 9, 4),
                            SUBSTR(HEX(sikd_prog.`id_sikd_prog`), 13, 4),
                            SUBSTR(HEX(sikd_prog.`id_sikd_prog`), 17, 4),
                            SUBSTR(HEX(sikd_prog.`id_sikd_prog`), 21)
                            ) AS sikd_prog_id_sikd_prog,
                    sikd_prog.`nm_prog` AS sikd_prog_nm_prog,
                    concat(sikd_bidang.`kd_bidang`,sikd_prog.`kd_prog`) AS sikd_prog_kd_prog,
                    CONCAT_WS('-',
                            SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 1, 8),
                            SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 9, 4),
                            SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 13, 4),
                            SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 17, 4),
                            SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 21)
                            ) AS sikd_kgtn_id_sikd_kgtn,
                    concat(sikd_bidang.`kd_bidang`,sikd_kgtn.`kd_kgtn`) AS sikd_kgtn_kd_kgtn,
                    sikd_kgtn.`nm_kgtn` AS sikd_kgtn_nm_kgtn,
                    0 AS jml_pagu_ppas,
                    SUM(rka_mata_anggaran.jumlah) AS jml_pagu_rka
                FROM
                    rka_rka rka_rka
                    INNER JOIN rka_skpd rka_skpd ON rka_rka.id_rka_rka = rka_skpd.id_rka_skpd
                    INNER JOIN rka_skpd_kgtn rka_skpd_kgtn ON rka_skpd.id_rka_skpd = rka_skpd_kgtn.id_rka_skpd_kgtn
                    INNER JOIN rka_mata_anggaran ON rka_rka.id_rka_rka = rka_mata_anggaran.rka_rka_id
                    INNER JOIN `sikd_satker` sikd_satker ON rka_rka.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                    INNER JOIN `sikd_bidang` sikd_bidang ON rka_skpd.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                    INNER JOIN `sikd_urusan` sikd_urusan ON sikd_bidang.`sikd_urusan_id` = sikd_urusan.`id_sikd_urusan`
                    INNER JOIN `sikd_kgtn` sikd_kgtn ON rka_skpd_kgtn.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                    INNER JOIN `sikd_prog` sikd_prog ON sikd_kgtn.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                    LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON rka_rka.`sikd_sub_satker_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                WHERE
                    rka_rka.rapbd_rapbd_id = :idRapbd
                AND IF (:idSkpd != '%', rka_rka.sikd_satker_id = :idSkpd, 1)
                AND IF (:idSubSkpd != '', rka_rka.sikd_sub_satker_id = :idSubSkpd, 1)
                AND rka_rka.rka_perubahan = '0'
                GROUP BY
                    rka_rka.id_rka_rka
                ORDER BY
                    sikd_satker_kode, sikd_sub_skpd_kode,
                    sikd_urusan_kd_urusan, if(sikd_satker_kd_bidang=sikd_bidang_kd_bidang,1,2),
                    sikd_bidang_kd_bidang, sikd_prog_kd_prog, sikd_kgtn_kd_kgtn
                ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rka_rka", $idRkaRka);
            $statement->execute();
            $rkaPengawasanPaguPpasBl = $statement->fetchAll();

            return new JsonResponse($rkaPengawasanPaguPpasBl);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }  
    }
    
    private function getRkaPengawasanPaguPpas($request) {
        try {
            $idRkaRka = $request->query->get("id_rka_rka");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRkaRka = pack('H*', str_replace('-', '', trim($idRkaRka)));
            
            $this->connection = $conn->getConnection();

            $sql = 
                "SELECT
                    sikd_satker.kode as kd_satker,
                    sikd_satker.nama as nm_satker,
                    count(distinct rka_rka.id_rka_rka) as jml_kgtn_rka,
                    sum(rka_mata_anggaran.jumlah) as jml_anggaran_bl_rka,
                    0 as jml_anggaran_btl_rka,
                    0 as jml_kgtn_ppas,
                    0 as jml_anggaran_bl_ppas,
                    0 as jml_anggaran_btl_ppas
                FROM
                    rka_rka
                    inner join rka_skpd_kgtn on rka_rka.id_rka_rka = rka_skpd_kgtn.id_rka_skpd_kgtn
                    inner join rka_mata_anggaran on rka_rka.id_rka_rka = rka_mata_anggaran.rka_rka_id
                    inner join sikd_satker on rka_rka.sikd_satker_id = sikd_satker.id_sikd_satker
                GROUP BY
                    sikd_satker.id_sikd_satker
                UNION
                SELECT
                    sikd_satker.kode as kd_satker,
                    sikd_satker.nama as nm_satker,
                    0 as jml_kgtn_rka,
                    0 as jml_anggaran_bl_rka,
                    sum(rka_mata_anggaran.jumlah) as jml_anggaran_btl_rka,
                    0 as jml_kgtn_ppas,
                    0 as jml_anggaran_bl_ppas,
                    0 as jml_anggaran_btl_ppas
                FROM
                    rka_rka
                    inner join rka_skpd_blnj_tdk_langsung on rka_rka.id_rka_rka = rka_skpd_blnj_tdk_langsung.id_rka_skpd_blnj_tdk_langsung
                    inner join rka_mata_anggaran on rka_rka.id_rka_rka = rka_mata_anggaran.rka_rka_id
                    inner join sikd_satker on rka_rka.sikd_satker_id = sikd_satker.id_sikd_satker
                GROUP BY
                    sikd_satker.id_sikd_satker
                UNION
                SELECT
                    sikd_satker.kode as kd_satker,
                    sikd_satker.nama as nm_satker,
                    0 as jml_kgtn_rka,
                    0 as jml_anggaran_bl_rka,
                    0 as jml_anggaran_btl_rka,
                    count(distinct ppas_blnj_langsung.id_ppas_blnj_langsung) as jml_kgtn_ppas,
                    sum(ppas_mata_anggaran.jml_final) as jml_anggaran_bl_ppas,
                    0 as jml_anggaran_btl_ppas
                FROM
                    ppas_ppas
                    inner join ppas_anggaran on ppas_ppas.id_ppas_ppas = ppas_anggaran.ppas_ppas_id
                    inner join ppas_blnj_langsung on ppas_ppas.id_ppas_ppas = ppas_blnj_langsung.id_ppas_blnj_langsung
                    inner join ppas_mata_anggaran on ppas_anggaran.id_ppas_anggaran = ppas_mata_anggaran.ppas_anggaran_id
                    inner join sikd_satker on ppas_anggaran.sikd_satker_id = sikd_satker.id_sikd_satker
                    inner join sikd_bidang on ppas_blnj_langsung.sikd_bidang_id = sikd_bidang.id_sikd_bidang
                WHERE
                    substr(sikd_bidang.kd_bidang,1,1) in ('1','2')
                GROUP BY
                    sikd_satker.id_sikd_satker
                UNION
                SELECT
                    sikd_satker.kode as kd_satker,
                    sikd_satker.nama as nm_satker,
                    0 as jml_kgtn_rka,
                    0 as jml_anggaran_bl_rka,
                    0 as jml_anggaran_btl_rka,
                    0 as jml_kgtn_ppas,
                    0 as jml_anggaran_bl_ppas,
                    sum(ppas_anggaran.jml_final) as jml_anggaran_btl_ppas
                FROM
                    ppas_ppas
                    inner join ppas_anggaran on ppas_ppas.id_ppas_ppas = ppas_anggaran.ppas_ppas_id
                    inner join ppas_blnj_tdk_langsung on ppas_ppas.id_ppas_ppas = ppas_blnj_tdk_langsung.id_ppas_blnj_tdk_langsung
                    inner join ppas_mata_anggaran on ppas_anggaran.id_ppas_anggaran = ppas_mata_anggaran.ppas_anggaran_id
                    inner join sikd_satker on ppas_anggaran.sikd_satker_id = sikd_satker.id_sikd_satker
                    inner join sikd_bidang on sikd_satker.sikd_bidang_id = sikd_bidang.id_sikd_bidang
                WHERE
                    substr(sikd_bidang.kd_bidang,1,1) in ('5')
                GROUP BY
                    sikd_satker.id_sikd_satker
                ORDER BY
                    kd_satker
                ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rka_rka", $idRkaRka);
            $statement->execute();
            $rkaPengawasanPaguPpas = $statement->fetchAll();

            return new JsonResponse($rkaPengawasanPaguPpas);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }  
    }
    
    private function getRkaSumberDanaKegiatan($request) {
        try {
            $idSikdSatker = $request->query->get("sikd_satker_id");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idSikdSatker = pack('H*', str_replace('-', '', trim($idSikdSatker)));
            
            $this->connection = $conn->getConnection();

            $sql = 
                "SELECT
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
                    rka_skpd_kgtn.`kd_kegiatan` AS rka_skpd_kgtn_kd_kegiatan,
                    rka_skpd_kgtn.`nm_kegiatan` AS rka_skpd_kgtn_nm_kegiatan,
                    rka_skpd_kgtn.`nm_subkegiatan` AS rka_skpd_kgtn_nm_subkegiatan,
                    rka_skpd_kgtn.`jml_anggaran` AS rka_skpd_kgtn_jml_anggaran,
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
                    CONCAT_WS('-',
                            SUBSTR(HEX(sikd_sumber_anggaran.`id_sikd_sumber_anggaran`), 1, 8),
                            SUBSTR(HEX(sikd_sumber_anggaran.`id_sikd_sumber_anggaran`), 9, 4),
                            SUBSTR(HEX(sikd_sumber_anggaran.`id_sikd_sumber_anggaran`), 13, 4),
                            SUBSTR(HEX(sikd_sumber_anggaran.`id_sikd_sumber_anggaran`), 17, 4),
                            SUBSTR(HEX(sikd_sumber_anggaran.`id_sikd_sumber_anggaran`), 21)
                            ) AS sikd_sumber_anggaran_id_sikd_sumber_anggaran,
                    sikd_sumber_anggaran.`kd_sumber_anggaran` AS sikd_sumber_anggaran_kd_sumber_anggaran,
                    sikd_sumber_anggaran.`nm_sumber_anggaran` AS sikd_sumber_anggaran_nm_sumber_anggaran,
                    sikd_sumber_anggaran.`singkatan` AS sikd_sumber_anggaran_singkatan,
                    rka_mata_anggaran.`jumlah` AS rka_mata_anggaran_jumlah
                FROM
                    `rka_rka` rka_rka INNER JOIN `rka_mata_anggaran` rka_mata_anggaran ON rka_rka.`id_rka_rka` = rka_mata_anggaran.`rka_rka_id`
                    INNER JOIN `rka_skpd_kgtn` rka_skpd_kgtn ON rka_rka.`id_rka_rka` = rka_skpd_kgtn.`id_rka_skpd_kgtn`
                    INNER JOIN `sikd_satker` sikd_satker ON rka_rka.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                    LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON rka_rka.`sikd_sub_satker_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                    INNER JOIN `sikd_sumber_anggaran` sikd_sumber_anggaran ON rka_mata_anggaran.`sikd_sumber_anggaran_id` = sikd_sumber_anggaran.`id_sikd_sumber_anggaran`
                    INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON rka_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                WHERE
                    rka_rka.sikd_satker_id LIKE !:idSkpd 
                    AND IF(:idSubSkpd != '', rka_rka.sikd_sub_satker_id = :idSubSkpd, 1) 
                    AND rka_rka.rka_perubahan = '0'
                    AND rka_rka.status_rka IN ('0','1')
                    AND IF(:jnsSmbrAnggrn != '', sikd_sumber_anggaran.singkatan = :jnsSmbrAnggrn, 1)
                ORDER BY
                    sikd_satker_kode, sikd_sub_skpd_kode,
                    sikd_urusan_kd_urusan, if(sikd_satker_kd_bidang=sikd_bidang_kd_bidang,1,2),
                    sikd_bidang_kd_bidang, sikd_prog_kd_prog, sikd_kgtn_kd_kgtn
                ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("sikd_satker_id", $idSikdSatker);
            $statement->execute();
            $rkaSumberDanaKegiatan = $statement->fetchAll();

            return new JsonResponse($rkaSumberDanaKegiatan);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }  
    }
    
}
