<?php
namespace App\Controller\Renstra;

use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Delete;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * @RouteResource("renstrareport")
 */
class RenstraReportController extends \App\Controller\ApiBaseController
{
    //protected $dbalConnName = 'simral_renstra';
    
    public function cgetAction(Request $request)
    {        
        $rpt = $request->query->get("jns_report");

        switch ($rpt) {
            case "renstra_visi_misi":
                $id_renstra = $request->query->get("id_renstra");
                return $this->getRenstraVisiMisi($id_renstra);
            case "renstra_strategi_arah_kbjkn":
                $id_renstra = $request->query->get("id_renstra");
                return $this->getRenstraStrategiArahKbjkn($id_renstra);
            case "renstra_kbjkn_program":
                $id_renstra = $request->query->get("id_renstra");
                return $this->getRenstraKbjknProgram($id_renstra);
            case "renstra_kbjkn_program_sub1":
                $id_sasaran = $request->query->get("id_sasaran");
                return $this->getRenstraKbjknProgramSub1($id_sasaran);
            case "renstra_kbjkn_program_sub2":
                $id_sasaran = $request->query->get("id_sasaran");
                return $this->getRenstraKbjknProgramSub2($id_sasaran);
            case "renstra_kbjkn_program_sub3":
                $id_sasaran = $request->query->get("id_sasaran");
                return $this->getRenstraKbjknProgramSub3($id_sasaran);
            case "renstra_indikasi_program":
                $id_renstra = $request->query->get("id_renstra");
                return $this->getRenstraIndikasiProgram($id_renstra);
            case "renstra_indikasi_program_sub":
                $id_program = $request->query->get("id_program");
                return $this->getRenstraIndikasiProgramSub($id_program);
            case "renstra_prog_kgtn_prioritas":
                return $this->getRenstraProgKgtnPrioritas();
            case "renstra_prog_kgtn_prioritas_sub1":
                $id_sasaran = $request->query->get("id_sasaran");
                return $this->getRenstraProgKgtnPrioritasSub1($id_sasaran);
            case "renstra_prog_kgtn_prioritas_sub2":
                $id_program = $request->query->get("id_program");
                return $this->getRenstraProgKgtnPrioritasSub2($id_program);
            case "renstra_prog_kgtn_prioritas_sub3":
                $id_kegiatan = $request->query->get("id_kegiatan");
                return $this->getRenstraProgKgtnPrioritasSub3($id_kegiatan);
            default:
                throw new BadRequestHttpException("Undefined report");
        }
    }
    
    private function getRenstraVisiMisi($id_renstra)
    {
        try {
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $id_renstra = $this->convertOuuidToUuid($id_renstra);
            $this->connection = $conn->getConnection();
            $sql = "SELECT
                         CONCAT_WS('-',
                            SUBSTR(HEX(sikd_satker.id_sikd_satker), 1, 8),
                            SUBSTR(HEX(sikd_satker.id_sikd_satker), 9, 4),
                            SUBSTR(HEX(sikd_satker.id_sikd_satker), 13, 4),
                            SUBSTR(HEX(sikd_satker.id_sikd_satker), 17, 4),
                            SUBSTR(HEX(sikd_satker.id_sikd_satker), 21)
                          ) AS id_sikd_satker,
                         sikd_satker.kode AS kd_satker,
                         sikd_satker.nama AS nm_satker,
                         CONCAT_WS('-',
                            SUBSTR(HEX(sikd_sub_skpd.id_sikd_sub_skpd), 1, 8),
                            SUBSTR(HEX(sikd_sub_skpd.id_sikd_sub_skpd), 9, 4),
                            SUBSTR(HEX(sikd_sub_skpd.id_sikd_sub_skpd), 13, 4),
                            SUBSTR(HEX(sikd_sub_skpd.id_sikd_sub_skpd), 17, 4),
                            SUBSTR(HEX(sikd_sub_skpd.id_sikd_sub_skpd), 21)
                          ) AS id_sikd_sub_skpd,
                         sikd_sub_skpd.kode AS kd_sub_skpd,
                         sikd_sub_skpd.nama AS nm_sub_skpd,
                         renstra_renstra.`no_perka` AS no_perda,
                         renstra_renstra.`periode` AS periode,
                         DATE_FORMAT(renstra_renstra.`tgl_perka`, '%d-%m-%Y') AS tgl_perda,
                         rpjmd_visi.`uraian_visi` AS uraian_visi,
                         CONCAT_WS('-',
                            SUBSTR(HEX(renstra_misi.`id_renstra_misi`), 1, 8),
                            SUBSTR(HEX(renstra_misi.`id_renstra_misi`), 9, 4),
                            SUBSTR(HEX(renstra_misi.`id_renstra_misi`), 13, 4),
                            SUBSTR(HEX(renstra_misi.`id_renstra_misi`), 17, 4),
                            SUBSTR(HEX(renstra_misi.`id_renstra_misi`), 21)
                          ) AS id_renstra_misi,
                         renstra_misi.`no_misi` AS no_misi,
                         renstra_misi.`uraian_misi` AS uraian_misi,
                         CONCAT_WS('-',
                            SUBSTR(HEX(renstra_tujuan.`id_renstra_tujuan`), 1, 8),
                            SUBSTR(HEX(renstra_tujuan.`id_renstra_tujuan`), 9, 4),
                            SUBSTR(HEX(renstra_tujuan.`id_renstra_tujuan`), 13, 4),
                            SUBSTR(HEX(renstra_tujuan.`id_renstra_tujuan`), 17, 4),
                            SUBSTR(HEX(renstra_tujuan.`id_renstra_tujuan`), 21)
                          ) AS id_renstra_tujuan,
                         renstra_tujuan.`kd_tujuan` AS kd_tujuan,
                         renstra_tujuan.`uraian_tujuan` AS uraian_tujuan,
                         CONCAT_WS('-',
                            SUBSTR(HEX(renstra_sasaran.`id_renstra_sasaran`), 1, 8),
                            SUBSTR(HEX(renstra_sasaran.`id_renstra_sasaran`), 9, 4),
                            SUBSTR(HEX(renstra_sasaran.`id_renstra_sasaran`), 13, 4),
                            SUBSTR(HEX(renstra_sasaran.`id_renstra_sasaran`), 17, 4),
                            SUBSTR(HEX(renstra_sasaran.`id_renstra_sasaran`), 21)
                          ) AS id_renstra_sasaran,
                         renstra_sasaran.`kd_sasaran` AS kd_sasaran,
                         renstra_sasaran.`uraian_sasaran` AS uraian_sasaran
                    FROM
                         `renstra_renstra` renstra_renstra 
                         INNER JOIN `rpjmd_visi` rpjmd_visi ON renstra_renstra.`rpjmd_rpjmd_id` = rpjmd_visi.`rpjmd_rpjmd_id`
                         INNER JOIN `renstra_misi` renstra_misi ON renstra_renstra.`id_renstra_renstra` = renstra_misi.`renstra_renstra_id`
                         INNER JOIN `sikd_satker` sikd_satker ON renstra_renstra.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                         LEFT OUTER JOIN `renstra_tujuan` renstra_tujuan ON renstra_misi.`id_renstra_misi` = renstra_tujuan.`renstra_misi_id`
                         LEFT OUTER JOIN `renstra_sasaran` renstra_sasaran ON renstra_tujuan.`id_renstra_tujuan` = renstra_sasaran.`renstra_tujuan_id`
                         LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON renstra_renstra.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                    WHERE
                         renstra_renstra.`id_renstra_renstra` = :id_renstra
                    GROUP BY
                         renstra_misi.`id_renstra_misi`,
                         renstra_tujuan.`id_renstra_tujuan`,
                         renstra_sasaran.`id_renstra_sasaran`
                    ORDER BY
                         renstra_misi.`no_misi` ASC,
                         renstra_tujuan.`no_tujuan` ASC,
                         renstra_sasaran.`no_sasaran` ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_renstra", $id_renstra);
            $statement->execute();
            $result = $statement->fetchAll();
            
            return new JsonResponse($result);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }

    private function getRenstraStrategiArahKbjkn($id_renstra)
    {
        try {
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $id_renstra = $this->convertOuuidToUuid($id_renstra);
            $this->connection = $conn->getConnection();
            /*$sql = "SELECT
                    CONCAT_WS('-',
                            SUBSTR(HEX(renstra_renstra.`rpjmd_rpjmd_id`), 1, 8),
                            SUBSTR(HEX(renstra_renstra.`rpjmd_rpjmd_id`), 9, 4),
                            SUBSTR(HEX(renstra_renstra.`rpjmd_rpjmd_id`), 13, 4),
                            SUBSTR(HEX(renstra_renstra.`rpjmd_rpjmd_id`), 17, 4),
                            SUBSTR(HEX(renstra_renstra.`rpjmd_rpjmd_id`), 21)
                          ) AS rpjmd_rpjmd_id,
                     renstra_renstra.`no_perka` AS no_perda,
                     renstra_renstra.`periode` AS periode,
                     DATE_FORMAT(renstra_renstra.`tgl_perka`,'%d-%m-%Y')AS tgl_perda,
                     CONCAT_WS('-',
                            SUBSTR(HEX(renstra_misi.`id_renstra_misi`), 1, 8),
                            SUBSTR(HEX(renstra_misi.`id_renstra_misi`), 9, 4),
                            SUBSTR(HEX(renstra_misi.`id_renstra_misi`), 13, 4),
                            SUBSTR(HEX(renstra_misi.`id_renstra_misi`), 17, 4),
                            SUBSTR(HEX(renstra_misi.`id_renstra_misi`), 21)
                          ) AS id_renstra_misi,
                     renstra_misi.`no_misi` AS no_misi,
                     renstra_misi.`uraian_misi` AS uraian_misi,
                     CONCAT_WS('-',
                            SUBSTR(HEX(renstra_tujuan.`id_renstra_tujuan`), 1, 8),
                            SUBSTR(HEX(renstra_tujuan.`id_renstra_tujuan`), 9, 4),
                            SUBSTR(HEX(renstra_tujuan.`id_renstra_tujuan`), 13, 4),
                            SUBSTR(HEX(renstra_tujuan.`id_renstra_tujuan`), 17, 4),
                            SUBSTR(HEX(renstra_tujuan.`id_renstra_tujuan`), 21)
                          ) AS id_renstra_tujuan,
                     renstra_tujuan.`kd_tujuan` AS kd_tujuan,
                     renstra_tujuan.`uraian_tujuan` AS uraian_tujuan,
                     CONCAT_WS('-',
                            SUBSTR(HEX(renstra_sasaran.`id_renstra_sasaran`), 1, 8),
                            SUBSTR(HEX(renstra_sasaran.`id_renstra_sasaran`), 9, 4),
                            SUBSTR(HEX(renstra_sasaran.`id_renstra_sasaran`), 13, 4),
                            SUBSTR(HEX(renstra_sasaran.`id_renstra_sasaran`), 17, 4),
                            SUBSTR(HEX(renstra_sasaran.`id_renstra_sasaran`), 21)
                          ) AS id_renstra_sasaran,
                     renstra_sasaran.`kd_sasaran` AS kd_sasaran,
                     renstra_sasaran.`uraian_sasaran` AS uraian_sasaran,
                     CONCAT_WS('-',
                            SUBSTR(HEX(renstra_strategi.`id_renstra_strategi`), 1, 8),
                            SUBSTR(HEX(renstra_strategi.`id_renstra_strategi`), 9, 4),
                            SUBSTR(HEX(renstra_strategi.`id_renstra_strategi`), 13, 4),
                            SUBSTR(HEX(renstra_strategi.`id_renstra_strategi`), 17, 4),
                            SUBSTR(HEX(renstra_strategi.`id_renstra_strategi`), 21)
                          ) AS id_renstra_strategi,
                     renstra_strategi.`kd_strategi` AS kd_strategi,
                     renstra_strategi.`uraian_strategi` AS uraian_strategi,
                     CONCAT_WS('-',
                            SUBSTR(HEX(renstra_arah_kebijakan.`id_renstra_arah_kebijakan`), 1, 8),
                            SUBSTR(HEX(renstra_arah_kebijakan.`id_renstra_arah_kebijakan`), 9, 4),
                            SUBSTR(HEX(renstra_arah_kebijakan.`id_renstra_arah_kebijakan`), 13, 4),
                            SUBSTR(HEX(renstra_arah_kebijakan.`id_renstra_arah_kebijakan`), 17, 4),
                            SUBSTR(HEX(renstra_arah_kebijakan.`id_renstra_arah_kebijakan`), 21)
                          ) AS id_renstra_arah_kebijakan,
                     renstra_arah_kebijakan.`kd_arah_kebijakan` AS kd_arah_kebijakan,
                     renstra_arah_kebijakan.`uraian_arah_kebijakan` AS uraian_arah_kebijakan
                FROM
                     `renstra_renstra` renstra_renstra 
                     INNER JOIN `renstra_misi` renstra_misi ON renstra_renstra.`id_renstra_renstra` = renstra_misi.`renstra_renstra_id`
                     INNER JOIN `renstra_tujuan` renstra_tujuan ON renstra_misi.`id_renstra_misi` = renstra_tujuan.`renstra_misi_id`
                     LEFT OUTER JOIN `renstra_sasaran` renstra_sasaran ON renstra_tujuan.`id_renstra_tujuan` = renstra_sasaran.`renstra_tujuan_id`
                     LEFT OUTER JOIN `renstra_rumusan_strategi` renstra_rumusan_strategi ON renstra_sasaran.`id_renstra_sasaran` = renstra_rumusan_strategi.`renstra_sasaran_id`
                     LEFT OUTER JOIN `renstra_strategi` renstra_strategi ON renstra_rumusan_strategi.`renstra_strategi_id` = renstra_strategi.`id_renstra_strategi`
                     LEFT OUTER JOIN `renstra_rumusan_arah_kbjkn` renstra_rumusan_arah_kbjkn ON renstra_strategi.`id_renstra_strategi` = renstra_rumusan_arah_kbjkn.`renstra_strategi_id`
                     LEFT OUTER JOIN `renstra_arah_kebijakan` renstra_arah_kebijakan ON renstra_rumusan_arah_kbjkn.`renstra_arah_kebijakan_id` = renstra_arah_kebijakan.`id_renstra_arah_kebijakan`
                WHERE
                     renstra_renstra.`id_renstra_renstra` = :id_renstra
                GROUP BY
                     renstra_misi.`id_renstra_misi`,
                     renstra_tujuan.`id_renstra_tujuan`,
                     renstra_sasaran.`id_renstra_sasaran`,
                     renstra_strategi.`id_renstra_strategi`,
                     renstra_arah_kebijakan.`id_renstra_arah_kebijakan`
                ORDER BY
                     renstra_misi.`no_misi` ASC,
                     renstra_tujuan.`no_tujuan` ASC,
                     renstra_sasaran.`no_sasaran` ASC,
                     renstra_strategi.`no_strategi` ASC,
                     renstra_arah_kebijakan.`no_arah_kebijakan` ASC";*/
            $sql = "SELECT
                         CONCAT_WS('-',
                            SUBSTR(HEX(sikd_satker.id_sikd_satker), 1, 8),
                            SUBSTR(HEX(sikd_satker.id_sikd_satker), 9, 4),
                            SUBSTR(HEX(sikd_satker.id_sikd_satker), 13, 4),
                            SUBSTR(HEX(sikd_satker.id_sikd_satker), 17, 4),
                            SUBSTR(HEX(sikd_satker.id_sikd_satker), 21)
                          ) AS id_sikd_satker,
                         sikd_satker.kode AS kd_satker,
                         sikd_satker.nama AS nm_satker,
                         CONCAT_WS('-',
                            SUBSTR(HEX(sikd_sub_skpd.id_sikd_sub_skpd), 1, 8),
                            SUBSTR(HEX(sikd_sub_skpd.id_sikd_sub_skpd), 9, 4),
                            SUBSTR(HEX(sikd_sub_skpd.id_sikd_sub_skpd), 13, 4),
                            SUBSTR(HEX(sikd_sub_skpd.id_sikd_sub_skpd), 17, 4),
                            SUBSTR(HEX(sikd_sub_skpd.id_sikd_sub_skpd), 21)
                          ) AS id_sikd_sub_skpd,
                         sikd_sub_skpd.kode AS kd_sub_skpd,
                         sikd_sub_skpd.nama AS nm_sub_skpd,
                         renstra_renstra.`no_perka` AS no_perda,
                         renstra_renstra.`periode` AS periode,
                         DATE_FORMAT(renstra_renstra.`tgl_perka`,'%d-%m-%Y')AS tgl_perda,
                         CONCAT_WS('-',
                            SUBSTR(HEX(rpjmd_visi.`id_rpjmd_visi`), 1, 8),
                            SUBSTR(HEX(rpjmd_visi.`id_rpjmd_visi`), 9, 4),
                            SUBSTR(HEX(rpjmd_visi.`id_rpjmd_visi`), 13, 4),
                            SUBSTR(HEX(rpjmd_visi.`id_rpjmd_visi`), 17, 4),
                            SUBSTR(HEX(rpjmd_visi.`id_rpjmd_visi`), 21)
                          ) AS id_rpjmd_visi,
                         rpjmd_visi.`uraian_visi` AS uraian_visi,
                         CONCAT_WS('-',
                            SUBSTR(HEX(renstra_misi.`id_renstra_misi`), 1, 8),
                            SUBSTR(HEX(renstra_misi.`id_renstra_misi`), 9, 4),
                            SUBSTR(HEX(renstra_misi.`id_renstra_misi`), 13, 4),
                            SUBSTR(HEX(renstra_misi.`id_renstra_misi`), 17, 4),
                            SUBSTR(HEX(renstra_misi.`id_renstra_misi`), 21)
                          ) AS id_renstra_misi,
                         renstra_misi.`no_misi` AS no_misi,
                         renstra_misi.`uraian_misi` AS uraian_misi,
                         CONCAT_WS('-',
                            SUBSTR(HEX(renstra_tujuan.`id_renstra_tujuan`), 1, 8),
                            SUBSTR(HEX(renstra_tujuan.`id_renstra_tujuan`), 9, 4),
                            SUBSTR(HEX(renstra_tujuan.`id_renstra_tujuan`), 13, 4),
                            SUBSTR(HEX(renstra_tujuan.`id_renstra_tujuan`), 17, 4),
                            SUBSTR(HEX(renstra_tujuan.`id_renstra_tujuan`), 21)
                          ) AS id_renstra_tujuan,
                         renstra_tujuan.`kd_tujuan` AS kd_tujuan,
                         renstra_tujuan.`uraian_tujuan` AS uraian_tujuan,
                         CONCAT_WS('-',
                            SUBSTR(HEX(renstra_sasaran.`id_renstra_sasaran`), 1, 8),
                            SUBSTR(HEX(renstra_sasaran.`id_renstra_sasaran`), 9, 4),
                            SUBSTR(HEX(renstra_sasaran.`id_renstra_sasaran`), 13, 4),
                            SUBSTR(HEX(renstra_sasaran.`id_renstra_sasaran`), 17, 4),
                            SUBSTR(HEX(renstra_sasaran.`id_renstra_sasaran`), 21)
                          ) AS id_renstra_sasaran,
                         renstra_sasaran.`kd_sasaran` AS kd_sasaran,
                         renstra_sasaran.`uraian_sasaran` AS uraian_sasaran,
                         CONCAT_WS('-',
                            SUBSTR(HEX(renstra_strategi.`id_renstra_strategi`), 1, 8),
                            SUBSTR(HEX(renstra_strategi.`id_renstra_strategi`), 9, 4),
                            SUBSTR(HEX(renstra_strategi.`id_renstra_strategi`), 13, 4),
                            SUBSTR(HEX(renstra_strategi.`id_renstra_strategi`), 17, 4),
                            SUBSTR(HEX(renstra_strategi.`id_renstra_strategi`), 21)
                          ) AS id_renstra_strategi,
                         renstra_strategi.`kd_strategi` AS kd_strategi,
                         renstra_strategi.`uraian_strategi` AS uraian_strategi,
                         CONCAT_WS('-',
                            SUBSTR(HEX(renstra_arah_kebijakan.`id_renstra_arah_kebijakan`), 1, 8),
                            SUBSTR(HEX(renstra_arah_kebijakan.`id_renstra_arah_kebijakan`), 9, 4),
                            SUBSTR(HEX(renstra_arah_kebijakan.`id_renstra_arah_kebijakan`), 13, 4),
                            SUBSTR(HEX(renstra_arah_kebijakan.`id_renstra_arah_kebijakan`), 17, 4),
                            SUBSTR(HEX(renstra_arah_kebijakan.`id_renstra_arah_kebijakan`), 21)
                          ) AS id_renstra_arah_kebijakan,
                         renstra_arah_kebijakan.`kd_arah_kebijakan` AS kd_arah_kebijakan,
                         renstra_arah_kebijakan.`uraian_arah_kebijakan` AS uraian_arah_kebijakan
                    FROM
                         `renstra_renstra` renstra_renstra 
                         INNER JOIN `rpjmd_visi` rpjmd_visi ON renstra_renstra.`rpjmd_rpjmd_id` = rpjmd_visi.`rpjmd_rpjmd_id`
                         INNER JOIN `renstra_misi` renstra_misi ON renstra_renstra.`id_renstra_renstra` = renstra_misi.`renstra_renstra_id`
                         INNER JOIN `renstra_tujuan` renstra_tujuan ON renstra_misi.`id_renstra_misi` = renstra_tujuan.`renstra_misi_id`
                         INNER JOIN `sikd_satker` sikd_satker ON renstra_renstra.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                         LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON renstra_renstra.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                         LEFT OUTER JOIN `renstra_sasaran` renstra_sasaran ON renstra_tujuan.`id_renstra_tujuan` = renstra_sasaran.`renstra_tujuan_id`
                         LEFT OUTER JOIN `renstra_rumusan_strategi` renstra_rumusan_strategi ON renstra_sasaran.`id_renstra_sasaran` = renstra_rumusan_strategi.`renstra_sasaran_id`
                         LEFT OUTER JOIN `renstra_strategi` renstra_strategi ON renstra_rumusan_strategi.`renstra_strategi_id` = renstra_strategi.`id_renstra_strategi`
                         LEFT OUTER JOIN `renstra_rumusan_arah_kbjkn` renstra_rumusan_arah_kbjkn ON renstra_strategi.`id_renstra_strategi` = renstra_rumusan_arah_kbjkn.`renstra_strategi_id`
                         LEFT OUTER JOIN `renstra_arah_kebijakan` renstra_arah_kebijakan ON renstra_rumusan_arah_kbjkn.`renstra_arah_kebijakan_id` = renstra_arah_kebijakan.`id_renstra_arah_kebijakan`
                    WHERE
                         renstra_renstra.`id_renstra_renstra` = :id_renstra
                    GROUP BY
                         renstra_misi.`id_renstra_misi`,
                         renstra_tujuan.`id_renstra_tujuan`,
                         renstra_sasaran.`id_renstra_sasaran`,
                         renstra_strategi.`id_renstra_strategi`,
                         renstra_arah_kebijakan.`id_renstra_arah_kebijakan`
                    ORDER BY
                         renstra_misi.`no_misi` ASC,
                         renstra_tujuan.`no_tujuan` ASC,
                         renstra_sasaran.`no_sasaran` ASC,
                         renstra_strategi.`no_strategi` ASC,
                         renstra_arah_kebijakan.`no_arah_kebijakan` ASC";
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_renstra", $id_renstra);
            $statement->execute();
            $result = $statement->fetchAll();
            
            return new JsonResponse($result);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    private function getRenstraKbjknProgram($id_renstra)
    {
        try {
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $id_renstra = $this->convertOuuidToUuid($id_renstra);
            $this->connection = $conn->getConnection();
            /*$sql = "SELECT
                    CONCAT_WS('-',
                            SUBSTR(HEX(renstra_renstra.`id_renstra_renstra`), 1, 8),
                            SUBSTR(HEX(renstra_renstra.`id_renstra_renstra`), 9, 4),
                            SUBSTR(HEX(renstra_renstra.`id_renstra_renstra`), 13, 4),
                            SUBSTR(HEX(renstra_renstra.`id_renstra_renstra`), 17, 4),
                            SUBSTR(HEX(renstra_renstra.`id_renstra_renstra`), 21)
                          ) AS renstra_renstra_id_renstra_renstra,
                     renstra_renstra.`periode` AS renstra_renstra_periode,
                     renstra_renstra.`uraian_renstra` AS renstra_renstra_uraian_renstra,
                     renstra_renstra.`no_perka` AS renstra_renstra_no_perda,
                     CONCAT_WS('-',
                            SUBSTR(HEX(renstra_sasaran.`id_renstra_sasaran`), 1, 8),
                            SUBSTR(HEX(renstra_sasaran.`id_renstra_sasaran`), 9, 4),
                            SUBSTR(HEX(renstra_sasaran.`id_renstra_sasaran`), 13, 4),
                            SUBSTR(HEX(renstra_sasaran.`id_renstra_sasaran`), 17, 4),
                            SUBSTR(HEX(renstra_sasaran.`id_renstra_sasaran`), 21)
                          ) AS renstra_sasaran_id_renstra_sasaran,
                     renstra_sasaran.`no_sasaran` AS renstra_sasaran_no_sasaran,
                     renstra_sasaran.`kd_sasaran` AS renstra_sasaran_kd_sasaran,
                     renstra_sasaran.`uraian_sasaran` AS renstra_sasaran_uraian_sasaran
                FROM
                     `renstra_sasaran` renstra_sasaran 
                     INNER JOIN `renstra_tujuan` renstra_tujuan ON renstra_sasaran.`renstra_tujuan_id` = renstra_tujuan.`id_renstra_tujuan`
                    INNER JOIN `renstra_misi` renstra_misi ON renstra_misi.`id_renstra_misi` = renstra_tujuan.`renstra_misi_id`
                    INNER JOIN `renstra_renstra` renstra_renstra ON renstra_renstra.`id_renstra_renstra` = renstra_misi.`renstra_renstra_id`
                WHERE
                     renstra_renstra.`id_renstra_renstra` = :id_renstra
                ORDER BY
                     renstra_sasaran.`kd_sasaran`";*/

            $sql = "SELECT
                     CONCAT_WS('-',
                            SUBSTR(HEX(sikd_satker.id_sikd_satker), 1, 8),
                            SUBSTR(HEX(sikd_satker.id_sikd_satker), 9, 4),
                            SUBSTR(HEX(sikd_satker.id_sikd_satker), 13, 4),
                            SUBSTR(HEX(sikd_satker.id_sikd_satker), 17, 4),
                            SUBSTR(HEX(sikd_satker.id_sikd_satker), 21)
                          ) AS id_sikd_satker,
                     sikd_satker.kode AS kd_satker,
                     sikd_satker.nama AS nm_satker,
                     CONCAT_WS('-',
                            SUBSTR(HEX(sikd_sub_skpd.id_sikd_sub_skpd), 1, 8),
                            SUBSTR(HEX(sikd_sub_skpd.id_sikd_sub_skpd), 9, 4),
                            SUBSTR(HEX(sikd_sub_skpd.id_sikd_sub_skpd), 13, 4),
                            SUBSTR(HEX(sikd_sub_skpd.id_sikd_sub_skpd), 17, 4),
                            SUBSTR(HEX(sikd_sub_skpd.id_sikd_sub_skpd), 21)
                          ) AS id_sikd_sub_skpd,
                     sikd_sub_skpd.kode AS kd_sub_skpd,
                     sikd_sub_skpd.nama AS nm_sub_skpd,
                     CONCAT_WS('-',
                            SUBSTR(HEX(renstra_renstra.`id_renstra_renstra`), 1, 8),
                            SUBSTR(HEX(renstra_renstra.`id_renstra_renstra`), 9, 4),
                            SUBSTR(HEX(renstra_renstra.`id_renstra_renstra`), 13, 4),
                            SUBSTR(HEX(renstra_renstra.`id_renstra_renstra`), 17, 4),
                            SUBSTR(HEX(renstra_renstra.`id_renstra_renstra`), 21)
                          ) AS renstra_renstra_id_renstra_renstra,
                     renstra_renstra.`periode` AS renstra_renstra_periode,
                     renstra_renstra.`uraian_renstra` AS renstra_renstra_uraian_renstra,
                     renstra_renstra.`no_perka` AS renstra_renstra_no_perda,
                     CONCAT_WS('-',
                            SUBSTR(HEX(renstra_sasaran.`id_renstra_sasaran`), 1, 8),
                            SUBSTR(HEX(renstra_sasaran.`id_renstra_sasaran`), 9, 4),
                            SUBSTR(HEX(renstra_sasaran.`id_renstra_sasaran`), 13, 4),
                            SUBSTR(HEX(renstra_sasaran.`id_renstra_sasaran`), 17, 4),
                            SUBSTR(HEX(renstra_sasaran.`id_renstra_sasaran`), 21)
                          ) AS renstra_sasaran_id_renstra_sasaran,
                     renstra_sasaran.`no_sasaran` AS renstra_sasaran_no_sasaran,
                     renstra_sasaran.`kd_sasaran` AS renstra_sasaran_kd_sasaran,
                     renstra_sasaran.`uraian_sasaran` AS renstra_sasaran_uraian_sasaran
                FROM
                      `renstra_sasaran` renstra_sasaran 
                     INNER JOIN `renstra_tujuan` renstra_tujuan ON renstra_sasaran.`renstra_tujuan_id` = renstra_tujuan.`id_renstra_tujuan`
                    INNER JOIN `renstra_misi` renstra_misi ON renstra_misi.`id_renstra_misi` = renstra_tujuan.`renstra_misi_id`
                    INNER JOIN `renstra_renstra` renstra_renstra ON renstra_renstra.`id_renstra_renstra` = renstra_misi.`renstra_renstra_id`
                     INNER JOIN `sikd_satker` sikd_satker ON renstra_renstra.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                     LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON renstra_renstra.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                WHERE
                     renstra_renstra.`id_renstra_renstra` = :id_renstra
                ORDER BY
                     renstra_sasaran.`kd_sasaran`";
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_renstra", $id_renstra);
            $statement->execute();
            $result = $statement->fetchAll();
            return new JsonResponse($result);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    private function getRenstraKbjknProgramSub1($id_sasaran)
    {
        try {
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $id_sasaran = $this->convertOuuidToUuid($id_sasaran);
            $this->connection = $conn->getConnection();
            $sql = "SELECT distinct
                    CONCAT_WS('-',
                            SUBSTR(HEX(renstra_rumusan_strategi.`renstra_sasaran_id`), 1, 8),
                            SUBSTR(HEX(renstra_rumusan_strategi.`renstra_sasaran_id`), 9, 4),
                            SUBSTR(HEX(renstra_rumusan_strategi.`renstra_sasaran_id`), 13, 4),
                            SUBSTR(HEX(renstra_rumusan_strategi.`renstra_sasaran_id`), 17, 4),
                            SUBSTR(HEX(renstra_rumusan_strategi.`renstra_sasaran_id`), 21)
                          ) AS renstra_rumusan_strategi_renstra_sasaran_id,
                    CONCAT_WS('-',
                            SUBSTR(HEX(renstra_arah_kebijakan.`id_renstra_arah_kebijakan`), 1, 8),
                            SUBSTR(HEX(renstra_arah_kebijakan.`id_renstra_arah_kebijakan`), 9, 4),
                            SUBSTR(HEX(renstra_arah_kebijakan.`id_renstra_arah_kebijakan`), 13, 4),
                            SUBSTR(HEX(renstra_arah_kebijakan.`id_renstra_arah_kebijakan`), 17, 4),
                            SUBSTR(HEX(renstra_arah_kebijakan.`id_renstra_arah_kebijakan`), 21)
                          ) AS renstra_arah_kebijakan_id_renstra_arah_kebijakan,
                     renstra_arah_kebijakan.`no_arah_kebijakan` AS renstra_arah_kebijakan_no_arah_kebijakan,
                     renstra_arah_kebijakan.`kd_arah_kebijakan` AS renstra_arah_kebijakan_kd_arah_kebijakan,
                     renstra_arah_kebijakan.`uraian_arah_kebijakan` AS renstra_arah_kebijakan_uraian_arah_kebijakan
                FROM
                     `renstra_rumusan_arah_kbjkn` renstra_rumusan_arah_kbjkn 
                     INNER JOIN `renstra_rumusan_strategi` renstra_rumusan_strategi ON renstra_rumusan_arah_kbjkn.`renstra_strategi_id` = renstra_rumusan_strategi.`renstra_strategi_id`
                     INNER JOIN `renstra_arah_kebijakan` renstra_arah_kebijakan ON renstra_rumusan_arah_kbjkn.`renstra_arah_kebijakan_id` = renstra_arah_kebijakan.`id_renstra_arah_kebijakan`
                WHERE
                     renstra_rumusan_strategi.`renstra_sasaran_id` = :id_sasaran    
                ORDER BY
                     renstra_arah_kebijakan.`kd_arah_kebijakan`";
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_sasaran", $id_sasaran);
            $statement->execute();
            $result = $statement->fetchAll();
            return new JsonResponse($result);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    private function getRenstraKbjknProgramSub2($id_sasaran)
    {
        try {
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $id_sasaran = $this->convertOuuidToUuid($id_sasaran);
            $this->connection = $conn->getConnection();
            $sql = "SELECT
                CONCAT_WS('-',
                        SUBSTR(HEX(renstra_indikator_sasaran.`id_renstra_indikator_sasaran`), 1, 8),
                        SUBSTR(HEX(renstra_indikator_sasaran.`id_renstra_indikator_sasaran`), 9, 4),
                        SUBSTR(HEX(renstra_indikator_sasaran.`id_renstra_indikator_sasaran`), 13, 4),
                        SUBSTR(HEX(renstra_indikator_sasaran.`id_renstra_indikator_sasaran`), 17, 4),
                        SUBSTR(HEX(renstra_indikator_sasaran.`id_renstra_indikator_sasaran`), 21)
                      ) AS renstra_indikator_sasaran_id_renstra_indikator_sasaran,
                 CONCAT_WS('-',
                        SUBSTR(HEX(renstra_indikator_sasaran.`renstra_sasaran_id`), 1, 8),
                        SUBSTR(HEX(renstra_indikator_sasaran.`renstra_sasaran_id`), 9, 4),
                        SUBSTR(HEX(renstra_indikator_sasaran.`renstra_sasaran_id`), 13, 4),
                        SUBSTR(HEX(renstra_indikator_sasaran.`renstra_sasaran_id`), 17, 4),
                        SUBSTR(HEX(renstra_indikator_sasaran.`renstra_sasaran_id`), 21)
                      ) AS renstra_indikator_sasaran_renstra_sasaran_id,
                     renstra_indikator_sasaran.`no_indikator` AS renstra_indikator_sasaran_no_indikator,
                     renstra_indikator_sasaran.`uraian_indikator` AS renstra_indikator_sasaran_uraian_indikator,
                     renstra_indikator_sasaran.`satuan` AS renstra_indikator_sasaran_satuan,
                     renstra_indikator_sasaran.`rumusan_satuan` AS renstra_indikator_sasaran_rumusan_satuan,
                     renstra_indikator_sasaran.`capaian_awal` AS renstra_indikator_sasaran_capaian_awal,
                     renstra_indikator_sasaran.`kondisi_akhir` AS renstra_indikator_sasaran_kondisi_akhir
                FROM
                     `renstra_indikator_sasaran` renstra_indikator_sasaran
                WHERE
                     renstra_indikator_sasaran.`renstra_sasaran_id` = :id_sasaran
                ORDER BY
                     renstra_indikator_sasaran.`no_indikator` ASC";
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_sasaran", $id_sasaran);
            $statement->execute();
            $result = $statement->fetchAll();
            return new JsonResponse($result);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    private function getRenstraKbjknProgramSub3($id_sasaran)
    {
        try {
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $id_sasaran = $this->convertOuuidToUuid($id_sasaran);
            $this->connection = $conn->getConnection();
            /*$sql = "SELECT
            CONCAT_WS('-',
                        SUBSTR(HEX(renstra_program.`id_renstra_program`), 1, 8),
                        SUBSTR(HEX(renstra_program.`id_renstra_program`), 9, 4),
                        SUBSTR(HEX(renstra_program.`id_renstra_program`), 13, 4),
                        SUBSTR(HEX(renstra_program.`id_renstra_program`), 17, 4),
                        SUBSTR(HEX(renstra_program.`id_renstra_program`), 21)
                      ) AS renstra_program_id_renstra_program,
            CONCAT_WS('-',
                        SUBSTR(HEX(renstra_program.`renstra_sasaran_id`), 1, 8),
                        SUBSTR(HEX(renstra_program.`renstra_sasaran_id`), 9, 4),
                        SUBSTR(HEX(renstra_program.`renstra_sasaran_id`), 13, 4),
                        SUBSTR(HEX(renstra_program.`renstra_sasaran_id`), 17, 4),
                        SUBSTR(HEX(renstra_program.`renstra_sasaran_id`), 21)
                      ) AS renstra_program_renstra_sasaran_id,
            CONCAT_WS('-',
                        SUBSTR(HEX(renstra_program.`sikd_bidang_id`), 1, 8),
                        SUBSTR(HEX(renstra_program.`sikd_bidang_id`), 9, 4),
                        SUBSTR(HEX(renstra_program.`sikd_bidang_id`), 13, 4),
                        SUBSTR(HEX(renstra_program.`sikd_bidang_id`), 17, 4),
                        SUBSTR(HEX(renstra_program.`sikd_bidang_id`), 21)
                      ) AS renstra_program_sikd_bidang_id,
             renstra_program.`kd_program` AS renstra_program_kd_program,
             renstra_program.`uraian_program` AS renstra_program_uraian_program,
             renstra_program.`prioritas_program` AS renstra_program_prioritas_program,
             renstra_program.`keterangan` AS renstra_program_keterangan
        FROM
            `renstra_program` renstra_program 
        WHERE 
             renstra_program.`renstra_sasaran_id` = :id_sasaran
        ORDER BY
             renstra_program.`kd_program`";*/

            $sql = "SELECT
                     CONCAT_WS('-',
                        SUBSTR(HEX(renstra_program.`id_renstra_program`), 1, 8),
                        SUBSTR(HEX(renstra_program.`id_renstra_program`), 9, 4),
                        SUBSTR(HEX(renstra_program.`id_renstra_program`), 13, 4),
                        SUBSTR(HEX(renstra_program.`id_renstra_program`), 17, 4),
                        SUBSTR(HEX(renstra_program.`id_renstra_program`), 21)
                      ) AS renstra_program_id_renstra_program,
                     CONCAT_WS('-',
                        SUBSTR(HEX(renstra_program.`renstra_sasaran_id`), 1, 8),
                        SUBSTR(HEX(renstra_program.`renstra_sasaran_id`), 9, 4),
                        SUBSTR(HEX(renstra_program.`renstra_sasaran_id`), 13, 4),
                        SUBSTR(HEX(renstra_program.`renstra_sasaran_id`), 17, 4),
                        SUBSTR(HEX(renstra_program.`renstra_sasaran_id`), 21)
                      ) AS renstra_program_renstra_sasaran_id,
                     CONCAT_WS('-',
                        SUBSTR(HEX(renstra_program.`sikd_bidang_id`), 1, 8),
                        SUBSTR(HEX(renstra_program.`sikd_bidang_id`), 9, 4),
                        SUBSTR(HEX(renstra_program.`sikd_bidang_id`), 13, 4),
                        SUBSTR(HEX(renstra_program.`sikd_bidang_id`), 17, 4),
                        SUBSTR(HEX(renstra_program.`sikd_bidang_id`), 21)
                      ) AS renstra_program_sikd_bidang_id,
                     sikd_bidang.`kd_bidang` AS sikd_bidang_kd_bidang,
                     sikd_bidang.`nm_bidang` AS sikd_bidang_nm_bidang,
                     renstra_program.`kd_program` AS renstra_program_kd_program,
                     renstra_program.`uraian_program` AS renstra_program_uraian_program,
                     renstra_program.`prioritas_program` AS renstra_program_prioritas_program,
                     renstra_program.`keterangan` AS renstra_program_keterangan
                FROM
                     `sikd_bidang` sikd_bidang 
                     INNER JOIN `renstra_program` renstra_program ON sikd_bidang.`id_sikd_bidang` = renstra_program.`sikd_bidang_id`
                WHERE 
                     renstra_program.`renstra_sasaran_id` = :id_sasaran
                ORDER BY
                     renstra_program.`kd_program`";
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_sasaran", $id_sasaran);
            $statement->execute();
            $result = $statement->fetchAll();
            return new JsonResponse($result);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    private function getRenstraIndikasiProgram($id_renstra)
    {
        try {
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $id_renstra = $this->convertOuuidToUuid($id_renstra);
            $this->connection = $conn->getConnection();
            /*$sql = "SELECT
                    CONCAT_WS('-',
                        SUBSTR(HEX(renstra_program.`sikd_prog_id`), 1, 8),
                        SUBSTR(HEX(renstra_program.`sikd_prog_id`), 9, 4),
                        SUBSTR(HEX(renstra_program.`sikd_prog_id`), 13, 4),
                        SUBSTR(HEX(renstra_program.`sikd_prog_id`), 17, 4),
                        SUBSTR(HEX(renstra_program.`sikd_prog_id`), 21)
                      ) AS renstra_program_sikd_prog_id,
                    CONCAT_WS('-',
                        SUBSTR(HEX(renstra_program.`id_renstra_program`), 1, 8),
                        SUBSTR(HEX(renstra_program.`id_renstra_program`), 9, 4),
                        SUBSTR(HEX(renstra_program.`id_renstra_program`), 13, 4),
                        SUBSTR(HEX(renstra_program.`id_renstra_program`), 17, 4),
                        SUBSTR(HEX(renstra_program.`id_renstra_program`), 21)
                      ) AS renstra_program_id_renstra_program,
                         renstra_program.`kd_program` AS renstra_program_kd_program,
                         renstra_program.`uraian_program` AS renstra_program_uraian_program,
                         renstra_program.`prioritas_program` AS renstra_program_prioritas_program,
                         renstra_program.`keterangan` AS renstra_program_keterangan,
                    CONCAT_WS('-',
                        SUBSTR(HEX(renstra_renstra.`id_renstra_renstra`), 1, 8),
                        SUBSTR(HEX(renstra_renstra.`id_renstra_renstra`), 9, 4),
                        SUBSTR(HEX(renstra_renstra.`id_renstra_renstra`), 13, 4),
                        SUBSTR(HEX(renstra_renstra.`id_renstra_renstra`), 17, 4),
                        SUBSTR(HEX(renstra_renstra.`id_renstra_renstra`), 21)
                      ) AS renstra_renstra_id_renstra_renstra,
                    CONCAT_WS('-',
                        SUBSTR(HEX(renstra_renstra.`sikd_satker_id`), 1, 8),
                        SUBSTR(HEX(renstra_renstra.`sikd_satker_id`), 9, 4),
                        SUBSTR(HEX(renstra_renstra.`sikd_satker_id`), 13, 4),
                        SUBSTR(HEX(renstra_renstra.`sikd_satker_id`), 17, 4),
                        SUBSTR(HEX(renstra_renstra.`sikd_satker_id`), 21)
                      ) AS renstra_renstra_sikd_satker_id,
                         renstra_renstra.`periode` AS renstra_renstra_periode,
                         SUM(IFNULL(renstra_kegiatan.jml_anggaran_thn_1,0)) jml_anggaran_tahun_1,
                         SUM(IFNULL(renstra_kegiatan.jml_anggaran_thn_2,0)) jml_anggaran_tahun_2,
                         SUM(IFNULL(renstra_kegiatan.jml_anggaran_thn_3,0)) jml_anggaran_tahun_3,
                         SUM(IFNULL(renstra_kegiatan.jml_anggaran_thn_4,0)) jml_anggaran_tahun_4,
                         SUM(IFNULL(renstra_kegiatan.jml_anggaran_thn_5,0)) jml_anggaran_tahun_5
                    FROM
                         `renstra_program` renstra_program
                         INNER JOIN `renstra_sasaran` renstra_sasaran ON renstra_program.`renstra_sasaran_id` = renstra_sasaran.`id_renstra_sasaran`
                         INNER JOIN `renstra_tujuan` renstra_tujuan ON renstra_sasaran.`renstra_tujuan_id` = renstra_tujuan.`id_renstra_tujuan`
                    INNER JOIN `renstra_misi` renstra_misi ON renstra_misi.`id_renstra_misi` = renstra_tujuan.`renstra_misi_id`
                    INNER JOIN `renstra_renstra` renstra_renstra ON renstra_renstra.`id_renstra_renstra` = renstra_misi.`renstra_renstra_id`
                    LEFT OUTER JOIN `renstra_kegiatan` renstra_kegiatan ON renstra_program.`id_renstra_program` = renstra_kegiatan.`renstra_program_id`
                    WHERE
                         renstra_renstra.`id_renstra_renstra` = :id_renstra
                    GROUP BY
                         renstra_program.`id_renstra_program`
                    ORDER BY
                         renstra_program.`kd_program`";*/
            $sql = "SELECT
                     CONCAT_WS('-',
                        SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 1, 8),
                        SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 9, 4),
                        SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 13, 4),
                        SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 17, 4),
                        SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 21)
                      ) AS id_sikd_satker,
                     sikd_satker.`kode` AS kd_satker,
                     sikd_satker.`nama` AS nm_satker,
                     CONCAT_WS('-',
                        SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 1, 8),
                        SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 9, 4),
                        SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 13, 4),
                        SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 17, 4),
                        SUBSTR(HEX(sikd_sub_skpd.`id_sikd_sub_skpd`), 21)
                      ) AS id_sub_skpd,
                     sikd_sub_skpd.`kode` AS kd_sub_skpd,
                     sikd_sub_skpd.`nama` AS nm_sub_skpd,
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
                     SUBSTR(sikd_bidang.`kd_bidang`,2,2) AS sikd_bidang_kd_bidang,
                     sikd_bidang.`nm_bidang` AS sikd_bidang_nm_bidang,
                     sikd_prog.`kd_prog` AS sikd_prog_kd_prog,
                     CONCAT_WS('-',
                        SUBSTR(HEX(renstra_program.`id_renstra_program`), 1, 8),
                        SUBSTR(HEX(renstra_program.`id_renstra_program`), 9, 4),
                        SUBSTR(HEX(renstra_program.`id_renstra_program`), 13, 4),
                        SUBSTR(HEX(renstra_program.`id_renstra_program`), 17, 4),
                        SUBSTR(HEX(renstra_program.`id_renstra_program`), 21)
                      ) AS renstra_program_id_renstra_program,
                     renstra_program.`kd_program` AS renstra_program_kd_program,
                     renstra_program.`uraian_program` AS renstra_program_uraian_program,
                     renstra_program.`prioritas_program` AS renstra_program_prioritas_program,
                     renstra_program.`keterangan` AS renstra_program_keterangan,
                     CONCAT_WS('-',
                        SUBSTR(HEX(renstra_renstra.`id_renstra_renstra`), 1, 8),
                        SUBSTR(HEX(renstra_renstra.`id_renstra_renstra`), 9, 4),
                        SUBSTR(HEX(renstra_renstra.`id_renstra_renstra`), 13, 4),
                        SUBSTR(HEX(renstra_renstra.`id_renstra_renstra`), 17, 4),
                        SUBSTR(HEX(renstra_renstra.`id_renstra_renstra`), 21)
                      ) AS renstra_renstra_id_renstra_renstra,
                     renstra_renstra.`periode` AS renstra_renstra_periode,
                     SUM(IFNULL(renstra_kegiatan.jml_anggaran_thn_1,0)) jml_anggaran_tahun_1,
                     SUM(IFNULL(renstra_kegiatan.jml_anggaran_thn_2,0)) jml_anggaran_tahun_2,
                     SUM(IFNULL(renstra_kegiatan.jml_anggaran_thn_3,0)) jml_anggaran_tahun_3,
                     SUM(IFNULL(renstra_kegiatan.jml_anggaran_thn_4,0)) jml_anggaran_tahun_4,
                     SUM(IFNULL(renstra_kegiatan.jml_anggaran_thn_5,0)) jml_anggaran_tahun_5
                FROM
                     `sikd_urusan` sikd_urusan 
                     INNER JOIN `sikd_bidang` sikd_bidang ON sikd_urusan.`id_sikd_urusan` = sikd_bidang.`sikd_urusan_id`
                     INNER JOIN `renstra_program` renstra_program ON sikd_bidang.`id_sikd_bidang` = renstra_program.`sikd_bidang_id`
                     INNER JOIN `renstra_sasaran` renstra_sasaran ON renstra_program.`renstra_sasaran_id` = renstra_sasaran.`id_renstra_sasaran`
                     INNER JOIN `renstra_tujuan` renstra_tujuan ON renstra_sasaran.`renstra_tujuan_id` = renstra_tujuan.`id_renstra_tujuan`
                    INNER JOIN `renstra_misi` renstra_misi ON renstra_misi.`id_renstra_misi` = renstra_tujuan.`renstra_misi_id`
                    INNER JOIN `renstra_renstra` renstra_renstra ON renstra_renstra.`id_renstra_renstra` = renstra_misi.`renstra_renstra_id`
                    LEFT OUTER JOIN `renstra_kegiatan` renstra_kegiatan ON renstra_program.`id_renstra_program` = renstra_kegiatan.`renstra_program_id`
                     INNER JOIN `sikd_prog` sikd_prog ON renstra_program.`sikd_prog_id` = sikd_prog.`id_sikd_prog`
                     INNER JOIN `sikd_satker` sikd_satker ON sikd_satker.`id_sikd_satker` = renstra_renstra.`sikd_satker_id`
                     LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON sikd_sub_skpd.`id_sikd_sub_skpd` = renstra_renstra.`sikd_sub_skpd_id`
                WHERE
                     renstra_renstra.`id_renstra_renstra` = :id_renstra
                GROUP BY
                     sikd_urusan.`id_sikd_urusan`,
                     sikd_bidang.`id_sikd_bidang`,
                     renstra_program.`id_renstra_program`
                ORDER BY
                     sikd_urusan.`kd_urusan`,
                     sikd_bidang.`kd_bidang`,
                     renstra_program.`kd_program`";
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_renstra", $id_renstra);
            $statement->execute();
            $result = $statement->fetchAll();
            return new JsonResponse($result);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    private function getRenstraIndikasiProgramSub($id_program)
    {
        try {
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $id_program = $this->convertOuuidToUuid($id_program);
            $this->connection = $conn->getConnection();
            $sql = "SELECT
                    CONCAT_WS('-',
                        SUBSTR(HEX(renstra_indikator_program.`renstra_program_id`), 1, 8),
                        SUBSTR(HEX(renstra_indikator_program.`renstra_program_id`), 9, 4),
                        SUBSTR(HEX(renstra_indikator_program.`renstra_program_id`), 13, 4),
                        SUBSTR(HEX(renstra_indikator_program.`renstra_program_id`), 17, 4),
                        SUBSTR(HEX(renstra_indikator_program.`renstra_program_id`), 21)
                      ) AS renstra_indikator_program_renstra_program_id,
                      CONCAT_WS('-',
                        SUBSTR(HEX(renstra_indikator_program.`id_renstra_indikator_program`), 1, 8),
                        SUBSTR(HEX(renstra_indikator_program.`id_renstra_indikator_program`), 9, 4),
                        SUBSTR(HEX(renstra_indikator_program.`id_renstra_indikator_program`), 13, 4),
                        SUBSTR(HEX(renstra_indikator_program.`id_renstra_indikator_program`), 17, 4),
                        SUBSTR(HEX(renstra_indikator_program.`id_renstra_indikator_program`), 21)
                      ) AS id_renstra_indikator_program,
                     renstra_indikator_program.`no_indikator` AS no_indikator,
                     renstra_indikator_program.`uraian_indikator` AS uraian_indikator,
                     renstra_indikator_program.`satuan` AS satuan,
                     renstra_indikator_program.`capaian_awal` AS capaian_awal,
                     renstra_indikator_program.`target_tahun_1` AS target_tahun_1,
                     renstra_indikator_program.`target_tahun_2` AS target_tahun_2,
                     renstra_indikator_program.`target_tahun_3` AS target_tahun_3,
                     renstra_indikator_program.`target_tahun_4` AS target_tahun_4,
                     renstra_indikator_program.`target_tahun_5` AS target_tahun_5,
                     renstra_indikator_program.`kondisi_akhir` AS kondisi_akhir
                FROM
                     `renstra_indikator_program` renstra_indikator_program 
                WHERE
                     renstra_indikator_program.`renstra_program_id` = :id_program
                ORDER BY
                     renstra_indikator_program.`no_indikator`";
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_program", $id_program);
            $statement->execute();
            $result = $statement->fetchAll();
            return new JsonResponse($result);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    private function getRenstraProgKgtnPrioritas()
    {
        try {
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $this->connection = $conn->getConnection();
            /*$sql = "SELECT
                    CONCAT_WS('-',
                        SUBSTR(HEX(renstra_program.`sikd_bidang_id`), 1, 8),
                        SUBSTR(HEX(renstra_program.`sikd_bidang_id`), 9, 4),
                        SUBSTR(HEX(renstra_program.`sikd_bidang_id`), 13, 4),
                        SUBSTR(HEX(renstra_program.`sikd_bidang_id`), 17, 4),
                        SUBSTR(HEX(renstra_program.`sikd_bidang_id`), 21)
                      ) AS renstra_program_sikd_bidang_id,
                    CONCAT_WS('-',
                        SUBSTR(HEX(renstra_renstra.`sikd_satker_id`), 1, 8),
                        SUBSTR(HEX(renstra_renstra.`sikd_satker_id`), 9, 4),
                        SUBSTR(HEX(renstra_renstra.`sikd_satker_id`), 13, 4),
                        SUBSTR(HEX(renstra_renstra.`sikd_satker_id`), 17, 4),
                        SUBSTR(HEX(renstra_renstra.`sikd_satker_id`), 21)
                      ) AS renstra_renstra_sikd_satker_id,
                    CONCAT_WS('-',
                        SUBSTR(HEX(renstra_renstra.`sikd_sub_skpd_id`), 1, 8),
                        SUBSTR(HEX(renstra_renstra.`sikd_sub_skpd_id`), 9, 4),
                        SUBSTR(HEX(renstra_renstra.`sikd_sub_skpd_id`), 13, 4),
                        SUBSTR(HEX(renstra_renstra.`sikd_sub_skpd_id`), 17, 4),
                        SUBSTR(HEX(renstra_renstra.`sikd_sub_skpd_id`), 21)
                      ) AS renstra_renstra_sikd_sub_skpd_id,
                    CONCAT_WS('-',
                        SUBSTR(HEX(renstra_renstra.`id_renstra_renstra`), 1, 8),
                        SUBSTR(HEX(renstra_renstra.`id_renstra_renstra`), 9, 4),
                        SUBSTR(HEX(renstra_renstra.`id_renstra_renstra`), 13, 4),
                        SUBSTR(HEX(renstra_renstra.`id_renstra_renstra`), 17, 4),
                        SUBSTR(HEX(renstra_renstra.`id_renstra_renstra`), 21)
                      ) AS id_renstra,
                     renstra_renstra.`periode` AS renstra_periode,
                     CONCAT_WS('-',
                        SUBSTR(HEX(renstra_tujuan.`id_renstra_tujuan`), 1, 8),
                        SUBSTR(HEX(renstra_tujuan.`id_renstra_tujuan`), 9, 4),
                        SUBSTR(HEX(renstra_tujuan.`id_renstra_tujuan`), 13, 4),
                        SUBSTR(HEX(renstra_tujuan.`id_renstra_tujuan`), 17, 4),
                        SUBSTR(HEX(renstra_tujuan.`id_renstra_tujuan`), 21)
                      ) AS id_renstra_tujuan,
                     renstra_tujuan.`kd_tujuan` AS kd_tujuan,
                     renstra_tujuan.`uraian_tujuan` AS uraian_tujuan,
                     CONCAT_WS('-',
                        SUBSTR(HEX(renstra_sasaran.`id_renstra_sasaran`), 1, 8),
                        SUBSTR(HEX(renstra_sasaran.`id_renstra_sasaran`), 9, 4),
                        SUBSTR(HEX(renstra_sasaran.`id_renstra_sasaran`), 13, 4),
                        SUBSTR(HEX(renstra_sasaran.`id_renstra_sasaran`), 17, 4),
                        SUBSTR(HEX(renstra_sasaran.`id_renstra_sasaran`), 21)
                      ) AS id_renstra_sasaran,
                     renstra_sasaran.`kd_sasaran` AS kd_sasaran,
                     renstra_sasaran.`uraian_sasaran` AS uraian_sasaran,
                     CONCAT_WS('-',
                        SUBSTR(HEX(renstra_program.`id_renstra_program`), 1, 8),
                        SUBSTR(HEX(renstra_program.`id_renstra_program`), 9, 4),
                        SUBSTR(HEX(renstra_program.`id_renstra_program`), 13, 4),
                        SUBSTR(HEX(renstra_program.`id_renstra_program`), 17, 4),
                        SUBSTR(HEX(renstra_program.`id_renstra_program`), 21)
                      ) AS id_renstra_program,
                     renstra_program.`kd_program` AS kd_program,
                     renstra_program.`uraian_program` AS uraian_program,
                     CONCAT_WS('-',
                        SUBSTR(HEX(renstra_kegiatan.`id_renstra_kegiatan`), 1, 8),
                        SUBSTR(HEX(renstra_kegiatan.`id_renstra_kegiatan`), 9, 4),
                        SUBSTR(HEX(renstra_kegiatan.`id_renstra_kegiatan`), 13, 4),
                        SUBSTR(HEX(renstra_kegiatan.`id_renstra_kegiatan`), 17, 4),
                        SUBSTR(HEX(renstra_kegiatan.`id_renstra_kegiatan`), 21)
                      ) AS id_renstra_kegiatan,
                     renstra_kegiatan.`kd_kgtn` AS kd_kegiatan,
                     renstra_kegiatan.`nm_kgtn` AS nm_kegiatan,
                     renstra_kegiatan.`jml_anggaran_thn_1` AS jml_anggaran_tahun_1,
                     renstra_kegiatan.`jml_anggaran_thn_2` AS jml_anggaran_tahun_2,
                     renstra_kegiatan.`jml_anggaran_thn_3` AS jml_anggaran_tahun_3,
                     renstra_kegiatan.`jml_anggaran_thn_4` AS jml_anggaran_tahun_4,
                     renstra_kegiatan.`jml_anggaran_thn_5` AS jml_anggaran_tahun_5,
                     renstra_kegiatan.`jml_anggaran_thn_6` AS jml_anggaran_tahun_6
                FROM
                     `renstra_tujuan` renstra_tujuan 
                     INNER JOIN `renstra_sasaran` renstra_sasaran ON renstra_tujuan.`id_renstra_tujuan` = renstra_sasaran.`renstra_tujuan_id`
                     INNER JOIN `renstra_program` renstra_program ON renstra_sasaran.`id_renstra_sasaran` = renstra_program.`renstra_sasaran_id`
                     INNER JOIN `renstra_kegiatan` renstra_kegiatan ON renstra_program.`id_renstra_program` = renstra_kegiatan.`renstra_program_id`
                     INNER JOIN `renstra_misi` renstra_misi ON renstra_misi.`id_renstra_misi` = renstra_tujuan.`renstra_misi_id`
                    INNER JOIN `renstra_renstra` renstra_renstra ON renstra_renstra.`id_renstra_renstra` = renstra_misi.`renstra_renstra_id`
                ORDER BY 
                     renstra_tujuan.`kd_tujuan`, renstra_sasaran.`kd_sasaran`,
                     renstra_kegiatan.`kd_kgtn`";*/
            $sql = "SELECT
                         CONCAT_WS('-',
                            SUBSTR(HEX(renstra_renstra.`id_renstra_renstra`), 1, 8),
                            SUBSTR(HEX(renstra_renstra.`id_renstra_renstra`), 9, 4),
                            SUBSTR(HEX(renstra_renstra.`id_renstra_renstra`), 13, 4),
                            SUBSTR(HEX(renstra_renstra.`id_renstra_renstra`), 17, 4),
                            SUBSTR(HEX(renstra_renstra.`id_renstra_renstra`), 21)
                          )  AS id_renstra,
                         CONCAT_WS('-',
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 1, 8),
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 9, 4),
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 13, 4),
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 17, 4),
                            SUBSTR(HEX(sikd_satker.`id_sikd_satker`), 21)
                          ) AS id_sikd_satker,
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
                         renstra_renstra.`periode` AS renstra_periode,
                         CONCAT_WS('-',
                            SUBSTR(HEX(renstra_tujuan.`id_renstra_tujuan`), 1, 8),
                            SUBSTR(HEX(renstra_tujuan.`id_renstra_tujuan`), 9, 4),
                            SUBSTR(HEX(renstra_tujuan.`id_renstra_tujuan`), 13, 4),
                            SUBSTR(HEX(renstra_tujuan.`id_renstra_tujuan`), 17, 4),
                            SUBSTR(HEX(renstra_tujuan.`id_renstra_tujuan`), 21)
                          ) AS id_renstra_tujuan,
                         renstra_tujuan.`kd_tujuan` AS kd_tujuan,
                         renstra_tujuan.`uraian_tujuan` AS uraian_tujuan,
                         CONCAT_WS('-',
                            SUBSTR(HEX(renstra_sasaran.`id_renstra_sasaran`), 1, 8),
                            SUBSTR(HEX(renstra_sasaran.`id_renstra_sasaran`), 9, 4),
                            SUBSTR(HEX(renstra_sasaran.`id_renstra_sasaran`), 13, 4),
                            SUBSTR(HEX(renstra_sasaran.`id_renstra_sasaran`), 17, 4),
                            SUBSTR(HEX(renstra_sasaran.`id_renstra_sasaran`), 21)
                          ) AS id_renstra_sasaran,
                         renstra_sasaran.`kd_sasaran` AS kd_sasaran,
                         renstra_sasaran.`uraian_sasaran` AS uraian_sasaran,
                         CONCAT_WS('-',
                            SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 1, 8),
                            SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 9, 4),
                            SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 13, 4),
                            SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 17, 4),
                            SUBSTR(HEX(sikd_bidang.`id_sikd_bidang`), 21)
                          ) AS id_sikd_bidang,
                         sikd_bidang.`kd_bidang` AS kd_bidang,
                         sikd_bidang.`nm_bidang` AS nm_bidang,
                         CONCAT_WS('-',
                            SUBSTR(HEX(renstra_program.`id_renstra_program`), 1, 8),
                            SUBSTR(HEX(renstra_program.`id_renstra_program`), 9, 4),
                            SUBSTR(HEX(renstra_program.`id_renstra_program`), 13, 4),
                            SUBSTR(HEX(renstra_program.`id_renstra_program`), 17, 4),
                            SUBSTR(HEX(renstra_program.`id_renstra_program`), 21)
                          ) AS id_renstra_program,
                         renstra_program.`kd_program` AS kd_program,
                         renstra_program.`uraian_program` AS uraian_program,
                         CONCAT_WS('-',
                            SUBSTR(HEX(renstra_kegiatan.`id_renstra_kegiatan`), 1, 8),
                            SUBSTR(HEX(renstra_kegiatan.`id_renstra_kegiatan`), 9, 4),
                            SUBSTR(HEX(renstra_kegiatan.`id_renstra_kegiatan`), 13, 4),
                            SUBSTR(HEX(renstra_kegiatan.`id_renstra_kegiatan`), 17, 4),
                            SUBSTR(HEX(renstra_kegiatan.`id_renstra_kegiatan`), 21)
                          ) AS id_renstra_kegiatan,
                         renstra_kegiatan.`kd_kgtn` AS kd_kegiatan,
                         renstra_kegiatan.`nm_kgtn` AS nm_kegiatan,
                         renstra_kegiatan.`jml_anggaran_thn_1` AS jml_anggaran_tahun_1,
                         renstra_kegiatan.`jml_anggaran_thn_2` AS jml_anggaran_tahun_2,
                         renstra_kegiatan.`jml_anggaran_thn_3` AS jml_anggaran_tahun_3,
                         renstra_kegiatan.`jml_anggaran_thn_4` AS jml_anggaran_tahun_4,
                         renstra_kegiatan.`jml_anggaran_thn_5` AS jml_anggaran_tahun_5,
                         renstra_kegiatan.`jml_anggaran_thn_6` AS jml_anggaran_tahun_6
                    FROM
                         `renstra_tujuan` renstra_tujuan 
                     INNER JOIN `renstra_sasaran` renstra_sasaran ON renstra_tujuan.`id_renstra_tujuan` = renstra_sasaran.`renstra_tujuan_id`
                     INNER JOIN `renstra_program` renstra_program ON renstra_sasaran.`id_renstra_sasaran` = renstra_program.`renstra_sasaran_id`
                     INNER JOIN `renstra_kegiatan` renstra_kegiatan ON renstra_program.`id_renstra_program` = renstra_kegiatan.`renstra_program_id`
                     INNER JOIN `renstra_misi` renstra_misi ON renstra_misi.`id_renstra_misi` = renstra_tujuan.`renstra_misi_id`
                    INNER JOIN `renstra_renstra` renstra_renstra ON renstra_renstra.`id_renstra_renstra` = renstra_misi.`renstra_renstra_id`
                         INNER JOIN `sikd_bidang` sikd_bidang ON renstra_program.`sikd_bidang_id` = sikd_bidang.`id_sikd_bidang`
                         INNER JOIN `sikd_satker` sikd_satker ON renstra_renstra.`sikd_satker_id` = sikd_satker.`id_sikd_satker`
                         LEFT OUTER JOIN `sikd_sub_skpd` sikd_sub_skpd ON renstra_renstra.`sikd_sub_skpd_id` = sikd_sub_skpd.`id_sikd_sub_skpd`
                    ORDER BY 
                         sikd_satker.`kode`, sikd_sub_skpd.`kode`,
                         renstra_tujuan.`kd_tujuan`, renstra_sasaran.`kd_sasaran`,
                         sikd_bidang.`kd_bidang`, renstra_program.`kd_program`,
                         renstra_kegiatan.`kd_kgtn`";
            $statement = $this->connection->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();

            return new JsonResponse($result);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    private function getRenstraProgKgtnPrioritasSub1($id_sasaran)
    {
        try {
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $id_sasaran = $this->convertOuuidToUuid($id_sasaran);
            $this->connection = $conn->getConnection();
            $sql = "SELECT
                     CONCAT_WS('-',
                        SUBSTR(HEX(renstra_indikator_sasaran.`id_renstra_indikator_sasaran`), 1, 8),
                        SUBSTR(HEX(renstra_indikator_sasaran.`id_renstra_indikator_sasaran`), 9, 4),
                        SUBSTR(HEX(renstra_indikator_sasaran.`id_renstra_indikator_sasaran`), 13, 4),
                        SUBSTR(HEX(renstra_indikator_sasaran.`id_renstra_indikator_sasaran`), 17, 4),
                        SUBSTR(HEX(renstra_indikator_sasaran.`id_renstra_indikator_sasaran`), 21)
                      ) AS renstra_indikator_sasaran_id_renstra_indikator_sasaran,
                      CONCAT_WS('-',
                        SUBSTR(HEX(renstra_indikator_sasaran.`renstra_sasaran_id`), 1, 8),
                        SUBSTR(HEX(renstra_indikator_sasaran.`renstra_sasaran_id`), 9, 4),
                        SUBSTR(HEX(renstra_indikator_sasaran.`renstra_sasaran_id`), 13, 4),
                        SUBSTR(HEX(renstra_indikator_sasaran.`renstra_sasaran_id`), 17, 4),
                        SUBSTR(HEX(renstra_indikator_sasaran.`renstra_sasaran_id`), 21)
                      ) AS renstra_indikator_sasaran_renstra_sasaran_id,
                     renstra_indikator_sasaran.`no_indikator` AS renstra_indikator_sasaran_no_indikator,
                     renstra_indikator_sasaran.`uraian_indikator` AS renstra_indikator_sasaran_uraian_indikator,
                     renstra_indikator_sasaran.`satuan` AS renstra_indikator_sasaran_satuan,
                     renstra_indikator_sasaran.`rumusan_satuan` AS renstra_indikator_sasaran_rumusan_satuan,
                     renstra_indikator_sasaran.`capaian_awal` AS renstra_indikator_sasaran_capaian_awal,
                     renstra_indikator_sasaran.`kondisi_akhir` AS renstra_indikator_sasaran_kondisi_akhir
                FROM
                     `renstra_indikator_sasaran` renstra_indikator_sasaran
                WHERE
                     renstra_indikator_sasaran.`renstra_sasaran_id` = :id_sasaran
                ORDER BY
                     renstra_indikator_sasaran.`no_indikator` ASC";
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_sasaran", $id_sasaran);
            $statement->execute();
            $result = $statement->fetchAll();
            return new JsonResponse($result);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    private function getRenstraProgKgtnPrioritasSub2($id_program)
    {
        try {
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $id_program = $this->convertOuuidToUuid($id_program);
            $this->connection = $conn->getConnection();
            $sql = "SELECT
                    CONCAT_WS('-',
                        SUBSTR(HEX(renstra_indikator_program.`id_renstra_indikator_program`), 1, 8),
                        SUBSTR(HEX(renstra_indikator_program.`id_renstra_indikator_program`), 9, 4),
                        SUBSTR(HEX(renstra_indikator_program.`id_renstra_indikator_program`), 13, 4),
                        SUBSTR(HEX(renstra_indikator_program.`id_renstra_indikator_program`), 17, 4),
                        SUBSTR(HEX(renstra_indikator_program.`id_renstra_indikator_program`), 21)
                      ) AS id_renstra_indikator_program,
                      CONCAT_WS('-',
                        SUBSTR(HEX(renstra_indikator_program.`renstra_program_id`), 1, 8),
                        SUBSTR(HEX(renstra_indikator_program.`renstra_program_id`), 9, 4),
                        SUBSTR(HEX(renstra_indikator_program.`renstra_program_id`), 13, 4),
                        SUBSTR(HEX(renstra_indikator_program.`renstra_program_id`), 17, 4),
                        SUBSTR(HEX(renstra_indikator_program.`renstra_program_id`), 21)
                      ) AS renstra_program_id,
                     renstra_indikator_program.`no_indikator` AS no_indikator,
                     renstra_indikator_program.`uraian_indikator` AS uraian_indikator,
                     renstra_indikator_program.`satuan` AS satuan,
                     concat(renstra_indikator_program.`capaian_awal`,' ',renstra_indikator_program.`satuan`) AS capaian_awal,
                     renstra_indikator_program.`target_tahun_1` AS target_tahun_1,
                     renstra_indikator_program.`target_tahun_2` AS target_tahun_2,
                     renstra_indikator_program.`target_tahun_3` AS target_tahun_3,
                     renstra_indikator_program.`target_tahun_4` AS target_tahun_4,
                     renstra_indikator_program.`target_tahun_6` AS target_tahun_6,
                     renstra_indikator_program.`target_tahun_5` AS target_tahun_5,
                     renstra_indikator_program.`kondisi_akhir` AS kondisi_akhir
                FROM
                     `renstra_indikator_program` renstra_indikator_program
                WHERE
                     renstra_indikator_program.renstra_program_id = :id_program
                ORDER BY
                     renstra_indikator_program.`no_indikator`";
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_program", $id_program);
            $statement->execute();
            $result = $statement->fetchAll();
            return new JsonResponse($result);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    private function getRenstraProgKgtnPrioritasSub3($id_kegiatan)
    {
        try {
            $conn = $this->getDoctrine()->getManager($this->readEntityManagerName);
            $id_kegiatan = $this->convertOuuidToUuid($id_kegiatan);
            $this->connection = $conn->getConnection();
            $sql = "SELECT
                    CONCAT_WS('-',
                        SUBSTR(HEX(renstra_indikator_kegiatan.`id_renstra_indikator_kegiatan`), 1, 8),
                        SUBSTR(HEX(renstra_indikator_kegiatan.`id_renstra_indikator_kegiatan`), 9, 4),
                        SUBSTR(HEX(renstra_indikator_kegiatan.`id_renstra_indikator_kegiatan`), 13, 4),
                        SUBSTR(HEX(renstra_indikator_kegiatan.`id_renstra_indikator_kegiatan`), 17, 4),
                        SUBSTR(HEX(renstra_indikator_kegiatan.`id_renstra_indikator_kegiatan`), 21)
                      ) AS id_renstra_indikator_kegiatan,
                     CONCAT_WS('-',
                        SUBSTR(HEX(renstra_indikator_kegiatan.`renstra_kegiatan_id`), 1, 8),
                        SUBSTR(HEX(renstra_indikator_kegiatan.`renstra_kegiatan_id`), 9, 4),
                        SUBSTR(HEX(renstra_indikator_kegiatan.`renstra_kegiatan_id`), 13, 4),
                        SUBSTR(HEX(renstra_indikator_kegiatan.`renstra_kegiatan_id`), 17, 4),
                        SUBSTR(HEX(renstra_indikator_kegiatan.`renstra_kegiatan_id`), 21)
                      ) AS renstra_kegiatan_id,
                     renstra_indikator_kegiatan.`no_indikator` AS no_indikator,
                     renstra_indikator_kegiatan.`uraian_indikator` AS uraian_indikator,
                     renstra_indikator_kegiatan.`satuan` AS satuan,
                     concat(renstra_indikator_kegiatan.`capaian_awal`,' ',renstra_indikator_kegiatan.`satuan`) AS capaian_awal,
                     renstra_indikator_kegiatan.`target_tahun_1` AS target_tahun_1,
                     renstra_indikator_kegiatan.`target_tahun_2` AS target_tahun_2,
                     renstra_indikator_kegiatan.`target_tahun_3` AS target_tahun_3,
                     renstra_indikator_kegiatan.`target_tahun_4` AS target_tahun_4,
                     renstra_indikator_kegiatan.`target_tahun_6` AS target_tahun_6,
                     renstra_indikator_kegiatan.`target_tahun_5` AS target_tahun_5,
                     renstra_indikator_kegiatan.`kondisi_akhir` AS kondisi_akhir
                FROM
                     `renstra_indikator_kegiatan` renstra_indikator_kegiatan
                WHERE
                     renstra_indikator_kegiatan.renstra_kegiatan_id = :id_kegiatan
                ORDER BY
                     renstra_indikator_kegiatan.`no_indikator`";
            $statement = $this->connection->prepare($sql);
            $statement->bindValue("id_kegiatan", $id_kegiatan);
            $statement->execute();
            $result = $statement->fetchAll();
            return new JsonResponse($result);
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->handleDBALException($ex);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    }
    
    
}
