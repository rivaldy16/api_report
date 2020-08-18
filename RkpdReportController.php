<?php
namespace App\Controller\Rkpd;

use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Delete;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * @RouteResource("rkpdreport")
 */
class RkpdReportController extends \App\Controller\ApiBaseController
{
    //protected $dbalConnName = 'simral_rkpd';
    
    public function cgetAction(Request $request)
    {        
        //print_r("ok");exit;
        $rpt = $request->query->get("jns_report");

        switch ($rpt) {

            //SINKRONISASI
             case "rkpd_sinkronisasi_01" :
                return $this->getRkpdSinkronisasi01($request);
            case "rkpd_sinkronisasi_02" :
                return $this->getRkpdSinkronisasi02($request);
            case "rkpd_sinkronisasi_03" :
                return $this->getRkpdSinkronisasi03($request);
            case "rkpd_sinkronisasi_04" :
                return $this->getRkpdSinkronisasi04($request);
            case "rkpd_sinkronisasi_05" :
                return $this->getRkpdSinkronisasi05($request);
            case "rkpd_sinkronisasi_05_0" :
                return $this->getRkpdSinkronisasi050($request);
            case "rkpd_sinkronisasi_05_1" :
                return $this->getRkpdSinkronisasi051($request);
            case "rkpd_sinkronisasi_05_2" :
                return $this->getRkpdSinkronisasi052($request);
            case "rkpd_sinkronisasi_05_3" :
                return $this->getRkpdSinkronisasi053($request);

            //REKAPITULASI
            case "rkpd_rekap_proyeksi" ://RENTAN REVISI P90
                return $this->getRkpdRekapProyeksi($request);
            case "rkpd_rekap_bidang_prog" :
                return $this->getRkpdRekapBidangProg($request);
            case "rkpd_rekap_prog_kgtn" :
                return $this->getRkpdRekapBidangProgKgtn($request);
            case "rkpd_rekap_satker" :
                return $this->getRkpdRekapSatker($request);
            case "rkpd_rekap_urusan_satker" :
                return $this->getRkpdRekapUrusanSatker($request);
            case "rkpd_rekap_satker_prog_kgtn_1" :
                return $this->getRkpdRekapSatkerProgKgtn1($request);
            case "rkpd_rekap_satker_prog_kgtn_2" :
                return $this->getRkpdRekapSatkerProgKgtn2($request);
            case "rkpd_list_kgtn_skpd" :
                return $this->getRkpdRekapListKgtnSkpd($request);
            case "rkpd_rekap_satker_1" :
                return $this->getRkpdRekapSatker1($request);
            case "rkpd_rekap_satker_2" ://RENTAN REVISI P90
                return $this->getRkpdRekapSatker2($request);
            
            //PERMENDAGRI
            case "rkpd_lamp_permen23_1b" :
                return $this->getRkpdLampPermen231b($request);
            case "rkpd_lamp_permen23_1c" :
                return $this->getRkpdLampPermen231c($request);
            case "rkpd_lamp_permen23_1d" :
                return $this->getRkpdLampPermen231d($request);
            case "rkpd_lamp_permen23_1d_sub1" :
                return $this->getRkpdLampPermen231dSub1($request);
            case "rkpd_lamp_permen23_1d_mod" :
                return $this->getRkpdLampPermen231dMod($request);
            case "rkpd_lamp_permen23_1d_mod_sub1" :
                return $this->getRkpdLampPermen231dModSub1($request);
            case "rkpd_lamp_permen23_1d_mod2" :
                return $this->getRkpdLampPermen231dMod2($request);
            case "rkpd_lamp_permen23_1d_mod2_sub1" :
                return $this->getRkpdLampPermen231dMod2Sub1($request);
            case "rkpd_lamp_permen23_1e" :
                return $this->getRkpdLampPermen231e($request);
            case "rkpd_lamp_permen23_1e_sub1" :
                return $this->getRkpdLampPermen231eSub1($request);
            case "rkpd_lamp_permen23_2b" :
                return $this->getRkpdLampPermen232b($request);
            case "rkpd_lamp_permen23_2b_sub1" :
                return $this->getRkpdLampPermen232bSub1($request);

            //OTHERS
            case "sub_rekap_list_kgtn_skpd" :
                return $this->getSubQRkpdRekapListKgtnSkpd($request);
            case "indikasi_rencana_prog_kgtn_prio" :
                return $this->getRenstraIndikasiRencanaProgKgtnPrio($request);
            default:
                throw new BadRequestHttpException("Undefined report");
        }
    }

    //SINKRONISASI
    private function getRkpdSinkronisasi01($request)
    {
        try {
            

            $tahun = $request->query->get("tahun");
            //$kdPrioritas = $request->query->get("prioritas");
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            //$tahun = pack('H*', str_replace('-', '', trim($tahun)));
            $this->connection = $conn->getConnection();
            
            //print_r("ok");exit;

            $sql = "SELECT
                         rkpd_prioritas_nasional.`tahun` AS rkpd_rkpd_tahun,
                         CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_prioritas_nasional.`id_rkpd_prioritas_nasional`), 1, 8),
                         SUBSTR(HEX(rkpd_prioritas_nasional.`id_rkpd_prioritas_nasional`), 9, 4),
                         SUBSTR(HEX(rkpd_prioritas_nasional.`id_rkpd_prioritas_nasional`), 13, 4),
                         SUBSTR(HEX(rkpd_prioritas_nasional.`id_rkpd_prioritas_nasional`), 17, 4),
                         SUBSTR(HEX(rkpd_prioritas_nasional.`id_rkpd_prioritas_nasional`), 21)
                            ) AS rkpd_prioritas_nasional_id_rkpd_prioritas_nasional,
                         rkpd_prioritas_nasional.`no_prioritas` AS rkpd_prioritas_nasional_no_prioritas, 
                         concat(rkpd_prioritas_nasional.`bidang_prioritas`,'\n',rkpd_prioritas_nasional.`nm_program`,'\nTema:\n',rkpd_prioritas_nasional.`tema_program`) AS rkpd_prioritas_nasional_tema_prioritas,
                         rkpd_prioritas_nasional.`nm_program` AS rkpd_prioritas_nasional_nm_program,
                         rkpd_prioritas_nasional.`tema_program` AS rkpd_prioritas_nasional_tema_program,
                         CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_prioritas_prov.`id_rkpd_prioritas_prov`), 1, 8),
                         SUBSTR(HEX(rkpd_prioritas_prov.`id_rkpd_prioritas_prov`), 9, 4),
                         SUBSTR(HEX(rkpd_prioritas_prov.`id_rkpd_prioritas_prov`), 13, 4),
                         SUBSTR(HEX(rkpd_prioritas_prov.`id_rkpd_prioritas_prov`), 17, 4),
                         SUBSTR(HEX(rkpd_prioritas_prov.`id_rkpd_prioritas_prov`), 21)
                            ) AS rkpd_prioritas_prov_id_rkpd_prioritas_prov,
                         rkpd_prioritas_prov.`no_prioritas` AS rkpd_prioritas_prov_no_prioritas,
                         concat(rkpd_prioritas_prov.`bidang_prioritas`,'\n',rkpd_prioritas_prov.`nm_program`,'\nTema:\n',rkpd_prioritas_prov.`tema_program`) AS rkpd_prioritas_prov_tema_prioritas,
                         rkpd_prioritas_prov.`nm_program` AS rkpd_prioritas_prov_nm_program,
                         rkpd_prioritas_prov.`tema_program` AS rkpd_prioritas_prov_tema_program,
                         CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_prioritas_kab.`id_rkpd_prioritas_kab`), 1, 8),
                         SUBSTR(HEX(rkpd_prioritas_kab.`id_rkpd_prioritas_kab`), 9, 4),
                         SUBSTR(HEX(rkpd_prioritas_kab.`id_rkpd_prioritas_kab`), 13, 4),
                         SUBSTR(HEX(rkpd_prioritas_kab.`id_rkpd_prioritas_kab`), 17, 4),
                         SUBSTR(HEX(rkpd_prioritas_kab.`id_rkpd_prioritas_kab`), 21)
                            ) AS rkpd_prioritas_kab_id_rkpd_prioritas_kab,
                         rkpd_prioritas_kab.`no_prioritas` AS rkpd_prioritas_kab_no_prioritas,
                         concat(rkpd_prioritas_kab.`bidang_prioritas`,'\n',rkpd_prioritas_kab.`nm_program`,'\nTema:\n',rkpd_prioritas_kab.`tema_program`) AS rkpd_prioritas_kab_tema_prioritas,
                         rkpd_prioritas_kab.`nm_program` AS rkpd_prioritas_kab_nm_program,
                         rkpd_prioritas_kab.`tema_program` AS rkpd_prioritas_kab_tema_program
                    FROM
                         `rkpd_prioritas_nasional` rkpd_prioritas_nasional
                         LEFT OUTER JOIN `rkpd_prioritas_prov` rkpd_prioritas_prov ON rkpd_prioritas_prov.`rkpd_prioritas_nasional_id` = rkpd_prioritas_nasional.`id_rkpd_prioritas_nasional`
                         LEFT OUTER JOIN `rkpd_prioritas_kab` rkpd_prioritas_kab ON rkpd_prioritas_prov.`id_rkpd_prioritas_prov` = rkpd_prioritas_kab.`rkpd_prioritas_prov_id`
                    WHERE 
                         rkpd_prioritas_nasional.tahun = :tahun
                    UNION

                    SELECT
                         rkpd_prioritas_nasional.`tahun` AS rkpd_rkpd_tahun,
                         CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_prioritas_nasional.`id_rkpd_prioritas_nasional`), 1, 8),
                         SUBSTR(HEX(rkpd_prioritas_nasional.`id_rkpd_prioritas_nasional`), 9, 4),
                         SUBSTR(HEX(rkpd_prioritas_nasional.`id_rkpd_prioritas_nasional`), 13, 4),
                         SUBSTR(HEX(rkpd_prioritas_nasional.`id_rkpd_prioritas_nasional`), 17, 4),
                         SUBSTR(HEX(rkpd_prioritas_nasional.`id_rkpd_prioritas_nasional`), 21)
                            ) AS rkpd_prioritas_nasional_id_rkpd_prioritas_nasional,
                         rkpd_prioritas_nasional.`no_prioritas` AS rkpd_prioritas_nasional_no_prioritas,
                         concat(rkpd_prioritas_nasional.`bidang_prioritas`,'\n',rkpd_prioritas_nasional.`nm_program`,'\nTema:\n',rkpd_prioritas_nasional.`tema_program`) AS rkpd_prioritas_nasional_tema_prioritas,
                         rkpd_prioritas_nasional.`nm_program` AS rkpd_prioritas_nasional_nm_program,
                         rkpd_prioritas_nasional.`tema_program` AS rkpd_prioritas_nasional_tema_program,
                         '-' AS rkpd_prioritas_prov_id_rkpd_prioritas_prov,
                         '-' AS rkpd_prioritas_prov_no_prioritas,
                         '-' AS rkpd_prioritas_prov_tema_prioritas,
                         '-' AS rkpd_prioritas_prov_nm_program,
                         '-' AS rkpd_prioritas_prov_tema_program,
                         CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_prioritas_kab.`id_rkpd_prioritas_kab`), 1, 8),
                         SUBSTR(HEX(rkpd_prioritas_kab.`id_rkpd_prioritas_kab`), 9, 4),
                         SUBSTR(HEX(rkpd_prioritas_kab.`id_rkpd_prioritas_kab`), 13, 4),
                         SUBSTR(HEX(rkpd_prioritas_kab.`id_rkpd_prioritas_kab`), 17, 4),
                         SUBSTR(HEX(rkpd_prioritas_kab.`id_rkpd_prioritas_kab`), 21)
                            ) AS rkpd_prioritas_kab_id_rkpd_prioritas_kab,
                         rkpd_prioritas_kab.`no_prioritas` AS rkpd_prioritas_kab_no_prioritas,
                         concat(rkpd_prioritas_kab.`bidang_prioritas`,'\n',rkpd_prioritas_kab.`nm_program`,'\nTema:\n',rkpd_prioritas_kab.`tema_program`) AS rkpd_prioritas_kab_tema_prioritas,
                         rkpd_prioritas_kab.`nm_program` AS rkpd_prioritas_kab_nm_program,
                         rkpd_prioritas_kab.`tema_program` AS rkpd_prioritas_kab_tema_program
                    FROM
                         `rkpd_prioritas_nasional` rkpd_prioritas_nasional 
                        INNER JOIN `rkpd_prioritas_kab` rkpd_prioritas_kab ON rkpd_prioritas_nasional.`id_rkpd_prioritas_nasional` = rkpd_prioritas_kab.`rkpd_prioritas_nasional_id`
                        AND rkpd_prioritas_kab.`rkpd_prioritas_prov_id` = ''
                    WHERE 
                         rkpd_prioritas_nasional.tahun = :tahun

                    UNION
                    SELECT
                         rkpd_prioritas_prov.`tahun` AS rkpd_rkpd_tahun,
                         '-' AS rkpd_prioritas_nasional_id_rkpd_prioritas_nasional,
                         '-' AS rkpd_prioritas_nasional_no_prioritas,
                         '-' AS rkpd_prioritas_nasional_tema_prioritas,
                         '-' AS rkpd_prioritas_nasional_nm_program,
                         '-' AS rkpd_prioritas_nasional_tema_program,
                         CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_prioritas_prov.`id_rkpd_prioritas_prov`), 1, 8),
                         SUBSTR(HEX(rkpd_prioritas_prov.`id_rkpd_prioritas_prov`), 9, 4),
                         SUBSTR(HEX(rkpd_prioritas_prov.`id_rkpd_prioritas_prov`), 13, 4),
                         SUBSTR(HEX(rkpd_prioritas_prov.`id_rkpd_prioritas_prov`), 17, 4),
                         SUBSTR(HEX(rkpd_prioritas_prov.`id_rkpd_prioritas_prov`), 21)
                            ) AS rkpd_prioritas_prov_id_rkpd_prioritas_prov,
                         rkpd_prioritas_prov.`no_prioritas` AS rkpd_prioritas_prov_no_prioritas,
                         concat(rkpd_prioritas_prov.`bidang_prioritas`,'\n',rkpd_prioritas_prov.`nm_program`,'\nTema:\n',rkpd_prioritas_prov.`tema_program`) AS rkpd_prioritas_prov_tema_prioritas,
                         rkpd_prioritas_prov.`nm_program` AS rkpd_prioritas_prov_nm_program,
                         rkpd_prioritas_prov.`tema_program` AS rkpd_prioritas_prov_tema_program,
                         CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_prioritas_kab.`id_rkpd_prioritas_kab`), 1, 8),
                         SUBSTR(HEX(rkpd_prioritas_kab.`id_rkpd_prioritas_kab`), 9, 4),
                         SUBSTR(HEX(rkpd_prioritas_kab.`id_rkpd_prioritas_kab`), 13, 4),
                         SUBSTR(HEX(rkpd_prioritas_kab.`id_rkpd_prioritas_kab`), 17, 4),
                         SUBSTR(HEX(rkpd_prioritas_kab.`id_rkpd_prioritas_kab`), 21)
                            ) AS rkpd_prioritas_kab_id_rkpd_prioritas_kab,
                         rkpd_prioritas_kab.`no_prioritas` AS rkpd_prioritas_kab_no_prioritas,
                         concat(rkpd_prioritas_kab.`bidang_prioritas`,'\n',rkpd_prioritas_kab.`nm_program`,'\nTema:\n',rkpd_prioritas_kab.`tema_program`) AS rkpd_prioritas_kab_tema_prioritas,
                         rkpd_prioritas_kab.`nm_program` AS rkpd_prioritas_kab_nm_program,
                         rkpd_prioritas_kab.`tema_program` AS rkpd_prioritas_kab_tema_program
                    FROM
                         `rkpd_prioritas_prov` rkpd_prioritas_prov
                         LEFT OUTER JOIN `rkpd_prioritas_kab` rkpd_prioritas_kab ON rkpd_prioritas_prov.`id_rkpd_prioritas_prov` = rkpd_prioritas_kab.`rkpd_prioritas_prov_id`
                    WHERE 
                        rkpd_prioritas_prov.tahun = :tahun
                        AND rkpd_prioritas_prov.`rkpd_prioritas_nasional_id` = ''
                    UNION
                    SELECT
                         rkpd_prioritas_kab.`tahun` AS rkpd_rkpd_tahun,
                         '-' AS rkpd_prioritas_nasional_id_rkpd_prioritas_nasional,
                         '-' AS rkpd_prioritas_nasional_no_prioritas,
                         '-' AS rkpd_prioritas_nasional_tema_prioritas,
                         '-' AS rkpd_prioritas_nasional_nm_program,
                         '-' AS rkpd_prioritas_nasional_tema_program,
                         '-' AS rkpd_prioritas_prov_id_rkpd_prioritas_prov,
                         '-' AS rkpd_prioritas_prov_no_prioritas,
                         '-' AS rkpd_prioritas_prov_tema_prioritas,
                         '-' AS rkpd_prioritas_prov_nm_program,
                         '-' AS rkpd_prioritas_prov_tema_program,
                         CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_prioritas_kab.`id_rkpd_prioritas_kab`), 1, 8),
                         SUBSTR(HEX(rkpd_prioritas_kab.`id_rkpd_prioritas_kab`), 9, 4),
                         SUBSTR(HEX(rkpd_prioritas_kab.`id_rkpd_prioritas_kab`), 13, 4),
                         SUBSTR(HEX(rkpd_prioritas_kab.`id_rkpd_prioritas_kab`), 17, 4),
                         SUBSTR(HEX(rkpd_prioritas_kab.`id_rkpd_prioritas_kab`), 21)
                            ) AS rkpd_prioritas_kab_id_rkpd_prioritas_kab,
                         rkpd_prioritas_kab.`no_prioritas` AS rkpd_prioritas_kab_no_prioritas,
                         concat(rkpd_prioritas_kab.`bidang_prioritas`,'\n',rkpd_prioritas_kab.`nm_program`,'\nTema:\n',rkpd_prioritas_kab.`tema_program`) AS rkpd_prioritas_kab_tema_prioritas,
                         rkpd_prioritas_kab.`nm_program` AS rkpd_prioritas_kab_nm_program,
                         rkpd_prioritas_kab.`tema_program` AS rkpd_prioritas_kab_tema_program
                    FROM
                         `rkpd_prioritas_kab` rkpd_prioritas_kab 
                    WHERE 
                         rkpd_prioritas_kab.tahun = :tahun
                     AND rkpd_prioritas_kab.`rkpd_prioritas_nasional_id` = ''
                     AND rkpd_prioritas_kab.`rkpd_prioritas_prov_id` = ''
                    ORDER BY
                         lpad(rkpd_prioritas_nasional_no_prioritas,2,0),
                         lpad(rkpd_prioritas_prov_no_prioritas,2,0),
                         lpad(rkpd_prioritas_kab_no_prioritas,2,0)
                    ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("tahun", $tahun);
            //$statement->bindValue("kdPrioritas", $kdPrioritas);
            
            $statement->execute();
            $renstraReport = $statement->fetchAll();

            return new JsonResponse($renstraReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }

    private function getRkpdSinkronisasi02($request)
    {
        try {
            
            $idRkpd = $request->query->get("id_rkpd");
            $tahun = $request->query->get("tahun");
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRkpd = pack('H*', str_replace('-', '', trim($idRkpd)));
            $this->connection = $conn->getConnection();
            
            //print_r("ok");exit;
            
            $sql = "SELECT
                     rkpd_rkpd.`jns_rkpd` AS jns_rkpd,
                     CONCAT_WS('-',
                      SUBSTR(HEX(rkpd_prioritas_nasional.`id_rkpd_prioritas_nasional`), 1, 8),
                      SUBSTR(HEX(rkpd_prioritas_nasional.`id_rkpd_prioritas_nasional`), 9, 4),
                      SUBSTR(HEX(rkpd_prioritas_nasional.`id_rkpd_prioritas_nasional`), 13, 4),
                      SUBSTR(HEX(rkpd_prioritas_nasional.`id_rkpd_prioritas_nasional`), 17, 4),
                      SUBSTR(HEX(rkpd_prioritas_nasional.`id_rkpd_prioritas_nasional`), 21)
                         ) AS rkpd_prioritas_nasional_id_rkpd_prioritas_nasional,
                     rkpd_prioritas_nasional.`tahun` AS rkpd_prioritas_tahun,
                     rkpd_prioritas_nasional.`no_prioritas` AS rkpd_prioritas_no_prioritas,
                     rkpd_prioritas_nasional.`bidang_prioritas` AS rkpd_prioritas_bidang_prioritas,
                     rkpd_prioritas_nasional.`nm_program` AS rkpd_prioritas_nm_program,
                     CONCAT_WS('-',
                      SUBSTR(HEX(rkpd_sasaran.`id_rkpd_sasaran`), 1, 8),
                      SUBSTR(HEX(rkpd_sasaran.`id_rkpd_sasaran`), 9, 4),
                      SUBSTR(HEX(rkpd_sasaran.`id_rkpd_sasaran`), 13, 4),
                      SUBSTR(HEX(rkpd_sasaran.`id_rkpd_sasaran`), 17, 4),
                      SUBSTR(HEX(rkpd_sasaran.`id_rkpd_sasaran`), 21)
                         ) AS rkpd_sasaran_id_rkpd_sasaran,
                     rkpd_sasaran.`no_sasaran` AS rkpd_sasaran_no_sasaran,
                     rkpd_sasaran.`uraian_sasaran` AS rkpd_sasaran_uraian_sasaran,
                     CONCAT_WS('-',
                      SUBSTR(HEX(rkpd_program.`id_rkpd_program`), 1, 8),
                      SUBSTR(HEX(rkpd_program.`id_rkpd_program`), 9, 4),
                      SUBSTR(HEX(rkpd_program.`id_rkpd_program`), 13, 4),
                      SUBSTR(HEX(rkpd_program.`id_rkpd_program`), 17, 4),
                      SUBSTR(HEX(rkpd_program.`id_rkpd_program`), 21)
                         ) AS rkpd_program_id_rkpd_program,
                     rkpd_program.`kd_program` AS rkpd_program_kd_program,
                     if(length(sikd_kgtn.`kd_kgtn`) = 4, substring(sikd_kgtn.`kd_kgtn`,-2),
                        if(length(sikd_kgtn.`kd_kgtn`) = 5, substring(sikd_kgtn.`kd_kgtn`,-3), substring(sikd_kgtn.`kd_kgtn`,-4))) AS sikd_kgtn_kd_kgtn,
                     sikd_kgtn.`nm_kgtn` AS sikd_kgtn_nm_kgtn,
                     sikd_prog.`kd_prog` AS sikd_prog_kd_prog,
                     sikd_prog.`nm_prog` AS sikd_prog_nm_prog,
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
                      SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 1, 8),
                      SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 9, 4),
                      SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 13, 4),
                      SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 17, 4),
                      SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 21)
                         ) AS rkpd_kegiatan_id_rkpd_kegiatan,
                     rkpd_kegiatan.`sikd_kgtn_id` AS rkpd_kegiatan_sikd_kgtn_id,
                     rkpd_kegiatan.`kd_kegiatan` AS rkpd_kegiatan_kd_kegiatan,
                     rkpd_kegiatan.`nm_kegiatan` AS rkpd_kegiatan_nm_kegiatan,
                     rkpd_kegiatan.`nm_subkegiatan` AS rkpd_kegiatan_nm_subkegiatan,
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
                      SUBSTR(HEX(if(rkpd_kegiatan.`sikd_sub_skpd_id`!='', sikd_sub_skpd.`id_sikd_sub_skpd`, sikd_satker.`id_sikd_satker`)), 1, 8),
                      SUBSTR(HEX(if(rkpd_kegiatan.`sikd_sub_skpd_id`!='', sikd_sub_skpd.`id_sikd_sub_skpd`, sikd_satker.`id_sikd_satker`)), 9, 4),
                      SUBSTR(HEX(if(rkpd_kegiatan.`sikd_sub_skpd_id`!='', sikd_sub_skpd.`id_sikd_sub_skpd`, sikd_satker.`id_sikd_satker`)), 13, 4),
                      SUBSTR(HEX(if(rkpd_kegiatan.`sikd_sub_skpd_id`!='', sikd_sub_skpd.`id_sikd_sub_skpd`, sikd_satker.`id_sikd_satker`)), 17, 4),
                      SUBSTR(HEX(if(rkpd_kegiatan.`sikd_sub_skpd_id`!='', sikd_sub_skpd.`id_sikd_sub_skpd`, sikd_satker.`id_sikd_satker`)), 21)
                         ) AS sikd_sub_skpd_id_sikd_sub_skpd,
                     if(CONCAT_WS('-',
                      SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 1, 8),
                      SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 9, 4),
                      SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 13, 4),
                      SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 17, 4),
                      SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 21)
                         )!='', sikd_sub_skpd.`kode`, sikd_satker.`kode`) AS sikd_sub_skpd_kode,
                     if(CONCAT_WS('-',
                      SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 1, 8),
                      SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 9, 4),
                      SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 13, 4),
                      SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 17, 4),
                      SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 21)
                         )!='', sikd_sub_skpd.`nama`, sikd_satker.`nama`) AS sikd_sub_skpd_nama,
                     rkpd_program.`pagu_indikatif` AS rkpd_program_pagu_indikatif,
                     SUM(IFNULL(rkpd_kegiatan.`jml_anggaran_rkpd`,0)) AS rkpd_kegiatan_jml_anggaran_rkpd,
                     SUM(IFNULL(renja_kegiatan.`tgt_anggaran_thn_ini`,0)) AS renja_kegiatan_tgt_anggaran_thn_ini,
                     SUM((IFNULL(rkpd_kegiatan.`jml_anggaran_rkpd`,0) - IFNULL(renja_kegiatan.`tgt_anggaran_thn_ini`,0))) AS jml_selisih_rkpd_renja
                FROM
                     `rkpd_prioritas_nasional` rkpd_prioritas_nasional 
                     LEFT OUTER JOIN `rkpd_prioritas_prov` rkpd_prioritas_prov ON rkpd_prioritas_nasional.`id_rkpd_prioritas_nasional` = rkpd_prioritas_prov.`rkpd_prioritas_nasional_id` 
                     LEFT OUTER JOIN `rkpd_prioritas_kab` rkpd_prioritas_kab ON rkpd_prioritas_prov.`id_rkpd_prioritas_prov` = rkpd_prioritas_kab.`rkpd_prioritas_prov_id` 
                     INNER JOIN `rkpd_sasaran` rkpd_sasaran  ON rkpd_sasaran.`rkpd_prioritas_kab_id` = rkpd_prioritas_kab.`id_rkpd_prioritas_kab`
                     INNER JOIN `rkpd_sasaran_program` rkpd_sasaran_program ON rkpd_sasaran.`id_rkpd_sasaran` = rkpd_sasaran_program.`rkpd_sasaran_id`
                     INNER JOIN `rkpd_program` rkpd_program ON rkpd_sasaran_program.`sikd_bidang_id` = rkpd_program.`sikd_bidang_id`
                   AND rkpd_sasaran_program.`sikd_prog_id` = rkpd_program.`sikd_prog_id`
                     INNER JOIN `rkpd_anggaran` rkpd_kegiatan ON rkpd_program.`id_rkpd_program` = rkpd_kegiatan.`rkpd_program_id`
                     INNER JOIN `sikd_satker` sikd_satker ON rkpd_kegiatan.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                     LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON rkpd_kegiatan.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                     INNER JOIN `rkpd_rkpd` rkpd_rkpd ON rkpd_rkpd.`id_rkpd_rkpd` = rkpd_kegiatan.`rkpd_rkpd_id`
                     AND rkpd_rkpd.`id_rkpd_rkpd` = :id_rkpd
                     INNER JOIN `sikd_bidang` sikd_bidang ON rkpd_program.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                     INNER JOIN `sikd_prog` sikd_prog ON rkpd_program.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                     INNER JOIN `sikd_kgtn` sikd_kgtn ON rkpd_kegiatan.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                     LEFT OUTER JOIN `renja_anggaran` renja_kegiatan ON rkpd_kegiatan.`renja_anggaran_id` = renja_kegiatan.`id_renja_anggaran`
                     LEFT OUTER JOIN `renja_renja` renja_renja ON renja_kegiatan.`renja_renja_id` = renja_renja.`id_renja_renja`
                WHERE
                     rkpd_prioritas_nasional.tahun = :tahun
                GROUP BY
                     rkpd_prioritas_nasional.`id_rkpd_prioritas_nasional`,
                     rkpd_sasaran.`id_rkpd_sasaran`,
                     rkpd_program.`id_rkpd_program`,
                     sikd_satker.`id_sikd_satker`,
                     sikd_sub_skpd_kode,
                     sikd_kgtn.`id_sikd_kgtn`
                ORDER BY
                     rkpd_prioritas_nasional.`no_prioritas` ASC,
                     rkpd_sasaran.`no_sasaran` ASC,
                     rkpd_program.`kd_program` ASC,
                     sikd_satker.`kode` ASC,
                     sikd_sub_skpd_kode ASC,
                     sikd_kgtn.`kd_kgtn` ASC";
                 /*SELECT
                      rkpd_rkpd.`jns_rkpd` AS jns_rkpd,
                      rkpd_prioritas_nasional.`id_rkpd_prioritas_nasional` AS rkpd_prioritas_nasional_id_rkpd_prioritas_nasional,
                      rkpd_prioritas_nasional.`tahun` AS rkpd_prioritas_tahun,
                      rkpd_prioritas_nasional.`no_prioritas` AS rkpd_prioritas_no_prioritas,
                      rkpd_prioritas_nasional.`bidang_prioritas` AS rkpd_prioritas_bidang_prioritas,
                      rkpd_prioritas_nasional.`nm_program` AS rkpd_prioritas_nm_program,
                      CONCAT_WS('-',
                          SUBSTR(HEX(rkpd_sasaran.`id_rkpd_sasaran`), 1, 8),
                          SUBSTR(HEX(rkpd_sasaran.`id_rkpd_sasaran`), 9, 4),
                          SUBSTR(HEX(rkpd_sasaran.`id_rkpd_sasaran`), 13, 4),
                          SUBSTR(HEX(rkpd_sasaran.`id_rkpd_sasaran`), 17, 4),
                          SUBSTR(HEX(rkpd_sasaran.`id_rkpd_sasaran`), 21)
                             )  AS rkpd_sasaran_id_rkpd_sasaran,
                      rkpd_sasaran.`no_sasaran` AS rkpd_sasaran_no_sasaran,
                      rkpd_sasaran.`uraian_sasaran` AS rkpd_sasaran_uraian_sasaran,
                      CONCAT_WS('-',
                          SUBSTR(HEX(rkpd_program.`id_rkpd_program`), 1, 8),
                          SUBSTR(HEX(rkpd_program.`id_rkpd_program`), 9, 4),
                          SUBSTR(HEX(rkpd_program.`id_rkpd_program`), 13, 4),
                          SUBSTR(HEX(rkpd_program.`id_rkpd_program`), 17, 4),
                          SUBSTR(HEX(rkpd_program.`id_rkpd_program`), 21)
                             )  AS rkpd_program_id_rkpd_program,
                      rkpd_program.`kd_program` AS rkpd_program_kd_program,
                      if(length(sikd_kgtn.`kd_kgtn`) = 4, substring(sikd_kgtn.`kd_kgtn`,-2),
                         if(length(sikd_kgtn.`kd_kgtn`) = 5, substring(sikd_kgtn.`kd_kgtn`,-3), substring(sikd_kgtn.`kd_kgtn`,-4))) AS sikd_kgtn_kd_kgtn,
                      sikd_kgtn.`nm_kgtn` AS sikd_kgtn_nm_kgtn,
                      sikd_prog.`kd_prog` AS sikd_prog_kd_prog,
                      sikd_prog.`nm_prog` AS sikd_prog_nm_prog,
                      CONCAT_WS('-',
                          SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 1, 8),
                          SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 9, 4),
                          SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 13, 4),
                          SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 17, 4),
                          SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 21)
                             )  AS sikd_bidang_id_sikd_bidang,
                      sikd_bidang.`kd_bidang` AS sikd_bidang_kd_bidang,
                      sikd_bidang.`nm_bidang` AS sikd_bidang_nm_bidang,
                      CONCAT_WS('-',
                          SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 1, 8),
                          SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 9, 4),
                          SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 13, 4),
                          SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 17, 4),
                          SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 21)
                             )  AS rkpd_kegiatan_id_rkpd_kegiatan,
                      CONCAT_WS('-',
                          SUBSTR(HEX(rkpd_kegiatan.`sikd_kgtn_id`), 1, 8),
                          SUBSTR(HEX(rkpd_kegiatan.`sikd_kgtn_id`), 9, 4),
                          SUBSTR(HEX(rkpd_kegiatan.`sikd_kgtn_id`), 13, 4),
                          SUBSTR(HEX(rkpd_kegiatan.`sikd_kgtn_id`), 17, 4),
                          SUBSTR(HEX(rkpd_kegiatan.`sikd_kgtn_id`), 21)
                             ) AS rkpd_kegiatan_sikd_kgtn_id,
                      rkpd_kegiatan.`kd_kegiatan` AS rkpd_kegiatan_kd_kegiatan,
                      rkpd_kegiatan.`nm_kegiatan` AS rkpd_kegiatan_nm_kegiatan,
                      rkpd_kegiatan.`nm_subkegiatan` AS rkpd_kegiatan_nm_subkegiatan,
                      CONCAT_WS('-',
                          SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 1, 8),
                          SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 9, 4),
                          SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 13, 4),
                          SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 17, 4),
                          SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 21)
                             )  AS sikd_satker_id_sikd_satker,
                      sikd_satker.`kode` AS sikd_satker_kode,
                      sikd_satker.`nama` AS sikd_satker_nama,
                      CONCAT_WS('-',
                          SUBSTR(HEX(if(rkpd_kegiatan.`sikd_sub_skpd_id`!='', sikd_sub_skpd.`id_sikd_sub_skpd`, sikd_satker.`id_sikd_satker`)), 1, 8),
                          SUBSTR(HEX(if(rkpd_kegiatan.`sikd_sub_skpd_id`!='', sikd_sub_skpd.`id_sikd_sub_skpd`, sikd_satker.`id_sikd_satker`)), 9, 4),
                          SUBSTR(HEX(if(rkpd_kegiatan.`sikd_sub_skpd_id`!='', sikd_sub_skpd.`id_sikd_sub_skpd`, sikd_satker.`id_sikd_satker`)), 13, 4),
                          SUBSTR(HEX(if(rkpd_kegiatan.`sikd_sub_skpd_id`!='', sikd_sub_skpd.`id_sikd_sub_skpd`, sikd_satker.`id_sikd_satker`)), 17, 4),
                          SUBSTR(HEX(if(rkpd_kegiatan.`sikd_sub_skpd_id`!='', sikd_sub_skpd.`id_sikd_sub_skpd`, sikd_satker.`id_sikd_satker`)), 21)
                             ) AS sikd_sub_skpd_id_sikd_sub_skpd,
                      if(rkpd_kegiatan.`sikd_sub_skpd_id`!='', sikd_sub_skpd.`kode`, sikd_satker.`kode`) AS sikd_sub_skpd_kode,
                      if(rkpd_kegiatan.`sikd_sub_skpd_id`!='', sikd_sub_skpd.`nama`, sikd_satker.`nama`) AS sikd_sub_skpd_nama,
                      rkpd_program.`pagu_indikatif` AS rkpd_program_pagu_indikatif,
                      SUM(IFNULL(rkpd_kegiatan.`jml_anggaran_rkpd`,0)) AS rkpd_kegiatan_jml_anggaran_rkpd,
                      rkpd_kegiatan.`renja_anggaran_id` AS renja_kegiatan_id_renja_kegiatan
                    FROM
                      `rkpd_prioritas_nasional` rkpd_prioritas_nasional
                      LEFT OUTER JOIN `rkpd_prioritas_prov` rkpd_prioritas_prov ON rkpd_prioritas_nasional.`id_rkpd_prioritas_nasional` = rkpd_prioritas_prov.`rkpd_prioritas_nasional_id`
                      LEFT OUTER JOIN `rkpd_prioritas_kab` rkpd_prioritas_kab ON rkpd_prioritas_prov.`id_rkpd_prioritas_prov` = rkpd_prioritas_kab.`rkpd_prioritas_prov_id`
                      INNER JOIN `rkpd_sasaran` rkpd_sasaran  ON rkpd_sasaran.`rkpd_prioritas_kab_id` = rkpd_prioritas_kab.`id_rkpd_prioritas_kab`
                      INNER JOIN `rkpd_sasaran_program` rkpd_sasaran_program ON rkpd_sasaran.`id_rkpd_sasaran` = rkpd_sasaran_program.`rkpd_sasaran_id`
                      INNER JOIN `rkpd_program` rkpd_program ON rkpd_sasaran_program.`sikd_bidang_id` = rkpd_program.`sikd_bidang_id`
                      AND rkpd_sasaran_program.`sikd_prog_id` = rkpd_program.`sikd_prog_id`
                      INNER JOIN `rkpd_anggaran` rkpd_kegiatan ON rkpd_program.`id_rkpd_program` = rkpd_kegiatan.`rkpd_program_id`
                      INNER JOIN `sikd_satker` sikd_satker ON rkpd_kegiatan.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                      LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON rkpd_kegiatan.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                      INNER JOIN `rkpd_rkpd` rkpd_rkpd ON rkpd_rkpd.`id_rkpd_rkpd` = rkpd_kegiatan.`rkpd_rkpd_id`
                      AND rkpd_rkpd.`id_rkpd_rkpd` = :idRkpd
                      INNER JOIN `sikd_bidang` sikd_bidang ON rkpd_program.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                      INNER JOIN `sikd_prog` sikd_prog ON rkpd_program.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                      INNER JOIN `sikd_kgtn` sikd_kgtn ON rkpd_kegiatan.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                    WHERE
                      rkpd_prioritas_nasional.tahun = :tahun
                    GROUP BY
                      rkpd_prioritas_nasional.`id_rkpd_prioritas_nasional`,
                      rkpd_sasaran.`id_rkpd_sasaran`,
                      rkpd_program.`id_rkpd_program`,
                      sikd_satker.`id_sikd_satker`,
                      sikd_sub_skpd_kode,
                      sikd_kgtn.`id_sikd_kgtn`
                    ORDER BY
                      rkpd_prioritas_nasional.`no_prioritas` ASC,
                      rkpd_sasaran.`no_sasaran` ASC,
                      rkpd_program.`kd_program` ASC,
                      sikd_satker.`kode` ASC,
                      sikd_sub_skpd_kode ASC,
                      sikd_kgtn.`kd_kgtn` ASC
                    ;*/
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rkpd", $idRkpd);
            $statement->bindValue("tahun", $tahun);
            
            $statement->execute();
            $renstraReport = $statement->fetchAll();
            
            return new JsonResponse($renstraReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }

    private function getRkpdSinkronisasi03($request)
    {
        try {
            
            $idRkpd = $request->query->get("id_rkpd");
            $tahun = $request->query->get("tahun");
            //$kdPrioritas = $request->query->get("prioritas");
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRkpd = pack('H*', str_replace('-', '', trim($idRkpd)));
            $this->connection = $conn->getConnection();
            
            //print_r("ok");exit;
            
            $sql = "SELECT
                     rkpd_rkpd.`jns_rkpd` AS jns_rkpd,
                     CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_prioritas_prov.`id_rkpd_prioritas_prov`), 1, 8),
                         SUBSTR(HEX(rkpd_prioritas_prov.`id_rkpd_prioritas_prov`), 9, 4),
                         SUBSTR(HEX(rkpd_prioritas_prov.`id_rkpd_prioritas_prov`), 13, 4),
                         SUBSTR(HEX(rkpd_prioritas_prov.`id_rkpd_prioritas_prov`), 17, 4),
                         SUBSTR(HEX(rkpd_prioritas_prov.`id_rkpd_prioritas_prov`), 21)
                            ) AS rkpd_prioritas_prov_id_rkpd_prioritas_prov,
                     rkpd_prioritas_prov.`tahun` AS rkpd_prioritas_tahun,
                     rkpd_prioritas_prov.`no_prioritas` AS rkpd_prioritas_no_prioritas,
                     rkpd_prioritas_prov.`bidang_prioritas` AS rkpd_prioritas_bidang_prioritas,
                     rkpd_prioritas_prov.`nm_program` AS rkpd_prioritas_nm_program,
                     CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_sasaran.`id_rkpd_sasaran`), 1, 8),
                         SUBSTR(HEX(rkpd_sasaran.`id_rkpd_sasaran`), 9, 4),
                         SUBSTR(HEX(rkpd_sasaran.`id_rkpd_sasaran`), 13, 4),
                         SUBSTR(HEX(rkpd_sasaran.`id_rkpd_sasaran`), 17, 4),
                         SUBSTR(HEX(rkpd_sasaran.`id_rkpd_sasaran`), 21)
                            ) AS rkpd_sasaran_id_rkpd_sasaran,
                     rkpd_sasaran.`no_sasaran` AS rkpd_sasaran_no_sasaran,
                     rkpd_sasaran.`uraian_sasaran` AS rkpd_sasaran_uraian_sasaran,
                     CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_program.`id_rkpd_program`), 1, 8),
                         SUBSTR(HEX(rkpd_program.`id_rkpd_program`), 9, 4),
                         SUBSTR(HEX(rkpd_program.`id_rkpd_program`), 13, 4),
                         SUBSTR(HEX(rkpd_program.`id_rkpd_program`), 17, 4),
                         SUBSTR(HEX(rkpd_program.`id_rkpd_program`), 21)
                            ) AS rkpd_program_id_rkpd_program,
                     rkpd_program.`kd_program` AS rkpd_program_kd_program,
                     if(length(sikd_kgtn.`kd_kgtn`) = 4, substring(sikd_kgtn.`kd_kgtn`,-2),
                        if(length(sikd_kgtn.`kd_kgtn`) = 5, substring(sikd_kgtn.`kd_kgtn`,-3), substring(sikd_kgtn.`kd_kgtn`,-4))) AS sikd_kgtn_kd_kgtn,
                     sikd_kgtn.`nm_kgtn` AS sikd_kgtn_nm_kgtn,
                     sikd_prog.`kd_prog` AS sikd_prog_kd_prog,
                     sikd_prog.`nm_prog` AS sikd_prog_nm_prog,
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
                         SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 1, 8),
                         SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 9, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 13, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 17, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 21)
                            ) AS rkpd_kegiatan_id_rkpd_kegiatan,
                     CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_kgtn_id`), 1, 8),
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_kgtn_id`), 9, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_kgtn_id`), 13, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_kgtn_id`), 17, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_kgtn_id`), 21)
                            ) AS rkpd_kegiatan_sikd_kgtn_id,
                     rkpd_kegiatan.`kd_kegiatan` AS rkpd_kegiatan_kd_kegiatan,
                     rkpd_kegiatan.`nm_kegiatan` AS rkpd_kegiatan_nm_kegiatan,
                     rkpd_kegiatan.`nm_subkegiatan` AS rkpd_kegiatan_nm_subkegiatan,
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
                         SUBSTR(HEX(if(rkpd_kegiatan.`sikd_sub_skpd_id`!='', sikd_sub_skpd.`id_sikd_sub_skpd`, sikd_satker.`id_sikd_satker`)), 1, 8),
                         SUBSTR(HEX(if(rkpd_kegiatan.`sikd_sub_skpd_id`!='', sikd_sub_skpd.`id_sikd_sub_skpd`, sikd_satker.`id_sikd_satker`)), 9, 4),
                         SUBSTR(HEX(if(rkpd_kegiatan.`sikd_sub_skpd_id`!='', sikd_sub_skpd.`id_sikd_sub_skpd`, sikd_satker.`id_sikd_satker`)), 13, 4),
                         SUBSTR(HEX(if(rkpd_kegiatan.`sikd_sub_skpd_id`!='', sikd_sub_skpd.`id_sikd_sub_skpd`, sikd_satker.`id_sikd_satker`)), 17, 4),
                         SUBSTR(HEX(if(rkpd_kegiatan.`sikd_sub_skpd_id`!='', sikd_sub_skpd.`id_sikd_sub_skpd`, sikd_satker.`id_sikd_satker`)), 21)
                            ) AS sikd_sub_skpd_id_sikd_sub_skpd,
                     if(CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 1, 8),
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 9, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 13, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 17, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 21)
                            )!='', sikd_sub_skpd.`kode`, sikd_satker.`kode`) AS sikd_sub_skpd_kode,
                     if(CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 1, 8),
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 9, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 13, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 17, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 21)
                            )!='', sikd_sub_skpd.`nama`, sikd_satker.`nama`) AS sikd_sub_skpd_nama,
                     rkpd_program.`pagu_indikatif` AS rkpd_program_pagu_indikatif,
                     SUM(IFNULL(rkpd_kegiatan.`jml_anggaran_rkpd`,0)) AS rkpd_kegiatan_jml_anggaran_rkpd,
                     SUM(IFNULL(renja_kegiatan.`tgt_anggaran_thn_ini`,0)) AS renja_kegiatan_tgt_anggaran_thn_ini,
                     SUM((IFNULL(rkpd_kegiatan.`jml_anggaran_rkpd`,0) - IFNULL(renja_kegiatan.`tgt_anggaran_thn_ini`,0))) AS jml_selisih_rkpd_renja
                     -- ,rkpd_kegiatan.`renja_anggaran_id` AS renja_kegiatan_id_renja_kegiatan
                FROM
                     `rkpd_prioritas_prov` rkpd_prioritas_prov
                     LEFT OUTER JOIN `rkpd_prioritas_kab` rkpd_prioritas_kab ON rkpd_prioritas_prov.`id_rkpd_prioritas_prov` = rkpd_prioritas_kab.`rkpd_prioritas_prov_id`
                     INNER JOIN `rkpd_sasaran` rkpd_sasaran  ON rkpd_sasaran.`rkpd_prioritas_kab_id` = rkpd_prioritas_kab.`id_rkpd_prioritas_kab`
                     INNER JOIN `rkpd_sasaran_program` rkpd_sasaran_program ON rkpd_sasaran.`id_rkpd_sasaran` = rkpd_sasaran_program.`rkpd_sasaran_id`
                     INNER JOIN `rkpd_program` rkpd_program ON rkpd_sasaran_program.`sikd_bidang_id` = rkpd_program.`sikd_bidang_id`
                   AND rkpd_sasaran_program.`sikd_prog_id` = rkpd_program.`sikd_prog_id`
                     INNER JOIN `rkpd_anggaran` rkpd_kegiatan ON rkpd_program.`id_rkpd_program` = rkpd_kegiatan.`rkpd_program_id`
                     INNER JOIN `sikd_satker` sikd_satker ON rkpd_kegiatan.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                     LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON rkpd_kegiatan.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                     INNER JOIN `rkpd_rkpd` rkpd_rkpd ON rkpd_rkpd.`id_rkpd_rkpd` = rkpd_kegiatan.`rkpd_rkpd_id`
                   AND rkpd_rkpd.`id_rkpd_rkpd` = :id_rkpd
                     INNER JOIN `sikd_bidang` sikd_bidang ON rkpd_program.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                     INNER JOIN `sikd_prog` sikd_prog ON rkpd_program.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                     INNER JOIN `sikd_kgtn` sikd_kgtn ON rkpd_kegiatan.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                     LEFT OUTER JOIN `renja_anggaran` renja_kegiatan ON rkpd_kegiatan.`renja_anggaran_id` = renja_kegiatan.`id_renja_anggaran`
                     LEFT OUTER JOIN `renja_renja` renja_renja ON renja_kegiatan.`renja_renja_id` = renja_renja.`id_renja_renja`

                WHERE
                     rkpd_prioritas_prov.tahun = :tahun
                GROUP BY
                     rkpd_prioritas_prov.`id_rkpd_prioritas_prov`,
                     rkpd_sasaran.`id_rkpd_sasaran`,
                     rkpd_program.`id_rkpd_program`,
                     sikd_satker.`id_sikd_satker`,
                     sikd_sub_skpd_kode,
                     sikd_kgtn.`id_sikd_kgtn`
                ORDER BY
                     rkpd_prioritas_prov.`no_prioritas` ASC,
                     rkpd_sasaran.`no_sasaran` ASC,
                     rkpd_program.`kd_program` ASC,
                     sikd_satker.`kode` ASC,
                     sikd_sub_skpd_kode ASC,
                     sikd_kgtn.`kd_kgtn` ASC
                    ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rkpd", $idRkpd);
            $statement->bindValue("tahun", $tahun);
            //$statement->bindValue("kdPrioritas", $kdPrioritas);
            
            $statement->execute();
            $renstraReport = $statement->fetchAll();
            
            return new JsonResponse($renstraReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }

    private function getRkpdSinkronisasi04($request)
    {
        try {
            
            $idRkpd = $request->query->get("id_rkpd");
            $tahun = $request->query->get("tahun");
            //$kdPrioritas = $request->query->get("prioritas");
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRkpd = pack('H*', str_replace('-', '', trim($idRkpd)));
            $this->connection = $conn->getConnection();
            
            //print_r("ok");exit;
            
            $sql = "SELECT
                     rkpd_rkpd.`jns_rkpd` AS jns_rkpd,
                     CONCAT_WS('-',
                       SUBSTR(HEX(rkpd_prioritas_kab.`id_rkpd_prioritas_kab`), 1, 8),
                       SUBSTR(HEX(rkpd_prioritas_kab.`id_rkpd_prioritas_kab`), 9, 4),
                       SUBSTR(HEX(rkpd_prioritas_kab.`id_rkpd_prioritas_kab`), 13, 4),
                       SUBSTR(HEX(rkpd_prioritas_kab.`id_rkpd_prioritas_kab`), 17, 4),
                       SUBSTR(HEX(rkpd_prioritas_kab.`id_rkpd_prioritas_kab`), 21)
                          ) AS rkpd_prioritas_kab_id_rkpd_prioritas_kab,
                     rkpd_prioritas_kab.`tahun` AS rkpd_prioritas_tahun,
                     rkpd_prioritas_kab.`no_prioritas` AS rkpd_prioritas_no_prioritas,
                     rkpd_prioritas_kab.`bidang_prioritas` AS rkpd_prioritas_bidang_prioritas,
                     rkpd_prioritas_kab.`nm_program` AS rkpd_prioritas_nm_program,
                     CONCAT_WS('-',
                       SUBSTR(HEX(rkpd_sasaran.`id_rkpd_sasaran`), 1, 8),
                       SUBSTR(HEX(rkpd_sasaran.`id_rkpd_sasaran`), 9, 4),
                       SUBSTR(HEX(rkpd_sasaran.`id_rkpd_sasaran`), 13, 4),
                       SUBSTR(HEX(rkpd_sasaran.`id_rkpd_sasaran`), 17, 4),
                       SUBSTR(HEX(rkpd_sasaran.`id_rkpd_sasaran`), 21)
                          ) AS rkpd_sasaran_id_rkpd_sasaran,
                     rkpd_sasaran.`no_sasaran` AS rkpd_sasaran_no_sasaran,
                     rkpd_sasaran.`uraian_sasaran` AS rkpd_sasaran_uraian_sasaran,
                     CONCAT_WS('-',
                       SUBSTR(HEX(rkpd_program.`id_rkpd_program`), 1, 8),
                       SUBSTR(HEX(rkpd_program.`id_rkpd_program`), 9, 4),
                       SUBSTR(HEX(rkpd_program.`id_rkpd_program`), 13, 4),
                       SUBSTR(HEX(rkpd_program.`id_rkpd_program`), 17, 4),
                       SUBSTR(HEX(rkpd_program.`id_rkpd_program`), 21)
                          ) AS rkpd_program_id_rkpd_program,
                     rkpd_program.`kd_program` AS rkpd_program_kd_program,
                     if(length(sikd_kgtn.`kd_kgtn`) = 4, substring(sikd_kgtn.`kd_kgtn`,-2),
                        if(length(sikd_kgtn.`kd_kgtn`) = 5, substring(sikd_kgtn.`kd_kgtn`,-3), substring(sikd_kgtn.`kd_kgtn`,-4))) AS sikd_kgtn_kd_kgtn,
                     sikd_kgtn.`nm_kgtn` AS sikd_kgtn_nm_kgtn,
                     sikd_prog.`kd_prog` AS sikd_prog_kd_prog,
                     sikd_prog.`nm_prog` AS sikd_prog_nm_prog,
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
                       SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 1, 8),
                       SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 9, 4),
                       SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 13, 4),
                       SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 17, 4),
                       SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 21)
                          ) AS rkpd_kegiatan_id_rkpd_kegiatan,
                     CONCAT_WS('-',
                       SUBSTR(HEX(rkpd_kegiatan.`sikd_kgtn_id`), 1, 8),
                       SUBSTR(HEX(rkpd_kegiatan.`sikd_kgtn_id`), 9, 4),
                       SUBSTR(HEX(rkpd_kegiatan.`sikd_kgtn_id`), 13, 4),
                       SUBSTR(HEX(rkpd_kegiatan.`sikd_kgtn_id`), 17, 4),
                       SUBSTR(HEX(rkpd_kegiatan.`sikd_kgtn_id`), 21)
                          ) AS rkpd_kegiatan_sikd_kgtn_id,
                     rkpd_kegiatan.`kd_kegiatan` AS rkpd_kegiatan_kd_kegiatan,
                     rkpd_kegiatan.`nm_kegiatan` AS rkpd_kegiatan_nm_kegiatan,
                     rkpd_kegiatan.`nm_subkegiatan` AS rkpd_kegiatan_nm_subkegiatan,
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
                       SUBSTR(HEX(if(rkpd_kegiatan.`sikd_sub_skpd_id`!='', sikd_sub_skpd.`id_sikd_sub_skpd`, sikd_satker.`id_sikd_satker`)), 1, 8),
                       SUBSTR(HEX(if(rkpd_kegiatan.`sikd_sub_skpd_id`!='', sikd_sub_skpd.`id_sikd_sub_skpd`, sikd_satker.`id_sikd_satker`)), 9, 4),
                       SUBSTR(HEX(if(rkpd_kegiatan.`sikd_sub_skpd_id`!='', sikd_sub_skpd.`id_sikd_sub_skpd`, sikd_satker.`id_sikd_satker`)), 13, 4),
                       SUBSTR(HEX(if(rkpd_kegiatan.`sikd_sub_skpd_id`!='', sikd_sub_skpd.`id_sikd_sub_skpd`, sikd_satker.`id_sikd_satker`)), 17, 4),
                       SUBSTR(HEX(if(rkpd_kegiatan.`sikd_sub_skpd_id`!='', sikd_sub_skpd.`id_sikd_sub_skpd`, sikd_satker.`id_sikd_satker`)), 21)
                          ) AS sikd_sub_skpd_id_sikd_sub_skpd,
                     if(rkpd_kegiatan.`sikd_sub_skpd_id`!='', sikd_sub_skpd.`kode`, sikd_satker.`kode`) AS sikd_sub_skpd_kode,
                     if(rkpd_kegiatan.`sikd_sub_skpd_id`!='', sikd_sub_skpd.`nama`, sikd_satker.`nama`) AS sikd_sub_skpd_nama,
                     rkpd_program.`pagu_indikatif` AS rkpd_program_pagu_indikatif,
                     SUM(IFNULL(rkpd_kegiatan.`jml_anggaran_rkpd`,0)) AS rkpd_kegiatan_jml_anggaran_rkpd,
                     SUM(IFNULL(renja_kegiatan.`tgt_anggaran_thn_ini`,0)) AS renja_kegiatan_tgt_anggaran_thn_ini,
                     SUM((IFNULL(rkpd_kegiatan.`jml_anggaran_rkpd`,0) - IFNULL(renja_kegiatan.`tgt_anggaran_thn_ini`,0))) AS jml_selisih_rkpd_renja
                     -- rkpd_kegiatan.`renja_anggaran_id` AS renja_kegiatan_id_renja_kegiatan
                FROM
                     `rkpd_prioritas_kab` rkpd_prioritas_kab
                     INNER JOIN `rkpd_sasaran` rkpd_sasaran  ON rkpd_sasaran.`rkpd_prioritas_kab_id` = rkpd_prioritas_kab.`id_rkpd_prioritas_kab`
                     INNER JOIN `rkpd_sasaran_program` rkpd_sasaran_program ON rkpd_sasaran.`id_rkpd_sasaran` = rkpd_sasaran_program.`rkpd_sasaran_id`
                     INNER JOIN `rkpd_program` rkpd_program ON rkpd_sasaran_program.`sikd_bidang_id` = rkpd_program.`sikd_bidang_id`
                   AND rkpd_sasaran_program.`sikd_prog_id` = rkpd_program.`sikd_prog_id`
                     INNER JOIN `rkpd_anggaran` rkpd_kegiatan ON rkpd_program.`id_rkpd_program` = rkpd_kegiatan.`rkpd_program_id`
                     INNER JOIN `sikd_satker` sikd_satker ON rkpd_kegiatan.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                     LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON rkpd_kegiatan.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                     INNER JOIN `rkpd_rkpd` rkpd_rkpd ON rkpd_rkpd.`id_rkpd_rkpd` = rkpd_kegiatan.`rkpd_rkpd_id`
                   AND rkpd_rkpd.`id_rkpd_rkpd` = :id_rkpd
                     INNER JOIN `sikd_bidang` sikd_bidang ON rkpd_program.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                     INNER JOIN `sikd_prog` sikd_prog ON rkpd_program.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                     INNER JOIN `sikd_kgtn` sikd_kgtn ON rkpd_kegiatan.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                     LEFT OUTER JOIN `renja_anggaran` renja_kegiatan ON rkpd_kegiatan.`renja_anggaran_id` = renja_kegiatan.`id_renja_anggaran`
                     LEFT OUTER JOIN `renja_renja` renja_renja ON renja_kegiatan.`renja_renja_id` = renja_renja.`id_renja_renja`
                    -- INNER JOIN `sikd_sub_kgtn` sikd_sub_kgtn ON sikd_kgtn.`id_sikd_kgtn` = sikd_sub_kgtn.`sikd_kgtn_id`
                WHERE
                     rkpd_prioritas_kab.tahun = :tahun
                GROUP BY
                     rkpd_prioritas_kab.`id_rkpd_prioritas_kab`,
                     rkpd_sasaran.`id_rkpd_sasaran`,
                     rkpd_program.`id_rkpd_program`,
                     sikd_satker.`id_sikd_satker`,
                     sikd_sub_skpd_kode,
                     sikd_kgtn.`id_sikd_kgtn`
                ORDER BY
                     rkpd_prioritas_kab.`no_prioritas` ASC,
                     rkpd_sasaran.`no_sasaran` ASC,
                     rkpd_program.`kd_program` ASC,
                     sikd_satker.`kode` ASC,
                     sikd_sub_skpd_kode ASC,
                     sikd_kgtn.`kd_kgtn` ASC
                    ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rkpd", $idRkpd);
            $statement->bindValue("tahun", $tahun);
            //$statement->bindValue("kdPrioritas", $kdPrioritas);
            
            $statement->execute();
            $renstraReport = $statement->fetchAll();
            
            return new JsonResponse($renstraReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }

    private function getRkpdSinkronisasi05($request)
    {
        try {

            //$idRkpd = $request->query->get("id_rkpd");
            //$tahun = $request->query->get("tahun");
            //$kdPrioritas = $request->query->get("prioritas");
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            //$idRkpd = pack('H*', str_replace('-', '', trim($idRkpd)));
            $this->connection = $conn->getConnection();
            
            //print_r("ok");exit;

            $sql = "SELECT
                        CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_prioritas_kab.`id_rkpd_prioritas_kab`), 1, 8),
                         SUBSTR(HEX(rkpd_prioritas_kab.`id_rkpd_prioritas_kab`), 9, 4),
                         SUBSTR(HEX(rkpd_prioritas_kab.`id_rkpd_prioritas_kab`), 13, 4),
                         SUBSTR(HEX(rkpd_prioritas_kab.`id_rkpd_prioritas_kab`), 17, 4),
                         SUBSTR(HEX(rkpd_prioritas_kab.`id_rkpd_prioritas_kab`), 21)
                            ) AS rkpd_prioritas_kab_id_rkpd_prioritas_kab,
                         rkpd_prioritas_kab.`no_prioritas` AS rkpd_prioritas_kab_no_prioritas,
                         rkpd_prioritas_kab.`bidang_prioritas` AS rkpd_prioritas_kab_bidang_prioritas,
                         rkpd_prioritas_kab.`nm_program` AS rkpd_prioritas_kab_nm_program
                    FROM
                         `rkpd_prioritas_kab` rkpd_prioritas_kab 
                         INNER JOIN `rkpd_sasaran` rkpd_sasaran ON rkpd_prioritas_kab.`id_rkpd_prioritas_kab` = rkpd_sasaran.`rkpd_prioritas_kab_id`
                         LEFT OUTER JOIN `rkpd_sasaran_program` rkpd_sasaran_program ON rkpd_sasaran.`id_rkpd_sasaran` = rkpd_sasaran_program.`rkpd_sasaran_id`
                    GROUP BY
                         rkpd_prioritas_kab.`no_prioritas`
                    ORDER BY
                         rkpd_prioritas_kab.`no_prioritas` ASC
                    ";
            
            $statement = $this->connection->prepare($sql);
            //$statement->bindValue("idRkpd", $idRkpd);
            //$statement->bindValue("tahun", $tahun);
            //$statement->bindValue("kdPrioritas", $kdPrioritas);
            
            $statement->execute();
            $renstraReport = $statement->fetchAll();

            return new JsonResponse($renstraReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }    

    private function getRkpdSinkronisasi050($request)
    {
        try {

            //print_r("ok");exit;

            $idRkpdPrioritasKab = $request->query->get("id_rkpd_prioritas_kab");
            //$tahun = $request->query->get("tahun");
            //$kdPrioritas = $request->query->get("prioritas");
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRkpdPrioritasKab = pack('H*', str_replace('-', '', trim($idRkpdPrioritasKab)));
            $this->connection = $conn->getConnection();
            
            //print_r($jnsRkpd);exit;

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
                        CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_sasaran_program.`sikd_bidang_id`), 1, 8),
                         SUBSTR(HEX(rkpd_sasaran_program.`sikd_bidang_id`), 9, 4),
                         SUBSTR(HEX(rkpd_sasaran_program.`sikd_bidang_id`), 13, 4),
                         SUBSTR(HEX(rkpd_sasaran_program.`sikd_bidang_id`), 17, 4),
                         SUBSTR(HEX(rkpd_sasaran_program.`sikd_bidang_id`), 21)
                            ) AS sikd_bidang_id,
                         rkpd_sasaran.`no_sasaran` AS rkpd_sasaran_no_sasaran,
                         rkpd_sasaran.`uraian_sasaran` AS rkpd_sasaran_uraian_sasaran
                    FROM
                         `rkpd_prioritas_kab` rkpd_prioritas_kab 
                         INNER JOIN `rkpd_sasaran` rkpd_sasaran ON rkpd_prioritas_kab.`id_rkpd_prioritas_kab` = rkpd_sasaran.`rkpd_prioritas_kab_id`
                         INNER JOIN `rkpd_sasaran_program` rkpd_sasaran_program ON rkpd_sasaran.`id_rkpd_sasaran` = rkpd_sasaran_program.`rkpd_sasaran_id`
                    WHERE
                         rkpd_sasaran.`rkpd_prioritas_kab_id` = :idRkpdPrioritasKab
                    ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("idRkpdPrioritasKab", $idRkpdPrioritasKab);
            //$statement->bindValue("tahun", $tahun);
            //$statement->bindValue("kdPrioritas", $kdPrioritas);
            
            $statement->execute();
            $renstraReport = $statement->fetchAll();

            return new JsonResponse($renstraReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    } 

    private function getRkpdSinkronisasi051($request)
    {
        try {

            //print_r("ok");exit;

            $idRkpdPrioritasKab = $request->query->get("id_rkpd_prioritas_kab");
            //$tahun = $request->query->get("tahun");
            //$kdPrioritas = $request->query->get("prioritas");
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRkpdPrioritasKab = pack('H*', str_replace('-', '', trim($idRkpdPrioritasKab)));
            $this->connection = $conn->getConnection();
            
            //print_r($jnsRkpd);exit;

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
                         rkpd_sasaran.`no_sasaran` AS rkpd_sasaran_no_sasaran,
                         rkpd_sasaran.`uraian_sasaran` AS rkpd_sasaran_uraian_sasaran
                    FROM
                        `rkpd_prioritas_kab` rkpd_prioritas_kab 
                         INNER JOIN `rkpd_sasaran` rkpd_sasaran ON rkpd_prioritas_kab.`id_rkpd_prioritas_kab` = rkpd_sasaran.`rkpd_prioritas_kab_id`
                    WHERE
                         rkpd_sasaran.`rkpd_prioritas_kab_id` = :idRkpdPrioritasKab
                    GROUP BY
                         rkpd_sasaran.`no_sasaran`
                    ORDER BY
                         rkpd_sasaran.`no_sasaran` ASC
                    ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("idRkpdPrioritasKab", $idRkpdPrioritasKab);
            //$statement->bindValue("tahun", $tahun);
            //$statement->bindValue("kdPrioritas", $kdPrioritas);
            
            $statement->execute();
            $renstraReport = $statement->fetchAll();

            return new JsonResponse($renstraReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    } 

    private function getRkpdSinkronisasi052($request)
    {
        try {

            //print_r("ok");exit;

            $idRkpdPrioritasKab = $request->query->get("id_rkpd_prioritas_kab");
            //$tahun = $request->query->get("tahun");
            //$kdPrioritas = $request->query->get("prioritas");
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRkpdPrioritasKab = pack('H*', str_replace('-', '', trim($idRkpdPrioritasKab)));
            $this->connection = $conn->getConnection();
            
            //print_r($jnsRkpd);exit;

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
                         rkpd_sasaran.`no_sasaran` AS rkpd_sasaran_no_sasaran,
                         rkpd_sasaran.`uraian_sasaran` AS rkpd_sasaran_uraian_sasaran,
                         CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_sasaran_program.`sikd_prog_id`), 1, 8),
                         SUBSTR(HEX(rkpd_sasaran_program.`sikd_prog_id`), 9, 4),
                         SUBSTR(HEX(rkpd_sasaran_program.`sikd_prog_id`), 13, 4),
                         SUBSTR(HEX(rkpd_sasaran_program.`sikd_prog_id`), 17, 4),
                         SUBSTR(HEX(rkpd_sasaran_program.`sikd_prog_id`), 21)
                            ) AS sikd_prog_id_sikd_prog
                    FROM
                         `rkpd_prioritas_kab` rkpd_prioritas_kab 
                         INNER JOIN `rkpd_sasaran` rkpd_sasaran ON rkpd_prioritas_kab.`id_rkpd_prioritas_kab` = rkpd_sasaran.`rkpd_prioritas_kab_id`
                         INNER JOIN `rkpd_sasaran_program` rkpd_sasaran_program ON rkpd_sasaran.`id_rkpd_sasaran` = rkpd_sasaran_program.`rkpd_sasaran_id`
                    WHERE
                         rkpd_sasaran.`rkpd_prioritas_kab_id` = :idRkpdPrioritasKab
                    ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("idRkpdPrioritasKab", $idRkpdPrioritasKab);
            //$statement->bindValue("tahun", $tahun);
            //$statement->bindValue("kdPrioritas", $kdPrioritas);
            
            $statement->execute();
            $renstraReport = $statement->fetchAll();

            return new JsonResponse($renstraReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    } 

    private function getRkpdSinkronisasi053($request)
    {   

        //MASIH DIKERJAKAN
        try {

            //print_r("ok");exit;

            $idRkpdPrioritasKab = $request->query->get("id_rkpd_prioritas_kab");
            //$tahun = $request->query->get("tahun");
            //$kdPrioritas = $request->query->get("prioritas");
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRkpdPrioritasKab = pack('H*', str_replace('-', '', trim($idRkpdPrioritasKab)));
            $this->connection = $conn->getConnection();
            
            //print_r($jnsRkpd);exit;

            $sql = "SELECT
                        CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_sasaran_program.`sikd_bidang_id`), 1, 8),
                         SUBSTR(HEX(rkpd_sasaran_program.`sikd_bidang_id`), 9, 4),
                         SUBSTR(HEX(rkpd_sasaran_program.`sikd_bidang_id`), 13, 4),
                         SUBSTR(HEX(rkpd_sasaran_program.`sikd_bidang_id`), 17, 4),
                         SUBSTR(HEX(rkpd_sasaran_program.`sikd_bidang_id`), 21)
                            ) AS sikd_bidang_id
                    FROM
                         `rkpd_prioritas_kab` rkpd_prioritas_kab
                         INNER JOIN `rkpd_sasaran` rkpd_sasaran ON rkpd_prioritas_kab.`id_rkpd_prioritas_kab` = rkpd_sasaran.`rkpd_prioritas_kab_id`
                         /*INNER JOIN `rkpd_rkpd` rkpd_rkpd ON rkpd_prioritas_kab.`rkpd_rkpd_id` = rkpd_rkpd.`id_rkpd_rkpd`*/
                         INNER JOIN `rkpd_sasaran_program` rkpd_sasaran_program ON rkpd_sasaran.`id_rkpd_sasaran` = rkpd_sasaran_program.`rkpd_sasaran_id`
                    WHERE
                         rkpd_sasaran.`rkpd_prioritas_kab_id` = :idRkpdPrioritasKab
                    GROUP BY sikd_bidang_id
                    ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("idRkpdPrioritasKab", $idRkpdPrioritasKab);
            //$statement->bindValue("tahun", $tahun);
            //$statement->bindValue("kdPrioritas", $kdPrioritas);
            
            $statement->execute();
            $renstraReport = $statement->fetchAll();

            return new JsonResponse($renstraReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    } 

    //REKAPITULASI
    private function getRkpdRekapProyeksi($Request){
        try {

            $idRkpd = $Request->query->get("id_rkpd");
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRkpd = pack('H*', str_replace('-', '', trim($idRkpd)));
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                         rkpd_rkpd.`jns_rkpd` AS jns_rkpd,
                        CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 1, 8),
                         SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 9, 4),
                         SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 13, 4),
                         SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 17, 4),
                         SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 21)
                            ) AS id_rkpd_rkpd,
                         sikd_rek_akun.kd_rek_akun AS rkpd_pendapatan_akun,
                         IF(sikd_rek_akun.kd_rek_akun = '4', 'Pendapatan Daerah', 
                      IF(sikd_rek_akun.kd_rek_akun = '5', 'Belanja Daerah', 'Penerimaan Pembiayaan')) AS rkpd_pendapatan_nm_akun,
                         sikd_rek_akun.`kd_rek_akun` AS sikd_rek_akun_kd_rek_akun,
                         sikd_rek_akun.`nm_rek_akun` AS sikd_rek_akun_nm_rek_akun,
                         if(sikd_rek_akun.`kd_rek_akun` in ('4','5'), 'rek_45', 'rek_6') AS jns_rek,
                        CONCAT_WS('-',
                         SUBSTR(HEX(sikd_rek_kelompok.`id_sikd_rek_kelompok`), 1, 8),
                         SUBSTR(HEX(sikd_rek_kelompok.`id_sikd_rek_kelompok`), 9, 4),
                         SUBSTR(HEX(sikd_rek_kelompok.`id_sikd_rek_kelompok`), 13, 4),
                         SUBSTR(HEX(sikd_rek_kelompok.`id_sikd_rek_kelompok`), 17, 4),
                         SUBSTR(HEX(sikd_rek_kelompok.`id_sikd_rek_kelompok`), 21)
                            ) AS sikd_rek_kelompok_id_sikd_rek_kelompok,
                         concat(substring(sikd_rek_kelompok.`kd_rek_kelompok`,1,1),'.',
                          substring(sikd_rek_kelompok.`kd_rek_kelompok`,2,1)) AS sikd_rek_kelompok_kd_rek_kelompok,
                         sikd_rek_kelompok.`nm_rek_kelompok` AS sikd_rek_kelompok_nm_rek_kelompok,
                         CONCAT_WS('-',
                         SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 1, 8),
                         SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 9, 4),
                         SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 13, 4),
                         SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 17, 4),
                         SUBSTR(HEX(sikd_rek_jenis.`id_sikd_rek_jenis`), 21)
                            ) AS sikd_rek_jenis_id_sikd_rek_jenis,
                         concat(substring(sikd_rek_jenis.`kd_rek_jenis`,1,1),'.',
                          substring(sikd_rek_jenis.`kd_rek_jenis`,2,1),'.',
                          substring(sikd_rek_jenis.`kd_rek_jenis`,3,1)) AS sikd_rek_jenis_kd_rek_jenis,
                         sikd_rek_jenis.`nm_rek_jenis` AS sikd_rek_jenis_nm_rek_jenis,
                         SUM(IFNULL(rkpd_mata_anggaran.`jumlah`, 0)) AS jumlah,
                         IF(sikd_rek_akun.`kd_rek_akun`='4', SUM(IFNULL(rkpd_mata_anggaran.`jumlah`, 0)),
                       IF(sikd_rek_akun.`kd_rek_akun`='5', SUM(IFNULL(-(rkpd_mata_anggaran.`jumlah`), 0)), 0)) AS jml_surplus,
                         SUM(if(sikd_rek_kelompok.`kd_rek_kelompok`='61', IFNULL(rkpd_mata_anggaran.`jumlah`, 0),
                       if(sikd_rek_kelompok.`kd_rek_kelompok`='62', IFNULL(-(rkpd_mata_anggaran.`jumlah`), 0), 0))) AS jml_pembiayaan
                    FROM
                         `rkpd_mata_anggaran` rkpd_mata_anggaran
                         INNER JOIN `rkpd_anggaran` rkpd_anggaran ON rkpd_mata_anggaran.`rkpd_anggaran_id` = rkpd_anggaran.`id_rkpd_anggaran`
                         INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON rkpd_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                         INNER JOIN `rkpd_rkpd` rkpd_rkpd ON rkpd_anggaran.`rkpd_rkpd_id` = rkpd_rkpd.id_rkpd_rkpd
                         INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                         INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                         INNER JOIN `sikd_rek_kelompok` sikd_rek_kelompok ON sikd_rek_jenis.`sikd_rek_kelompok_id` = sikd_rek_kelompok.`id_sikd_rek_kelompok`
                         INNER JOIN `sikd_rek_akun` sikd_rek_akun ON sikd_rek_kelompok.`sikd_rek_akun_id` = sikd_rek_akun.`id_sikd_rek_akun`
                       AND (sikd_rek_akun.kd_rek_akun in ('4','5','6')
                        OR sikd_rek_kelompok.kd_rek_kelompok in ('61','62'))
                    WHERE
                         rkpd_rkpd.id_rkpd_rkpd = :id_rkpd
                    GROUP BY
                         sikd_rek_akun_kd_rek_akun,
                         sikd_rek_kelompok_kd_rek_kelompok,
                         sikd_rek_jenis_kd_rek_jenis,
                         jns_rek
                    UNION
                    SELECT
                         rkpd_rkpd.`jns_rkpd` AS jns_rkpd,
                         CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 1, 8),
                         SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 9, 4),
                         SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 13, 4),
                         SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 17, 4),
                         SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 21)
                            ) AS id_rkpd_rkpd,
                         '5' AS rkpd_pendapatan_akun,
                         'BELANJA DAERAH' AS rkpd_pendapatan_nm_akun,
                         '5' AS sikd_rek_akun_kd_rek_akun,
                         'BELANJA' AS sikd_rek_akun_nm_rek_akun,
                         'rek_45' AS jns_rek,
                         '' AS sikd_rek_kelompok_id_sikd_rek_kelompok,
                         '5.2' AS sikd_rek_kelompok_kd_rek_kelompok,
                         -- 'BELANJA LANGSUNG' AS sikd_rek_kelompok_nm_rek_kelompok,
                         'RKPD BELANJA' AS sikd_rek_kelompok_nm_rek_kelompok,
                         '' AS sikd_rek_jenis_id_sikd_rek_jenis,
                         sikd_urusan.`kd_urusan` AS sikd_rek_jenis_kd_rek_jenis,
                         sikd_urusan.`nm_urusan` AS sikd_rek_jenis_nm_rek_jenis,
                         SUM(IFNULL(rkpd_kegiatan.`jml_anggaran_rkpd`, 0)) AS jumlah,
                         SUM(IFNULL(-(rkpd_kegiatan.`jml_anggaran_rkpd`), 0)) AS jml_surplus,
                         0 AS jml_pembiayaan
                    FROM
                         `rkpd_rkpd` rkpd_rkpd
                         INNER JOIN `rkpd_program` rkpd_program ON rkpd_rkpd.`id_rkpd_rkpd` = rkpd_program.`rkpd_rkpd_id`
                         INNER JOIN `rkpd_anggaran` rkpd_kegiatan ON rkpd_program.`id_rkpd_program` = rkpd_kegiatan.`rkpd_program_id`
                         INNER JOIN `sikd_kgtn` sikd_kgtn ON rkpd_kegiatan.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                         INNER JOIN `sikd_prog` sikd_prog ON sikd_kgtn.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                         INNER JOIN `sikd_bidang` sikd_bidang ON sikd_prog.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                         INNER JOIN `sikd_urusan` sikd_urusan ON sikd_bidang.`sikd_urusan_id` = sikd_urusan.`id_sikd_urusan`
                    WHERE
                         rkpd_rkpd.id_rkpd_rkpd = :id_rkpd
                    GROUP BY
                         sikd_rek_akun_kd_rek_akun,
                         sikd_rek_kelompok_kd_rek_kelompok,
                         sikd_rek_jenis_kd_rek_jenis,
                         jns_rek

                    ORDER BY
                         sikd_rek_akun_kd_rek_akun,
                         sikd_rek_kelompok_kd_rek_kelompok,
                         sikd_rek_jenis_kd_rek_jenis";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rkpd", $idRkpd);            
            $statement->execute();
            $renstraReport = $statement->fetchAll();

            return new JsonResponse($renstraReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }

    }
    
    private function getRkpdRekapBidangProg($request)
    {
        try {
            $idRkpd = $request->query->get("id_rkpd");
            //$kdPrioritas = $request->query->get("prioritas");
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRkpd = pack('H*', str_replace('-', '', trim($idRkpd)));
            $this->connection = $conn->getConnection();
            
            $sql = /*"SELECT
                         CONCAT_WS('-',
                        SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 1, 8),
                        SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 9, 4),
                        SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 13, 4),
                        SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 17, 4),
                        SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 21)
                            ) AS rkpd_rkpd_id_rkpd_rkpd,
                         rkpd_rkpd.`tahun` AS rkpd_rkpd_tahun,
                         rkpd_rkpd.`jns_rkpd` AS rkpd_rkpd_jns_rkpd,
                         CONCAT_WS('-',
                        SUBSTR(HEX(rkpd_program.`id_rkpd_program`), 1, 8),
                        SUBSTR(HEX(rkpd_program.`id_rkpd_program`), 9, 4),
                        SUBSTR(HEX(rkpd_program.`id_rkpd_program`), 13, 4),
                        SUBSTR(HEX(rkpd_program.`id_rkpd_program`), 17, 4),
                        SUBSTR(HEX(rkpd_program.`id_rkpd_program`), 21)
                            ) AS rkpd_program_id_rkpd_program,
                         rkpd_program.`kd_program` AS rkpd_program_kd_program,
                         rkpd_program.`tgt_anggaran_rpjmd` AS rkpd_program_tgt_anggaran_rpjmd,
                         rkpd_program.`rls_anggaran_sd_thn_lalu` AS rkpd_program_rls_anggaran_sd_thn_lalu,
                         rkpd_program.`pagu_indikatif` AS rkpd_program_pagu_indikatif1,
                         rkpd_program.`keterangan` AS rkpd_program_keterangan,
                         CONCAT_WS('-',
                        SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 1, 8),
                        SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 9, 4),
                        SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 13, 4),
                        SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 17, 4),
                        SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 21)
                            ) AS rkpd_kegiatan_id_rkpd_kegiatan,
                         rkpd_kegiatan.`kd_kegiatan` AS rkpd_kegiatan_kd_kegiatan,
                         rkpd_kegiatan.`nm_kegiatan` AS rkpd_kegiatan_nm_kegiatan,
                         rkpd_kegiatan.`nm_subkegiatan` AS rkpd_kegiatan_nm_subkegiatan,
                         IFNULL(rkpd_kegiatan.`jml_anggaran_rkpd`,0)AS rkpd_kegiatan_jml_anggaran_rkpd,
                         SUM(IFNULL(rkpd_kegiatan.`jml_anggaran_rkpd`,0))AS rkpd_program_pagu_indikatif,
                    	 CONCAT_WS('-',
                        SUBSTR(HEX(rkpd_program.`sikd_bidang_id`), 1, 8),
                        SUBSTR(HEX(rkpd_program.`sikd_bidang_id`), 9, 4),
                        SUBSTR(HEX(rkpd_program.`sikd_bidang_id`), 13, 4),
                        SUBSTR(HEX(rkpd_program.`sikd_bidang_id`), 17, 4),
                        SUBSTR(HEX(rkpd_program.`sikd_bidang_id`), 21)
                            ) AS sikd_bidang_id,
                    	 CONCAT_WS('-',
                        SUBSTR(HEX(rkpd_program.`sikd_prog_id`), 1, 8),
                        SUBSTR(HEX(rkpd_program.`sikd_prog_id`), 9, 4),
                        SUBSTR(HEX(rkpd_program.`sikd_prog_id`), 13, 4),
                        SUBSTR(HEX(rkpd_program.`sikd_prog_id`), 17, 4),
                        SUBSTR(HEX(rkpd_program.`sikd_prog_id`), 21)
                            ) AS sikd_prog_id
                    FROM
                         `rkpd_program` rkpd_program 
                         INNER JOIN `rkpd_rkpd` rkpd_rkpd ON rkpd_program.`rkpd_rkpd_id` = rkpd_rkpd.`id_rkpd_rkpd`
                         LEFT OUTER JOIN `rkpd_anggaran` rkpd_kegiatan ON rkpd_program.`id_rkpd_program` = rkpd_kegiatan.`rkpd_program_id`
                    WHERE
                         rkpd_rkpd.`id_rkpd_rkpd` = :idRkpd
                     and if(:kdPrioritas!='', rkpd_kegiatan.`prioritas` = :kdPrioritas, 1)
                    GROUP BY
                         rkpd_program.`kd_program`
                    ORDER BY
                         rkpd_program.`kd_program` ASC,
                         rkpd_kegiatan.`kd_kegiatan` ASC
                    LIMIT 10";*/

                    "SELECT
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
                         concat(sikd_urusan.`kd_urusan`, '.', substr(sikd_bidang.`kd_bidang`,2,2)) AS sikd_bidang_kd_bidang,
                         sikd_bidang.`nm_bidang` AS sikd_bidang_nm_bidang,
                         CONCAT_WS('-',
                         SUBSTR(HEX(sikd_prog.`id_sikd_prog`), 1, 8),
                         SUBSTR(HEX(sikd_prog.`id_sikd_prog`), 9, 4),
                         SUBSTR(HEX(sikd_prog.`id_sikd_prog`), 13, 4),
                         SUBSTR(HEX(sikd_prog.`id_sikd_prog`), 17, 4),
                         SUBSTR(HEX(sikd_prog.`id_sikd_prog`), 21)
                            ) AS sikd_prog_id_sikd_prog,
                         concat(sikd_urusan.`kd_urusan`, '.', substr(sikd_bidang.`kd_bidang`,2,2),'.', sikd_prog.`kd_prog`) AS sikd_prog_kd_prog,
                         sikd_prog.`nm_prog` AS sikd_prog_nm_prog,
                         SUM(rkpd_skpd_kgtn.`jml_anggaran_rkpd`) AS jml_anggaran
                    FROM
                         `rkpd_anggaran` rkpd_skpd_kgtn
                         INNER JOIN `sikd_kgtn` sikd_kgtn ON rkpd_skpd_kgtn.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                         INNER JOIN `sikd_prog` sikd_prog ON sikd_kgtn.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                         INNER JOIN `sikd_bidang` sikd_bidang ON rkpd_skpd_kgtn.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                         INNER JOIN `sikd_urusan` sikd_urusan ON sikd_bidang.`sikd_urusan_id` = sikd_urusan.`id_sikd_urusan`
                    WHERE
                         rkpd_skpd_kgtn.`rkpd_rkpd_id` = :id_rkpd
                    GROUP BY
                         sikd_prog.`id_sikd_prog`
                    ORDER BY
                         sikd_urusan.`kd_urusan`, sikd_bidang.`kd_bidang`, sikd_prog.`kd_prog`";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rkpd", $idRkpd);
            //$statement->bindValue("kdPrioritas", $kdPrioritas);
            
            $statement->execute();
            $renstraReport = $statement->fetchAll();

            return new JsonResponse($renstraReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getRkpdRekapBidangProgKgtn($request)
    {
        try {
            $id_rkpd = $request->query->get("id_rkpd");
            $prioritas = $request->query->get("prioritas");
            $id_rkpd = pack('H*', str_replace('-', '', trim($id_rkpd)));
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $this->connection = $conn->getConnection();


            /*$conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $id_rkpd = $this->convertOuuidToUuid($id_rkpd);
            $this->connection = $conn->getConnection();*/
            
            /*$sql = "SELECT
                     CONCAT_WS('-',
                        SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 1, 8),
                        SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 9, 4),
                        SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 13, 4),
                        SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 17, 4),
                        SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 21)
                            ) AS rkpd_rkpd_id_rkpd_rkpd,
                     rkpd_rkpd.`tahun` AS rkpd_rkpd_tahun,
                     rkpd_rkpd.`jns_rkpd` AS rkpd_rkpd_jns_rkpd,
                     CONCAT_WS('-',
                        SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 1, 8),
                        SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 9, 4),
                        SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 13, 4),
                        SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 17, 4),
                        SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 21)
                            ) AS rkpd_program_id_rkpd_program,
                     rkpd_program.`kd_program` AS rkpd_program_kd_program,
                     rkpd_program.`tgt_anggaran_rpjmd` AS rkpd_program_tgt_anggaran_rpjmd,
                     rkpd_program.`rls_anggaran_sd_thn_lalu` AS rkpd_program_rls_anggaran_sd_thn_lalu,
                     rkpd_program.`pagu_indikatif` AS rkpd_program_pagu_indikatif,
                     rkpd_program.`keterangan` AS rkpd_program_keterangan,
                     CONCAT_WS('-',
                        SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 1, 8),
                        SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 9, 4),
                        SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 13, 4),
                        SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 17, 4),
                        SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 21)
                            ) AS rkpd_kegiatan_id_rkpd_kegiatan,
                     rkpd_kegiatan.`kd_kegiatan` AS rkpd_kegiatan_kd_kegiatan,
                     rkpd_kegiatan.`nm_kegiatan` AS rkpd_kegiatan_nm_kegiatan,
                     rkpd_kegiatan.`no_subkegiatan` AS rkpd_kegiatan_no_subkegiatan,
                     rkpd_kegiatan.`nm_subkegiatan` AS rkpd_kegiatan_nm_subkegiatan,
                     IFNULL(rkpd_kegiatan.`jml_anggaran_rkpd`,0)AS rkpd_kegiatan_jml_anggaran_rkpd,
                	 CONCAT_WS('-',
                        SUBSTR(HEX(rkpd_program.`sikd_bidang_id`), 1, 8),
                        SUBSTR(HEX(rkpd_program.`sikd_bidang_id`), 9, 4),
                        SUBSTR(HEX(rkpd_program.`sikd_bidang_id`), 13, 4),
                        SUBSTR(HEX(rkpd_program.`sikd_bidang_id`), 17, 4),
                        SUBSTR(HEX(rkpd_program.`sikd_bidang_id`), 21)
                            ) AS sikd_bidang_id,
                	 CONCAT_WS('-',
                        SUBSTR(HEX(rkpd_program.`sikd_prog_id`), 1, 8),
                        SUBSTR(HEX(rkpd_program.`sikd_prog_id`), 9, 4),
                        SUBSTR(HEX(rkpd_program.`sikd_prog_id`), 13, 4),
                        SUBSTR(HEX(rkpd_program.`sikd_prog_id`), 17, 4),
                        SUBSTR(HEX(rkpd_program.`sikd_prog_id`), 21)
                            ) AS sikd_prog_id,
                	 CONCAT_WS('-',
                        SUBSTR(HEX(rkpd_kegiatan.`sikd_satker_id`), 1, 8),
                        SUBSTR(HEX(rkpd_kegiatan.`sikd_satker_id`), 9, 4),
                        SUBSTR(HEX(rkpd_kegiatan.`sikd_satker_id`), 13, 4),
                        SUBSTR(HEX(rkpd_kegiatan.`sikd_satker_id`), 17, 4),
                        SUBSTR(HEX(rkpd_kegiatan.`sikd_satker_id`), 21)
                            ) AS sikd_satker_id,
                	 CONCAT_WS('-',
                        SUBSTR(HEX(rkpd_kegiatan.`sikd_kgtn_id`), 1, 8),
                        SUBSTR(HEX(rkpd_kegiatan.`sikd_kgtn_id`), 9, 4),
                        SUBSTR(HEX(rkpd_kegiatan.`sikd_kgtn_id`), 13, 4),
                        SUBSTR(HEX(rkpd_kegiatan.`sikd_kgtn_id`), 17, 4),
                        SUBSTR(HEX(rkpd_kegiatan.`sikd_kgtn_id`), 21)
                            ) AS sikd_kgtn_id,
                      CONCAT_WS('-',
                        SUBSTR(HEX(rkpd_kegiatan.`renja_anggaran_id`), 1, 8),
                        SUBSTR(HEX(rkpd_kegiatan.`renja_anggaran_id`), 9, 4),
                        SUBSTR(HEX(rkpd_kegiatan.`renja_anggaran_id`), 13, 4),
                        SUBSTR(HEX(rkpd_kegiatan.`renja_anggaran_id`), 17, 4),
                        SUBSTR(HEX(rkpd_kegiatan.`renja_anggaran_id`), 21)
                            ) AS renja_anggaran_id
                FROM
                     `rkpd_program` rkpd_program 
                     INNER JOIN `rkpd_rkpd` rkpd_rkpd ON rkpd_program.`rkpd_rkpd_id` = rkpd_rkpd.`id_rkpd_rkpd`
                     INNER JOIN `rkpd_anggaran` rkpd_kegiatan ON rkpd_program.`id_rkpd_program` = rkpd_kegiatan.`rkpd_program_id`
                WHERE
                     rkpd_rkpd.`id_rkpd_rkpd` = :id_rkpd
                     and if(:prioritas !='', rkpd_kegiatan.`prioritas` = :prioritas, 1)
                ORDER BY
                     rkpd_program.`kd_program` ASC,
                     rkpd_kegiatan.`kd_kegiatan` ASC,
                     lpad(rkpd_kegiatan.`no_subkegiatan`,3,0) ASC
                LIMIT 10    ";*/

            $sql = "SELECT
                        CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 1, 8),
                         SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 9, 4),
                         SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 13, 4),
                         SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 17, 4),
                         SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 21)
                            ) AS rkpd_rkpd_id_rkpd_rkpd,
                         rkpd_rkpd.`tahun` AS rkpd_rkpd_tahun,
                         rkpd_rkpd.`jns_rkpd` AS rkpd_rkpd_jns_rkpd,
                        CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_program.`id_rkpd_program`), 1, 8),
                         SUBSTR(HEX(rkpd_program.`id_rkpd_program`), 9, 4),
                         SUBSTR(HEX(rkpd_program.`id_rkpd_program`), 13, 4),
                         SUBSTR(HEX(rkpd_program.`id_rkpd_program`), 17, 4),
                         SUBSTR(HEX(rkpd_program.`id_rkpd_program`), 21)
                            ) AS rkpd_program_id_rkpd_program,
                         rkpd_program.`kd_program` AS rkpd_program_kd_program,
                        CONCAT_WS('-',
                         SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 1, 8),
                         SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 9, 4),
                         SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 13, 4),
                         SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 17, 4),
                         SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 21)
                            ) AS sikd_bidang_id_sikd_bidang,
                         sikd_bidang.`kd_bidang` AS sikd_bidang_kd_bidang,
                         sikd_bidang.`nm_bidang` AS sikd_bidang_nm_bidang,
                         sikd_satker.`kode` AS sikd_satker_kode,
                         sikd_satker.`nama` AS sikd_satker_nama,
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
                         SUBSTR(HEX(sikd_kgtn.id_sikd_kgtn), 1, 8),
                         SUBSTR(HEX(sikd_kgtn.id_sikd_kgtn), 9, 4),
                         SUBSTR(HEX(sikd_kgtn.id_sikd_kgtn), 13, 4),
                         SUBSTR(HEX(sikd_kgtn.id_sikd_kgtn), 17, 4),
                         SUBSTR(HEX(sikd_kgtn.id_sikd_kgtn), 21)
                            ) AS sikd_kgtn_id_sikd_kgtn,
                         if(length(sikd_kgtn.`kd_kgtn`)=4, substring(sikd_kgtn.`kd_kgtn`,-2), substring(sikd_kgtn.`kd_kgtn`,-3)) AS sikd_kgtn_kd_kgtn,
                         sikd_kgtn.`nm_kgtn` AS sikd_kgtn_nm_kgtn,
                         rkpd_program.`tgt_anggaran_rpjmd` AS rkpd_program_tgt_anggaran_rpjmd,
                         rkpd_program.`rls_anggaran_sd_thn_lalu` AS rkpd_program_rls_anggaran_sd_thn_lalu,
                         rkpd_program.`pagu_indikatif` AS rkpd_program_pagu_indikatif,
                         rkpd_program.`keterangan` AS rkpd_program_keterangan,
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
                         SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 1, 8),
                         SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 9, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 13, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 17, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 21)
                            ) AS rkpd_kegiatan_id_rkpd_kegiatan,
                         rkpd_kegiatan.`kd_kegiatan` AS rkpd_kegiatan_kd_kegiatan,
                         rkpd_kegiatan.`nm_kegiatan` AS rkpd_kegiatan_nm_kegiatan,
                         rkpd_kegiatan.`no_subkegiatan` AS rkpd_kegiatan_no_subkegiatan,
                         rkpd_kegiatan.`nm_subkegiatan` AS rkpd_kegiatan_nm_subkegiatan,
                         IFNULL(rkpd_kegiatan.`jml_anggaran_rkpd`,0)AS rkpd_kegiatan_jml_anggaran_rkpd,
                         IFNULL(renja_kegiatan.`tgt_anggaran_thn_ini`,0)AS renja_kegiatan_tgt_anggaran_thn_ini
                    FROM
                         `rkpd_program` rkpd_program 
                         INNER JOIN `rkpd_rkpd` rkpd_rkpd ON rkpd_program.`rkpd_rkpd_id` = rkpd_rkpd.`id_rkpd_rkpd`
                         INNER JOIN `sikd_bidang` sikd_bidang ON rkpd_program.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                         INNER JOIN `sikd_prog` sikd_prog ON rkpd_program.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                         INNER JOIN `sikd_urusan` sikd_urusan ON sikd_bidang.`sikd_urusan_id` = sikd_urusan.`id_sikd_urusan`
                         INNER JOIN `rkpd_anggaran` rkpd_kegiatan ON rkpd_program.`id_rkpd_program` = rkpd_kegiatan.`rkpd_program_id`
                         LEFT OUTER JOIN `renja_anggaran` renja_kegiatan ON rkpd_kegiatan.`renja_anggaran_id` = renja_kegiatan.`id_renja_anggaran`
                         LEFT OUTER JOIN `sikd_satker` sikd_satker ON rkpd_kegiatan.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                         LEFT OUTER JOIN `sikd_kgtn` sikd_kgtn ON rkpd_kegiatan.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                    WHERE
                         rkpd_rkpd.`id_rkpd_rkpd` = :id_rkpd
                     and if(:prioritas != '', rkpd_kegiatan.`prioritas` = :prioritas, 1)
                    ORDER BY
                         sikd_urusan.`kd_urusan` ASC,
                         sikd_bidang.`kd_bidang` ASC,
                         rkpd_program.`kd_program` ASC,
                         rkpd_kegiatan.`kd_kegiatan` ASC,
                         lpad(rkpd_kegiatan.`no_subkegiatan`,3,0) ASC";

            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rkpd", $id_rkpd);
            $statement->bindValue("prioritas", $prioritas);
            $statement->execute();
            $result = $statement->fetchAll();
            
            return new JsonResponse($result);
            
            /*$statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rkpd", $id_rkpd);
            $statement->bindValue("prioritas", $prioritas);
            
            $statement->execute();
            $renstraReport = $statement->fetchAll();
            
            return new JsonResponse($renstraReport);*/
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getRkpdRekapSatker($request)
    {
        try {
            $id_rkpd = $request->query->get("id_rkpd");
            $prioritas = $request->query->get("prioritas");
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $id_rkpd = pack('H*', str_replace('-', '', trim($id_rkpd)));
            $this->connection = $conn->getConnection();

            $sql = /*"SELECT
                         CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 1, 8),
                         SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 9, 4),
                         SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 13, 4),
                         SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 17, 4),
                         SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 21)
                         ) AS rkpd_rkpd_id_rkpd_rkpd,
                         rkpd_rkpd.`tahun` AS rkpd_rkpd_tahun,
                         rkpd_rkpd.`jns_rkpd` AS rkpd_rkpd_jns_rkpd,
                         CONCAT_WS('-',
                         SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 1, 8),
                         SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 9, 4),
                         SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 13, 4),
                         SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 17, 4),
                         SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 21)
                         ) AS sikd_satker_id_sikd_satker,
                         sikd_satker.`kode` AS sikd_satker_kode,
                         sikd_satker.`nama` AS sikd_satker_nama,
                         if(rkpd_kegiatan.`sikd_sub_skpd_id` !='', sikd_sub_skpd.`kode`, sikd_satker.`kode`) AS sikd_sub_skpd_kode,
                         if(rkpd_kegiatan.`sikd_sub_skpd_id` !='', sikd_sub_skpd.`nama`, 'SKPD INDUK') AS sikd_sub_skpd_nama,
                         if((select count('x') from sikd_sub_skpd a where a.sikd_satker_id = sikd_satker.id_sikd_satker) > 1, '1', '0') AS jml_sub_unit, 
                         CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 1, 8),
                         SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 9, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 13, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 17, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 21)
                         ) AS rkpd_kegiatan_id_rkpd_kegiatan,
                         rkpd_kegiatan.`kd_kegiatan` AS rkpd_kegiatan_kd_kegiatan,
                         rkpd_kegiatan.`nm_kegiatan` AS rkpd_kegiatan_nm_kegiatan,
                         rkpd_kegiatan.`nm_subkegiatan` AS rkpd_kegiatan_nm_subkegiatan,
                         SUM(rkpd_kegiatan.`jml_anggaran_rkpd`) AS rkpd_kegiatan_jml_anggaran_rkpd,
                         SUM(IFNULL(renja_kegiatan.`tgt_anggaran_thn_ini`,0)) AS renja_kegiatan_tgt_anggaran_thn_ini
                    FROM
                         `rkpd_anggaran` rkpd_kegiatan 
                         INNER JOIN `rkpd_rkpd` rkpd_rkpd ON rkpd_kegiatan.`rkpd_rkpd_id` = rkpd_rkpd.`id_rkpd_rkpd`
                         INNER JOIN `sikd_satker` sikd_satker ON rkpd_kegiatan.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                         LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON rkpd_kegiatan.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                         LEFT OUTER JOIN `renja_anggaran` renja_kegiatan ON renja_kegiatan.`id_renja_anggaran` = rkpd_kegiatan.`renja_anggaran_id`
                         LEFT OUTER JOIN `renja_renja` renja_renja ON renja_kegiatan.`renja_renja_id` = renja_renja.`id_renja_renja`
                    WHERE
                         rkpd_rkpd.`id_rkpd_rkpd` = :id_rkpd
                     and if(:prioritas !='', rkpd_kegiatan.`prioritas` = :prioritas, 1)
                    GROUP BY
                         sikd_satker_id_sikd_satker, sikd_sub_skpd_kode
                    ORDER BY
                         sikd_satker_kode,
                         sikd_satker_id_sikd_satker,
                         sikd_sub_skpd_kode";*/
                   
                   "SELECT
                        CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 1, 8),
                         SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 9, 4),
                         SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 13, 4),
                         SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 17, 4),
                         SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 21)
                         ) AS rkpd_rkpd_id_rkpd_rkpd,
                         rkpd_rkpd.`tahun` AS rkpd_rkpd_tahun,
                         rkpd_rkpd.`jns_rkpd` AS rkpd_rkpd_jns_rkpd,
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
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 1, 8),
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 9, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 13, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 17, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 21)
                         ) !='', sikd_sub_skpd.`kode`, sikd_satker.`kode`) AS sikd_sub_skpd_kode,
                         if(CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 1, 8),
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 9, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 13, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 17, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 21)
                         ) !='', sikd_sub_skpd.`nama`, 'SKPD INDUK') AS sikd_sub_skpd_nama,
                         if((select count('x') from sikd_sub_skpd a where a.sikd_satker_id = sikd_satker.id_sikd_satker) > 1, '1', '0') AS jml_sub_unit, 
                        CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 1, 8),
                         SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 9, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 13, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 17, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 21)
                         ) AS rkpd_kegiatan_id_rkpd_kegiatan,
                         rkpd_kegiatan.`kd_kegiatan` AS rkpd_kegiatan_kd_kegiatan,
                         rkpd_kegiatan.`nm_kegiatan` AS rkpd_kegiatan_nm_kegiatan,
                         rkpd_kegiatan.`nm_subkegiatan` AS rkpd_kegiatan_nm_subkegiatan,
                         SUM(rkpd_kegiatan.`jml_anggaran_rkpd`) AS rkpd_kegiatan_jml_anggaran_rkpd,
                         SUM(IFNULL(renja_kegiatan.`tgt_anggaran_thn_ini`,0)) AS renja_kegiatan_tgt_anggaran_thn_ini
                    FROM
                         `rkpd_anggaran` rkpd_kegiatan 
                         INNER JOIN `rkpd_rkpd` rkpd_rkpd ON rkpd_kegiatan.`rkpd_rkpd_id` = rkpd_rkpd.`id_rkpd_rkpd`
                         INNER JOIN `sikd_satker` sikd_satker ON rkpd_kegiatan.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                         LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON rkpd_kegiatan.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                         LEFT OUTER JOIN `renja_anggaran` renja_kegiatan ON renja_kegiatan.`id_renja_anggaran` = rkpd_kegiatan.`renja_anggaran_id`
                         LEFT OUTER JOIN `renja_renja` renja_renja ON renja_kegiatan.`renja_renja_id` = renja_renja.`id_renja_renja`
                    WHERE
                         rkpd_rkpd.`id_rkpd_rkpd` = :id_rkpd
                     and if(:prioritas != '', rkpd_kegiatan.`prioritas` = :prioritas, 1)
                    GROUP BY
                         sikd_satker_id_sikd_satker, sikd_sub_skpd_kode
                    ORDER BY
                         sikd_satker_kode,
                         sikd_satker_id_sikd_satker,
                         sikd_sub_skpd_kode";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rkpd", $id_rkpd);
            $statement->bindValue("prioritas", $prioritas);
            
            $statement->execute();
            $renstraReport = $statement->fetchAll();
            
            return new JsonResponse($renstraReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getRkpdRekapUrusanSatker($request)
    {
        try {
            $id_rkpd = $request->query->get("id_rkpd");
            $prioritas = $request->query->get("prioritas");
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $id_rkpd = pack('H*', str_replace('-', '', trim($id_rkpd)));
            $this->connection = $conn->getConnection();
            
            /*$sql = "SELECT
                         CONCAT_WS('-',
                        SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 1, 8),
                        SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 9, 4),
                        SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 13, 4),
                        SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 17, 4),
                        SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 21)
                            ) AS rkpd_rkpd_id_rkpd_rkpd,
                         rkpd_rkpd.`tahun` AS rkpd_rkpd_tahun,
                         rkpd_rkpd.`jns_rkpd` AS rkpd_rkpd_jns_rkpd, 
                         CONCAT_WS('-',
                        SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 1, 8),
                        SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 9, 4),
                        SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 13, 4),
                        SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 17, 4),
                        SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 21)
                            ) AS rkpd_kegiatan_id_rkpd_kegiatan,
                         rkpd_kegiatan.`kd_kegiatan` AS rkpd_kegiatan_kd_kegiatan,
                         rkpd_kegiatan.`nm_kegiatan` AS rkpd_kegiatan_nm_kegiatan,
                         rkpd_kegiatan.`nm_subkegiatan` AS rkpd_kegiatan_nm_subkegiatan,
                    	 CONCAT_WS('-',
                        SUBSTR(HEX(rkpd_kegiatan.`renja_anggaran_id`), 1, 8),
                        SUBSTR(HEX(rkpd_kegiatan.`renja_anggaran_id`), 9, 4),
                        SUBSTR(HEX(rkpd_kegiatan.`renja_anggaran_id`), 13, 4),
                        SUBSTR(HEX(rkpd_kegiatan.`renja_anggaran_id`), 17, 4),
                        SUBSTR(HEX(rkpd_kegiatan.`renja_anggaran_id`), 21)
                            ) AS renja_kegiatan_id_renja_kegiatan,
                         SUM(rkpd_kegiatan.`jml_anggaran_rkpd`)AS rkpd_kegiatan_jml_anggaran_rkpd,
                	 CONCAT_WS('-',
                        SUBSTR(HEX(rkpd_program.`sikd_bidang_id`), 1, 8),
                        SUBSTR(HEX(rkpd_program.`sikd_bidang_id`), 9, 4),
                        SUBSTR(HEX(rkpd_program.`sikd_bidang_id`), 13, 4),
                        SUBSTR(HEX(rkpd_program.`sikd_bidang_id`), 17, 4),
                        SUBSTR(HEX(rkpd_program.`sikd_bidang_id`), 21)
                            ) AS sikd_bidang_id_sikd_bidang,
                    	 CONCAT_WS('-',
                        SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 1, 8),
                        SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 9, 4),
                        SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 13, 4),
                        SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 17, 4),
                        SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 21)
                            ) AS sikd_sub_skpd_id,
                    	 CONCAT_WS('-',
                        SUBSTR(HEX(rkpd_kegiatan.`sikd_satker_id`), 1, 8),
                        SUBSTR(HEX(rkpd_kegiatan.`sikd_satker_id`), 9, 4),
                        SUBSTR(HEX(rkpd_kegiatan.`sikd_satker_id`), 13, 4),
                        SUBSTR(HEX(rkpd_kegiatan.`sikd_satker_id`), 17, 4),
                        SUBSTR(HEX(rkpd_kegiatan.`sikd_satker_id`), 21)
                            ) AS sikd_satker_id_sikd_satker
                    FROM
                         `rkpd_anggaran` rkpd_kegiatan 
                         INNER JOIN `rkpd_rkpd` rkpd_rkpd ON rkpd_kegiatan.`rkpd_rkpd_id` = rkpd_rkpd.`id_rkpd_rkpd`
                         INNER JOIN `rkpd_program` rkpd_program ON rkpd_kegiatan.`rkpd_program_id` = rkpd_program.`id_rkpd_program`
                    WHERE
                             rkpd_rkpd.`id_rkpd_rkpd` = :idRkpd
                             and if(:kdPrioritas!='', rkpd_kegiatan.`prioritas` = :kdPrioritas, 1)
                    GROUP BY
                    		 rkpd_program.`sikd_bidang_id`,
                    		 rkpd_kegiatan.`sikd_satker_id`,
                    		 rkpd_kegiatan.`sikd_sub_skpd_id`
                    ORDER BY
                    		 rkpd_program.`sikd_bidang_id`,
                    		 rkpd_kegiatan.`sikd_satker_id` ASC,
                    		 rkpd_kegiatan.`sikd_sub_skpd_id` ASC
                    ";*/

            $sql = "SELECT
                        CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 1, 8),
                         SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 9, 4),
                         SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 13, 4),
                         SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 17, 4),
                         SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 21)
                            ) AS rkpd_rkpd_id_rkpd_rkpd,
                         rkpd_rkpd.`tahun` AS rkpd_rkpd_tahun,
                         rkpd_rkpd.`jns_rkpd` AS rkpd_rkpd_jns_rkpd,
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
                         SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 1, 8),
                         SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 9, 4),
                         SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 13, 4),
                         SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 17, 4),
                         SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 21)
                            ) AS sikd_satker_id_sikd_satker,
                         sikd_satker.`kode` AS sikd_satker_kode,
                         sikd_satker.`nama` AS sikd_satker_nama,
                         if(CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 1, 8),
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 9, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 13, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 17, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 21)
                            ) != '', sikd_sub_skpd.`kode`, sikd_satker.`kode`) AS sikd_sub_skpd_kode,
                         if(CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 1, 8),
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 9, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 13, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 17, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 21)
                            ) != '', sikd_sub_skpd.`nama`, 'SKPD INDUK') AS sikd_sub_skpd_nama,
                         if((select count('x') from sikd_sub_skpd a where a.sikd_satker_id = sikd_satker.id_sikd_satker) > 1, '1', '0') AS jml_sub_unit, 
                        CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 1, 8),
                         SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 9, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 13, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 17, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 21)
                            ) AS rkpd_kegiatan_id_rkpd_kegiatan,
                         rkpd_kegiatan.`kd_kegiatan` AS rkpd_kegiatan_kd_kegiatan,
                         rkpd_kegiatan.`nm_kegiatan` AS rkpd_kegiatan_nm_kegiatan,
                         rkpd_kegiatan.`nm_subkegiatan` AS rkpd_kegiatan_nm_subkegiatan,
                        CONCAT_WS('-',
                         SUBSTR(HEX(renja_kegiatan.`id_renja_anggaran`), 1, 8),
                         SUBSTR(HEX(renja_kegiatan.`id_renja_anggaran`), 9, 4),
                         SUBSTR(HEX(renja_kegiatan.`id_renja_anggaran`), 13, 4),
                         SUBSTR(HEX(renja_kegiatan.`id_renja_anggaran`), 17, 4),
                         SUBSTR(HEX(renja_kegiatan.`id_renja_anggaran`), 21)
                            ) AS renja_kegiatan_id_renja_kegiatan,
                         SUM(rkpd_kegiatan.`jml_anggaran_rkpd`)AS rkpd_kegiatan_jml_anggaran_rkpd,
                         SUM(IFNULL(renja_kegiatan.`tgt_anggaran_thn_ini`,0))AS renja_kegiatan_tgt_anggaran_thn_ini
                    FROM
                         `rkpd_anggaran` rkpd_kegiatan 
                         INNER JOIN `rkpd_rkpd` rkpd_rkpd ON rkpd_kegiatan.`rkpd_rkpd_id` = rkpd_rkpd.`id_rkpd_rkpd`
                         INNER JOIN `rkpd_program` rkpd_program ON rkpd_kegiatan.`rkpd_program_id` = rkpd_program.`id_rkpd_program`
                         INNER JOIN `sikd_bidang` sikd_bidang ON rkpd_program.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                         INNER JOIN `sikd_urusan` sikd_urusan ON sikd_bidang.`sikd_urusan_id` = sikd_urusan.`id_sikd_urusan`
                         INNER JOIN `sikd_satker` sikd_satker ON rkpd_kegiatan.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                         LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON rkpd_kegiatan.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                         LEFT OUTER JOIN `renja_anggaran` renja_kegiatan ON renja_kegiatan.`id_renja_anggaran` = rkpd_kegiatan.`renja_anggaran_id`
                         LEFT OUTER JOIN `renja_renja` renja_renja ON renja_kegiatan.`renja_renja_id` = renja_renja.`id_renja_renja`
                    WHERE
                         rkpd_rkpd.`id_rkpd_rkpd` = :id_rkpd
                     and if(:prioritas != '', rkpd_kegiatan.`prioritas` = :prioritas, 1)
                    GROUP BY
                         sikd_bidang.id_sikd_bidang,
                         sikd_satker.id_sikd_satker,
                         sikd_sub_skpd_kode
                    ORDER BY
                         sikd_bidang_kd_bidang,
                         sikd_satker_kode ASC,
                         sikd_satker_id_sikd_satker ASC,
                         sikd_sub_skpd_kode ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rkpd", $id_rkpd);
            $statement->bindValue("prioritas", $prioritas);
            
            $statement->execute();
            $renstraReport = $statement->fetchAll();
            
            return new JsonResponse($renstraReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }

    private function getRkpdRekapSatkerProgKgtn1($request)
    {
         try {

            //print_r("ok");exit;

            $idRkpd = $request->query->get("id_rkpd");
            $prioritas = $request->query->get("prioritas");
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRkpd = pack('H*', str_replace('-', '', trim($idRkpd)));
            $this->connection = $conn->getConnection();
            
            //print_r($jnsRkpd);exit;

            $sql = "SELECT
                        CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 1, 8),
                         SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 9, 4),
                         SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 13, 4),
                         SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 17, 4),
                         SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 21)
                            ) AS rkpd_rkpd_id_rkpd_rkpd,
                         rkpd_rkpd.`tahun` AS rkpd_rkpd_tahun,
                         rkpd_rkpd.`jns_rkpd` AS rkpd_rkpd_jns_rkpd,
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
                         SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 1, 8),
                         SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 9, 4),
                         SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 13, 4),
                         SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 17, 4),
                         SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 21)
                            ) AS sikd_satker_id_sikd_satker,
                         sikd_satker.`kode` AS sikd_satker_kode,
                         sikd_satker.`nama` AS sikd_satker_nama,
                        if(CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 1, 8),
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 9, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 13, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 17, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 21)
                            ) !='', sikd_sub_skpd.`kode`, sikd_satker.`kode`) AS sikd_sub_skpd_kode,
                        if(CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 1, 8),
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 9, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 13, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 17, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 21)
                            ) !='', sikd_sub_skpd.`nama`, 'SKPD INDUK') AS sikd_sub_skpd_nama,
                         if((select count('x') from sikd_sub_skpd a where a.sikd_satker_id = sikd_satker.id_sikd_satker) > 1, '1', '0') AS jml_sub_unit, 
                         rkpd_program.`kd_program` AS rkpd_program_kd_program,
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
                        CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 1, 8),
                         SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 9, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 13, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 17, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 21)
                            ) AS rkpd_kegiatan_id_rkpd_kegiatan,
                         rkpd_kegiatan.`kd_kegiatan` AS rkpd_kegiatan_kd_kegiatan,
                        CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_kgtn_id`), 1, 8),
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_kgtn_id`), 9, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_kgtn_id`), 13, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_kgtn_id`), 17, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_kgtn_id`), 21)
                            ) AS rkpd_kegiatan_sikd_kgtn_id,
                         rkpd_kegiatan.`nm_kegiatan` AS rkpd_kegiatan_nm_kegiatan,
                         rkpd_kegiatan.`no_subkegiatan` AS rkpd_kegiatan_no_subkegiatan,
                         rkpd_kegiatan.`nm_subkegiatan` AS rkpd_kegiatan_nm_subkegiatan,
                        CONCAT_WS('-',
                         SUBSTR(HEX(renja_kegiatan.`id_renja_anggaran`), 1, 8),
                         SUBSTR(HEX(renja_kegiatan.`id_renja_anggaran`), 9, 4),
                         SUBSTR(HEX(renja_kegiatan.`id_renja_anggaran`), 13, 4),
                         SUBSTR(HEX(renja_kegiatan.`id_renja_anggaran`), 17, 4),
                         SUBSTR(HEX(renja_kegiatan.`id_renja_anggaran`), 21)
                            ) AS renja_kegiatan_id_renja_kegiatan,
                         SUM(rkpd_kegiatan.`jml_anggaran_rkpd`)AS rkpd_kegiatan_jml_anggaran_rkpd,
                         SUM(IFNULL(renja_kegiatan.`tgt_anggaran_thn_ini`,0))AS renja_kegiatan_tgt_anggaran_thn_ini
                    FROM
                         `rkpd_anggaran` rkpd_kegiatan 
                         INNER JOIN `rkpd_rkpd` rkpd_rkpd ON rkpd_kegiatan.`rkpd_rkpd_id` = rkpd_rkpd.`id_rkpd_rkpd`
                         INNER JOIN `rkpd_program` rkpd_program ON rkpd_kegiatan.`rkpd_program_id` = rkpd_program.`id_rkpd_program`
                         INNER JOIN `sikd_bidang` sikd_bidang ON rkpd_program.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                         INNER JOIN `sikd_prog` sikd_prog ON rkpd_program.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                         INNER JOIN `sikd_kgtn` sikd_kgtn ON rkpd_kegiatan.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                         INNER JOIN `sikd_urusan` sikd_urusan ON sikd_bidang.`sikd_urusan_id` = sikd_urusan.`id_sikd_urusan`
                         INNER JOIN `sikd_satker` sikd_satker ON rkpd_kegiatan.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                         LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON rkpd_kegiatan.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                         LEFT OUTER JOIN `renja_anggaran` renja_kegiatan ON renja_kegiatan.`id_renja_anggaran` = rkpd_kegiatan.`renja_anggaran_id`
                         LEFT OUTER JOIN `renja_renja` renja_renja ON renja_kegiatan.`renja_renja_id` = renja_renja.`id_renja_renja`
                    WHERE
                         rkpd_rkpd.`id_rkpd_rkpd` = :id_rkpd
                     and if(:prioritas != '', rkpd_kegiatan.`prioritas` = :prioritas, 1)
                    GROUP BY
                         sikd_urusan_kd_urusan,
                         sikd_bidang_kd_bidang,
                         sikd_satker_id_sikd_satker,
                         sikd_sub_skpd_kode,
                         sikd_prog_kd_prog,
                         rkpd_kegiatan.id_rkpd_anggaran
                    ORDER BY
                         sikd_urusan_kd_urusan ASC,
                         sikd_bidang_kd_bidang ASC,
                         sikd_satker_kode ASC,
                         sikd_satker_id_sikd_satker ASC,
                         sikd_sub_skpd_kode ASC,
                         sikd_prog_kd_prog ASC,
                         sikd_kgtn.`kd_kgtn` ASC,
                         LPAD(rkpd_kegiatan_no_subkegiatan,3,0)";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rkpd", $idRkpd);
            $statement->bindValue("prioritas", $prioritas);
            
            $statement->execute();
            $renstraReport = $statement->fetchAll();

            return new JsonResponse($renstraReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }

    private function getRkpdRekapSatkerProgKgtn2($request)
    {
         try {

            //print_r("ok");exit;

            $idRkpd = $request->query->get("id_rkpd");
            $prioritas = $request->query->get("prioritas");
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRkpd = pack('H*', str_replace('-', '', trim($idRkpd)));
            $this->connection = $conn->getConnection();
            
            //print_r($jnsRkpd);exit;

            $sql = "SELECT
                        CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 1, 8),
                         SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 9, 4),
                         SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 13, 4),
                         SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 17, 4),
                         SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 21)
                            ) AS rkpd_rkpd_id_rkpd_rkpd,
                         rkpd_rkpd.`tahun` AS rkpd_rkpd_tahun,
                         rkpd_rkpd.`jns_rkpd` AS rkpd_rkpd_jns_rkpd,
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
                         SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 1, 8),
                         SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 9, 4),
                         SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 13, 4),
                         SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 17, 4),
                         SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 21)
                            ) AS sikd_satker_id_sikd_satker,
                         sikd_satker.`kode` AS sikd_satker_kode,
                         sikd_satker.`nama` AS sikd_satker_nama,
                        if(CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 1, 8),
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 9, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 13, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 17, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 21)
                            ) !='', sikd_sub_skpd.`kode`, sikd_satker.`kode`) AS sikd_sub_skpd_kode,
                        if(CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 1, 8),
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 9, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 13, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 17, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 21)
                            ) !='', sikd_sub_skpd.`nama`, 'SKPD INDUK') AS sikd_sub_skpd_nama,
                         if((select count('x') from sikd_sub_skpd a where a.sikd_satker_id = sikd_satker.id_sikd_satker) > 1, '1', '0') AS jml_sub_unit, 
                         rkpd_program.`kd_program` AS rkpd_program_kd_program,
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
                        CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 1, 8),
                         SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 9, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 13, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 17, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 21)
                            ) AS rkpd_kegiatan_id_rkpd_kegiatan,
                         rkpd_kegiatan.`kd_kegiatan` AS rkpd_kegiatan_kd_kegiatan,
                        CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_kgtn_id`), 1, 8),
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_kgtn_id`), 9, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_kgtn_id`), 13, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_kgtn_id`), 17, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_kgtn_id`), 21)
                            ) AS rkpd_kegiatan_sikd_kgtn_id,
                         rkpd_kegiatan.`nm_kegiatan` AS rkpd_kegiatan_nm_kegiatan,
                         rkpd_kegiatan.`no_subkegiatan` AS rkpd_kegiatan_no_subkegiatan,
                         rkpd_kegiatan.`nm_subkegiatan` AS rkpd_kegiatan_nm_subkegiatan,
                        CONCAT_WS('-',
                         SUBSTR(HEX(renja_kegiatan.`id_renja_anggaran`), 1, 8),
                         SUBSTR(HEX(renja_kegiatan.`id_renja_anggaran`), 9, 4),
                         SUBSTR(HEX(renja_kegiatan.`id_renja_anggaran`), 13, 4),
                         SUBSTR(HEX(renja_kegiatan.`id_renja_anggaran`), 17, 4),
                         SUBSTR(HEX(renja_kegiatan.`id_renja_anggaran`), 21)
                            ) AS renja_kegiatan_id_renja_kegiatan,
                         SUM(rkpd_kegiatan.`jml_anggaran_rkpd`)AS rkpd_kegiatan_jml_anggaran_rkpd,
                         SUM(IFNULL(renja_kegiatan.`tgt_anggaran_thn_ini`,0))AS renja_kegiatan_tgt_anggaran_thn_ini
                    FROM
                         `rkpd_anggaran` rkpd_kegiatan 
                         INNER JOIN `rkpd_rkpd` rkpd_rkpd ON rkpd_kegiatan.`rkpd_rkpd_id` = rkpd_rkpd.`id_rkpd_rkpd`
                         INNER JOIN `rkpd_program` rkpd_program ON rkpd_kegiatan.`rkpd_program_id` = rkpd_program.`id_rkpd_program`
                         INNER JOIN `sikd_bidang` sikd_bidang ON rkpd_program.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                         INNER JOIN `sikd_prog` sikd_prog ON rkpd_program.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                         INNER JOIN `sikd_kgtn` sikd_kgtn ON rkpd_kegiatan.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                         INNER JOIN `sikd_urusan` sikd_urusan ON sikd_bidang.`sikd_urusan_id` = sikd_urusan.`id_sikd_urusan`
                         INNER JOIN `sikd_satker` sikd_satker ON rkpd_kegiatan.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                         LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON rkpd_kegiatan.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                         LEFT OUTER JOIN `renja_anggaran` renja_kegiatan ON renja_kegiatan.`id_renja_anggaran` = rkpd_kegiatan.`renja_anggaran_id`
                         LEFT OUTER JOIN `renja_renja` renja_renja ON renja_kegiatan.`renja_renja_id` = renja_renja.`id_renja_renja`
                    WHERE
                         rkpd_rkpd.`id_rkpd_rkpd` = :id_rkpd
                     and if(:prioritas !='', rkpd_kegiatan.`prioritas` = :prioritas, 1)
                    GROUP BY
                         sikd_satker_id_sikd_satker,
                         sikd_sub_skpd_kode,
                         sikd_bidang_kd_bidang,
                         sikd_prog_kd_prog,
                         rkpd_kegiatan.id_rkpd_anggaran
                    ORDER BY
                         sikd_satker_kode ASC,
                         sikd_satker_id_sikd_satker ASC,
                         sikd_sub_skpd_kode ASC,
                         sikd_bidang_kd_bidang ASC,
                         sikd_prog_kd_prog ASC,
                         sikd_kgtn.`kd_kgtn` ASC,
                         LPAD(rkpd_kegiatan_no_subkegiatan,3,0)";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rkpd", $idRkpd);
            $statement->bindValue("prioritas", $prioritas);
            
            $statement->execute();
            $renstraReport = $statement->fetchAll();

            return new JsonResponse($renstraReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }

    private function getRkpdRekapListKgtnSkpd($request)
    {
        try {
            $idRkpd = $request->query->get("id_rkpd");
            $prioritas = $request->query->get("prioritas");
            $idSatker = $request->query->get("id_satker");
            $idSubSkpd = $request->query->get("id_subSkpd");
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            
            $idRkpd = pack('H*', str_replace('-', '', trim($idRkpd)));
            $idSatker = pack('H*', str_replace('-', '', trim($idSatker)));
            
            if ($idSubSkpd != ''){
                $idSubSkpd = pack('H*', str_replace('-', '', trim($idSubSkpd)));
            }
            
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                         rkpd_rkpd.`jns_rkpd` AS rkpd_rkpd_jns_rkpd,
                        CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 1, 8),
                         SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 9, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 13, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 17, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 21)
                            ) AS ppas_satker_id_rkpd_skpd_kgtn,
                        CONCAT_WS('-',
                         SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 1, 8),
                         SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 9, 4),
                         SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 13, 4),
                         SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 17, 4),
                         SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 21)
                            ) AS sikd_satker_id_sikd_satker,
                         sikd_satker.`kode` AS sikd_satker_kode,
                         sikd_satker.`nama` AS sikd_satker_nama,
                         if(:id_satker != '', if(:id_subSkpd != '%', CONCAT_WS('-',
                         SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 1, 8),
                         SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 9, 4),
                         SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 13, 4),
                         SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 17, 4),
                         SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 21)
                            ), ''), '') AS sikd_sub_skpd_id_sikd_sub_skpd,
                         if(:id_satker != '', if(:id_subSkpd = '', sikd_satker.`kode`, if(:id_subSkpd = '%', '', sikd_sub_skpd.`kode`)), '') AS sikd_sub_skpd_kode,
                         if(:id_satker != '', if(:id_subSkpd = '', 'SKPD INDUK', if(:id_subSkpd = '%', 'SEMUA UNIT', sikd_sub_skpd.`nama`)), '') AS sikd_sub_skpd_nama,
                         sikd_sub_skpd.`kode` AS sikd_sub_skpd_kode_,
                         sikd_sub_skpd.`nama` AS sikd_sub_skpd_nama_,
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
                         concat(sikd_bidang.`kd_bidang`, '.',sikd_prog.`kd_prog`) AS sikd_prog_kd_prog,
                         sikd_prog.`nm_prog` AS sikd_prog_nm_prog,
                        CONCAT_WS('-',
                         SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 1, 8),
                         SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 9, 4),
                         SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 13, 4),
                         SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 17, 4),
                         SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 21)
                            ) AS sikd_kgtn_id_sikd_kgtn,
                         concat(sikd_bidang.`kd_bidang`, '.',sikd_prog.`kd_prog`,'.',substr(sikd_kgtn.`kd_kgtn`,3,3))  AS sikd_kgtn_kd_kgtn,
                         sikd_kgtn.`nm_kgtn` AS sikd_kgtn_nm_kgtn,
                         rkpd_kegiatan.`no_subkegiatan` AS rkpd_kegiatan_no_subkegiatan,
                         rkpd_kegiatan.`nm_subkegiatan` AS rkpd_kegiatan_nm_subkegiatan,
                         rkpd_kegiatan.`target_kgtn` AS rkpd_kegiatan_target_kgtn,
                         rkpd_kegiatan.`catatan_rkpd` AS rkpd_kegiatan_catatan_rkpd,
                         ifnull((Select GROUP_CONCAT(DISTINCT a.target_kgtn ORDER BY a.no_subkegiatan DESC SEPARATOR ';\n')
                                 From rkpd_anggaran a
                                 Where a.rkpd_rkpd_id = :id_rkpd
                                   and a.kd_kegiatan = rkpd_kegiatan.kd_kegiatan 
                                   and a.prioritas = rkpd_kegiatan.prioritas 
                                   and a.sikd_satker_id = rkpd_kegiatan.sikd_satker_id 
                                   and a.sikd_sub_skpd_id = rkpd_kegiatan.sikd_sub_skpd_id
                                   and a.target_kgtn != ''), '-') AS rekap_rkpd_kgtn_target_kgtn,
                         SUM(rkpd_kegiatan.`jml_anggaran_rkpd`)AS jml_plafon
                    FROM
                         `rkpd_anggaran` rkpd_kegiatan
                         INNER JOIN `rkpd_rkpd` rkpd_rkpd ON rkpd_kegiatan.`rkpd_rkpd_id` = rkpd_rkpd.`id_rkpd_rkpd`
                         INNER JOIN `sikd_kgtn` sikd_kgtn ON rkpd_kegiatan.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                         INNER JOIN `rkpd_program` rkpd_program ON rkpd_kegiatan.`rkpd_program_id` = rkpd_program.`id_rkpd_program`
                         INNER JOIN `sikd_bidang` sikd_bidang ON rkpd_program.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                         INNER JOIN `sikd_urusan` sikd_urusan ON sikd_bidang.`sikd_urusan_id` = sikd_urusan.`id_sikd_urusan`
                         INNER JOIN `sikd_prog` sikd_prog ON rkpd_program.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                         INNER JOIN `sikd_satker` sikd_satker ON rkpd_kegiatan.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                         LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON rkpd_kegiatan.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                         INNER JOIN `sikd_bidang` sikd_bidang_induk ON sikd_satker.`kd_bidang_induk` = sikd_bidang_induk.`kd_bidang`
                    WHERE
                         rkpd_kegiatan.`rkpd_rkpd_id` = :id_rkpd
                     and if(:prioritas != '', rkpd_kegiatan.`prioritas` = :prioritas, 1)
                     and if(:id_satker != '', rkpd_kegiatan.`sikd_satker_id` = :id_satker, 1)
                     and if(:id_satker != '', if(:id_subSkpd != '%', rkpd_kegiatan.`sikd_sub_skpd_id` = :id_subSkpd,
                            rkpd_kegiatan.`sikd_sub_skpd_id` like '%'), 1)
                    GROUP BY
                         rkpd_kegiatan.id_rkpd_anggaran,
                         rkpd_kegiatan.`no_subkegiatan`
                    ORDER BY
                         sikd_satker.`kode`, sikd_sub_skpd.`kode`,
                         sikd_urusan.`kd_urusan`, sikd_bidang.`kd_bidang`,
                         sikd_prog.`kd_prog`, sikd_kgtn.`kd_kgtn`,
                         lpad(rkpd_kegiatan.`no_subkegiatan`, 3, 0)";

            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rkpd", $idRkpd);
            $statement->bindValue("prioritas", $prioritas);
            $statement->bindValue("id_satker", $idSatker);
            $statement->bindValue("id_subSkpd", $idSubSkpd);
            
            $statement->execute();
            $rkpdReport = $statement->fetchAll();
            
            return new JsonResponse($rkpdReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }

    private function getRkpdRekapSatker1($request)
    {
        try {
            $idRkpd = $request->query->get("id_rkpd");
            $prioritas = $request->query->get("prioritas");
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRkpd = pack('H*', str_replace('-', '', trim($idRkpd)));
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
                        if(CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 1, 8),
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 9, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 13, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 17, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 21)
                            ) != '', sikd_sub_skpd.`kode`, sikd_satker.`kode`) AS sikd_sub_skpd_kode,
                         if(CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 1, 8),
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 9, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 13, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 17, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 21)
                            ) != '', sikd_sub_skpd.`nama`, 'SKPD INDUK') AS sikd_sub_skpd_nama,
                         if((select count('x') from sikd_sub_skpd a where a.sikd_satker_id = sikd_satker.id_sikd_satker) > 1, '1', '0') AS jml_sub_unit, 
                        CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_kegiatan.`rkpd_rkpd_id`), 1, 8),
                         SUBSTR(HEX(rkpd_kegiatan.`rkpd_rkpd_id`), 9, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`rkpd_rkpd_id`), 13, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`rkpd_rkpd_id`), 17, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`rkpd_rkpd_id`), 21)
                            ) AS rkpd_kegiatan_rkpd_rkpd_id,
                        CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 1, 8),
                         SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 9, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 13, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 17, 4),
                         SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 21)
                            ) AS rkpd_kegiatan_id_rkpd_kegiatan,
                         IF(rkpd_rkpd.jns_rkpd = 'RKPD-A', 'Rancangan RKPD', IF(rkpd_rkpd.jns_rkpd = 'RKPD-F', 'RKPD FInal', 'RKPD Perubahan')) AS jns_rkpd,
                         IF(rkpd_rkpd.status_rkpd = '0','Draft','') AS status_rkpd, 
                         rkpd_rkpd.no_dokumen AS rkpd_rkpd_no_dokumen,  
                         date_format(rkpd_rkpd.tgl_pengesahan,'%d-%m-%Y') AS rkpd_rkpd_tgl_pengesahan,  
                         0 AS jml_plafon_pdpt,
                         0 AS jml_plafon_btl,
                         SUM(rkpd_kegiatan.jml_anggaran_rkpd) AS jml_plafon_bl
                    FROM
                         `rkpd_rkpd` rkpd_rkpd
                         INNER JOIN `rkpd_anggaran` rkpd_kegiatan ON rkpd_rkpd.`id_rkpd_rkpd` = rkpd_kegiatan.`rkpd_rkpd_id`
                         INNER JOIN `sikd_satker` sikd_satker ON rkpd_kegiatan.sikd_satker_id = sikd_satker.`id_sikd_satker`
                         INNER JOIN `sikd_satker` sikd_skpd ON sikd_satker.id_sikd_satker = sikd_skpd.`id_sikd_satker`
                         LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON rkpd_kegiatan.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                    WHERE
                         rkpd_rkpd.id_rkpd_rkpd = :id_rkpd
                    GROUP BY
                         sikd_satker_id_sikd_satker,
                         sikd_sub_skpd_kode
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
                        if(CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_anggaran.`sikd_sub_skpd_id`), 1, 8),
                         SUBSTR(HEX(rkpd_anggaran.`sikd_sub_skpd_id`), 9, 4),
                         SUBSTR(HEX(rkpd_anggaran.`sikd_sub_skpd_id`), 13, 4),
                         SUBSTR(HEX(rkpd_anggaran.`sikd_sub_skpd_id`), 17, 4),
                         SUBSTR(HEX(rkpd_anggaran.`sikd_sub_skpd_id`), 21)
                            ) != '', sikd_sub_skpd.`kode`, sikd_satker.`kode`) AS sikd_sub_skpd_kode,
                        if(CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_anggaran.`sikd_sub_skpd_id`), 1, 8),
                         SUBSTR(HEX(rkpd_anggaran.`sikd_sub_skpd_id`), 9, 4),
                         SUBSTR(HEX(rkpd_anggaran.`sikd_sub_skpd_id`), 13, 4),
                         SUBSTR(HEX(rkpd_anggaran.`sikd_sub_skpd_id`), 17, 4),
                         SUBSTR(HEX(rkpd_anggaran.`sikd_sub_skpd_id`), 21)
                            ) != '', sikd_sub_skpd.`nama`, 'SKPD INDUK') AS sikd_sub_skpd_nama,
                         if((select count('x') from sikd_sub_skpd a where a.sikd_satker_id = sikd_satker.id_sikd_satker) > 1, '1', '0') AS jml_sub_unit, 
                        CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_anggaran.`rkpd_rkpd_id`), 1, 8),
                         SUBSTR(HEX(rkpd_anggaran.`rkpd_rkpd_id`), 9, 4),
                         SUBSTR(HEX(rkpd_anggaran.`rkpd_rkpd_id`), 13, 4),
                         SUBSTR(HEX(rkpd_anggaran.`rkpd_rkpd_id`), 17, 4),
                         SUBSTR(HEX(rkpd_anggaran.`rkpd_rkpd_id`), 21)
                            ) AS rkpd_anggaran_rkpd_rkpd_id,
                        CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_anggaran.`id_rkpd_anggaran`), 1, 8),
                         SUBSTR(HEX(rkpd_anggaran.`id_rkpd_anggaran`), 9, 4),
                         SUBSTR(HEX(rkpd_anggaran.`id_rkpd_anggaran`), 13, 4),
                         SUBSTR(HEX(rkpd_anggaran.`id_rkpd_anggaran`), 17, 4),
                         SUBSTR(HEX(rkpd_anggaran.`id_rkpd_anggaran`), 21)
                            ) AS rkpd_anggaran_id_rkpd_anggaran,
                         IF(rkpd_rkpd.jns_rkpd = 'RKPD-A', 'Rancangan RKPD', IF(rkpd_rkpd.jns_rkpd = 'RKPD-F', 'RKPD Final', 'RKPD Perubahan')) AS jns_rkpd,
                         IF(rkpd_rkpd.status_rkpd = '0','Draft','') AS status_rkpd, 
                         rkpd_rkpd.no_dokumen AS rkpd_rkpd_no_dokumen,  
                         date_format(rkpd_rkpd.tgl_pengesahan,'%d-%m-%Y') AS rkpd_rkpd_tgl_pengesahan,  
                         SUM(IF(rkpd_anggaran.rkpd_anggaran_type = 'RkpdPendapatan', rkpd_mata_anggaran.jumlah, 0)) AS jml_plafon_pdpt,
                         -- SUM(IF(rkpd_anggaran.rkpd_anggaran_type = 'RkpdBlnjTdkLangsung', rkpd_mata_anggaran.jumlah, 0)) AS jml_plafon_btl,
                         SUM(IF(rkpd_anggaran.rkpd_anggaran_type = 'RkpdBelanja', rkpd_mata_anggaran.jumlah, 0)) AS jml_plafon_btl,
                         0 AS jml_plafon_bl
                    FROM
                         `rkpd_rkpd` rkpd_rkpd
                         INNER JOIN `rkpd_anggaran` rkpd_anggaran ON rkpd_rkpd.`id_rkpd_rkpd` = rkpd_anggaran.`rkpd_rkpd_id`
                         INNER JOIN `sikd_satker` sikd_satker ON rkpd_anggaran.sikd_satker_id = sikd_satker.`id_sikd_satker`
                         INNER JOIN `sikd_satker` sikd_skpd ON sikd_satker.id_sikd_satker = sikd_skpd.`id_sikd_satker`
                         LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON rkpd_anggaran.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                         INNER JOIN `rkpd_mata_anggaran` rkpd_mata_anggaran ON rkpd_anggaran.`id_rkpd_anggaran` = rkpd_mata_anggaran.`rkpd_anggaran_id`
                    WHERE
                         rkpd_rkpd.id_rkpd_rkpd = :id_rkpd
                    GROUP BY
                         sikd_satker_id_sikd_satker,
                         sikd_sub_skpd_kode

                    ORDER BY
                         sikd_satker_kode,
                         sikd_sub_skpd_kode";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rkpd", $idRkpd);
            $statement->bindValue("prioritas", $prioritas);
            
            $statement->execute();
            $renstraReport = $statement->fetchAll();
            
            return new JsonResponse($renstraReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }

    private function getRkpdRekapSatker2($request)
    {
        try {
            $idRkpd = $request->query->get("id_rkpd");
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRkpd = pack('H*', str_replace('-', '', trim($idRkpd)));
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                    CONCAT_WS('-',
                        SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 1, 8),
                        SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 9, 4),
                        SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 13, 4),
                        SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 17, 4),
                        SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 21)
                            ) AS rkpd_rkpd_id_rkpd_rkpd,
                     rkpd_rkpd.`tahun` AS rkpd_rkpd_tahun,
                     rkpd_rkpd.`jns_rkpd` AS rkpd_rkpd_jns_rkpd,
                     CONCAT_WS('-',
                        SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 1, 8),
                        SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 9, 4),
                        SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 13, 4),
                        SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 17, 4),
                        SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 21)
                            ) AS sikd_satker_id_sikd_satker,
                     sikd_satker.`kode` AS sikd_satker_kode,
                     sikd_satker.`nama` AS sikd_satker_nama,
                     if(rkpd_anggaran.`sikd_sub_skpd_id` !='', sikd_sub_skpd.`kode`, sikd_satker.`kode`) AS sikd_sub_skpd_kode,
                     if(rkpd_anggaran.`sikd_sub_skpd_id` !='', sikd_sub_skpd.`nama`, 'SKPD INDUK') AS sikd_sub_skpd_nama,
                     if((select count('x') from sikd_sub_skpd a where a.sikd_satker_id = sikd_satker.id_sikd_satker) > 1, '1', '0') AS jml_sub_unit,
                     CONCAT_WS('-',
                        SUBSTR(HEX(rkpd_anggaran.`id_rkpd_anggaran`), 1, 8),
                        SUBSTR(HEX(rkpd_anggaran.`id_rkpd_anggaran`), 9, 4),
                        SUBSTR(HEX(rkpd_anggaran.`id_rkpd_anggaran`), 13, 4),
                        SUBSTR(HEX(rkpd_anggaran.`id_rkpd_anggaran`), 17, 4),
                        SUBSTR(HEX(rkpd_anggaran.`id_rkpd_anggaran`), 21)
                            )  AS rkpd_kegiatan_id_rkpd_kegiatan,
                     rkpd_anggaran.`kd_kegiatan` AS rkpd_kegiatan_kd_kegiatan,
                     rkpd_anggaran.`nm_kegiatan` AS rkpd_kegiatan_nm_kegiatan,
                     rkpd_anggaran.`nm_subkegiatan` AS rkpd_kegiatan_nm_subkegiatan,
                     SUM(rkpd_anggaran.`jml_anggaran_rkpd`) AS rkpd_kegiatan_jml_anggaran_rkpd,
                     IF(rkpd_rkpd.`jns_rkpd` = 'RKPD-A', SUM(IFNULL(rkpd_anggaran.`jml_usulan_anggaran`, 0)),'') AS renja_kegiatan_tgt_anggaran_thn_ini, 
                     IF(rkpd_rkpd.`jns_rkpd` = 'RKPD-A', SUM(IFNULL(rkpd_anggaran.`jml_usulan_anggaran`, 0)), 
                     -- IFNULL(renja_blnj_langsung.`jumlah`,0)) AS renja_kegiatan_tgt_anggaran_thn_ini,
                     -- IFNULL(ppas_blnj_langsung.`jumlah`,0) AS ppas_kegiatan_usulan,
                     -- IFNULL(ppas_blnj_langsung.`jml_final`,0) AS ppas_kegiatan_final,
                     -- IFNULL(ppas_blnj_langsung.`jml_revisi`,0) AS ppas_kegiatan_revisi
                     IFNULL(renja_belanja.`jumlah`,0)) AS renja_kegiatan_tgt_anggaran_thn_ini,
                     IFNULL(ppas_belanja.`jumlah`,0) AS ppas_kegiatan_usulan,
                     IFNULL(ppas_belanja.`jml_final`,0) AS ppas_kegiatan_final,
                     IFNULL(ppas_belanja.`jml_revisi`,0) AS ppas_kegiatan_revisi
                FROM
                     `rkpd_anggaran` rkpd_anggaran 
                     INNER JOIN `rkpd_rkpd` rkpd_rkpd ON rkpd_anggaran.`rkpd_rkpd_id` = rkpd_rkpd.`id_rkpd_rkpd`
                     INNER JOIN `sikd_satker` sikd_satker ON rkpd_anggaran.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                     LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON rkpd_anggaran.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                     LEFT OUTER JOIN (select a.sikd_satker_id, a.sikd_sub_skpd_id, if(f.jns_rkpd = 'RKPD-F', sum(e.jumlah), sum(f1.jml_usulan_anggaran)) as jumlah
                              from renja_renja a, renja_anggaran c, 
                               renja_anggaran d, renja_mata_anggaran e, rkpd_rkpd f, rkpd_anggaran f1
                              -- WHERE c.renja_anggaran_type = 'RenjaBlnjLangsung'
                              WHERE c.renja_anggaran_type = 'RenjaBelanja'
                   and a.id_renja_renja = c.renja_renja_id
                            and c.id_renja_anggaran = d.id_renja_anggaran
                            and d.id_renja_anggaran = e.renja_anggaran_id
                            and d.rkpd_anggaran_id = f1.id_rkpd_anggaran
                            and f1.rkpd_rkpd_id = f.id_rkpd_rkpd
                            and f.id_rkpd_rkpd = :id_rkpd
                              -- group by a.sikd_satker_id, a.sikd_sub_skpd_id) AS renja_blnj_langsung
                              group by a.sikd_satker_id, a.sikd_sub_skpd_id) AS renja_belanja
                     -- ON renja_blnj_langsung.sikd_satker_id = rkpd_anggaran.`sikd_satker_id`
                    -- AND renja_blnj_langsung.sikd_sub_skpd_id = rkpd_anggaran.`sikd_sub_skpd_id`
                     ON renja_belanja.sikd_satker_id = rkpd_anggaran.`sikd_satker_id`
                     AND renja_belanja.sikd_sub_skpd_id = rkpd_anggaran.`sikd_sub_skpd_id`
                     LEFT OUTER JOIN (select c.sikd_satker_id, c.sikd_sub_skpd_id, 
                           sum(c.jml_usulan) as jumlah, 
                           sum(c.jml_final) as jml_final,
                           sum(c.jml_revisi) as jml_revisi
                          from ppas_ppas a, ppas_anggaran b, ppas_anggaran c
                          WHERE b.ppas_anggaran_type = 'PpasBelanja'
                and a.id_ppas_ppas = c.ppas_ppas_id
                      and c.id_ppas_anggaran = b.id_ppas_anggaran
                          -- group by c.sikd_satker_id, c.sikd_sub_skpd_id) AS ppas_blnj_langsung
                          group by c.sikd_satker_id, c.sikd_sub_skpd_id) AS ppas_belanja
                     -- ON ppas_blnj_langsung.sikd_satker_id = rkpd_anggaran.`sikd_satker_id`
                    -- AND ppas_blnj_langsung.sikd_sub_skpd_id = rkpd_anggaran.`sikd_sub_skpd_id`
                     ON ppas_belanja.sikd_satker_id = rkpd_anggaran.`sikd_satker_id`
                    AND ppas_belanja.sikd_sub_skpd_id = rkpd_anggaran.`sikd_sub_skpd_id`
                WHERE
                    rkpd_rkpd.`id_rkpd_rkpd` =:id_rkpd
                GROUP BY
                     sikd_satker_id_sikd_satker, 
                     sikd_sub_skpd_kode
                ORDER BY
                     sikd_satker_kode,
                     sikd_satker_id_sikd_satker,
                     sikd_sub_skpd_kode";
            
            //print_r($sql);exit;
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rkpd", $idRkpd);
           
            $statement->execute();
            $renstraReport = $statement->fetchAll();
            
            return new JsonResponse($renstraReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }

    //PERMENDAGRI
    private function getRkpdLampPermen231b($request)
    {
        try {

            // $idRkpd = $request->query->get("id_rkpd");
            // $tahun = $request->query->get("tahun");
            //$kdPrioritas = $request->query->get("prioritas");
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            //$idRkpd = pack('H*', str_replace('-', '', trim($idRkpd)));
            $this->connection = $conn->getConnection();
            
            //print_r("ok");exit;

            $sql = "SELECT
                         CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_dok_rencana_pembangunan.`id_rkpd_dok_renc_pembangunan`), 1, 8),
                         SUBSTR(HEX(rkpd_dok_rencana_pembangunan.`id_rkpd_dok_renc_pembangunan`), 9, 4),
                         SUBSTR(HEX(rkpd_dok_rencana_pembangunan.`id_rkpd_dok_renc_pembangunan`), 13, 4),
                         SUBSTR(HEX(rkpd_dok_rencana_pembangunan.`id_rkpd_dok_renc_pembangunan`), 17, 4),
                         SUBSTR(HEX(rkpd_dok_rencana_pembangunan.`id_rkpd_dok_renc_pembangunan`), 21)
                            ) AS rkpd_dok_rencana_pembangunan_id_rkpd_dok_rencana_pembangunan,
                         rkpd_dok_rencana_pembangunan.`tahun` AS rkpd_dok_rencana_pembangunan_tahun,
                         rkpd_dok_rencana_pembangunan.`no_urut` AS rkpd_dok_rencana_pembangunan_no_urut,
                         rkpd_dok_rencana_pembangunan.`jns_dokumen` AS rkpd_dok_rencana_pembangunan_jns_dokumen,
                         rkpd_dok_rencana_pembangunan.`uraian` AS rkpd_dok_rencana_pembangunan_uraian,
                         rkpd_dok_rencana_pembangunan.`dasar_hukum` AS rkpd_dok_rencana_pembangunan_dasar_hukum,
                         rkpd_dok_rencana_pembangunan.`no_dokumen` AS rkpd_dok_rencana_pembangunan_no_dokumen,
                         rkpd_dok_rencana_pembangunan.`tgl_pengesahan` AS rkpd_dok_rencana_pembangunan_tgl_pengesahan,
                         rkpd_dok_rencana_pembangunan.`status` AS rkpd_dok_rencana_pembangunan_status,
                         rkpd_dok_rencana_pembangunan.`keterangan` AS rkpd_dok_rencana_pembangunan_keterangan
                    FROM
                         `rkpd_dok_renc_pembangunan` rkpd_dok_rencana_pembangunan
                    ORDER BY
                         rkpd_dok_rencana_pembangunan.`no_urut`
                    ";
            
            $statement = $this->connection->prepare($sql);
            // $statement->bindValue("idRkpd", $idRkpd);
            // $statement->bindValue("tahun", $tahun);
            //$statement->bindValue("kdPrioritas", $kdPrioritas);
            
            $statement->execute();
            $renstraReport = $statement->fetchAll();

            return new JsonResponse($renstraReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getRkpdLampPermen231c($request)
    {
        try {

            // $idRkpd = $request->query->get("id_rkpd");
            // $tahun = $request->query->get("tahun");
            //$kdPrioritas = $request->query->get("prioritas");
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            //$idRkpd = pack('H*', str_replace('-', '', trim($idRkpd)));
            $this->connection = $conn->getConnection();
            
            //print_r("ok");exit;

            $sql = "SELECT
                        if(sikd_sub_skpd.`kode` <> '', CONCAT_WS('-',
                         SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 1, 8),
                         SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 9, 4),
                         SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 13, 4),
                         SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 17, 4),
                         SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 21)
                            ), CONCAT_WS('-',
                         SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 1, 8),
                         SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 9, 4),
                         SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 13, 4),
                         SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 17, 4),
                         SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 21)
                            )) AS sikd_satker_id_sikd_satker,
                         if(sikd_sub_skpd.`kode` <> '', sikd_sub_skpd.`kode`, sikd_satker.`kode`) AS sikd_satker_kode,
                         if(sikd_sub_skpd.`kode` <> '', sikd_sub_skpd.`nama`, sikd_satker.`nama`) AS sikd_satker_nama,
                         renja_renja.`tahun` AS tahun,
                         round((renja_renja.`tahun`-1),0) AS tahun_sblm
                    FROM
                         `sikd_satker` sikd_satker 
                         INNER JOIN `renja_renja` renja_renja ON sikd_satker.`id_sikd_satker` = renja_renja.`sikd_satker_id`
                         LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON renja_renja.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                    WHERE
                         renja_renja.`jns_renja` = 'Renja-A'
                    ORDER BY
                        sikd_satker.kode";
            
            $statement = $this->connection->prepare($sql);
            // $statement->bindValue("idRkpd", $idRkpd);
            // $statement->bindValue("tahun", $tahun);
            //$statement->bindValue("kdPrioritas", $kdPrioritas);
            
            $statement->execute();
            $renstraReport = $statement->fetchAll();

            return new JsonResponse($renstraReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }

    private function getRkpdLampPermen231d($request)
    {
        try {

            //print_r("ok");exit;

            $idRkpd = $request->query->get("id_rkpd");
            //$tahun = $request->query->get("tahun");
            //$kdPrioritas = $request->query->get("prioritas");
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRkpd = pack('H*', str_replace('-', '', trim($idRkpd)));
            $this->connection = $conn->getConnection();
            
            //print_r($jnsRkpd);exit;

            $sql = /*"SELECT
                CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 1, 8),
                         SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 9, 4),
                         SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 13, 4),
                         SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 17, 4),
                         SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 21)
                            )AS rkpd_rkpd_id_rkpd_rkpd,
                 rkpd_rkpd.`tahun` AS rkpd_rkpd_tahun,
                 rkpd_rkpd.`jns_rkpd` AS rkpd_rkpd_jns_rkpd,
                 rkpd_rkpd.`status_rkpd` AS rkpd_rkpd_status_rkpd,
                 CONCAT_WS('-',
                         SUBSTR(HEX(sikd_urusan.`id_sikd_urusan`), 1, 8),
                         SUBSTR(HEX(sikd_urusan.`id_sikd_urusan`), 9, 4),
                         SUBSTR(HEX(sikd_urusan.`id_sikd_urusan`), 13, 4),
                         SUBSTR(HEX(sikd_urusan.`id_sikd_urusan`), 17, 4),
                         SUBSTR(HEX(sikd_urusan.`id_sikd_urusan`), 21)
                            )AS sikd_urusan_id_sikd_urusan,
                 sikd_urusan.`kd_urusan` AS sikd_urusan_kd_urusan,
                 sikd_urusan.`nm_urusan` AS sikd_urusan_nm_urusan,
                CONCAT_WS('-',
                         SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 1, 8),
                         SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 9, 4),
                         SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 13, 4),
                         SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 17, 4),
                         SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 21)
                            )AS sikd_bidang_id_sikd_bidang,
                 sikd_bidang.`kd_bidang` AS sikd_bidang_kd_bidang,
                 sikd_bidang.`nm_bidang` AS sikd_bidang_nm_bidang,
                 CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_program.`id_rkpd_program`), 1, 8),
                         SUBSTR(HEX(rkpd_program.`id_rkpd_program`), 9, 4),
                         SUBSTR(HEX(rkpd_program.`id_rkpd_program`), 13, 4),
                         SUBSTR(HEX(rkpd_program.`id_rkpd_program`), 17, 4),
                         SUBSTR(HEX(rkpd_program.`id_rkpd_program`), 21)
                            )AS rkpd_program_id_rkpd_program,
                 rkpd_program.`kd_program` AS rkpd_program_kd_program,
                 sikd_prog.`kd_prog` AS sikd_prog_kd_prog,
                 sikd_prog.`nm_prog` AS sikd_prog_nm_prog,
                 rkpd_program.`pagu_indikatif` AS rkpd_program_pagu_indikatif,
                 CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_anggaran.`id_rkpd_anggaran`), 1, 8),
                         SUBSTR(HEX(rkpd_anggaran.`id_rkpd_anggaran`), 9, 4),
                         SUBSTR(HEX(rkpd_anggaran.`id_rkpd_anggaran`), 13, 4),
                         SUBSTR(HEX(rkpd_anggaran.`id_rkpd_anggaran`), 17, 4),
                         SUBSTR(HEX(rkpd_anggaran.`id_rkpd_anggaran`), 21)
                            )AS rkpd_kegiatan_id_rkpd_kegiatan,
                CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_anggaran.`renja_anggaran_id`), 1, 8),
                         SUBSTR(HEX(rkpd_anggaran.`renja_anggaran_id`), 9, 4),
                         SUBSTR(HEX(rkpd_anggaran.`renja_anggaran_id`), 13, 4),
                         SUBSTR(HEX(rkpd_anggaran.`renja_anggaran_id`), 17, 4),
                         SUBSTR(HEX(rkpd_anggaran.`renja_anggaran_id`), 21)
                            )AS renja_kegiatan_id_renja_kegiatan,
                 rkpd_anggaran.`kd_kegiatan` AS rkpd_kegiatan_kd_kegiatan,
                 rkpd_anggaran.`nm_kegiatan` AS rkpd_kegiatan_nm_kegiatan,
                 rkpd_anggaran.`nm_subkegiatan` AS rkpd_kegiatan_nm_subkegiatan,
                 rkpd_anggaran.`jml_anggaran_rkpd` AS rkpd_kegiatan_jml_anggaran_rkpd,
                 ifnull(CONCAT_WS('-',
                         SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 1, 8),
                         SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 9, 4),
                         SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 13, 4),
                         SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 17, 4),
                         SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 21)
                            ),
                        CONCAT_WS('-',
                         SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 1, 8),
                         SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 9, 4),
                         SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 13, 4),
                         SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 17, 4),
                         SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 21)
                            )) AS sikd_satker_id_sikd_satker,
                 ifnull(sikd_sub_skpd.`kode`, sikd_satker.`kode`) AS sikd_satker_kode,
                 ifnull(sikd_sub_skpd.`nama`, sikd_satker.`nama`) AS sikd_satker_nama,
                 if(rkpd_anggaran.`sikd_sub_skpd_id` != '', sikd_sub_skpd.`nama`, sikd_satker.`nama`) AS nm_satker_pelaksana,
                CONCAT_WS('-',
                         SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 1, 8),
                         SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 9, 4),
                         SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 13, 4),
                         SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 17, 4),
                         SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 21)
                            )AS sikd_kgtn_id_sikd_kgtn,
                 sikd_kgtn.`kd_kgtn` AS sikd_kgtn_kd_kgtn,
                 sikd_kgtn.`nm_kgtn` AS sikd_kgtn_nm_kgtn
            FROM
                 `rkpd_program` rkpd_program 
                 INNER JOIN `rkpd_rkpd` rkpd_rkpd ON rkpd_program.`rkpd_rkpd_id` = rkpd_rkpd.`id_rkpd_rkpd`
                 INNER JOIN `sikd_bidang` sikd_bidang ON rkpd_program.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                 INNER JOIN `sikd_urusan` sikd_urusan ON sikd_bidang.`sikd_urusan_id` = sikd_urusan.`id_sikd_urusan`
                 INNER JOIN `sikd_prog` sikd_prog ON rkpd_program.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                 INNER JOIN `rkpd_anggaran` rkpd_anggaran ON rkpd_program.`id_rkpd_program` = rkpd_anggaran.`rkpd_program_id`
                 INNER JOIN `sikd_satker` sikd_satker ON rkpd_anggaran.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                 LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON rkpd_anggaran.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                 LEFT OUTER JOIN `sikd_kgtn` sikd_kgtn ON rkpd_anggaran.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                 -- INNER JOIN `sikd_sub_kgtn` sikd_sub_kgtn ON sikd_kgtn.`id_sikd_kgtn` = sikd_sub_kgtn.`sikd_kgtn_id`
            WHERE
                 rkpd_rkpd.id_rkpd_rkpd = :idRkpd  
            ORDER BY
                 sikd_urusan.`kd_urusan` ASC,
                 sikd_bidang.`kd_bidang` ASC,
                 rkpd_program.`kd_program` ASC,
                 sikd_satker.`kode` ASC,
                 sikd_sub_skpd.`kode` ASC,
                 sikd_kgtn.`kd_kgtn` ASC
                    ";*/

                "SELECT
                    CONCAT_WS('-',
                     SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 1, 8),
                     SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 9, 4),
                     SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 13, 4),
                     SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 17, 4),
                     SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 21)
                        ) AS rkpd_rkpd_id_rkpd_rkpd,
                     rkpd_rkpd.`tahun` AS rkpd_rkpd_tahun,
                     rkpd_rkpd.`jns_rkpd` AS rkpd_rkpd_jns_rkpd,
                     rkpd_rkpd.`status_rkpd` AS rkpd_rkpd_status_rkpd,
                    CONCAT_WS('-',
                     SUBSTR(HEX(rkpd_prioritas_kab.`id_rkpd_prioritas_kab`), 1, 8),
                     SUBSTR(HEX(rkpd_prioritas_kab.`id_rkpd_prioritas_kab`), 9, 4),
                     SUBSTR(HEX(rkpd_prioritas_kab.`id_rkpd_prioritas_kab`), 13, 4),
                     SUBSTR(HEX(rkpd_prioritas_kab.`id_rkpd_prioritas_kab`), 17, 4),
                     SUBSTR(HEX(rkpd_prioritas_kab.`id_rkpd_prioritas_kab`), 21)
                        ) AS rkpd_prioritas_kab_id_rkpd_prioritas_kab,
                    CONCAT_WS('-',
                     SUBSTR(HEX(rkpd_prioritas.`id_rkpd_prioritas_kab`), 1, 8),
                     SUBSTR(HEX(rkpd_prioritas.`id_rkpd_prioritas_kab`), 9, 4),
                     SUBSTR(HEX(rkpd_prioritas.`id_rkpd_prioritas_kab`), 13, 4),
                     SUBSTR(HEX(rkpd_prioritas.`id_rkpd_prioritas_kab`), 17, 4),
                     SUBSTR(HEX(rkpd_prioritas.`id_rkpd_prioritas_kab`), 21)
                        ) AS rkpd_prioritas_id_rkpd_prioritas,
                     ifnull(rkpd_prioritas.`no_prioritas`,'-') AS rkpd_prioritas_no_prioritas,
                     ifnull(rkpd_prioritas.`nm_program`, '-') AS rkpd_prioritas_nm_program,
                    CONCAT_WS('-',
                     SUBSTR(HEX(rkpd_sasaran.`id_rkpd_sasaran`), 1, 8),
                     SUBSTR(HEX(rkpd_sasaran.`id_rkpd_sasaran`), 9, 4),
                     SUBSTR(HEX(rkpd_sasaran.`id_rkpd_sasaran`), 13, 4),
                     SUBSTR(HEX(rkpd_sasaran.`id_rkpd_sasaran`), 17, 4),
                     SUBSTR(HEX(rkpd_sasaran.`id_rkpd_sasaran`), 21)
                        ) AS rkpd_sasaran_id_rkpd_sasaran,
                     ifnull(rkpd_sasaran.`no_sasaran`, '-') AS rkpd_sasaran_no_sasaran,
                     ifnull(rkpd_sasaran.`uraian_sasaran`, '-') AS rkpd_sasaran_uraian_sasaran,
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
                     SUBSTR(HEX(rkpd_program.`id_rkpd_program`), 1, 8),
                     SUBSTR(HEX(rkpd_program.`id_rkpd_program`), 9, 4),
                     SUBSTR(HEX(rkpd_program.`id_rkpd_program`), 13, 4),
                     SUBSTR(HEX(rkpd_program.`id_rkpd_program`), 17, 4),
                     SUBSTR(HEX(rkpd_program.`id_rkpd_program`), 21)
                        ) AS rkpd_program_id_rkpd_program,
                     rkpd_program.`kd_program` AS rkpd_program_kd_program,
                     sikd_prog.`kd_prog` AS sikd_prog_kd_prog,
                     sikd_prog.`nm_prog` AS sikd_prog_nm_prog,
                     rkpd_program.`pagu_indikatif` AS rkpd_program_pagu_indikatif,
                    CONCAT_WS('-',
                     SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 1, 8),
                     SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 9, 4),
                     SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 13, 4),
                     SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 17, 4),
                     SUBSTR(HEX(rkpd_kegiatan.`id_rkpd_anggaran`), 21)
                        ) AS rkpd_kegiatan_id_rkpd_kegiatan,
                     rkpd_kegiatan.`kd_kegiatan` AS rkpd_kegiatan_kd_kegiatan,
                     rkpd_kegiatan.`nm_kegiatan` AS rkpd_kegiatan_nm_kegiatan,
                     rkpd_kegiatan.`nm_subkegiatan` AS rkpd_kegiatan_nm_subkegiatan,
                     rkpd_kegiatan.`jml_anggaran_rkpd` AS rkpd_kegiatan_jml_anggaran_rkpd,
                     renja_kegiatan.`tgt_anggaran_thn_ini` AS renja_kegiatan_tgt_anggaran_thn_ini,
                     renja_kegiatan.`tgt_anggaran_thn_dpn` AS renja_kegiatan_tgt_anggaran_thn_dpn,
                    ifnull(CONCAT_WS('-',
                     SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 1, 8),
                     SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 9, 4),
                     SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 13, 4),
                     SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 17, 4),
                     SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 21)
                        ), CONCAT_WS('-',
                     SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 1, 8),
                     SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 9, 4),
                     SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 13, 4),
                     SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 17, 4),
                     SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 21)
                        )) AS sikd_satker_id_sikd_satker,
                     ifnull(sikd_sub_skpd.`kode`, sikd_satker.`kode`) AS sikd_satker_kode,
                     ifnull(sikd_sub_skpd.`nama`, sikd_satker.`nama`) AS sikd_satker_nama,
                     renja_kegiatan.`jns_kgtn` AS renja_kegiatan_jns_kgtn,
                     renja_kegiatan.`lokasi_kgtn` AS renja_kegiatan_lokasi_kgtn,
                    CONCAT_WS('-',
                     SUBSTR(HEX(renja_kegiatan.`id_renja_anggaran`), 1, 8),
                     SUBSTR(HEX(renja_kegiatan.`id_renja_anggaran`), 9, 4),
                     SUBSTR(HEX(renja_kegiatan.`id_renja_anggaran`), 13, 4),
                     SUBSTR(HEX(renja_kegiatan.`id_renja_anggaran`), 17, 4),
                     SUBSTR(HEX(renja_kegiatan.`id_renja_anggaran`), 21)
                        ) AS renja_kegiatan_id_renja_kegiatan,
                    if(CONCAT_WS('-',
                     SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 1, 8),
                     SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 9, 4),
                     SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 13, 4),
                     SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 17, 4),
                     SUBSTR(HEX(rkpd_kegiatan.`sikd_sub_skpd_id`), 21)
                        ) != '', sikd_sub_skpd.`nama`, sikd_satker.`nama`) AS nm_satker_pelaksana,
                    CONCAT_WS('-',
                     SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 1, 8),
                     SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 9, 4),
                     SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 13, 4),
                     SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 17, 4),
                     SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 21)
                        ) AS sikd_kgtn_id_sikd_kgtn,
                     sikd_kgtn.`kd_kgtn` AS sikd_kgtn_kd_kgtn,
                     sikd_kgtn.`nm_kgtn` AS sikd_kgtn_nm_kgtn
                FROM
                     `rkpd_program` rkpd_program 
                     INNER JOIN `rkpd_rkpd` rkpd_rkpd ON rkpd_program.`rkpd_rkpd_id` = rkpd_rkpd.`id_rkpd_rkpd`
                     INNER JOIN `sikd_bidang` sikd_bidang ON rkpd_program.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                     INNER JOIN `sikd_urusan` sikd_urusan ON sikd_bidang.`sikd_urusan_id` = sikd_urusan.`id_sikd_urusan`
                     INNER JOIN `sikd_prog` sikd_prog ON rkpd_program.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                     INNER JOIN `rkpd_anggaran` rkpd_kegiatan ON rkpd_program.`id_rkpd_program` = rkpd_kegiatan.`rkpd_program_id`
                     INNER JOIN `sikd_satker` sikd_satker ON rkpd_kegiatan.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                     LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON rkpd_kegiatan.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                     LEFT OUTER JOIN `sikd_kgtn` sikd_kgtn ON rkpd_kegiatan.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                     LEFT OUTER JOIN `renja_anggaran` renja_kegiatan ON renja_kegiatan.`id_renja_anggaran` = rkpd_kegiatan.`renja_anggaran_id`
                     LEFT OUTER JOIN `rkpd_prioritas_kab` rkpd_prioritas_kab ON renja_kegiatan.`rkpd_prioritas_kab_id` = rkpd_prioritas_kab.`id_rkpd_prioritas_kab`
                     LEFT OUTER JOIN `rkpd_prioritas_kab` rkpd_prioritas ON rkpd_prioritas_kab.`id_rkpd_prioritas_kab` = rkpd_prioritas.`id_rkpd_prioritas_kab`
                     LEFT OUTER JOIN `rkpd_sasaran` rkpd_sasaran ON renja_kegiatan.`rkpd_sasaran_id` = rkpd_sasaran.`id_rkpd_sasaran`
                WHERE
                     rkpd_rkpd.id_rkpd_rkpd = :id_rkpd  
                ORDER BY
                     rkpd_prioritas.`no_prioritas` ASC,
                     rkpd_sasaran.`no_sasaran` ASC,
                     sikd_urusan.`kd_urusan` ASC,
                     sikd_bidang.`kd_bidang` ASC,
                     rkpd_program.`kd_program` ASC,
                     sikd_satker.`kode` ASC,
                     sikd_sub_skpd.`kode` ASC,
                     sikd_kgtn.`kd_kgtn` ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rkpd", $idRkpd);
            //$statement->bindValue("tahun", $tahun);
            //$statement->bindValue("kdPrioritas", $kdPrioritas);
            
            $statement->execute();
            $renstraReport = $statement->fetchAll();

            return new JsonResponse($renstraReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }

    private function getRkpdLampPermen231dSub1($request)
    {
        try {

            //print_r("ok");exit;

            $idProg = $request->query->get("id_prog");
            //$tahun = $request->query->get("tahun");
            //$kdPrioritas = $request->query->get("prioritas");
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idProg = pack('H*', str_replace('-', '', trim($idProg)));
            $this->connection = $conn->getConnection();
            
            //print_r($jnsRkpd);exit;

            $sql = "SELECT
                        CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_program_indikator.`id_rkpd_program_indikator`), 1, 8),
                         SUBSTR(HEX(rkpd_program_indikator.`id_rkpd_program_indikator`), 9, 4),
                         SUBSTR(HEX(rkpd_program_indikator.`id_rkpd_program_indikator`), 13, 4),
                         SUBSTR(HEX(rkpd_program_indikator.`id_rkpd_program_indikator`), 17, 4),
                         SUBSTR(HEX(rkpd_program_indikator.`id_rkpd_program_indikator`), 21)
                            ) AS rkpd_program_indikator_id_rkpd_program_indikator,
                        CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_program_indikator.`rkpd_program_id`), 1, 8),
                         SUBSTR(HEX(rkpd_program_indikator.`rkpd_program_id`), 9, 4),
                         SUBSTR(HEX(rkpd_program_indikator.`rkpd_program_id`), 13, 4),
                         SUBSTR(HEX(rkpd_program_indikator.`rkpd_program_id`), 17, 4),
                         SUBSTR(HEX(rkpd_program_indikator.`rkpd_program_id`), 21)
                            ) AS rkpd_program_indikator_rkpd_program_id,
                         rkpd_program_indikator.`no_indikator` AS rkpd_program_indikator_no_indikator,
                         rkpd_program_indikator.`uraian_indikator` AS rkpd_program_indikator_uraian_indikator,
                         rkpd_program_indikator.`satuan` AS rkpd_program_indikator_satuan,
                         rkpd_program_indikator.`target_thn_ini` AS rkpd_program_indikator_target_thn_ini
                    FROM
                         `rkpd_program_indikator` rkpd_program_indikator
                    WHERE
                         rkpd_program_indikator.`rkpd_program_id` = :id_prog
                    ORDER BY
                         rkpd_program_indikator.`no_indikator`
                    ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_prog", $idProg);
            //$statement->bindValue("tahun", $tahun);
            //$statement->bindValue("kdPrioritas", $kdPrioritas);
            
            $statement->execute();
            $renstraReport = $statement->fetchAll();

            return new JsonResponse($renstraReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }

    private function getRkpdLampPermen231dMod($request)
    {
        try {

            //print_r("ok");exit;

            $idRkpd = $request->query->get("id_rkpd");
            //$tahun = $request->query->get("tahun");
            //$kdPrioritas = $request->query->get("prioritas");
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRkpd = pack('H*', str_replace('-', '', trim($idRkpd)));
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                        CONCAT_WS('-',
                             SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 1, 8),
                             SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 9, 4),
                             SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 13, 4),
                             SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 17, 4),
                             SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 21)
                                ) AS rkpd_rkpd_id_rkpd_rkpd,
                         rkpd_rkpd.`tahun` AS rkpd_rkpd_tahun,
                         rkpd_rkpd.`jns_rkpd` AS rkpd_rkpd_jns_rkpd,
                         rkpd_rkpd.`status_rkpd` AS rkpd_rkpd_status_rkpd,
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
                             SUBSTR(HEX(rkpd_program.`id_rkpd_program`), 1, 8),
                             SUBSTR(HEX(rkpd_program.`id_rkpd_program`), 9, 4),
                             SUBSTR(HEX(rkpd_program.`id_rkpd_program`), 13, 4),
                             SUBSTR(HEX(rkpd_program.`id_rkpd_program`), 17, 4),
                             SUBSTR(HEX(rkpd_program.`id_rkpd_program`), 21)
                                ) AS rkpd_program_id_rkpd_program,
                         rkpd_program.`kd_program` AS rkpd_program_kd_program,
                         sikd_prog.`kd_prog` AS sikd_prog_kd_prog,
                         sikd_prog.`nm_prog` AS sikd_prog_nm_prog,
                         rkpd_program.`pagu_indikatif` AS rkpd_program_pagu_indikatif,
                        CONCAT_WS('-',
                             SUBSTR(HEX(rkpd_anggaran.`id_rkpd_anggaran`), 1, 8),
                             SUBSTR(HEX(rkpd_anggaran.`id_rkpd_anggaran`), 9, 4),
                             SUBSTR(HEX(rkpd_anggaran.`id_rkpd_anggaran`), 13, 4),
                             SUBSTR(HEX(rkpd_anggaran.`id_rkpd_anggaran`), 17, 4),
                             SUBSTR(HEX(rkpd_anggaran.`id_rkpd_anggaran`), 21)
                                ) AS rkpd_kegiatan_id_rkpd_kegiatan,
                         rkpd_anggaran.`kd_kegiatan` AS rkpd_kegiatan_kd_kegiatan,
                         rkpd_anggaran.`nm_kegiatan` AS rkpd_kegiatan_nm_kegiatan,
                         rkpd_anggaran.`nm_subkegiatan` AS rkpd_kegiatan_nm_subkegiatan,
                         rkpd_anggaran.`prioritas` AS rkpd_kegiatan_prioritas,
                         rkpd_anggaran.`jml_anggaran_rkpd` AS rkpd_kegiatan_jml_anggaran_rkpd,
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
                                ) AS sikd_sub_skpd_id_sikd_sub_skpd_,
                         sikd_sub_skpd.`kode` AS sikd_sub_skpd_kode_,
                         '' AS sikd_sub_skpd_id_sikd_sub_skpd,
                         '' AS sikd_sub_skpd_kode,
                         sikd_sub_skpd.`nama` AS sikd_sub_skpd_nama,
                        CONCAT_WS('-',
                             SUBSTR(HEX(rkpd_anggaran.`renja_anggaran_id`), 1, 8),
                             SUBSTR(HEX(rkpd_anggaran.`renja_anggaran_id`), 9, 4),
                             SUBSTR(HEX(rkpd_anggaran.`renja_anggaran_id`), 13, 4),
                             SUBSTR(HEX(rkpd_anggaran.`renja_anggaran_id`), 17, 4),
                             SUBSTR(HEX(rkpd_anggaran.`renja_anggaran_id`), 21)
                                ) AS renja_kegiatan_id_renja_kegiatan,
                        CONCAT_WS('-',
                             SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 1, 8),
                             SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 9, 4),
                             SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 13, 4),
                             SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 17, 4),
                             SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 21)
                                ) AS sikd_kgtn_id_sikd_kgtn,
                         sikd_kgtn.`kd_kgtn` AS sikd_kgtn_kd_kgtn,
                         sikd_kgtn.`nm_kgtn` AS sikd_kgtn_nm_kgtn
                    FROM
                         `rkpd_program` rkpd_program 
                         INNER JOIN `rkpd_rkpd` rkpd_rkpd ON rkpd_program.`rkpd_rkpd_id` = rkpd_rkpd.`id_rkpd_rkpd`
                         INNER JOIN `sikd_bidang` sikd_bidang ON rkpd_program.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                         INNER JOIN `sikd_urusan` sikd_urusan ON sikd_bidang.`sikd_urusan_id` = sikd_urusan.`id_sikd_urusan`
                         INNER JOIN `sikd_prog` sikd_prog ON rkpd_program.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                         INNER JOIN `rkpd_anggaran` rkpd_anggaran ON rkpd_program.`id_rkpd_program` = rkpd_anggaran.`rkpd_program_id`
                         INNER JOIN `sikd_satker` sikd_satker ON rkpd_anggaran.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                         LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON rkpd_anggaran.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                         LEFT OUTER JOIN `sikd_kgtn` sikd_kgtn ON rkpd_anggaran.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                    WHERE
                         rkpd_rkpd.id_rkpd_rkpd = :id_rkpd
                    ORDER BY
                         sikd_urusan.`kd_urusan` ASC,
                         sikd_bidang.`kd_bidang` ASC,
                         sikd_satker.`kode` ASC,
                         sikd_satker.`id_sikd_satker` ASC,
                         sikd_sub_skpd.`kode` ASC,
                         rkpd_program.`kd_program` ASC,
                         rkpd_anggaran.`kd_kegiatan` ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rkpd", $idRkpd);
            //$statement->bindValue("tahun", $tahun);
            //$statement->bindValue("kdPrioritas", $kdPrioritas);
            
            $statement->execute();
            $renstraReport = $statement->fetchAll();

            return new JsonResponse($renstraReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }

    private function getRkpdLampPermen231dModSub1($request)
    {
        try {

            //print_r("ok");exit;

            $idProg = $request->query->get("id_prog");
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idProg = pack('H*', str_replace('-', '', trim($idProg)));
            $this->connection = $conn->getConnection();
            
            //print_r($jnsRkpd);exit;

            $sql = "SELECT
                         rkpd_program_indikator.`uraian_indikator` AS rkpd_program_indikator_uraian_indikator,
                         concat(rkpd_program_indikator.`target_thn_ini`, ' ', rkpd_program_indikator.`satuan`) AS rkpd_program_indikator_target_thn_ini
                    FROM
                         `rkpd_program_indikator` rkpd_program_indikator 
                    WHERE
                         rkpd_program_indikator.`rkpd_program_id` = :id_prog                    
                    ORDER BY
                         rkpd_program_indikator.`no_indikator`";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_prog", $idProg);
            //$statement->bindValue("tahun", $tahun);
            //$statement->bindValue("kdPrioritas", $kdPrioritas);
            
            $statement->execute();
            $renstraReport = $statement->fetchAll();

            return new JsonResponse($renstraReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }

    private function getRkpdLampPermen231dMod2($request)
    {
        try {

            $idRkpd = $request->query->get("id_rkpd");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRkpd = pack('H*', str_replace('-', '', trim($idRkpd)));
            $this->connection = $conn->getConnection();
            
            //print_r("ok");exit;

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
                            ) AS sikd_sub_skpd_id_sikd_sub_skpd_,
                     sikd_sub_skpd.`kode` AS sikd_sub_skpd_kode_,
                     '' AS sikd_sub_skpd_id_sikd_sub_skpd,
                     '' AS sikd_sub_skpd_kode,
                     sikd_sub_skpd.`nama` AS sikd_sub_skpd_nama,
                     CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 1, 8),
                         SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 9, 4),
                         SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 13, 4),
                         SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 17, 4),
                         SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 21)
                            ) AS rkpd_rkpd_id_rkpd_rkpd,
                     rkpd_rkpd.`tahun` AS rkpd_rkpd_tahun,
                     rkpd_rkpd.`jns_rkpd` AS rkpd_rkpd_jns_rkpd,
                     rkpd_rkpd.`status_rkpd` AS rkpd_rkpd_status_rkpd,
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
                         SUBSTR(HEX(rkpd_program.`id_rkpd_program`), 1, 8),
                         SUBSTR(HEX(rkpd_program.`id_rkpd_program`), 9, 4),
                         SUBSTR(HEX(rkpd_program.`id_rkpd_program`), 13, 4),
                         SUBSTR(HEX(rkpd_program.`id_rkpd_program`), 17, 4),
                         SUBSTR(HEX(rkpd_program.`id_rkpd_program`), 21)
                            ) AS rkpd_program_id_rkpd_program,
                     rkpd_program.`kd_program` AS rkpd_program_kd_program,
                     sikd_prog.`kd_prog` AS sikd_prog_kd_prog,
                     sikd_prog.`nm_prog` AS sikd_prog_nm_prog,
                     rkpd_program.`pagu_indikatif` AS rkpd_program_pagu_indikatif,
                     CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_anggaran.`id_rkpd_anggaran`), 1, 8),
                         SUBSTR(HEX(rkpd_anggaran.`id_rkpd_anggaran`), 9, 4),
                         SUBSTR(HEX(rkpd_anggaran.`id_rkpd_anggaran`), 13, 4),
                         SUBSTR(HEX(rkpd_anggaran.`id_rkpd_anggaran`), 17, 4),
                         SUBSTR(HEX(rkpd_anggaran.`id_rkpd_anggaran`), 21)
                            ) AS rkpd_kegiatan_id_rkpd_kegiatan,
                     rkpd_anggaran.`kd_kegiatan` AS rkpd_kegiatan_kd_kegiatan,
                     rkpd_anggaran.`nm_kegiatan` AS rkpd_kegiatan_nm_kegiatan,
                     rkpd_anggaran.`nm_subkegiatan` AS rkpd_kegiatan_nm_subkegiatan,
                     rkpd_anggaran.`prioritas` AS rkpd_kegiatan_prioritas,
                     rkpd_anggaran.`jml_anggaran_rkpd` AS rkpd_kegiatan_jml_anggaran_rkpd,
                     CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_anggaran.`renja_anggaran_id`), 1, 8),
                         SUBSTR(HEX(rkpd_anggaran.`renja_anggaran_id`), 9, 4),
                         SUBSTR(HEX(rkpd_anggaran.`renja_anggaran_id`), 13, 4),
                         SUBSTR(HEX(rkpd_anggaran.`renja_anggaran_id`), 17, 4),
                         SUBSTR(HEX(rkpd_anggaran.`renja_anggaran_id`), 21)
                            ) AS renja_kegiatan_id_renja_kegiatan,
                    CONCAT_WS('-',
                         SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 1, 8),
                         SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 9, 4),
                         SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 13, 4),
                         SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 17, 4),
                         SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 21)
                            ) AS sikd_kgtn_id_sikd_kgtn,
                     sikd_kgtn.`kd_kgtn` AS sikd_kgtn_kd_kgtn,
                     sikd_kgtn.`nm_kgtn` AS sikd_kgtn_nm_kgtn
                FROM
                     `rkpd_program` rkpd_program 
                     INNER JOIN `rkpd_rkpd` rkpd_rkpd ON rkpd_program.`rkpd_rkpd_id` = rkpd_rkpd.`id_rkpd_rkpd`
                     INNER JOIN `sikd_bidang` sikd_bidang ON rkpd_program.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                     INNER JOIN `sikd_urusan` sikd_urusan ON sikd_bidang.`sikd_urusan_id` = sikd_urusan.`id_sikd_urusan`
                     INNER JOIN `sikd_prog` sikd_prog ON rkpd_program.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                     INNER JOIN `rkpd_anggaran` rkpd_anggaran ON rkpd_program.`id_rkpd_program` = rkpd_anggaran.`rkpd_program_id`
                     INNER JOIN `sikd_satker` sikd_satker ON rkpd_anggaran.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                     LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON rkpd_anggaran.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                     LEFT OUTER JOIN `sikd_kgtn` sikd_kgtn ON rkpd_anggaran.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                WHERE
                     rkpd_rkpd.id_rkpd_rkpd = :id_rkpd
                ORDER BY
                     sikd_satker.kode ASC, 
                     sikd_sub_skpd_kode ASC,
                     sikd_urusan.`kd_urusan` ASC,
                     sikd_bidang.`kd_bidang` ASC,
                     rkpd_program.`kd_program` ASC,
                     rkpd_anggaran.`kd_kegiatan` ASC
                    ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rkpd", $idRkpd);
            // $statement->bindValue("tahun", $tahun);
            //$statement->bindValue("kdPrioritas", $kdPrioritas);
            
            $statement->execute();
            $renstraReport = $statement->fetchAll();

            return new JsonResponse($renstraReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }

    private function getRkpdLampPermen231dMod2Sub1($request)
    {
        try {

            //print_r("ok");exit;

            $idProg = $request->query->get("id_prog");
            //$tahun = $request->query->get("tahun");
            //$kdPrioritas = $request->query->get("prioritas");
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idProg = pack('H*', str_replace('-', '', trim($idProg)));
            $this->connection = $conn->getConnection();
            
            //print_r($jnsRkpd);exit;

            $sql = "SELECT
                        CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_program_indikator.`id_rkpd_program_indikator`), 1, 8),
                         SUBSTR(HEX(rkpd_program_indikator.`id_rkpd_program_indikator`), 9, 4),
                         SUBSTR(HEX(rkpd_program_indikator.`id_rkpd_program_indikator`), 13, 4),
                         SUBSTR(HEX(rkpd_program_indikator.`id_rkpd_program_indikator`), 17, 4),
                         SUBSTR(HEX(rkpd_program_indikator.`id_rkpd_program_indikator`), 21)
                            ) AS rkpd_program_indikator_id_rkpd_program_indikator,
                         CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_program_indikator.`rkpd_program_id`), 1, 8),
                         SUBSTR(HEX(rkpd_program_indikator.`rkpd_program_id`), 9, 4),
                         SUBSTR(HEX(rkpd_program_indikator.`rkpd_program_id`), 13, 4),
                         SUBSTR(HEX(rkpd_program_indikator.`rkpd_program_id`), 17, 4),
                         SUBSTR(HEX(rkpd_program_indikator.`rkpd_program_id`), 21)
                            ) AS rkpd_program_indikator_rkpd_program_id,
                         rkpd_program_indikator.`no_indikator` AS rkpd_program_indikator_no_indikator,
                         rkpd_program_indikator.`uraian_indikator` AS rkpd_program_indikator_uraian_indikator,
                         rkpd_program_indikator.`satuan` AS rkpd_program_indikator_satuan,
                         concat(rkpd_program_indikator.`target_thn_ini`,' ',rkpd_program_indikator.`satuan`) AS rkpd_program_indikator_target_thn_ini
                    FROM
                         `rkpd_program_indikator` rkpd_program_indikator
                    WHERE
                         rkpd_program_indikator.`rkpd_program_id` = :id_prog
                    ORDER BY
                         rkpd_program_indikator.`no_indikator`
                    ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_prog", $idProg);
            //$statement->bindValue("tahun", $tahun);
            //$statement->bindValue("kdPrioritas", $kdPrioritas);
            
            $statement->execute();
            $renstraReport = $statement->fetchAll();

            return new JsonResponse($renstraReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }

    private function getRkpdLampPermen231e($request)
    {
        try {

            //print_r("ok");exit;

            $idRkpd = $request->query->get("id_rkpd");
            //$tahun = $request->query->get("tahun");
            //$kdPrioritas = $request->query->get("prioritas");
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRkpd = pack('H*', str_replace('-', '', trim($idRkpd)));
            $this->connection = $conn->getConnection();
            
            //print_r($jnsRkpd);exit;

            $sql = "SELECT
                    CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 1, 8),
                         SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 9, 4),
                         SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 13, 4),
                         SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 17, 4),
                         SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 21)
                            ) AS rkpd_rkpd_id_rkpd_rkpd,
                     rkpd_rkpd.`tahun` AS rkpd_rkpd_tahun,
                     rkpd_rkpd.`jns_rkpd` AS rkpd_rkpd_jns_rkpd,
                     rkpd_rkpd.`status_rkpd` AS rkpd_rkpd_status_rkpd,
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
                         SUBSTR(HEX(rkpd_program.`id_rkpd_program`), 1, 8),
                         SUBSTR(HEX(rkpd_program.`id_rkpd_program`), 9, 4),
                         SUBSTR(HEX(rkpd_program.`id_rkpd_program`), 13, 4),
                         SUBSTR(HEX(rkpd_program.`id_rkpd_program`), 17, 4),
                         SUBSTR(HEX(rkpd_program.`id_rkpd_program`), 21)
                            ) AS rkpd_program_id_rkpd_program,
                     rkpd_program.`kd_program` AS rkpd_program_kd_program,
                     sikd_prog.`kd_prog` AS sikd_prog_kd_prog,
                     sikd_prog.`nm_prog` AS sikd_prog_nm_prog,
                     rkpd_program.`pagu_indikatif` AS rkpd_program_pagu_indikatif,
                     CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_anggaran.`id_rkpd_anggaran`), 1, 8),
                         SUBSTR(HEX(rkpd_anggaran.`id_rkpd_anggaran`), 9, 4),
                         SUBSTR(HEX(rkpd_anggaran.`id_rkpd_anggaran`), 13, 4),
                         SUBSTR(HEX(rkpd_anggaran.`id_rkpd_anggaran`), 17, 4),
                         SUBSTR(HEX(rkpd_anggaran.`id_rkpd_anggaran`), 21)
                            ) AS rkpd_kegiatan_id_rkpd_kegiatan,
                     rkpd_anggaran.`kd_kegiatan` AS rkpd_kegiatan_kd_kegiatan,
                     rkpd_anggaran.`nm_kegiatan` AS rkpd_kegiatan_nm_kegiatan,
                     rkpd_anggaran.`nm_subkegiatan` AS rkpd_kegiatan_nm_subkegiatan,
                     rkpd_anggaran.`jml_anggaran_rkpd` AS rkpd_kegiatan_jml_anggaran_rkpd,
                     CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_anggaran.`renja_anggaran_id`), 1, 8),
                         SUBSTR(HEX(rkpd_anggaran.`renja_anggaran_id`), 9, 4),
                         SUBSTR(HEX(rkpd_anggaran.`renja_anggaran_id`), 13, 4),
                         SUBSTR(HEX(rkpd_anggaran.`renja_anggaran_id`), 17, 4),
                         SUBSTR(HEX(rkpd_anggaran.`renja_anggaran_id`), 21)
                            ) AS renja_kegiatan_id_renja_kegiatan,
                    CONCAT_WS('-',
                         SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 1, 8),
                         SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 9, 4),
                         SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 13, 4),
                         SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 17, 4),
                         SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 21)
                            ) AS sikd_kgtn_id_sikd_kgtn,
                     sikd_kgtn.`kd_kgtn` AS sikd_kgtn_kd_kgtn,
                     sikd_kgtn.`nm_kgtn` AS sikd_kgtn_nm_kgtn
                FROM
                     `rkpd_program` rkpd_program 
                     INNER JOIN `rkpd_rkpd` rkpd_rkpd ON rkpd_program.`rkpd_rkpd_id` = rkpd_rkpd.`id_rkpd_rkpd`
                     INNER JOIN `sikd_bidang` sikd_bidang ON rkpd_program.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                     INNER JOIN `sikd_urusan` sikd_urusan ON sikd_bidang.`sikd_urusan_id` = sikd_urusan.`id_sikd_urusan`
                     INNER JOIN `sikd_prog` sikd_prog ON rkpd_program.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                     LEFT OUTER JOIN `rkpd_anggaran` rkpd_anggaran ON rkpd_program.`id_rkpd_program` = rkpd_anggaran.`rkpd_program_id`
                     LEFT OUTER JOIN `sikd_kgtn` sikd_kgtn ON rkpd_anggaran.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                WHERE
                     rkpd_rkpd.id_rkpd_rkpd = :id_rkpd
                ORDER BY
                     sikd_urusan.`kd_urusan` ASC,
                     sikd_bidang.`kd_bidang` ASC,
                     rkpd_program.`kd_program` ASC,
                     rkpd_anggaran.`kd_kegiatan` ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rkpd", $idRkpd);
            //$statement->bindValue("tahun", $tahun);
            //$statement->bindValue("kdPrioritas", $kdPrioritas);
            
            $statement->execute();
            $renstraReport = $statement->fetchAll();

            return new JsonResponse($renstraReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }   

    private function getRkpdLampPermen231eSub1($request)
    {
        try {

            //print_r("ok");exit;

            $idProg = $request->query->get("id_prog");
            //$tahun = $request->query->get("tahun");
            //$kdPrioritas = $request->query->get("prioritas");
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idProg = pack('H*', str_replace('-', '', trim($idProg)));
            $this->connection = $conn->getConnection();
            
            //print_r($jnsRkpd);exit;

            $sql = "SELECT
                        CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_program_indikator.`id_rkpd_program_indikator`), 1, 8),
                         SUBSTR(HEX(rkpd_program_indikator.`id_rkpd_program_indikator`), 9, 4),
                         SUBSTR(HEX(rkpd_program_indikator.`id_rkpd_program_indikator`), 13, 4),
                         SUBSTR(HEX(rkpd_program_indikator.`id_rkpd_program_indikator`), 17, 4),
                         SUBSTR(HEX(rkpd_program_indikator.`id_rkpd_program_indikator`), 21)
                            ) AS rkpd_program_indikator_id_rkpd_program_indikator,
                        CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_program_indikator.`rkpd_program_id`), 1, 8),
                         SUBSTR(HEX(rkpd_program_indikator.`rkpd_program_id`), 9, 4),
                         SUBSTR(HEX(rkpd_program_indikator.`rkpd_program_id`), 13, 4),
                         SUBSTR(HEX(rkpd_program_indikator.`rkpd_program_id`), 17, 4),
                         SUBSTR(HEX(rkpd_program_indikator.`rkpd_program_id`), 21)
                            ) AS rkpd_program_indikator_rkpd_program_id,
                         rkpd_program_indikator.`no_indikator` AS rkpd_program_indikator_no_indikator,
                         rkpd_program_indikator.`uraian_indikator` AS rkpd_program_indikator_uraian_indikator,
                         rkpd_program_indikator.`satuan` AS rkpd_program_indikator_satuan,
                         rkpd_program_indikator.`target_rpjmd` AS rkpd_program_indikator_target_rpjmd,
                         rkpd_program_indikator.`realisasi_sd_thn_lalu` AS rkpd_program_indikator_realisasi_sd_thn_lalu,
                         rkpd_program_indikator.`target_thn_ini` AS rkpd_program_indikator_target_thn_ini,
                         rkpd_program_indikator.`realisasi_tw2` AS rkpd_program_indikator_realisasi_tw2
                    FROM
                         `rkpd_program_indikator` rkpd_program_indikator
                    WHERE
                         rkpd_program_indikator.`rkpd_program_id` = :id_prog
                    ORDER BY
                         rkpd_program_indikator.`no_indikator` ASC
                    ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_prog", $idProg);
            //$statement->bindValue("tahun", $tahun);
            //$statement->bindValue("kdPrioritas", $kdPrioritas);
            
            $statement->execute();
            $renstraReport = $statement->fetchAll();

            return new JsonResponse($renstraReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }      
        
    private function getRkpdLampPermen232b($request)
    {
        try {

            //print_r("ok");exit;

            $idRkpd = $request->query->get("id_rkpd");
            //$tahun = $request->query->get("tahun");
            //$kdPrioritas = $request->query->get("prioritas");
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRkpd = pack('H*', str_replace('-', '', trim($idRkpd)));
            $this->connection = $conn->getConnection();
            
            //print_r($jnsRkpd);exit;

            $sql = "SELECT
                    CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 1, 8),
                         SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 9, 4),
                         SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 13, 4),
                         SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 17, 4),
                         SUBSTR(HEX(rkpd_rkpd.`id_rkpd_rkpd`), 21)
                            ) AS rkpd_rkpd_id_rkpd_rkpd,
                     rkpd_rkpd.`tahun` AS rkpd_rkpd_tahun,
                     rkpd_rkpd.`jns_rkpd` AS rkpd_rkpd_jns_rkpd,
                     rkpd_rkpd.`status_rkpd` AS rkpd_rkpd_status_rkpd,
                     CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_prioritas_kab.`id_rkpd_prioritas_kab`), 1, 8),
                         SUBSTR(HEX(rkpd_prioritas_kab.`id_rkpd_prioritas_kab`), 9, 4),
                         SUBSTR(HEX(rkpd_prioritas_kab.`id_rkpd_prioritas_kab`), 13, 4),
                         SUBSTR(HEX(rkpd_prioritas_kab.`id_rkpd_prioritas_kab`), 17, 4),
                         SUBSTR(HEX(rkpd_prioritas_kab.`id_rkpd_prioritas_kab`), 21)
                            ) AS rkpd_prioritas_kab_id_rkpd_prioritas_kab,
                     rkpd_prioritas_kab.`no_prioritas` AS rkpd_prioritas_kab_no_prioritas,
                     rkpd_prioritas_kab.`bidang_prioritas` AS rkpd_prioritas_kab_tag_prioritas,
                     rkpd_prioritas_kab.`nm_program` AS rkpd_prioritas_kab_nm_program,
                     CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_sasaran.`id_rkpd_sasaran`), 1, 8),
                         SUBSTR(HEX(rkpd_sasaran.`id_rkpd_sasaran`), 9, 4),
                         SUBSTR(HEX(rkpd_sasaran.`id_rkpd_sasaran`), 13, 4),
                         SUBSTR(HEX(rkpd_sasaran.`id_rkpd_sasaran`), 17, 4),
                         SUBSTR(HEX(rkpd_sasaran.`id_rkpd_sasaran`), 21)
                            ) AS rkpd_sasaran_id_rkpd_sasaran,
                     rkpd_sasaran.`no_sasaran` AS rkpd_sasaran_no_sasaran,
                     rkpd_sasaran.`uraian_sasaran` AS rkpd_sasaran_uraian_sasaran,
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
                         SUBSTR(HEX(rkpd_program.`id_rkpd_program`), 1, 8),
                         SUBSTR(HEX(rkpd_program.`id_rkpd_program`), 9, 4),
                         SUBSTR(HEX(rkpd_program.`id_rkpd_program`), 13, 4),
                         SUBSTR(HEX(rkpd_program.`id_rkpd_program`), 17, 4),
                         SUBSTR(HEX(rkpd_program.`id_rkpd_program`), 21)
                            ) AS rkpd_program_id_rkpd_program,
                     rkpd_program.`kd_program` AS rkpd_program_kd_program,
                     sikd_prog.`kd_prog` AS sikd_prog_kd_prog,
                     sikd_prog.`nm_prog` AS sikd_prog_nm_prog,
                     rkpd_program.`pagu_indikatif` AS rkpd_program_pagu_indikatif,
                     CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_anggaran.`id_rkpd_anggaran`), 1, 8),
                         SUBSTR(HEX(rkpd_anggaran.`id_rkpd_anggaran`), 9, 4),
                         SUBSTR(HEX(rkpd_anggaran.`id_rkpd_anggaran`), 13, 4),
                         SUBSTR(HEX(rkpd_anggaran.`id_rkpd_anggaran`), 17, 4),
                         SUBSTR(HEX(rkpd_anggaran.`id_rkpd_anggaran`), 21)
                            ) AS rkpd_kegiatan_id_rkpd_kegiatan,
                     rkpd_anggaran.`kd_kegiatan` AS rkpd_kegiatan_kd_kegiatan,
                     rkpd_anggaran.`nm_kegiatan` AS rkpd_kegiatan_nm_kegiatan,
                     rkpd_anggaran.`nm_subkegiatan` AS rkpd_kegiatan_nm_subkegiatan,
                     rkpd_anggaran.`jml_anggaran_rkpd` AS rkpd_kegiatan_jml_anggaran_rkpd,
                     CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_anggaran.`renja_anggaran_id`), 1, 8),
                         SUBSTR(HEX(rkpd_anggaran.`renja_anggaran_id`), 9, 4),
                         SUBSTR(HEX(rkpd_anggaran.`renja_anggaran_id`), 13, 4),
                         SUBSTR(HEX(rkpd_anggaran.`renja_anggaran_id`), 17, 4),
                         SUBSTR(HEX(rkpd_anggaran.`renja_anggaran_id`), 21)
                            ) AS renja_kegiatan_id_renja_kegiatan,
                    CONCAT_WS('-',
                         SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 1, 8),
                         SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 9, 4),
                         SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 13, 4),
                         SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 17, 4),
                         SUBSTR(HEX(sikd_kgtn.`id_sikd_kgtn`), 21)
                            ) AS sikd_kgtn_id_sikd_kgtn,
                     sikd_kgtn.`kd_kgtn` AS sikd_kgtn_kd_kgtn,
                     sikd_kgtn.`nm_kgtn` AS sikd_kgtn_nm_kgtn,
                     rkpd_program.`tgt_anggaran_rpjmd` AS rkpd_program_tgt_anggaran_rpjmd,
                     rkpd_program.`rls_anggaran_sd_thn_lalu` AS rkpd_program_rls_anggaran_sd_thn_lalu
                FROM
                     `rkpd_program` rkpd_program 
                     INNER JOIN `rkpd_rkpd` rkpd_rkpd ON rkpd_program.`rkpd_rkpd_id` = rkpd_rkpd.`id_rkpd_rkpd`
                     INNER JOIN `sikd_bidang` sikd_bidang ON rkpd_program.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                     INNER JOIN `sikd_prog` sikd_prog ON rkpd_program.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                     INNER JOIN `rkpd_sasaran_rkpd_program` rkpd_sasaran_rkpd_program ON rkpd_program.`id_rkpd_program` = rkpd_sasaran_rkpd_program.`rkpd_program_id`
                     INNER JOIN `rkpd_sasaran` rkpd_sasaran ON rkpd_sasaran_rkpd_program.`rkpd_sasaran_id` = rkpd_sasaran.`id_rkpd_sasaran`
                     LEFT OUTER JOIN `rkpd_anggaran` rkpd_anggaran ON rkpd_program.`id_rkpd_program` = rkpd_anggaran.`rkpd_program_id`
                     LEFT OUTER JOIN `sikd_kgtn` sikd_kgtn ON rkpd_anggaran.`sikd_kgtn_id` = sikd_kgtn.`id_sikd_kgtn`
                     INNER JOIN `rkpd_prioritas_kab` rkpd_prioritas_kab ON rkpd_sasaran.`rkpd_prioritas_kab_id` = rkpd_prioritas_kab.`id_rkpd_prioritas_kab`
                     INNER JOIN `sikd_urusan` sikd_urusan ON sikd_bidang.`sikd_urusan_id` = sikd_urusan.`id_sikd_urusan`
                WHERE
                     rkpd_rkpd.id_rkpd_rkpd = :id_rkpd
                ORDER BY
                     rkpd_prioritas_kab.`no_prioritas` ASC,
                     rkpd_sasaran.`no_sasaran` ASC,
                     sikd_urusan.`kd_urusan` ASC,
                     sikd_bidang.`kd_bidang` ASC,
                     rkpd_program.`kd_program` ASC,
                     rkpd_anggaran.`kd_kegiatan` ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rkpd", $idRkpd);
            //$statement->bindValue("tahun", $tahun);
            //$statement->bindValue("kdPrioritas", $kdPrioritas);
            
            $statement->execute();
            $renstraReport = $statement->fetchAll();

            return new JsonResponse($renstraReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }

    private function getRkpdLampPermen232bSub1($request)
    {
        try {

            //print_r("ok");exit;

            $idProg = $request->query->get("id_prog");
            //$tahun = $request->query->get("tahun");
            //$kdPrioritas = $request->query->get("prioritas");
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idProg = pack('H*', str_replace('-', '', trim($idProg)));
            $this->connection = $conn->getConnection();
            
            //print_r($jnsRkpd);exit;

            $sql = "SELECT
                        CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_program_indikator.`id_rkpd_program_indikator`), 1, 8),
                         SUBSTR(HEX(rkpd_program_indikator.`id_rkpd_program_indikator`), 9, 4),
                         SUBSTR(HEX(rkpd_program_indikator.`id_rkpd_program_indikator`), 13, 4),
                         SUBSTR(HEX(rkpd_program_indikator.`id_rkpd_program_indikator`), 17, 4),
                         SUBSTR(HEX(rkpd_program_indikator.`id_rkpd_program_indikator`), 21)
                            ) AS rkpd_program_indikator_id_rkpd_program_indikator,
                        CONCAT_WS('-',
                         SUBSTR(HEX(rkpd_program_indikator.`rkpd_program_id`), 1, 8),
                         SUBSTR(HEX(rkpd_program_indikator.`rkpd_program_id`), 9, 4),
                         SUBSTR(HEX(rkpd_program_indikator.`rkpd_program_id`), 13, 4),
                         SUBSTR(HEX(rkpd_program_indikator.`rkpd_program_id`), 17, 4),
                         SUBSTR(HEX(rkpd_program_indikator.`rkpd_program_id`), 21)
                            ) AS rkpd_program_indikator_rkpd_program_id,
                         rkpd_program_indikator.`no_indikator` AS rkpd_program_indikator_no_indikator,
                         rkpd_program_indikator.`uraian_indikator` AS rkpd_program_indikator_uraian_indikator,
                         rkpd_program_indikator.`satuan` AS rkpd_program_indikator_satuan,
                         rkpd_program_indikator.`target_thn_ini` AS rkpd_program_indikator_target_thn_ini,
                         rkpd_program_indikator.`target_rpjmd` AS rkpd_program_indikator_target_rpjmd,
                         rkpd_program_indikator.`target_thn_dpn` AS rkpd_program_indikator_target_thn_dpn,
                         rkpd_program_indikator.`realisasi_sd_thn_lalu` AS rkpd_program_indikator_realisasi_sd_thn_lalu,
                         rkpd_program_indikator.`realisasi_tw1` AS rkpd_program_indikator_realisasi_tw1,
                         rkpd_program_indikator.`realisasi_tw2` AS rkpd_program_indikator_realisasi_tw2,
                         rkpd_program_indikator.`realisasi_tw3` AS rkpd_program_indikator_realisasi_tw3,
                         rkpd_program_indikator.`realisasi_tw4` AS rkpd_program_indikator_realisasi_tw4,
                         (rkpd_program_indikator.`realisasi_tw1` + rkpd_program_indikator.`realisasi_tw2` +
                         rkpd_program_indikator.`realisasi_tw3` + rkpd_program_indikator.`realisasi_tw4`) AS ttl_realisasi
                    FROM
                         `rkpd_program_indikator` rkpd_program_indikator
                    WHERE
                         rkpd_program_indikator.`rkpd_program_id` = :id_prog
                    ORDER BY
                         rkpd_program_indikator.`no_indikator` ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_prog", $idProg);
            //$statement->bindValue("tahun", $tahun);
            //$statement->bindValue("kdPrioritas", $kdPrioritas);
            
            $statement->execute();
            $renstraReport = $statement->fetchAll();

            return new JsonResponse($renstraReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    } 

    private function getSubQRkpdRekapListKgtnSkpd($request)
    {
        try {
            $idRkpd = $request->query->get("id_rkpd");
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRkpd = pack('H*', str_replace('-', '', trim($idRkpd)));
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                     a.kd_kegiatan ,
                     a.prioritas ,
                     CONCAT_WS('-',
                         SUBSTR(HEX(a.`sikd_satker_id`), 1, 8),
                         SUBSTR(HEX(a.`sikd_satker_id`), 9, 4),
                         SUBSTR(HEX(a.`sikd_satker_id`), 13, 4),
                         SUBSTR(HEX(a.`sikd_satker_id`), 17, 4),
                         SUBSTR(HEX(a.`sikd_satker_id`), 21)
                            ) AS sikd_satker_id ,
                     CONCAT_WS('-',
                         SUBSTR(HEX(a.`sikd_sub_skpd_id`), 1, 8),
                         SUBSTR(HEX(a.`sikd_sub_skpd_id`), 9, 4),
                         SUBSTR(HEX(a.`sikd_sub_skpd_id`), 13, 4),
                         SUBSTR(HEX(a.`sikd_sub_skpd_id`), 17, 4),
                         SUBSTR(HEX(a.`sikd_sub_skpd_id`), 21)
                            ) AS sikd_sub_skpd_id ,
                     a.target_kgtn ,
                     GROUP_CONCAT(DISTINCT a.target_kgtn ORDER BY a.no_subkegiatan DESC SEPARATOR ';\n') AS group_details
                                 From rkpd_anggaran a
                                 Where a.rkpd_rkpd_id = :idRkpd
                                 and a.target_kgtn != ''
                    ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("idRkpd", $idRkpd);
            
            $statement->execute();
            $rkpdReport = $statement->fetchAll();
            
            return new JsonResponse($rkpdReport);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
}