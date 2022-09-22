<?php 

namespace App\Models;
use CodeIgniter\Model;

class PermisosModel extends Model
{
    protected $table      = 'permisos';
    protected $primaryKey = 'idPermiso';

   // protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['nombrePermiso'];

    /*protected $useTimestamps = true;
    protected $createdField  = 'fechaAlta_Us';
    protected $updatedField  = 'fechaEdit_Us';
    protected $deletedField  = 'deleted_at';*/

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    
    function consultar(){
        $nombre = $this->findAll();
        return $nombre;
    }

}