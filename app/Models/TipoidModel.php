<?php 

namespace App\Models;
use CodeIgniter\Model;

class TipoidModel extends Model
{
    protected $table      = 'tipoid';
    protected $primaryKey = 'idTipoId';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['tipoId_nombre'];

    function consultar()
    {
        $tipoId = $this->findAll();
        return $tipoId;
    }
}