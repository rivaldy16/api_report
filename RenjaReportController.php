<?php
namespace App\Controller\Renja;

use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Delete;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * @RouteResource("renjareport")
 */
class RenjaReportController extends \App\Controller\ApiBaseController
{
    //protected $dbalConnName = 'simral_renja';
    
    public function cgetAction(Request $request)
    {        
        
        $rpt = $request->query->get("jns_report");
        
        switch ($rpt) {
            case "rekap_proyeksi":
                return $this->getRenjaRekapProyeksi($request);
            case "rekap_prog" :
                return $this->getRenjaRekapProgram($request);
            case "rekap_prog_kgtn" :
                return $this->getRenjaRekapProgKgth($request);
            case "rekap_urusan_satker" :
                return $this->getRenjaRekapUrusanSatker($request);
            case "rekap_prog_rkpd" :
                return $this->getRenjaRekapProgRkpd($request);
            case "renja_bl_kgtn" :
                return $this->getRenjaBelanjaLangsung($request);
            case "renja_non_bl" :
                return $this->getRenjaBelanjaTakLangsung($request);
            case "renja_anggaran_sub" :
                return $this->getRenjaAnggaranSub($request);
            case "renja_bl_idktr" :
                return $this->getRenjaBelanjaLngsngIndikator($request);
            case "renja_sub_rpt" :
                return $this->getSubRenjaRpt($request);
            case "renja_lamp_permen54_6c0" :
                return $this->getRenjaLampPermen546c0($request);
            case "renja_lamp_permen54_6c0_sub2" :
                return $this->getRenjaLampPermen546c0Sub2($request);
            case "renja_lamp_permen54_6c0_sub1" :
                return $this->getRenjaLampPermen546c0Sub1($request);
            case "renja_lamp_permen54_7h4" :
                return $this->getRenjaLampPermen547h4($request);
            case "renja_lamp_permen54_6c6" :
                return $this->getRenjaPermen546c6($request);
            case "renja_lamp_permen54_7i5" :
                return $this->getRenjaLampPermen547i5($request);
            case "renja_kgtn_skpd" :
                return $this->getRenjaKgtnSkpd($request);
            //RKPD
            case "rkpd_lamp_permen23_1c" :
                return $this->getRkpdLampPermen231c($request);
            case "rkpd_lamp_permen23_1c_sub1" :
                return $this->getRkpdLampPermen231cSub1($request);
             case "rkpd_lamp_permen23_1d_sub2" :
                return $this->getRkpdLampPermen231dSub2($request);
            case "rkpd_lamp_permen23_1d_mod_sub2" :
                return $this->getRkpdLampPermen231dModSub2($request);
            case "rkpd_lamp_permen23_1d_mod2_sub2" :
                return $this->getRkpdLampPermen231dMod2Sub2($request);
            case "rkpd_lamp_permen23_1e_sub2" :
                return $this->getRkpdLampPermen231eSub2($request);
            case "rkpd_lamp_permen23_2b_sub2" :
                return $this->getRkpdLampPermen232bSub2($request);
            default:
                throw new BadRequestHttpException("Undefined report");
        }
    }
    
   private function getRenjaRekapProyeksi($request)
    {
        try {
            $jns_renja = $request->query->get("jns_renja");
            $id_renja = $request->query->get("id_renja");
            $sikd_satker_id = $request->query->get("sikd_satker_id");
            $tahun = $request->query->get("tahun");
            $sikd_sub_skpd_id = $request->query->get("sikd_sub_skpd_id");

            //$id_renja = pack('H*', str_replace('-', '', trim($id_renja)));
            $id_renja = $this->convertOuuidToUuid($id_renja);
            $sikd_satker_id = pack('H*', str_replace('-', '', trim($sikd_satker_id)));
            if ($sikd_sub_skpd_id != '%'){
                $sikd_sub_skpd_id = pack('H*', str_replace('-', '', trim($sikd_sub_skpd_id)));    
            }

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $this->connection = $conn->getConnection();

            /*$sql = "SELECT
                         renja_renja.`jns_renja` AS jns_renja,
                         CONCAT_WS('-',
                        SUBSTR(HEX(renja_renja.`id_renja_renja`), 1, 8),
                        SUBSTR(HEX(renja_renja.`id_renja_renja`), 9, 4),
                        SUBSTR(HEX(renja_renja.`id_renja_renja`), 13, 4),
                        SUBSTR(HEX(renja_renja.`id_renja_renja`), 17, 4),
                        SUBSTR(HEX(renja_renja.`id_renja_renja`), 21)
                            ) AS id_renja_renja,
                         CONCAT_WS('-',
                        SUBSTR(HEX(renja_renja.sikd_satker_id), 1, 8),
                        SUBSTR(HEX(renja_renja.sikd_satker_id), 9, 4),
                        SUBSTR(HEX(renja_renja.sikd_satker_id), 13, 4),
                        SUBSTR(HEX(renja_renja.sikd_satker_id), 17, 4),
                        SUBSTR(HEX(renja_renja.sikd_satker_id), 21)
                            ) AS sikd_satker_id,
                         renja_mata_anggaran.kd_rekening,
                         IF(renja_anggaran.renja_anggaran_type != 'RenjaBlnjLangsung', SUM(IFNULL(renja_mata_anggaran.`jumlah`, 0)), 
                        IFNULL(renja_blnj_langsung.jumlah, 0)) AS jumlah,
                         IF(SUBSTRING(renja_mata_anggaran.kd_rekening,1,1) = '4', SUM(IFNULL(renja_mata_anggaran.`jumlah`, 0)),
                         IF(SUBSTRING(renja_mata_anggaran.kd_rekening,1,1)='5',
                            IF(renja_anggaran.renja_anggaran_type != 'RenjaBlnjLangsung',  
                            SUM(IFNULL(-(renja_mata_anggaran.`jumlah`), 0)), IFNULL(-(renja_blnj_langsung.jumlah), 0)), 0)) AS jml_surplus,
                         SUM(if(SUBSTRING(renja_mata_anggaran.kd_rekening,1,2)='61', IFNULL(renja_mata_anggaran.`jumlah`, 0),
                         if(SUBSTRING(renja_mata_anggaran.kd_rekening,1,2)='62', IFNULL(-(renja_mata_anggaran.`jumlah`), 0), 0))) AS jml_pembiayaan,
                      CONCAT_WS('-',
                        SUBSTR(HEX(renja_anggaran.`sikd_kgtn_id`), 1, 8),
                        SUBSTR(HEX(renja_anggaran.`sikd_kgtn_id`), 9, 4),
                        SUBSTR(HEX(renja_anggaran.`sikd_kgtn_id`), 13, 4),
                        SUBSTR(HEX(renja_anggaran.`sikd_kgtn_id`), 17, 4),
                        SUBSTR(HEX(renja_anggaran.`sikd_kgtn_id`), 21)
                        ) AS renja_sikd_kgtn_id,
                   CONCAT_WS('-',
                                        SUBSTR(HEX(renja_mata_anggaran.`sikd_rek_rincian_obj_id`), 1, 8),
                                        SUBSTR(HEX(renja_mata_anggaran.`sikd_rek_rincian_obj_id`), 9, 4),
                                        SUBSTR(HEX(renja_mata_anggaran.`sikd_rek_rincian_obj_id`), 13, 4),
                                        SUBSTR(HEX(renja_mata_anggaran.`sikd_rek_rincian_obj_id`), 17, 4),
                                        SUBSTR(HEX(renja_mata_anggaran.`sikd_rek_rincian_obj_id`), 21)
                                        ) AS renja_mata_anggaran_sikd_rek_rincian_obj_id
                    
                    FROM
                         `renja_mata_anggaran` renja_mata_anggaran
                         INNER JOIN `renja_anggaran` renja_anggaran ON renja_mata_anggaran.`renja_anggaran_id` = renja_anggaran.`id_renja_anggaran`
                         INNER JOIN `renja_renja` renja_renja ON renja_anggaran.`renja_renja_id` = renja_renja.id_renja_renja
                         LEFT OUTER JOIN (Select d.sikd_satker_id, a1.sikd_rek_rincian_obj_id, sum(a1.jumlah) as jumlah
                                  From renja_anggaran a
                                   inner join renja_kegiatan c on a.sikd_kgtn_id = c.sikd_kgtn_id
                                   inner join renja_renja d on c.renja_renja_id = d.id_renja_renja
                                   inner join renja_mata_anggaran a1 on a.id_renja_anggaran = a1.renja_anggaran_id
                                  Where d.jns_renja = :jnsRenja and d.sikd_satker_id= :idSatker and d.id_renja_renja= :idRenja 
                                  Group by d.sikd_satker_id, a1.sikd_rek_rincian_obj_id) AS  renja_blnj_langsung
                            ON renja_mata_anggaran.sikd_rek_rincian_obj_id = renja_blnj_langsung.sikd_rek_rincian_obj_id
                    WHERE
                        IF(:idSubUnit = '', renja_renja.sikd_satker_id = :idSatker , 
                        renja_renja.id_renja_renja = :idRenja) and renja_renja.jns_renja = :jnsRenja
                    GROUP BY
                         renja_mata_anggaran.kd_rekening,
                         renja_renja.sikd_satker_id
                    ";*/
            $sql = "SELECT
                     renja_renja.`jns_renja` AS jns_renja,
                     CONCAT_WS('-',
                        SUBSTR(HEX(renja_renja.`id_renja_renja`), 1, 8),
                        SUBSTR(HEX(renja_renja.`id_renja_renja`), 9, 4),
                        SUBSTR(HEX(renja_renja.`id_renja_renja`), 13, 4),
                        SUBSTR(HEX(renja_renja.`id_renja_renja`), 17, 4),
                        SUBSTR(HEX(renja_renja.`id_renja_renja`), 21)
                        ) AS id_renja_renja,
                     sikd_satker.nama AS sikd_satker_nama,
                     IF(:sikd_sub_skpd_id = '%', 'Semua Sub Unit', sikd_sub_skpd.nama) AS sikd_sub_skpd_nama,
                     sikd_satker.sikd_satker_type AS satker_type,
                     sikd_rek_akun.kd_rek_akun AS renja_pendapatan_akun,
                     IF(sikd_rek_akun.kd_rek_akun = '4', 'Pendapatan Daerah', 
                     IF(sikd_rek_akun.kd_rek_akun = '5', 'Belanja Daerah', 'Penerimaan Pembiayaan')) AS renja_pendapatan_nm_akun,
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
                     CONCAT_WS('-',
                        SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 1, 8),
                        SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 9, 4),
                        SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 13, 4),
                        SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 17, 4),
                        SUBSTR(HEX(sikd_rek_obj.`id_sikd_rek_obj`), 21)
                        ) AS sikd_rek_obj_id_sikd_rek_obj,
                     concat(substring(sikd_rek_obj.`kd_rek_obj`,1,1),'.',
                      substring(sikd_rek_obj.`kd_rek_obj`,2,1),'.',
                      substring(sikd_rek_obj.`kd_rek_obj`,3,1),'.',
                      substring(sikd_rek_obj.`kd_rek_obj`,4,2)) AS sikd_rek_obj_kd_rek_obj,
                     sikd_rek_obj.`nm_rek_obj` AS sikd_rek_obj_nm_rek_obj,
                     CONCAT_WS('-',
                        SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 1, 8),
                        SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 9, 4),
                        SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 13, 4),
                        SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 17, 4),
                        SUBSTR(HEX(sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`), 21)
                        ) AS sikd_rek_rincian_obj_id_sikd_rek_rincian_obj,
                     concat(substring(sikd_rek_rincian_obj.`kd_rek_rincian_obj`,1,1),'.',
                      substring(sikd_rek_rincian_obj.`kd_rek_rincian_obj`,2,1),'.',
                      substring(sikd_rek_rincian_obj.`kd_rek_rincian_obj`,3,1),'.',
                      substring(sikd_rek_rincian_obj.`kd_rek_rincian_obj`,4,2),'.',
                      substring(sikd_rek_rincian_obj.`kd_rek_rincian_obj`,6,2)) AS sikd_rek_rincian_obj_kd_rek_rincian_obj,
                     sikd_rek_rincian_obj.`nm_rek_rincian_obj` AS sikd_rek_rincian_obj_nm_rek_rincian_obj,
                     IF(renja_anggaran.renja_anggaran_type != 'RenjaBlnjLangsung', SUM(IFNULL(renja_mata_anggaran.`jumlah`, 0)), 
                     IFNULL(renja_mata_anggaran.jumlah, 0)) AS jumlah,
                     IF(sikd_rek_akun.`kd_rek_akun`='4', SUM(IFNULL(renja_mata_anggaran.`jumlah`, 0)),
                     IF(sikd_rek_akun.`kd_rek_akun`='5',
                      IF(renja_anggaran.renja_anggaran_type != 'RenjaBlnjLangsung',  
                     SUM(IFNULL(-(renja_rincian_mata_anggaran.`jumlah`), 0)), IFNULL(-(renja_mata_anggaran.jumlah), 0)), 0)) AS jml_surplus,
                     SUM(if(sikd_rek_kelompok.`kd_rek_kelompok`='61', IFNULL(renja_mata_anggaran.`jumlah`, 0),
                   if(sikd_rek_kelompok.`kd_rek_kelompok`='62', IFNULL(-(renja_mata_anggaran.`jumlah`), 0), 0))) AS jml_pembiayaan
                FROM
                     `renja_mata_anggaran` renja_mata_anggaran
                     INNER JOIN `renja_anggaran` renja_anggaran ON renja_mata_anggaran.`renja_anggaran_id` = renja_anggaran.`id_renja_anggaran`
                     INNER JOIN `renja_rincian_mata_anggaran` renja_rincian_mata_anggaran ON renja_rincian_mata_anggaran.renja_mata_anggaran_id = renja_mata_anggaran.id_renja_mata_anggaran
                     INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON renja_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                     INNER JOIN `renja_renja` renja_renja ON renja_anggaran.`renja_renja_id` = renja_renja.id_renja_renja
                     INNER JOIN `sikd_satker` sikd_satker ON renja_renja.sikd_satker_id = sikd_satker.id_sikd_satker
                     LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON renja_renja.sikd_sub_skpd_id = sikd_sub_skpd.id_sikd_sub_skpd
                     INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                     INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                     INNER JOIN `sikd_rek_kelompok` sikd_rek_kelompok ON sikd_rek_jenis.`sikd_rek_kelompok_id` = sikd_rek_kelompok.`id_sikd_rek_kelompok`
                     INNER JOIN `sikd_rek_akun` sikd_rek_akun ON sikd_rek_kelompok.`sikd_rek_akun_id` = sikd_rek_akun.`id_sikd_rek_akun`
                   AND (sikd_rek_akun.kd_rek_akun in ('4','5','6')
                    OR sikd_rek_kelompok.kd_rek_kelompok in ('61','62'))
                     LEFT OUTER JOIN (Select d.sikd_satker_id, a1.sikd_rek_rincian_obj_id, sum(a1.jumlah) as jumlah
                          From renja_anggaran a
                         inner join renja_mata_anggaran b on a.id_renja_anggaran = b.renja_anggaran_id
                         inner join renja_renja d ON a.renja_renja_id  = d.id_renja_renja
                         inner join renja_mata_anggaran a1 on a.id_renja_anggaran = a1.renja_anggaran_id
                          Where d.jns_renja = :jns_renja
                      and IF(:sikd_sub_skpd_id = '%', d.sikd_satker_id = :sikd_satker_id, 
                        d.id_renja_renja = :id_renja)
                          Group by d.sikd_satker_id, a1.sikd_rek_rincian_obj_id) AS  renja_blnj_langsung
                  ON renja_renja.sikd_satker_id = renja_blnj_langsung.sikd_satker_id
                       AND renja_mata_anggaran.sikd_rek_rincian_obj_id = renja_blnj_langsung.sikd_rek_rincian_obj_id
                WHERE
                     renja_renja.jns_renja = :jns_renja
                 AND IF(:sikd_sub_skpd_id = '%', renja_renja.sikd_satker_id = :sikd_satker_id, renja_renja.id_renja_renja = :id_renja)
                GROUP BY
                     sikd_rek_akun.`kd_rek_akun`,
                     sikd_rek_kelompok.`kd_rek_kelompok`,
                     sikd_rek_jenis.`kd_rek_jenis`,
                     sikd_rek_obj.`kd_rek_obj`,
                     sikd_rek_rincian_obj.`kd_rek_rincian_obj`,
                     jns_rek
                ORDER BY
                     sikd_rek_akun_kd_rek_akun,
                     sikd_rek_kelompok_kd_rek_kelompok,
                     sikd_rek_jenis_kd_rek_jenis,
                     sikd_rek_obj_kd_rek_obj,
                     sikd_rek_rincian_obj_kd_rek_rincian_obj";
            
            
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_renja", $id_renja);
            $statement->bindValue("sikd_satker_id", $sikd_satker_id);
            $statement->bindValue("sikd_sub_skpd_id", $sikd_sub_skpd_id);
            $statement->bindValue("jns_renja", $jns_renja);
            $statement->execute();
            $rekapProyeksi = $statement->fetchAll();

            return new JsonResponse($rekapProyeksi);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }

    private function getRenjaRekapProgram($request){
        try {

            $jnsRenja = $request->query->get("jns_renja");
            $idRenja = $request->query->get("id_renja");
            $idSatker = $request->query->get("sikd_satker_id");
            $tahun = $request->query->get("tahun");
            $idSubUnit = $request->query->get("sikd_sub_skpd_id");
            

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRenja = pack('H*', str_replace('-', '', trim($idRenja)));
            $this->connection = $conn->getConnection();

            $idSatker = pack('H*', str_replace('-', '', trim($idSatker)));
            
            if ($idSubUnit != '%'){
                $idSubUnit = pack('H*', str_replace('-', '', trim($idSubUnit)));    
            }
            
            $sql = "SELECT
                     CONCAT_WS('-',
                        SUBSTR(HEX(renja_renja.`id_renja_renja`), 1, 8),
                        SUBSTR(HEX(renja_renja.`id_renja_renja`), 9, 4),
                        SUBSTR(HEX(renja_renja.`id_renja_renja`), 13, 4),
                        SUBSTR(HEX(renja_renja.`id_renja_renja`), 17, 4),
                        SUBSTR(HEX(renja_renja.`id_renja_renja`), 21)
                            ) AS renja_renja_id_renja_renja,
                     renja_renja.`tahun` AS renja_renja_tahun,
                     CONCAT_WS('-',
                        SUBSTR(HEX(renja_program.`id_renja_program`), 1, 8),
                        SUBSTR(HEX(renja_program.`id_renja_program`), 9, 4),
                        SUBSTR(HEX(renja_program.`id_renja_program`), 13, 4),
                        SUBSTR(HEX(renja_program.`id_renja_program`), 17, 4),
                        SUBSTR(HEX(renja_program.`id_renja_program`), 21)
                            ) AS renja_program_id_rkpd_program,
                     renja_program.`kd_program` AS renja_program_kd_program,
                     renja_program.`tgt_anggaran_renstra` AS renja_program_tgt_anggaran_renstra,
                     renja_program.`rls_anggaran_sd_thn_lalu` AS renja_program_rls_anggaran_sd_thn_lalu,
                     renja_program.`pagu_indikatif` AS renja_program_pagu_indikatif_,
                     SUM(renja_anggaran.`tgt_anggaran_thn_ini`) AS renja_program_pagu_indikatif_,
                     IFNULL(jumlah_renja.`jumlah`, 0) AS renja_program_pagu_indikatif,
                     renja_program.`keterangan` AS renja_program_keterangan,
                     CONCAT_WS('-',
                        SUBSTR(HEX(renja_program.`sikd_prog_id`), 1, 8),
                        SUBSTR(HEX(renja_program.`sikd_prog_id`), 9, 4),
                        SUBSTR(HEX(renja_program.`sikd_prog_id`), 13, 4),
                        SUBSTR(HEX(renja_program.`sikd_prog_id`), 17, 4),
                        SUBSTR(HEX(renja_program.`sikd_prog_id`), 21)
                            ) AS renj_prog_sikd_prog_id,
                     CONCAT_WS('-',
                        SUBSTR(HEX(renja_program.`sikd_bidang_id`), 1, 8),
                        SUBSTR(HEX(renja_program.`sikd_bidang_id`), 9, 4),
                        SUBSTR(HEX(renja_program.`sikd_bidang_id`), 13, 4),
                        SUBSTR(HEX(renja_program.`sikd_bidang_id`), 17, 4),
                        SUBSTR(HEX(renja_program.`sikd_bidang_id`), 21)
                            ) AS renj_prog_sikd_bidang_id,
                     CONCAT_WS('-',
                        SUBSTR(HEX(renja_renja.`sikd_satker_id`), 1, 8),
                        SUBSTR(HEX(renja_renja.`sikd_satker_id`), 9, 4),
                        SUBSTR(HEX(renja_renja.`sikd_satker_id`), 13, 4),
                        SUBSTR(HEX(renja_renja.`sikd_satker_id`), 17, 4),
                        SUBSTR(HEX(renja_renja.`sikd_satker_id`), 21)
                            ) AS renj_prog_sikd_satker_id,
                      CONCAT_WS('-',
                        SUBSTR(HEX(renja_renja.`sikd_sub_skpd_id`), 1, 8),
                        SUBSTR(HEX(renja_renja.`sikd_sub_skpd_id`), 9, 4),
                        SUBSTR(HEX(renja_renja.`sikd_sub_skpd_id`), 13, 4),
                        SUBSTR(HEX(renja_renja.`sikd_sub_skpd_id`), 17, 4),
                        SUBSTR(HEX(renja_renja.`sikd_sub_skpd_id`), 21)
                            ) AS renj_prog_sikd_sub_skpd_id,
                      CONCAT_WS('-',
                        SUBSTR(HEX(renja_anggaran.`sikd_kgtn_id`), 1, 8),
                        SUBSTR(HEX(renja_anggaran.`sikd_kgtn_id`), 9, 4),
                        SUBSTR(HEX(renja_anggaran.`sikd_kgtn_id`), 13, 4),
                        SUBSTR(HEX(renja_anggaran.`sikd_kgtn_id`), 17, 4),
                        SUBSTR(HEX(renja_anggaran.`sikd_kgtn_id`), 21)
                        ) AS renja_sikd_kgtn_id
                FROM
                     `renja_program` renja_program 
                     INNER JOIN `renja_renja` renja_renja ON renja_program.`renja_renja_id` = renja_renja.`id_renja_renja`
                     INNER JOIN `renja_anggaran` renja_anggaran ON renja_program.`id_renja_program` = renja_anggaran.`renja_program_id`
                     LEFT OUTER JOIN (select c2.sikd_satker_id, c3.sikd_prog_id, sum(a.jumlah) as jumlah 
                              from renja_mata_anggaran a, renja_anggaran b, renja_renja c2, renja_program c3
                                   where a.renja_anggaran_id = b.id_renja_anggaran
                             and b.renja_program_id = c3.id_renja_program
                             and c3.renja_renja_id = c2.id_renja_renja
                             and c2.jns_renja = :jnsRenja
                             and IF(:idSubUnit = '%', c2.sikd_satker_id = :idSatker, 
                                c2.id_renja_renja = :idRenja)
                              group by c2.sikd_satker_id, c3.sikd_prog_id) AS jumlah_renja
                      ON jumlah_renja.sikd_satker_id = renja_renja.sikd_satker_id
                     AND jumlah_renja.sikd_prog_id = renja_program.sikd_prog_id
                WHERE
                     renja_renja.jns_renja = :jnsRenja
                 AND IF(:idSubUnit = '%', renja_renja.sikd_satker_id = :idSatker, renja_renja.id_renja_renja = :idRenja)
                GROUP BY
                     renja_program.`kd_program`,
                     renja_renja.sikd_satker_id
                ORDER BY
                     renja_program.`kd_program` ASC
                    ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("idRenja", $idRenja);
            $statement->bindValue("idSatker", $idSatker);
            $statement->bindValue("idSubUnit", $idSubUnit);
            $statement->bindValue("jnsRenja", $jnsRenja);
            
            $statement->execute();
            $rekapProgram = $statement->fetchAll();

            return new JsonResponse($rekapProgram);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    private function getRenjaRekapProgKgth($request){
        try {
            
            $jnsRenja = $request->query->get("jns_renja");
            $idRenja = $request->query->get("id_renja");
            $idSatker = $request->query->get("sikd_satker_id");
            $tahun = $request->query->get("tahun");
            $idSubUnit = $request->query->get("sikd_sub_skpd_id");
            
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRenja = pack('H*', str_replace('-', '', trim($idRenja)));
            $this->connection = $conn->getConnection();
            
            $idSatker = pack('H*', str_replace('-', '', trim($idSatker)));
            
            if ($idSubUnit != '%'){
                $idSubUnit = pack('H*', str_replace('-', '', trim($idSubUnit)));
            }
            
            $sql = "SELECT
                        CONCAT_WS('-',
                        SUBSTR(HEX(renja_renja.`id_renja_renja`), 1, 8),
                        SUBSTR(HEX(renja_renja.`id_renja_renja`), 9, 4),
                        SUBSTR(HEX(renja_renja.`id_renja_renja`), 13, 4),
                        SUBSTR(HEX(renja_renja.`id_renja_renja`), 17, 4),
                        SUBSTR(HEX(renja_renja.`id_renja_renja`), 21)
                        ) AS renja_renja_id_renja_renja,
                        renja_renja.`tahun` AS renja_renja_tahun,
                        CONCAT_WS('-',
                        SUBSTR(HEX(renja_program.`id_renja_program`), 1, 8),
                        SUBSTR(HEX(renja_program.`id_renja_program`), 9, 4),
                        SUBSTR(HEX(renja_program.`id_renja_program`), 13, 4),
                        SUBSTR(HEX(renja_program.`id_renja_program`), 17, 4),
                        SUBSTR(HEX(renja_program.`id_renja_program`), 21)
                        ) AS renja_program_id_renja_program,
                        renja_program.`kd_program` AS renja_program_kd_program,
                        renja_program.`tgt_anggaran_renstra` AS renja_program_tgt_anggaran_renstra,
                        renja_program.`rls_anggaran_sd_thn_lalu` AS renja_program_rls_anggaran_sd_thn_lalu,
                        renja_program.`pagu_indikatif` AS renja_program_pagu_indikatif,
                        renja_program.`keterangan` AS renja_program_keterangan,
                        CONCAT_WS('-',
                        SUBSTR(HEX(renja_anggaran.`id_renja_anggaran`), 1, 8),
                        SUBSTR(HEX(renja_anggaran.`id_renja_anggaran`), 9, 4),
                        SUBSTR(HEX(renja_anggaran.`id_renja_anggaran`), 13, 4),
                        SUBSTR(HEX(renja_anggaran.`id_renja_anggaran`), 17, 4),
                        SUBSTR(HEX(renja_anggaran.`id_renja_anggaran`), 21)
                        ) AS renja_kegiatan_id_renja_kegiatan,
                        CONCAT_WS('-',
                        SUBSTR(HEX(renja_anggaran.`sikd_kgtn_id`), 1, 8),
                        SUBSTR(HEX(renja_anggaran.`sikd_kgtn_id`), 9, 4),
                        SUBSTR(HEX(renja_anggaran.`sikd_kgtn_id`), 13, 4),
                        SUBSTR(HEX(renja_anggaran.`sikd_kgtn_id`), 17, 4),
                        SUBSTR(HEX(renja_anggaran.`sikd_kgtn_id`), 21)
                        ) AS renja_kegiatan_sikd_kgtn_id,
                        renja_anggaran.`kd_kegiatan` AS renja_kegiatan_kd_kegiatan_,
                        renja_anggaran.`nm_kegiatan` AS renja_kegiatan_nm_kegiatan,
                        lpad(renja_anggaran.`no_subkegiatan`,3,0) AS renja_kegiatan_no_subkegiatan,
                        if(trim(renja_anggaran.`nm_subkegiatan`) != '', renja_anggaran.`nm_subkegiatan`, renja_anggaran.`nm_kegiatan`) AS renja_kegiatan_nm_subkegiatan,
                        SUM(IFNULL(renja_anggaran.`jml_anggaran_rkpd`,0))AS renja_kegiatan_jml_anggaran_rkpd,
                        SUM(IFNULL(renja_anggaran.`tgt_anggaran_thn_ini`,0))AS renja_kegiatan_tgt_anggaran_thn_ini_,
                        IFNULL(jumlah_renja.`jumlah`, 0) AS renja_kegiatan_tgt_anggaran_thn_ini,
                     CONCAT_WS('-',
                        SUBSTR(HEX(renja_program.`sikd_prog_id`), 1, 8),
                        SUBSTR(HEX(renja_program.`sikd_prog_id`), 9, 4),
                        SUBSTR(HEX(renja_program.`sikd_prog_id`), 13, 4),
                        SUBSTR(HEX(renja_program.`sikd_prog_id`), 17, 4),
                        SUBSTR(HEX(renja_program.`sikd_prog_id`), 21)
                            ) AS renj_prog_sikd_prog_id,
                     CONCAT_WS('-',
                        SUBSTR(HEX(renja_program.`sikd_bidang_id`), 1, 8),
                        SUBSTR(HEX(renja_program.`sikd_bidang_id`), 9, 4),
                        SUBSTR(HEX(renja_program.`sikd_bidang_id`), 13, 4),
                        SUBSTR(HEX(renja_program.`sikd_bidang_id`), 17, 4),
                        SUBSTR(HEX(renja_program.`sikd_bidang_id`), 21)
                            ) AS renj_prog_sikd_bidang_id,
                     CONCAT_WS('-',
                        SUBSTR(HEX(renja_renja.`sikd_satker_id`), 1, 8),
                        SUBSTR(HEX(renja_renja.`sikd_satker_id`), 9, 4),
                        SUBSTR(HEX(renja_renja.`sikd_satker_id`), 13, 4),
                        SUBSTR(HEX(renja_renja.`sikd_satker_id`), 17, 4),
                        SUBSTR(HEX(renja_renja.`sikd_satker_id`), 21)
                            ) AS renj_prog_sikd_satker_id,
                      CONCAT_WS('-',
                        SUBSTR(HEX(renja_renja.`sikd_sub_skpd_id`), 1, 8),
                        SUBSTR(HEX(renja_renja.`sikd_sub_skpd_id`), 9, 4),
                        SUBSTR(HEX(renja_renja.`sikd_sub_skpd_id`), 13, 4),
                        SUBSTR(HEX(renja_renja.`sikd_sub_skpd_id`), 17, 4),
                        SUBSTR(HEX(renja_renja.`sikd_sub_skpd_id`), 21)
                            ) AS renj_prog_sikd_sub_skpd_id,
                      replace(replace(renja_anggaran.`kd_kegiatan`,'.',''),'-','') AS renja_kegiatan_kd_kegiatan_cut,
                      CONCAT_WS('-',
                        SUBSTR(HEX(renja_anggaran.`sikd_kgtn_id`), 1, 8),
                        SUBSTR(HEX(renja_anggaran.`sikd_kgtn_id`), 9, 4),
                        SUBSTR(HEX(renja_anggaran.`sikd_kgtn_id`), 13, 4),
                        SUBSTR(HEX(renja_anggaran.`sikd_kgtn_id`), 17, 4),
                        SUBSTR(HEX(renja_anggaran.`sikd_kgtn_id`), 21)
                        ) AS renja_sikd_kgtn_id
                    FROM
                    `renja_program` renja_program 
                    INNER JOIN `renja_renja` renja_renja ON renja_program.`renja_renja_id` = renja_renja.`id_renja_renja`
                    INNER JOIN `renja_anggaran` renja_anggaran ON renja_program.`id_renja_program` = renja_anggaran.`renja_program_id`
                    LEFT OUTER JOIN (select c2.sikd_satker_id, b.sikd_kgtn_id, b.no_subkegiatan, sum(a.jumlah) as jumlah 
                        from renja_mata_anggaran a, renja_anggaran b, renja_renja c2, renja_program c3
                        where a.renja_anggaran_id = b.id_renja_anggaran
                        and b.renja_program_id = c3.id_renja_program
                        and c3.renja_renja_id = c2.id_renja_renja
                        and c2.jns_renja = :jnsRenja
                        and IF(:idSubUnit = '%', c2.sikd_satker_id = :idSatker, 
                        c2.id_renja_renja = :idRenja)
                        group by c2.sikd_satker_id, b.sikd_kgtn_id, b.no_subkegiatan) AS jumlah_renja
                    ON jumlah_renja.sikd_satker_id = renja_renja.sikd_satker_id
                    AND jumlah_renja.sikd_kgtn_id = renja_anggaran.sikd_kgtn_id
                    AND jumlah_renja.no_subkegiatan = renja_anggaran.no_subkegiatan
                    WHERE
                        renja_renja.jns_renja = :jnsRenja
                     AND IF(:idSubUnit = '%', renja_renja.sikd_satker_id = :idSatker, renja_renja.id_renja_renja = :idRenja)
                    GROUP BY
                        renja_program.`kd_program`,
                        renja_kegiatan_no_subkegiatan
                    ORDER BY
                        renja_program.`kd_program` ASC,
                        renja_kegiatan_no_subkegiatan ASC
                    ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("idRenja", $idRenja);
            $statement->bindValue("idSatker", $idSatker);
            $statement->bindValue("idSubUnit", $idSubUnit);
            $statement->bindValue("jnsRenja", $jnsRenja);
            
            $statement->execute();
            $rekapProgram = $statement->fetchAll();
            
            return new JsonResponse($rekapProgram);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    private function getRenjaRekapUrusanSatker($request){
        try {
            
            $jnsRenja = $request->query->get("jns_renja");
            $idRenja = $request->query->get("id_renja");
            $idSatker = $request->query->get("sikd_satker_id");
            $tahun = $request->query->get("tahun");
            $idSubUnit = $request->query->get("sikd_sub_skpd_id");
            
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRenja = pack('H*', str_replace('-', '', trim($idRenja)));
            $this->connection = $conn->getConnection();
            
            $idSatker = pack('H*', str_replace('-', '', trim($idSatker)));
            
            if ($idSubUnit != '%'){
                $idSubUnit = pack('H*', str_replace('-', '', trim($idSubUnit)));
            }
            
            $sql = "SELECT
                        CONCAT_WS('-',
                        SUBSTR(HEX(renja_renja.`id_renja_renja`), 1, 8),
                        SUBSTR(HEX(renja_renja.`id_renja_renja`), 9, 4),
                        SUBSTR(HEX(renja_renja.`id_renja_renja`), 13, 4),
                        SUBSTR(HEX(renja_renja.`id_renja_renja`), 17, 4),
                        SUBSTR(HEX(renja_renja.`id_renja_renja`), 21)
                        ) AS renja_renja_id_renja_renja,
                        renja_renja.`tahun` AS renja_renja_tahun,
                        CONCAT_WS('-',
                        SUBSTR(HEX(renja_anggaran.`id_renja_anggaran`), 1, 8),
                        SUBSTR(HEX(renja_anggaran.`id_renja_anggaran`), 9, 4),
                        SUBSTR(HEX(renja_anggaran.`id_renja_anggaran`), 13, 4),
                        SUBSTR(HEX(renja_anggaran.`id_renja_anggaran`), 17, 4),
                        SUBSTR(HEX(renja_anggaran.`id_renja_anggaran`), 21)
                        ) AS renja_kegiatan_id_renja_kegiatan,
                        SUM(renja_anggaran.`jml_anggaran_rkpd`)AS rkpd_kegiatan_jml_anggaran_rkpd,
                        SUM(renja_anggaran.`tgt_anggaran_thn_ini`)AS renja_kegiatan_tgt_anggaran_thn_ini_,
                        IFNULL(jumlah_renja.`jumlah`,0)AS renja_kegiatan_tgt_anggaran_thn_ini,
                     CONCAT_WS('-',
                        SUBSTR(HEX(renja_program.`sikd_prog_id`), 1, 8),
                        SUBSTR(HEX(renja_program.`sikd_prog_id`), 9, 4),
                        SUBSTR(HEX(renja_program.`sikd_prog_id`), 13, 4),
                        SUBSTR(HEX(renja_program.`sikd_prog_id`), 17, 4),
                        SUBSTR(HEX(renja_program.`sikd_prog_id`), 21)
                            ) AS renj_prog_sikd_prog_id,
                     CONCAT_WS('-',
                        SUBSTR(HEX(renja_program.`sikd_bidang_id`), 1, 8),
                        SUBSTR(HEX(renja_program.`sikd_bidang_id`), 9, 4),
                        SUBSTR(HEX(renja_program.`sikd_bidang_id`), 13, 4),
                        SUBSTR(HEX(renja_program.`sikd_bidang_id`), 17, 4),
                        SUBSTR(HEX(renja_program.`sikd_bidang_id`), 21)
                            ) AS renj_prog_sikd_bidang_id,
                     CONCAT_WS('-',
                        SUBSTR(HEX(renja_renja.`sikd_satker_id`), 1, 8),
                        SUBSTR(HEX(renja_renja.`sikd_satker_id`), 9, 4),
                        SUBSTR(HEX(renja_renja.`sikd_satker_id`), 13, 4),
                        SUBSTR(HEX(renja_renja.`sikd_satker_id`), 17, 4),
                        SUBSTR(HEX(renja_renja.`sikd_satker_id`), 21)
                            ) AS renj_prog_sikd_satker_id,
                      CONCAT_WS('-',
                        SUBSTR(HEX(renja_renja.`sikd_sub_skpd_id`), 1, 8),
                        SUBSTR(HEX(renja_renja.`sikd_sub_skpd_id`), 9, 4),
                        SUBSTR(HEX(renja_renja.`sikd_sub_skpd_id`), 13, 4),
                        SUBSTR(HEX(renja_renja.`sikd_sub_skpd_id`), 17, 4),
                        SUBSTR(HEX(renja_renja.`sikd_sub_skpd_id`), 21)
                            ) AS renj_prog_sikd_sub_skpd_id,
                      CONCAT_WS('-',
                        SUBSTR(HEX(renja_anggaran.`sikd_kgtn_id`), 1, 8),
                        SUBSTR(HEX(renja_anggaran.`sikd_kgtn_id`), 9, 4),
                        SUBSTR(HEX(renja_anggaran.`sikd_kgtn_id`), 13, 4),
                        SUBSTR(HEX(renja_anggaran.`sikd_kgtn_id`), 17, 4),
                        SUBSTR(HEX(renja_anggaran.`sikd_kgtn_id`), 21)
                        ) AS renja_sikd_kgtn_id
                    FROM
                    `renja_anggaran` renja_anggaran
                    INNER JOIN `renja_renja` renja_renja ON renja_anggaran.`renja_renja_id` = renja_renja.`id_renja_renja`
                    INNER JOIN `renja_program` renja_program ON renja_anggaran.`renja_program_id` = renja_program.`id_renja_program`
                    LEFT OUTER JOIN (select c2.sikd_satker_id, c3.sikd_bidang_id, sum(a.jumlah) as jumlah
                        from renja_mata_anggaran a, renja_anggaran b, renja_renja c2, renja_program c3
                        where a.renja_anggaran_id = b.id_renja_anggaran
                            and b.renja_program_id = c3.id_renja_program
                            and b.renja_renja_id = c2.id_renja_renja
                            and c2.jns_renja = :jnsRenja
                            and IF(:idSubUnit = '%', c2.sikd_satker_id = :idSatker,
                            c2.id_renja_renja = :idRenja)
                        group by c2.sikd_satker_id, c3.sikd_bidang_id) AS jumlah_renja
                        ON jumlah_renja.sikd_satker_id = renja_renja.sikd_satker_id
                        AND jumlah_renja.sikd_bidang_id = renja_program.sikd_bidang_id
                    WHERE
                    renja_renja.jns_renja = :jnsRenja
                    AND IF(:idSubUnit = '%', renja_renja.sikd_satker_id = :idSatker, renja_renja.id_renja_renja = :idRenja)
                    ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("idRenja", $idRenja);
            $statement->bindValue("idSatker", $idSatker);
            $statement->bindValue("idSubUnit", $idSubUnit);
            $statement->bindValue("jnsRenja", $jnsRenja);
            
            $statement->execute();
            $rekapProgram = $statement->fetchAll();
            
            return new JsonResponse($rekapProgram);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    private function getRenjaRekapProgRkpd($request){
        try {
            
            $jnsRenja = $request->query->get("jns_renja");
            $idRenja = $request->query->get("id_renja");
            $idSatker = $request->query->get("sikd_satker_id");
            $tahun = $request->query->get("tahun");
            $idSubUnit = $request->query->get("sikd_sub_skpd_id");
            
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerNamee);
            $idRenja = pack('H*', str_replace('-', '', trim($idRenja)));
            $this->connection = $conn->getConnection();
            
            $idSatker = pack('H*', str_replace('-', '', trim($idSatker)));
            
            if ($idSubUnit != '%'){
                $idSubUnit = pack('H*', str_replace('-', '', trim($idSubUnit)));
            }
            
            $sql = "SELECT
                        CONCAT_WS('-',
                        SUBSTR(HEX(renja_renja.`id_renja_renja`), 1, 8),
                        SUBSTR(HEX(renja_renja.`id_renja_renja`), 9, 4),
                        SUBSTR(HEX(renja_renja.`id_renja_renja`), 13, 4),
                        SUBSTR(HEX(renja_renja.`id_renja_renja`), 17, 4),
                        SUBSTR(HEX(renja_renja.`id_renja_renja`), 21)
                        ) AS renja_renja_id_renja_renja,
                        renja_renja.`tahun` AS renja_renja_tahun,
                        renja_program.`kd_program` AS renja_program_kd_program,
                        SUM(ifnull(renja_anggaran.`jml_anggaran_rkpd`, 0)) AS rkpd_program_pagu_indikatif,
                        ifnull(jumlah_renja.jumlah, 0) AS renja_program_pagu_indikatif,
                        SUM(ifnull(renja_anggaran.`jml_anggaran_rkpd`, 0)) - ifnull(jumlah_renja.jumlah, 0) AS selisih_renja_rkpd,
                     CONCAT_WS('-',
                        SUBSTR(HEX(renja_program.`sikd_prog_id`), 1, 8),
                        SUBSTR(HEX(renja_program.`sikd_prog_id`), 9, 4),
                        SUBSTR(HEX(renja_program.`sikd_prog_id`), 13, 4),
                        SUBSTR(HEX(renja_program.`sikd_prog_id`), 17, 4),
                        SUBSTR(HEX(renja_program.`sikd_prog_id`), 21)
                            ) AS renj_prog_sikd_prog_id,
                     CONCAT_WS('-',
                        SUBSTR(HEX(renja_program.`sikd_bidang_id`), 1, 8),
                        SUBSTR(HEX(renja_program.`sikd_bidang_id`), 9, 4),
                        SUBSTR(HEX(renja_program.`sikd_bidang_id`), 13, 4),
                        SUBSTR(HEX(renja_program.`sikd_bidang_id`), 17, 4),
                        SUBSTR(HEX(renja_program.`sikd_bidang_id`), 21)
                            ) AS renj_prog_sikd_bidang_id,
                     CONCAT_WS('-',
                        SUBSTR(HEX(renja_renja.`sikd_satker_id`), 1, 8),
                        SUBSTR(HEX(renja_renja.`sikd_satker_id`), 9, 4),
                        SUBSTR(HEX(renja_renja.`sikd_satker_id`), 13, 4),
                        SUBSTR(HEX(renja_renja.`sikd_satker_id`), 17, 4),
                        SUBSTR(HEX(renja_renja.`sikd_satker_id`), 21)
                            ) AS renj_prog_sikd_satker_id,
                      CONCAT_WS('-',
                        SUBSTR(HEX(renja_renja.`sikd_sub_skpd_id`), 1, 8),
                        SUBSTR(HEX(renja_renja.`sikd_sub_skpd_id`), 9, 4),
                        SUBSTR(HEX(renja_renja.`sikd_sub_skpd_id`), 13, 4),
                        SUBSTR(HEX(renja_renja.`sikd_sub_skpd_id`), 17, 4),
                        SUBSTR(HEX(renja_renja.`sikd_sub_skpd_id`), 21)
                            ) AS renj_prog_sikd_sub_skpd_id,
                      CONCAT_WS('-',
                        SUBSTR(HEX(renja_anggaran.`sikd_kgtn_id`), 1, 8),
                        SUBSTR(HEX(renja_anggaran.`sikd_kgtn_id`), 9, 4),
                        SUBSTR(HEX(renja_anggaran.`sikd_kgtn_id`), 13, 4),
                        SUBSTR(HEX(renja_anggaran.`sikd_kgtn_id`), 17, 4),
                        SUBSTR(HEX(renja_anggaran.`sikd_kgtn_id`), 21)
                        ) AS renja_sikd_kgtn_id
                    FROM
                    `renja_renja` renja_renja
                    INNER JOIN `renja_program` renja_program ON renja_renja.`id_renja_renja` = renja_program.`renja_renja_id`
                    INNER JOIN `renja_anggaran` renja_anggaran ON renja_program.`id_renja_program` = renja_anggaran.`renja_program_id`
                    LEFT OUTER JOIN (select c2.sikd_satker_id, c3.sikd_prog_id, sum(a.jumlah) as jumlah
                            from renja_mata_anggaran a, renja_anggaran b, renja_renja c2, renja_program c3
                            where a.renja_anggaran_id = b.id_renja_anggaran
                            and b.renja_program_id = c3.id_renja_program
                            and c3.renja_renja_id = c2.id_renja_renja
                            and c2.jns_renja = :jnsRenja
                            and IF(:idSubUnit = '%', c2.sikd_satker_id = :idSatker,
                                c2.id_renja_renja = :idRenja)
                            group by c2.sikd_satker_id, c3.sikd_prog_id) AS jumlah_renja
                            ON jumlah_renja.sikd_satker_id = renja_renja.sikd_satker_id
                            AND jumlah_renja.sikd_prog_id = renja_program.sikd_prog_id
                    WHERE
                        renja_renja.jns_renja = :jnsRenja
                        AND IF(:idSubUnit = '%', renja_renja.sikd_satker_id = :idSatker, renja_renja.id_renja_renja = :idRenja)
                    ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("idRenja", $idRenja);
            $statement->bindValue("idSatker", $idSatker);
            $statement->bindValue("idSubUnit", $idSubUnit);
            $statement->bindValue("jnsRenja", $jnsRenja);
            
            $statement->execute();
            $rekapProgram = $statement->fetchAll();
            
            return new JsonResponse($rekapProgram);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    private function getRenjaBelanjaLangsung($request){
        try {
            
            /*$id_renja_anggaran = $request->query->get("id_renja_anggaran");
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $id_renja_anggaran = pack('H*', str_replace('-', '', trim($id_renja_anggaran)));
            $this->connection = $conn->getConnection();*/

            $id_renja_anggaran = $request->query->get("id_renja_anggaran");
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $id_renja_anggaran = $this->convertOuuidToUuid($id_renja_anggaran);
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                       CONCAT_WS('-',
                        SUBSTR(HEX(renja_anggaran.`id_renja_anggaran`), 1, 8),
                        SUBSTR(HEX(renja_anggaran.`id_renja_anggaran`), 9, 4),
                        SUBSTR(HEX(renja_anggaran.`id_renja_anggaran`), 13, 4),
                        SUBSTR(HEX(renja_anggaran.`id_renja_anggaran`), 17, 4),
                        SUBSTR(HEX(renja_anggaran.`id_renja_anggaran`), 21)
                       ) AS renja_anggaran_id_renja_anggaran,
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
                        SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 1, 8),
                        SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 9, 4),
                        SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 13, 4),
                        SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 17, 4),
                        SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 21)
                       ) AS sikd_bidang_id_sikd_bidang,
                       sikd_bidang.`kd_bidang` AS sikd_bidang_kd_bidang,
                       sikd_bidang.`nm_bidang` AS sikd_bidang_nm_bidang,
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
                        SUBSTR(HEX(renja_mata_anggaran.`id_renja_mata_anggaran`), 1, 8),
                        SUBSTR(HEX(renja_mata_anggaran.`id_renja_mata_anggaran`), 9, 4),
                        SUBSTR(HEX(renja_mata_anggaran.`id_renja_mata_anggaran`), 13, 4),
                        SUBSTR(HEX(renja_mata_anggaran.`id_renja_mata_anggaran`), 17, 4),
                        SUBSTR(HEX(renja_mata_anggaran.`id_renja_mata_anggaran`), 21)
                       ) AS id_renja_mata_anggaran,
                       renja_mata_anggaran.`volume` AS renja_mata_anggaran_volume,
                       renja_mata_anggaran.`satuan` AS renja_mata_anggaran_satuan,
                       renja_mata_anggaran.`harga` AS renja_mata_anggaran_harga,
                       ifnull(renja_mata_anggaran.`jumlah`,0)AS renja_mata_anggaran_jumlah,
                       CONCAT_WS('-',
                         SUBSTR(HEX(renja_anggaran.`id_renja_anggaran`), 1, 8),
                         SUBSTR(HEX(renja_anggaran.`id_renja_anggaran`), 9, 4),
                         SUBSTR(HEX(renja_anggaran.`id_renja_anggaran`), 13, 4),
                         SUBSTR(HEX(renja_anggaran.`id_renja_anggaran`), 17, 4),
                         SUBSTR(HEX(renja_anggaran.`id_renja_anggaran`), 21)
                       ) AS renja_blnj_langsung_renja_kegiatan_id,
                       renja_program.`kd_program` AS renja_program_kd_program,
                       sikd_prog.`nm_prog` AS sikd_prog_nm_prog,
                       renja_anggaran.`kd_kegiatan` AS renja_kegiatan_kd_kegiatan,
                       renja_anggaran.`nm_kegiatan` AS renja_kegiatan_nm_kegiatan,
                       renja_anggaran.`prioritas` AS renja_kegiatan_prioritas,
                       renja_anggaran.`klpk_sasaran` AS renja_kegiatan_klpk_sasaran
                  FROM
                            `renja_anggaran` renja_anggaran 
                     INNER JOIN `renja_mata_anggaran` renja_mata_anggaran ON renja_anggaran.`id_renja_anggaran` = renja_mata_anggaran.`renja_anggaran_id`
                     INNER JOIN `renja_renja` renja_renja ON renja_anggaran.`renja_renja_id` = renja_renja.`id_renja_renja`
                     INNER JOIN `renja_program` renja_program ON renja_anggaran.renja_program_id = renja_program.`id_renja_program`
                     INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON renja_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                     INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                     INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                     INNER JOIN `sikd_rek_kelompok` sikd_rek_kelompok ON sikd_rek_jenis.`sikd_rek_kelompok_id` = sikd_rek_kelompok.`id_sikd_rek_kelompok`
                     INNER JOIN `sikd_rek_akun` sikd_rek_akun ON sikd_rek_kelompok.`sikd_rek_akun_id` = sikd_rek_akun.`id_sikd_rek_akun`
                     INNER JOIN `sikd_prog` sikd_prog ON renja_program.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                     INNER JOIN `sikd_satker` sikd_satker ON renja_renja.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                     INNER JOIN `sikd_bidang` sikd_bidang ON renja_anggaran.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                     LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON renja_renja.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                  WHERE
                       renja_anggaran.`id_renja_anggaran` = :id_renja_anggaran
                  ORDER BY
                       renja_mata_anggaran.`kd_rekening` ASC
                    ";

            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_renja_anggaran", $id_renja_anggaran);
            
            $statement->execute();
            $result = $statement->fetchAll();
            
            return new JsonResponse($result);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getRenjaBelanjaTakLangsung($request){
        try {
            
            /*$idRenja = $request->query->get("id_renja_anggaran");
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRenja = pack('H*', str_replace('-', '', trim($idRenja)));
            $this->connection = $conn->getConnection();*/

            $id_renja_anggaran = $request->query->get("id_renja_anggaran");
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $id_renja_anggaran = $this->convertOuuidToUuid($id_renja_anggaran);
            $this->connection = $conn->getConnection();
            
            /*$sql = "SELECT
                     renja_renja.`jns_renja` AS renja_renja_jns_renja,
                     CONCAT_WS('-',
                                        SUBSTR(HEX(renja_mata_anggaran.`id_renja_mata_anggaran`), 1, 8),
                                        SUBSTR(HEX(renja_mata_anggaran.`id_renja_mata_anggaran`), 9, 4),
                                        SUBSTR(HEX(renja_mata_anggaran.`id_renja_mata_anggaran`), 13, 4),
                                        SUBSTR(HEX(renja_mata_anggaran.`id_renja_mata_anggaran`), 17, 4),
                                        SUBSTR(HEX(renja_mata_anggaran.`id_renja_mata_anggaran`), 21)
                                        ) AS id_renja_mata_anggaran,
                     renja_mata_anggaran.`volume` AS renja_mata_anggaran_volume,
                     renja_mata_anggaran.`satuan` AS renja_mata_anggaran_satuan,
                     renja_mata_anggaran.`harga` AS renja_mata_anggaran_harga,
                     ifnull(renja_mata_anggaran.`jumlah`,0) AS renja_mata_anggaran_jumlah,
                   CONCAT_WS('-',
                                        SUBSTR(HEX(renja_mata_anggaran.`sikd_rek_rincian_obj_id`), 1, 8),
                                        SUBSTR(HEX(renja_mata_anggaran.`sikd_rek_rincian_obj_id`), 9, 4),
                                        SUBSTR(HEX(renja_mata_anggaran.`sikd_rek_rincian_obj_id`), 13, 4),
                                        SUBSTR(HEX(renja_mata_anggaran.`sikd_rek_rincian_obj_id`), 17, 4),
                                        SUBSTR(HEX(renja_mata_anggaran.`sikd_rek_rincian_obj_id`), 21)
                                        ) AS renja_mata_anggaran_sikd_rek_rincian_obj_id,
                   CONCAT_WS('-',
                                        SUBSTR(HEX(renja_renja.`sikd_satker_id`), 1, 8),
                                        SUBSTR(HEX(renja_renja.`sikd_satker_id`), 9, 4),
                                        SUBSTR(HEX(renja_renja.`sikd_satker_id`), 13, 4),
                                        SUBSTR(HEX(renja_renja.`sikd_satker_id`), 17, 4),
                                        SUBSTR(HEX(renja_renja.`sikd_satker_id`), 21)
                                        ) AS renja_renja_sikd_satker_id,
                   CONCAT_WS('-',
                                        SUBSTR(HEX(renja_anggaran.`sikd_bidang_id`), 1, 8),
                                        SUBSTR(HEX(renja_anggaran.`sikd_bidang_id`), 9, 4),
                                        SUBSTR(HEX(renja_anggaran.`sikd_bidang_id`), 13, 4),
                                        SUBSTR(HEX(renja_anggaran.`sikd_bidang_id`), 17, 4),
                                        SUBSTR(HEX(renja_anggaran.`sikd_bidang_id`), 21)
                                        ) AS renja_anggaran_sikd_bidang_id,
                   CONCAT_WS('-',
                                        SUBSTR(HEX(renja_renja.`sikd_sub_skpd_id`), 1, 8),
                                        SUBSTR(HEX(renja_renja.`sikd_sub_skpd_id`), 9, 4),
                                        SUBSTR(HEX(renja_renja.`sikd_sub_skpd_id`), 13, 4),
                                        SUBSTR(HEX(renja_renja.`sikd_sub_skpd_id`), 17, 4),
                                        SUBSTR(HEX(renja_renja.`sikd_sub_skpd_id`), 21)
                                        ) AS renja_renja_sikd_sub_skpd_id
                FROM
                     `renja_anggaran` renja_anggaran
        INNER JOIN `renja_renja` renja_renja ON renja_anggaran.`renja_renja_id` = renja_renja.`id_renja_renja`
        INNER JOIN `renja_mata_anggaran` renja_mata_anggaran ON renja_anggaran.`id_renja_anggaran` = renja_mata_anggaran.`renja_anggaran_id`
                WHERE
                     renja_anggaran.`id_renja_anggaran` = :id_renja_anggaran
                ORDER BY
                     renja_mata_anggaran.`kd_rekening` ASC
                    ";*/
            $sql = "SELECT
                     renja_renja.`jns_renja` AS renja_renja_jns_renja,
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
                        SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 1, 8),
                        SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 9, 4),
                        SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 13, 4),
                        SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 17, 4),
                        SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 21)
                     ) AS sikd_bidang_id_sikd_bidang,
                     sikd_bidang.`kd_bidang` AS sikd_bidang_kd_bidang,
                     sikd_bidang.`nm_bidang` AS sikd_bidang_nm_bidang,
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
                        SUBSTR(HEX(renja_mata_anggaran.`id_renja_mata_anggaran`), 1, 8),
                        SUBSTR(HEX(renja_mata_anggaran.`id_renja_mata_anggaran`), 9, 4),
                        SUBSTR(HEX(renja_mata_anggaran.`id_renja_mata_anggaran`), 13, 4),
                        SUBSTR(HEX(renja_mata_anggaran.`id_renja_mata_anggaran`), 17, 4),
                        SUBSTR(HEX(renja_mata_anggaran.`id_renja_mata_anggaran`), 21)
                     ) AS id_renja_mata_anggaran,
                     renja_mata_anggaran.`volume` AS renja_mata_anggaran_volume,
                     renja_mata_anggaran.`satuan` AS renja_mata_anggaran_satuan,
                     renja_mata_anggaran.`harga` AS renja_mata_anggaran_harga,
                     ifnull(renja_mata_anggaran.`jumlah`,0) AS renja_mata_anggaran_jumlah
                FROM
                     `renja_anggaran` renja_anggaran
                     INNER JOIN `renja_renja` renja_renja ON renja_anggaran.`renja_renja_id` = renja_renja.`id_renja_renja`
                     INNER JOIN `renja_mata_anggaran` renja_mata_anggaran ON renja_anggaran.`id_renja_anggaran` = renja_mata_anggaran.`renja_anggaran_id`
                     INNER JOIN `sikd_rek_rincian_obj` sikd_rek_rincian_obj ON renja_mata_anggaran.`sikd_rek_rincian_obj_id` = sikd_rek_rincian_obj.`id_sikd_rek_rincian_obj`
                     INNER JOIN `sikd_rek_obj` sikd_rek_obj ON sikd_rek_rincian_obj.`sikd_rek_obj_id` = sikd_rek_obj.`id_sikd_rek_obj`
                     INNER JOIN `sikd_rek_jenis` sikd_rek_jenis ON sikd_rek_obj.`sikd_rek_jenis_id` = sikd_rek_jenis.`id_sikd_rek_jenis`
                     INNER JOIN `sikd_rek_kelompok` sikd_rek_kelompok ON sikd_rek_jenis.`sikd_rek_kelompok_id` = sikd_rek_kelompok.`id_sikd_rek_kelompok`
                     INNER JOIN `sikd_rek_akun` sikd_rek_akun ON sikd_rek_kelompok.`sikd_rek_akun_id` = sikd_rek_akun.`id_sikd_rek_akun`
                     INNER JOIN `sikd_satker` sikd_satker ON renja_renja.sikd_satker_id = sikd_satker.id_sikd_satker
                     LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON renja_renja.sikd_sub_skpd_id = sikd_sub_skpd.id_sikd_sub_skpd
                     INNER JOIN `sikd_bidang` sikd_bidang ON renja_anggaran.sikd_bidang_id = sikd_bidang.id_sikd_bidang
                WHERE
                     renja_anggaran.`id_renja_anggaran` = :id_renja_anggaran
                ORDER BY
                     renja_mata_anggaran.`kd_rekening` ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_renja_anggaran", $id_renja_anggaran);
            
            $statement->execute();
            $result = $statement->fetchAll();
            
            return new JsonResponse($result);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    private function getRenjaAnggaranSub($request){
      try {
            $idRenjaMataAnggaran = $request->query->get("id_renja_mata_anggaran");
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRenjaMataAnggaran = pack('H*', str_replace('-', '', trim($idRenjaMataAnggaran)));
            $this->connection = $conn->getConnection();
            $sql = "SELECT
                        CONCAT_WS('-',
                         SUBSTR(HEX(renja_rincian_mata_anggaran.`renja_mata_anggaran_id`), 1, 8),
                         SUBSTR(HEX(renja_rincian_mata_anggaran.`renja_mata_anggaran_id`), 9, 4),
                         SUBSTR(HEX(renja_rincian_mata_anggaran.`renja_mata_anggaran_id`), 13, 4),
                         SUBSTR(HEX(renja_rincian_mata_anggaran.`renja_mata_anggaran_id`), 17, 4),
                         SUBSTR(HEX(renja_rincian_mata_anggaran.`renja_mata_anggaran_id`), 21)
                          ) AS renja_rincian_mata_anggaran_renja_mata_anggaran_id,
                         renja_rincian_mata_anggaran.`no_item_h` AS renja_rincian_mata_anggaran_no_item_h,
                         renja_rincian_mata_anggaran.`no_item_s` AS renja_rincian_mata_anggaran_no_item_s,
                         renja_rincian_mata_anggaran.`no_item` AS renja_rincian_mata_anggaran_no_item,
                         renja_rincian_mata_anggaran.`jns_item` AS renja_rincian_mata_anggaran_jns_item,
                         renja_rincian_mata_anggaran.`header` AS renja_rincian_mata_anggaran_header,
                         renja_rincian_mata_anggaran.`subheader` AS renja_rincian_mata_anggaran_subheader,
                         renja_rincian_mata_anggaran.`uraian` AS renja_rincian_mata_anggaran_uraian,
                         renja_rincian_mata_anggaran.`volume` AS renja_rincian_mata_anggaran_volume,
                         renja_rincian_mata_anggaran.`satuan` AS renja_rincian_mata_anggaran_satuan,
                         renja_rincian_mata_anggaran.`harga` AS renja_rincian_mata_anggaran_harga,
                         renja_rincian_mata_anggaran.`jumlah` AS renja_rincian_mata_anggaran_jumlah
                    FROM
                         `renja_rincian_mata_anggaran` renja_rincian_mata_anggaran
                    WHERE
                         renja_rincian_mata_anggaran.`renja_mata_anggaran_id` =:idRenjaMataAnggaran
                    ORDER BY
                      cast(renja_rincian_mata_anggaran.`no_item_h` as unsigned),
                      cast(renja_rincian_mata_anggaran.`no_item_s` as unsigned),
                      cast(renja_rincian_mata_anggaran.`no_item` as unsigned)";
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("idRenjaMataAnggaran", $idRenjaMataAnggaran);
            $statement->execute();
            $progamIndikator = $statement->fetchAll();
            return new JsonResponse($progamIndikator);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getRenjaBelanjaLngsngIndikator($request){
        try {
            $idKgtn = $request->query->get("id_renja_kgtn");
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idKgtn = pack('H*', str_replace('-', '', trim($idKgtn)));
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                     CONCAT_WS('-',
                    SUBSTR(HEX(renja_kegiatan_indikator.`id_renja_kegiatan_indikator`), 1, 8),
                    SUBSTR(HEX(renja_kegiatan_indikator.`id_renja_kegiatan_indikator`), 9, 4),
                    SUBSTR(HEX(renja_kegiatan_indikator.`id_renja_kegiatan_indikator`), 13, 4),
                    SUBSTR(HEX(renja_kegiatan_indikator.`id_renja_kegiatan_indikator`), 17, 4),
                    SUBSTR(HEX(renja_kegiatan_indikator.`id_renja_kegiatan_indikator`), 21)
                    ) AS renja_kegiatan_indikator_id_renja_kegiatan_indikator,
                    renja_kegiatan_indikator.`no_indikator` AS renja_kegiatan_indikator_no_indikator,
                    renja_kegiatan_indikator.`uraian_indikator` AS renja_kegiatan_indikator_uraian_indikator,
                    renja_kegiatan_indikator.`satuan` AS renja_kegiatan_indikator_satuan,
                    renja_kegiatan_indikator.`target_thn_ini` AS renja_kegiatan_indikator_target_thn_ini,
                  CONCAT_WS('-',
                    SUBSTR(HEX(`renja_kegiatan`.`id_renja_anggaran`), 1, 8),
                    SUBSTR(HEX(`renja_kegiatan`.`id_renja_anggaran`), 9, 4),
                    SUBSTR(HEX(`renja_kegiatan`.`id_renja_anggaran`), 13, 4),
                    SUBSTR(HEX(`renja_kegiatan`.`id_renja_anggaran`), 17, 4),
                    SUBSTR(HEX(`renja_kegiatan`.`id_renja_anggaran`), 21)
                    ) AS renja_kegiatan_id_renja_kegiatan,
CONCAT_WS('-',
                    SUBSTR(HEX(renja_kegiatan_indikator.`sikd_klpk_indikator_id`), 1, 8),
                    SUBSTR(HEX(renja_kegiatan_indikator.`sikd_klpk_indikator_id`), 9, 4),
                    SUBSTR(HEX(renja_kegiatan_indikator.`sikd_klpk_indikator_id`), 13, 4),
                    SUBSTR(HEX(renja_kegiatan_indikator.`sikd_klpk_indikator_id`), 17, 4),
                    SUBSTR(HEX(renja_kegiatan_indikator.`sikd_klpk_indikator_id`), 21)
                    ) AS renja_kegiatan_indikator_sikd_klpk_indikator_id
                FROM
                     `renja_kegiatan_indikator` renja_kegiatan_indikator
                        RIGHT OUTER JOIN `renja_anggaran` renja_kegiatan ON renja_kegiatan_indikator.`renja_blnj_langsung_id` = renja_kegiatan.`id_renja_anggaran`
                WHERE
                     renja_kegiatan.`id_renja_anggaran` = :idKgtn
                ORDER BY
                     renja_kegiatan_indikator.`no_indikator` ASC
                    ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("idKgtn", $idKgtn);
            $statement->execute();
            $rekapProgram = $statement->fetchAll();
            
            return new JsonResponse($rekapProgram);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getSubRenjaRpt($request)
    {
        try {
            
            $idRenja = $request->query->get("id_renja");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRenja = pack('H*', str_replace('-', '', trim($idRenja)));
            $this->connection = $conn->getConnection();
            
            $sql = "SELECT
                     CONCAT_WS('-',
                                        SUBSTR(HEX(renja_rincian_mata_anggaran.`renja_mata_anggaran_id`), 1, 8),
                                        SUBSTR(HEX(renja_rincian_mata_anggaran.`renja_mata_anggaran_id`), 9, 4),
                                        SUBSTR(HEX(renja_rincian_mata_anggaran.`renja_mata_anggaran_id`), 13, 4),
                                        SUBSTR(HEX(renja_rincian_mata_anggaran.`renja_mata_anggaran_id`), 17, 4),
                                        SUBSTR(HEX(renja_rincian_mata_anggaran.`renja_mata_anggaran_id`), 21)
                                        ) AS renja_rincian_mata_anggaran_renja_mata_anggaran_id,
                     renja_rincian_mata_anggaran.`no_item_h` AS renja_rincian_mata_anggaran_no_item_h,
                     renja_rincian_mata_anggaran.`no_item_s` AS renja_rincian_mata_anggaran_no_item_s,
                     renja_rincian_mata_anggaran.`no_item` AS renja_rincian_mata_anggaran_no_item,
                     renja_rincian_mata_anggaran.`jns_item` AS renja_rincian_mata_anggaran_jns_item,
                     renja_rincian_mata_anggaran.`header` AS renja_rincian_mata_anggaran_header,
                     renja_rincian_mata_anggaran.`subheader` AS renja_rincian_mata_anggaran_subheader,
                     renja_rincian_mata_anggaran.`uraian` AS renja_rincian_mata_anggaran_uraian,
                     renja_rincian_mata_anggaran.`volume` AS renja_rincian_mata_anggaran_volume,
                     renja_rincian_mata_anggaran.`satuan` AS renja_rincian_mata_anggaran_satuan,
                     renja_rincian_mata_anggaran.`harga` AS renja_rincian_mata_anggaran_harga,
                     renja_rincian_mata_anggaran.`jumlah` AS renja_rincian_mata_anggaran_jumlah
                FROM
                     `renja_rincian_mata_anggaran` renja_rincian_mata_anggaran
                WHERE
                     renja_rincian_mata_anggaran.`renja_mata_anggaran_id` = :idRenja
                ORDER BY
                  cast(renja_rincian_mata_anggaran.`no_item_h` as unsigned),
                  cast(renja_rincian_mata_anggaran.`no_item_s` as unsigned),
                  cast(renja_rincian_mata_anggaran.`no_item` as unsigned)
                    ";
            
            
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("idRenja", $idRenja);
            
            $statement->execute();
            $rekapProyeksi = $statement->fetchAll();
            
            return new JsonResponse($rekapProyeksi);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }

    private function getRenjaLampPermen546c0($request){
      try {

            $jnsRenja = $request->query->get("jns_renja");
            $idRenja = $request->query->get("id_renja");
            $idSatker = $request->query->get("sikd_satker_id");
            $tahun = $request->query->get("tahun");
            $idSubUnit = $request->query->get("sikd_sub_skpd_id");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRenja = pack('H*', str_replace('-', '', trim($idRenja)));
            $this->connection = $conn->getConnection();

            $idSatker = pack('H*', str_replace('-', '', trim($idSatker)));
            
            if ($idSubUnit != '%'){
                $idSubUnit = pack('H*', str_replace('-', '', trim($idSubUnit)));    
            }
            $sql = "SELECT
                         CONCAT_WS('-',
                         SUBSTR(HEX(renja_renja.id_renja_renja), 1, 8),
                         SUBSTR(HEX(renja_renja.id_renja_renja), 9, 4),
                         SUBSTR(HEX(renja_renja.id_renja_renja), 13, 4),
                         SUBSTR(HEX(renja_renja.id_renja_renja), 17, 4),
                         SUBSTR(HEX(renja_renja.id_renja_renja), 21)
                            ) AS renja_renja_id_renja_renja,
                         renja_renja.tahun AS renja_renja_tahun,
                         CONCAT_WS('-',
                         SUBSTR(HEX(renja_program.id_renja_program), 1, 8),
                         SUBSTR(HEX(renja_program.id_renja_program), 9, 4),
                         SUBSTR(HEX(renja_program.id_renja_program), 13, 4),
                         SUBSTR(HEX(renja_program.id_renja_program), 17, 4),
                         SUBSTR(HEX(renja_program.id_renja_program), 21)
                            ) AS renja_program_id_renja_program,
                         renja_program.kd_program AS renja_program_kd_program,
                         CONCAT_WS('-',
                         SUBSTR(HEX(renja_program.sikd_prog_id ), 1, 8),
                         SUBSTR(HEX(renja_program.sikd_prog_id ), 9, 4),
                         SUBSTR(HEX(renja_program.sikd_prog_id ), 13, 4),
                         SUBSTR(HEX(renja_program.sikd_prog_id ), 17, 4),
                         SUBSTR(HEX(renja_program.sikd_prog_id ), 21)
                            ) AS sikd_prog_id_sikd_prog,
                         renja_program.tgt_anggaran_renstra AS renja_program_tgt_anggaran_renstra,
                         renja_program.rls_anggaran_sd_thn_lalu AS renja_program_rls_anggaran_sd_thn_lalu,
                         renja_program.pagu_indikatif AS renja_program_pagu_indikatif,
                         renja_program.prakiraan_maju AS renja_program_prakiraan_maju,
                         renja_program.keterangan AS renja_program_keterangan,
                         CONCAT_WS('-',
                         SUBSTR(HEX(renja_anggaran.sikd_kgtn_id), 1, 8),
                         SUBSTR(HEX(renja_anggaran.sikd_kgtn_id), 9, 4),
                         SUBSTR(HEX(renja_anggaran.sikd_kgtn_id), 13, 4),
                         SUBSTR(HEX(renja_anggaran.sikd_kgtn_id), 17, 4),
                         SUBSTR(HEX(renja_anggaran.sikd_kgtn_id), 21)
                            ) AS renja_kegiatan_id_renja_kegiatan,
                         renja_anggaran.kd_kegiatan AS renja_kegiatan_kd_kegiatan,
                         renja_anggaran.kd_kegiatan AS sikd_kgtn_kd_kgtn,
                         renja_anggaran.nm_kegiatan AS renja_kegiatan_nm_kegiatan,
                         renja_anggaran.nm_kegiatan AS sikd_kgtn_nm_kgtn,
                         renja_anggaran.nm_subkegiatan AS renja_kegiatan_nm_subkegiatan,
                         renja_anggaran.lokasi_kgtn AS renja_kegiatan_lokasi_kgtn,
                         renja_anggaran.keterangan AS renja_kegiatan_keterangan,
                         IFNULL(renja_anggaran.jml_anggaran_rkpd,0) AS renja_kegiatan_jml_anggaran_rkpd,
                         IFNULL(renja_anggaran.tgt_anggaran_thn_ini,0) AS renja_kegiatan_tgt_anggaran_thn_ini,
                         IFNULL(renja_anggaran.tgt_anggaran_thn_dpn,0) AS renja_kegiatan_tgt_anggaran_thn_dpn,
                          CONCAT_WS('-',
                         SUBSTR(HEX(renja_mata_anggaran.sikd_sumber_anggaran_id), 1, 8),
                         SUBSTR(HEX(renja_mata_anggaran.sikd_sumber_anggaran_id), 9, 4),
                         SUBSTR(HEX(renja_mata_anggaran.sikd_sumber_anggaran_id), 13, 4),
                         SUBSTR(HEX(renja_mata_anggaran.sikd_sumber_anggaran_id), 17, 4),
                         SUBSTR(HEX(renja_mata_anggaran.sikd_sumber_anggaran_id), 21)
                            ) AS renja_mata_anggaran_sikd_sumber_anggaran_id
                    FROM
                         renja_program renja_program 
                         INNER JOIN renja_renja renja_renja ON renja_program.renja_renja_id = renja_renja.id_renja_renja
                         LEFT OUTER JOIN renja_anggaran renja_anggaran ON renja_program.id_renja_program = renja_anggaran.renja_program_id
                         LEFT JOIN renja_mata_anggaran renja_mata_anggaran ON renja_anggaran.id_renja_anggaran = renja_mata_anggaran.renja_anggaran_id
                    WHERE
                         renja_renja.id_renja_renja = :idRenja and renja_anggaran.sikd_kgtn_id is not NULL
                    ORDER BY
                         renja_program.kd_program ASC,
                         renja_anggaran.kd_kegiatan ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("idRenja", $idRenja);
            /*$statement->bindValue("idSatker", $idSatker);
            $statement->bindValue("idSubUnit", $idSubUnit);
            $statement->bindValue("jnsRenja", $jnsRenja);*/
            
            $statement->execute();
            $rekapProyeksi = $statement->fetchAll();

            return new JsonResponse($rekapProyeksi);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }

    private function getRenjaLampPermen546c0Sub2($request){
      try {
            $idProg = $request->query->get("id_prog");
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idProg = pack('H*', str_replace('-', '', trim($idProg)));
            //print_r($idProg);exit;
            $this->connection = $conn->getConnection();
            $sql = "SELECT renja_program_indikator.`no_indikator` AS renja_kegiatan_indikator_no_indikator, renja_program_indikator.`uraian_indikator` AS renja_kegiatan_indikator_uraian_indikator, concat(renja_program_indikator.`target_thn_ini`,' ',renja_program_indikator.`satuan`) AS renja_kegiatan_indikator_target_thn_ini, concat(renja_program_indikator.`target_thn_dpn`,' ',renja_program_indikator.`satuan`) AS renja_kegiatan_indikator_target_thn_dpn FROM `renja_program_indikator` renja_program_indikator WHERE renja_program_indikator.`renja_program_id` = :idProg ORDER BY renja_program_indikator.`rkpd_program_indikator_id`, renja_program_indikator.`no_indikator`";
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("idProg", $idProg);
            $statement->execute();
            $progamIndikator = $statement->fetchAll();
            return new JsonResponse($progamIndikator);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    private function getRenjaLampPermen547h4($request){
      try {

            $idRenja = $request->query->get("idRenja");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRenja = pack('H*', str_replace('-', '', trim($idRenja)));
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                         CONCAT_WS('-',
                         SUBSTR(HEX(renja_renja.id_renja_renja), 1, 8),
                         SUBSTR(HEX(renja_renja.id_renja_renja), 9, 4),
                         SUBSTR(HEX(renja_renja.id_renja_renja), 13, 4),
                         SUBSTR(HEX(renja_renja.id_renja_renja), 17, 4),
                         SUBSTR(HEX(renja_renja.id_renja_renja), 21)
                            ) AS renja_renja_id_renja_renja,
                         renja_renja.tahun AS renja_renja_tahun,
                         CONCAT_WS('-',
                         SUBSTR(HEX(renja_program.id_renja_program), 1, 8),
                         SUBSTR(HEX(renja_program.id_renja_program), 9, 4),
                         SUBSTR(HEX(renja_program.id_renja_program), 13, 4),
                         SUBSTR(HEX(renja_program.id_renja_program), 17, 4),
                         SUBSTR(HEX(renja_program.id_renja_program), 21)
                            ) AS renja_program_id_renja_program,
                         renja_program.kd_program AS renja_program_kd_program,
                         CONCAT_WS('-',
                         SUBSTR(HEX(renja_program.sikd_prog_id ), 1, 8),
                         SUBSTR(HEX(renja_program.sikd_prog_id ), 9, 4),
                         SUBSTR(HEX(renja_program.sikd_prog_id ), 13, 4),
                         SUBSTR(HEX(renja_program.sikd_prog_id ), 17, 4),
                         SUBSTR(HEX(renja_program.sikd_prog_id ), 21)
                            ) AS sikd_prog_id_sikd_prog,
                         renja_program.tgt_anggaran_renstra AS renja_program_tgt_anggaran_renstra,
                         renja_program.rls_anggaran_sd_thn_lalu AS renja_program_rls_anggaran_sd_thn_lalu,
                         renja_program.pagu_indikatif AS renja_program_pagu_indikatif,
                         renja_program.prakiraan_maju AS renja_program_prakiraan_maju,
                         renja_program.keterangan AS renja_program_keterangan,
                         CONCAT_WS('-',
                         SUBSTR(HEX(renja_anggaran.sikd_kgtn_id), 1, 8),
                         SUBSTR(HEX(renja_anggaran.sikd_kgtn_id), 9, 4),
                         SUBSTR(HEX(renja_anggaran.sikd_kgtn_id), 13, 4),
                         SUBSTR(HEX(renja_anggaran.sikd_kgtn_id), 17, 4),
                         SUBSTR(HEX(renja_anggaran.sikd_kgtn_id), 21)
                            ) AS renja_kegiatan_id_renja_kegiatan,
                         renja_anggaran.kd_kegiatan AS renja_kegiatan_kd_kegiatan,
                         renja_anggaran.kd_kegiatan AS sikd_kgtn_kd_kgtn,
                         renja_anggaran.nm_kegiatan AS renja_kegiatan_nm_kegiatan,
                         renja_anggaran.nm_kegiatan AS sikd_kgtn_nm_kgtn,
                         renja_anggaran.nm_subkegiatan AS renja_kegiatan_nm_subkegiatan,
                         renja_anggaran.lokasi_kgtn AS renja_kegiatan_lokasi_kgtn,
                         renja_anggaran.keterangan AS renja_kegiatan_keterangan,
                         CONCAT_WS('-',
                         SUBSTR(HEX(renja_program.sikd_bidang_id), 1, 8),
                         SUBSTR(HEX(renja_program.sikd_bidang_id), 9, 4),
                         SUBSTR(HEX(renja_program.sikd_bidang_id), 13, 4),
                         SUBSTR(HEX(renja_program.sikd_bidang_id), 17, 4),
                         SUBSTR(HEX(renja_program.sikd_bidang_id), 21)
                            ) AS renja_program_sikd_bidang_id,
                         IFNULL(renja_anggaran.jml_anggaran_rkpd,0) AS renja_kegiatan_jml_anggaran_rkpd,
                         IFNULL(renja_anggaran.tgt_anggaran_thn_ini,0) AS renja_kegiatan_tgt_anggaran_thn_ini,
                         IFNULL(renja_anggaran.tgt_anggaran_thn_dpn,0) AS renja_kegiatan_tgt_anggaran_thn_dpn,
                          CONCAT_WS('-',
                         SUBSTR(HEX(renja_mata_anggaran.sikd_sumber_anggaran_id), 1, 8),
                         SUBSTR(HEX(renja_mata_anggaran.sikd_sumber_anggaran_id), 9, 4),
                         SUBSTR(HEX(renja_mata_anggaran.sikd_sumber_anggaran_id), 13, 4),
                         SUBSTR(HEX(renja_mata_anggaran.sikd_sumber_anggaran_id), 17, 4),
                         SUBSTR(HEX(renja_mata_anggaran.sikd_sumber_anggaran_id), 21)
                            ) AS renja_mata_anggaran_sikd_sumber_anggaran_id,
                        IFNULL((Select GROUP_CONCAT(DISTINCT concat(a.target_thn_ini, ' ',a.satuan) ORDER BY a.no_indikator DESC SEPARATOR ';\n')
                          From renja_kegiatan_indikator a
                          Where 
                            a.renja_blnj_langsung_id = renja_anggaran.renja_anggaran_type
                            and a.sikd_klpk_indikator_id = '3'), '-') AS renja_kegiatan_indikator_target_indikator,
                         IFNULL((Select GROUP_CONCAT(DISTINCT a.uraian_indikator ORDER BY a.no_indikator DESC SEPARATOR ';\n')
                          From renja_program_indikator a
                          Where a.renja_program_id = renja_program.id_renja_program), '-') AS renja_program_indikator_uraian_indikator,
                            renja_kegiatan_indikator.uraian_indikator AS renja_kegiatan_indikator_uraian_indikator
                    FROM
                         renja_kegiatan_indikator, renja_program renja_program 
                         INNER JOIN renja_renja renja_renja ON renja_program.renja_renja_id = renja_renja.id_renja_renja
                         LEFT OUTER JOIN renja_anggaran renja_anggaran ON renja_program.id_renja_program = renja_anggaran.renja_program_id
                         LEFT JOIN renja_mata_anggaran renja_mata_anggaran ON renja_anggaran.id_renja_anggaran = renja_mata_anggaran.renja_anggaran_id
                    WHERE
                         renja_kegiatan_indikator.renja_blnj_langsung_id = renja_anggaran.id_renja_anggaran
                    AND
                         renja_renja.id_renja_renja = :idRenja
                    ORDER BY
                         renja_program.kd_program ASC,
                         renja_anggaran.kd_kegiatan ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("idRenja", $idRenja);
            
            $statement->execute();
            $rekapProyeksi = $statement->fetchAll();

            return new JsonResponse($rekapProyeksi);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }

    private function getRenjaPermen546c6($request){

        try {
            
            $jnsRenja = $request->query->get("jns_renja");
            $idRenja = $request->query->get("id_renja");
            $idSatker = $request->query->get("sikd_satker_id");
            $tahun = $request->query->get("tahun");
            $idSubUnit = $request->query->get("sikd_sub_skpd_id");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRenja = pack('H*', str_replace('-', '', trim($idRenja)));
            $this->connection = $conn->getConnection();
            
            $idSatker = pack('H*', str_replace('-', '', trim($idSatker)));
            
            if ($idSubUnit != '%'){
                $idSubUnit = pack('H*', str_replace('-', '', trim($idSubUnit)));
            }
            
            //return 'ok';

            $sql = "SELECT
                  CONCAT_WS('-',
                        SUBSTR(HEX(renja_renja.`id_renja_renja`), 1, 8),
                        SUBSTR(HEX(renja_renja.`id_renja_renja`), 9, 4),
                        SUBSTR(HEX(renja_renja.`id_renja_renja`), 13, 4),
                        SUBSTR(HEX(renja_renja.`id_renja_renja`), 17, 4),
                        SUBSTR(HEX(renja_renja.`id_renja_renja`), 21)
                            ) AS renja_renja_id_renja_renja,
                  CONCAT_WS('-',
                        SUBSTR(HEX(renja_anggaran.`sikd_bidang_id`), 1, 8),
                        SUBSTR(HEX(renja_anggaran.`sikd_bidang_id`), 9, 4),
                        SUBSTR(HEX(renja_anggaran.`sikd_bidang_id`), 13, 4),
                        SUBSTR(HEX(renja_anggaran.`sikd_bidang_id`), 17, 4),
                        SUBSTR(HEX(renja_anggaran.`sikd_bidang_id`), 21)
                            ) AS renja_anggaran_sikd_bidang_id,
                 renja_renja.`tahun` AS renja_renja_tahun,
                 CONCAT_WS('-',
                        SUBSTR(HEX(renja_program.`id_renja_program`), 1, 8),
                        SUBSTR(HEX(renja_program.`id_renja_program`), 9, 4),
                        SUBSTR(HEX(renja_program.`id_renja_program`), 13, 4),
                        SUBSTR(HEX(renja_program.`id_renja_program`), 17, 4),
                        SUBSTR(HEX(renja_program.`id_renja_program`), 21)
                            ) AS renja_program_id_renja_program,
                 renja_program.`kd_program` AS renja_program_kd_program,
                 renja_program.`tgt_anggaran_renstra` AS renja_program_tgt_anggaran_renstra,
                 renja_program.`rls_anggaran_sd_thn_lalu` AS renja_program_rls_anggaran_sd_thn_lalu,
                 renja_program.`pagu_indikatif` AS renja_program_pagu_indikatif,
                 renja_program.`prakiraan_maju` AS renja_program_prakiraan_maju,
                 renja_program.`keterangan` AS renja_program_keterangan,
                 CONCAT_WS('-',
                        SUBSTR(HEX(renja_program.`sikd_prog_id`), 1, 8),
                        SUBSTR(HEX(renja_program.`sikd_prog_id`), 9, 4),
                        SUBSTR(HEX(renja_program.`sikd_prog_id`), 13, 4),
                        SUBSTR(HEX(renja_program.`sikd_prog_id`), 17, 4),
                        SUBSTR(HEX(renja_program.`sikd_prog_id`), 21)
                            ) AS renja_program_sikd_prog_id,
                 CONCAT_WS('-',
                        SUBSTR(HEX(renja_anggaran.`sikd_kgtn_id`), 1, 8),
                        SUBSTR(HEX(renja_anggaran.`sikd_kgtn_id`), 9, 4),
                        SUBSTR(HEX(renja_anggaran.`sikd_kgtn_id`), 13, 4),
                        SUBSTR(HEX(renja_anggaran.`sikd_kgtn_id`), 17, 4),
                        SUBSTR(HEX(renja_anggaran.`sikd_kgtn_id`), 21)
                            ) AS renja_anggaran_sikd_kgtn_id,
                 renja_anggaran.`kd_kegiatan` AS renja_kegiatan_kd_kegiatan_,
                 renja_anggaran.`nm_kegiatan` AS renja_kegiatan_nm_kegiatan,
                 renja_anggaran.`nm_subkegiatan` AS renja_kegiatan_nm_subkegiatan,
                 renja_anggaran.`lokasi_kgtn` AS renja_kegiatan_lokasi_kgtn,
                 renja_anggaran.`tgt_anggaran_renstra` AS renja_kegiatan_tgt_anggaran_renstra,
                 renja_anggaran.`rls_anggaran_sd_thn_lalu` AS renja_kegiatan_rls_anggaran_sd_thn_lalu,
                 renja_anggaran.`keterangan` AS renja_kegiatan_keterangan,
                 IFNULL(renja_anggaran.`jml_anggaran_rkpd`,0)AS renja_kegiatan_jml_anggaran_rkpd,
                 IFNULL(renja_anggaran.`tgt_anggaran_thn_ini`,0)AS renja_kegiatan_tgt_anggaran_thn_ini,
                 IFNULL(renja_anggaran.`tgt_anggaran_thn_dpn`,0)AS renja_kegiatan_tgt_anggaran_thn_dpn,
                 IFNULL((Select GROUP_CONCAT(DISTINCT a.uraian_indikator ORDER BY a.no_indikator DESC SEPARATOR ';\n')
                         From renja_program_indikator a
                         Where a.renja_program_id = renja_program.`id_renja_program`), '-') AS renja_program_indikator_uraian_indikator,
                  renja_kegiatan_indikator.`uraian_indikator` AS renja_kegiatan_indikator_uraian_indikator
            FROM
                  renja_kegiatan_indikator, `renja_program` renja_program
                 INNER JOIN `renja_renja` renja_renja ON renja_program.`renja_renja_id` = renja_renja.`id_renja_renja`
                 LEFT OUTER JOIN renja_anggaran ON renja_program.`id_renja_program` = renja_anggaran.`renja_program_id`
            WHERE 
                 renja_kegiatan_indikator.`renja_blnj_langsung_id` = renja_anggaran.`id_renja_anggaran`
            AND
                 renja_renja.id_renja_renja = :idRenja
            ORDER BY
                 renja_program.`kd_program` ASC,
                 renja_anggaran.`kd_kegiatan` ASC";

            $statement = $this->connection->prepare($sql);
            $statement->bindValue("idRenja", $idRenja);
            /*$statement->bindValue("idSatker", $idSatker);
            $statement->bindValue("idSubUnit", $idSubUnit);
            $statement->bindValue("jnsRenja", $jnsRenja);*/
           // return new JsonResponse($sql);
            $statement->execute();
            $permen54 = $statement->fetchAll();
            //print_r('ok');exit;                        
            return new JsonResponse($permen54);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }      
    }
    
    private function getRenjaLampPermen547i5($request){

        try {


            $jnsRenja = $request->query->get("jns_renja");
            $idRenja = $request->query->get("id_renja");
            $idSatker = $request->query->get("sikd_satker_id");
            $tahun = $request->query->get("tahun");
            $idSubUnit = $request->query->get("sikd_sub_skpd_id");
            
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRenja = pack('H*', str_replace('-', '', trim($idRenja)));
            $this->connection = $conn->getConnection();
            
            $idSatker = pack('H*', str_replace('-', '', trim($idSatker)));
            
            if ($idSubUnit != '%'){
                $idSubUnit = pack('H*', str_replace('-', '', trim($idSubUnit)));
            }
            
            //print_r('ok');exit;

            $sql = "SELECT
                 CONCAT_WS('-',
                        SUBSTR(HEX(renja_renja.`id_renja_renja`), 1, 8),
                        SUBSTR(HEX(renja_renja.`id_renja_renja`), 9, 4),
                        SUBSTR(HEX(renja_renja.`id_renja_renja`), 13, 4),
                        SUBSTR(HEX(renja_renja.`id_renja_renja`), 17, 4),
                        SUBSTR(HEX(renja_renja.`id_renja_renja`), 21)
                            ) AS renja_renja_id_renja_renja,
                 renja_renja.`tahun` AS renja_renja_tahun,
                 CONCAT_WS('-',
                        SUBSTR(HEX(renja_program.`id_renja_program`), 1, 8),
                        SUBSTR(HEX(renja_program.`id_renja_program`), 9, 4),
                        SUBSTR(HEX(renja_program.`id_renja_program`), 13, 4),
                        SUBSTR(HEX(renja_program.`id_renja_program`), 17, 4),
                        SUBSTR(HEX(renja_program.`id_renja_program`), 21)
                            ) AS renja_program_id_renja_program,
                 renja_program.`kd_program` AS renja_program_kd_program,
                 renja_program.`tgt_anggaran_renstra` AS renja_program_tgt_anggaran_renstra,
                 renja_program.`rls_anggaran_sd_thn_lalu` AS renja_program_rls_anggaran_sd_thn_lalu,
                 renja_program.`pagu_indikatif` AS renja_program_pagu_indikatif,
                 renja_program.`prakiraan_maju` AS renja_program_prakiraan_maju,
                 renja_program.`keterangan` AS renja_program_keterangan,
                 CONCAT_WS('-',
                        SUBSTR(HEX(renja_program.`sikd_bidang_id`), 1, 8),
                        SUBSTR(HEX(renja_program.`sikd_bidang_id`), 9, 4),
                        SUBSTR(HEX(renja_program.`sikd_bidang_id`), 13, 4),
                        SUBSTR(HEX(renja_program.`sikd_bidang_id`), 17, 4),
                        SUBSTR(HEX(renja_program.`sikd_bidang_id`), 21)
                            ) AS renja_program_sikd_bidang_id,
                 CONCAT_WS('-',
                        SUBSTR(HEX(renja_program.`sikd_prog_id`), 1, 8),
                        SUBSTR(HEX(renja_program.`sikd_prog_id`), 9, 4),
                        SUBSTR(HEX(renja_program.`sikd_prog_id`), 13, 4),
                        SUBSTR(HEX(renja_program.`sikd_prog_id`), 17, 4),
                        SUBSTR(HEX(renja_program.`sikd_prog_id`), 21)
                            ) AS renja_program_sikd_prog_id,
                 CONCAT_WS('-',
                        SUBSTR(HEX(renja_anggaran.`sikd_kgtn_id`), 1, 8),
                        SUBSTR(HEX(renja_anggaran.`sikd_kgtn_id`), 9, 4),
                        SUBSTR(HEX(renja_anggaran.`sikd_kgtn_id`), 13, 4),
                        SUBSTR(HEX(renja_anggaran.`sikd_kgtn_id`), 17, 4),
                        SUBSTR(HEX(renja_anggaran.`sikd_kgtn_id`), 21)
                            ) AS renja_anggaran_sikd_kgtn_id,
                 renja_anggaran.`kd_kegiatan` AS renja_kegiatan_kd_kegiatan,
                 renja_anggaran.`nm_kegiatan` AS renja_kegiatan_nm_kegiatan,
                 renja_anggaran.`nm_subkegiatan` AS renja_kegiatan_nm_subkegiatan,
                 renja_anggaran.`lokasi_kgtn` AS renja_kegiatan_lokasi_kgtn,
                 renja_anggaran.`klpk_sasaran` AS renja_kegiatan_klpk_sasaran,
                 renja_anggaran.`keterangan` AS renja_kegiatan_keterangan,
                 IFNULL(renja_anggaran.`jml_anggaran_rkpd`,0)AS renja_kegiatan_jml_anggaran_rkpd,
                 IFNULL(renja_anggaran.`tgt_anggaran_thn_ini`,0)AS renja_kegiatan_tgt_anggaran_thn_ini,
                 IFNULL(renja_anggaran.`tgt_anggaran_thn_dpn`,0)AS renja_kegiatan_tgt_anggaran_thn_dpn,
                 IFNULL((Select GROUP_CONCAT(DISTINCT a.uraian_indikator ORDER BY a.no_indikator DESC SEPARATOR ';\n')
                         From renja_program_indikator a
                         Where a.renja_program_id = renja_program.`id_renja_program`), '-') AS renja_program_indikator_uraian_indikator,
                renja_kegiatan_indikator.`uraian_indikator` AS renja_kegiatan_indikator_uraian_indikator
            FROM
                  renja_kegiatan_indikator, `renja_program` renja_program
                 INNER JOIN `renja_renja` renja_renja ON renja_program.`renja_renja_id` = renja_renja.`id_renja_renja`
                 LEFT OUTER JOIN renja_anggaran ON renja_program.`id_renja_program` = renja_anggaran.`renja_program_id`
            WHERE 
                 renja_kegiatan_indikator.`renja_blnj_langsung_id` = renja_anggaran.`id_renja_anggaran`
            AND
                 renja_renja.id_renja_renja = :idRenja
            ORDER BY
                 renja_program.`kd_program` ASC,
                 renja_anggaran.`kd_kegiatan` ";

            $statement = $this->connection->prepare($sql);
            $statement->bindValue("idRenja", $idRenja);
            /*$statement->bindValue("idSatker", $idSatker);
            $statement->bindValue("idSubUnit", $idSubUnit);
            $statement->bindValue("jnsRenja", $jnsRenja);*/
            //return new JsonResponse($sql);
            $statement->execute();
            $permen54 = $statement->fetchAll();
            //print_r('ok');exit;                        
            return new JsonResponse($permen54);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }      
    }

     private function getRkpdLampPermen231c($request)
    {
        try {

            /*$jnsRenja = $request->query->get("jns_renja");
            $idRenja = $request->query->get("id_renja");
            $idSatker = $request->query->get("sikd_satker_id");
            $tahun = $request->query->get("tahun");
            $idSubUnit = $request->query->get("sikd_sub_skpd_id");*/

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            
            $this->connection = $conn->getConnection();
            /*$idRenja = pack('H*', str_replace('-', '', trim($idRenja)));
            $idSatker = pack('H*', str_replace('-', '', trim($idSatker)));
            
            if ($idSubUnit != '%'){
                $idSubUnit = pack('H*', str_replace('-', '', trim($idSubUnit)));    
            }*/
            $sql = "SELECT
                         renja_renja.`tahun` AS tahun,
                         round((renja_renja.`tahun`-1),0) AS tahun_sblm,
                        CONCAT_WS('-',
                        SUBSTR(HEX(renja_renja.`sikd_satker_id`), 1, 8),
                        SUBSTR(HEX(renja_renja.`sikd_satker_id`), 9, 4),
                        SUBSTR(HEX(renja_renja.`sikd_satker_id`), 13, 4),
                        SUBSTR(HEX(renja_renja.`sikd_satker_id`), 17, 4),
                        SUBSTR(HEX(renja_renja.`sikd_satker_id`), 21)
                            ) AS sikd_satker_id_sikd_satker
                    FROM
                         `renja_renja` renja_renja
                    WHERE
                         renja_renja.`jns_renja` = 'Renja-A'
                    ";
            
            
            
            $statement = $this->connection->prepare($sql);
            /*$statement->bindValue("idRenja", $idRenja);
            $statement->bindValue("idSatker", $idSatker);
            $statement->bindValue("idSubUnit", $idSubUnit);
            $statement->bindValue("jnsRenja", $jnsRenja);*/
            
            $statement->execute();
            $rekapProyeksi = $statement->fetchAll();

            return new JsonResponse($rekapProyeksi);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
  private function getRenjaLampPermen546c0Sub1($request){
    try {
          $idKgtn = $request->query->get("id_kgtn");
          $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
          $idKgtn = pack('H*', str_replace('-', '', trim($idKgtn)));
          //print_r($idProg);exit;
          $this->connection = $conn->getConnection();
          $sql = "SELECT
                    renja_kegiatan_indikator.`no_indikator` AS renja_kegiatan_indikator_no_indikator,
                    renja_kegiatan_indikator.`uraian_indikator` AS renja_kegiatan_indikator_uraian_indikator,
                    concat(renja_kegiatan_indikator.`target_thn_ini`,' ',renja_kegiatan_indikator.`satuan`) AS renja_kegiatan_indikator_target_thn_ini,
                    concat(renja_kegiatan_indikator.`target_thn_dpn`,' ',renja_kegiatan_indikator.`satuan`) AS renja_kegiatan_indikator_target_thn_dpn,
                    renja_kegiatan_indikator.`sikd_klpk_indikator_id` AS sikd_klpk_indikator_id
                    FROM
                    `renja_kegiatan_indikator` renja_kegiatan_indikator
                    WHERE
                    renja_kegiatan_indikator.renja_blnj_langsung_id = :idKgtn
                    ORDER BY
                         renja_kegiatan_indikator.sikd_klpk_indikator_id,
                         renja_kegiatan_indikator.no_indikator";
          $statement = $this->connection->prepare($sql);
          $statement->bindValue("idKgtn", $idKgtn);
          $statement->execute();
          $progamIndikator = $statement->fetchAll();
          return new JsonResponse($progamIndikator);
      } catch (\Doctrine\DBAL\DBALException $ex) {
          return $this->handleDBALException($ex);
      } catch (\Exception $ex) {
          return $this->handleException($ex);
      }
  }

  private function getRenjaKgtnSkpd($request)
    {
        try {
            //print_r("ok");exit;

            $idRenjaAnggaran = $request->query->get("id_renja_anggaran");
            $tahun = $request->query->get("tahun");
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idRenjaAnggaran = pack('H*', str_replace('-', '', trim($idRenjaAnggaran)));
            $this->connection = $conn->getConnection();

            $sql = "SELECT
                       renja_renja.`jns_renja` AS renja_renja_jns_renja,
                      CONCAT_WS('-',
                       SUBSTR(HEX(renja_renja.`id_renja_renja`), 1, 8),
                       SUBSTR(HEX(renja_renja.`id_renja_renja`), 9, 4),
                       SUBSTR(HEX(renja_renja.`id_renja_renja`), 13, 4),
                       SUBSTR(HEX(renja_renja.`id_renja_renja`), 17, 4),
                       SUBSTR(HEX(renja_renja.`id_renja_renja`), 21)
                       ) AS renja_renja_id_renja_renja,
                       renja_renja.`tahun` AS renja_renja_tahun,
                      CONCAT_WS('-',
                       SUBSTR(HEX(renja_renja.`sikd_satker_id`), 1, 8),
                       SUBSTR(HEX(renja_renja.`sikd_satker_id`), 9, 4),
                       SUBSTR(HEX(renja_renja.`sikd_satker_id`), 13, 4),
                       SUBSTR(HEX(renja_renja.`sikd_satker_id`), 17, 4),
                       SUBSTR(HEX(renja_renja.`sikd_satker_id`), 21)
                       ) AS sikd_satker_id_sikd_satker,
                      CONCAT_WS('-',
                       SUBSTR(HEX(renja_renja.`sikd_sub_skpd_id`), 1, 8),
                       SUBSTR(HEX(renja_renja.`sikd_sub_skpd_id`), 9, 4),
                       SUBSTR(HEX(renja_renja.`sikd_sub_skpd_id`), 13, 4),
                       SUBSTR(HEX(renja_renja.`sikd_sub_skpd_id`), 17, 4),
                       SUBSTR(HEX(renja_renja.`sikd_sub_skpd_id`), 21)
                       ) AS sikd_sub_skpd_id_sikd_sub_skpd,
                      CONCAT_WS('-',
                       SUBSTR(HEX(renja_anggaran.`id_renja_anggaran`), 1, 8),
                       SUBSTR(HEX(renja_anggaran.`id_renja_anggaran`), 9, 4),
                       SUBSTR(HEX(renja_anggaran.`id_renja_anggaran`), 13, 4),
                       SUBSTR(HEX(renja_anggaran.`id_renja_anggaran`), 17, 4),
                       SUBSTR(HEX(renja_anggaran.`id_renja_anggaran`), 21)
                       ) AS renja_kegiatan_id_renja_kegiatan,
                       renja_anggaran.`kd_kegiatan` AS renja_kegiatan_kd_kegiatan_,
                       renja_anggaran.`nm_kegiatan` AS renja_kegiatan_nm_kegiatan,
                      CONCAT_WS('-',
                       SUBSTR(HEX(renja_anggaran.`sikd_bidang_id`), 1, 8),
                       SUBSTR(HEX(renja_anggaran.`sikd_bidang_id`), 9, 4),
                       SUBSTR(HEX(renja_anggaran.`sikd_bidang_id`), 13, 4),
                       SUBSTR(HEX(renja_anggaran.`sikd_bidang_id`), 17, 4),
                       SUBSTR(HEX(renja_anggaran.`sikd_bidang_id`), 21)
                       ) AS sikd_bidang_id_sikd_bidang,
                      CONCAT_WS('-',
                       SUBSTR(HEX(renja_program.`id_renja_program`), 1, 8),
                       SUBSTR(HEX(renja_program.`id_renja_program`), 9, 4),
                       SUBSTR(HEX(renja_program.`id_renja_program`), 13, 4),
                       SUBSTR(HEX(renja_program.`id_renja_program`), 17, 4),
                       SUBSTR(HEX(renja_program.`id_renja_program`), 21)
                       ) AS renja_program_id_renja_program,
                      CONCAT_WS('-',
                       SUBSTR(HEX(renja_program.`sikd_prog_id`), 1, 8),
                       SUBSTR(HEX(renja_program.`sikd_prog_id`), 9, 4),
                       SUBSTR(HEX(renja_program.`sikd_prog_id`), 13, 4),
                       SUBSTR(HEX(renja_program.`sikd_prog_id`), 17, 4),
                       SUBSTR(HEX(renja_program.`sikd_prog_id`), 21)
                       ) AS sikd_prog_id_sikd_prog,
                       renja_program.`kd_program` AS renja_program_kd_program,
                      CONCAT_WS('-',
                       SUBSTR(HEX(renja_anggaran.`sikd_kgtn_id`), 1, 8),
                       SUBSTR(HEX(renja_anggaran.`sikd_kgtn_id`), 9, 4),
                       SUBSTR(HEX(renja_anggaran.`sikd_kgtn_id`), 13, 4),
                       SUBSTR(HEX(renja_anggaran.`sikd_kgtn_id`), 17, 4),
                       SUBSTR(HEX(renja_anggaran.`sikd_kgtn_id`), 21)
                       ) AS sikd_kgtn_id_sikd_kgtn,
                       renja_anggaran.`prioritas` AS renja_kegiatan_prioritas,
                       renja_anggaran.`sifat_kgtn` AS renja_kegiatan_sifat_kgtn,
                       renja_anggaran.`jns_kgtn` AS renja_kegiatan_jns_kgtn,
                       renja_anggaran.`klpk_sasaran` AS renja_kegiatan_klpk_sasaran,
                       renja_anggaran.`lokasi_kgtn` AS renja_kegiatan_lokasi_kgtn,
                       renja_anggaran.`latar_belakang` AS renja_kegiatan_latar_belakang,
                       renja_anggaran.`kebijakan_umum` AS renja_kegiatan_kebijakan_umum,
                       renja_anggaran.`tujuan_kgtn` AS renja_kegiatan_tujuan_kgtn,
                       renja_anggaran.`tupoksi_skpd` AS renja_kegiatan_tupoksi_skpd,
                      CONCAT_WS('-',
                       SUBSTR(HEX(renja_anggaran.`rkpd_sasaran_id`), 1, 8),
                       SUBSTR(HEX(renja_anggaran.`rkpd_sasaran_id`), 9, 4),
                       SUBSTR(HEX(renja_anggaran.`rkpd_sasaran_id`), 13, 4),
                       SUBSTR(HEX(renja_anggaran.`rkpd_sasaran_id`), 17, 4),
                       SUBSTR(HEX(renja_anggaran.`rkpd_sasaran_id`), 21)
                       ) AS renja_kegiatan_rkpd_sasaran_id,
                       renja_anggaran.`tgt_anggaran_renstra` AS renja_kegiatan_tgt_anggaran_renstra,
                       renja_anggaran.`rls_anggaran_sd_thn_lalu` AS renja_kegiatan_rls_anggaran_sd_thn_lalu,
                       renja_anggaran.`tgt_anggaran_thn_ini` AS renja_kegiatan_tgt_anggaran_thn_ini,
                       renja_anggaran.`tgt_anggaran_thn_dpn` AS renja_kegiatan_tgt_anggaran_thn_dpn,
                       renja_anggaran.`jml_anggaran_rkpd` AS renja_kegiatan_jml_anggaran_rkpd,
                       renja_anggaran.`catatan_rkpd` AS renja_kegiatan_catatan_rkpd,
                       renja_anggaran.`keterangan` AS renja_kegiatan_keterangan
                  FROM
                      `renja_program` renja_program 
                      INNER JOIN `renja_anggaran` renja_anggaran ON renja_program.`id_renja_program` = renja_anggaran.`renja_program_id`
                       INNER JOIN `renja_renja` renja_renja ON renja_anggaran.`renja_renja_id` = renja_renja.`id_renja_renja`
                    WHERE
                       renja_anggaran.id_renja_anggaran = :idRenjaAnggaran
                    ";

            $statement = $this->connection->prepare($sql);
            
            $statement->bindValue("idRenjaAnggaran", $idRenjaAnggaran);
            $statement->execute();
            $rekapProyeksi = $statement->fetchAll();

            return new JsonResponse($rekapProyeksi);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }

    private function getRkpdLampPermen231cSub1($request)
    {
        try {

            $jnsDok = $request->query->get("jns_dok");
            $idSatker = $request->query->get("id_satker");
            //$kdPrioritas = $request->query->get("prioritas");
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idSatker = pack('H*', str_replace('-', '', trim($idSatker)));
            $this->connection = $conn->getConnection();
            
            //print_r("ok");exit;

            $sql = "SELECT
                         renstra.`no_urut` AS renstra_no_urut,
                         renstra.`jns_dokumen` AS renstra_jns_dokumen,
                         renstra.`uraian` AS renstra_uraian,
                         renstra.`dasar_hukum` AS renstra_dasar_hukum,
                         renstra.`no_dokumen` AS renstra_no_dokumen,
                         if(renstra.`tgl_pengesahan` <> '0000-00-00', date_format(renstra.`tgl_pengesahan`,'%d-%m-%Y'), '') AS renstra_tgl_pengesahan,
                         IF(renstra.`status`='1', 'X', '') AS renstra_status_sdh,
                         IF(renstra.`status`='0', 'X', '') AS renstra_status_blm
                    FROM
                         `sikd_satker` sikd_satker      
                         INNER JOIN `renja_dok_rencana_skpd` renstra ON sikd_satker.`id_sikd_satker` = renstra.`sikd_satker_id`
                         LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON renstra.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                    WHERE
                         renstra.`jns_dokumen` = :jns_dok
                     AND if(renstra.`sikd_sub_skpd_id`<>'', renstra.`sikd_sub_skpd_id` = :id_satker, sikd_satker.`id_sikd_satker` = :id_satker)
                    ORDER BY
                         renstra.`no_urut`";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("jns_dok", $jnsDok);
            $statement->bindValue("id_satker", $idSatker);
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

    private function getRkpdLampPermen231dSub2($request)
    {
        try {

            //print_r("ok");exit;

            $idKgtn = $request->query->get("id_kgtn");
            //$tahun = $request->query->get("tahun");
            //$kdPrioritas = $request->query->get("prioritas");
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idKgtn = pack('H*', str_replace('-', '', trim($idKgtn)));
            $this->connection = $conn->getConnection();
            
            //print_r($jnsRkpd);exit;

            $sql = "SELECT
                        CONCAT_WS('-',
                         SUBSTR(HEX(renja_kegiatan_indikator.`id_renja_kegiatan_indikator`), 1, 8),
                         SUBSTR(HEX(renja_kegiatan_indikator.`id_renja_kegiatan_indikator`), 9, 4),
                         SUBSTR(HEX(renja_kegiatan_indikator.`id_renja_kegiatan_indikator`), 13, 4),
                         SUBSTR(HEX(renja_kegiatan_indikator.`id_renja_kegiatan_indikator`), 17, 4),
                         SUBSTR(HEX(renja_kegiatan_indikator.`id_renja_kegiatan_indikator`), 21)
                         ) AS renja_kegiatan_indikator_id_renja_kegiatan_indikator,
                        /*CONCAT_WS('-',
                         SUBSTR(HEX(renja_kegiatan_indikator.`renja_blnj_langsung_id`), 1, 8),
                         SUBSTR(HEX(renja_kegiatan_indikator.`renja_blnj_langsung_id`), 9, 4),
                         SUBSTR(HEX(renja_kegiatan_indikator.`renja_blnj_langsung_id`), 13, 4),
                         SUBSTR(HEX(renja_kegiatan_indikator.`renja_blnj_langsung_id`), 17, 4),
                         SUBSTR(HEX(renja_kegiatan_indikator.`renja_blnj_langsung_id`), 21)
                         ) AS renja_kegiatan_indikator_renja_kegiatan_id,*/
                        CONCAT_WS('-',
                         SUBSTR(HEX(renja_kegiatan_indikator.`renja_belanja_id`), 1, 8),
                         SUBSTR(HEX(renja_kegiatan_indikator.`renja_belanja_id`), 9, 4),
                         SUBSTR(HEX(renja_kegiatan_indikator.`renja_belanja_id`), 13, 4),
                         SUBSTR(HEX(renja_kegiatan_indikator.`renja_belanja_id`), 17, 4),
                         SUBSTR(HEX(renja_kegiatan_indikator.`renja_belanja_id`), 21)
                         ) AS renja_kegiatan_indikator_renja_kegiatan_id,
                        CONCAT_WS('-',
                         SUBSTR(HEX(renja_kegiatan_indikator.`sikd_klpk_indikator_id`), 1, 8),
                         SUBSTR(HEX(renja_kegiatan_indikator.`sikd_klpk_indikator_id`), 9, 4),
                         SUBSTR(HEX(renja_kegiatan_indikator.`sikd_klpk_indikator_id`), 13, 4),
                         SUBSTR(HEX(renja_kegiatan_indikator.`sikd_klpk_indikator_id`), 17, 4),
                         SUBSTR(HEX(renja_kegiatan_indikator.`sikd_klpk_indikator_id`), 21)
                         ) AS sikd_klpk_indikator_id,
                         renja_kegiatan_indikator.`no_indikator` AS renja_kegiatan_indikator_no_indikator,
                         renja_kegiatan_indikator.`uraian_indikator` AS renja_kegiatan_indikator_uraian_indikator,
                         renja_kegiatan_indikator.`satuan` AS renja_kegiatan_indikator_satuan,
                         renja_kegiatan_indikator.`target_thn_ini` AS renja_kegiatan_indikator_target_thn_ini
                    FROM
                         `renja_kegiatan_indikator` renja_kegiatan_indikator
                    WHERE
                         -- renja_kegiatan_indikator.`renja_blnj_langsung_id` = :idKgtn
                         renja_kegiatan_indikator.`renja_belanja_id` = :idKgtn
                    ORDER BY
                         renja_kegiatan_indikator.`no_indikator`
                    ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("idKgtn", $idKgtn);
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

    private function getRkpdLampPermen231dModSub2($request)
    {
        try {

          //print_r("ok");exit;

            $idKgtn = $request->query->get("id_kgtn");
            $nmIndktr = $request->query->get("nm_indktr");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            
            $this->connection = $conn->getConnection();
            $idKgtn = pack('H*', str_replace('-', '', trim($idKgtn)));
            //$idSatker = pack('H*', str_replace('-', '', trim($idSatker)));
           
            $sql = "SELECT
                        CONCAT_WS('-',
                         SUBSTR(HEX(renja_kegiatan_indikator.`id_renja_kegiatan_indikator`), 1, 8),
                         SUBSTR(HEX(renja_kegiatan_indikator.`id_renja_kegiatan_indikator`), 9, 4),
                         SUBSTR(HEX(renja_kegiatan_indikator.`id_renja_kegiatan_indikator`), 13, 4),
                         SUBSTR(HEX(renja_kegiatan_indikator.`id_renja_kegiatan_indikator`), 17, 4),
                         SUBSTR(HEX(renja_kegiatan_indikator.`id_renja_kegiatan_indikator`), 21)
                         ) AS renja_kegiatan_indikator_id_renja_kegiatan_indikator,
                        /*CONCAT_WS('-',
                         SUBSTR(HEX(renja_kegiatan_indikator.`renja_blnj_langsung_id`), 1, 8),
                         SUBSTR(HEX(renja_kegiatan_indikator.`renja_blnj_langsung_id`), 9, 4),
                         SUBSTR(HEX(renja_kegiatan_indikator.`renja_blnj_langsung_id`), 13, 4),
                         SUBSTR(HEX(renja_kegiatan_indikator.`renja_blnj_langsung_id`), 17, 4),
                         SUBSTR(HEX(renja_kegiatan_indikator.`renja_blnj_langsung_id`), 21)
                         ) AS renja_kegiatan_indikator_renja_kegiatan_id,*/
                        CONCAT_WS('-',
                         SUBSTR(HEX(renja_kegiatan_indikator.`renja_belanja_id`), 1, 8),
                         SUBSTR(HEX(renja_kegiatan_indikator.`renja_belanja_id`), 9, 4),
                         SUBSTR(HEX(renja_kegiatan_indikator.`renja_belanja_id`), 13, 4),
                         SUBSTR(HEX(renja_kegiatan_indikator.`renja_belanja_id`), 17, 4),
                         SUBSTR(HEX(renja_kegiatan_indikator.`renja_belanja_id`), 21)
                         ) AS renja_kegiatan_indikator_renja_kegiatan_id,
                         sikd_klpk_indikator.`kd_klpk_indikator` AS sikd_klpk_indikator_kd_klpk_indikator,
                         sikd_klpk_indikator.`nm_klpk_indikator` AS sikd_klpk_indikator_nm_klpk_indikator,
                         renja_kegiatan_indikator.`no_indikator` AS renja_kegiatan_indikator_no_indikator,
                         renja_kegiatan_indikator.`uraian_indikator` AS renja_kegiatan_indikator_uraian_indikator,
                         concat(renja_kegiatan_indikator.`target_thn_ini`, ' ', renja_kegiatan_indikator.`satuan`) AS renja_kegiatan_indikator_target_thn_ini
                    FROM
                         `sikd_klpk_indikator` sikd_klpk_indikator 
                          INNER JOIN `renja_kegiatan_indikator` renja_kegiatan_indikator ON sikd_klpk_indikator.`id_sikd_klpk_indikator` = renja_kegiatan_indikator.`sikd_klpk_indikator_id`
                    WHERE
                         -- renja_kegiatan_indikator.`renja_blnj_langsung_id` = :id_kgtn
                        renja_kegiatan_indikator.`renja_belanja_id` = :id_kgtn
                     and sikd_klpk_indikator.`nm_klpk_indikator` = :nm_indktr
                    ORDER BY
                         sikd_klpk_indikator.`kd_klpk_indikator`,
                         renja_kegiatan_indikator.`no_indikator`";

                     //and sikd_klpk_indikator.`nm_klpk_indikator` = $P{NM_INDKTR}
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_kgtn", $idKgtn);
            $statement->bindValue("nm_indktr", $nmIndktr);
            //$statement->bindValue("idSatker", $idSatker);
            
            $statement->execute();
            $rekapProyeksi = $statement->fetchAll();

            return new JsonResponse($rekapProyeksi);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }

    private function getRkpdLampPermen231dMod2Sub2($request)
    {
        try {

          //print_r("ok");exit;

            $idKgtn = $request->query->get("id_kgtn");
            //$idSatker = $request->query->get("sikd_satker_id");

            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            
            $this->connection = $conn->getConnection();
            $idKgtn = pack('H*', str_replace('-', '', trim($idKgtn)));
            //$idSatker = pack('H*', str_replace('-', '', trim($idSatker)));
           
            $sql = "SELECT
                    CONCAT_WS('-',
                         SUBSTR(HEX(renja_kegiatan_indikator.`id_renja_kegiatan_indikator`), 1, 8),
                         SUBSTR(HEX(renja_kegiatan_indikator.`id_renja_kegiatan_indikator`), 9, 4),
                         SUBSTR(HEX(renja_kegiatan_indikator.`id_renja_kegiatan_indikator`), 13, 4),
                         SUBSTR(HEX(renja_kegiatan_indikator.`id_renja_kegiatan_indikator`), 17, 4),
                         SUBSTR(HEX(renja_kegiatan_indikator.`id_renja_kegiatan_indikator`), 21)
                            ) AS renja_kegiatan_indikator_id_renja_kegiatan_indikator,
                     /*CONCAT_WS('-',
                         SUBSTR(HEX(renja_kegiatan_indikator.`renja_blnj_langsung_id`), 1, 8),
                         SUBSTR(HEX(renja_kegiatan_indikator.`renja_blnj_langsung_id`), 9, 4),
                         SUBSTR(HEX(renja_kegiatan_indikator.`renja_blnj_langsung_id`), 13, 4),
                         SUBSTR(HEX(renja_kegiatan_indikator.`renja_blnj_langsung_id`), 17, 4),
                         SUBSTR(HEX(renja_kegiatan_indikator.`renja_blnj_langsung_id`), 21)
                            ) AS renja_kegiatan_indikator_renja_kegiatan_id,*/
                    CONCAT_WS('-',
                         SUBSTR(HEX(renja_kegiatan_indikator.`renja_belanja_id`), 1, 8),
                         SUBSTR(HEX(renja_kegiatan_indikator.`renja_belanja_id`), 9, 4),
                         SUBSTR(HEX(renja_kegiatan_indikator.`renja_belanja_id`), 13, 4),
                         SUBSTR(HEX(renja_kegiatan_indikator.`renja_belanja_id`), 17, 4),
                         SUBSTR(HEX(renja_kegiatan_indikator.`renja_belanja_id`), 21)
                            ) AS renja_kegiatan_indikator_renja_kegiatan_id,
                     sikd_klpk_indikator.`kd_klpk_indikator` AS sikd_klpk_indikator_kd_klpk_indikator,
                     sikd_klpk_indikator.`nm_klpk_indikator` AS sikd_klpk_indikator_nm_klpk_indikator,
                     renja_kegiatan_indikator.`no_indikator` AS renja_kegiatan_indikator_no_indikator,
                     renja_kegiatan_indikator.`uraian_indikator` AS renja_kegiatan_indikator_uraian_indikator,
                     renja_kegiatan_indikator.`satuan` AS renja_kegiatan_indikator_satuan,
                     concat(renja_kegiatan_indikator.`target_thn_ini`,' ',renja_kegiatan_indikator.`satuan`) AS renja_kegiatan_indikator_target_thn_ini
                FROM
                     `sikd_klpk_indikator` sikd_klpk_indikator INNER JOIN `renja_kegiatan_indikator` renja_kegiatan_indikator ON sikd_klpk_indikator.`id_sikd_klpk_indikator` = renja_kegiatan_indikator.`sikd_klpk_indikator_id`
                WHERE
                     -- renja_kegiatan_indikator.`renja_blnj_langsung_id` = :id_kgtn
                    renja_kegiatan_indikator.`renja_belanja_id` = :id_kgtn
                    AND sikd_klpk_indikator.kd_klpk_indikator = '03' 
                ORDER BY
                     sikd_klpk_indikator.`kd_klpk_indikator`,
                     renja_kegiatan_indikator.`no_indikator`";

                     //and sikd_klpk_indikator.`nm_klpk_indikator` = $P{NM_INDKTR}
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_kgtn", $idKgtn);
            //$statement->bindValue("idSatker", $idSatker);
            
            $statement->execute();
            $rekapProyeksi = $statement->fetchAll();

            return new JsonResponse($rekapProyeksi);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }

    private function getRkpdLampPermen231eSub2($request)
    {
        try {

            //print_r("ok");exit;

            $idKgtn = $request->query->get("id_kgtn");
            //$tahun = $request->query->get("tahun");
            //$kdPrioritas = $request->query->get("prioritas");
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idKgtn = pack('H*', str_replace('-', '', trim($idKgtn)));
            $this->connection = $conn->getConnection();
            
            //print_r($jnsRkpd);exit;

            $sql = "SELECT
                        CONCAT_WS('-',
                         SUBSTR(HEX(renja_kegiatan_indikator.`id_renja_kegiatan_indikator`), 1, 8),
                         SUBSTR(HEX(renja_kegiatan_indikator.`id_renja_kegiatan_indikator`), 9, 4),
                         SUBSTR(HEX(renja_kegiatan_indikator.`id_renja_kegiatan_indikator`), 13, 4),
                         SUBSTR(HEX(renja_kegiatan_indikator.`id_renja_kegiatan_indikator`), 17, 4),
                         SUBSTR(HEX(renja_kegiatan_indikator.`id_renja_kegiatan_indikator`), 21)
                         ) AS renja_kegiatan_indikator_id_renja_kegiatan_indikator,
                        /*CONCAT_WS('-',
                         SUBSTR(HEX(renja_kegiatan_indikator.`renja_blnj_langsung_id`), 1, 8),
                         SUBSTR(HEX(renja_kegiatan_indikator.`renja_blnj_langsung_id`), 9, 4),
                         SUBSTR(HEX(renja_kegiatan_indikator.`renja_blnj_langsung_id`), 13, 4),
                         SUBSTR(HEX(renja_kegiatan_indikator.`renja_blnj_langsung_id`), 17, 4),
                         SUBSTR(HEX(renja_kegiatan_indikator.`renja_blnj_langsung_id`), 21)
                         ) AS renja_kegiatan_indikator_renja_kegiatan_id,*/
                        CONCAT_WS('-',
                         SUBSTR(HEX(renja_kegiatan_indikator.`renja_belanja_id`), 1, 8),
                         SUBSTR(HEX(renja_kegiatan_indikator.`renja_belanja_id`), 9, 4),
                         SUBSTR(HEX(renja_kegiatan_indikator.`renja_belanja_id`), 13, 4),
                         SUBSTR(HEX(renja_kegiatan_indikator.`renja_belanja_id`), 17, 4),
                         SUBSTR(HEX(renja_kegiatan_indikator.`renja_belanja_id`), 21)
                         ) AS renja_kegiatan_indikator_renja_kegiatan_id,
                        CONCAT_WS('-',
                         SUBSTR(HEX(renja_kegiatan_indikator.`sikd_klpk_indikator_id`), 1, 8),
                         SUBSTR(HEX(renja_kegiatan_indikator.`sikd_klpk_indikator_id`), 9, 4),
                         SUBSTR(HEX(renja_kegiatan_indikator.`sikd_klpk_indikator_id`), 13, 4),
                         SUBSTR(HEX(renja_kegiatan_indikator.`sikd_klpk_indikator_id`), 17, 4),
                         SUBSTR(HEX(renja_kegiatan_indikator.`sikd_klpk_indikator_id`), 21)
                         ) AS sikd_klpk_indikator_id,
                         renja_kegiatan_indikator.`no_indikator` AS renja_kegiatan_indikator_no_indikator,
                         renja_kegiatan_indikator.`uraian_indikator` AS renja_kegiatan_indikator_uraian_indikator,
                         renja_kegiatan_indikator.`satuan` AS renja_kegiatan_indikator_satuan,
                         renja_kegiatan_indikator.`target_renstra` AS renja_kegiatan_indikator_target_renstra,
                         renja_kegiatan_indikator.`target_thn_ini` AS renja_kegiatan_indikator_target_thn_ini,
                         renja_kegiatan_indikator.`realisasi_sd_thn_lalu` AS renja_kegiatan_indikator_realisasi_sd_thn_lalu,
                         renja_kegiatan_indikator.`realisasi_tw2` AS renja_kegiatan_indikator_realisasi_tw2
                    FROM
                          `renja_kegiatan_indikator` renja_kegiatan_indikator
                    WHERE
                         -- renja_kegiatan_indikator.`renja_blnj_langsung_id` = :id_kgtn
                         renja_kegiatan_indikator.`renja_belanja_id` = :id_kgtn
                    ORDER BY
                         renja_kegiatan_indikator.`no_indikator` ASC
                    ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_kgtn", $idKgtn);
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

    private function getRkpdLampPermen232bSub2($request)
    {
        try {

            //print_r("ok");exit;

            $idKgtn = $request->query->get("id_kgtn");
            //$tahun = $request->query->get("tahun");
            //$kdPrioritas = $request->query->get("prioritas");
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $idKgtn = pack('H*', str_replace('-', '', trim($idKgtn)));
            $this->connection = $conn->getConnection();
            
            //print_r($jnsRkpd);exit;

            $sql = "SELECT
                      CONCAT_WS('-',
                       SUBSTR(HEX(renja_kegiatan_indikator.`id_renja_kegiatan_indikator`), 1, 8),
                       SUBSTR(HEX(renja_kegiatan_indikator.`id_renja_kegiatan_indikator`), 9, 4),
                       SUBSTR(HEX(renja_kegiatan_indikator.`id_renja_kegiatan_indikator`), 13, 4),
                       SUBSTR(HEX(renja_kegiatan_indikator.`id_renja_kegiatan_indikator`), 17, 4),
                       SUBSTR(HEX(renja_kegiatan_indikator.`id_renja_kegiatan_indikator`), 21)
                         ) AS renja_kegiatan_indikator_id_renja_kegiatan_indikator,
                      /*CONCAT_WS('-',
                       SUBSTR(HEX(renja_kegiatan_indikator.`renja_blnj_langsung_id`), 1, 8),
                       SUBSTR(HEX(renja_kegiatan_indikator.`renja_blnj_langsung_id`), 9, 4),
                       SUBSTR(HEX(renja_kegiatan_indikator.`renja_blnj_langsung_id`), 13, 4),
                       SUBSTR(HEX(renja_kegiatan_indikator.`renja_blnj_langsung_id`), 17, 4),
                       SUBSTR(HEX(renja_kegiatan_indikator.`renja_blnj_langsung_id`), 21)
                         ) AS renja_kegiatan_indikator_renja_kegiatan_id,*/
                      CONCAT_WS('-',
                       SUBSTR(HEX(renja_kegiatan_indikator.`renja_belanja_id`), 1, 8),
                       SUBSTR(HEX(renja_kegiatan_indikator.`renja_belanja_id`), 9, 4),
                       SUBSTR(HEX(renja_kegiatan_indikator.`renja_belanja_id`), 13, 4),
                       SUBSTR(HEX(renja_kegiatan_indikator.`renja_belanja_id`), 17, 4),
                       SUBSTR(HEX(renja_kegiatan_indikator.`renja_belanja_id`), 21)
                         ) AS renja_kegiatan_indikator_renja_kegiatan_id,
                      CONCAT_WS('-',
                         SUBSTR(HEX(renja_kegiatan_indikator.`sikd_klpk_indikator_id`), 1, 8),
                         SUBSTR(HEX(renja_kegiatan_indikator.`sikd_klpk_indikator_id`), 9, 4),
                         SUBSTR(HEX(renja_kegiatan_indikator.`sikd_klpk_indikator_id`), 13, 4),
                         SUBSTR(HEX(renja_kegiatan_indikator.`sikd_klpk_indikator_id`), 17, 4),
                         SUBSTR(HEX(renja_kegiatan_indikator.`sikd_klpk_indikator_id`), 21)
                         ) AS sikd_klpk_indikator_id,
                       renja_kegiatan_indikator.`no_indikator` AS renja_kegiatan_indikator_no_indikator,
                       renja_kegiatan_indikator.`uraian_indikator` AS renja_kegiatan_indikator_uraian_indikator,
                       renja_kegiatan_indikator.`satuan` AS renja_kegiatan_indikator_satuan,
                       renja_kegiatan_indikator.`target_thn_ini` AS renja_kegiatan_indikator_target_thn_ini,
                       renja_kegiatan_indikator.`target_renstra` AS renja_kegiatan_indikator_target_renstra,
                       renja_kegiatan_indikator.`target_thn_dpn` AS renja_kegiatan_indikator_target_thn_dpn,
                       renja_kegiatan_indikator.`realisasi_sd_thn_lalu` AS renja_kegiatan_indikator_realisasi_sd_thn_lalu,
                       renja_kegiatan_indikator.`realisasi_tw1` AS renja_kegiatan_indikator_realisasi_tw1,
                       renja_kegiatan_indikator.`realisasi_tw2` AS renja_kegiatan_indikator_realisasi_tw2,
                       renja_kegiatan_indikator.`realisasi_tw3` AS renja_kegiatan_indikator_realisasi_tw3,
                       renja_kegiatan_indikator.`realisasi_tw4` AS renja_kegiatan_indikator_realisasi_tw4,
                       (renja_kegiatan_indikator.`realisasi_tw1` + renja_kegiatan_indikator.`realisasi_tw2` +
                       renja_kegiatan_indikator.`realisasi_tw3` + renja_kegiatan_indikator.`realisasi_tw4`) AS ttl_realisasi
                  FROM
                       `renja_kegiatan_indikator` renja_kegiatan_indikator
                  WHERE
                     -- renja_kegiatan_indikator.`renja_blnj_langsung_id` = :id_kgtn
                     renja_kegiatan_indikator.`renja_belanja_id` = :id_kgtn
                  ORDER BY
                       renja_kegiatan_indikator.`no_indikator` ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_kgtn", $idKgtn);
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
}
