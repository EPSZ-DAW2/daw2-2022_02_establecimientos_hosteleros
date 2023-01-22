<?php

namespace app\models\classes;

/**
 *
 */
trait NombreCompletoQueryTrait
{

    public function nombreCompleto( $trozo, $alias=null)
    {
        //----------
        $db= null;
        if ($db === null) {
            $modelClass= $this->modelClass;
            $db= $modelClass::getDb();
        }
        //----------
        $termino= '%'.$trozo.'%';
        $termino= str_replace( ['%', '_'], ['@#P#@', '@#S#@'], $termino);
        $termino= $db->quoteValue( $termino);
        //Como "quoteValue" envuelve entre comillas la cadena que recibe, se
        //quitan para que el filtro lo vuelva a hacer.
        $qi= substr( $termino, 0, 1); $qf= substr( $termino, -1, 1);
        if ($qi == $qf) $termino= substr( $termino, 1, -1);
        $termino= str_replace( ['@#P#@', '@#S#@'], ['%', '_'], $termino);
        //agregar el filtro en funci�n del par�metro "alias" recibido.
        if (empty($alias)) $alias= ''; else $alias.= '.';
        return $this->andFilterWhere(['like'
            , 'CONCAT( '.$alias.'nombre, " ", '.$alias.'apellidos)'
            , $termino, false
        ]);
    }

}