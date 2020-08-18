<?php
namespace App\Controller\Musren;

use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Delete;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * @RouteResource("musrenreport")
 */
class MusrenReportController extends \App\Controller\ApiBaseController
{
    
    //protected $dbalConnName = 'simral_musren';
    
    public function cgetAction(Request $request) 
    {
        //print_r("ok");exit;
        $rpt = $request->query->get("jns_report");
        switch ($rpt){
            //DESA/KELURAHAN
            case "musren_desa_list_kgtn_swdy":
                return $this->getMusrenDesaListKgtnSwdy($request);
            case "musren_desa_list_kgtn_swdy_sub":
                return $this->getMusrenDesaListKgtnSwdySub($request);
            case "musren_desa_list_kgtn":
                return $this->getMusrenDesaListKgtn($request);
            case "musren_desa_list_kgtn_sub":
                return $this->getMusrenDesaListKgtnSub($request);
            case "musren_desa_rekap_kgtn":
                return $this->getMusrenDesaRekapKgtn($request);
            case "musren_desa_rekap_kgtn_mus":
                return $this->getMusrenDesaRekapKgtnMus($request);
            case "musren_desa_list_flow_usulan":
                return $this->getMusrenDesaListFlowUsulan($request);
            case "musren_desa_list_flow_usulan_sub":
                return $this->getMusrenDesaListFlowUsulanSub($request);
            case "musren_desa_list_kgtn_kec_stj":
                return $this->getMusrenDesaListKgtnKecStj($request);
            case "musren_desa_list_kgtn_kec_stj_sub":
                return $this->getMusrenDesaListKgtnKecStjSub($request);
            case "musren_desa_list_kgtn_skpd_stj":
                return $this->getMusrenDesaListKgtnSkpdStj($request);
            case "musren_desa_list_kgtn_skpd_stj_sub":
                return $this->getMusrenDesaListKgtnSkpdStjSub($request);
            case "musren_desa_list_kgtn_kota_stj":
                return $this->getMusrenDesaListKgtnKotaStj($request);
            case "musren_desa_list_kgtn_kota_stj_sub":
                return $this->getMusrenDesaListKgtnKotaStjSub($request);
            case "musren_desa_delegasi":
                return $this->getMusrenDesaDelegasi($request);
            case "musren_desa_list_prioritas_usulan":
                return $this->getMusrenDesaListPrioritasUsulan($request);
            case "musren_desa_list_usulan_desa":
                return $this->getMusrenDesaListUsulanDesa($request);
            case "musren_desa_list_kgtn_blm_verf":
                return $this->getMusrenDesaListKgtnBlmVerf($request);
            case "musren_desa_list_kgtn_kec_tdk_stj"://EMPTY DATA
                return $this->getMusrenDesaListKgtnKecTdkStj($request);
            
            //KECAMATAN
            case "musren_kec_list_usulan_desa":
                return $this->getMusrenKecListUsulanDesa($request);
            case "musren_kec_list_usulan_desa_sub":
                return $this->getMusrenKecListUsulanDesaSub($request);
            case "musren_kec_list_usulan_desa_sub1":
                return $this->getMusrenKecListUsulanDesaSub1($request);
            case "musren_kec_list_kgtn":
                return $this->getMusrenKecListKgtn($request);
            case "musren_kec_list_kgtn_sub":
                return $this->getMusrenKecListKgtnSub($request);
            case "musren_kec_rekap_lokasi":
                return $this->getMusrenKecRekapLokasi($request);
            case "musren_kec_rekap_bidang":
                return $this->getMusrenKecRekapBidang($request);
            case "musren_kec_list_flow_usulan":
                return $this->getMusrenKecListFlowUsulan($request);
            case "musren_kec_list_flow_usulan_sub":
                return $this->getMusrenKecListFlowUsulanSub($request);
            case "musren_kec_delegasi":
                return $this->getMusrenKecDelegasi($request);
            case "musren_kec_rekap_usulan_desa":
                return $this->getMusrenKecRekapUsulanDesa($request);
            case "musren_kec_list_kgtn_skpd_stj":
                return $this->getMusrenKecListKgtnSkpdStj($request);
            case "musren_kec_list_kgtn_skpd_stj_sub":
                return $this->getMusrenKecListKgtnSkpdStjSub($request);
            case "musren_kec_list_kgtn_kota_stj":
                return $this->getMusrenKecListKgtnKotaStj($request);
            case "musren_kec_list_kgtn_kota_stj_sub":
                return $this->getMusrenKecListKgtnKotaStjSub($request);
            
            //RESES DEWAN
            case "musren_reses_list_kgtn":
                return $this->getMusrenResesListKgtn($request);
            case "musren_reses_rekap_lokasi":
                return $this->getMusrenResesRekapLokasi($request);
            case "musren_reses_list_flow_usulan":
                return $this->getMusrenResesListFlowUsulan($request);
            case "musren_reses_list_flow_usulan_sub":
                return $this->getMusrenResesListFlowUsulanSub($request);

            //FORUM SKPD
            case "musren_skpd_list_usulan_res":
                return $this->getMusrenSkpdListUsulanRes($request);
            case "musren_skpd_list_usulan_kec":
                return $this->getMusrenSkpdListUsulanKec($request);
            case "musren_skpd_list_usulan_kec_sub":
                return $this->getMusrenSkpdListUsulanKecSub($request);
            case "musren_skpd_list_usulan_kec_sub1":
                return $this->getMusrenSkpdListUsulanKecSub1($request);
            case "musren_skpd_list_kgtn":
                return $this->getMusrenSkpdListKgtn($request);
            case "musren_skpd_list_kgtn_ringkas":
                return $this->getMusrenSkpdListKgtnRingkas($request);
            case "musren_skpd_list_kgtn_sub":
                return $this->getMusrenSkpdListKgtnSub($request);
            case "musren_skpd_list_flow_usulan":
                return $this->getMusrenSkpdListFlowUsulan($request);
            case "musren_skpd_rekap_usulan_kec":
                return $this->getMusrenSkpdRekapUsulanKec($request);
            case "musren_skpd_rekap_usulan_res":
                return $this->getMusrenSkpdRekapUsulanRes($request);
            case "musren_skpd_list_kgtn_kota_stj_rekap":
                return $this->getMusrenSkpdListKgtnKotaStjRekap($request);
            case "musren_skpd_list_kgtn_kota_stj":
                return $this->getMusrenSkpdListKgtnKotaStj($request);
            case "musren_skpd_list_kgtn_kota_stj_sub":
                return $this->getMusrenSkpdListKgtnKotaStjSub($request);
            case "musren_skpd_hibah_bansos":
                return $this->getMusrenSkpdHibahBansos($request);
            case "musren_skpd_rekap_anggaran":
                return $this->getMusrenSkpdRekapAnggaran($request);
            case "anomali_smbr_anggaran":
                return $this->getAnomaliSmbrAnggaran($request);

            //KABUPATEN/KOTA
            case "musren_kab_list_flow_usulan_desa":
                return $this->getMusrenKabListFlowUsulanDesa($request);
            case "musren_kab_list_flow_usulan_desa_w":
                return $this->getMusrenKabListFlowUsulanDesaW($request);
            case "musren_kab_list_flow_usulan_desa_f":
                return $this->getMusrenKabListFlowUsulanDesaF($request);
            case "musren_kab_list_flow_usulan_kec":
                return $this->getMusrenKabListFlowUsulanKec($request);
            case "musren_kab_list_flow_usulan_kec_w":
                return $this->getMusrenKabListFlowUsulanKecW($request);
            case "musren_kab_list_flow_usulan_kec_f":
                return $this->getMusrenKabListFlowUsulanKecF($request);
            case "musren_kab_rekap_usulan_per_satker":
                return $this->getMusrenKabRekapUsulanPerSatker($request);
            case "musren_kab_rekap_usulan_per_bidang":
                return $this->getMusrenKabRekapUsulanPerBidang($request);
            case "musren_kab_rekap_usulan_per_fungsi":
                return $this->getMusrenKabRekapUsulanPerFungsi($request);
            case "musren_kab_rekap_usulan_per_wilayah":
                return $this->getMusrenKabRekapUsulanPerWilayah($request);
            case "musren_kab_rekap_usulan_per_musren":
                return $this->getMusrenKabRekapUsulanPerMusren($request);
            case "musren_skpd_rekap_kgtn_skpd":
                return $this->getMusrenSkpdRekapKgtnSkpd($request);
            case "musren_skpd_rekap_kgtn_skpd_2":
                return $this->getMusrenSkpdRekapKgtnSkpd2($request);
            case "musren_skpd_list_kgtn":
                return $this->getMusrenSkpdListKgtn($request);
            case "musren_skpd_list_kgtn_ringkas":
                return $this->getMusrenSkpdListKgtnRingkas($request);
            case "musren_skpd_list_kgtn_sub":
                return $this->getMusrenSkpdListKgtnSub($request);
            case "musren_skpd_rekap_bid_prog":
                return $this->getMusrenSkpdRekapBidProg($request);
            case "musren_kab_rekap_kgtn_skpd":
                return $this->getMusrenKabRekapKgtnSkpd($request);
            case "musren_kab_rekap_kgtn_skpd_2":
                return $this->getMusrenKabRekapKgtnSkpd2($request);
            case "musren_kab_list_kgtn":
                return $this->getMusrenKabListKgtn($request);
            case "musren_kab_list_kgtn_sub":
                return $this->getMusrenKabListKgtnSub($request);
            case "musren_kab_list_kgtn_ringkas":
                return $this->getMusrenKabListKgtnRingkas($request);
            case "musren_kab_rekap_bid_prog":
                return $this->getMusrenKabRekapBidProg($request);
            case "musren_kab_list_flow_usulan":
                return $this->getMusrenKabListFlowUsulan($request);

            //PENGAWASAN
            case "musren_desa_blm_kgtn":
                return $this->getMusrenDesaBlmKgtn($request);
            case "musren_kec_blm_kgtn":
                return $this->getMusrenKecBlmKgtn($request);
            case "musren_skpd_blm_kgtn":
                return $this->getMusrenSkpdBlmKgtn($request);
            case "musren_kec_list_usulan_desa_blm_proses":
                return $this->getMusrenKecListUsulanDesaBlmProses($request);
            case "musren_skpd_list_usulan_kec_blm_proses":
                return $this->getMusrenSkpdListUsulanKecBlmProses($request);
            case "musren_kab_list_usulan_skpd_blm_proses":
                return $this->getMusrenKabListUsulanSkpdBlmProses($request);
            
            default:
                throw new BadRequestHttpException("Undefined report");    
        }
    }
    
    //DESA/KELURAHAN
    private function getMusrenDesaListKgtnSwdy($request)
    {
        try {
            
            $kec = $request->query->get("kec");
            $desa = $request->query->get("desa");
            $prioritas = $request->query->get("prioritas");
            $quota = $request->query->get("quota");
            $idBidang = $request->query->get("bidang");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idBidang = pack('H*', str_replace('-', '', trim($idBidang)));
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 1, 8),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 9, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 13, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 17, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 21)
                         ) AS musren_kgtn_id_musren_kgtn,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 1, 8),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 9, 4),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 13, 4),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 17, 4),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 21)
                         ) AS musren_kgtn_sikd_musren_bidang_id,
                         sikd_musren_bidang.`kd_bidang` AS sikd_musren_bidang_kd_bidang,
                         sikd_musren_bidang.`nm_bidang` AS sikd_musren_bidang_nm_bidang,
                         musren_kgtn.`nm_kgtn` AS musren_kgtn_nm_kgtn,
                         musren_kgtn.`nm_subkgtn` AS musren_kgtn_nm_subkgtn,
                         musren_kgtn.`prioritas` AS musren_kgtn_prioritas,
                         musren_kgtn.`sifat_kgtn` AS musren_kgtn_sifat_kgtn,
                         musren_kgtn.`output` AS musren_kgtn_output,
                         musren_kgtn.`outcome` AS musren_kgtn_outcome,
                         musren_kgtn_desa.`no_urut_usulan` AS musren_kgtn_desa_no_urut_usulan,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 1, 8),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 9, 4),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 13, 4),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 17, 4),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 21)
                         ) AS musren_musrenbang_id_musren_musrenbang,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_musrenbang_desa.`id_musren_musrenbang`), 1, 8),
                        SUBSTR(HEX(musren_musrenbang_desa.`id_musren_musrenbang`), 9, 4),
                        SUBSTR(HEX(musren_musrenbang_desa.`id_musren_musrenbang`), 13, 4),
                        SUBSTR(HEX(musren_musrenbang_desa.`id_musren_musrenbang`), 17, 4),
                        SUBSTR(HEX(musren_musrenbang_desa.`id_musren_musrenbang`), 21)
                         ) AS musren_musrenbang_desa_id_musren_musdesa,
                         musren_musrenbang.`tahun` AS musren_musrenbang_tahun,
                         vw_appl_kode_wilayah.`kode_wilayah` AS vw_appl_kode_wilayah_kode_wilayah,
                         vw_appl_kode_wilayah.`klasifikasi` AS vw_appl_kode_wilayah_klasifikasi,
                         vw_appl_kode_wilayah.`nama_wilayah` AS vw_appl_kode_wilayah_nama_wilayah,
                         vw_appl_kode_wilayah_induk.`kode_wilayah` AS vw_appl_kode_wilayah_induk_kode_wilayah,
                         vw_appl_kode_wilayah_induk.`nama_wilayah` AS vw_appl_kode_wilayah_induk_nama_wilayah,
                         SUM(vw_musren_anggaran_kgtn_desa.`jml_swadaya`) AS vw_musren_anggaran_kgtn_desa_jml_swadaya,
                         SUM(vw_musren_anggaran_kgtn_desa.`jml_apb_desa`) AS vw_musren_anggaran_kgtn_desa_jml_apb_desa
                    FROM
                         `musren_kgtn` musren_kgtn_desa 
                         INNER JOIN `musren_kgtn` musren_kgtn ON musren_kgtn_desa.`id_musren_kgtn` = musren_kgtn.`id_musren_kgtn`
                         INNER JOIN `musren_musrenbang` musren_musrenbang ON musren_kgtn.`musren_musrenbang_id` = musren_musrenbang.`id_musren_musrenbang`
                         INNER JOIN `sikd_bidang` sikd_musren_bidang ON musren_kgtn.`sikd_bidang_id` = sikd_musren_bidang.`id_sikd_bidang`
                         INNER JOIN `musren_lokasi_kgtn` musren_lokasi_kgtn ON musren_kgtn.`id_musren_kgtn` = musren_lokasi_kgtn.`musren_kgtn_id`
                         INNER JOIN `vw_musren_anggaran_kgtn_desa` vw_musren_anggaran_kgtn_desa ON musren_lokasi_kgtn.`id_musren_lokasi_kgtn` = vw_musren_anggaran_kgtn_desa.`musren_lokasi_kgtn_id`
                         INNER JOIN `musren_musrenbang` musren_musrenbang_desa ON musren_musrenbang.`id_musren_musrenbang` = musren_musrenbang_desa.`id_musren_musrenbang` AND musren_musrenbang_desa.`musren_musrenbang_type` = 'MusrenMusrenbangDesa'
                         INNER JOIN `vw_appl_kode_wilayah` vw_appl_kode_wilayah ON musren_musrenbang.`kd_wilayah` = vw_appl_kode_wilayah.`kode_wilayah`
                         INNER JOIN `vw_appl_kode_wilayah_induk` vw_appl_kode_wilayah_induk ON vw_appl_kode_wilayah.`kode_induk` = vw_appl_kode_wilayah_induk.`kode_wilayah`
                         INNER JOIN `musren_jns_kgtn` musren_jns_kgtn ON musren_kgtn.`musren_jns_kgtn_id` = musren_jns_kgtn.`id_musren_jns_kgtn`
                    WHERE
                        musren_kgtn_desa.`musren_kgtn_type` = 'MusrenKgtnDesa'
                     AND musren_kgtn_desa.`status_verifikasi` = '1'
                     AND vw_appl_kode_wilayah_induk.`kode_wilayah` = :kec
                     AND IF(:desa != '', musren_musrenbang.`kd_wilayah` = :desa, musren_musrenbang.`kd_wilayah` LIKE '%')
                     AND IF(:bidang != '', sikd_musren_bidang.`id_sikd_bidang` = :bidang,  sikd_musren_bidang.`id_sikd_bidang` LIKE '%')
                     AND IF(:prioritas != '', musren_kgtn.`prioritas` = :prioritas, 1)
                     AND IF(:quota != '', musren_jns_kgtn.`no_jns_kgtn` = :quota, 1)
                    GROUP BY
                         vw_appl_kode_wilayah_induk.`kode_wilayah`,
                         vw_appl_kode_wilayah.`kode_wilayah`,
                         sikd_musren_bidang.kd_bidang,
                         musren_kgtn.`id_musren_kgtn`
                    HAVING (vw_musren_anggaran_kgtn_desa_jml_swadaya+vw_musren_anggaran_kgtn_desa_jml_apb_desa) > 0    
                    ORDER BY
                         vw_appl_kode_wilayah_induk.`kode_wilayah` ASC,
                         vw_appl_kode_wilayah.`kode_wilayah` ASC,
                         sikd_musren_bidang.kd_bidang ASC,
                         musren_kgtn_desa.`no_urut_usulan` ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("kec", $kec);
            $statement->bindValue("desa", $desa);
            $statement->bindValue("prioritas", $prioritas);
            $statement->bindValue("quota", $quota);
            $statement->bindValue("bidang", $idBidang);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getMusrenDesaListKgtnSwdySub($request)
    {
        try {
            
            $idMusrenKgtn = $request->query->get("id_musren_kgtn");            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idMusrenKgtn = pack('H*', str_replace('-', '', trim($idMusrenKgtn)));
            
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_lokasi_kgtn.`musren_kgtn_id`), 1, 8),
                        SUBSTR(HEX(musren_lokasi_kgtn.`musren_kgtn_id`), 9, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.`musren_kgtn_id`), 13, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.`musren_kgtn_id`), 17, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.`musren_kgtn_id`), 21)
                         ) AS musren_lokasi_kgtn_musren_kgtn_id,
                         musren_lokasi_kgtn.`nm_lokasi` AS musren_lokasi_kgtn_nm_lokasi_kgtn,
                         if(musren_lokasi_kgtn.`rt` not in (0,''), musren_lokasi_kgtn.`rt`, '-') AS musren_lokasi_kgtn_rt,
                         if(musren_lokasi_kgtn.`rw` not in (0,''), musren_lokasi_kgtn.`rw`, '-') AS musren_lokasi_kgtn_rw,
                         musren_lokasi_kgtn.`volume` AS musren_lokasi_kgtn_volume,
                         musren_lokasi_kgtn.`satuan` AS musren_lokasi_kgtn_satuan,
                         vw_musren_anggaran_kgtn_desa.`jml_swadaya` AS vw_musren_anggaran_kgtn_desa_jml_swadaya,
                         vw_musren_anggaran_kgtn_desa.`jml_apb_desa` AS vw_musren_anggaran_kgtn_desa_jml_apb_desa,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 1, 8),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 9, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 13, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 17, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 21)
                         ) AS musren_kgtn_id_musren_kgtn
                    FROM
                         `vw_musren_anggaran_kgtn_desa` vw_musren_anggaran_kgtn_desa 
                         RIGHT OUTER JOIN `musren_lokasi_kgtn` musren_lokasi_kgtn ON vw_musren_anggaran_kgtn_desa.`musren_lokasi_kgtn_id` = musren_lokasi_kgtn.`id_musren_lokasi_kgtn`
                         RIGHT OUTER JOIN `musren_kgtn` musren_kgtn ON musren_lokasi_kgtn.`musren_kgtn_id` = musren_kgtn.`id_musren_kgtn`
                    WHERE 
                         musren_kgtn.id_musren_kgtn = :id_musren_kgtn
                    ORDER BY
                         musren_lokasi_kgtn.`id_musren_lokasi_kgtn`";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_musren_kgtn", $idMusrenKgtn);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getMusrenDesaListKgtn($request)
    {
        try {
            
            $kec = $request->query->get("kec");
            $desa = $request->query->get("desa");
            $prioritas = $request->query->get("prioritas");
            $quota = $request->query->get("quota");
            $idBidang = $request->query->get("bidang");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idBidang = pack('H*', str_replace('-', '', trim($idBidang)));
            
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 1, 8),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 9, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 13, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 17, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 21)
                         ) AS musren_kgtn_id_musren_kgtn,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 1, 8),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 9, 4),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 13, 4),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 17, 4),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 21)
                         ) AS musren_kgtn_sikd_musren_bidang_id,
                         sikd_musren_bidang.`kd_bidang` AS sikd_musren_bidang_kd_bidang,
                         sikd_musren_bidang.`nm_bidang` AS sikd_musren_bidang_nm_bidang,
                         musren_kgtn.`nm_kgtn` AS musren_kgtn_nm_kgtn,
                         musren_kgtn.`nm_subkgtn` AS musren_kgtn_nm_subkgtn,
                         musren_kgtn.`prioritas` AS musren_kgtn_prioritas,
                         musren_kgtn.`sifat_kgtn` AS musren_kgtn_sifat_kgtn,
                         musren_kgtn.`output` AS musren_kgtn_output,
                         musren_kgtn.`outcome` AS musren_kgtn_outcome,
                         musren_kgtn_desa.`no_urut_usulan` AS musren_kgtn_desa_no_urut_usulan,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 1, 8),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 9, 4),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 13, 4),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 17, 4),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 21)
                         ) AS musren_musrenbang_id_musren_musrenbang,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_musrenbang_desa.`id_musren_musrenbang`), 1, 8),
                        SUBSTR(HEX(musren_musrenbang_desa.`id_musren_musrenbang`), 9, 4),
                        SUBSTR(HEX(musren_musrenbang_desa.`id_musren_musrenbang`), 13, 4),
                        SUBSTR(HEX(musren_musrenbang_desa.`id_musren_musrenbang`), 17, 4),
                        SUBSTR(HEX(musren_musrenbang_desa.`id_musren_musrenbang`), 21)
                         ) AS musren_musrenbang_desa_id_musren_musdesa,
                         musren_musrenbang.`tahun` AS musren_musrenbang_tahun,
                         vw_appl_kode_wilayah.`kode_wilayah` AS vw_appl_kode_wilayah_kode_wilayah,
                         vw_appl_kode_wilayah.`klasifikasi` AS vw_appl_kode_wilayah_klasifikasi,
                         vw_appl_kode_wilayah.`nama_wilayah` AS vw_appl_kode_wilayah_nama_wilayah,
                         vw_appl_kode_wilayah_induk.`kode_wilayah` AS vw_appl_kode_wilayah_induk_kode_wilayah,
                         vw_appl_kode_wilayah_induk.`nama_wilayah` AS vw_appl_kode_wilayah_induk_nama_wilayah,
                         SUM(vw_musren_anggaran_kgtn_desa.`jml_apbd_kab`) AS vw_musren_anggaran_kgtn_desa_jml_apbd_kab,
                         SUM(vw_musren_anggaran_kgtn_desa.`jml_apbd_prop`) AS vw_musren_anggaran_kgtn_desa_jml_apbd_prop,
                         SUM(vw_musren_anggaran_kgtn_desa.`jml_apbn`) AS vw_musren_anggaran_kgtn_desa_jml_apbn,
                         SUM(vw_musren_anggaran_kgtn_desa.`jml_sumber_lain`) AS vw_musren_anggaran_kgtn_desa_jml_sumber_lain
                    FROM
                         `musren_kgtn` musren_kgtn_desa 
                         INNER JOIN `musren_kgtn` musren_kgtn ON musren_kgtn_desa.`id_musren_kgtn` = musren_kgtn.`id_musren_kgtn`
                         INNER JOIN `musren_musrenbang` musren_musrenbang ON musren_kgtn.`musren_musrenbang_id` = musren_musrenbang.`id_musren_musrenbang`
                         INNER JOIN `sikd_bidang` sikd_musren_bidang ON musren_kgtn.`sikd_bidang_id` = sikd_musren_bidang.`id_sikd_bidang`
                         INNER JOIN `musren_lokasi_kgtn` musren_lokasi_kgtn ON musren_kgtn.`id_musren_kgtn` = musren_lokasi_kgtn.`musren_kgtn_id`
                         INNER JOIN `vw_musren_anggaran_kgtn_desa` vw_musren_anggaran_kgtn_desa ON musren_lokasi_kgtn.`id_musren_lokasi_kgtn` = vw_musren_anggaran_kgtn_desa.`musren_lokasi_kgtn_id`
                         INNER JOIN `musren_musrenbang` musren_musrenbang_desa ON musren_musrenbang.`id_musren_musrenbang` = musren_musrenbang_desa.`id_musren_musrenbang` AND musren_musrenbang_desa.`musren_musrenbang_type` = 'MusrenMusrenbangDesa'
                         INNER JOIN `vw_appl_kode_wilayah` vw_appl_kode_wilayah ON musren_musrenbang.`kd_wilayah` = vw_appl_kode_wilayah.`kode_wilayah`
                         INNER JOIN `vw_appl_kode_wilayah_induk` vw_appl_kode_wilayah_induk ON vw_appl_kode_wilayah.`kode_induk` = vw_appl_kode_wilayah_induk.`kode_wilayah`
                         INNER JOIN `musren_jns_kgtn` musren_jns_kgtn ON musren_kgtn_desa.`musren_jns_kgtn_id` = musren_jns_kgtn.`id_musren_jns_kgtn`
                    WHERE
                        musren_kgtn_desa.`musren_kgtn_type` = 'MusrenKgtnDesa'
                     AND musren_kgtn_desa.`status_verifikasi` = '1'
                     AND vw_appl_kode_wilayah_induk.`kode_wilayah` = :kec
                     AND IF(:desa != '', musren_musrenbang.`kd_wilayah` = :desa, 1)
                     AND IF(:bidang != '', sikd_musren_bidang.`id_sikd_bidang` = :bidang, 1)
                     AND IF(:prioritas != '', musren_kgtn.`prioritas` = :prioritas, 1)
                     AND IF(:quota != '', musren_jns_kgtn.`no_jns_kgtn` = :quota, 1)
                    GROUP BY
                         vw_appl_kode_wilayah_induk.`kode_wilayah`,
                         vw_appl_kode_wilayah.`kode_wilayah`,
                         sikd_musren_bidang.kd_bidang,
                         musren_kgtn_desa.`no_urut_usulan`
                    ORDER BY
                         vw_appl_kode_wilayah_induk.`kode_wilayah` ASC,
                         vw_appl_kode_wilayah.`kode_wilayah` ASC,
                         sikd_musren_bidang.kd_bidang ASC,
                         musren_kgtn_desa.`no_urut_usulan` ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("kec", $kec);
            $statement->bindValue("desa", $desa);
            $statement->bindValue("prioritas", $prioritas);
            $statement->bindValue("quota", $quota);
            $statement->bindValue("bidang", $idBidang);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getMusrenDesaListKgtnSub($request)
    {
        try {
            
            $idMusrenKgtn = $request->query->get("id_musren_kgtn");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idMusrenKgtn = pack('H*', str_replace('-', '', trim($idMusrenKgtn)));
            
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_lokasi_kgtn.`musren_kgtn_id`), 1, 8),
                        SUBSTR(HEX(musren_lokasi_kgtn.`musren_kgtn_id`), 9, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.`musren_kgtn_id`), 13, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.`musren_kgtn_id`), 17, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.`musren_kgtn_id`), 21)
                         ) AS musren_lokasi_kgtn_musren_kgtn_id,
                         musren_lokasi_kgtn.`nm_lokasi` AS musren_lokasi_kgtn_nm_lokasi_kgtn,
                         if(musren_lokasi_kgtn.`rt` not in (0,''), musren_lokasi_kgtn.`rt`, '-') AS musren_lokasi_kgtn_rt,
                         if(musren_lokasi_kgtn.`rw` not in (0,''), musren_lokasi_kgtn.`rw`, '-') AS musren_lokasi_kgtn_rw,
                         if(musren_lokasi_kgtn.`volume` = '',0,musren_lokasi_kgtn.`volume`) AS musren_lokasi_kgtn_volume,
                         musren_lokasi_kgtn.`satuan` AS musren_lokasi_kgtn_satuan,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 1, 8),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 9, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 13, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 17, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 21)
                         ) AS musren_kgtn_id_musren_kgtn,
                         vw_musren_anggaran_kgtn_desa.`jml_apbd_kab` AS vw_musren_anggaran_kgtn_desa_jml_apbd_kab,
                         vw_musren_anggaran_kgtn_desa.`jml_apbd_prop` AS vw_musren_anggaran_kgtn_desa_jml_apbd_prop,
                         vw_musren_anggaran_kgtn_desa.`jml_apbn` AS vw_musren_anggaran_kgtn_desa_jml_apbn,
                         vw_musren_anggaran_kgtn_desa.`jml_sumber_lain` AS vw_musren_anggaran_kgtn_desa_jml_sumber_lain
                    FROM
                         `vw_musren_anggaran_kgtn_desa` vw_musren_anggaran_kgtn_desa 
                         RIGHT OUTER JOIN `musren_lokasi_kgtn` musren_lokasi_kgtn ON vw_musren_anggaran_kgtn_desa.`musren_lokasi_kgtn_id` = musren_lokasi_kgtn.`id_musren_lokasi_kgtn`
                         RIGHT OUTER JOIN `musren_kgtn` musren_kgtn ON musren_lokasi_kgtn.`musren_kgtn_id` = musren_kgtn.`id_musren_kgtn`
                    WHERE
                         musren_kgtn.id_musren_kgtn = :id_musren_kgtn
                    ORDER BY
                         musren_lokasi_kgtn.`id_musren_lokasi_kgtn`";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_musren_kgtn", $idMusrenKgtn);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getMusrenDesaRekapKgtn($request)
    {
        try {
            
            $desa = $request->query->get("desa");
            $prioritas = $request->query->get("prioritas");
            $quota = $request->query->get("quota");
            $tahun = $request->query->get("tahun");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT DISTINCT
                         count(distinct (if((vw_musren_anggaran_kgtn_desa.`jml_swadaya`+ vw_musren_anggaran_kgtn_desa.`jml_apb_desa`) > 0,CONCAT_WS('-',
                                SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 1, 8),
                                SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 9, 4),
                                SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 13, 4),
                                SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 17, 4),
                                SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 21)
                                 ),null)))jml_kgtn_swadaya,
                         count(distinct (if((vw_musren_anggaran_kgtn_desa.`jml_apbd_kab`+ vw_musren_anggaran_kgtn_desa.`jml_apbd_prop` + vw_musren_anggaran_kgtn_desa.`jml_apbn`+vw_musren_anggaran_kgtn_desa.`jml_sumber_lain`) > 0,CONCAT_WS('-',
                                SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 1, 8),
                                SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 9, 4),
                                SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 13, 4),
                                SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 17, 4),
                                SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 21)
                                 ),null)))jml_kgtn_non_swadaya,
                         sum(vw_musren_anggaran_kgtn_desa.`jml_swadaya`)AS jml_swadaya,
                         sum(vw_musren_anggaran_kgtn_desa.`jml_apb_desa`)AS jml_apb_desa,
                         sum(vw_musren_anggaran_kgtn_desa.`jml_apbd_kab`)AS jml_apbd_kab,
                         sum(vw_musren_anggaran_kgtn_desa.`jml_apbd_prop`)AS jml_apbd_prop,
                         sum(vw_musren_anggaran_kgtn_desa.`jml_apbn`)AS jml_apbn,
                         sum(vw_musren_anggaran_kgtn_desa.`jml_sumber_lain`)AS jml_sumber_lain,
                         count(distinct CONCAT_WS('-',
                                SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 1, 8),
                                SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 9, 4),
                                SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 13, 4),
                                SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 17, 4),
                                SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 21)
                                 )) AS jml_kgtn,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 1, 8),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 9, 4),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 13, 4),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 17, 4),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 21)
                         ) AS musren_kgtn_sikd_musren_bidang_id,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn.`musren_musrenbang_id`), 1, 8),
                        SUBSTR(HEX(musren_kgtn.`musren_musrenbang_id`), 9, 4),
                        SUBSTR(HEX(musren_kgtn.`musren_musrenbang_id`), 13, 4),
                        SUBSTR(HEX(musren_kgtn.`musren_musrenbang_id`), 17, 4),
                        SUBSTR(HEX(musren_kgtn.`musren_musrenbang_id`), 21)
                         ) AS musren_kgtn_musren_musrenbang_id,
                         musren_musrenbang.`tahun` AS musren_musrenbang_tahun,
                         musren_musrenbang.`kd_wilayah` AS musren_musrenbang_kd_wilayah,
                         sikd_musren_bidang.`kd_bidang` AS sikd_musren_bidang_kd_bidang,
                         sikd_musren_bidang.`nm_bidang` AS sikd_musren_bidang_nm_bidang,
                         vw_appl_kode_wilayah.`kode_wilayah` AS vw_appl_kode_wilayah_kode_wilayah,
                         vw_appl_kode_wilayah.`klasifikasi` AS vw_appl_kode_wilayah_klasifikasi,
                         vw_appl_kode_wilayah.`nama_wilayah` AS vw_appl_kode_wilayah_nama_wilayah,
                         vw_appl_kode_wilayah_induk.`kode_wilayah` AS vw_appl_kode_wilayah_induk_kode_wilayah,
                         vw_appl_kode_wilayah_induk.`klasifikasi` AS vw_appl_kode_wilayah_induk_klasifikasi,
                         vw_appl_kode_wilayah_induk.`nama_wilayah` AS vw_appl_kode_wilayah_induk_nama_wilayah
                    FROM
                         `musren_kgtn` musren_kgtn 
                         INNER JOIN `sikd_bidang` sikd_musren_bidang ON musren_kgtn.`sikd_bidang_id` = sikd_musren_bidang.`id_sikd_bidang`
                         INNER JOIN `musren_musrenbang` musren_musrenbang ON musren_kgtn.`musren_musrenbang_id` = musren_musrenbang.`id_musren_musrenbang`
                         INNER JOIN `vw_appl_kode_wilayah` vw_appl_kode_wilayah ON musren_musrenbang.`kd_wilayah` = vw_appl_kode_wilayah.`kode_wilayah`
                         INNER JOIN `vw_appl_kode_wilayah_induk` vw_appl_kode_wilayah_induk ON vw_appl_kode_wilayah.`kode_induk` = vw_appl_kode_wilayah_induk.`kode_wilayah`
                         INNER JOIN `musren_kgtn` musren_kgtn_desa ON musren_kgtn.`id_musren_kgtn` = musren_kgtn_desa.`id_musren_kgtn` AND musren_kgtn_desa.`musren_kgtn_type` = 'MusrenKgtnDesa'
                         LEFT OUTER JOIN `musren_lokasi_kgtn` musren_lokasi_kgtn ON musren_kgtn.`id_musren_kgtn` = musren_lokasi_kgtn.`musren_kgtn_id`
                         LEFT OUTER JOIN `vw_musren_anggaran_kgtn_desa` vw_musren_anggaran_kgtn_desa ON musren_lokasi_kgtn.`id_musren_lokasi_kgtn` = vw_musren_anggaran_kgtn_desa.`musren_lokasi_kgtn_id`
                         INNER JOIN `musren_jns_kgtn` musren_jns_kgtn ON musren_kgtn_desa.`musren_jns_kgtn_id` = musren_jns_kgtn.`id_musren_jns_kgtn`
                    WHERE
                         musren_kgtn_desa.`status_verifikasi` = '1'
                     AND musren_musrenbang.`tahun` = :tahun
                     AND IF(:desa != '', musren_musrenbang.`kd_wilayah` = :desa, 1)
                     AND IF(:prioritas != '', musren_kgtn.`prioritas` = :prioritas, 1)
                     AND IF(:quota != '', musren_jns_kgtn.`no_jns_kgtn` = :quota, 1)
                    GROUP BY
                         musren_musrenbang.`kd_wilayah`,
                         sikd_musren_bidang.`kd_bidang`
                    ORDER BY
                         musren_musrenbang.`kd_wilayah` ASC,
                         sikd_musren_bidang.`kd_bidang` ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("desa", $desa);
            $statement->bindValue("prioritas", $prioritas);
            $statement->bindValue("quota", $quota);
            $statement->bindValue("tahun", $tahun);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getMusrenDesaRekapKgtnMus($request)
    {
        try {
            
            $desa = $request->query->get("desa");
            $prioritas = $request->query->get("prioritas");
            $tahun = $request->query->get("tahun");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT DISTINCT
                         count(distinct (if((vw_musren_anggaran_kgtn_desa.`jml_swadaya`+ vw_musren_anggaran_kgtn_desa.`jml_apb_desa`) > 0,CONCAT_WS('-',
                            SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 1, 8),
                            SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 9, 4),
                            SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 13, 4),
                            SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 17, 4),
                            SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 21)
                             ),null)))jml_kgtn_swadaya,
                         count(distinct (if((vw_musren_anggaran_kgtn_desa.`jml_apbd_kab`+ vw_musren_anggaran_kgtn_desa.`jml_apbd_prop` + vw_musren_anggaran_kgtn_desa.`jml_apbn`+vw_musren_anggaran_kgtn_desa.`jml_sumber_lain`) > 0,CONCAT_WS('-',
                            SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 1, 8),
                            SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 9, 4),
                            SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 13, 4),
                            SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 17, 4),
                            SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 21)
                             ),null)))jml_kgtn_non_swadaya,
                         sum(vw_musren_anggaran_kgtn_desa.`jml_swadaya`)AS jml_swadaya,
                         sum(vw_musren_anggaran_kgtn_desa.`jml_apb_desa`)AS jml_apb_desa,
                         sum(vw_musren_anggaran_kgtn_desa.`jml_apbd_kab`)AS jml_apbd_kab,
                         sum(vw_musren_anggaran_kgtn_desa.`jml_apbd_prop`)AS jml_apbd_prop,
                         sum(vw_musren_anggaran_kgtn_desa.`jml_apbn`)AS jml_apbn,
                         sum(vw_musren_anggaran_kgtn_desa.`jml_sumber_lain`)AS jml_sumber_lain,
                         count(distinct CONCAT_WS('-',
                            SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 1, 8),
                            SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 9, 4),
                            SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 13, 4),
                            SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 17, 4),
                            SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 21)
                             )) AS jml_kgtn,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 1, 8),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 9, 4),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 13, 4),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 17, 4),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 21)
                         ) AS musren_kgtn_sikd_musren_bidang_id,
                         musren_musrenbang.`tahun` AS musren_musrenbang_tahun,
                         musren_musrenbang.`kd_wilayah` AS musren_musrenbang_kd_wilayah,
                         sikd_musren_bidang.`kd_bidang` AS sikd_musren_bidang_kd_bidang,
                         sikd_musren_bidang.`nm_bidang` AS sikd_musren_bidang_nm_bidang,
                         vw_appl_kode_wilayah.`kode_wilayah` AS vw_appl_kode_wilayah_kode_wilayah,
                         vw_appl_kode_wilayah.`klasifikasi` AS vw_appl_kode_wilayah_klasifikasi,
                         vw_appl_kode_wilayah.`nama_wilayah` AS vw_appl_kode_wilayah_nama_wilayah,
                         vw_appl_kode_wilayah_induk.`kode_wilayah` AS vw_appl_kode_wilayah_induk_kode_wilayah,
                         vw_appl_kode_wilayah_induk.`klasifikasi` AS vw_appl_kode_wilayah_induk_klasifikasi,
                         vw_appl_kode_wilayah_induk.`nama_wilayah` AS vw_appl_kode_wilayah_induk_nama_wilayah
                    FROM
                         `musren_kgtn` musren_kgtn 
                         INNER JOIN `sikd_bidang` sikd_musren_bidang ON musren_kgtn.`sikd_bidang_id` = sikd_musren_bidang.`id_sikd_bidang`
                         INNER JOIN `musren_musrenbang` musren_musrenbang ON musren_kgtn.`musren_musrenbang_id` = musren_musrenbang.`id_musren_musrenbang`
                         INNER JOIN `vw_appl_kode_wilayah` vw_appl_kode_wilayah ON musren_musrenbang.`kd_wilayah` = vw_appl_kode_wilayah.`kode_wilayah`
                         INNER JOIN `vw_appl_kode_wilayah_induk` vw_appl_kode_wilayah_induk ON vw_appl_kode_wilayah.`kode_induk` = vw_appl_kode_wilayah_induk.`kode_wilayah`
                         INNER JOIN `musren_kgtn` musren_kgtn_desa ON musren_kgtn.`id_musren_kgtn` = musren_kgtn_desa.`id_musren_kgtn` AND musren_kgtn_desa.`musren_kgtn_type` = 'MusrenKgtnDesa'
                         LEFT OUTER JOIN `musren_lokasi_kgtn` musren_lokasi_kgtn ON musren_kgtn.`id_musren_kgtn` = musren_lokasi_kgtn.`musren_kgtn_id`
                         LEFT OUTER JOIN `vw_musren_anggaran_kgtn_desa` vw_musren_anggaran_kgtn_desa ON musren_lokasi_kgtn.`id_musren_lokasi_kgtn` = vw_musren_anggaran_kgtn_desa.`musren_lokasi_kgtn_id`
                    WHERE
                         musren_musrenbang.`tahun` = :tahun
                     AND IF(:desa != '', musren_musrenbang.`kd_wilayah` = :desa, 1)
                     AND IF(:prioritas != '', musren_kgtn.`prioritas` = :prioritas, 1)
                    GROUP BY
                         musren_musrenbang.`kd_wilayah`,
                         sikd_musren_bidang.`kd_bidang`
                    ORDER BY
                         musren_musrenbang.`kd_wilayah` ASC,
                         sikd_musren_bidang.`kd_bidang` ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("desa", $desa);
            $statement->bindValue("prioritas", $prioritas);
            $statement->bindValue("tahun", $tahun);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getMusrenDesaListFlowUsulan($request)
    {
        try {
            
            $desa = $request->query->get("desa");
            $prioritas = $request->query->get("prioritas");
            $idBidang = $request->query->get("bidang");
            $quota = $request->query->get("quota");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idBidang = pack('H*', str_replace('-', '', trim($idBidang)));
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                         vw_appl_kode_wilayah_induk.`kode_wilayah` AS vw_appl_kode_wilayah_induk_kode_wilayah,
                         vw_appl_kode_wilayah_induk.`nama_wilayah` AS vw_appl_kode_wilayah_induk_nama_wilayah,
                         vw_appl_kode_wilayah.`kode_wilayah` AS vw_appl_kode_wilayah_kode_wilayah,
                         vw_appl_kode_wilayah.`nama_wilayah` AS vw_appl_kode_wilayah_nama_wilayah,
                         musren_musrenbang.`tahun` AS musren_musrenbang_tahun,
                         sikd_bidang.`kd_bidang` AS sikd_bidang_kd_bidang,
                         sikd_bidang.`nm_bidang` AS sikd_bidang_nm_bidang,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 1, 8),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 9, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 13, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 17, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 21)
                         ) AS musren_kgtn_id_musren_kgtn,
                         musren_kgtn.`kd_kgtn` AS musren_kgtn_kd_kgtn,
                         musren_kgtn.`nm_kgtn` AS musren_kgtn_nm_kgtn,
                         musren_lokasi_kgtn.`nm_lokasi` AS vw_musren_usulan_kgtn_nm_lokasi_kgtn,
                         musren_lokasi_kgtn.`volume` AS vw_musren_usulan_kgtn_volume,
                         musren_lokasi_kgtn.`satuan` AS vw_musren_usulan_kgtn_satuan,
                         musren_kgtn_desa.`no_urut_usulan` AS musren_kgtn_desa_no_urut_usulan,
                         ifnull((select a.singkatan from sikd_satker a, musren_kgtn b
                                 where b.musren_kgtn_type = 'MusrenKgtnKec'
                                 and b.id_musren_kgtn = musren_kgtn_desa.musren_kgtn_kec_id
                                   and b.sikd_skpd_id = a.id_sikd_satker), '-') AS pelaksana,
                         SUM(vw_musren_anggaran_kgtn_desa.jml_apbd_kab+
                             vw_musren_anggaran_kgtn_desa.jml_apbd_prop+
                             vw_musren_anggaran_kgtn_desa.jml_apbn+
                             vw_musren_anggaran_kgtn_desa.jml_sumber_lain) AS vw_musren_usulan_angg_jml_usulan,
                          ifnull((select sum(a.jml_anggaran) 
                                  from musren_lokasi_kgtn a, musren_lokasi_kgtn b
                                  where b.musren_kgtn_id = musren_kgtn_desa.`id_musren_kgtn`
                                    and a.musren_lokasi_kgtn_id = b.`id_musren_lokasi_kgtn`
                                    /*and a.musren_lokasi_kgtn_id = b.id_musren_lokasi_kgtn*/), 0) AS jml_usulan_kec,
                          ifnull((select sum(a.jml_anggaran) 
                                  from musren_lokasi_kgtn a inner join musren_kgtn d on a.musren_kgtn_id = d.id_musren_kgtn and d.musren_kgtn_type = 'MusrenKgtnSkpd', musren_lokasi_kgtn b, musren_lokasi_kgtn c
                                  where c.musren_kgtn_id = musren_kgtn_desa.`id_musren_kgtn`
                                    and b.musren_lokasi_kgtn_id = c.`id_musren_lokasi_kgtn`
                                    and a.musren_lokasi_kgtn_id = b.`id_musren_lokasi_kgtn`
                                    /*and a.musren_skpd_lokasi_kgtn_id = b.id_musren_skpd_lokasi_kgtn*/), 0) AS jml_usulan_skpd,
                          ifnull((select sum(a.jml_anggaran) 
                                  from musren_lokasi_kgtn a, musren_lokasi_kgtn b inner join musren_kgtn e on b.musren_kgtn_id = e.id_musren_kgtn and e.musren_kgtn_type = 'MusrenKgtnSkpd', musren_lokasi_kgtn c, musren_lokasi_kgtn d
                                  where d.musren_kgtn_id = musren_kgtn_desa.`id_musren_kgtn`
                                    and c.musren_lokasi_kgtn_id = d.`id_musren_lokasi_kgtn`
                                    and b.musren_lokasi_kgtn_id = c.`id_musren_lokasi_kgtn`
                                    and a.musren_lokasi_kgtn_id = b.`id_musren_lokasi_kgtn`
                                    /*and a.musren_lokasi_kgtn_id = b.id_musren_lokasi_kgtn*/), 0) AS jml_usulan_kota
                    FROM
                         `musren_kgtn` musren_kgtn_desa 
                         INNER JOIN `musren_kgtn` musren_kgtn ON musren_kgtn_desa.`id_musren_kgtn` = musren_kgtn.`id_musren_kgtn`
                         INNER JOIN `musren_musrenbang` musren_musrenbang ON musren_kgtn.`musren_musrenbang_id` = musren_musrenbang.`id_musren_musrenbang`
                         INNER JOIN `sikd_bidang` sikd_bidang ON musren_kgtn.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                         INNER JOIN `musren_lokasi_kgtn` musren_lokasi_kgtn ON musren_kgtn.`id_musren_kgtn` = musren_lokasi_kgtn.`musren_kgtn_id`
                         INNER JOIN `vw_musren_anggaran_kgtn_desa` vw_musren_anggaran_kgtn_desa ON musren_lokasi_kgtn.`id_musren_lokasi_kgtn` = vw_musren_anggaran_kgtn_desa.`musren_lokasi_kgtn_id`
                         INNER JOIN `musren_musrenbang` musren_musrenbang_desa ON musren_musrenbang.`id_musren_musrenbang` = musren_musrenbang_desa.`id_musren_musrenbang` AND musren_musrenbang_desa.`musren_musrenbang_type` = 'MusrenMusrenbangDesa'
                         INNER JOIN `vw_appl_kode_wilayah` vw_appl_kode_wilayah ON musren_musrenbang.`kd_wilayah` = vw_appl_kode_wilayah.`kode_wilayah`
                         INNER JOIN `vw_appl_kode_wilayah_induk` vw_appl_kode_wilayah_induk ON vw_appl_kode_wilayah.`kode_induk` = vw_appl_kode_wilayah_induk.`kode_wilayah`
                         INNER JOIN `musren_jns_kgtn` musren_jns_kgtn ON musren_kgtn_desa.`musren_jns_kgtn_id` = musren_jns_kgtn.`id_musren_jns_kgtn`
                    WHERE
                        musren_kgtn_desa.`musren_kgtn_type` = 'MusrenKgtnDesa'
                     AND musren_kgtn_desa.`status_verifikasi` = '1'
                     AND IF(:desa != '', vw_appl_kode_wilayah.`kode_wilayah` = :desa, 1)
                     AND IF(:bidang != '', musren_kgtn.`sikd_bidang_id` = :bidang, 1)
                     AND IF(:prioritas != '', musren_kgtn.`prioritas` = :prioritas, 1)
                     AND IF(:quota != '', musren_jns_kgtn.`no_jns_kgtn` = :quota, 1)
                    GROUP BY
                         sikd_bidang.`kd_bidang`,
                         musren_kgtn_desa.`no_urut_usulan`
                    ORDER BY
                         sikd_bidang.`kd_bidang` ASC,
                         musren_kgtn_desa.`no_urut_usulan` ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("desa", $desa);
            $statement->bindValue("bidang", $idBidang);
            $statement->bindValue("prioritas", $prioritas);
            $statement->bindValue("quota", $quota);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getMusrenDesaListFlowUsulanSub($request)
    {
        try {
            
            $idMusrenKgtn = $request->query->get("id_musren_kgtn");
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idMusrenKgtn = pack('H*', str_replace('-', '', trim($idMusrenKgtn)));
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_lokasi_kgtn.`musren_kgtn_id`), 1, 8),
                        SUBSTR(HEX(musren_lokasi_kgtn.`musren_kgtn_id`), 9, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.`musren_kgtn_id`), 13, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.`musren_kgtn_id`), 17, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.`musren_kgtn_id`), 21)
                         ) AS musren_lokasi_kgtn_musren_kgtn_id,
                         musren_lokasi_kgtn.`nm_lokasi` AS musren_lokasi_kgtn_nm_lokasi_kgtn,
                         if(musren_lokasi_kgtn.`rt` not in (0,''), musren_lokasi_kgtn.`rt`, '-') AS musren_lokasi_kgtn_rt,
                         if(musren_lokasi_kgtn.`rw` not in (0,''), musren_lokasi_kgtn.`rw`, '-') AS musren_lokasi_kgtn_rw,
                         musren_lokasi_kgtn.`volume` AS musren_lokasi_kgtn_volume,
                         ifnull(musren_lokasi_kgtn.`satuan`,'-') AS musren_lokasi_kgtn_satuan,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 1, 8),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 9, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 13, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 17, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 21)
                         ) AS musren_kgtn_id_musren_kgtn,
                         (vw_musren_anggaran_kgtn_desa.`jml_apbd_kab`+
                          vw_musren_anggaran_kgtn_desa.`jml_apbd_prop`+
                          vw_musren_anggaran_kgtn_desa.`jml_apbn`+
                          vw_musren_anggaran_kgtn_desa.`jml_sumber_lain`) AS jml_usulan_desa,
                          ifnull((select sum(a.jml_anggaran) from musren_lokasi_kgtn a
                                  where a.musren_lokasi_kgtn_id = musren_lokasi_kgtn.`id_musren_lokasi_kgtn`
                                    /*and a.musren_lokasi_kgtn_id = b.id_musren_lokasi_kgtn*/), 0) AS jml_usulan_kec,
                          ifnull((select sum(a.jml_anggaran) from musren_lokasi_kgtn a inner join musren_kgtn c on a.musren_kgtn_id = c.id_musren_kgtn and c.musren_kgtn_type = 'MusrenKgtnSkpd', musren_lokasi_kgtn b
                                  where b.musren_lokasi_kgtn_id = musren_lokasi_kgtn.`id_musren_lokasi_kgtn`
                                    and a.musren_lokasi_kgtn_id = b.`id_musren_lokasi_kgtn`
                                    /*and a.musren_skpd_lokasi_kgtn_id = b.id_musren_skpd_lokasi_kgtn*/), 0) AS jml_usulan_skpd,
                          ifnull((select sum(a.jml_anggaran) from musren_lokasi_kgtn a, musren_lokasi_kgtn b inner join musren_kgtn d on b.musren_kgtn_id = d.id_musren_kgtn and d.musren_kgtn_type = 'MusrenKgtnSkpd', musren_lokasi_kgtn c
                                  where c.musren_lokasi_kgtn_id = musren_lokasi_kgtn.`id_musren_lokasi_kgtn`
                                    and b.musren_lokasi_kgtn_id = c.`id_musren_lokasi_kgtn`
                                    and a.musren_lokasi_kgtn_id = b.`id_musren_lokasi_kgtn`
                                    /*and a.musren_lokasi_kgtn_id = b.id_musren_lokasi_kgtn*/), 0) AS jml_usulan_kota
                    FROM
                         `vw_musren_anggaran_kgtn_desa` vw_musren_anggaran_kgtn_desa RIGHT OUTER JOIN `musren_lokasi_kgtn` musren_lokasi_kgtn ON vw_musren_anggaran_kgtn_desa.`musren_lokasi_kgtn_id` = musren_lokasi_kgtn.`id_musren_lokasi_kgtn`
                         RIGHT OUTER JOIN `musren_kgtn` musren_kgtn ON musren_lokasi_kgtn.`musren_kgtn_id` = musren_kgtn.`id_musren_kgtn`
                    WHERE
                         musren_kgtn.id_musren_kgtn = :id_musren_kgtn

                    ORDER BY
                         musren_lokasi_kgtn.`id_musren_lokasi_kgtn`";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_musren_kgtn", $idMusrenKgtn);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getMusrenDesaListKgtnKecStj($request)
    {
        try {
            
            $kec = $request->query->get("kec");
            $desa = $request->query->get("desa");
            $idBidang = $request->query->get("bidang");
            $prioritas = $request->query->get("prioritas");
            $quota = $request->query->get("quota");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idBidang = pack('H*', str_replace('-', '', trim($idBidang)));
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
                         sikd_satker.`singkatan` AS sikd_satker_singkatan,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 1, 8),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 9, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 13, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 17, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 21)
                         ) AS musren_kgtn_id_musren_kgtn,
                        CONCAT_WS('-',
                        SUBSTR(HEX(sikd_musren_bidang.`sikd_musren_bidang_id`), 1, 8),
                        SUBSTR(HEX(sikd_musren_bidang.`sikd_musren_bidang_id`), 9, 4),
                        SUBSTR(HEX(sikd_musren_bidang.`sikd_musren_bidang_id`), 13, 4),
                        SUBSTR(HEX(sikd_musren_bidang.`sikd_musren_bidang_id`), 17, 4),
                        SUBSTR(HEX(sikd_musren_bidang.`sikd_musren_bidang_id`), 21)
                         ) AS musren_kgtn_sikd_musren_bidang_id,
                         sikd_musren_bidang.`kd_bidang` AS sikd_musren_bidang_kd_bidang,
                         sikd_musren_bidang.`nm_bidang` AS sikd_musren_bidang_nm_bidang,
                         musren_kgtn.`nm_kgtn` AS musren_kgtn_nm_kgtn,
                         musren_kgtn.`nm_subkgtn` AS musren_kgtn_nm_subkgtn,
                         musren_kgtn.`prioritas` AS musren_kgtn_prioritas,
                         musren_kgtn.`sifat_kgtn` AS musren_kgtn_sifat_kgtn,
                         musren_kgtn.`output` AS musren_kgtn_output,
                         musren_kgtn.`outcome` AS musren_kgtn_outcome,
                         musren_kgtn_desa.`no_urut_usulan` AS musren_kgtn_desa_no_urut_usulan,
                         ifnull((select sum(a.jml_anggaran) 
                                 from /*musren_anggaran_kgtn a,*/ musren_lokasi_kgtn a, musren_lokasi_kgtn b
                                 where b.musren_kgtn_id = musren_kgtn_desa.`id_musren_kgtn`
                                   -- and b.musren_lokasi_kgtn_id_ref = c.id_musren_lokasi_kgtn*/
                                   and a.musren_lokasi_kgtn_id = b.id_musren_lokasi_kgtn
                                   /*and a.musren_lokasi_kgtn_id = b.id_musren_lokasi_kgtn*/),0) AS musren_kgtn_anggaran_disetujui,
                         musren_lokasi_kgtn.`nm_lokasi` AS musren_lokasi_kgtn_nm_lokasi_kgtn,
                         musren_lokasi_kgtn.`volume` AS musren_lokasi_kgtn_volume,
                         musren_lokasi_kgtn.`satuan` AS musren_lokasi_kgtn_satuan,
                         SUM(IF(musren_kgtn_desa.musren_kgtn_kec_id = '', 0,
                                vw_musren_anggaran_kgtn_desa.jml_apbd_kab+
                                vw_musren_anggaran_kgtn_desa.jml_apbd_prop+
                                vw_musren_anggaran_kgtn_desa.jml_apbn+
                                vw_musren_anggaran_kgtn_desa.jml_sumber_lain)) AS vw_musren_anggaran_kgtn_desa_jml_usulan,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 1, 8),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 9, 4),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 13, 4),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 17, 4),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 21)
                         ) AS musren_musrenbang_id_musren_musrenbang,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_musrenbang_desa.`id_musren_musrenbang`), 1, 8),
                        SUBSTR(HEX(musren_musrenbang_desa.`id_musren_musrenbang`), 9, 4),
                        SUBSTR(HEX(musren_musrenbang_desa.`id_musren_musrenbang`), 13, 4),
                        SUBSTR(HEX(musren_musrenbang_desa.`id_musren_musrenbang`), 17, 4),
                        SUBSTR(HEX(musren_musrenbang_desa.`id_musren_musrenbang`), 21)
                         ) AS musren_musrenbang_desa_id_musren_musdesa,
                         musren_musrenbang.`tahun` AS musren_musrenbang_tahun,
                         vw_appl_kode_wilayah.`kode_wilayah` AS vw_appl_kode_wilayah_kode_wilayah,
                         vw_appl_kode_wilayah.`klasifikasi` AS vw_appl_kode_wilayah_klasifikasi,
                         vw_appl_kode_wilayah.`nama_wilayah` AS vw_appl_kode_wilayah_nama_wilayah,
                         vw_appl_kode_wilayah_induk.`kode_wilayah` AS vw_appl_kode_wilayah_induk_kode_wilayah,
                         vw_appl_kode_wilayah_induk.`nama_wilayah` AS vw_appl_kode_wilayah_induk_nama_wilayah
                    FROM
                         `musren_kgtn` musren_kgtn_desa 
                         INNER JOIN `musren_kgtn` musren_kgtn_kec ON musren_kgtn_desa.`id_musren_kgtn` = musren_kgtn_kec.`musren_kgtn_desa_id` AND musren_kgtn_kec.`musren_kgtn_type` = 'MusrenKgtnKec'
                         INNER JOIN `sikd_satker` sikd_satker ON musren_kgtn_kec.`sikd_skpd_id` = sikd_satker.`id_sikd_satker`
                         INNER JOIN `musren_kgtn` musren_kgtn ON musren_kgtn_desa.`id_musren_kgtn` = musren_kgtn.`id_musren_kgtn`
                         INNER JOIN `musren_musrenbang` musren_musrenbang ON musren_kgtn.`musren_musrenbang_id` = musren_musrenbang.`id_musren_musrenbang`
                         INNER JOIN `sikd_bidang` sikd_musren_bidang ON musren_kgtn.`sikd_bidang_id` = sikd_musren_bidang.`id_sikd_bidang`
                         INNER JOIN `musren_lokasi_kgtn` musren_lokasi_kgtn ON musren_kgtn.`id_musren_kgtn` = musren_lokasi_kgtn.`musren_kgtn_id`
                         INNER JOIN `vw_musren_anggaran_kgtn_desa` vw_musren_anggaran_kgtn_desa ON musren_lokasi_kgtn.`id_musren_lokasi_kgtn` = vw_musren_anggaran_kgtn_desa.`musren_lokasi_kgtn_id`
                         INNER JOIN `musren_musrenbang` musren_musrenbang_desa ON musren_musrenbang.`id_musren_musrenbang` = musren_musrenbang_desa.`id_musren_musrenbang` AND musren_musrenbang_desa.`musren_musrenbang_type` = 'MusrenMusrenbangDesa'
                         INNER JOIN `vw_appl_kode_wilayah` vw_appl_kode_wilayah ON musren_musrenbang.`kd_wilayah` = vw_appl_kode_wilayah.`kode_wilayah`
                         INNER JOIN `vw_appl_kode_wilayah_induk` vw_appl_kode_wilayah_induk ON vw_appl_kode_wilayah.`kode_induk` = vw_appl_kode_wilayah_induk.`kode_wilayah`
                         INNER JOIN `musren_jns_kgtn` musren_jns_kgtn ON musren_kgtn_desa.`musren_jns_kgtn_id` = musren_jns_kgtn.`id_musren_jns_kgtn`
                    WHERE
                        musren_kgtn_desa.`musren_kgtn_type` = 'MusrenKgtnDesa'
                     AND musren_kgtn_desa.`status_verifikasi` = '1'
                     AND vw_appl_kode_wilayah_induk.`kode_wilayah` = :kec
                     AND IF(:desa != '', musren_musrenbang.`kd_wilayah` = :desa, musren_musrenbang.`kd_wilayah` LIKE '%')
                     AND IF(:bidang != '', sikd_musren_bidang.`id_sikd_bidang` = :bidang,  sikd_musren_bidang.`id_sikd_bidang` LIKE '%')
                     AND IF(:prioritas != '', musren_kgtn.`prioritas` = :prioritas, 1)
                     AND IF(:quota != '', musren_jns_kgtn.`no_jns_kgtn` = :quota, 1)
                    GROUP BY
                         vw_appl_kode_wilayah_induk.`kode_wilayah`,
                         vw_appl_kode_wilayah.`kode_wilayah`,
                         sikd_musren_bidang.kd_bidang,
                         musren_kgtn_desa.`no_urut_usulan`
                    HAVING (musren_kgtn_anggaran_disetujui > 0)
                    ORDER BY
                         vw_appl_kode_wilayah_induk.`kode_wilayah` ASC,
                         vw_appl_kode_wilayah.`kode_wilayah` ASC,
                         sikd_musren_bidang.kd_bidang ASC,
                         sikd_satker.`kode` ASC,
                         musren_kgtn_desa.`no_urut_usulan` ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("kec", $kec);
            $statement->bindValue("desa", $desa);
            $statement->bindValue("bidang", $idBidang);
            $statement->bindValue("prioritas", $prioritas);
            $statement->bindValue("quota", $quota);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getMusrenDesaListKgtnKecStjSub($request)
    {
        try {
            
            $idMusrenKgtn = $request->query->get("id_musren_kgtn");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idMusrenKgtn = pack('H*', str_replace('-', '', trim($idMusrenKgtn)));
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_lokasi_kgtn.`musren_kgtn_id`), 1, 8),
                        SUBSTR(HEX(musren_lokasi_kgtn.`musren_kgtn_id`), 9, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.`musren_kgtn_id`), 13, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.`musren_kgtn_id`), 17, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.`musren_kgtn_id`), 21)
                         ) AS musren_lokasi_kgtn_musren_kgtn_id,
                         musren_lokasi_kgtn.`nm_lokasi` AS musren_lokasi_kgtn_nm_lokasi_kgtn,
                         if(musren_lokasi_kgtn.`rt` not in (0,''), musren_lokasi_kgtn.`rt`, '-') AS musren_lokasi_kgtn_rt,
                         if(musren_lokasi_kgtn.`rw` not in (0,''), musren_lokasi_kgtn.`rw`, '-') AS musren_lokasi_kgtn_rw,
                         musren_lokasi_kgtn.`volume` AS musren_lokasi_kgtn_volume,
                         musren_lokasi_kgtn.`satuan` AS musren_lokasi_kgtn_satuan,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 1, 8),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 9, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 13, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 17, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 21)
                         ) AS musren_kgtn_id_musren_kgtn,
                         (vw_musren_anggaran_kgtn_desa.jml_apbd_kab+
                          vw_musren_anggaran_kgtn_desa.jml_apbd_prop+
                          vw_musren_anggaran_kgtn_desa.jml_apbn+
                          vw_musren_anggaran_kgtn_desa.jml_sumber_lain) AS vw_musren_anggaran_kgtn_desa_jml_usulan,
                          ifnull((select sum(a.jml_anggaran) from musren_lokasi_kgtn a
                                  where a.musren_lokasi_kgtn_id = musren_lokasi_kgtn.`id_musren_lokasi_kgtn`
                                    /*and a.musren_lokasi_kgtn_id = b.id_musren_lokasi_kgtn*/), 0) AS jml_usulan_kec
                    FROM
                         `musren_lokasi_kgtn` musren_lokasi_kgtn INNER JOIN `musren_kgtn` musren_kgtn ON musren_lokasi_kgtn.`musren_kgtn_id` = musren_kgtn.`id_musren_kgtn`
                         INNER JOIN `vw_musren_anggaran_kgtn_desa` vw_musren_anggaran_kgtn_desa ON musren_lokasi_kgtn.`id_musren_lokasi_kgtn` = vw_musren_anggaran_kgtn_desa.`musren_lokasi_kgtn_id`
                    WHERE
                         musren_kgtn.id_musren_kgtn = :id_musren_kgtn

                    ORDER BY
                         musren_lokasi_kgtn.`id_musren_lokasi_kgtn` ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_musren_kgtn", $idMusrenKgtn);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getMusrenDesaListKgtnSkpdStj($request)
    {
        try {
            
            $kec = $request->query->get("kec");
            $desa = $request->query->get("desa");
            $idBidang = $request->query->get("bidang");
            $prioritas = $request->query->get("prioritas");
            $quota = $request->query->get("quota");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idBidang = pack('H*', str_replace('-', '', trim($idBidang)));
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
                         sikd_satker.`singkatan` AS sikd_satker_singkatan,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 1, 8),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 9, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 13, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 17, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 21)
                         ) AS musren_kgtn_id_musren_kgtn,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 1, 8),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 9, 4),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 13, 4),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 17, 4),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 21)
                         ) AS musren_kgtn_sikd_musren_bidang_id,
                         sikd_musren_bidang.`kd_bidang` AS sikd_musren_bidang_kd_bidang,
                         sikd_musren_bidang.`nm_bidang` AS sikd_musren_bidang_nm_bidang,
                         musren_kgtn.`nm_kgtn` AS musren_kgtn_nm_kgtn,
                         musren_kgtn.`nm_subkgtn` AS musren_kgtn_nm_subkgtn,
                         musren_kgtn.`prioritas` AS musren_kgtn_prioritas,
                         musren_kgtn.`sifat_kgtn` AS musren_kgtn_sifat_kgtn,
                         musren_kgtn.`output` AS musren_kgtn_output,
                         musren_kgtn.`outcome` AS musren_kgtn_outcome,
                         musren_kgtn_desa.`no_urut_usulan` AS musren_kgtn_desa_no_urut_usulan,
                         ifnull((select sum(a.jml_anggaran) 
                                 from musren_lokasi_kgtn a inner join musren_kgtn d on a.musren_kgtn_id = d.id_musren_kgtn and d.musren_kgtn_type = 'MusrenKgtnSkpd', musren_lokasi_kgtn b, musren_lokasi_kgtn c
                                 where c.musren_kgtn_id = musren_kgtn_desa.`id_musren_kgtn`
                                   and b.musren_lokasi_kgtn_id = c.`id_musren_lokasi_kgtn`
                                   and a.musren_lokasi_kgtn_id = b.`id_musren_lokasi_kgtn`
                                   /*and a.musren_skpd_lokasi_kgtn_id = b.id_musren_skpd_lokasi_kgtn*/),0) AS musren_kgtn_anggaran_disetujui,
                         musren_lokasi_kgtn.`nm_lokasi` AS musren_lokasi_kgtn_nm_lokasi_kgtn,
                         musren_lokasi_kgtn.`volume` AS musren_lokasi_kgtn_volume,
                         musren_lokasi_kgtn.`satuan` AS musren_lokasi_kgtn_satuan,
                         SUM(IF(musren_kgtn_desa.musren_kgtn_kec_id = '', 0,
                                vw_musren_anggaran_kgtn_desa.jml_apbd_kab+
                                vw_musren_anggaran_kgtn_desa.jml_apbd_prop+
                                vw_musren_anggaran_kgtn_desa.jml_apbn+
                                vw_musren_anggaran_kgtn_desa.jml_sumber_lain)) AS vw_musren_anggaran_kgtn_desa_jml_usulan,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 1, 8),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 9, 4),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 13, 4),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 17, 4),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 21)
                         ) AS musren_musrenbang_id_musren_musrenbang,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_musrenbang_desa.`id_musren_musrenbang`), 1, 8),
                        SUBSTR(HEX(musren_musrenbang_desa.`id_musren_musrenbang`), 9, 4),
                        SUBSTR(HEX(musren_musrenbang_desa.`id_musren_musrenbang`), 13, 4),
                        SUBSTR(HEX(musren_musrenbang_desa.`id_musren_musrenbang`), 17, 4),
                        SUBSTR(HEX(musren_musrenbang_desa.`id_musren_musrenbang`), 21)
                         ) AS musren_musrenbang_desa_id_musren_musdesa,
                         musren_musrenbang.`tahun` AS musren_musrenbang_tahun,
                         vw_appl_kode_wilayah.`kode_wilayah` AS vw_appl_kode_wilayah_kode_wilayah,
                         vw_appl_kode_wilayah.`klasifikasi` AS vw_appl_kode_wilayah_klasifikasi,
                         vw_appl_kode_wilayah.`nama_wilayah` AS vw_appl_kode_wilayah_nama_wilayah,
                         vw_appl_kode_wilayah_induk.`kode_wilayah` AS vw_appl_kode_wilayah_induk_kode_wilayah,
                         vw_appl_kode_wilayah_induk.`nama_wilayah` AS vw_appl_kode_wilayah_induk_nama_wilayah
                    FROM
                         `musren_kgtn` musren_kgtn_desa 
                         INNER JOIN `musren_kgtn` musren_kgtn_kec ON musren_kgtn_desa.`id_musren_kgtn` = musren_kgtn_kec.`musren_kgtn_desa_id` AND musren_kgtn_kec.`musren_kgtn_type` = 'MusrenKgtnKec'
                         INNER JOIN `sikd_satker` sikd_satker ON musren_kgtn_kec.`sikd_skpd_id` = sikd_satker.`id_sikd_satker`
                         INNER JOIN `musren_kgtn` musren_kgtn ON musren_kgtn_desa.`id_musren_kgtn` = musren_kgtn.`id_musren_kgtn`
                         INNER JOIN `musren_musrenbang` musren_musrenbang ON musren_kgtn.`musren_musrenbang_id` = musren_musrenbang.`id_musren_musrenbang`
                         INNER JOIN `sikd_bidang` sikd_musren_bidang ON musren_kgtn.`sikd_bidang_id` = sikd_musren_bidang.`id_sikd_bidang`
                         INNER JOIN `musren_lokasi_kgtn` musren_lokasi_kgtn ON musren_kgtn.`id_musren_kgtn` = musren_lokasi_kgtn.`musren_kgtn_id`
                         INNER JOIN `vw_musren_anggaran_kgtn_desa` vw_musren_anggaran_kgtn_desa ON musren_lokasi_kgtn.`id_musren_lokasi_kgtn` = vw_musren_anggaran_kgtn_desa.`musren_lokasi_kgtn_id`
                         INNER JOIN `musren_musrenbang` musren_musrenbang_desa ON musren_musrenbang.`id_musren_musrenbang` = musren_musrenbang_desa.`id_musren_musrenbang` AND musren_musrenbang_desa.`musren_musrenbang_type` = 'MusrenMusrenbangDesa'
                         INNER JOIN `vw_appl_kode_wilayah` vw_appl_kode_wilayah ON musren_musrenbang.`kd_wilayah` = vw_appl_kode_wilayah.`kode_wilayah`
                         INNER JOIN `vw_appl_kode_wilayah_induk` vw_appl_kode_wilayah_induk ON vw_appl_kode_wilayah.`kode_induk` = vw_appl_kode_wilayah_induk.`kode_wilayah`
                         INNER JOIN `musren_jns_kgtn` musren_jns_kgtn ON musren_kgtn_desa.`musren_jns_kgtn_id` = musren_jns_kgtn.`id_musren_jns_kgtn` 
                    WHERE
                        musren_kgtn_desa.`musren_kgtn_type` = 'MusrenKgtnDesa'
                     AND musren_kgtn_desa.`status_verifikasi` = '1'
                     AND vw_appl_kode_wilayah_induk.`kode_wilayah` = :kec
                     AND IF(:desa != '', musren_musrenbang.`kd_wilayah` = :desa, musren_musrenbang.`kd_wilayah` LIKE '%')
                     AND IF(:bidang != '', sikd_musren_bidang.`id_sikd_bidang` = :bidang,  sikd_musren_bidang.`id_sikd_bidang` LIKE '%')
                     AND IF(:prioritas != '', musren_kgtn.`prioritas` = :prioritas, 1)
                     AND IF(:quota != '', musren_jns_kgtn.`no_jns_kgtn` = :quota, 1)
                    GROUP BY
                         vw_appl_kode_wilayah_induk.`kode_wilayah`,
                         vw_appl_kode_wilayah.`kode_wilayah`,
                         sikd_musren_bidang.kd_bidang,
                         musren_kgtn_desa.`no_urut_usulan`
                    HAVING (musren_kgtn_anggaran_disetujui > 0)
                    ORDER BY
                         vw_appl_kode_wilayah_induk.`kode_wilayah` ASC,
                         vw_appl_kode_wilayah.`kode_wilayah` ASC,
                         sikd_musren_bidang.kd_bidang ASC,
                         sikd_satker.`kode` ASC,
                         musren_kgtn_desa.`no_urut_usulan` ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("kec", $kec);
            $statement->bindValue("desa", $desa);
            $statement->bindValue("bidang", $idBidang);
            $statement->bindValue("prioritas", $prioritas);
            $statement->bindValue("quota", $quota);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getMusrenDesaListKgtnSkpdStjSub($request)
    {
        try {
            
            $idMusrenKgtn = $request->query->get("id_musren_kgtn");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idMusrenKgtn = pack('H*', str_replace('-', '', trim($idMusrenKgtn)));
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                         CONCAT_WS('-',
                        SUBSTR(HEX(musren_lokasi_kgtn.`musren_kgtn_id`), 1, 8),
                        SUBSTR(HEX(musren_lokasi_kgtn.`musren_kgtn_id`), 9, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.`musren_kgtn_id`), 13, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.`musren_kgtn_id`), 17, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.`musren_kgtn_id`), 21)
                         ) AS musren_lokasi_kgtn_musren_kgtn_id,
                         musren_lokasi_kgtn.`nm_lokasi` AS musren_lokasi_kgtn_nm_lokasi_kgtn,
                         if(musren_lokasi_kgtn.`rt` not in (0,''), musren_lokasi_kgtn.`rt`, '-') AS musren_lokasi_kgtn_rt,
                         if(musren_lokasi_kgtn.`rw` not in (0,''), musren_lokasi_kgtn.`rw`, '-') AS musren_lokasi_kgtn_rw,
                         musren_lokasi_kgtn.`volume` AS musren_lokasi_kgtn_volume,
                         musren_lokasi_kgtn.`satuan` AS musren_lokasi_kgtn_satuan,
                         CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 1, 8),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 9, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 13, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 17, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 21)
                         ) AS musren_kgtn_id_musren_kgtn,
                         (vw_musren_anggaran_kgtn_desa.jml_apbd_kab+
                          vw_musren_anggaran_kgtn_desa.jml_apbd_prop+
                          vw_musren_anggaran_kgtn_desa.jml_apbn+
                          vw_musren_anggaran_kgtn_desa.jml_sumber_lain) AS vw_musren_anggaran_kgtn_desa_jml_usulan,
                          ifnull((select sum(a.jml_anggaran) 
                                  from musren_lokasi_kgtn a inner join musren_kgtn c on a.musren_kgtn_id = c.id_musren_kgtn and c.musren_kgtn_type = 'MusrenKgtnSkpd', musren_lokasi_kgtn b
                                  where b.musren_lokasi_kgtn_id = musren_lokasi_kgtn.`id_musren_lokasi_kgtn`
                                    and a.musren_lokasi_kgtn_id = b.`id_musren_lokasi_kgtn`
                                    ), 0) AS jml_usulan_kec
                    FROM
                         `musren_lokasi_kgtn` musren_lokasi_kgtn
                         INNER JOIN `musren_kgtn` musren_kgtn ON musren_lokasi_kgtn.`musren_kgtn_id` = musren_kgtn.`id_musren_kgtn`
                         INNER JOIN `vw_musren_anggaran_kgtn_desa` vw_musren_anggaran_kgtn_desa ON musren_lokasi_kgtn.`id_musren_lokasi_kgtn` = vw_musren_anggaran_kgtn_desa.`musren_lokasi_kgtn_id`
                    WHERE
                         musren_kgtn.id_musren_kgtn = :id_musren_kgtn

                    ORDER BY
                         musren_lokasi_kgtn.`id_musren_lokasi_kgtn` ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_musren_kgtn", $idMusrenKgtn);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getMusrenDesaListKgtnKotaStj($request)
    {
        try {
            
            $kec = $request->query->get("kec");
            $desa = $request->query->get("desa");
            $idBidang = $request->query->get("bidang");
            $prioritas = $request->query->get("prioritas");
            $quota = $request->query->get("quota");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idBidang = pack('H*', str_replace('-', '', trim($idBidang)));
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
                         sikd_satker.`singkatan` AS sikd_satker_singkatan,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 1, 8),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 9, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 13, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 17, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 21)
                         ) AS musren_kgtn_id_musren_kgtn,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 1, 8),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 9, 4),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 13, 4),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 17, 4),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 21)
                         ) AS musren_kgtn_sikd_musren_bidang_id,
                         sikd_musren_bidang.`kd_bidang` AS sikd_musren_bidang_kd_bidang,
                         sikd_musren_bidang.`nm_bidang` AS sikd_musren_bidang_nm_bidang,
                         musren_kgtn.`nm_kgtn` AS musren_kgtn_nm_kgtn,
                         musren_kgtn.`nm_subkgtn` AS musren_kgtn_nm_subkgtn,
                         musren_kgtn.`prioritas` AS musren_kgtn_prioritas,
                         musren_kgtn.`sifat_kgtn` AS musren_kgtn_sifat_kgtn,
                         musren_kgtn.`output` AS musren_kgtn_output,
                         musren_kgtn.`outcome` AS musren_kgtn_outcome,
                         musren_kgtn_desa.`no_urut_usulan` AS musren_kgtn_desa_no_urut_usulan,
                         ifnull((select sum(a.jml_anggaran) 
                                 from musren_lokasi_kgtn a, musren_lokasi_kgtn b inner join musren_kgtn e on b.musren_kgtn_id = e.id_musren_kgtn and e.musren_kgtn_type = 'MusrenKgtnSkpd', musren_lokasi_kgtn c, musren_lokasi_kgtn d
                                 where d.musren_kgtn_id = musren_kgtn_desa.`id_musren_kgtn`
                                   and c.musren_lokasi_kgtn_id = d.`id_musren_lokasi_kgtn`
                                   and b.musren_lokasi_kgtn_id = c.`id_musren_lokasi_kgtn`
                                   and a.musren_lokasi_kgtn_id = b.`id_musren_lokasi_kgtn`
                                   /*and a.musren_lokasi_kgtn_id = b.id_musren_lokasi_kgtn*/),0) AS musren_kgtn_anggaran_disetujui,
                         musren_lokasi_kgtn.`nm_lokasi` AS musren_lokasi_kgtn_nm_lokasi_kgtn,
                         musren_lokasi_kgtn.`volume` AS musren_lokasi_kgtn_volume,
                         musren_lokasi_kgtn.`satuan` AS musren_lokasi_kgtn_satuan,
                         SUM(IF(musren_kgtn_desa.musren_kgtn_kec_id = '', 0,
                                vw_musren_anggaran_kgtn_desa.jml_apbd_kab+
                                vw_musren_anggaran_kgtn_desa.jml_apbd_prop+
                                vw_musren_anggaran_kgtn_desa.jml_apbn+
                                vw_musren_anggaran_kgtn_desa.jml_sumber_lain)) AS vw_musren_anggaran_kgtn_desa_jml_usulan,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 1, 8),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 9, 4),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 13, 4),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 17, 4),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 21)
                         ) AS musren_musrenbang_id_musren_musrenbang,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_musrenbang_desa.`id_musren_musrenbang`), 1, 8),
                        SUBSTR(HEX(musren_musrenbang_desa.`id_musren_musrenbang`), 9, 4),
                        SUBSTR(HEX(musren_musrenbang_desa.`id_musren_musrenbang`), 13, 4),
                        SUBSTR(HEX(musren_musrenbang_desa.`id_musren_musrenbang`), 17, 4),
                        SUBSTR(HEX(musren_musrenbang_desa.`id_musren_musrenbang`), 21)
                         ) AS musren_musrenbang_desa_id_musren_musdesa,
                         musren_musrenbang.`tahun` AS musren_musrenbang_tahun,
                         vw_appl_kode_wilayah.`kode_wilayah` AS vw_appl_kode_wilayah_kode_wilayah,
                         vw_appl_kode_wilayah.`klasifikasi` AS vw_appl_kode_wilayah_klasifikasi,
                         vw_appl_kode_wilayah.`nama_wilayah` AS vw_appl_kode_wilayah_nama_wilayah,
                         vw_appl_kode_wilayah_induk.`kode_wilayah` AS vw_appl_kode_wilayah_induk_kode_wilayah,
                         vw_appl_kode_wilayah_induk.`nama_wilayah` AS vw_appl_kode_wilayah_induk_nama_wilayah
                    FROM
                         `musren_kgtn` musren_kgtn_desa 
                         INNER JOIN `musren_kgtn` musren_kgtn_kec ON musren_kgtn_desa.`id_musren_kgtn` = musren_kgtn_kec.`musren_kgtn_desa_id` AND musren_kgtn_kec.`musren_kgtn_type` = 'MusrenKgtnKec'
                         INNER JOIN `sikd_satker` sikd_satker ON musren_kgtn_kec.`sikd_skpd_id` = sikd_satker.`id_sikd_satker`
                         INNER JOIN `musren_kgtn` musren_kgtn ON musren_kgtn_desa.`id_musren_kgtn` = musren_kgtn.`id_musren_kgtn`
                         INNER JOIN `musren_musrenbang` musren_musrenbang ON musren_kgtn.`musren_musrenbang_id` = musren_musrenbang.`id_musren_musrenbang`
                         INNER JOIN `sikd_bidang` sikd_musren_bidang ON musren_kgtn.`sikd_bidang_id` = sikd_musren_bidang.`id_sikd_bidang`
                         INNER JOIN `musren_lokasi_kgtn` musren_lokasi_kgtn ON musren_kgtn.`id_musren_kgtn` = musren_lokasi_kgtn.`musren_kgtn_id`
                         INNER JOIN `vw_musren_anggaran_kgtn_desa` vw_musren_anggaran_kgtn_desa ON musren_lokasi_kgtn.`id_musren_lokasi_kgtn` = vw_musren_anggaran_kgtn_desa.`musren_lokasi_kgtn_id`
                         INNER JOIN `musren_musrenbang` musren_musrenbang_desa ON musren_musrenbang.`id_musren_musrenbang` = musren_musrenbang_desa.`id_musren_musrenbang` AND musren_musrenbang_desa.`musren_musrenbang_type` = 'MusrenMusrenbangDesa'
                         INNER JOIN `vw_appl_kode_wilayah` vw_appl_kode_wilayah ON musren_musrenbang.`kd_wilayah` = vw_appl_kode_wilayah.`kode_wilayah`
                         INNER JOIN `vw_appl_kode_wilayah_induk` vw_appl_kode_wilayah_induk ON vw_appl_kode_wilayah.`kode_induk` = vw_appl_kode_wilayah_induk.`kode_wilayah`
                         INNER JOIN `musren_jns_kgtn` musren_jns_kgtn ON musren_kgtn_desa.`musren_jns_kgtn_id` = musren_jns_kgtn.`id_musren_jns_kgtn`
                    WHERE
                        musren_kgtn_desa.`musren_kgtn_type` = 'MusrenKgtnDesa'
                     AND vw_appl_kode_wilayah_induk.`kode_wilayah` = :kec
                     AND IF(:desa != '', musren_musrenbang.`kd_wilayah` = :desa, musren_musrenbang.`kd_wilayah` LIKE '%')
                     AND IF(:bidang != '', sikd_musren_bidang.`id_sikd_bidang` = :bidang,  sikd_musren_bidang.`id_sikd_bidang` LIKE '%')
                     AND IF(:prioritas != '', musren_kgtn.`prioritas` = :prioritas, 1)
                     AND IF(:quota != '', musren_jns_kgtn.`no_jns_kgtn` = :quota, 1)

                    GROUP BY
                         vw_appl_kode_wilayah_induk.`kode_wilayah`,
                         vw_appl_kode_wilayah.`kode_wilayah`,
                         sikd_musren_bidang.kd_bidang,
                         musren_kgtn_desa.`no_urut_usulan`
                    HAVING (musren_kgtn_anggaran_disetujui > 0)

                    ORDER BY
                         vw_appl_kode_wilayah_induk.`kode_wilayah` ASC,
                         vw_appl_kode_wilayah.`kode_wilayah` ASC,
                         sikd_musren_bidang.kd_bidang ASC,
                         sikd_satker.`kode` ASC,
                         musren_kgtn_desa.`no_urut_usulan` ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("kec", $kec);
            $statement->bindValue("desa", $desa);
            $statement->bindValue("bidang", $idBidang);
            $statement->bindValue("prioritas", $prioritas);
            $statement->bindValue("quota", $quota);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getMusrenDesaListKgtnKotaStjSub($request)
    {
        try {
            
            $idMusrenKgtn = $request->query->get("id_musren_kgtn");            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idMusrenKgtn = pack('H*', str_replace('-', '', trim($idMusrenKgtn)));
            
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_lokasi_kgtn.`musren_kgtn_id`), 1, 8),
                        SUBSTR(HEX(musren_lokasi_kgtn.`musren_kgtn_id`), 9, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.`musren_kgtn_id`), 13, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.`musren_kgtn_id`), 17, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.`musren_kgtn_id`), 21)
                         ) AS musren_lokasi_kgtn_musren_kgtn_id,
                         musren_lokasi_kgtn.`nm_lokasi` AS musren_lokasi_kgtn_nm_lokasi_kgtn,
                         if(musren_lokasi_kgtn.`rt` not in (0,''), musren_lokasi_kgtn.`rt`, '-') AS musren_lokasi_kgtn_rt,
                         if(musren_lokasi_kgtn.`rw` not in (0,''), musren_lokasi_kgtn.`rw`, '-') AS musren_lokasi_kgtn_rw,
                         musren_lokasi_kgtn.`volume` AS musren_lokasi_kgtn_volume,
                         musren_lokasi_kgtn.`satuan` AS musren_lokasi_kgtn_satuan,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 1, 8),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 9, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 13, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 17, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 21)
                         ) AS musren_kgtn_id_musren_kgtn,
                         (vw_musren_anggaran_kgtn_desa.jml_apbd_kab+
                          vw_musren_anggaran_kgtn_desa.jml_apbd_prop+
                          vw_musren_anggaran_kgtn_desa.jml_apbn+
                          vw_musren_anggaran_kgtn_desa.jml_sumber_lain) AS jml_usulan,
                          ifnull((select sum(a.jml_anggaran) 
                                  from musren_lokasi_kgtn a, musren_lokasi_kgtn b inner join musren_kgtn d on b.musren_kgtn_id = d.id_musren_kgtn and d.musren_kgtn_type = 'MusrenKgtnSkpd', musren_lokasi_kgtn c
                                  where c.musren_lokasi_kgtn_id = musren_lokasi_kgtn.`id_musren_lokasi_kgtn`
                                    and b.musren_lokasi_kgtn_id = a.`id_musren_lokasi_kgtn`
                                    and a.musren_lokasi_kgtn_id = b.`id_musren_lokasi_kgtn`
                                    /*and a.musren_lokasi_kgtn_id = b.id_musren_lokasi_kgtn*/), 0) AS jml_disetujui
                    FROM
                         `musren_lokasi_kgtn` musren_lokasi_kgtn INNER JOIN `musren_kgtn` musren_kgtn ON musren_lokasi_kgtn.`musren_kgtn_id` = musren_kgtn.`id_musren_kgtn`
                         INNER JOIN `vw_musren_anggaran_kgtn_desa` vw_musren_anggaran_kgtn_desa ON musren_lokasi_kgtn.`id_musren_lokasi_kgtn` = vw_musren_anggaran_kgtn_desa.`musren_lokasi_kgtn_id`
                    WHERE
                         musren_kgtn.id_musren_kgtn = :id_musren_kgtn

                    ORDER BY
                         musren_lokasi_kgtn.`id_musren_lokasi_kgtn` ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_musren_kgtn", $idMusrenKgtn);
            $statement->execute();
            //print_r("ok");exit;
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getMusrenDesaDelegasi($request)
    {
        try {
            
            $kec = $request->query->get("kec");
            $desa = $request->query->get("desa");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_delegasi.`id_musren_delegasi`), 1, 8),
                        SUBSTR(HEX(musren_delegasi.`id_musren_delegasi`), 9, 4),
                        SUBSTR(HEX(musren_delegasi.`id_musren_delegasi`), 13, 4),
                        SUBSTR(HEX(musren_delegasi.`id_musren_delegasi`), 17, 4),
                        SUBSTR(HEX(musren_delegasi.`id_musren_delegasi`), 21)
                         ) AS musren_delegasi_id_musren_delegasi,
                         musren_delegasi.`nm_delegasi` AS musren_delegasi_nm_delegasi,
                         musren_delegasi.`nik` AS musren_delegasi_nik,
                         musren_delegasi.`jns_kelamin` AS musren_delegasi_jns_kelamin,
                         musren_delegasi.`pekerjaan` AS musren_delegasi_pekerjaan,
                         musren_delegasi.`jabatan` AS musren_delegasi_jabatan,
                         musren_delegasi.`no_telp` AS musren_delegasi_no_telp,
                         musren_delegasi.`alamat` AS musren_delegasi_alamat,
                         musren_musrenbang.`kd_wilayah` AS musren_musrenbang_kd_wilayah,
                         musren_musrenbang.`tahun` AS musren_musrenbang_tahun,
                         musren_musrenbang.`tgl_pelaksanaan` AS musren_musrenbang_tgl_pelaksanaan,
                         musren_musrenbang.`lokasi_pelaksanaan` AS musren_musrenbang_lokasi_pelaksanaan,
                         vw_appl_kode_wilayah.`kode_wilayah` AS vw_appl_kode_wilayah_kode_wilayah,
                         if(vw_appl_kode_wilayah.`klasifikasi` = 'KEL', 'Kelurahan', 'Desa') AS vw_appl_kode_wilayah_klasifikasi,
                         vw_appl_kode_wilayah.`nama_wilayah` AS vw_appl_kode_wilayah_nama_wilayah,
                         vw_appl_kode_wilayah_induk.`kode_wilayah` AS vw_appl_kode_wilayah_induk_kode_wilayah,
                         vw_appl_kode_wilayah_induk.`klasifikasi` AS vw_appl_kode_wilayah_induk_klasifikasi,
                         vw_appl_kode_wilayah_induk.`nama_wilayah` AS vw_appl_kode_wilayah_induk_nama_wilayah
                    FROM
                         `musren_musrenbang` musren_musrenbang_desa
                         INNER JOIN `musren_musrenbang` musren_musrenbang ON musren_musrenbang_desa.`id_musren_musrenbang` = musren_musrenbang.`id_musren_musrenbang`
                         INNER JOIN `musren_delegasi` musren_delegasi ON musren_musrenbang.`id_musren_musrenbang` = musren_delegasi.`musren_musrenbang_id`
                         INNER JOIN `vw_appl_kode_wilayah` vw_appl_kode_wilayah ON musren_musrenbang.`kd_wilayah` = vw_appl_kode_wilayah.`kode_wilayah`
                         INNER JOIN `vw_appl_kode_wilayah_induk` vw_appl_kode_wilayah_induk ON vw_appl_kode_wilayah.`kode_induk` = vw_appl_kode_wilayah_induk.`kode_wilayah`
                    WHERE
                        musren_musrenbang_desa.`musren_musrenbang_type` = 'MusrenMusrenbangDesa'
                     AND vw_appl_kode_wilayah_induk.`kode_wilayah` = :kec
                     AND IF(:desa != '', musren_musrenbang.`kd_wilayah` = :desa, musren_musrenbang.`kd_wilayah` LIKE '%')
                    ORDER BY
                         vw_appl_kode_wilayah_induk.`kode_wilayah` ASC,
                         vw_appl_kode_wilayah.`kode_wilayah` ASC,
                         musren_delegasi.`id_musren_delegasi` ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("kec", $kec);
            $statement->bindValue("desa", $desa);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getMusrenDesaListPrioritasUsulan($request)
    {
        try {
            
            $kec = $request->query->get("kec");
            $desa = $request->query->get("desa");
            $idBidang = $request->query->get("bidang");
            $prioritas = $request->query->get("prioritas");
            $quota = $request->query->get("quota");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idBidang = pack('H*', str_replace('-', '', trim($idBidang)));
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 1, 8),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 9, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 13, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 17, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 21)
                         ) AS musren_kgtn_id_musren_kgtn,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 1, 8),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 9, 4),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 13, 4),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 17, 4),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 21)
                         ) AS musren_kgtn_sikd_musren_bidang_id,
                         sikd_musren_bidang.`kd_bidang` AS sikd_musren_bidang_kd_bidang,
                         sikd_musren_bidang.`nm_bidang` AS sikd_musren_bidang_nm_bidang,
                         musren_kgtn.`nm_kgtn` AS musren_kgtn_nm_kgtn,
                         musren_kgtn.`nm_subkgtn` AS musren_kgtn_nm_subkgtn,
                         musren_kgtn.`prioritas` AS musren_kgtn_prioritas,
                         musren_kgtn.`sifat_kgtn` AS musren_kgtn_sifat_kgtn,
                         musren_kgtn.`output` AS musren_kgtn_output,
                         musren_kgtn.`outcome` AS musren_kgtn_outcome,
                         musren_kgtn_desa.`no_urut_usulan` AS musren_kgtn_desa_no_urut_usulan,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 1, 8),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 9, 4),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 13, 4),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 17, 4),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 21)
                         ) AS musren_musrenbang_id_musren_musrenbang,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_musrenbang_desa.`id_musren_musrenbang`), 1, 8),
                        SUBSTR(HEX(musren_musrenbang_desa.`id_musren_musrenbang`), 9, 4),
                        SUBSTR(HEX(musren_musrenbang_desa.`id_musren_musrenbang`), 13, 4),
                        SUBSTR(HEX(musren_musrenbang_desa.`id_musren_musrenbang`), 17, 4),
                        SUBSTR(HEX(musren_musrenbang_desa.`id_musren_musrenbang`), 21)
                         ) AS musren_musrenbang_desa_id_musren_musdesa,
                         musren_musrenbang.`tahun` AS musren_musrenbang_tahun,
                         vw_appl_kode_wilayah.`kode_wilayah` AS vw_appl_kode_wilayah_kode_wilayah,
                         vw_appl_kode_wilayah.`klasifikasi` AS vw_appl_kode_wilayah_klasifikasi,
                         vw_appl_kode_wilayah.`nama_wilayah` AS vw_appl_kode_wilayah_nama_wilayah,
                         vw_appl_kode_wilayah_induk.`kode_wilayah` AS vw_appl_kode_wilayah_induk_kode_wilayah,
                         vw_appl_kode_wilayah_induk.`nama_wilayah` AS vw_appl_kode_wilayah_induk_nama_wilayah,
                         SUM(vw_musren_anggaran_kgtn_desa.`jml_swadaya`) AS vw_musren_anggaran_kgtn_desa_jml_swadaya,
                         SUM(vw_musren_anggaran_kgtn_desa.`jml_apb_desa`) AS vw_musren_anggaran_kgtn_desa_jml_apb_desa,
                         SUM(vw_musren_anggaran_kgtn_desa.`jml_apbd_kab`) AS vw_musren_anggaran_kgtn_desa_jml_apbd_kab,
                         SUM(vw_musren_anggaran_kgtn_desa.`jml_apbd_prop`) AS vw_musren_anggaran_kgtn_desa_jml_apbd_prop,
                         SUM(vw_musren_anggaran_kgtn_desa.`jml_apbn`) AS vw_musren_anggaran_kgtn_desa_jml_apbn,
                         SUM(vw_musren_anggaran_kgtn_desa.`jml_sumber_lain`) AS vw_musren_anggaran_kgtn_desa_jml_sumber_lain
                    FROM
                         `musren_kgtn` musren_kgtn_desa 
                         INNER JOIN `musren_kgtn` musren_kgtn ON musren_kgtn_desa.`id_musren_kgtn` = musren_kgtn.`id_musren_kgtn`
                         INNER JOIN `musren_musrenbang` musren_musrenbang ON musren_kgtn.`musren_musrenbang_id` = musren_musrenbang.`id_musren_musrenbang`
                         INNER JOIN `sikd_bidang` sikd_musren_bidang ON musren_kgtn.`sikd_bidang_id` = sikd_musren_bidang.`id_sikd_bidang`
                         INNER JOIN `musren_lokasi_kgtn` musren_lokasi_kgtn ON musren_kgtn.`id_musren_kgtn` = musren_lokasi_kgtn.`musren_kgtn_id`
                         INNER JOIN `vw_musren_anggaran_kgtn_desa` vw_musren_anggaran_kgtn_desa ON musren_lokasi_kgtn.`id_musren_lokasi_kgtn` = vw_musren_anggaran_kgtn_desa.`musren_lokasi_kgtn_id`
                         INNER JOIN `musren_musrenbang` musren_musrenbang_desa ON musren_musrenbang.`id_musren_musrenbang` = musren_musrenbang_desa.`id_musren_musrenbang` AND musren_musrenbang_desa.`musren_musrenbang_type` = 'MusrenMusrenbangDesa'
                         INNER JOIN `vw_appl_kode_wilayah` vw_appl_kode_wilayah ON musren_musrenbang.`kd_wilayah` = vw_appl_kode_wilayah.`kode_wilayah`
                         INNER JOIN `vw_appl_kode_wilayah_induk` vw_appl_kode_wilayah_induk ON vw_appl_kode_wilayah.`kode_induk` = vw_appl_kode_wilayah_induk.`kode_wilayah`
                         INNER JOIN `musren_jns_kgtn` musren_jns_kgtn ON musren_kgtn_desa.`musren_jns_kgtn_id` = musren_jns_kgtn.`id_musren_jns_kgtn`
                    WHERE
                        musren_kgtn_desa.`musren_kgtn_type` = 'MusrenKgtnDesa'
                     AND musren_kgtn_desa.`status_verifikasi` = '1'
                     AND vw_appl_kode_wilayah_induk.`kode_wilayah` = :kec
                     AND IF(:desa != '', musren_musrenbang.`kd_wilayah` = :desa, 1)
                     AND IF(:bidang != '', sikd_musren_bidang.`id_sikd_bidang` = :bidang, 1)
                     AND IF(:prioritas != '', musren_kgtn.`prioritas` = :prioritas, 1)
                     AND IF(:quota != '', musren_jns_kgtn.`no_jns_kgtn` = :quota, 1)

                    GROUP BY
                         vw_appl_kode_wilayah_induk.`kode_wilayah`,
                         vw_appl_kode_wilayah.`kode_wilayah`,
                         musren_kgtn_desa.`no_urut_usulan`
                    ORDER BY
                         vw_appl_kode_wilayah_induk.`kode_wilayah` ASC,
                         vw_appl_kode_wilayah.`kode_wilayah` ASC,
                         musren_kgtn_desa.`no_urut_usulan` ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("kec", $kec);
            $statement->bindValue("desa", $desa);
            $statement->bindValue("bidang", $idBidang);
            $statement->bindValue("prioritas", $prioritas);
            $statement->bindValue("quota", $quota);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getMusrenDesaListUsulanDesa($request)
    {
        try {
            
            $kec = $request->query->get("kec");
            $desa = $request->query->get("desa");
            $idBidang = $request->query->get("bidang");
            $prioritas = $request->query->get("prioritas");
            $quota = $request->query->get("quota");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idBidang = pack('H*', str_replace('-', '', trim($idBidang)));
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 1, 8),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 9, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 13, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 17, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 21)
                         ) AS musren_kgtn_id_musren_kgtn,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 1, 8),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 9, 4),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 13, 4),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 17, 4),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 21)
                         ) AS musren_kgtn_sikd_musren_bidang_id,
                         sikd_musren_bidang.`kd_bidang` AS sikd_musren_bidang_kd_bidang,
                         sikd_musren_bidang.`nm_bidang` AS sikd_musren_bidang_nm_bidang,
                         musren_kgtn.`nm_kgtn` AS musren_kgtn_nm_kgtn,
                         musren_kgtn.`nm_subkgtn` AS musren_kgtn_nm_subkgtn,
                         musren_kgtn.`prioritas` AS musren_kgtn_prioritas,
                         musren_kgtn.`sifat_kgtn` AS musren_kgtn_sifat_kgtn,
                         musren_kgtn.`output` AS musren_kgtn_output,
                         musren_kgtn.`outcome` AS musren_kgtn_outcome,
                         musren_kgtn_desa.`no_urut_usulan` AS musren_kgtn_desa_no_urut_usulan,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 1, 8),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 9, 4),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 13, 4),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 17, 4),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 21)
                         ) AS musren_musrenbang_id_musren_musrenbang,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_musrenbang_desa.`id_musren_musrenbang`), 1, 8),
                        SUBSTR(HEX(musren_musrenbang_desa.`id_musren_musrenbang`), 9, 4),
                        SUBSTR(HEX(musren_musrenbang_desa.`id_musren_musrenbang`), 13, 4),
                        SUBSTR(HEX(musren_musrenbang_desa.`id_musren_musrenbang`), 17, 4),
                        SUBSTR(HEX(musren_musrenbang_desa.`id_musren_musrenbang`), 21)
                         ) AS musren_musrenbang_desa_id_musren_musdesa,
                         musren_musrenbang.`tahun` AS musren_musrenbang_tahun,
                         vw_appl_kode_wilayah.`kode_wilayah` AS vw_appl_kode_wilayah_kode_wilayah,
                         vw_appl_kode_wilayah.`klasifikasi` AS vw_appl_kode_wilayah_klasifikasi,
                         vw_appl_kode_wilayah.`nama_wilayah` AS vw_appl_kode_wilayah_nama_wilayah,
                         vw_appl_kode_wilayah_induk.`kode_wilayah` AS vw_appl_kode_wilayah_induk_kode_wilayah,
                         vw_appl_kode_wilayah_induk.`nama_wilayah` AS vw_appl_kode_wilayah_induk_nama_wilayah,
                         SUM(vw_musren_anggaran_kgtn_desa.`jml_swadaya`) AS vw_musren_anggaran_kgtn_desa_jml_swadaya,
                         SUM(vw_musren_anggaran_kgtn_desa.`jml_apb_desa`) AS vw_musren_anggaran_kgtn_desa_jml_apb_desa,
                         SUM(vw_musren_anggaran_kgtn_desa.`jml_apbd_kab`) AS vw_musren_anggaran_kgtn_desa_jml_apbd_kab,
                         SUM(vw_musren_anggaran_kgtn_desa.`jml_apbd_prop`) AS vw_musren_anggaran_kgtn_desa_jml_apbd_prop,
                         SUM(vw_musren_anggaran_kgtn_desa.`jml_apbn`) AS vw_musren_anggaran_kgtn_desa_jml_apbn,
                         SUM(vw_musren_anggaran_kgtn_desa.`jml_sumber_lain`) AS vw_musren_anggaran_kgtn_desa_jml_sumber_lain
                    FROM
                         `musren_kgtn` musren_kgtn_desa 
                         INNER JOIN `musren_kgtn` musren_kgtn ON musren_kgtn_desa.`id_musren_kgtn` = musren_kgtn.`id_musren_kgtn`
                         INNER JOIN `musren_musrenbang` musren_musrenbang ON musren_kgtn.`musren_musrenbang_id` = musren_musrenbang.`id_musren_musrenbang`
                         INNER JOIN `sikd_bidang` sikd_musren_bidang ON musren_kgtn.`sikd_bidang_id` = sikd_musren_bidang.`id_sikd_bidang`
                         INNER JOIN `musren_lokasi_kgtn` musren_lokasi_kgtn ON musren_kgtn.`id_musren_kgtn` = musren_lokasi_kgtn.`musren_kgtn_id`
                         INNER JOIN `vw_musren_anggaran_kgtn_desa` vw_musren_anggaran_kgtn_desa ON musren_lokasi_kgtn.`id_musren_lokasi_kgtn` = vw_musren_anggaran_kgtn_desa.`musren_lokasi_kgtn_id`
                         INNER JOIN `musren_musrenbang` musren_musrenbang_desa ON musren_musrenbang.`id_musren_musrenbang` = musren_musrenbang_desa.`id_musren_musrenbang` AND musren_musrenbang_desa.`musren_musrenbang_type` = 'MusrenMusrenbangDesa'
                         INNER JOIN `vw_appl_kode_wilayah` vw_appl_kode_wilayah ON musren_musrenbang.`kd_wilayah` = vw_appl_kode_wilayah.`kode_wilayah`
                         INNER JOIN `vw_appl_kode_wilayah_induk` vw_appl_kode_wilayah_induk ON vw_appl_kode_wilayah.`kode_induk` = vw_appl_kode_wilayah_induk.`kode_wilayah`
                         INNER JOIN `musren_jns_kgtn` musren_jns_kgtn ON musren_kgtn_desa.`musren_jns_kgtn_id` = musren_jns_kgtn.`id_musren_jns_kgtn`
                    WHERE
                        musren_kgtn_desa.`musren_kgtn_type` = 'MusrenKgtnDesa'
                     AND musren_kgtn_desa.`status_verifikasi` = '1'
                     AND vw_appl_kode_wilayah_induk.`kode_wilayah` = :kec
                     AND IF(:desa != '', musren_musrenbang.`kd_wilayah` = :desa, 1)
                     AND IF(:bidang != '', sikd_musren_bidang.`id_sikd_bidang` = :bidang, 1)
                     AND IF(:prioritas != '', musren_kgtn.`prioritas` = :prioritas, 1)
                     AND IF(:quota != '', musren_jns_kgtn.`no_jns_kgtn` = :quota, 1)

                    GROUP BY
                         vw_appl_kode_wilayah_induk.`kode_wilayah`,
                         vw_appl_kode_wilayah.`kode_wilayah`,
                         sikd_musren_bidang.kd_bidang,
                         musren_kgtn_desa.`no_urut_usulan`
                    ORDER BY
                         vw_appl_kode_wilayah_induk.`kode_wilayah` ASC,
                         vw_appl_kode_wilayah.`kode_wilayah` ASC,
                         sikd_musren_bidang.kd_bidang ASC,
                         musren_kgtn_desa.`no_urut_usulan` ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("kec", $kec);
            $statement->bindValue("desa", $desa);
            $statement->bindValue("bidang", $idBidang);
            $statement->bindValue("prioritas", $prioritas);
            $statement->bindValue("quota", $quota);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getMusrenDesaListKgtnBlmVerf($request)
    {
        try {
            
            $kec = $request->query->get("kec");
            $desa = $request->query->get("desa");
            $idBidang = $request->query->get("bidang");
            $prioritas = $request->query->get("prioritas");
            $quota = $request->query->get("quota");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idBidang = pack('H*', str_replace('-', '', trim($idBidang)));
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 1, 8),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 9, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 13, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 17, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 21)
                         ) AS musren_kgtn_id_musren_kgtn,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 1, 8),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 9, 4),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 13, 4),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 17, 4),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 21)
                         ) AS musren_kgtn_sikd_musren_bidang_id,
                         sikd_musren_bidang.`kd_bidang` AS sikd_musren_bidang_kd_bidang,
                         sikd_musren_bidang.`nm_bidang` AS sikd_musren_bidang_nm_bidang,
                         musren_kgtn.`nm_kgtn` AS musren_kgtn_nm_kgtn,
                         musren_kgtn.`nm_subkgtn` AS musren_kgtn_nm_subkgtn,
                         musren_kgtn.`prioritas` AS musren_kgtn_prioritas,
                         musren_kgtn.`sifat_kgtn` AS musren_kgtn_sifat_kgtn,
                         musren_kgtn.`output` AS musren_kgtn_output,
                         musren_kgtn.`outcome` AS musren_kgtn_outcome,
                         musren_kgtn_desa.`no_urut_usulan` AS musren_kgtn_desa_no_urut_usulan,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 1, 8),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 9, 4),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 13, 4),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 17, 4),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 21)
                         ) AS musren_musrenbang_id_musren_musrenbang,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_musrenbang_desa.`id_musren_musrenbang`), 1, 8),
                        SUBSTR(HEX(musren_musrenbang_desa.`id_musren_musrenbang`), 9, 4),
                        SUBSTR(HEX(musren_musrenbang_desa.`id_musren_musrenbang`), 13, 4),
                        SUBSTR(HEX(musren_musrenbang_desa.`id_musren_musrenbang`), 17, 4),
                        SUBSTR(HEX(musren_musrenbang_desa.`id_musren_musrenbang`), 21)
                         ) AS musren_musrenbang_desa_id_musren_musdesa,
                         musren_musrenbang.`tahun` AS musren_musrenbang_tahun,
                         vw_appl_kode_wilayah.`kode_wilayah` AS vw_appl_kode_wilayah_kode_wilayah,
                         vw_appl_kode_wilayah.`klasifikasi` AS vw_appl_kode_wilayah_klasifikasi,
                         vw_appl_kode_wilayah.`nama_wilayah` AS vw_appl_kode_wilayah_nama_wilayah,
                         vw_appl_kode_wilayah_induk.`kode_wilayah` AS vw_appl_kode_wilayah_induk_kode_wilayah,
                         vw_appl_kode_wilayah_induk.`nama_wilayah` AS vw_appl_kode_wilayah_induk_nama_wilayah,
                         SUM(vw_musren_anggaran_kgtn_desa.`jml_apbd_kab`) AS vw_musren_anggaran_kgtn_desa_jml_apbd_kab,
                         SUM(vw_musren_anggaran_kgtn_desa.`jml_apbd_prop`) AS vw_musren_anggaran_kgtn_desa_jml_apbd_prop,
                         SUM(vw_musren_anggaran_kgtn_desa.`jml_apbn`) AS vw_musren_anggaran_kgtn_desa_jml_apbn,
                         SUM(vw_musren_anggaran_kgtn_desa.`jml_sumber_lain`) AS vw_musren_anggaran_kgtn_desa_jml_sumber_lain
                    FROM
                         `musren_kgtn` musren_kgtn_desa 
                         INNER JOIN `musren_kgtn` musren_kgtn ON musren_kgtn_desa.`id_musren_kgtn` = musren_kgtn.`id_musren_kgtn`
                         INNER JOIN `musren_musrenbang` musren_musrenbang ON musren_kgtn.`musren_musrenbang_id` = musren_musrenbang.`id_musren_musrenbang`
                         INNER JOIN `sikd_bidang` sikd_musren_bidang ON musren_kgtn.`sikd_bidang_id` = sikd_musren_bidang.`id_sikd_bidang`
                         LEFT OUTER JOIN `musren_lokasi_kgtn` musren_lokasi_kgtn ON musren_kgtn.`id_musren_kgtn` = musren_lokasi_kgtn.`musren_kgtn_id`
                         LEFT OUTER JOIN `vw_musren_anggaran_kgtn_desa` vw_musren_anggaran_kgtn_desa ON musren_lokasi_kgtn.`id_musren_lokasi_kgtn` = vw_musren_anggaran_kgtn_desa.`musren_lokasi_kgtn_id`
                         INNER JOIN `musren_musrenbang` musren_musrenbang_desa ON musren_musrenbang.`id_musren_musrenbang` = musren_musrenbang_desa.`id_musren_musrenbang` AND musren_musrenbang_desa.`musren_musrenbang_type` = 'MusrenMusrenbangDesa'
                         INNER JOIN `vw_appl_kode_wilayah` vw_appl_kode_wilayah ON musren_musrenbang.`kd_wilayah` = vw_appl_kode_wilayah.`kode_wilayah`
                         INNER JOIN `vw_appl_kode_wilayah_induk` vw_appl_kode_wilayah_induk ON vw_appl_kode_wilayah.`kode_induk` = vw_appl_kode_wilayah_induk.`kode_wilayah`
                         INNER JOIN `musren_jns_kgtn` musren_jns_kgtn ON musren_kgtn_desa.`musren_jns_kgtn_id` = musren_jns_kgtn.`id_musren_jns_kgtn`
                    WHERE
                        musren_kgtn_desa.`musren_kgtn_type` = 'MusrenKgtnDesa'
                     AND musren_kgtn_desa.`status_verifikasi` != '1'
                     AND vw_appl_kode_wilayah_induk.`kode_wilayah` = :kec
                     AND IF(:desa != '', musren_musrenbang.`kd_wilayah` = :desa, 1)
                     AND IF(:bidang != '', sikd_musren_bidang.`id_sikd_bidang` = :bidang, 1)
                     AND IF(:prioritas != '', musren_kgtn.`prioritas` = :prioritas, 1)
                     AND IF(:quota != '', musren_jns_kgtn.`no_jns_kgtn` = :quota, 1)
                    GROUP BY
                         vw_appl_kode_wilayah_induk.`kode_wilayah`,
                         vw_appl_kode_wilayah.`kode_wilayah`,
                         sikd_musren_bidang.kd_bidang,
                         musren_kgtn_desa.`no_urut_usulan`
                    ORDER BY
                         vw_appl_kode_wilayah_induk.`kode_wilayah` ASC,
                         vw_appl_kode_wilayah.`kode_wilayah` ASC,
                         sikd_musren_bidang.kd_bidang ASC,
                         musren_kgtn_desa.`no_urut_usulan` ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("kec", $kec);
            $statement->bindValue("desa", $desa);
            $statement->bindValue("bidang", $idBidang);
            $statement->bindValue("prioritas", $prioritas);
            $statement->bindValue("quota", $quota);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getMusrenDesaListKgtnKecTdkStj($request)
    {
        try {
            
            $kec = $request->query->get("kec");
            $desa = $request->query->get("desa");
            $idBidang = $request->query->get("bidang");
            $prioritas = $request->query->get("prioritas");
            $quota = $request->query->get("quota");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idBidang = pack('H*', str_replace('-', '', trim($idBidang)));
            $this->connection = $conn->getConnection();
            
            $sql = /*"SELECT
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 1, 8),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 9, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 13, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 17, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 21)
                         ) AS musren_kgtn_id_musren_kgtn,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 1, 8),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 9, 4),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 13, 4),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 17, 4),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 21)
                         ) AS musren_kgtn_sikd_musren_bidang_id,
                         sikd_musren_bidang.`kd_bidang` AS sikd_musren_bidang_kd_bidang,
                         sikd_musren_bidang.`nm_bidang` AS sikd_musren_bidang_nm_bidang,
                         musren_kgtn.`nm_kgtn` AS musren_kgtn_nm_kgtn,
                         musren_kgtn.`nm_subkgtn` AS musren_kgtn_nm_subkgtn,
                         musren_kgtn.`prioritas` AS musren_kgtn_prioritas,
                         musren_kgtn.`sifat_kgtn` AS musren_kgtn_sifat_kgtn,
                         musren_kgtn.`output` AS musren_kgtn_output,
                         musren_kgtn.`outcome` AS musren_kgtn_outcome,
                         musren_kgtn_desa.`no_urut_usulan` AS musren_kgtn_desa_no_urut_usulan,
                         ifnull((select sum(a.jml_anggaran) 
                                 from musren_lokasi_kgtn a, musren_lokasi_kgtn b
                                 where b.musren_kgtn_id = musren_kgtn_desa.`id_musren_kgtn`
                                   and a.musren_lokasi_kgtn_id = b.id_musren_lokasi_kgtn),0) AS musren_kgtn_anggaran_disetujui,
                         musren_lokasi_kgtn.`nm_lokasi` AS musren_lokasi_kgtn_nm_lokasi_kgtn,
                         musren_lokasi_kgtn.`volume` AS musren_lokasi_kgtn_volume,
                         musren_lokasi_kgtn.`satuan` AS musren_lokasi_kgtn_satuan,
                         SUM(IF(musren_kgtn_desa.musren_kgtn_kec_id != '', 0 ,
                                vw_musren_anggaran_kgtn_desa.jml_apbd_kab+
                                vw_musren_anggaran_kgtn_desa.jml_apbd_prop+
                                vw_musren_anggaran_kgtn_desa.jml_apbn+
                                vw_musren_anggaran_kgtn_desa.jml_sumber_lain)) AS vw_musren_anggaran_kgtn_desa_jml_usulan,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 1, 8),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 9, 4),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 13, 4),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 17, 4),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 21)
                         ) AS musren_musrenbang_id_musren_musrenbang,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_musrenbang_desa.`id_musren_musrenbang`), 1, 8),
                        SUBSTR(HEX(musren_musrenbang_desa.`id_musren_musrenbang`), 9, 4),
                        SUBSTR(HEX(musren_musrenbang_desa.`id_musren_musrenbang`), 13, 4),
                        SUBSTR(HEX(musren_musrenbang_desa.`id_musren_musrenbang`), 17, 4),
                        SUBSTR(HEX(musren_musrenbang_desa.`id_musren_musrenbang`), 21)
                         ) AS musren_musrenbang_desa_id_musren_musdesa,
                         musren_musrenbang.`tahun` AS musren_musrenbang_tahun,
                         vw_appl_kode_wilayah.`kode_wilayah` AS vw_appl_kode_wilayah_kode_wilayah,
                         vw_appl_kode_wilayah.`klasifikasi` AS vw_appl_kode_wilayah_klasifikasi,
                         vw_appl_kode_wilayah.`nama_wilayah` AS vw_appl_kode_wilayah_nama_wilayah,
                         vw_appl_kode_wilayah_induk.`kode_wilayah` AS vw_appl_kode_wilayah_induk_kode_wilayah,
                         vw_appl_kode_wilayah_induk.`nama_wilayah` AS vw_appl_kode_wilayah_induk_nama_wilayah
                    FROM
                         `musren_kgtn` musren_kgtn_desa 
                         INNER JOIN `musren_kgtn` musren_kgtn ON musren_kgtn_desa.`id_musren_kgtn` = musren_kgtn.`id_musren_kgtn`
                         AND musren_kgtn_desa.`musren_kgtn_kec_id` = ''
                         INNER JOIN `musren_musrenbang` musren_musrenbang ON musren_kgtn.`musren_musrenbang_id` = musren_musrenbang.`id_musren_musrenbang`
                         INNER JOIN `sikd_bidang` sikd_musren_bidang ON musren_kgtn.`sikd_bidang_id` = sikd_musren_bidang.`id_sikd_bidang`
                         INNER JOIN `musren_lokasi_kgtn` musren_lokasi_kgtn ON musren_kgtn.`id_musren_kgtn` = musren_lokasi_kgtn.`musren_kgtn_id`
                         INNER JOIN `vw_musren_anggaran_kgtn_desa` vw_musren_anggaran_kgtn_desa ON musren_lokasi_kgtn.`id_musren_lokasi_kgtn` = vw_musren_anggaran_kgtn_desa.`musren_lokasi_kgtn_id`
                         INNER JOIN `musren_musrenbang` musren_musrenbang_desa ON musren_musrenbang.`id_musren_musrenbang` = musren_musrenbang_desa.`id_musren_musrenbang` AND musren_musrenbang_desa.`musren_musrenbang_type` = 'MusrenMusrenbangDesa'
                         INNER JOIN `vw_appl_kode_wilayah` vw_appl_kode_wilayah ON musren_musrenbang.`kd_wilayah` = vw_appl_kode_wilayah.`kode_wilayah`
                         INNER JOIN `vw_appl_kode_wilayah_induk` vw_appl_kode_wilayah_induk ON vw_appl_kode_wilayah.`kode_induk` = vw_appl_kode_wilayah_induk.`kode_wilayah`
                         INNER JOIN `musren_jns_kgtn` musren_jns_kgtn ON musren_kgtn_desa.`musren_jns_kgtn_id` = musren_jns_kgtn.`id_musren_jns_kgtn`
                    WHERE
                        musren_kgtn_desa.`musren_kgtn_type` = 'MusrenKgtnDesa'
                     AND musren_kgtn_desa.`status_verifikasi` = '1'
                     AND vw_appl_kode_wilayah_induk.`kode_wilayah` = :kec
                     AND IF(:desa != '', musren_musrenbang.`kd_wilayah` = :desa, musren_musrenbang.`kd_wilayah` LIKE '%')
                     AND IF(:bidang != '', sikd_musren_bidang.`id_sikd_bidang` = :bidang,  sikd_musren_bidang.`id_sikd_bidang` LIKE '%')
                     AND IF(:prioritas != '', musren_kgtn.`prioritas` = :prioritas, 1)
                     AND IF(:quota != '', musren_kgtn.`jns_kgtn` = :quota, 1)

                    GROUP BY
                         vw_appl_kode_wilayah_induk.`kode_wilayah`,
                         vw_appl_kode_wilayah.`kode_wilayah`,
                         sikd_musren_bidang.kd_bidang,
                         musren_kgtn_desa.`no_urut_usulan`
                    HAVING (musren_kgtn_anggaran_disetujui = 0)

                    ORDER BY
                         vw_appl_kode_wilayah_induk.`kode_wilayah` ASC,
                         vw_appl_kode_wilayah.`kode_wilayah` ASC,
                         sikd_musren_bidang.kd_bidang ASC,
                         musren_kgtn_desa.`no_urut_usulan` ASC";*/
                    "SELECT
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 1, 8),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 9, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 13, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 17, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 21)
                         ) AS musren_kgtn_id_musren_kgtn,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 1, 8),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 9, 4),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 13, 4),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 17, 4),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 21)
                         ) AS musren_kgtn_sikd_musren_bidang_id,
                         sikd_musren_bidang.`kd_bidang` AS sikd_musren_bidang_kd_bidang,
                         sikd_musren_bidang.`nm_bidang` AS sikd_musren_bidang_nm_bidang,
                         musren_kgtn.`nm_kgtn` AS musren_kgtn_nm_kgtn,
                         musren_kgtn.`nm_subkgtn` AS musren_kgtn_nm_subkgtn,
                         musren_kgtn.`prioritas` AS musren_kgtn_prioritas,
                         musren_kgtn.`sifat_kgtn` AS musren_kgtn_sifat_kgtn,
                         musren_kgtn.`output` AS musren_kgtn_output,
                         musren_kgtn.`outcome` AS musren_kgtn_outcome,
                         musren_kgtn_kec.`no_urut_usulan` AS musren_kgtn_desa_no_urut_usulan,
                         ifnull((select sum(a.jml_anggaran) 
                                 from musren_lokasi_kgtn a, musren_lokasi_kgtn b
                                 where b.musren_kgtn_id = musren_kgtn_kec.`id_musren_kgtn`
                                   and a.musren_lokasi_kgtn_id = b.id_musren_lokasi_kgtn),0) AS musren_kgtn_anggaran_disetujui,
                         musren_lokasi_kgtn.`nm_lokasi` AS musren_lokasi_kgtn_nm_lokasi_kgtn,
                         musren_lokasi_kgtn.`volume` AS musren_lokasi_kgtn_volume,
                         musren_lokasi_kgtn.`satuan` AS musren_lokasi_kgtn_satuan,
                         SUM(IF(musren_kgtn_kec.musren_kgtn_desa_id != '', 0 ,
                                vw_musren_anggaran_kgtn_desa.jml_apbd_kab+
                                vw_musren_anggaran_kgtn_desa.jml_apbd_prop+
                                vw_musren_anggaran_kgtn_desa.jml_apbn+
                                vw_musren_anggaran_kgtn_desa.jml_sumber_lain)) AS vw_musren_anggaran_kgtn_desa_jml_usulan,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 1, 8),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 9, 4),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 13, 4),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 17, 4),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 21)
                         ) AS musren_musrenbang_id_musren_musrenbang,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_musrenbang_desa.`id_musren_musrenbang`), 1, 8),
                        SUBSTR(HEX(musren_musrenbang_desa.`id_musren_musrenbang`), 9, 4),
                        SUBSTR(HEX(musren_musrenbang_desa.`id_musren_musrenbang`), 13, 4),
                        SUBSTR(HEX(musren_musrenbang_desa.`id_musren_musrenbang`), 17, 4),
                        SUBSTR(HEX(musren_musrenbang_desa.`id_musren_musrenbang`), 21)
                         ) AS musren_musrenbang_desa_id_musren_musdesa,
                         musren_musrenbang.`tahun` AS musren_musrenbang_tahun,
                         vw_appl_kode_wilayah.`kode_wilayah` AS vw_appl_kode_wilayah_kode_wilayah,
                         vw_appl_kode_wilayah.`klasifikasi` AS vw_appl_kode_wilayah_klasifikasi,
                         vw_appl_kode_wilayah.`nama_wilayah` AS vw_appl_kode_wilayah_nama_wilayah,
                         vw_appl_kode_wilayah_induk.`kode_wilayah` AS vw_appl_kode_wilayah_induk_kode_wilayah,
                         vw_appl_kode_wilayah_induk.`nama_wilayah` AS vw_appl_kode_wilayah_induk_nama_wilayah
                    FROM
                         `musren_kgtn` musren_kgtn_kec
                         INNER JOIN `musren_kgtn` musren_kgtn ON musren_kgtn_kec.`id_musren_kgtn` = musren_kgtn.`id_musren_kgtn`
                         LEFT JOIN `musren_kgtn` musren_kgtn_desa ON musren_kgtn.`id_musren_kgtn` = musren_kgtn_desa.`id_musren_kgtn` AND musren_kgtn_desa.`musren_kgtn_type` = 'MusrenKgtnDesa'
                         INNER JOIN `musren_musrenbang` musren_musrenbang ON musren_kgtn.`musren_musrenbang_id` = musren_musrenbang.`id_musren_musrenbang`
                         INNER JOIN `sikd_bidang` sikd_musren_bidang ON musren_kgtn.`sikd_bidang_id` = sikd_musren_bidang.`id_sikd_bidang`
                         INNER JOIN `musren_lokasi_kgtn` musren_lokasi_kgtn ON musren_kgtn.`id_musren_kgtn` = musren_lokasi_kgtn.`musren_kgtn_id`
                         LEFT JOIN `vw_musren_anggaran_kgtn_desa` vw_musren_anggaran_kgtn_desa ON musren_lokasi_kgtn.`id_musren_lokasi_kgtn` = vw_musren_anggaran_kgtn_desa.`musren_lokasi_kgtn_id`
                         LEFT JOIN `musren_musrenbang` musren_musrenbang_desa ON musren_musrenbang.`id_musren_musrenbang` = musren_musrenbang_desa.`id_musren_musrenbang` AND musren_musrenbang_desa.`musren_musrenbang_type` = 'MusrenMusrenbangDesa'
                         INNER JOIN `vw_appl_kode_wilayah` vw_appl_kode_wilayah ON musren_musrenbang.`kd_wilayah` = vw_appl_kode_wilayah.`kode_wilayah`
                         INNER JOIN `vw_appl_kode_wilayah_induk` vw_appl_kode_wilayah_induk ON vw_appl_kode_wilayah.`kode_induk` = vw_appl_kode_wilayah_induk.`kode_wilayah`
                         INNER JOIN `musren_jns_kgtn` musren_jns_kgtn ON musren_kgtn_kec.`musren_jns_kgtn_id` = musren_jns_kgtn.`id_musren_jns_kgtn`
                    WHERE
                        musren_kgtn_kec.`musren_kgtn_type` = 'MusrenKgtnKec'
                     AND musren_kgtn_kec.`status_verifikasi` = '2'
                     AND musren_kgtn_kec.`musren_kgtn_desa_id` IS NOT NULL
                     AND vw_appl_kode_wilayah_induk.`kode_wilayah` = :kec
                     AND IF(:desa != '', musren_musrenbang.`kd_wilayah` = :desa, musren_musrenbang.`kd_wilayah` LIKE '%')
                     AND IF(:bidang != '', sikd_musren_bidang.`id_sikd_bidang` = :bidang,  sikd_musren_bidang.`id_sikd_bidang` LIKE '%')
                     AND IF(:prioritas != '', musren_kgtn.`prioritas` = :prioritas, 1)
                     AND IF(:quota != '', musren_jns_kgtn.`no_jns_kgtn` = :quota, 1)
                    GROUP BY
                         vw_appl_kode_wilayah_induk.`kode_wilayah`,
                         vw_appl_kode_wilayah.`kode_wilayah`,
                         sikd_musren_bidang.kd_bidang,
                         musren_kgtn_kec.`no_urut_usulan`
                    HAVING (musren_kgtn_anggaran_disetujui = 0)

                    ORDER BY
                         vw_appl_kode_wilayah_induk.`kode_wilayah` ASC,
                         vw_appl_kode_wilayah.`kode_wilayah` ASC,
                         sikd_musren_bidang.kd_bidang ASC,
                         musren_kgtn_kec.`no_urut_usulan` ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("kec", $kec);
            $statement->bindValue("desa", $desa);
            $statement->bindValue("bidang", $idBidang);
            $statement->bindValue("prioritas", $prioritas);
            $statement->bindValue("quota", $quota);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }

    //KECAMATAN    
    private function getMusrenKecListUsulanDesa($request)
    {
        try {
            
            $kec = $request->query->get("kec");
            $prioritas = $request->query->get("prioritas");
            $quota = $request->query->get("quota");
            $idBidang = $request->query->get("bidang");
            $status = $request->query->get("status");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idBidang = pack('H*', str_replace('-', '', trim($idBidang)));
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 1, 8),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 9, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 13, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 17, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 21)
                         ) AS musren_kgtn_id_musren_kgtn,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 1, 8),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 9, 4),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 13, 4),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 17, 4),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 21)
                         ) AS musren_kgtn_sikd_musren_bidang_id,
                         sikd_musren_bidang.`kd_bidang` AS sikd_musren_bidang_kd_bidang,
                         sikd_musren_bidang.`nm_bidang` AS sikd_musren_bidang_nm_bidang,
                         musren_kgtn.`nm_kgtn` AS musren_kgtn_nm_kgtn,
                         musren_kgtn.`nm_subkgtn` AS musren_kgtn_nm_subkgtn,
                         musren_kgtn.`prioritas` AS musren_kgtn_prioritas,
                         musren_kgtn.`sifat_kgtn` AS musren_kgtn_sifat_kgtn,
                         musren_kgtn.`output` AS musren_kgtn_output,
                         musren_kgtn.`outcome` AS musren_kgtn_outcome,
                         musren_kgtn_desa.`no_urut_usulan` AS musren_kgtn_desa_no_urut_usulan,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 1, 8),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 9, 4),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 13, 4),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 17, 4),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 21)
                         ) AS musren_musrenbang_id_musren_musrenbang,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_musrenbang_desa.`id_musren_musrenbang`), 1, 8),
                        SUBSTR(HEX(musren_musrenbang_desa.`id_musren_musrenbang`), 9, 4),
                        SUBSTR(HEX(musren_musrenbang_desa.`id_musren_musrenbang`), 13, 4),
                        SUBSTR(HEX(musren_musrenbang_desa.`id_musren_musrenbang`), 17, 4),
                        SUBSTR(HEX(musren_musrenbang_desa.`id_musren_musrenbang`), 21)
                         ) AS musren_musrenbang_desa_id_musren_musdesa,
                         musren_musrenbang.`tahun` AS musren_musrenbang_tahun,
                         ifnull(substring(vw_appl_kode_wilayah.`kode_wilayah`,7,4), '-') AS vw_appl_kode_wilayah_kode,
                         vw_appl_kode_wilayah.`kode_wilayah` AS vw_appl_kode_wilayah_kode_wilayah,
                         vw_appl_kode_wilayah.`klasifikasi` AS vw_appl_kode_wilayah_klasifikasi,
                         vw_appl_kode_wilayah.`nama_wilayah` AS vw_appl_kode_wilayah_nama_wilayah,
                         vw_appl_kode_wilayah_induk.`kode_wilayah` AS vw_appl_kode_wilayah_induk_kode_wilayah,
                         vw_appl_kode_wilayah_induk.`nama_wilayah` AS vw_appl_kode_wilayah_induk_nama_wilayah,
                         SUM(vw_musren_anggaran_kgtn_desa.`jml_swadaya`) AS vw_musren_anggaran_kgtn_desa_jml_swadaya,
                         SUM(vw_musren_anggaran_kgtn_desa.`jml_apb_desa`) AS vw_musren_anggaran_kgtn_desa_jml_apb_desa,
                         SUM(vw_musren_anggaran_kgtn_desa.`jml_apbd_kab`) AS vw_musren_anggaran_kgtn_desa_jml_apbd_kab,
                         SUM(vw_musren_anggaran_kgtn_desa.`jml_apbd_prop`) AS vw_musren_anggaran_kgtn_desa_jml_apbd_prop,
                         SUM(vw_musren_anggaran_kgtn_desa.`jml_apbn`) AS vw_musren_anggaran_kgtn_desa_jml_apbn,
                         SUM(vw_musren_anggaran_kgtn_desa.`jml_sumber_lain`) AS vw_musren_anggaran_kgtn_desa_jml_sumber_lain
                    FROM
                         `musren_kgtn` musren_kgtn_desa 
                         INNER JOIN `musren_kgtn` musren_kgtn ON musren_kgtn_desa.`id_musren_kgtn` = musren_kgtn.`id_musren_kgtn`
                         INNER JOIN `musren_musrenbang` musren_musrenbang ON musren_kgtn.`musren_musrenbang_id` = musren_musrenbang.`id_musren_musrenbang`
                         INNER JOIN `sikd_bidang` sikd_musren_bidang ON musren_kgtn.`sikd_bidang_id` = sikd_musren_bidang.`id_sikd_bidang`
                         LEFT OUTER JOIN `musren_lokasi_kgtn` musren_lokasi_kgtn ON musren_kgtn.`id_musren_kgtn` = musren_lokasi_kgtn.`musren_kgtn_id`
                         LEFT OUTER JOIN `vw_musren_anggaran_kgtn_desa` vw_musren_anggaran_kgtn_desa ON musren_lokasi_kgtn.`id_musren_lokasi_kgtn` = vw_musren_anggaran_kgtn_desa.`musren_lokasi_kgtn_id`
                         INNER JOIN `musren_musrenbang` musren_musrenbang_desa ON musren_musrenbang.`id_musren_musrenbang` = musren_musrenbang_desa.`id_musren_musrenbang` AND musren_musrenbang_desa.`musren_musrenbang_type` = 'MusrenMusrenbangDesa'
                         INNER JOIN `vw_appl_kode_wilayah` vw_appl_kode_wilayah ON musren_musrenbang.`kd_wilayah` = vw_appl_kode_wilayah.`kode_wilayah`
                         INNER JOIN `vw_appl_kode_wilayah_induk` vw_appl_kode_wilayah_induk ON vw_appl_kode_wilayah.`kode_induk` = vw_appl_kode_wilayah_induk.`kode_wilayah`
                         INNER JOIN `musren_jns_kgtn` musren_jns_kgtn ON musren_jns_kgtn.`id_musren_jns_kgtn` = musren_kgtn_desa.`musren_jns_kgtn_id`
                    WHERE
                        musren_kgtn_desa.`musren_kgtn_type` = 'MusrenKgtnDesa'
                     AND vw_appl_kode_wilayah_induk.`kode_wilayah` = :kec
                     AND IF(:status = '1', musren_kgtn_desa.`status_verifikasi` = '1',
                            IF(:status = '0', musren_kgtn_desa.`status_verifikasi` IN ('','0'), 1))
                     AND IF(:bidang != '', sikd_musren_bidang.`id_sikd_bidang` = :bidang, 1)
                     AND IF(:prioritas != '', musren_kgtn.`prioritas` = :prioritas, 1)
                     AND IF(:quota != '', musren_jns_kgtn.`no_jns_kgtn` = :quota, 1)
                    GROUP BY
                         vw_appl_kode_wilayah_induk.`kode_wilayah`,
                         sikd_musren_bidang.kd_bidang,
                         vw_appl_kode_wilayah.`kode_wilayah`,
                         musren_kgtn_desa.`no_urut_usulan`
                    ORDER BY
                         vw_appl_kode_wilayah_induk.`kode_wilayah` ASC,
                         sikd_musren_bidang.kd_bidang ASC,
                         vw_appl_kode_wilayah.`kode_wilayah` ASC,
                         musren_kgtn_desa.`no_urut_usulan` ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("kec", $kec);
            $statement->bindValue("prioritas", $prioritas);
            $statement->bindValue("quota", $quota);
            $statement->bindValue("bidang", $idBidang);
            $statement->bindValue("status", $status);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getMusrenKecListUsulanDesaSub($request)
    {
        try {
            
            $idMusrenKgtn = $request->query->get("id_musren_kgtn");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idMusrenKgtn = pack('H*', str_replace('-', '', trim($idMusrenKgtn)));
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                         musren_lokasi_kgtn.`nm_lokasi` AS musren_lokasi_kgtn_nm_lokasi_kgtn,
                         if(musren_lokasi_kgtn.`rt` not in (0,''), musren_lokasi_kgtn.`rt`, '-') AS musren_lokasi_kgtn_rt,
                         if(musren_lokasi_kgtn.`rw` not in (0,''), musren_lokasi_kgtn.`rw`, '-') AS musren_lokasi_kgtn_rw,
                         musren_lokasi_kgtn.`volume` AS musren_lokasi_kgtn_volume,
                         musren_lokasi_kgtn.`satuan` AS musren_lokasi_kgtn_satuan,
                         vw_musren_anggaran_kgtn_desa.`jml_swadaya` AS vw_musren_anggaran_kgtn_desa_jml_swadaya,
                         vw_musren_anggaran_kgtn_desa.`jml_apb_desa` AS vw_musren_anggaran_kgtn_desa_jml_apb_desa,
                         vw_musren_anggaran_kgtn_desa.`jml_apbd_kab` AS vw_musren_anggaran_kgtn_desa_jml_apbd_kab,
                         vw_musren_anggaran_kgtn_desa.`jml_apbd_prop` AS vw_musren_anggaran_kgtn_desa_jml_apbd_prop,
                         vw_musren_anggaran_kgtn_desa.`jml_apbn` AS vw_musren_anggaran_kgtn_desa_jml_apbn,
                         vw_musren_anggaran_kgtn_desa.`jml_sumber_lain` AS vw_musren_anggaran_kgtn_desa_jml_sumber_lain
                    FROM
                         `musren_lokasi_kgtn` musren_lokasi_kgtn 
                         INNER JOIN `musren_kgtn` musren_kgtn ON musren_lokasi_kgtn.`musren_kgtn_id` = musren_kgtn.`id_musren_kgtn`
                         INNER JOIN `vw_musren_anggaran_kgtn_desa` vw_musren_anggaran_kgtn_desa ON musren_lokasi_kgtn.`id_musren_lokasi_kgtn` = vw_musren_anggaran_kgtn_desa.`musren_lokasi_kgtn_id`
                    WHERE
                         musren_kgtn.`id_musren_kgtn` = :id_musren_kgtn";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_musren_kgtn", $idMusrenKgtn);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }

    private function getMusrenKecListUsulanDesaSub1($request)
    {
        try {
            
            $idMusrenKgtn = $request->query->get("id_musren_kgtn");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idMusrenKgtn = pack('H*', str_replace('-', '', trim($idMusrenKgtn)));
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_lokasi_kgtn.`id_musren_lokasi_kgtn`), 1, 8),
                        SUBSTR(HEX(musren_lokasi_kgtn.`id_musren_lokasi_kgtn`), 9, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.`id_musren_lokasi_kgtn`), 13, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.`id_musren_lokasi_kgtn`), 17, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.`id_musren_lokasi_kgtn`), 21)
                         ) AS musren_lokasi_kgtn_id_musren_lokasi_kgtn,
                         musren_lokasi_kgtn.`nm_lokasi` AS musren_lokasi_kgtn_nm_lokasi_kgtn,
                         musren_lokasi_kgtn.`volume` AS musren_lokasi_kgtn_volume,
                         musren_lokasi_kgtn.`satuan` AS musren_lokasi_kgtn_satuan,
                         vw_musren_anggaran_kgtn_desa.`jml_swadaya` AS vw_musren_anggaran_kgtn_desa_jml_swadaya,
                         vw_musren_anggaran_kgtn_desa.`jml_apb_desa` AS vw_musren_anggaran_kgtn_desa_jml_apb_desa,
                         vw_musren_anggaran_kgtn_desa.`jml_apbd_kab` AS vw_musren_anggaran_kgtn_desa_jml_apbd_kab,
                         vw_musren_anggaran_kgtn_desa.`jml_apbd_prop` AS vw_musren_anggaran_kgtn_desa_jml_apbd_prop,
                         vw_musren_anggaran_kgtn_desa.`jml_apbn` AS vw_musren_anggaran_kgtn_desa_jml_apbn,
                         vw_musren_anggaran_kgtn_desa.`jml_sumber_lain` AS vw_musren_anggaran_kgtn_desa_jml_sumber_lain
                    FROM
                         `musren_lokasi_kgtn` musren_lokasi_kgtn 
                         INNER JOIN `musren_kgtn` musren_kgtn ON musren_lokasi_kgtn.`musren_kgtn_id` = musren_kgtn.`id_musren_kgtn`
                         INNER JOIN `vw_musren_anggaran_kgtn_desa` vw_musren_anggaran_kgtn_desa ON musren_lokasi_kgtn.`id_musren_lokasi_kgtn` = vw_musren_anggaran_kgtn_desa.`musren_lokasi_kgtn_id`
                    WHERE
                         musren_kgtn.`id_musren_kgtn` = :id_musren_kgtn";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_musren_kgtn", $idMusrenKgtn);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getMusrenKecListKgtn($request)
    {
        try {
            
            $kec = $request->query->get("kec");
            $prioritas = $request->query->get("prioritas");
            $quota = $request->query->get("quota");
            $idBidang = $request->query->get("bidang");
            $status = $request->query->get("status");
            $tahun = $request->query->get("tahun");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idBidang = pack('H*', str_replace('-', '', trim($idBidang)));
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 1, 8),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 9, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 13, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 17, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 21)
                         ) AS musren_kgtn_id_musren_kgtn,
                         musren_kgtn.`nm_kgtn` AS musren_kgtn_nm_kgtn,
                         musren_kgtn.`prioritas` AS musren_kgtn_prioritas,
                         musren_kgtn.`sifat_kgtn` AS musren_kgtn_sifat_kgtn,
                         musren_kgtn.`output` AS musren_kgtn_output,
                         musren_kgtn.`outcome` AS musren_kgtn_outcome,
                         musren_kgtn_kec.`no_urut_usulan` AS musren_kgtn_kec_no_urut_usulan,
                        CONCAT_WS('-',
                        SUBSTR(HEX(sikd_musren_bidang.`id_sikd_bidang`), 1, 8),
                        SUBSTR(HEX(sikd_musren_bidang.`id_sikd_bidang`), 9, 4),
                        SUBSTR(HEX(sikd_musren_bidang.`id_sikd_bidang`), 13, 4),
                        SUBSTR(HEX(sikd_musren_bidang.`id_sikd_bidang`), 17, 4),
                        SUBSTR(HEX(sikd_musren_bidang.`id_sikd_bidang`), 21)
                         ) AS sikd_musren_bidang_id_sikd_musren_bidang,
                         sikd_musren_bidang.`kd_bidang` AS sikd_musren_bidang_kd_bidang,
                         sikd_musren_bidang.`nm_bidang` AS sikd_musren_bidang_nm_bidang,
                         ifnull(substring(vw_appl_kode_wilayah.`kode_wilayah`,7,4),'-') AS vw_appl_kode_wilayah_kode,
                         concat(vw_appl_kode_wilayah.`klasifikasi`,' ',vw_appl_kode_wilayah.`nama_wilayah`)AS vw_appl_kode_wilayah_nama_wilayah,
                         sikd_satker.`kode` AS sikd_satker_kode,
                         sikd_satker.`nama` AS sikd_satker_nama,
                         musren_musrenbang.`kd_wilayah` AS musren_musrenbang_kd_wilayah,
                         SUM(vw_musren_anggaran_kgtn.`jml_apbd_kab`) AS vw_musren_anggaran_kgtn_jml_apbd_kab,
                         SUM(vw_musren_anggaran_kgtn.`jml_apbd_prop`) AS vw_musren_anggaran_kgtn_jml_apbd_prop,
                         SUM(vw_musren_anggaran_kgtn.`jml_apbn`) AS vw_musren_anggaran_kgtn_jml_apbn,
                         SUM(vw_musren_anggaran_kgtn.`jml_lain`) AS vw_musren_anggaran_kgtn_jml_lain,
                         vw_appl_kode_wilayah_A.`klasifikasi` AS vw_appl_kode_wilayah_A_klasifikasi,
                         vw_appl_kode_wilayah_A.`nama_wilayah` AS vw_appl_kode_wilayah_A_nama_wilayah
                    FROM
                         `musren_kgtn` musren_kgtn 
                         INNER JOIN `musren_kgtn` musren_kgtn_kec ON musren_kgtn.`id_musren_kgtn` = musren_kgtn_kec.`id_musren_kgtn` AND musren_kgtn_kec.`musren_kgtn_type` = 'MusrenKgtnKec'
                         INNER JOIN `sikd_satker` sikd_satker ON musren_kgtn_kec.`sikd_skpd_id` = sikd_satker.`id_sikd_satker`
                         LEFT OUTER JOIN `sikd_bidang` sikd_musren_bidang ON musren_kgtn.`sikd_bidang_id` = sikd_musren_bidang.`id_sikd_bidang`
                         INNER JOIN `musren_lokasi_kgtn` musren_lokasi_kgtn ON musren_kgtn.`id_musren_kgtn` = musren_lokasi_kgtn.`musren_kgtn_id`
                         INNER JOIN `vw_musren_anggaran_kgtn` vw_musren_anggaran_kgtn ON musren_lokasi_kgtn.`id_musren_lokasi_kgtn` = vw_musren_anggaran_kgtn.`musren_lokasi_kgtn_id`
                         INNER JOIN `musren_musrenbang` musren_musrenbang ON musren_kgtn.`musren_musrenbang_id` = musren_musrenbang.`id_musren_musrenbang`
                         INNER JOIN `vw_appl_kode_wilayah` vw_appl_kode_wilayah_A ON musren_musrenbang.`kd_wilayah` = vw_appl_kode_wilayah_A.`kode_wilayah`
                         INNER JOIN `vw_appl_kode_wilayah` vw_appl_kode_wilayah ON musren_lokasi_kgtn.`kd_wilayah` = vw_appl_kode_wilayah.`kode_wilayah`
                         INNER JOIN `musren_jns_kgtn` musren_jns_kgtn ON musren_kgtn_kec.`musren_jns_kgtn_id` = musren_jns_kgtn.`id_musren_jns_kgtn`
                    WHERE
                         musren_musrenbang.`tahun` = :tahun
                     AND IF(:kec != '', musren_musrenbang.`kd_wilayah` = :kec, 1)
                     AND IF(:status = '1', musren_kgtn_kec.`status_verifikasi` = '1',
                            IF(:status = '0', musren_kgtn_kec.`status_verifikasi` IN ('','0'), 1))
                     AND IF(:bidang != '', musren_kgtn.`sikd_bidang_id` = :bidang, 1)
                     AND IF(:prioritas != '', musren_kgtn.`prioritas` = :prioritas, 1)
                     AND IF(:quota != '', musren_jns_kgtn.`no_jns_kgtn` = :quota, 1)
                     AND vw_appl_kode_wilayah_A.klasifikasi = 'KEC'
                    GROUP BY
                         musren_musrenbang.`kd_wilayah`,
                         sikd_musren_bidang.kd_bidang,
                         vw_appl_kode_wilayah.`kode_wilayah`,
                         musren_kgtn_kec.`id_musren_kgtn`
                    ORDER BY
                         musren_musrenbang.`kd_wilayah` ASC,
                         sikd_musren_bidang.kd_bidang ASC,
                         vw_appl_kode_wilayah.`kode_wilayah` ASC,
                         musren_kgtn_kec.`id_musren_kgtn` ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("kec", $kec);
            $statement->bindValue("prioritas", $prioritas);
            $statement->bindValue("quota", $quota);
            $statement->bindValue("bidang", $idBidang);
            $statement->bindValue("status", $status);
            $statement->bindValue("tahun", $tahun);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }

    private function getMusrenKecListKgtnSub($request)
    {
        try {
            
            $idMusrenKgtn = $request->query->get("id_musren_kgtn");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idMusrenKgtn = pack('H*', str_replace('-', '', trim($idMusrenKgtn)));
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                         musren_lokasi_kgtn.`nm_lokasi` AS musren_lokasi_kgtn_nm_lokasi_kgtn,
                         ifnull(musren_lokasi_kgtn.`rt`,'-') AS musren_lokasi_kgtn_rt,
                         ifnull(musren_lokasi_kgtn.`rw`,'-') AS musren_lokasi_kgtn_rw,
                         musren_lokasi_kgtn.`volume` AS musren_lokasi_kgtn_volume,
                         musren_lokasi_kgtn.`satuan` AS musren_lokasi_kgtn_satuan,
                         vw_musren_anggaran_kgtn.`jml_apbd_kab` AS vw_musren_anggaran_kgtn_jml_apbd_kab,
                         vw_musren_anggaran_kgtn.`jml_apbd_prop` AS vw_musren_anggaran_kgtn_jml_apbd_prop,
                         vw_musren_anggaran_kgtn.`jml_apbn` AS vw_musren_anggaran_kgtn_jml_apbn,
                         vw_musren_anggaran_kgtn.`jml_lain` AS vw_musren_anggaran_kgtn_jml_lain
                    FROM
                         `musren_lokasi_kgtn` musren_lokasi_kgtn 
                         INNER JOIN `musren_kgtn` musren_kgtn ON musren_lokasi_kgtn.`musren_kgtn_id` = musren_kgtn.`id_musren_kgtn`
                         INNER JOIN `vw_musren_anggaran_kgtn` vw_musren_anggaran_kgtn ON musren_lokasi_kgtn.`id_musren_lokasi_kgtn` = vw_musren_anggaran_kgtn.`musren_lokasi_kgtn_id`
                    WHERE
                         musren_kgtn.`id_musren_kgtn` = :id_musren_kgtn";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_musren_kgtn", $idMusrenKgtn);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getMusrenKecRekapLokasi($request)
    {
        try {
            
            $kec = $request->query->get("kec");
            $prioritas = $request->query->get("prioritas");
            $idBidang = $request->query->get("bidang");
            $status = $request->query->get("status");
            $tahun = $request->query->get("tahun");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idBidang = pack('H*', str_replace('-', '', trim($idBidang)));
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT DISTINCT
                        CONCAT_WS('-',
                        SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 1, 8),
                        SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 9, 4),
                        SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 13, 4),
                        SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 17, 4),
                        SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 21)
                         ) AS sikd_satker_id_sikd_satker,
                         sum(vw_musren_anggaran_kgtn.`jml_apbd_kab`)AS jml_apbd_kab,
                         sum(vw_musren_anggaran_kgtn.`jml_apbd_prop`)AS jml_apbd_prop,
                         sum(vw_musren_anggaran_kgtn.`jml_apbn`)AS jml_apbn,
                         sum(vw_musren_anggaran_kgtn.`jml_lain`)AS jml_lain,
                         count(distinct CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 1, 8),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 9, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 13, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 17, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 21)
                         )) AS jml_kgtn,
                         sikd_satker.`kode` AS sikd_satker_kode,
                         sikd_satker.`nama` AS sikd_satker_nama,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 1, 8),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 9, 4),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 13, 4),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 17, 4),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 21)
                         ) AS musren_kgtn_sikd_musren_bidang_id,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn.`musren_musrenbang_id`), 1, 8),
                        SUBSTR(HEX(musren_kgtn.`musren_musrenbang_id`), 9, 4),
                        SUBSTR(HEX(musren_kgtn.`musren_musrenbang_id`), 13, 4),
                        SUBSTR(HEX(musren_kgtn.`musren_musrenbang_id`), 17, 4),
                        SUBSTR(HEX(musren_kgtn.`musren_musrenbang_id`), 21)
                         ) AS musren_kgtn_musren_musrenbang_id,
                         musren_musrenbang.`tahun` AS musren_musrenbang_tahun,
                         musren_musrenbang.`kd_wilayah` AS musren_musrenbang_kd_wilayah,
                         sikd_musren_bidang.`kd_bidang` AS sikd_musren_bidang_kd_bidang,
                         sikd_musren_bidang.`nm_bidang` AS sikd_musren_bidang_nm_bidang,
                         vw_appl_kode_wilayah.`kode_wilayah` AS vw_appl_kode_wilayah_kode_wilayah,
                         vw_appl_kode_wilayah.`klasifikasi` AS vw_appl_kode_wilayah_klasifikasi,
                         vw_appl_kode_wilayah.`nama_wilayah` AS vw_appl_kode_wilayah_nama_wilayah,
                         musren_lokasi_kgtn.`kd_wilayah` AS musren_lokasi_kgtn_kd_wilayah,
                         vw_appl_kode_wilayah_A.`kode_wilayah` AS vw_appl_kode_wilayah_A_kode_wilayah,
                         vw_appl_kode_wilayah_A.`klasifikasi` AS vw_appl_kode_wilayah_A_klasifikasi,
                         vw_appl_kode_wilayah_A.`nama_wilayah` AS vw_appl_kode_wilayah_A_nama_wilayah
                    FROM
                         `musren_kgtn` musren_kgtn 
                         INNER JOIN `sikd_bidang` sikd_musren_bidang ON musren_kgtn.`sikd_bidang_id` = sikd_musren_bidang.`id_sikd_bidang`
                         INNER JOIN `musren_musrenbang` musren_musrenbang ON musren_kgtn.`musren_musrenbang_id` = musren_musrenbang.`id_musren_musrenbang`
                         INNER JOIN `vw_appl_kode_wilayah` vw_appl_kode_wilayah ON musren_musrenbang.`kd_wilayah` = vw_appl_kode_wilayah.`kode_wilayah`
                         INNER JOIN `musren_kgtn` musren_kgtn_kec ON musren_kgtn.`id_musren_kgtn` = musren_kgtn_kec.`id_musren_kgtn`
                         INNER JOIN `sikd_satker` sikd_satker ON musren_kgtn_kec.`sikd_skpd_id` = sikd_satker.`id_sikd_satker` AND musren_kgtn_kec.`musren_kgtn_type` = 'MusrenKgtnKec'
                         INNER JOIN `musren_lokasi_kgtn` musren_lokasi_kgtn ON musren_kgtn.`id_musren_kgtn` = musren_lokasi_kgtn.`musren_kgtn_id`
                         INNER JOIN `vw_appl_kode_wilayah` vw_appl_kode_wilayah_A ON musren_lokasi_kgtn.`kd_wilayah` = vw_appl_kode_wilayah_A.`kode_wilayah`
                         LEFT OUTER JOIN `vw_musren_anggaran_kgtn` vw_musren_anggaran_kgtn ON musren_lokasi_kgtn.`id_musren_lokasi_kgtn` = vw_musren_anggaran_kgtn.`musren_lokasi_kgtn_id`
                    WHERE
                         musren_musrenbang.`tahun` = :tahun
                     AND IF(:kec != '', musren_musrenbang.`kd_wilayah` = :kec, 1)
                     AND IF(:status = '1', musren_kgtn_kec.`status_verifikasi` = '1',
                            IF(:status = '0', musren_kgtn_kec.`status_verifikasi` IN ('','0'), 1))
                     AND IF(:bidang != '', musren_kgtn.`sikd_bidang_id` = :bidang, 1)
                     AND IF(:prioritas != '', musren_kgtn.`prioritas` = :prioritas, 1)
                    GROUP BY
                         musren_musrenbang.`kd_wilayah`,
                         musren_lokasi_kgtn.`kd_wilayah`
                    ORDER BY
                         musren_musrenbang.`kd_wilayah` ASC,
                         musren_lokasi_kgtn.`kd_wilayah` ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("kec", $kec);
            $statement->bindValue("prioritas", $prioritas);
            $statement->bindValue("bidang", $idBidang);
            $statement->bindValue("status", $status);
            $statement->bindValue("tahun", $tahun);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getMusrenKecRekapBidang($request)
    {
        try {

            $kec = $request->query->get("kec");
            $prioritas = $request->query->get("prioritas");
            $idBidang = $request->query->get("bidang");
            $status = $request->query->get("status");
            $tahun = $request->query->get("tahun");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idBidang = pack('H*', str_replace('-', '', trim($idBidang)));
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT DISTINCT
                        CONCAT_WS('-',
                        SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 1, 8),
                        SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 9, 4),
                        SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 13, 4),
                        SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 17, 4),
                        SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 21)
                         ) AS sikd_satker_id_sikd_satker,
                         sum(vw_musren_anggaran_kgtn.`jml_apbd_kab`)AS jml_apbd_kab,
                         sum(vw_musren_anggaran_kgtn.`jml_apbd_prop`)AS jml_apbd_prop,
                         sum(vw_musren_anggaran_kgtn.`jml_apbn`)AS jml_apbn,
                         sum(vw_musren_anggaran_kgtn.`jml_lain`)AS jml_lain,
                         count(distinct CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 1, 8),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 9, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 13, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 17, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 21)
                         )) AS jml_kgtn,
                         sikd_satker.`kode` AS sikd_satker_kode,
                         sikd_satker.`nama` AS sikd_satker_nama,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 1, 8),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 9, 4),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 13, 4),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 17, 4),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 21)
                         ) AS musren_kgtn_sikd_musren_bidang_id,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn.`musren_musrenbang_id`), 1, 8),
                        SUBSTR(HEX(musren_kgtn.`musren_musrenbang_id`), 9, 4),
                        SUBSTR(HEX(musren_kgtn.`musren_musrenbang_id`), 13, 4),
                        SUBSTR(HEX(musren_kgtn.`musren_musrenbang_id`), 17, 4),
                        SUBSTR(HEX(musren_kgtn.`musren_musrenbang_id`), 21)
                         ) AS musren_kgtn_musren_musrenbang_id,
                         musren_musrenbang.`tahun` AS musren_musrenbang_tahun,
                         musren_musrenbang.`kd_wilayah` AS musren_musrenbang_kd_wilayah,
                         sikd_musren_bidang.`kd_bidang` AS sikd_musren_bidang_kd_bidang,
                         sikd_musren_bidang.`nm_bidang` AS sikd_musren_bidang_nm_bidang,
                         vw_appl_kode_wilayah.`kode_wilayah` AS vw_appl_kode_wilayah_kode_wilayah,
                         vw_appl_kode_wilayah.`klasifikasi` AS vw_appl_kode_wilayah_klasifikasi,
                         vw_appl_kode_wilayah.`nama_wilayah` AS vw_appl_kode_wilayah_nama_wilayah,
                         musren_lokasi_kgtn.`kd_wilayah` AS musren_lokasi_kgtn_kd_wilayah,
                         vw_appl_kode_wilayah_A.`kode_wilayah` AS vw_appl_kode_wilayah_A_kode_wilayah,
                         vw_appl_kode_wilayah_A.`klasifikasi` AS vw_appl_kode_wilayah_A_klasifikasi,
                         vw_appl_kode_wilayah_A.`nama_wilayah` AS vw_appl_kode_wilayah_A_nama_wilayah
                    FROM
                         `musren_kgtn` musren_kgtn 
                         INNER JOIN `sikd_bidang` sikd_musren_bidang ON musren_kgtn.`sikd_bidang_id` = sikd_musren_bidang.`id_sikd_bidang`
                         INNER JOIN `musren_musrenbang` musren_musrenbang ON musren_kgtn.`musren_musrenbang_id` = musren_musrenbang.`id_musren_musrenbang`
                         INNER JOIN `vw_appl_kode_wilayah` vw_appl_kode_wilayah ON musren_musrenbang.`kd_wilayah` = vw_appl_kode_wilayah.`kode_wilayah`
                         INNER JOIN `musren_kgtn` musren_kgtn_kec ON musren_kgtn.`id_musren_kgtn` = musren_kgtn_kec.`id_musren_kgtn` AND musren_kgtn_kec.`musren_kgtn_type` = 'MusrenKgtnKec'
                         INNER JOIN `sikd_satker` sikd_satker ON musren_kgtn_kec.`sikd_skpd_id` = sikd_satker.`id_sikd_satker`
                         INNER JOIN `musren_lokasi_kgtn` musren_lokasi_kgtn ON musren_kgtn.`id_musren_kgtn` = musren_lokasi_kgtn.`musren_kgtn_id`
                         INNER JOIN `vw_appl_kode_wilayah` vw_appl_kode_wilayah_A ON musren_lokasi_kgtn.`kd_wilayah` = vw_appl_kode_wilayah_A.`kode_wilayah`
                         LEFT OUTER JOIN `vw_musren_anggaran_kgtn` vw_musren_anggaran_kgtn ON musren_lokasi_kgtn.`id_musren_lokasi_kgtn` = vw_musren_anggaran_kgtn.`musren_lokasi_kgtn_id`
                    WHERE
                         musren_musrenbang.`tahun` = :tahun
                     AND IF(:kec != '', musren_musrenbang.`kd_wilayah` = :kec, 1)
                     AND IF(:status = '1', musren_kgtn_kec.`status_verifikasi` = '1',
                            IF(:status = '0', musren_kgtn_kec.`status_verifikasi` IN ('','0'), 1))
                     AND IF(:bidang != '', musren_kgtn.`sikd_bidang_id` = :bidang, 1)
                     AND IF(:prioritas != '', musren_kgtn.`prioritas` = :prioritas, 1)
                    GROUP BY
                         musren_musrenbang.`kd_wilayah`,
                         sikd_musren_bidang.`kd_bidang`,
                         musren_lokasi_kgtn.`kd_wilayah`
                    ORDER BY
                         musren_musrenbang.`kd_wilayah` ASC,
                         sikd_musren_bidang.`kd_bidang` ASC,
                         musren_lokasi_kgtn.`kd_wilayah` ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("kec", $kec);
            $statement->bindValue("prioritas", $prioritas);
            $statement->bindValue("bidang", $idBidang);
            $statement->bindValue("status", $status);
            $statement->bindValue("tahun", $tahun);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getMusrenKecListFlowUsulan($request)
    {
        try {
            
            $kec = $request->query->get("kec");
            $prioritas = $request->query->get("prioritas");
            $idBidang = $request->query->get("bidang");
            $status = $request->query->get("status");
            $tahun = $request->query->get("tahun");
            $quota = $request->query->get("quota");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idBidang = pack('H*', str_replace('-', '', trim($idBidang)));
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                         ifnull(substring(vw_appl_kode_wilayah.`kode_wilayah`,7,4),'-') AS vw_appl_kode_wilayah_kode,
                         vw_appl_kode_wilayah.`kode_wilayah` AS vw_appl_kode_wilayah_kode_wilayah,
                         concat(vw_appl_kode_wilayah.`klasifikasi`,' ',vw_appl_kode_wilayah.`nama_wilayah`)AS vw_appl_kode_wilayah_nama_wilayah,
                         musren_musrenbang.`tahun` AS musren_musrenbang_tahun,
                         musren_musrenbang.`kd_wilayah` AS musren_musrenbang_kd_wilayah,
                         sikd_bidang.`kd_bidang` AS sikd_bidang_kd_bidang,
                         sikd_bidang.`nm_bidang` AS sikd_bidang_nm_bidang,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 1, 8),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 9, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 13, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 17, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 21)
                         ) AS musren_kgtn_id_musren_kgtn,
                         musren_kgtn.`kd_kgtn` AS musren_kgtn_kd_kgtn,
                         musren_kgtn.`nm_kgtn` AS musren_kgtn_nm_kgtn,
                         musren_kgtn_kec.`no_urut_usulan` AS musren_kgtn_kec_no_urut_usulan,
                         musren_lokasi_kgtn.`nm_lokasi` AS vw_musren_usulan_kgtn_nm_lokasi_kgtn,
                         musren_lokasi_kgtn.`volume` AS vw_musren_usulan_kgtn_volume,
                         musren_lokasi_kgtn.`satuan` AS vw_musren_usulan_kgtn_satuan,
                         vw_appl_kode_wilayah_A.`klasifikasi` AS vw_appl_kode_wilayah_A_klasifikasi,
                         vw_appl_kode_wilayah_A.`nama_wilayah` AS vw_appl_kode_wilayah_A_nama_wilayah,
                         ifnull((select a.singkatan from sikd_satker a, musren_kgtn b
                                 where b.musren_kgtn_type = 'MusrenKgtnKec'
                                   and b.id_musren_kgtn = musren_kgtn_kec.id_musren_kgtn
                                   and b.sikd_skpd_id = a.id_sikd_satker), '-') AS pelaksana,
                          ifnull((select sum(a.jml_anggaran) 
                                  from musren_lokasi_kgtn a, musren_lokasi_kgtn b
                                  where b.musren_kgtn_id = musren_kgtn_kec.`id_musren_kgtn`
                                    and a.id_musren_lokasi_kgtn = b.`musren_lokasi_kgtn_id`
                                    /*and a.musren_lokasi_kgtn_id = b.id_musren_lokasi_kgtn*/), 0) AS jml_usulan_desa,
                         SUM(vw_musren_anggaran_kgtn.jml_apbd_kab+
                             vw_musren_anggaran_kgtn.jml_apbd_prop+
                             vw_musren_anggaran_kgtn.jml_apbn+
                             vw_musren_anggaran_kgtn.jml_lain) AS jml_usulan_kec,
                          ifnull((select sum(a.jml_anggaran) 
                                  from musren_lokasi_kgtn a inner join musren_kgtn c on a.musren_kgtn_id = c.id_musren_kgtn and c.musren_kgtn_type = 'MusrenKgtnSkpd', musren_lokasi_kgtn b
                                  where b.musren_kgtn_id = musren_kgtn_kec.`id_musren_kgtn`
                                    and a.musren_lokasi_kgtn_id = b.`id_musren_lokasi_kgtn`
                                    /*and a.musren_skpd_lokasi_kgtn_id = b.id_musren_skpd_lokasi_kgtn*/), 0) AS jml_usulan_skpd,
                          ifnull((select sum(a.jml_anggaran) 
                                  from musren_lokasi_kgtn a, musren_lokasi_kgtn b inner join musren_kgtn d on b.musren_kgtn_id = d.id_musren_kgtn and d.musren_kgtn_type = 'MusrenKgtnSkpd', musren_lokasi_kgtn c
                                  where c.musren_kgtn_id = musren_kgtn_kec.`id_musren_kgtn`
                                    and b.musren_lokasi_kgtn_id = c.`id_musren_lokasi_kgtn`
                                    and a.musren_lokasi_kgtn_id = b.`id_musren_lokasi_kgtn`
                                    /*and a.musren_lokasi_kgtn_id = b.id_musren_lokasi_kgtn*/), 0) AS jml_usulan_kota
                    FROM
                         `musren_kgtn` musren_kgtn 
                         INNER JOIN `musren_kgtn` musren_kgtn_kec ON musren_kgtn.`id_musren_kgtn` = musren_kgtn_kec.`id_musren_kgtn` AND musren_kgtn_kec.`musren_kgtn_type` = 'MusrenKgtnKec'
                         INNER JOIN `sikd_satker` sikd_satker ON musren_kgtn_kec.`sikd_skpd_id` = sikd_satker.`id_sikd_satker`
                         INNER JOIN `sikd_bidang` sikd_bidang ON musren_kgtn.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                         INNER JOIN `musren_lokasi_kgtn` musren_lokasi_kgtn ON musren_kgtn.`id_musren_kgtn` = musren_lokasi_kgtn.`musren_kgtn_id`
                         INNER JOIN `vw_musren_anggaran_kgtn` vw_musren_anggaran_kgtn ON musren_lokasi_kgtn.`id_musren_lokasi_kgtn` = vw_musren_anggaran_kgtn.`musren_lokasi_kgtn_id`
                         INNER JOIN `musren_musrenbang` musren_musrenbang ON musren_kgtn.`musren_musrenbang_id` = musren_musrenbang.`id_musren_musrenbang`
                         INNER JOIN `vw_appl_kode_wilayah` vw_appl_kode_wilayah_A ON musren_musrenbang.`kd_wilayah` = vw_appl_kode_wilayah_A.`kode_wilayah`
                         INNER JOIN `vw_appl_kode_wilayah` vw_appl_kode_wilayah ON musren_lokasi_kgtn.`kd_wilayah` = vw_appl_kode_wilayah.`kode_wilayah`
                         INNER JOIN `musren_jns_kgtn` musren_jns_kgtn ON musren_kgtn_kec.`musren_jns_kgtn_id` = musren_jns_kgtn.`id_musren_jns_kgtn`
                    WHERE
                         musren_musrenbang.`tahun` = :tahun
                     AND IF(:kec != '', musren_musrenbang.`kd_wilayah` = :kec, 1)
                     AND IF(:status = '1', musren_kgtn_kec.`status_verifikasi` = '1',
                            IF(:status = '0', musren_kgtn_kec.`status_verifikasi` IN ('','0'), 1))
                     AND IF(:bidang != '', musren_kgtn.`sikd_bidang_id` = :bidang, 1)
                     AND IF(:quota != '', musren_jns_kgtn.`no_jns_kgtn` = :quota, 1)
                     AND IF(:prioritas != '', musren_kgtn.`prioritas` = :prioritas, 1)
                     AND vw_appl_kode_wilayah_A.klasifikasi = 'KEC'
                    GROUP BY
                         sikd_bidang.`kd_bidang`,
                         vw_appl_kode_wilayah.`kode_wilayah`,
                         musren_kgtn_kec.`no_urut_usulan`
                    ORDER BY
                         sikd_bidang.`kd_bidang` ASC,
                         vw_appl_kode_wilayah.`kode_wilayah` ASC,
                         musren_kgtn_kec.`no_urut_usulan` ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("kec", $kec);
            $statement->bindValue("prioritas", $prioritas);
            $statement->bindValue("bidang", $idBidang);
            $statement->bindValue("status", $status);
            $statement->bindValue("tahun", $tahun);
            $statement->bindValue("quota", $quota);
            
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }

    private function getMusrenKecListFlowUsulanSub($request)
    {
        try {
            
            $idMusrenKgtn = $request->query->get("id_musren_kgtn");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idMusrenKgtn = pack('H*', str_replace('-', '', trim($idMusrenKgtn)));
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_lokasi_kgtn.`musren_kgtn_id`), 1, 8),
                        SUBSTR(HEX(musren_lokasi_kgtn.`musren_kgtn_id`), 9, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.`musren_kgtn_id`), 13, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.`musren_kgtn_id`), 17, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.`musren_kgtn_id`), 21)
                         ) AS musren_lokasi_kgtn_musren_kgtn_id,
                         ifnull(musren_lokasi_kgtn.`rt`,'-') AS musren_lokasi_kgtn_rt,
                         ifnull(musren_lokasi_kgtn.`rw`,'-') AS musren_lokasi_kgtn_rw,
                         musren_lokasi_kgtn.`nm_lokasi` AS musren_lokasi_kgtn_nm_lokasi_kgtn,
                         musren_lokasi_kgtn.`volume` AS musren_lokasi_kgtn_volume,
                         ifnull(musren_lokasi_kgtn.`satuan`,'-') AS musren_lokasi_kgtn_satuan,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 1, 8),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 9, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 13, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 17, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 21)
                         ) AS musren_kgtn_id_musren_kgtn,
                         ifnull((select sum(a.jml_anggaran) 
                                 from musren_lokasi_kgtn a, musren_lokasi_kgtn b
                                 where b.id_musren_lokasi_kgtn = musren_lokasi_kgtn.`id_musren_lokasi_kgtn`
                                   and a.id_musren_lokasi_kgtn = b.musren_lokasi_kgtn_id
                                   /*and a.musren_lokasi_kgtn_id = b.id_musren_lokasi_kgtn*/), 0) AS jml_usulan_desa,
                         (vw_musren_anggaran_kgtn.`jml_apbd_kab`+
                          vw_musren_anggaran_kgtn.`jml_apbd_prop`+
                          vw_musren_anggaran_kgtn.`jml_apbn`+
                          vw_musren_anggaran_kgtn.`jml_lain`) AS jml_usulan_kec,
                         ifnull((select sum(a.jml_anggaran) 
                                 from musren_lokasi_kgtn a inner join musren_kgtn c on a.musren_kgtn_id = c.id_musren_kgtn and c.musren_kgtn_type = 'MusrenKgtnSkpd', musren_lokasi_kgtn b
                                 where b.id_musren_lokasi_kgtn = musren_lokasi_kgtn.`id_musren_lokasi_kgtn`
                                   and a.musren_lokasi_kgtn_id = b.`id_musren_lokasi_kgtn`
                                   /*and a.musren_skpd_lokasi_kgtn_id = b.id_musren_skpd_lokasi_kgtn*/), 0) AS jml_usulan_skpd,
                         ifnull((select sum(a.jml_anggaran) 
                                 from musren_lokasi_kgtn a, musren_lokasi_kgtn b inner join musren_kgtn d on b.musren_kgtn_id = d.id_musren_kgtn and d.musren_kgtn_type = 'MusrenKgtnSkpd', musren_lokasi_kgtn c
                                 where c.id_musren_lokasi_kgtn = musren_lokasi_kgtn.`id_musren_lokasi_kgtn`
                                   and b.musren_lokasi_kgtn_id = c.`id_musren_lokasi_kgtn`
                                   and a.musren_lokasi_kgtn_id = b.`id_musren_lokasi_kgtn`
                                   /*and a.musren_lokasi_kgtn_id = b.id_musren_lokasi_kgtn*/), 0) AS jml_usulan_kota
                    FROM
                         `vw_musren_anggaran_kgtn` vw_musren_anggaran_kgtn 
                         RIGHT OUTER JOIN `musren_lokasi_kgtn` musren_lokasi_kgtn ON vw_musren_anggaran_kgtn.`musren_lokasi_kgtn_id` = musren_lokasi_kgtn.`id_musren_lokasi_kgtn`
                         RIGHT OUTER JOIN `musren_kgtn` musren_kgtn ON musren_lokasi_kgtn.`musren_kgtn_id` = musren_kgtn.`id_musren_kgtn`
                    WHERE
                         musren_kgtn.id_musren_kgtn = :id_musren_kgtn

                    ORDER BY
                         musren_lokasi_kgtn.`id_musren_lokasi_kgtn`";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_musren_kgtn", $idMusrenKgtn);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getMusrenKecDelegasi($request)
    {
        try {
            
            $kec = $request->query->get("kec");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_delegasi.`id_musren_delegasi`), 1, 8),
                        SUBSTR(HEX(musren_delegasi.`id_musren_delegasi`), 9, 4),
                        SUBSTR(HEX(musren_delegasi.`id_musren_delegasi`), 13, 4),
                        SUBSTR(HEX(musren_delegasi.`id_musren_delegasi`), 17, 4),
                        SUBSTR(HEX(musren_delegasi.`id_musren_delegasi`), 21)
                         ) AS musren_delegasi_id_musren_delegasi,
                         musren_delegasi.`nm_delegasi` AS musren_delegasi_nm_delegasi,
                         musren_delegasi.`nik` AS musren_delegasi_nik,
                         musren_delegasi.`jns_kelamin` AS musren_delegasi_jns_kelamin,
                         musren_delegasi.`pekerjaan` AS musren_delegasi_pekerjaan,
                         musren_delegasi.`jabatan` AS musren_delegasi_jabatan,
                         musren_delegasi.`no_telp` AS musren_delegasi_no_telp,
                         musren_delegasi.`alamat` AS musren_delegasi_alamat,
                         musren_musrenbang.`kd_wilayah` AS musren_musrenbang_kd_wilayah,
                         musren_musrenbang.`tahun` AS musren_musrenbang_tahun,
                         musren_musrenbang.`tgl_pelaksanaan` AS musren_musrenbang_tgl_pelaksanaan,
                         musren_musrenbang.`lokasi_pelaksanaan` AS musren_musrenbang_lokasi_pelaksanaan,
                         if(vw_appl_kode_wilayah.`klasifikasi` = 'KEC', 'KECAMATAN', '') AS vw_appl_kode_wilayah_klasifikasi,
                         vw_appl_kode_wilayah.`kode_wilayah` AS vw_appl_kode_wilayah_kode_wilayah,
                         vw_appl_kode_wilayah.`klasifikasi` AS vw_appl_kode_wilayah_klasifikasi,
                         vw_appl_kode_wilayah.`nama_wilayah` AS vw_appl_kode_wilayah_nama_wilayah
                    FROM
                         `musren_musrenbang` musren_musrenbang_kec 
                         INNER JOIN `musren_musrenbang` musren_musrenbang ON musren_musrenbang_kec.`id_musren_musrenbang` = musren_musrenbang.`id_musren_musrenbang`
                         INNER JOIN `musren_delegasi` musren_delegasi ON musren_musrenbang.`id_musren_musrenbang` = musren_delegasi.`musren_musrenbang_id`
                         INNER JOIN `vw_appl_kode_wilayah` vw_appl_kode_wilayah ON musren_musrenbang.`kd_wilayah` = vw_appl_kode_wilayah.`kode_wilayah`
                    WHERE
                         musren_musrenbang_kec.`musren_musrenbang_type` = 'MusrenMusrenbangKec'
                        AND IF(:kec != '', musren_musrenbang.`kd_wilayah` = :kec, musren_musrenbang.`kd_wilayah` LIKE '%')
                    ORDER BY
                         vw_appl_kode_wilayah.`kode_wilayah` ASC,
                         musren_delegasi.`id_musren_delegasi` ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("kec", $kec);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getMusrenKecRekapUsulanDesa($request)
    {
        try {
            
            $kec = $request->query->get("kec");
            $status = $request->query->get("status");
            $idBidang = $request->query->get("bidang");
            $prioritas = $request->query->get("prioritas");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idBidang = pack('H*', str_replace('-', '', trim($idBidang)));
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                         vw_appl_kode_wilayah_induk.`kode_wilayah` AS vw_appl_kode_wilayah_induk_kode_wilayah,
                         vw_appl_kode_wilayah_induk.`nama_wilayah` AS vw_appl_kode_wilayah_induk_nama_wilayah,
                         vw_appl_kode_wilayah.`kode_wilayah` AS vw_appl_kode_wilayah_kode_wilayah,
                         vw_appl_kode_wilayah.`klasifikasi` AS vw_appl_kode_wilayah_klasifikasi,
                         vw_appl_kode_wilayah.`nama_wilayah` AS vw_appl_kode_wilayah_nama_wilayah,
                         musren_musrenbang.`tahun` AS musren_musrenbang_tahun,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 1, 8),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 9, 4),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 13, 4),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 17, 4),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 21)
                         ) AS musren_musrenbang_id_musren_musrenbang,
                         musren_musrenbang.`kd_wilayah` AS musren_musrenbang_kd_wilayah,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 1, 8),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 9, 4),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 13, 4),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 17, 4),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 21)
                         ) AS musren_kgtn_sikd_musren_bidang_id,
                         sikd_musren_bidang.`kd_bidang` AS sikd_musren_bidang_kd_bidang,
                         sikd_musren_bidang.`nm_bidang` AS sikd_musren_bidang_nm_bidang,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn_desa.`id_musren_kgtn`), 1, 8),
                        SUBSTR(HEX(musren_kgtn_desa.`id_musren_kgtn`), 9, 4),
                        SUBSTR(HEX(musren_kgtn_desa.`id_musren_kgtn`), 13, 4),
                        SUBSTR(HEX(musren_kgtn_desa.`id_musren_kgtn`), 17, 4),
                        SUBSTR(HEX(musren_kgtn_desa.`id_musren_kgtn`), 21)
                         ) AS musren_kgtn_desa_id_musren_kgtn_desa,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn_desa.`musren_kgtn_kec_id`), 1, 8),
                        SUBSTR(HEX(musren_kgtn_desa.`musren_kgtn_kec_id`), 9, 4),
                        SUBSTR(HEX(musren_kgtn_desa.`musren_kgtn_kec_id`), 13, 4),
                        SUBSTR(HEX(musren_kgtn_desa.`musren_kgtn_kec_id`), 17, 4),
                        SUBSTR(HEX(musren_kgtn_desa.`musren_kgtn_kec_id`), 21)
                         ) AS musren_kgtn_desa_musren_kgtn_kec_id,
                         count(distinct CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn_desa.`id_musren_kgtn`), 1, 8),
                        SUBSTR(HEX(musren_kgtn_desa.`id_musren_kgtn`), 9, 4),
                        SUBSTR(HEX(musren_kgtn_desa.`id_musren_kgtn`), 13, 4),
                        SUBSTR(HEX(musren_kgtn_desa.`id_musren_kgtn`), 17, 4),
                        SUBSTR(HEX(musren_kgtn_desa.`id_musren_kgtn`), 21)
                         ))AS jml_musren_kgtn_desa,
                         count(if(CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn_desa.`musren_kgtn_kec_id`), 1, 8),
                        SUBSTR(HEX(musren_kgtn_desa.`musren_kgtn_kec_id`), 9, 4),
                        SUBSTR(HEX(musren_kgtn_desa.`musren_kgtn_kec_id`), 13, 4),
                        SUBSTR(HEX(musren_kgtn_desa.`musren_kgtn_kec_id`), 17, 4),
                        SUBSTR(HEX(musren_kgtn_desa.`musren_kgtn_kec_id`), 21)
                         ) = '', null, 'x')) AS jml_musren_kgtn_desa_disetujui,
                         sum((vw_musren_anggaran_kgtn.jml_apbd_kab+
                              vw_musren_anggaran_kgtn.jml_apbd_prop+
                              vw_musren_anggaran_kgtn.jml_apbn+
                              vw_musren_anggaran_kgtn.jml_sumber_lain)) AS jml_apbd_kab,
                        ifnull((select sum(a.jml_anggaran) 
                                  from musren_lokasi_kgtn a, musren_kgtn b, musren_lokasi_kgtn c
                                  where c.kd_wilayah = vw_appl_kode_wilayah.`kode_wilayah`
                                    and b.id_musren_kgtn = c.musren_kgtn_id
                                    and b.sikd_bidang_id = sikd_musren_bidang.`id_sikd_bidang`
                                    and a.musren_lokasi_kgtn_id = c.`id_musren_lokasi_kgtn`
                                    /*and a.musren_lokasi_kgtn_id = b.id_musren_lokasi_kgtn*/), 0) AS jml_anggaran_disetujui
                    FROM
                         `musren_musrenbang` musren_musrenbang 
                         INNER JOIN `musren_musrenbang` musren_musrenbang_desa ON musren_musrenbang.`id_musren_musrenbang` = musren_musrenbang_desa.`id_musren_musrenbang` AND musren_musrenbang_desa.`musren_musrenbang_type` = 'MusrenMusrenbangDesa'
                         INNER JOIN `vw_appl_kode_wilayah` vw_appl_kode_wilayah ON musren_musrenbang.`kd_wilayah` = vw_appl_kode_wilayah.`kode_wilayah`
                         INNER JOIN `vw_appl_kode_wilayah_induk` vw_appl_kode_wilayah_induk ON vw_appl_kode_wilayah.`kode_induk` = vw_appl_kode_wilayah_induk.`kode_wilayah`
                         INNER JOIN `musren_kgtn` musren_kgtn ON musren_musrenbang_desa.`id_musren_musrenbang` = musren_kgtn.`musren_musrenbang_id`
                         INNER JOIN `musren_kgtn` musren_kgtn_desa ON musren_kgtn.`id_musren_kgtn` = musren_kgtn_desa.`id_musren_kgtn` AND musren_kgtn_desa.`musren_kgtn_type` = 'MusrenKgtnDesa'
                         INNER JOIN `sikd_bidang` sikd_musren_bidang ON musren_kgtn.`sikd_bidang_id` = sikd_musren_bidang.`id_sikd_bidang`
                         INNER JOIN `musren_lokasi_kgtn` musren_lokasi_kgtn ON musren_kgtn_desa.`id_musren_kgtn` = musren_lokasi_kgtn.`musren_kgtn_id`
                         INNER JOIN `vw_musren_anggaran_kgtn_desa` vw_musren_anggaran_kgtn ON musren_lokasi_kgtn.`id_musren_lokasi_kgtn` = vw_musren_anggaran_kgtn.`musren_lokasi_kgtn_id`
                    WHERE
                         vw_appl_kode_wilayah_induk.klasifikasi = 'KEC'
                     AND IF(:kec!='', vw_appl_kode_wilayah_induk.`kode_wilayah` = :kec, 1)
                     AND IF(:status = '1', musren_kgtn_desa.`status_verifikasi` = '1',
                            IF(:status = '0', musren_kgtn_desa.`status_verifikasi` IN ('','0'), 1))
                     AND IF(:bidang!='', musren_kgtn.`sikd_bidang_id` = :bidang, 1)
                     AND IF(:prioritas!='', musren_kgtn.`prioritas` = :prioritas, 1)
                    GROUP BY
                         vw_appl_kode_wilayah_induk.`kode_wilayah`,
                         sikd_musren_bidang.`kd_bidang`,
                         vw_appl_kode_wilayah.`kode_wilayah`
                    ORDER BY
                         vw_appl_kode_wilayah_induk.`kode_wilayah` ASC,
                         sikd_musren_bidang.`kd_bidang` ASC,
                         vw_appl_kode_wilayah.`kode_wilayah` ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("kec", $kec);
            $statement->bindValue("status", $status);
            $statement->bindValue("bidang", $idBidang);
            $statement->bindValue("prioritas", $prioritas);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getMusrenKecListKgtnSkpdStj($request)
    {
        try {
            
            $kec = $request->query->get("kec");
            $status = $request->query->get("status");
            $idBidang = $request->query->get("bidang");
            $prioritas = $request->query->get("prioritas");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idBidang = pack('H*', str_replace('-', '', trim($idBidang)));
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
                         sikd_satker.`singkatan` AS sikd_satker_singkatan,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 1, 8),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 9, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 13, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 17, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 21)
                         ) AS musren_kgtn_id_musren_kgtn,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 1, 8),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 9, 4),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 13, 4),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 17, 4),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 21)
                         ) AS musren_kgtn_sikd_musren_bidang_id,
                         sikd_musren_bidang.`kd_bidang` AS sikd_musren_bidang_kd_bidang,
                         sikd_musren_bidang.`nm_bidang` AS sikd_musren_bidang_nm_bidang,
                         musren_kgtn.`nm_kgtn` AS musren_kgtn_nm_kgtn,
                         musren_kgtn.`nm_subkgtn` AS musren_kgtn_nm_subkgtn,
                         musren_kgtn.`prioritas` AS musren_kgtn_prioritas,
                         musren_kgtn.`sifat_kgtn` AS musren_kgtn_sifat_kgtn,
                         musren_kgtn.`output` AS musren_kgtn_output,
                         musren_kgtn.`outcome` AS musren_kgtn_outcome,
                         musren_kgtn_kec.`no_urut_usulan` AS musren_kgtn_kec_no_urut_usulan,
                         ifnull((select sum(a.jml_anggaran) 
                                 from musren_lokasi_kgtn a inner join musren_kgtn c on a.musren_kgtn_id = c.id_musren_kgtn and c.musren_kgtn_type = 'MusrenKgtnSkpd', musren_lokasi_kgtn b
                                 where b.musren_kgtn_id = musren_kgtn_kec.id_musren_kgtn
                                   and a.musren_lokasi_kgtn_id = b.id_musren_lokasi_kgtn
                                   /*and a.musren_skpd_lokasi_kgtn_id = b.id_musren_skpd_lokasi_kgtn*/), 0) AS musren_kgtn_anggaran_disetujui,
                         musren_lokasi_kgtn.`nm_lokasi` AS musren_lokasi_kgtn_nm_lokasi_kgtn,
                         musren_lokasi_kgtn.`volume` AS musren_lokasi_kgtn_volume,
                         SUM(IF(musren_kgtn_kec.musren_kgtn_skpd_id='', 0 ,
                                vw_musren_anggaran_kgtn.jml_apbd_kab+
                                vw_musren_anggaran_kgtn.jml_apbd_prop+
                                vw_musren_anggaran_kgtn.jml_apbn+
                                vw_musren_anggaran_kgtn.jml_lain)) AS vw_musren_anggaran_kgtn_jml_usulan,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 1, 8),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 9, 4),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 13, 4),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 17, 4),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 21)
                         ) AS musren_musrenbang_id_musren_musrenbang,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_musrenbang_kec.`id_musren_musrenbang`), 1, 8),
                        SUBSTR(HEX(musren_musrenbang_kec.`id_musren_musrenbang`), 9, 4),
                        SUBSTR(HEX(musren_musrenbang_kec.`id_musren_musrenbang`), 13, 4),
                        SUBSTR(HEX(musren_musrenbang_kec.`id_musren_musrenbang`), 17, 4),
                        SUBSTR(HEX(musren_musrenbang_kec.`id_musren_musrenbang`), 21)
                         ) AS musren_musrenbang_kec_id_musren_muskec,
                         musren_musrenbang.`tahun` AS musren_musrenbang_tahun,
                         musren_musrenbang.`kd_wilayah` AS musren_musrenbang_kd_wilayah,
                         ifnull(substring(vw_appl_kode_wilayah.`kode_wilayah`,7,4),'-') AS vw_appl_kode_wilayah_kode,
                         concat(vw_appl_kode_wilayah.`klasifikasi`,' ',vw_appl_kode_wilayah.`nama_wilayah`)AS vw_appl_kode_wilayah_nama_wilayah,
                         vw_appl_kode_wilayah_A.`klasifikasi` AS vw_appl_kode_wilayah_A_klasifikasi,
                         vw_appl_kode_wilayah_A.`nama_wilayah` AS vw_appl_kode_wilayah_A_nama_wilayah
                    FROM
                         `musren_kgtn` musren_kgtn_kec 
                         INNER JOIN `sikd_satker` sikd_satker ON musren_kgtn_kec.`sikd_skpd_id` = sikd_satker.`id_sikd_satker`
                         -- INNER JOIN `musren_kgtn` musren_skpd_kgtn ON musren_kgtn_kec.`musren_kgtn_skpd_id` = musren_skpd_kgtn.`id_musren_kgtn` AND musren_skpd_kgtn.`musren_kgtn_type` = 'MusrenKgtnSkpd'
                         INNER JOIN `musren_kgtn` musren_kgtn ON musren_kgtn_kec.`id_musren_kgtn` = musren_kgtn.`id_musren_kgtn`
                         INNER JOIN `musren_musrenbang` musren_musrenbang ON musren_kgtn.`musren_musrenbang_id` = musren_musrenbang.`id_musren_musrenbang`
                         INNER JOIN `sikd_bidang` sikd_musren_bidang ON musren_kgtn.`sikd_bidang_id` = sikd_musren_bidang.`id_sikd_bidang`
                         INNER JOIN `musren_lokasi_kgtn` musren_lokasi_kgtn ON musren_kgtn.`id_musren_kgtn` = musren_lokasi_kgtn.`musren_kgtn_id`
                         INNER JOIN `vw_musren_anggaran_kgtn` vw_musren_anggaran_kgtn ON musren_lokasi_kgtn.`id_musren_lokasi_kgtn` = vw_musren_anggaran_kgtn.`musren_lokasi_kgtn_id`
                         INNER JOIN `musren_musrenbang` musren_musrenbang_kec ON musren_musrenbang.`id_musren_musrenbang` = musren_musrenbang_kec.`id_musren_musrenbang` AND musren_musrenbang_kec.`musren_musrenbang_type` = 'MusrenMusrenbangKec'
                         INNER JOIN `vw_appl_kode_wilayah` vw_appl_kode_wilayah_A ON musren_musrenbang.`kd_wilayah` = vw_appl_kode_wilayah_A.`kode_wilayah`
                         INNER JOIN `vw_appl_kode_wilayah` vw_appl_kode_wilayah ON musren_lokasi_kgtn.`kd_wilayah` = vw_appl_kode_wilayah.`kode_wilayah`
                    WHERE
                        musren_kgtn_kec.`musren_kgtn_type` = 'MusrenKgtnKec'
                     AND IF(:kec != '', musren_musrenbang.`kd_wilayah` = :kec, 1)
                     AND IF(:status = '1', musren_kgtn_kec.`status_verifikasi` = '1',
                            IF(:status = '0', musren_kgtn_kec.`status_verifikasi` IN ('','0'), 1))
                     AND IF(:bidang != '', sikd_musren_bidang.`id_sikd_bidang` = :bidang, 1)
                     AND IF(:prioritas != '', musren_kgtn.`prioritas` = :prioritas, 1)
                     AND vw_appl_kode_wilayah_A.klasifikasi = 'KEC'
                    GROUP BY
                         musren_musrenbang.`kd_wilayah`,
                         sikd_musren_bidang.kd_bidang,
                         vw_appl_kode_wilayah.`kode_wilayah`,
                         musren_kgtn_kec.`no_urut_usulan`
                    HAVING (musren_kgtn_anggaran_disetujui > 0)

                    ORDER BY
                         musren_musrenbang.`kd_wilayah` ASC,
                         sikd_musren_bidang.kd_bidang ASC,
                         vw_appl_kode_wilayah.`kode_wilayah` ASC,
                         musren_kgtn_kec.`no_urut_usulan` ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("kec", $kec);
            $statement->bindValue("status", $status);
            $statement->bindValue("bidang", $idBidang);
            $statement->bindValue("prioritas", $prioritas);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getMusrenKecListKgtnSkpdStjSub($request)
    {
        try {
            
            $idMusrenKgtn = $request->query->get("id_musren_kgtn");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idMusrenKgtn = pack('H*', str_replace('-', '', trim($idMusrenKgtn)));
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_lokasi_kgtn.`musren_kgtn_id`), 1, 8),
                        SUBSTR(HEX(musren_lokasi_kgtn.`musren_kgtn_id`), 9, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.`musren_kgtn_id`), 13, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.`musren_kgtn_id`), 17, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.`musren_kgtn_id`), 21)
                         ) AS musren_lokasi_kgtn_musren_kgtn_id,
                         musren_lokasi_kgtn.`nm_lokasi` AS musren_lokasi_kgtn_nm_lokasi_kgtn,
                         ifnull(musren_lokasi_kgtn.`rt`,'-') AS musren_lokasi_kgtn_rt,
                         ifnull(musren_lokasi_kgtn.`rw`,'-') AS musren_lokasi_kgtn_rw,
                         musren_lokasi_kgtn.`volume` AS musren_lokasi_kgtn_volume,
                         musren_lokasi_kgtn.`satuan` AS musren_lokasi_kgtn_satuan,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 1, 8),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 9, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 13, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 17, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 21)
                         ) AS musren_kgtn_id_musren_kgtn,
                         (vw_musren_anggaran_kgtn.jml_apbd_kab+
                          vw_musren_anggaran_kgtn.jml_apbd_prop+
                          vw_musren_anggaran_kgtn.jml_apbn+
                          vw_musren_anggaran_kgtn.jml_lain) AS jml_usulan,
                          ifnull((select sum(a.jml_anggaran) 
                                  from musren_lokasi_kgtn a inner join musren_kgtn b on a.musren_kgtn_id = b.id_musren_kgtn and b.musren_kgtn_type = 'MusrenKgtnSkpd'
                                  where a.musren_lokasi_kgtn_id = musren_lokasi_kgtn.`id_musren_lokasi_kgtn`
                                    /*and a.musren_skpd_lokasi_kgtn_id = b.id_musren_skpd_lokasi_kgtn*/), 0) AS jml_disetujui
                    FROM
                         `musren_lokasi_kgtn` musren_lokasi_kgtn 
                         INNER JOIN `musren_kgtn` musren_kgtn ON musren_lokasi_kgtn.`musren_kgtn_id` = musren_kgtn.`id_musren_kgtn`
                         INNER JOIN `vw_musren_anggaran_kgtn` vw_musren_anggaran_kgtn ON musren_lokasi_kgtn.`id_musren_lokasi_kgtn` = vw_musren_anggaran_kgtn.`musren_lokasi_kgtn_id`
                    WHERE
                         musren_kgtn.id_musren_kgtn = :id_musren_kgtn

                    ORDER BY
                         musren_lokasi_kgtn.`id_musren_lokasi_kgtn` ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_musren_kgtn", $idMusrenKgtn);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }

    private function getMusrenKecListKgtnKotaStj($request)
    {
        try {
            
            $kec = $request->query->get("kec");
            $status = $request->query->get("status");
            $idBidang = $request->query->get("bidang");
            $prioritas = $request->query->get("prioritas");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idBidang = pack('H*', str_replace('-', '', trim($idBidang)));
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
                         sikd_satker.`singkatan` AS sikd_satker_singkatan,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 1, 8),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 9, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 13, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 17, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 21)
                         ) AS musren_kgtn_id_musren_kgtn,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 1, 8),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 9, 4),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 13, 4),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 17, 4),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 21)
                         ) AS musren_kgtn_sikd_musren_bidang_id,
                         sikd_musren_bidang.`kd_bidang` AS sikd_musren_bidang_kd_bidang,
                         sikd_musren_bidang.`nm_bidang` AS sikd_musren_bidang_nm_bidang,
                         musren_kgtn.`nm_kgtn` AS musren_kgtn_nm_kgtn,
                         musren_kgtn.`nm_subkgtn` AS musren_kgtn_nm_subkgtn,
                         musren_kgtn.`prioritas` AS musren_kgtn_prioritas,
                         musren_kgtn.`sifat_kgtn` AS musren_kgtn_sifat_kgtn,
                         musren_kgtn.`output` AS musren_kgtn_output,
                         musren_kgtn.`outcome` AS musren_kgtn_outcome,
                         musren_kgtn_kec.`no_urut_usulan` AS musren_kgtn_kec_no_urut_usulan,
                         ifnull((select sum(a.jml_anggaran) 
                                 from musren_lokasi_kgtn a, musren_lokasi_kgtn b inner join musren_kgtn d on b.musren_kgtn_id = d.id_musren_kgtn and d.musren_kgtn_type = 'MusrenKgtnSkpd', musren_lokasi_kgtn c
                                 where c.musren_kgtn_id = musren_kgtn_kec.id_musren_kgtn
                                   and b.musren_lokasi_kgtn_id = c.id_musren_lokasi_kgtn
                                   and a.musren_lokasi_kgtn_id = b.id_musren_lokasi_kgtn
                                   /*and a.musren_lokasi_kgtn_id = b.id_musren_lokasi_kgtn*/), 0) AS musren_kgtn_anggaran_disetujui,
                         musren_lokasi_kgtn.`nm_lokasi` AS musren_lokasi_kgtn_nm_lokasi_kgtn,
                         musren_lokasi_kgtn.`volume` AS musren_lokasi_kgtn_volume,
                         SUM(IF(musren_kgtn_kec.musren_kgtn_skpd_id='', 0 ,
                                vw_musren_anggaran_kgtn.jml_apbd_kab+
                                vw_musren_anggaran_kgtn.jml_apbd_prop+
                                vw_musren_anggaran_kgtn.jml_apbn+
                                vw_musren_anggaran_kgtn.jml_lain)) AS vw_musren_anggaran_kgtn_jml_usulan,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 1, 8),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 9, 4),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 13, 4),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 17, 4),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 21)
                         ) AS musren_musrenbang_id_musren_musrenbang,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_musrenbang_kec.`id_musren_musrenbang`), 1, 8),
                        SUBSTR(HEX(musren_musrenbang_kec.`id_musren_musrenbang`), 9, 4),
                        SUBSTR(HEX(musren_musrenbang_kec.`id_musren_musrenbang`), 13, 4),
                        SUBSTR(HEX(musren_musrenbang_kec.`id_musren_musrenbang`), 17, 4),
                        SUBSTR(HEX(musren_musrenbang_kec.`id_musren_musrenbang`), 21)
                         ) AS musren_musrenbang_kec_id_musren_muskec,
                         musren_musrenbang.`tahun` AS musren_musrenbang_tahun,
                         musren_musrenbang.`kd_wilayah` AS musren_musrenbang_kd_wilayah,
                         ifnull(substring(vw_appl_kode_wilayah.`kode_wilayah`,7,4),'-') AS vw_appl_kode_wilayah_kode,
                         concat(vw_appl_kode_wilayah.`klasifikasi`,' ',vw_appl_kode_wilayah.`nama_wilayah`)AS vw_appl_kode_wilayah_nama_wilayah,
                         vw_appl_kode_wilayah_A.`klasifikasi` AS vw_appl_kode_wilayah_A_klasifikasi,
                         vw_appl_kode_wilayah_A.`nama_wilayah` AS vw_appl_kode_wilayah_A_nama_wilayah
                    FROM
                         `musren_kgtn` musren_kgtn_kec 
                         INNER JOIN `sikd_satker` sikd_satker ON musren_kgtn_kec.`sikd_skpd_id` = sikd_satker.`id_sikd_satker`
                         INNER JOIN `musren_kgtn` musren_kgtn ON musren_kgtn_kec.`id_musren_kgtn` = musren_kgtn.`id_musren_kgtn`
                         -- INNER JOIN `musren_kgtn` musren_skpd_kgtn ON musren_kgtn_kec.`musren_kgtn_skpd_id` = musren_skpd_kgtn.`id_musren_kgtn` AND musren_skpd_kgtn.`musren_kgtn_type` = 'MusrenKgtnSkpd'
                         INNER JOIN `musren_musrenbang` musren_musrenbang ON musren_kgtn.`musren_musrenbang_id` = musren_musrenbang.`id_musren_musrenbang`
                         INNER JOIN `sikd_bidang` sikd_musren_bidang ON musren_kgtn.`sikd_bidang_id` = sikd_musren_bidang.`id_sikd_bidang`
                         INNER JOIN `musren_lokasi_kgtn` musren_lokasi_kgtn ON musren_kgtn.`id_musren_kgtn` = musren_lokasi_kgtn.`musren_kgtn_id`
                         INNER JOIN `vw_musren_anggaran_kgtn` vw_musren_anggaran_kgtn ON musren_lokasi_kgtn.`id_musren_lokasi_kgtn` = vw_musren_anggaran_kgtn.`musren_lokasi_kgtn_id`
                         INNER JOIN `musren_musrenbang` musren_musrenbang_kec ON musren_musrenbang.`id_musren_musrenbang` = musren_musrenbang_kec.`id_musren_musrenbang` AND musren_musrenbang_kec.`musren_musrenbang_type` = 'MusrenMusrenbangKec'
                         INNER JOIN `vw_appl_kode_wilayah` vw_appl_kode_wilayah_A ON musren_musrenbang.`kd_wilayah` = vw_appl_kode_wilayah_A.`kode_wilayah`
                         INNER JOIN `vw_appl_kode_wilayah` vw_appl_kode_wilayah ON musren_lokasi_kgtn.`kd_wilayah` = vw_appl_kode_wilayah.`kode_wilayah`
                    WHERE
                        musren_kgtn_kec.`musren_kgtn_type` = 'MusrenKgtnKec'
                     AND IF(:kec != '', musren_musrenbang.`kd_wilayah` = :kec, 1)
                     AND IF(:status = '1', musren_kgtn_kec.`status_verifikasi` = '1',
                            IF(:status = '0', musren_kgtn_kec.`status_verifikasi` IN ('','0'), 1))
                     AND IF(:bidang != '', sikd_musren_bidang.`id_sikd_bidang` = :bidang, 1)
                     AND IF(:prioritas != '', musren_kgtn.`prioritas` = :prioritas, 1)
                     AND vw_appl_kode_wilayah_A.klasifikasi = 'KEC'

                    GROUP BY
                         musren_musrenbang.`kd_wilayah`,
                         sikd_musren_bidang.kd_bidang,
                         vw_appl_kode_wilayah.`kode_wilayah`,
                         musren_kgtn_kec.`no_urut_usulan`
                    HAVING (musren_kgtn_anggaran_disetujui > 0)
                    ORDER BY
                         musren_musrenbang.`kd_wilayah` ASC,
                         sikd_musren_bidang.kd_bidang ASC,
                         vw_appl_kode_wilayah.`kode_wilayah` ASC,
                         musren_kgtn_kec.`no_urut_usulan` ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("kec", $kec);
            $statement->bindValue("status", $status);
            $statement->bindValue("bidang", $idBidang);
            $statement->bindValue("prioritas", $prioritas);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }

    private function getMusrenKecListKgtnKotaStjSub($request)
    {
        try {
            
            $idMusrenKgtn = $request->query->get("id_musren_kgtn");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idMusrenKgtn = pack('H*', str_replace('-', '', trim($idMusrenKgtn)));
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_lokasi_kgtn.`musren_kgtn_id`), 1, 8),
                        SUBSTR(HEX(musren_lokasi_kgtn.`musren_kgtn_id`), 9, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.`musren_kgtn_id`), 13, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.`musren_kgtn_id`), 17, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.`musren_kgtn_id`), 21)
                         ) AS musren_lokasi_kgtn_musren_kgtn_id,
                         musren_lokasi_kgtn.`nm_lokasi` AS musren_lokasi_kgtn_nm_lokasi_kgtn,
                         ifnull(musren_lokasi_kgtn.`rt`,'-') AS musren_lokasi_kgtn_rt,
                         ifnull(musren_lokasi_kgtn.`rw`,'-') AS musren_lokasi_kgtn_rw,
                         musren_lokasi_kgtn.`volume` AS musren_lokasi_kgtn_volume,
                         musren_lokasi_kgtn.`satuan` AS musren_lokasi_kgtn_satuan,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 1, 8),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 9, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 13, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 17, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 21)
                         ) AS musren_kgtn_id_musren_kgtn,
                         (vw_musren_anggaran_kgtn.jml_apbd_kab+
                          vw_musren_anggaran_kgtn.jml_apbd_prop+
                          vw_musren_anggaran_kgtn.jml_apbn+
                          vw_musren_anggaran_kgtn.jml_lain) AS jml_usulan,
                          ifnull((select sum(a.jml_anggaran) 
                                  from musren_lokasi_kgtn a, musren_lokasi_kgtn b inner join musren_kgtn c on b.musren_kgtn_id = c.id_musren_kgtn and c.musren_kgtn_type = 'MusrenKgtnSkpd'
                                  where b.musren_lokasi_kgtn_id = musren_lokasi_kgtn.`id_musren_lokasi_kgtn`
                                    and a.musren_lokasi_kgtn_id = b.`id_musren_lokasi_kgtn`
                                    /*and a.musren_lokasi_kgtn_id = b.id_musren_lokasi_kgtn*/), 0) AS jml_disetujui
                    FROM
                         `musren_lokasi_kgtn` musren_lokasi_kgtn 
                         INNER JOIN `musren_kgtn` musren_kgtn ON musren_lokasi_kgtn.`musren_kgtn_id` = musren_kgtn.`id_musren_kgtn`
                         INNER JOIN `vw_musren_anggaran_kgtn` vw_musren_anggaran_kgtn ON musren_lokasi_kgtn.`id_musren_lokasi_kgtn` = vw_musren_anggaran_kgtn.`musren_lokasi_kgtn_id`
                    WHERE
                         musren_kgtn.id_musren_kgtn = :id_musren_kgtn

                    ORDER BY
                         musren_lokasi_kgtn.`id_musren_lokasi_kgtn` ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_musren_kgtn", $idMusrenKgtn);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    //RESES DEWAN
    private function getMusrenResesListKgtn($request)
    {
        try {

            $idSkpd = $request->query->get("id_skpd");
            $idSubSkpd = $request->query->get("id_subskpd");
            $idBidang = $request->query->get("id_bidang");
            $prioritas = $request->query->get("prioritas");
            $tahun = $request->query->get("tahun");
            $idFraksi = $request->query->get("id_fraksi");
            $quota = $request->query->get("quota");
            $userGroup = $request->query->get("user_group");
            $userName = $request->query->get("user_name");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idSkpd = pack('H*', str_replace('-', '', trim($idSkpd)));
            $idSubSkpd = pack('H*', str_replace('-', '', trim($idSubSkpd)));
            $idBidang = pack('H*', str_replace('-', '', trim($idBidang)));
            $idFraksi = pack('H*', str_replace('-', '', trim($idFraksi)));
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                         musren_kgtn_reses.`created_by` AS musren_kgtn_created_by,
                         musren_kgtn_reses.`nm_pengusul` AS musren_kgtn_nm_pengusul,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 1, 8),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 9, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 13, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 17, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 21)
                         ) AS musren_kgtn_id_musren_kgtn,
                         musren_kgtn.`nm_kgtn` AS musren_kgtn_nm_kgtn,
                         musren_kgtn.`prioritas` AS musren_kgtn_prioritas,
                         musren_kgtn.`sifat_kgtn` AS musren_kgtn_sifat_kgtn,
                         musren_kgtn.`output` AS musren_kgtn_output,
                         musren_kgtn.`outcome` AS musren_kgtn_outcome,
                        CONCAT_WS('-',
                        SUBSTR(HEX(sikd_musren_bidang.`id_sikd_bidang`), 1, 8),
                        SUBSTR(HEX(sikd_musren_bidang.`id_sikd_bidang`), 9, 4),
                        SUBSTR(HEX(sikd_musren_bidang.`id_sikd_bidang`), 13, 4),
                        SUBSTR(HEX(sikd_musren_bidang.`id_sikd_bidang`), 17, 4),
                        SUBSTR(HEX(sikd_musren_bidang.`id_sikd_bidang`), 21)
                         ) AS sikd_musren_bidang_id_sikd_musren_bidang,
                         sikd_musren_bidang.`kd_bidang` AS sikd_musren_bidang_kd_bidang,
                         sikd_musren_bidang.`nm_bidang` AS sikd_musren_bidang_nm_bidang,
                         musren_fraksi.`nm_fraksi` AS musren_fraksi_nm_fraksi,
                         musren_fraksi.`singkatan` AS musren_fraksi_singkatan,
                         sikd_satker.`kode` AS sikd_satker_kode,
                         sikd_satker.`nama` AS sikd_satker_nama,
                         sikd_sub_skpd.`kode` AS sikd_sub_skpd_kode,
                         sikd_sub_skpd.`nama` AS sikd_sub_skpd_nama,
                         musren_musrenbang.`kd_wilayah` AS musren_musrenbang_kd_wilayah,
                         musren_lokasi_kgtn.`nm_lokasi` AS musren_lokasi_kgtn_nm_lokasi,
                         ifnull(musren_lokasi_kgtn.`rt`,'-') AS musren_lokasi_kgtn_rt,
                         ifnull(musren_lokasi_kgtn.`rw`,'-') AS musren_lokasi_kgtn_rw,
                         ifnull(vw_appl_kode_wilayah.`nama_wilayah`,'') AS musren_lokasi_kgtn_nm_wilayah,
                         musren_lokasi_kgtn.`volume` AS musren_lokasi_kgtn_volume,
                         musren_lokasi_kgtn.`satuan` AS musren_lokasi_kgtn_satuan,
                         vw_musren_anggaran_kgtn.`jml_apbd_kab` AS vw_musren_anggaran_kgtn_jml_apbd_kab,
                         vw_musren_anggaran_kgtn.`jml_apbd_prop` AS vw_musren_anggaran_kgtn_jml_apbd_prop,
                         vw_musren_anggaran_kgtn.`jml_lain` AS vw_musren_anggaran_kgtn_jml_lain,
                         vw_musren_anggaran_kgtn.`jml_apbn` AS vw_musren_anggaran_kgtn_ttl_jml_apbn
                    FROM
                         `musren_kgtn` musren_kgtn 
                         INNER JOIN `musren_kgtn` musren_kgtn_reses ON musren_kgtn.`id_musren_kgtn` = musren_kgtn_reses.`id_musren_kgtn` AND musren_kgtn_reses.`musren_kgtn_type` = 'MusrenKgtnDprd'
                         INNER JOIN `musren_fraksi_dprd` musren_fraksi ON musren_kgtn_reses.`musren_fraksi_dprd_id` = musren_fraksi.`id_musren_fraksi_dprd`
                         INNER JOIN `sikd_satker` sikd_satker ON musren_kgtn_reses.`sikd_skpd_id` = sikd_satker.`id_sikd_satker`
                         LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON musren_kgtn_reses.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                         INNER JOIN `sikd_bidang` sikd_musren_bidang ON musren_kgtn.`sikd_bidang_id` = sikd_musren_bidang.`id_sikd_bidang`
                         INNER JOIN `musren_lokasi_kgtn` musren_lokasi_kgtn ON musren_kgtn.`id_musren_kgtn` = musren_lokasi_kgtn.`musren_kgtn_id`
                         LEFT OUTER JOIN `vw_musren_anggaran_kgtn` vw_musren_anggaran_kgtn ON musren_lokasi_kgtn.`id_musren_lokasi_kgtn` = vw_musren_anggaran_kgtn.`musren_lokasi_kgtn_id`
                         INNER JOIN `musren_musrenbang` musren_musrenbang ON musren_kgtn.`musren_musrenbang_id` = musren_musrenbang.`id_musren_musrenbang`
                         LEFT OUTER JOIN `vw_appl_kode_wilayah` vw_appl_kode_wilayah ON musren_lokasi_kgtn.`kd_wilayah` = vw_appl_kode_wilayah.`kode_wilayah`
                         INNER JOIN `musren_jns_kgtn` musren_jns_kgtn ON musren_kgtn.`musren_jns_kgtn_id` = musren_jns_kgtn.`id_musren_jns_kgtn`
                    WHERE
                         musren_musrenbang.`tahun` = :tahun
                     AND IF(:id_fraksi != '', musren_kgtn_reses.`musren_fraksi_dprd_id` = :id_fraksi, 1)
                     AND IF(:id_skpd != '', musren_kgtn_reses.`sikd_skpd_id` = :id_skpd, 1)
                     AND IF(:id_subskpd != '', musren_kgtn_reses.`sikd_sub_skpd_id` = :id_subskpd, 1)
                     AND IF(:id_bidang != '', musren_kgtn.`sikd_bidang_id` = :id_bidang, 1)
                     AND IF(:prioritas != '', musren_kgtn.`prioritas` = :prioritas, 1)
                     AND IF(:quota != '', musren_jns_kgtn.`no_jns_kgtn` = :quota, 1)
                     AND IF(:user_group = 'Musrenbang DPRD', musren_kgtn_reses.`created_by` = :user_name, 1)
                    ORDER BY
                         musren_kgtn_reses.`created_by` ASC,
                         musren_fraksi.`nm_fraksi` ASC,
                         sikd_satker.`kode` ASC,
                         sikd_musren_bidang.kd_bidang ASC,
                         musren_kgtn.`id_musren_kgtn` ASC,
                         musren_lokasi_kgtn.`id_musren_lokasi_kgtn`";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_skpd", $idSkpd);
            $statement->bindValue("id_subskpd", $idSubSkpd);
            $statement->bindValue("id_bidang", $idBidang);
            $statement->bindValue("prioritas", $prioritas);
            $statement->bindValue("tahun", $tahun);
            $statement->bindValue("id_fraksi", $idFraksi);
            $statement->bindValue("quota", $quota);
            $statement->bindValue("user_group", $userGroup);
            $statement->bindValue("user_name", $userName);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getMusrenResesRekapLokasi($request)
    {
        try {

            $idSkpd = $request->query->get("id_skpd");
            $idSubSkpd = $request->query->get("id_subskpd");
            $idBidang = $request->query->get("id_bidang");
            $prioritas = $request->query->get("prioritas");
            $tahun = $request->query->get("tahun");
            $quota = $request->query->get("quota");
            $userGroup = $request->query->get("user_group");
            $userName = $request->query->get("user_name");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idSkpd = pack('H*', str_replace('-', '', trim($idSkpd)));
            $idSubSkpd = pack('H*', str_replace('-', '', trim($idSubSkpd)));
            $idBidang = pack('H*', str_replace('-', '', trim($idBidang)));
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                         musren_kgtn_reses.`created_by` AS musren_kgtn_created_by,
                         musren_kgtn_reses.`nm_pengusul` AS musren_kgtn_nm_pengusul,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 1, 8),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 9, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 13, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 17, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 21)
                         ) AS musren_kgtn_id_musren_kgtn,
                         musren_kgtn.`nm_kgtn` AS musren_kgtn_nm_kgtn,
                         musren_kgtn.`prioritas` AS musren_kgtn_prioritas,
                         musren_kgtn.`sifat_kgtn` AS musren_kgtn_sifat_kgtn,
                         musren_kgtn.`output` AS musren_kgtn_output,
                         musren_kgtn.`outcome` AS musren_kgtn_outcome,
                        CONCAT_WS('-',
                        SUBSTR(HEX(sikd_musren_bidang.`id_sikd_bidang`), 1, 8),
                        SUBSTR(HEX(sikd_musren_bidang.`id_sikd_bidang`), 9, 4),
                        SUBSTR(HEX(sikd_musren_bidang.`id_sikd_bidang`), 13, 4),
                        SUBSTR(HEX(sikd_musren_bidang.`id_sikd_bidang`), 17, 4),
                        SUBSTR(HEX(sikd_musren_bidang.`id_sikd_bidang`), 21)
                         ) AS sikd_musren_bidang_id_sikd_musren_bidang,
                         sikd_musren_bidang.`kd_bidang` AS sikd_musren_bidang_kd_bidang,
                         sikd_musren_bidang.`nm_bidang` AS sikd_musren_bidang_nm_bidang,
                         musren_fraksi.`nm_fraksi` AS musren_fraksi_nm_fraksi,
                         musren_fraksi.`singkatan` AS musren_fraksi_singkatan,
                         sikd_satker.`kode` AS sikd_satker_kode,
                         sikd_satker.`nama` AS sikd_satker_nama,
                         sikd_sub_skpd.`kode` AS sikd_sub_skpd_kode,
                         sikd_sub_skpd.`nama` AS sikd_sub_skpd_nama,
                         musren_musrenbang.`kd_wilayah` AS musren_musrenbang_kd_wilayah,
                         SUM(vw_musren_anggaran_kgtn.`jml_apbd_kab`) AS vw_musren_anggaran_kgtn_jml_apbd_kab,
                         SUM(vw_musren_anggaran_kgtn.`jml_apbd_prop`) AS vw_musren_anggaran_kgtn_jml_apbd_prop,
                         SUM(vw_musren_anggaran_kgtn.`jml_lain`) AS vw_musren_anggaran_kgtn_jml_lain,
                         SUM(vw_musren_anggaran_kgtn.`jml_apbn`) AS vw_musren_anggaran_kgtn_ttl_jml_apbn
                    FROM
                         `musren_kgtn` musren_kgtn 
                         INNER JOIN `musren_kgtn` musren_kgtn_reses ON musren_kgtn.`id_musren_kgtn` = musren_kgtn_reses.`id_musren_kgtn` AND musren_kgtn_reses.`musren_kgtn_type` =  'MusrenKgtnDprd'
                         INNER JOIN `musren_fraksi_dprd` musren_fraksi ON musren_kgtn_reses.`musren_fraksi_dprd_id` = musren_fraksi.`id_musren_fraksi_dprd`
                         INNER JOIN `sikd_satker` sikd_satker ON musren_kgtn_reses.`sikd_skpd_id` = sikd_satker.`id_sikd_satker`
                         LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON musren_kgtn_reses.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                         INNER JOIN `sikd_bidang` sikd_musren_bidang ON musren_kgtn.`sikd_bidang_id` = sikd_musren_bidang.`id_sikd_bidang`
                         INNER JOIN `musren_lokasi_kgtn` musren_lokasi_kgtn ON musren_kgtn.`id_musren_kgtn` = musren_lokasi_kgtn.`musren_kgtn_id`
                         LEFT OUTER JOIN `vw_musren_anggaran_kgtn` vw_musren_anggaran_kgtn ON musren_lokasi_kgtn.`id_musren_lokasi_kgtn` = vw_musren_anggaran_kgtn.`musren_lokasi_kgtn_id`
                         INNER JOIN `musren_musrenbang` musren_musrenbang ON musren_kgtn.`musren_musrenbang_id` = musren_musrenbang.`id_musren_musrenbang`
                         INNER JOIN `musren_jns_kgtn` musren_jns_kgtn ON musren_kgtn.`musren_jns_kgtn_id` = musren_jns_kgtn.`id_musren_jns_kgtn`
                    WHERE
                         musren_musrenbang.`tahun` = :tahun
                     AND IF(:id_skpd != '', musren_kgtn_reses.`sikd_skpd_id` = :id_skpd, 1)
                     AND IF(:id_subskpd != '', musren_kgtn_reses.`sikd_sub_skpd_id` = :id_subskpd, 1)
                     AND IF(:id_bidang != '', musren_kgtn.`sikd_bidang_id` = :id_bidang, 1)
                     AND IF(:prioritas != '', musren_kgtn.`prioritas` = :prioritas, 1)
                     AND IF(:quota != '', musren_jns_kgtn.`no_jns_kgtn` = :quota, 1)
                     AND IF(:user_group = 'Musrenbang DPRD', musren_kgtn_reses.`created_by` = :user_name, 1)
                    GROUP BY
                         musren_fraksi.`nm_fraksi`,
                         sikd_satker.`kode`,
                         sikd_musren_bidang.kd_bidang
                    ORDER BY
                         musren_fraksi.`nm_fraksi` ASC,
                         sikd_satker.`kode` ASC,
                         sikd_musren_bidang.kd_bidang ASC,
                         musren_kgtn.`id_musren_kgtn`";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_skpd", $idSkpd);
            $statement->bindValue("id_subskpd", $idSubSkpd);
            $statement->bindValue("id_bidang", $idBidang);
            $statement->bindValue("prioritas", $prioritas);
            $statement->bindValue("tahun", $tahun);
            $statement->bindValue("quota", $quota);
            $statement->bindValue("user_group", $userGroup);
            $statement->bindValue("user_name", $userName);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getMusrenResesListFlowUsulan($request)
    {
        try {

            $idSkpd = $request->query->get("id_skpd");
            $idSubSkpd = $request->query->get("id_subskpd");
            $idBidang = $request->query->get("id_bidang");
            $idFraksi = $request->query->get("id_fraksi");
            $prioritas = $request->query->get("prioritas");
            $tahun = $request->query->get("tahun");
            $quota = $request->query->get("quota");
            $userGroup = $request->query->get("user_group");
            $userName = $request->query->get("user_name");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idSkpd = pack('H*', str_replace('-', '', trim($idSkpd)));
            $idSubSkpd = pack('H*', str_replace('-', '', trim($idSubSkpd)));
            $idBidang = pack('H*', str_replace('-', '', trim($idBidang)));
            $idFraksi = pack('H*', str_replace('-', '', trim($idFraksi)));
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                         musren_kgtn_reses.`created_by` AS musren_kgtn_created_by,
                         musren_kgtn_reses.`nm_pengusul` AS musren_kgtn_nm_pengusul,
                         musren_musrenbang.`tahun` AS musren_musrenbang_tahun,
                         musren_musrenbang.`kd_wilayah` AS musren_musrenbang_kd_wilayah,
                         sikd_bidang.`kd_bidang` AS sikd_bidang_kd_bidang,
                         sikd_bidang.`nm_bidang` AS sikd_bidang_nm_bidang,
                         musren_fraksi.`nm_fraksi` AS musren_fraksi_nm_fraksi,
                         musren_fraksi.`singkatan` AS musren_fraksi_singkatan,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 1, 8),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 9, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 13, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 17, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 21)
                         ) AS musren_kgtn_id_musren_kgtn,
                         musren_kgtn.`kd_kgtn` AS musren_kgtn_kd_kgtn,
                         musren_kgtn.`nm_kgtn` AS musren_kgtn_nm_kgtn,
                         musren_kgtn.`prioritas` AS musren_kgtn_prioritas,
                         musren_lokasi_kgtn.`nm_lokasi` AS vw_musren_usulan_kgtn_nm_lokasi_kgtn,
                         musren_lokasi_kgtn.`volume` AS vw_musren_usulan_kgtn_volume,
                         musren_lokasi_kgtn.`satuan` AS vw_musren_usulan_kgtn_satuan,
                         sikd_satker.`kode` AS sikd_satker_kode,
                         sikd_satker.`nama` AS sikd_satker_nama,
                         sikd_sub_skpd.`kode` AS sikd_sub_skpd_kode,
                         sikd_sub_skpd.`nama` AS sikd_sub_skpd_nama,
                         musren_lokasi_kgtn.`nm_lokasi` AS musren_lokasi_kgtn_nm_lokasi,
                         ifnull(musren_lokasi_kgtn.`rt`,'-') AS musren_lokasi_kgtn_rt,
                         ifnull(musren_lokasi_kgtn.`rw`,'-') AS musren_lokasi_kgtn_rw,
                         ifnull(vw_appl_kode_wilayah.`nama_wilayah`,'') AS musren_lokasi_kgtn_nm_wilayah,
                         musren_lokasi_kgtn.`volume` AS musren_lokasi_kgtn_volume,
                         musren_lokasi_kgtn.`satuan` AS musren_lokasi_kgtn_satuan,
                         ifnull((select sum(a.jml_anggaran) 
                                 from musren_lokasi_kgtn a, musren_lokasi_kgtn b
                                 where b.id_musren_lokasi_kgtn = musren_lokasi_kgtn.`id_musren_lokasi_kgtn`
                                   and a.id_musren_lokasi_kgtn = b.musren_lokasi_kgtn_id
                                   /*and a.musren_lokasi_kgtn_id = b.id_musren_lokasi_kgtn*/), 0) AS jml_usulan_desa,
                        ifnull(vw_musren_anggaran_kgtn.jml_apbd_kab+
                             vw_musren_anggaran_kgtn.jml_apbd_prop+
                             vw_musren_anggaran_kgtn.jml_apbn+
                             vw_musren_anggaran_kgtn.jml_lain, 0) AS jml_usulan_reses,
                          ifnull((select sum(a.jml_anggaran) 
                                  from musren_lokasi_kgtn a inner join musren_kgtn c on a.musren_kgtn_id = c.id_musren_kgtn and c.musren_kgtn_type = 'MusrenKgtnSkpd', musren_lokasi_kgtn b
                                  where b.musren_kgtn_id = musren_kgtn_reses.`id_musren_kgtn`
                                    and a.musren_lokasi_kgtn_id = b.`id_musren_lokasi_kgtn`
                                    /*and a.musren_skpd_lokasi_kgtn_id = b.id_musren_skpd_lokasi_kgtn*/), 0) AS jml_usulan_skpd,
                          ifnull((select sum(a.jml_anggaran) 
                                  from musren_lokasi_kgtn a, musren_lokasi_kgtn b inner join musren_kgtn d on b.musren_kgtn_id = d.id_musren_kgtn and d.musren_kgtn_type = 'MusrenKgtnSkpd', musren_lokasi_kgtn c
                                  where c.musren_kgtn_id = musren_kgtn_reses.`id_musren_kgtn`
                                    and b.musren_lokasi_kgtn_id = c.`id_musren_lokasi_kgtn`
                                    and a.musren_lokasi_kgtn_id = b.`id_musren_lokasi_kgtn`
                                    /*and a.musren_lokasi_kgtn_id = b.id_musren_lokasi_kgtn*/), 0) AS jml_usulan_kota
                    FROM
                         `musren_kgtn` musren_kgtn 
                         INNER JOIN `musren_kgtn` musren_kgtn_reses ON musren_kgtn.`id_musren_kgtn` = musren_kgtn_reses.`id_musren_kgtn` AND musren_kgtn_reses.`musren_kgtn_type` = 'MusrenKgtnDprd'
                         INNER JOIN `musren_fraksi_dprd` musren_fraksi ON musren_kgtn_reses.`musren_fraksi_dprd_id` = musren_fraksi.`id_musren_fraksi_dprd`
                         INNER JOIN `sikd_satker` sikd_satker ON musren_kgtn_reses.`sikd_skpd_id` = sikd_satker.`id_sikd_satker`
                         LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON musren_kgtn_reses.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                         INNER JOIN `sikd_bidang` sikd_bidang ON musren_kgtn.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                         INNER JOIN `musren_lokasi_kgtn` musren_lokasi_kgtn ON musren_kgtn.`id_musren_kgtn` = musren_lokasi_kgtn.`musren_kgtn_id`
                         LEFT OUTER JOIN `vw_musren_anggaran_kgtn` vw_musren_anggaran_kgtn ON musren_lokasi_kgtn.`id_musren_lokasi_kgtn` = vw_musren_anggaran_kgtn.`musren_lokasi_kgtn_id`
                         INNER JOIN `musren_musrenbang` musren_musrenbang ON musren_kgtn.`musren_musrenbang_id` = musren_musrenbang.`id_musren_musrenbang`
                         LEFT OUTER JOIN `vw_appl_kode_wilayah` vw_appl_kode_wilayah ON musren_lokasi_kgtn.`kd_wilayah` = vw_appl_kode_wilayah.`kode_wilayah`
                         INNER JOIN `musren_jns_kgtn` musren_jns_kgtn ON musren_kgtn.`musren_jns_kgtn_id` = musren_jns_kgtn.`id_musren_jns_kgtn`
                    WHERE
                         musren_musrenbang.`tahun` = :tahun
                     AND IF(:id_fraksi != '', musren_kgtn_reses.`musren_fraksi_dprd_id` = :id_fraksi, 1)
                     AND IF(:id_skpd != '', musren_kgtn_reses.`sikd_skpd_id` = :id_skpd, 1)
                     AND IF(:id_subskpd != '', musren_kgtn_reses.`sikd_sub_skpd_id` = :id_subskpd, 1)
                     AND IF(:id_bidang != '', musren_kgtn.`sikd_bidang_id` = :id_bidang, 1)
                     AND IF(:prioritas != '', musren_kgtn.`prioritas` = :prioritas, 1)
                     AND IF(:quota != '', musren_jns_kgtn.`no_jns_kgtn` = :quota, 1)
                     AND IF(:user_group = 'Musrenbang DPRD', musren_kgtn_reses.`created_by` = :user_name, 1)
                    ORDER BY
                         musren_kgtn_reses.`created_by` ASC,
                         musren_fraksi.`nm_fraksi` ASC,
                         sikd_satker.`kode` ASC,
                         sikd_bidang.kd_bidang ASC,
                         musren_kgtn.`id_musren_kgtn` ASC,
                         musren_lokasi_kgtn.`id_musren_lokasi_kgtn`";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_skpd", $idSkpd);
            $statement->bindValue("id_subskpd", $idSubSkpd);
            $statement->bindValue("id_bidang", $idBidang);
            $statement->bindValue("id_fraksi", $idFraksi);
            $statement->bindValue("prioritas", $prioritas);
            $statement->bindValue("tahun", $tahun);
            $statement->bindValue("quota", $quota);
            $statement->bindValue("user_group", $userGroup);
            $statement->bindValue("user_name", $userName);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getMusrenResesListFlowUsulanSub($request)
    {
        try {
            
            $idMusrenKgtn = $request->query->get("id_musren_kgtn");            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idMusrenKgtn = pack('H*', str_replace('-', '', trim($idMusrenKgtn)));
            
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                            CONCAT_WS('-',
                            SUBSTR(HEX(musren_lokasi_kgtn.`musren_kgtn_id`), 1, 8),
                            SUBSTR(HEX(musren_lokasi_kgtn.`musren_kgtn_id`), 9, 4),
                            SUBSTR(HEX(musren_lokasi_kgtn.`musren_kgtn_id`), 13, 4),
                            SUBSTR(HEX(musren_lokasi_kgtn.`musren_kgtn_id`), 17, 4),
                            SUBSTR(HEX(musren_lokasi_kgtn.`musren_kgtn_id`), 21)
                             ) AS musren_lokasi_kgtn_musren_kgtn_id,
                             ifnull(musren_lokasi_kgtn.`rt`,'-') AS musren_lokasi_kgtn_rt,
                             ifnull(musren_lokasi_kgtn.`rw`,'-') AS musren_lokasi_kgtn_rw,
                             musren_lokasi_kgtn.`nm_lokasi` AS musren_lokasi_kgtn_nm_lokasi_kgtn,
                             musren_lokasi_kgtn.`volume` AS musren_lokasi_kgtn_volume,
                             ifnull(musren_lokasi_kgtn.`satuan`,'-') AS musren_lokasi_kgtn_satuan,
                            CONCAT_WS('-',
                            SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 1, 8),
                            SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 9, 4),
                            SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 13, 4),
                            SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 17, 4),
                            SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 21)
                             ) AS musren_kgtn_id_musren_kgtn,
                             ifnull((select sum(a.jml_anggaran) 
                                     from musren_lokasi_kgtn a, musren_lokasi_kgtn b
                                     where b.id_musren_lokasi_kgtn = musren_lokasi_kgtn.`id_musren_lokasi_kgtn`
                                       and a.id_musren_lokasi_kgtn = b.musren_lokasi_kgtn_id
                                       /*and a.musren_lokasi_kgtn_id = b.id_musren_lokasi_kgtn*/), 0) AS jml_usulan_desa,
                             (vw_musren_anggaran_kgtn.`jml_apbd_kab`+
                              vw_musren_anggaran_kgtn.`jml_apbd_prop`+
                              vw_musren_anggaran_kgtn.`jml_apbn`+
                              vw_musren_anggaran_kgtn.`jml_lain`) AS jml_usulan_kec,
                             ifnull((select sum(a.jml_anggaran) 
                                     from musren_lokasi_kgtn a inner join musren_kgtn c on a.musren_kgtn_id = c.id_musren_kgtn and c.musren_kgtn_type = 'MusrenKgtnSkpd', musren_lokasi_kgtn b
                                     where b.id_musren_lokasi_kgtn = musren_lokasi_kgtn.`id_musren_lokasi_kgtn`
                                       and a.musren_lokasi_kgtn_id = b.`id_musren_lokasi_kgtn`
                                       /*and a.musren_skpd_lokasi_kgtn_id = b.id_musren_skpd_lokasi_kgtn*/), 0) AS jml_usulan_skpd,
                             ifnull((select sum(a.jml_anggaran) 
                                     from musren_lokasi_kgtn a, musren_lokasi_kgtn b inner join musren_kgtn d on b.musren_kgtn_id = d.id_musren_kgtn and d.musren_kgtn_type = 'MusrenKgtnSkpd', musren_lokasi_kgtn c
                                     where c.id_musren_lokasi_kgtn = musren_lokasi_kgtn.`id_musren_lokasi_kgtn`
                                       and b.musren_lokasi_kgtn_id = c.`id_musren_lokasi_kgtn`
                                       and a.musren_lokasi_kgtn_id = b.`id_musren_lokasi_kgtn`
                                       /*and a.musren_lokasi_kgtn_id = b.id_musren_lokasi_kgtn*/), 0) AS jml_usulan_kota
                        FROM
                             `vw_musren_anggaran_kgtn` vw_musren_anggaran_kgtn 
                             RIGHT OUTER JOIN `musren_lokasi_kgtn` musren_lokasi_kgtn ON vw_musren_anggaran_kgtn.`musren_lokasi_kgtn_id` = musren_lokasi_kgtn.`id_musren_lokasi_kgtn`
                             RIGHT OUTER JOIN `musren_kgtn` musren_kgtn ON musren_lokasi_kgtn.`musren_kgtn_id` = musren_kgtn.`id_musren_kgtn`
                        WHERE
                             musren_kgtn.id_musren_kgtn = :id_musren_kgtn

                        ORDER BY
                             musren_lokasi_kgtn.`id_musren_lokasi_kgtn`";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_musren_kgtn", $idMusrenKgtn);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }

    //FORUM SKPD
    private function getMusrenSkpdListUsulanRes($request)
    {
        try {

            $tahun = $request->query->get("tahun");
            $status = $request->query->get("status");
            $idSkpd = $request->query->get("id_skpd");
            $idSubSkpd = $request->query->get("id_subskpd");
            $idBidang = $request->query->get("id_bidang");
            $prioritas = $request->query->get("prioritas");
            $quota = $request->query->get("quota");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idSkpd = pack('H*', str_replace('-', '', trim($idSkpd)));
            $idSubSkpd = pack('H*', str_replace('-', '', trim($idSubSkpd)));
            $idBidang = pack('H*', str_replace('-', '', trim($idBidang)));
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                         CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 1, 8),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 9, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 13, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 17, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 21)
                         ) AS musren_kgtn_id_musren_kgtn,
                         musren_kgtn.`nm_kgtn` AS musren_kgtn_nm_kgtn,
                         musren_kgtn.`prioritas` AS musren_kgtn_prioritas,
                         musren_kgtn.`sifat_kgtn` AS musren_kgtn_sifat_kgtn,
                         musren_kgtn.`output` AS musren_kgtn_output,
                         musren_kgtn.`outcome` AS musren_kgtn_outcome,
                         CONCAT_WS('-',
                        SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 1, 8),
                        SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 9, 4),
                        SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 13, 4),
                        SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 17, 4),
                        SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 21)
                         ) AS sikd_musren_bidang_id_sikd_musren_bidang,
                         sikd_bidang.`kd_bidang` AS sikd_musren_bidang_kd_bidang,
                         sikd_bidang.`nm_bidang` AS sikd_musren_bidang_nm_bidang,
                         SUM(vw_musren_anggaran_kgtn.`jml_apbd_kab`) AS vw_musren_anggaran_kgtn_jml_apbd_kab,
                         SUM(vw_musren_anggaran_kgtn.`jml_apbd_prop`) AS vw_musren_anggaran_kgtn_jml_apbd_prop,
                         SUM(vw_musren_anggaran_kgtn.`jml_apbn`) AS vw_musren_anggaran_kgtn_jml_apbn,
                         SUM(vw_musren_anggaran_kgtn.`jml_lain`) AS vw_musren_anggaran_kgtn_jml_lain,
                         sikd_satker.`kode` AS sikd_satker_kode,
                         sikd_satker.`nama` AS sikd_satker_nama,
                         sikd_sub_skpd.`kode` AS sikd_sub_skpd_kode,
                         sikd_sub_skpd.`nama` AS sikd_sub_skpd_nama
                    FROM
                         `musren_kgtn` musren_kgtn 
                         INNER JOIN `musren_kgtn` musren_kgtn_reses ON musren_kgtn.`id_musren_kgtn` = musren_kgtn_reses.`id_musren_kgtn` AND musren_kgtn_reses.`musren_kgtn_type` = 'MusrenKgtnDprd'
                         INNER JOIN `sikd_satker` sikd_satker ON musren_kgtn_reses.`sikd_skpd_id` = sikd_satker.`id_sikd_satker`
                         LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON musren_kgtn_reses.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                         LEFT OUTER JOIN `sikd_bidang` sikd_bidang ON musren_kgtn.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                         INNER JOIN `musren_lokasi_kgtn` musren_lokasi_kgtn ON musren_kgtn.`id_musren_kgtn` = musren_lokasi_kgtn.`musren_kgtn_id`
                         LEFT OUTER JOIN `vw_musren_anggaran_kgtn` vw_musren_anggaran_kgtn ON musren_lokasi_kgtn.`id_musren_lokasi_kgtn` = vw_musren_anggaran_kgtn.`musren_lokasi_kgtn_id`
                         INNER JOIN `musren_musrenbang` musren_musrenbang ON musren_kgtn.`musren_musrenbang_id` = musren_musrenbang.`id_musren_musrenbang`
                         INNER JOIN `musren_jns_kgtn` musren_jns_kgtn ON musren_kgtn.`musren_jns_kgtn_id` = musren_jns_kgtn.`id_musren_jns_kgtn`
                    WHERE
                         musren_musrenbang.`tahun` = :tahun
                     AND IF(:status = '1', musren_kgtn_reses.`status_verifikasi` = '1',
                            IF(:status = '0', musren_kgtn_reses.`status_verifikasi` IN ('','0'), 1))
                     AND IF(:id_skpd != '', sikd_satker.id_sikd_satker = :id_skpd, 1)
                     AND IF(:id_subskpd != '', sikd_sub_skpd.id_sikd_sub_skpd = :id_subskpd, 1)
                     AND IF(:id_bidang != '', musren_kgtn.sikd_bidang_id = :id_bidang, 1)
                     AND IF(:prioritas != '', musren_kgtn.prioritas = :prioritas, 1)
                     AND IF(:quota != '', musren_jns_kgtn.`no_jns_kgtn` = :quota, 1)
                    GROUP BY
                         sikd_satker.kode,
                         sikd_sub_skpd.`kode`,
                         sikd_bidang.kd_bidang,
                         musren_kgtn.`id_musren_kgtn`
                    ORDER BY
                         sikd_satker.kode ASC,
                         sikd_sub_skpd.`kode` ASC,
                         sikd_bidang.kd_bidang ASC,
                         cast(trim(leading 'F' from musren_kgtn.`prioritas`) as unsigned) ASC,
                         musren_kgtn.`id_musren_kgtn` ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("tahun", $tahun);
            $statement->bindValue("status", $status);
            $statement->bindValue("id_skpd", $idSkpd);
            $statement->bindValue("id_subskpd", $idSubSkpd);
            $statement->bindValue("id_bidang", $idBidang);
            $statement->bindValue("prioritas", $prioritas);
            $statement->bindValue("quota", $quota);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }

    private function getMusrenSkpdListUsulanKec($request)
    {
        try {

            $tahun = $request->query->get("tahun");
            $status = $request->query->get("status");
            $idSkpd = $request->query->get("id_skpd");
            $idBidang = $request->query->get("id_bidang");
            $prioritas = $request->query->get("prioritas");
            $quota = $request->query->get("quota");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idSkpd = pack('H*', str_replace('-', '', trim($idSkpd)));
            $idBidang = pack('H*', str_replace('-', '', trim($idBidang)));
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                     CONCAT_WS('-',
                    SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 1, 8),
                    SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 9, 4),
                    SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 13, 4),
                    SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 17, 4),
                    SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 21)
                     ) AS musren_kgtn_id_musren_kgtn,
                     musren_kgtn.`nm_kgtn` AS musren_kgtn_nm_kgtn,
                     musren_kgtn.`prioritas` AS musren_kgtn_prioritas,
                     musren_kgtn.`sifat_kgtn` AS musren_kgtn_sifat_kgtn,
                     musren_kgtn.`output` AS musren_kgtn_output,
                     musren_kgtn.`outcome` AS musren_kgtn_outcome,
                     CONCAT_WS('-',
                    SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 1, 8),
                    SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 9, 4),
                    SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 13, 4),
                    SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 17, 4),
                    SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 21)
                     ) AS sikd_musren_bidang_id_sikd_musren_bidang,
                     sikd_bidang.`kd_bidang` AS sikd_musren_bidang_kd_bidang,
                     sikd_bidang.`nm_bidang` AS sikd_musren_bidang_nm_bidang,
                     RPAD(substring(vw_appl_kode_wilayah.`kode_wilayah`,5,6),6,0) AS vw_appl_kode_wilayah_kode,
                     vw_appl_kode_wilayah.`kode_wilayah` AS vw_appl_kode_wilayah_kode_wilayah,
                     concat(vw_appl_kode_wilayah.`klasifikasi`, ' ', vw_appl_kode_wilayah.`nama_wilayah`, ', ', vw_appl_kode_wilayah_induk.`nama_wilayah`) AS vw_appl_kode_wilayah_nama_wilayah,
                     SUM(vw_musren_anggaran_kgtn.`jml_apbd_kab`) AS vw_musren_anggaran_kgtn_jml_apbd_kab,
                     SUM(vw_musren_anggaran_kgtn.`jml_apbd_prop`) AS vw_musren_anggaran_kgtn_jml_apbd_prop,
                     SUM(vw_musren_anggaran_kgtn.`jml_apbn`) AS vw_musren_anggaran_kgtn_jml_apbn,
                     SUM(vw_musren_anggaran_kgtn.`jml_lain`) AS vw_musren_anggaran_kgtn_jml_lain,
                     sikd_satker.`kode` AS sikd_satker_kode,
                     sikd_satker.`nama` AS sikd_satker_nama
                FROM
                     `musren_kgtn` musren_kgtn 
                     INNER JOIN `musren_kgtn` musren_kgtn_kec ON musren_kgtn.`id_musren_kgtn` = musren_kgtn_kec.`id_musren_kgtn` AND musren_kgtn_kec.`musren_kgtn_type` = 'MusrenKgtnKec'
                     INNER JOIN `sikd_satker` sikd_satker ON musren_kgtn_kec.`sikd_skpd_id` = sikd_satker.`id_sikd_satker`
                     LEFT OUTER JOIN `sikd_bidang` sikd_bidang ON musren_kgtn.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                     INNER JOIN `musren_lokasi_kgtn` musren_lokasi_kgtn ON musren_kgtn.`id_musren_kgtn` = musren_lokasi_kgtn.`musren_kgtn_id`
                     INNER JOIN `vw_musren_anggaran_kgtn` vw_musren_anggaran_kgtn ON musren_lokasi_kgtn.`id_musren_lokasi_kgtn` = vw_musren_anggaran_kgtn.`musren_lokasi_kgtn_id`
                     INNER JOIN `musren_musrenbang` musren_musrenbang ON musren_kgtn.`musren_musrenbang_id` = musren_musrenbang.`id_musren_musrenbang`
                     INNER JOIN `vw_appl_kode_wilayah` vw_appl_kode_wilayah ON musren_lokasi_kgtn.`kd_wilayah` = vw_appl_kode_wilayah.`kode_wilayah`
                     INNER JOIN `vw_appl_kode_wilayah_induk` vw_appl_kode_wilayah_induk ON vw_appl_kode_wilayah.`kode_induk` = vw_appl_kode_wilayah_induk.`kode_wilayah`
                     INNER JOIN `musren_jns_kgtn` musren_jns_kgtn ON musren_kgtn.`musren_jns_kgtn_id` = musren_jns_kgtn.`id_musren_jns_kgtn`
                WHERE
                     musren_musrenbang.`tahun` = :tahun
                 AND IF(:status = '1', musren_kgtn_kec.`status_verifikasi` = '1',
                        IF(:status = '0', musren_kgtn_kec.`status_verifikasi` IN ('','0'), 1))
                 AND IF(:id_skpd != '', sikd_satker.id_sikd_satker = :id_skpd, 1)
                 AND IF(:id_bidang != '', musren_kgtn.sikd_bidang_id = :id_bidang, 1)
                 AND IF(:prioritas != '', musren_kgtn.prioritas = :prioritas, 1)
                 AND IF(:quota != '', musren_jns_kgtn.`no_jns_kgtn` = :quota, 1)
                GROUP BY
                     sikd_satker.kode,
                     sikd_bidang.kd_bidang,
                     vw_appl_kode_wilayah.`kode_wilayah`,
                     musren_kgtn.`id_musren_kgtn`
                ORDER BY
                     sikd_satker.kode ASC,
                     sikd_bidang.kd_bidang ASC,
                     RPAD(vw_appl_kode_wilayah.`kode_wilayah`,10,0) ASC,
                     cast(trim(leading 'F' from musren_kgtn.`prioritas`) as unsigned) ASC,
                     musren_kgtn.`id_musren_kgtn` ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("tahun", $tahun);
            $statement->bindValue("status", $status);
            $statement->bindValue("id_skpd", $idSkpd);
            $statement->bindValue("id_bidang", $idBidang);
            $statement->bindValue("prioritas", $prioritas);
            $statement->bindValue("quota", $quota);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getMusrenSkpdListUsulanKecSub($request)
    {
        try {

            $idMusrenKgtn = $request->query->get("id_musren_kgtn");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idMusrenKgtn = pack('H*', str_replace('-', '', trim($idMusrenKgtn)));
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                         musren_lokasi_kgtn.`nm_lokasi` AS musren_lokasi_kgtn_nm_lokasi_kgtn,
                         musren_lokasi_kgtn.`volume` AS musren_lokasi_kgtn_volume,
                         musren_lokasi_kgtn.`satuan` AS musren_lokasi_kgtn_satuan,
                         vw_musren_anggaran_kgtn.`jml_apbd_kab` AS vw_musren_anggaran_kgtn_jml_apbd_kab,
                         vw_musren_anggaran_kgtn.`jml_apbd_prop` AS vw_musren_anggaran_kgtn_jml_apbd_prop,
                         vw_musren_anggaran_kgtn.`jml_apbn` AS vw_musren_anggaran_kgtn_jml_apbn,
                         vw_musren_anggaran_kgtn.`jml_lain` AS vw_musren_anggaran_kgtn_jml_lain
                    FROM
                         `musren_lokasi_kgtn` musren_lokasi_kgtn 
                         INNER JOIN `musren_kgtn` musren_kgtn ON musren_lokasi_kgtn.`musren_kgtn_id` = musren_kgtn.`id_musren_kgtn`
                         LEFT OUTER JOIN `vw_musren_anggaran_kgtn` vw_musren_anggaran_kgtn ON musren_lokasi_kgtn.`id_musren_lokasi_kgtn` = vw_musren_anggaran_kgtn.`musren_lokasi_kgtn_id`
                    WHERE
                         musren_kgtn.`id_musren_kgtn` = :id_musren_kgtn";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_musren_kgtn", $idMusrenKgtn);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getMusrenSkpdListUsulanKecSub1($request)
    {
        try {

            $idMusrenKgtn = $request->query->get("id_musren_kgtn");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idMusrenKgtn = pack('H*', str_replace('-', '', trim($idMusrenKgtn)));
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_lokasi_kgtn.`id_musren_lokasi_kgtn`), 1, 8),
                        SUBSTR(HEX(musren_lokasi_kgtn.`id_musren_lokasi_kgtn`), 9, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.`id_musren_lokasi_kgtn`), 13, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.`id_musren_lokasi_kgtn`), 17, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.`id_musren_lokasi_kgtn`), 21)
                         ) AS musren_lokasi_kgtn_id_musren_lokasi_kgtn,
                         musren_lokasi_kgtn.`nm_lokasi` AS musren_lokasi_kgtn_nm_lokasi_kgtn,
                         musren_lokasi_kgtn.`volume` AS musren_lokasi_kgtn_volume,
                         musren_lokasi_kgtn.`satuan` AS musren_lokasi_kgtn_satuan,
                         vw_musren_anggaran_kgtn.`jml_apbd_kab` AS vw_musren_anggaran_kgtn_jml_apbd_kab,
                         vw_musren_anggaran_kgtn.`jml_apbd_prop` AS vw_musren_anggaran_kgtn_jml_apbd_prop,
                         -- vw_musren_anggaran_kgtn.`jml_apbn_dak` AS vw_musren_anggaran_kgtn_jml_apbn_dak,
                         -- vw_musren_anggaran_kgtn.`jml_apbn_tp` AS vw_musren_anggaran_kgtn_jml_apbn_tp,
                         -- vw_musren_anggaran_kgtn.`jml_apbn_d` AS vw_musren_anggaran_kgtn_jml_apbn_d,
                         vw_musren_anggaran_kgtn.`jml_apbn` AS vw_musren_anggaran_kgtn_jml_apbn,
                         vw_musren_anggaran_kgtn.`jml_lain` AS vw_musren_anggaran_kgtn_jml_lain
                         -- vw_musren_anggaran_kgtn.`ttl_jml_apbn` AS vw_musren_anggaran_kgtn_ttl_jml_apbn
                    FROM
                         `musren_lokasi_kgtn` musren_lokasi_kgtn INNER JOIN `musren_kgtn` musren_kgtn ON musren_lokasi_kgtn.`musren_kgtn_id` = musren_kgtn.`id_musren_kgtn`
                         INNER JOIN `vw_musren_anggaran_kgtn` vw_musren_anggaran_kgtn ON musren_lokasi_kgtn.`id_musren_lokasi_kgtn` = vw_musren_anggaran_kgtn.`musren_lokasi_kgtn_id`
                    WHERE
                         musren_kgtn.`id_musren_kgtn` = :id_musren_kgtn";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_musren_kgtn", $idMusrenKgtn);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getMusrenSkpdListKgtn($request)
    {
        try {

            //print_r("ok");exit;

            $tahun = $request->query->get("tahun");
            $status = $request->query->get("status");
            $idSkpd = $request->query->get("id_skpd");
            $idSubSkpd = $request->query->get("id_subskpd");
            $idBidang = $request->query->get("id_bidang");
            $prioritas = $request->query->get("prioritas");
            $pengusul = $request->query->get("pengusul");
            $quota = $request->query->get("quota");
            $smbrAng = $request->query->get("smbr_ang");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idSkpd = pack('H*', str_replace('-', '', trim($idSkpd)));
            $idSubSkpd = pack('H*', str_replace('-', '', trim($idSubSkpd)));
            $idBidang = pack('H*', str_replace('-', '', trim($idBidang)));
            $smbrAng = pack('H*', str_replace('-', '', trim($smbrAng)));
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                     sikd_satker.`kode` AS sikd_satker_kode,
                     sikd_satker.`nama` AS sikd_satker_nama,
                     sikd_sub_skpd.`kode` AS sikd_sub_skpd_kode,
                     sikd_sub_skpd.`nama` AS sikd_sub_skpd_nama,
                    CONCAT_WS('-',
                    SUBSTR(HEX(musren_skpd_kgtn.`id_musren_kgtn`), 1, 8),
                    SUBSTR(HEX(musren_skpd_kgtn.`id_musren_kgtn`), 9, 4),
                    SUBSTR(HEX(musren_skpd_kgtn.`id_musren_kgtn`), 13, 4),
                    SUBSTR(HEX(musren_skpd_kgtn.`id_musren_kgtn`), 17, 4),
                    SUBSTR(HEX(musren_skpd_kgtn.`id_musren_kgtn`), 21)
                     ) AS musren_skpd_kgtn_id_musren_skpd_kgtn,
                     substring(sikd_kgtn.kd_kgtn,3,3) AS skpd_kgtn_kode,
                     musren_skpd_kgtn.`kd_kgtn` AS musren_skpd_kgtn_kd_kgtn,
                     musren_skpd_kgtn.`nm_kgtn` AS musren_skpd_kgtn_nm_kgtn,
                     ifnull(musren_skpd_kgtn.`no_subkgtn`, '-') AS musren_skpd_kgtn_no_subkgtn,
                     ifnull(musren_skpd_kgtn.`nm_subkgtn`, musren_skpd_kgtn.`nm_kgtn`) AS musren_skpd_kgtn_nm_subkgtn,
                     musren_skpd_kgtn.`prioritas` AS musren_skpd_kgtn_prioritas,
                     musren_skpd_kgtn.`sifat_kgtn` AS musren_skpd_kgtn_sifat_kgtn,
                     musren_skpd_kgtn.`output` AS musren_skpd_kgtn_output,
                     musren_skpd_kgtn.`outcome` AS musren_skpd_kgtn_outcome,
                    CONCAT_WS('-',
                    SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 1, 8),
                    SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 9, 4),
                    SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 13, 4),
                    SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 17, 4),
                    SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 21)
                     ) AS sikd_bidang_id_sikd_bidang,
                     sikd_bidang.`kd_bidang` AS sikd_bidang_kd_bidang,
                     sikd_bidang.`nm_bidang` AS sikd_bidang_nm_bidang,
                     sikd_prog.`kd_prog` AS sikd_prog_kd_prog,
                     sikd_prog.`nm_prog` AS sikd_prog_nm_prog,
                     sikd_kgtn.`kd_kgtn` AS sikd_kgtn_kd_kgtn,
                     SUM(if(musren_jns_anggaran.`kd_jns_anggaran` = '1', musren_skpd_lokasi_kgtn.`jml_anggaran`, 0)) AS vw_musren_skpd_anggaran_kgtn_jml_apbd_kab,
                     SUM(if(musren_jns_anggaran.`kd_jns_anggaran` = '2', musren_skpd_lokasi_kgtn.`jml_anggaran`, 0)) AS vw_musren_skpd_anggaran_kgtn_jml_apbd_prop,
                     SUM(if(musren_jns_anggaran.`kd_jns_anggaran` = '3', musren_skpd_lokasi_kgtn.`jml_anggaran`, 0)) AS vw_musren_skpd_anggaran_kgtn_jml_apbn,
                     SUM(if(musren_jns_anggaran.`kd_jns_anggaran` = '9' OR
                            (CONCAT_WS('-',
                    SUBSTR(HEX(musren_skpd_lokasi_kgtn.`sikd_sumber_anggaran_id`), 1, 8),
                    SUBSTR(HEX(musren_skpd_lokasi_kgtn.`sikd_sumber_anggaran_id`), 9, 4),
                    SUBSTR(HEX(musren_skpd_lokasi_kgtn.`sikd_sumber_anggaran_id`), 13, 4),
                    SUBSTR(HEX(musren_skpd_lokasi_kgtn.`sikd_sumber_anggaran_id`), 17, 4),
                    SUBSTR(HEX(musren_skpd_lokasi_kgtn.`sikd_sumber_anggaran_id`), 21)
                     ) NOT IN 
                            (select sikd_sumber_anggaran_id from musren_jns_anggaran)), musren_skpd_lokasi_kgtn.`jml_anggaran`, 0)) AS vw_musren_skpd_anggaran_kgtn_jml_lain
                FROM
                     `musren_kgtn` musren_skpd_kgtn 
                     INNER JOIN `musren_musrenbang` musren_forum_skpd ON musren_skpd_kgtn.`musren_musrenbang_id` = musren_forum_skpd.`id_musren_musrenbang` AND musren_forum_skpd.`musren_musrenbang_type` = 'MusrenForumSkpd'
                     INNER JOIN `sikd_satker` sikd_satker ON musren_skpd_kgtn.`sikd_skpd_id` = sikd_satker.`id_sikd_satker`
                     LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON musren_skpd_kgtn.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                     LEFT OUTER JOIN `sikd_bidang` sikd_bidang ON musren_skpd_kgtn.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                     INNER JOIN `sikd_kgtn` sikd_kgtn ON musren_skpd_kgtn.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                     INNER JOIN `sikd_prog` sikd_prog ON sikd_kgtn.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                     INNER JOIN `musren_lokasi_kgtn` musren_skpd_lokasi_kgtn ON musren_skpd_kgtn.`id_musren_kgtn` = musren_skpd_lokasi_kgtn.`musren_kgtn_id`
                     LEFT OUTER JOIN `musren_jns_anggaran` musren_jns_anggaran ON musren_skpd_lokasi_kgtn.`sikd_sumber_anggaran_id` = musren_jns_anggaran.`sikd_sumber_anggaran_id`
                     LEFT OUTER JOIN `vw_musren_jns_usulan_kgtn` musren_kgtn ON musren_skpd_lokasi_kgtn.`musren_lokasi_kgtn_id` = musren_kgtn.`id_musren_lokasi_kgtn`
                     INNER JOIN `musren_jns_kgtn` musren_jns_kgtn ON musren_skpd_kgtn.`musren_jns_kgtn_id` = musren_jns_kgtn.`id_musren_jns_kgtn`
                WHERE
                    musren_skpd_kgtn.`musren_kgtn_type` = 'MusrenKgtnSkpd'
                 AND musren_forum_skpd.`tahun` = :tahun
                 AND IF(:status = '1', musren_skpd_kgtn.`status_verifikasi` = '1',
                        IF(:status = '0', musren_skpd_kgtn.`status_verifikasi` IN ('','0'), 1))
                 AND IF(:id_skpd != '', sikd_satker.id_sikd_satker = :id_skpd, 1)
                 AND IF(:id_subskpd != '', musren_skpd_kgtn.`sikd_sub_skpd_id` = :id_subskpd, 1)
                 AND IF(:id_bidang != '', sikd_bidang.`id_sikd_bidang` = :id_bidang, 1)
                 AND IF(:prioritas != '', musren_skpd_kgtn.prioritas = :prioritas, 1)
                 AND IF(:pengusul = '4', musren_skpd_kgtn.`musren_kgtn_type` = 'MusrenKgtnDprd',
                        IF(:pengusul = '3', musren_skpd_kgtn.`musren_kgtn_type` = 'MusrenKgtnKec',
                        IF(:pengusul = '2', musren_skpd_kgtn.`musren_kgtn_type` = 'MusrenKgtnSkpd', 1)))
                 AND IF(:quota != '', musren_jns_kgtn.`no_jns_kgtn` = :quota, 1)
                 AND IF(:smbr_ang != '', musren_skpd_lokasi_kgtn.sikd_sumber_anggaran_id = :smbr_ang, 1)
                GROUP BY
                     sikd_satker.kode,
                     sikd_sub_skpd.kode,
                     sikd_bidang.`kd_bidang`,
                     sikd_prog.`kd_prog`,
                     sikd_kgtn.`kd_kgtn`,
                     musren_skpd_kgtn.`no_subkgtn`
                ORDER BY
                     sikd_satker.kode ASC,
                     sikd_sub_skpd.kode ASC,
                     sikd_bidang.`kd_bidang` ASC,
                     sikd_prog.`kd_prog` ASC,
                     cast(trim(leading 'F' from musren_skpd_kgtn.`prioritas`) as unsigned) ASC,
                     sikd_kgtn.`kd_kgtn` ASC,
                     lpad(musren_skpd_kgtn.`no_subkgtn`,3,0) ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("tahun", $tahun);
            $statement->bindValue("status", $status);
            $statement->bindValue("id_skpd", $idSkpd);
            $statement->bindValue("id_subskpd", $idSubSkpd);
            $statement->bindValue("id_bidang", $idBidang);
            $statement->bindValue("prioritas", $prioritas);
            $statement->bindValue("pengusul", $pengusul);
            $statement->bindValue("quota", $quota);
            $statement->bindValue("smbr_ang", $smbrAng);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }

    private function getMusrenSkpdListKgtnRingkas($request)
    {
        try {

            $tahun = $request->query->get("tahun");
            $status = $request->query->get("status");
            $idSkpd = $request->query->get("id_skpd");
            $idSubSkpd = $request->query->get("id_subskpd");
            $idBidang = $request->query->get("id_bidang");
            $prioritas = $request->query->get("prioritas");
            $pengusul = $request->query->get("pengusul");
            $quota = $request->query->get("quota");
            $smbrAng = $request->query->get("smbr_ang");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idSkpd = pack('H*', str_replace('-', '', trim($idSkpd)));
            $idSubSkpd = pack('H*', str_replace('-', '', trim($idSubSkpd)));
            $idBidang = pack('H*', str_replace('-', '', trim($idBidang)));
           
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                         sikd_satker.`kode` AS sikd_satker_kode,
                         sikd_satker.`nama` AS sikd_satker_nama,
                         sikd_sub_skpd.`kode` AS sikd_sub_skpd_kode,
                         sikd_sub_skpd.`nama` AS sikd_sub_skpd_nama,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_skpd_kgtn.`id_musren_kgtn`), 1, 8),
                        SUBSTR(HEX(musren_skpd_kgtn.`id_musren_kgtn`), 9, 4),
                        SUBSTR(HEX(musren_skpd_kgtn.`id_musren_kgtn`), 13, 4),
                        SUBSTR(HEX(musren_skpd_kgtn.`id_musren_kgtn`), 17, 4),
                        SUBSTR(HEX(musren_skpd_kgtn.`id_musren_kgtn`), 21)
                         ) AS musren_skpd_kgtn_id_musren_skpd_kgtn,
                         substring(sikd_kgtn.kd_kgtn,3,3) AS skpd_kgtn_kode,
                         musren_skpd_kgtn.`kd_kgtn` AS musren_skpd_kgtn_kd_kgtn,
                         musren_skpd_kgtn.`nm_kgtn` AS musren_skpd_kgtn_nm_kgtn,
                         ifnull(musren_skpd_kgtn.`no_subkgtn`, '-') AS musren_skpd_kgtn_no_subkgtn,
                         ifnull(musren_skpd_kgtn.`nm_subkgtn`, musren_skpd_kgtn.`nm_kgtn`) AS musren_skpd_kgtn_nm_subkgtn,
                         musren_skpd_kgtn.`prioritas` AS musren_skpd_kgtn_prioritas,
                         musren_skpd_kgtn.`sifat_kgtn` AS musren_skpd_kgtn_sifat_kgtn,
                         musren_skpd_kgtn.`output` AS musren_skpd_kgtn_output,
                         musren_skpd_kgtn.`outcome` AS musren_skpd_kgtn_outcome,
                        CONCAT_WS('-',
                        SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 1, 8),
                        SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 9, 4),
                        SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 13, 4),
                        SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 17, 4),
                        SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 21)
                         ) AS sikd_bidang_id_sikd_bidang,
                         sikd_bidang.`kd_bidang` AS sikd_bidang_kd_bidang,
                         sikd_bidang.`nm_bidang` AS sikd_bidang_nm_bidang,
                         sikd_prog.`kd_prog` AS sikd_prog_kd_prog,
                         sikd_prog.`nm_prog` AS sikd_prog_nm_prog,
                         SUM(if(musren_jns_anggaran.`kd_jns_anggaran` = '1', musren_skpd_lokasi_kgtn.`jml_anggaran`, 0)) AS vw_musren_skpd_anggaran_kgtn_jml_apbd_kab,
                         SUM(if(musren_jns_anggaran.`kd_jns_anggaran` = '2', musren_skpd_lokasi_kgtn.`jml_anggaran`, 0)) AS vw_musren_skpd_anggaran_kgtn_jml_apbd_prop,
                         SUM(if(musren_jns_anggaran.`kd_jns_anggaran` = '3', musren_skpd_lokasi_kgtn.`jml_anggaran`, 0)) AS vw_musren_skpd_anggaran_kgtn_jml_apbn,
                         SUM(if(musren_jns_anggaran.`kd_jns_anggaran` = '9' OR
                                (CONCAT_WS('-',
                        SUBSTR(HEX(musren_skpd_lokasi_kgtn.`sikd_sumber_anggaran_id`), 1, 8),
                        SUBSTR(HEX(musren_skpd_lokasi_kgtn.`sikd_sumber_anggaran_id`), 9, 4),
                        SUBSTR(HEX(musren_skpd_lokasi_kgtn.`sikd_sumber_anggaran_id`), 13, 4),
                        SUBSTR(HEX(musren_skpd_lokasi_kgtn.`sikd_sumber_anggaran_id`), 17, 4),
                        SUBSTR(HEX(musren_skpd_lokasi_kgtn.`sikd_sumber_anggaran_id`), 21)
                         ) NOT IN 
                                (select sikd_sumber_anggaran_id from musren_jns_anggaran)), musren_skpd_lokasi_kgtn.`jml_anggaran`, 0)) AS vw_musren_skpd_anggaran_kgtn_jml_lain
                    FROM
                         `musren_kgtn` musren_skpd_kgtn 
                         INNER JOIN `musren_musrenbang` musren_forum_skpd ON musren_skpd_kgtn.`musren_musrenbang_id` = musren_forum_skpd.`id_musren_musrenbang` AND musren_forum_skpd.`musren_musrenbang_type` = 'MusrenForumSkpd'
                         INNER JOIN `sikd_satker` sikd_satker ON musren_skpd_kgtn.`sikd_skpd_id` = sikd_satker.`id_sikd_satker`
                         LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON musren_skpd_kgtn.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                         LEFT OUTER JOIN `sikd_bidang` sikd_bidang ON musren_skpd_kgtn.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                         INNER JOIN `sikd_kgtn` sikd_kgtn ON musren_skpd_kgtn.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                         INNER JOIN `sikd_prog` sikd_prog ON sikd_kgtn.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                         INNER JOIN `musren_lokasi_kgtn` musren_skpd_lokasi_kgtn ON musren_skpd_kgtn.`id_musren_kgtn` = musren_skpd_lokasi_kgtn.`musren_kgtn_id`
                         -- INNER JOIN `musren_skpd_anggaran_kgtn` musren_skpd_anggaran_kgtn ON musren_skpd_lokasi_kgtn.`id_musren_skpd_lokasi_kgtn` = musren_skpd_anggaran_kgtn.`musren_skpd_lokasi_kgtn_id`
                         LEFT OUTER JOIN `musren_jns_anggaran` musren_jns_anggaran ON musren_skpd_lokasi_kgtn.`sikd_sumber_anggaran_id` = musren_jns_anggaran.`sikd_sumber_anggaran_id`
                         LEFT OUTER JOIN `vw_musren_jns_usulan_kgtn` musren_kgtn ON musren_skpd_lokasi_kgtn.`musren_lokasi_kgtn_id` = musren_kgtn.`id_musren_lokasi_kgtn`
                         INNER JOIN `musren_jns_kgtn` musren_jns_kgtn ON musren_skpd_kgtn.`musren_jns_kgtn_id` = musren_jns_kgtn.`id_musren_jns_kgtn`
                    WHERE
                        musren_skpd_kgtn.`musren_kgtn_type` = 'MusrenKgtnSkpd'
                     AND musren_forum_skpd.`tahun` = :tahun
                     AND IF(:status = '1', musren_skpd_kgtn.`status_verifikasi` = '1',
                            IF(:status = '0', musren_skpd_kgtn.`status_verifikasi` IN ('','0'), 1))
                     AND IF(:id_skpd != '', sikd_satker.id_sikd_satker = :id_skpd, 1)
                     AND IF(:id_subskpd != '', musren_skpd_kgtn.`sikd_sub_skpd_id` = :id_subskpd, 1)
                     AND IF(:id_bidang != '', sikd_bidang.`id_sikd_bidang` = :id_bidang, 1)
                     AND IF(:prioritas != '', musren_skpd_kgtn.prioritas = :prioritas, 1)
                     AND IF(:pengusul = '4', musren_skpd_kgtn.`musren_kgtn_type` = 'MusrenKgtnDprd',
                            IF(:pengusul = '3', musren_skpd_kgtn.`musren_kgtn_type` = 'MusrenKgtnKec',
                            IF(:pengusul = '2', musren_skpd_kgtn.`musren_kgtn_type` = 'MusrenKgtnSkpd', 1)))
                     AND IF(:quota != '', musren_jns_kgtn.`no_jns_kgtn` = :quota, 1)
                     AND IF(:smbr_ang != '', musren_skpd_lokasi_kgtn.sikd_sumber_anggaran_id = :smbr_ang, 1)
                    GROUP BY
                         sikd_satker.kode,
                         sikd_sub_skpd.kode,
                         sikd_bidang.`kd_bidang`,
                         sikd_prog.`kd_prog`,
                         musren_skpd_kgtn.`kd_kgtn`,
                         musren_skpd_kgtn.`no_subkgtn`
                    ORDER BY
                         sikd_satker.kode ASC,
                         sikd_sub_skpd.kode ASC,
                         sikd_bidang.`kd_bidang` ASC,
                         sikd_prog.`kd_prog` ASC,
                         musren_skpd_kgtn.`kd_kgtn` ASC,
                         lpad(musren_skpd_kgtn.`no_subkgtn`,3,0) ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("tahun", $tahun);
            $statement->bindValue("status", $status);
            $statement->bindValue("id_skpd", $idSkpd);
            $statement->bindValue("id_subskpd", $idSubSkpd);
            $statement->bindValue("id_bidang", $idBidang);
            $statement->bindValue("prioritas", $prioritas);
            $statement->bindValue("pengusul", $pengusul);
            $statement->bindValue("quota", $quota);
            $statement->bindValue("smbr_ang", $smbrAng);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getMusrenSkpdListKgtnSub($request)
    {
        try {

            //print_r("ok");exit;

            $idMusrenKgtn = $request->query->get("id_musren_kgtn");
            $pengusul = $request->query->get("pengusul");
            $quota = $request->query->get("quota");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idMusrenKgtn = pack('H*', str_replace('-', '', trim($idMusrenKgtn)));
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                         musren_skpd_lokasi_kgtn.`nm_lokasi` AS musren_skpd_lokasi_kgtn_nm_lokasi_kgtn,
                         ifnull(musren_skpd_lokasi_kgtn.`rt`,'-') AS musren_skpd_lokasi_kgtn_rt,
                         ifnull(musren_skpd_lokasi_kgtn.`rw`,'-') AS musren_skpd_lokasi_kgtn_rw,
                         musren_skpd_lokasi_kgtn.`volume` AS musren_skpd_lokasi_kgtn_volume,
                         musren_skpd_lokasi_kgtn.`satuan` AS musren_skpd_lokasi_kgtn_satuan,
                         vw_musren_skpd_anggaran_kgtn.`jml_apbd_kab` AS vw_musren_skpd_anggaran_kgtn_jml_apbd_kab,
                         vw_musren_skpd_anggaran_kgtn.`jml_apbd_prop` AS vw_musren_skpd_anggaran_kgtn_jml_apbd_prop,
                         vw_musren_skpd_anggaran_kgtn.`jml_apbn` AS vw_musren_skpd_anggaran_kgtn_jml_apbn,
                         vw_musren_skpd_anggaran_kgtn.`jml_lain` AS vw_musren_skpd_anggaran_kgtn_jml_lain
                    FROM
                         `musren_lokasi_kgtn` musren_skpd_lokasi_kgtn 
                         INNER JOIN `musren_kgtn` musren_skpd_kgtn ON musren_skpd_lokasi_kgtn.`musren_kgtn_id` = musren_skpd_kgtn.`id_musren_kgtn` AND musren_skpd_kgtn.`musren_kgtn_type` = 'MusrenKgtnSkpd'
                         INNER JOIN `vw_musren_skpd_anggaran_kgtn` vw_musren_skpd_anggaran_kgtn ON musren_skpd_lokasi_kgtn.`id_musren_lokasi_kgtn` = vw_musren_skpd_anggaran_kgtn.`musren_skpd_lokasi_kgtn_id`
                         LEFT OUTER JOIN `vw_musren_jns_usulan_kgtn` musren_kgtn ON musren_skpd_lokasi_kgtn.`musren_lokasi_kgtn_id` = musren_kgtn.`id_musren_lokasi_kgtn`
                         INNER JOIN `musren_jns_kgtn` musren_jns_kgtn ON musren_skpd_kgtn.`musren_jns_kgtn_id` = musren_jns_kgtn.`id_musren_jns_kgtn`
                    WHERE
                         musren_skpd_kgtn.`id_musren_kgtn` = :id_musren_kgtn
                     AND IF(:pengusul = '4', musren_skpd_kgtn.`musren_kgtn_type` = 'MusrenKgtnDprd',
                            IF(:pengusul = '3', musren_skpd_kgtn.`musren_kgtn_type` = 'MusrenKgtnKec',
                            IF(:pengusul = '2', musren_skpd_kgtn.`musren_kgtn_type` = 'MusrenKgtnSkpd', 1)))
                     AND IF(:quota != '', musren_jns_kgtn.`no_jns_kgtn` = :quota, 1)";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_musren_kgtn", $idMusrenKgtn);
            $statement->bindValue("pengusul", $pengusul);
            $statement->bindValue("quota", $quota);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }

    private function getMusrenSkpdListFlowUsulan($request)
    {
        try {

            $tahun = $request->query->get("tahun");
            $status = $request->query->get("status");
            $idSkpd = $request->query->get("id_skpd");
            $idSubSkpd = $request->query->get("id_subskpd");
            $idBidang = $request->query->get("id_bidang");
            $prioritas = $request->query->get("prioritas");
            $quota = $request->query->get("quota");
            $smbrAng = $request->query->get("smbr_ang");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idSkpd = pack('H*', str_replace('-', '', trim($idSkpd)));
            $idSubSkpd = pack('H*', str_replace('-', '', trim($idSubSkpd)));
            $idBidang = pack('H*', str_replace('-', '', trim($idBidang)));
           
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                         musren_forum_skpd.`tahun` AS musren_musrenbang_tahun,
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
                         sikd_bidang.`kd_bidang` AS sikd_bidang_kd_bidang,
                         sikd_bidang.`nm_bidang` AS sikd_bidang_nm_bidang,
                         sikd_prog.`kd_prog` AS sikd_prog_kd_prog,
                         sikd_prog.`nm_prog` AS sikd_prog_nm_prog,
                         substring(sikd_kgtn.`kd_kgtn`,3,3) AS sikd_kgtn_kode,
                         sikd_kgtn.`kd_kgtn` AS sikd_kgtn_kd_kgtn,
                         sikd_kgtn.`nm_kgtn` AS sikd_kgtn_nm_kgtn,
                         ifnull(substring(vw_appl_kode_wilayah.`kode_wilayah`,7,4),'-') AS vw_appl_kode_wilayah_kode,
                         vw_appl_kode_wilayah.`kode_wilayah` AS vw_appl_kode_wilayah_kode_wilayah,
                         concat(vw_appl_kode_wilayah.`klasifikasi`,' ',vw_appl_kode_wilayah.`nama_wilayah`,', ',vw_appl_kode_wilayah_induk.`nama_wilayah`)AS vw_appl_kode_wilayah_nama_wilayah,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_skpd_kgtn.`id_musren_kgtn`), 1, 8),
                        SUBSTR(HEX(musren_skpd_kgtn.`id_musren_kgtn`), 9, 4),
                        SUBSTR(HEX(musren_skpd_kgtn.`id_musren_kgtn`), 13, 4),
                        SUBSTR(HEX(musren_skpd_kgtn.`id_musren_kgtn`), 17, 4),
                        SUBSTR(HEX(musren_skpd_kgtn.`id_musren_kgtn`), 21)
                         ) AS musren_skpd_kgtn_id_musren_skpd_kgtn,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_skpd_lokasi_kgtn.`id_musren_lokasi_kgtn`), 1, 8),
                        SUBSTR(HEX(musren_skpd_lokasi_kgtn.`id_musren_lokasi_kgtn`), 9, 4),
                        SUBSTR(HEX(musren_skpd_lokasi_kgtn.`id_musren_lokasi_kgtn`), 13, 4),
                        SUBSTR(HEX(musren_skpd_lokasi_kgtn.`id_musren_lokasi_kgtn`), 17, 4),
                        SUBSTR(HEX(musren_skpd_lokasi_kgtn.`id_musren_lokasi_kgtn`), 21)
                         ) AS musren_skpd_lokasi_kgtn_id_musren_skpd_lokasi_kgtn,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_skpd_lokasi_kgtn.`musren_lokasi_kgtn_id`), 1, 8),
                        SUBSTR(HEX(musren_skpd_lokasi_kgtn.`musren_lokasi_kgtn_id`), 9, 4),
                        SUBSTR(HEX(musren_skpd_lokasi_kgtn.`musren_lokasi_kgtn_id`), 13, 4),
                        SUBSTR(HEX(musren_skpd_lokasi_kgtn.`musren_lokasi_kgtn_id`), 17, 4),
                        SUBSTR(HEX(musren_skpd_lokasi_kgtn.`musren_lokasi_kgtn_id`), 21)
                         ) AS musren_skpd_lokasi_kgtn_musren_lokasi_kgtn_id_ref,
                         musren_skpd_lokasi_kgtn.`nm_lokasi` AS musren_lokasi_kgtn_nm_lokasi_kgtn,
                         musren_skpd_lokasi_kgtn.`volume` AS musren_lokasi_kgtn_volume,
                         ifnull(musren_skpd_lokasi_kgtn.`satuan`,'-') AS musren_lokasi_kgtn_satuan,
                         '' AS musren_kgtn_nm_kgtn,
                         ifnull(jml_usulan_desa.jumlah, 0) AS jml_usulan_desa,
                         ifnull(jml_usulan_kec.jumlah, 0) AS jml_usulan_kec,
                         SUM(musren_skpd_lokasi_kgtn.jml_anggaran) AS jml_usulan_skpd,
                         ifnull(jml_usulan_kota.jumlah, 0) AS jml_usulan_kota
                    FROM
                         `musren_kgtn` musren_skpd_kgtn 
                         INNER JOIN `musren_musrenbang` musren_forum_skpd ON musren_skpd_kgtn.`musren_musrenbang_id` = musren_forum_skpd.`id_musren_musrenbang` AND musren_forum_skpd.`musren_musrenbang_type` = 'MusrenForumSkpd'
                         INNER JOIN `sikd_satker` sikd_satker ON musren_skpd_kgtn.`sikd_skpd_id` = sikd_satker.`id_sikd_satker`
                         LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON musren_skpd_kgtn.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                         LEFT OUTER JOIN `sikd_bidang` sikd_bidang ON musren_skpd_kgtn.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                         INNER JOIN `sikd_kgtn` sikd_kgtn ON musren_skpd_kgtn.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                         INNER JOIN `sikd_prog` sikd_prog ON sikd_kgtn.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                         INNER JOIN `musren_lokasi_kgtn` musren_skpd_lokasi_kgtn ON musren_skpd_kgtn.`id_musren_kgtn` = musren_skpd_lokasi_kgtn.`musren_kgtn_id`
                         -- INNER JOIN `musren_skpd_anggaran_kgtn` musren_skpd_anggaran_kgtn ON musren_skpd_lokasi_kgtn.`id_musren_skpd_lokasi_kgtn` = musren_skpd_anggaran_kgtn.`musren_skpd_lokasi_kgtn_id`
                         LEFT OUTER JOIN `vw_musren_jns_usulan_kgtn` musren_kgtn ON musren_skpd_lokasi_kgtn.`musren_lokasi_kgtn_id` = musren_kgtn.`id_musren_lokasi_kgtn`
                         INNER JOIN `vw_appl_kode_wilayah` vw_appl_kode_wilayah ON musren_skpd_lokasi_kgtn.`kd_wilayah` = vw_appl_kode_wilayah.`kode_wilayah`
                         INNER JOIN `vw_appl_kode_wilayah_induk` vw_appl_kode_wilayah_induk ON vw_appl_kode_wilayah.`kode_induk` = vw_appl_kode_wilayah_induk.`kode_wilayah`
                         LEFT OUTER JOIN (select sum(a.jml_anggaran) as jumlah, c.id_musren_lokasi_kgtn as lokasi_id
                                          from musren_lokasi_kgtn a, musren_lokasi_kgtn b, musren_lokasi_kgtn c inner join musren_kgtn d on c.musren_kgtn_id = d.id_musren_kgtn and d.musren_kgtn_type = 'MusrenKgtnSkpd'
                                          where b.id_musren_lokasi_kgtn = c.musren_lokasi_kgtn_id
                                        and a.id_musren_lokasi_kgtn = b.musren_lokasi_kgtn_id
                                        /*and a.musren_lokasi_kgtn_id = b.id_musren_lokasi_kgtn*/
                                  group by lokasi_id order by lokasi_id) as jml_usulan_desa
                              ON jml_usulan_desa.lokasi_id = musren_skpd_lokasi_kgtn.`id_musren_lokasi_kgtn`
                         LEFT OUTER JOIN (select sum(a.jml_anggaran) as jumlah, b.id_musren_lokasi_kgtn as lokasi_id
                                          from musren_lokasi_kgtn a, musren_lokasi_kgtn b inner join musren_kgtn c on b.musren_kgtn_id = c.id_musren_kgtn and c.musren_kgtn_type = 'MusrenKgtnSkpd'
                                          where a.id_musren_lokasi_kgtn = b.`musren_lokasi_kgtn_id`
                                        /*and a.musren_lokasi_kgtn_id = b.id_musren_lokasi_kgtn*/
                                  group by lokasi_id order by lokasi_id) as jml_usulan_kec
                              ON jml_usulan_kec.lokasi_id = musren_skpd_lokasi_kgtn.`id_musren_lokasi_kgtn`
                         LEFT OUTER JOIN (select sum(a.jml_anggaran) as jumlah, b.id_musren_lokasi_kgtn as lokasi_id
                                          from musren_lokasi_kgtn a, musren_lokasi_kgtn b inner join musren_kgtn c on b.musren_kgtn_id = c.id_musren_kgtn and c.musren_kgtn_type = 'MusrenKgtnSkpd'
                                          where a.musren_lokasi_kgtn_id = b.`id_musren_lokasi_kgtn`
                                        /*and a.musren_lokasi_kgtn_id = b.id_musren_lokasi_kgtn*/
                                  group by lokasi_id order by lokasi_id) as jml_usulan_kota
                              ON jml_usulan_kota.lokasi_id = musren_skpd_lokasi_kgtn.`id_musren_lokasi_kgtn`
                    WHERE
                        musren_skpd_kgtn.`musren_kgtn_type` = 'MusrenKgtnSkpd'
                     AND musren_forum_skpd.`tahun` = :tahun
                     AND IF(:status = '1', musren_skpd_kgtn.`status_verifikasi` = '1',
                            IF(:status = '0', musren_skpd_kgtn.`status_verifikasi` IN ('','0'), 1))
                     AND IF(:id_skpd != '', sikd_satker.id_sikd_satker = :id_skpd, 1)
                     AND IF(:id_subskpd != '', musren_skpd_kgtn.`sikd_sub_skpd_id` = :id_subskpd, 1)
                     AND IF(:id_bidang != '', sikd_bidang.`id_sikd_bidang` = :id_bidang, 1)
                     AND IF(:prioritas != '', musren_skpd_kgtn.prioritas = :prioritas, 1)
                     AND IF(:quota != '', musren_kgtn.`jns_kgtn` = :quota, 1)
                     AND IF(:smbr_ang != '', musren_skpd_lokasi_kgtn.sikd_sumber_anggaran_id = :smbr_ang, 1)
                    GROUP BY
                         sikd_satker.kode,
                         sikd_sub_skpd.kode,
                         sikd_bidang.`kd_bidang`,
                         sikd_prog.`kd_prog`,
                         sikd_kgtn.`kd_kgtn`,
                         vw_appl_kode_wilayah_kode,
                         musren_skpd_lokasi_kgtn.`id_musren_lokasi_kgtn`
                    ORDER BY
                         sikd_satker.kode ASC,
                         sikd_sub_skpd.kode ASC,
                         sikd_bidang.`kd_bidang` ASC,
                         sikd_prog.`kd_prog` ASC,
                         sikd_kgtn.`kd_kgtn` ASC,
                         vw_appl_kode_wilayah_kode ASC,
                         musren_skpd_lokasi_kgtn.`id_musren_lokasi_kgtn` ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("tahun", $tahun);
            $statement->bindValue("status", $status);
            $statement->bindValue("id_skpd", $idSkpd);
            $statement->bindValue("id_subskpd", $idSubSkpd);
            $statement->bindValue("id_bidang", $idBidang);
            $statement->bindValue("prioritas", $prioritas);
            $statement->bindValue("quota", $quota);
            $statement->bindValue("smbr_ang", $smbrAng);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getMusrenSkpdRekapUsulanKec($request)
    {
        try {

            //print_r("ok");exit;

            $tahun = $request->query->get("tahun");
            $status = $request->query->get("status");
            $idSkpd = $request->query->get("id_skpd");
            $idBidang = $request->query->get("id_bidang");
            $prioritas = $request->query->get("prioritas");
            $quota = $request->query->get("quota");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idSkpd = pack('H*', str_replace('-', '', trim($idSkpd)));
            $idBidang = pack('H*', str_replace('-', '', trim($idBidang)));
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
                     vw_appl_kode_wilayah.`kode_wilayah` AS vw_appl_kode_wilayah_kode_wilayah,
                     vw_appl_kode_wilayah.`klasifikasi` AS vw_appl_kode_wilayah_klasifikasi,
                     vw_appl_kode_wilayah.`nama_wilayah` AS vw_appl_kode_wilayah_nama_wilayah,
                     substring(vw_appl_kode_wilayah_A.`kode_wilayah`,5,2) AS vw_appl_kode_wilayah_induk_kode,
                     vw_appl_kode_wilayah_A.`kode_wilayah` AS vw_appl_kode_wilayah_induk_kode_wilayah,
                     vw_appl_kode_wilayah_A.`klasifikasi` AS vw_appl_kode_wilayah_induk_klasifikasi,
                     vw_appl_kode_wilayah_A.`nama_wilayah` AS vw_appl_kode_wilayah_induk_nama_wilayah,
                     musren_musrenbang.`tahun` AS musren_musrenbang_tahun,
                     CONCAT_WS('-',
                    SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 1, 8),
                    SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 9, 4),
                    SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 13, 4),
                    SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 17, 4),
                    SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 21)
                     ) AS musren_musrenbang_id_musren_musrenbang,
                     musren_musrenbang.`kd_wilayah` AS musren_musrenbang_kd_wilayah,
                     CONCAT_WS('-',
                    SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 1, 8),
                    SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 9, 4),
                    SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 13, 4),
                    SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 17, 4),
                    SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 21)
                     ) AS musren_kgtn_sikd_musren_bidang_id,
                     sikd_musren_bidang.`kd_bidang` AS sikd_musren_bidang_kd_bidang,
                     sikd_musren_bidang.`nm_bidang` AS sikd_musren_bidang_nm_bidang,
                     CONCAT_WS('-',
                    SUBSTR(HEX(musren_kgtn_kec.`id_musren_kgtn`), 1, 8),
                    SUBSTR(HEX(musren_kgtn_kec.`id_musren_kgtn`), 9, 4),
                    SUBSTR(HEX(musren_kgtn_kec.`id_musren_kgtn`), 13, 4),
                    SUBSTR(HEX(musren_kgtn_kec.`id_musren_kgtn`), 17, 4),
                    SUBSTR(HEX(musren_kgtn_kec.`id_musren_kgtn`), 21)
                     ) AS musren_kgtn_kec_id_musren_kgtn_kec,
                     CONCAT_WS('-',
                    SUBSTR(HEX(musren_kgtn_kec.`sikd_skpd_id`), 1, 8),
                    SUBSTR(HEX(musren_kgtn_kec.`sikd_skpd_id`), 9, 4),
                    SUBSTR(HEX(musren_kgtn_kec.`sikd_skpd_id`), 13, 4),
                    SUBSTR(HEX(musren_kgtn_kec.`sikd_skpd_id`), 17, 4),
                    SUBSTR(HEX(musren_kgtn_kec.`sikd_skpd_id`), 21)
                     ) AS musren_kgtn_kec_skpd_pelaksana_id,
                     count(distinct CONCAT_WS('-',
                    SUBSTR(HEX(musren_kgtn_kec.`id_musren_kgtn`), 1, 8),
                    SUBSTR(HEX(musren_kgtn_kec.`id_musren_kgtn`), 9, 4),
                    SUBSTR(HEX(musren_kgtn_kec.`id_musren_kgtn`), 13, 4),
                    SUBSTR(HEX(musren_kgtn_kec.`id_musren_kgtn`), 17, 4),
                    SUBSTR(HEX(musren_kgtn_kec.`id_musren_kgtn`), 21)
                     ))AS jml_musren_kgtn_kec,
                     ifnull((select count(a.id_musren_kgtn)
                             from musren_kgtn a, musren_lokasi_kgtn b, musren_lokasi_kgtn c inner join musren_kgtn d on c.musren_kgtn_id = d.id_musren_kgtn and d.musren_kgtn_type = 'MusrenKgtnSkpd'
                             where 
                                a.musren_kgtn_type = 'MusrenKgtnKec'
                               and a.`sikd_skpd_id` = sikd_satker.id_sikd_satker
                               and a.`musren_kgtn_skpd_id` != ''
                               and b.musren_kgtn_id = a.id_musren_kgtn
                               and b.kd_wilayah = musren_lokasi_kgtn.`kd_wilayah`
                               and c.musren_lokasi_kgtn_id = b.id_musren_lokasi_kgtn), 0)AS jml_musren_kgtn_kec_disetujui,
                     sum((vw_musren_anggaran_kgtn.jml_apbd_kab+
                          vw_musren_anggaran_kgtn.jml_apbd_prop+
                          vw_musren_anggaran_kgtn.jml_apbn+
                          vw_musren_anggaran_kgtn.jml_lain)) AS jml_anggaran_usulan,
                     ifnull((select sum(a.jml_anggaran) 
                             from musren_lokasi_kgtn a inner join musren_kgtn e on a.musren_kgtn_id = e.id_musren_kgtn and e.musren_kgtn_type = 'MusrenKgtnSkpd', musren_kgtn b,
                                  musren_lokasi_kgtn c, musren_kgtn d
                             where 
                                d.musren_kgtn_type = 'MusrenKgtnKec'
                               and c.kd_wilayah = vw_appl_kode_wilayah.`kode_wilayah`
                               and b.id_musren_kgtn = c.musren_kgtn_id
                               and b.sikd_bidang_id = sikd_musren_bidang.`id_sikd_bidang`
                           and d.id_musren_kgtn = c.`musren_kgtn_id`
                           and d.sikd_skpd_id = sikd_satker.id_sikd_satker
                           and a.musren_lokasi_kgtn_id = c.id_musren_lokasi_kgtn),0) AS jml_anggaran_disetujui
                FROM
                     `musren_musrenbang` musren_musrenbang 
                     INNER JOIN `musren_musrenbang` musren_musrenbang_kec ON musren_musrenbang.`id_musren_musrenbang` = musren_musrenbang_kec.`id_musren_musrenbang` AND musren_musrenbang_kec.`musren_musrenbang_type` = 'MusrenMusrenbangKec'
                     INNER JOIN `musren_kgtn` musren_kgtn ON musren_musrenbang_kec.`id_musren_musrenbang` = musren_kgtn.`musren_musrenbang_id`
                     INNER JOIN `musren_kgtn` musren_kgtn_kec ON musren_kgtn.`id_musren_kgtn` = musren_kgtn_kec.`id_musren_kgtn` AND musren_kgtn_kec.`musren_kgtn_type` = 'MusrenKgtnKec'
                     INNER JOIN `sikd_satker` sikd_satker ON musren_kgtn_kec.`sikd_skpd_id` = sikd_satker.`id_sikd_satker`
                     LEFT OUTER JOIN `sikd_bidang` sikd_musren_bidang ON musren_kgtn.`sikd_bidang_id` = sikd_musren_bidang.`id_sikd_bidang`
                     INNER JOIN `musren_lokasi_kgtn` musren_lokasi_kgtn ON musren_kgtn_kec.`id_musren_kgtn` = musren_lokasi_kgtn.`musren_kgtn_id`
                     INNER JOIN `musren_lokasi_kgtn` musren_lokasi_kgtn_skpd ON musren_lokasi_kgtn.`id_musren_lokasi_kgtn` = musren_lokasi_kgtn_skpd.`musren_lokasi_kgtn_id`
                     INNER JOIN `musren_kgtn` musren_skpd_kgtn ON musren_lokasi_kgtn_skpd.`musren_kgtn_id` = musren_skpd_kgtn.`id_musren_kgtn` AND musren_skpd_kgtn.`musren_kgtn_type` = 'MusrenKgtnSkpd'
                    INNER JOIN `vw_appl_kode_wilayah` vw_appl_kode_wilayah ON musren_lokasi_kgtn.`kd_wilayah` = vw_appl_kode_wilayah.`kode_wilayah`
                     INNER JOIN `vw_appl_kode_wilayah` vw_appl_kode_wilayah_A 
                        ON musren_musrenbang.`kd_wilayah` = vw_appl_kode_wilayah_A.`kode_wilayah`
                     INNER JOIN `vw_musren_anggaran_kgtn` vw_musren_anggaran_kgtn ON musren_lokasi_kgtn.`id_musren_lokasi_kgtn` = vw_musren_anggaran_kgtn.`musren_lokasi_kgtn_id`
                     INNER JOIN `musren_jns_kgtn` musren_jns_kgtn ON musren_kgtn.`musren_jns_kgtn_id` = musren_jns_kgtn.`id_musren_jns_kgtn`
                WHERE
                     musren_musrenbang.`tahun` = :tahun
                 AND IF(:status = '1', musren_skpd_kgtn.`status_verifikasi` = '1',
                        IF(:status = '0', musren_skpd_kgtn.`status_verifikasi` IN ('','0'), 1))
                 AND IF(:id_skpd != '', sikd_satker.id_sikd_satker = :id_skpd, 1)
                 AND IF(:id_bidang!='', musren_kgtn.`sikd_bidang_id` = :id_bidang, 1)
                 AND IF(:prioritas!='', musren_kgtn.`prioritas` = :prioritas, 1)
                 AND IF(:quota != '', musren_jns_kgtn.`no_jns_kgtn` = :quota, 1)
                 AND (vw_musren_anggaran_kgtn.jml_apbd_kab+
                      vw_musren_anggaran_kgtn.jml_apbd_prop+
                      vw_musren_anggaran_kgtn.jml_apbn+
                      vw_musren_anggaran_kgtn.jml_lain) >= 0
                GROUP BY
                     sikd_satker.`id_sikd_satker`,
                     sikd_musren_bidang.`kd_bidang`,
                     vw_appl_kode_wilayah_A.`kode_wilayah`,
                     vw_appl_kode_wilayah.`kode_wilayah`
                HAVING (jml_musren_kgtn_kec >= 0)

                ORDER BY
                     sikd_satker.`id_sikd_satker` ASC,
                     sikd_musren_bidang.`kd_bidang` ASC,
                     vw_appl_kode_wilayah_A.`kode_wilayah` ASC,
                     RPAD(vw_appl_kode_wilayah.`kode_wilayah`,10,0) ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("tahun", $tahun);
            $statement->bindValue("status", $status);
            $statement->bindValue("id_skpd", $idSkpd);
            $statement->bindValue("id_bidang", $idBidang);
            $statement->bindValue("prioritas", $prioritas);
            $statement->bindValue("quota", $quota);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getMusrenSkpdRekapUsulanRes($request)
    {
        try {

            //print_r("ok");exit;

            $tahun = $request->query->get("tahun");
            $status = $request->query->get("status");
            $idSkpd = $request->query->get("id_skpd");
            $idBidang = $request->query->get("id_bidang");
            $prioritas = $request->query->get("prioritas");
            $quota = $request->query->get("quota");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idSkpd = pack('H*', str_replace('-', '', trim($idSkpd)));
            $idBidang = pack('H*', str_replace('-', '', trim($idBidang)));
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
                     musren_fraksi.`nm_fraksi` AS musren_fraksi_nm_fraksi,
                     musren_musrenbang.`tahun` AS musren_musrenbang_tahun,
                     CONCAT_WS('-',
                    SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 1, 8),
                    SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 9, 4),
                    SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 13, 4),
                    SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 17, 4),
                    SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 21)
                     ) AS musren_musrenbang_id_musren_musrenbang,
                     musren_musrenbang.`kd_wilayah` AS musren_musrenbang_kd_wilayah,
                     CONCAT_WS('-',
                    SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 1, 8),
                    SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 9, 4),
                    SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 13, 4),
                    SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 17, 4),
                    SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 21)
                     ) AS musren_kgtn_sikd_musren_bidang_id,
                     sikd_musren_bidang.`kd_bidang` AS sikd_musren_bidang_kd_bidang,
                     sikd_musren_bidang.`nm_bidang` AS sikd_musren_bidang_nm_bidang,
                     CONCAT_WS('-',
                    SUBSTR(HEX(musren_kgtn_reses.`id_musren_kgtn`), 1, 8),
                    SUBSTR(HEX(musren_kgtn_reses.`id_musren_kgtn`), 9, 4),
                    SUBSTR(HEX(musren_kgtn_reses.`id_musren_kgtn`), 13, 4),
                    SUBSTR(HEX(musren_kgtn_reses.`id_musren_kgtn`), 17, 4),
                    SUBSTR(HEX(musren_kgtn_reses.`id_musren_kgtn`), 21)
                     ) AS musren_kgtn_kec_id_musren_kgtn_kec,
                     CONCAT_WS('-',
                    SUBSTR(HEX(musren_kgtn_reses.`sikd_skpd_id`), 1, 8),
                    SUBSTR(HEX(musren_kgtn_reses.`sikd_skpd_id`), 9, 4),
                    SUBSTR(HEX(musren_kgtn_reses.`sikd_skpd_id`), 13, 4),
                    SUBSTR(HEX(musren_kgtn_reses.`sikd_skpd_id`), 17, 4),
                    SUBSTR(HEX(musren_kgtn_reses.`sikd_skpd_id`), 21)
                     ) AS musren_kgtn_kec_skpd_pelaksana_id,
                     count(distinct CONCAT_WS('-',
                    SUBSTR(HEX(musren_kgtn_reses.`id_musren_kgtn`), 1, 8),
                    SUBSTR(HEX(musren_kgtn_reses.`id_musren_kgtn`), 9, 4),
                    SUBSTR(HEX(musren_kgtn_reses.`id_musren_kgtn`), 13, 4),
                    SUBSTR(HEX(musren_kgtn_reses.`id_musren_kgtn`), 17, 4),
                    SUBSTR(HEX(musren_kgtn_reses.`id_musren_kgtn`), 21)
                     ))AS jml_musren_kgtn_kec,
                     ifnull((select count(a.id_musren_kgtn)
                             from musren_kgtn a, musren_lokasi_kgtn b, musren_lokasi_kgtn c inner join musren_kgtn d on c.musren_kgtn_id = d.id_musren_kgtn and d.musren_kgtn_type = 'MusrenKgtnSkpd', musren_kgtn a1
                             where 
                                a.musren_kgtn_type = 'MusrenKgtnDprd'
                               and a.`id_musren_kgtn` = a1.id_musren_kgtn
                               and a1.sikd_bidang_id = sikd_musren_bidang.`id_sikd_bidang`
                               and a.`sikd_skpd_id` = sikd_satker.id_sikd_satker
                               and a.`musren_kgtn_skpd_id` != ''
                               and a.musren_fraksi_dprd_id = musren_fraksi.id_musren_fraksi_dprd
                               and b.musren_kgtn_id = a.id_musren_kgtn
                               and b.kd_wilayah = musren_lokasi_kgtn.`kd_wilayah`
                               and c.musren_lokasi_kgtn_id = b.id_musren_lokasi_kgtn), 0)AS jml_musren_kgtn_kec_disetujui,
                     sum((vw_musren_anggaran_kgtn.jml_apbd_kab+
                          vw_musren_anggaran_kgtn.jml_apbd_prop+
                          vw_musren_anggaran_kgtn.jml_apbn+
                          vw_musren_anggaran_kgtn.jml_lain)) AS jml_anggaran_usulan,
                     ifnull((select sum(a.jml_anggaran) 
                             from musren_lokasi_kgtn a inner join musren_kgtn e on a.musren_kgtn_id = e.id_musren_kgtn and e.musren_kgtn_type = 'MusrenKgtnSkpd', musren_kgtn b,
                                  musren_lokasi_kgtn c, musren_kgtn d
                             where 
                                d.musren_kgtn_type = 'MusrenKgtnDprd'
                               and b.id_musren_kgtn = c.musren_kgtn_id
                               and b.sikd_bidang_id = sikd_musren_bidang.`id_sikd_bidang`
                           and d.id_musren_kgtn = c.`musren_kgtn_id`
                           and d.sikd_skpd_id = sikd_satker.id_sikd_satker
                           and a.musren_lokasi_kgtn_id = c.id_musren_lokasi_kgtn 
                               and d.musren_fraksi_dprd_id = musren_fraksi.id_musren_fraksi_dprd),0) AS jml_anggaran_disetujui
                FROM
                     `musren_musrenbang` musren_musrenbang 
                     INNER JOIN `musren_musrenbang` musren_musrenbang_reses ON musren_musrenbang.`id_musren_musrenbang` = musren_musrenbang_reses.`id_musren_musrenbang` AND musren_musrenbang_reses.`musren_musrenbang_type` = 'MusrenDprd'
                     INNER JOIN `musren_kgtn` musren_kgtn ON musren_musrenbang_reses.`id_musren_musrenbang` = musren_kgtn.`musren_musrenbang_id`
                     INNER JOIN `musren_kgtn` musren_kgtn_reses ON musren_kgtn.`id_musren_kgtn` = musren_kgtn_reses.`id_musren_kgtn` AND musren_kgtn_reses.`musren_kgtn_type` = 'MusrenKgtnDprd'
                     INNER JOIN `sikd_satker` sikd_satker ON musren_kgtn_reses.`sikd_skpd_id` = sikd_satker.`id_sikd_satker`
                     LEFT OUTER JOIN `sikd_bidang` sikd_musren_bidang ON musren_kgtn.`sikd_bidang_id` = sikd_musren_bidang.`id_sikd_bidang`
                     INNER JOIN `musren_lokasi_kgtn` musren_lokasi_kgtn ON musren_kgtn_reses.`id_musren_kgtn` = musren_lokasi_kgtn.`musren_kgtn_id`
                     INNER JOIN `musren_lokasi_kgtn` musren_lokasi_kgtn_skpd ON musren_lokasi_kgtn.`id_musren_lokasi_kgtn` = musren_lokasi_kgtn_skpd.`musren_lokasi_kgtn_id`
                     INNER JOIN `musren_kgtn` musren_skpd_kgtn ON musren_lokasi_kgtn_skpd.`musren_kgtn_id` = musren_skpd_kgtn.`id_musren_kgtn` AND musren_skpd_kgtn.`musren_kgtn_type` = 'MusrenKgtnSkpd'
                     INNER JOIN `musren_fraksi_dprd` musren_fraksi ON musren_kgtn_reses.`musren_fraksi_dprd_id` = musren_fraksi.`id_musren_fraksi_dprd`
                     INNER JOIN `vw_musren_anggaran_kgtn` vw_musren_anggaran_kgtn ON musren_lokasi_kgtn.`id_musren_lokasi_kgtn` = vw_musren_anggaran_kgtn.`musren_lokasi_kgtn_id`
                     INNER JOIN `musren_jns_kgtn` musren_jns_kgtn ON musren_kgtn.`musren_jns_kgtn_id` = musren_jns_kgtn.`id_musren_jns_kgtn`
                WHERE
                     musren_musrenbang.`tahun` = :tahun
                 AND IF(:status = '1', musren_skpd_kgtn.`status_verifikasi` = '1',
                        IF(:status = '0', musren_skpd_kgtn.`status_verifikasi` IN ('','0'), 1))
                 AND IF(:id_skpd != '', sikd_satker.id_sikd_satker = :id_skpd, 1)
                 AND IF(:id_bidang!='', musren_kgtn.`sikd_bidang_id` = :id_bidang, 1)
                 AND IF(:prioritas!='', musren_kgtn.`prioritas` = :prioritas, 1)
                 AND IF(:quota != '', musren_jns_kgtn.`no_jns_kgtn` = :quota, 1)
                 AND (vw_musren_anggaran_kgtn.jml_apbd_kab+
                      vw_musren_anggaran_kgtn.jml_apbd_prop+
                      vw_musren_anggaran_kgtn.jml_apbn+
                      vw_musren_anggaran_kgtn.jml_lain) >= 0
                GROUP BY
                     sikd_satker.`id_sikd_satker`,
                     sikd_musren_bidang.`kd_bidang`,
                     musren_fraksi.`id_musren_fraksi_dprd`
                HAVING (jml_musren_kgtn_kec >= 0)

                ORDER BY
                     sikd_satker.`id_sikd_satker` ASC,
                     sikd_musren_bidang.`kd_bidang` ASC,
                     musren_fraksi.`nm_fraksi` ASC,
                     musren_fraksi.`id_musren_fraksi_dprd` ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("tahun", $tahun);
            $statement->bindValue("status", $status);
            $statement->bindValue("id_skpd", $idSkpd);
            $statement->bindValue("id_bidang", $idBidang);
            $statement->bindValue("prioritas", $prioritas);
            $statement->bindValue("quota", $quota);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getMusrenSkpdListKgtnKotaStjRekap($request)
    {
        try {

            //print_r("ok");exit;

            $tahun = $request->query->get("tahun");
            $status = $request->query->get("status");
            $idSkpd = $request->query->get("id_skpd");
            $idSubSkpd = $request->query->get("id_subskpd");
            $idBidang = $request->query->get("id_bidang");
            $prioritas = $request->query->get("prioritas");
            $quota = $request->query->get("quota");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idSkpd = pack('H*', str_replace('-', '', trim($idSkpd)));
            $idSubSkpd = pack('H*', str_replace('-', '', trim($idSubSkpd)));
            $idBidang = pack('H*', str_replace('-', '', trim($idBidang)));
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                         sikd_satker.`kode` AS sikd_satker_kode,
                         sikd_satker.`nama` AS sikd_satker_nama,
                         sikd_sub_skpd.`kode` AS sikd_sub_skpd_kode,
                         sikd_sub_skpd.`nama` AS sikd_sub_skpd_nama,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_skpd_kgtn.`id_musren_kgtn`), 1, 8),
                        SUBSTR(HEX(musren_skpd_kgtn.`id_musren_kgtn`), 9, 4),
                        SUBSTR(HEX(musren_skpd_kgtn.`id_musren_kgtn`), 13, 4),
                        SUBSTR(HEX(musren_skpd_kgtn.`id_musren_kgtn`), 17, 4),
                        SUBSTR(HEX(musren_skpd_kgtn.`id_musren_kgtn`), 21)
                         ) AS musren_skpd_kgtn_id_musren_skpd_kgtn,
                         substring(sikd_kgtn.kd_kgtn,3,3) AS skpd_kgtn_kode,
                         musren_skpd_kgtn.`kd_kgtn` AS musren_skpd_kgtn_kd_kgtn,
                         musren_skpd_kgtn.`nm_kgtn` AS musren_skpd_kgtn_nm_kgtn,
                         musren_skpd_kgtn.`no_subkgtn` AS musren_skpd_kgtn_no_subkgtn,
                         musren_skpd_kgtn.`nm_subkgtn` AS musren_skpd_kgtn_nm_subkgtn,
                         musren_skpd_kgtn.`prioritas` AS musren_skpd_kgtn_prioritas,
                         musren_skpd_kgtn.`sifat_kgtn` AS musren_skpd_kgtn_sifat_kgtn,
                         musren_skpd_kgtn.`output` AS musren_skpd_kgtn_output,
                         musren_skpd_kgtn.`outcome` AS musren_skpd_kgtn_outcome,
                        CONCAT_WS('-',
                        SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 1, 8),
                        SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 9, 4),
                        SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 13, 4),
                        SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 17, 4),
                        SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 21)
                         ) AS sikd_bidang_id_sikd_bidang,
                         sikd_bidang.`kd_bidang` AS sikd_bidang_kd_bidang,
                         sikd_bidang.`nm_bidang` AS sikd_bidang_nm_bidang,
                         sikd_prog.`kd_prog` AS sikd_prog_kd_prog,
                         sikd_prog.`nm_prog` AS sikd_prog_nm_prog,
                         sikd_kgtn.`kd_kgtn` AS sikd_kgtn_kd_kgtn,
                         sikd_kgtn.`nm_kgtn` AS sikd_kgtn_nm_kgtn,
                         SUM(vw_musren_skpd_anggaran_kgtn.`jml_apbd_kab`+
                             vw_musren_skpd_anggaran_kgtn.`jml_apbd_prop`+
                             vw_musren_skpd_anggaran_kgtn.`jml_lain`+
                             vw_musren_skpd_anggaran_kgtn.`jml_apbn`) AS vw_musren_anggaran_kgtn_jml_usulan,
                         ifnull(musren_kgtn_anggaran_disetujui.jumlah, 0) AS musren_kgtn_anggaran_disetujui
                    FROM
                         `musren_kgtn` musren_skpd_kgtn 
                         INNER JOIN `musren_musrenbang` musren_forum_skpd ON musren_skpd_kgtn.`musren_musrenbang_id` = musren_forum_skpd.`id_musren_musrenbang` AND musren_forum_skpd.`musren_musrenbang_type` = 'MusrenForumSkpd'
                         INNER JOIN `sikd_satker` sikd_satker ON musren_skpd_kgtn.`sikd_skpd_id` = sikd_satker.`id_sikd_satker`
                         LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON musren_skpd_kgtn.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                         LEFT OUTER JOIN `sikd_bidang` sikd_bidang ON musren_skpd_kgtn.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                         INNER JOIN `sikd_kgtn` sikd_kgtn ON musren_skpd_kgtn.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                         INNER JOIN `sikd_prog` sikd_prog ON sikd_kgtn.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                         INNER JOIN `musren_lokasi_kgtn` musren_skpd_lokasi_kgtn ON musren_skpd_kgtn.`id_musren_kgtn` = musren_skpd_lokasi_kgtn.`musren_kgtn_id`
                         INNER JOIN `vw_musren_skpd_anggaran_kgtn` vw_musren_skpd_anggaran_kgtn ON musren_skpd_lokasi_kgtn.`id_musren_lokasi_kgtn` = vw_musren_skpd_anggaran_kgtn.`musren_skpd_lokasi_kgtn_id`
                         LEFT OUTER JOIN `vw_musren_jns_usulan_kgtn` musren_kgtn ON musren_skpd_lokasi_kgtn.`musren_lokasi_kgtn_id` = musren_kgtn.`id_musren_lokasi_kgtn`
                         LEFT OUTER JOIN (select sum(a.jml_anggaran) as jumlah, b.id_musren_lokasi_kgtn as lokasi_id
                                          from musren_lokasi_kgtn a, musren_lokasi_kgtn b inner join musren_kgtn c on b.`musren_kgtn_id` = c.`id_musren_kgtn` and c.`musren_kgtn_type` = 'MusrenKgtnSkpd'
                                          where a.musren_lokasi_kgtn_id = b.`id_musren_lokasi_kgtn`
                                        -- and a.musren_lokasi_kgtn_id = b.id_musren_lokasi_kgtn
                                  group by lokasi_id order by lokasi_id) as musren_kgtn_anggaran_disetujui
                              ON musren_kgtn_anggaran_disetujui.lokasi_id = musren_skpd_lokasi_kgtn.`id_musren_lokasi_kgtn`
                        INNER JOIN `musren_jns_kgtn` musren_jns_kgtn ON musren_skpd_kgtn.`musren_jns_kgtn_id` = musren_jns_kgtn.`id_musren_jns_kgtn`
                    WHERE
                        musren_skpd_kgtn.`musren_kgtn_type` = 'MusrenKgtnSkpd'
                     AND musren_forum_skpd.`tahun` = :tahun
                     AND IF(:status = '1', musren_skpd_kgtn.`status_verifikasi` = '1',
                            IF(:status = '0', musren_skpd_kgtn.`status_verifikasi` IN ('','0'), 1))
                     AND IF(:id_skpd != '', sikd_satker.id_sikd_satker = :id_skpd, 1)
                     AND IF(:id_subskpd != '', musren_skpd_kgtn.`sikd_sub_skpd_id` = :id_subskpd, 1)
                     AND IF(:id_bidang != '', sikd_bidang.`id_sikd_bidang` = :id_bidang, 1)
                     AND IF(:prioritas != '', musren_skpd_kgtn.prioritas = :prioritas, 1)
                     AND IF(:quota != '', musren_jns_kgtn.`no_jns_kgtn` = :quota, 1)
                    GROUP BY
                         sikd_satker.kode,
                         sikd_sub_skpd.kode,
                         sikd_bidang.`kd_bidang`,
                         sikd_prog.`kd_prog`,
                         sikd_kgtn.`kd_kgtn`,
                         musren_skpd_kgtn.no_subkgtn
                    HAVING (musren_kgtn_anggaran_disetujui >= 0)
                    ORDER BY
                         sikd_satker.kode ASC,
                         sikd_sub_skpd.kode ASC,
                         sikd_bidang.`kd_bidang` ASC,
                         sikd_prog.`kd_prog` ASC,
                         sikd_kgtn.`kd_kgtn` ASC,
                         lpad(musren_skpd_kgtn_no_subkgtn,3,0) ASC,
                         cast(trim(leading 'P' from musren_skpd_kgtn.`prioritas`) as unsigned)";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("tahun", $tahun);
            $statement->bindValue("status", $status);
            $statement->bindValue("id_skpd", $idSkpd);
            $statement->bindValue("id_subskpd", $idSubSkpd);
            $statement->bindValue("id_bidang", $idBidang);
            $statement->bindValue("prioritas", $prioritas);
            $statement->bindValue("quota", $quota);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getMusrenSkpdListKgtnKotaStj($request)
    {
        try {

            //print_r("ok");exit;

            $tahun = $request->query->get("tahun");
            $status = $request->query->get("status");
            $idSkpd = $request->query->get("id_skpd");
            $idSubSkpd = $request->query->get("id_subskpd");
            $idBidang = $request->query->get("id_bidang");
            $prioritas = $request->query->get("prioritas");
            $quota = $request->query->get("quota");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idSkpd = pack('H*', str_replace('-', '', trim($idSkpd)));
            $idSubSkpd = pack('H*', str_replace('-', '', trim($idSubSkpd)));
            $idBidang = pack('H*', str_replace('-', '', trim($idBidang)));
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                         sikd_satker.`kode` AS sikd_satker_kode,
                         sikd_satker.`nama` AS sikd_satker_nama,
                         sikd_sub_skpd.`kode` AS sikd_sub_skpd_kode,
                         sikd_sub_skpd.`nama` AS sikd_sub_skpd_nama,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_skpd_kgtn.`id_musren_kgtn`), 1, 8),
                        SUBSTR(HEX(musren_skpd_kgtn.`id_musren_kgtn`), 9, 4),
                        SUBSTR(HEX(musren_skpd_kgtn.`id_musren_kgtn`), 13, 4),
                        SUBSTR(HEX(musren_skpd_kgtn.`id_musren_kgtn`), 17, 4),
                        SUBSTR(HEX(musren_skpd_kgtn.`id_musren_kgtn`), 21)
                         ) AS musren_skpd_kgtn_id_musren_skpd_kgtn,
                         substring(sikd_kgtn.kd_kgtn,3,3) AS skpd_kgtn_kode,
                         musren_skpd_kgtn.`kd_kgtn` AS musren_skpd_kgtn_kd_kgtn,
                         musren_skpd_kgtn.`nm_kgtn` AS musren_skpd_kgtn_nm_kgtn,
                         musren_skpd_kgtn.`no_subkgtn` AS musren_skpd_kgtn_no_subkgtn,
                         musren_skpd_kgtn.`nm_subkgtn` AS musren_skpd_kgtn_nm_subkgtn,
                         musren_skpd_kgtn.`prioritas` AS musren_skpd_kgtn_prioritas,
                         musren_skpd_kgtn.`sifat_kgtn` AS musren_skpd_kgtn_sifat_kgtn,
                         musren_skpd_kgtn.`output` AS musren_skpd_kgtn_output,
                         musren_skpd_kgtn.`outcome` AS musren_skpd_kgtn_outcome,
                        CONCAT_WS('-',
                        SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 1, 8),
                        SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 9, 4),
                        SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 13, 4),
                        SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 17, 4),
                        SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 21)
                         ) AS sikd_bidang_id_sikd_bidang,
                         sikd_bidang.`kd_bidang` AS sikd_bidang_kd_bidang,
                         sikd_bidang.`nm_bidang` AS sikd_bidang_nm_bidang,
                         sikd_prog.`kd_prog` AS sikd_prog_kd_prog,
                         sikd_prog.`nm_prog` AS sikd_prog_nm_prog,
                         sikd_kgtn.`kd_kgtn` AS sikd_kgtn_kd_kgtn,
                         sikd_kgtn.`nm_kgtn` AS sikd_kgtn_nm_kgtn,
                         SUM(vw_musren_skpd_anggaran_kgtn.`jml_apbd_kab`+
                             vw_musren_skpd_anggaran_kgtn.`jml_apbd_prop`+
                             vw_musren_skpd_anggaran_kgtn.`jml_lain`+
                             vw_musren_skpd_anggaran_kgtn.`jml_apbn`) AS vw_musren_anggaran_kgtn_jml_usulan,
                         ifnull(musren_kgtn_anggaran_disetujui.jumlah, 0) AS musren_kgtn_anggaran_disetujui

                    FROM
                         `musren_kgtn` musren_skpd_kgtn 
                         INNER JOIN `musren_musrenbang` musren_forum_skpd ON musren_skpd_kgtn.`musren_musrenbang_id` = musren_forum_skpd.`id_musren_musrenbang` AND musren_forum_skpd.`musren_musrenbang_type` = 'MusrenForumSkpd'
                         INNER JOIN `sikd_satker` sikd_satker ON musren_skpd_kgtn.`sikd_skpd_id` = sikd_satker.`id_sikd_satker`
                         LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON musren_skpd_kgtn.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                         LEFT OUTER JOIN `sikd_bidang` sikd_bidang ON musren_skpd_kgtn.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                         INNER JOIN `sikd_kgtn` sikd_kgtn ON musren_skpd_kgtn.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                         INNER JOIN `sikd_prog` sikd_prog ON sikd_kgtn.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                         INNER JOIN `musren_lokasi_kgtn` musren_skpd_lokasi_kgtn ON musren_skpd_kgtn.`id_musren_kgtn` = musren_skpd_lokasi_kgtn.`musren_kgtn_id`
                         INNER JOIN `vw_musren_skpd_anggaran_kgtn` vw_musren_skpd_anggaran_kgtn ON musren_skpd_lokasi_kgtn.`id_musren_lokasi_kgtn` = vw_musren_skpd_anggaran_kgtn.`musren_skpd_lokasi_kgtn_id`
                         LEFT OUTER JOIN `vw_musren_jns_usulan_kgtn` musren_kgtn ON musren_skpd_lokasi_kgtn.`musren_lokasi_kgtn_id` = musren_kgtn.`id_musren_lokasi_kgtn`
                         LEFT OUTER JOIN (select sum(a.jml_anggaran) as jumlah, b.id_musren_lokasi_kgtn as lokasi_id
                                          from musren_lokasi_kgtn a, musren_lokasi_kgtn b inner join musren_kgtn c on b.`musren_kgtn_id` = c.`id_musren_kgtn` and c.`musren_kgtn_type` = 'MusrenKgtnSkpd'
                                          where a.musren_lokasi_kgtn_id = b.`id_musren_lokasi_kgtn`
                                        -- and a.musren_lokasi_kgtn_id = b.id_musren_lokasi_kgtn
                                  group by lokasi_id order by lokasi_id) as musren_kgtn_anggaran_disetujui
                              ON musren_kgtn_anggaran_disetujui.lokasi_id = musren_skpd_lokasi_kgtn.`id_musren_lokasi_kgtn`
                        INNER JOIN `musren_jns_kgtn` musren_jns_kgtn ON musren_skpd_kgtn.`musren_jns_kgtn_id` = musren_jns_kgtn.`id_musren_jns_kgtn`
                    WHERE
                        musren_skpd_kgtn.`musren_kgtn_type` = 'MusrenKgtnSkpd'
                     AND musren_forum_skpd.`tahun` = :tahun
                     AND IF(:status = '1', musren_skpd_kgtn.`status_verifikasi` = '1',
                            IF(:status = '0', musren_skpd_kgtn.`status_verifikasi` IN ('','0'), 1))
                     AND IF(:id_skpd != '', sikd_satker.id_sikd_satker = :id_skpd, 1)
                     AND IF(:id_subskpd != '', musren_skpd_kgtn.`sikd_sub_skpd_id` = :id_subskpd, 1)
                     AND IF(:id_bidang != '', sikd_bidang.`id_sikd_bidang` = :id_bidang, 1)
                     AND IF(:prioritas != '', musren_skpd_kgtn.prioritas = :prioritas, 1)
                     AND IF(:quota != '', musren_jns_kgtn.`no_jns_kgtn` = :quota, 1)
                    GROUP BY
                         sikd_satker.kode,
                         sikd_sub_skpd.kode,
                         sikd_bidang.`kd_bidang`,
                         sikd_prog.`kd_prog`,
                         sikd_kgtn.`kd_kgtn`,
                         musren_skpd_kgtn.no_subkgtn
                    HAVING (musren_kgtn_anggaran_disetujui >= 0)
                    ORDER BY
                         sikd_satker.kode ASC,
                         sikd_sub_skpd.kode ASC,
                         sikd_bidang.`kd_bidang` ASC,
                         sikd_prog.`kd_prog` ASC,
                         sikd_kgtn.`kd_kgtn` ASC,
                         lpad(musren_skpd_kgtn_no_subkgtn,3,0) ASC,
                         cast(trim(leading 'P' from musren_skpd_kgtn.`prioritas`) as unsigned) ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("tahun", $tahun);
            $statement->bindValue("status", $status);
            $statement->bindValue("id_skpd", $idSkpd);
            $statement->bindValue("id_subskpd", $idSubSkpd);
            $statement->bindValue("id_bidang", $idBidang);
            $statement->bindValue("prioritas", $prioritas);
            $statement->bindValue("quota", $quota);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getMusrenSkpdListKgtnKotaStjSub($request)
    {
        try {

            //print_r("ok");exit;

            $idMusrenKgtn = $request->query->get("id_musren_kgtn");
            $quota = $request->query->get("quota");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idMusrenKgtn = pack('H*', str_replace('-', '', trim($idMusrenKgtn)));
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                         musren_skpd_lokasi_kgtn.`nm_lokasi` AS musren_skpd_lokasi_kgtn_nm_lokasi_kgtn,
                         musren_skpd_lokasi_kgtn.`volume` AS musren_skpd_lokasi_kgtn_volume,
                         musren_skpd_lokasi_kgtn.`satuan` AS musren_skpd_lokasi_kgtn_satuan,
                         (vw_musren_skpd_anggaran_kgtn.`jml_apbd_kab`+
                          vw_musren_skpd_anggaran_kgtn.`jml_apbd_prop`+
                          vw_musren_skpd_anggaran_kgtn.`jml_lain`+
                          vw_musren_skpd_anggaran_kgtn.`jml_apbn`) AS jml_usulan,
                          ifnull((select sum(a.jml_anggaran) 
                                  from musren_lokasi_kgtn a
                                  where a.musren_lokasi_kgtn_id = musren_skpd_lokasi_kgtn.`id_musren_lokasi_kgtn`
                                    /*and a.musren_lokasi_kgtn_id = b.id_musren_lokasi_kgtn*/), 0) AS jml_disetujui
                    FROM
                         `musren_lokasi_kgtn` musren_skpd_lokasi_kgtn 
                         INNER JOIN `musren_kgtn` musren_skpd_kgtn ON musren_skpd_lokasi_kgtn.`musren_kgtn_id` = musren_skpd_kgtn.`id_musren_kgtn` AND musren_skpd_kgtn.`musren_kgtn_type` = 'MusrenKgtnSkpd'
                         INNER JOIN `vw_musren_skpd_anggaran_kgtn` vw_musren_skpd_anggaran_kgtn ON musren_skpd_lokasi_kgtn.`id_musren_lokasi_kgtn` = vw_musren_skpd_anggaran_kgtn.`musren_skpd_lokasi_kgtn_id`
                         LEFT OUTER JOIN `vw_musren_jns_usulan_kgtn` musren_kgtn ON musren_skpd_lokasi_kgtn.`musren_lokasi_kgtn_id` = musren_kgtn.`id_musren_lokasi_kgtn`
                         INNER JOIN `musren_jns_kgtn` musren_jns_kgtn ON musren_skpd_kgtn.`musren_jns_kgtn_id` = musren_jns_kgtn.`id_musren_jns_kgtn`
                    WHERE
                         musren_skpd_kgtn.`id_musren_kgtn` = :id_musren_kgtn
                     AND IF(:quota != '', musren_jns_kgtn.`no_jns_kgtn` = :quota, 1)";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_musren_kgtn", $idMusrenKgtn);
            $statement->bindValue("quota", $quota);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getMusrenSkpdHibahBansos($request)
    {
        try {

            //print_r("ok");exit;

            $tahun = $request->query->get("tahun");
            $idSkpd = $request->query->get("id_skpd");
            $idSubSkpd = $request->query->get("id_subskpd");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idSkpd = pack('H*', str_replace('-', '', trim($idSkpd)));
            $idSubSkpd = pack('H*', str_replace('-', '', trim($idSubSkpd)));
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_hibah_bansos.`id_musren_hibah_bansos`), 1, 8),
                        SUBSTR(HEX(musren_hibah_bansos.`id_musren_hibah_bansos`), 9, 4),
                        SUBSTR(HEX(musren_hibah_bansos.`id_musren_hibah_bansos`), 13, 4),
                        SUBSTR(HEX(musren_hibah_bansos.`id_musren_hibah_bansos`), 17, 4),
                        SUBSTR(HEX(musren_hibah_bansos.`id_musren_hibah_bansos`), 21)
                         ) AS musren_hibah_bansos_id_musren_hibah_bansos,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_forum_hibah_bansos.`musren_musrenbang_id`), 1, 8),
                        SUBSTR(HEX(musren_forum_hibah_bansos.`musren_musrenbang_id`), 9, 4),
                        SUBSTR(HEX(musren_forum_hibah_bansos.`musren_musrenbang_id`), 13, 4),
                        SUBSTR(HEX(musren_forum_hibah_bansos.`musren_musrenbang_id`), 17, 4),
                        SUBSTR(HEX(musren_forum_hibah_bansos.`musren_musrenbang_id`), 21)
                         ) AS musren_forum_hibah_bansos_musren_forum_skpd_id,
                         musren_forum_skpd.`tahun` AS musren_forum_skpd_tahun,
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
                         musren_hibah_bansos.`kd_rekening` AS musren_hibah_bansos_kd_rekening,
                         sikd_rek_rincian_obj.`kd_rek_rincian_obj` AS sikd_rek_rincian_obj_kd_rek_rincian_obj,
                         sikd_rek_rincian_obj.`nm_rek_rincian_obj` AS sikd_rek_rincian_obj_nm_rek_rincian_obj,
                         musren_hibah_bansos.`no_urut` AS musren_hibah_bansos_no_urut,
                         musren_hibah_bansos.`nm_penerima` AS musren_hibah_bansos_nm_penerima,
                         musren_hibah_bansos.`alamat_penerima` AS musren_hibah_bansos_alamat_penerima,
                         musren_hibah_bansos.`jumlah` AS musren_hibah_bansos_jumlah,
                         musren_hibah_bansos.`keterangan` AS musren_hibah_bansos_keterangan
                    FROM
                         `musren_hibah_bansos` musren_hibah_bansos 
                         INNER JOIN `musren_hibah_bansos` musren_forum_hibah_bansos ON musren_hibah_bansos.`id_musren_hibah_bansos` = musren_forum_hibah_bansos.`id_musren_hibah_bansos` AND musren_forum_hibah_bansos.`musren_anggaran_btl_type` = 'MusrenHibahBansosForum'
                         INNER JOIN `musren_musrenbang` musren_forum_skpd ON musren_forum_hibah_bansos.`musren_musrenbang_id` = musren_forum_skpd.`id_musren_musrenbang` AND musren_forum_skpd.`musren_musrenbang_type` = 'MusrenForumSkpd'  
                         INNER JOIN `sikd_satker` sikd_satker ON musren_hibah_bansos.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                         INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON musren_hibah_bansos.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                         INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                         INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                         LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON musren_hibah_bansos.`sikd_sub_satker_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                    WHERE
                         musren_forum_skpd.`tahun` = :tahun
                     AND IF(:id_skpd != '', sikd_satker.id_sikd_satker = :id_skpd, 1)
                     AND IF(:id_subskpd != '', musren_hibah_bansos.`sikd_sub_satker_id` = :id_subskpd, 1)
                    ORDER BY
                         sikd_satker.`kode`,
                         sikd_sub_skpd.`kode`,
                         sikd_rek_jenis.`kd_rek_jenis`,
                         sikd_rek_obj.`kd_rek_obj`,
                         sikd_rek_rincian_obj.`kd_rek_rincian_obj`,
                         musren_hibah_bansos.`no_urut`";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("tahun", $tahun);
            $statement->bindValue("id_skpd", $idSkpd);
            $statement->bindValue("id_subskpd", $idSubSkpd);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getMusrenSkpdRekapAnggaran($request)
    {
        try {

            //print_r("ok");exit;

            $tahun = $request->query->get("tahun");
            $idSkpd = $request->query->get("id_skpd");
            $idSubSkpd = $request->query->get("id_subskpd");
            $status = $request->query->get("status");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idSkpd = pack('H*', str_replace('-', '', trim($idSkpd)));
            $idSubSkpd = pack('H*', str_replace('-', '', trim($idSubSkpd)));
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_forum_skpd.`id_musren_musrenbang`), 1, 8),
                        SUBSTR(HEX(musren_forum_skpd.`id_musren_musrenbang`), 9, 4),
                        SUBSTR(HEX(musren_forum_skpd.`id_musren_musrenbang`), 13, 4),
                        SUBSTR(HEX(musren_forum_skpd.`id_musren_musrenbang`), 17, 4),
                        SUBSTR(HEX(musren_forum_skpd.`id_musren_musrenbang`), 21)
                         ) AS musren_forum_skpd_id_musren_forum_skpd,
                         musren_forum_skpd.`tahun` AS musren_forum_skpd_tahun,
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
                         '520' AS kd_rekening,
                         'BELANJA' AS nm_rekening,
                         SUM(musren_skpd_lokasi_kgtn.`jml_anggaran`) AS jml_anggaran
                    FROM
                         `musren_kgtn` musren_skpd_kgtn 
                         INNER JOIN `musren_lokasi_kgtn` musren_skpd_lokasi_kgtn ON musren_skpd_kgtn.`id_musren_kgtn` = musren_skpd_lokasi_kgtn.`musren_kgtn_id`
                         AND IF(:status = '1', musren_skpd_kgtn.`status_verifikasi` = '1',
                                 IF(:status = '0', musren_skpd_kgtn.`status_verifikasi` IN ('','0'), 1))
                         -- INNER JOIN `musren_skpd_anggaran_kgtn` musren_skpd_anggaran_kgtn ON musren_skpd_lokasi_kgtn.`id_musren_skpd_lokasi_kgtn` = musren_skpd_anggaran_kgtn.`musren_skpd_lokasi_kgtn_id`
                         INNER JOIN `musren_musrenbang` musren_forum_skpd ON musren_skpd_kgtn.`musren_musrenbang_id` = musren_forum_skpd.`id_musren_musrenbang` AND musren_forum_skpd.`musren_musrenbang_type` = 'MusrenForumSkpd'
                         INNER JOIN `sikd_satker` sikd_satker ON musren_skpd_kgtn.`sikd_skpd_id` = sikd_satker.`id_sikd_satker`
                         LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON musren_skpd_kgtn.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                    WHERE
                        musren_skpd_kgtn.`musren_kgtn_type` = 'MusrenKgtnSkpd'
                     AND musren_forum_skpd.`tahun` = :tahun
                     AND IF(:id_skpd != '', sikd_satker.id_sikd_satker = :id_skpd, 1)
                     AND IF(:id_subskpd != '', musren_skpd_kgtn.`sikd_sub_skpd_id` = :id_subskpd, 1)
                    GROUP BY 
                         musren_forum_skpd.`id_musren_musrenbang`,
                         sikd_satker.`id_sikd_satker`,
                         sikd_sub_skpd.`id_sikd_sub_skpd`
                    UNION
                    SELECT
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_forum_skpd.`id_musren_musrenbang`), 1, 8),
                        SUBSTR(HEX(musren_forum_skpd.`id_musren_musrenbang`), 9, 4),
                        SUBSTR(HEX(musren_forum_skpd.`id_musren_musrenbang`), 13, 4),
                        SUBSTR(HEX(musren_forum_skpd.`id_musren_musrenbang`), 17, 4),
                        SUBSTR(HEX(musren_forum_skpd.`id_musren_musrenbang`), 21)
                         ) AS musren_forum_skpd_id_musren_forum_skpd,
                         musren_forum_skpd.`tahun` AS musren_forum_skpd_tahun,
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
                         sikd_rek_jenis.kd_rek_jenis AS kd_rekening,
                         sikd_rek_jenis.nm_rek_jenis AS nm_rekening,
                         SUM(musren_anggaran_btl.`jumlah`) AS jml_anggaran
                    FROM
                         `musren_musrenbang` musren_forum_skpd 
                         INNER JOIN `musren_anggaran_btl` musren_forum_anggaran_btl ON musren_forum_skpd.`id_musren_musrenbang` = musren_forum_anggaran_btl.`musren_musrenbang_id` AND musren_forum_anggaran_btl.`musren_anggaran_btl_type` = 'MusrenHibahBansosForum'
                         INNER JOIN `musren_anggaran_btl` musren_anggaran_btl ON musren_forum_anggaran_btl.`id_musren_anggaran_btl` = musren_anggaran_btl.`id_musren_anggaran_btl`
                         INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON musren_anggaran_btl.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                         INNER JOIN `sikd_satker` sikd_satker ON musren_anggaran_btl.`sikd_skpd_id` = sikd_satker.`id_sikd_satker`
                         LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON musren_anggaran_btl.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                    WHERE
                        musren_forum_skpd.`musren_musrenbang_type` = 'MusrenForumSkpd'
                     AND musren_forum_skpd.`tahun` = :tahun
                     AND IF(:id_skpd != '', sikd_satker.id_sikd_satker = :id_skpd, 1)
                     AND IF(:id_subskpd != '', musren_anggaran_btl.`sikd_sub_skpd_id` = :id_subskpd, 1)
                    GROUP BY 
                         musren_forum_skpd.`id_musren_musrenbang`,
                         sikd_satker.`id_sikd_satker`,
                         sikd_sub_skpd.`id_sikd_sub_skpd`,
                         sikd_rek_jenis.kd_rek_jenis
                    UNION
                    SELECT
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_forum_skpd.`id_musren_musrenbang`), 1, 8),
                        SUBSTR(HEX(musren_forum_skpd.`id_musren_musrenbang`), 9, 4),
                        SUBSTR(HEX(musren_forum_skpd.`id_musren_musrenbang`), 13, 4),
                        SUBSTR(HEX(musren_forum_skpd.`id_musren_musrenbang`), 17, 4),
                        SUBSTR(HEX(musren_forum_skpd.`id_musren_musrenbang`), 21)
                         ) AS musren_forum_skpd_id_musren_forum_skpd,
                         musren_forum_skpd.`tahun` AS musren_forum_skpd_tahun,
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
                         sikd_rek_jenis.kd_rek_jenis AS kd_rekening,
                         sikd_rek_jenis.nm_rek_jenis AS nm_rekening,
                         SUM(musren_hibah_bansos.`jumlah`) AS jml_anggaran
                    FROM
                         `musren_musrenbang` musren_forum_skpd 
                         INNER JOIN `musren_hibah_bansos` musren_forum_hibah_bansos ON musren_forum_skpd.`id_musren_musrenbang` = musren_forum_hibah_bansos.`musren_musrenbang_id` AND musren_forum_hibah_bansos.`musren_anggaran_btl_type` = 'MusrenHibahBansosForum'
                         INNER JOIN `musren_hibah_bansos` musren_hibah_bansos ON musren_hibah_bansos.`id_musren_hibah_bansos` = musren_forum_hibah_bansos.`id_musren_hibah_bansos`
                         INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON musren_hibah_bansos.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                         INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                         INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                         INNER JOIN `sikd_satker` sikd_satker ON musren_hibah_bansos.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                         LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON musren_hibah_bansos.`sikd_sub_satker_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                    WHERE
                        musren_forum_skpd.`musren_musrenbang_type` = 'MusrenForumSkpd'
                     AND musren_forum_skpd.`tahun` = :tahun
                     AND IF(:id_skpd != '', sikd_satker.id_sikd_satker = :id_skpd, 1)
                     AND IF(:id_subskpd != '', musren_hibah_bansos.`sikd_sub_satker_id` = :id_subskpd, 1)
                    GROUP BY 
                         musren_forum_skpd.`id_musren_musrenbang`,
                         sikd_satker.`id_sikd_satker`,
                         sikd_sub_skpd.`id_sikd_sub_skpd`,
                         sikd_rek_jenis.kd_rek_jenis
                    ORDER BY
                         sikd_satker_kode,
                         sikd_sub_skpd_kode,
                         kd_rekening";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("status", $status);
            $statement->bindValue("tahun", $tahun);
            $statement->bindValue("id_skpd", $idSkpd);
            $statement->bindValue("id_subskpd", $idSubSkpd);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getAnomaliSmbrAnggaran($request)
    {
        try {

            //print_r("ok");exit;
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                         sikd_satker.`kode` AS sikd_satker_kode,
                         sikd_satker.`nama` AS sikd_satker_nama,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_skpd_kgtn.`id_musren_kgtn`), 1, 8),
                        SUBSTR(HEX(musren_skpd_kgtn.`id_musren_kgtn`), 9, 4),
                        SUBSTR(HEX(musren_skpd_kgtn.`id_musren_kgtn`), 13, 4),
                        SUBSTR(HEX(musren_skpd_kgtn.`id_musren_kgtn`), 17, 4),
                        SUBSTR(HEX(musren_skpd_kgtn.`id_musren_kgtn`), 21)
                         ) AS id_musren_skpd_kgtn,
                         musren_skpd_kgtn.`kd_kgtn` AS musren_skpd_kgtn_kd_kgtn,
                         musren_skpd_kgtn.`nm_kgtn` AS musren_skpd_kgtn_nm_kgtn,
                         musren_skpd_kgtn.`no_subkgtn` AS musren_skpd_kgtn_no_subkgtn,
                         musren_skpd_kgtn.`nm_subkgtn` AS musren_skpd_kgtn_nm_subkgtn,
                         musren_skpd_lokasi_kgtn.`nm_lokasi` AS musren_skpd_lokasi_kgtn_nm_lokasi_kgtn,
                         musren_skpd_lokasi_kgtn.`jml_anggaran` AS musren_skpd_anggaran_kgtn_jml_anggaran,
                         ifnull(CONCAT_WS('-',
                        SUBSTR(HEX(sikd_sumber_anggaran.`id_sikd_sumber_anggaran`), 1, 8),
                        SUBSTR(HEX(sikd_sumber_anggaran.`id_sikd_sumber_anggaran`), 9, 4),
                        SUBSTR(HEX(sikd_sumber_anggaran.`id_sikd_sumber_anggaran`), 13, 4),
                        SUBSTR(HEX(sikd_sumber_anggaran.`id_sikd_sumber_anggaran`), 17, 4),
                        SUBSTR(HEX(sikd_sumber_anggaran.`id_sikd_sumber_anggaran`), 21)
                         ),'-') AS sikd_sumber_anggaran_id_sikd_sumber_anggaran,
                         sikd_sumber_anggaran.`nm_sumber_anggaran` AS sikd_sumber_anggaran_nm_sumber_anggaran,
                         ifnull(sikd_sumber_anggaran.`singkatan`,'-') AS sikd_sumber_anggaran_singkatan,
                         sikd_sumber_anggaran.`tipe_anggaran` AS sikd_sumber_anggaran_tipe_anggaran
                    FROM
                         `musren_kgtn` musren_skpd_kgtn 
                         INNER JOIN `musren_lokasi_kgtn` musren_skpd_lokasi_kgtn ON musren_skpd_kgtn.`id_musren_kgtn` = musren_skpd_lokasi_kgtn.`musren_kgtn_id`
                         -- INNER JOIN `musren_skpd_anggaran_kgtn` musren_skpd_anggaran_kgtn ON musren_skpd_lokasi_kgtn.`id_musren_skpd_lokasi_kgtn` = musren_skpd_anggaran_kgtn.`musren_skpd_lokasi_kgtn_id`
                         LEFT OUTER JOIN `sikd_sumber_anggaran` sikd_sumber_anggaran ON musren_skpd_lokasi_kgtn.`sikd_sumber_anggaran_id` = sikd_sumber_anggaran.`id_sikd_sumber_anggaran`
                         INNER JOIN `sikd_satker` sikd_satker ON musren_skpd_kgtn.`sikd_skpd_id` = sikd_satker.`id_sikd_satker`
                    WHERE
                         musren_skpd_lokasi_kgtn.sikd_sumber_anggaran_id NOT IN 
                        (SELECT id_sikd_sumber_anggaran FROM `sikd_sumber_anggaran`
                         WHERE tipe_anggaran = 'Musrenbang')
                    ORDER BY
                         sikd_satker.`kode`";
            
            $statement = $this->connection->prepare($sql);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }

    //KABUPATEN/KOTA
    private function getMusrenKabListFlowUsulanDesa($request)
    {
        try {

            $kec = $request->query->get("kec");
            $status = $request->query->get("status");
            $idBidang = $request->query->get("id_bidang");
            $prioritas = $request->query->get("prioritas");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idBidang = pack('H*', str_replace('-', '', trim($idBidang)));
           
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                         vw_appl_kode_wilayah_induk.`kode_wilayah` AS vw_appl_kode_wilayah_induk_kode_wilayah,
                         vw_appl_kode_wilayah_induk.`nama_wilayah` AS vw_appl_kode_wilayah_induk_nama_wilayah,
                         vw_appl_kode_wilayah.`kode_wilayah` AS vw_appl_kode_wilayah_kode_wilayah,
                         vw_appl_kode_wilayah.`klasifikasi` AS vw_appl_kode_wilayah_klasifikasi,
                         vw_appl_kode_wilayah.`nama_wilayah` AS vw_appl_kode_wilayah_nama_wilayah,
                         musren_musrenbang.`tahun` AS musren_musrenbang_tahun,
                         sikd_bidang.`kd_bidang` AS sikd_bidang_kd_bidang,
                         sikd_bidang.`nm_bidang` AS sikd_bidang_nm_bidang,
                         count(distinct CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn_desa.`id_musren_kgtn`), 1, 8),
                        SUBSTR(HEX(musren_kgtn_desa.`id_musren_kgtn`), 9, 4),
                        SUBSTR(HEX(musren_kgtn_desa.`id_musren_kgtn`), 13, 4),
                        SUBSTR(HEX(musren_kgtn_desa.`id_musren_kgtn`), 17, 4),
                        SUBSTR(HEX(musren_kgtn_desa.`id_musren_kgtn`), 21)
                         )) AS jml_usulan_kgtn,
                         count(distinct CONCAT_WS('-',
                        SUBSTR(HEX(musren_lokasi_kgtn.id_musren_lokasi_kgtn), 1, 8),
                        SUBSTR(HEX(musren_lokasi_kgtn.id_musren_lokasi_kgtn), 9, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.id_musren_lokasi_kgtn), 13, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.id_musren_lokasi_kgtn), 17, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.id_musren_lokasi_kgtn), 21)
                         )) AS jml_lokasi_kgtn,
                         SUM(vw_musren_anggaran_kgtn_desa.jml_apbd_kab+
                             vw_musren_anggaran_kgtn_desa.jml_apbd_prop+
                             vw_musren_anggaran_kgtn_desa.jml_apbn+
                             vw_musren_anggaran_kgtn_desa.jml_sumber_lain) AS jml_usulan_desa,
                         ifnull(sum(usulan_kec.jml_anggaran), 0) AS jml_usulan_kec,
                         ifnull(sum(usulan_skpd.jml_anggaran), 0) AS jml_usulan_skpd,
                         ifnull(sum(usulan_kota.jml_anggaran), 0) AS jml_usulan_kota
                    FROM
                         `musren_kgtn` musren_kgtn_desa 
                         INNER JOIN `musren_kgtn` musren_kgtn ON musren_kgtn_desa.`id_musren_kgtn` = musren_kgtn.`id_musren_kgtn`
                         INNER JOIN `musren_musrenbang` musren_musrenbang ON musren_kgtn.`musren_musrenbang_id` = musren_musrenbang.`id_musren_musrenbang`
                         INNER JOIN `sikd_bidang` sikd_bidang ON musren_kgtn.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                         INNER JOIN `musren_lokasi_kgtn` musren_lokasi_kgtn ON musren_kgtn.`id_musren_kgtn` = musren_lokasi_kgtn.`musren_kgtn_id`
                         LEFT OUTER JOIN (select a.jml_anggaran, a.musren_lokasi_kgtn_id, a.id_musren_lokasi_kgtn  
                                 from musren_lokasi_kgtn a
                                 /*where a.musren_lokasi_kgtn_id = b.id_musren_lokasi_kgtn*/) AS usulan_kec ON
                             musren_lokasi_kgtn.`id_musren_lokasi_kgtn` = usulan_kec.musren_lokasi_kgtn_id 
                         LEFT OUTER JOIN (select a.jml_anggaran, a.musren_lokasi_kgtn_id, a.id_musren_lokasi_kgtn  
                                 from musren_lokasi_kgtn a inner join musren_kgtn b on a.musren_kgtn_id = b.id_musren_kgtn and b.musren_kgtn_type = 'MusrenKgtnSkpd'
                                 /*where a.musren_skpd_lokasi_kgtn_id = b.id_musren_skpd_lokasi_kgtn*/) AS usulan_skpd ON
                             usulan_kec.id_musren_lokasi_kgtn = usulan_skpd.musren_lokasi_kgtn_id 
                         LEFT OUTER JOIN (select a.jml_anggaran, a.musren_lokasi_kgtn_id  
                                 from musren_lokasi_kgtn a
                                 /*where a.musren_lokasi_kgtn_id = b.id_musren_lokasi_kgtn*/) AS usulan_kota ON
                             usulan_skpd.`id_musren_lokasi_kgtn` = usulan_kota.musren_lokasi_kgtn_id 
                         INNER JOIN `vw_musren_anggaran_kgtn_desa` vw_musren_anggaran_kgtn_desa ON musren_lokasi_kgtn.`id_musren_lokasi_kgtn` = vw_musren_anggaran_kgtn_desa.`musren_lokasi_kgtn_id`
                         INNER JOIN `musren_musrenbang` musren_musrenbang_desa ON musren_musrenbang.`id_musren_musrenbang` = musren_musrenbang_desa.`id_musren_musrenbang` AND musren_musrenbang_desa.`musren_musrenbang_type` = 'MusrenMusrenbangDesa'
                         INNER JOIN `vw_appl_kode_wilayah` vw_appl_kode_wilayah ON musren_musrenbang.`kd_wilayah` = vw_appl_kode_wilayah.`kode_wilayah`
                         INNER JOIN `vw_appl_kode_wilayah_induk` vw_appl_kode_wilayah_induk ON vw_appl_kode_wilayah.`kode_induk` = vw_appl_kode_wilayah_induk.`kode_wilayah`
                    WHERE
                        musren_kgtn_desa.`musren_kgtn_type` = 'MusrenKgtnDesa'
                     AND IF(:kec != '', vw_appl_kode_wilayah_induk.`kode_wilayah` = :kec, 1)
                     AND IF(:status = '1', musren_kgtn_desa.`status_verifikasi` = '1',
                            IF(:status = '0', musren_kgtn_desa.`status_verifikasi` IN ('','0'), 1))
                     AND IF(:id_bidang != '', musren_kgtn.`sikd_bidang_id` = :id_bidang, 1)
                     AND IF(:prioritas != '', musren_kgtn.`prioritas` = :prioritas, 1)
                     AND ((vw_musren_anggaran_kgtn_desa.jml_apbd_kab+
                           vw_musren_anggaran_kgtn_desa.jml_apbd_prop+
                           vw_musren_anggaran_kgtn_desa.jml_apbn+
                           vw_musren_anggaran_kgtn_desa.jml_sumber_lain) >= 0)
                    GROUP BY
                         vw_appl_kode_wilayah_induk.`kode_wilayah`,
                         sikd_bidang.`kd_bidang`,
                         vw_appl_kode_wilayah.`kode_wilayah`
                    ORDER BY
                         vw_appl_kode_wilayah_induk.`kode_wilayah` ASC,
                         sikd_bidang.`kd_bidang` ASC,
                         vw_appl_kode_wilayah.`kode_wilayah` ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("kec", $kec);
            $statement->bindValue("status", $status);
            $statement->bindValue("id_bidang", $idBidang);
            $statement->bindValue("prioritas", $prioritas);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getMusrenKabListFlowUsulanDesaW($request)
    {
        try {

            $kec = $request->query->get("kec");
            $status = $request->query->get("status");
            $idBidang = $request->query->get("id_bidang");
            $prioritas = $request->query->get("prioritas");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idBidang = pack('H*', str_replace('-', '', trim($idBidang)));
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                         vw_appl_kode_wilayah_induk.`kode_wilayah` AS vw_appl_kode_wilayah_induk_kode_wilayah,
                         vw_appl_kode_wilayah_induk.`nama_wilayah` AS vw_appl_kode_wilayah_induk_nama_wilayah,
                         substring(vw_appl_kode_wilayah.`kode_wilayah`,7,4) AS vw_appl_kode_wilayah_kode,
                         vw_appl_kode_wilayah.`kode_wilayah` AS vw_appl_kode_wilayah_kode_wilayah,
                         vw_appl_kode_wilayah.`klasifikasi` AS vw_appl_kode_wilayah_klasifikasi,
                         vw_appl_kode_wilayah.`nama_wilayah` AS vw_appl_kode_wilayah_nama_wilayah,
                         musren_musrenbang.`tahun` AS musren_musrenbang_tahun,
                         sikd_bidang.`kd_bidang` AS sikd_bidang_kd_bidang,
                         sikd_bidang.`nm_bidang` AS sikd_bidang_nm_bidang,
                         count(distinct CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn_desa.`id_musren_kgtn`), 1, 8),
                        SUBSTR(HEX(musren_kgtn_desa.`id_musren_kgtn`), 9, 4),
                        SUBSTR(HEX(musren_kgtn_desa.`id_musren_kgtn`), 13, 4),
                        SUBSTR(HEX(musren_kgtn_desa.`id_musren_kgtn`), 17, 4),
                        SUBSTR(HEX(musren_kgtn_desa.`id_musren_kgtn`), 21)
                         )) AS jml_usulan_kgtn,
                         count(distinct CONCAT_WS('-',
                        SUBSTR(HEX(musren_lokasi_kgtn.id_musren_lokasi_kgtn), 1, 8),
                        SUBSTR(HEX(musren_lokasi_kgtn.id_musren_lokasi_kgtn), 9, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.id_musren_lokasi_kgtn), 13, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.id_musren_lokasi_kgtn), 17, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.id_musren_lokasi_kgtn), 21)
                         )) AS jml_lokasi_kgtn,
                         SUM(vw_musren_anggaran_kgtn_desa.jml_apbd_kab+
                             vw_musren_anggaran_kgtn_desa.jml_apbd_prop+
                             vw_musren_anggaran_kgtn_desa.jml_apbn+
                             vw_musren_anggaran_kgtn_desa.jml_sumber_lain) AS jml_usulan_desa,
                         ifnull(sum(usulan_kec.jml_anggaran), 0) AS jml_usulan_kec,
                         ifnull(sum(usulan_skpd.jml_anggaran), 0) AS jml_usulan_skpd,
                         ifnull(sum(usulan_kota.jml_anggaran), 0) AS jml_usulan_kota
                    FROM
                         `musren_kgtn` musren_kgtn_desa 
                         INNER JOIN `musren_kgtn` musren_kgtn ON musren_kgtn_desa.`id_musren_kgtn` = musren_kgtn.`id_musren_kgtn`
                         INNER JOIN `musren_musrenbang` musren_musrenbang ON musren_kgtn.`musren_musrenbang_id` = musren_musrenbang.`id_musren_musrenbang`
                         INNER JOIN `sikd_bidang` sikd_bidang ON musren_kgtn.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                         INNER JOIN `musren_lokasi_kgtn` musren_lokasi_kgtn ON musren_kgtn.`id_musren_kgtn` = musren_lokasi_kgtn.`musren_kgtn_id`
                         LEFT OUTER JOIN (select a.jml_anggaran, a.musren_lokasi_kgtn_id, a.id_musren_lokasi_kgtn  
                                 from musren_lokasi_kgtn a
                                 /*where a.musren_lokasi_kgtn_id = b.id_musren_lokasi_kgtn*/) AS usulan_kec ON
                             musren_lokasi_kgtn.`id_musren_lokasi_kgtn` = usulan_kec.musren_lokasi_kgtn_id 
                         LEFT OUTER JOIN (select a.jml_anggaran, a.musren_lokasi_kgtn_id, a.id_musren_lokasi_kgtn  
                                 from musren_lokasi_kgtn a inner join musren_kgtn b on a.musren_kgtn_id = b.id_musren_kgtn and b.musren_kgtn_type = 'MusrenKgtnSkpd'
                                 /*where a.musren_skpd_lokasi_kgtn_id = b.id_musren_skpd_lokasi_kgtn*/) AS usulan_skpd ON
                             usulan_kec.id_musren_lokasi_kgtn = usulan_skpd.musren_lokasi_kgtn_id 
                         LEFT OUTER JOIN (select a.jml_anggaran, a.musren_lokasi_kgtn_id  
                                 from musren_lokasi_kgtn a
                                 /*where a.musren_lokasi_kgtn_id = b.id_musren_lokasi_kgtn*/) AS usulan_kota ON
                             usulan_skpd.`id_musren_lokasi_kgtn` = usulan_kota.musren_lokasi_kgtn_id 
                         INNER JOIN `vw_musren_anggaran_kgtn_desa` vw_musren_anggaran_kgtn_desa ON musren_lokasi_kgtn.`id_musren_lokasi_kgtn` = vw_musren_anggaran_kgtn_desa.`musren_lokasi_kgtn_id`
                         INNER JOIN `musren_musrenbang` musren_musrenbang_desa ON musren_musrenbang.`id_musren_musrenbang` = musren_musrenbang_desa.`id_musren_musrenbang` AND musren_musrenbang_desa.`musren_musrenbang_type` = 'MusrenMusrenbangDesa'
                         INNER JOIN `vw_appl_kode_wilayah` vw_appl_kode_wilayah ON musren_musrenbang.`kd_wilayah` = vw_appl_kode_wilayah.`kode_wilayah`
                         INNER JOIN `vw_appl_kode_wilayah_induk` vw_appl_kode_wilayah_induk ON vw_appl_kode_wilayah.`kode_induk` = vw_appl_kode_wilayah_induk.`kode_wilayah`
                    WHERE
                        musren_kgtn_desa.`musren_kgtn_type` = 'MusrenKgtnDesa'
                     AND IF(:kec != '', vw_appl_kode_wilayah_induk.`kode_wilayah` = :kec, 1)
                     AND IF(:status = '1', musren_kgtn_desa.`status_verifikasi` = '1',
                            IF(:status = '0', musren_kgtn_desa.`status_verifikasi` IN ('','0'), 1))
                     AND IF(:id_bidang != '', musren_kgtn.`sikd_bidang_id` = :id_bidang, 1)
                     AND IF(:prioritas != '', musren_kgtn.`prioritas` = :prioritas, 1)
                     AND ((vw_musren_anggaran_kgtn_desa.jml_apbd_kab+
                           vw_musren_anggaran_kgtn_desa.jml_apbd_prop+
                           vw_musren_anggaran_kgtn_desa.jml_apbn+
                           vw_musren_anggaran_kgtn_desa.jml_sumber_lain) >= 0)
                    GROUP BY
                         vw_appl_kode_wilayah_induk.`kode_wilayah`,
                         vw_appl_kode_wilayah.`kode_wilayah`,
                         sikd_bidang.`kd_bidang`
                    ORDER BY
                         vw_appl_kode_wilayah_induk.`kode_wilayah` ASC,
                         vw_appl_kode_wilayah.`kode_wilayah` ASC,
                         sikd_bidang.`kd_bidang` ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("kec", $kec);
            $statement->bindValue("status", $status);
            $statement->bindValue("id_bidang", $idBidang);
            $statement->bindValue("prioritas", $prioritas);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getMusrenKabListFlowUsulanDesaF($request)
    {
        try {

            $kec = $request->query->get("kec");
            $status = $request->query->get("status");
            $idFungsi = $request->query->get("id_fungsi");
            $prioritas = $request->query->get("prioritas");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idFungsi = pack('H*', str_replace('-', '', trim($idFungsi)));
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                         vw_appl_kode_wilayah_induk.`kode_wilayah` AS vw_appl_kode_wilayah_induk_kode_wilayah,
                         vw_appl_kode_wilayah_induk.`nama_wilayah` AS vw_appl_kode_wilayah_induk_nama_wilayah,
                         vw_appl_kode_wilayah.`kode_wilayah` AS vw_appl_kode_wilayah_kode_wilayah,
                         vw_appl_kode_wilayah.`klasifikasi` AS vw_appl_kode_wilayah_klasifikasi,
                         vw_appl_kode_wilayah.`nama_wilayah` AS vw_appl_kode_wilayah_nama_wilayah,
                         musren_musrenbang.`tahun` AS musren_musrenbang_tahun,
                         sikd_fungsi.`kd_fungsi` AS sikd_fungsi_kd_fungsi,
                         sikd_fungsi.`nm_fungsi` AS sikd_fungsi_nm_fungsi,
                         count(distinct CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn_desa.`id_musren_kgtn`), 1, 8),
                        SUBSTR(HEX(musren_kgtn_desa.`id_musren_kgtn`), 9, 4),
                        SUBSTR(HEX(musren_kgtn_desa.`id_musren_kgtn`), 13, 4),
                        SUBSTR(HEX(musren_kgtn_desa.`id_musren_kgtn`), 17, 4),
                        SUBSTR(HEX(musren_kgtn_desa.`id_musren_kgtn`), 21)
                         )) AS jml_usulan_kgtn,
                         count(distinct CONCAT_WS('-',
                        SUBSTR(HEX(musren_lokasi_kgtn.id_musren_lokasi_kgtn), 1, 8),
                        SUBSTR(HEX(musren_lokasi_kgtn.id_musren_lokasi_kgtn), 9, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.id_musren_lokasi_kgtn), 13, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.id_musren_lokasi_kgtn), 17, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.id_musren_lokasi_kgtn), 21)
                         )) AS jml_lokasi_kgtn,
                         SUM(vw_musren_anggaran_kgtn_desa.jml_apbd_kab+
                             vw_musren_anggaran_kgtn_desa.jml_apbd_prop+
                             vw_musren_anggaran_kgtn_desa.jml_apbn+
                             vw_musren_anggaran_kgtn_desa.jml_sumber_lain) AS jml_usulan_desa,
                         ifnull(sum(usulan_kec.jml_anggaran), 0) AS jml_usulan_kec,
                         ifnull(sum(usulan_skpd.jml_anggaran), 0) AS jml_usulan_skpd,
                         ifnull(sum(usulan_kota.jml_anggaran), 0) AS jml_usulan_kota
                    FROM
                         `musren_kgtn` musren_kgtn_desa 
                         INNER JOIN `musren_kgtn` musren_kgtn ON musren_kgtn_desa.`id_musren_kgtn` = musren_kgtn.`id_musren_kgtn`
                         INNER JOIN `musren_musrenbang` musren_musrenbang ON musren_kgtn.`musren_musrenbang_id` = musren_musrenbang.`id_musren_musrenbang`
                         INNER JOIN `sikd_bidang` sikd_bidang ON musren_kgtn.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                         INNER JOIN `sikd_fungsi` sikd_fungsi ON sikd_bidang.`sikd_fungsi_id` = sikd_fungsi.`id_sikd_fungsi`
                         INNER JOIN `musren_lokasi_kgtn` musren_lokasi_kgtn ON musren_kgtn.`id_musren_kgtn` = musren_lokasi_kgtn.`musren_kgtn_id`
                         LEFT OUTER JOIN (select a.jml_anggaran, a.musren_lokasi_kgtn_id, a.id_musren_lokasi_kgtn  
                                 from musren_lokasi_kgtn a
                                 /*where a.musren_lokasi_kgtn_id = b.id_musren_lokasi_kgtn*/) AS usulan_kec ON
                             musren_lokasi_kgtn.`id_musren_lokasi_kgtn` = usulan_kec.musren_lokasi_kgtn_id 
                         LEFT OUTER JOIN (select a.jml_anggaran, a.musren_lokasi_kgtn_id, a.id_musren_lokasi_kgtn  
                                 from musren_lokasi_kgtn a inner join musren_kgtn b on a.musren_kgtn_id = b.id_musren_kgtn and b.musren_kgtn_type = 'MusrenKgtnSkpd'
                                 /*where a.musren_skpd_lokasi_kgtn_id = b.id_musren_skpd_lokasi_kgtn*/) AS usulan_skpd ON
                             usulan_kec.id_musren_lokasi_kgtn = usulan_skpd.musren_lokasi_kgtn_id 
                         LEFT OUTER JOIN (select a.jml_anggaran, a.musren_lokasi_kgtn_id 
                                 from musren_lokasi_kgtn a
                                 /*where a.musren_lokasi_kgtn_id = b.id_musren_lokasi_kgtn*/) AS usulan_kota ON
                             usulan_skpd.`id_musren_lokasi_kgtn` = usulan_kota.musren_lokasi_kgtn_id 
                         INNER JOIN `vw_musren_anggaran_kgtn_desa` vw_musren_anggaran_kgtn_desa ON musren_lokasi_kgtn.`id_musren_lokasi_kgtn` = vw_musren_anggaran_kgtn_desa.`musren_lokasi_kgtn_id`
                         INNER JOIN `musren_musrenbang` musren_musrenbang_desa ON musren_musrenbang.`id_musren_musrenbang` = musren_musrenbang_desa.`id_musren_musrenbang` AND musren_musrenbang_desa.`musren_musrenbang_type` = 'MusrenMusrenbangDesa'
                         INNER JOIN `vw_appl_kode_wilayah` vw_appl_kode_wilayah ON musren_musrenbang.`kd_wilayah` = vw_appl_kode_wilayah.`kode_wilayah`
                         INNER JOIN `vw_appl_kode_wilayah_induk` vw_appl_kode_wilayah_induk ON vw_appl_kode_wilayah.`kode_induk` = vw_appl_kode_wilayah_induk.`kode_wilayah`
                    WHERE
                        musren_kgtn_desa.`musren_kgtn_type` = 'MusrenKgtnDesa'
                     AND IF(:kec != '', vw_appl_kode_wilayah_induk.`kode_wilayah` = :kec, 1)
                     AND IF(:status = '1', musren_kgtn_desa.`status_verifikasi` = '1',
                            IF(:status = '0', musren_kgtn_desa.`status_verifikasi` IN ('','0'), 1))
                     AND IF(:id_fungsi != '', sikd_fungsi.`id_sikd_fungsi` = :id_fungsi, 1)
                     AND IF(:prioritas != '', musren_kgtn.`prioritas` = :prioritas, 1)
                     AND ((vw_musren_anggaran_kgtn_desa.jml_apbd_kab+
                           vw_musren_anggaran_kgtn_desa.jml_apbd_prop+
                           vw_musren_anggaran_kgtn_desa.jml_apbn+
                           vw_musren_anggaran_kgtn_desa.jml_sumber_lain) >= 0)
                    GROUP BY
                         vw_appl_kode_wilayah_induk.`kode_wilayah`,
                         sikd_fungsi.`kd_fungsi`,
                         vw_appl_kode_wilayah.`kode_wilayah`
                    ORDER BY
                         vw_appl_kode_wilayah_induk.`kode_wilayah` ASC,
                         sikd_fungsi.`kd_fungsi` ASC,
                         vw_appl_kode_wilayah.`kode_wilayah` ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("kec", $kec);
            $statement->bindValue("status", $status);
            $statement->bindValue("id_fungsi", $idFungsi);
            $statement->bindValue("prioritas", $prioritas);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getMusrenKabListFlowUsulanKec($request)
    {
        try {

            $kec = $request->query->get("kec");
            $status = $request->query->get("status");
            $idBidang = $request->query->get("id_bidang");
            $prioritas = $request->query->get("prioritas");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idBidang = pack('H*', str_replace('-', '', trim($idBidang)));
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                         vw_appl_kode_wilayah.`kode_wilayah` AS vw_appl_kode_wilayah_kode_wilayah,
                         vw_appl_kode_wilayah.`klasifikasi` AS vw_appl_kode_wilayah_klasifikasi,
                         vw_appl_kode_wilayah.`nama_wilayah` AS vw_appl_kode_wilayah_nama_wilayah,
                         substring(vw_appl_kode_wilayah_A.`kode_wilayah`,5,2) AS vw_appl_kode_wilayah_induk_kode,
                         vw_appl_kode_wilayah_A.`kode_wilayah` AS vw_appl_kode_wilayah_induk_kode_wilayah,
                         vw_appl_kode_wilayah_A.`klasifikasi` AS vw_appl_kode_wilayah_induk_klasifikasi,
                         vw_appl_kode_wilayah_A.`nama_wilayah` AS vw_appl_kode_wilayah_induk_nama_wilayah,
                         musren_musrenbang.`tahun` AS musren_musrenbang_tahun,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 1, 8),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 9, 4),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 13, 4),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 17, 4),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 21)
                         ) AS musren_musrenbang_id_musren_musrenbang,
                         musren_musrenbang.`kd_wilayah` AS musren_musrenbang_kd_wilayah,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 1, 8),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 9, 4),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 13, 4),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 17, 4),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 21)
                         ) AS musren_kgtn_sikd_musren_bidang_id,
                         sikd_musren_bidang.`kd_bidang` AS sikd_musren_bidang_kd_bidang,
                         sikd_musren_bidang.`nm_bidang` AS sikd_musren_bidang_nm_bidang,
                         count(distinct CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn_kec.`id_musren_kgtn`), 1, 8),
                        SUBSTR(HEX(musren_kgtn_kec.`id_musren_kgtn`), 9, 4),
                        SUBSTR(HEX(musren_kgtn_kec.`id_musren_kgtn`), 13, 4),
                        SUBSTR(HEX(musren_kgtn_kec.`id_musren_kgtn`), 17, 4),
                        SUBSTR(HEX(musren_kgtn_kec.`id_musren_kgtn`), 21)
                         )) AS jml_usulan_kgtn,
                         count(distinct CONCAT_WS('-',
                        SUBSTR(HEX(musren_lokasi_kgtn.id_musren_lokasi_kgtn), 1, 8),
                        SUBSTR(HEX(musren_lokasi_kgtn.id_musren_lokasi_kgtn), 9, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.id_musren_lokasi_kgtn), 13, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.id_musren_lokasi_kgtn), 17, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.id_musren_lokasi_kgtn), 21)
                         )) AS jml_lokasi_kgtn,
                         SUM(vw_musren_anggaran_kgtn.jml_apbd_kab+
                             vw_musren_anggaran_kgtn.jml_apbd_prop+
                             vw_musren_anggaran_kgtn.jml_apbn+
                             vw_musren_anggaran_kgtn.jml_lain) AS jml_usulan_kec,
                         ifnull(sum(usulan_skpd.jml_anggaran), 0) AS jml_usulan_skpd,
                         ifnull(sum(usulan_kota.jml_anggaran), 0) AS jml_usulan_kota
                    FROM
                         `musren_kgtn` musren_kgtn
                         INNER JOIN `musren_kgtn` musren_kgtn_kec ON musren_kgtn.`id_musren_kgtn` = musren_kgtn_kec.`id_musren_kgtn` AND musren_kgtn_kec.`musren_kgtn_type` = 'MusrenKgtnKec'
                         INNER JOIN `sikd_satker` sikd_satker ON musren_kgtn_kec.`sikd_skpd_id` = sikd_satker.`id_sikd_satker`
                         INNER JOIN `sikd_bidang` sikd_musren_bidang ON musren_kgtn.`sikd_bidang_id` = sikd_musren_bidang.`id_sikd_bidang`
                         INNER JOIN `musren_lokasi_kgtn` musren_lokasi_kgtn ON musren_kgtn_kec.`id_musren_kgtn` = musren_lokasi_kgtn.`musren_kgtn_id`
                         LEFT OUTER JOIN (select a.jml_anggaran, a.musren_lokasi_kgtn_id  
                                 from musren_lokasi_kgtn a inner join musren_kgtn b on a.musren_kgtn_id = b.id_musren_kgtn and b.musren_kgtn_type = 'MusrenKgtnSkpd'
                                 /*where a.musren_skpd_lokasi_kgtn_id = b.id_musren_skpd_lokasi_kgtn*/) AS usulan_skpd ON
                             musren_lokasi_kgtn.`id_musren_lokasi_kgtn` = usulan_skpd.musren_lokasi_kgtn_id 
                         LEFT OUTER JOIN (select a.jml_anggaran, b.musren_lokasi_kgtn_id  
                                 from musren_lokasi_kgtn a, musren_lokasi_kgtn b inner join musren_kgtn c on b.musren_kgtn_id = c.id_musren_kgtn and c.musren_kgtn_type = 'MusrenKgtnSkpd'
                                 where /*a.musren_lokasi_kgtn_id = b.id_musren_lokasi_kgtn
                                   and*/ a.musren_lokasi_kgtn_id = b.id_musren_lokasi_kgtn) AS usulan_kota ON
                             musren_lokasi_kgtn.`id_musren_lokasi_kgtn` = usulan_kota.musren_lokasi_kgtn_id
                         INNER JOIN `musren_musrenbang` musren_musrenbang ON musren_kgtn.`musren_musrenbang_id` = musren_musrenbang.`id_musren_musrenbang`
                         INNER JOIN `vw_musren_anggaran_kgtn` vw_musren_anggaran_kgtn ON musren_lokasi_kgtn.`id_musren_lokasi_kgtn` = vw_musren_anggaran_kgtn.`musren_lokasi_kgtn_id`
                         INNER JOIN `vw_appl_kode_wilayah` vw_appl_kode_wilayah ON musren_lokasi_kgtn.`kd_wilayah` = vw_appl_kode_wilayah.`kode_wilayah`
                         INNER JOIN `vw_appl_kode_wilayah` vw_appl_kode_wilayah_A 
                            ON musren_musrenbang.`kd_wilayah` = vw_appl_kode_wilayah_A.`kode_wilayah`
                    WHERE
                         IF(:kec != '', musren_musrenbang.`kd_wilayah` = :kec, 1)
                     AND IF(:status = '1', musren_kgtn_kec.`status_verifikasi` = '1',
                            IF(:status = '0', musren_kgtn_kec.`status_verifikasi` IN ('','0'), 1))
                     AND IF(:id_bidang != '', musren_kgtn.`sikd_bidang_id` = :id_bidang, 1)
                     AND IF(:prioritas != '', musren_kgtn.`prioritas` = :prioritas, 1)
                     AND ((vw_musren_anggaran_kgtn.jml_apbd_kab+
                           vw_musren_anggaran_kgtn.jml_apbd_prop+
                           vw_musren_anggaran_kgtn.jml_apbn+
                           vw_musren_anggaran_kgtn.jml_lain) >= 0)
                    GROUP BY
                         musren_musrenbang.`kd_wilayah`,
                         sikd_musren_bidang.`kd_bidang`,
                         vw_appl_kode_wilayah.`kode_wilayah`
                    ORDER BY
                         musren_musrenbang.`kd_wilayah` ASC,
                         sikd_musren_bidang.`kd_bidang` ASC,
                         vw_appl_kode_wilayah.`kode_wilayah` ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("kec", $kec);
            $statement->bindValue("status", $status);
            $statement->bindValue("id_bidang", $idBidang);
            $statement->bindValue("prioritas", $prioritas);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getMusrenKabListFlowUsulanKecW($request)
    {
        try {

            $kec = $request->query->get("kec");
            $status = $request->query->get("status");
            $idBidang = $request->query->get("id_bidang");
            $prioritas = $request->query->get("prioritas");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idBidang = pack('H*', str_replace('-', '', trim($idBidang)));
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                         ifnull(substring(vw_appl_kode_wilayah.`kode_wilayah`,7,4),'-') AS vw_appl_kode_wilayah_kode,
                         vw_appl_kode_wilayah.`kode_wilayah` AS vw_appl_kode_wilayah_kode_wilayah,
                         vw_appl_kode_wilayah.`klasifikasi` AS vw_appl_kode_wilayah_klasifikasi,
                         vw_appl_kode_wilayah.`nama_wilayah` AS vw_appl_kode_wilayah_nama_wilayah,
                         substring(vw_appl_kode_wilayah_A.`kode_wilayah`,5,2) AS vw_appl_kode_wilayah_induk_kode,
                         vw_appl_kode_wilayah_A.`kode_wilayah` AS vw_appl_kode_wilayah_induk_kode_wilayah,
                         vw_appl_kode_wilayah_A.`klasifikasi` AS vw_appl_kode_wilayah_induk_klasifikasi,
                         vw_appl_kode_wilayah_A.`nama_wilayah` AS vw_appl_kode_wilayah_induk_nama_wilayah,
                         musren_musrenbang.`tahun` AS musren_musrenbang_tahun,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 1, 8),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 9, 4),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 13, 4),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 17, 4),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 21)
                         ) AS musren_musrenbang_id_musren_musrenbang,
                         musren_musrenbang.`kd_wilayah` AS musren_musrenbang_kd_wilayah,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 1, 8),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 9, 4),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 13, 4),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 17, 4),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 21)
                         ) AS musren_kgtn_sikd_musren_bidang_id,
                         sikd_musren_bidang.`kd_bidang` AS sikd_musren_bidang_kd_bidang,
                         sikd_musren_bidang.`nm_bidang` AS sikd_musren_bidang_nm_bidang,
                         count(distinct CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn_kec.`id_musren_kgtn`), 1, 8),
                        SUBSTR(HEX(musren_kgtn_kec.`id_musren_kgtn`), 9, 4),
                        SUBSTR(HEX(musren_kgtn_kec.`id_musren_kgtn`), 13, 4),
                        SUBSTR(HEX(musren_kgtn_kec.`id_musren_kgtn`), 17, 4),
                        SUBSTR(HEX(musren_kgtn_kec.`id_musren_kgtn`), 21)
                         )) AS jml_usulan_kgtn,
                         count(distinct CONCAT_WS('-',
                        SUBSTR(HEX(musren_lokasi_kgtn.id_musren_lokasi_kgtn), 1, 8),
                        SUBSTR(HEX(musren_lokasi_kgtn.id_musren_lokasi_kgtn), 9, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.id_musren_lokasi_kgtn), 13, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.id_musren_lokasi_kgtn), 17, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.id_musren_lokasi_kgtn), 21)
                         )) AS jml_lokasi_kgtn,
                         SUM(vw_musren_anggaran_kgtn.jml_apbd_kab+
                             vw_musren_anggaran_kgtn.jml_apbd_prop+
                             vw_musren_anggaran_kgtn.jml_apbn+
                             vw_musren_anggaran_kgtn.jml_lain) AS jml_usulan_kec,
                         ifnull(sum(usulan_skpd.jml_anggaran), 0) AS jml_usulan_skpd,
                         ifnull(sum(usulan_kota.jml_anggaran), 0) AS jml_usulan_kota
                    FROM
                         `musren_kgtn` musren_kgtn
                         INNER JOIN `musren_kgtn` musren_kgtn_kec ON musren_kgtn.`id_musren_kgtn` = musren_kgtn_kec.`id_musren_kgtn` AND musren_kgtn_kec.`musren_kgtn_type` = 'MusrenKgtnKec'
                         INNER JOIN `sikd_satker` sikd_satker ON musren_kgtn_kec.`sikd_skpd_id` = sikd_satker.`id_sikd_satker`
                         INNER JOIN `sikd_bidang` sikd_musren_bidang ON musren_kgtn.`sikd_bidang_id` = sikd_musren_bidang.`id_sikd_bidang`
                         INNER JOIN `musren_lokasi_kgtn` musren_lokasi_kgtn ON musren_kgtn_kec.`id_musren_kgtn` = musren_lokasi_kgtn.`musren_kgtn_id`
                         LEFT OUTER JOIN (select a.jml_anggaran, a.musren_lokasi_kgtn_id  
                                 from musren_lokasi_kgtn a inner join musren_kgtn b on a.musren_kgtn_id = b.id_musren_kgtn and b.musren_kgtn_type = 'MusrenKgtnSkpd'
                                 /*where a.musren_skpd_lokasi_kgtn_id = b.id_musren_skpd_lokasi_kgtn*/) AS usulan_skpd ON
                             musren_lokasi_kgtn.`id_musren_lokasi_kgtn` = usulan_skpd.musren_lokasi_kgtn_id 
                         LEFT OUTER JOIN (select a.jml_anggaran, b.musren_lokasi_kgtn_id  
                                 from musren_lokasi_kgtn a, musren_lokasi_kgtn b inner join musren_kgtn c on b.musren_kgtn_id = c.id_musren_kgtn and c.musren_kgtn_type = 'MusrenKgtnSkpd'
                                 where /*a.musren_lokasi_kgtn_id = b.id_musren_lokasi_kgtn
                                   and*/ a.musren_lokasi_kgtn_id = b.id_musren_lokasi_kgtn) AS usulan_kota ON
                             musren_lokasi_kgtn.`id_musren_lokasi_kgtn` = usulan_kota.musren_lokasi_kgtn_id 
                         INNER JOIN `musren_musrenbang` musren_musrenbang ON musren_kgtn.`musren_musrenbang_id` = musren_musrenbang.`id_musren_musrenbang`
                         INNER JOIN `vw_musren_anggaran_kgtn` vw_musren_anggaran_kgtn ON musren_lokasi_kgtn.`id_musren_lokasi_kgtn` = vw_musren_anggaran_kgtn.`musren_lokasi_kgtn_id`
                         INNER JOIN `vw_appl_kode_wilayah` vw_appl_kode_wilayah ON musren_lokasi_kgtn.`kd_wilayah` = vw_appl_kode_wilayah.`kode_wilayah`
                         INNER JOIN `vw_appl_kode_wilayah` vw_appl_kode_wilayah_A 
                            ON musren_musrenbang.`kd_wilayah` = vw_appl_kode_wilayah_A.`kode_wilayah`
                    WHERE
                         IF(:kec != '', musren_musrenbang.`kd_wilayah` = :kec, 1)
                     AND IF(:status = '1', musren_kgtn_kec.`status_verifikasi` = '1',
                            IF(:status = '0', musren_kgtn_kec.`status_verifikasi` IN ('','0'), 1))
                     AND IF(:id_bidang != '', musren_kgtn.`sikd_bidang_id` = :id_bidang, 1)
                     AND IF(:prioritas != '', musren_kgtn.`prioritas` = :prioritas, 1)
                     AND ((vw_musren_anggaran_kgtn.jml_apbd_kab+
                           vw_musren_anggaran_kgtn.jml_apbd_prop+
                           vw_musren_anggaran_kgtn.jml_apbn+
                           vw_musren_anggaran_kgtn.jml_lain) >= 0)
                    GROUP BY
                         musren_musrenbang.`kd_wilayah`,
                         vw_appl_kode_wilayah.`kode_wilayah`,
                         sikd_musren_bidang.`kd_bidang`
                    ORDER BY
                         musren_musrenbang.`kd_wilayah` ASC,
                         vw_appl_kode_wilayah.`kode_wilayah` ASC,
                         sikd_musren_bidang.`kd_bidang` ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("kec", $kec);
            $statement->bindValue("status", $status);
            $statement->bindValue("id_bidang", $idBidang);
            $statement->bindValue("prioritas", $prioritas);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getMusrenKabListFlowUsulanKecF($request)
    {
        try {

            $kec = $request->query->get("kec");
            $status = $request->query->get("status");
            $idBidang = $request->query->get("id_bidang");
            $prioritas = $request->query->get("prioritas");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idBidang = pack('H*', str_replace('-', '', trim($idBidang)));
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                         vw_appl_kode_wilayah.`kode_wilayah` AS vw_appl_kode_wilayah_kode_wilayah,
                         vw_appl_kode_wilayah.`klasifikasi` AS vw_appl_kode_wilayah_klasifikasi,
                         vw_appl_kode_wilayah.`nama_wilayah` AS vw_appl_kode_wilayah_nama_wilayah,
                         substring(vw_appl_kode_wilayah_A.`kode_wilayah`,5,2) AS vw_appl_kode_wilayah_induk_kode,
                         vw_appl_kode_wilayah_A.`kode_wilayah` AS vw_appl_kode_wilayah_induk_kode_wilayah,
                         vw_appl_kode_wilayah_A.`klasifikasi` AS vw_appl_kode_wilayah_induk_klasifikasi,
                         vw_appl_kode_wilayah_A.`nama_wilayah` AS vw_appl_kode_wilayah_induk_nama_wilayah,
                         musren_musrenbang.`tahun` AS musren_musrenbang_tahun,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 1, 8),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 9, 4),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 13, 4),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 17, 4),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 21)
                         ) AS musren_musrenbang_id_musren_musrenbang,
                         musren_musrenbang.`kd_wilayah` AS musren_musrenbang_kd_wilayah,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 1, 8),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 9, 4),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 13, 4),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 17, 4),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 21)
                         ) AS musren_kgtn_sikd_musren_bidang_id,
                         sikd_fungsi.`kd_fungsi` AS sikd_fungsi_kd_fungsi,
                         sikd_fungsi.`nm_fungsi` AS sikd_fungsi_nm_fungsi,
                         count(distinct CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn_kec.`id_musren_kgtn`), 1, 8),
                        SUBSTR(HEX(musren_kgtn_kec.`id_musren_kgtn`), 9, 4),
                        SUBSTR(HEX(musren_kgtn_kec.`id_musren_kgtn`), 13, 4),
                        SUBSTR(HEX(musren_kgtn_kec.`id_musren_kgtn`), 17, 4),
                        SUBSTR(HEX(musren_kgtn_kec.`id_musren_kgtn`), 21)
                         )) AS jml_usulan_kgtn,
                         count(distinct CONCAT_WS('-',
                        SUBSTR(HEX(musren_lokasi_kgtn.id_musren_lokasi_kgtn), 1, 8),
                        SUBSTR(HEX(musren_lokasi_kgtn.id_musren_lokasi_kgtn), 9, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.id_musren_lokasi_kgtn), 13, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.id_musren_lokasi_kgtn), 17, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.id_musren_lokasi_kgtn), 21)
                         )) AS jml_lokasi_kgtn,
                         SUM(vw_musren_anggaran_kgtn.jml_apbd_kab+
                             vw_musren_anggaran_kgtn.jml_apbd_prop+
                             vw_musren_anggaran_kgtn.jml_apbn+
                             vw_musren_anggaran_kgtn.jml_lain) AS jml_usulan_kec,
                         ifnull(sum(usulan_skpd.jml_anggaran), 0) AS jml_usulan_skpd,
                         ifnull(sum(usulan_kota.jml_anggaran), 0) AS jml_usulan_kota
                    FROM
                         `musren_kgtn` musren_kgtn
                         INNER JOIN `musren_kgtn` musren_kgtn_kec ON musren_kgtn.`id_musren_kgtn` = musren_kgtn_kec.`id_musren_kgtn` AND musren_kgtn_kec.`musren_kgtn_type` = 'MusrenKgtnKec'
                         INNER JOIN `sikd_satker` sikd_satker ON musren_kgtn_kec.`sikd_skpd_id` = sikd_satker.`id_sikd_satker`
                         INNER JOIN `sikd_bidang` sikd_musren_bidang ON musren_kgtn.`sikd_bidang_id` = sikd_musren_bidang.`id_sikd_bidang`
                         INNER JOIN `sikd_fungsi` sikd_fungsi ON sikd_musren_bidang.`sikd_fungsi_id` = sikd_fungsi.`id_sikd_fungsi`
                         INNER JOIN `musren_lokasi_kgtn` musren_lokasi_kgtn ON musren_kgtn_kec.`id_musren_kgtn` = musren_lokasi_kgtn.`musren_kgtn_id`
                         LEFT OUTER JOIN (select a.jml_anggaran, a.musren_lokasi_kgtn_id 
                                 from musren_lokasi_kgtn a inner join musren_kgtn b on a.musren_kgtn_id = b.id_musren_kgtn and b.musren_kgtn_type = 'MusrenKgtnSkpd'
                                 /*where a.musren_skpd_lokasi_kgtn_id = b.id_musren_skpd_lokasi_kgtn*/) AS usulan_skpd ON
                             musren_lokasi_kgtn.`id_musren_lokasi_kgtn` = usulan_skpd.musren_lokasi_kgtn_id 
                         LEFT OUTER JOIN (select a.jml_anggaran, b.musren_lokasi_kgtn_id  
                                 from musren_lokasi_kgtn a, musren_lokasi_kgtn b inner join musren_kgtn c on b.musren_kgtn_id = c.id_musren_kgtn and c.musren_kgtn_type = 'MusrenKgtnSkpd'
                                 where /*a.musren_lokasi_kgtn_id = b.id_musren_lokasi_kgtn
                                   and*/ a.musren_lokasi_kgtn_id = b.id_musren_lokasi_kgtn) AS usulan_kota ON
                             musren_lokasi_kgtn.`id_musren_lokasi_kgtn` = usulan_kota.musren_lokasi_kgtn_id
                         INNER JOIN `musren_musrenbang` musren_musrenbang ON musren_kgtn.`musren_musrenbang_id` = musren_musrenbang.`id_musren_musrenbang`
                         INNER JOIN `vw_musren_anggaran_kgtn` vw_musren_anggaran_kgtn ON musren_lokasi_kgtn.`id_musren_lokasi_kgtn` = vw_musren_anggaran_kgtn.`musren_lokasi_kgtn_id`
                         INNER JOIN `vw_appl_kode_wilayah` vw_appl_kode_wilayah ON musren_lokasi_kgtn.`kd_wilayah` = vw_appl_kode_wilayah.`kode_wilayah`
                         INNER JOIN `vw_appl_kode_wilayah` vw_appl_kode_wilayah_A 
                            ON musren_musrenbang.`kd_wilayah` = vw_appl_kode_wilayah_A.`kode_wilayah`
                    WHERE
                         IF(:kec != '', musren_musrenbang.`kd_wilayah` = :kec, 1)
                     AND IF(:status = '1', musren_kgtn_kec.`status_verifikasi` = '1',
                            IF(:status = '0', musren_kgtn_kec.`status_verifikasi` IN ('','0'), 1))
                     AND IF(:id_bidang != '', musren_kgtn.`sikd_bidang_id` = :id_bidang, 1)
                     AND IF(:prioritas != '', musren_kgtn.`prioritas` = :prioritas, 1)
                     AND ((vw_musren_anggaran_kgtn.jml_apbd_kab+
                           vw_musren_anggaran_kgtn.jml_apbd_prop+
                           vw_musren_anggaran_kgtn.jml_apbn+
                           vw_musren_anggaran_kgtn.jml_lain) >= 0)
                    GROUP BY
                         musren_musrenbang.`kd_wilayah`,
                         sikd_fungsi.`kd_fungsi`,
                         vw_appl_kode_wilayah.`kode_wilayah`
                    ORDER BY
                         musren_musrenbang.`kd_wilayah` ASC,
                         sikd_fungsi.`kd_fungsi` ASC,
                         vw_appl_kode_wilayah.`kode_wilayah` ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("kec", $kec);
            $statement->bindValue("status", $status);
            $statement->bindValue("id_bidang", $idBidang);
            $statement->bindValue("prioritas", $prioritas);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getMusrenKabRekapUsulanPerSatker($request)
    {
        try {

            $status = $request->query->get("status");
            $prioritas = $request->query->get("prioritas");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
           
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                         musren_musrenbang.`tahun` AS musren_musrenbang_tahun,
                         sikd_satker.`kode` AS sikd_satker_kode,
                         sikd_satker.`nama` AS sikd_satker_nama,
                         count(distinct CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn_kec.`id_musren_kgtn`), 1, 8),
                        SUBSTR(HEX(musren_kgtn_kec.`id_musren_kgtn`), 9, 4),
                        SUBSTR(HEX(musren_kgtn_kec.`id_musren_kgtn`), 13, 4),
                        SUBSTR(HEX(musren_kgtn_kec.`id_musren_kgtn`), 17, 4),
                        SUBSTR(HEX(musren_kgtn_kec.`id_musren_kgtn`), 21)
                         )) AS jml_usulan_kgtn,
                         count(distinct CONCAT_WS('-',
                        SUBSTR(HEX(musren_lokasi_kgtn.id_musren_lokasi_kgtn), 1, 8),
                        SUBSTR(HEX(musren_lokasi_kgtn.id_musren_lokasi_kgtn), 9, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.id_musren_lokasi_kgtn), 13, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.id_musren_lokasi_kgtn), 17, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.id_musren_lokasi_kgtn), 21)
                         )) AS jml_lokasi_kgtn,
                         SUM(IFNULL(vw_musren_anggaran_kgtn.jml_apbd_kab, 0)) AS jml_usulan_apbd_kab,
                         SUM(IFNULL(vw_musren_anggaran_kgtn.jml_apbd_prop, 0)) AS jml_usulan_apbd_prop,
                         SUM(IFNULL(vw_musren_anggaran_kgtn.jml_apbn, 0)) AS jml_usulan_apbn,
                         SUM(IFNULL(vw_musren_anggaran_kgtn.jml_lain,0)) AS jml_usulan_lainnya
                    FROM
                         `musren_kgtn` musren_kgtn_kec 
                         INNER JOIN `musren_kgtn` musren_kgtn ON musren_kgtn_kec.`id_musren_kgtn` = musren_kgtn.`id_musren_kgtn`
                         INNER JOIN `sikd_satker` sikd_satker ON musren_kgtn_kec.`sikd_skpd_id` = sikd_satker.`id_sikd_satker`
                         INNER JOIN `musren_musrenbang` musren_musrenbang ON musren_kgtn.`musren_musrenbang_id` = musren_musrenbang.`id_musren_musrenbang`
                         INNER JOIN `musren_musrenbang` musren_musrenbang_kec ON musren_musrenbang.`id_musren_musrenbang` = musren_musrenbang_kec.`id_musren_musrenbang` AND musren_musrenbang_kec.`musren_musrenbang_type` = 'MusrenMusrenbangKec'
                         INNER JOIN `musren_lokasi_kgtn` musren_lokasi_kgtn ON musren_kgtn.`id_musren_kgtn` = musren_lokasi_kgtn.`musren_kgtn_id`
                         INNER JOIN `vw_musren_anggaran_kgtn` vw_musren_anggaran_kgtn ON musren_lokasi_kgtn.`id_musren_lokasi_kgtn` = vw_musren_anggaran_kgtn.`musren_lokasi_kgtn_id`
                    WHERE
                        musren_kgtn_kec.`musren_kgtn_type` = 'MusrenKgtnKec'
                     AND IF(:prioritas != '', musren_kgtn.`prioritas` = :prioritas, 1)
                     AND IF(:status = '1', musren_kgtn_kec.`status_verifikasi` = '1',
                            IF(:status = '0', musren_kgtn_kec.`status_verifikasi` IN ('','0'), 1))
                     AND ((vw_musren_anggaran_kgtn.jml_apbd_kab+
                           vw_musren_anggaran_kgtn.jml_apbd_prop+
                           vw_musren_anggaran_kgtn.jml_apbn+
                           vw_musren_anggaran_kgtn.jml_lain) >= 0)
                    GROUP BY
                         sikd_satker.`kode`,
                         sikd_satker.`id_sikd_satker`
                    ORDER BY
                         sikd_satker.`kode` ASC,
                         sikd_satker.`id_sikd_satker` ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("status", $status);
            $statement->bindValue("prioritas", $prioritas);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getMusrenKabRekapUsulanPerBidang($request)
    {
        try {

            $status = $request->query->get("status");
            $prioritas = $request->query->get("prioritas");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
           
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                         musren_musrenbang.`tahun` AS musren_musrenbang_tahun,
                         sikd_bidang.`kd_bidang` AS sikd_bidang_kd_bidang,
                         sikd_bidang.`nm_bidang` AS sikd_bidang_nm_bidang,
                         count(distinct CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn_kec.`id_musren_kgtn`), 1, 8),
                        SUBSTR(HEX(musren_kgtn_kec.`id_musren_kgtn`), 9, 4),
                        SUBSTR(HEX(musren_kgtn_kec.`id_musren_kgtn`), 13, 4),
                        SUBSTR(HEX(musren_kgtn_kec.`id_musren_kgtn`), 17, 4),
                        SUBSTR(HEX(musren_kgtn_kec.`id_musren_kgtn`), 21)
                         )) AS jml_usulan_kgtn,
                         count(distinct CONCAT_WS('-',
                        SUBSTR(HEX(musren_lokasi_kgtn.id_musren_lokasi_kgtn), 1, 8),
                        SUBSTR(HEX(musren_lokasi_kgtn.id_musren_lokasi_kgtn), 9, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.id_musren_lokasi_kgtn), 13, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.id_musren_lokasi_kgtn), 17, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.id_musren_lokasi_kgtn), 21)
                         )) AS jml_lokasi_kgtn,
                         SUM(IFNULL(vw_musren_anggaran_kgtn.jml_apbd_kab, 0)) AS jml_usulan_apbd_kab,
                         SUM(IFNULL(vw_musren_anggaran_kgtn.jml_apbd_prop, 0)) AS jml_usulan_apbd_prop,
                         SUM(IFNULL(vw_musren_anggaran_kgtn.jml_apbn, 0)) AS jml_usulan_apbn,
                         SUM(IFNULL(vw_musren_anggaran_kgtn.jml_lain,0)) AS jml_usulan_lainnya
                    FROM
                         `musren_kgtn` musren_kgtn_kec 
                         INNER JOIN `musren_kgtn` musren_kgtn ON musren_kgtn_kec.`id_musren_kgtn` = musren_kgtn.`id_musren_kgtn`
                         INNER JOIN `sikd_satker` sikd_satker ON musren_kgtn_kec.`sikd_skpd_id` = sikd_satker.`id_sikd_satker`
                         INNER JOIN `sikd_bidang` sikd_bidang ON musren_kgtn.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                         INNER JOIN `musren_musrenbang` musren_musrenbang ON musren_kgtn.`musren_musrenbang_id` = musren_musrenbang.`id_musren_musrenbang`
                         INNER JOIN `musren_musrenbang` musren_musrenbang_kec ON musren_musrenbang.`id_musren_musrenbang` = musren_musrenbang_kec.`id_musren_musrenbang` AND musren_musrenbang_kec.`musren_musrenbang_type` = 'MusrenMusrenbangKec'
                         INNER JOIN `musren_lokasi_kgtn` musren_lokasi_kgtn ON musren_kgtn.`id_musren_kgtn` = musren_lokasi_kgtn.`musren_kgtn_id`
                         INNER JOIN `vw_musren_anggaran_kgtn` vw_musren_anggaran_kgtn ON musren_lokasi_kgtn.`id_musren_lokasi_kgtn` = vw_musren_anggaran_kgtn.`musren_lokasi_kgtn_id`
                    WHERE
                        musren_kgtn_kec.`musren_kgtn_type` = 'MusrenKgtnKec'
                     AND IF(:prioritas != '', musren_kgtn.`prioritas` = :prioritas, 1)
                     AND IF(:status = '1', musren_kgtn_kec.`status_verifikasi` = '1',
                            IF(:status = '0', musren_kgtn_kec.`status_verifikasi` IN ('','0'), 1))
                     AND ((vw_musren_anggaran_kgtn.jml_apbd_kab+
                           vw_musren_anggaran_kgtn.jml_apbd_prop+
                           vw_musren_anggaran_kgtn.jml_apbn+
                           vw_musren_anggaran_kgtn.jml_lain) >= 0)
                    GROUP BY
                         sikd_bidang.`kd_bidang`
                    ORDER BY
                        sikd_bidang.`kd_bidang` ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("status", $status);
            $statement->bindValue("prioritas", $prioritas);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getMusrenKabRekapUsulanPerFungsi($request)
    {
        try {

            $status = $request->query->get("status");
            $prioritas = $request->query->get("prioritas");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
           
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                         musren_musrenbang.`tahun` AS musren_musrenbang_tahun,
                         sikd_fungsi.`kd_fungsi` AS sikd_fungsi_kd_fungsi,
                         sikd_fungsi.`nm_fungsi` AS sikd_fungsi_nm_fungsi,
                         count(distinct CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn_kec.`id_musren_kgtn`), 1, 8),
                        SUBSTR(HEX(musren_kgtn_kec.`id_musren_kgtn`), 9, 4),
                        SUBSTR(HEX(musren_kgtn_kec.`id_musren_kgtn`), 13, 4),
                        SUBSTR(HEX(musren_kgtn_kec.`id_musren_kgtn`), 17, 4),
                        SUBSTR(HEX(musren_kgtn_kec.`id_musren_kgtn`), 21)
                         )) AS jml_usulan_kgtn,
                         count(distinct CONCAT_WS('-',
                        SUBSTR(HEX(musren_lokasi_kgtn.id_musren_lokasi_kgtn), 1, 8),
                        SUBSTR(HEX(musren_lokasi_kgtn.id_musren_lokasi_kgtn), 9, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.id_musren_lokasi_kgtn), 13, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.id_musren_lokasi_kgtn), 17, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.id_musren_lokasi_kgtn), 21)
                         )) AS jml_lokasi_kgtn,
                         SUM(IFNULL(vw_musren_anggaran_kgtn.jml_apbd_kab, 0)) AS jml_usulan_apbd_kab,
                         SUM(IFNULL(vw_musren_anggaran_kgtn.jml_apbd_prop, 0)) AS jml_usulan_apbd_prop,
                         SUM(IFNULL(vw_musren_anggaran_kgtn.jml_apbn, 0)) AS jml_usulan_apbn,
                         SUM(IFNULL(vw_musren_anggaran_kgtn.jml_lain,0)) AS jml_usulan_lainnya
                    FROM
                         `musren_kgtn` musren_kgtn_kec 
                         INNER JOIN `musren_kgtn` musren_kgtn ON musren_kgtn_kec.`id_musren_kgtn` = musren_kgtn.`id_musren_kgtn`
                         INNER JOIN `sikd_satker` sikd_satker ON musren_kgtn_kec.`sikd_skpd_id` = sikd_satker.`id_sikd_satker`
                         INNER JOIN `sikd_bidang` sikd_bidang ON musren_kgtn.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                         INNER JOIN `sikd_fungsi` sikd_fungsi ON sikd_bidang.`sikd_fungsi_id` = sikd_fungsi.`id_sikd_fungsi`
                         INNER JOIN `musren_musrenbang` musren_musrenbang ON musren_kgtn.`musren_musrenbang_id` = musren_musrenbang.`id_musren_musrenbang`
                         INNER JOIN `musren_musrenbang` musren_musrenbang_kec ON musren_musrenbang.`id_musren_musrenbang` = musren_musrenbang_kec.`id_musren_musrenbang` AND musren_musrenbang_kec.`musren_musrenbang_type` = 'MusrenMusrenbangKec'
                         INNER JOIN `musren_lokasi_kgtn` musren_lokasi_kgtn ON musren_kgtn.`id_musren_kgtn` = musren_lokasi_kgtn.`musren_kgtn_id`
                         INNER JOIN `vw_musren_anggaran_kgtn` vw_musren_anggaran_kgtn ON musren_lokasi_kgtn.`id_musren_lokasi_kgtn` = vw_musren_anggaran_kgtn.`musren_lokasi_kgtn_id`
                    WHERE
                        musren_kgtn_kec.`musren_kgtn_type` = 'MusrenKgtnKec'
                     AND IF(:prioritas != '', musren_kgtn.`prioritas` = :prioritas, 1)
                     AND IF(:status = '1', musren_kgtn_kec.`status_verifikasi` = '1',
                            IF(:status = '0', musren_kgtn_kec.`status_verifikasi` IN ('','0'), 1))
                     AND ((vw_musren_anggaran_kgtn.jml_apbd_kab+
                           vw_musren_anggaran_kgtn.jml_apbd_prop+
                           vw_musren_anggaran_kgtn.jml_apbn+
                           vw_musren_anggaran_kgtn.jml_lain) >= 0)
                    GROUP BY
                         sikd_fungsi.`kd_fungsi`
                    ORDER BY
                        sikd_fungsi.`kd_fungsi` ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("status", $status);
            $statement->bindValue("prioritas", $prioritas);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getMusrenKabRekapUsulanPerWilayah($request)
    {
        try {

            $status = $request->query->get("status");
            $prioritas = $request->query->get("prioritas");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
           
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                         musren_musrenbang.`tahun` AS musren_musrenbang_tahun,
                         vw_appl_kode_wilayah.`kode_wilayah` AS vw_appl_kode_wilayah_kode_wilayah,
                         vw_appl_kode_wilayah.`nama_wilayah` AS vw_appl_kode_wilayah_nama_wilayah,
                         count(distinct CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn_kec.`id_musren_kgtn`), 1, 8),
                        SUBSTR(HEX(musren_kgtn_kec.`id_musren_kgtn`), 9, 4),
                        SUBSTR(HEX(musren_kgtn_kec.`id_musren_kgtn`), 13, 4),
                        SUBSTR(HEX(musren_kgtn_kec.`id_musren_kgtn`), 17, 4),
                        SUBSTR(HEX(musren_kgtn_kec.`id_musren_kgtn`), 21)
                         )) AS jml_usulan_kgtn,
                         count(distinct CONCAT_WS('-',
                        SUBSTR(HEX(musren_lokasi_kgtn.id_musren_lokasi_kgtn), 1, 8),
                        SUBSTR(HEX(musren_lokasi_kgtn.id_musren_lokasi_kgtn), 9, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.id_musren_lokasi_kgtn), 13, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.id_musren_lokasi_kgtn), 17, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.id_musren_lokasi_kgtn), 21)
                         )) AS jml_lokasi_kgtn,
                         SUM(IFNULL(vw_musren_anggaran_kgtn.jml_apbd_kab, 0)) AS jml_usulan_apbd_kab,
                         SUM(IFNULL(vw_musren_anggaran_kgtn.jml_apbd_prop, 0)) AS jml_usulan_apbd_prop,
                         SUM(IFNULL(vw_musren_anggaran_kgtn.jml_apbn, 0)) AS jml_usulan_apbn,
                         SUM(IFNULL(vw_musren_anggaran_kgtn.jml_lain,0)) AS jml_usulan_lainnya
                    FROM
                         `musren_kgtn` musren_kgtn_kec 
                         INNER JOIN `musren_kgtn` musren_kgtn ON musren_kgtn_kec.`id_musren_kgtn` = musren_kgtn.`id_musren_kgtn`
                         INNER JOIN `sikd_satker` sikd_satker ON musren_kgtn_kec.`sikd_skpd_id` = sikd_satker.`id_sikd_satker`
                         INNER JOIN `musren_musrenbang` musren_musrenbang ON musren_kgtn.`musren_musrenbang_id` = musren_musrenbang.`id_musren_musrenbang`
                         INNER JOIN `musren_lokasi_kgtn` musren_lokasi_kgtn ON musren_kgtn.`id_musren_kgtn` = musren_lokasi_kgtn.`musren_kgtn_id`
                         INNER JOIN `vw_musren_anggaran_kgtn` vw_musren_anggaran_kgtn ON musren_lokasi_kgtn.`id_musren_lokasi_kgtn` = vw_musren_anggaran_kgtn.`musren_lokasi_kgtn_id`
                         INNER JOIN `vw_appl_kode_wilayah` vw_appl_kode_wilayah ON musren_musrenbang.`kd_wilayah` = vw_appl_kode_wilayah.`kode_wilayah`
                    WHERE
                        musren_kgtn_kec.`musren_kgtn_type` = 'MusrenKgtnKec'
                     AND IF(:prioritas != '', musren_kgtn.`prioritas` = :prioritas, 1)
                     AND IF(:status = '1', musren_kgtn_kec.`status_verifikasi` = '1',
                            IF(:status = '0', musren_kgtn_kec.`status_verifikasi` IN ('','0'), 1))
                     AND ((vw_musren_anggaran_kgtn.jml_apbd_kab+
                           vw_musren_anggaran_kgtn.jml_apbd_prop+
                           vw_musren_anggaran_kgtn.jml_apbn+
                           vw_musren_anggaran_kgtn.jml_lain) >= 0)
                    GROUP BY
                         vw_appl_kode_wilayah.`kode_wilayah`
                    ORDER BY
                         vw_appl_kode_wilayah.`kode_wilayah` ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("status", $status);
            $statement->bindValue("prioritas", $prioritas);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getMusrenKabRekapUsulanPerMusren($request)
    {
        try {

            $status = $request->query->get("status");
            $prioritas = $request->query->get("prioritas");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
           
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                     musren_musrenbang.`tahun` AS musren_musrenbang_tahun,
                     sikd_musren_bidang.`kd_bidang` AS sikd_musren_bidang_kd_bidang,
                     sikd_musren_bidang.`nm_bidang` AS sikd_musren_bidang_nm_bidang,
                     count(distinct CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn_kec.`id_musren_kgtn`), 1, 8),
                        SUBSTR(HEX(musren_kgtn_kec.`id_musren_kgtn`), 9, 4),
                        SUBSTR(HEX(musren_kgtn_kec.`id_musren_kgtn`), 13, 4),
                        SUBSTR(HEX(musren_kgtn_kec.`id_musren_kgtn`), 17, 4),
                        SUBSTR(HEX(musren_kgtn_kec.`id_musren_kgtn`), 21)
                         )) AS jml_usulan_kgtn,
                     count(distinct CONCAT_WS('-',
                        SUBSTR(HEX(musren_lokasi_kgtn.id_musren_lokasi_kgtn), 1, 8),
                        SUBSTR(HEX(musren_lokasi_kgtn.id_musren_lokasi_kgtn), 9, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.id_musren_lokasi_kgtn), 13, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.id_musren_lokasi_kgtn), 17, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.id_musren_lokasi_kgtn), 21)
                         )) AS jml_lokasi_kgtn,
                     SUM(IFNULL(vw_musren_anggaran_kgtn.jml_apbd_kab, 0)) AS jml_usulan_apbd_kab,
                     SUM(IFNULL(vw_musren_anggaran_kgtn.jml_apbd_prop, 0)) AS jml_usulan_apbd_prop,
                     SUM(IFNULL(vw_musren_anggaran_kgtn.jml_apbn, 0)) AS jml_usulan_apbn,
                     SUM(IFNULL(vw_musren_anggaran_kgtn.jml_lain,0)) AS jml_usulan_lainnya
                FROM
                     `musren_kgtn` musren_kgtn_kec 
                     INNER JOIN `musren_kgtn` musren_kgtn ON musren_kgtn_kec.`id_musren_kgtn` = musren_kgtn.`id_musren_kgtn`
                     INNER JOIN `sikd_satker` sikd_satker ON musren_kgtn_kec.`sikd_skpd_id` = sikd_satker.`id_sikd_satker`
                     INNER JOIN `sikd_bidang` sikd_musren_bidang ON musren_kgtn.`sikd_bidang_id` = sikd_musren_bidang.`id_sikd_bidang`
                     INNER JOIN `musren_musrenbang` musren_musrenbang ON musren_kgtn.`musren_musrenbang_id` = musren_musrenbang.`id_musren_musrenbang`
                     INNER JOIN `musren_musrenbang` musren_musrenbang_kec ON musren_musrenbang.`id_musren_musrenbang` = musren_musrenbang_kec.`id_musren_musrenbang` AND musren_musrenbang_kec.`musren_musrenbang_type` = 'MusrenMusrenbangKec'
                     INNER JOIN `musren_lokasi_kgtn` musren_lokasi_kgtn ON musren_kgtn.`id_musren_kgtn` = musren_lokasi_kgtn.`musren_kgtn_id`
                     INNER JOIN `vw_musren_anggaran_kgtn` vw_musren_anggaran_kgtn ON musren_lokasi_kgtn.`id_musren_lokasi_kgtn` = vw_musren_anggaran_kgtn.`musren_lokasi_kgtn_id`
                WHERE
                    musren_kgtn_kec.`musren_kgtn_type` = 'MusrenKgtnKec'
                 AND IF(:prioritas != '', musren_kgtn.`prioritas` = :prioritas, 1)
                 AND IF(:status = '1', musren_kgtn_kec.`status_verifikasi` = '1',
                        IF(:status = '0', musren_kgtn_kec.`status_verifikasi` IN ('','0'), 1))
                 AND ((vw_musren_anggaran_kgtn.jml_apbd_kab+
                       vw_musren_anggaran_kgtn.jml_apbd_prop+
                       vw_musren_anggaran_kgtn.jml_apbn+
                       vw_musren_anggaran_kgtn.jml_lain) >= 0)
                GROUP BY
                     sikd_musren_bidang.`kd_bidang`
                ORDER BY
                    sikd_musren_bidang.`kd_bidang` ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("status", $status);
            $statement->bindValue("prioritas", $prioritas);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getMusrenSkpdRekapKgtnSkpd($request)
    {
        try {

            $tahun = $request->query->get("tahun");
            $status = $request->query->get("status");
            $prioritas = $request->query->get("prioritas");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
           
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                         if(CONCAT_WS('-',
                        SUBSTR(HEX(musren_skpd_kgtn.sikd_sub_skpd_id), 1, 8),
                        SUBSTR(HEX(musren_skpd_kgtn.sikd_sub_skpd_id), 9, 4),
                        SUBSTR(HEX(musren_skpd_kgtn.sikd_sub_skpd_id), 13, 4),
                        SUBSTR(HEX(musren_skpd_kgtn.sikd_sub_skpd_id), 17, 4),
                        SUBSTR(HEX(musren_skpd_kgtn.sikd_sub_skpd_id), 21)
                         ) <> '', sikd_sub_skpd.kode, sikd_satker.`kode`) AS sikd_satker_kode,
                         if(CONCAT_WS('-',
                        SUBSTR(HEX(musren_skpd_kgtn.sikd_sub_skpd_id), 1, 8),
                        SUBSTR(HEX(musren_skpd_kgtn.sikd_sub_skpd_id), 9, 4),
                        SUBSTR(HEX(musren_skpd_kgtn.sikd_sub_skpd_id), 13, 4),
                        SUBSTR(HEX(musren_skpd_kgtn.sikd_sub_skpd_id), 17, 4),
                        SUBSTR(HEX(musren_skpd_kgtn.sikd_sub_skpd_id), 21)
                         ) <> '', sikd_sub_skpd.nama, sikd_satker.`nama`) AS sikd_satker_nama,
                         sum(vw_musren_skpd_anggaran_kgtn.`jml_apbd_kab`) AS jml_apbd_kab,
                         sum(vw_musren_skpd_anggaran_kgtn.`jml_apbd_prop`) AS jml_apbd_prop,
                         sum(vw_musren_skpd_anggaran_kgtn.`jml_apbn`) AS jml_apbn,
                         sum(vw_musren_skpd_anggaran_kgtn.`jml_lain`) AS jml_lain,
                         sum(vw_musren_skpd_anggaran_kgtn.`ttl_anggaran`) AS jml_satker,
                         count(distinct(CONCAT_WS('-',
                        SUBSTR(HEX(sikd_prog.id_sikd_prog), 1, 8),
                        SUBSTR(HEX(sikd_prog.id_sikd_prog), 9, 4),
                        SUBSTR(HEX(sikd_prog.id_sikd_prog), 13, 4),
                        SUBSTR(HEX(sikd_prog.id_sikd_prog), 17, 4),
                        SUBSTR(HEX(sikd_prog.id_sikd_prog), 21)
                         ))) AS jml_prog,
                         count(distinct(CONCAT_WS('-',
                        SUBSTR(HEX(musren_skpd_kgtn.sikd_kgtn_id), 1, 8),
                        SUBSTR(HEX(musren_skpd_kgtn.sikd_kgtn_id), 9, 4),
                        SUBSTR(HEX(musren_skpd_kgtn.sikd_kgtn_id), 13, 4),
                        SUBSTR(HEX(musren_skpd_kgtn.sikd_kgtn_id), 17, 4),
                        SUBSTR(HEX(musren_skpd_kgtn.sikd_kgtn_id), 21)
                         ))) AS jml_kgtn,
                         count(distinct(CONCAT_WS('-',
                        SUBSTR(HEX(musren_skpd_kgtn.id_musren_kgtn), 1, 8),
                        SUBSTR(HEX(musren_skpd_kgtn.id_musren_kgtn), 9, 4),
                        SUBSTR(HEX(musren_skpd_kgtn.id_musren_kgtn), 13, 4),
                        SUBSTR(HEX(musren_skpd_kgtn.id_musren_kgtn), 17, 4),
                        SUBSTR(HEX(musren_skpd_kgtn.id_musren_kgtn), 21)
                         ))) AS jml_sub_kgtn
                    FROM
                         `musren_kgtn` musren_skpd_kgtn 
                         INNER JOIN `musren_musrenbang` musren_forum_skpd ON musren_skpd_kgtn.`musren_musrenbang_id` = musren_forum_skpd.`id_musren_musrenbang` AND musren_forum_skpd.`musren_musrenbang_type` = 'MusrenForumSkpd'
                         INNER JOIN `sikd_satker` sikd_satker ON musren_skpd_kgtn.`sikd_skpd_id` = sikd_satker.`id_sikd_satker`
                         LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON musren_skpd_kgtn.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                         LEFT OUTER JOIN `sikd_bidang` sikd_bidang ON musren_skpd_kgtn.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                         INNER JOIN `sikd_kgtn` sikd_kgtn ON musren_skpd_kgtn.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                         INNER JOIN `sikd_prog` sikd_prog ON sikd_kgtn.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                         INNER JOIN `musren_lokasi_kgtn` musren_skpd_lokasi_kgtn ON musren_skpd_kgtn.`id_musren_kgtn` = musren_skpd_lokasi_kgtn.`musren_kgtn_id`
                         INNER JOIN `vw_musren_skpd_anggaran_kgtn` vw_musren_skpd_anggaran_kgtn ON musren_skpd_lokasi_kgtn.`id_musren_lokasi_kgtn` = vw_musren_skpd_anggaran_kgtn.`musren_skpd_lokasi_kgtn_id`
                    WHERE
                        musren_skpd_kgtn.`musren_kgtn_type` = 'MusrenKgtnSkpd'
                     AND musren_forum_skpd.`tahun` = :tahun
                     AND IF(:status = '1', musren_skpd_kgtn.`status_verifikasi` = '1',
                            IF(:status = '0', musren_skpd_kgtn.`status_verifikasi` IN ('','0'), 1))
                     AND IF(:prioritas != '', musren_skpd_kgtn.`prioritas` = :prioritas, 1)
                    GROUP BY
                         sikd_satker_kode
                    ORDER BY
                         sikd_satker_kode ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("tahun", $tahun);
            $statement->bindValue("status", $status);
            $statement->bindValue("prioritas", $prioritas);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getMusrenSkpdRekapKgtnSkpd2($request)
    {
        try {

            $tahun = $request->query->get("tahun");
            $status = $request->query->get("status");
            $prioritas = $request->query->get("prioritas");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
           
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                         if(CONCAT_WS('-',
                        SUBSTR(HEX(musren_skpd_kgtn.sikd_sub_skpd_id), 1, 8),
                        SUBSTR(HEX(musren_skpd_kgtn.sikd_sub_skpd_id), 9, 4),
                        SUBSTR(HEX(musren_skpd_kgtn.sikd_sub_skpd_id), 13, 4),
                        SUBSTR(HEX(musren_skpd_kgtn.sikd_sub_skpd_id), 17, 4),
                        SUBSTR(HEX(musren_skpd_kgtn.sikd_sub_skpd_id), 21)
                         ) <> '', sikd_sub_skpd.kode, sikd_satker.`kode`) AS sikd_satker_kode,
                         if(CONCAT_WS('-',
                        SUBSTR(HEX(musren_skpd_kgtn.sikd_sub_skpd_id), 1, 8),
                        SUBSTR(HEX(musren_skpd_kgtn.sikd_sub_skpd_id), 9, 4),
                        SUBSTR(HEX(musren_skpd_kgtn.sikd_sub_skpd_id), 13, 4),
                        SUBSTR(HEX(musren_skpd_kgtn.sikd_sub_skpd_id), 17, 4),
                        SUBSTR(HEX(musren_skpd_kgtn.sikd_sub_skpd_id), 21)
                         ) <> '', sikd_sub_skpd.nama, sikd_satker.`nama`) AS sikd_satker_nama,
                         SUM(if(musren_forum_skpd.musren_musrenbang_type = 'ForumSkpd', musren_skpd_lokasi_kgtn.`jml_anggaran`, 0)) AS jml_skpd,
                         SUM(if(musren_forum_skpd.musren_musrenbang_type = 'ForumReses', musren_skpd_lokasi_kgtn.`jml_anggaran`, 0)) AS jml_reses,
                         SUM(if(musren_forum_skpd.musren_musrenbang_type = 'ForumMusrenbang'&&length(musren_skpd_lokasi_kgtn.kd_wilayah) = 6, musren_skpd_lokasi_kgtn.`jml_anggaran`, 0)) AS jml_kec,
                         SUM(if(musren_forum_skpd.musren_musrenbang_type = 'ForumMusrenbang'&&length(musren_skpd_lokasi_kgtn.kd_wilayah) > 6, musren_skpd_lokasi_kgtn.`jml_anggaran`, 0)) AS jml_desa,
                         count(distinct(CONCAT_WS('-',
                        SUBSTR(HEX(sikd_prog.id_sikd_prog), 1, 8),
                        SUBSTR(HEX(sikd_prog.id_sikd_prog), 9, 4),
                        SUBSTR(HEX(sikd_prog.id_sikd_prog), 13, 4),
                        SUBSTR(HEX(sikd_prog.id_sikd_prog), 17, 4),
                        SUBSTR(HEX(sikd_prog.id_sikd_prog), 21)
                         ))) AS jml_prog,
                         count(distinct(CONCAT_WS('-',
                        SUBSTR(HEX(musren_skpd_kgtn.sikd_kgtn_id), 1, 8),
                        SUBSTR(HEX(musren_skpd_kgtn.sikd_kgtn_id), 9, 4),
                        SUBSTR(HEX(musren_skpd_kgtn.sikd_kgtn_id), 13, 4),
                        SUBSTR(HEX(musren_skpd_kgtn.sikd_kgtn_id), 17, 4),
                        SUBSTR(HEX(musren_skpd_kgtn.sikd_kgtn_id), 21)
                         ))) AS jml_kgtn,
                         count(CONCAT_WS('-',
                        SUBSTR(HEX(musren_skpd_kgtn.id_musren_kgtn), 1, 8),
                        SUBSTR(HEX(musren_skpd_kgtn.id_musren_kgtn), 9, 4),
                        SUBSTR(HEX(musren_skpd_kgtn.id_musren_kgtn), 13, 4),
                        SUBSTR(HEX(musren_skpd_kgtn.id_musren_kgtn), 17, 4),
                        SUBSTR(HEX(musren_skpd_kgtn.id_musren_kgtn), 21)
                         )) AS jml_sub_kgtn
                    FROM
                         `musren_kgtn` musren_skpd_kgtn 
                         INNER JOIN `musren_musrenbang` musren_forum_skpd ON musren_skpd_kgtn.`musren_musrenbang_id` = musren_forum_skpd.`id_musren_musrenbang` AND musren_forum_skpd.`musren_musrenbang_type` = 'MusrenForumSkpd'
                         INNER JOIN `sikd_satker` sikd_satker ON musren_skpd_kgtn.`sikd_skpd_id` = sikd_satker.`id_sikd_satker`
                         LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON musren_skpd_kgtn.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                         LEFT OUTER JOIN `sikd_bidang` sikd_bidang ON musren_skpd_kgtn.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                         INNER JOIN `sikd_kgtn` sikd_kgtn ON musren_skpd_kgtn.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                         INNER JOIN `sikd_prog` sikd_prog ON sikd_kgtn.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                         INNER JOIN `musren_lokasi_kgtn` musren_skpd_lokasi_kgtn ON musren_skpd_kgtn.`id_musren_kgtn` = musren_skpd_lokasi_kgtn.`musren_kgtn_id`
                         -- INNER JOIN `musren_skpd_anggaran_kgtn` musren_skpd_anggaran_kgtn ON musren_skpd_lokasi_kgtn.`id_musren_skpd_lokasi_kgtn` = musren_skpd_anggaran_kgtn.`musren_skpd_lokasi_kgtn_id`
                    WHERE
                        musren_skpd_kgtn.`musren_kgtn_type` = 'MusrenKgtnSkpd'
                     AND musren_forum_skpd.`tahun` = :tahun
                     AND IF(:status = '1', musren_skpd_kgtn.`status_verifikasi` = '1',
                            IF(:status = '0', musren_skpd_kgtn.`status_verifikasi` IN ('','0'), 1))
                     AND IF(:prioritas != '', musren_skpd_kgtn.`prioritas` = :prioritas, 1)
                    GROUP BY
                         sikd_satker_kode
                    ORDER BY
                         sikd_satker_kode ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("tahun", $tahun);
            $statement->bindValue("status", $status);
            $statement->bindValue("prioritas", $prioritas);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    
    
    private function getMusrenSkpdRekapBidProg($request)
    {
        try {

            $tahun = $request->query->get("tahun");
            $status = $request->query->get("status");
            $idBidang = $request->query->get("id_bidang");
            $prioritas = $request->query->get("prioritas");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idBidang = pack('H*', str_replace('-', '', trim($idBidang)));
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
                         sikd_prog.`kd_prog` AS sikd_prog_kd_prog,
                         sikd_prog.`nm_prog` AS sikd_prog_nm_prog,
                         SUM(vw_musren_skpd_anggaran_kgtn.`jml_apbd_kab`) AS vw_musren_anggaran_kgtn_jml_apbd_kab,
                         SUM(vw_musren_skpd_anggaran_kgtn.`jml_apbd_prop`) AS vw_musren_anggaran_kgtn_jml_apbd_prop,
                         SUM(vw_musren_skpd_anggaran_kgtn.`jml_apbn`) AS vw_musren_anggaran_kgtn_jml_apbn,
                         SUM(vw_musren_skpd_anggaran_kgtn.`jml_lain`) AS vw_musren_anggaran_kgtn_jml_lain,
                         SUM(vw_musren_skpd_anggaran_kgtn.`jml_apbn`) AS vw_musren_anggaran_kgtn_ttl_jml_apbn,
                         SUM(vw_musren_skpd_anggaran_kgtn.`ttl_anggaran`) AS vw_musren_anggaran_kgtn_jml_prog,
                         count(distinct(CONCAT_WS('-',
                        SUBSTR(HEX(sikd_prog.id_sikd_prog), 1, 8),
                        SUBSTR(HEX(sikd_prog.id_sikd_prog), 9, 4),
                        SUBSTR(HEX(sikd_prog.id_sikd_prog), 13, 4),
                        SUBSTR(HEX(sikd_prog.id_sikd_prog), 17, 4),
                        SUBSTR(HEX(sikd_prog.id_sikd_prog), 21)
                         ))) AS jml_prog,
                         count(distinct(CONCAT_WS('-',
                        SUBSTR(HEX(musren_skpd_kgtn.sikd_kgtn_id), 1, 8),
                        SUBSTR(HEX(musren_skpd_kgtn.sikd_kgtn_id), 9, 4),
                        SUBSTR(HEX(musren_skpd_kgtn.sikd_kgtn_id), 13, 4),
                        SUBSTR(HEX(musren_skpd_kgtn.sikd_kgtn_id), 17, 4),
                        SUBSTR(HEX(musren_skpd_kgtn.sikd_kgtn_id), 21)
                         ))) AS jml_kgtn,
                         count(distinct(CONCAT_WS('-',
                        SUBSTR(HEX(musren_skpd_kgtn.id_musren_kgtn), 1, 8),
                        SUBSTR(HEX(musren_skpd_kgtn.id_musren_kgtn), 9, 4),
                        SUBSTR(HEX(musren_skpd_kgtn.id_musren_kgtn), 13, 4),
                        SUBSTR(HEX(musren_skpd_kgtn.id_musren_kgtn), 17, 4),
                        SUBSTR(HEX(musren_skpd_kgtn.id_musren_kgtn), 21)
                         ))) AS jml_sub_kgtn
                    FROM
                         `musren_kgtn` musren_skpd_kgtn 
                         INNER JOIN `musren_musrenbang` musren_forum_skpd ON musren_skpd_kgtn.`musren_musrenbang_id` = musren_forum_skpd.`id_musren_musrenbang` AND musren_forum_skpd.`musren_musrenbang_type` = 'MusrenForumSkpd'
                         LEFT OUTER JOIN `sikd_bidang` sikd_bidang ON musren_skpd_kgtn.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                         INNER JOIN `sikd_kgtn` sikd_kgtn ON musren_skpd_kgtn.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                         INNER JOIN `sikd_prog` sikd_prog ON  sikd_kgtn.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                         INNER JOIN `musren_lokasi_kgtn` musren_skpd_lokasi_kgtn ON musren_skpd_kgtn.`id_musren_kgtn` = musren_skpd_lokasi_kgtn.`musren_kgtn_id`
                         INNER JOIN `vw_musren_skpd_anggaran_kgtn` vw_musren_skpd_anggaran_kgtn ON musren_skpd_lokasi_kgtn.`id_musren_lokasi_kgtn` = vw_musren_skpd_anggaran_kgtn.`musren_skpd_lokasi_kgtn_id`
                    WHERE
                        musren_skpd_kgtn.`musren_kgtn_type` = 'MusrenKgtnSkpd'
                     AND musren_forum_skpd.`tahun` = :tahun
                     AND IF(:status = '1', musren_skpd_kgtn.`status_verifikasi` = '1',
                            IF(:status = '0', musren_skpd_kgtn.`status_verifikasi` IN ('','0'), 1))
                     AND IF(:id_bidang != '', musren_skpd_kgtn.`sikd_bidang_id` = :id_bidang, 1)
                     AND IF(:prioritas != '', musren_skpd_kgtn.`prioritas` = :prioritas, 1)
                    GROUP BY
                         sikd_bidang.`kd_bidang`,
                         sikd_prog.`kd_prog`
                    ORDER BY
                         sikd_bidang.`kd_bidang` ASC,
                         sikd_prog.`kd_prog` ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("tahun", $tahun);
            $statement->bindValue("status", $status);
            $statement->bindValue("id_bidang", $idBidang);
            $statement->bindValue("prioritas", $prioritas);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getMusrenKabRekapKgtnSkpd($request)
    {
        try {

            $tahun = $request->query->get("tahun");
            $prioritas = $request->query->get("prioritas");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
           
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                         if(CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn_kab.sikd_sub_skpd_id), 1, 8),
                        SUBSTR(HEX(musren_kgtn_kab.sikd_sub_skpd_id), 9, 4),
                        SUBSTR(HEX(musren_kgtn_kab.sikd_sub_skpd_id), 13, 4),
                        SUBSTR(HEX(musren_kgtn_kab.sikd_sub_skpd_id), 17, 4),
                        SUBSTR(HEX(musren_kgtn_kab.sikd_sub_skpd_id), 21)
                         ) <> '', sikd_sub_skpd.kode, sikd_satker.`kode`) AS sikd_satker_kode,
                         if(CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn_kab.sikd_sub_skpd_id), 1, 8),
                        SUBSTR(HEX(musren_kgtn_kab.sikd_sub_skpd_id), 9, 4),
                        SUBSTR(HEX(musren_kgtn_kab.sikd_sub_skpd_id), 13, 4),
                        SUBSTR(HEX(musren_kgtn_kab.sikd_sub_skpd_id), 17, 4),
                        SUBSTR(HEX(musren_kgtn_kab.sikd_sub_skpd_id), 21)
                         ) <> '', sikd_sub_skpd.nama, sikd_satker.`nama`) AS sikd_satker_nama,
                         sum(vw_musren_anggaran_kgtn.`jml_apbd_kab`) AS jml_apbd_kab,
                         sum(vw_musren_anggaran_kgtn.`jml_apbd_prop`) AS jml_apbd_prop,
                         sum(vw_musren_anggaran_kgtn.`jml_apbn`) AS jml_apbn,
                         sum(vw_musren_anggaran_kgtn.`jml_lain`) AS jml_lain,
                         sum(vw_musren_anggaran_kgtn.`jml_apbn`) AS ttl_jml_apbn,
                         sum(vw_musren_anggaran_kgtn.`jml_apbd_kab`+vw_musren_anggaran_kgtn.`jml_apbd_prop`+vw_musren_anggaran_kgtn.`jml_lain`+vw_musren_anggaran_kgtn.`jml_apbn`) AS jml_satker,
                         count(distinct(CONCAT_WS('-',
                        SUBSTR(HEX(sikd_prog.id_sikd_prog), 1, 8),
                        SUBSTR(HEX(sikd_prog.id_sikd_prog), 9, 4),
                        SUBSTR(HEX(sikd_prog.id_sikd_prog), 13, 4),
                        SUBSTR(HEX(sikd_prog.id_sikd_prog), 17, 4),
                        SUBSTR(HEX(sikd_prog.id_sikd_prog), 21)
                         ))) AS jml_prog,
                         count(distinct(CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn.sikd_kgtn_id), 1, 8),
                        SUBSTR(HEX(musren_kgtn.sikd_kgtn_id), 9, 4),
                        SUBSTR(HEX(musren_kgtn.sikd_kgtn_id), 13, 4),
                        SUBSTR(HEX(musren_kgtn.sikd_kgtn_id), 17, 4),
                        SUBSTR(HEX(musren_kgtn.sikd_kgtn_id), 21)
                         ))) AS jml_kgtn,
                         count(distinct(CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn.id_musren_kgtn), 1, 8),
                        SUBSTR(HEX(musren_kgtn.id_musren_kgtn), 9, 4),
                        SUBSTR(HEX(musren_kgtn.id_musren_kgtn), 13, 4),
                        SUBSTR(HEX(musren_kgtn.id_musren_kgtn), 17, 4),
                        SUBSTR(HEX(musren_kgtn.id_musren_kgtn), 21)
                         ))) AS jml_sub_kgtn
                    FROM
                         `musren_kgtn` musren_kgtn 
                         INNER JOIN `musren_kgtn` musren_kgtn_kab ON musren_kgtn.`id_musren_kgtn` = musren_kgtn_kab.`id_musren_kgtn` AND musren_kgtn_kab.`musren_kgtn_type` = 'MusrenKgtnKab'
                         INNER JOIN `sikd_satker` sikd_satker ON musren_kgtn_kab.`sikd_skpd_id` = sikd_satker.`id_sikd_satker`
                         LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON musren_kgtn_kab.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                         LEFT OUTER JOIN `sikd_bidang` sikd_bidang ON musren_kgtn.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                         INNER JOIN `sikd_kgtn` sikd_kgtn ON musren_kgtn.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                         INNER JOIN `sikd_prog` sikd_prog ON sikd_kgtn.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                         INNER JOIN `musren_lokasi_kgtn` musren_lokasi_kgtn ON musren_kgtn.`id_musren_kgtn` = musren_lokasi_kgtn.`musren_kgtn_id`
                         INNER JOIN `musren_musrenbang` musren_musrenbang ON musren_kgtn.`musren_musrenbang_id` = musren_musrenbang.`id_musren_musrenbang`
                         INNER JOIN `vw_musren_anggaran_kgtn` vw_musren_anggaran_kgtn ON musren_lokasi_kgtn.`id_musren_lokasi_kgtn` = vw_musren_anggaran_kgtn.`musren_lokasi_kgtn_id`
                    WHERE
                         musren_musrenbang.`tahun` = :tahun
                     AND IF(:prioritas != '', musren_kgtn.`prioritas` = :prioritas, 1)
                    GROUP BY
                         sikd_satker_kode
                    ORDER BY
                         sikd_satker_kode ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("tahun", $tahun);
            $statement->bindValue("prioritas", $prioritas);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getMusrenKabRekapKgtnSkpd2($request)
    {
        try {

            $tahun = $request->query->get("tahun");
            $prioritas = $request->query->get("prioritas");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
           
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                         if(CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn_kab.sikd_sub_skpd_id), 1, 8),
                        SUBSTR(HEX(musren_kgtn_kab.sikd_sub_skpd_id), 9, 4),
                        SUBSTR(HEX(musren_kgtn_kab.sikd_sub_skpd_id), 13, 4),
                        SUBSTR(HEX(musren_kgtn_kab.sikd_sub_skpd_id), 17, 4),
                        SUBSTR(HEX(musren_kgtn_kab.sikd_sub_skpd_id), 21)
                         ) <> '', sikd_sub_skpd.kode, sikd_satker.`kode`) AS sikd_satker_kode,
                         if(CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn_kab.sikd_sub_skpd_id), 1, 8),
                        SUBSTR(HEX(musren_kgtn_kab.sikd_sub_skpd_id), 9, 4),
                        SUBSTR(HEX(musren_kgtn_kab.sikd_sub_skpd_id), 13, 4),
                        SUBSTR(HEX(musren_kgtn_kab.sikd_sub_skpd_id), 17, 4),
                        SUBSTR(HEX(musren_kgtn_kab.sikd_sub_skpd_id), 21)
                         ) <> '', sikd_sub_skpd.nama, sikd_satker.`nama`) AS sikd_satker_nama,
                         SUM(if(musren_musrenbang.musren_musrenbang_type = 'ForumSkpd', musren_lokasi_kgtn.`jml_anggaran`, 0)) AS jml_skpd,
                         SUM(if(musren_musrenbang.musren_musrenbang_type = 'ForumReses', musren_lokasi_kgtn.`jml_anggaran`, 0)) AS jml_reses,
                         SUM(if(musren_musrenbang.musren_musrenbang_type = 'ForumMusrenbang'&&length(musren_lokasi_kgtn.kd_wilayah) = 6, musren_lokasi_kgtn.`jml_anggaran`, 0)) AS jml_kec,
                         SUM(if(musren_musrenbang.musren_musrenbang_type = 'ForumMusrenbang'&&length(musren_lokasi_kgtn.kd_wilayah) > 6, musren_lokasi_kgtn.`jml_anggaran`, 0)) AS jml_desa,
                         count(distinct(CONCAT_WS('-',
                        SUBSTR(HEX(sikd_prog.id_sikd_prog), 1, 8),
                        SUBSTR(HEX(sikd_prog.id_sikd_prog), 9, 4),
                        SUBSTR(HEX(sikd_prog.id_sikd_prog), 13, 4),
                        SUBSTR(HEX(sikd_prog.id_sikd_prog), 17, 4),
                        SUBSTR(HEX(sikd_prog.id_sikd_prog), 21)
                         ))) AS jml_prog,
                         count(distinct(CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn.sikd_kgtn_id), 1, 8),
                        SUBSTR(HEX(musren_kgtn.sikd_kgtn_id), 9, 4),
                        SUBSTR(HEX(musren_kgtn.sikd_kgtn_id), 13, 4),
                        SUBSTR(HEX(musren_kgtn.sikd_kgtn_id), 17, 4),
                        SUBSTR(HEX(musren_kgtn.sikd_kgtn_id), 21)
                         ))) AS jml_kgtn,
                         count(distinct(CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn.id_musren_kgtn), 1, 8),
                        SUBSTR(HEX(musren_kgtn.id_musren_kgtn), 9, 4),
                        SUBSTR(HEX(musren_kgtn.id_musren_kgtn), 13, 4),
                        SUBSTR(HEX(musren_kgtn.id_musren_kgtn), 17, 4),
                        SUBSTR(HEX(musren_kgtn.id_musren_kgtn), 21)
                         ))) AS jml_sub_kgtn
                    FROM
                         `musren_kgtn` musren_kgtn 
                         INNER JOIN `musren_kgtn` musren_kgtn_kab ON musren_kgtn.`id_musren_kgtn` = musren_kgtn_kab.`id_musren_kgtn` AND musren_kgtn_kab.`musren_kgtn_type` = 'MusrenKgtnKab'
                         INNER JOIN `sikd_satker` sikd_satker ON musren_kgtn_kab.`sikd_skpd_id` = sikd_satker.`id_sikd_satker`
                         LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON musren_kgtn_kab.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                         LEFT OUTER JOIN `sikd_bidang` sikd_bidang ON musren_kgtn.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                         INNER JOIN `sikd_kgtn` sikd_kgtn ON musren_kgtn.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                         INNER JOIN `sikd_prog` sikd_prog ON sikd_kgtn.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                         INNER JOIN `musren_lokasi_kgtn` musren_lokasi_kgtn ON musren_kgtn.`id_musren_kgtn` = musren_lokasi_kgtn.`musren_kgtn_id`
                         INNER JOIN `musren_musrenbang` musren_musrenbang ON musren_kgtn.`musren_musrenbang_id` = musren_musrenbang.`id_musren_musrenbang`
                         -- INNER JOIN `musren_anggaran_kgtn` musren_anggaran_kgtn ON musren_lokasi_kgtn.`id_musren_lokasi_kgtn` = musren_anggaran_kgtn.`musren_lokasi_kgtn_id`
                    WHERE
                         musren_musrenbang.`tahun` = :tahun
                     AND IF(:prioritas != '', musren_kgtn.`prioritas` = :prioritas, 1)
                    GROUP BY
                         sikd_satker_kode
                    ORDER BY
                         sikd_satker_kode ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("tahun", $tahun);
            $statement->bindValue("prioritas", $prioritas);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getMusrenKabListKgtn($request)
    {
        try {

            $tahun = $request->query->get("tahun");
            $idSkpd = $request->query->get("id_skpd");
            $idSubSkpd = $request->query->get("id_subskpd");
            $idBidang = $request->query->get("id_bidang");
            $prioritas = $request->query->get("prioritas");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idSkpd = pack('H*', str_replace('-', '', trim($idSkpd)));
            $idSubSkpd = pack('H*', str_replace('-', '', trim($idSubSkpd)));
            $idBidang = pack('H*', str_replace('-', '', trim($idBidang)));
           
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                         sikd_satker.`kode` AS sikd_satker_kode,
                         sikd_satker.`nama` AS sikd_satker_nama,
                         sikd_sub_skpd.`kode` AS sikd_sub_skpd_kode,
                         sikd_sub_skpd.`nama` AS sikd_sub_skpd_nama,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 1, 8),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 9, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 13, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 17, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 21)
                         ) AS musren_kgtn_id_musren_kgtn,
                         substring(sikd_kgtn.kd_kgtn,3,3) AS skpd_kgtn_kode,
                         musren_kgtn.`kd_kgtn` AS musren_kgtn_kd_kgtn,
                         musren_kgtn.`nm_kgtn` AS musren_kgtn_nm_kgtn,
                         ifnull(musren_kgtn.`no_subkgtn`,'-') AS musren_kgtn_no_subkgtn,
                         musren_kgtn.`nm_subkgtn` AS musren_kgtn_nm_subkgtn,
                         musren_kgtn.`prioritas` AS musren_kgtn_prioritas,
                         musren_kgtn.`sifat_kgtn` AS musren_kgtn_sifat_kgtn,
                         musren_kgtn.`output` AS musren_kgtn_output,
                         musren_kgtn.`outcome` AS musren_kgtn_outcome,
                        CONCAT_WS('-',
                        SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 1, 8),
                        SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 9, 4),
                        SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 13, 4),
                        SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 17, 4),
                        SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 21)
                         ) AS sikd_bidang_id_sikd_bidang,
                         sikd_bidang.`kd_bidang` AS sikd_bidang_kd_bidang,
                         sikd_bidang.`nm_bidang` AS sikd_bidang_nm_bidang,
                         sikd_prog.`kd_prog` AS sikd_prog_kd_prog,
                         sikd_prog.`nm_prog` AS sikd_prog_nm_prog,
                         SUM(vw_musren_anggaran_kgtn.`jml_apbd_kab`) AS vw_musren_anggaran_kgtn_jml_apbd_kab,
                         SUM(vw_musren_anggaran_kgtn.`jml_apbd_prop`) AS vw_musren_anggaran_kgtn_jml_apbd_prop,
                         SUM(vw_musren_anggaran_kgtn.`jml_apbn`) AS vw_musren_anggaran_kgtn_jml_apbn,
                         SUM(vw_musren_anggaran_kgtn.`jml_lain`) AS vw_musren_anggaran_kgtn_jml_lain
                    FROM
                         `musren_kgtn` musren_kgtn 
                         INNER JOIN `musren_kgtn` musren_kgtn_kab ON musren_kgtn.`id_musren_kgtn` = musren_kgtn_kab.`id_musren_kgtn` AND musren_kgtn_kab.`musren_kgtn_type` = 'MusrenKgtnKab'
                         INNER JOIN `sikd_satker` sikd_satker ON musren_kgtn_kab.`sikd_skpd_id` = sikd_satker.`id_sikd_satker`
                         LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON musren_kgtn_kab.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                         LEFT OUTER JOIN `sikd_bidang` sikd_bidang ON musren_kgtn.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                         INNER JOIN `sikd_kgtn` sikd_kgtn ON musren_kgtn.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                         INNER JOIN `sikd_prog` sikd_prog ON sikd_kgtn.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                         INNER JOIN `musren_lokasi_kgtn` musren_lokasi_kgtn ON musren_kgtn.`id_musren_kgtn` = musren_lokasi_kgtn.`musren_kgtn_id`
                         INNER JOIN `vw_musren_anggaran_kgtn` vw_musren_anggaran_kgtn ON musren_lokasi_kgtn.`id_musren_lokasi_kgtn` = vw_musren_anggaran_kgtn.`musren_lokasi_kgtn_id`
                         INNER JOIN `musren_musrenbang` musren_musrenbang ON musren_kgtn.`musren_musrenbang_id` = musren_musrenbang.`id_musren_musrenbang`
                         INNER JOIN `vw_appl_kode_wilayah` vw_appl_kode_wilayah ON musren_musrenbang.`kd_wilayah` = vw_appl_kode_wilayah.`kode_wilayah`
                    WHERE
                         musren_musrenbang.`tahun` = :tahun
                     AND IF(:id_skpd != '', sikd_satker.id_sikd_satker = :id_skpd, 1)
                     AND IF(:id_subskpd != '', musren_kgtn_kab.`sikd_sub_skpd_id` = :id_subskpd, 1)
                     AND IF(:id_bidang != '', musren_kgtn.`sikd_bidang_id` = :id_bidang, 1)
                     AND IF(:prioritas != '', musren_kgtn.`prioritas` = :prioritas, 1)
                     AND (vw_appl_kode_wilayah.klasifikasi = 'KAB' or vw_appl_kode_wilayah.klasifikasi = 'KOTA')
                    GROUP BY
                         sikd_satker.kode,
                         sikd_sub_skpd.kode,
                         sikd_bidang.`kd_bidang`,
                         sikd_prog.`kd_prog`,
                         musren_kgtn.`kd_kgtn`,
                         musren_kgtn.`no_subkgtn`
                    ORDER BY
                         sikd_satker.kode ASC,
                         sikd_sub_skpd.kode ASC,
                         sikd_bidang.`kd_bidang` ASC,
                         sikd_prog.`kd_prog` ASC,
                         musren_kgtn.`kd_kgtn` ASC,
                         lpad(musren_kgtn.`no_subkgtn`,3,0) ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("tahun", $tahun);
            $statement->bindValue("id_skpd", $idSkpd);
            $statement->bindValue("id_subskpd", $idSubSkpd);
            $statement->bindValue("id_bidang", $idBidang);
            $statement->bindValue("prioritas", $prioritas);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getMusrenKabListKgtnSub($request)
    {
        try {

            $idMusrenKgtn = $request->query->get("id_musren_kgtn");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idMusrenKgtn = pack('H*', str_replace('-', '', trim($idMusrenKgtn)));
           
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                         musren_lokasi_kgtn.`nm_lokasi` AS musren_lokasi_kgtn_nm_lokasi_kgtn,
                         musren_lokasi_kgtn.`volume` AS musren_lokasi_kgtn_volume,
                         musren_lokasi_kgtn.`satuan` AS musren_lokasi_kgtn_satuan,
                         vw_musren_anggaran_kgtn.`jml_apbd_kab` AS vw_musren_anggaran_kgtn_jml_apbd_kab,
                         vw_musren_anggaran_kgtn.`jml_apbd_prop` AS vw_musren_anggaran_kgtn_jml_apbd_prop,
                         vw_musren_anggaran_kgtn.`jml_apbn` AS vw_musren_anggaran_kgtn_jml_apbn,
                         vw_musren_anggaran_kgtn.`jml_lain` AS vw_musren_anggaran_kgtn_jml_lain
                    FROM
                         `musren_lokasi_kgtn` musren_lokasi_kgtn 
                         INNER JOIN `musren_kgtn` musren_kgtn ON musren_lokasi_kgtn.`musren_kgtn_id` = musren_kgtn.`id_musren_kgtn`
                         INNER JOIN `vw_musren_anggaran_kgtn` vw_musren_anggaran_kgtn ON musren_lokasi_kgtn.`id_musren_lokasi_kgtn` = vw_musren_anggaran_kgtn.`musren_lokasi_kgtn_id`
                    WHERE
                         musren_kgtn.`id_musren_kgtn` = :id_musren_kgtn";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_musren_kgtn", $idMusrenKgtn);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getMusrenKabListKgtnRingkas($request)
    {
        try {

            $tahun = $request->query->get("tahun");
            $idSkpd = $request->query->get("id_skpd");
            $idSubSkpd = $request->query->get("id_subskpd");
            $idBidang = $request->query->get("id_bidang");
            $prioritas = $request->query->get("prioritas");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idSkpd = pack('H*', str_replace('-', '', trim($idSkpd)));
            $idSubSkpd = pack('H*', str_replace('-', '', trim($idSubSkpd)));
            $idBidang = pack('H*', str_replace('-', '', trim($idBidang)));
           
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                         sikd_satker.`kode` AS sikd_satker_kode,
                         sikd_satker.`nama` AS sikd_satker_nama,
                         sikd_sub_skpd.`kode` AS sikd_sub_skpd_kode,
                         sikd_sub_skpd.`nama` AS sikd_sub_skpd_nama,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 1, 8),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 9, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 13, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 17, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 21)
                         ) AS musren_kgtn_id_musren_kgtn,
                         substring(sikd_kgtn.kd_kgtn,3,3) AS skpd_kgtn_kode,
                         musren_kgtn.`kd_kgtn` AS musren_kgtn_kd_kgtn,
                         musren_kgtn.`nm_kgtn` AS musren_kgtn_nm_kgtn,
                         ifnull(musren_kgtn.`no_subkgtn`,'-') AS musren_kgtn_no_subkgtn,
                         musren_kgtn.`nm_subkgtn` AS musren_kgtn_nm_subkgtn,
                         musren_kgtn.`prioritas` AS musren_kgtn_prioritas,
                         musren_kgtn.`sifat_kgtn` AS musren_kgtn_sifat_kgtn,
                         musren_kgtn.`output` AS musren_kgtn_output,
                         musren_kgtn.`outcome` AS musren_kgtn_outcome,
                        CONCAT_WS('-',
                        SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 1, 8),
                        SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 9, 4),
                        SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 13, 4),
                        SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 17, 4),
                        SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 21)
                         ) AS sikd_bidang_id_sikd_bidang,
                         sikd_bidang.`kd_bidang` AS sikd_bidang_kd_bidang,
                         sikd_bidang.`nm_bidang` AS sikd_bidang_nm_bidang,
                         sikd_prog.`kd_prog` AS sikd_prog_kd_prog,
                         sikd_prog.`nm_prog` AS sikd_prog_nm_prog,
                         SUM(vw_musren_anggaran_kgtn.`jml_apbd_kab`) AS vw_musren_anggaran_kgtn_jml_apbd_kab,
                         SUM(vw_musren_anggaran_kgtn.`jml_apbd_prop`) AS vw_musren_anggaran_kgtn_jml_apbd_prop,
                         SUM(vw_musren_anggaran_kgtn.`jml_apbn`) AS vw_musren_anggaran_kgtn_jml_apbn,
                         SUM(vw_musren_anggaran_kgtn.`jml_lain`) AS vw_musren_anggaran_kgtn_jml_lain
                    FROM
                         `musren_kgtn` musren_kgtn 
                         INNER JOIN `musren_kgtn` musren_kgtn_kab ON musren_kgtn.`id_musren_kgtn` = musren_kgtn_kab.`id_musren_kgtn` AND musren_kgtn_kab.`musren_kgtn_type` = 'MusrenKgtnKab'
                         INNER JOIN `sikd_satker` sikd_satker ON musren_kgtn_kab.`sikd_skpd_id` = sikd_satker.`id_sikd_satker`
                         LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON musren_kgtn_kab.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                         LEFT OUTER JOIN `sikd_bidang` sikd_bidang ON musren_kgtn.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                         INNER JOIN `sikd_kgtn` sikd_kgtn ON musren_kgtn.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                         INNER JOIN `sikd_prog` sikd_prog ON sikd_kgtn.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                         INNER JOIN `musren_lokasi_kgtn` musren_lokasi_kgtn ON musren_kgtn.`id_musren_kgtn` = musren_lokasi_kgtn.`musren_kgtn_id`
                         INNER JOIN `vw_musren_anggaran_kgtn` vw_musren_anggaran_kgtn ON musren_lokasi_kgtn.`id_musren_lokasi_kgtn` = vw_musren_anggaran_kgtn.`musren_lokasi_kgtn_id`
                         INNER JOIN `musren_musrenbang` musren_musrenbang ON musren_kgtn.`musren_musrenbang_id` = musren_musrenbang.`id_musren_musrenbang`
                    WHERE
                         musren_musrenbang.`tahun` = :tahun
                     AND IF(:id_skpd != '', sikd_satker.id_sikd_satker = :id_skpd, 1)
                     AND IF(:id_subskpd != '', musren_kgtn_kab.`sikd_sub_skpd_id` = :id_subskpd, 1)
                     AND IF(:id_bidang != '', musren_kgtn.`sikd_bidang_id` = :id_bidang, 1)
                     AND IF(:prioritas != '', musren_kgtn.`prioritas` = :prioritas, 1)
                    GROUP BY
                         sikd_satker.kode,
                         sikd_sub_skpd.kode,
                         sikd_bidang.`kd_bidang`,
                         sikd_prog.`kd_prog`,
                         musren_kgtn.`kd_kgtn`,
                         musren_kgtn.`no_subkgtn`
                    ORDER BY
                         sikd_satker.kode ASC,
                         sikd_sub_skpd.kode ASC,
                         sikd_bidang.`kd_bidang` ASC,
                         sikd_prog.`kd_prog` ASC,
                         musren_kgtn.`kd_kgtn` ASC,
                         lpad(musren_kgtn.`no_subkgtn`,3,0) ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("tahun", $tahun);
            $statement->bindValue("id_skpd", $idSkpd);
            $statement->bindValue("id_subskpd", $idSubSkpd);
            $statement->bindValue("id_bidang", $idBidang);
            $statement->bindValue("prioritas", $prioritas);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getMusrenKabRekapBidProg($request)
    {
        try {

            $tahun = $request->query->get("tahun");
            $idBidang = $request->query->get("id_bidang");
            $prioritas = $request->query->get("prioritas");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idBidang = pack('H*', str_replace('-', '', trim($idBidang)));
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
                             sikd_prog.`kd_prog` AS sikd_prog_kd_prog,
                             sikd_prog.`nm_prog` AS sikd_prog_nm_prog,
                             SUM(vw_musren_anggaran_kgtn.`jml_apbd_kab`) AS vw_musren_anggaran_kgtn_jml_apbd_kab,
                             SUM(vw_musren_anggaran_kgtn.`jml_apbd_prop`) AS vw_musren_anggaran_kgtn_jml_apbd_prop,
                             SUM(vw_musren_anggaran_kgtn.`jml_apbn`) AS vw_musren_anggaran_kgtn_jml_apbn,
                             SUM(vw_musren_anggaran_kgtn.`jml_lain`) AS vw_musren_anggaran_kgtn_jml_lain,
                             SUM(vw_musren_anggaran_kgtn.`jml_apbd_kab`+vw_musren_anggaran_kgtn.`jml_apbd_prop`+vw_musren_anggaran_kgtn.`jml_apbn`+vw_musren_anggaran_kgtn.`jml_lain`) AS vw_musren_anggaran_kgtn_jml_prog,
                             count(distinct(CONCAT_WS('-',
                            SUBSTR(HEX(sikd_prog.id_sikd_prog), 1, 8),
                            SUBSTR(HEX(sikd_prog.id_sikd_prog), 9, 4),
                            SUBSTR(HEX(sikd_prog.id_sikd_prog), 13, 4),
                            SUBSTR(HEX(sikd_prog.id_sikd_prog), 17, 4),
                            SUBSTR(HEX(sikd_prog.id_sikd_prog), 21)
                             ))) AS jml_prog,
                             COUNT(distinct(CONCAT_WS('-',
                            SUBSTR(HEX(musren_kgtn.sikd_kgtn_id), 1, 8),
                            SUBSTR(HEX(musren_kgtn.sikd_kgtn_id), 9, 4),
                            SUBSTR(HEX(musren_kgtn.sikd_kgtn_id), 13, 4),
                            SUBSTR(HEX(musren_kgtn.sikd_kgtn_id), 17, 4),
                            SUBSTR(HEX(musren_kgtn.sikd_kgtn_id), 21)
                             ))) AS jml_kgtn,
                             COUNT(distinct(CONCAT_WS('-',
                            SUBSTR(HEX(musren_kgtn_kab.id_musren_kgtn), 1, 8),
                            SUBSTR(HEX(musren_kgtn_kab.id_musren_kgtn), 9, 4),
                            SUBSTR(HEX(musren_kgtn_kab.id_musren_kgtn), 13, 4),
                            SUBSTR(HEX(musren_kgtn_kab.id_musren_kgtn), 17, 4),
                            SUBSTR(HEX(musren_kgtn_kab.id_musren_kgtn), 21)
                             ))) AS jml_sub_kgtn
                        FROM
                             `musren_kgtn` musren_kgtn 
                             INNER JOIN `musren_kgtn` musren_kgtn_kab ON musren_kgtn.`id_musren_kgtn` = musren_kgtn_kab.`id_musren_kgtn` AND musren_kgtn_kab.`musren_kgtn_type` = 'MusrenKgtnKab'
                             INNER JOIN `sikd_satker` sikd_satker ON musren_kgtn_kab.`sikd_skpd_id` = sikd_satker.`id_sikd_satker`
                             LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON musren_kgtn_kab.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                             LEFT OUTER JOIN `sikd_bidang` sikd_bidang ON musren_kgtn.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                             INNER JOIN `sikd_kgtn` sikd_kgtn ON musren_kgtn.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                             INNER JOIN `sikd_prog` sikd_prog ON sikd_kgtn.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                             INNER JOIN `musren_lokasi_kgtn` musren_lokasi_kgtn ON musren_kgtn.`id_musren_kgtn` = musren_lokasi_kgtn.`musren_kgtn_id`
                             INNER JOIN `musren_musrenbang` musren_musrenbang ON musren_kgtn.`musren_musrenbang_id` = musren_musrenbang.`id_musren_musrenbang`
                             INNER JOIN `vw_musren_anggaran_kgtn` vw_musren_anggaran_kgtn ON musren_lokasi_kgtn.`id_musren_lokasi_kgtn` = vw_musren_anggaran_kgtn.`musren_lokasi_kgtn_id`
                        WHERE
                             musren_musrenbang.`tahun` = :tahun
                         AND IF(:id_bidang != '', musren_kgtn.`sikd_bidang_id` = :id_bidang, 1)
                         AND IF(:prioritas != '', musren_kgtn.`prioritas` = :prioritas, 1)
                        GROUP BY
                             sikd_bidang.`kd_bidang`,
                             sikd_prog.`kd_prog`
                        ORDER BY
                             sikd_bidang.`kd_bidang` ASC,
                             sikd_prog.`kd_prog` ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("tahun", $tahun);
            $statement->bindValue("id_bidang", $idBidang);
            $statement->bindValue("prioritas", $prioritas);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getMusrenKabListFlowUsulan($request)
    {
        try {

            $tahun = $request->query->get("tahun");
            $idSkpd = $request->query->get("id_skpd");
            $idSubSkpd = $request->query->get("id_subskpd");
            $idBidang = $request->query->get("id_bidang");
            $prioritas = $request->query->get("prioritas");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idSkpd = pack('H*', str_replace('-', '', trim($idSkpd)));
            $idSubSkpd = pack('H*', str_replace('-', '', trim($idSubSkpd)));
            $idBidang = pack('H*', str_replace('-', '', trim($idBidang)));
           
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                         musren_musrenbang.`tahun` AS musren_musrenbang_tahun,
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
                         sikd_bidang.`kd_bidang` AS sikd_bidang_kd_bidang,
                         sikd_bidang.`nm_bidang` AS sikd_bidang_nm_bidang,
                         sikd_prog.`kd_prog` AS sikd_prog_kd_prog,
                         sikd_prog.`nm_prog` AS sikd_prog_nm_prog,
                         substring(sikd_kgtn.`kd_kgtn`,3,3) AS sikd_kgtn_kode,
                         sikd_kgtn.`kd_kgtn` AS sikd_kgtn_kd_kgtn,
                         sikd_kgtn.`nm_kgtn` AS sikd_kgtn_nm_kgtn,
                         ifnull(substring(vw_appl_kode_wilayah.`kode_wilayah`,7,4),'-') AS vw_appl_kode_wilayah_kode,
                         vw_appl_kode_wilayah.`kode_wilayah` AS vw_appl_kode_wilayah_kode_wilayah,
                         concat(vw_appl_kode_wilayah.`klasifikasi`,' ',vw_appl_kode_wilayah.`nama_wilayah`,', ',vw_appl_kode_wilayah_induk.`nama_wilayah`)AS vw_appl_kode_wilayah_nama_wilayah,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 1, 8),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 9, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 13, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 17, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 21)
                         ) AS musren_kgtn_id_musren_kgtn,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_lokasi_kgtn.`id_musren_lokasi_kgtn`), 1, 8),
                        SUBSTR(HEX(musren_lokasi_kgtn.`id_musren_lokasi_kgtn`), 9, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.`id_musren_lokasi_kgtn`), 13, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.`id_musren_lokasi_kgtn`), 17, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.`id_musren_lokasi_kgtn`), 21)
                         ) AS musren_lokasi_kgtn_id_musren_lokasi_kgtn,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_lokasi_kgtn.`musren_lokasi_kgtn_id`), 1, 8),
                        SUBSTR(HEX(musren_lokasi_kgtn.`musren_lokasi_kgtn_id`), 9, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.`musren_lokasi_kgtn_id`), 13, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.`musren_lokasi_kgtn_id`), 17, 4),
                        SUBSTR(HEX(musren_lokasi_kgtn.`musren_lokasi_kgtn_id`), 21)
                         ) AS musren_lokasi_kgtn_musren_lokasi_kgtn_id_ref,
                         musren_lokasi_kgtn.`nm_lokasi` AS musren_lokasi_kgtn_nm_lokasi_kgtn,
                         musren_lokasi_kgtn.`volume` AS musren_lokasi_kgtn_volume,
                         ifnull(musren_lokasi_kgtn.`satuan`,'-') AS musren_lokasi_kgtn_satuan,
                         '' AS musren_kgtn_nm_kgtn,
                         ifnull((select sum(a.jml_anggaran) 
                                 from musren_lokasi_kgtn a, musren_lokasi_kgtn b, musren_lokasi_kgtn c inner join musren_kgtn e on c.musren_kgtn_id = e.id_musren_kgtn and e.musren_kgtn_type = 'MusrenKgtnSkpd', musren_lokasi_kgtn d
                                 where d.id_musren_lokasi_kgtn = musren_lokasi_kgtn.`id_musren_lokasi_kgtn`
                                   and c.id_musren_lokasi_kgtn = d.musren_lokasi_kgtn_id
                                   and b.id_musren_lokasi_kgtn = c.musren_lokasi_kgtn_id
                                   and a.id_musren_lokasi_kgtn = b.musren_lokasi_kgtn_id
                                   /*and a.musren_lokasi_kgtn_id = b.id_musren_lokasi_kgtn*/), 0) AS jml_usulan_desa,
                         ifnull((select sum(a.jml_anggaran) 
                                 from musren_lokasi_kgtn a, musren_lokasi_kgtn b inner join musren_kgtn d on b.musren_kgtn_id = d.id_musren_kgtn and d.musren_kgtn_type = 'MusrenKgtnSkpd', musren_lokasi_kgtn c
                                 where c.id_musren_lokasi_kgtn = musren_lokasi_kgtn.`id_musren_lokasi_kgtn`
                                   and b.id_musren_lokasi_kgtn = c.`musren_lokasi_kgtn_id`
                                   and a.id_musren_lokasi_kgtn = b.`musren_lokasi_kgtn_id`
                                   /*and a.musren_lokasi_kgtn_id = b.id_musren_lokasi_kgtn*/), 0) AS jml_usulan_kec,
                         ifnull((select sum(a.jml_anggaran) 
                                 from musren_lokasi_kgtn a inner join musren_kgtn c on a.musren_kgtn_id = c.id_musren_kgtn and c.musren_kgtn_type = 'MusrenKgtnSkpd', musren_lokasi_kgtn b
                                 where b.id_musren_lokasi_kgtn = musren_lokasi_kgtn.`id_musren_lokasi_kgtn`
                                   and a.id_musren_lokasi_kgtn = b.`musren_lokasi_kgtn_id`
                                   /*and a.musren_skpd_lokasi_kgtn_id = b.id_musren_skpd_lokasi_kgtn*/), 0) AS jml_usulan_skpd,
                         SUM(vw_musren_anggaran_kgtn.jml_apbd_kab+
                             vw_musren_anggaran_kgtn.jml_apbd_prop+
                             vw_musren_anggaran_kgtn.jml_apbn+
                             vw_musren_anggaran_kgtn.jml_lain) AS jml_usulan_kota
                    FROM
                         `musren_kgtn` musren_kgtn 
                         INNER JOIN `musren_kgtn` musren_kgtn_kab ON musren_kgtn.`id_musren_kgtn` = musren_kgtn_kab.`id_musren_kgtn` AND musren_kgtn_kab.`musren_kgtn_type` = 'MusrenKgtnKab'
                         INNER JOIN `sikd_satker` sikd_satker ON musren_kgtn_kab.`sikd_skpd_id` = sikd_satker.`id_sikd_satker`
                         LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON musren_kgtn_kab.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                         LEFT OUTER JOIN `sikd_bidang` sikd_bidang ON musren_kgtn.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                         INNER JOIN `sikd_kgtn` sikd_kgtn ON musren_kgtn.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                         INNER JOIN `sikd_prog` sikd_prog ON sikd_kgtn.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                         INNER JOIN `musren_lokasi_kgtn` musren_lokasi_kgtn ON musren_kgtn.`id_musren_kgtn` = musren_lokasi_kgtn.`musren_kgtn_id`
                         INNER JOIN `vw_musren_anggaran_kgtn` vw_musren_anggaran_kgtn ON musren_lokasi_kgtn.`id_musren_lokasi_kgtn` = vw_musren_anggaran_kgtn.`musren_lokasi_kgtn_id`
                         INNER JOIN `musren_musrenbang` musren_musrenbang ON musren_kgtn.`musren_musrenbang_id` = musren_musrenbang.`id_musren_musrenbang`
                         INNER JOIN `vw_appl_kode_wilayah` vw_appl_kode_wilayah ON musren_lokasi_kgtn.`kd_wilayah` = vw_appl_kode_wilayah.`kode_wilayah`
                         INNER JOIN `vw_appl_kode_wilayah_induk` vw_appl_kode_wilayah_induk ON vw_appl_kode_wilayah.`kode_induk` = vw_appl_kode_wilayah_induk.`kode_wilayah`
                    WHERE
                         musren_musrenbang.`tahun` = :tahun
                     AND IF(:id_skpd != '', sikd_satker.id_sikd_satker = :id_skpd, 1)
                     AND IF(:id_subskpd != '', musren_kgtn_kab.`sikd_sub_skpd_id` = :id_subskpd, 1)
                     AND IF(:id_bidang != '', sikd_bidang.`id_sikd_bidang` = :id_bidang, 1)
                     AND IF(:prioritas != '', musren_kgtn.prioritas = :prioritas, 1)
                    GROUP BY
                         sikd_satker.kode,
                         sikd_sub_skpd.kode,
                         sikd_bidang.`kd_bidang`,
                         sikd_prog.`kd_prog`,
                         sikd_kgtn.`kd_kgtn`,
                         vw_appl_kode_wilayah_kode,
                         musren_lokasi_kgtn.`id_musren_lokasi_kgtn`

                    ORDER BY
                         sikd_satker.kode ASC,
                         sikd_sub_skpd.kode ASC,
                         sikd_bidang.`kd_bidang` ASC,
                         sikd_prog.`kd_prog` ASC,
                         sikd_kgtn.`kd_kgtn` ASC,
                         vw_appl_kode_wilayah_kode ASC,
                         musren_lokasi_kgtn.`id_musren_lokasi_kgtn` ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("tahun", $tahun);
            $statement->bindValue("id_skpd", $idSkpd);
            $statement->bindValue("id_subskpd", $idSubSkpd);
            $statement->bindValue("id_bidang", $idBidang);
            $statement->bindValue("prioritas", $prioritas);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }

    //PENGAWASAN
    private function getMusrenDesaBlmKgtn($request)
    {
        try {
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                         vw_appl_kode_wilayah.`kode_wilayah` AS vw_appl_kode_wilayah_kode_wilayah,
                         vw_appl_kode_wilayah.`klasifikasi` AS vw_appl_kode_wilayah_klasifikasi,
                         vw_appl_kode_wilayah.`nama_wilayah` AS vw_appl_kode_wilayah_nama_wilayah,
                         vw_appl_kode_wilayah_induk.`kode_wilayah` AS vw_appl_kode_wilayah_induk_kode_wilayah,
                         vw_appl_kode_wilayah_induk.`nama_wilayah` AS vw_appl_kode_wilayah_induk_nama_wilayah
                    FROM
                         `vw_appl_kode_wilayah_induk` vw_appl_kode_wilayah_induk 
                         INNER JOIN `vw_appl_kode_wilayah` vw_appl_kode_wilayah ON vw_appl_kode_wilayah_induk.`kode_wilayah` = vw_appl_kode_wilayah.`kode_induk`
                              AND vw_appl_kode_wilayah.`kode_wilayah` NOT IN  
                                 (select a.`kd_wilayah` 
                                  from `musren_musrenbang` a 
                                  inner join `musren_musrenbang` b on a.id_musren_musrenbang = b.id_musren_musrenbang and b.musren_musrenbang_type = 'MusrenMusrenbangDesa')
                         AND length(vw_appl_kode_wilayah_induk.kode_wilayah) = 6     
                    ORDER BY
                         vw_appl_kode_wilayah_induk.`kode_wilayah`,
                         vw_appl_kode_wilayah.`kode_wilayah`";
            
            $statement = $this->connection->prepare($sql);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getMusrenKecBlmKgtn($request)
    {
        try {
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                         vw_appl_kode_wilayah.`kode_wilayah` AS vw_appl_kode_wilayah_kode_wilayah,
                         vw_appl_kode_wilayah.`klasifikasi` AS vw_appl_kode_wilayah_klasifikasi,
                         vw_appl_kode_wilayah.`nama_wilayah` AS vw_appl_kode_wilayah_nama_wilayah,
                         vw_appl_kode_wilayah_induk.`kode_wilayah` AS vw_appl_kode_wilayah_induk_kode_wilayah,
                         vw_appl_kode_wilayah_induk.`klasifikasi` AS vw_appl_kode_wilayah_induk_klasifikasi,
                         vw_appl_kode_wilayah_induk.`nama_wilayah` AS vw_appl_kode_wilayah_induk_nama_wilayah
                    FROM
                         `vw_appl_kode_wilayah_induk` vw_appl_kode_wilayah_induk 
                         INNER JOIN `vw_appl_kode_wilayah` vw_appl_kode_wilayah ON vw_appl_kode_wilayah_induk.`kode_wilayah` = vw_appl_kode_wilayah.`kode_induk`
                              AND vw_appl_kode_wilayah.`klasifikasi` IN ('KEC')  
                              AND vw_appl_kode_wilayah.`kode_wilayah` NOT IN  
                                 (select a.`kd_wilayah` 
                                  from `musren_musrenbang` a 
                                  inner join `musren_musrenbang` b on a.id_musren_musrenbang = b.id_musren_musrenbang and b.`musren_musrenbang_type` = 'MusrenMusrenbangKec')
                                 
                    ORDER BY
                         vw_appl_kode_wilayah_induk.`kode_wilayah`,
                         vw_appl_kode_wilayah.`kode_wilayah`";
            
            $statement = $this->connection->prepare($sql);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getMusrenSkpdBlmKgtn($request)
    {
        try {
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                         sikd_satker.`kode` AS sikd_satker_kode,
                         sikd_satker.`nama` AS sikd_satker_nama,
                         sikd_satker.`singkatan` AS sikd_satker_singkatan
                    FROM
                         `sikd_satker` sikd_satker 
                         INNER JOIN `sikd_satker` sikd_skpd ON sikd_satker.`id_sikd_satker`= sikd_skpd.`id_sikd_satker`
                         -- AND sikd_skpd.`id_sikd_skpd` NOT IN
                         AND sikd_skpd.`id_sikd_satker` NOT IN
                              (select a.sikd_skpd_id
                               from /*musren_skpd_kgtn a*/
                               musren_kgtn a
                               inner join `sikd_satker` b ON a.sikd_skpd_id = b.`id_sikd_satker`
                               and a.`musren_kgtn_type` = 'MusrenKgtnSkpd')
                    GROUP BY
                         sikd_satker_kode

                    UNION
                    SELECT
                         sikd_sub_skpd.`kode` AS sikd_satker_kode,
                         sikd_sub_skpd.`nama` AS sikd_satker_nama,
                         sikd_sub_skpd.`singkatan` AS sikd_satker_singkatan
                    FROM
                         `sikd_satker` sikd_satker 
                         -- INNER JOIN `sikd_skpd` sikd_skpd ON sikd_satker.`id_sikd_satker`= sikd_skpd.`id_sikd_skpd`
                         INNER JOIN `sikd_sub_skpd` sikd_sub_skpd ON sikd_satker.`id_sikd_satker` = sikd_sub_skpd.`sikd_satker_id`
                         AND sikd_sub_skpd.`id_sikd_sub_skpd` NOT IN
                              (select a.sikd_sub_skpd_id
                               from /*musren_skpd_kgtn a*/
                               musren_kgtn a 
                               inner join `sikd_sub_skpd` b ON a.sikd_sub_skpd_id = b.`id_sikd_sub_skpd`
                               and a.`musren_kgtn_type` = 'MusrenKgtnSkpd')
                    GROUP BY
                         sikd_satker_kode

                    ORDER BY
                         sikd_satker_kode ASC";
            
            $statement = $this->connection->prepare($sql);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getMusrenKecListUsulanDesaBlmProses($request)
    {
        try {

            $kec = $request->query->get("kec");
            $idBidang = $request->query->get("bidang");
            $prioritas = $request->query->get("prioritas");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idBidang = pack('H*', str_replace('-', '', trim($idBidang)));
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 1, 8),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 9, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 13, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 17, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 21)
                         ) AS musren_kgtn_id_musren_kgtn,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 1, 8),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 9, 4),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 13, 4),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 17, 4),
                        SUBSTR(HEX(musren_kgtn.`sikd_bidang_id`), 21)
                         ) AS musren_kgtn_sikd_musren_bidang_id,
                         sikd_musren_bidang.`kd_bidang` AS sikd_musren_bidang_kd_bidang,
                         sikd_musren_bidang.`nm_bidang` AS sikd_musren_bidang_nm_bidang,
                         musren_kgtn.`nm_kgtn` AS musren_kgtn_nm_kgtn,
                         musren_kgtn.`nm_subkgtn` AS musren_kgtn_nm_subkgtn,
                         musren_kgtn.`prioritas` AS musren_kgtn_prioritas,
                         musren_kgtn.`sifat_kgtn` AS musren_kgtn_sifat_kgtn,
                         musren_kgtn.`output` AS musren_kgtn_output,
                         musren_kgtn.`outcome` AS musren_kgtn_outcome,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 1, 8),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 9, 4),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 13, 4),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 17, 4),
                        SUBSTR(HEX(musren_musrenbang.`id_musren_musrenbang`), 21)
                         ) AS musren_musrenbang_id_musren_musrenbang,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_musrenbang_desa.`id_musren_musrenbang`), 1, 8),
                        SUBSTR(HEX(musren_musrenbang_desa.`id_musren_musrenbang`), 9, 4),
                        SUBSTR(HEX(musren_musrenbang_desa.`id_musren_musrenbang`), 13, 4),
                        SUBSTR(HEX(musren_musrenbang_desa.`id_musren_musrenbang`), 17, 4),
                        SUBSTR(HEX(musren_musrenbang_desa.`id_musren_musrenbang`), 21)
                         ) AS musren_musrenbang_desa_id_musren_musdesa,
                         musren_musrenbang.`tahun` AS musren_musrenbang_tahun,
                         ifnull(substring(vw_appl_kode_wilayah.`kode_wilayah`,7,4), '-') AS vw_appl_kode_wilayah_kode,
                         vw_appl_kode_wilayah.`kode_wilayah` AS vw_appl_kode_wilayah_kode_wilayah,
                         vw_appl_kode_wilayah.`klasifikasi` AS vw_appl_kode_wilayah_klasifikasi,
                         vw_appl_kode_wilayah.`nama_wilayah` AS vw_appl_kode_wilayah_nama_wilayah,
                         vw_appl_kode_wilayah_induk.`kode_wilayah` AS vw_appl_kode_wilayah_induk_kode_wilayah,
                         vw_appl_kode_wilayah_induk.`nama_wilayah` AS vw_appl_kode_wilayah_induk_nama_wilayah,
                         SUM(vw_musren_anggaran_kgtn_desa.`jml_swadaya`) AS vw_musren_anggaran_kgtn_desa_jml_swadaya,
                         SUM(vw_musren_anggaran_kgtn_desa.`jml_apb_desa`) AS vw_musren_anggaran_kgtn_desa_jml_apb_desa,
                         SUM(vw_musren_anggaran_kgtn_desa.`jml_apbd_kab`) AS vw_musren_anggaran_kgtn_desa_jml_apbd_kab,
                         SUM(vw_musren_anggaran_kgtn_desa.`jml_apbd_prop`) AS vw_musren_anggaran_kgtn_desa_jml_apbd_prop,
                         SUM(vw_musren_anggaran_kgtn_desa.`jml_apbn`) AS vw_musren_anggaran_kgtn_desa_jml_apbn,
                         SUM(vw_musren_anggaran_kgtn_desa.`jml_sumber_lain`) AS vw_musren_anggaran_kgtn_desa_jml_sumber_lain
                    FROM
                         `musren_kgtn` musren_kgtn_desa 
                         INNER JOIN `musren_kgtn` musren_kgtn ON musren_kgtn_desa.`id_musren_kgtn` = musren_kgtn.`id_musren_kgtn`
                         INNER JOIN `musren_musrenbang` musren_musrenbang ON musren_kgtn.`musren_musrenbang_id` = musren_musrenbang.`id_musren_musrenbang`
                         INNER JOIN `sikd_bidang` sikd_musren_bidang ON musren_kgtn.`sikd_bidang_id` = sikd_musren_bidang.`id_sikd_bidang`
                         INNER JOIN `musren_lokasi_kgtn` musren_lokasi_kgtn ON musren_kgtn.`id_musren_kgtn` = musren_lokasi_kgtn.`musren_kgtn_id`
                         INNER JOIN `vw_musren_anggaran_kgtn_desa` vw_musren_anggaran_kgtn_desa ON musren_lokasi_kgtn.`id_musren_lokasi_kgtn` = vw_musren_anggaran_kgtn_desa.`musren_lokasi_kgtn_id`
                         INNER JOIN `musren_musrenbang` musren_musrenbang_desa ON musren_musrenbang.`id_musren_musrenbang` = musren_musrenbang_desa.`id_musren_musrenbang` AND musren_musrenbang_desa.`musren_musrenbang_type` = 'MusrenMusrenbangDesa'
                         INNER JOIN `vw_appl_kode_wilayah` vw_appl_kode_wilayah ON musren_musrenbang.`kd_wilayah` = vw_appl_kode_wilayah.`kode_wilayah`
                         INNER JOIN `vw_appl_kode_wilayah_induk` vw_appl_kode_wilayah_induk ON vw_appl_kode_wilayah.`kode_induk` = vw_appl_kode_wilayah_induk.`kode_wilayah`
                         INNER JOIN sikd_sumber_anggaran sikd_sumber_anggaran ON musren_kgtn_desa.`sikd_sumber_anggaran_id` = sikd_sumber_anggaran.`id_sikd_sumber_anggaran`
                    WHERE
                          musren_kgtn_desa.`musren_kgtn_type` = 'MusrenKgtnDesa'
                      AND musren_kgtn_desa.`status_verifikasi` = '1'
                      AND sikd_sumber_anggaran.`nm_sumber_anggaran` NOT IN ('Swadaya', 'APB Desa')
                      AND musren_kgtn_desa.`id_musren_kgtn` NOT IN (SELECT musren_kgtn_desa_id FROM musren_kgtn WHERE musren_kgtn_type = 'MusrenKgtnKec' AND musren_kgtn_desa_id IS NOT NULL)
                      AND IF(:kec != '', vw_appl_kode_wilayah_induk.`kode_wilayah` = :kec, 1)
                     AND IF(:bidang != '', sikd_musren_bidang.`id_sikd_bidang` = :bidang, 1)
                     AND IF(:prioritas != '', musren_kgtn.`prioritas` = :prioritas, 1)
                    GROUP BY
                         vw_appl_kode_wilayah_induk.`kode_wilayah`,
                         sikd_musren_bidang.kd_bidang,
                         vw_appl_kode_wilayah.`kode_wilayah`,
                         musren_kgtn.id_musren_kgtn
                    ORDER BY
                         vw_appl_kode_wilayah_induk.`kode_wilayah` ASC,
                         sikd_musren_bidang.kd_bidang ASC,
                         vw_appl_kode_wilayah.`kode_wilayah` ASC,
                         cast(trim(leading 'p' from musren_kgtn.`prioritas`) as unsigned) ASC,
                         musren_kgtn.id_musren_kgtn ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("kec", $kec);
            $statement->bindValue("bidang", $idBidang);
            $statement->bindValue("prioritas", $prioritas);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getMusrenSkpdListUsulanKecBlmProses($request)
    {
        try {

            $idSkpd = $request->query->get("id_skpd");
            $idBidang = $request->query->get("id_bidang");
            $prioritas = $request->query->get("prioritas");
            $tahun = $request->query->get("tahun");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idSkpd = pack('H*', str_replace('-', '', trim($idSkpd)));
            $idBidang = pack('H*', str_replace('-', '', trim($idBidang)));
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 1, 8),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 9, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 13, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 17, 4),
                        SUBSTR(HEX(musren_kgtn.`id_musren_kgtn`), 21)
                         ) AS musren_kgtn_id_musren_kgtn,
                         musren_kgtn.`nm_kgtn` AS musren_kgtn_nm_kgtn,
                         musren_kgtn.`prioritas` AS musren_kgtn_prioritas,
                         musren_kgtn.`sifat_kgtn` AS musren_kgtn_sifat_kgtn,
                         musren_kgtn.`output` AS musren_kgtn_output,
                         musren_kgtn.`outcome` AS musren_kgtn_outcome,
                        CONCAT_WS('-',
                        SUBSTR(HEX(sikd_musren_bidang.`id_sikd_bidang`), 1, 8),
                        SUBSTR(HEX(sikd_musren_bidang.`id_sikd_bidang`), 9, 4),
                        SUBSTR(HEX(sikd_musren_bidang.`id_sikd_bidang`), 13, 4),
                        SUBSTR(HEX(sikd_musren_bidang.`id_sikd_bidang`), 17, 4),
                        SUBSTR(HEX(sikd_musren_bidang.`id_sikd_bidang`), 21)
                         ) AS sikd_musren_bidang_id_sikd_musren_bidang,
                         sikd_musren_bidang.`kd_bidang` AS sikd_musren_bidang_kd_bidang,
                         sikd_musren_bidang.`nm_bidang` AS sikd_musren_bidang_nm_bidang,
                         RPAD(substring(vw_appl_kode_wilayah.`kode_wilayah`,5,6),6,0) AS vw_appl_kode_wilayah_kode,
                         vw_appl_kode_wilayah.`kode_wilayah` AS vw_appl_kode_wilayah_kode_wilayah,
                         concat(vw_appl_kode_wilayah.`klasifikasi`, ' ', vw_appl_kode_wilayah.`nama_wilayah`, ', ', vw_appl_kode_wilayah_induk.`nama_wilayah`) AS vw_appl_kode_wilayah_nama_wilayah,
                         SUM(vw_musren_anggaran_kgtn.`jml_apbd_kab`) AS vw_musren_anggaran_kgtn_jml_apbd_kab,
                         SUM(vw_musren_anggaran_kgtn.`jml_apbd_prop`) AS vw_musren_anggaran_kgtn_jml_apbd_prop,
                        SUM(vw_musren_anggaran_kgtn.`jml_apbn`) AS vw_musren_anggaran_kgtn_jml_apbn,
                         SUM(vw_musren_anggaran_kgtn.`jml_lain`) AS vw_musren_anggaran_kgtn_jml_lain,
                         sikd_satker.`kode` AS sikd_satker_kode,
                         sikd_satker.`nama` AS sikd_satker_nama
                    FROM
                         `musren_kgtn` musren_kgtn 
                         INNER JOIN `musren_kgtn` musren_kgtn_kec ON musren_kgtn.`id_musren_kgtn` = musren_kgtn_kec.`id_musren_kgtn` AND musren_kgtn_kec.`musren_kgtn_type` = 'MusrenKgtnKec'
                         INNER JOIN `sikd_satker` sikd_satker ON musren_kgtn_kec.`sikd_skpd_id` = sikd_satker.`id_sikd_satker`
                         INNER JOIN `sikd_bidang` sikd_musren_bidang ON musren_kgtn.`sikd_bidang_id` = sikd_musren_bidang.`id_sikd_bidang`
                         INNER JOIN `musren_lokasi_kgtn` musren_lokasi_kgtn ON musren_kgtn.`id_musren_kgtn` = musren_lokasi_kgtn.`musren_kgtn_id`
                         INNER JOIN `vw_musren_anggaran_kgtn` vw_musren_anggaran_kgtn ON musren_lokasi_kgtn.`id_musren_lokasi_kgtn` = vw_musren_anggaran_kgtn.`musren_lokasi_kgtn_id`
                         INNER JOIN `musren_musrenbang` musren_musrenbang ON musren_kgtn.`musren_musrenbang_id` = musren_musrenbang.`id_musren_musrenbang`
                         INNER JOIN `vw_appl_kode_wilayah` vw_appl_kode_wilayah ON musren_lokasi_kgtn.`kd_wilayah` = vw_appl_kode_wilayah.`kode_wilayah`
                         INNER JOIN `vw_appl_kode_wilayah_induk` vw_appl_kode_wilayah_induk ON vw_appl_kode_wilayah.`kode_induk` = vw_appl_kode_wilayah_induk.`kode_wilayah`
                    WHERE
                        musren_kgtn_kec.`status_verifikasi` = '1'
                     AND musren_lokasi_kgtn.`id_musren_lokasi_kgtn` NOT IN (SELECT a.`musren_lokasi_kgtn_id` FROM musren_lokasi_kgtn a INNER JOIN musren_kgtn b ON a.`musren_kgtn_id` = b.`id_musren_kgtn` AND b.`musren_kgtn_type` = 'MusrenKgtnSkpd' WHERE a.`musren_lokasi_kgtn_id` IS NOT NULL)
                     AND musren_musrenbang.`tahun` = :tahun
                     AND IF(:id_skpd != '', sikd_satker.id_sikd_satker = :id_skpd, 1)
                     AND IF(:id_bidang != '', musren_kgtn.sikd_bidang_id = :id_bidang, 1)
                     AND IF(:prioritas != '', musren_kgtn.prioritas = :prioritas, 1)
                    GROUP BY
                         sikd_satker.kode,
                         sikd_musren_bidang.kd_bidang,
                         vw_appl_kode_wilayah.`kode_wilayah`,
                         musren_kgtn.`id_musren_kgtn`
                    ORDER BY
                         sikd_satker.kode ASC,
                         sikd_musren_bidang.kd_bidang ASC,
                         RPAD(vw_appl_kode_wilayah.`kode_wilayah`,10,0) ASC,
                         cast(trim(leading 'P' from musren_kgtn.`prioritas`) as unsigned) ASC,
                         musren_kgtn.`id_musren_kgtn` ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_skpd", $idSkpd);
            $statement->bindValue("id_bidang", $idBidang);
            $statement->bindValue("prioritas", $prioritas);
            $statement->bindValue("tahun", $tahun);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getMusrenKabListUsulanSkpdBlmProses($request)
    {
        try {

            $idSkpd = $request->query->get("id_skpd");
            $idSubSkpd = $request->query->get("id_subskpd");
            $idBidang = $request->query->get("id_bidang");
            $prioritas = $request->query->get("prioritas");
            $tahun = $request->query->get("tahun");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idSkpd = pack('H*', str_replace('-', '', trim($idSkpd)));
            $idSubSkpd = pack('H*', str_replace('-', '', trim($idSubSkpd)));
            $idBidang = pack('H*', str_replace('-', '', trim($idBidang)));
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                         sikd_satker.`kode` AS sikd_satker_kode,
                         sikd_satker.`nama` AS sikd_satker_nama,
                         sikd_sub_skpd.`kode` AS sikd_sub_skpd_kode,
                         sikd_sub_skpd.`nama` AS sikd_sub_skpd_nama,
                        CONCAT_WS('-',
                        SUBSTR(HEX(musren_skpd_kgtn.`id_musren_kgtn`), 1, 8),
                        SUBSTR(HEX(musren_skpd_kgtn.`id_musren_kgtn`), 9, 4),
                        SUBSTR(HEX(musren_skpd_kgtn.`id_musren_kgtn`), 13, 4),
                        SUBSTR(HEX(musren_skpd_kgtn.`id_musren_kgtn`), 17, 4),
                        SUBSTR(HEX(musren_skpd_kgtn.`id_musren_kgtn`), 21)
                         ) AS musren_skpd_kgtn_id_musren_skpd_kgtn,
                         substring(sikd_kgtn.kd_kgtn,3,3) AS skpd_kgtn_kode,
                         musren_skpd_kgtn.`kd_kgtn` AS musren_skpd_kgtn_kd_kgtn,
                         musren_skpd_kgtn.`nm_kgtn` AS musren_skpd_kgtn_nm_kgtn,
                         musren_skpd_kgtn.`prioritas` AS musren_skpd_kgtn_prioritas,
                         musren_skpd_kgtn.`sifat_kgtn` AS musren_skpd_kgtn_sifat_kgtn,
                         musren_skpd_kgtn.`output` AS musren_skpd_kgtn_output,
                         musren_skpd_kgtn.`outcome` AS musren_skpd_kgtn_outcome,
                        CONCAT_WS('-',
                        SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 1, 8),
                        SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 9, 4),
                        SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 13, 4),
                        SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 17, 4),
                        SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 21)
                         ) AS sikd_bidang_id_sikd_bidang,
                         sikd_bidang.`kd_bidang` AS sikd_bidang_kd_bidang,
                         sikd_bidang.`nm_bidang` AS sikd_bidang_nm_bidang,
                         sikd_prog.`kd_prog` AS sikd_prog_kd_prog,
                         sikd_prog.`nm_prog` AS sikd_prog_nm_prog,
                         SUM(vw_musren_skpd_anggaran_kgtn.`jml_apbd_kab`) AS vw_musren_skpd_anggaran_kgtn_jml_apbd_kab,
                         SUM(vw_musren_skpd_anggaran_kgtn.`jml_apbd_prop`) AS vw_musren_skpd_anggaran_kgtn_jml_apbd_prop,
                         SUM(vw_musren_skpd_anggaran_kgtn.`jml_apbn`) AS vw_musren_skpd_anggaran_kgtn_jml_apbn,
                         SUM(vw_musren_skpd_anggaran_kgtn.`jml_lain`) AS vw_musren_skpd_anggaran_kgtn_jml_lain
                    FROM
                         `musren_kgtn` musren_skpd_kgtn 
                         INNER JOIN `musren_musrenbang` musren_forum_skpd ON musren_skpd_kgtn.`musren_musrenbang_id` = musren_forum_skpd.`id_musren_musrenbang` AND musren_forum_skpd.`musren_musrenbang_type` = 'MusrenForumSkpd'
                         INNER JOIN `sikd_satker` sikd_satker ON musren_skpd_kgtn.`sikd_skpd_id` = sikd_satker.`id_sikd_satker`
                         LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON musren_skpd_kgtn.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                         INNER JOIN `sikd_bidang` sikd_bidang ON musren_skpd_kgtn.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                         INNER JOIN `sikd_kgtn` sikd_kgtn ON musren_skpd_kgtn.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                         INNER JOIN `sikd_prog` sikd_prog ON sikd_bidang.`id_sikd_bidang` = sikd_prog.`sikd_bidang_id`
                             AND sikd_prog.`kd_prog` = substring(sikd_kgtn.kd_kgtn,1,2)
                         INNER JOIN `musren_lokasi_kgtn` musren_skpd_lokasi_kgtn ON musren_skpd_kgtn.`id_musren_kgtn` = musren_skpd_lokasi_kgtn.`musren_kgtn_id`
                         INNER JOIN `vw_musren_skpd_anggaran_kgtn` vw_musren_skpd_anggaran_kgtn ON musren_skpd_lokasi_kgtn.`id_musren_lokasi_kgtn` = vw_musren_skpd_anggaran_kgtn.`musren_skpd_lokasi_kgtn_id`
                    WHERE
                        musren_skpd_kgtn.`musren_kgtn_type` = 'MusrenKgtnSkpd'
                     AND musren_skpd_kgtn.`id_musren_kgtn` NOT IN (SELECT musren_kgtn_skpd_id FROM renja_anggaran WHERE musren_kgtn_skpd_id IS NOT NULL)
                     AND musren_forum_skpd.`tahun` = :tahun
                     AND IF(:id_skpd != '', sikd_satker.id_sikd_satker = :id_skpd, 1)
                     AND IF(:id_subskpd != '', musren_skpd_kgtn.`sikd_sub_skpd_id` = :id_subskpd, 1)
                     AND IF(:id_bidang != '', sikd_bidang.`id_sikd_bidang` = :id_bidang, 1)
                     AND IF(:prioritas != '', musren_skpd_kgtn.prioritas = :prioritas, 1)
                    GROUP BY
                         sikd_satker.kode,
                         sikd_sub_skpd.kode,
                         sikd_bidang.`kd_bidang`,
                         sikd_prog.`kd_prog`,
                         musren_skpd_kgtn.`kd_kgtn`
                    ORDER BY
                         sikd_satker.kode ASC,
                         sikd_sub_skpd.kode ASC,
                         sikd_bidang.`kd_bidang` ASC,
                         sikd_prog.`kd_prog` ASC,
                         musren_skpd_kgtn.`kd_kgtn` ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_skpd", $idSkpd);
            $statement->bindValue("id_subskpd", $idSubSkpd);
            $statement->bindValue("id_bidang", $idBidang);
            $statement->bindValue("prioritas", $prioritas);
            $statement->bindValue("tahun", $tahun);
            
            $statement->execute();
            $musrenReport = $statement->fetchAll();
            
            return new JsonResponse($musrenReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
}