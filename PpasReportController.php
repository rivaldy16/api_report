<?php
namespace App\Controller\Ppas;

use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Delete;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * @RouteResource("ppasreport")
 */
class PpasReportController extends \App\Controller\ApiBaseController
{
    //protected $dbalConnName = 'simral_renstra';
    
    public function cgetAction(Request $request)
    {        
        $rpt = $request->query->get("jns_report");

        switch ($rpt) {
            case "ppas_rekap_satker":
                return $this->getPpasRekapSatker($request);
            case "ppas_rekap_satker_sub":
                return $this->getPpasRekapSatkerSub($request);
            case "ppas_header_landscape":
                return $this->getPpasHeaderLandscape($request);
            case "ppas_rekap_satker_rinc":
                return $this->getPpasRekapSatkerRinc($request);
            case "ppas_header_p":
                return $this->getPpasHeaderP($request);
            case "ppas_rekap_satker_rinc_ket":
                return $this->getPpasRekapSatkerRincKet($request);
            case "ppas_rekap_pdpt":
                return $this->getPpasRekapPdpt($request);
            case "ppas_rekap_btl":
                return $this->getPpasRekapBtl($request);
            case "ppas_rekap_bl":
                return $this->getPpasRekapBl($request);
            case "ppas_rekap_pbyn":
                return $this->getPpasRekapPbyn($request);

            case "ppas_rekap_tab1":
                return $this->getPpasLamp1($request);
            case "ppas_rekap_tab2_1":
                return $this->getPpasLamp2_1($request);
            case "ppas_rekap_tab2_1_p":
                return $this->getPpasLamp2_1Perubahan($request);
            case "ppas_rekap_tab2_1_rinci":
                return $this->getPpasLamp2_1Rinci($request);
            case "ppas_rekap_tab2_1_rinci_p":
                return $this->getPpasLamp2_1RinciPerubahan($request);
            case "ppas_lamp_3_1":
                return $this->getPpasLamp3_1($request);
            case "ppas_lamp_3_1_sub2":
                return $this->getPpasLamp3_1_Sub2($request);
            case "ppas_lamp_3_1_sub1":
                return $this->getPpasLamp3_1_Sub1($request);
            case "ppas_rekap_tab4_1a":
                return $this->getPpasLamp4_1A($request);
            case "ppas_rekap_tab4_1a_p":
                return $this->getPpasLamp4_1APerubahan($request);
            case "ppas_rekap_tab4_1b":
                return $this->getPpasLamp4_1B($request);
            case "ppas_rekap_tab4_1b_p":
                return $this->getPpasLamp4_1BPerubahan($request);
            case "ppas_rekap_tab4_2":
                return $this->getPpasLamp4_2($request);
            case "ppas_rekap_tab4_3":
                return $this->getPpasLamp4_3($request);
            case "ppas_rekap_tab5":
                return $this->getPpasLamp5($request);
            case "ppas_rekap_tab6":
                return $this->getPpasLamp6($request);
            case "ppas_rekap_tab4_2_p":
                return $this->getPpasLamp4_2Perubahan($request);
            case "ppas_rekap_tab4_3_p":
                return $this->getPpasLamp4_3Perubahan($request);
            case "ppas_rekap_tab5_p":
                return $this->getPpasLamp5Perubahan($request);
            case "ppas_rekap_tab6_p":
                return $this->getPpasLamp6Perubahan($request);
            
            case "ppas_rekap_program_rka_pdpt":
                return $this->getPpasRekapProgramRkaPdpt($request);
            case "ppas_rekap_program_rka_btl":
                return $this->getPpasRekapProgramRkaBtl($request);
            case "ppas_rekap_program_rka_bl":
                return $this->getPpasRekapProgramRkaBl($request);
            case "ppas_rekap_program_rka_pbyn":
                return $this->getPpasRekapProgramRkaPbyn($request);
            case "ppas_rekap_program_rka_non_ppas":
                return $this->getPpasRekapProgramRkaNonPpas($request);
            case "ppas_rekap_program_rkpd":
                return $this->getPpasRekapProgramRkpd($request);
            case "ppas_rekap_program_skpd":
                return $this->getPpasRekapProgramSkpd($request);
            case "ppas_rekap_program_ppas_non_rkpd":
                return $this->getPpasRekapProgramPpasNonRkpd($request);
            case "ppas_rekap_program_ppas_non_rka":
                return $this->getPpasRekapProgramPpasNonRka($request);
            case "ppas_rekap_program_rkpd_non_ppas":
                return $this->getPpasRekapProgramRkpdNonPpas($request);
            case "ppas_trx_non_mak":
                return $this->getPpasTrxNonMak($request);
            case "ppas_kgtn_tanpa_ssrn":
                return $this->getPpasKgtnTanpaSsrn($request);

            default:
                throw new BadRequestHttpException("Undefined report");
        }
    }

    private function getPpasRekapSatker($request)
    {
        try {
            $idPpas = $request->query->get("id_ppas");
            $idPpas = $this->convertOuuidToUuid($idPpas);
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $this->connection = $conn->getConnection();


            $sql = "SELECT
                        CONCAT_WS('-',
                        SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 1, 8),
                        SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 9, 4),
                        SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 13, 4),
                        SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 17, 4),
                        SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 21)
                            ) AS ppas_ppas_id_ppas_ppas,
                        CONCAT_WS('-',
                        SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 1, 8),
                        SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 9, 4),
                        SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 13, 4),
                        SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 17, 4),
                        SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 21)
                            ) AS sikd_satker_id_sikd_satker,
                        sikd_satker.`kode` AS sikd_satker_kode,
                        sikd_satker.`nama` AS sikd_satker_nama,
                        if(ppas_anggaran.sikd_sub_skpd_id != '', ppas_anggaran.sikd_sub_skpd_id, sikd_satker.id_sikd_satker) AS sikd_sub_skpd_id_sikd_sub_skpd,
                        if(ppas_anggaran.sikd_sub_skpd_id != '', sikd_sub_skpd.kode, sikd_satker.kode) AS sikd_sub_skpd_kode,
                        if(ppas_anggaran.sikd_sub_skpd_id != '', sikd_sub_skpd.nama, sikd_satker.nama) AS sikd_sub_skpd_nama,
                        CONCAT_WS('-',
                        SUBSTR(HEX(ppas_anggaran.`ppas_ppas_id`), 1, 8),
                        SUBSTR(HEX(ppas_anggaran.`ppas_ppas_id`), 9, 4),
                        SUBSTR(HEX(ppas_anggaran.`ppas_ppas_id`), 13, 4),
                        SUBSTR(HEX(ppas_anggaran.`ppas_ppas_id`), 17, 4),
                        SUBSTR(HEX(ppas_anggaran.`ppas_ppas_id`), 21)
                            ) AS ppas_anggaran_ppas_ppas_id,
                        CONCAT_WS('-',
                        SUBSTR(HEX(ppas_anggaran.`id_ppas_anggaran`), 1, 8),
                        SUBSTR(HEX(ppas_anggaran.`id_ppas_anggaran`), 9, 4),
                        SUBSTR(HEX(ppas_anggaran.`id_ppas_anggaran`), 13, 4),
                        SUBSTR(HEX(ppas_anggaran.`id_ppas_anggaran`), 17, 4),
                        SUBSTR(HEX(ppas_anggaran.`id_ppas_anggaran`), 21)
                            ) AS ppas_anggaran_id_ppas_anggaran,
                        IF(ppas_ppas.jns_ppas = 'PPAS-A', 'PPAS Murni', 'PPAS Perubahan') AS jns_ppas,
                        IF(ppas_ppas.status_ppas = '0','Draft','') AS status_ppas, 
                        ppas_ppas.no_dokumen_pemda AS ppas_ppas_no_dokumen,    
                        date_format(ppas_ppas.tgl_pengesahan_pemda,'%d-%m-%Y') AS ppas_ppas_tgl_pengesahan,
                        if((select count('x') from sikd_sub_skpd where sikd_skpd_id = sikd_satker.`id_sikd_satker`) > 0, '1', '0') AS print_sub,   
                        SUM(IF(substring(ppas_mata_anggaran.kd_rekening,1,1) = '4', ppas_mata_anggaran.jml_usulan, 0)) AS jml_plafon_pdpt,
                        SUM(IF(substring(ppas_mata_anggaran.kd_rekening,1,2) = '51', ppas_mata_anggaran.jml_usulan, 0)) AS jml_plafon_btl,
                        SUM(IF(ppas_anggaran.ppas_anggaran_type = 'PpasBlnjLangsung', ppas_anggaran.jml_usulan, 0)) AS jml_plafon_bl, 
                        -- SUM(IF(ppas_anggaran.ppas_anggaran_type = 'PpasBelanja', ppas_anggaran.jml_usulan, 0)) AS jml_plafon_bl,  
                        SUM(IF(substring(ppas_mata_anggaran.kd_rekening,1,1) = '4', ppas_mata_anggaran.jml_final, 0)) AS jml_final_pdpt,
                        SUM(IF(substring(ppas_mata_anggaran.kd_rekening,1,2) = '51', ppas_mata_anggaran.jml_final, 0)) AS jml_final_btl,
                        SUM(IF(ppas_anggaran.ppas_anggaran_type = 'PpasBlnjLangsung', ppas_anggaran.jml_final, 0)) AS jml_final_bl
                        -- SUM(IF(ppas_anggaran.ppas_anggaran_type = 'PpasBelanja', ppas_anggaran.jml_final, 0)) AS jml_final_bl
                    FROM
                        `ppas_ppas` ppas_ppas
                        INNER JOIN `ppas_anggaran` ppas_anggaran ON ppas_ppas.`id_ppas_ppas` = ppas_anggaran.`ppas_ppas_id`
                            AND ppas_ppas.id_ppas_ppas = :idPpas
                        LEFT OUTER JOIN `ppas_mata_anggaran` ppas_mata_anggaran ON ppas_anggaran.`id_ppas_anggaran` = ppas_mata_anggaran.`ppas_anggaran_id`
                        INNER JOIN `sikd_satker` sikd_satker ON ppas_anggaran.sikd_satker_id = sikd_satker.`id_sikd_satker`
                        #INNER JOIN `sikd_skpd` sikd_skpd ON sikd_satker.id_sikd_satker = sikd_skpd.`id_sikd_skpd`
                        LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON ppas_anggaran.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                    GROUP BY
                        sikd_satker_kode,
                        sikd_sub_skpd_kode

                    ORDER BY
                        sikd_satker_kode,
                        sikd_sub_skpd_kode
                    ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("idPpas", $idPpas);
            $statement->execute();
            $rekapProyeksi = $statement->fetchAll();

            return new JsonResponse($rekapProyeksi);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }

    private function getPpasRekapSatkerSub($request)
    {
        try {
            $idPpas = $request->query->get("id_ppas");
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idPpas = $this->convertOuuidToUuid($idPpas);
            #$idPpas = pack('H*', str_replace('-', '', trim($idPpas)));
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
                        SUM(IF(SUBSTR(ppas_mata_anggaran.kd_rekening,1,1)='4', ppas_mata_anggaran.jml_usulan, 0)) AS jml_plafon_pdpt,
                        SUM(IF(SUBSTR(ppas_mata_anggaran.kd_rekening,1,2)='51', ppas_mata_anggaran.jml_usulan, 0)) AS jml_plafon_btl,
                        SUM(IF(SUBSTR(ppas_mata_anggaran.kd_rekening,1,2)='61', ppas_mata_anggaran.jml_usulan, 0)) AS jml_plafon_pnrm,
                        SUM(IF(SUBSTR(ppas_mata_anggaran.kd_rekening,1,2)='62', ppas_mata_anggaran.jml_usulan, 0)) AS jml_plafon_pbyr,
                        SUM(IF(SUBSTR(ppas_mata_anggaran.kd_rekening,1,1)='4', ppas_mata_anggaran.jml_final, 0)) AS jml_final_pdpt,
                        SUM(IF(SUBSTR(ppas_mata_anggaran.kd_rekening,1,2)='51', ppas_mata_anggaran.jml_final, 0)) AS jml_final_btl,
                        SUM(IF(SUBSTR(ppas_mata_anggaran.kd_rekening,1,2)='61', ppas_mata_anggaran.jml_final, 0)) AS jml_final_pnrm,
                        SUM(IF(SUBSTR(ppas_mata_anggaran.kd_rekening,1,2)='62', ppas_mata_anggaran.jml_final, 0)) AS jml_final_pbyr
                    FROM
                        `sikd_satker` sikd_satker
                        LEFT OUTER JOIN `ppas_anggaran` ppas_anggaran ON ppas_anggaran.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                        INNER JOIN `ppas_ppas` ppas_ppas ON ppas_anggaran.`ppas_ppas_id` = ppas_ppas.`id_ppas_ppas`
                        AND ppas_ppas.id_ppas_ppas = :idPpas
                        INNER JOIN `ppas_mata_anggaran` ppas_mata_anggaran ON ppas_mata_anggaran.`ppas_anggaran_id` = ppas_anggaran.`id_ppas_anggaran`
                    GROUP BY
                        sikd_satker.kode
                    ORDER BY
                        sikd_satker.kode
                    ";
            
            
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("idPpas", $idPpas);
            $statement->execute();
            $rekapProyeksi = $statement->fetchAll();

            return new JsonResponse($rekapProyeksi);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }

    private function getPpasHeaderLandscape($request)
    {
        try {
            $idPpas = $request->query->get("id_ppas");
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idPpas = $this->convertOuuidToUuid($idPpas);
            //$idPpas = pack('H*', str_replace('-', '', trim($idPpas)));
            $this->connection = $conn->getConnection();
            $sql = "SELECT
                        CONCAT_WS('-',
                            SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 1, 8),
                            SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 9, 4),
                            SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 13, 4),
                            SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 17, 4),
                            SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 21)
                                ) AS ppas_ppas_id_ppas_ppas,
                        ppas_ppas.`tahun` AS ppas_ppas_tahun,
                        IF(ppas_ppas.`jns_ppas`='PPAS-A','PPAS MURNI','PPAS PERUBAHAN') AS ppas_ppas_jns_ppas,
                        ppas_ppas.`no_dokumen_pemda` AS ppas_ppas_no_dokumen_pemda,
                        ppas_ppas.`no_dokumen_dprd` AS ppas_ppas_no_dokumen_dprd,
                        IF(ppas_ppas.`tgl_pengesahan_pemda`='0000-00-00', null, date_format(ppas_ppas.`tgl_pengesahan_pemda`,'%d-%m-%Y')) AS ppas_ppas_tgl_pengesahan_pemda,
                        IF(ppas_ppas.`tgl_pengesahan_dprd`='0000-00-00', null, date_format(ppas_ppas.`tgl_pengesahan_dprd`,'%d-%m-%Y')) AS ppas_ppas_tgl_pengesahan_dprd,
                        IF(ppas_ppas.`status_ppas`='0','DRAFT ',' ') AS ppas_ppas_status_ppas
                    FROM
                        `ppas_ppas` ppas_ppas
                    WHERE
                        ppas_ppas.id_ppas_ppas = :idPpas
                    ";
            
            
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("idPpas", $idPpas);
            $statement->execute();
            $rekapProyeksi = $statement->fetchAll();

            return new JsonResponse($rekapProyeksi);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
 
    private function getPpasRekapSatkerRinc($request)
    {
        try {
            $idPpas = $request->query->get("id_ppas");
            $idSatker = $request->query->get("id_satker");
            $idSubUnit = $request->query->get("id_sub_unit");
            $idPpas = $this->convertOuuidToUuid($idPpas);
            $idSatker = pack('H*', str_replace('-', '', trim($idSatker)));
            if ($idSubUnit != ''){
                $idSubUnit = pack('H*', str_replace('-', '', trim($idSubUnit)));    
            }

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $this->connection = $conn->getConnection();
        
            $sql = 
                "SELECT
                    CONCAT_WS('-',
                    SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 1, 8),
                    SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 9, 4),
                    SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 13, 4),
                    SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 17, 4),
                    SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 21)
                        ) AS ppas_ppas_id_ppas_ppas,
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
                    CONCAT(sikd_bidang.`kd_bidang`,sikd_prog.`kd_prog`) AS sikd_prog_kd_prog,
                    CONCAT_WS('-',
                    SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 1, 8),
                    SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 9, 4),
                    SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 13, 4),
                    SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 17, 4),
                    SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 21)
                        ) AS sikd_kgtn_id_sikd_kgtn,
                    CONCAT(sikd_bidang.`kd_bidang`,sikd_kgtn.`kd_kgtn`) AS sikd_kgtn_kd_kgtn,
                    sikd_kgtn.`nm_kgtn` AS sikd_kgtn_nm_kgtn,
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
                    SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 1, 8),
                    SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 9, 4),
                    SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 13, 4),
                    SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 17, 4),
                    SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 21)
                        ) AS sikd_rek_obj_id_sikd_rek_obj,
                    sikd_rek_obj.`kd_rek_obj` AS sikd_rek_obj_kd_rek_obj,
                    sikd_rek_obj.`nm_rek_obj` AS sikd_rek_obj_nm_rek_obj,
                    CONCAT_WS('-',
                    SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 1, 8),
                    SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 9, 4),
                    SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 13, 4),
                    SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 17, 4),
                    SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 21)
                        ) AS sikd_rek_jenis_id_sikd_rek_jenis,
                    sikd_rek_jenis.`kd_rek_jenis` AS sikd_rek_jenis_kd_rek_jenis,
                    sikd_rek_jenis.`nm_rek_jenis` AS sikd_rek_jenis_nm_rek_jenis,
                    IF(sikd_urusan.`id_sikd_urusan` IS NOT NULL, '52', sikd_rek_kelompok.`kd_rek_kelompok`) AS kd_rek_kelompok,
                    -- IF(sikd_urusan.`id_sikd_urusan` IS NOT NULL, 'BELANJA LANGSUNG', sikd_rek_kelompok.`nm_rek_kelompok`) AS nm_rek_kelompok,
                    IF(sikd_urusan.`id_sikd_urusan` IS NOT NULL, 'BELANJA', sikd_rek_kelompok.`nm_rek_kelompok`) AS nm_rek_kelompok,
                    IF(sikd_urusan.`id_sikd_urusan` IS NOT NULL, '5', sikd_rek_akun.`kd_rek_akun`) AS kd_rek_akun,
                    IF(sikd_urusan.`id_sikd_urusan` IS NOT NULL, 'BELANJA', sikd_rek_akun.`nm_rek_akun`) AS nm_rek_akun,
                    /*IF(ppas_anggaran.ppas_anggaran_type != 'PpasBlnjLangsung', IFNULL(ppas_mata_anggaran.`jml_usulan`,0), IFNULL(ppas_anggaran.`jml_usulan`,0)) AS jml_pengajuan,
                    IF(ppas_anggaran.ppas_anggaran_type != 'PpasBlnjLangsung', IFNULL(ppas_mata_anggaran.`jml_final`,0), IFNULL(ppas_anggaran.`jml_final`,0)) AS jml_pembahasan,
                    IF(ppas_anggaran.ppas_anggaran_type != 'PpasBlnjLangsung', IFNULL(ppas_mata_anggaran.`jml_final`,0) - IFNULL(ppas_mata_anggaran.`jml_usulan`,0), 0) AS jml_selisih,
                    IF(ppas_anggaran.ppas_anggaran_type != 'PpasBlnjLangsung', 100*(IFNULL(ppas_mata_anggaran.`jml_final`,0) - IFNULL(ppas_mata_anggaran.`jml_usulan`,0))/IFNULL(ppas_mata_anggaran.`jml_usulan`,0),*/
                    IF(ppas_anggaran.ppas_anggaran_type != 'PpasBelanja', IFNULL(ppas_mata_anggaran.`jml_usulan`,0), IFNULL(ppas_anggaran.`jml_usulan`,0)) AS jml_pengajuan,
                    IF(ppas_anggaran.ppas_anggaran_type != 'PpasBelanja', IFNULL(ppas_mata_anggaran.`jml_final`,0), IFNULL(ppas_anggaran.`jml_final`,0)) AS jml_pembahasan,
                    IF(ppas_anggaran.ppas_anggaran_type != 'PpasBelanja', IFNULL(ppas_mata_anggaran.`jml_final`,0) - IFNULL(ppas_mata_anggaran.`jml_usulan`,0), 0) AS jml_selisih,
                    IF(ppas_anggaran.ppas_anggaran_type != 'PpasBelanja', 100*(IFNULL(ppas_mata_anggaran.`jml_final`,0) - IFNULL(ppas_mata_anggaran.`jml_usulan`,0))/IFNULL(ppas_mata_anggaran.`jml_usulan`,0),
                    100*(IFNULL(ppas_anggaran.`jml_final`,0) - IFNULL(ppas_anggaran.`jml_usulan`,0))/IFNULL(ppas_anggaran.`jml_usulan`,0)) AS pct_selisih
                FROM
                    `ppas_ppas` ppas_ppas 
                    INNER JOIN `ppas_anggaran` ppas_anggaran ON ppas_ppas.`id_ppas_ppas` = ppas_anggaran.`ppas_ppas_id`
                    INNER JOIN `sikd_satker` sikd_satker ON ppas_anggaran.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                    LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON ppas_anggaran.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                    LEFT OUTER JOIN `ppas_mata_anggaran` ppas_mata_anggaran ON ppas_anggaran.`id_ppas_anggaran` = ppas_mata_anggaran.`ppas_anggaran_id`
                    LEFT OUTER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON ppas_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                    LEFT OUTER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                    LEFT OUTER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                    LEFT OUTER JOIN `sikd_rek_kelompok` sikd_rek_kelompok ON sikd_rek_jenis.`sikd_rek_kelompok_id` = sikd_rek_kelompok.`id_sikd_rek_kelompok`
                    LEFT OUTER JOIN `sikd_rek_akun` sikd_rek_akun ON sikd_rek_kelompok.`sikd_rek_akun_id` = sikd_rek_akun.`id_sikd_rek_akun`
                    #LEFT OUTER JOIN `ppas_blnj_langsung` ppas_blnj_langsung ON ppas_anggaran.`id_ppas_anggaran` = ppas_blnj_langsung.`id_ppas_blnj_langsung`
                    LEFT OUTER JOIN `sikd_kgtn` sikd_kgtn ON ppas_anggaran.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                    LEFT OUTER JOIN `sikd_bidang` sikd_bidang ON ppas_anggaran.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                    LEFT OUTER JOIN `sikd_urusan` sikd_urusan ON sikd_bidang.`sikd_urusan_id` = sikd_urusan.`id_sikd_urusan`
                    LEFT OUTER JOIN `sikd_prog` sikd_prog ON sikd_kgtn.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                WHERE
                    ppas_ppas.id_ppas_ppas = :idPpas
                    AND IF (:idSatker != '', ppas_anggaran.sikd_satker_id = :idSatker, 1)
                    AND IF (:idSubUnit != '', ppas_anggaran.sikd_sub_skpd_id = :idSubUnit, 1)
                ORDER BY
                    sikd_satker.`kode`, sikd_sub_skpd.`kode`,
                    IF(sikd_rek_rincian_obj.`kd_rek_rincian_obj` IS NULL AND sikd_urusan.`id_sikd_urusan` IS NULL, 0,
                    IF(sikd_rek_rincian_obj.`kd_rek_rincian_obj` IS NULL, 2, 1)), kd_rek_akun,
                    sikd_rek_rincian_obj.`kd_rek_rincian_obj`,
                    sikd_urusan.`kd_urusan`,
                    sikd_bidang.kd_bidang, sikd_prog.kd_prog, sikd_kgtn.kd_kgtn
                    ";
                
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("idPpas", $idPpas);
            $statement->bindValue("idSatker", $idSatker);
            $statement->bindValue("idSubUnit", $idSubUnit);
            $statement->execute();
            $rekapProyeksi = $statement->fetchAll();

            return new JsonResponse($rekapProyeksi);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }

    private function getPpasHeaderP($request)
    {
        try {
            $idPpas = $request->query->get("id_ppas");
            $idPpas = $this->convertOuuidToUuid($idPpas);
            //$idPpas = pack('H*', str_replace('-', '', trim($idPpas)));
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $this->connection = $conn->getConnection();
            $sql = "SELECT
                        CONCAT_WS('-',
                            SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 1, 8),
                            SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 9, 4),
                            SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 13, 4),
                            SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 17, 4),
                            SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 21)
                                ) AS ppas_ppas_id_ppas_ppas,
                        ppas_ppas.`tahun` AS ppas_ppas_tahun,
                        IF(ppas_ppas.`jns_ppas`='PPAS-A','PPAS MURNI','PPAS PERUBAHAN') AS ppas_ppas_jns_ppas,
                        ppas_ppas.`no_dokumen_pemda` AS ppas_ppas_no_dokumen_pemda,
                        ppas_ppas.`no_dokumen_dprd` AS ppas_ppas_no_dokumen_dprd,
                        IF(ppas_ppas.`tgl_pengesahan_pemda`='0000-00-00', null, date_format(ppas_ppas.`tgl_pengesahan_pemda`,'%d-%m-%Y')) AS ppas_ppas_tgl_pengesahan_pemda,
                        IF(ppas_ppas.`tgl_pengesahan_dprd`='0000-00-00', null, date_format(ppas_ppas.`tgl_pengesahan_dprd`,'%d-%m-%Y')) AS ppas_ppas_tgl_pengesahan_dprd,
                        IF(ppas_ppas.`status_ppas`='0','DRAFT ',' ') AS ppas_ppas_status_ppas
                    FROM
                        `ppas_ppas` ppas_ppas
                     WHERE
                        ppas_ppas.id_ppas_ppas = :idPpas
                    ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("idPpas", $idPpas);
            $statement->execute();
            $rekapProyeksi = $statement->fetchAll();

            return new JsonResponse($rekapProyeksi);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    private function getPpasRekapSatkerRincKet($request)
    {
        try {
            $idPpas = $request->query->get("id_ppas");
            $idSatker = $request->query->get("id_satker");
            $idSubUnit = $request->query->get("id_sub_unit");

            $idPpas = $this->convertOuuidToUuid($idPpas);
            $idSatker = pack('H*', str_replace('-', '', trim($idSatker)));
            if ($idSubUnit != ''){
                $idSubUnit = pack('H*', str_replace('-', '', trim($idSubUnit)));    
            }
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $this->connection = $conn->getConnection();

            $sql = 
                /*"SELECT
                     CONCAT_WS('-',
                        SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 1, 8),
                        SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 9, 4),
                        SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 13, 4),
                        SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 17, 4),
                        SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 21)
                            ) AS ppas_ppas_id_ppas_ppas,
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
                     ppas_anggaran.sasaran_kgtn AS sasaran_kgtn,
                     ppas_anggaran.target_kgtn AS target_kgtn,
                     IFNULL(ppas_anggaran.`jml_usulan`,0) AS jml_pengajuan,
                     IFNULL(ppas_anggaran.`jml_final`,0) AS jml_pembahasan,
                     ppas_anggaran.keterangan AS keterangan_kgtn,
                     CONCAT_WS('-',
                        SUBSTR(HEX(ppas_anggaran.`rkpd_kegiatan_id`), 1, 8),
                        SUBSTR(HEX(ppas_anggaran.`rkpd_kegiatan_id`), 9, 4),
                        SUBSTR(HEX(ppas_anggaran.`rkpd_kegiatan_id`), 13, 4),
                        SUBSTR(HEX(ppas_anggaran.`rkpd_kegiatan_id`), 17, 4),
                        SUBSTR(HEX(ppas_anggaran.`rkpd_kegiatan_id`), 21)
                            ) AS ppas_anggaran_kgtn_id
                FROM
                     `ppas_ppas` ppas_ppas 
                     INNER JOIN `ppas_anggaran` ppas_anggaran ON ppas_ppas.`id_ppas_ppas` = ppas_anggaran.`ppas_ppas_id`
                     INNER JOIN `sikd_satker` sikd_satker ON ppas_anggaran.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                     LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON ppas_anggaran.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                     LEFT OUTER JOIN `sikd_kgtn` sikd_kgtn ON ppas_anggaran.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                     LEFT OUTER JOIN `sikd_bidang` sikd_bidang ON ppas_anggaran.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                     LEFT OUTER JOIN `sikd_urusan` sikd_urusan ON sikd_bidang.`sikd_urusan_id` = sikd_urusan.`id_sikd_urusan`
                     LEFT OUTER JOIN `sikd_prog` sikd_prog ON sikd_kgtn.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                WHERE
                     ppas_ppas.id_ppas_ppas = :idPpas
                     AND IF (:idSatker != '', ppas_anggaran.sikd_satker_id = :idSatker, 1)
                     AND IF (:idSubUnit != '', ppas_anggaran.sikd_sub_skpd_id LIKE :idSubUnit, 1)
                ORDER BY
                     sikd_satker.`kode`, sikd_sub_skpd.`kode`,
                     sikd_urusan.`kd_urusan`,
                     sikd_bidang.kd_bidang, sikd_prog.kd_prog, sikd_kgtn.kd_kgtn LIMIT 200
                    ";

            $sql = "SELECT
                         CONCAT_WS('-',
                         SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 1, 8),
                         SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 9, 4),
                         SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 13, 4),
                         SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 17, 4),
                         SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 21)
                            ) AS ppas_ppas_id_ppas_ppas,
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
                         sikd_kgtn.`id_sikd_kgtn` AS sikd_kgtn_id_sikd_kgtn,
                         concat(sikd_bidang.`kd_bidang`,sikd_kgtn.`kd_kgtn`) AS sikd_kgtn_kd_kgtn,
                         sikd_kgtn.`nm_kgtn` AS sikd_kgtn_nm_kgtn,
                         ppas_anggaran.sasaran_kgtn AS sasaran_kgtn,
                         ppas_anggaran.target_kgtn AS target_kgtn,
                         IFNULL(ppas_anggaran.`jml_usulan`,0) AS jml_pengajuan,
                         IFNULL(ppas_anggaran.`jml_final`,0) AS jml_pembahasan,
                         IFNULL(rkpd_anggaran.jml_anggaran_rkpd, 0) AS jml_anggaran_rkpd,
                         ppas_anggaran.keterangan AS keterangan_kgtn
                    FROM
                         `ppas_ppas` ppas_ppas 
                         INNER JOIN `ppas_anggaran` ppas_anggaran ON ppas_ppas.`id_ppas_ppas` = ppas_anggaran.`ppas_ppas_id`
                         INNER JOIN `sikd_satker` sikd_satker ON ppas_anggaran.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                         LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON ppas_anggaran.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                         LEFT OUTER JOIN `rkpd_anggaran` rkpd_anggaran ON ppas_anggaran.`rkpd_kegiatan_id` = rkpd_anggaran.`id_rkpd_anggaran`
                         LEFT OUTER JOIN `sikd_kgtn` sikd_kgtn ON ppas_anggaran.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                         LEFT OUTER JOIN `sikd_bidang` sikd_bidang ON ppas_anggaran.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                         LEFT OUTER JOIN `sikd_urusan` sikd_urusan ON sikd_bidang.`sikd_urusan_id` = sikd_urusan.`id_sikd_urusan`
                         LEFT OUTER JOIN `sikd_prog` sikd_prog ON sikd_kgtn.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                    WHERE
                         ppas_ppas.id_ppas_ppas = :idPpas
                         AND IF (:idSatker != '', ppas_anggaran.sikd_satker_id = :idSatker,1)
                    ORDER BY
                         sikd_satker.`kode`, sikd_sub_skpd.`kode`,
                         sikd_urusan.`kd_urusan`,
                         sikd_bidang.kd_bidang, sikd_prog.kd_prog, sikd_kgtn.kd_kgtn";*/

                    "SELECT
                        CONCAT_WS('-',
                            SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 1, 8),
                            SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 9, 4),
                            SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 13, 4),
                            SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 17, 4),
                            SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 21)
                                ) AS ppas_ppas_id_ppas_ppas,
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
                        CONCAT(sikd_bidang.`kd_bidang`,sikd_prog.`kd_prog`) AS sikd_prog_kd_prog,
                        sikd_kgtn.`id_sikd_kgtn` AS sikd_kgtn_id_sikd_kgtn,
                        CONCAT(sikd_bidang.`kd_bidang`,sikd_kgtn.`kd_kgtn`) AS sikd_kgtn_kd_kgtn,
                        sikd_kgtn.`nm_kgtn` AS sikd_kgtn_nm_kgtn,
                        ppas_anggaran.sasaran_kgtn AS sasaran_kgtn,
                        ppas_anggaran.target_kgtn AS target_kgtn,
                        IFNULL(ppas_anggaran.`jml_usulan`,0) AS jml_pengajuan,
                        IFNULL(ppas_anggaran.`jml_final`,0) AS jml_pembahasan,
                        IFNULL(rkpd_anggaran.jml_anggaran_rkpd, 0) AS jml_anggaran_rkpd,
                        ppas_anggaran.keterangan AS keterangan_kgtn
                    FROM
                        `ppas_ppas` ppas_ppas 
                        INNER JOIN `ppas_anggaran` ppas_anggaran ON ppas_ppas.`id_ppas_ppas` = ppas_anggaran.`ppas_ppas_id`
                        -- AND ppas_anggaran.ppas_anggaran_type = 'PpasBlnjLangsung'
                        AND ppas_anggaran.ppas_anggaran_type = 'PpasBelanja'
                        INNER JOIN `sikd_satker` sikd_satker ON ppas_anggaran.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                        LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON ppas_anggaran.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                        #LEFT OUTER JOIN `ppas_blnj_langsung` ppas_blnj_langsung ON ppas_anggaran.`id_ppas_anggaran` = ppas_blnj_langsung.`id_ppas_blnj_langsung`
                        #LEFT OUTER JOIN `rkpd_kegiatan` rkpd_kegiatan ON ppas_blnj_langsung.`rkpd_kegiatan_id` = rkpd_kegiatan.`id_rkpd_kegiatan`
                        LEFT OUTER JOIN `rkpd_anggaran` rkpd_anggaran ON ppas_anggaran.`rkpd_kegiatan_id` = rkpd_anggaran.`id_rkpd_anggaran`
                        LEFT OUTER JOIN `sikd_kgtn` sikd_kgtn ON ppas_anggaran.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                        LEFT OUTER JOIN `sikd_bidang` sikd_bidang ON ppas_anggaran.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                        LEFT OUTER JOIN `sikd_urusan` sikd_urusan ON sikd_bidang.`sikd_urusan_id` = sikd_urusan.`id_sikd_urusan`
                        LEFT OUTER JOIN `sikd_prog` sikd_prog ON sikd_kgtn.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                    WHERE
                        ppas_ppas.id_ppas_ppas = :idPpas
                    AND IF (:idSatker != '', ppas_anggaran.sikd_satker_id = :idSatker, 1)
                    AND IF (:idSubUnit != '', ppas_anggaran.sikd_sub_skpd_id LIKE :idSubUnit, 1)
                    ORDER BY
                        sikd_satker.`kode`, sikd_sub_skpd.`kode`,
                        sikd_urusan.`kd_urusan`,
                        sikd_bidang.kd_bidang, sikd_prog.kd_prog, sikd_kgtn.kd_kgtn
                    ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("idPpas", $idPpas);
            $statement->bindValue("idSatker", $idSatker);
            $statement->bindValue("idSubUnit", $idSubUnit);
            $statement->execute();
            $rekapProyeksi = $statement->fetchAll();

            return new JsonResponse($rekapProyeksi);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }

    private function getPpasRekapPdpt($request)
    {
        try {
            $idPpas = $request->query->get("id_ppas");
            $idPpas = $this->convertOuuidToUuid($idPpas);
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $this->connection = $conn->getConnection();

            $sql = 
                "SELECT
                    CONCAT_WS('-',
                    SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 1, 8),
                    SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 9, 4),
                    SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 13, 4),
                    SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 17, 4),
                    SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 21)
                        ) AS id_ppas_ppas,
                    IFNULL(sikd_sub_skpd.`id_sikd_sub_skpd`, 
                    CONCAT_WS('-',
                    SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 1, 8),
                    SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 9, 4),
                    SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 13, 4),
                    SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 17, 4),
                    SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 21)
                        )) AS sikd_satker_id_sikd_satker,
                    IFNULL(sikd_sub_skpd.`kode`, sikd_satker.`kode`) AS sikd_satker_kode,
                    IFNULL(sikd_sub_skpd.`nama`, sikd_satker.`nama`) AS sikd_satker_nama,
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
                    SUM(IFNULL(ppas_mata_anggaran.`jml_usulan`,0)) AS jml_pengajuan,
                    SUM(IFNULL(ppas_mata_anggaran.`jml_final`,0)) AS jml_pembahasan,
                    SUM((IFNULL(ppas_mata_anggaran.`jml_final`,0) - IFNULL(ppas_mata_anggaran.`jml_usulan`,0))) AS jml_selisih
                FROM
                    `ppas_ppas` ppas_ppas 
                    INNER JOIN `ppas_anggaran` ppas_anggaran ON ppas_ppas.`id_ppas_ppas` = ppas_anggaran.`ppas_ppas_id`
                    AND ppas_anggaran.ppas_anggaran_type = 'PpasPendapatan'
                    #INNER JOIN `ppas_pendapatan` ppas_pendapatan ON ppas_anggaran.`id_ppas_anggaran` = ppas_pendapatan.`id_ppas_pendapatan`
                    LEFT OUTER JOIN `ppas_mata_anggaran` ppas_mata_anggaran ON ppas_anggaran.`id_ppas_anggaran` = ppas_mata_anggaran.`ppas_anggaran_id`
                    INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON ppas_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                    INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                    INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                    INNER JOIN `sikd_rek_kelompok` sikd_rek_kelompok ON sikd_rek_jenis.`sikd_rek_kelompok_id` = sikd_rek_kelompok.`id_sikd_rek_kelompok`
                    INNER JOIN `sikd_satker` sikd_satker ON ppas_anggaran.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                    LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON ppas_anggaran.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                WHERE
                    ppas_ppas.id_ppas_ppas = :idPpas
                GROUP BY
                    sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`,
                    sikd_satker.`id_sikd_satker`,
                    sikd_sub_skpd.`id_sikd_sub_skpd`
                ORDER BY
                    sikd_rek_rincian_obj.`kd_rek_rincian_obj` ASC,
                    sikd_satker.`kode`,
                    sikd_sub_skpd.`kode`
                ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("idPpas", $idPpas);
            $statement->execute();
            $rekapProyeksi = $statement->fetchAll();

            return new JsonResponse($rekapProyeksi);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }

    private function getPpasRekapBtl($request)
    {
        try {
            $idPpas = $request->query->get("id_ppas");
            $idPpas = $this->convertOuuidToUuid($idPpas);
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $this->connection = $conn->getConnection();

            $sql =
                "SELECT
                    CONCAT_WS('-',
                        SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 1, 8),
                        SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 9, 4),
                        SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 13, 4),
                        SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 17, 4),
                        SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 21)
                            ) AS id_ppas_ppas,
                    IFNULL(sikd_sub_skpd.`id_sikd_sub_skpd`, 
                    CONCAT_WS('-',
                        SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 1, 8),
                        SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 9, 4),
                        SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 13, 4),
                        SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 17, 4),
                        SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 21)
                            )) AS sikd_satker_id_sikd_satker,
                    IFNULL(sikd_sub_skpd.`kode`, sikd_satker.`kode`) AS sikd_satker_kode,
                    IFNULL(sikd_sub_skpd.`nama`, sikd_satker.`nama`) AS sikd_satker_nama,
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
                    SUM(IFNULL(ppas_mata_anggaran.`jml_usulan`,0)) AS jml_pengajuan,
                    SUM(IFNULL(ppas_mata_anggaran.`jml_final`,0)) AS jml_pembahasan,
                    SUM((IFNULL(ppas_mata_anggaran.`jml_final`,0) - IFNULL(ppas_mata_anggaran.`jml_usulan`,0))) AS jml_selisih
                FROM
                    `ppas_ppas` ppas_ppas 
                    INNER JOIN `ppas_anggaran` ppas_anggaran ON ppas_ppas.`id_ppas_ppas` = ppas_anggaran.`ppas_ppas_id`
                    -- AND ppas_anggaran.ppas_anggaran_type = 'PpasBlnjTdkLangsung'
                    AND ppas_anggaran.ppas_anggaran_type = 'PpasBelanja'
                    #INNER JOIN `ppas_blnj_tdk_langsung` ppas_blnj_tdk_langsung ON ppas_anggaran.`id_ppas_anggaran` = ppas_blnj_tdk_langsung.`id_ppas_blnj_tdk_langsung`
                    LEFT OUTER JOIN `ppas_mata_anggaran` ppas_mata_anggaran ON ppas_anggaran.`id_ppas_anggaran` = ppas_mata_anggaran.`ppas_anggaran_id`
                    INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON ppas_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                    INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                    INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                    INNER JOIN `sikd_rek_kelompok` sikd_rek_kelompok ON sikd_rek_jenis.`sikd_rek_kelompok_id` = sikd_rek_kelompok.`id_sikd_rek_kelompok`
                    INNER JOIN `sikd_satker` sikd_satker ON ppas_anggaran.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                    LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON ppas_anggaran.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                WHERE
                    ppas_ppas.id_ppas_ppas = :idPpas
                GROUP BY
                    sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`,
                    sikd_satker.`id_sikd_satker`,
                    sikd_sub_skpd.`id_sikd_sub_skpd`
                ORDER BY
                    sikd_rek_rincian_obj.`kd_rek_rincian_obj` ASC,
                    sikd_satker.`kode`,
                    sikd_sub_skpd.`kode`
                ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("idPpas", $idPpas);
            $statement->execute();
            $rekapProyeksi = $statement->fetchAll();

            return new JsonResponse($rekapProyeksi);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }

    private function getPpasRekapBl($request)
    {
        try {
            $idPpas = $request->query->get("id_ppas");
            $idPpas = $this->convertOuuidToUuid($idPpas);
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $this->connection = $conn->getConnection();

            $sql = 
                "SELECT
                    CONCAT_WS('-',
                    SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 1, 8),
                    SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 9, 4),
                    SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 13, 4),
                    SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 17, 4),
                    SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 21)
                        ) AS id_ppas_ppas,
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
                    CONCAT_WS('-',
                    SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 1, 8),
                    SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 9, 4),
                    SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 13, 4),
                    SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 17, 4),
                    SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 21)
                        ) AS sikd_bidang_id_sikd_bidang,
                    CONCAT(sikd_urusan.`kd_urusan`, '.', substr(sikd_bidang.`kd_bidang`,2,2)) AS sikd_bidang_kd_bidang,
                    sikd_bidang.`nm_bidang` AS sikd_bidang_nm_bidang,
                    CONCAT_WS('-',
                    SUBSTR(HEX(sikd_prog.`id_sikd_prog`), 1, 8),
                    SUBSTR(HEX(sikd_prog.`id_sikd_prog`), 9, 4),
                    SUBSTR(HEX(sikd_prog.`id_sikd_prog`), 13, 4),
                    SUBSTR(HEX(sikd_prog.`id_sikd_prog`), 17, 4),
                    SUBSTR(HEX(sikd_prog.`id_sikd_prog`), 21)
                        ) AS sikd_prog_id_sikd_prog,
                    CONCAT(sikd_urusan.`kd_urusan`, '.', substr(sikd_bidang.`kd_bidang`,2,2),'.', sikd_prog.`kd_prog`) AS sikd_prog_kd_prog,
                    sikd_prog.`nm_prog` AS sikd_prog_nm_prog,
                    SUM(IFNULL(ppas_anggaran.`jml_usulan`,0)) AS jml_pengajuan,
                    SUM(IFNULL(ppas_anggaran.`jml_final`,0)) AS jml_pembahasan,
                    SUM((IFNULL(ppas_anggaran.`jml_final`,0) - IFNULL(ppas_anggaran.`jml_usulan`,0))) AS jml_selisih
                FROM
                    `ppas_ppas` ppas_ppas 
                    INNER JOIN `ppas_anggaran` ppas_anggaran ON ppas_ppas.`id_ppas_ppas` = ppas_anggaran.`ppas_ppas_id`
                    -- AND ppas_anggaran.ppas_anggaran_type = 'PpasBlnjLangsung'
                    AND ppas_anggaran.ppas_anggaran_type = 'PpasBelanja'
                    #INNER JOIN `ppas_blnj_langsung` ppas_blnj_langsung ON ppas_anggaran.`id_ppas_anggaran` = ppas_blnj_langsung.`id_ppas_blnj_langsung`
                    INNER JOIN `sikd_kgtn` sikd_kgtn ON ppas_anggaran.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                    INNER JOIN `sikd_prog` sikd_prog ON sikd_kgtn.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                    INNER JOIN `sikd_bidang` sikd_bidang ON sikd_prog.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                    INNER JOIN `sikd_urusan` sikd_urusan ON sikd_bidang.`sikd_urusan_id` = sikd_urusan.`id_sikd_urusan`
                    INNER JOIN `sikd_satker` sikd_satker ON ppas_anggaran.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                    LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON ppas_anggaran.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                WHERE
                    ppas_ppas.id_ppas_ppas = :idPpas
                GROUP BY
                    sikd_urusan.`id_sikd_urusan`, 
                    sikd_bidang.`id_sikd_bidang`, 
                    sikd_prog.`id_sikd_prog`,
                    sikd_satker.`id_sikd_satker`, 
                    sikd_sub_skpd.`id_sikd_sub_skpd`
                ORDER BY
                    sikd_urusan.`kd_urusan`, 
                    sikd_bidang.`kd_bidang`, 
                    sikd_prog.`kd_prog`,
                    sikd_satker.`kode`, 
                    sikd_sub_skpd.`kode`
                ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("idPpas", $idPpas);
            $statement->execute();
            $rekapProyeksi = $statement->fetchAll();

            return new JsonResponse($rekapProyeksi);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }

    private function getPpasRekapPbyn($request)
    {
        try {
            $idPpas = $request->query->get("id_ppas");
            $idPpas = $this->convertOuuidToUuid($idPpas);
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $this->connection = $conn->getConnection();

            $sql = 
                "SELECT
                    CONCAT_WS('-',
                        SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 1, 8),
                        SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 9, 4),
                        SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 13, 4),
                        SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 17, 4),
                        SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 21)
                            ) AS id_ppas_ppas,
                    IFNULL(sikd_sub_skpd.`id_sikd_sub_skpd`, 
                    CONCAT_WS('-',
                        SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 1, 8),
                        SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 9, 4),
                        SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 13, 4),
                        SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 17, 4),
                        SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 21)
                            )) AS sikd_satker_id_sikd_satker,
                    IFNULL(sikd_sub_skpd.`kode`, sikd_satker.`kode`) AS sikd_satker_kode,
                    IFNULL(sikd_sub_skpd.`nama`, sikd_satker.`nama`) AS sikd_satker_nama,
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
                    SUM(IFNULL(ppas_mata_anggaran.`jml_usulan`,0)) AS jml_pengajuan,
                    SUM(IFNULL(ppas_mata_anggaran.`jml_final`,0)) AS jml_pembahasan,
                    SUM((IFNULL(ppas_mata_anggaran.`jml_final`,0) - IFNULL(ppas_mata_anggaran.`jml_usulan`,0))) AS jml_selisih,
                    SUM(IF(sikd_rek_kelompok.`kd_rek_kelompok`='61',1,-1)*IFNULL(ppas_mata_anggaran.`jml_usulan`,0)) AS ttl_pengajuan,
                    SUM(IF(sikd_rek_kelompok.`kd_rek_kelompok`='61',1,-1)*IFNULL(ppas_mata_anggaran.`jml_final`,0)) AS ttl_pembahasan,
                    SUM(IF(sikd_rek_kelompok.`kd_rek_kelompok`='61',1,-1)*(IFNULL(ppas_mata_anggaran.`jml_final`,0) - IFNULL(ppas_mata_anggaran.`jml_usulan`,0))) AS ttl_selisih
                FROM
                    `ppas_ppas` ppas_ppas 
                    INNER JOIN `ppas_anggaran` ppas_anggaran ON ppas_ppas.`id_ppas_ppas` = ppas_anggaran.`ppas_ppas_id`
                    AND ppas_anggaran.ppas_anggaran_type = 'PpasPembiayaan'
                    #INNER JOIN `ppas_pembiayaan` ppas_pembiayaan ON ppas_anggaran.`id_ppas_anggaran` = ppas_pembiayaan.`id_ppas_pembiayaan`
                    LEFT OUTER JOIN `ppas_mata_anggaran` ppas_mata_anggaran ON ppas_anggaran.`id_ppas_anggaran` = ppas_mata_anggaran.`ppas_anggaran_id`
                    INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON ppas_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                    INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                    INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                    INNER JOIN `sikd_rek_kelompok` sikd_rek_kelompok ON sikd_rek_jenis.`sikd_rek_kelompok_id` = sikd_rek_kelompok.`id_sikd_rek_kelompok`
                    INNER JOIN `sikd_satker` sikd_satker ON ppas_anggaran.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                    LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON ppas_anggaran.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                WHERE
                    ppas_ppas.id_ppas_ppas = :idPpas
                GROUP BY
                    sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`,
                    sikd_satker.`id_sikd_satker`,
                    sikd_sub_skpd.`id_sikd_sub_skpd`
                ORDER BY
                    sikd_rek_rincian_obj.`kd_rek_rincian_obj` ASC,
                    sikd_satker.`kode`,
                    sikd_sub_skpd.`kode`
                ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("idPpas", $idPpas);
            $statement->execute();
            $rekapProyeksi = $statement->fetchAll();

            return new JsonResponse($rekapProyeksi);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }

    private function getPpasRekapProgramRkpd($request)
    {
        try {

            $idPpas = $request->query->get("id_ppas");
            $status = $request->query->get("status");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idPpas = $this->convertOuuidToUuid($idPpas);
            //$idPpas = pack('H*', str_replace('-', '', trim($idPpas)));
            $status = pack('H*', str_replace('-', '', trim($status)));
            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                        sikd_bidang.`kd_bidang` AS sikd_bidang_kd_bidang,
                        sikd_bidang.`nm_bidang` AS sikd_bidang_nm_bidang,
                        sikd_prog.`kd_prog` AS sikd_prog_kd_prog,
                        sikd_prog.`nm_prog` AS sikd_prog_nm_prog,
                        sikd_kgtn.`kd_kgtn` AS sikd_kgtn_kd_kgtn,
                        sikd_kgtn.`nm_kgtn` AS sikd_kgtn_nm_kgtn,
                        ppas_ppas.`status_ppas` AS ppas_ppas_status_ppas,
                        ppas_ppas.`jns_ppas` AS ppas_ppas_jns_ppas,
                        ppas_ppas.`no_dokumen_pemda` AS ppas_ppas_no_dokumen,
                        if(ppas_ppas.`tgl_pengesahan_pemda`<>'' || ppas_ppas.`tgl_pengesahan_pemda`<>'0000-00-00',
                            date_format(ppas_ppas.`tgl_pengesahan_pemda`,'%d-%m-%y'), '-')  AS ppas_ppas_tgl_pengesahan,
                        sikd_satker.`id_sikd_satker` AS sikd_satker_id_sikd_satker,
                        sikd_satker.`kode` AS sikd_satker_kode,
                        sikd_satker.`nama` AS sikd_satker_nama,
                        sikd_sub_skpd.`kode` AS sikd_sub_skpd_kode,
                        sikd_sub_skpd.`nama` AS sikd_sub_skpd_nama,
                        sum(ifnull(rkpd_anggaran.`jml_anggaran_rkpd`,0)) AS rkpd_program_pagu_indikatif,
                        0 AS ppas_blnj_langsung_jml_plafon
                    FROM
                        `rkpd_program` rkpd_program 
                        INNER JOIN `rkpd_rkpd` rkpd_rkpd ON rkpd_program.`rkpd_rkpd_id` = rkpd_rkpd.`id_rkpd_rkpd`
                        INNER JOIN `sikd_bidang` sikd_bidang ON rkpd_program.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                        INNER JOIN `sikd_prog` sikd_prog ON rkpd_program.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                        #INNER JOIN `rkpd_kegiatan` rkpd_kegiatan ON rkpd_program.`id_rkpd_program` = rkpd_kegiatan.`rkpd_program_id`
                        INNER JOIN `rkpd_anggaran` rkpd_anggaran ON rkpd_program.`id_rkpd_program` = rkpd_anggaran.`rkpd_program_id`
                        INNER JOIN `sikd_satker` sikd_satker ON rkpd_anggaran.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                        LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON rkpd_anggaran.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                        INNER JOIN `ppas_ppas` ppas_ppas ON rkpd_rkpd.`id_rkpd_rkpd` = ppas_ppas.`rkpd_rkpd_id`
                        INNER JOIN `sikd_kgtn` sikd_kgtn ON rkpd_anggaran.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                    WHERE
                         ppas_ppas.`id_ppas_ppas` = :idPpas
                    GROUP BY
                        sikd_bidang.`kd_bidang`,
                        sikd_prog.`kd_prog`,
                        sikd_satker.`id_sikd_satker`,
                        sikd_sub_skpd.`kode`,
                        sikd_kgtn.`kd_kgtn`
                    UNION
                    SELECT
                        sikd_bidang.`kd_bidang` AS sikd_bidang_kd_bidang,
                        sikd_bidang.`nm_bidang` AS sikd_bidang_nm_bidang,
                        sikd_prog.`kd_prog` AS sikd_prog_kd_prog,
                        sikd_prog.`nm_prog` AS sikd_prog_nm_prog,
                        sikd_kgtn.`kd_kgtn` AS sikd_kgtn_kd_kgtn,
                        sikd_kgtn.`nm_kgtn` AS sikd_kgtn_nm_kgtn,
                        ppas_ppas.`status_ppas` AS ppas_ppas_status_ppas,
                        ppas_ppas.`jns_ppas` AS ppas_ppas_jns_ppas,
                        ppas_ppas.`no_dokumen_pemda` AS ppas_ppas_no_dokumen,
                        if(ppas_ppas.`tgl_pengesahan_pemda`<>'' || ppas_ppas.`tgl_pengesahan_pemda`<>'0000-00-00',
                            date_format(ppas_ppas.`tgl_pengesahan_pemda`,'%d-%m-%y'), '-')  AS ppas_ppas_tgl_pengesahan,
                        sikd_satker.`id_sikd_satker` AS sikd_satker_id_sikd_satker,
                        sikd_satker.`kode` AS sikd_satker_kode,
                        sikd_satker.`nama` AS sikd_satker_nama,
                        sikd_sub_skpd.`kode` AS sikd_sub_skpd_kode,
                        sikd_sub_skpd.`nama` AS sikd_sub_skpd_nama,
                        0 AS rkpd_program_pagu_indikatif,
                        SUM(IF(:status='0', ppas_anggaran.`jml_usulan`, ppas_anggaran.`jml_final`)) AS ppas_blnj_langsung_jml_plafon
                    FROM
                        `ppas_ppas` ppas_ppas
                        INNER JOIN `ppas_anggaran` ppas_anggaran ON ppas_anggaran.`ppas_ppas_id` = ppas_ppas.`id_ppas_ppas`
                        #INNER JOIN `ppas_blnj_langsung` ppas_blnj_langsung ON ppas_anggaran.`id_ppas_anggaran` = ppas_blnj_langsung.`id_ppas_blnj_langsung`
                        -- AND ppas_anggaran.ppas_anggaran_type = 'PpasBlnjLangsung'
                        AND ppas_anggaran.ppas_anggaran_type = 'PpasBelanja'
                        #INNER JOIN `rkpd_kegiatan` rkpd_kegiatan ON ppas_blnj_langsung.`rkpd_kegiatan_id` = rkpd_kegiatan.`id_rkpd_kegiatan`
                        INNER JOIN `rkpd_anggaran` rkpd_anggaran ON ppas_anggaran.`rkpd_kegiatan_id` = rkpd_anggaran.`id_rkpd_anggaran`
                        INNER JOIN `sikd_kgtn` sikd_kgtn ON rkpd_anggaran.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                        INNER JOIN `sikd_satker` sikd_satker ON rkpd_anggaran.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                        LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON rkpd_anggaran.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                        INNER JOIN `sikd_bidang` sikd_bidang ON ppas_anggaran.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                        INNER JOIN `sikd_urusan` sikd_urusan ON sikd_bidang.`sikd_urusan_id` = sikd_urusan.`id_sikd_urusan`
                        INNER JOIN `sikd_prog` sikd_prog ON sikd_kgtn.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                    WHERE
                        ppas_ppas.`id_ppas_ppas` = :idPpas
                    GROUP BY
                        sikd_kgtn.`kd_bidang`,
                        sikd_prog.`kd_prog`,
                        sikd_satker.`id_sikd_satker`,
                        sikd_sub_skpd.`kode`,
                        sikd_kgtn.`kd_kgtn`
                    ORDER BY
                        sikd_bidang_kd_bidang ASC,
                        sikd_prog_kd_prog ASC,
                        sikd_satker_kode ASC,
                        sikd_satker_id_sikd_satker ASC,
                        sikd_sub_skpd_kode ASC,
                        sikd_kgtn_kd_kgtn ASC
                   ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("idPpas", $idPpas);
            $statement->bindValue("status", $status);
            $statement->execute();
            $rekapProyeksi = $statement->fetchAll();

            return new JsonResponse($rekapProyeksi);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }

    private function getPpasRekapProgramSkpd($request)
    {
        try {

            $idPpas = $request->query->get("id_ppas");
            $idSatker = $request->query->get("id_satker");
            $status = $request->query->get("status");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            //$idPpas = pack('H*', str_replace('-', '', trim($idPpas)));
            $idPpas = $this->convertOuuidToUuid($idPpas);
            $idSatker = pack('H*', str_replace('-', '', trim($idSatker)));
            $status = pack('H*', str_replace('-', '', trim($status)));
            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                        sikd_bidang.`kd_bidang` AS sikd_bidang_kd_bidang,
                        sikd_bidang.`nm_bidang` AS sikd_bidang_nm_bidang,
                        sikd_prog.`kd_prog` AS sikd_prog_kd_prog,
                        sikd_prog.`nm_prog` AS sikd_prog_nm_prog,
                        sikd_kgtn.`kd_kgtn` AS sikd_kgtn_kd_kgtn,
                        sikd_kgtn.`nm_kgtn` AS sikd_kgtn_nm_kgtn,
                        ppas_ppas.`status_ppas` AS ppas_ppas_status_ppas,
                        ppas_ppas.`jns_ppas` AS ppas_ppas_jns_ppas,
                        ppas_ppas.`no_dokumen_pemda` AS ppas_ppas_no_dokumen,
                        if(ppas_ppas.`tgl_pengesahan_pemda`<>'' || ppas_ppas.`tgl_pengesahan_pemda`<>'0000-00-00',
                            date_format(ppas_ppas.`tgl_pengesahan_pemda`,'%d-%m-%y'), '-')  AS ppas_ppas_tgl_pengesahan,
                        sikd_satker.`id_sikd_satker` AS sikd_satker_id_sikd_satker,
                        sikd_satker.`kode` AS sikd_satker_kode,
                        sikd_satker.`nama` AS sikd_satker_nama,
                        sikd_sub_skpd.`kode` AS sikd_sub_skpd_kode,
                        sikd_sub_skpd.`nama` AS sikd_sub_skpd_nama,
                        sum(ifnull(rkpd_anggaran.`jml_anggaran_rkpd`,0)) AS rkpd_program_pagu_indikatif,
                        0 AS ppas_blnj_langsung_jml_plafon
                    FROM
                        `rkpd_program` rkpd_program 
                        INNER JOIN `rkpd_rkpd` rkpd_rkpd ON rkpd_program.`rkpd_rkpd_id` = rkpd_rkpd.`id_rkpd_rkpd`
                        INNER JOIN `sikd_bidang` sikd_bidang ON rkpd_program.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                        INNER JOIN `sikd_prog` sikd_prog ON rkpd_program.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                        #INNER JOIN `rkpd_kegiatan` rkpd_kegiatan ON rkpd_program.`id_rkpd_program` = rkpd_kegiatan.`rkpd_program_id`
                        INNER JOIN `rkpd_anggaran` rkpd_anggaran ON rkpd_program.`id_rkpd_program` = rkpd_anggaran.`rkpd_program_id`
                        INNER JOIN `sikd_satker` sikd_satker ON rkpd_anggaran.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                        LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON rkpd_anggaran.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                        INNER JOIN `ppas_ppas` ppas_ppas ON rkpd_rkpd.`id_rkpd_rkpd` = ppas_ppas.`rkpd_rkpd_id`
                        INNER JOIN `sikd_kgtn` sikd_kgtn ON rkpd_anggaran.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                    WHERE
                        ppas_ppas.`id_ppas_ppas` = :idPpas
                    AND IF(:idSatker<>'', sikd_satker.`id_sikd_satker` = :idSatker, sikd_satker.`id_sikd_satker` LIKE '%')
                    GROUP BY
                        sikd_satker.`id_sikd_satker`,
                        sikd_sub_skpd.`kode`,
                        sikd_prog.`kd_prog`,
                        sikd_kgtn.`kd_kgtn`
                    UNION
                    SELECT
                        sikd_bidang.`kd_bidang` AS sikd_bidang_kd_bidang,
                        sikd_bidang.`nm_bidang` AS sikd_bidang_nm_bidang,
                        sikd_prog.`kd_prog` AS sikd_prog_kd_prog,
                        sikd_prog.`nm_prog` AS sikd_prog_nm_prog,
                        sikd_kgtn.`kd_kgtn` AS sikd_kgtn_kd_kgtn,
                        sikd_kgtn.`nm_kgtn` AS sikd_kgtn_nm_kgtn,
                        ppas_ppas.`status_ppas` AS ppas_ppas_status_ppas,
                        ppas_ppas.`jns_ppas` AS ppas_ppas_jns_ppas,
                        ppas_ppas.`no_dokumen_pemda` AS ppas_ppas_no_dokumen,
                        if(ppas_ppas.`tgl_pengesahan_pemda`<>'' || ppas_ppas.`tgl_pengesahan_pemda`<>'0000-00-00',
                            date_format(ppas_ppas.`tgl_pengesahan_pemda`,'%d-%m-%y'), '-')  AS ppas_ppas_tgl_pengesahan,
                        sikd_satker.`id_sikd_satker` AS sikd_satker_id_sikd_satker,
                        sikd_satker.`kode` AS sikd_satker_kode,
                        sikd_satker.`nama` AS sikd_satker_nama,
                        sikd_sub_skpd.`kode` AS sikd_sub_skpd_kode,
                        sikd_sub_skpd.`nama` AS sikd_sub_skpd_nama,
                        0 AS rkpd_program_pagu_indikatif,
                        SUM(IF(:status='0', ppas_anggaran.`jml_usulan`, ppas_anggaran.`jml_final`)) AS ppas_blnj_langsung_jml_plafon
                    FROM
                        `ppas_ppas` ppas_ppas
                        INNER JOIN `ppas_anggaran` ppas_anggaran ON ppas_anggaran.`ppas_ppas_id` = ppas_ppas.`id_ppas_ppas`
                        #INNER JOIN `ppas_blnj_langsung` ppas_blnj_langsung ON ppas_anggaran.`id_ppas_anggaran` = ppas_blnj_langsung.`id_ppas_blnj_langsung`
                        -- AND ppas_anggaran.ppas_anggaran_type = 'PpasBlnjLangsung'
                        AND ppas_anggaran.ppas_anggaran_type = 'PpasBelanja'
                        INNER JOIN `sikd_kgtn` sikd_kgtn ON ppas_anggaran.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                        INNER JOIN `sikd_bidang` sikd_bidang ON ppas_anggaran.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                        INNER JOIN `sikd_urusan` sikd_urusan ON sikd_bidang.`sikd_urusan_id` = sikd_urusan.`id_sikd_urusan`
                        INNER JOIN `sikd_prog` sikd_prog ON sikd_kgtn.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                        INNER JOIN `sikd_satker` sikd_satker ON ppas_anggaran.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                        LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON ppas_anggaran.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                    WHERE
                         ppas_ppas.`id_ppas_ppas` = :idPpas
                    AND IF(:idSatker<>'', sikd_satker.`id_sikd_satker` = :idSatker, sikd_satker.`id_sikd_satker` LIKE '%')
                    GROUP BY
                        sikd_satker.`id_sikd_satker`,
                        sikd_sub_skpd.`kode`,
                        sikd_prog.`kd_prog`,
                        sikd_kgtn.`kd_kgtn`
                    ORDER BY
                        sikd_satker_kode ASC,
                        sikd_satker_id_sikd_satker ASC,
                        sikd_sub_skpd_kode ASC,
                        sikd_prog_kd_prog ASC,
                        sikd_kgtn_kd_kgtn ASC
                    ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("idPpas", $idPpas);
            $statement->bindValue("idSatker", $idSatker);
            $statement->bindValue("status", $status);
            $statement->execute();
            $rekapProyeksi = $statement->fetchAll();

            return new JsonResponse($rekapProyeksi);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }

    private function getPpasRekapProgramPpasNonRkpd($request)
    {
        try {

            $idPpas = $request->query->get("id_ppas");
            //print_r($)
            $status = $request->query->get("status");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idPpas = $this->convertOuuidToUuid($idPpas);
            //$idPpas = pack('H*', str_replace('-', '', trim($idPpas)));
            $status = pack('H*', str_replace('-', '', trim($status)));
            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                        sikd_bidang.`kd_bidang` AS sikd_bidang_kd_bidang,
                        sikd_bidang.`nm_bidang` AS sikd_bidang_nm_bidang,
                        sikd_prog.`kd_prog` AS sikd_prog_kd_prog,
                        sikd_prog.`nm_prog` AS sikd_prog_nm_prog,
                        sikd_kgtn.`kd_kgtn` AS sikd_kgtn_kd_kgtn,
                        sikd_kgtn.`nm_kgtn` AS sikd_kgtn_nm_kgtn,
                        ppas_ppas.`status_ppas` AS ppas_ppas_status_ppas,
                        ppas_ppas.`jns_ppas` AS ppas_ppas_jns_ppas,
                        ppas_ppas.`no_dokumen_pemda` AS ppas_ppas_no_dokumen,
                        IF(ppas_ppas.`tgl_pengesahan_pemda`<>'' || ppas_ppas.`tgl_pengesahan_pemda`<>'0000-00-00',
                            DATE_FORMAT(ppas_ppas.`tgl_pengesahan_pemda`,'%d-%m-%y'), '-')  AS ppas_ppas_tgl_pengesahan,
                        sikd_satker.`id_sikd_satker` AS sikd_satker_id_sikd_satker,
                        sikd_satker.`kode` AS sikd_satker_kode,
                        sikd_satker.`nama` AS sikd_satker_nama,
                        sikd_sub_skpd.`kode` AS sikd_sub_skpd_kode,
                        sikd_sub_skpd.`nama` AS sikd_sub_skpd_nama,
                        IF(:status='0', ppas_anggaran.`jml_usulan`, ppas_anggaran.`jml_final`) AS ppas_blnj_langsung_jml_plafon
                    FROM
                        `ppas_ppas` ppas_ppas
                        INNER JOIN `ppas_anggaran` ppas_anggaran ON ppas_anggaran.`ppas_ppas_id` = ppas_ppas.`id_ppas_ppas`
                        #INNER JOIN `ppas_blnj_langsung` ppas_blnj_langsung ON ppas_anggaran.`id_ppas_anggaran` = ppas_blnj_langsung.`id_ppas_blnj_langsung`
                        -- AND ppas_anggaran.ppas_anggaran_type = 'PpasBlnjLangsung'
                        AND ppas_anggaran.ppas_anggaran_type = 'PpasBelanja'
                        INNER JOIN `sikd_kgtn` sikd_kgtn ON ppas_anggaran.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                        INNER JOIN `sikd_bidang` sikd_bidang ON ppas_anggaran.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                        INNER JOIN `sikd_urusan` sikd_urusan ON sikd_bidang.`sikd_urusan_id` = sikd_urusan.`id_sikd_urusan`
                        INNER JOIN `sikd_prog` sikd_prog ON sikd_kgtn.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                        INNER JOIN `sikd_satker` sikd_satker ON ppas_anggaran.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                        LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON ppas_anggaran.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                    WHERE
                        ppas_ppas.`id_ppas_ppas` = :idPpas
                    AND (ppas_anggaran.`rkpd_kegiatan_id`='' OR ppas_anggaran.`rkpd_kegiatan_id` IS NULL)
                    ORDER BY
                        sikd_bidang_kd_bidang ASC,
                        sikd_prog_kd_prog ASC,
                        sikd_satker_kode ASC,
                        sikd_satker_id_sikd_satker ASC,
                        sikd_sub_skpd_kode ASC,
                        sikd_kgtn_kd_kgtn ASC
                    ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("idPpas", $idPpas);
            $statement->bindValue("status", $status);
            $statement->execute();
            $rekapProyeksi = $statement->fetchAll();

            return new JsonResponse($rekapProyeksi);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }

    private function getPpasRekapProgramRkpdNonPpas($request)
    {
        try {

            $idPpas = $request->query->get("id_ppas");
            //print_r($)
            //$status = $request->query->get("status_ppas");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idPpas = $this->convertOuuidToUuid($idPpas);
            //$idPpas = pack('H*', str_replace('-', '', trim($idPpas)));
            //$status = pack('H*', str_replace('-', '', trim($status)));
            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                        sikd_bidang.`kd_bidang` AS sikd_bidang_kd_bidang,
                        sikd_bidang.`nm_bidang` AS sikd_bidang_nm_bidang,
                        sikd_prog.`kd_prog` AS sikd_prog_kd_prog,
                        sikd_prog.`nm_prog` AS sikd_prog_nm_prog,
                        sikd_kgtn.`kd_kgtn` AS sikd_kgtn_kd_kgtn,
                        sikd_kgtn.`nm_kgtn` AS sikd_kgtn_nm_kgtn,
                        ppas_ppas.`status_ppas` AS ppas_ppas_status_ppas,
                        ppas_ppas.`jns_ppas` AS ppas_ppas_jns_ppas,
                        ppas_ppas.`no_dokumen_pemda` AS ppas_ppas_no_dokumen,
                        if(ppas_ppas.`tgl_pengesahan_pemda`<>'' || ppas_ppas.`tgl_pengesahan_pemda`<>'0000-00-00',
                            date_format(ppas_ppas.`tgl_pengesahan_pemda`,'%d-%m-%y'), '-')  AS ppas_ppas_tgl_pengesahan,
                        sikd_satker.`id_sikd_satker` AS sikd_satker_id_sikd_satker,
                        sikd_satker.`kode` AS sikd_satker_kode,
                        sikd_satker.`nama` AS sikd_satker_nama,
                        sikd_sub_skpd.`kode` AS sikd_sub_skpd_kode,
                        sikd_sub_skpd.`nama` AS sikd_sub_skpd_nama,
                        ifnull(rkpd_anggaran.`jml_anggaran_rkpd`,0) AS rkpd_program_pagu_indikatif
                    FROM
                        `rkpd_program` rkpd_program 
                        INNER JOIN `rkpd_rkpd` rkpd_rkpd ON rkpd_program.`rkpd_rkpd_id` = rkpd_rkpd.`id_rkpd_rkpd`
                        INNER JOIN `sikd_bidang` sikd_bidang ON rkpd_program.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                        INNER JOIN `sikd_prog` sikd_prog ON rkpd_program.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                        INNER JOIN `rkpd_anggaran` rkpd_anggaran ON rkpd_program.`id_rkpd_program` = rkpd_anggaran.rkpd_program_id
                        #INNER JOIN `rkpd_kegiatan` rkpd_kegiatan ON rkpd_program.`id_rkpd_program` = rkpd_kegiatan.`rkpd_program_id`
                        INNER JOIN `sikd_kgtn` sikd_kgtn ON rkpd_anggaran.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                        INNER JOIN `sikd_satker` sikd_satker ON rkpd_anggaran.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                        LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON rkpd_anggaran.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                        INNER JOIN `ppas_ppas` ppas_ppas ON rkpd_rkpd.`id_rkpd_rkpd` = ppas_ppas.`rkpd_rkpd_id` 
                    WHERE
                        ppas_ppas.`id_ppas_ppas` = :idPpas
                    AND rkpd_anggaran.`id_rkpd_anggaran` NOT IN 
                            (Select rkpd_kegiatan_id 
                                from `ppas_anggaran`
                                        #ppas_blnj_langsung 
                                where -- ppas_anggaran.ppas_anggaran_type = 'PpasBlnjLangsung'
                                        ppas_anggaran.ppas_anggaran_type = 'PpasBelanja'
                                    and sikd_satker_id = rkpd_anggaran.`sikd_satker_id`
                                    and sikd_sub_skpd_id = rkpd_anggaran.`sikd_sub_skpd_id`)
                    ORDER BY
                        sikd_bidang_kd_bidang ASC,
                        sikd_prog_kd_prog ASC,
                        sikd_satker_kode ASC,
                        sikd_satker_id_sikd_satker ASC,
                        sikd_sub_skpd_kode ASC,
                        sikd_kgtn_kd_kgtn ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("idPpas", $idPpas);
            //$statement->bindValue("status", $status);
            $statement->execute();
            $rekapProyeksi = $statement->fetchAll();

            return new JsonResponse($rekapProyeksi);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }

    private function getPpasTrxNonMak($request)
    {
        try {

            $idPpas = $request->query->get("id_ppas");
            $status = $request->query->get("status");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idPpas = $this->convertOuuidToUuid($idPpas);
            //$idPpas = pack('H*', str_replace('-', '', trim($idPpas)));
            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                        sikd_satker.`id_sikd_satker` AS sikd_satker_id_sikd_satker,
                        sikd_satker.`kode` AS sikd_satker_kode,
                        sikd_satker.`nama` AS sikd_satker_nama,
                        sikd_sub_skpd.`id_sikd_sub_skpd` AS sikd_sub_skpd_id_sikd_sub_skpd,
                        sikd_sub_skpd.`kode` AS sikd_sub_skpd_kode,
                        sikd_sub_skpd.`nama` AS sikd_sub_skpd_nama,
                        CONCAT_WS('-',
                            SUBSTR(HEX(ppas_anggaran.`ppas_ppas_id`), 1, 8),
                            SUBSTR(HEX(ppas_anggaran.`ppas_ppas_id`), 9, 4),
                            SUBSTR(HEX(ppas_anggaran.`ppas_ppas_id`), 13, 4),
                            SUBSTR(HEX(ppas_anggaran.`ppas_ppas_id`), 17, 4),
                            SUBSTR(HEX(ppas_anggaran.`ppas_ppas_id`), 21)
                                ) AS ppas_anggaran_ppas_ppas_id,
                        CONCAT_WS('-',
                            SUBSTR(HEX(ppas_anggaran.`id_ppas_anggaran`), 1, 8),
                            SUBSTR(HEX(ppas_anggaran.`id_ppas_anggaran`), 9, 4),
                            SUBSTR(HEX(ppas_anggaran.`id_ppas_anggaran`), 13, 4),
                            SUBSTR(HEX(ppas_anggaran.`id_ppas_anggaran`), 17, 4),
                            SUBSTR(HEX(ppas_anggaran.`id_ppas_anggaran`), 21)
                                ) AS ppas_anggaran_id_ppas_anggaran,
                        IF(ppas_ppas.jns_ppas = 'PPAS-A', 'PPAS Murni', 'PPAS Perubahan') AS jns_ppas,
                        IF(ppas_ppas.status_ppas = '0','Draft','') AS status_ppas,
                        CONCAT_WS('-',
                            SUBSTR(HEX(ppas_mata_anggaran.id_ppas_mata_anggaran), 1, 8),
                            SUBSTR(HEX(ppas_mata_anggaran.id_ppas_mata_anggaran), 9, 4),
                            SUBSTR(HEX(ppas_mata_anggaran.id_ppas_mata_anggaran), 13, 4),
                            SUBSTR(HEX(ppas_mata_anggaran.id_ppas_mata_anggaran), 17, 4),
                            SUBSTR(HEX(ppas_mata_anggaran.id_ppas_mata_anggaran), 21)
                                ) AS ppas_mata_anggaran_id_ppas_mata_anggaran, 
                        ppas_mata_anggaran.kd_rekening AS ppas_mata_anggaran_kd_rekening, 
                        ppas_mata_anggaran.created_by AS ppas_mata_anggaran_created_by, 
                        ppas_mata_anggaran.creation_date AS ppas_mata_anggaran_creation_date,
                        IF(SUBSTR(ppas_mata_anggaran.kd_rekening,1,1)='4', IF(:status='0', ppas_mata_anggaran.`jml_usulan`, ppas_mata_anggaran.`jml_final`), 0) AS jml_plafon_pdpt,
                        IF(SUBSTR(ppas_mata_anggaran.kd_rekening,1,2)='51', IF(:status='0', ppas_mata_anggaran.`jml_usulan`, ppas_mata_anggaran.`jml_final`), 0) AS jml_plafon_btl,
                        -- IF(ppas_anggaran.ppas_anggaran_type = 'PpasBlnjLangsung', IF(:status='0', ppas_mata_anggaran.`jml_usulan`, 
                        IF(ppas_anggaran.ppas_anggaran_type = 'PpasBelanja', IF(:status='0', ppas_mata_anggaran.`jml_usulan`, ppas_mata_anggaran.`jml_final`), 0) AS jml_plafon_bl
                    FROM
                        `sikd_satker` sikd_satker
                        #INNER JOIN sikd_skpd sikd_skpd ON sikd_satker.id_sikd_satker = sikd_skpd.id_sikd_skpd
                        LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON sikd_satker.id_sikd_satker = sikd_sub_skpd.sikd_satker_id
                        LEFT OUTER JOIN `ppas_anggaran` ppas_anggaran ON ppas_anggaran.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                        AND IF(sikd_sub_skpd.`id_sikd_sub_skpd` IS NOT NULL, ppas_anggaran.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`, 1)
                        LEFT OUTER JOIN `ppas_ppas` ppas_ppas ON ppas_anggaran.`ppas_ppas_id` = ppas_ppas.`id_ppas_ppas`
                        AND ppas_ppas.id_ppas_ppas = :idPpas
                        LEFT OUTER JOIN `ppas_mata_anggaran` ppas_mata_anggaran ON ppas_mata_anggaran.`ppas_anggaran_id` = ppas_anggaran.`id_ppas_anggaran`
                    WHERE
                        ppas_mata_anggaran.kd_rekening not in (select kd_rek_rincian_obj from sikd_rek_rincian_obj)
                    ORDER BY
                        sikd_satker.kode,
                        sikd_sub_skpd.kode,
                        ppas_mata_anggaran.kd_rekening
                    ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("idPpas", $idPpas);
            $statement->bindValue("status", $status);
            $statement->execute();
            $rekapProyeksi = $statement->fetchAll();

            return new JsonResponse($rekapProyeksi);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }

    private function getPpasKgtnTanpaSsrn($request)
    {
        try {

            $id_ppas = $request->query->get("id_ppas");
            $sikd_satker_id = $request->query->get("sikd_satker_id");
            $sikd_sub_skpd_id = $request->query->get("sikd_sub_skpd_id");
            $status = $request->query->get("status");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            //$sikd_sub_skpd_id = pack('H*', str_replace('-', '', trim($sikd_sub_skpd_id)));
            $id_ppas = $this->convertOuuidToUuid($id_ppas);
            $sikd_satker_id = pack('H*', str_replace('-', '', trim($sikd_satker_id)));
            if ($sikd_sub_skpd_id != ''){
                $sikd_sub_skpd_id = pack('H*', str_replace('-', '', trim($sikd_sub_skpd_id)));    
            }
            
            
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                        CONCAT_WS('-',
                            SUBSTR(HEX(ppas_anggaran.`id_ppas_anggaran`), 1, 8),
                            SUBSTR(HEX(ppas_anggaran.`id_ppas_anggaran`), 9, 4),
                            SUBSTR(HEX(ppas_anggaran.`id_ppas_anggaran`), 13, 4),
                            SUBSTR(HEX(ppas_anggaran.`id_ppas_anggaran`), 17, 4),
                            SUBSTR(HEX(ppas_anggaran.`id_ppas_anggaran`), 21)
                                ) AS id_ppas_anggaran,
                        sikd_satker.`id_sikd_satker` AS sikd_satker_id_sikd_satker,
                        sikd_satker.`kode` AS sikd_satker_kode,
                        sikd_satker.`nama` AS sikd_satker_nama,
                        sikd_sub_skpd.`id_sikd_sub_skpd` AS sikd_sub_skpd_id_sikd_sub_skpd,
                        sikd_sub_skpd.`kode` AS sikd_sub_skpd_kode,
                        sikd_sub_skpd.`nama` AS sikd_sub_skpd_nama,
                        sikd_bidang_induk.kd_bidang AS sikd_bidang_induk_kd_bidang,
                        sikd_bidang_induk.nm_bidang AS sikd_bidang_induk_nm_bidang,
                        sikd_urusan.`id_sikd_urusan` AS sikd_urusan_id_sikd_urusan,
                        sikd_urusan.`kd_urusan` AS sikd_urusan_kd_urusan,
                        sikd_urusan.`nm_urusan` AS sikd_urusan_nm_urusan,
                        sikd_bidang.`id_sikd_bidang` AS sikd_bidang_id_sikd_bidang,
                        sikd_bidang.`kd_bidang` AS sikd_bidang_kd_bidang,
                        sikd_bidang.`nm_bidang` AS sikd_bidang_nm_bidang,
                        sikd_prog.`id_sikd_prog` AS sikd_prog_id_sikd_prog,
                        concat(sikd_bidang.`kd_bidang`, '.', sikd_prog.`kd_prog`) AS sikd_prog_kd_prog,
                        sikd_prog.`nm_prog` AS sikd_prog_nm_prog,
                        sikd_kgtn.`id_sikd_kgtn` AS sikd_kgtn_id_sikd_kgtn,
                        concat(sikd_bidang.`kd_bidang`, '.', sikd_prog.`kd_prog`, '.',substr(sikd_kgtn.`kd_kgtn`,3,3))  AS sikd_kgtn_kd_kgtn,
                        sikd_kgtn.`nm_kgtn` AS sikd_kgtn_nm_kgtn,
                        ppas_anggaran.`nm_subkegiatan` AS ppas_blnj_langsung_nm_subkegiatan,
                        ppas_anggaran.`sasaran_kgtn` AS ppas_blnj_langsung_sasaran,
                        ppas_anggaran.`target_kgtn` AS ppas_blnj_langsung_target,
                        SUM(IF(:status='0', ppas_anggaran.`jml_usulan`, ppas_anggaran.`jml_final`))AS jml_plafon
                    FROM
                        `ppas_ppas` ppas_ppas
                        INNER JOIN `ppas_anggaran` ppas_anggaran ON ppas_anggaran.`ppas_ppas_id` = ppas_ppas.`id_ppas_ppas`
                        AND ppas_anggaran.ppas_anggaran_type = 'PpasBlnjLangsung'
                        #INNER JOIN `ppas_blnj_langsung` ppas_blnj_langsung ON ppas_anggaran.`id_ppas_anggaran` = ppas_blnj_langsung.`id_ppas_blnj_langsung`
                        INNER JOIN `sikd_kgtn` sikd_kgtn ON ppas_anggaran.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                        INNER JOIN `sikd_bidang` sikd_bidang ON ppas_anggaran.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                        INNER JOIN `sikd_urusan` sikd_urusan ON sikd_bidang.`sikd_urusan_id` = sikd_urusan.`id_sikd_urusan`
                        INNER JOIN `sikd_prog` sikd_prog ON sikd_kgtn.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                        INNER JOIN `sikd_satker` sikd_satker ON ppas_anggaran.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                        INNER JOIN `sikd_bidang` sikd_bidang_induk ON sikd_satker.`kd_bidang_induk` = sikd_bidang_induk.`kd_bidang`
                        LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON ppas_anggaran.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                    WHERE
                        ppas_anggaran.`ppas_ppas_id` LIKE :id_ppas
                        AND IF(:sikd_satker_id != '', ppas_anggaran.sikd_satker_id = :sikd_satker_id, 1)
                        AND IF(:sikd_sub_skpd_id != '', ppas_anggaran.sikd_sub_skpd_id LIKE :sikd_sub_skpd_id, 1)
                        AND (ppas_anggaran.`sasaran_kgtn` = '' OR ppas_anggaran.`sasaran_kgtn` IS NULL OR ppas_anggaran.`target_kgtn` = '' OR ppas_anggaran.`target_kgtn` IS NULL)
                    GROUP BY
                        ppas_anggaran.id_ppas_anggaran
                    ORDER BY
                        sikd_satker.`kode`, sikd_sub_skpd.`kode`,
                        sikd_urusan.`kd_urusan`, sikd_bidang.`kd_bidang`,
                        sikd_prog.`kd_prog`, sikd_kgtn.`kd_kgtn`
                    ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_ppas", $id_ppas);
            $statement->bindValue("sikd_satker_id", $sikd_satker_id);
            $statement->bindValue("sikd_sub_skpd_id", $sikd_sub_skpd_id);
            $statement->bindValue("status", $status);
            $statement->execute();
            $rekapProyeksi = $statement->fetchAll();

            return new JsonResponse($rekapProyeksi);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getPpasLamp1($request)
    {
        try {
            $idPpas = $request->query->get("id_ppas");
            $status = $request->query->get("status_ppas");
            
           
            $idPpas = $this->convertOuuidToUuid($idPpas);
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $this->connection = $conn->getConnection();


            $sql = "SELECT
                        CONCAT_WS('-',
                            SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 1, 8),
                            SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 9, 4),
                            SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 13, 4),
                            SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 17, 4),
                            SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 21)
                        ) AS id_ppas_ppas,
                        sikd_rek_akun.kd_rek_akun AS ppas_pendapatan_akun,
                        IF(sikd_rek_akun.kd_rek_akun = '4', 'Pendapatan Daerah', 
                        IF(sikd_rek_akun.kd_rek_akun = '5', 'Belanja Daerah', 'Penerimaan Pembiayaan')) AS ppas_pendapatan_nm_akun,
                        sikd_rek_akun.`kd_rek_akun` AS sikd_rek_akun_kd_rek_akun,
                        sikd_rek_akun.`nm_rek_akun` AS sikd_rek_akun_nm_rek_akun,
                        IF(sikd_rek_akun.`kd_rek_akun` in ('4','5'), 'rek_45', 'rek_6') AS jns_rek,
                        sikd_rek_kelompok.`id_sikd_rek_kelompok` AS sikd_rek_kelompok_id_sikd_rek_kelompok,
                        sikd_rek_kelompok.`kd_rek_kelompok` AS sikd_rek_kelompok_kd_rek_kelompok,
                        sikd_rek_kelompok.`nm_rek_kelompok` AS sikd_rek_kelompok_nm_rek_kelompok,
                        sikd_rek_jenis.`id_sikd_rek_jenis` AS sikd_rek_jenis_id_sikd_rek_jenis,
                        sikd_rek_jenis.`kd_rek_jenis` AS sikd_rek_jenis_kd_rek_jenis,
                        sikd_rek_jenis.`nm_rek_jenis` AS sikd_rek_jenis_nm_rek_jenis,
                        sikd_rek_obj.`id_sikd_rek_obj` AS sikd_rek_obj_id_sikd_rek_obj,
                        sikd_rek_obj.`kd_rek_obj` AS sikd_rek_obj_kd_rek_obj,
                        sikd_rek_obj.`nm_rek_obj` AS sikd_rek_obj_nm_rek_obj,
                        sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj` AS sikd_rek_rincian_obj_id_sikd_rek_rincian_obj,
                        sikd_rek_rincian_obj.`kd_rek_rincian_obj` AS sikd_rek_rincian_obj_kd_rek_rincian_obj,
                        sikd_rek_rincian_obj.`nm_rek_rincian_obj` AS sikd_rek_rincian_obj_nm_rek_rincian_obj,
                        SUM(IF(:status='0', ppas_mata_anggaran.`jml_usulan`, ppas_mata_anggaran.`jml_final`)) AS ppas_pendapatan_jml_plafon,
                        SUM(IF(sikd_rek_akun.`kd_rek_akun`='4', (IF(:status='0', ppas_mata_anggaran.`jml_usulan`, ppas_mata_anggaran.`jml_final`)),
                        IF(sikd_rek_akun.`kd_rek_akun`='5', (IF(:status='0',-ppas_mata_anggaran.`jml_usulan`,-ppas_mata_anggaran.`jml_final`)), 0))) AS jml_surplus,
                        SUM(IF(sikd_rek_kelompok.`kd_rek_kelompok`='61',(IF(:status='0', ppas_mata_anggaran.`jml_usulan`, ppas_mata_anggaran.`jml_final`)),
                        IF(sikd_rek_kelompok.`kd_rek_kelompok`='62',(IF(:status='0',-ppas_mata_anggaran.`jml_usulan`,-ppas_mata_anggaran.`jml_final`)), 0))) AS jml_pembiayaan
                    FROM
                        `ppas_ppas` ppas_ppas
                        INNER JOIN `ppas_anggaran` ppas_anggaran ON ppas_anggaran.`ppas_ppas_id` = ppas_ppas.`id_ppas_ppas`
                        INNER JOIN `ppas_mata_anggaran` ppas_mata_anggaran ON ppas_anggaran.`id_ppas_anggaran` = ppas_mata_anggaran.`ppas_anggaran_id`
                        INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON ppas_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                        INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                        INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                        INNER JOIN `sikd_rek_kelompok` sikd_rek_kelompok ON sikd_rek_jenis.`sikd_rek_kelompok_id` = sikd_rek_kelompok.`id_sikd_rek_kelompok`
                        LEFT OUTER JOIN `sikd_rek_akun` sikd_rek_akun ON sikd_rek_kelompok.`sikd_rek_akun_id` = sikd_rek_akun.`id_sikd_rek_akun`
                    WHERE
                        ppas_ppas.`id_ppas_ppas` = :idPpas
                    AND (sikd_rek_akun.kd_rek_akun in ('4','5')
                    OR sikd_rek_kelompok.kd_rek_kelompok in ('61','62'))
                    GROUP BY
                        sikd_rek_akun.`kd_rek_akun`,
                        sikd_rek_kelompok.`kd_rek_kelompok`,
                        sikd_rek_jenis.`kd_rek_jenis`,
                        jns_rek
                    UNION
                    SELECT
                        CONCAT_WS('-',
                            SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 1, 8),
                            SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 9, 4),
                            SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 13, 4),
                            SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 17, 4),
                            SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 21)
                        ) AS id_ppas_ppas,
                        '5' AS ppas_pendapatan_akun,
                        'Belanja Daerah' AS ppas_pendapatan_nm_akun,
                        '5' AS sikd_rek_akun_kd_rek_akun,
                        'BELANJA' AS sikd_rek_akun_nm_rek_akun,
                        'rek_45' AS jns_rek,
                        '' AS sikd_rek_kelompok_id_sikd_rek_kelompok,
                        '52' AS sikd_rek_kelompok_kd_rek_kelompok,
                        -- 'BELANJA LANGSUNG' AS sikd_rek_kelompok_nm_rek_kelompok,
                        'BELANJA' AS sikd_rek_kelompok_nm_rek_kelompok,
                        '' AS sikd_rek_jenis_id_sikd_rek_jenis,
                        sikd_urusan.`kd_urusan` AS sikd_rek_jenis_kd_rek_jenis,
                        sikd_urusan.`nm_urusan` AS sikd_rek_jenis_nm_rek_jenis,
                        '' AS sikd_rek_obj_id_sikd_rek_obj,
                        '' AS sikd_rek_obj_kd_rek_obj,
                        '' AS sikd_rek_obj_nm_rek_obj,
                        '' AS sikd_rek_rincian_obj_id_sikd_rek_rincian_obj,
                        '' AS sikd_rek_rincian_obj_kd_rek_rincian_obj,
                        '-' AS sikd_rek_rincian_obj_nm_rek_rincian_obj,
                        SUM(IF(:status='0', ppas_anggaran.`jml_usulan`, ppas_anggaran.`jml_final`)) AS ppas_pendapatan_jml_plafon,
                        SUM(IF(:status='0',-ppas_anggaran.`jml_usulan`,-ppas_anggaran.`jml_final`)) AS jml_surplus,
                        0 AS jml_pembiayaan
                    FROM
                        `ppas_ppas` ppas_ppas
                        INNER JOIN `ppas_anggaran` ppas_anggaran ON ppas_anggaran.`ppas_ppas_id` = ppas_ppas.`id_ppas_ppas`
                        #INNER JOIN `ppas_blnj_langsung` ppas_blnj_langsung ON ppas_anggaran.`id_ppas_anggaran` = ppas_blnj_langsung.`id_ppas_blnj_langsung`
                        -- AND ppas_anggaran.ppas_anggaran_type = 'PpasBlnjLangsung'
                        AND ppas_anggaran.ppas_anggaran_type = 'PpasBelanja'
                        INNER JOIN `sikd_kgtn` sikd_kgtn ON ppas_anggaran.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                        INNER JOIN `sikd_prog` sikd_prog ON sikd_kgtn.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                        INNER JOIN `sikd_bidang` sikd_bidang ON sikd_prog.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                        INNER JOIN `sikd_urusan` sikd_urusan ON sikd_bidang.`sikd_urusan_id` = sikd_urusan.`id_sikd_urusan`
                    WHERE
                        ppas_ppas.`id_ppas_ppas` = :idPpas
                    GROUP BY
                        sikd_rek_akun_kd_rek_akun,
                        sikd_rek_kelompok_kd_rek_kelompok,
                        sikd_rek_jenis_kd_rek_jenis,
                        jns_rek
                    ORDER BY
                        sikd_rek_akun_kd_rek_akun,
                        sikd_rek_kelompok_kd_rek_kelompok,
                        sikd_rek_jenis_kd_rek_jenis
                    ";
            
            
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("idPpas", $idPpas);
            $statement->bindValue("status", $status);
            $statement->execute();
            $rekapProyeksi = $statement->fetchAll();
            
            return new JsonResponse($rekapProyeksi);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getPpasLamp2_1Perubahan($request)
    {
        try {
            $idPpas = $request->query->get("id_ppas");
            $status = $request->query->get("status_ppas");
            $tahun = $request->query->get("tahun");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idPpas = pack('H*', str_replace('-', '', trim($idPpas)));
            $this->connection = $conn->getConnection();
            $sql = "SELECT
                        CONCAT_WS('-',
                            SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 1, 8),
                            SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 9, 4),
                            SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 13, 4),
                            SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 17, 4),
                            SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 21)
                                ) AS id_ppas_ppas,
                        sikd_rek_akun.kd_rek_akun AS ppas_pendapatan_akun,
                        IF(sikd_rek_akun.kd_rek_akun = '4', 'Pendapatan Daerah', 'Penerimaan Pembiayaan') AS ppas_pendapatan_nm_akun,
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
                        SUM(IF(:status='0', ppas_mata_anggaran.`jml_usulan`, ppas_mata_anggaran.`jml_final`)) AS ppas_pendapatan_jml_plafon,
                        0 AS ppas_jml_sblm
                    FROM
                        `ppas_ppas` ppas_ppas
                        INNER JOIN `ppas_anggaran` ppas_anggaran ON ppas_anggaran.`ppas_ppas_id` = ppas_ppas.`id_ppas_ppas`
                        INNER JOIN `ppas_mata_anggaran` ppas_mata_anggaran ON ppas_anggaran.`id_ppas_anggaran` = ppas_mata_anggaran.`ppas_anggaran_id`
                        INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON ppas_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                        INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                        INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                        INNER JOIN `sikd_rek_kelompok` sikd_rek_kelompok ON sikd_rek_jenis.`sikd_rek_kelompok_id` = sikd_rek_kelompok.`id_sikd_rek_kelompok`
                        LEFT OUTER JOIN `sikd_rek_akun` sikd_rek_akun ON sikd_rek_kelompok.`sikd_rek_akun_id` = sikd_rek_akun.`id_sikd_rek_akun`
                    WHERE
                        ppas_ppas.tahun = :tahun
                        AND ppas_ppas.`id_ppas_ppas` = :idPpas
                        AND (sikd_rek_akun.kd_rek_akun = '4'
                        OR sikd_rek_kelompok.kd_rek_kelompok = '61')
                    GROUP BY
                        sikd_rek_jenis.`kd_rek_jenis`
                    UNION
                    SELECT
                        CONCAT_WS('-',
                            SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 1, 8),
                            SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 9, 4),
                            SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 13, 4),
                            SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 17, 4),
                            SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 21)
                                ) AS id_ppas_ppas,
                        sikd_rek_akun.kd_rek_akun AS ppas_pendapatan_akun,
                        IF(sikd_rek_akun.kd_rek_akun = '4', 'Pendapatan Daerah', 'Penerimaan Pembiayaan') AS ppas_pendapatan_nm_akun,
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
                        0 AS ppas_pendapatan_jml_plafon,
                        SUM(IF(:status='0', ppas_mata_anggaran.`jml_usulan`, ppas_mata_anggaran.`jml_final`)) AS ppas_jml_sblm
                    FROM
                        `ppas_ppas` ppas_ppas
                        INNER JOIN `ppas_anggaran` ppas_anggaran ON ppas_anggaran.`ppas_ppas_id` = ppas_ppas.`id_ppas_ppas`
                        INNER JOIN `ppas_mata_anggaran` ppas_mata_anggaran ON ppas_anggaran.`id_ppas_anggaran` = ppas_mata_anggaran.`ppas_anggaran_id`
                        INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON ppas_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                        INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                        INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                        INNER JOIN `sikd_rek_kelompok` sikd_rek_kelompok ON sikd_rek_jenis.`sikd_rek_kelompok_id` = sikd_rek_kelompok.`id_sikd_rek_kelompok`
                        LEFT OUTER JOIN `sikd_rek_akun` sikd_rek_akun ON sikd_rek_kelompok.`sikd_rek_akun_id` = sikd_rek_akun.`id_sikd_rek_akun`
                    WHERE
                        ppas_ppas.tahun = :tahun
                        AND ppas_ppas.`jns_ppas` = 'PPAS-A'
                        AND (sikd_rek_akun.kd_rek_akun = '4'
                        OR sikd_rek_kelompok.kd_rek_kelompok = '61')
                    GROUP BY
                        sikd_rek_jenis.`kd_rek_jenis`
                    ORDER BY
                        sikd_rek_jenis_kd_rek_jenis
                    ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("idPpas", $idPpas);
            $statement->bindValue("status", $status);
            $statement->bindValue("tahun", $tahun);
            $statement->execute();
            $rekapProyeksi = $statement->fetchAll();
            
            return new JsonResponse($rekapProyeksi);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getPpasLamp2_1RinciPerubahan($request)
    {
        try {
            $idPpas = $request->query->get("id_ppas");
            $status = $request->query->get("status_ppas");
            $tahun = $request->query->get("tahun");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idPpas = pack('H*', str_replace('-', '', trim($idPpas)));
            $this->connection = $conn->getConnection();
            $sql = "SELECT
                        CONCAT_WS('-',
                        SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 1, 8),
                        SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 9, 4),
                        SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 13, 4),
                        SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 17, 4),
                        SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 21)
                            ) AS id_ppas_ppas,
                        sikd_rek_akun.kd_rek_akun AS ppas_pendapatan_akun,
                        IF(sikd_rek_akun.kd_rek_akun = '4', 'Pendapatan Daerah', 'Penerimaan Pembiayaan') AS ppas_pendapatan_nm_akun,
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
                        SUM(IF(:status='0', ppas_mata_anggaran.`jml_usulan`, ppas_mata_anggaran.`jml_final`)) AS ppas_pendapatan_jml_plafon,
                        0 AS ppas_jml_sblm
                    FROM
                        `ppas_ppas` ppas_ppas
                        INNER JOIN `ppas_anggaran` ppas_anggaran ON ppas_anggaran.`ppas_ppas_id` = ppas_ppas.`id_ppas_ppas`
                        INNER JOIN `ppas_mata_anggaran` ppas_mata_anggaran ON ppas_anggaran.`id_ppas_anggaran` = ppas_mata_anggaran.`ppas_anggaran_id`
                        INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON ppas_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                        INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                        INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                        INNER JOIN `sikd_rek_kelompok` sikd_rek_kelompok ON sikd_rek_jenis.`sikd_rek_kelompok_id` = sikd_rek_kelompok.`id_sikd_rek_kelompok`
                        LEFT OUTER JOIN `sikd_rek_akun` sikd_rek_akun ON sikd_rek_kelompok.`sikd_rek_akun_id` = sikd_rek_akun.`id_sikd_rek_akun`
                    WHERE
                        ppas_ppas.tahun = :tahun
                        AND ppas_ppas.`id_ppas_ppas` = :idPpas
                        AND (sikd_rek_akun.kd_rek_akun = '4'
                        OR sikd_rek_kelompok.kd_rek_kelompok = '61')
                    GROUP BY
                        sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                    UNION
                    SELECT
                        CONCAT_WS('-',
                        SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 1, 8),
                        SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 9, 4),
                        SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 13, 4),
                        SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 17, 4),
                        SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 21)
                            ) AS id_ppas_ppas,
                        sikd_rek_akun.kd_rek_akun AS ppas_pendapatan_akun,
                        IF(sikd_rek_akun.kd_rek_akun = '4', 'Pendapatan Daerah', 'Penerimaan Pembiayaan') AS ppas_pendapatan_nm_akun,
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
                        0 AS ppas_pendapatan_jml_plafon,
                        SUM(IF(:status='0', ppas_mata_anggaran.`jml_usulan`, ppas_mata_anggaran.`jml_final`)) AS jml_ppas_sblm
                    FROM
                        `ppas_ppas` ppas_ppas
                        INNER JOIN `ppas_anggaran` ppas_anggaran ON ppas_anggaran.`ppas_ppas_id` = ppas_ppas.`id_ppas_ppas`
                        INNER JOIN `ppas_mata_anggaran` ppas_mata_anggaran ON ppas_anggaran.`id_ppas_anggaran` = ppas_mata_anggaran.`ppas_anggaran_id`
                        INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON ppas_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                        INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                        INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                        INNER JOIN `sikd_rek_kelompok` sikd_rek_kelompok ON sikd_rek_jenis.`sikd_rek_kelompok_id` = sikd_rek_kelompok.`id_sikd_rek_kelompok`
                        LEFT OUTER JOIN `sikd_rek_akun` sikd_rek_akun ON sikd_rek_kelompok.`sikd_rek_akun_id` = sikd_rek_akun.`id_sikd_rek_akun`
                    WHERE
                        ppas_ppas.tahun = :tahun
                        AND ppas_ppas.`jns_ppas` = 'PPAS-A'
                        AND (sikd_rek_akun.kd_rek_akun = '4'
                        OR sikd_rek_kelompok.kd_rek_kelompok = '61')
                    GROUP BY
                        sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                    ORDER BY
                        sikd_rek_rincian_obj_kd_rek_rincian_obj
                    ";
            
            
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("idPpas", $idPpas);
            $statement->bindValue("status", $status);
            $statement->bindValue("tahun", $tahun);
            $statement->execute();
            $rekapProyeksi = $statement->fetchAll();
            
            return new JsonResponse($rekapProyeksi);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getPpasLamp4_1APerubahan($request)
    {
        try {
            $idPpas = $request->query->get("id_ppas");
            $status = $request->query->get("status_ppas");
            $tahun = $request->query->get("tahun");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idPpas = pack('H*', str_replace('-', '', trim($idPpas)));
            $this->connection = $conn->getConnection();
            $sql = "SELECT
                         CONCAT_WS('-',
                    			SUBSTR(HEX(ppas_anggaran.`id_ppas_anggaran`), 1, 8),
                    			SUBSTR(HEX(ppas_anggaran.`id_ppas_anggaran`), 9, 4),
                    			SUBSTR(HEX(ppas_anggaran.`id_ppas_anggaran`), 13, 4),
                    			SUBSTR(HEX(ppas_anggaran.`id_ppas_anggaran`), 17, 4),
                    			SUBSTR(HEX(ppas_anggaran.`id_ppas_anggaran`), 21)
                    				) AS id_ppas_anggaran,
                         IF(ppas_ppas.jns_ppas = 'PPAS-F', 'PPAS Final', 'PPAS Perubahan') AS jns_ppas,
                         IF(ppas_ppas.status_ppas = '0','Draft','') AS status_ppas,
                         ppas_ppas.no_dokumen_pemda AS ppas_ppas_no_dokumen,
                         CONCAT_WS('-',
                    			SUBSTR(HEX(IFNULL(sikd_sub_skpd.`id_sikd_sub_skpd`, sikd_satker.`id_sikd_satker`)), 1, 8),
                    			SUBSTR(HEX(IFNULL(sikd_sub_skpd.`id_sikd_sub_skpd`, sikd_satker.`id_sikd_satker`)), 9, 4),
                    			SUBSTR(HEX(IFNULL(sikd_sub_skpd.`id_sikd_sub_skpd`, sikd_satker.`id_sikd_satker`)), 13, 4),
                    			SUBSTR(HEX(IFNULL(sikd_sub_skpd.`id_sikd_sub_skpd`, sikd_satker.`id_sikd_satker`)), 17, 4),
                    			SUBSTR(HEX(IFNULL(sikd_sub_skpd.`id_sikd_sub_skpd`, sikd_satker.`id_sikd_satker`)), 21)
                    				) AS sikd_satker_id_sikd_satker,
                         concat(sikd_urusan.`kd_urusan`, '.', substr(sikd_bidang.`kd_bidang`,3,2), '.',
                         	IFNULL(sikd_sub_skpd.`kode`, sikd_satker.`kode`)) AS sikd_satker_kode,
                         IFNULL(sikd_sub_skpd.`nama`, sikd_satker.`nama`) AS sikd_satker_nama,
                         CONCAT_WS('-',
                    			SUBSTR(HEX(sikd_urusan.`id_sikd_urusan`), 1, 8),
                    			SUBSTR(HEX(sikd_urusan.`id_sikd_urusan`), 9, 4),
                    			SUBSTR(HEX(sikd_urusan.`id_sikd_urusan`), 13, 4),
                    			SUBSTR(HEX(sikd_urusan.`id_sikd_urusan`), 17, 4),
                    			SUBSTR(HEX(sikd_urusan.`id_sikd_urusan`), 21)
                    				) AS sikd_urusan_id_sikd_urusan,
                         sikd_urusan.`kd_urusan` AS sikd_urusan_kd_urusan,
                         sikd_urusan.`nm_urusan` AS sikd_urusan_nm_urusan,
                         CONCAT_WS('-',
                    			SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 1, 8),
                    			SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 9, 4),
                    			SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 13, 4),
                    			SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 17, 4),
                    			SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 21)
                    				) AS sikd_bidang_id_sikd_bidang,
                         concat(sikd_urusan.`kd_urusan`, '.', substr(sikd_bidang.`kd_bidang`,3,2)) AS sikd_bidang_kd_bidang,
                         sikd_bidang.`nm_bidang` AS sikd_bidang_nm_bidang,
                         SUM(IF(:status='0', ppas_anggaran.`jml_usulan`, ppas_anggaran.`jml_final`)) AS jml_plafon,
                         0 AS jml_plafon_sblm
                    FROM
                         `ppas_ppas` ppas_ppas
                         INNER JOIN `ppas_anggaran` ppas_anggaran ON ppas_anggaran.`ppas_ppas_id` = ppas_ppas.`id_ppas_ppas`
                         INNER JOIN `sikd_kgtn` sikd_kgtn ON ppas_anggaran.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                         INNER JOIN `sikd_bidang` sikd_bidang ON ppas_anggaran.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                         INNER JOIN `sikd_urusan` sikd_urusan ON sikd_bidang.`sikd_urusan_id` = sikd_urusan.`id_sikd_urusan`
                         INNER JOIN `sikd_satker` sikd_satker ON ppas_anggaran.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                         LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON ppas_anggaran.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                    WHERE
                         ppas_ppas.tahun = :tahun
                         AND ppas_anggaran.`ppas_ppas_id` = :idPpas
                    GROUP BY
                         sikd_bidang.`id_sikd_bidang`,
                         sikd_satker.`id_sikd_satker`,
                         sikd_sub_skpd.`id_sikd_sub_skpd`
                    UNION
                    SELECT
                         CONCAT_WS('-',
                    			SUBSTR(HEX(ppas_anggaran.`id_ppas_anggaran`), 1, 8),
                    			SUBSTR(HEX(ppas_anggaran.`id_ppas_anggaran`), 9, 4),
                    			SUBSTR(HEX(ppas_anggaran.`id_ppas_anggaran`), 13, 4),
                    			SUBSTR(HEX(ppas_anggaran.`id_ppas_anggaran`), 17, 4),
                    			SUBSTR(HEX(ppas_anggaran.`id_ppas_anggaran`), 21)
                    				) AS id_ppas_anggaran,
                         IF(ppas_ppas.jns_ppas = 'PPAS-F', 'PPAS Final', 'PPAS Perubahan') AS jns_ppas,
                         IF(ppas_ppas.status_ppas = '0','Draft','') AS status_ppas,
                         ppas_ppas.no_dokumen_pemda AS ppas_ppas_no_dokumen,
                         CONCAT_WS('-',
                    			SUBSTR(HEX(IFNULL(sikd_sub_skpd.`id_sikd_sub_skpd`, sikd_satker.`id_sikd_satker`)), 1, 8),
                    			SUBSTR(HEX(IFNULL(sikd_sub_skpd.`id_sikd_sub_skpd`, sikd_satker.`id_sikd_satker`)), 9, 4),
                    			SUBSTR(HEX(IFNULL(sikd_sub_skpd.`id_sikd_sub_skpd`, sikd_satker.`id_sikd_satker`)), 13, 4),
                    			SUBSTR(HEX(IFNULL(sikd_sub_skpd.`id_sikd_sub_skpd`, sikd_satker.`id_sikd_satker`)), 17, 4),
                    			SUBSTR(HEX(IFNULL(sikd_sub_skpd.`id_sikd_sub_skpd`, sikd_satker.`id_sikd_satker`)), 21)
                    				) AS sikd_satker_id_sikd_satker,
                         concat(sikd_urusan.`kd_urusan`, '.', substr(sikd_bidang.`kd_bidang`,3,2), '.',
                         	IFNULL(sikd_sub_skpd.`kode`, sikd_satker.`kode`)) AS sikd_satker_kode,
                         IFNULL(sikd_sub_skpd.`nama`, sikd_satker.`nama`) AS sikd_satker_nama,
                         CONCAT_WS('-',
                    			SUBSTR(HEX(sikd_urusan.`id_sikd_urusan`), 1, 8),
                    			SUBSTR(HEX(sikd_urusan.`id_sikd_urusan`), 9, 4),
                    			SUBSTR(HEX(sikd_urusan.`id_sikd_urusan`), 13, 4),
                    			SUBSTR(HEX(sikd_urusan.`id_sikd_urusan`), 17, 4),
                    			SUBSTR(HEX(sikd_urusan.`id_sikd_urusan`), 21)
                    				) AS sikd_urusan_id_sikd_urusan,
                         sikd_urusan.`kd_urusan` AS sikd_urusan_kd_urusan,
                         sikd_urusan.`nm_urusan` AS sikd_urusan_nm_urusan,
                         CONCAT_WS('-',
                    			SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 1, 8),
                    			SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 9, 4),
                    			SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 13, 4),
                    			SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 17, 4),
                    			SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 21)
                    				) AS sikd_bidang_id_sikd_bidang,
                         concat(sikd_urusan.`kd_urusan`, '.', substr(sikd_bidang.`kd_bidang`,3,2)) AS sikd_bidang_kd_bidang,
                         sikd_bidang.`nm_bidang` AS sikd_bidang_nm_bidang,
                         0 AS jml_plafon,
                         SUM(IF(:status='0', ppas_anggaran.`jml_usulan`, ppas_anggaran.`jml_final`)) AS jml_plafon_sblm
                    FROM
                         `ppas_ppas` ppas_ppas
                         INNER JOIN `ppas_anggaran` ppas_anggaran ON ppas_anggaran.`ppas_ppas_id` = ppas_ppas.`id_ppas_ppas`
                         INNER JOIN `sikd_kgtn` sikd_kgtn ON ppas_anggaran.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                         INNER JOIN `sikd_bidang` sikd_bidang ON ppas_anggaran.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                         INNER JOIN `sikd_urusan` sikd_urusan ON sikd_bidang.`sikd_urusan_id` = sikd_urusan.`id_sikd_urusan`
                         INNER JOIN `sikd_satker` sikd_satker ON ppas_anggaran.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                         LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON ppas_anggaran.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                    WHERE
                         ppas_ppas.tahun = :tahun
                         AND ppas_ppas.`jns_ppas` = 'PPAS-A'
                    GROUP BY
                         sikd_bidang.`id_sikd_bidang`,
                         sikd_satker.`id_sikd_satker`,
                         sikd_sub_skpd.`id_sikd_sub_skpd`
                    ORDER BY
                         sikd_urusan_kd_urusan,
                         concat(sikd_urusan_kd_urusan, '.', substr(sikd_bidang_kd_bidang,3,2)),
                         sikd_satker_kode
                    ";
            
            
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("idPpas", $idPpas);
            $statement->bindValue("status", $status);
            $statement->bindValue("tahun", $tahun);
            $statement->execute();
            $rekapProyeksi = $statement->fetchAll();
            
            return new JsonResponse($rekapProyeksi);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getPpasLamp4_1BPerubahan($request)
    {
        try {
            $idPpas = $request->query->get("id_ppas");
            $status = $request->query->get("status_ppas");
            $tahun = $request->query->get("tahun");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idPpas = pack('H*', str_replace('-', '', trim($idPpas)));
            $this->connection = $conn->getConnection();
            $sql = "SELECT
                         CONCAT_WS('-',
                    			SUBSTR(HEX(ppas_anggaran.`id_ppas_anggaran`), 1, 8),
                    			SUBSTR(HEX(ppas_anggaran.`id_ppas_anggaran`), 9, 4),
                    			SUBSTR(HEX(ppas_anggaran.`id_ppas_anggaran`), 13, 4),
                    			SUBSTR(HEX(ppas_anggaran.`id_ppas_anggaran`), 17, 4),
                    			SUBSTR(HEX(ppas_anggaran.`id_ppas_anggaran`), 21)
                    				) AS id_ppas_anggaran,
                         IF(ppas_ppas.jns_ppas = 'PPAS-F', 'PPAS Final', 'PPAS Perubahan') AS jns_ppas,
                         IF(ppas_ppas.status_ppas = '0','Draft','') AS status_ppas,
                         ppas_ppas.no_dokumen_pemda AS ppas_ppas_no_dokumen,
                         date_format(ppas_ppas.tgl_pengesahan_pemda,'%d-%m-%Y') AS ppas_ppas_tgl_pengesahan,
                         CONCAT_WS('-',
                    			SUBSTR(HEX(IFNULL(sikd_sub_skpd.`id_sikd_sub_skpd`, sikd_satker.`id_sikd_satker`)), 1, 8),
                    			SUBSTR(HEX(IFNULL(sikd_sub_skpd.`id_sikd_sub_skpd`, sikd_satker.`id_sikd_satker`)), 9, 4),
                    			SUBSTR(HEX(IFNULL(sikd_sub_skpd.`id_sikd_sub_skpd`, sikd_satker.`id_sikd_satker`)), 13, 4),
                    			SUBSTR(HEX(IFNULL(sikd_sub_skpd.`id_sikd_sub_skpd`, sikd_satker.`id_sikd_satker`)), 17, 4),
                    			SUBSTR(HEX(IFNULL(sikd_sub_skpd.`id_sikd_sub_skpd`, sikd_satker.`id_sikd_satker`)), 21)
                    				) AS sikd_satker_id_sikd_satker,
                         IFNULL(sikd_sub_skpd.`kode`, sikd_satker.`kode`) AS sikd_satker_kode,
                         IFNULL(sikd_sub_skpd.`nama`, sikd_satker.`nama`) AS sikd_satker_nama,
                         SUM(IF(sikd_urusan.`kd_urusan` = '0', IF(:status='0', ppas_anggaran.`jml_usulan`, ppas_anggaran.`jml_final`), 0)) AS jml_plafon_non_urusan,
                         SUM(IF(sikd_urusan.`kd_urusan` != '0', IF(:status='0', ppas_anggaran.`jml_usulan`, ppas_anggaran.`jml_final`), 0)) AS jml_plafon_urusan,
                    	SUM(IF(:status='0', ppas_anggaran.`jml_usulan`, ppas_anggaran.`jml_final`)) AS jml_plafon
                    FROM
                         `ppas_ppas` ppas_ppas
                         INNER JOIN `ppas_anggaran` ppas_anggaran ON ppas_anggaran.`ppas_ppas_id` = ppas_ppas.`id_ppas_ppas`
                         INNER JOIN `sikd_kgtn` sikd_kgtn ON ppas_anggaran.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                         INNER JOIN `sikd_prog` sikd_prog ON sikd_kgtn.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                         INNER JOIN `sikd_bidang` sikd_bidang ON sikd_prog.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                         INNER JOIN `sikd_urusan` sikd_urusan ON sikd_bidang.`sikd_urusan_id` = sikd_urusan.`id_sikd_urusan`
                         INNER JOIN `sikd_satker` sikd_satker ON ppas_anggaran.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                         LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON ppas_anggaran.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                    WHERE
                         ppas_anggaran.`ppas_ppas_id` = :idPpas
                    GROUP BY
                         sikd_satker.`id_sikd_satker`,
                         sikd_sub_skpd.`id_sikd_sub_skpd`
                    ORDER BY
                         sikd_satker.`kode`, sikd_sub_skpd.`kode`
                    ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("idPpas", $idPpas);
            $statement->bindValue("status", $status);
            $statement->bindValue("tahun", $tahun);
            $statement->execute();
            $rekapProyeksi = $statement->fetchAll();
            
            return new JsonResponse($rekapProyeksi);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getPpasLamp4_2Perubahan($request)
    {
        try {
            $idPpas = $request->query->get("id_ppas");
            $status = $request->query->get("status_ppas");
            $tahun = $request->query->get("tahun");
            $idSubUnit = $request->query->get("id_sub_unit");
            $idSatker = $request->query->get("id_satker");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idPpas = pack('H*', str_replace('-', '', trim($idPpas)));
            if ($idSubUnit != ''){
                $idSubUnit = pack('H*', str_replace('-', '', trim($idSubUnit)));
            } else {
                $idSubUnit = '';
            }
            $idSatker = pack('H*', str_replace('-', '', trim($idSatker)));
            $this->connection = $conn->getConnection();
            $sql = "SELECT
                         CONCAT_WS('-',
                    			SUBSTR(HEX(ppas_anggaran.`id_ppas_anggaran`), 1, 8),
                    			SUBSTR(HEX(ppas_anggaran.`id_ppas_anggaran`), 9, 4),
                    			SUBSTR(HEX(ppas_anggaran.`id_ppas_anggaran`), 13, 4),
                    			SUBSTR(HEX(ppas_anggaran.`id_ppas_anggaran`), 17, 4),
                    			SUBSTR(HEX(ppas_anggaran.`id_ppas_anggaran`), 21)
                    				) AS id_ppas_anggaran,
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
                         sikd_bidang_induk.kd_bidang AS sikd_bidang_induk_kd_bidang,
                         sikd_bidang_induk.nm_bidang AS sikd_bidang_induk_nm_bidang,
                         CONCAT_WS('-',
                    			SUBSTR(HEX(sikd_urusan.`id_sikd_urusan`), 1, 8),
                    			SUBSTR(HEX(sikd_urusan.`id_sikd_urusan`), 9, 4),
                    			SUBSTR(HEX(sikd_urusan.`id_sikd_urusan`), 13, 4),
                    			SUBSTR(HEX(sikd_urusan.`id_sikd_urusan`), 17, 4),
                    			SUBSTR(HEX(sikd_urusan.`id_sikd_urusan`), 21)
                    				) AS sikd_urusan_id_sikd_urusan,
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
                    			SUBSTR(HEX(sikd_prog.`id_sikd_prog`), 1, 8),
                    			SUBSTR(HEX(sikd_prog.`id_sikd_prog`), 9, 4),
                    			SUBSTR(HEX(sikd_prog.`id_sikd_prog`), 13, 4),
                    			SUBSTR(HEX(sikd_prog.`id_sikd_prog`), 17, 4),
                    			SUBSTR(HEX(sikd_prog.`id_sikd_prog`), 21)
                    				) AS sikd_prog_id_sikd_prog,
                         concat(sikd_bidang.`kd_bidang`, '.', sikd_prog.`kd_prog`) AS sikd_prog_kd_prog,
                         sikd_prog.`nm_prog` AS sikd_prog_nm_prog,
                         CONCAT_WS('-',
                    			SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 1, 8),
                    			SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 9, 4),
                    			SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 13, 4),
                    			SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 17, 4),
                    			SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 21)
                    				) AS sikd_kgtn_id_sikd_kgtn,
                         concat(sikd_bidang.`kd_bidang`, '.', sikd_prog.`kd_prog`, '.',substr(sikd_kgtn.`kd_kgtn`,3,3))  AS sikd_kgtn_kd_kgtn,
                         sikd_kgtn.`nm_kgtn` AS sikd_kgtn_nm_kgtn,
                         ppas_anggaran.`nm_subkegiatan` AS ppas_blnj_langsung_nm_subkegiatan,
                         ppas_anggaran.`sasaran_kgtn` AS ppas_blnj_langsung_sasaran,
                         ppas_anggaran.`target_kgtn` AS ppas_blnj_langsung_target,
                         IF(:status='0', ppas_anggaran.`jml_usulan`, ppas_anggaran.`jml_final`) AS jml_plafon,
                    	 IFNULL(ppas_sblm_prbhn.jml_plafon_sblm,0) AS jml_plafon_sblm
                    FROM
                         `ppas_ppas` ppas_ppas
                         INNER JOIN `ppas_anggaran` ppas_anggaran ON ppas_anggaran.`ppas_ppas_id` = ppas_ppas.`id_ppas_ppas`
                         INNER JOIN `sikd_kgtn` sikd_kgtn ON ppas_anggaran.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                         INNER JOIN `sikd_bidang` sikd_bidang ON ppas_anggaran.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                         INNER JOIN `sikd_urusan` sikd_urusan ON sikd_bidang.`sikd_urusan_id` = sikd_urusan.`id_sikd_urusan`
                         INNER JOIN `sikd_prog` sikd_prog ON sikd_kgtn.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                         INNER JOIN `sikd_satker` sikd_satker ON ppas_anggaran.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                         INNER JOIN `sikd_bidang` sikd_bidang_induk ON sikd_satker.`kd_bidang_induk` = sikd_bidang_induk.`kd_bidang`
                         LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON ppas_anggaran.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                    	 LEFT OUTER JOIN
                    		(select b.kd_kegiatan, IF(:status='0', b.`jml_usulan`, b.`jml_final`) AS jml_plafon_sblm
                    		 from ppas_ppas a, ppas_anggaran b,
                    		 where a.id_ppas_ppas = b.ppas_ppas_id
                    		 and a.tahun = :tahun
                    		 and a.jns_ppas = 'PPAS-A'
                    		 AND IF(:idSatker != '', b.sikd_satker_id = :idSatker, 1)
                    		 AND IF(:idSatker != '', b.sikd_sub_skpd_id LIKE :idSubUnit, 1)) ppas_sblm_prbhn
                    		 ON ppas_anggaran.kd_kegiatan = ppas_sblm_prbhn.kd_kegiatan
                    WHERE
                         ppas_ppas.tahun = :tahun
                         AND ppas_anggaran.`ppas_ppas_id` LIKE :idPpas
                         AND IF(:idSatker != '', ppas_anggaran.sikd_satker_id = :idSatker, 1)
                         AND IF(:idSatker != '', ppas_anggaran.sikd_sub_skpd_id LIKE :idSubUnit, 1)
                    ORDER BY
                         sikd_satker.kode, sikd_sub_skpd.kode,
                         sikd_urusan.kd_urusan, sikd_bidang.kd_bidang,
                         sikd_prog.kd_prog, sikd_kgtn.kd_kgtn
                    ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("idPpas", $idPpas);
            $statement->bindValue("status", $status);
            $statement->bindValue("tahun", $tahun);
            $statement->bindValue("idSatker", $idSubUnit);
            $statement->bindValue("idSubUnit", $idSubUnit);
            $statement->execute();
            $rekapProyeksi = $statement->fetchAll();
            
            return new JsonResponse($rekapProyeksi);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getPpasLamp4_3Perubahan($request)
    {
        try {
            $idPpas = $request->query->get("id_ppas");
            $status = $request->query->get("status_ppas");
            $tahun = $request->query->get("tahun");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idPpas = pack('H*', str_replace('-', '', trim($idPpas)));
            $this->connection = $conn->getConnection();
            $sql = "SELECT
                         CONCAT_WS('-',
                    			SUBSTR(HEX(ppas_anggaran.`ppas_ppas_id`), 1, 8),
                    			SUBSTR(HEX(ppas_anggaran.`ppas_ppas_id`), 9, 4),
                    			SUBSTR(HEX(ppas_anggaran.`ppas_ppas_id`), 13, 4),
                    			SUBSTR(HEX(ppas_anggaran.`ppas_ppas_id`), 17, 4),
                    			SUBSTR(HEX(ppas_anggaran.`ppas_ppas_id`), 21)
                    				) AS ppas_satker_ppas_ppas_id,
                         CONCAT_WS('-',
                    			SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 1, 8),
                    			SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 9, 4),
                    			SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 13, 4),
                    			SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 17, 4),
                    			SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 21)
                    				) AS sikd_rek_jenis_id_sikd_rek_jenis,
                         sikd_rek_jenis.`kd_rek_jenis` AS sikd_rek_jenis_kd_rek_jenis,
                         sikd_rek_jenis.`nm_rek_jenis` AS sikd_rek_jenis_nm_rek_jenis,
                         SUM(IF(:status='0', ppas_mata_anggaran.`jml_usulan`, ppas_mata_anggaran.`jml_final`)) AS jml_plafon,
                         0 AS jml_plafon_sblm
                    FROM
                         `ppas_ppas` ppas_ppas
                         INNER JOIN `ppas_anggaran` ppas_anggaran ON ppas_anggaran.`ppas_ppas_id` = ppas_ppas.`id_ppas_ppas`
                    	 INNER JOIN `ppas_mata_anggaran` ppas_mata_anggaran ON ppas_anggaran.id_ppas_anggaran = ppas_mata_anggaran.ppas_anggaran_id
                         INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON ppas_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                         INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                         INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                         INNER JOIN `sikd_rek_kelompok` sikd_rek_kelompok ON sikd_rek_jenis.`sikd_rek_kelompok_id` = sikd_rek_kelompok.`id_sikd_rek_kelompok`
                    WHERE
                         ppas_ppas.tahun = :tahun
                         AND ppas_anggaran.`ppas_ppas_id` = :idPpas
                    GROUP BY
                         sikd_rek_jenis.`id_sikd_rek_jenis`
                    UNION
                    SELECT
                         CONCAT_WS('-',
                    			SUBSTR(HEX(ppas_anggaran.`ppas_ppas_id`), 1, 8),
                    			SUBSTR(HEX(ppas_anggaran.`ppas_ppas_id`), 9, 4),
                    			SUBSTR(HEX(ppas_anggaran.`ppas_ppas_id`), 13, 4),
                    			SUBSTR(HEX(ppas_anggaran.`ppas_ppas_id`), 17, 4),
                    			SUBSTR(HEX(ppas_anggaran.`ppas_ppas_id`), 21)
                    				) AS ppas_satker_ppas_ppas_id,
                         CONCAT_WS('-',
                    			SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 1, 8),
                    			SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 9, 4),
                    			SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 13, 4),
                    			SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 17, 4),
                    			SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 21)
                    				) AS sikd_rek_jenis_id_sikd_rek_jenis,
                         sikd_rek_jenis.`kd_rek_jenis` AS sikd_rek_jenis_kd_rek_jenis,
                         sikd_rek_jenis.`nm_rek_jenis` AS sikd_rek_jenis_nm_rek_jenis,
                         0 AS jml_plafon,
                         SUM(IF(:status='0', ppas_mata_anggaran.`jml_usulan`, ppas_mata_anggaran.`jml_final`)) AS jml_plafon_sblm
                    FROM
                         `ppas_ppas` ppas_ppas
                         INNER JOIN `ppas_anggaran` ppas_anggaran ON ppas_anggaran.`ppas_ppas_id` = ppas_ppas.`id_ppas_ppas`
                    	 INNER JOIN `ppas_mata_anggaran` ppas_mata_anggaran ON ppas_anggaran.id_ppas_anggaran = ppas_mata_anggaran.ppas_anggaran_id
                         INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON ppas_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                         INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                         INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                         INNER JOIN `sikd_rek_kelompok` sikd_rek_kelompok ON sikd_rek_jenis.`sikd_rek_kelompok_id` = sikd_rek_kelompok.`id_sikd_rek_kelompok`
                    WHERE
                         ppas_ppas.tahun = :tahun
                         AND ppas_ppas.`jns_ppas` = 'PPAS-A'
                    GROUP BY
                         sikd_rek_jenis.`id_sikd_rek_jenis`
                    ORDER BY
                         sikd_rek_jenis_kd_rek_jenis ASC
                    ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("idPpas", $idPpas);
            $statement->bindValue("status", $status);
            $statement->bindValue("tahun", $tahun);
            $statement->execute();
            $rekapProyeksi = $statement->fetchAll();
            
            return new JsonResponse($rekapProyeksi);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getPpasLamp5Perubahan($request)
    {
        try {
            $idPpas = $request->query->get("id_ppas");
            $status = $request->query->get("status_ppas");
            $tahun = $request->query->get("tahun");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idPpas = pack('H*', str_replace('-', '', trim($idPpas)));
            $this->connection = $conn->getConnection();
            $sql = "SELECT
                         CONCAT_WS('-',
                    			SUBSTR(HEX(ppas_anggaran.`ppas_ppas_id`), 1, 8),
                    			SUBSTR(HEX(ppas_anggaran.`ppas_ppas_id`), 9, 4),
                    			SUBSTR(HEX(ppas_anggaran.`ppas_ppas_id`), 13, 4),
                    			SUBSTR(HEX(ppas_anggaran.`ppas_ppas_id`), 17, 4),
                    			SUBSTR(HEX(ppas_anggaran.`ppas_ppas_id`), 21)
                    				) AS ppas_anggaran_ppas_ppas_id,
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
                         SUM(IF(:status='0', ppas_mata_anggaran.`jml_usulan`, ppas_mata_anggaran.`jml_final`)) AS jml_plafon,
                         SUM(IF(sikd_rek_kelompok.kd_rek_kelompok='61',1,-1)*IF(:status='0', ppas_mata_anggaran.`jml_usulan`, ppas_mata_anggaran.`jml_final`)) AS jml_netto,
                         0 AS jml_plafon_sblm,
                         0 AS jml_netto_sblm
                    FROM
                         `ppas_ppas` ppas_ppas
                         INNER JOIN `ppas_anggaran` ppas_anggaran ON ppas_anggaran.`ppas_ppas_id` = ppas_ppas.`id_ppas_ppas`
                    	 INNER JOIN `ppas_pembiayaan` ppas_pembiayaan ON ppas_anggaran.`id_ppas_anggaran` = ppas_pembiayaan.`id_ppas_pembiayaan`
                         INNER JOIN `ppas_mata_anggaran` ppas_mata_anggaran ON ppas_anggaran.`id_ppas_anggaran` = ppas_mata_anggaran.`ppas_anggaran_id`
                         INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON ppas_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                         INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                         INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                         INNER JOIN `sikd_rek_kelompok` sikd_rek_kelompok ON sikd_rek_jenis.`sikd_rek_kelompok_id` = sikd_rek_kelompok.`id_sikd_rek_kelompok`
                    WHERE
                         ppas_ppas.tahun = :tahun
                         AND sikd_rek_kelompok.kd_rek_kelompok IN ('61','62')
                         AND ppas_anggaran.`ppas_ppas_id` = :idPpas
                    GROUP BY
                         sikd_rek_jenis.`id_sikd_rek_jenis`
                    UNION
                    SELECT
                         CONCAT_WS('-',
                    			SUBSTR(HEX(ppas_anggaran.`ppas_ppas_id`), 1, 8),
                    			SUBSTR(HEX(ppas_anggaran.`ppas_ppas_id`), 9, 4),
                    			SUBSTR(HEX(ppas_anggaran.`ppas_ppas_id`), 13, 4),
                    			SUBSTR(HEX(ppas_anggaran.`ppas_ppas_id`), 17, 4),
                    			SUBSTR(HEX(ppas_anggaran.`ppas_ppas_id`), 21)
                    				) AS ppas_anggaran_ppas_ppas_id,
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
                    	 0 AS jml_plafon,
                    	 0 AS jml_netto,
                         SUM(IF(:status='0', ppas_mata_anggaran.`jml_usulan`, ppas_mata_anggaran.`jml_final`)) AS jml_plafon_sblm,
                         SUM(IF(sikd_rek_kelompok.kd_rek_kelompok='61',1,-1)*IF(:status='0', ppas_mata_anggaran.`jml_usulan`, ppas_mata_anggaran.`jml_final`)) AS jml_netto_sblm
                    FROM
                         `ppas_ppas` ppas_ppas
                         INNER JOIN `ppas_anggaran` ppas_anggaran ON ppas_anggaran.`ppas_ppas_id` = ppas_ppas.`id_ppas_ppas`
                    	 INNER JOIN `ppas_pembiayaan` ppas_pembiayaan ON ppas_anggaran.`id_ppas_anggaran` = ppas_pembiayaan.`id_ppas_pembiayaan`
                         INNER JOIN `ppas_mata_anggaran` ppas_mata_anggaran ON ppas_anggaran.`id_ppas_anggaran` = ppas_mata_anggaran.`ppas_anggaran_id`
                         INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON ppas_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                         INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                         INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                         INNER JOIN `sikd_rek_kelompok` sikd_rek_kelompok ON sikd_rek_jenis.`sikd_rek_kelompok_id` = sikd_rek_kelompok.`id_sikd_rek_kelompok`
                    WHERE
                         ppas_ppas.tahun = :tahun
                         AND ppas_ppas.`jns_ppas` = 'PPAS-A'
                    	 AND sikd_rek_kelompok.kd_rek_kelompok IN ('61','62')
                         AND ppas_anggaran.`ppas_ppas_id` = :idPpas
                    GROUP BY
                         sikd_rek_jenis.`id_sikd_rek_jenis`
                    ORDER BY
                         sikd_rek_jenis_kd_rek_jenis
                    ";
            
            
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("idPpas", $idPpas);
            $statement->bindValue("status", $status);
            $statement->bindValue("tahun", $tahun);
            $statement->execute();
            $rekapProyeksi = $statement->fetchAll();
            
            return new JsonResponse($rekapProyeksi);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getPpasLamp6Perubahan($request)
    {
        try {
            $idPpas = $request->query->get("id_ppas");
            $status = $request->query->get("status_ppas");
            $tahun = $request->query->get("tahun");
            $tahun = $request->query->get("kd_rek");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idPpas = pack('H*', str_replace('-', '', trim($idPpas)));
            $this->connection = $conn->getConnection();
            $sql = "SELECT
                             CONCAT_WS('-',
                        			SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 1, 8),
                        			SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 9, 4),
                        			SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 13, 4),
                        			SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 17, 4),
                        			SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 21)
                        				) AS ppas_ppas_id_ppas_ppas,
                             ppas_ppas.`tahun` AS ppas_ppas_tahun,
                        	 ppas_pnrm_hibah_bansos.`no_urut` AS ppas_pnrm_hibah_bansos_no_urut,
                             ppas_pnrm_hibah_bansos.`nm_penerima` AS ppas_pnrm_hibah_bansos_nm_penerima,
                             ppas_pnrm_hibah_bansos.`alamat_penerima` AS ppas_pnrm_hibah_bansos_alamat_penerima,
                             CONCAT_WS('-',
                        			SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 1, 8),
                        			SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 9, 4),
                        			SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 13, 4),
                        			SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 17, 4),
                        			SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 21)
                        				) AS sikd_rek_rincian_obj_id_sikd_rek_rincian_obj,
                             sikd_rek_rincian_obj.`kd_rek_rincian_obj` AS sikd_rek_rincian_obj_kd_rek_rincian_obj,
                             sikd_rek_rincian_obj.`nm_rek_rincian_obj` AS sikd_rek_rincian_obj_nm_rek_rincian_obj,
                             (IF(:status='0', ppas_pnrm_hibah_bansos.`jml_usulan`, ppas_pnrm_hibah_bansos.`jml_final`)) AS jml_plafon,
                             0 AS jml_plafon_sblm
                        FROM
                             `ppas_pnrm_hibah_bansos` ppas_pnrm_hibah_bansos
                        	 INNER JOIN `ppas_ppas` ppas_ppas ON ppas_pnrm_hibah_bansos.`ppas_ppas_id` = ppas_ppas.`id_ppas_ppas`
                             INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON ppas_pnrm_hibah_bansos.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                        WHERE
                             ppas_ppas.tahun = :tahun
                             AND ppas_ppas.id_ppas_ppas = :idPpas
                             AND SUBSTR(ppas_pnrm_hibah_bansos.kd_rekening,1,3) = :kdRek
                        UNION
                        SELECT
                             CONCAT_WS('-',
                        			SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 1, 8),
                        			SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 9, 4),
                        			SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 13, 4),
                        			SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 17, 4),
                        			SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 21)
                        				) AS ppas_ppas_id_ppas_ppas,
                             ppas_ppas.`tahun` AS ppas_ppas_tahun,
                             ppas_pnrm_hibah_bansos.`no_urut` AS ppas_pnrm_hibah_bansos_no_urut,
                             ppas_pnrm_hibah_bansos.`nm_penerima` AS ppas_pnrm_hibah_bansos_nm_penerima,
                             ppas_pnrm_hibah_bansos.`alamat_penerima` AS ppas_pnrm_hibah_bansos_alamat_penerima,
                             CONCAT_WS('-',
                        			SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 1, 8),
                        			SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 9, 4),
                        			SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 13, 4),
                        			SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 17, 4),
                        			SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 21)
                        				) AS sikd_rek_rincian_obj_id_sikd_rek_rincian_obj,
                             sikd_rek_rincian_obj.`kd_rek_rincian_obj` AS sikd_rek_rincian_obj_kd_rek_rincian_obj,
                             sikd_rek_rincian_obj.`nm_rek_rincian_obj` AS sikd_rek_rincian_obj_nm_rek_rincian_obj,
                             0 AS jml_plafon,
                             (IF(:status='0', ppas_pnrm_hibah_bansos.`jml_usulan`, ppas_pnrm_hibah_bansos.`jml_final`)) AS jml_plafon_sblm
                        FROM
                             `ppas_pnrm_hibah_bansos` ppas_pnrm_hibah_bansos
                        	 INNER JOIN `ppas_ppas` ppas_ppas ON ppas_pnrm_hibah_bansos.`ppas_ppas_id` = ppas_ppas.`id_ppas_ppas`
                             INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON ppas_pnrm_hibah_bansos.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                        WHERE
                             ppas_ppas.tahun = :tahun
                             AND ppas_ppas.`jns_ppas` = 'PPAS-A'
                             AND SUBSTR(ppas_pnrm_hibah_bansos.kd_rekening,1,3) = :kdRek
                        ORDER BY
                             sikd_rek_rincian_obj_id_sikd_rek_rincian_obj, ppas_pnrm_hibah_bansos_no_urut ASC
                    ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("idPpas", $idPpas);
            $statement->bindValue("status", $status);
            $statement->bindValue("tahun", $tahun);
            $statement->bindValue("kdRek", $kdRek);
            $statement->execute();
            $rekapProyeksi = $statement->fetchAll();
            
            return new JsonResponse($rekapProyeksi);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getPpasLamp2_1($request)
    {
        try {
            $idPpas = $request->query->get("id_ppas");
            $status = $request->query->get("status_ppas");
            $tahun = $request->query->get("tahun");
            
            $idPpas = $this->convertOuuidToUuid($idPpas);
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                        CONCAT_WS('-',
                            SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 1, 8),
                            SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 9, 4),
                            SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 13, 4),
                            SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 17, 4),
                            SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 21)
                            ) AS id_ppas_ppas,
                        sikd_rek_akun.kd_rek_akun AS ppas_pendapatan_akun,
                        IF(sikd_rek_akun.kd_rek_akun = '4', 'Pendapatan Daerah', 'Penerimaan Pembiayaan') AS ppas_pendapatan_nm_akun,
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
                        SUM(IF(:status='0', ppas_mata_anggaran.`jml_usulan`, ppas_mata_anggaran.`jml_final`)) AS ppas_pendapatan_jml_plafon
                    FROM
                        `ppas_ppas` ppas_ppas
                        INNER JOIN `ppas_anggaran` ppas_anggaran ON ppas_anggaran.`ppas_ppas_id` = ppas_ppas.`id_ppas_ppas`
                        INNER JOIN `ppas_mata_anggaran` ppas_mata_anggaran ON ppas_anggaran.`id_ppas_anggaran` = ppas_mata_anggaran.`ppas_anggaran_id`
                        INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON ppas_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                        INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                        INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                        INNER JOIN `sikd_rek_kelompok` sikd_rek_kelompok ON sikd_rek_jenis.`sikd_rek_kelompok_id` = sikd_rek_kelompok.`id_sikd_rek_kelompok`
                        LEFT OUTER JOIN `sikd_rek_akun` sikd_rek_akun ON sikd_rek_kelompok.`sikd_rek_akun_id` = sikd_rek_akun.`id_sikd_rek_akun`
                    WHERE
                        ppas_ppas.`id_ppas_ppas` = :idPpas
                        AND (sikd_rek_akun.kd_rek_akun = '4'
                        OR sikd_rek_kelompok.kd_rek_kelompok = '61')
                    GROUP BY
                        sikd_rek_jenis.`kd_rek_jenis`
                    ORDER BY
                        sikd_rek_jenis.`kd_rek_jenis`
                    ";
            
            
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("idPpas", $idPpas);
            $statement->bindValue("status", $status);
            $statement->execute();
            $rekapProyeksi = $statement->fetchAll();
            
            return new JsonResponse($rekapProyeksi);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getPpasLamp2_1Rinci($request)
    {
        try {
            $idPpas = $request->query->get("id_ppas");
            $status = $request->query->get("status_ppas");
            $tahun = $request->query->get("tahun");
            
            $idPpas = $this->convertOuuidToUuid($idPpas);
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                        CONCAT_WS('-',
                            SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 1, 8),
                            SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 9, 4),
                            SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 13, 4),
                            SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 17, 4),
                            SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 21)
                                ) AS id_ppas_ppas,
                        sikd_rek_akun.kd_rek_akun AS ppas_pendapatan_akun,
                        IF(sikd_rek_akun.kd_rek_akun = '4', 'Pendapatan Daerah', 'Penerimaan Pembiayaan') AS ppas_pendapatan_nm_akun,
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
                        SUM(IF(:status='0', ppas_mata_anggaran.`jml_usulan`, ppas_mata_anggaran.`jml_final`)) AS ppas_pendapatan_jml_plafon
                    FROM
                        `ppas_ppas` ppas_ppas
                        INNER JOIN `ppas_anggaran` ppas_anggaran ON ppas_anggaran.`ppas_ppas_id` = ppas_ppas.`id_ppas_ppas`
                        INNER JOIN `ppas_mata_anggaran` ppas_mata_anggaran ON ppas_anggaran.`id_ppas_anggaran` = ppas_mata_anggaran.`ppas_anggaran_id`
                        INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON ppas_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                        INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                        INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                        INNER JOIN `sikd_rek_kelompok` sikd_rek_kelompok ON sikd_rek_jenis.`sikd_rek_kelompok_id` = sikd_rek_kelompok.`id_sikd_rek_kelompok`
                        LEFT OUTER JOIN `sikd_rek_akun` sikd_rek_akun ON sikd_rek_kelompok.`sikd_rek_akun_id` = sikd_rek_akun.`id_sikd_rek_akun`
                    WHERE
                        ppas_ppas.`id_ppas_ppas` = :idPpas
                        AND (sikd_rek_akun.kd_rek_akun = '4'
                        OR sikd_rek_kelompok.kd_rek_kelompok = '61')
                    GROUP BY
                        sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                    ORDER BY
                        sikd_rek_rincian_obj.`kd_rek_rincian_obj`
                    ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("idPpas", $idPpas);
            $statement->bindValue("status", $status);
            $statement->execute();
            $rekapProyeksi = $statement->fetchAll();
            
            return new JsonResponse($rekapProyeksi);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }

    private function getPpasLamp3_1($request){
        try {
            $tahun = $request->query->get("tahun");
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $this->connection = $conn->getConnection();
            $sql = "SELECT
                        CONCAT_WS('-',
                        SUBSTR(HEX(rkpd_prioritas_kab.`id_rkpd_prioritas_kab`), 1, 8),
                        SUBSTR(HEX(rkpd_prioritas_kab.`id_rkpd_prioritas_kab`), 9, 4),
                        SUBSTR(HEX(rkpd_prioritas_kab.`id_rkpd_prioritas_kab`), 13, 4),
                        SUBSTR(HEX(rkpd_prioritas_kab.`id_rkpd_prioritas_kab`), 17, 4),
                        SUBSTR(HEX(rkpd_prioritas_kab.`id_rkpd_prioritas_kab`), 21)
                            ) AS rkpd_prioritas_kab_id_rkpd_prioritas_kab,
                        CONCAT_WS('-',
                        SUBSTR(HEX(rkpd_sasaran.`id_rkpd_sasaran`), 1, 8),
                        SUBSTR(HEX(rkpd_sasaran.`id_rkpd_sasaran`), 9, 4),
                        SUBSTR(HEX(rkpd_sasaran.`id_rkpd_sasaran`), 13, 4),
                        SUBSTR(HEX(rkpd_sasaran.`id_rkpd_sasaran`), 17, 4),
                        SUBSTR(HEX(rkpd_sasaran.`id_rkpd_sasaran`), 21)
                            ) AS rkpd_sasaran_id_rkpd_sasaran,
                        rkpd_prioritas_kab.`tahun` AS rkpd_prioritas_kab_tahun,
                        rkpd_prioritas_kab.`no_prioritas` AS rkpd_prioritas_kab_no_prioritas,
                        rkpd_prioritas_kab.`bidang_prioritas` AS rkpd_prioritas_kab_bidang_prioritas,
                        rkpd_prioritas_kab.`nm_program` AS rkpd_prioritas_kab_nm_program,
                        rkpd_sasaran.`no_sasaran` AS rkpd_sasaran_no_sasaran,
                        rkpd_sasaran.`uraian_sasaran` AS rkpd_sasaran_uraian_sasaran
                    FROM
                        #`rkpd_prioritas` rkpd_prioritas 
                        #INNER JOIN `rkpd_prioritas_kab` rkpd_prioritas_kab ON rkpd_prioritas.`id_rkpd_prioritas` = rkpd_prioritas_kab.`id_rkpd_prioritas_kab`
                        `rkpd_prioritas_kab` rkpd_prioritas_kab
                        LEFT OUTER JOIN `rkpd_sasaran` rkpd_sasaran ON rkpd_sasaran.`rkpd_prioritas_kab_id` = rkpd_prioritas_kab.`id_rkpd_prioritas_kab`
                    WHERE
                        rkpd_prioritas_kab.tahun = :tahun
                    ORDER BY
                        rkpd_prioritas_kab.no_prioritas, 
                        rkpd_sasaran.no_sasaran;
                    ";
            
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("tahun", $tahun);
            $statement->execute();
            $rekapProyeksi = $statement->fetchAll();
            
            return new JsonResponse($rekapProyeksi);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }


    private function getPpasLamp3_1_Sub2($request){
        try {
            $id_ppas = $request->query->get("id_ppas");
            //$id_ppas = pack('H*', str_replace('-', '', trim($id_ppas)));
            $id_ppas = $this->convertOuuidToUuid($id_ppas);

            $id_rkpd_sasaran = $request->query->get("id_rkpd_sasaran");
            $id_rkpd_sasaran = pack('H*', str_replace('-', '', trim($id_rkpd_sasaran)));
            //$id_rkpd_sasaran = $this->convertOuuidToUuid($id_rkpd_sasaran);
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $this->connection = $conn->getConnection();
            $sql = "SELECT DISTINCT
                        concat(sikd_bidang.kd_bidang,'.',sikd_prog.kd_prog) AS kd_prog, sikd_prog.nm_prog AS nm_prog,
                        CONCAT_WS('-',
                        SUBSTR(HEX(rkpd_sasaran_program.rkpd_sasaran_id), 1, 8),
                        SUBSTR(HEX(rkpd_sasaran_program.rkpd_sasaran_id), 9, 4),
                        SUBSTR(HEX(rkpd_sasaran_program.rkpd_sasaran_id), 13, 4),
                        SUBSTR(HEX(rkpd_sasaran_program.rkpd_sasaran_id), 17, 4),
                        SUBSTR(HEX(rkpd_sasaran_program.rkpd_sasaran_id), 21)
                            ) AS id_rkpd_sasaran
                    FROM
                        `ppas_ppas` ppas_ppas 
                        INNER JOIN `ppas_anggaran` ppas_anggaran ON ppas_anggaran.`ppas_ppas_id` = ppas_ppas.`id_ppas_ppas`
                        INNER JOIN `sikd_satker` sikd_satker ON ppas_anggaran.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                        LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON ppas_anggaran.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                        #INNER JOIN `ppas_anggaran` ppas_anggaran ON ppas_anggaran.`id_ppas_anggaran` = ppas_blnj_langsung.`id_ppas_blnj_langsung`
                        INNER JOIN `sikd_kgtn` sikd_kgtn ON ppas_anggaran.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                        INNER JOIN `sikd_bidang` sikd_bidang ON ppas_anggaran.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                        INNER JOIN `sikd_prog` sikd_prog ON sikd_kgtn.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                        INNER JOIN `rkpd_sasaran_program` rkpd_sasaran_program ON sikd_prog.`id_sikd_prog` = rkpd_sasaran_program.`sikd_prog_id`
                    WHERE
                        ppas_ppas.id_ppas_ppas = :id_ppas
                        AND rkpd_sasaran_program.rkpd_sasaran_id = :id_rkpd_sasaran
                    ORDER BY
                        sikd_bidang.kd_bidang, sikd_prog.kd_prog
                    ";
            
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_ppas", $id_ppas);
            $statement->bindValue("id_rkpd_sasaran", $id_rkpd_sasaran);
            $statement->execute();
            $rekapProyeksi = $statement->fetchAll();
            
            return new JsonResponse($rekapProyeksi);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }

    private function getPpasLamp3_1_Sub1($request){
        try {
            $id_ppas = $request->query->get("id_ppas");
            //$id_ppas = pack('H*', str_replace('-', '', trim($id_ppas)));
            $id_ppas = $this->convertOuuidToUuid($id_ppas);

            $id_rkpd_sasaran = $request->query->get("id_rkpd_sasaran");
            $id_rkpd_sasaran = pack('H*', str_replace('-', '', trim($id_rkpd_sasaran)));
            //$id_rkpd_sasaran = $this->convertOuuidToUuid($id_rkpd_sasaran);
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $this->connection = $conn->getConnection();
            $sql = "SELECT
                        GROUP_CONCAT(DISTINCT IFNULL(sikd_sub_skpd.`singkatan`, sikd_satker.`singkatan`)
                        ORDER BY sikd_satker.`singkatan` DESC SEPARATOR ', ') AS sikd_satker_singkatan
                        FROM
                        `ppas_ppas` ppas_ppas 
                        INNER JOIN `ppas_anggaran` ppas_anggaran ON ppas_anggaran.`ppas_ppas_id` = ppas_ppas.`id_ppas_ppas`
                        -- AND ppas_anggaran.ppas_anggaran_type = 'PpasBlnjLangsung'
                        AND ppas_anggaran.ppas_anggaran_type = 'PpasBelanja'
                        INNER JOIN `sikd_satker` sikd_satker ON ppas_anggaran.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                        LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON ppas_anggaran.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                        #INNER JOIN `ppas_blnj_langsung` ppas_blnj_langsung ON ppas_anggaran.`id_ppas_anggaran` = ppas_blnj_langsung.`id_ppas_blnj_langsung`
                        INNER JOIN `sikd_kgtn` sikd_kgtn ON ppas_anggaran.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                        INNER JOIN `sikd_prog` sikd_prog ON sikd_kgtn.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                        INNER JOIN `rkpd_sasaran_program` rkpd_sasaran_program ON sikd_prog.`id_sikd_prog` = rkpd_sasaran_program.`sikd_prog_id`
                    WHERE
                        ppas_ppas.id_ppas_ppas = :id_ppas
                    AND rkpd_sasaran_program.rkpd_sasaran_id = :id_rkpd_sasaran
                    ";
            
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_ppas", $id_ppas);
            $statement->bindValue("id_rkpd_sasaran", $id_rkpd_sasaran);
            $statement->execute();
            $rekapProyeksi = $statement->fetchAll();
            
            return new JsonResponse($rekapProyeksi);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getPpasLamp4_1A($request)
    {
        try {
            $idPpas = $request->query->get("id_ppas");
            $idPpas = $this->convertOuuidToUuid($idPpas);
            $status = $request->query->get("status_ppas");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            //$idPpas = pack('H*', str_replace('-', '', trim($idPpas)));
            $this->connection = $conn->getConnection();
            $sql = "SELECT
                        CONCAT_WS('-',
                        SUBSTR(HEX(ppas_anggaran.`id_ppas_anggaran`), 1, 8),
                        SUBSTR(HEX(ppas_anggaran.`id_ppas_anggaran`), 9, 4),
                        SUBSTR(HEX(ppas_anggaran.`id_ppas_anggaran`), 13, 4),
                        SUBSTR(HEX(ppas_anggaran.`id_ppas_anggaran`), 17, 4),
                        SUBSTR(HEX(ppas_anggaran.`id_ppas_anggaran`), 21)
                        ) AS id_ppas_anggaran,
                        IF(ppas_ppas.jns_ppas = 'PPAS-F', 'PPAS Final', 'PPAS Perubahan') AS jns_ppas,
                        IF(ppas_ppas.status_ppas = '0','Draft','') AS status_ppas, 
                        ppas_ppas.no_dokumen_pemda AS ppas_ppas_no_dokumen,    
                        date_format(ppas_ppas.tgl_pengesahan_pemda,'%d-%m-%Y') AS ppas_ppas_tgl_pengesahan,    
                        IFNULL(sikd_sub_skpd.`id_sikd_sub_skpd`, 
                        CONCAT_WS('-',
                        SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 1, 8),
                        SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 9, 4),
                        SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 13, 4),
                        SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 17, 4),
                        SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 21)
                        )) AS sikd_satker_id_sikd_satker,
                        concat(sikd_urusan.`kd_urusan`, '.', substr(sikd_bidang.`kd_bidang`,3,2), '.',
                        IFNULL(sikd_sub_skpd.`kode`, sikd_satker.`kode`)) AS sikd_satker_kode,
                        IFNULL(sikd_sub_skpd.`nama`, sikd_satker.`nama`) AS sikd_satker_nama,
                        CONCAT_WS('-',
                        SUBSTR(HEX(sikd_urusan.`id_sikd_urusan`), 1, 8),
                        SUBSTR(HEX(sikd_urusan.`id_sikd_urusan`), 9, 4),
                        SUBSTR(HEX(sikd_urusan.`id_sikd_urusan`), 13, 4),
                        SUBSTR(HEX(sikd_urusan.`id_sikd_urusan`), 17, 4),
                        SUBSTR(HEX(sikd_urusan.`id_sikd_urusan`), 21)
                        ) AS sikd_urusan_id_sikd_urusan,
                        sikd_urusan.`kd_urusan` AS sikd_urusan_kd_urusan,
                        sikd_urusan.`nm_urusan` AS sikd_urusan_nm_urusan,
                        CONCAT_WS('-',
                        SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 1, 8),
                        SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 9, 4),
                        SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 13, 4),
                        SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 17, 4),
                        SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 21)
                        ) AS sikd_bidang_id_sikd_bidang,
                        concat(sikd_urusan.`kd_urusan`, '.', substr(sikd_bidang.`kd_bidang`,3,2)) AS sikd_bidang_kd_bidang,
                        sikd_bidang.`nm_bidang` AS sikd_bidang_nm_bidang,
                        SUM(IF(:status='0', ppas_anggaran.`jml_usulan`, ppas_anggaran.`jml_final`)) AS jml_plafon
                    FROM
                        `ppas_ppas` ppas_ppas
                        INNER JOIN `ppas_anggaran` ppas_anggaran ON ppas_anggaran.`ppas_ppas_id` = ppas_ppas.`id_ppas_ppas`
                        #INNER JOIN `ppas_blnj_langsung` ppas_blnj_langsung ON ppas_anggaran.`id_ppas_anggaran` = ppas_blnj_langsung.`id_ppas_blnj_langsung`
                        INNER JOIN `sikd_kgtn` sikd_kgtn ON ppas_anggaran.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                        INNER JOIN `sikd_bidang` sikd_bidang ON ppas_anggaran.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                        INNER JOIN `sikd_urusan` sikd_urusan ON sikd_bidang.`sikd_urusan_id` = sikd_urusan.`id_sikd_urusan`
                        INNER JOIN `sikd_satker` sikd_satker ON ppas_anggaran.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                        LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON ppas_anggaran.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                    WHERE
                        ppas_anggaran.`ppas_ppas_id` = :idPpas
                    GROUP BY
                        sikd_bidang.`id_sikd_bidang`,
                        sikd_satker.`id_sikd_satker`,
                        sikd_sub_skpd.`id_sikd_sub_skpd`
                    ORDER BY
                        sikd_urusan.`kd_urusan`,
                        concat(sikd_urusan.`kd_urusan`, '.', substr(sikd_bidang.`kd_bidang`,3,2)),
                        sikd_satker.`kode`, sikd_sub_skpd.`kode`
                    ";
            
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("idPpas", $idPpas);
            $statement->bindValue("status", $status);
            $statement->execute();
            $rekapProyeksi = $statement->fetchAll();
            
            return new JsonResponse($rekapProyeksi);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getPpasLamp4_1B($request)
    {
        try {
            $idPpas = $request->query->get("id_ppas");
            $idPpas = $this->convertOuuidToUuid($idPpas);
            $status = $request->query->get("status");
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            //$idPpas = pack('H*', str_replace('-', '', trim($idPpas)));
            $this->connection = $conn->getConnection();
            $sql = "SELECT
                         CONCAT_WS('-',
                            SUBSTR(HEX(ppas_anggaran.`id_ppas_anggaran`), 1, 8),
                            SUBSTR(HEX(ppas_anggaran.`id_ppas_anggaran`), 9, 4),
                            SUBSTR(HEX(ppas_anggaran.`id_ppas_anggaran`), 13, 4),
                            SUBSTR(HEX(ppas_anggaran.`id_ppas_anggaran`), 17, 4),
                            SUBSTR(HEX(ppas_anggaran.`id_ppas_anggaran`), 21)
                            ) AS id_ppas_anggaran,
                         IF(ppas_ppas.jns_ppas = 'PPAS-F', 'PPAS Final', 'PPAS Perubahan') AS jns_ppas,
                         IF(ppas_ppas.status_ppas = '0','Draft','') AS status_ppas, 
                         ppas_ppas.no_dokumen_pemda AS ppas_ppas_no_dokumen,    
                         date_format(ppas_ppas.tgl_pengesahan_pemda,'%d-%m-%Y') AS ppas_ppas_tgl_pengesahan,    
                         IFNULL(sikd_sub_skpd.`id_sikd_sub_skpd`, 
                         CONCAT_WS('-',
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 1, 8),
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 9, 4),
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 13, 4),
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 17, 4),
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 21)
                            )) AS sikd_satker_id_sikd_satker,
                         IFNULL(sikd_sub_skpd.`kode`, sikd_satker.`kode`) AS sikd_satker_kode,
                         IFNULL(sikd_sub_skpd.`nama`, sikd_satker.`nama`) AS sikd_satker_nama,
                         SUM(IF(sikd_urusan.`kd_urusan` = '0', IF(:status='0', ppas_anggaran.`jml_usulan`, ppas_anggaran.`jml_final`), 0)) AS jml_plafon_non_urusan,
                         SUM(IF(sikd_urusan.`kd_urusan` != '0', IF(:status='0', ppas_anggaran.`jml_usulan`, ppas_anggaran.`jml_final`), 0)) AS jml_plafon_urusan,
                        SUM(IF(:status='0', ppas_anggaran.`jml_usulan`, ppas_anggaran.`jml_final`)) AS jml_plafon
                    FROM
                         `ppas_ppas` ppas_ppas
                         INNER JOIN `ppas_anggaran` ppas_anggaran ON ppas_anggaran.`ppas_ppas_id` = ppas_ppas.`id_ppas_ppas`
                         INNER JOIN `sikd_kgtn` sikd_kgtn ON ppas_anggaran.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                         INNER JOIN `sikd_prog` sikd_prog ON sikd_kgtn.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                         INNER JOIN `sikd_bidang` sikd_bidang ON sikd_prog.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                         INNER JOIN `sikd_urusan` sikd_urusan ON sikd_bidang.`sikd_urusan_id` = sikd_urusan.`id_sikd_urusan`
                         INNER JOIN `sikd_satker` sikd_satker ON ppas_anggaran.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                         LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON ppas_anggaran.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                    WHERE
                         ppas_anggaran.`ppas_ppas_id` = :idPpas
                    GROUP BY
                         sikd_satker.`id_sikd_satker`,
                         sikd_sub_skpd.`id_sikd_sub_skpd`
                    ORDER BY
                         sikd_satker.`kode`, sikd_sub_skpd.`kode`
                    ";
            
            
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("idPpas", $idPpas);
            $statement->bindValue("status", $status);
            $statement->execute();
            $rekapProyeksi = $statement->fetchAll();
            
            return new JsonResponse($rekapProyeksi);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getPpasLamp4_2($request)
    {
        try {
            $idPpas = $request->query->get("id_ppas");
            $idPpas = $this->convertOuuidToUuid($idPpas);
            $status = $request->query->get("status");
            $idSubUnit = $request->query->get("id_sub_unit");
            $idSatker = $request->query->get("id_satker");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            //$idPpas = pack('H*', str_replace('-', '', trim($idPpas)));
            if ($idSubUnit != ''){
                $idSubUnit = pack('H*', str_replace('-', '', trim($idSubUnit)));
            } else {
                $idSubUnit = '';
            }
            $idSatker = pack('H*', str_replace('-', '', trim($idSatker)));
            $this->connection = $conn->getConnection();
            $sql = "SELECT
                     CONCAT_WS('-',
                        SUBSTR(HEX(ppas_anggaran.`id_ppas_anggaran`), 1, 8),
                        SUBSTR(HEX(ppas_anggaran.`id_ppas_anggaran`), 9, 4),
                        SUBSTR(HEX(ppas_anggaran.`id_ppas_anggaran`), 13, 4),
                        SUBSTR(HEX(ppas_anggaran.`id_ppas_anggaran`), 17, 4),
                        SUBSTR(HEX(ppas_anggaran.`id_ppas_anggaran`), 21)
                        ) AS id_ppas_anggaran,
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
                     sikd_bidang_induk.kd_bidang AS sikd_bidang_induk_kd_bidang,
                     sikd_bidang_induk.nm_bidang AS sikd_bidang_induk_nm_bidang,
                     CONCAT_WS('-',
                        SUBSTR(HEX(sikd_urusan.`id_sikd_urusan`), 1, 8),
                        SUBSTR(HEX(sikd_urusan.`id_sikd_urusan`), 9, 4),
                        SUBSTR(HEX(sikd_urusan.`id_sikd_urusan`), 13, 4),
                        SUBSTR(HEX(sikd_urusan.`id_sikd_urusan`), 17, 4),
                        SUBSTR(HEX(sikd_urusan.`id_sikd_urusan`), 21)
                        ) AS sikd_urusan_id_sikd_urusan,
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
                        SUBSTR(HEX(sikd_prog.`id_sikd_prog`), 1, 8),
                        SUBSTR(HEX(sikd_prog.`id_sikd_prog`), 9, 4),
                        SUBSTR(HEX(sikd_prog.`id_sikd_prog`), 13, 4),
                        SUBSTR(HEX(sikd_prog.`id_sikd_prog`), 17, 4),
                        SUBSTR(HEX(sikd_prog.`id_sikd_prog`), 21)
                        ) AS sikd_prog_id_sikd_prog,
                     concat(sikd_bidang.`kd_bidang`, '.', sikd_prog.`kd_prog`) AS sikd_prog_kd_prog,
                     sikd_prog.`nm_prog` AS sikd_prog_nm_prog,
                     CONCAT_WS('-',
                        SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 1, 8),
                        SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 9, 4),
                        SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 13, 4),
                        SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 17, 4),
                        SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 21)
                        ) AS sikd_kgtn_id_sikd_kgtn,
                     concat(sikd_bidang.`kd_bidang`, '.', sikd_prog.`kd_prog`, '.',substr(sikd_kgtn.`kd_kgtn`,3,3))  AS sikd_kgtn_kd_kgtn,
                     sikd_kgtn.`nm_kgtn` AS sikd_kgtn_nm_kgtn,
                     ppas_anggaran.`nm_subkegiatan` AS ppas_blnj_langsung_nm_subkegiatan,
                     ppas_anggaran.`sasaran_kgtn` AS ppas_blnj_langsung_sasaran,
                     ppas_anggaran.`target_kgtn` AS ppas_blnj_langsung_target,
                     SUM(IF(:status='0', ppas_anggaran.`jml_usulan`, ppas_anggaran.`jml_final`)) AS jml_plafon
                FROM
                     `ppas_ppas` ppas_ppas
                     INNER JOIN `ppas_anggaran` ppas_anggaran ON ppas_anggaran.`ppas_ppas_id` = ppas_ppas.`id_ppas_ppas`
                     INNER JOIN `sikd_kgtn` sikd_kgtn ON ppas_anggaran.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                     INNER JOIN `sikd_bidang` sikd_bidang ON ppas_anggaran.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                     INNER JOIN `sikd_urusan` sikd_urusan ON sikd_bidang.`sikd_urusan_id` = sikd_urusan.`id_sikd_urusan`
                     INNER JOIN `sikd_prog` sikd_prog ON sikd_kgtn.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                     INNER JOIN `sikd_satker` sikd_satker ON ppas_anggaran.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                     INNER JOIN `sikd_bidang` sikd_bidang_induk ON sikd_satker.`kd_bidang_induk` = sikd_bidang_induk.`kd_bidang`
                     LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON ppas_anggaran.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                WHERE
                     ppas_anggaran.`ppas_ppas_id` LIKE :idPpas
                     AND IF(:idSatker != '', ppas_anggaran.sikd_satker_id = :idSatker, 1)
                GROUP BY
                     ppas_anggaran.id_ppas_anggaran
                ORDER BY
                     sikd_satker.`kode`, sikd_sub_skpd.`kode`,
                     sikd_urusan.`kd_urusan`, sikd_bidang.`kd_bidang`,
                     sikd_prog.`kd_prog`, sikd_kgtn.`kd_kgtn`
                    ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("idPpas", $idPpas);
            $statement->bindValue("status", $status);
            $statement->bindValue("idSatker", $idSubUnit);
            $statement->execute();
            $rekapProyeksi = $statement->fetchAll();
            
            return new JsonResponse($rekapProyeksi);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getPpasLamp4_3($request)
    {
        try {
            $idPpas = $request->query->get("id_ppas");
            $idPpas = $this->convertOuuidToUuid($idPpas);
            $status = $request->query->get("status");
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            //$idPpas = pack('H*', str_replace('-', '', trim($idPpas)));
            $this->connection = $conn->getConnection();
            $sql = "SELECT
                     CONCAT_WS('-',
                        SUBSTR(HEX(ppas_anggaran.`ppas_ppas_id`), 1, 8),
                        SUBSTR(HEX(ppas_anggaran.`ppas_ppas_id`), 9, 4),
                        SUBSTR(HEX(ppas_anggaran.`ppas_ppas_id`), 13, 4),
                        SUBSTR(HEX(ppas_anggaran.`ppas_ppas_id`), 17, 4),
                        SUBSTR(HEX(ppas_anggaran.`ppas_ppas_id`), 21)
                        ) AS ppas_satker_ppas_ppas_id,
                     CONCAT_WS('-',
                        SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 1, 8),
                        SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 9, 4),
                        SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 13, 4),
                        SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 17, 4),
                        SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 21)
                        ) AS sikd_rek_jenis_id_sikd_rek_jenis,
                     sikd_rek_jenis.`kd_rek_jenis` AS sikd_rek_jenis_kd_rek_jenis,
                     sikd_rek_jenis.`nm_rek_jenis` AS sikd_rek_jenis_nm_rek_jenis,
                     SUM(IF(:status='0', ppas_mata_anggaran.`jml_usulan`, ppas_mata_anggaran.`jml_final`))AS jml_plafon
                FROM
                     `ppas_ppas` ppas_ppas
                     INNER JOIN `ppas_anggaran` ppas_anggaran ON ppas_anggaran.`ppas_ppas_id` = ppas_ppas.`id_ppas_ppas`
                     INNER JOIN `ppas_mata_anggaran` ppas_mata_anggaran ON ppas_anggaran.id_ppas_anggaran = ppas_mata_anggaran.ppas_anggaran_id
                     INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON ppas_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                     INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                     INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                     INNER JOIN `sikd_rek_kelompok` sikd_rek_kelompok ON sikd_rek_jenis.`sikd_rek_kelompok_id` = sikd_rek_kelompok.`id_sikd_rek_kelompok`
                WHERE
                     ppas_anggaran.`ppas_ppas_id` = :idPpas
                GROUP BY
                     sikd_rek_jenis.`id_sikd_rek_jenis`
                ORDER BY
                     sikd_rek_jenis.`kd_rek_jenis` ASC
                    ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("idPpas", $idPpas);
            $statement->bindValue("status", $status);
            $statement->execute();
            $rekapProyeksi = $statement->fetchAll();
            
            return new JsonResponse($rekapProyeksi);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getPpasLamp5($request)
    {
        try {
            $idPpas = $request->query->get("id_ppas");
            $idPpas = $this->convertOuuidToUuid($idPpas);
            $status = $request->query->get("status");
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            //$idPpas = pack('H*', str_replace('-', '', trim($idPpas)));
            $this->connection = $conn->getConnection();
            $sql = "SELECT
                         CONCAT_WS('-',
                            SUBSTR(HEX(ppas_anggaran.`ppas_ppas_id`), 1, 8),
                            SUBSTR(HEX(ppas_anggaran.`ppas_ppas_id`), 9, 4),
                            SUBSTR(HEX(ppas_anggaran.`ppas_ppas_id`), 13, 4),
                            SUBSTR(HEX(ppas_anggaran.`ppas_ppas_id`), 17, 4),
                            SUBSTR(HEX(ppas_anggaran.`ppas_ppas_id`), 21)
                            ) AS ppas_anggaran_ppas_ppas_id,
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
                         SUM(IF(:status='0', ppas_mata_anggaran.`jml_usulan`, ppas_mata_anggaran.`jml_final`))AS jml_plafon,
                         SUM(IF(sikd_rek_kelompok.kd_rek_kelompok='61',1,-1)*IF(:status='0', ppas_mata_anggaran.`jml_usulan`, ppas_mata_anggaran.`jml_final`)) AS jml_netto
                    FROM
                         `ppas_ppas` ppas_ppas
                         INNER JOIN `ppas_anggaran` ppas_anggaran ON ppas_anggaran.`ppas_ppas_id` = ppas_ppas.`id_ppas_ppas`
                         INNER JOIN `ppas_mata_anggaran` ppas_mata_anggaran ON ppas_anggaran.`id_ppas_anggaran` = ppas_mata_anggaran.`ppas_anggaran_id`
                         INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON ppas_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                         INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                         INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                         INNER JOIN `sikd_rek_kelompok` sikd_rek_kelompok ON sikd_rek_jenis.`sikd_rek_kelompok_id` = sikd_rek_kelompok.`id_sikd_rek_kelompok`
                    WHERE
                         sikd_rek_kelompok.kd_rek_kelompok IN ('61','62')   
                         AND ppas_anggaran.`ppas_ppas_id` = :idPpas
                    GROUP BY
                         sikd_rek_jenis.`id_sikd_rek_jenis`
                    ORDER BY
                         sikd_rek_jenis.`kd_rek_jenis`
                    ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("idPpas", $idPpas);
            $statement->bindValue("status", $status);
            $statement->execute();
            $rekapProyeksi = $statement->fetchAll();
            
            return new JsonResponse($rekapProyeksi);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getPpasLamp6($request) // blm dilanjut akrena blm jelas kdrek ngambil dari mana
    {
        try {
            $idPpas = $request->query->get("id_ppas");
            $status = $request->query->get("status_ppas");
            $tahun = $request->query->get("tahun");
            $tahun = $request->query->get("kd_rek");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idPpas = pack('H*', str_replace('-', '', trim($idPpas)));
            $this->connection = $conn->getConnection();
            $sql = "SELECT
                     CONCAT_WS('-',
                        SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 1, 8),
                        SUBSTR(HEX(ppas_ppas.`id_ppas_ppas`), 9, 4),
                        SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 13, 4),
                        SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 17, 4),
                        SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 21)
                        ) AS ppas_ppas_id_ppas_ppas,
                     ppas_ppas.`tahun` AS ppas_ppas_tahun,
                     ppas_ppas.`jns_ppas` AS ppas_ppas_jns_ppas,
                     ppas_pnrm_hibah_bansos.`no_urut` AS ppas_hibah_bansos_no_urut,
                     ppas_pnrm_hibah_bansos.`no_urut` AS ppas_hibah_bansos_no_urut,
                     ppas_pnrm_hibah_bansos.`nm_penerima` AS ppas_hibah_bansos_nm_penerima,
                     ppas_pnrm_hibah_bansos.`alamat_penerima` AS ppas_hibah_bansos_alamat_penerima,
                     sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj` AS sikd_rek_rincian_obj_id_sikd_rek_rincian_obj,
                     sikd_rek_rincian_obj.`kd_rek_rincian_obj` AS sikd_rek_rincian_obj_kd_rek_rincian_obj,
                     sikd_rek_rincian_obj.`nm_rek_rincian_obj` AS sikd_rek_rincian_obj_nm_rek_rincian_obj,
                     IF(:status='0', ppas_hibah_bansos.`jml_usulan`, ppas_hibah_bansos.`jml_final`)AS ppas_hibah_bansos_jumlah
                FROM
                     `ppas_pnrm_hibah_bansos` ppas_pnrm_hibah_bansos INNER JOIN `ppas_ppas` ppas_ppas ON ppas_pnrm_hibah_bansos.`ppas_ppas_id` = ppas_ppas.`id_ppas_ppas`
                     INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON ppas_pnrm_hibah_bansos.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                WHERE
                     ppas_ppas.id_ppas_ppas = :idPpas
                     AND SUBSTR(ppas_hibah_bansos.kd_rekening,1,3) = :kdRek
                ORDER BY
                     ppas_pnrm_hibah_bansos.kd_rekening, ppas_pnrm_hibah_bansos.no_urut ASC
                    ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("idPpas", $idPpas);
            $statement->bindValue("status", $status);
            $statement->bindValue("kdRek", $kdRek);
            $statement->execute();
            $rekapProyeksi = $statement->fetchAll();
            
            return new JsonResponse($rekapProyeksi);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }

    private function getPpasRekapProgramRkaPdpt($request)
    {
        try {
            $id_ppas = $request->query->get("id_ppas");
            //$sikd_satker_id = $request->query->get("sikd_satker_id");
            $status = $request->query->get("status");
            //$tahun = $request->query->get("tahun");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $id_ppas = $this->convertOuuidToUuid($id_ppas);
            $this->connection = $conn->getConnection();
            $sql = 
                /*"SELECT
                     ppas_anggaran.`id_ppas_anggaran` AS id_ppas_anggaran,
                     sikd_satker.`id_sikd_satker` AS sikd_satker_id_sikd_satker,
                     sikd_satker.`kode` AS sikd_satker_kode,
                     sikd_satker.`nama` AS sikd_satker_nama,
                     sikd_sub_skpd.`id_sikd_sub_skpd` AS sikd_sub_skpd_id_sikd_sub_skpd,
                     sikd_sub_skpd.`kode` AS sikd_sub_skpd_kode,
                     sikd_sub_skpd.`nama` AS sikd_sub_skpd_nama,
                     sikd_bidang.kd_bidang AS sikd_bidang_induk_kd_bidang,
                     sikd_bidang.nm_bidang AS sikd_bidang_induk_nm_bidang,
                     sikd_urusan.`id_sikd_urusan` AS sikd_urusan_id_sikd_urusan,
                     sikd_urusan.`kd_urusan` AS sikd_urusan_kd_urusan,
                     sikd_urusan.`nm_urusan` AS sikd_urusan_nm_urusan,
                     sikd_bidang.`id_sikd_bidang` AS sikd_bidang_id_sikd_bidang,
                     sikd_bidang.`kd_bidang` AS sikd_bidang_kd_bidang,
                     sikd_bidang.`nm_bidang` AS sikd_bidang_nm_bidang,
                     sikd_prog.`id_sikd_prog` AS sikd_prog_id_sikd_prog,
                     concat(sikd_bidang.`kd_bidang`, '.', sikd_prog.`kd_prog`) AS sikd_prog_kd_prog,
                     sikd_prog.`nm_prog` AS sikd_prog_nm_prog,
                     sikd_kgtn.`id_sikd_kgtn` AS sikd_kgtn_id_sikd_kgtn,
                     concat(sikd_bidang.`kd_bidang`, '.', sikd_prog.`kd_prog`, '.',substr(sikd_kgtn.`kd_kgtn`,3,3))  AS sikd_kgtn_kd_kgtn,
                     sikd_kgtn.`nm_kgtn` AS sikd_kgtn_nm_kgtn,
                     ppas_anggaran.`nm_subkegiatan` AS ppas_blnj_langsung_nm_subkegiatan,
                     ppas_anggaran.`sasaran_kgtn` AS ppas_blnj_langsung_sasaran,
                     ppas_anggaran.`target_kgtn` AS ppas_blnj_langsung_target,
                     SUM(IF(:status='0', ppas_anggaran.`jml_usulan`, ppas_anggaran.`jml_final`))AS jml_plafon
                FROM
                     `ppas_ppas` ppas_ppas
                     INNER JOIN `ppas_anggaran` ppas_anggaran ON ppas_anggaran.`ppas_ppas_id` = ppas_ppas.`id_ppas_ppas`
                     INNER JOIN `sikd_kgtn` sikd_kgtn ON ppas_anggaran.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                     INNER JOIN `sikd_bidang` sikd_bidang ON ppas_anggaran.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                     INNER JOIN `sikd_urusan` sikd_urusan ON sikd_bidang.`sikd_urusan_id` = sikd_urusan.`id_sikd_urusan`
                     INNER JOIN `sikd_prog` sikd_prog ON sikd_kgtn.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                     INNER JOIN `sikd_satker` sikd_satker ON ppas_anggaran.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                     INNER JOIN `sikd_bidang` sikd_bidang_induk ON sikd_satker.`kd_bidang_induk` = sikd_bidang_induk.`kd_bidang`
                     LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON ppas_anggaran.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                WHERE
                     ppas_anggaran.`ppas_ppas_id` = :id_ppas
                     AND IF(:sikd_satker_id != '', ppas_anggaran.sikd_satker_id = :sikd_satker_id, 1)
                     AND (ppas_anggaran.`sasaran_kgtn` = '' OR ppas_anggaran.`target_kgtn` = '')
                GROUP BY
                     ppas_anggaran.id_ppas_anggaran
                ORDER BY
                     sikd_satker.`kode`, sikd_sub_skpd.`kode`,
                     sikd_urusan.`kd_urusan`, sikd_bidang.`kd_bidang`,
                     sikd_prog.`kd_prog`, sikd_kgtn.`kd_kgtn`";*/
            
                "SELECT
                     sikd_satker.`id_sikd_satker` AS sikd_satker_id_sikd_satker,
                     sikd_satker.`kode` AS sikd_satker_kode,
                     sikd_satker.`nama` AS sikd_satker_nama,
                     sikd_sub_skpd.`kode` AS sikd_sub_skpd_kode,
                     sikd_sub_skpd.`nama` AS sikd_sub_skpd_nama,
                     sikd_rek_kelompok.`kd_rek_kelompok` AS sikd_rek_kelompok_kd_rek_kelompok,
                     sikd_rek_kelompok.`nm_rek_kelompok` AS sikd_rek_kelompok_nm_rek_kelompok,
                     sikd_rek_jenis.`kd_rek_jenis` AS sikd_rek_jenis_kd_rek_jenis,
                     sikd_rek_jenis.`nm_rek_jenis` AS sikd_rek_jenis_nm_rek_jenis,
                     sikd_rek_obj.`kd_rek_obj` AS sikd_rek_obj_kd_rek_obj,
                     sikd_rek_obj.`nm_rek_obj` AS sikd_rek_obj_nm_rek_obj,
                     sikd_rek_rincian_obj.`kd_rek_rincian_obj` AS sikd_rek_rincian_obj_kd_rek_rincian_obj,
                     sikd_rek_rincian_obj.`nm_rek_rincian_obj` AS sikd_rek_rincian_obj_nm_rek_rincian_obj,
                     SUM(ifnull(rkpd_mata_anggaran.`jumlah`, 0)) AS rkpd_mata_anggaran_jumlah,
                     0 AS ppas_mata_anggaran_jumlah,
                     0 AS rka_mata_anggaran_jumlah
                FROM
                     `rkpd_rkpd` rkpd_rkpd
                     INNER JOIN `rkpd_anggaran` rkpd_anggaran ON rkpd_anggaran.`rkpd_rkpd_id` = rkpd_rkpd.`id_rkpd_rkpd`
                     AND rkpd_anggaran.rkpd_anggaran_type = 'RkpdPendapatan'
                     INNER JOIN `rkpd_mata_anggaran` rkpd_mata_anggaran ON rkpd_anggaran.`id_rkpd_anggaran` = rkpd_mata_anggaran.`rkpd_anggaran_id`
                     #INNER JOIN `rkpd_pendapatan` rkpd_pendapatan ON rkpd_anggaran.`id_rkpd_anggaran` = rkpd_pendapatan.`id_rkpd_pendapatan`
                     INNER JOIN `sikd_satker` sikd_satker ON rkpd_anggaran.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                     LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON rkpd_anggaran.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                     INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON rkpd_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                     INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                     INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                     INNER JOIN `sikd_rek_kelompok` sikd_rek_kelompok ON sikd_rek_jenis.`sikd_rek_kelompok_id` = sikd_rek_kelompok.`id_sikd_rek_kelompok`
                     INNER JOIN `ppas_ppas` ppas_ppas ON rkpd_rkpd.`id_rkpd_rkpd` = ppas_ppas.`rkpd_rkpd_id`
                WHERE
                     ppas_ppas.`id_ppas_ppas` = :id_ppas
                GROUP BY
                     sikd_rek_kelompok_kd_rek_kelompok,
                     sikd_satker_id_sikd_satker,
                     sikd_sub_skpd_kode,
                     sikd_rek_jenis_kd_rek_jenis,
                     sikd_rek_obj_kd_rek_obj,
                     sikd_rek_rincian_obj_kd_rek_rincian_obj
                UNION
                SELECT
                     sikd_satker.`id_sikd_satker` AS sikd_satker_id_sikd_satker,
                     sikd_satker.`kode` AS sikd_satker_kode,
                     sikd_satker.`nama` AS sikd_satker_nama,
                     sikd_sub_skpd.`kode` AS sikd_sub_skpd_kode,
                     sikd_sub_skpd.`nama` AS sikd_sub_skpd_nama,
                     sikd_rek_kelompok.`kd_rek_kelompok` AS sikd_rek_kelompok_kd_rek_kelompok,
                     sikd_rek_kelompok.`nm_rek_kelompok` AS sikd_rek_kelompok_nm_rek_kelompok,
                     sikd_rek_jenis.`kd_rek_jenis` AS sikd_rek_jenis_kd_rek_jenis,
                     sikd_rek_jenis.`nm_rek_jenis` AS sikd_rek_jenis_nm_rek_jenis,
                     sikd_rek_obj.`kd_rek_obj` AS sikd_rek_obj_kd_rek_obj,
                     sikd_rek_obj.`nm_rek_obj` AS sikd_rek_obj_nm_rek_obj,
                     sikd_rek_rincian_obj.`kd_rek_rincian_obj` AS sikd_rek_rincian_obj_kd_rek_rincian_obj,
                     sikd_rek_rincian_obj.`nm_rek_rincian_obj` AS sikd_rek_rincian_obj_nm_rek_rincian_obj,
                     0 AS rkpd_mata_anggaran_jumlah,
                     SUM(IF(:status='0', ppas_mata_anggaran.`jml_usulan`, ppas_mata_anggaran.`jml_final`)) AS ppas_mata_anggaran_jumlah,
                     0 AS rka_mata_anggaran_jumlah
                FROM
                     `ppas_ppas` ppas_ppas
                     INNER JOIN `ppas_anggaran` ppas_anggaran ON ppas_anggaran.`ppas_ppas_id` = ppas_ppas.`id_ppas_ppas`
                     AND ppas_anggaran.ppas_anggaran_type = 'PpasPendapatan'
                     INNER JOIN `ppas_mata_anggaran` ppas_mata_anggaran ON ppas_anggaran.`id_ppas_anggaran` = ppas_mata_anggaran.`ppas_anggaran_id`
                     #INNER JOIN `ppas_pendapatan` ppas_pendapatan ON ppas_anggaran.`id_ppas_anggaran` = ppas_pendapatan.`id_ppas_pendapatan`
                     INNER JOIN `sikd_satker` sikd_satker ON ppas_anggaran.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                     LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON ppas_anggaran.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                     INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON ppas_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                     INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                     INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                     INNER JOIN `sikd_rek_kelompok` sikd_rek_kelompok ON sikd_rek_jenis.`sikd_rek_kelompok_id` = sikd_rek_kelompok.`id_sikd_rek_kelompok`
                WHERE
                     ppas_ppas.`id_ppas_ppas` = :id_ppas
                GROUP BY
                     sikd_rek_kelompok_kd_rek_kelompok,
                     sikd_satker_id_sikd_satker,
                     sikd_sub_skpd_kode,
                     sikd_rek_jenis_kd_rek_jenis,
                     sikd_rek_obj_kd_rek_obj,
                     sikd_rek_rincian_obj_kd_rek_rincian_obj
                UNION
                SELECT
                     sikd_satker.`id_sikd_satker` AS sikd_satker_id_sikd_satker,
                     sikd_satker.`kode` AS sikd_satker_kode,
                     sikd_satker.`nama` AS sikd_satker_nama,
                     sikd_sub_skpd.`kode` AS sikd_sub_skpd_kode,
                     sikd_sub_skpd.`nama` AS sikd_sub_skpd_nama,
                     sikd_rek_kelompok.`kd_rek_kelompok` AS sikd_rek_kelompok_kd_rek_kelompok,
                     sikd_rek_kelompok.`nm_rek_kelompok` AS sikd_rek_kelompok_nm_rek_kelompok,
                     sikd_rek_jenis.`kd_rek_jenis` AS sikd_rek_jenis_kd_rek_jenis,
                     sikd_rek_jenis.`nm_rek_jenis` AS sikd_rek_jenis_nm_rek_jenis,
                     sikd_rek_obj.`kd_rek_obj` AS sikd_rek_obj_kd_rek_obj,
                     sikd_rek_obj.`nm_rek_obj` AS sikd_rek_obj_nm_rek_obj,
                     sikd_rek_rincian_obj.`kd_rek_rincian_obj` AS sikd_rek_rincian_obj_kd_rek_rincian_obj,
                     sikd_rek_rincian_obj.`nm_rek_rincian_obj` AS sikd_rek_rincian_obj_nm_rek_rincian_obj,
                     0 AS rkpd_mata_anggaran_jumlah,
                     0 AS ppas_mata_anggaran_jumlah,
                     sum(ifnull(rka_mata_anggaran.`jumlah`,0)) AS rka_mata_anggaran_jumlah
                FROM
                     `rka_rka` rka_rka
                     INNER JOIN `rka_mata_anggaran` rka_mata_anggaran ON rka_mata_anggaran.`rka_rka` = rka_rka.`id_rka_rka`
                     #AND (rka_skpd.rka_skpd_type = 'RkaSkpdPendapatan'
                     #OR rka_skpkd.rka_skpkd_type = 'RkaSkpkdPendapatan')
                     AND (rka_rka.rka_rka_type = 'RkaSkpdPendapatan' 
                     OR  rka_rka.rka_rka_type = 'RkaSkpkdPendapatan')
                     #AND if(:id_ppas = (SELECT ppas_ppas.`id_ppas_ppas` FROM ppas_ppas WHERE jns_ppas = 'PPAS-A') , rka_rka.`rka_perubahan`='0' OR rka_rka.`rka_perubahan` IS NULL, rka_rka.`rka_perubahan`='1')
                     AND CASE
                             WHEN :id_ppas = (SELECT ppas_ppas.`id_ppas_ppas` FROM ppas_ppas WHERE jns_ppas = 'PPAS-A') THEN rka_rka.`rka_perubahan` = '0' OR rka_rka.`rka_perubahan` IS NULL
                             ELSE rka_rka.`rka_perubahan`='1'
                         END
                     INNER JOIN `sikd_satker` sikd_satker ON rka_rka.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                     LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON rka_rka.`sikd_sub_satker_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                     #LEFT OUTER JOIN `rka_skpd` rka_skpd ON rka_rka.`id_rka_rka` = rka_skpd.`id_rka_skpd`
                     #LEFT OUTER JOIN `rka_skpkd` rka_skpkd ON rka_rka.`id_rka_rka` = rka_skpkd.`id_rka_skpkd`
                     INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON rka_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                     INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                     INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                     INNER JOIN `sikd_rek_kelompok` sikd_rek_kelompok ON sikd_rek_jenis.`sikd_rek_kelompok_id` = sikd_rek_kelompok.`id_sikd_rek_kelompok`
                GROUP BY
                     sikd_rek_kelompok_kd_rek_kelompok,
                     sikd_satker_id_sikd_satker,
                     sikd_sub_skpd_kode,
                     sikd_rek_jenis_kd_rek_jenis,
                     sikd_rek_obj_kd_rek_obj,
                     sikd_rek_rincian_obj_kd_rek_rincian_obj
                ORDER BY
                     sikd_rek_kelompok_kd_rek_kelompok ASC,
                     sikd_satker_kode ASC,
                     sikd_satker_id_sikd_satker ASC,
                     sikd_sub_skpd_kode ASC,
                     sikd_rek_jenis_kd_rek_jenis ASC,
                     sikd_rek_obj_kd_rek_obj ASC,
                     sikd_rek_rincian_obj_kd_rek_rincian_obj ASC
                 ";

            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_ppas", $id_ppas);
            //$statement->bindValue("sikd_satker_id", $sikd_satker_id);
            $statement->bindValue("status", $status);
            $statement->execute();
            $rekapProyeksi = $statement->fetchAll();
            
            return new JsonResponse($rekapProyeksi);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }

    private function getPpasRekapProgramRkaBtl($request)
    {
        try {
            $id_ppas = $request->query->get("id_ppas");
            $status = $request->query->get("status");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $id_ppas = $this->convertOuuidToUuid($id_ppas);
            $this->connection = $conn->getConnection();
            $sql = 
                "SELECT
                    sikd_satker.`id_sikd_satker` AS sikd_satker_id_sikd_satker,
                    sikd_satker.`kode` AS sikd_satker_kode,
                    sikd_satker.`nama` AS sikd_satker_nama,
                    sikd_sub_skpd.`kode` AS sikd_sub_skpd_kode,
                    sikd_sub_skpd.`nama` AS sikd_sub_skpd_nama,
                    sikd_rek_kelompok.`kd_rek_kelompok` AS sikd_rek_kelompok_kd_rek_kelompok,
                    sikd_rek_kelompok.`nm_rek_kelompok` AS sikd_rek_kelompok_nm_rek_kelompok,
                    sikd_rek_jenis.`kd_rek_jenis` AS sikd_rek_jenis_kd_rek_jenis,
                    sikd_rek_jenis.`nm_rek_jenis` AS sikd_rek_jenis_nm_rek_jenis,
                    sikd_rek_obj.`kd_rek_obj` AS sikd_rek_obj_kd_rek_obj,
                    sikd_rek_obj.`nm_rek_obj` AS sikd_rek_obj_nm_rek_obj,
                    sikd_rek_rincian_obj.`kd_rek_rincian_obj` AS sikd_rek_rincian_obj_kd_rek_rincian_obj,
                    sikd_rek_rincian_obj.`nm_rek_rincian_obj` AS sikd_rek_rincian_obj_nm_rek_rincian_obj,
                    SUM(ifnull(rkpd_mata_anggaran.`jumlah`, 0)) AS rkpd_mata_anggaran_jumlah,
                    0 AS ppas_mata_anggaran_jumlah,
                    0 AS rka_mata_anggaran_jumlah
                FROM
                    `rkpd_rkpd` rkpd_rkpd
                    INNER JOIN `rkpd_anggaran` rkpd_anggaran ON rkpd_anggaran.`rkpd_rkpd_id` = rkpd_rkpd.`id_rkpd_rkpd`
                    -- AND rkpd_anggaran.rkpd_anggaran_type = 'RkpdBlnjTdkLangsung'
                    AND rkpd_anggaran.rkpd_anggaran_type = 'RkpdBelanja'
                    INNER JOIN `rkpd_mata_anggaran` rkpd_mata_anggaran ON rkpd_anggaran.`id_rkpd_anggaran` = rkpd_mata_anggaran.`rkpd_anggaran_id`
                    #INNER JOIN `rkpd_blnj_tdk_langsung` rkpd_blnj_tdk_langsung ON rkpd_anggaran.`id_rkpd_anggaran` = rkpd_blnj_tdk_langsung.`id_rkpd_blnj_tdk_langsung`
                    INNER JOIN `sikd_satker` sikd_satker ON rkpd_anggaran.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                    LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON rkpd_anggaran.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                    INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON rkpd_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                    INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                    INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                    INNER JOIN `sikd_rek_kelompok` sikd_rek_kelompok ON sikd_rek_jenis.`sikd_rek_kelompok_id` = sikd_rek_kelompok.`id_sikd_rek_kelompok`
                    INNER JOIN `ppas_ppas` ppas_ppas ON rkpd_rkpd.`id_rkpd_rkpd` = ppas_ppas.`rkpd_rkpd_id`
                WHERE
                     ppas_ppas.`id_ppas_ppas` = :id_ppas
                GROUP BY
                    sikd_rek_kelompok_kd_rek_kelompok,
                    sikd_satker_id_sikd_satker,
                    sikd_sub_skpd_kode,
                    sikd_rek_jenis_kd_rek_jenis,
                    sikd_rek_obj_kd_rek_obj,
                    sikd_rek_rincian_obj_kd_rek_rincian_obj
                UNION
                SELECT
                    sikd_satker.`id_sikd_satker` AS sikd_satker_id_sikd_satker,
                    sikd_satker.`kode` AS sikd_satker_kode,
                    sikd_satker.`nama` AS sikd_satker_nama,
                    sikd_sub_skpd.`kode` AS sikd_sub_skpd_kode,
                    sikd_sub_skpd.`nama` AS sikd_sub_skpd_nama,
                    sikd_rek_kelompok.`kd_rek_kelompok` AS sikd_rek_kelompok_kd_rek_kelompok,
                    sikd_rek_kelompok.`nm_rek_kelompok` AS sikd_rek_kelompok_nm_rek_kelompok,
                    sikd_rek_jenis.`kd_rek_jenis` AS sikd_rek_jenis_kd_rek_jenis,
                    sikd_rek_jenis.`nm_rek_jenis` AS sikd_rek_jenis_nm_rek_jenis,
                    sikd_rek_obj.`kd_rek_obj` AS sikd_rek_obj_kd_rek_obj,
                    sikd_rek_obj.`nm_rek_obj` AS sikd_rek_obj_nm_rek_obj,
                    sikd_rek_rincian_obj.`kd_rek_rincian_obj` AS sikd_rek_rincian_obj_kd_rek_rincian_obj,
                    sikd_rek_rincian_obj.`nm_rek_rincian_obj` AS sikd_rek_rincian_obj_nm_rek_rincian_obj,
                    0 AS rkpd_mata_anggaran_jumlah,
                    SUM(IF(:status='0', ppas_mata_anggaran.`jml_usulan`, ppas_mata_anggaran.`jml_final`)) AS ppas_mata_anggaran_jumlah,
                    0 AS rka_mata_anggaran_jumlah
                FROM
                    `ppas_ppas` ppas_ppas
                    INNER JOIN `ppas_anggaran` ppas_anggaran ON ppas_anggaran.`ppas_ppas_id` = ppas_ppas.`id_ppas_ppas`
                    -- AND ppas_anggaran.ppas_anggaran_type = 'PpasBlnjTdkLangsung'
                    AND ppas_anggaran.ppas_anggaran_type = 'PpasBelanja'
                    INNER JOIN `ppas_mata_anggaran` ppas_mata_anggaran ON ppas_anggaran.`id_ppas_anggaran` = ppas_mata_anggaran.`ppas_anggaran_id`
                    #INNER JOIN `ppas_blnj_tdk_langsung` ppas_blnj_tdk_langsung ON ppas_anggaran.`id_ppas_anggaran` = ppas_blnj_tdk_langsung.`id_ppas_blnj_tdk_langsung`
                    INNER JOIN `sikd_satker` sikd_satker ON ppas_anggaran.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                    LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON ppas_anggaran.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                    INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON ppas_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                    INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                    INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                    INNER JOIN `sikd_rek_kelompok` sikd_rek_kelompok ON sikd_rek_jenis.`sikd_rek_kelompok_id` = sikd_rek_kelompok.`id_sikd_rek_kelompok`
                WHERE
                     ppas_ppas.`id_ppas_ppas` = :id_ppas
                GROUP BY
                    sikd_rek_kelompok_kd_rek_kelompok,
                    sikd_satker_id_sikd_satker,
                    sikd_sub_skpd_kode,
                    sikd_rek_jenis_kd_rek_jenis,
                    sikd_rek_obj_kd_rek_obj,
                    sikd_rek_rincian_obj_kd_rek_rincian_obj
                UNION
                SELECT
                    sikd_satker.`id_sikd_satker` AS sikd_satker_id_sikd_satker,
                    sikd_satker.`kode` AS sikd_satker_kode,
                    sikd_satker.`nama` AS sikd_satker_nama,
                    sikd_sub_skpd.`kode` AS sikd_sub_skpd_kode,
                    sikd_sub_skpd.`nama` AS sikd_sub_skpd_nama,
                    sikd_rek_kelompok.`kd_rek_kelompok` AS sikd_rek_kelompok_kd_rek_kelompok,
                    sikd_rek_kelompok.`nm_rek_kelompok` AS sikd_rek_kelompok_nm_rek_kelompok,
                    sikd_rek_jenis.`kd_rek_jenis` AS sikd_rek_jenis_kd_rek_jenis,
                    sikd_rek_jenis.`nm_rek_jenis` AS sikd_rek_jenis_nm_rek_jenis,
                    sikd_rek_obj.`kd_rek_obj` AS sikd_rek_obj_kd_rek_obj,
                    sikd_rek_obj.`nm_rek_obj` AS sikd_rek_obj_nm_rek_obj,
                    sikd_rek_rincian_obj.`kd_rek_rincian_obj` AS sikd_rek_rincian_obj_kd_rek_rincian_obj,
                    sikd_rek_rincian_obj.`nm_rek_rincian_obj` AS sikd_rek_rincian_obj_nm_rek_rincian_obj,
                    0 AS rkpd_mata_anggaran_jumlah,
                    0 AS ppas_mata_anggaran_jumlah,
                    SUM(rka_mata_anggaran.jumlah) AS rka_mata_anggaran_jumlah
                FROM
                    `rka_rka` rka_rka
                    INNER JOIN `rka_mata_anggaran` rka_mata_anggaran ON rka_mata_anggaran.`rka_rka` = rka_rka.`id_rka_rka`
                    /*AND (rka_rka.rka_rka_type = 'RkaSkpdBlnjTdkLangsung' 
                    OR  rka_rka.rka_rka_type = 'RkaSkpkdBlnjTdkLangsung')*/
                    AND (rka_rka.rka_rka_type = 'RkaBelanja' 
                    OR  rka_rka.rka_rka_type = 'RkaBelanja')
                    AND CASE
                     	    WHEN :id_ppas = (SELECT ppas_ppas.`id_ppas_ppas` FROM ppas_ppas WHERE jns_ppas = 'PPAS-A') THEN rka_rka.`rka_perubahan` = '0' OR rka_rka.`rka_perubahan` IS NULL
                            ELSE rka_rka.`rka_perubahan`='1'
                        END
                    INNER JOIN `sikd_satker` sikd_satker ON rka_rka.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                    LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON rka_rka.`sikd_sub_satker_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                    #LEFT OUTER JOIN `rka_skpd` rka_skpd ON rka_rka.`id_rka_rka` = rka_skpd.`id_rka_skpd`
                    #LEFT OUTER JOIN `rka_skpkd` rka_skpkd ON rka_rka.`id_rka_rka` = rka_skpkd.`id_rka_skpkd`
                    INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON rka_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                    INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                    INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                    INNER JOIN `sikd_rek_kelompok` sikd_rek_kelompok ON sikd_rek_jenis.`sikd_rek_kelompok_id` = sikd_rek_kelompok.`id_sikd_rek_kelompok`
                #WHERE
                    #(rka_skpd.rka_skpd_type = 'RkaSkpdBlnjTdkLangsung'
                #OR rka_skpkd.rka_skpkd_type = 'RkaSkpkdBlnjTdkLangsung')
                GROUP BY
                    sikd_rek_kelompok_kd_rek_kelompok,
                    sikd_satker_id_sikd_satker,
                    sikd_sub_skpd_kode,
                    sikd_rek_rincian_obj_kd_rek_rincian_obj
                ORDER BY
                    sikd_rek_kelompok_kd_rek_kelompok ASC,
                    sikd_satker_kode ASC,
                    sikd_satker_id_sikd_satker ASC,
                    sikd_sub_skpd_kode ASC,
                    sikd_rek_rincian_obj_kd_rek_rincian_obj ASC
                ";

            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_ppas", $id_ppas);
            $statement->bindValue("status", $status);
            $statement->execute();
            $rekapProyeksi = $statement->fetchAll();
            
            return new JsonResponse($rekapProyeksi);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }

    private function getPpasRekapProgramRkaBl($request)
    {
        try {
            $id_ppas = $request->query->get("id_ppas");
            $status = $request->query->get("status");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $id_ppas = $this->convertOuuidToUuid($id_ppas);
            $this->connection = $conn->getConnection();
            $sql = 
                "SELECT
                    sikd_bidang.`kd_bidang` AS sikd_bidang_kd_bidang,
                    sikd_bidang.`nm_bidang` AS sikd_bidang_nm_bidang,
                    sikd_prog.`kd_prog` AS sikd_prog_kd_prog,
                    sikd_prog.`nm_prog` AS sikd_prog_nm_prog,
                    sikd_kgtn.`kd_kgtn` AS sikd_kgtn_kd_kgtn,
                    sikd_kgtn.`nm_kgtn` AS sikd_kgtn_nm_kgtn,
                    ppas_ppas.`status_ppas` AS ppas_ppas_status_ppas,
                    ppas_ppas.`jns_ppas` AS ppas_ppas_jns_ppas,
                    ppas_ppas.`no_dokumen_pemda` AS ppas_ppas_no_dokumen,
                    if(ppas_ppas.`tgl_pengesahan_pemda`<>'' || ppas_ppas.`tgl_pengesahan_pemda`<>'0000-00-00',
                        date_format(ppas_ppas.`tgl_pengesahan_pemda`,'%d-%m-%y'), '-')  AS ppas_ppas_tgl_pengesahan,
                    sikd_satker.`id_sikd_satker` AS sikd_satker_id_sikd_satker,
                    sikd_satker.`kode` AS sikd_satker_kode,
                    sikd_satker.`nama` AS sikd_satker_nama,
                    sikd_sub_skpd.`kode` AS sikd_sub_skpd_kode,
                    sikd_sub_skpd.`nama` AS sikd_sub_skpd_nama,
                    sum(ifnull(rkpd_anggaran.`jml_anggaran_rkpd`,0)) AS rkpd_program_pagu_indikatif,
                    0 AS ppas_blnj_langsung_jml_plafon,
                    0 AS rka_mata_anggaran_jumlah
                FROM
                    `rkpd_program` rkpd_program 
                    INNER JOIN `rkpd_rkpd` rkpd_rkpd ON rkpd_program.`rkpd_rkpd_id` = rkpd_rkpd.`id_rkpd_rkpd`
                    INNER JOIN `sikd_bidang` sikd_bidang ON rkpd_program.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                    INNER JOIN `sikd_prog` sikd_prog ON rkpd_program.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                    #INNER JOIN `rkpd_kegiatan` rkpd_kegiatan ON rkpd_program.`id_rkpd_program` = rkpd_kegiatan.`rkpd_program_id`
                    INNER JOIN `rkpd_anggaran` rkpd_anggaran ON rkpd_program.`id_rkpd_program` = rkpd_anggaran.rkpd_program_id
                    INNER JOIN `sikd_kgtn` sikd_kgtn ON rkpd_anggaran.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                    INNER JOIN `sikd_satker` sikd_satker ON rkpd_anggaran.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                    LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON rkpd_anggaran.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                    INNER JOIN `ppas_ppas` ppas_ppas ON rkpd_rkpd.`id_rkpd_rkpd` = ppas_ppas.`rkpd_rkpd_id`
                WHERE
                    ppas_ppas.`id_ppas_ppas` = :id_ppas
                GROUP BY
                    sikd_bidang.`kd_bidang`,
                    sikd_prog.`kd_prog`,
                    sikd_satker.`id_sikd_satker`,
                    sikd_sub_skpd.`kode`,
                    sikd_kgtn.`kd_kgtn`
                UNION
                SELECT
                    sikd_bidang.`kd_bidang` AS sikd_bidang_kd_bidang,
                    sikd_bidang.`nm_bidang` AS sikd_bidang_nm_bidang,
                    sikd_prog.`kd_prog` AS sikd_prog_kd_prog,
                    sikd_prog.`nm_prog` AS sikd_prog_nm_prog,
                    sikd_kgtn.`kd_kgtn` AS sikd_kgtn_kd_kgtn,
                    sikd_kgtn.`nm_kgtn` AS sikd_kgtn_nm_kgtn,
                    ppas_ppas.`status_ppas` AS ppas_ppas_status_ppas,
                    ppas_ppas.`jns_ppas` AS ppas_ppas_jns_ppas,
                    ppas_ppas.`no_dokumen_pemda` AS ppas_ppas_no_dokumen,
                    if(ppas_ppas.`tgl_pengesahan_pemda`<>'' || ppas_ppas.`tgl_pengesahan_pemda`<>'0000-00-00',
                        date_format(ppas_ppas.`tgl_pengesahan_pemda`,'%d-%m-%y'), '-')  AS ppas_ppas_tgl_pengesahan,
                    sikd_satker.`id_sikd_satker` AS sikd_satker_id_sikd_satker,
                    sikd_satker.`kode` AS sikd_satker_kode,
                    sikd_satker.`nama` AS sikd_satker_nama,
                    sikd_sub_skpd.`kode` AS sikd_sub_skpd_kode,
                    sikd_sub_skpd.`nama` AS sikd_sub_skpd_nama,
                    0 AS rkpd_program_pagu_indikatif,
                    sum(IF(:status='0', ppas_anggaran.`jml_usulan`, ppas_anggaran.`jml_final`)) AS ppas_blnj_langsung_jml_plafon,
                    0 AS rka_mata_anggaran_jumlah
                FROM
                    `ppas_ppas` ppas_ppas
                    INNER JOIN `ppas_anggaran` ppas_anggaran ON ppas_anggaran.`ppas_ppas_id` = ppas_ppas.`id_ppas_ppas`
                    -- AND ppas_anggaran.ppas_anggaran_type = 'PpasBlnjLangsung'
                    AND ppas_anggaran.ppas_anggaran_type = 'PpasBelanja'
                    #INNER JOIN `ppas_blnj_langsung` ppas_blnj_langsung ON ppas_anggaran.`id_ppas_anggaran` = ppas_blnj_langsung.`id_ppas_blnj_langsung`
                    #LEFT OUTER JOIN `rkpd_kegiatan` rkpd_kegiatan ON ppas_blnj_langsung.`rkpd_kegiatan_id` = rkpd_kegiatan.`id_rkpd_kegiatan`
                    INNER JOIN `sikd_kgtn` sikd_kgtn ON ppas_anggaran.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                    INNER JOIN `sikd_satker` sikd_satker ON ppas_anggaran.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                    LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON ppas_anggaran.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                    INNER JOIN `sikd_bidang` sikd_bidang ON ppas_anggaran.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                    INNER JOIN `sikd_urusan` sikd_urusan ON sikd_bidang.`sikd_urusan_id` = sikd_urusan.`id_sikd_urusan`
                    INNER JOIN `sikd_prog` sikd_prog ON sikd_kgtn.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                WHERE
                    ppas_ppas.`id_ppas_ppas` = :id_ppas
                GROUP BY
                    sikd_kgtn.`kd_bidang`,
                    sikd_prog.`kd_prog`,
                    sikd_satker.`id_sikd_satker`,
                    sikd_sub_skpd.`kode`,
                    sikd_kgtn.`kd_kgtn`
                UNION #masih harus cek link antara rka dan ppasnya
                SELECT
                    sikd_bidang.`kd_bidang` AS sikd_bidang_kd_bidang,
                    sikd_bidang.`nm_bidang` AS sikd_bidang_nm_bidang,
                    sikd_prog.`kd_prog` AS sikd_prog_kd_prog,
                    sikd_prog.`nm_prog` AS sikd_prog_nm_prog,
                    sikd_kgtn.`kd_kgtn` AS sikd_kgtn_kd_kgtn,
                    sikd_kgtn.`nm_kgtn` AS sikd_kgtn_nm_kgtn,
                    ppas_ppas.`status_ppas` AS ppas_ppas_status_ppas,
                    ppas_ppas.`jns_ppas` AS ppas_ppas_jns_ppas,
                    ppas_ppas.`no_dokumen_pemda` AS ppas_ppas_no_dokumen,
                    if(ppas_ppas.`tgl_pengesahan_pemda`<>'' || ppas_ppas.`tgl_pengesahan_pemda`<>'0000-00-00',
                        date_format(ppas_ppas.`tgl_pengesahan_pemda`,'%d-%m-%y'), '-')  AS ppas_ppas_tgl_pengesahan,
                    sikd_satker.`id_sikd_satker` AS sikd_satker_id_sikd_satker,
                    sikd_satker.`kode` AS sikd_satker_kode,
                    sikd_satker.`nama` AS sikd_satker_nama,
                    sikd_sub_skpd.`kode` AS sikd_sub_skpd_kode,
                    sikd_sub_skpd.`nama` AS sikd_sub_skpd_nama,
                    0 AS rkpd_program_pagu_indikatif,
                    0 AS ppas_blnj_langsung_jml_plafon,
                    SUM(rka_mata_anggaran.jumlah) AS rka_mata_anggaran_jumlah
                FROM
                    `rka_rka` rka_rka
                    INNER JOIN `rka_mata_anggaran` rka_mata_anggaran ON rka_mata_anggaran.`rka_rka` = rka_rka.`id_rka_rka`
                    #INNER JOIN `rka_skpd` rka_skpd ON rka_rka.`id_rka_rka` = rka_skpd.`id_rka_skpd`
                    #INNER JOIN `rka_skpd_kgtn` rka_skpd_kgtn ON rka_skpd.`id_rka_skpd` = rka_skpd_kgtn.`id_rka_skpd_kgtn`
                    #INNER JOIN `sikd_kgtn` sikd_kgtn ON rka_skpd_kgtn.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                    AND CASE
                            WHEN :id_ppas = (SELECT ppas_ppas.`id_ppas_ppas` FROM ppas_ppas WHERE jns_ppas = 'PPAS-A') THEN rka_rka.`rka_perubahan` = '0' OR rka_rka.`rka_perubahan` IS NULL
                            ELSE rka_rka.`rka_perubahan`='1'
                         END
                    INNER JOIN `sikd_kgtn` sikd_kgtn ON rka_rka.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                    INNER JOIN `sikd_bidang` sikd_bidang ON rka_rka.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                    INNER JOIN `sikd_urusan` sikd_urusan ON sikd_bidang.`sikd_urusan_id` = sikd_urusan.`id_sikd_urusan`
                    INNER JOIN `sikd_prog` sikd_prog ON sikd_kgtn.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                    INNER JOIN `sikd_satker` sikd_satker ON rka_rka.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                    LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON rka_rka.`sikd_sub_satker_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                    #INNER JOIN `ppas_blnj_langsung` ppas_blnj_langsung ON rka_skpd_kgtn.`ppas_blnj_langsung_id` = ppas_blnj_langsung.`id_ppas_blnj_langsung`
                    #INNER JOIN `ppas_anggaran` ppas_anggaran ON ppas_blnj_langsung.`id_ppas_blnj_langsung` = ppas_anggaran.`id_ppas_anggaran`
                    INNER JOIN `ppas_anggaran` ppas_anggaran ON rka_rka.`ppas_anggaran_id` = ppas_anggaran.`id_ppas_anggaran`
                    INNER JOIN `ppas_ppas` ppas_ppas ON ppas_anggaran.`ppas_ppas_id` = ppas_ppas.`id_ppas_ppas`
                GROUP BY
                    sikd_kgtn.`kd_bidang`,
                    sikd_prog.`kd_prog`,
                    sikd_satker.`id_sikd_satker`,
                    sikd_sub_skpd.`kode`,
                    sikd_kgtn.`kd_kgtn`
                ORDER BY
                    sikd_bidang_kd_bidang ASC,
                    sikd_prog_kd_prog ASC,
                    sikd_satker_kode ASC,
                    sikd_satker_id_sikd_satker ASC,
                    sikd_sub_skpd_kode ASC,
                    sikd_kgtn_kd_kgtn ASC
                ";

            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_ppas", $id_ppas);
            $statement->bindValue("status", $status);
            $statement->execute();
            $rekapProyeksi = $statement->fetchAll();
            
            return new JsonResponse($rekapProyeksi);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }

    private function getPpasRekapProgramRkaPbyn($request)
    {
        try {
            $id_ppas = $request->query->get("id_ppas");
            $status = $request->query->get("status");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $id_ppas = $this->convertOuuidToUuid($id_ppas);
            $this->connection = $conn->getConnection();
            $sql = 
                "SELECT
                    sikd_satker.`id_sikd_satker` AS sikd_satker_id_sikd_satker,
                    sikd_satker.`kode` AS sikd_satker_kode,
                    sikd_satker.`nama` AS sikd_satker_nama,
                    sikd_rek_kelompok.`kd_rek_kelompok` AS sikd_rek_kelompok_kd_rek_kelompok,
                    sikd_rek_kelompok.`nm_rek_kelompok` AS sikd_rek_kelompok_nm_rek_kelompok,
                    sikd_rek_jenis.`kd_rek_jenis` AS sikd_rek_jenis_kd_rek_jenis,
                    sikd_rek_jenis.`nm_rek_jenis` AS sikd_rek_jenis_nm_rek_jenis,
                    sikd_rek_obj.`kd_rek_obj` AS sikd_rek_obj_kd_rek_obj,
                    sikd_rek_obj.`nm_rek_obj` AS sikd_rek_obj_nm_rek_obj,
                    sikd_rek_rincian_obj.`kd_rek_rincian_obj` AS sikd_rek_rincian_obj_kd_rek_rincian_obj,
                    sikd_rek_rincian_obj.`nm_rek_rincian_obj` AS sikd_rek_rincian_obj_nm_rek_rincian_obj,
                    SUM(IF(SUBSTR(ppas_mata_anggaran.kd_rekening,1,2) = '61',1,-1) * IF(:status='0', ppas_mata_anggaran.`jml_usulan`, ppas_mata_anggaran.`jml_final`)) AS netto_ppas,
                    0 AS netto_rka,
                    SUM(IF(:status='0', ppas_mata_anggaran.`jml_usulan`, ppas_mata_anggaran.`jml_final`)) AS ppas_mata_anggaran_jumlah,
                    0 AS rka_mata_anggaran_jumlah
                FROM
                    `ppas_ppas` ppas_ppas
                    INNER JOIN `ppas_anggaran` ppas_anggaran ON ppas_anggaran.`ppas_ppas_id` = ppas_ppas.`id_ppas_ppas`
                    AND ppas_anggaran.ppas_anggaran_type = 'PpasPembiayaan'
                    INNER JOIN `ppas_mata_anggaran` ppas_mata_anggaran ON ppas_anggaran.`id_ppas_anggaran` = ppas_mata_anggaran.`ppas_anggaran_id`
                    #INNER JOIN `ppas_pembiayaan` ppas_pembiayaan ON ppas_anggaran.`id_ppas_anggaran` = ppas_pembiayaan.`id_ppas_pembiayaan`
                    INNER JOIN `sikd_satker` sikd_satker ON ppas_anggaran.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                    INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON ppas_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                    INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                    INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                    INNER JOIN `sikd_rek_kelompok` sikd_rek_kelompok ON sikd_rek_jenis.`sikd_rek_kelompok_id` = sikd_rek_kelompok.`id_sikd_rek_kelompok`
                WHERE
                    ppas_ppas.`id_ppas_ppas` = :id_ppas
                GROUP BY
                    sikd_rek_kelompok_kd_rek_kelompok,
                    sikd_satker_id_sikd_satker,
                    sikd_rek_rincian_obj_kd_rek_rincian_obj
                UNION
                SELECT
                    sikd_satker.`id_sikd_satker` AS sikd_satker_id_sikd_satker,
                    sikd_satker.`kode` AS sikd_satker_kode,
                    sikd_satker.`nama` AS sikd_satker_nama,
                    sikd_rek_kelompok.`kd_rek_kelompok` AS sikd_rek_kelompok_kd_rek_kelompok,
                    sikd_rek_kelompok.`nm_rek_kelompok` AS sikd_rek_kelompok_nm_rek_kelompok,
                    sikd_rek_jenis.`kd_rek_jenis` AS sikd_rek_jenis_kd_rek_jenis,
                    sikd_rek_jenis.`nm_rek_jenis` AS sikd_rek_jenis_nm_rek_jenis,
                    sikd_rek_obj.`kd_rek_obj` AS sikd_rek_obj_kd_rek_obj,
                    sikd_rek_obj.`nm_rek_obj` AS sikd_rek_obj_nm_rek_obj,
                    sikd_rek_rincian_obj.`kd_rek_rincian_obj` AS sikd_rek_rincian_obj_kd_rek_rincian_obj,
                    sikd_rek_rincian_obj.`nm_rek_rincian_obj` AS sikd_rek_rincian_obj_nm_rek_rincian_obj,
                    0 AS netto_ppas,
                    sum(if(substr(rka_mata_anggaran.`kd_rekening`,1,2) = '61', 1,-1) * rka_mata_anggaran.`jumlah`) AS netto_rka,
                    0 AS ppas_mata_anggaran_jumlah,
                    sum(ifnull(rka_mata_anggaran.`jumlah`,0)) AS rka_mata_anggaran_jumlah
                FROM
                    `rka_rka` rka_rka
                    INNER JOIN `rka_mata_anggaran` rka_mata_anggaran ON rka_mata_anggaran.`rka_rka` = rka_rka.`id_rka_rka`
                    AND (rka_rka.rka_rka_type = 'RkaSkpkdPenerimaan' 
                    OR  rka_rka.rka_rka_type = 'RkaSkpkdPengeluaran')
                    AND CASE
                            WHEN :id_ppas = (SELECT ppas_ppas.`id_ppas_ppas` FROM ppas_ppas WHERE jns_ppas = 'PPAS-A') THEN rka_rka.`rka_perubahan` = '0' OR rka_rka.`rka_perubahan` IS NULL
                            ELSE rka_rka.`rka_perubahan`='1'
                        END
                    INNER JOIN `sikd_satker` sikd_satker ON rka_rka.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                    #INNER JOIN `rka_skpkd` rka_skpkd ON rka_rka.`id_rka_rka` = rka_skpkd.`id_rka_skpkd`
                    INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON rka_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                    INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                    INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                    INNER JOIN `sikd_rek_kelompok` sikd_rek_kelompok ON sikd_rek_jenis.`sikd_rek_kelompok_id` = sikd_rek_kelompok.`id_sikd_rek_kelompok`
                #WHERE
                #    (rka_rka.rka_rka_type = 'RkaSkpkdPenerimaan'
                #OR rka_rka.rka_rka_type = 'RkaSkpkdPengeluaran')
                GROUP BY
                    sikd_rek_kelompok_kd_rek_kelompok,
                    sikd_satker_id_sikd_satker,
                    sikd_rek_rincian_obj_kd_rek_rincian_obj
                ORDER BY
                    sikd_rek_kelompok_kd_rek_kelompok ASC,
                    sikd_satker_kode ASC,
                    sikd_satker_id_sikd_satker ASC,
                    sikd_rek_rincian_obj_kd_rek_rincian_obj ASC
                ";

            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_ppas", $id_ppas);
            $statement->bindValue("status", $status);
            $statement->execute();
            $rekapProyeksi = $statement->fetchAll();
            
            return new JsonResponse($rekapProyeksi);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    private function getPpasRekapProgramRkaNonPpas($request)
    {
        try {
            $id_ppas = $request->query->get("id_ppas");
            //$status = $request->query->get("status");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $id_ppas = $this->convertOuuidToUuid($id_ppas);
            $this->connection = $conn->getConnection();
            $sql = 
                "SELECT
                    sikd_kgtn.`kd_kgtn` AS sikd_kgtn_kd_kgtn,
                    sikd_kgtn.`nm_kgtn` AS sikd_kgtn_nm_kgtn,
                    sikd_satker.`id_sikd_satker` AS sikd_satker_id_sikd_satker,
                    sikd_satker.`kode` AS sikd_satker_kode,
                    sikd_satker.`nama` AS sikd_satker_nama,
                    sikd_sub_skpd.`kode` AS sikd_sub_skpd_kode,
                    sikd_sub_skpd.`nama` AS sikd_sub_skpd_nama,
                    rka_mata_anggaran.`kd_rekening` AS rka_mata_anggaran_kd_rekening,
                    ifnull(rka_mata_anggaran.`jumlah`,0) AS rka_mata_anggaran_jumlah
                FROM
                    `rka_rka` rka_rka
                    #INNER JOIN `rka_skpd` rka_skpd ON rka_rka.`id_rka_rka` = rka_skpd.`id_rka_skpd`
                    #INNER JOIN `rka_skpd_kgtn` rka_skpd_kgtn ON rka_skpd.`id_rka_skpd` = rka_skpd_kgtn.`id_rka_skpd_kgtn`
                    INNER JOIN `sikd_kgtn` sikd_kgtn ON rka_rka.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                    AND rka_rka.rka_rka_type = 'RkaSkpdKgtn'
                    INNER JOIN `sikd_satker` sikd_satker ON rka_rka.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                    LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON rka_rka.`sikd_sub_satker_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                    LEFT OUTER JOIN `rka_mata_anggaran` rka_mata_anggaran ON rka_mata_anggaran.`rka_rka` = rka_rka.`id_rka_rka` 
                WHERE
                    rka_rka.ppas_anggaran_id
                NOT IN 
                    (SELECT ppas_anggaran.`id_ppas_anggaran` FROM ppas_anggaran, ppas_ppas
                        WHERE ppas_anggaran.`ppas_ppas_id` = ppas_ppas.`id_ppas_ppas`
                        -- AND ppas_anggaran.`ppas_anggaran_type` = 'PpasBlnjLangsung'
                        AND ppas_anggaran.`ppas_anggaran_type` = 'PpasBelanja'
                        AND ppas_ppas.`ppas_ppas_id` = :id_ppas
                        )
                ORDER BY
                    sikd_satker_kode ASC,
                    sikd_satker_id_sikd_satker ASC,
                    sikd_sub_skpd_kode ASC,
                    sikd_kgtn_kd_kgtn ASC,
                    rka_mata_anggaran_kd_rekening ASC
                ";

            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_ppas", $id_ppas);
            //$statement->bindValue("status", $status);
            $statement->execute();
            $rekapProyeksi = $statement->fetchAll();
            
            return new JsonResponse($rekapProyeksi);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }

    private function getPpasRekapProgramPpasNonRka($request)
    {
        try {
            $id_ppas = $request->query->get("id_ppas");
            $status = $request->query->get("status");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $id_ppas = $this->convertOuuidToUuid($id_ppas);
            $this->connection = $conn->getConnection();
            $sql = 
                "SELECT
                    sikd_bidang.`kd_bidang` AS sikd_bidang_kd_bidang,
                    sikd_bidang.`nm_bidang` AS sikd_bidang_nm_bidang,
                    sikd_prog.`kd_prog` AS sikd_prog_kd_prog,
                    sikd_prog.`nm_prog` AS sikd_prog_nm_prog,
                    sikd_kgtn.`kd_kgtn` AS sikd_kgtn_kd_kgtn,
                    sikd_kgtn.`nm_kgtn` AS sikd_kgtn_nm_kgtn,
                    sikd_satker.`id_sikd_satker` AS sikd_satker_id_sikd_satker,
                    sikd_satker.`kode` AS sikd_satker_kode,
                    sikd_satker.`nama` AS sikd_satker_nama,
                    sikd_sub_skpd.`kode` AS sikd_sub_skpd_kode,
                    sikd_sub_skpd.`nama` AS sikd_sub_skpd_nama,
                    SUM(IF(:status='0', ppas_anggaran.`jml_usulan`, ppas_anggaran.`jml_final`)) AS rka_mata_anggaran_jumlah
                FROM
                    `ppas_ppas` ppas_ppas
                    INNER JOIN `ppas_anggaran` ppas_anggaran ON ppas_anggaran.`ppas_ppas_id` = ppas_ppas.`id_ppas_ppas`
                    -- AND ppas_anggaran.`ppas_anggaran_type` = 'PpasBlnjLangsung'
                    AND ppas_anggaran.`ppas_anggaran_type` = 'PpasBelanja'
                    #INNER JOIN `ppas_blnj_langsung` ppas_blnj_langsung ON ppas_anggaran.`id_ppas_anggaran` = ppas_blnj_langsung.`id_ppas_blnj_langsung`
                    INNER JOIN `sikd_kgtn` sikd_kgtn ON ppas_anggaran.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                    INNER JOIN `sikd_bidang` sikd_bidang ON ppas_anggaran.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                    INNER JOIN `sikd_urusan` sikd_urusan ON sikd_bidang.`sikd_urusan_id` = sikd_urusan.`id_sikd_urusan`
                    INNER JOIN `sikd_prog` sikd_prog ON sikd_kgtn.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                    INNER JOIN `sikd_satker` sikd_satker ON ppas_anggaran.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                    LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON ppas_anggaran.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                WHERE 
                    ppas_ppas.`id_ppas_ppas` = :id_ppas
                AND ppas_anggaran.`id_ppas_anggaran` NOT IN 
                (Select b.ppas_anggaran_id from rka_rka b
                    WHERE b.sikd_satker_id = ppas_anggaran.`sikd_satker_id`
                    and b.sikd_sub_satker_id = ppas_anggaran.`sikd_sub_skpd_id`)
                GROUP BY
                    sikd_bidang_kd_bidang,
                    sikd_prog_kd_prog,
                    sikd_satker_kode,
                    sikd_satker_id_sikd_satker,
                    sikd_sub_skpd_kode,
                    sikd_kgtn_kd_kgtn
                ORDER BY
                    sikd_bidang_kd_bidang ASC,
                    sikd_prog_kd_prog ASC,
                    sikd_satker_kode ASC,
                    sikd_satker_id_sikd_satker ASC,
                    sikd_sub_skpd_kode ASC,
                    sikd_kgtn_kd_kgtn ASC
                ";

            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_ppas", $id_ppas);
            $statement->bindValue("status", $status);
            $statement->execute();
            $rekapProyeksi = $statement->fetchAll();
            
            return new JsonResponse($rekapProyeksi);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
}