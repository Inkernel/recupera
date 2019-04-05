
DROP TABLE IF EXISTS bbbb;
CREATE TABLE bbbb AS 
select cp, entidad, direccion, num_accion, num_procedimiento, fecha_acuerdo_inicio,
resolucion, detalle_edo_tramite as t, detalle_estado AS tramite, monto_no_solventado, inicio_frr, et_impugnacion
from pfrr
left join estados_tramite ON pfrr.detalle_edo_tramite = estados_tramite.id_estado
where fecha_acuerdo_inicio > '20121231'

DROP TABLE IF EXISTS bbb;
CREATE TABLE bbb AS 
select cp, entidad, direccion, num_accion, num_procedimiento, fecha_acuerdo_inicio,
resolucion,t, tramite, monto_no_solventado, inicio_frr, et_impugnacion, detalle_estado as impugnacion
from bbbb
left join estados_tramite ON bbbb.et_impugnacion = estados_tramite.id_estado

DROP TABLE IF EXISTS bb;
CREATE TABLE bb AS 
select resolucion, t, tramite,  et_impugnacion, impugnacion,
case 
when (et_impugnacion = 0 and t = 24 and year(resolucion)="2019") then 'Corriendo Plazo'
when et_impugnacion = 45 then 'Subjudice'
when t <> 24 then 'Trámite'
else "X"
end as firme,
cp, entidad, direccion, num_accion, num_procedimiento, fecha_acuerdo_inicio, monto_no_solventado, inicio_frr
from bbb


SELECT count(num_accion) as asuntos, t, 
        COUNT(CASE WHEN YEAR(fecha_acuerdo_inicio) = "2014" THEN num_accion ELSE null END) AS "2014",
        COUNT(CASE WHEN YEAR(fecha_acuerdo_inicio) = "2015" THEN num_accion ELSE null END) AS "2015"
From bb 
group by t


SELECT count(juicionulidad) as juicios, resultado,
        COUNT(CASE WHEN YEAR(f_resolucion) = "2016" THEN juicionulidad ELSE null END) AS "2016",
        COUNT(CASE WHEN YEAR(f_resolucion) = "2017" THEN juicionulidad ELSE null END) AS "2017",
        COUNT(CASE WHEN YEAR(f_resolucion) = "2018" THEN juicionulidad ELSE null END) AS "2018",
        COUNT(CASE WHEN YEAR(f_resolucion) = "2019" THEN juicionulidad ELSE null END) AS "2019"
From juiciosnew 
group by resultado






DROP TABLE IF EXISTS devueltoFecha;
CREATE TABLE devueltoFecha AS 
SELECT accion, num_accion, oficioAcuse, tipo FROM `devuelto` 
left join pfrr_historial on devuelto.accion=pfrr_historial.num_accion
where tipo="asistencia"
order by accion

DROP TABLE IF EXISTS devueltoMonto;
CREATE TABLE devueltoMonto AS 
SELECT accion, UAA, monto_no_solventado FROM `devuelto` 
left join fondos on devuelto.accion=fondos.num_accion
left join pfrr on devuelto.accion=pfrr.num_accion
order by accion


DROP TABLE IF EXISTS asistenciaMonto;
CREATE TABLE asistenciaMonto AS SELECT accion, UAA, monto_no_solventado FROM `asistencia` 
left join fondos on asistencia.accion=fondos.num_accion
left join pfrr on asistencia.accion=pfrr.num_accion
order by accion




CREATE TABLE error AS 
select pfrr.id, pfrr_historial.id as i2,pfrr.num_accion, pfrr_historial.num_accion as accion2, oficioAcuse, pfrr.detalle_edo_tramite,
        tipo,oficio
from pfrr left join pfrr_historial 
on pfrr.num_accion = pfrr_historial.num_accion and "pfrr.detalle_edo_tramite" = pfrr_historial.estadoTramite
where CP="2016" and tipo <> 'monto_frr'

select pfrr.id, pfrr_historial.id as i2,pfrr.num_accion, pfrr_historial.num_accion as accion2, oficioAcuse, pfrr.detalle_edo_tramite,
        tipo,oficio
from pfrr left join pfrr_historial 
on pfrr.num_accion = pfrr_historial.num_accion and "13" = pfrr_historial.estadoTramite
where CP="2016"  and tipo = 'asistencia'
order by pfrr.num_accion


select pfrr.num_accion, detalle_edo_tramite from pfrr
where CP="2016"


select pfrr.num_accion, oficioAcuse, `detalle_edo_tramite` from pfrr left join pfrr_historial on pfrr.num_accion = pfrr_historial.num_accion where CP="2016"

CREATE TABLE falta AS  SELECT id, accion, actor FROM `juiciosnew` WHERE cont is null
CREATE TABLE flata2 AS  SELECT num_accion, cont, nombre FROM `pfrr_presuntos_audiencias` WHERE 1

update juiciosnew inner join falta3a on falta3a.id = juiciosnew.id
set juiciosnew.actor = falta3a.actor, juiciosnew.cont = falta3a.cont

SELECT falta3a.actor, juiciosnew.actor FROM `falta3a` inner join juiciosnew on falta3a.id = juiciosnew.id

update juiciosnew inner join pfrr_presuntos_audiencias 
on juiciosnew.accion = pfrr_presuntos_audiencias.num_accion
and juiciosnew.actor = pfrr_presuntos_audiencias.nombre
set juiciosnew.cont = pfrr_presuntos_audiencias.cont


select accion, actor, pfrr_presuntos_audiencias.nombre, juiciosnew.cont, pfrr_presuntos_audiencias.cont as cont2 from juiciosnew inner join pfrr_presuntos_audiencias 
where juiciosnew.accion = pfrr_presuntos_audiencias.num_accion
and juiciosnew.actor = pfrr_presuntos_audiencias.nombre

select accion, actor, pfrr_presuntos_audiencias.nombre from juiciosnew inner join pfrr_presuntos_audiencias 
where juiciosnew.accion = pfrr_presuntos_audiencias.num_accion


UPDATE juiciosnew INNER JOIN actores ON juiciosnew.id = actores.id 
SET juiciosnew.actor = actores.Actor


CREATE TABLE asuntos AS 
select num_accion, cont from a
union all
select num_accion, cont from aa

or (pdrcs like :pat

create table entidades_pfrr SELECT distinct entidad FROM `pfrr` WHERE 1 order by entidad

DROP TABLE IF EXISTS aaaa;
CREATE TABLE aaaa AS 
SELECT num_accion 
FROM pfrr 
WHERE pdrcs LIKE '%Estado de México%' 


SELECT *
            FROM pfrr 
            left join pfrr_presuntos_audiencias on  (pfrr.num_accion = pfrr_presuntos_audiencias.num_accion)

            WHERE (entidad LIKE "%zacatecas%"  or pdrcs like "%zacatecas%" ) and 
            ( (status = 1) and (pfrr_presuntos_audiencias.tipo <> 'titularICC') 
                and (pfrr_presuntos_audiencias.tipo <> 'titularTESOFE') and (pfrr_presuntos_audiencias.tipo <> 'responsableInforme')
            ) 





UPDATE  pfrr_historial  SET oficioRecepcion = NuLL where oficioRecepcion  < "0000-01-01 00:00:00" 
UPDATE  pfrr_historial  SET sicsaAcuse = "1970-01-02" where sicsaAcuse  < "0000-01-01 00:00:00" 

sicsaRecepcion
oficioRecepcion
sicsaAcuse

UPDATE users SET created = NULL WHERE created < '0000-01-01 00:00:00'



SELECT 	*, DATEDIFF(limite_emision_resolucion, resolucion) AS difEmiRes,
                    DATEDIFF( fecha_notificacion_resolucion, limite_notificacion_resolucion) AS difNotRes 
            FROM pfrr 
            WHERE detalle_edo_tramite IN ( 23,24,25,26) AND  num_accion = '13-D-05033-02-1373-06-001' anD fecha_acuerdo_inicio <> '' 
            ORDER BY num_accion

SELECT 	*, DATEDIFF(limite_emision_resolucion, resolucion) AS difEmiRes,
                    DATEDIFF(limite_notificacion_resolucion, fecha_notificacion_resolucion) AS difNotRes 
            FROM pfrr 
            WHERE detalle_edo_tramite IN ( 23,24,25,26) AND  num_accion = '13-D-05033-02-1373-06-001' anD fecha_acuerdo_inicio <> '' 
            ORDER BY num_accion


SELECT *, count(pfrr_presuntos_audiencias.nombre) AS nombre 
FROM pfrr 
left join pfrr_presuntos_audiencias on (pfrr.num_accion = pfrr_presuntos_audiencias.num_accion) 
where  (pfrr.detalle_edo_tramite = 11 )
group by pfrr.num_accion


SELECT *, count(pfrr_presuntos_audiencias.nombre) AS nombre 
FROM pfrr 
left join pfrr_presuntos_audiencias on (pfrr.num_accion = pfrr_presuntos_audiencias.num_accion) 
where (status = 1) and (pfrr.detalle_edo_tramite = 11 ) and (pfrr_presuntos_audiencias.tipo <> 'titularICC') 
and (pfrr_presuntos_audiencias.tipo <> 'titularTESOFE') and (pfrr_presuntos_audiencias.tipo <> 'responsableInforme') 
group by pfrr.num_accion


select pfrr.num_accion, status, pfrr_presuntos_audiencias.tipo from pfrr 
left join pfrr_presuntos_audiencias on (pfrr.num_accion = pfrr_presuntos_audiencias.num_accion) 
where detalle_edo_tramite = 11


SELECT pfrr_presuntos_audiencias.nombre
        from pfrr
        inner join pfrr_presuntos_audiencias on  (pfrr.num_accion = pfrr_presuntos_audiencias.num_accion)  
        where (pfrr_presuntos_audiencias.nombre like "%al%") and (pfrr.num_accion = "04-0-36C00-2-291-06-001") and (status = 1) and (pfrr_presuntos_audiencias.tipo <> "titularICC")
                and (pfrr_presuntos_audiencias.tipo <> "titularTESOFE") and (pfrr_presuntos_audiencias.tipo <> "responsableInforme")
        order by pfrr_presuntos_audiencias.nombre





SELECT pfrr_presuntos_audiencias.nombre
        from pfrr
        inner join pfrr_presuntos_audiencias on  (pfrr.num_accion = pfrr_presuntos_audiencias.num_accion)  
        where (pfrr_presuntos_audiencias.nombre like "%al%") and (pfrr.num_accion = "04-0-36C00-2-291-06-001") and (status = 1) and (pfrr_presuntos_audiencias.tipo <> "titularICC")
                and (pfrr_presuntos_audiencias.tipo <> "titularTESOFE") and (pfrr_presuntos_audiencias.tipo <> "responsableInforme")
        order by pfrr_presuntos_audiencias.nombre


SELECT pfrr_presuntos_audiencias.nombre
        from pfrr
        inner join pfrr_presuntos_audiencias on  (pfrr.num_accion = pfrr_presuntos_audiencias.num_accion)  
        where  (pfrr.num_accion = "04-0-36C00-2-291-06-001") and (status = 1) and (pfrr_presuntos_audiencias.tipo <> "titularICC")
                and (pfrr_presuntos_audiencias.tipo <> "titularTESOFE") and (pfrr_presuntos_audiencias.tipo <> "responsableInforme")
        order by pfrr_presuntos_audiencias.nombre





SELECT pfrr.num_accion, pfrr.id, pfrr.superveniente, pfrr.entidad, pfrr.cp, pfrr.auditoria, pfrr.direccion, pfrr.subdirector, pfrr.abogado, pfrr.po, pfrr.fecha__po, pfrr.num_DT, pfrr.monto_no_solventado, pfrr.monto_no_solventado_UAA, pfrr.prescripcion, pfrr.detalle_edo_tramite, pfrr.fecha_edo_tramite, pfrr.num_procedimiento, pfrr.fecha_num_procedimiento, pfrr.cierre_instruccion, pfrr.resolucion, pfrr.fecha_notificacion_resolucion, pfrr.limite_notificacion_resolucion, pfrr.limite_emision_resolucion, pfrr.limite_cierre_instruccion, pfrr.fecha_IR, pfrr.fin_IR, pfrr.usuario, pfrr.hora, pfrr.PDR, pfrr.fecha_acuerdo_inicio, pfrr.fecha_analisis_documentacion, pfrr.tipo_resolucion, pfrr.subnivel, pfrr.DG, pfrr.validacion, pfrr.cralVisto, pfrr.f1_fecha_presc, pfrr.RS, pfrr.inicio_frr, pfrr.monto_pdr, pfrr.ampliados, pfrr.fecha_compromiso, pfrr.observaciones_b, pfrr.et_impugnacion
FROM pfrr
WHERE (((pfrr.num_accion) In (SELECT num_accion FROM pfrr As Tmp GROUP BY num_accion HAVING Count(*)>1 )))
ORDER BY pfrr.num_accion;



UPDATE pfrr_presuntos_audiencias  INNER JOIN presuntos ON pfrr_presuntos_audiencias.cont = presuntos.cont 
SET pfrr_presuntos_audiencias.nombre = presuntos.Responsable

SELECt F.cont, presuntos.cont, F.nombre, presuntos.Responsable from pfrr_presuntos_audiencias AS F  INNER JOIN presuntos 
ON F.cont = presuntos.cont 

SELECt F.cont, presuntos.cont, F.nombre, presuntos.Responsable from pfrr_presuntos_audiencias AS F 
INNER JOIN presuntos ON F.cont = presuntos.cont


CREATE TABLE  aaaa AS 
SELECT  num_procedimiento, resultado, toca_amparo, ad_status, toca_en_revision, rf_status
        FROM pfrr left join juiciosnew on pfrr.num_accion = juiciosnew.accion
        ORDER BY procedimiento



SELECT count(juicionulidad) as juicios, resultado,
        COUNT(CASE WHEN YEAR(f_resolucion) = "2016" THEN juicionulidad ELSE null END) AS "2016",
        COUNT(CASE WHEN YEAR(f_resolucion) = "2017" THEN juicionulidad ELSE null END) AS "2017",
        COUNT(CASE WHEN YEAR(f_resolucion) = "2018" THEN juicionulidad ELSE null END) AS "2018",
        COUNT(CASE WHEN YEAR(f_resolucion) = "2019" THEN juicionulidad ELSE null END) AS "2019"
From juiciosnew 
group by resultado


SELECT cp, count(id) as iniciados, 
        count(case when detalle_edo_tramite in (11,13,15,30) then id else null end) as "impugnados",
        count(case when detalle_edo_tramite in (23,24,25,26) then id else null end) as "resolucionesNoti"
from pfrr 
group by cp




SELECT resultado, count(juicionulidad) as juicios,
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
        COUNT(CASE WHEN YEAR(f_resolucion) = "2019" THEN juicionulidad ELSE null END) AS "2019"
From juiciosnew 
group by resultado


SELECT resultado, count(juicionulidad) as juicios,
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
        COUNT(CASE WHEN YEAR(fechanot) = "2019" THEN juicionulidad ELSE null END) AS "2019"
From juiciosnew 
group by resultado



SELECT ad_status, count(juicionulidad) as amparos,
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
        COUNT(CASE WHEN YEAR(fecha_ejec_amp) = "2019" THEN juicionulidad ELSE null END) AS "2019"
From juiciosnew
WHERE toca_amparo = "si"
group by ad_status


SELECT rf_status, count(juicionulidad) as recursos,
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
        COUNT(CASE WHEN YEAR(fecha_ejec_rev) = "2019" THEN juicionulidad ELSE null END) AS "2019"
From juiciosnew
WHERE toca_en_revision = "si"
group by rf_status







select pfrr.cierre_instruccion AS cierre_instruccion, pfrr.entidad AS entidad,
pfrr.fecha_acuerdo_inicio AS fecha_acuerdo_inicio,pfrr.num_procedimiento AS num_procedimiento,
pfrr.resolucion AS resolucion,pfrr.superveniente AS superveniente,pfrr.fecha_notificacion_resolucion AS fecha_notificacion_resolucion,
pfrr.po AS numero_de_pliego,pfrr_presuntos_audiencias.nombre AS nombre, 
pfrr_presuntos_audiencias.accion_omision AS accion_omision,
pfrr_presuntos_audiencias.prescripcion_accion_omision AS prescripcion_accion_omision,pfrr_presuntos_audiencias.status AS status,
pfrr_presuntos_audiencias.monto AS monto,
pfrr_presuntos_audiencias.fecha_notificacion_oficio_citatorio AS fecha_notificacion_oficio_citatorio,
pfrr_presuntos_audiencias.tipo AS tipo, pfrr_presuntos_audiencias.responsabilidad AS responsabilidad,
pfrr.detalle_edo_tramite AS id_sicsa,pfrr.num_accion AS num_accion,
pfrr.cp AS cp, estados_sicsa.estado_sicsa AS estado_sicsa,
estados_tramite.detalle_estado AS detalle_estado,pfrr.fecha_edo_tramite AS fecha_edo_tramite 
from (((pfrr 
join pfrr_presuntos_audiencias on (((pfrr.num_accion = pfrr_presuntos_audiencias.num_accion) and (pfrr_presuntos_audiencias.num_accion = pfrr.num_accion) )))
join estados_tramite on((pfrr.detalle_edo_tramite = estados_tramite.id_estado))) 
join estados_sicsa on((estados_tramite.id_sicsa = estados_sicsa.id_sicsa)))
group by pfrr.entidad,pfrr.fecha_acuerdo_inicio,pfrr.num_procedimiento,pfrr.resolucion,
pfrr.fecha_notificacion_resolucion,pfrr.po,pfrr.superveniente,pfrr_presuntos_audiencias.nombre,
pfrr_presuntos_audiencias.accion_omision,pfrr_presuntos_audiencias.prescripcion_accion_omision,
pfrr_presuntos_audiencias.status,pfrr_presuntos_audiencias.monto,
pfrr_presuntos_audiencias.fecha_notificacion_oficio_citatorio,pfrr.detalle_edo_tramite,pfrr.fecha_edo_tramite,
pfrr.num_accion,pfrr.cp,estados_sicsa.estado_sicsa,estados_tramite.detalle_estado,estados_sicsa.id_sicsa 
having ((estados_sicsa.id_sicsa = 8) and (pfrr_presuntos_audiencias.tipo <> 'titularICC') 
and (pfrr_presuntos_audiencias.tipo <> 'titularTESOFE') and (pfrr_presuntos_audiencias.tipo <> 'responsableInforme')) 
order by pfrr.num_accion







UPDATE juiciosnew INNER JOIN adT ON juiciosnew.juicionulidad = adT.juicionulidad 
SET juiciosnew.toca_amparo = adt.toca_amparo, juiciosnew.sub = adt.sub, juiciosnew.ad_status = adt.ad_status, 
juiciosnew.ad_f_interposicion = adt.ad_f_interposicion, juiciosnew.tribunal = adt.tribunal, 
juiciosnew.ejecutoria_amparo = adt.ejecutoria_amparo, juiciosnew.fecha_ejec_amp = adt.fecha_ejec_amp, 
juiciosnew.fecha_not_ejec_amp = adt.fecha_not_ejec_amp, juiciosnew.ad_observaciones = adt.ad_observaciones;

UPDATE juiciosnew set fecha_not = NuLL where fecha_not = CONVERT(0,DATETIME);


UPDATE juiciosnew INNER JOIN rrfT ON juiciosnew.juicionulidad = rrfT.jucionulidad 
SET juiciosnew.sub = rrfT.sub, juiciosnew.rf_status = rrfT.rf_status, juiciosnew.toca_en_revision = rrfT.toca_en_revision,
 juiciosnew.fecha_pre_rf = rrfT.fecha_pre_rf, juiciosnew.tribunal = rrfT.tribunal,
  juiciosnew.ejecutoria_revision = rrfT.ejecutoria_revision, juiciosnew.fecha_ejec_rev = rrfT.fecha_ejec_rev,
   juiciosnew.fecha_not_ejec_rev = rrfT.fecha_not_ejec_rev, juiciosnew.rf_observaciones = rrfT.rf_observaciones;


UPDATE juiciosnew INNER JOIN jnT ON juiciosnew.juicionulidad = jnT.juicionlidad 
SET juiciosnew.sub = jnT.sub, juiciosnew.resultado = jnT.resultado, juiciosnew.actor = jnT.actor, 
juiciosnew.fechanot = jnT.fechanot, juiciosnew.fecha_not = jnT.fecha_not, juiciosnew.salaconocimiento = jnT.salaconocimiento, 
juiciosnew.juicionulidad = jnT.juicionlidad, juiciosnew.f_resolucion = jnT.resolucion_sp, 
juiciosnew.fecha_not_sentencia = jnT.fecha_not_sentencia, juiciosnew.fecha_sentencia = jnT.fecha_sentencia, 
juiciosnew.observaciones = jnT.observaciones;

UPDATE juiciosnew SET juiciosnew.sub = "A.0", juiciosnew.resultado = "trámite";


UPDATE oficios INNER JOIN mv2 ON oficios.id = mv2.id 
SET oficios.num_accion = mv2.num_accion, oficios.oficio_referencia = mv2.oficio_referencia, 
oficios.tipo = mv2.tipo, oficios.visto = mv2.visto

INSERT INTO juiciosnew ( accion, procedimiento, juicionulidad, Dir, oficio_contestacion, fecha_pre_tribunal, oficio_ampliacion, fecha_pre_ampliacion, oficio_alegatos, fecha_pre_alegatos, estado )
SELECT jxo1.accion, jxo1.procedimiento, jxo1.juicionulidad, jxo1.Dir, jxo1.oficio_contestacion, jxo1.fecha_pre_tribunal, jxo1.oficio_ampliacion, jxo1.fecha_pre_ampliacion, jxo1.oficio_alegatos, jxo1.fecha_pre_alegatos, jxo1.estado
FROM jxo1;


INSERT INTO ai ( sub, dir, estado, procedimiento, actor, f_interposicion, instancia, ai, f_resolucion, f_notificacion, observaciones )
SELECT ai3.sub, ai3.dir, ai3.estado, ai3.procedimiento, ai3.actor, ai3.f_interposicion, ai3.instancia, ai3.ai, ai3.f_resolucion, ai3.f_notificacion, ai3.observaciones
FROM ai3;


UPDATE gustavo INNER JOIN juiciosnew ON gustavo.juicionlidad = juiciosnew.juicionulidad 
SET juiciosnew.sub = gustavo.sub, juiciosnew.resultado = gustavo.resultado, juiciosnew.actor = gustavo.actor, 
juiciosnew.fecha_not = gustavo.fechanot, juiciosnew.salaconocimiento = gustavo.salaconocimiento, 
juiciosnew.toca_amparo = gustavo.ad, juiciosnew.fecha_sentencia = gustavo.fecha_sentencia, 
juiciosnew.fecha_not_sentencia = gustavo.fecha_not_sentencia;

UPDATE gustavo INNER JOIN juiciosnew ON gustavo.juicionlidad = juiciosnew.juicionulidad 
SET juiciosnew.sub = gustavo.sub, juiciosnew.resultado = gustavo.resultado, juiciosnew.actor = gustavo.actor, 
juiciosnew.fecha_not = gustavo.fechanot, juiciosnew.salaconocimiento = gustavo.salaconocimiento, 
juiciosnew.fecha_sentencia = gustavo.fecha_sentencia, 
juiciosnew.fecha_not_sentencia = gustavo.fecha_not_sentencia;

UPDATE rrf INNER JOIN juiciosnew ON rrf.jucionulidad = juiciosnew.juicionulidad 
SET juiciosnew.toca_en_revision = rrf.toca_en_revision, juiciosnew.fecha_pre_rf = rrf.fecha_pre_rf, 
juiciosnew.rf_tribunal = rrf.rf_tribunal, juiciosnew.ejecutoria_revision = rrf.ejecutoria_revision, 
juiciosnew.rf_status = rrf.rf_status, juiciosnew.fecha_ejec_rev = rrf.fecha_ejec_rev, 
juiciosnew.fecha_not_ejec_rev = rrf.fecha_not_ejec_rev, juiciosnew.rf_observaciones = rrf.rf_observaciones;

UPDATE ad INNER JOIN juiciosnew ON ad.juicionulidad = juiciosnew.juicionulidad 
SET juiciosnew.ejecutoria_amparo = ad.ejecutoria_amparo, juiciosnew.fecha_ejec_amp = ad.fecha_ejec_amp, 
juiciosnew.toca_amparo = ad.toca_amparo, juiciosnew.fecha_not_ejec_amp = ad.fecha_not_ejec_amp, 
juiciosnew.ad_f_interposicion = ad.ad_f_interposicion, juiciosnew.ad_status = ad.ad_status, 
juiciosnew.ad_observaciones = ad.ad_observaciones, juiciosnew.tribunal = ad.tribunal;






