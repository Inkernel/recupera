<?php
header('Content-Type: text/html; charset=UTF-8'); 
 
class libreria
{
   // copiada de libreriaX para resolverlo
    public function dameUAA($clave) {
        try {
            $pdo = Database::connect();	
            $query = $pdo->prepare("SELECT UAA FROM fondos WHERE num_accion =:pat");
            $query->bindParam("pat", $clave, PDO::PARAM_STR);
            $query->execute();
            if ($query->rowCount() > 0) {
                $resultado = $query->fetch(PDO::FETCH_OBJ);
                return $resultado->UAA;
            } else return "--";
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function dameEstado($clave) {
        try {
            $pdo = Database::connect();	
            $query = $pdo->prepare("SELECT detalle_estado FROM estados_tramite WHERE id_estado =:pat");
            $query->bindParam("pat", $clave, PDO::PARAM_INT);
            $query->execute();
            if ($query->rowCount() > 0) {
                $resultado = $query->fetch(PDO::FETCH_OBJ);
                return $resultado->detalle_estado;
            } else return "no se encuentra";
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    // ====================


    public function dameOficioAcuse($tipo, $estado, $clave1) {
        try {
            $pdo = Database::connect();	
//            $query = $pdo->prepare("SELECT oficioAcuse FROM pfrr_historial WHERE num_accion =:pat1 and tipo =pat2");
           $query = $pdo->prepare("SELECT oficioAcuse FROM pfrr_historial WHERE tipo =:tipo AND estadoTramite =:estado AND num_accion =:pat1");

           $query->bindParam("tipo", $tipo, PDO::PARAM_STR);
           $query->bindParam("estado", $estado, PDO::PARAM_STR);
           $query->bindParam("pat1", $clave1, PDO::PARAM_STR);
           //            $query->bindParam("pat2", $clave2, PDO::PARAM_STR);
            $query->execute();
            if ($query->rowCount() > 0) {
                $resultado = $query->fetch(PDO::FETCH_OBJ);
                return $resultado->oficioAcuse;
            } else return "---";
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }




    public function getPFRRcontrol() {
        $pdo = Database::connect();
        $sql = 'SELECT cp, count(id) as acciones, 
                COUNT(CASE WHEN detalle_edo_tramite = 23 THEN detalle_edo_tramite ELSE null END) AS "abstencion",
                COUNT(CASE WHEN detalle_edo_tramite = 24 THEN detalle_edo_tramite ELSE null END) AS "responsabilidad",
                COUNT(CASE WHEN detalle_edo_tramite = 25 THEN detalle_edo_tramite ELSE null END) AS "sancion",
                COUNT(CASE WHEN detalle_edo_tramite = 26 THEN detalle_edo_tramite ELSE null END) AS "sobresiomiento",
                count(case when detalle_edo_tramite in (23,24,25,26) then id else null end) as "resolucionesNoti",

                COUNT(CASE WHEN detalle_edo_tramite = 15 THEN detalle_edo_tramite ELSE null END) AS "acuerdo",
                COUNT(CASE WHEN detalle_edo_tramite = 30 THEN detalle_edo_tramite ELSE null END) AS "iniciado",
                count(case when detalle_edo_tramite in (15,30) then id else null end) as "acuerdoInicio",

                COUNT(CASE WHEN detalle_edo_tramite = 16 THEN detalle_edo_tramite ELSE null END) AS "dInicio",
                COUNT(CASE WHEN detalle_edo_tramite = 17 THEN detalle_edo_tramite ELSE null END) AS "dAudiencia",
                COUNT(CASE WHEN detalle_edo_tramite = 18 THEN detalle_edo_tramite ELSE null END) AS "dPruebas",
                COUNT(CASE WHEN detalle_edo_tramite = 19 THEN detalle_edo_tramite ELSE null END) AS "dOpinion",
                COUNT(CASE WHEN detalle_edo_tramite = 22 THEN detalle_edo_tramite ELSE null END) AS "dElaboracion",
                COUNT(CASE WHEN detalle_edo_tramite = 28 THEN detalle_edo_tramite ELSE null END) AS "dActualizacion",
                COUNT(CASE WHEN detalle_edo_tramite = 29 THEN detalle_edo_tramite ELSE null END) AS "dEmision",
                COUNT(CASE WHEN detalle_edo_tramite = 31 THEN detalle_edo_tramite ELSE null END) AS "dAlegato",
                COUNT(CASE WHEN detalle_edo_tramite in (16,17,18,19,22,28,29,31) THEN detalle_edo_tramite ELSE null END) AS "desahogo",

                count(case when detalle_edo_tramite in (11) then id else null end) as "asistencia",
                count(case when detalle_edo_tramite in (12) then id else null end) as "archivo",
                count(case when detalle_edo_tramite in (13) then id else null end) as "devuelto",
                count(case when detalle_edo_tramite in (14) then id else null end) as "solventacion",
                count(case when detalle_edo_tramite in (11,12,13,14) then id else null end) as "expediente"
        from pfrr 
        group by cp';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /* aun no hay procedimiento y pueden faltar presuntos asignados */
    public function getAsistenciaAccion(){
        $pdo = Database::connect();
        $sql = "SELECT cp, fecha_IR, pfrr.num_accion as num_accion, entidad, auditoria, subnivel,  count(pfrr_presuntos_audiencias.nombre) AS presuntos, 
                        detalle_edo_tramite, fecha_edo_tramite, monto_no_solventado
                FROM pfrr
                left join pfrr_presuntos_audiencias on  (pfrr.num_accion = pfrr_presuntos_audiencias.num_accion)
                where (pfrr.detalle_edo_tramite = 11 ) and 
                ( 
                  ( (status = 1) and (pfrr_presuntos_audiencias.tipo <> 'titularICC') 
                    and (pfrr_presuntos_audiencias.tipo <> 'titularTESOFE') and (pfrr_presuntos_audiencias.tipo <> 'responsableInforme')
                  ) 
                or (pfrr_presuntos_audiencias.num_accion is null)  )
                group by pfrr.num_accion
            ";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
        return $stmt->fetchAll();
    }


    public function getDevueltoAccion(){
        $pdo = Database::connect();
        $sql = "SELECT cp, fecha_IR, pfrr.num_accion as num_accion, entidad, auditoria, subnivel,  count(pfrr_presuntos_audiencias.nombre) AS presuntos, 
                        detalle_edo_tramite, fecha_edo_tramite, monto_no_solventado
                FROM pfrr
                left join pfrr_presuntos_audiencias on  (pfrr.num_accion = pfrr_presuntos_audiencias.num_accion)
                where (pfrr.detalle_edo_tramite = 13 ) and 
                ( 
                  ( (status = 1) and (pfrr_presuntos_audiencias.tipo <> 'titularICC') 
                    and (pfrr_presuntos_audiencias.tipo <> 'titularTESOFE') and (pfrr_presuntos_audiencias.tipo <> 'responsableInforme')
                  ) 
                or (pfrr_presuntos_audiencias.num_accion is null)  )
                group by pfrr.num_accion
            ";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
        return $stmt->fetchAll();
    }


    public function getAcciones(){
        $pdo = Database::connect();
        $sql = "SELECT *, estados_tramite.detalle_estado, subnivel
                FROM pfrr
                inner join estados_tramite on pfrr.detalle_edo_tramite = estados_tramite.id_estado
                where 1
            ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }



    public function getAccionesEntidad(){
        $pdo = Database::connect();
        $sql = "SELECT *, estados_tramite.detalle_estado, subnivel
                FROM pfrr
                inner join estados_tramite on pfrr.detalle_edo_tramite = estados_tramite.id_estado
                where num_accion in (select num_accion from aaaa)
            ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }


    public function getAccionesXcargo($clave){
        $pdo = Database::connect();
        $sql = "DROP TABLE IF EXISTS aaaaa;
            CREATE TABLE aaaaa AS 
            SELECT num_accion 
            FROM pfrr_presuntos_audiencias
            WHERE cargo LIKE :pat ";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam("pat", $clave, PDO::PARAM_STR);
        $stmt->execute();

        $sql = "select * from aaaaa where 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }


    public function getOficiosPFRR(){
        $pdo = Database::connect();
        $sql = "SELECT *
                FROM oficios
		        WHERE tipo IN (SELECT value FROM oficios_options WHERE estado = 'pfrr') 
            ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getPFRRanalisis(){
        $pdo = Database::connect();
        $sql = "SELECT *, pfrr_presuntos_audiencias.nombre as nombre  
                FROM pfrr
                join pfrr_presuntos_audiencias on  (pfrr.num_accion = pfrr_presuntos_audiencias.num_accion)  
                where (status = 1) and (pfrr.detalle_edo_tramite = 11 ) and (pfrr_presuntos_audiencias.tipo <> 'titularICC') 
                and (pfrr_presuntos_audiencias.tipo <> 'titularTESOFE') and (pfrr_presuntos_audiencias.tipo <> 'responsableInforme')";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();
    }


    public function getPFRRdefensaProcedimiento() {
        $pdo = Database::connect();
        $sql = 'SELECT cp, 
                COUNT(CASE WHEN 	et_impugnacion = 45 THEN detalle_edo_tramite ELSE null END) AS "impugnada",
                COUNT(CASE WHEN 	et_impugnacion = 46 THEN detalle_edo_tramite ELSE null END) AS "existencia",
                COUNT(CASE WHEN 	et_impugnacion = 47 THEN detalle_edo_tramite ELSE null END) AS "inexistencia",
                COUNT(CASE WHEN 	et_impugnacion = 48 THEN detalle_edo_tramite ELSE null END) AS "mixta",
                count(case when 	et_impugnacion in (45,46,47,48) then id else null end) as "procedimientos"
        from pfrr 
        group by cp';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }


    public function getDefensaProcedimiento() {
        $pdo = Database::connect();
        $sql = 'SELECT *,  count(pfrr_presuntos_audiencias.nombre) AS nombre
        from pfrr
        join pfrr_presuntos_audiencias on  (pfrr.num_accion = pfrr_presuntos_audiencias.num_accion)  
        where (status = 1) and (pfrr.et_impugnacion in (45,46,47,48) ) and (pfrr_presuntos_audiencias.tipo <> "titularICC")
                and (pfrr_presuntos_audiencias.tipo <> "titularTESOFE") and (pfrr_presuntos_audiencias.tipo <> "responsableInforme")
        group by pfrr.num_accion
        '; 
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }


    public function getPFRRdefensaPR() {
        $pdo = Database::connect();
        $sql = 'SELECT cp, 
                COUNT(CASE WHEN 	et_impugnacion = 45 THEN detalle_edo_tramite ELSE null END) AS "impugnada",
                COUNT(CASE WHEN 	et_impugnacion = 46 THEN detalle_edo_tramite ELSE null END) AS "existencia",
                COUNT(CASE WHEN 	et_impugnacion = 47 THEN detalle_edo_tramite ELSE null END) AS "inexistencia",
                COUNT(CASE WHEN 	et_impugnacion = 48 THEN detalle_edo_tramite ELSE null END) AS "mixta",
                count(case when 	et_impugnacion in (45,46,47,48) then id else null end) as "actores"
                from pfrr 
                join pfrr_presuntos_audiencias on  (pfrr.num_accion = pfrr_presuntos_audiencias.num_accion)  
                where (status = 1) and (pfrr.et_impugnacion in (45,46,47,48) ) and (pfrr_presuntos_audiencias.tipo <> "titularICC")
                and (pfrr_presuntos_audiencias.tipo <> "titularTESOFE") and (pfrr_presuntos_audiencias.tipo <> "responsableInforme")
                group by cp';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getDefensaPR() {
        $pdo = Database::connect();
        $sql = 'SELECT *
        from pfrr
        join pfrr_presuntos_audiencias on  (pfrr.num_accion = pfrr_presuntos_audiencias.num_accion)  
        where (status = 1) and (pfrr.et_impugnacion in (45,46,47,48) ) and (pfrr_presuntos_audiencias.tipo <> "titularICC")
                and (pfrr_presuntos_audiencias.tipo <> "titularTESOFE") and (pfrr_presuntos_audiencias.tipo <> "responsableInforme")
        '; 
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getJuiciosxProcedimiento(){
        $pdo = Database::connect();
        $sql = 'SELECT * 
        FROM juiciosnew
        ORDER BY procedimiento';
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();
    }

    public function getProcedimientoJuicios(){
        $pdo = Database::connect();
        $sql = 'SELECT * 
        FROM pfrr left join juiciosnew on pfrr.num_procedimiento = juiciosnew.procedimiento
        ORDER BY procedimiento';
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();
    }

    public function getPFRRresoluciones(){
        $pdo = Database::connect();
        $sql = "SELECT pfrr.cierre_instruccion AS cierre_instruccion, pfrr.entidad AS entidad,
                    pfrr.fecha_acuerdo_inicio AS fecha_acuerdo_inicio, pfrr.num_procedimiento AS num_procedimiento,
                    pfrr.resolucion AS resolucion, pfrr.superveniente AS superveniente, pfrr_presuntos_audiencias.fecha_notificacion_resolucion AS fecha_notificacion_resolucion,
                    pfrr.po AS numero_de_pliego,pfrr_presuntos_audiencias.nombre AS nombre, 
                    pfrr_presuntos_audiencias.accion_omision AS accion_omision,
                    pfrr_presuntos_audiencias.prescripcion_accion_omision AS prescripcion_accion_omision,pfrr_presuntos_audiencias.status AS status,
                    pfrr_presuntos_audiencias.monto AS monto,
                    pfrr_presuntos_audiencias.fecha_notificacion_oficio_citatorio AS fecha_notificacion_oficio_citatorio,
                    pfrr_presuntos_audiencias.tipo AS tipo, pfrr_presuntos_audiencias.responsabilidad AS responsabilidad,
                    pfrr.detalle_edo_tramite AS detalle_edo_tramite, pfrr.num_accion AS num_accion,
                    pfrr.cp AS cp, pfrr.fecha_edo_tramite AS fecha_edo_tramite 
                from (pfrr 
                join pfrr_presuntos_audiencias on  (pfrr.num_accion = pfrr_presuntos_audiencias.num_accion)  )
                where (status = 1) and (pfrr.detalle_edo_tramite in (23,24,25,26) ) and (pfrr_presuntos_audiencias.tipo <> 'titularICC') 
                and (pfrr_presuntos_audiencias.tipo <> 'titularTESOFE') and (pfrr_presuntos_audiencias.tipo <> 'responsableInforme')
                order by pfrr.num_accion";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();
    }

    public function getAccionResoluciones(){
        $pdo = Database::connect();
        $sql = "SELECT *, count(pfrr_presuntos_audiencias.nombre) AS nombre, pfrr.fecha_notificacion_resolucion as notificacion, pfrr_presuntos_audiencias.status AS status
                from pfrr 
                join pfrr_presuntos_audiencias on  (pfrr.num_accion = pfrr_presuntos_audiencias.num_accion)  
                where (status = 1) and (pfrr.detalle_edo_tramite in (23,24,25,26) ) and (pfrr_presuntos_audiencias.tipo <> 'titularICC') 
                and (pfrr_presuntos_audiencias.tipo <> 'titularTESOFE') and (pfrr_presuntos_audiencias.tipo <> 'responsableInforme')
                group by pfrr.num_accion
                order by pfrr.num_accion";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();
    }

    public function getPFRRacuerdos(){
        $pdo = Database::connect();
        $sql = "SELECT *, pfrr_presuntos_audiencias.nombre, pfrr_presuntos_audiencias.domicilio, pfrr_presuntos_audiencias.dependencia
                FROM pfrr
                join pfrr_presuntos_audiencias on  (pfrr.num_accion = pfrr_presuntos_audiencias.num_accion)  
                where (status = 1) and (pfrr.detalle_edo_tramite in (15,30) ) and (pfrr_presuntos_audiencias.tipo <> 'titularICC') 
                and (pfrr_presuntos_audiencias.tipo <> 'titularTESOFE') and (pfrr_presuntos_audiencias.tipo <> 'responsableInforme')";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();
    }

    public function getAcuerdosInicio(){
        $pdo = Database::connect();
        $sql = "SELECT *, pfrr.num_accion as num_accion, count(pfrr_presuntos_audiencias.nombre) AS nombre
                FROM pfrr
                left join pfrr_presuntos_audiencias on  (pfrr.num_accion = pfrr_presuntos_audiencias.num_accion)  
                where pfrr.detalle_edo_tramite in (15,30) and 
                (
                   ( (status = 1)  and (pfrr_presuntos_audiencias.tipo <> 'titularICC') 
                        and (pfrr_presuntos_audiencias.tipo <> 'titularTESOFE') 
                        and (pfrr_presuntos_audiencias.tipo <> 'responsableInforme')
                    )
                    or (pfrr_presuntos_audiencias.num_accion is null)  
                )
                group by pfrr.num_accion
                order by pfrr.num_accion";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();
    }

    public function getPFRRdesahogos(){
        $pdo = Database::connect();
        $sql = "SELECT *, pfrr_presuntos_audiencias.nombre, pfrr_presuntos_audiencias.domicilio, pfrr_presuntos_audiencias.dependencia
                FROM pfrr
                join pfrr_presuntos_audiencias on  (pfrr.num_accion = pfrr_presuntos_audiencias.num_accion)  
                where (status = 1) and (pfrr.detalle_edo_tramite in (16,17,18,19,22,28,29,31)) and (pfrr_presuntos_audiencias.tipo <> 'titularICC') 
                and (pfrr_presuntos_audiencias.tipo <> 'titularTESOFE') and (pfrr_presuntos_audiencias.tipo <> 'responsableInforme')";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();
    }

    public function getPFRRdesahogosProcedimiento(){
        $pdo = Database::connect();
        $sql = "SELECT *, count(pfrr_presuntos_audiencias.nombre) AS nombre
                FROM pfrr
                join pfrr_presuntos_audiencias on  (pfrr.num_accion = pfrr_presuntos_audiencias.num_accion)  
                where (status = 1) and (pfrr.detalle_edo_tramite in (16,17,18,19,22,28,29,31)) and (pfrr_presuntos_audiencias.tipo <> 'titularICC') 
                and (pfrr_presuntos_audiencias.tipo <> 'titularTESOFE') and (pfrr_presuntos_audiencias.tipo <> 'responsableInforme')
                group by pfrr.num_accion
                order by pfrr.num_accion";
                
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();
    }

    

    public function getJCAcontrol01() {
        $pdo = Database::connect();
        $sql = 'SELECT resultado, count(juicionulidad) as juicios,
        COUNT(CASE WHEN fechanot is null THEN juicionulidad ELSE null END) AS "falta",
        COUNT(CASE WHEN fechanot = "0000-00-00" THEN juicionulidad ELSE null END) AS "ceros",
        COUNT(CASE WHEN fechanot <= "2017-12-31" and fechanot <> "0000-00-00" THEN juicionulidad ELSE null END) AS "Reporte",
        COUNT(CASE WHEN YEAR(fechanot) = "2018" THEN juicionulidad ELSE null END) AS "2018",
        COUNT(CASE WHEN YEAR(fechanot) = "2018" and MONTH(fechanot) = "01" THEN juicionulidad ELSE null END) AS "Ene",
        COUNT(CASE WHEN YEAR(fechanot) = "2018" and MONTH(fechanot) = "02" THEN juicionulidad ELSE null END) AS "Feb",
        COUNT(CASE WHEN YEAR(fechanot) = "2018" and MONTH(fechanot) = "03" THEN juicionulidad ELSE null END) AS "Mar",
        COUNT(CASE WHEN YEAR(fechanot) = "2018" and MONTH(fechanot) = "04" THEN juicionulidad ELSE null END) AS "Abr",
        COUNT(CASE WHEN YEAR(fechanot) = "2018" and MONTH(fechanot) = "05" THEN juicionulidad ELSE null END) AS "May",
        COUNT(CASE WHEN YEAR(fechanot) = "2018" and MONTH(fechanot) = "06" THEN juicionulidad ELSE null END) AS "Jun",
        COUNT(CASE WHEN YEAR(fechanot) = "2018" and MONTH(fechanot) = "07" THEN juicionulidad ELSE null END) AS "Jul",
        COUNT(CASE WHEN YEAR(fechanot) = "2018" and MONTH(fechanot) = "08" THEN juicionulidad ELSE null END) AS "Ago",
        COUNT(CASE WHEN YEAR(fechanot) = "2018" and MONTH(fechanot) = "09" THEN juicionulidad ELSE null END) AS "Sep",
        COUNT(CASE WHEN YEAR(fechanot) = "2018" and MONTH(fechanot) = "10" THEN juicionulidad ELSE null END) AS "Oct",
        COUNT(CASE WHEN YEAR(fechanot) = "2018" and MONTH(fechanot) = "11" THEN juicionulidad ELSE null END) AS "Nov",
        COUNT(CASE WHEN YEAR(fechanot) = "2018" and MONTH(fechanot) = "12" THEN juicionulidad ELSE null END) AS "Dic",
        COUNT(CASE WHEN YEAR(fechanot) = "2019" and MONTH(fechanot) = "01" THEN juicionulidad ELSE null END) AS "Ene19",
        COUNT(CASE WHEN YEAR(fechanot) = "2019" and MONTH(fechanot) = "02" THEN juicionulidad ELSE null END) AS "Feb19",
        COUNT(CASE WHEN YEAR(fechanot) = "2019" and MONTH(fechanot) = "03" THEN juicionulidad ELSE null END) AS "Mar19",
        COUNT(CASE WHEN YEAR(fechanot) = "2019" and MONTH(fechanot) = "04" THEN juicionulidad ELSE null END) AS "Abr19",
        COUNT(CASE WHEN YEAR(fechanot) = "2019" THEN juicionulidad ELSE null END) AS "2019"
        From juiciosnew 
        group by resultado';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }



    public function getPFRRcontrolResoluciones() {
        $pdo = Database::connect();
        $sql = 'SELECT cp, count(id) as presuntos, 
            COUNT(CASE WHEN detalle_edo_tramite = 23 THEN detalle_edo_tramite ELSE null END) AS "abstencion",
            COUNT(CASE WHEN detalle_edo_tramite = 24 THEN detalle_edo_tramite ELSE null END) AS "responsabilidad",
            COUNT(CASE WHEN detalle_edo_tramite = 25 THEN detalle_edo_tramite ELSE null END) AS "sancion",
            COUNT(CASE WHEN detalle_edo_tramite = 26 THEN detalle_edo_tramite ELSE null END) AS "sobresiomiento"
        from (pfrr 
        join pfrr_presuntos_audiencias on  (pfrr.num_accion = pfrr_presuntos_audiencias.num_accion)  )
        where  (status = 1) and (pfrr.detalle_edo_tramite in (23,24,25,26)) and (pfrr_presuntos_audiencias.tipo <> "titularICC") 
        and (pfrr_presuntos_audiencias.tipo <> "titularTESOFE") and (pfrr_presuntos_audiencias.tipo <> "responsableInforme")
        group by cp';
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();
    }

    public function getPFRRresponsables() {
        $pdo = Database::connect();
        $sql = 'SELECT cp, count(id) as presuntos,
            COUNT(CASE WHEN detalle_edo_tramite = 11 THEN detalle_edo_tramite ELSE null END) AS "noSolventado",
            COUNT(CASE WHEN detalle_edo_tramite = 12 THEN detalle_edo_tramite ELSE null END) AS "acuerdoArchivo",
            COUNT(CASE WHEN detalle_edo_tramite = 13 THEN detalle_edo_tramite ELSE null END) AS "devolucionExpediente",
            COUNT(CASE WHEN detalle_edo_tramite = 14 THEN detalle_edo_tramite ELSE null END) AS "solventacionPO",
            COUNT(CASE WHEN detalle_edo_tramite = 15 THEN detalle_edo_tramite ELSE null END) AS "acuerdo",

            COUNT(CASE WHEN detalle_edo_tramite = 16 THEN detalle_edo_tramite ELSE null END) AS "dInicio",
            COUNT(CASE WHEN detalle_edo_tramite = 17 THEN detalle_edo_tramite ELSE null END) AS "dAudiencia",
            COUNT(CASE WHEN detalle_edo_tramite = 18 THEN detalle_edo_tramite ELSE null END) AS "dPruebas",
            COUNT(CASE WHEN detalle_edo_tramite = 19 THEN detalle_edo_tramite ELSE null END) AS "dOpinion",
            COUNT(CASE WHEN detalle_edo_tramite = 22 THEN detalle_edo_tramite ELSE null END) AS "dElaboracion",

            COUNT(CASE WHEN detalle_edo_tramite = 23 THEN detalle_edo_tramite ELSE null END) AS "abstencion",
            COUNT(CASE WHEN detalle_edo_tramite = 24 THEN detalle_edo_tramite ELSE null END) AS "responsabilidad",
            COUNT(CASE WHEN detalle_edo_tramite = 25 THEN detalle_edo_tramite ELSE null END) AS "sancion",
            COUNT(CASE WHEN detalle_edo_tramite = 26 THEN detalle_edo_tramite ELSE null END) AS "sobresiomiento",

            COUNT(CASE WHEN detalle_edo_tramite = 28 THEN detalle_edo_tramite ELSE null END) AS "dActualizacion",
            COUNT(CASE WHEN detalle_edo_tramite = 29 THEN detalle_edo_tramite ELSE null END) AS "dEmision",

            COUNT(CASE WHEN detalle_edo_tramite = 30 THEN detalle_edo_tramite ELSE null END) AS "iniciado",

            COUNT(CASE WHEN detalle_edo_tramite = 31 THEN detalle_edo_tramite ELSE null END) AS "dAlegato",

            COUNT(CASE WHEN detalle_edo_tramite in (15,30) THEN detalle_edo_tramite ELSE null END) AS "acuerdoInicio",
            COUNT(CASE WHEN detalle_edo_tramite in (16,17,18,19,22,28,29,31) THEN detalle_edo_tramite ELSE null END) AS "desahogo"


        from pfrr 
        join pfrr_presuntos_audiencias on  (pfrr.num_accion = pfrr_presuntos_audiencias.num_accion)  
        where  (status = 1) and (pfrr_presuntos_audiencias.tipo <> "titularICC") 
        and (pfrr_presuntos_audiencias.tipo <> "titularTESOFE") and (pfrr_presuntos_audiencias.tipo <> "responsableInforme")
        group by cp ';
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();
    }









    public function getJCAcontrol02() {
        $pdo = Database::connect();
        $sql = 'SELECT resultado, count(juicionulidad) as juicios,
        COUNT(CASE WHEN f_resolucion is null THEN juicionulidad ELSE null END) AS "falta",
        COUNT(CASE WHEN f_resolucion = "0000-00-00" THEN juicionulidad ELSE null END) AS "ceros",
        COUNT(CASE WHEN f_resolucion <= "2017-12-31" and f_resolucion <> "0000-00-00" THEN juicionulidad ELSE null END) AS "Reporte",
        COUNT(CASE WHEN YEAR(f_resolucion) = "2018" THEN juicionulidad ELSE null END) AS "2018",
        COUNT(CASE WHEN YEAR(f_resolucion) = "2018" and MONTH(f_resolucion) = "01" THEN juicionulidad ELSE null END) AS "Ene",
        COUNT(CASE WHEN YEAR(f_resolucion) = "2018" and MONTH(f_resolucion) = "02" THEN juicionulidad ELSE null END) AS "Feb",
        COUNT(CASE WHEN YEAR(f_resolucion) = "2018" and MONTH(f_resolucion) = "03" THEN juicionulidad ELSE null END) AS "Mar",
        COUNT(CASE WHEN YEAR(f_resolucion) = "2018" and MONTH(f_resolucion) = "04" THEN juicionulidad ELSE null END) AS "Abr",
        COUNT(CASE WHEN YEAR(f_resolucion) = "2018" and MONTH(f_resolucion) = "05" THEN juicionulidad ELSE null END) AS "May",
        COUNT(CASE WHEN YEAR(f_resolucion) = "2018" and MONTH(f_resolucion) = "06" THEN juicionulidad ELSE null END) AS "Jun",
        COUNT(CASE WHEN YEAR(f_resolucion) = "2018" and MONTH(f_resolucion) = "07" THEN juicionulidad ELSE null END) AS "Jul",
        COUNT(CASE WHEN YEAR(f_resolucion) = "2018" and MONTH(f_resolucion) = "08" THEN juicionulidad ELSE null END) AS "Ago",
        COUNT(CASE WHEN YEAR(f_resolucion) = "2018" and MONTH(f_resolucion) = "09" THEN juicionulidad ELSE null END) AS "Sep",
        COUNT(CASE WHEN YEAR(f_resolucion) = "2018" and MONTH(f_resolucion) = "10" THEN juicionulidad ELSE null END) AS "Oct",
        COUNT(CASE WHEN YEAR(f_resolucion) = "2018" and MONTH(f_resolucion) = "11" THEN juicionulidad ELSE null END) AS "Nov",
        COUNT(CASE WHEN YEAR(f_resolucion) = "2018" and MONTH(f_resolucion) = "12" THEN juicionulidad ELSE null END) AS "Dic",
        COUNT(CASE WHEN YEAR(f_resolucion) = "2019" and MONTH(f_resolucion) = "01" THEN juicionulidad ELSE null END) AS "Ene19",
        COUNT(CASE WHEN YEAR(f_resolucion) = "2019" and MONTH(f_resolucion) = "02" THEN juicionulidad ELSE null END) AS "Feb19",
        COUNT(CASE WHEN YEAR(f_resolucion) = "2019" and MONTH(f_resolucion) = "03" THEN juicionulidad ELSE null END) AS "Mar19",
        COUNT(CASE WHEN YEAR(f_resolucion) = "2019" and MONTH(f_resolucion) = "04" THEN juicionulidad ELSE null END) AS "Abr19",
        COUNT(CASE WHEN YEAR(f_resolucion) = "2019" THEN juicionulidad ELSE null END) AS "2019"
        From juiciosnew 
        group by resultado';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }


    public function getJCAcontrol03() {
        $pdo = Database::connect();
        $sql = 'SELECT ad_status as resultado, count(juicionulidad) as juicios,
        COUNT(CASE WHEN fecha_ejec_amp is null THEN juicionulidad ELSE null END) AS "falta",
        COUNT(CASE WHEN fecha_ejec_amp = "0000-00-00" THEN juicionulidad ELSE null END) AS "ceros",
        COUNT(CASE WHEN fecha_ejec_amp <= "2017-12-31" and fecha_ejec_amp <> "0000-00-00" THEN juicionulidad ELSE null END) AS "Reporte",
        COUNT(CASE WHEN YEAR(fecha_ejec_amp) = "2018" THEN juicionulidad ELSE null END) AS "2018",
        COUNT(CASE WHEN YEAR(fecha_ejec_amp) = "2018" and MONTH(fecha_ejec_amp) = "01" THEN juicionulidad ELSE null END) AS "Ene",
        COUNT(CASE WHEN YEAR(fecha_ejec_amp) = "2018" and MONTH(fecha_ejec_amp) = "02" THEN juicionulidad ELSE null END) AS "Feb",
        COUNT(CASE WHEN YEAR(fecha_ejec_amp) = "2018" and MONTH(fecha_ejec_amp) = "03" THEN juicionulidad ELSE null END) AS "Mar",
        COUNT(CASE WHEN YEAR(fecha_ejec_amp) = "2018" and MONTH(fecha_ejec_amp) = "04" THEN juicionulidad ELSE null END) AS "Abr",
        COUNT(CASE WHEN YEAR(fecha_ejec_amp) = "2018" and MONTH(fecha_ejec_amp) = "05" THEN juicionulidad ELSE null END) AS "May",
        COUNT(CASE WHEN YEAR(fecha_ejec_amp) = "2018" and MONTH(fecha_ejec_amp) = "06" THEN juicionulidad ELSE null END) AS "Jun",
        COUNT(CASE WHEN YEAR(fecha_ejec_amp) = "2018" and MONTH(fecha_ejec_amp) = "07" THEN juicionulidad ELSE null END) AS "Jul",
        COUNT(CASE WHEN YEAR(fecha_ejec_amp) = "2018" and MONTH(fecha_ejec_amp) = "08" THEN juicionulidad ELSE null END) AS "Ago",
        COUNT(CASE WHEN YEAR(fecha_ejec_amp) = "2018" and MONTH(fecha_ejec_amp) = "09" THEN juicionulidad ELSE null END) AS "Sep",
        COUNT(CASE WHEN YEAR(fecha_ejec_amp) = "2018" and MONTH(fecha_ejec_amp) = "10" THEN juicionulidad ELSE null END) AS "Oct",
        COUNT(CASE WHEN YEAR(fecha_ejec_amp) = "2018" and MONTH(fecha_ejec_amp) = "11" THEN juicionulidad ELSE null END) AS "Nov",
        COUNT(CASE WHEN YEAR(fecha_ejec_amp) = "2018" and MONTH(fecha_ejec_amp) = "12" THEN juicionulidad ELSE null END) AS "Dic",
        COUNT(CASE WHEN YEAR(fecha_ejec_amp) = "2019" and MONTH(fecha_ejec_amp) = "01" THEN juicionulidad ELSE null END) AS "Ene19",
        COUNT(CASE WHEN YEAR(fecha_ejec_amp) = "2019" and MONTH(fecha_ejec_amp) = "02" THEN juicionulidad ELSE null END) AS "Feb19",
        COUNT(CASE WHEN YEAR(fecha_ejec_amp) = "2019" and MONTH(fecha_ejec_amp) = "03" THEN juicionulidad ELSE null END) AS "Mar19",
        COUNT(CASE WHEN YEAR(fecha_ejec_amp) = "2019" and MONTH(fecha_ejec_amp) = "04" THEN juicionulidad ELSE null END) AS "Abr19",
        COUNT(CASE WHEN YEAR(fecha_ejec_amp) = "2019" THEN juicionulidad ELSE null END) AS "2019"
        From juiciosnew
        WHERE toca_amparo = "si"
        group by ad_status';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getJCAcontrol04() {
        $pdo = Database::connect();
        $sql = 'SELECT rf_status as resultado, count(juicionulidad) as juicios,
        COUNT(CASE WHEN fecha_ejec_rev is null THEN juicionulidad ELSE null END) AS "falta",
        COUNT(CASE WHEN fecha_ejec_rev = "0000-00-00" THEN juicionulidad ELSE null END) AS "ceros",
        COUNT(CASE WHEN fecha_ejec_rev <= "2017-12-31" and fecha_ejec_rev <> "0000-00-00" THEN juicionulidad ELSE null END) AS "Reporte",
        COUNT(CASE WHEN YEAR(fecha_ejec_rev) = "2018" THEN juicionulidad ELSE null END) AS "2018",
        COUNT(CASE WHEN YEAR(fecha_ejec_rev) = "2018" and MONTH(fecha_ejec_rev) = "01" THEN juicionulidad ELSE null END) AS "Ene",
        COUNT(CASE WHEN YEAR(fecha_ejec_rev) = "2018" and MONTH(fecha_ejec_rev) = "02" THEN juicionulidad ELSE null END) AS "Feb",
        COUNT(CASE WHEN YEAR(fecha_ejec_rev) = "2018" and MONTH(fecha_ejec_rev) = "03" THEN juicionulidad ELSE null END) AS "Mar",
        COUNT(CASE WHEN YEAR(fecha_ejec_rev) = "2018" and MONTH(fecha_ejec_rev) = "04" THEN juicionulidad ELSE null END) AS "Abr",
        COUNT(CASE WHEN YEAR(fecha_ejec_rev) = "2018" and MONTH(fecha_ejec_rev) = "05" THEN juicionulidad ELSE null END) AS "May",
        COUNT(CASE WHEN YEAR(fecha_ejec_rev) = "2018" and MONTH(fecha_ejec_rev) = "06" THEN juicionulidad ELSE null END) AS "Jun",
        COUNT(CASE WHEN YEAR(fecha_ejec_rev) = "2018" and MONTH(fecha_ejec_rev) = "07" THEN juicionulidad ELSE null END) AS "Jul",
        COUNT(CASE WHEN YEAR(fecha_ejec_rev) = "2018" and MONTH(fecha_ejec_rev) = "08" THEN juicionulidad ELSE null END) AS "Ago",
        COUNT(CASE WHEN YEAR(fecha_ejec_rev) = "2018" and MONTH(fecha_ejec_rev) = "09" THEN juicionulidad ELSE null END) AS "Sep",
        COUNT(CASE WHEN YEAR(fecha_ejec_rev) = "2018" and MONTH(fecha_ejec_rev) = "10" THEN juicionulidad ELSE null END) AS "Oct",
        COUNT(CASE WHEN YEAR(fecha_ejec_rev) = "2018" and MONTH(fecha_ejec_rev) = "11" THEN juicionulidad ELSE null END) AS "Nov",
        COUNT(CASE WHEN YEAR(fecha_ejec_rev) = "2018" and MONTH(fecha_ejec_rev) = "12" THEN juicionulidad ELSE null END) AS "Dic",
        COUNT(CASE WHEN YEAR(fecha_ejec_rev) = "2019" and MONTH(fecha_ejec_rev) = "01" THEN juicionulidad ELSE null END) AS "Ene19",
        COUNT(CASE WHEN YEAR(fecha_ejec_rev) = "2019" and MONTH(fecha_ejec_rev) = "02" THEN juicionulidad ELSE null END) AS "Feb19",
        COUNT(CASE WHEN YEAR(fecha_ejec_rev) = "2019" and MONTH(fecha_ejec_rev) = "03" THEN juicionulidad ELSE null END) AS "Mar19",
        COUNT(CASE WHEN YEAR(fecha_ejec_rev) = "2019" and MONTH(fecha_ejec_rev) = "04" THEN juicionulidad ELSE null END) AS "Abr19",
        COUNT(CASE WHEN YEAR(fecha_ejec_rev) = "2019" THEN juicionulidad ELSE null END) AS "2019"
        From juiciosnew
        WHERE toca_en_revision = "si"
        group by rf_status';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }


}