<?php
header('Content-Type: text/html; charset=UTF-8'); 
 
class libreria
{

    public function getDTNS(){
        $pdo = Database::connect();
        $sql = "SELECT *
                FROM pfrr_presuntos_audiencias
                left join pfrr on pfrr.num_accion = pfrr_presuntos_audiencias.num_accion
                where cont in (select cont from 
                    (select num_accion, cont from a
                    union all
                    select num_accion, cont from aa) as asuntos
                ) 
                and detalle_edo_tramite in (10,11,12,13,15,30)  /* 14 pelas */
            ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getDesahogo(){
        $pdo = Database::connect();
        $sql = "SELECT *
                FROM pfrr_presuntos_audiencias
                left join pfrr on pfrr.num_accion = pfrr_presuntos_audiencias.num_accion
                where cont in (select cont from 
                    (select num_accion, cont from a
                    union all
                    select num_accion, cont from aa) as asuntos
                ) 
                and detalle_edo_tramite in (16,17,18,31,19,28,22,29)
            ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getJuicios(){
        $pdo = Database::connect();
        $sql = "SELECT *
                FROM pfrr_presuntos_audiencias
                left join pfrr on pfrr.num_accion = pfrr_presuntos_audiencias.num_accion
                where cont in (select cont from 
                    (select num_accion, cont from a
                    union all
                    select num_accion, cont from aa) as asuntos
                ) 
                and detalle_edo_tramite in (23,24,25,26)
            ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    

    public function getJuiciosNew(){
        $pdo = Database::connect();
        $sql = "SELECT *
                FROM juiciosnew
                left join pfrr on pfrr.num_accion = juiciosnew.accion
                left join pfrr_presuntos_audiencias on pfrr_presuntos_audiencias.cont = juiciosnew.cont
                where juiciosnew.accion in (select num_accion from 
                    (select num_accion, cont from a
                    union all
                    select num_accion, cont from aa) as asuntos
                ) 
            ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getRR(){
        $pdo = Database::connect();
        $sql = "SELECT actores_recurso.num_accion as num_accion, actores_recurso.cont as cont, actor, recurso_reconsideracion,
                        monto_no_solventado, pfrr.cp, pfrr.entidad as entidad, actores_recurso.entidad as entidadA, actores_recurso.detalle_edo_tramite
                FROM actores_recurso
                left join pfrr on pfrr.num_accion = actores_recurso.num_accion
                left join pfrr_presuntos_audiencias on pfrr_presuntos_audiencias.cont = actores_recurso.cont
                where actores_recurso.num_accion in (select num_accion from 
                    (select num_accion, cont from a
                    union all
                    select num_accion, cont from aa) as asuntos
                ) 
            ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    
    public function getRR_b(){
        $pdo = Database::connect();
        $sql = "SELECT *
                FROM actores_recurso
                where actores_recurso.num_accion in (select num_accion from 
                    (select num_accion, cont from a
                    union all
                    select num_accion, cont from aa) as asuntos
                ) 
            ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }


    public function getAccionesIrregularidad(){
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


    public function getAccionesEntidad(){
        $pdo = Database::connect();
        $sql = "SELECT *, estados_tramite.detalle_estado, subnivel
                FROM pfrr
                inner join estados_tramite on pfrr.detalle_edo_tramite = estados_tramite.id_estado
                where num_accion in (select num_accion from aaa)
            ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getPresuntosCargo(){
        $pdo = Database::connect();
        $sql = "SELECT *
                FROM pfrr_presuntos_audiencias
                where cont in (select cont from aaaaa)
            ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getPresuntosEntidad(){
        $pdo = Database::connect();
        $sql = "SELECT *
                FROM pfrr_presuntos_audiencias
                left join pfrr on pfrr.num_accion = pfrr_presuntos_audiencias.num_accion
                where cont in (select cont from aa)
            ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getPresuntosIrregularidad(){
        $pdo = Database::connect();
        $sql = "SELECT *
                FROM pfrr_presuntos_audiencias
                left join pfrr on pfrr.num_accion = pfrr_presuntos_audiencias.num_accion
                where cont in (select cont from a)
            ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getAccionesXcargo($clave){
        $pdo = Database::connect();
        $sql = "DROP TABLE IF EXISTS aaaaa;
            CREATE TABLE aaaaa AS 
            SELECT num_accion, cont 
            FROM pfrr_presuntos_audiencias
            WHERE cargo LIKE :pat and
            ( (status = 1) and (pfrr_presuntos_audiencias.tipo <> 'titularICC') 
                and (pfrr_presuntos_audiencias.tipo <> 'titularTESOFE') and (pfrr_presuntos_audiencias.tipo <> 'responsableInforme')
            )             
            ";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam("pat", $clave, PDO::PARAM_STR);
        $stmt->execute();

        $sql = "select * from aaaaa where 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }


    public function putAccionesXirregularidad($clave){
        $pdo = Database::connect();
        $sql = "DROP TABLE IF EXISTS aaaa;
            CREATE TABLE aaaa AS 
            SELECT num_accion
            FROM pfrr 
            inner join  entidades on pfrr.entidad  = entidades.entidad
            WHERE pdrcs LIKE :pat   
               AND  entidades.tipo = 'Federal' 
        ";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam("pat", $clave, PDO::PARAM_STR);
        $stmt->execute();
        $sql = "select * from aaaa where 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function putPresuntosIrregularidad($clave){
        $pdo = Database::connect();
        $sql = "DROP TABLE IF EXISTS a;
            CREATE TABLE a AS 
            SELECT pfrr.num_accion, cont
            FROM pfrr 
            inner join  entidades on pfrr.entidad  = entidades.entidad
            left join pfrr_presuntos_audiencias on  (pfrr.num_accion = pfrr_presuntos_audiencias.num_accion)

            WHERE pdrcs LIKE :pat   and cargo LIKE :pat
               AND  entidades.tipo = 'Federal' 
               AND
               ( (status = 1) and (pfrr_presuntos_audiencias.tipo <> 'titularICC') 
               and (pfrr_presuntos_audiencias.tipo <> 'titularTESOFE') and (pfrr_presuntos_audiencias.tipo <> 'responsableInforme')
           )             
       
        ";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam("pat", $clave, PDO::PARAM_STR);
        $stmt->execute();
        $sql = "select * from a where 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }


    public function getAccionesXentidad($clave){
        $pdo = Database::connect();
        $sql = "DROP TABLE IF EXISTS aaa;
            CREATE TABLE aaa AS 
            SELECT num_accion 
            FROM pfrr 
            WHERE entidad LIKE :pat   ";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam("pat", $clave, PDO::PARAM_STR);
        $stmt->execute();
        $sql = "select * from aaa where 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }


    public function getPresuntosXentidad($clave){
        $pdo = Database::connect();
        $sql = "DROP TABLE IF EXISTS aa;
            CREATE TABLE aa AS 
            SELECT pfrr.num_accion, cont 
            FROM pfrr 
            left join pfrr_presuntos_audiencias on  (pfrr.num_accion = pfrr_presuntos_audiencias.num_accion)

            WHERE entidad LIKE :pat  and 
            ( (status = 1) and (pfrr_presuntos_audiencias.tipo <> 'titularICC') 
                and (pfrr_presuntos_audiencias.tipo <> 'titularTESOFE') and (pfrr_presuntos_audiencias.tipo <> 'responsableInforme')
            )             
            ";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam("pat", $clave, PDO::PARAM_STR);
        $stmt->execute();
        $sql = "select * from aa where 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
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


    public function dameFondo($clave) {
        try {
            $pdo = Database::connect();	
            $query = $pdo->prepare("SELECT fondo FROM fondos WHERE num_accion =:pat");
            $query->bindParam("pat", $clave, PDO::PARAM_STR);
            $query->execute();
            if ($query->rowCount() > 0) {
                $resultado = $query->fetch(PDO::FETCH_OBJ);
                return $resultado->fondo;
            } else return "--";
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

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

    public function dameJuicio($clave1, $clave2) {
        try {
            $pdo = Database::connect();	
            $query = $pdo->prepare("SELECT juicionulidad FROM juiciosnew WHERE accion =:pat1 and actor =:pat2");
            $query->bindParam("pat1", $clave1, PDO::PARAM_STR);
            $query->bindParam("pat2", $clave2, PDO::PARAM_STR);
            $query->execute();
            if ($query->rowCount() > 0) {
                $resultado = $query->fetch(PDO::FETCH_OBJ);
                return $resultado->juicionulidad;
            } else return "--";
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }


    public function getEntidad($clave){
        $pdo = Database::connect();
        $sql = "SELECT *
            FROM pfrr 
            WHERE (pfrr.entidad LIKE :pat or pdrcs LIKE :pat) and detalle_edo_tramite <> 14
            ";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam("pat", $clave, PDO::PARAM_STR);
        $stmt->execute();        
        return $stmt->fetchAll();
    }

    public function getEntidadPresuntos($clave){
        $pdo = Database::connect();
        $sql = "SELECT *
            FROM pfrr 

            left join pfrr_presuntos_audiencias on  (pfrr.num_accion = pfrr_presuntos_audiencias.num_accion)
            WHERE (pfrr.entidad LIKE :pat or pdrcs LIKE :pat) and detalle_edo_tramite <> 14 and
                ( (status = 1) and (pfrr_presuntos_audiencias.tipo <> 'titularICC') 
                    and (pfrr_presuntos_audiencias.tipo <> 'titularTESOFE') and (pfrr_presuntos_audiencias.tipo <> 'responsableInforme')
                )             

            ";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam("pat", $clave, PDO::PARAM_STR);
        $stmt->execute();        
        return $stmt->fetchAll();
    }


    


}