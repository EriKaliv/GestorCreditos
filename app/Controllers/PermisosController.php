<?php namespace App\Controllers;

class PermisosController extends BaseController
{
	
	public function permiso()
	{
		
		$permisos = $this->permisosRoles->verificarPermisos($this->session->idRol);
		$tienePermiso = array();

		if($permisos != null){
			foreach($permisos as $permiso){
				$tienePermiso[$permiso['nombrePermiso']] = true;

			}
		}
		return $tienePermiso ;
	}

}
