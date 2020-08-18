<?php
namespace App\Controller\Rpjmd;

use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Delete;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * @RouteResource("rpjmdreport")
 */
class RpjmdReportController extends \App\Controller\ApiBaseController
{
    //protected $dbalConnName = 'simral_rpjmd';   
    
    public function cgetAction(Request $request)
    {
        $rpt = $request->query->get("jns_report");
        
        switch ($rpt) {
            case "visi_misi":
                $id_rpjmd = $request->query->get("id_rpjmd");
                return $this->getRpjmdVisiMisi($id_rpjmd);
            case "strategi_arah_kbjkn" :
                $id_rpjmd = $request->query->get("id_rpjmd");
                return $this->getRpjmdStrategiArahKbjkn($id_rpjmd);
            case "kbjkn_program":
                $id_rpjmd = $request->query->get("id_rpjmd");
                return $this->getRpjmdKbjknProgram($id_rpjmd);
            case "kbjkn_program_sub1":
                $id_sasaran = $request->query->get("id_sasaran");
                return $this->getRpjmdKbjknProgramSub1($id_sasaran);
            case "kbjkn_program_sub2":
                $id_sasaran = $request->query->get("id_sasaran");
                return $this->getRpjmdKbjknProgramSub2($id_sasaran);
            case "kbjkn_program_sub3":
                $id_sasaran = $request->query->get("id_sasaran");
                $tahun = $request->query->get("tahun");
                return $this->getRpjmdKbjknProgramSub3($id_sasaran, $tahun);
            case "kbjkn_program_sub4":
                return $this->getRpjmdKbjknProgramSub4($request);
            case "indikasi_program":
                $id_rpjmd = $request->query->get("id_rpjmd");
                return $this->getRpjmdIndikasiProgram($id_rpjmd);
            case "indikasi_program_sub":
                $id_program = $request->query->get("id_program");
                return $this->getRpjmdIndikasiProgramSub($id_program);
            case "indikator_kinerja":
                return $this->getRpjmdIndikatorKinerja();
            case "kemampuan_keuangan":
                return $this->getRpjmdKemampuanKeuangan();
            case "proyeksi_anggaran":
                return $this->getRpjmdProyeksiAnggaran();
            default:
                throw new BadRequestHttpException("Undefined report");
        }
    }
    
    private function getRpjmdVisiMisi($id_rpjmd)
    {
        try {
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $id_rpjmd = $this->convertOuuidToUuid($id_rpjmd);
            $this->connection = $conn->getConnection();

            $sql = 'SELECT
                     rpjmd_rpjmd.`no_perda` AS no_perda,
                     rpjmd_rpjmd.`periode` AS periode,
                     DATE_FORMAT(rpjmd_rpjmd.`tgl_perda`, "%d-%m-%Y") AS tgl_perda,
                     rpjmd_visi.`uraian_visi` AS uraian_visi,
                     CONCAT_WS("-",
                        SUBSTR(HEX(rpjmd_misi.`id_rpjmd_misi`), 1, 8),
                        SUBSTR(HEX(rpjmd_misi.`id_rpjmd_misi`), 9, 4),
                        SUBSTR(HEX(rpjmd_misi.`id_rpjmd_misi`), 13, 4),
                        SUBSTR(HEX(rpjmd_misi.`id_rpjmd_misi`), 17, 4),
                        SUBSTR(HEX(rpjmd_misi.`id_rpjmd_misi`), 21)
                      ) AS id_rpjmd_misi,
                     rpjmd_misi.`no_misi` AS no_misi,
                     rpjmd_misi.`uraian_misi` AS uraian_misi,
                     CONCAT_WS("-",
                        SUBSTR(HEX(rpjmd_tujuan.`id_rpjmd_tujuan`), 1, 8),
                        SUBSTR(HEX(rpjmd_tujuan.`id_rpjmd_tujuan`), 9, 4),
                        SUBSTR(HEX(rpjmd_tujuan.`id_rpjmd_tujuan`), 13, 4),
                        SUBSTR(HEX(rpjmd_tujuan.`id_rpjmd_tujuan`), 17, 4),
                        SUBSTR(HEX(rpjmd_tujuan.`id_rpjmd_tujuan`), 21)
                      ) AS id_rpjmd_tujuan,
                     rpjmd_tujuan.`kd_tujuan` AS kd_tujuan,
                     rpjmd_tujuan.`uraian_tujuan` AS uraian_tujuan,
                     CONCAT_WS("-",
                        SUBSTR(HEX(rpjmd_sasaran.`id_rpjmd_sasaran`), 1, 8),
                        SUBSTR(HEX(rpjmd_sasaran.`id_rpjmd_sasaran`), 9, 4),
                        SUBSTR(HEX(rpjmd_sasaran.`id_rpjmd_sasaran`), 13, 4),
                        SUBSTR(HEX(rpjmd_sasaran.`id_rpjmd_sasaran`), 17, 4),
                        SUBSTR(HEX(rpjmd_sasaran.`id_rpjmd_sasaran`), 21)
                      ) AS id_rpjmd_sasaran,
                     rpjmd_sasaran.`kd_sasaran` AS kd_sasaran,
                     rpjmd_sasaran.`uraian_sasaran` AS uraian_sasaran
                FROM
                     `rpjmd_rpjmd` rpjmd_rpjmd
                     INNER JOIN `rpjmd_visi` rpjmd_visi ON rpjmd_rpjmd.`id_rpjmd_rpjmd` = rpjmd_visi.`rpjmd_rpjmd_id`
                     INNER JOIN `rpjmd_misi` rpjmd_misi ON rpjmd_rpjmd.`id_rpjmd_rpjmd` = rpjmd_misi.`rpjmd_rpjmd_id`
                     LEFT OUTER JOIN `rpjmd_tujuan` rpjmd_tujuan ON rpjmd_misi.`id_rpjmd_misi` = rpjmd_tujuan.`rpjmd_misi_id`
                     LEFT OUTER JOIN `rpjmd_sasaran` rpjmd_sasaran ON rpjmd_tujuan.`id_rpjmd_tujuan` = rpjmd_sasaran.`rpjmd_tujuan_id`
                WHERE
                     rpjmd_rpjmd.`id_rpjmd_rpjmd` = :id_rpjmd
                GROUP BY
                     rpjmd_misi.`id_rpjmd_misi`,
                     rpjmd_tujuan.`id_rpjmd_tujuan`,
                     rpjmd_sasaran.`id_rpjmd_sasaran`
                ORDER BY
                     rpjmd_misi.`no_misi` ASC,
                     rpjmd_tujuan.`no_tujuan` ASC,
                     rpjmd_sasaran.`no_sasaran` ASC';
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rpjmd", $id_rpjmd);
            $statement->execute();
            $visis = $statement->fetchAll();
            return new JsonResponse($visis);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getRpjmdStrategiArahKbjkn($id_rpjmd)
    {
        $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
        $id_rpjmd = $this->convertOuuidToUuid($id_rpjmd);
        $this->connection = $conn->getConnection();

        $sql = "SELECT
                     rpjmd_rpjmd.no_perda AS no_perda,
                     rpjmd_rpjmd.periode AS periode,
                     DATE_FORMAT(rpjmd_rpjmd.tgl_perda,'%d-%m-%Y')AS tgl_perda,
                     CONCAT_WS('-',
                        SUBSTR(HEX(rpjmd_visi.`id_rpjmd_visi`), 1, 8),
                        SUBSTR(HEX(rpjmd_visi.`id_rpjmd_visi`), 9, 4),
                        SUBSTR(HEX(rpjmd_visi.`id_rpjmd_visi`), 13, 4),
                        SUBSTR(HEX(rpjmd_visi.`id_rpjmd_visi`), 17, 4),
                        SUBSTR(HEX(rpjmd_visi.`id_rpjmd_visi`), 21)
                      ) AS id_rpjmd_visi,
                     rpjmd_visi.uraian_visi AS uraian_visi,
                     CONCAT_WS('-',
                        SUBSTR(HEX(rpjmd_misi.id_rpjmd_misi), 1, 8),
                        SUBSTR(HEX(rpjmd_misi.id_rpjmd_misi), 9, 4),
                        SUBSTR(HEX(rpjmd_misi.id_rpjmd_misi), 13, 4),
                        SUBSTR(HEX(rpjmd_misi.id_rpjmd_misi), 17, 4),
                        SUBSTR(HEX(rpjmd_misi.id_rpjmd_misi), 21)
                      ) AS id_rpjmd_misi,
                     rpjmd_misi.no_misi AS no_misi,
                     rpjmd_misi.uraian_misi AS uraian_misi,
                     CONCAT_WS('-',
                        SUBSTR(HEX(rpjmd_tujuan.id_rpjmd_tujuan), 1, 8),
                        SUBSTR(HEX(rpjmd_tujuan.id_rpjmd_tujuan), 9, 4),
                        SUBSTR(HEX(rpjmd_tujuan.id_rpjmd_tujuan), 13, 4),
                        SUBSTR(HEX(rpjmd_tujuan.id_rpjmd_tujuan), 17, 4),
                        SUBSTR(HEX(rpjmd_tujuan.id_rpjmd_tujuan), 21)
                      ) AS id_rpjmd_tujuan,
                     rpjmd_tujuan.kd_tujuan AS kd_tujuan,
                     rpjmd_tujuan.uraian_tujuan AS uraian_tujuan,
                     CONCAT_WS('-',
                        SUBSTR(HEX(rpjmd_sasaran.id_rpjmd_sasaran), 1, 8),
                        SUBSTR(HEX(rpjmd_sasaran.id_rpjmd_sasaran), 9, 4),
                        SUBSTR(HEX(rpjmd_sasaran.id_rpjmd_sasaran), 13, 4),
                        SUBSTR(HEX(rpjmd_sasaran.id_rpjmd_sasaran), 17, 4),
                        SUBSTR(HEX(rpjmd_sasaran.id_rpjmd_sasaran), 21)
                      ) AS id_rpjmd_sasaran,
                     rpjmd_sasaran.kd_sasaran AS kd_sasaran,
                     rpjmd_sasaran.uraian_sasaran AS uraian_sasaran,
                     CONCAT_WS('-',
                        SUBSTR(HEX(rpjmd_strategi.id_rpjmd_strategi), 1, 8),
                        SUBSTR(HEX(rpjmd_strategi.id_rpjmd_strategi), 9, 4),
                        SUBSTR(HEX(rpjmd_strategi.id_rpjmd_strategi), 13, 4),
                        SUBSTR(HEX(rpjmd_strategi.id_rpjmd_strategi), 17, 4),
                        SUBSTR(HEX(rpjmd_strategi.id_rpjmd_strategi), 21)
                      ) AS id_rpjmd_strategi,
                     rpjmd_strategi.kd_strategi AS kd_strategi,
                     rpjmd_strategi.uraian_strategi AS uraian_strategi,
                     CONCAT_WS('-',
                        SUBSTR(HEX(rpjmd_arah_kebijakan.id_rpjmd_arah_kebijakan), 1, 8),
                        SUBSTR(HEX(rpjmd_arah_kebijakan.id_rpjmd_arah_kebijakan), 9, 4),
                        SUBSTR(HEX(rpjmd_arah_kebijakan.id_rpjmd_arah_kebijakan), 13, 4),
                        SUBSTR(HEX(rpjmd_arah_kebijakan.id_rpjmd_arah_kebijakan), 17, 4),
                        SUBSTR(HEX(rpjmd_arah_kebijakan.id_rpjmd_arah_kebijakan), 21)
                      ) AS id_rpjmd_arah_kebijakan,
                     rpjmd_arah_kebijakan.kd_arah_kebijakan AS kd_arah_kebijakan,
                     rpjmd_arah_kebijakan.uraian_arah_kebijakan AS uraian_arah_kebijakan
                FROM
                     rpjmd_rpjmd rpjmd_rpjmd
                     INNER JOIN rpjmd_visi rpjmd_visi ON rpjmd_rpjmd.id_rpjmd_rpjmd = rpjmd_visi.rpjmd_rpjmd_id
                     INNER JOIN rpjmd_misi rpjmd_misi ON rpjmd_visi.rpjmd_rpjmd_id = rpjmd_misi.rpjmd_rpjmd_id
                     INNER JOIN rpjmd_tujuan rpjmd_tujuan ON rpjmd_misi.id_rpjmd_misi = rpjmd_tujuan.rpjmd_misi_id
                     LEFT OUTER JOIN rpjmd_sasaran rpjmd_sasaran ON rpjmd_tujuan.id_rpjmd_tujuan = rpjmd_sasaran.rpjmd_tujuan_id
                     LEFT OUTER JOIN rpjmd_rumusan_strategi rpjmd_rumusan_strategi ON rpjmd_sasaran.id_rpjmd_sasaran = rpjmd_rumusan_strategi.rpjmd_sasaran_id
                     LEFT OUTER JOIN rpjmd_strategi rpjmd_strategi ON rpjmd_rumusan_strategi.rpjmd_strategi_id = rpjmd_strategi.id_rpjmd_strategi
                     LEFT OUTER JOIN rpjmd_rumusan_arah_kbjkn rpjmd_rumusan_arah_kbjkn ON rpjmd_strategi.id_rpjmd_strategi = rpjmd_rumusan_arah_kbjkn.rpjmd_strategi_id
                     LEFT OUTER JOIN rpjmd_arah_kebijakan rpjmd_arah_kebijakan ON rpjmd_rumusan_arah_kbjkn.rpjmd_arah_kebijakan_id = rpjmd_arah_kebijakan.id_rpjmd_arah_kebijakan
                WHERE
                     rpjmd_rpjmd.id_rpjmd_rpjmd = :id_rpjmd
                GROUP BY
                     rpjmd_misi.id_rpjmd_misi,
                     rpjmd_tujuan.id_rpjmd_tujuan,
                     rpjmd_sasaran.id_rpjmd_sasaran,
                     rpjmd_strategi.id_rpjmd_strategi,
                     rpjmd_arah_kebijakan.id_rpjmd_arah_kebijakan
                ORDER BY
                     rpjmd_misi.no_misi ASC,
                     rpjmd_tujuan.no_tujuan ASC,
                     rpjmd_sasaran.no_sasaran ASC,
                     rpjmd_strategi.no_strategi ASC,
                     rpjmd_arah_kebijakan.no_arah_kebijakan ASC";
        
        $statement = $this->connection->prepare($sql);
        $statement->bindValue("id_rpjmd", $id_rpjmd);
        $statement->execute();
        $rslt = $statement->fetchAll();
        
        return new JsonResponse($rslt);
    }
    
    private function getRpjmdKbjknProgram($id_rpjmd)
    {
        $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
        $id_rpjmd = $this->convertOuuidToUuid($id_rpjmd);
        $this->connection = $conn->getConnection();
        
        $sql = "SELECT
                     CONCAT_WS('-',
                        SUBSTR(HEX(rpjmd_rpjmd.id_rpjmd_rpjmd), 1, 8),
                        SUBSTR(HEX(rpjmd_rpjmd.id_rpjmd_rpjmd), 9, 4),
                        SUBSTR(HEX(rpjmd_rpjmd.id_rpjmd_rpjmd), 13, 4),
                        SUBSTR(HEX(rpjmd_rpjmd.id_rpjmd_rpjmd), 17, 4),
                        SUBSTR(HEX(rpjmd_rpjmd.id_rpjmd_rpjmd), 21)
                      ) AS rpjmd_rpjmd_id_rpjmd_rpjmd,
                     rpjmd_rpjmd.periode AS rpjmd_rpjmd_periode,
                     rpjmd_rpjmd.uraian_rpjmd AS rpjmd_rpjmd_uraian_rpjmd,
                     rpjmd_rpjmd.no_perda AS rpjmd_rpjmd_no_perda,
                     CONCAT_WS('-',
                        SUBSTR(HEX(rpjmd_sasaran.id_rpjmd_sasaran), 1, 8),
                        SUBSTR(HEX(rpjmd_sasaran.id_rpjmd_sasaran), 9, 4),
                        SUBSTR(HEX(rpjmd_sasaran.id_rpjmd_sasaran), 13, 4),
                        SUBSTR(HEX(rpjmd_sasaran.id_rpjmd_sasaran), 17, 4),
                        SUBSTR(HEX(rpjmd_sasaran.id_rpjmd_sasaran), 21)
                      ) AS rpjmd_sasaran_id_rpjmd_sasaran,
                     rpjmd_sasaran.no_sasaran AS rpjmd_sasaran_no_sasaran,
                     rpjmd_sasaran.kd_sasaran AS rpjmd_sasaran_kd_sasaran,
                     rpjmd_sasaran.uraian_sasaran AS rpjmd_sasaran_uraian_sasaran
                FROM
                     rpjmd_sasaran rpjmd_sasaran
                     INNER JOIN rpjmd_tujuan rpjmd_tujuan ON rpjmd_sasaran.rpjmd_tujuan_id = rpjmd_tujuan.id_rpjmd_tujuan
                     INNER JOIN rpjmd_misi rpjmd_misi ON rpjmd_tujuan.rpjmd_misi_id = rpjmd_misi.id_rpjmd_misi
                     INNER JOIN rpjmd_rpjmd rpjmd_rpjmd ON rpjmd_misi.rpjmd_rpjmd_id = rpjmd_rpjmd.id_rpjmd_rpjmd
                WHERE
                     rpjmd_rpjmd.id_rpjmd_rpjmd = :id_rpjmd
                ORDER BY
                     rpjmd_sasaran.kd_sasaran";
        
        $statement = $this->connection->prepare($sql);
        $statement->bindValue("id_rpjmd", $id_rpjmd);
        $statement->execute();
        $rslt = $statement->fetchAll();
        //$this->get("logger")->debug(print_r($rslt, 1));
        return new JsonResponse($rslt);
    }
    
    private function getRpjmdKbjknProgramSub1($id_sasaran)
    {
        $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
        $id_sasaran = $this->convertOuuidToUuid($id_sasaran);
        $this->connection = $conn->getConnection();
        
        $sql = "SELECT distinct
                     CONCAT_WS('-',
                        SUBSTR(HEX(rpjmd_rumusan_strategi.rpjmd_sasaran_id), 1, 8),
                        SUBSTR(HEX(rpjmd_rumusan_strategi.rpjmd_sasaran_id), 9, 4),
                        SUBSTR(HEX(rpjmd_rumusan_strategi.rpjmd_sasaran_id), 13, 4),
                        SUBSTR(HEX(rpjmd_rumusan_strategi.rpjmd_sasaran_id), 17, 4),
                        SUBSTR(HEX(rpjmd_rumusan_strategi.rpjmd_sasaran_id), 21)
                      ) AS rpjmd_rumusan_strategi_rpjmd_sasaran_id,
                     CONCAT_WS('-',
                        SUBSTR(HEX(rpjmd_arah_kebijakan.id_rpjmd_arah_kebijakan), 1, 8),
                        SUBSTR(HEX(rpjmd_arah_kebijakan.id_rpjmd_arah_kebijakan), 9, 4),
                        SUBSTR(HEX(rpjmd_arah_kebijakan.id_rpjmd_arah_kebijakan), 13, 4),
                        SUBSTR(HEX(rpjmd_arah_kebijakan.id_rpjmd_arah_kebijakan), 17, 4),
                        SUBSTR(HEX(rpjmd_arah_kebijakan.id_rpjmd_arah_kebijakan), 21)
                      ) AS rpjmd_arah_kebijakan_id_rpjmd_arah_kebijakan,
                     rpjmd_arah_kebijakan.no_arah_kebijakan AS rpjmd_arah_kebijakan_no_arah_kebijakan,
                     rpjmd_arah_kebijakan.kd_arah_kebijakan AS rpjmd_arah_kebijakan_kd_arah_kebijakan,
                     rpjmd_arah_kebijakan.uraian_arah_kebijakan AS rpjmd_arah_kebijakan_uraian_arah_kebijakan
                FROM
                     rpjmd_rumusan_arah_kbjkn rpjmd_rumusan_arah_kbjkn
                     INNER JOIN rpjmd_rumusan_strategi rpjmd_rumusan_strategi ON rpjmd_rumusan_arah_kbjkn.rpjmd_strategi_id = rpjmd_rumusan_strategi.rpjmd_strategi_id
                     INNER JOIN rpjmd_arah_kebijakan rpjmd_arah_kebijakan ON rpjmd_rumusan_arah_kbjkn.rpjmd_arah_kebijakan_id = rpjmd_arah_kebijakan.id_rpjmd_arah_kebijakan
                WHERE
                     rpjmd_rumusan_strategi.rpjmd_sasaran_id = :id_sasaran
                ORDER BY
                     rpjmd_arah_kebijakan.kd_arah_kebijakan";
        
        $statement = $this->connection->prepare($sql);
        $statement->bindValue("id_sasaran", $id_sasaran);
        $statement->execute();
        $rslt = $statement->fetchAll();
        return new JsonResponse($rslt);
    }
    
    private function getRpjmdKbjknProgramSub2($id_sasaran)
    {
        $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
        $id_sasaran = $this->convertOuuidToUuid($id_sasaran);
        $this->connection = $conn->getConnection();
        
        $sql = "SELECT
                     CONCAT_WS('-',
                        SUBSTR(HEX(rpjmd_indikator_sasaran.id_rpjmd_indikator_sasaran), 1, 8),
                        SUBSTR(HEX(rpjmd_indikator_sasaran.id_rpjmd_indikator_sasaran), 9, 4),
                        SUBSTR(HEX(rpjmd_indikator_sasaran.id_rpjmd_indikator_sasaran), 13, 4),
                        SUBSTR(HEX(rpjmd_indikator_sasaran.id_rpjmd_indikator_sasaran), 17, 4),
                        SUBSTR(HEX(rpjmd_indikator_sasaran.id_rpjmd_indikator_sasaran), 21)
                      ) AS rpjmd_indikator_sasaran_id_rpjmd_indikator_sasaran,
                     CONCAT_WS('-',
                        SUBSTR(HEX(rpjmd_indikator_sasaran.rpjmd_sasaran_id), 1, 8),
                        SUBSTR(HEX(rpjmd_indikator_sasaran.rpjmd_sasaran_id), 9, 4),
                        SUBSTR(HEX(rpjmd_indikator_sasaran.rpjmd_sasaran_id), 13, 4),
                        SUBSTR(HEX(rpjmd_indikator_sasaran.rpjmd_sasaran_id), 17, 4),
                        SUBSTR(HEX(rpjmd_indikator_sasaran.rpjmd_sasaran_id), 21)
                      ) AS rpjmd_indikator_sasaran_rpjmd_sasaran_id,
                     rpjmd_indikator_sasaran.no_indikator AS rpjmd_indikator_sasaran_no_indikator,
                     rpjmd_indikator_sasaran.uraian_indikator AS rpjmd_indikator_sasaran_uraian_indikator,
                     rpjmd_indikator_sasaran.satuan AS rpjmd_indikator_sasaran_satuan,
                     rpjmd_indikator_sasaran.rumusan_satuan AS rpjmd_indikator_sasaran_rumusan_satuan,
                     rpjmd_indikator_sasaran.capaian_awal AS rpjmd_indikator_sasaran_capaian_awal,
                     rpjmd_indikator_sasaran.kondisi_akhir AS rpjmd_indikator_sasaran_kondisi_akhir
                FROM
                     rpjmd_indikator_sasaran rpjmd_indikator_sasaran
                WHERE
                     rpjmd_indikator_sasaran.rpjmd_sasaran_id = :id_sasaran
                ORDER BY
                     rpjmd_indikator_sasaran.no_indikator ASC";
        
        $statement = $this->connection->prepare($sql);
        $statement->bindValue("id_sasaran", $id_sasaran);
        $statement->execute();
        $rslt = $statement->fetchAll();
        return new JsonResponse($rslt);
    }
    
    private function getRpjmdKbjknProgramSub3($id_sasaran, $tahun)
    {
        $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
        $id_sasaran = $this->convertOuuidToUuid($id_sasaran);
        $this->connection = $conn->getConnection();
        
        /*$sql = "SELECT
                     CONCAT_WS('-',
                        SUBSTR(HEX(rpjmd_program.id_rpjmd_program), 1, 8),
                        SUBSTR(HEX(rpjmd_program.id_rpjmd_program), 9, 4),
                        SUBSTR(HEX(rpjmd_program.id_rpjmd_program), 13, 4),
                        SUBSTR(HEX(rpjmd_program.id_rpjmd_program), 17, 4),
                        SUBSTR(HEX(rpjmd_program.id_rpjmd_program), 21)
                      ) AS rpjmd_program_id_rpjmd_program,
                     CONCAT_WS('-',
                        SUBSTR(HEX(rpjmd_program.rpjmd_sasaran_id), 1, 8),
                        SUBSTR(HEX(rpjmd_program.rpjmd_sasaran_id), 9, 4),
                        SUBSTR(HEX(rpjmd_program.rpjmd_sasaran_id), 13, 4),
                        SUBSTR(HEX(rpjmd_program.rpjmd_sasaran_id), 17, 4),
                        SUBSTR(HEX(rpjmd_program.rpjmd_sasaran_id), 21)
                      ) AS rpjmd_program_rpjmd_sasaran_id,
                     CONCAT_WS('-',
                        SUBSTR(HEX(rpjmd_program.sikd_bidang_id), 1, 8),
                        SUBSTR(HEX(rpjmd_program.sikd_bidang_id), 9, 4),
                        SUBSTR(HEX(rpjmd_program.sikd_bidang_id), 13, 4),
                        SUBSTR(HEX(rpjmd_program.sikd_bidang_id), 17, 4),
                        SUBSTR(HEX(rpjmd_program.sikd_bidang_id), 21)
                      ) AS rpjmd_program_sikd_bidang_id,
                     rpjmd_program.kd_program AS rpjmd_program_kd_program,
                     rpjmd_program.uraian_program AS rpjmd_program_uraian_program,
                     rpjmd_program.prioritas_program AS rpjmd_program_prioritas_program
                FROM
                    rpjmd_program
                WHERE
                     rpjmd_program.rpjmd_sasaran_id = :id_sasaran
                ORDER BY
                     rpjmd_program.kd_program";*/
        $sql = "SELECT
                     CONCAT_WS('-',
                        SUBSTR(HEX(rpjmd_program.`id_rpjmd_program`), 1, 8),
                        SUBSTR(HEX(rpjmd_program.`id_rpjmd_program`), 9, 4),
                        SUBSTR(HEX(rpjmd_program.`id_rpjmd_program`), 13, 4),
                        SUBSTR(HEX(rpjmd_program.`id_rpjmd_program`), 17, 4),
                        SUBSTR(HEX(rpjmd_program.`id_rpjmd_program`), 21)
                      ) AS rpjmd_program_id_rpjmd_program,
                     CONCAT_WS('-',
                        SUBSTR(HEX(rpjmd_program.`rpjmd_sasaran_id`), 1, 8),
                        SUBSTR(HEX(rpjmd_program.`rpjmd_sasaran_id`), 9, 4),
                        SUBSTR(HEX(rpjmd_program.`rpjmd_sasaran_id`), 13, 4),
                        SUBSTR(HEX(rpjmd_program.`rpjmd_sasaran_id`), 17, 4),
                        SUBSTR(HEX(rpjmd_program.`rpjmd_sasaran_id`), 21)
                      ) AS rpjmd_program_rpjmd_sasaran_id,
                     CONCAT_WS('-',
                        SUBSTR(HEX(rpjmd_program.`sikd_bidang_id`), 1, 8),
                        SUBSTR(HEX(rpjmd_program.`sikd_bidang_id`), 9, 4),
                        SUBSTR(HEX(rpjmd_program.`sikd_bidang_id`), 13, 4),
                        SUBSTR(HEX(rpjmd_program.`sikd_bidang_id`), 17, 4),
                        SUBSTR(HEX(rpjmd_program.`sikd_bidang_id`), 21)
                      ) AS rpjmd_program_sikd_bidang_id,
                     sikd_bidang.`kd_bidang` AS sikd_bidang_kd_bidang,
                     sikd_bidang.`nm_bidang` AS sikd_bidang_nm_bidang,
                     rpjmd_program.`kd_program` AS rpjmd_program_kd_program,
                     rpjmd_program.`uraian_program` AS rpjmd_program_uraian_program,
                     rpjmd_program.`prioritas_program` AS rpjmd_program_prioritas_program
                FROM
                     `sikd_bidang` sikd_bidang 
                     INNER JOIN `rpjmd_program` rpjmd_program ON sikd_bidang.`id_sikd_bidang` = rpjmd_program.`sikd_bidang_id`
                WHERE 
                     rpjmd_program.`rpjmd_sasaran_id` = :id_sasaran
                ORDER BY
                     rpjmd_program.`kd_program`";
        $statement = $this->connection->prepare($sql);
        $statement->bindValue("id_sasaran", $id_sasaran);
        $statement->execute();
        $rslt = $statement->fetchAll();        
        
        return new JsonResponse($rslt);
    }
    
    private function getRpjmdKbjknProgramSub4($request)
    {
        try {
            
            // printr("ok");exit;
            $id_program = $request->query->get("id_program");
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $id_program = $this->convertOuuidToUuid($id_program);
            $this->connection = $conn->getConnection();
            
            //print_r("ok");exit;
            
            $sql = "SELECT
                CONCAT_WS('-',
                        SUBSTR(HEX(rpjmd_pelaksana_program.`rpjmd_program_id`), 1, 8),
                        SUBSTR(HEX(rpjmd_pelaksana_program.`rpjmd_program_id`), 9, 4),
                        SUBSTR(HEX(rpjmd_pelaksana_program.`rpjmd_program_id`), 13, 4),
                        SUBSTR(HEX(rpjmd_pelaksana_program.`rpjmd_program_id`), 17, 4),
                        SUBSTR(HEX(rpjmd_pelaksana_program.`rpjmd_program_id`), 21)
                      ) AS rpjmd_pelaksana_program_rpjmd_program_id,
                 GROUP_CONCAT(DISTINCT sikd_satker.`singkatan` ORDER BY sikd_satker.`kode` DESC SEPARATOR ', ') nm_opd_pelaksana
                FROM
                     `sikd_satker` sikd_satker
                     INNER JOIN `rpjmd_pelaksana_program` rpjmd_pelaksana_program ON sikd_satker.`id_sikd_satker` = rpjmd_pelaksana_program.`sikd_satker_id`
                WHERE
                     rpjmd_pelaksana_program.`rpjmd_program_id` = :id_program
                GROUP BY
                     rpjmd_pelaksana_program.`rpjmd_program_id`
                    ";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_program", $id_program);
            $statement->execute();
            $rslt = $statement->fetchAll();    
            
            return new JsonResponse($rslt);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    private function getRpjmdIndikasiProgram($id_rpjmd) {
        try {
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $id_rpjmd = $this->convertOuuidToUuid($id_rpjmd);
            $this->connection = $conn->getConnection();
            
            /*$sql = "SELECT
                    CONCAT_WS('-',
                     SUBSTR(HEX(rpjmd_program.`id_rpjmd_program`), 1, 8),
                     SUBSTR(HEX(rpjmd_program.`id_rpjmd_program`), 9, 4),
                     SUBSTR(HEX(rpjmd_program.`id_rpjmd_program`), 13, 4),
                     SUBSTR(HEX(rpjmd_program.`id_rpjmd_program`), 17, 4),
                     SUBSTR(HEX(rpjmd_program.`id_rpjmd_program`), 21)
                     ) AS rpjmd_program_id_rpjmd_program,
                     rpjmd_program.`kd_program` AS rpjmd_program_kd_program,
                     rpjmd_program.`uraian_program` AS rpjmd_program_uraian_program,
                     rpjmd_program.`prioritas_program` AS rpjmd_program_prioritas_program,
                    CONCAT_WS('-',
                     SUBSTR(HEX(rpjmd_rpjmd.`id_rpjmd_rpjmd`), 1, 8),
                     SUBSTR(HEX(rpjmd_rpjmd.`id_rpjmd_rpjmd`), 9, 4),
                     SUBSTR(HEX(rpjmd_rpjmd.`id_rpjmd_rpjmd`), 13, 4),
                     SUBSTR(HEX(rpjmd_rpjmd.`id_rpjmd_rpjmd`), 17, 4),
                     SUBSTR(HEX(rpjmd_rpjmd.`id_rpjmd_rpjmd`), 21)
                     ) AS rpjmd_rpjmd_id_rpjmd_rpjmd,
                     rpjmd_rpjmd.`periode` AS rpjmd_rpjmd_periode,
                     SUM(IFNULL(rpjmd_pelaksana_program.jml_anggaran_tahun_1,0)) jml_anggaran_tahun_1,
                     SUM(IFNULL(rpjmd_pelaksana_program.jml_anggaran_tahun_2,0)) jml_anggaran_tahun_2,
                     SUM(IFNULL(rpjmd_pelaksana_program.jml_anggaran_tahun_3,0)) jml_anggaran_tahun_3,
                     SUM(IFNULL(rpjmd_pelaksana_program.jml_anggaran_tahun_4,0)) jml_anggaran_tahun_4,
                     SUM(IFNULL(rpjmd_pelaksana_program.jml_anggaran_tahun_5,0)) jml_anggaran_tahun_5,
                     SUM(IFNULL(rpjmd_pelaksana_program.jml_anggaran_tahun_6,0)) jml_anggaran_tahun_6,
                    CONCAT_WS('-',
                     SUBSTR(HEX(rpjmd_program.`sikd_bidang_id`), 1, 8),
                     SUBSTR(HEX(rpjmd_program.`sikd_bidang_id`), 9, 4),
                     SUBSTR(HEX(rpjmd_program.`sikd_bidang_id`), 13, 4),
                     SUBSTR(HEX(rpjmd_program.`sikd_bidang_id`), 17, 4),
                     SUBSTR(HEX(rpjmd_program.`sikd_bidang_id`), 21)
                     ) AS rpjmd_program_sikd_bidang_id,
                    CONCAT_WS('-',
                     SUBSTR(HEX(rpjmd_program.`sikd_prog_id`), 1, 8),
                     SUBSTR(HEX(rpjmd_program.`sikd_prog_id`), 9, 4),
                     SUBSTR(HEX(rpjmd_program.`sikd_prog_id`), 13, 4),
                     SUBSTR(HEX(rpjmd_program.`sikd_prog_id`), 17, 4),
                     SUBSTR(HEX(rpjmd_program.`sikd_prog_id`), 21)
                     ) AS rpjmd_program_sikd_prog_id,
                    CONCAT_WS('-',
                     SUBSTR(HEX(rpjmd_pelaksana_program.`sikd_satker_id`), 1, 8),
                     SUBSTR(HEX(rpjmd_pelaksana_program.`sikd_satker_id`), 9, 4),
                     SUBSTR(HEX(rpjmd_pelaksana_program.`sikd_satker_id`), 13, 4),
                     SUBSTR(HEX(rpjmd_pelaksana_program.`sikd_satker_id`), 17, 4),
                     SUBSTR(HEX(rpjmd_pelaksana_program.`sikd_satker_id`), 21)
                     ) AS sikd_satker_id
                FROM
                     `rpjmd_program` rpjmd_program
                     INNER JOIN `rpjmd_sasaran` rpjmd_sasaran ON rpjmd_program.`rpjmd_sasaran_id` = rpjmd_sasaran.`id_rpjmd_sasaran`
                     INNER JOIN `rpjmd_tujuan` rpjmd_tujuan ON rpjmd_sasaran.`rpjmd_tujuan_id` = rpjmd_tujuan.`id_rpjmd_tujuan`
                     INNER JOIN `rpjmd_misi` rpjmd_misi ON rpjmd_tujuan.`rpjmd_misi_id` = rpjmd_misi.`id_rpjmd_misi`
                     INNER JOIN `rpjmd_rpjmd` rpjmd_rpjmd ON rpjmd_misi.`rpjmd_rpjmd_id` = rpjmd_rpjmd.`id_rpjmd_rpjmd`
                     LEFT OUTER JOIN `rpjmd_pelaksana_program` rpjmd_pelaksana_program ON rpjmd_program.`id_rpjmd_program` = rpjmd_pelaksana_program.`rpjmd_program_id`
                WHERE
                     rpjmd_rpjmd.`id_rpjmd_rpjmd` = :id_rpjmd
                GROUP BY
                     rpjmd_program.`id_rpjmd_program`
                ORDER BY
                     rpjmd_program.`kd_program` LIMIT 1";*/

            $sql = "SELECT
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
                     SUBSTR(sikd_bidang.`kd_bidang`,3,2) AS sikd_bidang_kd_bidang,
                     sikd_bidang.`nm_bidang` AS sikd_bidang_nm_bidang,
                     sikd_prog.`kd_prog` AS sikd_prog_kd_prog,
                     CONCAT_WS('-',
                     SUBSTR(HEX(rpjmd_program.`id_rpjmd_program`), 1, 8),
                     SUBSTR(HEX(rpjmd_program.`id_rpjmd_program`), 9, 4),
                     SUBSTR(HEX(rpjmd_program.`id_rpjmd_program`), 13, 4),
                     SUBSTR(HEX(rpjmd_program.`id_rpjmd_program`), 17, 4),
                     SUBSTR(HEX(rpjmd_program.`id_rpjmd_program`), 21)
                     ) AS rpjmd_program_id_rpjmd_program,
                     rpjmd_program.`kd_program` AS rpjmd_program_kd_program,
                     rpjmd_program.`uraian_program` AS rpjmd_program_uraian_program,
                     rpjmd_program.`prioritas_program` AS rpjmd_program_prioritas_program,
                     CONCAT_WS('-',
                     SUBSTR(HEX(rpjmd_rpjmd.`id_rpjmd_rpjmd`), 1, 8),
                     SUBSTR(HEX(rpjmd_rpjmd.`id_rpjmd_rpjmd`), 9, 4),
                     SUBSTR(HEX(rpjmd_rpjmd.`id_rpjmd_rpjmd`), 13, 4),
                     SUBSTR(HEX(rpjmd_rpjmd.`id_rpjmd_rpjmd`), 17, 4),
                     SUBSTR(HEX(rpjmd_rpjmd.`id_rpjmd_rpjmd`), 21)
                     ) AS rpjmd_rpjmd_id_rpjmd_rpjmd,
                     rpjmd_rpjmd.`periode` AS rpjmd_rpjmd_periode,
                     GROUP_CONCAT(DISTINCT sikd_satker.`singkatan` ORDER BY sikd_satker.`kode` DESC SEPARATOR ', ') nm_opd_pelaksana,
                     SUM(IFNULL(rpjmd_pelaksana_program.jml_anggaran_tahun_1,0)) jml_anggaran_tahun_1,
                     SUM(IFNULL(rpjmd_pelaksana_program.jml_anggaran_tahun_2,0)) jml_anggaran_tahun_2,
                     SUM(IFNULL(rpjmd_pelaksana_program.jml_anggaran_tahun_3,0)) jml_anggaran_tahun_3,
                     SUM(IFNULL(rpjmd_pelaksana_program.jml_anggaran_tahun_4,0)) jml_anggaran_tahun_4,
                     SUM(IFNULL(rpjmd_pelaksana_program.jml_anggaran_tahun_5,0)) jml_anggaran_tahun_5,
                     SUM(IFNULL(rpjmd_pelaksana_program.jml_anggaran_tahun_6,0)) jml_anggaran_tahun_6
                FROM
                     `sikd_urusan` sikd_urusan 
                     INNER JOIN `sikd_bidang` sikd_bidang ON sikd_urusan.`id_sikd_urusan` = sikd_bidang.`sikd_urusan_id`
                     INNER JOIN `rpjmd_program` rpjmd_program ON sikd_bidang.`id_sikd_bidang` = rpjmd_program.`sikd_bidang_id`
                     LEFT OUTER JOIN `sikd_prog` sikd_prog ON rpjmd_program.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                     INNER JOIN `rpjmd_sasaran` rpjmd_sasaran ON rpjmd_program.`rpjmd_sasaran_id` = rpjmd_sasaran.`id_rpjmd_sasaran`
                     INNER JOIN `rpjmd_tujuan` rpjmd_tujuan ON rpjmd_sasaran.`rpjmd_tujuan_id` = rpjmd_tujuan.`id_rpjmd_tujuan`
                     INNER JOIN `rpjmd_misi` rpjmd_misi ON rpjmd_tujuan.`rpjmd_misi_id` = rpjmd_misi.`id_rpjmd_misi`
                     INNER JOIN `rpjmd_rpjmd` rpjmd_rpjmd ON rpjmd_misi.`rpjmd_rpjmd_id` = rpjmd_rpjmd.`id_rpjmd_rpjmd`
                     LEFT OUTER JOIN `rpjmd_pelaksana_program` rpjmd_pelaksana_program ON rpjmd_program.`id_rpjmd_program` = rpjmd_pelaksana_program.`rpjmd_program_id`
                     LEFT OUTER JOIN `sikd_satker` sikd_satker ON rpjmd_pelaksana_program.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                WHERE
                     rpjmd_rpjmd.`id_rpjmd_rpjmd` = :id_rpjmd
                GROUP BY
                     sikd_urusan.`id_sikd_urusan`,
                     sikd_bidang.`id_sikd_bidang`,
                     rpjmd_program.`id_rpjmd_program`
                ORDER BY
                     sikd_urusan.`kd_urusan`,
                     sikd_bidang.`kd_bidang`,
                     rpjmd_program.`kd_program`";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_rpjmd", $id_rpjmd);
            $statement->execute();
            $rslt = $statement->fetchAll();  
            
            return new JsonResponse($rslt);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    
    private function getRpjmdIndikasiProgramSub($id_program)
    {
        $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
        $id_program = $this->convertOuuidToUuid($id_program);
        $this->connection = $conn->getConnection();
        
        $sql = "SELECT
                CONCAT_WS('-',
                    SUBSTR(HEX(rpjmd_indikator_program.`id_rpjmd_indikator_program`), 1, 8),
                    SUBSTR(HEX(rpjmd_indikator_program.`id_rpjmd_indikator_program`), 9, 4),
                    SUBSTR(HEX(rpjmd_indikator_program.`id_rpjmd_indikator_program`), 13, 4),
                    SUBSTR(HEX(rpjmd_indikator_program.`id_rpjmd_indikator_program`), 17, 4),
                    SUBSTR(HEX(rpjmd_indikator_program.`id_rpjmd_indikator_program`), 21)
                    ) AS rpjmd_indikator_program_id_rpjmd_indikator_program,
                    rpjmd_indikator_program.`no_indikator` AS rpjmd_indikator_program_no_indikator,
                    rpjmd_indikator_program.`uraian_indikator` AS rpjmd_indikator_program_uraian_indikator,
                    rpjmd_indikator_program.`satuan` AS rpjmd_indikator_program_satuan,
                    rpjmd_indikator_program.`capaian_awal` AS rpjmd_indikator_program_capaian_awal,
                    rpjmd_indikator_program.`target_tahun_1` AS rpjmd_indikator_program_target_tahun_1,
                    rpjmd_indikator_program.`target_tahun_2` AS rpjmd_indikator_program_target_tahun_2,
                    rpjmd_indikator_program.`target_tahun_3` AS rpjmd_indikator_program_target_tahun_3,
                    rpjmd_indikator_program.`target_tahun_4` AS rpjmd_indikator_program_target_tahun_4,
                    rpjmd_indikator_program.`target_tahun_5` AS rpjmd_indikator_program_target_tahun_5,
                    rpjmd_indikator_program.`kondisi_akhir` AS rpjmd_indikator_program_kondisi_akhir
               FROM
                    `rpjmd_indikator_program` rpjmd_indikator_program
               WHERE
                        rpjmd_indikator_program.`rpjmd_program_id` = :id_program
               ORDER BY
                        rpjmd_indikator_program.`no_indikator`";
        
        $statement = $this->connection->prepare($sql);
        $statement->bindValue("id_program", $id_program);
        $statement->execute();
        $rslt = $statement->fetchAll();  
        
        return new JsonResponse($rslt);
    }
    
    
    private function getRpjmdIndikatorKinerja() {
        $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
        $this->connection = $conn->getConnection();
        
        $sql = "SELECT
                    CONCAT_WS('-',
                     SUBSTR(HEX(rpjmd_rpjmd.`id_rpjmd_rpjmd`), 1, 8),
                     SUBSTR(HEX(rpjmd_rpjmd.`id_rpjmd_rpjmd`), 9, 4),
                     SUBSTR(HEX(rpjmd_rpjmd.`id_rpjmd_rpjmd`), 13, 4),
                     SUBSTR(HEX(rpjmd_rpjmd.`id_rpjmd_rpjmd`), 17, 4),
                     SUBSTR(HEX(rpjmd_rpjmd.`id_rpjmd_rpjmd`), 21)
                     ) AS rpjmd_rpjmd_id_rpjmd_rpjmd,
                     rpjmd_rpjmd.`periode` AS rpjmd_rpjmd_periode,
                     rpjmd_rpjmd.`no_perda` AS rpjmd_rpjmd_no_perda,
                     rpjmd_rpjmd.`uraian_rpjmd` AS rpjmd_rpjmd_uraian_rpjmd,
                    CONCAT_WS('-',
                     SUBSTR(HEX(rpjmd_aspek_fokus_pembangunan.`id_rpjmd_aspek_fokus_pembangunan`), 1, 8),
                     SUBSTR(HEX(rpjmd_aspek_fokus_pembangunan.`id_rpjmd_aspek_fokus_pembangunan`), 9, 4),
                     SUBSTR(HEX(rpjmd_aspek_fokus_pembangunan.`id_rpjmd_aspek_fokus_pembangunan`), 13, 4),
                     SUBSTR(HEX(rpjmd_aspek_fokus_pembangunan.`id_rpjmd_aspek_fokus_pembangunan`), 17, 4),
                     SUBSTR(HEX(rpjmd_aspek_fokus_pembangunan.`id_rpjmd_aspek_fokus_pembangunan`), 21)
                     ) AS rpjmd_aspek_fokus_pembangunan_id_rpjmd_aspek_fokus_pembangunan,
                    CONCAT_WS('-',
                     SUBSTR(HEX(sikd_aspek_pemb.`id_sikd_aspek_pemb`), 1, 8),
                     SUBSTR(HEX(sikd_aspek_pemb.`id_sikd_aspek_pemb`), 9, 4),
                     SUBSTR(HEX(sikd_aspek_pemb.`id_sikd_aspek_pemb`), 13, 4),
                     SUBSTR(HEX(sikd_aspek_pemb.`id_sikd_aspek_pemb`), 17, 4),
                     SUBSTR(HEX(sikd_aspek_pemb.`id_sikd_aspek_pemb`), 21)
                     ) AS sikd_aspek_pemb_id_sikd_aspek_pemb,
                     sikd_aspek_pemb.`no_aspek_pemb` AS sikd_aspek_pemb_no_aspek_pemb,
                     sikd_aspek_pemb.`uraian_aspek_pemb` AS sikd_aspek_pemb_uraian_aspek_pemb,
                     rpjmd_aspek_fokus_pembangunan.`no_fokus_pembangunan` AS rpjmd_aspek_fokus_pembangunan_no_fokus_pembangunan,
                     rpjmd_aspek_fokus_pembangunan.`kd_fokus_pembangunan` AS rpjmd_aspek_fokus_pembangunan_kd_fokus_pembangunan,
                     rpjmd_aspek_fokus_pembangunan.`uraian_fokus_pembangunan` AS rpjmd_aspek_fokus_pembangunan_uraian_fokus_pembangunan,
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
                     SUBSTR(HEX(rpjmd_indikator_kinerja.`id_rpjmd_indikator_kinerja`), 1, 8),
                     SUBSTR(HEX(rpjmd_indikator_kinerja.`id_rpjmd_indikator_kinerja`), 9, 4),
                     SUBSTR(HEX(rpjmd_indikator_kinerja.`id_rpjmd_indikator_kinerja`), 13, 4),
                     SUBSTR(HEX(rpjmd_indikator_kinerja.`id_rpjmd_indikator_kinerja`), 17, 4),
                     SUBSTR(HEX(rpjmd_indikator_kinerja.`id_rpjmd_indikator_kinerja`), 21)
                     ) AS rpjmd_indikator_kinerja_id_rpjmd_indikator_kinerja,
                     rpjmd_indikator_kinerja.`no_indikator` AS rpjmd_indikator_kinerja_no_indikator,
                     rpjmd_indikator_kinerja_1.no_indikator, rpjmd_indikator_kinerja_1.uraian_indikator,
                     rpjmd_indikator_kinerja_1.satuan, rpjmd_indikator_kinerja_1.capaian_awal,
                     rpjmd_indikator_kinerja_1.target_tahun_1, rpjmd_indikator_kinerja_1.target_tahun_2,
                     rpjmd_indikator_kinerja_1.target_tahun_3, rpjmd_indikator_kinerja_1.target_tahun_4,
                     rpjmd_indikator_kinerja_1.target_tahun_5, rpjmd_indikator_kinerja_1.kondisi_akhir
                FROM
                     `rpjmd_aspek_fokus_pembangunan` rpjmd_aspek_fokus_pembangunan
                     INNER JOIN `sikd_aspek_pemb` sikd_aspek_pemb ON rpjmd_aspek_fokus_pembangunan.`sikd_aspek_pemb_id` = sikd_aspek_pemb.`id_sikd_aspek_pemb`
                     INNER JOIN `rpjmd_indikator_kinerja` rpjmd_indikator_kinerja ON rpjmd_aspek_fokus_pembangunan.`id_rpjmd_aspek_fokus_pembangunan` = rpjmd_indikator_kinerja.`rpjmd_aspek_fokus_pembangunan_id`
                     INNER JOIN `sikd_bidang` sikd_bidang ON rpjmd_indikator_kinerja.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                     RIGHT OUTER JOIN `rpjmd_permasalahan_pemb` rpjmd_permasalahan_pemb ON rpjmd_permasalahan_pemb.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                     RIGHT OUTER JOIN `rpjmd_rpjmd` rpjmd_rpjmd ON rpjmd_permasalahan_pemb.`rpjmd_rpjmd_id` = rpjmd_rpjmd.`id_rpjmd_rpjmd`
                     INNER JOIN (select a.id_rpjmd_indikator_kinerja as id_rpjmd_indikator_kinerja,
                            b.no_indikator, b.uraian_indikator, b.satuan, b.capaian_awal,
                            b.target_tahun_1, b.target_tahun_2, b.target_tahun_3, b.target_tahun_4, b.target_tahun_5,
                            b.kondisi_akhir
                        from rpjmd_indikator_kinerja a
                        inner join rpjmd_indikator_sasaran b on a.rpjmd_indikator_sasaran_id = b.id_rpjmd_indikator_sasaran
                        UNION
                        select a.id_rpjmd_indikator_kinerja as id_rpjmd_indikator_kinerja,
                            b.no_indikator, b.uraian_indikator, b.satuan, b.capaian_awal,
                            b.target_tahun_1, b.target_tahun_2, b.target_tahun_3, b.target_tahun_4, b.target_tahun_5,
                            b.kondisi_akhir
                        from rpjmd_indikator_kinerja a
                        inner join rpjmd_indikator_program b on a.rpjmd_indikator_program_id = b.id_rpjmd_indikator_program) AS rpjmd_indikator_kinerja_1
                      ON rpjmd_indikator_kinerja.id_rpjmd_indikator_kinerja = rpjmd_indikator_kinerja_1.id_rpjmd_indikator_kinerja
                ORDER BY
                     sikd_aspek_pemb.`no_aspek_pemb`,
                     rpjmd_aspek_fokus_pembangunan.`no_fokus_pembangunan`,
                     sikd_bidang.`kd_bidang`,
                     rpjmd_indikator_kinerja.`no_indikator`,
                     rpjmd_indikator_kinerja_1.`no_indikator`";
        
        $statement = $this->connection->prepare($sql);
        $statement->execute();
        $rslt = $statement->fetchAll();  
        
        return new JsonResponse($rslt);
    }
    
    private function getRpjmdKemampuanKeuangan()
    {
        $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
        $this->connection = $conn->getConnection();
        
        $sql = "SELECT
                    CONCAT_WS('-',
                    SUBSTR(HEX(rpjmd.id_rpjmd_rpjmd), 1, 8),
                    SUBSTR(HEX(rpjmd.id_rpjmd_rpjmd), 9, 4),
                    SUBSTR(HEX(rpjmd.id_rpjmd_rpjmd), 13, 4),
                    SUBSTR(HEX(rpjmd.id_rpjmd_rpjmd), 17, 4),
                    SUBSTR(HEX(rpjmd.id_rpjmd_rpjmd), 21)
                    )AS id_rpjmd_rpjmd,
                    rpjmd.periode,
                    '1_Penerimaan' group_item,
                    rek_akun.kd_rek_akun kode,
                    rek_akun.nm_rek_akun uraian,
                    SUM(ifnull(proyeksi.jml_tahun_1,0)) jml_tahun_1,
                    SUM(ifnull(proyeksi.jml_tahun_2,0)) jml_tahun_2,
                    SUM(ifnull(proyeksi.jml_tahun_3,0)) jml_tahun_3,
                    SUM(ifnull(proyeksi.jml_tahun_4,0)) jml_tahun_4,
                    SUM(ifnull(proyeksi.jml_tahun_5,0)) jml_tahun_5,
                    SUM(ifnull(proyeksi.jml_tahun_6,0)) jml_tahun_6,
                    SUM(ifnull(proyeksi.jml_tahun_1,0)) jml_kapasitas_tahun_1,
                    SUM(ifnull(proyeksi.jml_tahun_2,0)) jml_kapasitas_tahun_2,
                    SUM(ifnull(proyeksi.jml_tahun_3,0)) jml_kapasitas_tahun_3,
                    SUM(ifnull(proyeksi.jml_tahun_4,0)) jml_kapasitas_tahun_4,
                    SUM(ifnull(proyeksi.jml_tahun_5,0)) jml_kapasitas_tahun_5,
                    SUM(ifnull(proyeksi.jml_tahun_6,0)) jml_kapasitas_tahun_6
                from
                    sikd_rek_jenis rek_jenis
                    inner join sikd_rek_kelompok rek_klpk on rek_jenis.sikd_rek_kelompok_id = rek_klpk.id_sikd_rek_kelompok
                    inner join sikd_rek_akun rek_akun on rek_klpk.sikd_rek_akun_id = rek_akun.id_sikd_rek_akun
                    left outer join rpjmd_proyeksi_anggaran proyeksi on proyeksi.sikd_rek_jenis_id = rek_jenis.id_sikd_rek_jenis
                    left outer join rpjmd_rpjmd rpjmd on proyeksi.rpjmd_rpjmd_id = rpjmd.id_rpjmd_rpjmd
                where
                    rek_akun.kd_rek_akun = '4'
                group by
                    rek_akun.kd_rek_akun
                UNION
                select
                    CONCAT_WS('-',
                    SUBSTR(HEX(rpjmd.id_rpjmd_rpjmd), 1, 8),
                    SUBSTR(HEX(rpjmd.id_rpjmd_rpjmd), 9, 4),
                    SUBSTR(HEX(rpjmd.id_rpjmd_rpjmd), 13, 4),
                    SUBSTR(HEX(rpjmd.id_rpjmd_rpjmd), 17, 4),
                    SUBSTR(HEX(rpjmd.id_rpjmd_rpjmd), 21)
                    )AS id_rpjmd_rpjmd,
                    rpjmd.periode,
                    '1_Penerimaan' group_item,
                    rek_jenis.kd_rek_jenis kode,
                    rek_jenis.nm_rek_jenis uraian,
                    SUM(ifnull(proyeksi.jml_tahun_1,0)) jml_tahun_1,
                    SUM(ifnull(proyeksi.jml_tahun_2,0)) jml_tahun_2,
                    SUM(ifnull(proyeksi.jml_tahun_3,0)) jml_tahun_3,
                    SUM(ifnull(proyeksi.jml_tahun_4,0)) jml_tahun_4,
                    SUM(ifnull(proyeksi.jml_tahun_5,0)) jml_tahun_5,
                    SUM(ifnull(proyeksi.jml_tahun_6,0)) jml_tahun_6,
                    SUM(ifnull(proyeksi.jml_tahun_1,0)) jml_kapasitas_tahun_1,
                    SUM(ifnull(proyeksi.jml_tahun_2,0)) jml_kapasitas_tahun_2,
                    SUM(ifnull(proyeksi.jml_tahun_3,0)) jml_kapasitas_tahun_3,
                    SUM(ifnull(proyeksi.jml_tahun_4,0)) jml_kapasitas_tahun_4,
                    SUM(ifnull(proyeksi.jml_tahun_5,0)) jml_kapasitas_tahun_5,
                    SUM(ifnull(proyeksi.jml_tahun_6,0)) jml_kapasitas_tahun_6
                from
                    sikd_rek_jenis rek_jenis
                    inner join sikd_rek_kelompok rek_klpk on rek_jenis.sikd_rek_kelompok_id = rek_klpk.id_sikd_rek_kelompok
                    inner join sikd_rek_akun rek_akun on rek_klpk.sikd_rek_akun_id = rek_akun.id_sikd_rek_akun
                    left outer join rpjmd_proyeksi_anggaran proyeksi on proyeksi.sikd_rek_jenis_id = rek_jenis.id_sikd_rek_jenis
                    left outer join rpjmd_rpjmd rpjmd on proyeksi.rpjmd_rpjmd_id = rpjmd.id_rpjmd_rpjmd
                where
                    rek_klpk.kd_rek_kelompok = '61'
                group by
                    rek_jenis.kd_rek_jenis
                UNION
                select
                    CONCAT_WS('-',
                    SUBSTR(HEX(rpjmd.id_rpjmd_rpjmd), 1, 8),
                    SUBSTR(HEX(rpjmd.id_rpjmd_rpjmd), 9, 4),
                    SUBSTR(HEX(rpjmd.id_rpjmd_rpjmd), 13, 4),
                    SUBSTR(HEX(rpjmd.id_rpjmd_rpjmd), 17, 4),
                    SUBSTR(HEX(rpjmd.id_rpjmd_rpjmd), 21)
                    )AS id_rpjmd_rpjmd,
                    rpjmd.periode,
                    '2_Pengeluaran' group_item,
                    null kode,
                    'Belanja dan Pengeluaran Pembiayaan yang Wajib dan Mengikat serta Prioritas Utama' uraian,
                    SUM(ifnull(proyeksi.jml_tahun_1,0)) jml_tahun_1,
                    SUM(ifnull(proyeksi.jml_tahun_2,0)) jml_tahun_2,
                    SUM(ifnull(proyeksi.jml_tahun_3,0)) jml_tahun_3,
                    SUM(ifnull(proyeksi.jml_tahun_4,0)) jml_tahun_4,
                    SUM(ifnull(proyeksi.jml_tahun_5,0)) jml_tahun_5,
                    SUM(ifnull(proyeksi.jml_tahun_6,0)) jml_tahun_6,
                    SUM(ifnull(-proyeksi.jml_tahun_1,0)) jml_kapasitas_tahun_1,
                    SUM(ifnull(-proyeksi.jml_tahun_2,0)) jml_kapasitas_tahun_2,
                    SUM(ifnull(-proyeksi.jml_tahun_3,0)) jml_kapasitas_tahun_3,
                    SUM(ifnull(-proyeksi.jml_tahun_4,0)) jml_kapasitas_tahun_4,
                    SUM(ifnull(-proyeksi.jml_tahun_5,0)) jml_kapasitas_tahun_5,
                    SUM(ifnull(-proyeksi.jml_tahun_6,0)) jml_kapasitas_tahun_6
                from
                    sikd_rek_jenis rek_jenis
                    inner join sikd_rek_kelompok rek_klpk on rek_jenis.sikd_rek_kelompok_id = rek_klpk.id_sikd_rek_kelompok
                    inner join sikd_rek_akun rek_akun on rek_klpk.sikd_rek_akun_id = rek_akun.id_sikd_rek_akun
                    left outer join rpjmd_proyeksi_anggaran proyeksi on proyeksi.sikd_rek_jenis_id = rek_jenis.id_sikd_rek_jenis
                    left outer join rpjmd_rpjmd rpjmd on proyeksi.rpjmd_rpjmd_id = rpjmd.id_rpjmd_rpjmd
                where
                    rek_akun.kd_rek_akun = '5' or rek_klpk.kd_rek_kelompok = '62'
                group by
                    rpjmd.id_rpjmd_rpjmd
                order by
                    group_item, kode
                ";
        
        $statement = $this->connection->prepare($sql);
        $statement->execute();
        $rslt = $statement->fetchAll();  
        
        return new JsonResponse($rslt);
    }
    
    
    private function getRpjmdProyeksiAnggaran()
    {
        $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
        $this->connection = $conn->getConnection();
        
        $sql = "SELECT
                     CONCAT_WS('-',
                            SUBSTR(HEX(rpjmd.`id_rpjmd_rpjmd`), 1, 8),
                            SUBSTR(HEX(rpjmd.`id_rpjmd_rpjmd`), 9, 4),
                            SUBSTR(HEX(rpjmd.`id_rpjmd_rpjmd`), 13, 4),
                            SUBSTR(HEX(rpjmd.`id_rpjmd_rpjmd`), 17, 4),
                            SUBSTR(HEX(rpjmd.`id_rpjmd_rpjmd`), 21)
                          ) AS id_rpjmd_rpjmd,
                    rpjmd.periode,
                     CONCAT_WS('-',
                            SUBSTR(HEX(rek_jenis.`id_sikd_rek_jenis`), 1, 8),
                            SUBSTR(HEX(rek_jenis.`id_sikd_rek_jenis`), 9, 4),
                            SUBSTR(HEX(rek_jenis.`id_sikd_rek_jenis`), 13, 4),
                            SUBSTR(HEX(rek_jenis.`id_sikd_rek_jenis`), 17, 4),
                            SUBSTR(HEX(rek_jenis.`id_sikd_rek_jenis`), 21)
                          ) AS id_sikd_rek_jenis,
                    rek_akun.kd_rek_akun kd_rek_akun,
                    rek_klpk.kd_rek_kelompok kd_rek_kelompok,
                    rek_jenis.kd_rek_jenis kd_rek_jenis,
                    rek_akun.nm_rek_akun nm_rek_akun,
                    rek_klpk.nm_rek_kelompok nm_rek_klpk,
                    rek_jenis.nm_rek_jenis nm_rek_jenis,
                    rek_anggaran.prioritas_pengeluaran,
                    if(rek_anggaran.prioritas_pengeluaran='PWM','Prioritas Wajib Mengikat',
                    if(rek_anggaran.prioritas_pengeluaran='PU','Prioritas Utama','')) nm_prioritas,
                    if(rek_akun.kd_rek_akun in ('4','5'), 'rek_45','rek_6') jns_rek,
                    ifnull(proyeksi.jml_tahun_1,0) jml_tahun_1,
                    ifnull(proyeksi.jml_tahun_2,0) jml_tahun_2,
                    ifnull(proyeksi.jml_tahun_3,0) jml_tahun_3,
                    ifnull(proyeksi.jml_tahun_4,0) jml_tahun_4,
                    ifnull(proyeksi.jml_tahun_5,0) jml_tahun_5,
                    ifnull(proyeksi.jml_tahun_6,0) jml_tahun_6,
                    if(rek_akun.kd_rek_akun in ('4'),1, if(rek_akun.kd_rek_akun in ('5'),-1,0)) * ifnull(proyeksi.jml_tahun_1,0) jml_surpl_dfst_1,
                    if(rek_akun.kd_rek_akun in ('4'),1, if(rek_akun.kd_rek_akun in ('5'),-1,0)) * ifnull(proyeksi.jml_tahun_2,0) jml_surpl_dfst_2,
                    if(rek_akun.kd_rek_akun in ('4'),1, if(rek_akun.kd_rek_akun in ('5'),-1,0)) * ifnull(proyeksi.jml_tahun_3,0) jml_surpl_dfst_3,
                    if(rek_akun.kd_rek_akun in ('4'),1, if(rek_akun.kd_rek_akun in ('5'),-1,0)) * ifnull(proyeksi.jml_tahun_4,0) jml_surpl_dfst_4,
                    if(rek_akun.kd_rek_akun in ('4'),1, if(rek_akun.kd_rek_akun in ('5'),-1,0)) * ifnull(proyeksi.jml_tahun_5,0) jml_surpl_dfst_5,
                    if(rek_akun.kd_rek_akun in ('4'),1, if(rek_akun.kd_rek_akun in ('5'),-1,0)) * ifnull(proyeksi.jml_tahun_6,0) jml_surpl_dfst_6,
                    if(rek_klpk.kd_rek_kelompok in ('61'),1, if(rek_klpk.kd_rek_kelompok in ('62'),-1,0)) * ifnull(proyeksi.jml_tahun_1,0) jml_netto_1,
                    if(rek_klpk.kd_rek_kelompok in ('61'),1, if(rek_klpk.kd_rek_kelompok in ('62'),-1,0)) * ifnull(proyeksi.jml_tahun_2,0) jml_netto_2,
                    if(rek_klpk.kd_rek_kelompok in ('61'),1, if(rek_klpk.kd_rek_kelompok in ('62'),-1,0)) * ifnull(proyeksi.jml_tahun_3,0) jml_netto_3,
                    if(rek_klpk.kd_rek_kelompok in ('61'),1, if(rek_klpk.kd_rek_kelompok in ('62'),-1,0)) * ifnull(proyeksi.jml_tahun_4,0) jml_netto_4,
                    if(rek_klpk.kd_rek_kelompok in ('61'),1, if(rek_klpk.kd_rek_kelompok in ('62'),-1,0)) * ifnull(proyeksi.jml_tahun_5,0) jml_netto_5,
                    if(rek_klpk.kd_rek_kelompok in ('61'),1, if(rek_klpk.kd_rek_kelompok in ('62'),-1,0)) * ifnull(proyeksi.jml_tahun_6,0) jml_netto_6,
                    if(rek_akun.kd_rek_akun in ('4') || rek_klpk.kd_rek_kelompok in ('61'),1,-1) * ifnull(proyeksi.jml_tahun_1,0) jml_silpa_1,
                    if(rek_akun.kd_rek_akun in ('4') || rek_klpk.kd_rek_kelompok in ('61'),1,-1) * ifnull(proyeksi.jml_tahun_2,0) jml_silpa_2,
                    if(rek_akun.kd_rek_akun in ('4') || rek_klpk.kd_rek_kelompok in ('61'),1,-1) * ifnull(proyeksi.jml_tahun_3,0) jml_silpa_3,
                    if(rek_akun.kd_rek_akun in ('4') || rek_klpk.kd_rek_kelompok in ('61'),1,-1) * ifnull(proyeksi.jml_tahun_4,0) jml_silpa_4,
                    if(rek_akun.kd_rek_akun in ('4') || rek_klpk.kd_rek_kelompok in ('61'),1,-1) * ifnull(proyeksi.jml_tahun_5,0) jml_silpa_5,
                    if(rek_akun.kd_rek_akun in ('4') || rek_klpk.kd_rek_kelompok in ('61'),1,-1) * ifnull(proyeksi.jml_tahun_6,0) jml_silpa_6
                from
                    sikd_rek_jenis rek_jenis
                    inner join sikd_rek_kelompok rek_klpk on rek_jenis.sikd_rek_kelompok_id = rek_klpk.id_sikd_rek_kelompok
                    inner join sikd_rek_akun rek_akun on rek_klpk.sikd_rek_akun_id = rek_akun.id_sikd_rek_akun
                    left outer join rpjmd_proyeksi_anggaran proyeksi on proyeksi.sikd_rek_jenis_id = rek_jenis.id_sikd_rek_jenis
                    left outer join rpjmd_rpjmd rpjmd on proyeksi.rpjmd_rpjmd_id = rpjmd.id_rpjmd_rpjmd
                    left outer join rpjmd_rek_anggaran rek_anggaran on rek_anggaran.rpjmd_rpjmd_id = rpjmd.id_rpjmd_rpjmd
                where
                    substr(rek_jenis.kd_rek_jenis,1,1) in ('4','5','6')
                    and ((substr(rek_jenis.kd_rek_jenis,1,1) in ('6') and substr(rek_jenis.kd_rek_jenis,1,2) in ('61','62'))
                        or substr(rek_jenis.kd_rek_jenis,1,1) not in ('6'))
                order by
                    rek_akun.kd_rek_akun,
                    if(rek_anggaran.prioritas_pengeluaran='PWM',1,2),
                    rek_klpk.kd_rek_kelompok,
                    rek_jenis.kd_rek_jenis
            ";
        
        $statement = $this->connection->prepare($sql);
        $statement->execute();
        $rslt = $statement->fetchAll();  
        
        return new JsonResponse($rslt);
    }
    
    
    /*
     private function getRestMapData($baseUri, $resource, $keyValues = [], $keyFieldName, $tahun)
     {
     $request = $this->get("request_stack")->getCurrentRequest();
     $kdTenant = $request->headers->get("tenant");
     $client = new \GuzzleHttp\Client(['base_uri' => rtrim($baseUri, "/")."/$tahun/"]);
     $params = [
     'headers' => ['Connection' => 'close', 'tenant' => $kdTenant],
     'query' => ['ids' => implode(",", $keyValues)]
     ];
     //$this->get("logger")->debug(print_r($params, 1));
     $res = $client->request('GET', $resource, $params);
     
     $mapData = [];
     if ($res->getStatusCode() == 200) {  // OK
     if ($res->getBody() != "") {
     $datas = json_decode($res->getBody(), true);
     //$this->get("logger")->debug(print_r($datas, 1));
     //print_r($datas); exit;
     //if (is_array($datas)) {
     //    foreach ($datas as $data) {
     //        $mapData[str_replace('-', '', $data[$keyFieldName])] = $data;
     //    }
     //}
     }
     }
     
     $mapData = $datas;
     
     $this->get("logger")->debug(print_r($mapData, 1));
     return $mapData;
     }
     */
    
}